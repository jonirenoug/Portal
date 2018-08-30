@extends('app')

@section('styles')

@stop

@section('content')

	<div class="wapper">
		<div class="form-main">
			<h3>Forgotten pasword</h3>
			<div class="content-form">
				<p>If you have forgotten your password, enter your registered email address below and a new temporary pasword will be sent to you inbox immediately.</p>
				<p>You will be asked to change this temporary password after login.</p>

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
				
				<form action="{{ url('reset-password') }}" class="forgotten-password" method="post">
					<div class="input-group">
						<label>Email address</label>
						<input type="text" name="email_address" placeholder="Email address">
					</div>
					{{ csrf_field()}}
					<div class="input-submit">
						<input type="submit" name="" value="Resset my Password">
					</div>
				</form>
			</div>
			
		</div>

	</div>

@stop

@push('scripts-bottom')
<script type="text/javascript">
  
</script>
@endpush