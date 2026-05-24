@extends('user.layouts.app')
@section('title', 'Profile')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/user/profile.css') }}">
<style>
    /* Theme Overrides & Additions */
    .profile-container {
        max-width: 900px;
        margin: 0 auto;
    }

    /* Hero Profile Section */
    .profile-hero {
        background: linear-gradient(135deg, #1c1829 0%, #13101e 100%);
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 40px;
        margin-bottom: 32px;
        display: flex;
        align-items: center;
        gap: 40px;
        position: relative;
        overflow: hidden;
    }

    .profile-hero::after {
        content: '';
        position: absolute;
        top: -50px; right: -50px;
        width: 200px; height: 200px;
        background: radial-gradient(circle, var(--accent-soft), transparent 70%);
        opacity: 0.3;
    }

    .avatar-upload-container {
        position: relative;
        width: 140px;
        height: 140px;
        flex-shrink: 0;
    }

    .avatar-preview {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--bg-sidebar);
        box-shadow: 0 0 0 2px var(--accent);
        background: linear-gradient(135deg, var(--accent), var(--accent-2));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        font-weight: 800;
        color: #fff;
        font-family: 'Poppins', sans-serif;
    }

    .btn-edit-avatar {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--accent);
        border: 3px solid var(--bg-sidebar);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-edit-avatar:hover {
        transform: scale(1.1);
        background: var(--accent-2);
    }

    .hero-info-name {
        font-family: 'Poppins', sans-serif;
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 4px;
        color: #fff;
    }

    .hero-info-meta {
        color: var(--text-3);
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .hero-info-meta span {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Tabs Navigation */
    .profile-tabs-nav {
        display: flex;
        gap: 8px;
        margin-bottom: 24px;
        background: rgba(255, 255, 255, 0.03);
        padding: 6px;
        border-radius: 14px;
        width: fit-content;
        border: 1px solid var(--border);
    }

    .tab-btn {
        padding: 10px 24px;
        border-radius: 10px;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-3);
        cursor: pointer;
        transition: all 0.2s;
        border: none;
        background: transparent;
    }

    .tab-btn:hover {
        color: #fff;
    }

    .tab-btn.active {
        background: linear-gradient(135deg, var(--accent), var(--accent-2));
        color: #fff;
        box-shadow: 0 4px 12px rgba(179, 102, 255, 0.2);
    }

    /* Settings Card */
    .settings-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 32px;
        min-height: 400px;
    }

    .card-title {
        font-family: 'Poppins', sans-serif;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .card-title svg {
        width: 22px;
        height: 22px;
        color: var(--accent);
    }

    .tab-content {
        display: none;
        animation: fadeIn 0.3s ease;
    }

    .tab-content.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Form Styling */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-3);
        margin-bottom: 8px;
    }

    .form-input, .form-select {
        width: 100%;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 12px 16px;
        color: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        transition: all 0.2s;
        outline: none;
    }

    .form-input:focus, .form-select:focus {
        border-color: var(--accent);
        background: rgba(255, 255, 255, 0.05);
        box-shadow: 0 0 0 3px rgba(179, 102, 255, 0.1);
    }

    .form-select {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%238a8a9a' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
    }

    .form-select option {
        background-color: #13101e;
        color: #fff;
    }

    .form-select option:first-child {
        color: var(--text-3);
    }

    .btn-save {
        background: linear-gradient(135deg, var(--accent), var(--accent-2));
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 14px 32px;
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 10px;
        width: fit-content;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(179, 102, 255, 0.3);
    }

    /* Stats mini section */
    .stats-row {
        display: flex;
        gap: 16px;
        margin-top: 24px;
    }

    .stat-mini {
        background: rgba(255,255,255,0.03);
        border-radius: 12px;
        padding: 12px 20px;
        flex: 1;
        text-align: center;
    }

    .stat-mini-val {
        font-size: 18px;
        font-weight: 800;
        color: var(--accent);
        display: block;
    }

    .stat-mini-label {
        font-size: 10px;
        color: var(--text-3);
        text-transform: uppercase;
        font-weight: 700;
    }
</style>
@endpush

@section('content')
<div class="profile-container">
    {{-- Hero Profile Section --}}
    <div class="profile-hero">
        <div class="avatar-upload-container">
            <div class="avatar-preview">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <label for="avatar-input" class="btn-edit-avatar">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="width: 16px; height: 16px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </label>
            <input type="file" id="avatar-input" style="display: none;" accept="image/*">
        </div>
        <div class="hero-info">
            <h1 class="hero-info-name">{{ auth()->user()->name }}</h1>
            <div class="hero-info-meta">
                <span>
                    <svg style="width: 14px; height: 14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    {{ auth()->user()->email }}
                </span>
                <span>• Member since {{ auth()->user()->created_at->format('Y') }}</span>
            </div>
            <div class="stats-row">
                <div class="stat-mini">
                    <span class="stat-mini-val">12</span>
                    <span class="stat-mini-label">Events Joined</span>
                </div>
                <div class="stat-mini">
                    <span class="stat-mini-val">4</span>
                    <span class="stat-mini-label">Active Tickets</span>
                </div>
                <div class="stat-mini">
                    <span class="stat-mini-val">2.4k</span>
                    <span class="stat-mini-label">XP Points</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabs Navigation --}}
    <div class="profile-tabs-nav">
        <button class="tab-btn active" onclick="switchTab(event, 'personal')">Personal Info</button>
        <button class="tab-btn" onclick="switchTab(event, 'security')">Security</button>
    </div>

    <div class="settings-card">
        {{-- Tab: Personal Info --}}
        <div id="personal" class="tab-content active">
            <h2 class="card-title">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Personal Details
            </h2>
            <form action="#" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-input" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-input" value="{{ auth()->user()->email }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Student ID / NPM</label>
                        <input type="text" class="form-input" placeholder="e.g. 2407051001">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-input" placeholder="e.g. +62 812 3456 7890">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="" disabled selected>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Prefer not to say</option>
                        </select>
                    </div>
                </div>
                <div style="margin-top: 20px; border-top: 1px solid var(--border); padding-top: 24px;">
                    <button type="submit" class="btn-save">Save Changes</button>
                </div>
            </form>
        </div>

        {{-- Tab: Security --}}
        <div id="security" class="tab-content">
            <h2 class="card-title">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                Account Security
            </h2>
            <form action="#" method="POST">
                @csrf
                <div style="max-width: 500px;">
                    <div class="form-group">
                        <label class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-input" placeholder="••••••••">
                    </div>
                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" class="form-input" placeholder="Min. 8 characters">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-input" placeholder="Repeat new password">
                    </div>
                    <div style="margin-top: 20px; border-top: 1px solid var(--border); padding-top: 24px;">
                        <button type="submit" class="btn-save">Update Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Account Actions --}}
    <div style="margin-top: 32px; display: flex; justify-content: flex-end; gap: 16px;">
        <button style="background: none; border: 1px solid rgba(239, 68, 68, 0.3); color: #ef4444; padding: 12px 24px; border-radius: 12px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='rgba(239,68,68,0.05)'" onmouseout="this.style.background='none'">
            Deactivate Account
        </button>
    </div>
</div>

<script>
    // Tab switching logic
    function switchTab(evt, tabName) {
        // Hide all content
        const contents = document.querySelectorAll('.tab-content');
        contents.forEach(content => content.classList.remove('active'));

        // Deactivate all buttons
        const tabs = document.querySelectorAll('.tab-btn');
        tabs.forEach(tab => tab.classList.remove('active'));

        // Show current tab and activate button
        document.getElementById(tabName).classList.add('active');
        evt.currentTarget.classList.add('active');
    }

    // Preview image logic
    document.getElementById('avatar-input').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.querySelector('.avatar-preview');
                preview.innerHTML = `<img src="${event.target.result}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">`;
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endsection
