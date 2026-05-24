@extends('user.layouts.auth')
@section('title', 'Login')

@section('auth-content')
<div class="auth-body-login" style="width:100%; display:flex; justify-content:center;">

    {{-- Card --}}
    <div class="auth-card auth-card-login">
        
        <div class="auth-title">
            Welcome <span>Back</span>
        </div>
        <div class="auth-subtitle">Sign in to continue to Event Kampus</div>

        @if(session('success'))
            <div id="success-alert" style="
                position: fixed;
                top: 24px;
                left: 50%;
                transform: translateX(-50%);
                z-index: 9999;
                width: 90%;
                max-width: 400px;
                padding: 16px;
                background: linear-gradient(135deg, rgba(34, 197, 94, 0.95), rgba(21, 128, 61, 0.95));
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 14px;
                display: flex;
                align-items: center;
                gap: 12px;
                box-shadow: 0 20px 40px rgba(0,0,0,0.4);
                backdrop-filter: blur(10px);
                animation: slideDownAlert 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
                overflow: hidden;
            ">
                <div style="
                    width: 32px;
                    height: 32px;
                    background: rgba(255, 255, 255, 0.2);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-shrink: 0;
                ">
                    <svg style="width: 18px; height: 18px; color: #ffffff;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div style="font-size: 14px; font-weight: 600; color: #ffffff; line-height: 1.4; flex: 1;">
                    {{ session('success') }}
                </div>
                
                {{-- Progress Bar / Timer --}}
                <div id="alert-progress" style="
                    position: absolute;
                    bottom: 0;
                    left: 0;
                    height: 4px;
                    background: rgba(255, 255, 255, 0.5);
                    width: 100%;
                "></div>
            </div>

            <style>
                @keyframes slideDownAlert {
                    from { opacity: 0; transform: translate(-50%, -100px); }
                    to { opacity: 1; transform: translate(-50%, 0); }
                }
                @keyframes slideUpAlert {
                    from { opacity: 1; transform: translate(-50%, 0); }
                    to { opacity: 0; transform: translate(-50%, -100px); }
                }
                .slide-up-exit {
                    animation: slideUpAlert 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards !important;
                }
            </style>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const alert = document.getElementById('success-alert');
                    const progress = document.getElementById('alert-progress');
                    const duration = 3000; // 3 detik
                    let width = 100;
                    const interval = 10;
                    const step = (interval / duration) * 100;

                    const timer = setInterval(() => {
                        width -= step;
                        if (width <= 0) {
                            clearInterval(timer);
                            alert.classList.add('slide-up-exit');
                            setTimeout(() => {
                                alert.remove();
                            }, 500);
                        } else {
                            progress.style.width = width + '%';
                        }
                    }, interval);
                });
            </script>
        @endif

        @if(session('status'))
            <div class="alert-error" style="background:rgba(168,85,247,0.1);border-color:rgba(168,85,247,0.3);color:#d8b4fe; margin-top: 20px;">
                {{ session('status') }}
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
