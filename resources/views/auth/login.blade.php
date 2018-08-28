@extends('app')

@section('styles')
    
@stop

@section('content')

<div class="wapper">
    <div class="form-main">
        <h3>Neighbour Portal</h3>
        <div class="content-form">
            <p class="text-welcome">Welcome to your Neighbourhood dashboard. </p>
            <p class="text-welcome">Log in here to book meeting rooms, access membership details, and update your teams profile.</p>
            {{-- <p>If you are yet to register an account you can  <a href="{{ url('register') }}">create one here.</a></p> --}}

            @if(Session::has('error'))
            <div class="alert alert-danger">
                <ul style="margin:0">
                    <li>{{ Session::get('error') }}</li>
                </ul>
            </div>
            @endif

            @if(Session::has('success'))
            <div class="alert alert-success">
                <ul style="margin:0">
                    <li>{{ Session::get('success') }}</li>
                </ul>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin:0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <form action="{{ url('loginpost') }}" method="post"> 
                <div class="input-group">
                    <label>Email</label>
                    <input type="text" name="email_address" placeholder="Email address">
                </div>
                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password">
                </div>
                {{ csrf_field()}}
                <div class="input-submit">
                    <input type="submit" name="" value="Login">
                </div>
            </form>
            <a href="{{ url('forgotten-password') }}" class="f-pass">First time? Reset your login.</a>
            <a href="{{ url('forgotten-password') }}" class="f-pass float-right">Forgot my Password</a>
        </div>
        
    </div>

</div>


@stop

@push('scripts-bottom')
<script type="text/javascript">
  
</script>
@endpush