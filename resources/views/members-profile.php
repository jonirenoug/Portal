@extends('app')

@section('styles')
@stop

@section('content')

<div class="wapper">
	<div class="content-member">

				
			<div class="content-tabs">
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
				@if(Session::has('successtem'))
				    <div class="alert alert-success">
				        <ul style="margin:0">
				            <li>{{ Session::get('successtem') }}</li>
				        </ul>
				    </div>
				@endif
				<h3>Profile</h3>
				<ul class="nav nav-tabs">
					<li><a data-toggle="tab" class="@if(!Session::has('successtem')) active @endif" href="#menu1">Your details</a></li>
				</ul>
				<div class="tab-content">

					<div id="menu1" class="tab-pane @if(!Session::has('successtem')) in active @endif ">
						<form action="{{ url('/member/update') }}" enctype="multipart/form-data" method="post" class="member-profile">
							{{ csrf_field()}}
							<div class="form-group order">
								<div class="row">
									<div class="col-12 col-sm-3 box-order cl-first-name">
										<label for="First name">First name</label>
										<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" value="{{ $member['first_name'] or '' }}">
									</div>
									<div class="col-12 col-sm-3 box-order cl-surname">
										<label for="Surname">Surname</label>
										<input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" value="{{ $member['surname'] or '' }}">
									</div>
									<div class="col-12 col-sm-3 box-order avatar-image">
										<div class="circle">
									       <img class="profile-pic" src="{{ !empty($member['avatar'][0]['url']) ? $member['avatar'][0]['url']: asset('public/images/avatar-null.png') }}">
									    </div>
									    <div class="p-image">
									       <i class="fa fa-camera upload-button"></i>
									    </div>
										<input class="upload_avatar file-upload" id="Upload_avatar" type="file" name="avatar[]" value="Upload avatar" accept="image/*">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-12 col-sm-3">
										<label for="Team">Team</label>
										<input type="text" class="form-control" id="team" placeholder="Team" value="{{ $team['company_name'] or '' }}" readonly>
									</div>
								</div>
							</div>
							<hr>
							<h4>Contact details</h4>
							<div class="form-group">
								<div class="row">
									<div class="col-12 col-sm-3">
										<label for="email">Email address <i class="i-email-address"><span class="tooltiptext tooltip-top">Please contact community manager if you wish to update your email address</span></i></label>
										<input type="email" class="form-control" id="email_address" placeholder="Email address" value="{{ $member['email'] or '' }}" readonly>
									</div>
									<div class="col-12 col-sm-3">
										<label for="Phone">Phone</label>
										<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{ $member['phone'] or '' }}">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-12 col-sm-3">
										<label for="postal-address">Postal address</label>
										<input type="text" class="form-control" id="postal_address" name="postal_address" placeholder="Postal address" value="{{ $member['postal_street_address'] or '' }}">
									</div>
									<div class="col-12 col-sm-3">
										<label for="suburb">Suburb</label>
										<input type="text" class="form-control" id="suburb" name="suburb" placeholder="Suburb" value="{{ $member['postal_suburb'] or '' }}">
									</div>
									<div class="col-12 col-sm-3">
										<label for="postcode">Postcode</label>
										<input type="text" class="form-control" id="postcode" name="postcode" placeholder="Postcode" value="{{ $member['postal_postcode'] or '' }}">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-12 col-sm-3">
										<label for="state">State</label>
										<select name="state">
											<option value="act" {{ $member['postal_state'] == 'act' ? 'selected':'' }}>Australian Capital Territory</option>
											<option value="nsw" {{ $member['postal_state'] == 'nsw' ? 'selected':'' }}>New South Wales</option>
											<option value="nt" {{ $member['postal_state'] == 'nt' ? 'selected':'' }}>Northern Territory</option>
											<option value="qld" {{ $member['postal_state'] == 'qld' ? 'selected':'' }}>Queensland</option>
											<option value="sa" {{ $member['postal_state'] == 'sa' ? 'selected':'' }}>South Australia</option>
											<option value="tas" {{ $member['postal_state'] == 'tas' ? 'selected':'' }}>Tasmania</option>
											<option value="vic" {{ $member['postal_state'] == 'vic' ? 'selected':'' }}>Victoria</option>
											<option value="wa" {{ $member['postal_state'] == 'wa' ? 'selected':'' }}>Western Australia</option>
										</select>
										
									</div>
									<div class="col-12 col-sm-3">
										<label for="country">Country</label>
										<select name="country">
											<option value="australia">Australia</option>
										</select>
									</div>
								</div>
							</div>
							<hr>
							<h4>Access details</h4>
							<div class="form-group">
								<div class="row">
									<div class="col-12 col-sm-3">
										<label for="security code">Security code <i><span class="tooltiptext tooltip-top">Your personal building access code. Do not share this with anyone!</span></i></label>
										<input type="text" class="form-control" id="security_code" placeholder="Security code" value="{{ $member['security_code'] or '' }}" readonly>
									</div>
									<div class="col-12 col-sm-3">
										<label for="keyfob ID">Keyfob ID <i class="i-keyfob-id"><span class="tooltiptext tooltip-top">Building access keyfob</span></i></label>
										<input type="text" class="form-control" id="keyfob_id" placeholder="Keyfob ID" value="{{ $member['fob_number'] or '' }}" readonly>
									</div>
									<div class="col-12 col-sm-3">
										<label for="locker_number">Locker number <i class="i-locker-number"><span class="tooltiptext tooltip-top">Your locker key. Don't lose it!</span></i></label>
										<input type="text" class="form-control" id="locker_number" placeholder="Locker number" value="{{ $locker['Locker number'] or '' }}" readonly>
									</div>
								</div>
							</div>
							 
							<button type="submit" class="btn btn-default">Save changes</button>
						</form>
					</div>			
				</div>
			</div>
		</div>
</div>
@stop

@push('scripts-bottom')
@endpush