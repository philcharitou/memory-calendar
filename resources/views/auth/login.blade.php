@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="login_title"><i class="fa-solid fa-lock"></i></div>

        <div class="days_left">
            only
            <br>
            <span>{{ $days_left }} days</span>
            <br>
            left
        </div>
        <div class="card-body">
            <form class="form" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group">
                    <label for="password" class="label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="input-password form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="submit-button">
                    <div class="icon-holder">
                        <i class="fa-solid fa-lock-open"></i>
                    </div>
                    <p>Unlock Secrets</p>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
