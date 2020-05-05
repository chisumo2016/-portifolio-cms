@extends('layouts.external')

@section('content')
<div class="flex items-center justify-center bg-blue-100 min-h-screen -mt-16">
    <div class="bg-white rounded shadow mt-6">
        <div class="p-6 min-w-sm">
            <h2 class="text-3xl mb-6 font-bold text-gray-900">Login</h2>
            <form action="{{ route('login') }}" method="POST" >
                @csrf

                <div class="mb-4">
                    <label for="email" class="block mb-2 text-lg text-gray-700">Email</label>
                    <div class="flex flex-col">
                        <input id="email" type="email" class="border border-transparent bg-gray-300 rounded h-10 p-2{{ $errors->has('email') ? 'border-red-500' : ''}}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <p class="text-red-500  mt-2 leading-tight">{{ $errors->first('email') }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password">Password</label>
                    <div class="flex flex-col">
                        <input id="password" type="password" class="border border-transparent bg-gray-300 rounded h-10 p-2 {{ $errors->has('password') ? 'border-red-500' : ''}}" name="password" required autocomplete="current-password">
                        @error('password')
                        <p class="text-red-500 mt-2 leading-tight">{{ $errors->first('password') }}</p>
                        @enderror
                        <a href="{{ route('password.request') }}" class="mt-2 text-blue-600 hover:text-blue-700 transition-sm leading-tight">Forgot Password?</a>
                    </div>
                </div>
                <div class="flex items-baseline mb-6">
                    <input class="mr-3" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="text-lg text-gray-700 leading-tight">Remember</label>
                </div>
                <button type="submit" class="block px-4 py-2 mx-auto rounded bg-blue-600 hover:bg-blue-700 transition-sm text-white font-bold">Login</button>
            </form>
        </div>

    </div>
</div>

{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
