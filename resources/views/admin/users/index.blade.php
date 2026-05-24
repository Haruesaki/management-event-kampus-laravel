<?php
$page_title = "User Management";
$active_page = "user-management";
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CampusAdmin - User Management</title>
<link rel="stylesheet" href="{{ asset('css/shared/layout.css') }}">
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
  .layout { display: flex; height: 100vh; width: 100%; overflow: hidden; }
  .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
  .content { flex: 1; overflow-y: auto; padding: 32px 28px; }
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
  .entity-avatar { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 700; flex-shrink: 0; font-family: 'Poppins', sans-serif; }
  .entity-name { font-size: 14px; font-weight: 600; }
  .entity-email { font-size: 12px; color: var(--text-3); margin-top: 2px; }

  .role-badge { display: inline-block; font-size: 11px; font-weight: 700; letter-spacing: 0.5px; padding: 5px 12px; border-radius: 6px; text-transform: uppercase; }
  .role-admin { background: rgba(124,92,252,0.15); color: var(--accent-2); }
  .role-panitia { background: rgba(34,197,94,0.1); color: #22c55e; }
  .role-peserta { background: rgba(224,64,160,0.1); color: #e040a0; }

  .status-cell { display: flex; align-items: center; gap: 8px; font-size: 13px; }
  .status-dot { width: 7px; height: 7px; border-radius: 50%; }
  .dot-active { background: #22c55e; box-shadow: 0 0 6px rgba(34,197,94,0.5); }
  .dot-offline { background: var(--text-3); }
  .dot-deactivated { background: #ef4444; box-shadow: 0 0 6px rgba(239,68,68,0.5); }

  .actions-cell { display: flex; align-items: center; gap: 8px; }
  .action-btn { width: 32px; height: 32px; border-radius: 8px; background: var(--bg-card-2); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text-3); transition: all 0.2s; }
  .action-btn:hover { color: var(--text-1); border-color: rgba(255,255,255,0.15); }
  .action-btn svg { width: 14px; height: 14px; }
  .table-footer { padding: 14px 20px; font-size: 12px; color: var(--text-3); border-top: 1px solid var(--border); }

  /* INSIGHT POPUP */
  .insight-popup { position: fixed; right: 28px; bottom: 28px; width: 300px; background: var(--bg-card-2); border: 1px solid rgba(255,255,255,0.12); border-radius: 16px; padding: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.5); animation: slideUp 0.3s ease; }
  @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
  .popup-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; }
  .popup-title { font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--text-3); }
  .popup-close { width: 24px; height: 24px; border-radius: 6px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text-3); font-size: 16px; background: var(--bg-card); border: 1px solid var(--border); }
  .popup-user { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; }
  .popup-avatar { width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg, #1a6335, #22c55e); display: flex; align-items: center; justify-content: center; font-size: 15px; font-weight: 700; }
  .popup-name { font-size: 15px; font-weight: 700; }
  .popup-role { font-size: 12px; color: #22c55e; margin-top: 2px; }
  .popup-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; }
  .popup-row .label { font-size: 12px; color: var(--text-3); }
  .popup-row .val { font-size: 12px; font-weight: 600; }
  .quota-bar { height: 4px; background: var(--border); border-radius: 2px; margin-top: 10px; overflow: hidden; }
  .quota-fill { height: 100%; border-radius: 2px; background: linear-gradient(90deg, var(--accent), #e040a0); width: 85%; }
  .quota-label { font-size: 11px; color: var(--text-3); margin-top: 6px; text-align: right; }
</style>
</head>
<body>
<div class="layout">

  <!-- SIDEBAR (shared design) -->
  <aside class="sidebar">
    <div class="sidebar-brand">
      <div class="brand-name">CampusAdmin</div>
      <div class="brand-sub">Admin Panel</div>
    </div>
    <nav class="sidebar-nav">
      <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
          <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
          <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
        </svg>Dashboard
      </a>
      <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
          <circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/>
          <path d="M16 3.13a4 4 0 010 7.75"/><path d="M21 21v-2a4 4 0 00-3-3.87"/>
        </svg>User Management
      </a>
      <a href="{{ route('admin.events') }}" class="nav-item {{ request()->routeIs('admin.events*') ? 'active' : '' }}">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
          <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
          <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
        </svg>Event Management
      </a>
      <a href="{{ route('admin.users.bulk') }}" class="nav-item {{ request()->routeIs('admin.users.bulk') ? 'active' : '' }}">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
          <polygon points="12 2 2 7 12 12 22 7 12 2"/>
          <polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/>
        </svg>Bulk Operations
      </a>
    </nav>
    <div class="sidebar-footer">
      <div class="role-card">
        <a href="{{ route('profile.show') }}" style="display: flex; align-items: center; gap: 12px; text-decoration: none; flex: 1;">
          <div class="role-card-avatar avatar-admin">{{ strtoupper(substr(Auth::user()->name ?? 'AD', 0, 2)) }}</div>
          <div class="role-card-info">
            <div class="role-card-name">{{ Auth::user()->name ?? 'Administrator' }}</div>
            <div class="role-card-label">Administrator</div>
          </div>
        </a>
        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
          @csrf
          <button type="submit" class="role-card-logout" title="Logout">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
          </button>
        </form>
      </div>
    </div>
  </aside>

  <!-- MAIN -->
  <div class="main">
    <header class="topbar">
      <span class="topbar-brand">CampusAdmin</span>
      <div class="topbar-search">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
        </svg>
        <input type="text" placeholder="Search users...">
      </div>
      <div class="topbar-actions">
        <div class="topbar-icon">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
          </svg>
        </div>
        <div class="topbar-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
      </div>
    </header>

    <div class="content">
      <div class="page-top">
        <div class="page-top-left">
          <div class="page-title">Identity <span>Matrix</span></div>
          <p class="page-desc">Orchestrate campus roles and permissions from a single atmospheric nexus. Managing 2,491 active digital entities across the network.</p>
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
            <div class="metric-value">+124</div>
            <div class="metric-sub">Active this week</div>
          </div>
        </div>
      </div>

      <div class="toolbar">
        <div class="filter-tabs">
          <button class="filter-tab active">All Roles</button>
          <button class="filter-tab">Admin</button>
          <button class="filter-tab">Panitia</button>
          <button class="filter-tab">Peserta</button>
        </div>
        <button class="btn-onboard">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/>
            <line x1="8" y1="12" x2="16" y2="12"/>
          </svg>
          Onboard New User
        </button>
      </div>

      <div class="table-wrapper">
        <div class="table-header">
          <div class="th">Entity Name</div>
          <div class="th">Current Role</div>
          <div class="th">Access Status</div>
          <div class="th">Operational Actions</div>
        </div>

        <?php
        $users = [
          [
            'initials'=>'BS','name'=>'Bastian Setya','email'=>'bastian.s@campus.edu',
            'role'=>'ADMIN','role_class'=>'role-admin','status'=>'Active','status_class'=>'dot-active',
            'color'=>'#3b1f8c','selected'=>false
          ],
          [
            'initials'=>'LA','name'=>'Lestari Ananta','email'=>'lestari.a@event.com',
            'role'=>'PANITIA','role_class'=>'role-panitia','status'=>'Active','status_class'=>'dot-active',
            'color'=>'#163a24','selected'=>true
          ],
          [
            'initials'=>'DK','name'=>'Dini Kartika','email'=>'dkartika99@student.univ.id',
            'role'=>'PESERTA','role_class'=>'role-peserta','status'=>'Offline','status_class'=>'dot-offline',
            'color'=>'#2a1f4a','selected'=>false
          ],
          [
            'initials'=>'RR','name'=>'Rizky Ramadhan','email'=>'rizky.r@staff.id',
            'role'=>'PANITIA','role_class'=>'role-panitia','status'=>'Deactivated','status_class'=>'dot-deactivated',
            'color'=>'#1a1a2e','selected'=>false
          ],
        ];
        foreach($users as $u): ?>
        <div class="table-row <?= $u['selected'] ? 'selected' : '' ?>">
          <div class="entity-cell">
            <div class="entity-avatar" style="background:<?= $u['color'] ?>;"><?= $u['initials'] ?></div>
            <div>
              <div class="entity-name"><?= $u['name'] ?></div>
              <div class="entity-email"><?= $u['email'] ?></div>
            </div>
          </div>
          <div>
            <span class="role-badge <?= $u['role_class'] ?>"><?= $u['role'] ?></span>
          </div>
          <div class="status-cell">
            <div class="status-dot <?= $u['status_class'] ?>"></div>
            <?= $u['status'] ?>
          </div>
          <div class="actions-cell">
            <div class="action-btn">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
              </svg>
            </div>
            <div class="action-btn">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
              </svg>
            </div>
            <div class="action-btn">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="3 6 5 6 21 6"/>
                <path d="M19 6l-1 14H6L5 6"/>
                <path d="M10 11v6M14 11v6"/>
                <path d="M9 6V4h6v2"/>
              </svg>
            </div>
          </div>
        </div>
        <?php endforeach; ?>

        <div class="table-footer">Showing 1 to 4 of 2,491 identities</div>
      </div>
    </div>
  </div>
</div>

<!-- INSIGHT POPUP -->
<div class="insight-popup">
  <div class="popup-header">
    <span class="popup-title">Selected Insight</span>
    <div class="popup-close">×</div>
  </div>
  <div class="popup-user">
    <div class="popup-avatar">LA</div>
    <div>
      <div class="popup-name">Lestari Ananta</div>
      <div class="popup-role">Active Panitia</div>
    </div>
  </div>
  <div class="popup-row">
    <span class="label">Last Login</span>
    <span class="val">2 mins ago</span>
  </div>
  <div class="popup-row">
    <span class="label">Auth Level</span>
    <span class="val">Tier 2 Manager</span>
  </div>
  <div class="quota-bar">
    <div class="quota-fill"></div>
  </div>
  <div class="quota-label">Quota Usage: 85%</div>
</div>

{{-- GLOBAL LOADER --}}
<div id="global-loader" class="loader-overlay">
    <div class="premium-loader"></div>
    <div class="loader-text">Memproses Data...</div>
</div>

</body>
</html>