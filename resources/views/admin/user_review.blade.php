@extends('admin.layouts.app')

@section('title', 'User Review')

@push('styles')
<style>
  :root {
    --bg-card: #141418; --bg-card2: #1a1a1f; --bg-hover: rgba(124,92,252,0.08);
    --border: rgba(255,255,255,0.08); --accent: #7c5cfc; --accent-2: #a07fff;
    --text-1: #f0f0f5; --text-2: #c0c0cc; --text-3: #8a8a9a;
    --accent-green: #22c55e; --accent-red: #ef4444; --accent-yellow: #f59e0b; --accent-blue: #3b82f6;
  }

  .page-top {
    display: flex; align-items: flex-start; gap: 24px; margin-bottom: 32px;
  }
  .page-top-left { flex: 1; }
  .page-title {
    font-family: 'Poppins', sans-serif; font-size: 40px; font-weight: 800;
    letter-spacing: -2px; line-height: 1;
  }
  .page-title span { color: var(--accent-2); font-style: italic; }
  .page-desc { font-size: 13px; color: var(--text-3); margin-top: 10px; line-height: 1.6; max-width: 420px; }

  /* TABLE */
  .table-wrapper { background: var(--bg-card); border: 1px solid var(--border); border-radius: 14px; overflow: hidden; }
  .table-header { display: grid; grid-template-columns: 1fr 1.5fr 2.5fr 1.5fr; padding: 12px 20px; border-bottom: 1px solid var(--border); }
  .th { font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: var(--text-3); }
  .table-row {
    display: grid; grid-template-columns: 1fr 1.5fr 2.5fr 1.5fr;
    padding: 16px 20px; border-bottom: 1px solid var(--border);
    align-items: center; transition: background 0.15s;
  }
  .table-row:last-child { border-bottom: none; }
  .table-row:hover { background: var(--bg-card-2); }

  .entity-cell { display: flex; align-items: center; gap: 12px; }
  .entity-avatar { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; flex-shrink: 0; color: #fff; }
  .entity-name { font-size: 13px; font-weight: 600; color: #fff; }

  .action-badge { display: inline-block; font-size: 10px; font-weight: 700; letter-spacing: 0.5px; padding: 4px 10px; border-radius: 6px; text-transform: uppercase; }
  .bg-booking { background: rgba(59,130,246,0.1); color: var(--accent-blue); }
  .bg-admin-action { background: rgba(239,68,68,0.1); color: var(--accent-red); }
  .bg-panitia-action { background: rgba(34,197,94,0.1); color: var(--accent-green); }
  .bg-update-action { background: rgba(245,158,11,0.1); color: var(--accent-yellow); }
  .bg-default { background: rgba(124,92,252,0.1); color: var(--accent-2); }

  /* FILTER + TABLE ROW */
  .toolbar { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; gap: 16px; }
  .filter-tabs { display: flex; gap: 8px; }
  .filter-tab {
    padding: 7px 18px; border-radius: 20px; font-size: 13px; font-weight: 500;
    cursor: pointer; border: 1px solid var(--border); color: var(--text-3);
    background: transparent; transition: all 0.2s; font-family: 'DM Sans', sans-serif;
  }
  .filter-tab:hover { color: var(--text-1); border-color: rgba(255,255,255,0.15); }
  .filter-tab.active { background: var(--bg-card-2); border-color: rgba(255,255,255,0.15); color: var(--text-1); font-weight: 600; }

  .description-cell { font-size: 13px; color: var(--text-2); line-height: 1.5; }
  .time-cell { font-size: 12px; color: var(--text-3); text-align: right; font-family: 'DM Sans', sans-serif; }
</style>
@endpush

@section('content')
<div x-data="{ 
    search: '', 
    roleFilter: 'all'
}">
  <div class="page-top">
    <div class="page-top-left">
      <div class="page-title">User <span>Review</span></div>
      <p class="page-desc">Audit trail dan log aktivitas sistem secara menyeluruh. Pantau interaksi peserta, tindakan admin, dan manajemen event oleh panitia dalam satu tampilan sinkron.</p>
    </div>
  </div>

  <div class="toolbar">
    <div style="position: relative; max-width: 400px; flex: 1;">
        <input type="text" x-model="search" placeholder="Cari aktivitas atau nama user..." 
            style="width: 100%; background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px; padding: 12px 16px 12px 44px; color: #fff; outline: none; transition: all 0.2s;"
            @focus="$el.style.borderColor = 'var(--accent)'" @blur="$el.style.borderColor = 'var(--border)'">
        <svg style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); width: 18px; height: 18px; color: var(--text-3);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
        </svg>
    </div>

    <div class="filter-tabs">
        <button class="filter-tab" :class="roleFilter === 'all' ? 'active' : ''" @click="roleFilter = 'all'">All Roles</button>
        <button class="filter-tab" :class="roleFilter === 'admin' ? 'active' : ''" @click="roleFilter = 'admin'">Admin</button>
        <button class="filter-tab" :class="roleFilter === 'panitia' ? 'active' : ''" @click="roleFilter = 'panitia'">Panitia</button>
        <button class="filter-tab" :class="roleFilter === 'peserta' ? 'active' : ''" @click="roleFilter = 'peserta'">Peserta</button>
    </div>
  </div>

  <div class="table-wrapper">
    <div class="table-header">
      <div class="th">Pelaku</div>
      <div class="th">Aktivitas</div>
      <div class="th">Deskripsi</div>
      <div class="th" style="text-align: right;">Waktu (WIB)</div>
    </div>

    @forelse($logs as $log)
    @php
        $badgeClass = 'bg-default';
        if (str_contains($log->action, 'Pemesanan')) $badgeClass = 'bg-booking';
        elseif (str_contains($log->action, 'Ban') || str_contains($log->action, 'Hapus Akun')) $badgeClass = 'bg-admin-action';
        elseif (str_contains($log->action, 'Tambah Event') || str_contains($log->action, 'Hapus Event')) $badgeClass = 'bg-panitia-action';
        elseif (str_contains($log->action, 'Update')) $badgeClass = 'bg-update-action';
        
        $initials = strtoupper(substr($log->user->name ?? '?', 0, 2));
        $color = ['#3b1f8c', '#163a24', '#2a1f4a', '#1a1a2e', '#4c1d95', '#064e3b'][($log->user_id ?? 0) % 6];
        $userRole = strtolower($log->user->role->role_name ?? 'peserta');
    @endphp
    <div class="table-row" x-show="(roleFilter === 'all' || '{{ $userRole }}' === roleFilter) && (search === '' || '{{ strtolower($log->user->name ?? 'Sistem') }}'.includes(search.toLowerCase()) || '{{ strtolower($log->action) }}'.includes(search.toLowerCase()) || '{{ strtolower($log->description) }}'.includes(search.toLowerCase()))">
      <div class="entity-cell">
        <div class="entity-avatar" style="background: {{ $color }}">{{ $initials }}</div>
        <div class="entity-name">{{ $log->user->name ?? 'User Terhapus' }}</div>
      </div>
      <div>
        <span class="action-badge {{ $badgeClass }}">{{ $log->action }}</span>
      </div>
      <div class="description-cell">
        {{ $log->description }}
      </div>
      <div class="time-cell">
        {{ $log->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
      </div>
    </div>
    @empty
    <div style="padding: 40px; text-align: center; color: var(--text-3); font-size: 14px;">
        Belum ada riwayat aktivitas yang tercatat.
    </div>
    @endforelse
  </div>
</div>
@endsection
