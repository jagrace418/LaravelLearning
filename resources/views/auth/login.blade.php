@extends('layouts.app')

@section('content')

	<div class="bg-card w-full max-w-xs content-center mx-auto">
		<form method="POST" action="{{ route('login') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
			@csrf
			<div class="mb-4">

				<label for="email" class="block text-default text-sm font-bold mb-2">
					{{ __('E-Mail Address') }}
				</label>

				<input id="email" type="email"
					   class="bg-card shadow appearance-none border rounded w-full py-2 px-3 text-default leading-tight focus:outline-none focus:shadow-outline
                            @error('email') is-invalid @enderror"
					   name="email" value="{{ old('email') }}"
					   required autocomplete="email" autofocus>

				@error('email')
				<div class="py-1">
                    <span class="text-red-light invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
				</div>
				@enderror

			</div>

			<div class="mb-6">

				<label for="password" class="block text-default text-sm font-bold mb-2">
					{{ __('Password') }}
				</label>

				<input id="password" type="password"
					   class="bg-card shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-default mb-3 leading-tight focus:outline-none focus:shadow-outline
                            @error('password') is-invalid @enderror" name="password" required
					   autocomplete="current-password">

				@error('password')
				<div class="py-1">
                <span class="text-red-light invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
				</div>
				@enderror

			</div>

			<div class="flex items-center justify-between">

				<button type="submit"
						class="bg-button hover:bg-blue-700 text-default font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
					{{ __('Login') }}
				</button>

				@if (Route::has('password.request'))
					<a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
					   href="{{ route('password.request') }}">
						{{ __('Forgot Your Password?') }}
					</a>
				@endif

			</div>
		</form>
	</div>

@endsection
