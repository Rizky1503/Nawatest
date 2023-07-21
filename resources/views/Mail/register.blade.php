<p>Dear {{$user->name}}</p>
<br>
<p>Kode Verifikasi untuk mengaktifkan akun anda adalah</p>

<p class="font-size = 25px">{{$FourDigitRandomNumber}}</p>

<br>
<p>Terima kasih.</p>
<br>

<p>Regards,<br>
{{config('app.name')}}
