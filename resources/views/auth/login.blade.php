@extends('layouts.auth')

@section('content')

<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST" action="{{ route('login') }}">
	@csrf
	<!-- <div class="text-center mb-10">
		<h1 class="text-dark mb-3">Sign In to Metronic</h1>
		<div class="text-gray-400 fw-bold fs-4">New Here?
			<a href="authentication/flows/basic/sign-up.html" class="link-primary fw-bolder">Create an Account</a>
		</div>
	</div> -->
	<div class="fv-row mb-10">
		<label class="form-label fs-6 fw-bolder text-dark">{{ __('E-Mail Address') }}</label>
		<input class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" type="email" id="email" name="email"  value="{{ old('email') }}" required autocomplete="email" autofocus/>
		@error('email')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror
	</div>
	<div class="fv-row mb-10">
		<div class="d-flex flex-stack mb-2">
			<label class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Password') }}</label>
			@if (Route::has('password.request'))
			<a href="{{ route('password.request') }}" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
			@endif
		</div>
		<input class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" type="password" name="password" id="password" required autocomplete="current-password" />
		@error('password')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror
	</div>
	<div class="text-center">
		<button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
			{{ __('Login') }}
		</button>
	</div>
</form>

@endsection
