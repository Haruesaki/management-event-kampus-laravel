@extends('admin.layouts.app')

@section('title', 'Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endpush

@section('content')
<div style="display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:28px;">
    <div>
        <h1 style="font-family:'Poppins',sans-serif;font-size:32px;font-weight:800;letter-spacing:-1px;">System Overview</h1>
        <p style="color:var(--text-secondary);font-size:14px;margin-top:4px;">Welcome back, Curator. Here is your nocturnal report.</p>
    </div>
</div>

{{-- STATS --}}
<div class="stats-grid" style="grid-template-columns: repeat(3, 1fr);">
    <div class="stat-card">
        <div class="stat-label">
            Total User Aktif
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/>
                </svg>
            </div>
        </div>
        <div class="stat-value">{{ number_format($totalUserAktif) }}</div>
        <div class="stat-sub">Entitas digital yang terverifikasi</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">
            Event Aktif
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
            </div>
        </div>
        <div class="stat-value">{{ number_format($totalEventAktif) }}</div>
        <div class="stat-sub">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            Event yang sedang berlangsung
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-label">
            Pending Payments
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
            </div>
        </div>
        <div class="stat-value">{{ number_format($pendingPayments) }}</div>
        <div class="stat-sub" style="color:var(--accent-yellow);">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            Menunggu verifikasi sistem
        </div>
    </div>
</div>

{{-- MAIN CONTENT GRID --}}
<div style="display: flex; flex-direction: column; gap: 24px;">
    
    {{-- REGISTRATIONS --}}
    <div class="section" style="margin-bottom: 0;">
        <div class="section-header">
            <span class="section-title">Recent Registrations</span>
            <a href="#" class="view-all">View All</a>
        </div>
        <div class="reg-list" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;">
            @forelse($recentRegistrations as $reg)
            @php
                $initials = strtoupper(substr($reg->user->name ?? '?', 0, 2));
                $colors = ['#7c5cfc', '#e040a0', '#22c55e', '#3b82f6', '#f59e0b'];
                $color = $colors[$reg->user_id % count($colors)];
            @endphp
            <div class="reg-item" style="border: 1px solid var(--border); padding: 20px;">
                <div class="reg-avatar" style="background: {{ $color }}; width: 48px; height: 48px; font-size: 16px;">{{ $initials }}</div>
                <div class="reg-info">
                    <div class="reg-name" style="font-size: 15px; margin-bottom: 4px;">{{ $reg->user->name ?? 'User Terhapus' }}</div>
                    <div class="reg-meta" style="font-size: 11px; color: var(--accent-2);">{{ $reg->created_at->diffForHumans() }}</div>
                </div>
                <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 6px; flex-shrink: 0; max-width: 150px;">
                    <span class="badge badge-{{ strtolower($reg->status) }}" style="font-size: 9px; padding: 2px 8px;">{{ strtoupper($reg->status) }}</span>
                    <div style="font-size: 10px; color: var(--text-3); text-align: right; line-height: 1.3; font-weight: 500;">
                        Mendaftar pada:<br>
                        <span style="color: #fff; font-weight: 600;">{{ Str::limit($reg->event->title ?? 'Event Terhapus', 30) }}</span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full" style="padding: 40px; text-align: center; color: var(--text-secondary); background: var(--bg-card); border-radius: 14px; border: 1px dashed var(--border);">
                Belum ada pendaftaran terbaru.
            </div>
            @endforelse
        </div>
    </div>

</div>

@endsection
