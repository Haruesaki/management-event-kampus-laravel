@extends('admin.layouts.app')

@section('title', 'Create New User')

@push('styles')
<style>
    :root {
        --bg-card: #141418;
        --border: rgba(255,255,255,0.08);
        --accent: #7c5cfc;
        --text-1: #f0f0f5;
        --text-3: #8a8a9a;
    }

    .form-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 40px;
        max-width: 600px;
        margin: 0 auto;
    }

    .form-title {
        font-family: 'Poppins', sans-serif;
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 8px;
        color: var(--text-1);
    }

    .form-desc {
        font-size: 14px;
        color: var(--text-3);
        margin-bottom: 32px;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-3);
        margin-bottom: 8px;
    }

    .form-input, .form-select {
        width: 100%;
        background: rgba(255,255,255,0.03);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 12px 16px;
        color: var(--text-1);
        font-size: 14px;
        transition: all 0.2s;
        outline: none;
    }

    .form-input:focus, .form-select:focus {
        border-color: var(--accent);
        background: rgba(124,92,252,0.05);
    }

    .btn-submit {
        width: 100%;
        background: var(--accent);
        color: #fff;
        border: none;
        padding: 14px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 16px;
    }

    .btn-submit:hover {
        background: #6b4cfc;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(124,92,252,0.3);
    }

    .error-text {
        color: #ef4444;
        font-size: 12px;
        margin-top: 6px;
    }

    .form-select option {
        background: #1a1a1f;
        color: #fff;
    }
</style>
@endpush

@section('content')
<div style="padding: 40px 0;">
    <div class="form-card">
        <h2 class="form-title">Create New User</h2>
        <p class="form-desc">Daftarkan entitas digital baru ke dalam sistem Identity Matrix.</p>

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Full Name / Username</label>
                <input type="text" name="name" class="form-input" value="{{ old('name') }}" placeholder="Contoh: Bastian Setya" required>
                @error('name') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-input" value="{{ old('email') }}" placeholder="email@example.com" required>
                @error('email') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Role</label>
                <select name="role_id" class="form-select" required>
                    <option value="" disabled selected>Pilih Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                            {{ $role->role_name }}
                        </option>
                    @endforeach
                </select>
                @error('role_id') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" placeholder="••••••••" required>
                @error('password') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-input" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-submit">Simpan & Buat Akun</button>
        </form>
    </div>
</div>
@endsection
