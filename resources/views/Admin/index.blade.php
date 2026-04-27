@extends('layouts.app')
@section('title', 'Manajemen User')

@push('styles')
<style>
    .page-header { margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; }
    .page-title { font-family: 'Syne',sans-serif; font-size: 28px; font-weight: 800; }
    .btn-action {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 10px 18px; border-radius: 10px;
        font-family: 'DM Sans',sans-serif; font-size: 13px; font-weight: 600;
        border: none; cursor: pointer; text-decoration: none;
        transition: all 0.2s;
    }
    .btn-primary { background: var(--accent); color: #fff; }
    .btn-primary:hover { background: #9333ea; }
    .btn-outline-sm {
        padding: 6px 14px; border-radius: 8px; font-size: 12px; font-weight: 600;
        border: 1px solid var(--border); background: transparent;
        color: var(--text-2); cursor: pointer; text-decoration: none;
        transition: all 0.2s;
    }
    .btn-outline-sm:hover { border-color: var(--accent); color: var(--accent); }
    .btn-danger-sm {
        padding: 6px 14px; border-radius: 8px; font-size: 12px; font-weight: 600;
        border: 1px solid rgba(239,68,68,0.3); background: transparent;
        color: #f87171; cursor: pointer;
        transition: all 0.2s;
    }
    .btn-danger-sm:hover { background: rgba(239,68,68,0.1); }

    .filter-bar {
        background: var(--bg-card); border: 1px solid var(--border);
        border-radius: 14px; padding: 14px 18px;
        display: flex; gap: 10px; flex-wrap: wrap;
        margin-bottom: 20px; align-items: center;
    }
    .filter-input {
        flex: 1; min-width: 200px;
        background: rgba(255,255,255,0.05); border: 1px solid var(--border);
        border-radius: 8px; padding: 9px 14px;
        font-family: 'DM Sans',sans-serif; font-size: 13px; color: var(--text-1);
        outline: none;
    }
    .filter-select {
        background: rgba(255,255,255,0.05); border: 1px solid var(--border);
        border-radius: 8px; padding: 9px 14px;
        font-family: 'DM Sans',sans-serif; font-size: 13px; color: var(--text-1);
        outline: none; cursor: pointer;
    }

    .table-wrap {
        background: var(--bg-card); border: 1px solid var(--border);
        border-radius: 14px; overflow: hidden;
    }
    table { width: 100%; border-collapse: collapse; }
    thead th {
        background: rgba(255,255,255,0.03);
        padding: 12px 16px; text-align: left;
        font-size: 11px; font-weight: 600; color: var(--text-3);
        text-transform: uppercase; letter-spacing: 0.1em;
        border-bottom: 1px solid var(--border);
    }
    tbody tr { border-bottom: 1px solid var(--border); transition: background 0.15s; }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: rgba(255,255,255,0.02); }
    tbody td { padding: 14px 16px; font-size: 13px; }

    .badge {
        display: inline-block; padding: 3px 10px; border-radius: 20px;
        font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em;
    }
    .badge-admin   { background: rgba(251,191,36,0.15); color: #fbbf24; }
    .badge-panitia { background: rgba(168,85,247,0.15); color: #a855f7; }
    .badge-peserta { background: rgba(255,255,255,0.08); color: var(--text-2); }
    .badge-active   { background: rgba(34,197,94,0.15); color: #22c55e; }
    .badge-inactive { background: rgba(239,68,68,0.15); color: #f87171; }

    .import-section {
        background: var(--bg-card); border: 1px solid var(--border);
        border-radius: 14px; padding: 20px; margin-top: 20px;
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <h1 class="page-title">Manajemen User</h1>
    <div style="display:flex;gap:10px;">
        <a href="{{ route('admin.export.users') }}" class="btn-action btn-outline-sm">⬇ Export Excel</a>
    </div>
</div>

@if(session('success'))
    <div style="background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.3);border-radius:10px;padding:12px 16px;color:#86efac;margin-bottom:16px;">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:10px;padding:12px 16px;color:#fca5a5;margin-bottom:16px;">
        {{ session('error') }}
    </div>
@endif

{{-- Filter --}}
<form method="GET">
    <div class="filter-bar">
        <input type="text" name="search" class="filter-input" placeholder="Cari nama atau email..." value="{{ request('search') }}">
        <select name="role" class="filter-select">
            <option value="">Semua Role</option>
            @foreach($roles as $role)
                <option value="{{ $role->role_name }}" {{ request('role') == $role->role_name ? 'selected' : '' }}>
                    {{ $role->role_name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn-action btn-primary">Filter</button>
    </div>
</form>

{{-- Table --}}
<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td style="font-weight:600;">{{ $user->name }}</td>
                <td style="color:var(--text-2);">{{ $user->email }}</td>
                <td>
                    <span class="badge badge-{{ strtolower($user->role->role_name) }}">
                        {{ $user->role->role_name }}
                    </span>
                </td>
                <td>
                    <span class="badge {{ $user->is_active ? 'badge-active' : 'badge-inactive' }}">
                        {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td>
                    <div style="display:flex;gap:6px;flex-wrap:wrap;">
                        {{-- Ubah Role (bukan admin) --}}
                        @if($user->role->role_name !== 'Admin')
                        <form method="POST" action="{{ route('admin.users.role', $user->id) }}" style="display:inline;">
                            @csrf @method('PUT')
                            <select name="role_id" onchange="this.form.submit()"
                                style="background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:6px;padding:5px 8px;font-size:11px;color:var(--text-2);cursor:pointer;">
                                @foreach($roles->where('role_name','!=','Admin') as $r)
                                    <option value="{{ $r->id }}" {{ $user->role_id == $r->id ? 'selected' : '' }}>
                                        {{ $r->role_name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                        @endif

                        {{-- Toggle Aktif --}}
                        <form method="POST" action="{{ route('admin.users.toggle', $user->id) }}" style="display:inline;">
                            @csrf @method('PUT')
                            <button type="submit" class="btn-outline-sm">
                                {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>

                        {{-- Hapus (hanya admin sendiri atau non-admin) --}}
                        @if($user->role->role_name !== 'Admin' || $user->id === auth()->id())
                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" style="display:inline;"
                            onsubmit="return confirm('Yakin hapus user {{ $user->name }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-danger-sm">Hapus</button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;padding:40px;color:var(--text-3);">
                    Tidak ada user ditemukan
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
<div style="margin-top:20px;">{{ $users->withQueryString()->links() }}</div>

{{-- Import Excel --}}
<div class="import-section">
    <div style="font-family:'Syne',sans-serif;font-size:16px;font-weight:700;margin-bottom:8px;">
        Import Excel — Hapus Massal User
    </div>
    <p style="font-size:13px;color:var(--text-2);margin-bottom:16px;">
        Upload file Excel berisi kolom <code>email</code>. Sistem akan menghapus semua Panitia & Peserta yang emailnya ada di file tersebut. Admin tidak akan dihapus.
    </p>
    <form method="POST" action="{{ route('admin.users.import') }}" enctype="multipart/form-data" style="display:flex;gap:10px;align-items:center;">
        @csrf
        <input type="file" name="file" accept=".xlsx,.xls" required
            style="font-size:13px;color:var(--text-2);">
        <button type="submit" class="btn-action" style="background:rgba(239,68,68,0.2);color:#f87171;border:1px solid rgba(239,68,68,0.3);">
            Import & Hapus
        </button>
    </form>
</div>

@endsection