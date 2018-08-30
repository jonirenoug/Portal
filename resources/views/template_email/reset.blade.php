<img style="margin-top: 10px;" width="225" height="80" src="{{asset('/public/images/logo-email.png')}}" alt="">
<p>Hey {{$first_name}}</p>
<p>You have requested to reset your password.</p>
<p>You can either click the link below or copy and paste it into the address bar of your browser. You will be prompted to change your password.</p>

<p><a href="{{ url('reset-active') }}/{{$token}}">{{ url('reset-active') }}/{{$token}}</a></p>

<p>If you have any questions about your account please contact us at  <a style="text-decoration: unset; " href='hello@neighbourhood.work'>hello@neighbourhood.work</a></p>

<p style='color: #000000; font-weight: bold;'>Neighbourhood Work</p>