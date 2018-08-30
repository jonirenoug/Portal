@extends('app')

@section('styles')

@stop

@section('content')

	<div class="wapper">
		<div class="form-main">
			<h3>Reset Pasword</h3>
			<div class="content-form">

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
				
				<form action="{{ url('reset-active/token') }}" class="forgotten-password" method="post">
					<div class="input-group">
						<label>New Password</label>
						<input type="password" name="password" id="password" placeholder="New Password">
					</div>
					<div class="input-group">
						<label>Confirm Password</label>
						<input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm address">
					</div>
					{{ csrf_field()}}
					<input type="hidden" name="token_pass" value="{{ $token }}">
					<div class="input-submit">
						<input type="submit" name="" value="Reset Password">
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