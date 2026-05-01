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
<style>
  @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap');
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  :root {
    --bg-base: #0a0a0c;
    --bg-sidebar: #0e0e11;
    --bg-card: #141418;
    --bg-card2: #1a1a1f;
    --bg-hover: #1e1e25;
    --border: #2a2a35;
    --border-light: #32323f;
    --text-primary: #f0f0f5;
    --text-secondary: #8a8a9a;
    --text-muted: #555566;
    --accent-purple: #7c5cfc;
    --accent-purple-light: #a07fff;
    --accent-pink: #e040a0;
    --accent-green: #22c55e;
    --accent-red: #ef4444;
    --accent-yellow: #f59e0b;
  }
  html, body { height: 100%; font-family: 'DM Sans', sans-serif; background: var(--bg-base); color: var(--text-primary); }
  .layout { display: flex; height: 100vh; overflow: hidden; }

  .sidebar {
    width: 260px; min-width: 260px;
    background: var(--bg-sidebar);
    border-right: 1px solid var(--border);
    display: flex; flex-direction: column; padding: 28px 0;
  }
  .sidebar-brand { padding: 0 24px 28px; border-bottom: 1px solid var(--border); }
  .sidebar-brand .brand-name {
    font-family: 'Syne', sans-serif; font-size: 20px; font-weight: 800;
    color: var(--text-primary); letter-spacing: -0.5px;
  }
  .sidebar-brand .brand-sub { font-size: 11px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1.5px; margin-top: 4px; }
  .sidebar-nav { flex: 1; padding: 20px 0; }
  .nav-item {
    display: flex; align-items: center; gap: 12px;
    padding: 11px 24px; cursor: pointer; font-size: 14px; font-weight: 500;
    color: var(--text-secondary); transition: all 0.2s; position: relative; text-decoration: none;
  }
  .nav-item:hover { color: var(--text-primary); background: var(--bg-hover); }
  .nav-item.active { color: var(--text-primary); background: rgba(124,92,252,0.08); }
  .nav-item.active::before {
    content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 3px;
    background: var(--accent-purple); border-radius: 0 2px 2px 0;
  }
  .nav-item svg { width: 18px; height: 18px; flex-shrink: 0; }
  .sidebar-footer { padding: 16px 16px 0; border-top: 1px solid var(--border); margin-top: auto; }
  .admin-card {
    display: flex; align-items: center; gap: 12px;
    padding: 12px; border-radius: 12px; background: var(--bg-card2);
  }
  .admin-avatar {
    width: 38px; height: 38px; border-radius: 50%;
    background: linear-gradient(135deg, #5b21b6, #7c5cfc);
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; font-weight: 700; flex-shrink: 0;
    position: relative;
  }
  .admin-avatar::after {
    content: ''; position: absolute; bottom: 1px; right: 1px;
    width: 9px; height: 9px; border-radius: 50%;
    background: var(--accent-green); border: 2px solid var(--bg-card2);
  }
  .admin-info .name { font-size: 13px; font-weight: 600; }
  .admin-info .role { font-size: 11px; color: var(--text-secondary); margin-top: 2px; }

  .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
  .topbar {
    height: 60px; border-bottom: 1px solid var(--border);
    display: flex; align-items: center; padding: 0 28px;
    background: var(--bg-base); gap: 16px; flex-shrink: 0;
  }
  .topbar-brand {
    font-family: 'Syne', sans-serif; font-size: 13px; font-weight: 800;
    letter-spacing: 2px; text-transform: uppercase;
  }
  .search-box {
    flex: 1; max-width: 360px; background: var(--bg-card);
    border: 1px solid var(--border); border-radius: 10px;
    display: flex; align-items: center; gap: 10px; padding: 0 14px; height: 38px;
  }
  .search-box input {
    background: none; border: none; outline: none;
    color: var(--text-primary); font-size: 13px;
    font-family: 'DM Sans', sans-serif; width: 100%;
  }
  .search-box input::placeholder { color: var(--text-muted); }
  .search-box svg { color: var(--text-muted); width: 15px; height: 15px; flex-shrink: 0; }
  .topbar-actions { margin-left: auto; display: flex; align-items: center; gap: 14px; }
  .icon-btn {
    width: 36px; height: 36px; border-radius: 9px;
    background: var(--bg-card); border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--text-secondary); transition: all 0.2s;
  }
  .icon-btn:hover { color: var(--text-primary); }
  .icon-btn svg { width: 16px; height: 16px; }
  .user-avatar-top {
    width: 34px; height: 34px; border-radius: 50%;
    background: var(--accent-purple);
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 700; cursor: pointer;
  }

  .content { flex: 1; overflow-y: auto; padding: 32px 28px; }

  /* PAGE HEADER */
  .page-top {
    display: flex; align-items: flex-start; gap: 24px; margin-bottom: 32px;
  }
  .page-top-left { flex: 1; }
  .page-title {
    font-family: 'Syne', sans-serif; font-size: 40px; font-weight: 800;
    letter-spacing: -2px; line-height: 1;
  }
  .page-title span { color: var(--accent-purple-light); font-style: italic; }
  .page-desc { font-size: 13px; color: var(--text-secondary); margin-top: 10px; line-height: 1.6; max-width: 420px; }

  .metric-cards { display: flex; gap: 16px; }
  .metric-card {
    background: var(--bg-card); border: 1px solid var(--border);
    border-radius: 14px; padding: 18px 22px; min-width: 160px;
  }
  .metric-card.purple-bg {
    background: var(--accent-purple);
    border-color: var(--accent-purple);
  }
  .metric-label {
    font-size: 11px; font-weight: 600; letter-spacing: 1px;
    text-transform: uppercase; color: var(--text-secondary); margin-bottom: 8px;
  }
  .metric-card.purple-bg .metric-label { color: rgba(255,255,255,0.7); }
  .metric-value {
    font-family: 'Syne', sans-serif; font-size: 30px;
    font-weight: 800; letter-spacing: -1.5px;
  }
  .metric-sub { font-size: 12px; color: var(--text-secondary); margin-top: 4px; display: flex; align-items: center; gap: 4px; }
  .metric-card.purple-bg .metric-sub { color: rgba(255,255,255,0.7); }

  /* FILTER + TABLE ROW */
  .toolbar {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 20px; gap: 16px;
  }
  .filter-tabs { display: flex; gap: 8px; }
  .filter-tab {
    padding: 7px 18px; border-radius: 20px; font-size: 13px; font-weight: 500;
    cursor: pointer; border: 1px solid var(--border); color: var(--text-secondary);
    background: transparent; transition: all 0.2s; font-family: 'DM Sans', sans-serif;
  }
  .filter-tab:hover { color: var(--text-primary); border-color: var(--border-light); }
  .filter-tab.active {
    background: var(--bg-card2); border-color: var(--border-light);
    color: var(--text-primary); font-weight: 600;
  }
  .btn-onboard {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 10px 20px; border-radius: 10px;
    background: rgba(124,92,252,0.15); border: 1px solid rgba(124,92,252,0.3);
    color: var(--accent-purple-light); font-size: 13px; font-weight: 600;
    cursor: pointer; transition: all 0.2s; font-family: 'DM Sans', sans-serif;
  }
  .btn-onboard:hover { background: rgba(124,92,252,0.25); }
  .btn-onboard svg { width: 16px; height: 16px; }

  /* TABLE */
  .table-wrapper {
    background: var(--bg-card); border: 1px solid var(--border);
    border-radius: 14px; overflow: hidden;
  }
  .table-header {
    display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
    padding: 12px 20px; border-bottom: 1px solid var(--border);
  }
  .th {
    font-size: 11px; font-weight: 700; letter-spacing: 1px;
    text-transform: uppercase; color: var(--text-muted);
  }
  .table-row {
    display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
    padding: 16px 20px; border-bottom: 1px solid var(--border);
    align-items: center; transition: background 0.15s; cursor: pointer;
    position: relative;
  }
  .table-row:last-child { border-bottom: none; }
  .table-row:hover { background: var(--bg-card2); }
  .table-row.selected { background: rgba(124,92,252,0.05); }

  .entity-cell { display: flex; align-items: center; gap: 12px; }
  .entity-avatar {
    width: 40px; height: 40px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; font-weight: 700; flex-shrink: 0;
    font-family: 'Syne', sans-serif;
  }
  .entity-name { font-size: 14px; font-weight: 600; }
  .entity-email { font-size: 12px; color: var(--text-secondary); margin-top: 2px; }

  .role-badge {
    display: inline-block; font-size: 11px; font-weight: 700;
    letter-spacing: 0.5px; padding: 5px 12px; border-radius: 6px;
    text-transform: uppercase;
  }
  .role-admin { background: rgba(124,92,252,0.15); color: var(--accent-purple-light); }
  .role-panitia { background: rgba(34,197,94,0.1); color: var(--accent-green); }
  .role-peserta { background: rgba(224,64,160,0.1); color: #e040a0; }

  .status-cell { display: flex; align-items: center; gap: 8px; font-size: 13px; }
  .status-dot { width: 7px; height: 7px; border-radius: 50%; }
  .dot-active { background: var(--accent-green); box-shadow: 0 0 6px rgba(34,197,94,0.5); }
  .dot-offline { background: var(--text-muted); }
  .dot-deactivated { background: var(--accent-red); box-shadow: 0 0 6px rgba(239,68,68,0.5); }

  .actions-cell { display: flex; align-items: center; gap: 8px; }
  .action-btn {
    width: 32px; height: 32px; border-radius: 8px;
    background: var(--bg-card2); border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--text-secondary); transition: all 0.2s;
  }
  .action-btn:hover { color: var(--text-primary); border-color: var(--border-light); }
  .action-btn svg { width: 14px; height: 14px; }

  .table-footer {
    padding: 14px 20px; font-size: 12px; color: var(--text-secondary);
    border-top: 1px solid var(--border);
  }

  /* INSIGHT PANEL */
  .insight-popup {
    position: fixed; right: 28px; bottom: 28px;
    width: 300px; background: var(--bg-card2);
    border: 1px solid var(--border-light); border-radius: 16px;
    padding: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    animation: slideUp 0.3s ease;
  }
  @keyframes slideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .popup-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 16px;
  }
  .popup-title {
    font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
    text-transform: uppercase; color: var(--text-secondary);
  }
  .popup-close {
    width: 24px; height: 24px; border-radius: 6px;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--text-muted); font-size: 16px;
    background: var(--bg-card); border: 1px solid var(--border);
  }
  .popup-user { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; }
  .popup-avatar {
    width: 44px; height: 44px; border-radius: 50%;
    background: linear-gradient(135deg, #1a6335, #22c55e);
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; font-weight: 700;
  }
  .popup-name { font-size: 15px; font-weight: 700; }
  .popup-role { font-size: 12px; color: var(--accent-green); margin-top: 2px; }
  .popup-row {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 10px;
  }
  .popup-row .label { font-size: 12px; color: var(--text-secondary); }
  .popup-row .val { font-size: 12px; font-weight: 600; }
  .quota-bar {
    height: 4px; background: var(--border); border-radius: 2px; margin-top: 10px;
    overflow: hidden;
  }
  .quota-fill {
    height: 100%; border-radius: 2px;
    background: linear-gradient(90deg, var(--accent-purple), var(--accent-pink));
    width: 85%;
  }
  .quota-label { font-size: 11px; color: var(--text-muted); margin-top: 6px; text-align: right; }

  ::-webkit-scrollbar { width: 5px; }
  ::-webkit-scrollbar-track { background: transparent; }
  ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 10px; }
</style>
</head>
<body>
<div class="layout">
  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sidebar-brand">
      <div class="brand-name">Nocturnal Curator</div>
      <div class="brand-sub">System Administrator</div>
    </div>
    <nav class="sidebar-nav">
      <a href="../dashboard.blade.php" class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
          <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
        </svg>
        Dashboard
      </a>
      <a href="#" class="nav-item active">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/>
          <path d="M16 3.13a4 4 0 010 7.75"/><path d="M21 21v-2a4 4 0 00-3-3.87"/>
        </svg>
        User Management
      </a>
      <a href="../events/index.blade.php" class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
          <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
        </svg>
        Event Management
      </a>
      <a href="bulk.blade.php" class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polygon points="12 2 2 7 12 12 22 7 12 2"/>
          <polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/>
        </svg>
        Bulk Operations
      </a>
    </nav>
    <div class="sidebar-footer">
      <div class="admin-card">
        <div class="admin-avatar">AR</div>
        <div class="admin-info">
          <div class="name">Alex Rivera</div>
          <div class="role">Super User</div>
        </div>
      </div>
    </div>
  </aside>

  <!-- MAIN -->
  <div class="main">
    <header class="topbar">
      <span class="topbar-brand">CampusAdmin</span>
      <div class="search-box">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
        </svg>
        <input type="text" placeholder="Search database...">
      </div>
      <div class="topbar-actions">
        <div class="icon-btn">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/>
          </svg>
        </div>
        <div class="icon-btn">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="3"/>
            <path d="M19.07 4.93a10 10 0 010 14.14M4.93 4.93a10 10 0 000 14.14"/>
          </svg>
        </div>
        <div class="user-avatar-top">AR</div>
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
</body>
</html>