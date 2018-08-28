@extends('app')

@section('styles')
@stop

@section('content')

<div class="wapper">
	<div class="form-main">
			<h3>New members</h3>
		<div class="content-form">
			<strong>Welcome to the Neighbourhood</strong>
			<p>Please add person details of each of your team members so we can get security credentials up and running</p>
			@if(Session::has('error'))
		    <div class="alert alert-danger">
		        <ul style="margin:0">
		            <li>{{ Session::get('error') }}</li>
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
<<<<<<< HEAD
			<form id="form-register" action="{{ url('registerpost') }}" method="post">
=======
			<form id="form-register" action="{{ url('register') }}" method="post">
>>>>>>> 13149d82becc96d2e41b3c217c795ccff71340a8
				<div class="input-group">
					<label>Team name</label>
					
					<select name="team">
						<option value=" rec5zMvFuPdDa1R48 ">Navigate Communications</option>
						<option value=" rec7z7bmW5HoxxXkt ">The Smart Business Exit</option>
					</select>
				</div>
				<div class="input-group w50">
					<label>First name</label>
					<input type="text" name="first_name" placeholder="First name">
				</div>
				<div class="input-group w50 w_last">
					<label>Surname</label>
					<input type="text" name="surname" placeholder="Surname">
				</div>
				<div class="input-group">
					<label>Email address</label>
					<input type="text" name="email_address" placeholder="Email address">
				</div>
				<div class="input-group">
					<label>Password</label>
					<input type="password" id="passregister" name="passregister" placeholder="Password" >
				</div>
				<div class="input-group">
					<label>Confirm password</label>
					<input type="password" id="confirm_passregister" name="confirm_passregister" placeholder="Confirm password">
				</div>
				{{ csrf_field()}}
				<div class="input-submit">
					<input type="submit" name="" value="Submit">
				</div>
			</form>
		</div>
		
	</div>

</div>
@stop

@push('scripts-bottom')
<<<<<<< HEAD
=======

>>>>>>> 13149d82becc96d2e41b3c217c795ccff71340a8
@endpush