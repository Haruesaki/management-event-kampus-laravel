@extends('layouts.app')
@section('title', 'Profile')

@push('styles')
<style>
    .profile-wrap { max-width: 560px; }
    .profile-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 32px;
        margin-bottom: 20px;
    }
    .profile-header {
        display: flex; align-items: center; gap: 20px;
        margin-bottom: 28px;
    }
    .profile-avatar {
        width: 64px; height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent), var(--accent-2));
        display: flex; align-items: center; justify-content: center;
        font-family: 'Syne',sans-serif;
        font-size: 24px; font-weight: 800;
        color: #fff;
    }
    .profile-name { font-family: 'Syne',sans-serif; font-size: 20px; font-weight: 700; }
    .profile-role {
        display: inline-block;
        font-size: 11px; font-weight: 600;
        color: var(--accent);
        text-transform: uppercase; letter-spacing: 0.1em;
        background: rgba(168,85,247,0.15);
        border-radius: 20px; padding: 3px 12px;
        margin-top: 4px;
    }
    .form-group { margin-bottom: 20px; }
    .form-label {
        display: block; font-size: 11px; font-weight: 600;
        color: var(--accent); text-transform: uppercase;
        letter-spacing: 0.1em; margin-bottom: 8px;
    }
    .form-input {
        width: 100%;
        background: rgba(255,255,255,0.05);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 12px 16px;
        font-family: 'DM Sans',sans-serif;
        font-size: 14px; color: var(--text-1);
        outline: none; transition: border-color 0.2s;
    }
    .form-input:focus { border-color: rgba(168,85,247,0.6); }
    .btn-save {
        padding: 12px 28px;
        border-radius: 10px;
        background: linear-gradient(90deg, var(--accent), var(--accent-2));
        color: #fff;
        font-family: 'DM Sans',sans-serif;
        font-size: 14px; font-weight: 700;
        border: none; cursor: pointer;
        transition: opacity 0.2s;
    }
    .btn-save:hover { opacity: 0.9; }
</style>
@endpush

@section('content')
<div class="profile-wrap">
    @if(session('success'))
        <div style="background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.3);border-radius:10px;padding:12px 16px;color:#86efac;margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
            <div>
                <div class="profile-name">{{ $user->name }}</div>
                <div class="profile-role">{{ $user->role->role_name }}</div>
            </div>
        </div>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required>
                @error('name')<div style="color:#f87171;font-size:12px;margin-top:4px;">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required>
                @error('email')<div style="color:#f87171;font-size:12px;margin-top:4px;">{{ $message }}</div>@enderror
            </div>

            <div style="border-top:1px solid var(--border);margin:24px 0 20px;"></div>
            <div style="font-size:12px;color:var(--text-3);margin-bottom:16px;">Kosongkan jika tidak ingin ubah password</div>

            <div class="form-group">
                <label class="form-label">Password Baru</label>
                <input type="password" name="password" class="form-input" placeholder="••••••••">
                @error('password')<div style="color:#f87171;font-size:12px;margin-top:4px;">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-input" placeholder="••••••••">
            </div>

            <button type="submit" class="btn-save">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection