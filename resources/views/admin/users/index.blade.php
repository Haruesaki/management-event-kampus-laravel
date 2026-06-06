@extends('admin.layouts.app')

@section('title', 'User Management')

@push('styles')
<style>
  :root {
    --bg-card: #141418; --bg-card2: #1a1a1f; --bg-hover: rgba(124,92,252,0.08);
    --border: rgba(255,255,255,0.08); --accent: #7c5cfc; --accent-2: #a07fff;
    --text-1: #f0f0f5; --text-2: #c0c0cc; --text-3: #8a8a9a;
    --accent-green: #22c55e; --accent-red: #ef4444; --accent-yellow: #f59e0b; --accent-pink: #e040a0;
    /* Legacy aliases for content CSS below */
    --bg-base: #0c0a14; --bg-sidebar: #13101e;
    --border-light: rgba(255,255,255,0.12);
    --text-primary: #f0f0f5; --text-secondary: #8a8a9a; --text-muted: #555566;
    --accent-purple: #7c5cfc; --accent-purple-light: #a07fff;
  }

  /* PAGE HEADER */
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

  .metric-cards { display: flex; gap: 16px; }
  .metric-card {
    background: var(--bg-card); border: 1px solid var(--border);
    border-radius: 14px; padding: 18px 22px; min-width: 160px;
  }
  .metric-card.purple-bg { background: var(--accent); border-color: var(--accent); }
  .metric-label { font-size: 11px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; color: var(--text-3); margin-bottom: 8px; }
  .metric-card.purple-bg .metric-label { color: rgba(255,255,255,0.7); }
  .metric-value { font-family: 'Poppins', sans-serif; font-size: 30px; font-weight: 800; letter-spacing: -1.5px; }
  .metric-sub { font-size: 12px; color: var(--text-3); margin-top: 4px; display: flex; align-items: center; gap: 4px; }
  .metric-card.purple-bg .metric-sub { color: rgba(255,255,255,0.7); }

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
  .btn-onboard {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 10px 20px; border-radius: 10px;
    background: rgba(124,92,252,0.15); border: 1px solid rgba(124,92,252,0.3);
    color: var(--accent-2); font-size: 13px; font-weight: 600;
    cursor: pointer; transition: all 0.2s; font-family: 'DM Sans', sans-serif;
    text-decoration: none;
  }
  .btn-onboard:hover { background: rgba(124,92,252,0.25); }
  .btn-onboard svg { width: 16px; height: 16px; }

  /* TABLE */
  .table-wrapper { background: var(--bg-card); border: 1px solid var(--border); border-radius: 14px; overflow: hidden; }
  .table-header { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; padding: 12px 20px; border-bottom: 1px solid var(--border); }
  .th { font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: var(--text-3); }
  .table-row {
    display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
    padding: 16px 20px; border-bottom: 1px solid var(--border);
    align-items: center; transition: background 0.15s; cursor: pointer;
  }
  .table-row:last-child { border-bottom: none; }
  .table-row:hover { background: var(--bg-card-2); }

  .entity-cell { display: flex; align-items: center; gap: 12px; }
  .entity-avatar { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 700; flex-shrink: 0; font-family: 'Poppins', sans-serif; color: #fff; }
  .entity-name { font-size: 14px; font-weight: 600; color: #fff; }
  .entity-email { font-size: 12px; color: var(--text-3); margin-top: 2px; }

  .role-badge { display: inline-block; font-size: 11px; font-weight: 700; letter-spacing: 0.5px; padding: 5px 12px; border-radius: 6px; text-transform: uppercase; }
  .role-admin { background: rgba(124,92,252,0.15); color: var(--accent-2); }
  .role-panitia { background: rgba(34,197,94,0.1); color: #22c55e; }
  .role-peserta { background: rgba(224,64,160,0.1); color: #e040a0; }

  .status-cell { display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--text-2); }
  .status-dot { width: 7px; height: 7px; border-radius: 50%; }
  .dot-active { background: #22c55e; box-shadow: 0 0 6px rgba(34,197,94,0.5); }
  .dot-offline { background: var(--text-3); }
  .dot-deactivated { background: #ef4444; box-shadow: 0 0 6px rgba(239,68,68,0.5); }

  .actions-cell { display: flex; align-items: center; gap: 8px; }
  .action-btn { width: 32px; height: 32px; border-radius: 8px; background: var(--bg-card-2); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text-3); transition: all 0.2s; }
  .action-btn:hover { color: var(--text-1); border-color: rgba(255,255,255,0.15); }
  .action-btn svg { width: 14px; height: 14px; }
  .table-footer { padding: 14px 20px; font-size: 12px; color: var(--text-3); border-top: 1px solid var(--border); }

  /* ALERT */
  .alert-success {
    background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.2); color: #22c55e;
    padding: 12px 20px; border-radius: 12px; margin-bottom: 24px; font-size: 14px; font-weight: 500;
  }
  .alert-error {
    background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #ef4444;
    padding: 12px 20px; border-radius: 12px; margin-bottom: 24px; font-size: 14px; font-weight: 500;
  }

  /* MODAL / POPUP */
  .modal-overlay {
    position: fixed; inset: 0; background: rgba(0,0,0,0.8);
    backdrop-filter: blur(10px); z-index: 9998;
    display: flex; align-items: center; justify-content: center;
    padding: 20px;
  }
  .insight-popup { 
    position: relative; width: 100%; max-width: 440px; 
    background: #15151e; border: 1px solid rgba(255,255,255,0.08); 
    border-radius: 28px; padding: 40px; 
    box-shadow: 0 40px 100px -20px rgba(0,0,0,0.7);
    z-index: 9999;
  }
  .popup-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 32px; }
  .popup-title { font-size: 11px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--accent); }
  .popup-close { width: 36px; height: 36px; border-radius: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text-3); font-size: 24px; background: rgba(255,255,255,0.05); border: 1px solid var(--border); transition: all 0.2s; }
  .popup-close:hover { background: rgba(239,68,68,0.1); color: #ef4444; border-color: rgba(239,68,68,0.2); }
  .popup-user { display: flex; flex-direction: column; align-items: center; text-align: center; margin-bottom: 40px; }
  .popup-avatar { width: 90px; height: 90px; border-radius: 28px; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 800; margin-bottom: 20px; color: #fff; box-shadow: 0 15px 35px rgba(0,0,0,0.3); }
  .popup-name { font-size: 22px; font-weight: 800; color: #fff; margin-bottom: 6px; letter-spacing: -0.5px; }
  .popup-role { font-size: 12px; font-weight: 700; padding: 5px 14px; border-radius: 10px; text-transform: uppercase; letter-spacing: 1px; }
  
  .popup-row { display: flex; align-items: center; justify-content: space-between; padding: 16px 0; border-bottom: 1px solid rgba(255,255,255,0.04); }
  .popup-row:last-of-type { border-bottom: none; }
  .popup-row .label { font-size: 12px; font-weight: 600; color: var(--text-3); text-transform: uppercase; }
  .popup-row .val { font-size: 14px; font-weight: 600; color: #fff; }

  .quota-bar { height: 8px; background: rgba(255,255,255,0.05); border-radius: 4px; margin-top: 24px; overflow: hidden; }
  .quota-fill { height: 100%; border-radius: 4px; transition: width 1s ease-in-out; }
  .quota-label { font-size: 11px; color: var(--text-3); margin-top: 12px; text-align: center; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
</style>
@endpush

@section('content')
<div x-data="{ 
    search: '', 
    roleFilter: 'all',
    showModal: false,
    showBanModal: false,
    showDeleteModal: false,
    selectedUser: null,
    users: [
        @foreach($users as $user)
        {
            id: {{ $user->id }},
            name: '{{ addslashes($user->name) }}',
            email: '{{ addslashes($user->email) }}',
            role: '{{ $user->role->role_name ?? 'Peserta' }}',
            isActive: {{ $user->is_active ? 'true' : 'false' }},
            joinedAt: '{{ $user->created_at->format('d M Y') }}',
            initials: '{{ strtoupper(substr($user->name, 0, 2)) }}',
            roleClass: '{{ $user->role_id == 1 ? 'role-admin' : ($user->role_id == 2 ? 'role-panitia' : 'role-peserta') }}',
            color: '{{ ['#3b1f8c', '#163a24', '#2a1f4a', '#1a1a2e', '#4c1d95', '#064e3b'][$user->id % 6] }}'
        },
        @endforeach
    ],
    get filteredUsers() {
        return this.users.filter(user => {
            const matchesRole = this.roleFilter === 'all' || user.role.toLowerCase() === this.roleFilter.toLowerCase();
            const matchesSearch = user.name.toLowerCase().includes(this.search.toLowerCase()) || 
                                user.email.toLowerCase().includes(this.search.toLowerCase());
            return matchesRole && matchesSearch;
        });
    },
    openModal(user) {
        this.selectedUser = user;
        this.showModal = true;
    },
    openBanModal(user) {
        this.selectedUser = user;
        this.showBanModal = true;
    },
    openDeleteModal(user) {
        this.selectedUser = user;
        this.showDeleteModal = true;
    }
}">
      <div class="page-top">
        <div class="page-top-left">
          <div class="page-title">Identity <span>Matrix</span></div>
          <p class="page-desc">Orchestrate campus roles and permissions from a single atmospheric nexus. Managing <span x-text="users.length"></span> active digital entities across the network.</p>
        </div>
        <div class="metric-cards">
          <div class="metric-card">
            <div class="metric-label">Network Health</div>
            <div class="metric-value">99.2<span style="font-size:18px;color:var(--text-secondary);">%</span></div>
            <div class="metric-sub">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--accent-green)" stroke-width="2.5">
                <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
              </svg>
              All systems up
            </div>
          </div>
          <div class="metric-card purple-bg">
            <div class="metric-label">Growth Metric</div>
            <div class="metric-value">+{{ $users->where('created_at', '>=', now()->startOfWeek())->count() }}</div>
            <div class="metric-sub">Active this week</div>
          </div>
        </div>
      </div>

  @if(session('success'))
      <div class="alert-success">
          {{ session('success') }}
      </div>
  @endif

  @if(session('error'))
      <div class="alert-error">
          {{ session('error') }}
      </div>
  @endif

  <div style="margin-bottom: 24px;">
    <div style="position: relative; max-width: 400px; margin-bottom: 20px;">
        <input type="text" x-model="search" placeholder="Cari user berdasarkan nama atau email..." 
            style="width: 100%; background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px; padding: 12px 16px 12px 44px; color: #fff; outline: none; transition: all 0.2s;"
            @focus="$el.style.borderColor = 'var(--accent)'" @blur="$el.style.borderColor = 'var(--border)'">
        <svg style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); width: 18px; height: 18px; color: var(--text-3);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
        </svg>
    </div>

    <div class="toolbar">
        <div class="filter-tabs">
            <button class="filter-tab" :class="roleFilter === 'all' ? 'active' : ''" @click="roleFilter = 'all'">All Roles</button>
            <button class="filter-tab" :class="roleFilter === 'admin' ? 'active' : ''" @click="roleFilter = 'admin'">Admin</button>
            <button class="filter-tab" :class="roleFilter === 'panitia' ? 'active' : ''" @click="roleFilter = 'panitia'">Panitia</button>
            <button class="filter-tab" :class="roleFilter === 'peserta' ? 'active' : ''" @click="roleFilter = 'peserta'">Peserta</button>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn-onboard" id="btnOnboard">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/>
                <line x1="8" y1="12" x2="16" y2="12"/>
            </svg>
            Create New User
        </a>
    </div>
  </div>

  <div class="table-wrapper">
    <div class="table-header">
      <div class="th">Entity Name</div>
      <div class="th">Current Role</div>
      <div class="th">Access Status</div>
      <div class="th">Operational Actions</div>
    </div>

    <template x-for="user in filteredUsers" :key="user.id">
        <div class="table-row" @click="openModal(user)">
            <div class="entity-cell">
                <div class="entity-avatar" :style="'background: ' + user.color" x-text="user.initials"></div>
                <div>
                    <div class="entity-name" x-text="user.name"></div>
                    <div class="entity-email" x-text="user.email"></div>
                </div>
            </div>
            <div>
                <span class="role-badge" :class="user.roleClass" x-text="user.role"></span>
            </div>
            <div class="status-cell">
                <div class="status-dot" :class="user.isActive ? 'dot-active' : 'dot-offline'"></div>
                <span x-text="user.isActive ? 'Active' : 'Inactive'"></span>
            </div>
            <div class="actions-cell">
                <button type="button" class="action-btn" :title="user.isActive ? 'Ban User' : 'Unban User'" @click.stop="openBanModal(user)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" :style="!user.isActive ? 'color: #22c55e' : 'color: #ef4444'">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
                    </svg>
                </button>
                <button type="button" class="action-btn" title="Delete User" @click.stop="openDeleteModal(user)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: #ef4444">
                        <polyline points="3 6 5 6 21 6"/>
                        <path d="M19 6l-1 14H6L5 6"/>
                        <path d="M10 11v6M14 11v6"/>
                        <path d="M9 6V4h6v2"/>
                    </svg>
                </button>
            </div>
        </div>
    </template>

    <div x-show="filteredUsers.length === 0" style="padding: 40px; text-align: center; color: var(--text-3); font-size: 14px;">
        Tidak ada user yang ditemukan.
    </div>

    <div class="table-footer">Showing <span x-text="filteredUsers.length"></span> identities</div>
  </div>

  <!-- DYNAMIC INSIGHT POPUP WITH BACKDROP -->
  <div x-show="showModal" class="modal-overlay" style="display: none;" x-transition:enter="transition opacity duration-300" x-transition:leave="transition opacity duration-200">
    <div class="insight-popup" @click.away="showModal = false" x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-95 opacity-0" x-transition:enter-end="scale-100 opacity-100">
      <div class="popup-header">
        <span class="popup-title">User Identification</span>
        <div class="popup-close" @click="showModal = false">×</div>
      </div>
      <template x-if="selectedUser">
          <div>
              <div class="popup-user">
                  <div class="popup-avatar" :style="'background: ' + selectedUser.color" x-text="selectedUser.initials"></div>
                  <div class="popup-name" x-text="selectedUser.name"></div>
                  <span class="popup-role" :class="selectedUser.roleClass" x-text="selectedUser.role"></span>
              </div>
              
              <div class="popup-row">
                  <span class="label">Email Identity</span>
                  <span class="val" x-text="selectedUser.email"></span>
              </div>
              <div class="popup-row">
                  <span class="label">Registration Date</span>
                  <span class="val" x-text="selectedUser.joinedAt"></span>
              </div>
              <div class="popup-row">
                  <span class="label">Access Status</span>
                  <span class="val" :style="selectedUser.isActive ? 'color: #22c55e' : 'color: #ef4444'" x-text="selectedUser.isActive ? 'Authorized' : 'Deactivated'"></span>
              </div>

              <div class="quota-bar">
                  <div class="quota-fill" :style="'width: ' + (selectedUser.isActive ? '100%' : '0%') + '; background: ' + (selectedUser.isActive ? '#22c55e' : '#ef4444')"></div>
              </div>
              <div class="quota-label">Network Integrity: <span x-text="selectedUser.isActive ? 'Optimal' : 'Compromised'"></span></div>
          </div>
      </template>
    </div>
  </div>

  <!-- BAN CONFIRMATION MODAL -->
  <div x-show="showBanModal" class="modal-overlay" style="display: none;" x-transition:enter="transition opacity duration-300" x-transition:leave="transition opacity duration-200">
    <div class="insight-popup" @click.away="showBanModal = false" x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-95 opacity-0" x-transition:enter-end="scale-100 opacity-100">
        <div class="popup-header">
            <span class="popup-title" x-text="selectedUser?.isActive ? 'Confirm Ban' : 'Confirm Activation'"></span>
            <div class="popup-close" @click="showBanModal = false">×</div>
        </div>
        <template x-if="selectedUser">
            <div style="text-align: center;">
                <div style="margin-bottom: 24px; color: var(--text-1); font-size: 16px; line-height: 1.6;">
                    Apakah Anda yakin ingin <span x-text="selectedUser.isActive ? 'membanned' : 'mengaktifkan kembali'"></span> akun 
                    <strong x-text="selectedUser.name"></strong>?
                </div>
                <div x-show="selectedUser.isActive" style="background: rgba(239,68,68,0.1); border-radius: 12px; padding: 12px; margin-bottom: 24px; color: #ef4444; font-size: 13px;">
                    Pengguna tidak akan bisa masuk ke sistem setelah dibanned.
                </div>
                <form :action="'/admin/users/' + selectedUser.id + '/toggle-status'" method="POST">
                    @csrf
                    <div style="display: flex; gap: 12px;">
                        <button type="button" @click="showBanModal = false" style="flex: 1; padding: 12px; border-radius: 12px; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: #fff; font-weight: 600; cursor: pointer;">Batal</button>
                        <button type="submit" style="flex: 1; padding: 12px; border-radius: 12px; border: none; color: #fff; font-weight: 700; cursor: pointer;"
                            :style="selectedUser.isActive ? 'background: #ef4444' : 'background: #22c55e'"
                            x-text="selectedUser.isActive ? 'Ya, Banned Akun' : 'Ya, Aktifkan Akun'"></button>
                    </div>
                </form>
            </div>
        </template>
    </div>
  </div>

  <!-- DELETE CONFIRMATION MODAL -->
  <div x-show="showDeleteModal" class="modal-overlay" style="display: none;" x-transition:enter="transition opacity duration-300" x-transition:leave="transition opacity duration-200">
    <div class="insight-popup" @click.away="showDeleteModal = false" x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-95 opacity-0" x-transition:enter-end="scale-100 opacity-100">
        <div class="popup-header">
            <span class="popup-title" style="color: #ef4444;">Permanent Deletion</span>
            <div class="popup-close" @click="showDeleteModal = false">×</div>
        </div>
        <template x-if="selectedUser">
            <div style="text-align: center;">
                <div style="margin-bottom: 24px; color: var(--text-1); font-size: 16px; line-height: 1.6;">
                    Anda akan menghapus akun <strong x-text="selectedUser.name"></strong> secara <span style="color: #ef4444; font-weight: 800;">PERMANEN</span>.
                </div>
                <div style="background: rgba(239,68,68,0.1); border-radius: 12px; padding: 16px; margin-bottom: 24px; color: #ef4444; font-size: 13px; text-align: left;">
                    <p style="font-weight: 700; margin-bottom: 8px;">Peringatan Keamanan:</p>
                    <ul style="list-style: disc; margin-left: 20px;">
                        <li>Data akun akan dihapus dari database.</li>
                        <li>Tindakan ini tidak dapat dibatalkan.</li>
                        <li>Seluruh riwayat user akan ikut terhapus.</li>
                    </ul>
                </div>
                <form :action="'/admin/users/' + selectedUser.id" method="POST">
                    @csrf
                    @method('DELETE')
                    <div style="display: flex; gap: 12px;">
                        <button type="button" @click="showDeleteModal = false" style="flex: 1; padding: 12px; border-radius: 12px; background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: #fff; font-weight: 600; cursor: pointer;">Batalkan</button>
                        <button type="submit" style="flex: 1; padding: 12px; border-radius: 12px; background: #ef4444; border: none; color: #fff; font-weight: 700; cursor: pointer;">Ya, Hapus Permanen</button>
                    </div>
                </form>
            </div>
        </template>
    </div>
  </div>
</div>
@endsection
