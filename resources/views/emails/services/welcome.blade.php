@component('mail::message')
# Layanan Anda Telah Aktif!

Halo **{{ $service->user->name }}**,

Selamat! Layanan hosting Anda untuk domain **{{ $service->domain }}** telah berhasil diaktifkan.
Berikut adalah detail login untuk akun cPanel Anda. Harap simpan informasi ini di tempat yang aman.

@component('mail::panel')
**Paket Layanan:** {{ $service->product->name }} <br>
**Domain:** {{ $service->domain }} <br>
**Username cPanel:** `{{ $cpanelUsername }}` <br>
**Password cPanel:** `{{ $cpanelPassword }}`
@endcomponent

Anda bisa langsung login ke cPanel melalui tombol di bawah ini.

@component('mail::button', ['url' => 'http://' . $service->domain . '/cpanel', 'color' => 'primary'])
Login ke cPanel
@endcomponent

Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi tim support kami.

Terima kasih,<br>
Tim {{ config('app-name') }}
@endcomponent