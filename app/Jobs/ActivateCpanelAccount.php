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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ActivateCpanelAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // Beri waktu 10 menit dan coba 3 kali jika gagal
    public $timeout = 600;
    public $tries = 3;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Service $service
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $host = config('services.whm.host');
        $user = config('services.whm.user');
        $token = config('services.whm.token');
        $username = strtolower(substr(preg_replace('/[^a-zA-Z0-9]/', '', $this->service->domain), 0, 8));
        $password = Str::random(12) . 'A1!';

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

        if ($response->successful() && $response->json()['metadata']['result'] == 1) {
            // Jika berhasil, update status di DB dan kirim email
            $this->service->update(['status' => 'active']);
            Mail::to($this->service->user->email)->send(new NewServiceWelcomeEmail($this->service, $username, $password));
        } else {
            // Jika gagal, kita bisa update status jadi 'failed' atau kirim notif ke admin
            // Untuk sekarang, kita biarkan saja agar bisa dicoba lagi oleh cron job
        }
    }
}