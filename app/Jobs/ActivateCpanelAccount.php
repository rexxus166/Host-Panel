<?php

namespace App\Jobs;

use App\Models\Service;
use App\Mail\NewServiceWelcomeEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ActivateCpanelAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Waktu maksimum pekerjaan dapat berjalan (dalam detik).
     * @var int
     */
    public $timeout = 600; // 10 menit

    /**
     * Jumlah percobaan ulang jika pekerjaan gagal.
     * @var int
     */
    public $tries = 3;

    /**
     * Buat instance pekerjaan baru.
     */
    public function __construct(
        public Service $service
    )
    {
        //
    }

    /**
     * Jalankan pekerjaan.
     */
    public function handle(): void
    {
        // 1. Catat ke log bahwa pekerjaan dimulai
        Log::info('Memulai job aktivasi untuk domain: ' . $this->service->domain);

        // 2. Ambil kredensial dari file config
        $host = config('services.whm.host');
        $user = config('services.whm.user');
        $token = config('services.whm.token');

        // 3. Siapkan parameter unik untuk akun cPanel baru
        $username = strtolower(substr(preg_replace('/[^a-zA-Z0-9]/', '', $this->service->domain), 0, 8));
        $password = Str::random(12) . 'A1!';

        // 4. Kirim request ke WHM API
        $response = Http::withoutVerifying()
                         ->timeout(300) // Timeout 5 menit
                         ->withHeaders(['Authorization' => 'whm ' . $user . ':' . $token])
                         ->get("https://{$host}:2087/json-api/createacct", [
                            'api.version'   => 1,
                            'username'      => $username,
                            'domain'        => $this->service->domain,
                            'password'      => $password,
                            'plan'          => $this->service->product->package_name_whm,
                            'contactemail'  => $this->service->user->email,
                         ]);
        
        // 5. Proses respon dari WHM
        if ($response->successful() && isset($response->json()['metadata']['result']) && $response->json()['metadata']['result'] == 1) {
            
            Log::info('Akun cPanel untuk ' . $this->service->domain . ' berhasil dibuat.');
            
            // Update status layanan di database menjadi 'active'
            $this->service->update(['status' => 'active']);

            // Coba kirim email notifikasi ke pengguna
            try {
                Log::info('Mencoba mengirim email ke ' . $this->service->user->email);
                Mail::to($this->service->user->email)->send(new NewServiceWelcomeEmail($this->service, $username, $password));
                Log::info('Email berhasil dikirim untuk domain ' . $this->service->domain);
            } catch (\Exception $e) {
                // Jika pengiriman email GAGAL, catat errornya tapi jangan hentikan proses
                Log::error('Gagal mengirim email aktivasi untuk domain ' . $this->service->domain . ': ' . $e->getMessage());
            }

        } else {
            // Jika GAGAL membuat akun, catat errornya ke log
            $reason = $response->json()['metadata']['reason'] ?? 'Respon tidak diketahui dari WHM.';
            Log::error('Gagal membuat akun cPanel untuk domain ' . $this->service->domain . ': ' . $reason);
        }
    }
}