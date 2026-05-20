@extends('user.layouts.app')
@section('title', 'Profile')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/user/profile.css') }}">
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
