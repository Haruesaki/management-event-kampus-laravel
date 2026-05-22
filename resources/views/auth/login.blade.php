@extends('user.layouts.auth')
@section('title', 'Login')

@section('auth-content')
<div style="width:100%; max-width:400px;">

    {{-- Card --}}
    <div class="auth-card">
        
        <div class="auth-title">
            Welcome <span>Back</span>
        </div>
        <div class="auth-subtitle">Sign in to continue to Event Kampus</div>

        @if(session('status'))
            <div class="alert-error" style="background:rgba(168,85,247,0.1);border-color:rgba(168,85,247,0.3);color:#d8b4fe; margin-top: 20px;">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error" style="margin-top: 20px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            {{-- Email --}}
            <div class="form-group" style="margin-top:0;">
                <label class="form-label">Email Address</label>
                <div class="input-wrap">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="curator@ethereal.stage"
                        autocomplete="email"
                        required
                    >
                </div>
                @error('email')<div class="field-error">{{ $message }}</div>@enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <div class="forgot-row">
                    <label class="form-label" style="margin-bottom:0;">Password</label>
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Forgot Password?</a>
                    @endif
                </div>
                <div class="input-wrap" style="margin-top:8px;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        autocomplete="current-password"
                        required
                    >
                </div>
                @error('password')<div class="field-error">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn-primary">LOGIN</button>
        </form>

        <div class="auth-footer">
            Don't have an account? <a href="{{ route('register') }}">Register</a>
        </div>
    </div>
</div>
@endsection
