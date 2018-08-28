<p>Hi {{$name}}</p>
<p>You have requested to reset your password.</p>
<p>You can either click the link below or copy and paste it into the address bar of your browser. You will be prompted to change your password.</p>

<p><a href="{{ url('reset-active') }}/{{$token}}">{{ url('reset-active') }}/{{$token}}</a></p>

<p>If you have any questions about your account or any other matter, please contact us at <a href='support@domain.com'>support@domain.com</a></p>

<p>Cheers,</p>
<p style='color: #00b7a6; font-weight: bold;'>
	NHW Team
</p>