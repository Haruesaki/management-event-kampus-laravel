@extends('layouts.app')
@section('title', 'Profile')

@push('styles')
<style>
    .profile-header { margin-bottom: 36px; }
    .profile-label {
        font-size: 10px; font-weight: 600; color: var(--text-3);
        text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 6px;
    }
    .profile-title {
        font-family: 'Syne', sans-serif;
        font-size: 36px; font-weight: 800; margin-bottom: 8px;
    }
    .profile-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 40px;
        display: flex; align-items: center; gap: 28px;
        margin-bottom: 24px;
    }
    .profile-avatar {
        width: 80px; height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent), var(--accent-2));
        display: flex; align-items: center; justify-content: center;
        font-family: 'Syne', sans-serif;
        font-size: 28px; font-weight: 800; color: #fff;
        border: 3px solid rgba(168,85,247,0.35);
        flex-shrink: 0;
    }
    .profile-info-name { font-family: 'Syne', sans-serif; font-size: 22px; font-weight: 700; margin-bottom: 4px; }
    .profile-info-sub { font-size: 13px; color: var(--text-3); }
    .coming-soon {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 48px;
        text-align: center;
        color: var(--text-3);
    }
    .coming-soon svg { width: 48px; height: 48px; margin: 0 auto 16px; opacity: 0.4; }
    .coming-soon h3 { font-family: 'Syne', sans-serif; font-size: 18px; font-weight: 700; color: var(--text-2); margin-bottom: 8px; }
    .coming-soon p { font-size: 13px; }
</style>
@endpush

@section('content')

<div class="profile-header">
    <div class="profile-label">Account</div>
    <h1 class="profile-title">Profile</h1>
</div>

<div class="profile-card">
    <div class="profile-avatar">D</div>
    <div>
        <div class="profile-info-name">Digital Curator</div>
        <div class="profile-info-sub">Member since 2024 · Ethereal Auditorium</div>
    </div>
</div>

<div class="coming-soon">
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
    </svg>
    <h3>Profile Settings</h3>
    <p>Fitur pengaturan profil akan segera hadir.</p>
</div>

@endsection
