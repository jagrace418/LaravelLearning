@extends('layouts.app')

@section('content')

    <div class="w-full max-w-xs mx-auto">

        <form method="POST" action="{{ route('register') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">

                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                    {{ __('Name') }}
                </label>

                <input id="name" type="text"
                       class="form-control shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                        @error('name') is-invalid @enderror"
                       name="name" value="{{ old('name') }}"
                       required autocomplete="name" autofocus>

                @error('name')
                <div class="py-1">
                    <span class="text-red-light invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror

            </div>

            <div class="mb-6">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                    {{ __('E-Mail Address') }}
                </label>


                <input id="email" type="email"
                       class="form-control shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                        @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}"
                       required autocomplete="email">

                @error('email')
                <div class="py-1">
                    <span class="text-red-light invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror

            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                    {{ __('Password') }}
                </label>

                <input id="password" type="password"
                       class="form-control shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                        @error('password') is-invalid @enderror"
                       name="password" required autocomplete="new-password">

                @error('password')
                <div class="py-1">
                    <span class="text-red-light invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror

            </div>

            <div class="mb-6">

                <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2">
                    {{ __('Confirm Password') }}
                </label>

                <input id="password-confirm" type="password"
                       class="form-control shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       name="password_confirmation" required autocomplete="new-password">

            </div>

            <div class="col-md-6 offset-md-4">
                <button type="submit"
                        class="bg-blue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{ __('Register') }}
                </button>
            </div>


        </form>
    </div>
@endsection
