@component('mail::message')
# Halo, {{ $user->name }}

Pengajuan cuti Anda telah **{{ $status }}**.

@if($catatan)
Catatan:
> {{ $catatan }}
@endif

@component('mail::button', ['url' => url('/cuti')])
Lihat Pengajuan Cuti
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
