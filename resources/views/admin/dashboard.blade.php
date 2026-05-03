<?php
$page_title = "Dashboard";
$active_page = "dashboard";
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CampusAdmin - Dashboard</title>
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

  /* SIDEBAR */
  .sidebar {
    width: 260px; min-width: 260px;
    background: var(--bg-sidebar);
    border-right: 1px solid var(--border);
    display: flex; flex-direction: column;
    padding: 28px 0;
  }
  .sidebar-brand {
    padding: 0 24px 28px;
    border-bottom: 1px solid var(--border);
  }
  .sidebar-brand .brand-name {
    font-family: 'Syne', sans-serif;
    font-size: 20px; font-weight: 800;
    color: var(--text-primary);
    letter-spacing: -0.5px;
  }
  .sidebar-nav { flex: 1; padding: 20px 0; }
  .nav-item {
    display: flex; align-items: center; gap: 12px;
    padding: 11px 24px; cursor: pointer;
    font-size: 14px; font-weight: 500;
    color: var(--text-secondary);
    transition: all 0.2s; position: relative;
    text-decoration: none;
  }
  .nav-item:hover { color: var(--text-primary); background: var(--bg-hover); }
  .nav-item.active {
    color: var(--text-primary);
    background: rgba(124,92,252,0.08);
  }
  .nav-item.active::before {
    content: ''; position: absolute;
    left: 0; top: 0; bottom: 0; width: 3px;
    background: var(--accent-purple); border-radius: 0 2px 2px 0;
  }
  .nav-item svg { width: 18px; height: 18px; flex-shrink: 0; }

  .sidebar-footer {
    padding: 16px 16px 0;
    border-top: 1px solid var(--border);
    margin-top: auto;
  }
  .admin-card {
    display: flex; align-items: center; gap: 12px;
    padding: 12px; border-radius: 12px;
    background: var(--bg-card2);
  }
  .admin-avatar {
    width: 38px; height: 38px; border-radius: 50%;
    overflow: hidden; flex-shrink: 0;
    background: var(--accent-purple);
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; font-weight: 700;
  }
  .admin-avatar img { width: 100%; height: 100%; object-fit: cover; }
  .admin-info .name { font-size: 13px; font-weight: 600; }
  .admin-info .role { font-size: 11px; color: var(--text-secondary); margin-top: 2px; }

  /* TOPBAR */
  .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
  .topbar {
    height: 60px; border-bottom: 1px solid var(--border);
    display: flex; align-items: center; padding: 0 28px;
    background: var(--bg-base); gap: 16px; flex-shrink: 0;
  }
  .topbar-brand {
    font-family: 'Syne', sans-serif; font-size: 13px;
    font-weight: 800; letter-spacing: 2px;
    text-transform: uppercase; color: var(--text-primary);
    margin-right: 8px;
  }
  .search-box {
    flex: 1; max-width: 360px;
    background: var(--bg-card); border: 1px solid var(--border);
    border-radius: 10px; display: flex; align-items: center;
    gap: 10px; padding: 0 14px; height: 38px;
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
  .icon-btn:hover { color: var(--text-primary); background: var(--bg-hover); }
  .icon-btn svg { width: 16px; height: 16px; }
  .user-avatar-top {
    width: 34px; height: 34px; border-radius: 50%;
    overflow: hidden; cursor: pointer;
    background: var(--accent-purple);
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 700;
  }
  .user-avatar-top img { width: 100%; height: 100%; object-fit: cover; }

  /* CONTENT */
  .content { flex: 1; overflow-y: auto; padding: 32px 28px; }
  .page-header { margin-bottom: 28px; }
  .page-header h1 { font-family: 'Syne', sans-serif; font-size: 32px; font-weight: 800; letter-spacing: -1px; }
  .page-header p { color: var(--text-secondary); font-size: 14px; margin-top: 4px; }
  .header-actions { display: flex; gap: 12px; margin-top: 4px; float: right; }

  /* STAT CARDS */
  .stats-grid {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 16px; margin-bottom: 28px;
  }
  .stat-card {
    background: var(--bg-card); border: 1px solid var(--border);
    border-radius: 14px; padding: 20px;
    position: relative; overflow: hidden;
  }
  .stat-card.purple {
    background: var(--accent-purple);
    border-color: var(--accent-purple);
  }
  .stat-card .stat-label {
    font-size: 11px; font-weight: 600; letter-spacing: 1px;
    text-transform: uppercase; color: var(--text-secondary); margin-bottom: 12px;
    display: flex; align-items: center; justify-content: space-between;
  }
  .stat-card.purple .stat-label { color: rgba(255,255,255,0.75); }
  .stat-card .stat-value {
    font-family: 'Syne', sans-serif; font-size: 28px;
    font-weight: 800; letter-spacing: -1px;
  }
  .stat-card .stat-sub {
    font-size: 12px; color: var(--text-secondary); margin-top: 6px;
    display: flex; align-items: center; gap: 4px;
  }
  .stat-card.purple .stat-sub { color: rgba(255,255,255,0.75); }
  .stat-up { color: var(--accent-green) !important; }
  .stat-card .stat-icon {
    position: absolute; right: 18px; top: 50%; transform: translateY(-50%);
    opacity: 0.15; color: white;
  }
  .stat-card .stat-icon svg { width: 44px; height: 44px; }
  .stat-card.purple .stat-icon { opacity: 0.3; }

  /* TWO COL LAYOUT */
  .two-col { display: grid; grid-template-columns: 1fr 320px; gap: 20px; }

  /* SECTION */
  .section { margin-bottom: 20px; }
  .section-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 16px;
  }
  .section-title {
    font-family: 'Syne', sans-serif; font-size: 18px; font-weight: 700;
  }
  .view-all {
    font-size: 12px; color: var(--accent-purple-light); cursor: pointer;
    font-weight: 500; text-decoration: none;
  }
  .view-all:hover { text-decoration: underline; }

  /* REGISTRATIONS */
  .reg-list { display: flex; flex-direction: column; gap: 2px; }
  .reg-item {
    display: flex; align-items: center; gap: 14px;
    padding: 14px 16px; border-radius: 12px;
    background: var(--bg-card); border: 1px solid transparent;
    transition: all 0.2s;
  }
  .reg-item:hover { border-color: var(--border); background: var(--bg-card2); }
  .reg-avatar {
    width: 40px; height: 40px; border-radius: 50%;
    overflow: hidden; flex-shrink: 0;
    background: linear-gradient(135deg, var(--accent-purple), var(--accent-pink));
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; font-weight: 700;
  }
  .reg-avatar img { width: 100%; height: 100%; object-fit: cover; }
  .reg-info { flex: 1; min-width: 0; }
  .reg-name { font-size: 14px; font-weight: 600; }
  .reg-meta { font-size: 12px; color: var(--text-secondary); margin-top: 2px; }
  .badge {
    font-size: 10px; font-weight: 700; letter-spacing: 0.5px;
    padding: 4px 10px; border-radius: 20px;
    text-transform: uppercase; flex-shrink: 0;
  }
  .badge-verified { background: rgba(34,197,94,0.12); color: var(--accent-green); }
  .badge-pending { background: rgba(245,158,11,0.12); color: var(--accent-yellow); }
  .reg-more {
    width: 28px; height: 28px; border-radius: 8px;
    background: var(--bg-card2); border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--text-secondary);
    font-size: 16px; letter-spacing: 1px; line-height: 1;
  }

  /* ARCHIVING BANNER */
  .archiving-banner {
    border-radius: 14px; padding: 28px;
    background: linear-gradient(135deg, #1a0a2e 0%, #2a1248 50%, #1a0a2e 100%);
    border: 1px solid rgba(124,92,252,0.25);
    position: relative; overflow: hidden; margin-top: 16px;
  }
  .archiving-banner::before {
    content: '';
    position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 30 Q30 0 60 30 Q30 60 0 30' fill='none' stroke='rgba(124,92,252,0.1)' stroke-width='1'/%3E%3C/svg%3E") center/60px repeat;
  }
  .archiving-banner h3 {
    font-family: 'Syne', sans-serif; font-size: 22px; font-weight: 800;
    color: var(--accent-purple-light); margin-bottom: 10px; position: relative;
  }
  .archiving-banner p {
    font-size: 13px; color: rgba(255,255,255,0.6); line-height: 1.6; position: relative;
  }
  .review-btn {
    display: inline-block; margin-top: 18px; position: relative;
    padding: 9px 20px; border-radius: 20px;
    border: 1px solid rgba(124,92,252,0.4); background: rgba(124,92,252,0.15);
    color: var(--text-primary); font-size: 13px; font-weight: 500;
    cursor: pointer; transition: all 0.2s;
  }
  .review-btn:hover { background: rgba(124,92,252,0.3); }

  /* RIGHT PANEL - SYSTEM INSIGHTS */
  /* .insights-panel {} */
  .insight-card {
    background: var(--bg-card); border: 1px solid var(--border);
    border-radius: 14px; padding: 18px; margin-bottom: 16px;
  }
  .insight-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 14px;
  }
  .insight-title {
    font-family: 'Syne', sans-serif; font-size: 17px; font-weight: 700;
  }
  .live-badge {
    font-size: 10px; font-weight: 700; letter-spacing: 1px;
    color: var(--accent-purple-light); background: rgba(124,92,252,0.12);
    padding: 3px 8px; border-radius: 20px; text-transform: uppercase;
  }
  .insight-icon {
    width: 40px; height: 40px; border-radius: 10px;
    background: rgba(124,92,252,0.15); border: 1px solid rgba(124,92,252,0.2);
    display: flex; align-items: center; justify-content: center;
    color: var(--accent-purple-light); margin-bottom: 12px;
  }
  .insight-icon svg { width: 20px; height: 20px; }
  .peak-title {
    font-family: 'Syne', sans-serif; font-size: 18px; font-weight: 700;
    margin-bottom: 8px;
  }
  .peak-desc { font-size: 12px; color: var(--text-secondary); line-height: 1.5; }
  .progress-bar {
    height: 3px; background: var(--border); border-radius: 2px; margin-top: 14px;
  }
  .progress-fill {
    height: 100%; border-radius: 2px;
    background: linear-gradient(90deg, var(--accent-purple), var(--accent-pink));
  }

  /* VENUE CARD */
  .venue-card {
    background: var(--bg-card); border: 1px solid var(--border);
    border-radius: 14px; overflow: hidden; margin-bottom: 16px;
  }
  .venue-img {
    width: 100%; height: 130px; object-fit: cover;
    background: linear-gradient(135deg, #1a1a2e, #2a2a3e);
    display: flex; align-items: center; justify-content: center;
    color: var(--text-muted); font-size: 12px; position: relative;
  }
  .venue-img-placeholder {
    width: 100%; height: 130px;
    background: linear-gradient(135deg, #111118 0%, #1e1e2a 50%, #111118 100%);
    display: flex; align-items: center; justify-content: center;
  }
  .venue-img-placeholder svg { width: 40px; height: 40px; opacity: 0.15; }
  .venue-info { padding: 14px; }
  .venue-tag {
    display: inline-block; font-size: 10px; font-weight: 600;
    background: var(--bg-card2); border: 1px solid var(--border);
    color: var(--text-secondary); padding: 3px 10px; border-radius: 20px;
    margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;
  }
  .venue-stat { display: flex; justify-content: space-between; font-size: 13px; }
  .venue-stat .label { color: var(--text-secondary); }
  .venue-stat .val { font-weight: 600; }

  /* LIVE FEED */
  .live-feed { background: var(--bg-card); border: 1px solid var(--border); border-radius: 14px; padding: 18px; }
  .live-feed-title { font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--text-secondary); margin-bottom: 14px; }
  .feed-item { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 12px; }
  .feed-item:last-child { margin-bottom: 0; }
  .feed-dot {
    width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; margin-top: 4px;
  }
  .dot-green { background: var(--accent-green); }
  .dot-red { background: var(--accent-red); }
  .dot-muted { background: var(--text-muted); }
  .feed-text { font-size: 12px; color: var(--text-secondary); line-height: 1.4; }
  .feed-time { font-size: 11px; color: var(--text-muted); margin-top: 3px; }

  /* BUTTONS */
  .btn {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 9px 18px; border-radius: 10px;
    font-size: 13px; font-weight: 600; cursor: pointer;
    border: 1px solid transparent; transition: all 0.2s;
    font-family: 'DM Sans', sans-serif;
  }
  .btn-outline {
    background: var(--bg-card); border-color: var(--border);
    color: var(--text-primary);
  }
  .btn-outline:hover { border-color: var(--border-light); background: var(--bg-hover); }
  .btn-purple {
    background: var(--accent-purple); color: white;
    border-color: var(--accent-purple);
  }
  .btn-purple:hover { background: var(--accent-purple-light); }
  .btn svg { width: 14px; height: 14px; }

  /* FAB */
  .fab {
    position: fixed; bottom: 24px; right: 24px;
    width: 48px; height: 48px; border-radius: 50%;
    background: var(--accent-purple); color: white;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; box-shadow: 0 4px 20px rgba(124,92,252,0.4);
    font-size: 24px; transition: all 0.2s;
  }
  .fab:hover { background: var(--accent-purple-light); transform: scale(1.05); }

  /* SCROLLBAR */
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
    </div>
    <nav class="sidebar-nav">
      <a href="{{ route('admin.dashboard') }}" class="nav-item active">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
          <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
        </svg>
        Dashboard
      </a>
      <a href="{{ route('admin.users') }}" class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/>
          <path d="M16 3.13a4 4 0 010 7.75"/><path d="M21 21v-2a4 4 0 00-3-3.87"/>
        </svg>
        User Management
      </a>
      <a href="{{ route('admin.events') }}" class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
          <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
        </svg>
        Event Management
      </a>
      <a href="{{ route('admin.users.bulk') }}" class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polygon points="12 2 2 7 12 12 22 7 12 2"/>
          <polyline points="2 17 12 22 22 17"/>
          <polyline points="2 12 12 17 22 12"/>
        </svg>
        Bulk Operations
      </a>
    </nav>
    <div class="sidebar-footer">
      <div class="admin-card">
        <div class="admin-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 2)) }}</div>
        <div class="admin-info" style="flex: 1;">
          <div class="name">{{ Auth::user()->name ?? 'Administrator' }}</div>
          <div class="role">Admin</div>
        </div>
        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
          @csrf
          <button type="submit" title="Logout" style="width:32px;height:32px;border-radius:8px;background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);display:flex;align-items:center;justify-content:center;color:#ef4444;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.background='rgba(239,68,68,0.2)'" onmouseout="this.style.background='rgba(239,68,68,0.1)'">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;margin-left:2px;">
              <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"></path>
              <polyline points="16 17 21 12 16 7"></polyline>
              <line x1="21" y1="12" x2="9" y2="12"></line>
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
      <div class="search-box">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
        </svg>
        <input type="text" placeholder="Search system...">
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
        <div class="user-avatar-top">SA</div>
      </div>
    </header>

    <div class="content">
      <div style="display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:28px;">
        <div>
          <h1 style="font-family:'Syne',sans-serif;font-size:32px;font-weight:800;letter-spacing:-1px;">System Overview</h1>
          <p style="color:var(--text-secondary);font-size:14px;margin-top:4px;">Welcome back, Curator. Here is your nocturnal report.</p>
        </div>
        <div style="display:flex;gap:10px;margin-top:4px;">
          <button class="btn btn-outline">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/>
              <line x1="12" y1="15" x2="12" y2="3"/>
            </svg>
            Download Report
          </button>
          <button class="btn btn-purple">+ New Operation</button>
        </div>
      </div>

      <!-- STATS -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-label">
            Total Users
            <div class="stat-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/>
              </svg>
            </div>
          </div>
          <div class="stat-value">14,282</div>
          <div class="stat-sub stat-up">▲ +12.5% vs last month</div>
        </div>
        <div class="stat-card">
          <div class="stat-label">
            Active Events
            <div class="stat-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/>
              </svg>
            </div>
          </div>
          <div class="stat-value">84</div>
          <div class="stat-sub">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            12 starting today
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
          <div class="stat-value">$12,450</div>
          <div class="stat-sub" style="color:var(--accent-yellow);">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/>
              <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            Avg. 4.2 days overdue
          </div>
        </div>
        <div class="stat-card purple">
          <div class="stat-label">System Health</div>
          <div class="stat-value" style="font-size:24px;">Optimal</div>
          <div class="stat-sub">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
            All nodes functional
          </div>
          <div class="stat-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M12 2a10 10 0 0110 10c0 4-2.5 7-5 8.5A10 10 0 012 12C2 6.48 6.48 2 12 2z"/>
              <path d="M8 12s1-2 4-2 4 2 4 2"/>
              <circle cx="9" cy="9" r="1.5" fill="currentColor"/>
              <circle cx="15" cy="9" r="1.5" fill="currentColor"/>
            </svg>
          </div>
        </div>
      </div>

      <!-- TWO COL -->
      <div class="two-col">
        <div>
          <!-- REGISTRATIONS -->
          <div class="section">
            <div class="section-header">
              <span class="section-title">Recent Registrations</span>
              <a href="#" class="view-all">View All</a>
            </div>
            <div class="reg-list">
              <?php
              $registrations = [
                ['name'=>'Julianna Velez','meta'=>'M.S. Cybernetics · 2 mins ago','status'=>'verified','initials'=>'JV','color'=>'#7c5cfc'],
                ['name'=>'Marcus Sterling','meta'=>'B.A. Digital Arts · 14 mins ago','status'=>'pending','initials'=>'MS','color'=>'#e040a0'],
                ['name'=>'Elena Kostic','meta'=>'Ph.D Quantum Physics · 1 hour ago','status'=>'verified','initials'=>'EK','color'=>'#22c55e'],
              ];
              foreach($registrations as $r): ?>
              <div class="reg-item">
                <div class="reg-avatar" style="background:<?= $r['color'] ?>;"><?= $r['initials'] ?></div>
                <div class="reg-info">
                  <div class="reg-name"><?= $r['name'] ?></div>
                  <div class="reg-meta"><?= $r['meta'] ?></div>
                </div>
                <span class="badge badge-<?= $r['status'] ?>"><?= strtoupper($r['status']) ?></span>
                <div class="reg-more">···</div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- ARCHIVING BANNER -->
          <div class="archiving-banner">
            <h3>Automated Archiving</h3>
            <p>The nocturnal curator is scheduled to archive logs in 4 hours.<br>Ensure all manual overrides are resolved.</p>
            <button class="review-btn">Review Schedule</button>
          </div>
        </div>

        <!-- RIGHT PANEL -->
        <div class="insights-panel">
          <div class="section-title" style="margin-bottom:16px;">System Insights</div>

          <div class="insight-card">
            <div class="insight-header">
              <span class="live-badge">Real-Time</span>
            </div>
            <div class="insight-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
              </svg>
            </div>
            <div class="peak-title">Peak Activity Predicted</div>
            <p class="peak-desc">Engagement is expected to spike between 20:00 and 22:00 for the 'Midnight Hackathon'.</p>
            <div class="progress-bar"><div class="progress-fill" style="width:68%;"></div></div>
          </div>

          <div class="venue-card">
            <div class="venue-img-placeholder">
              <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1">
                <rect x="2" y="6" width="20" height="14" rx="2"/>
                <path d="M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/>
                <circle cx="12" cy="13" r="3"/>
              </svg>
            </div>
            <div class="venue-info">
              <div class="venue-tag">Main Quad Gate</div>
              <div class="venue-stat">
                <span class="label">Active Entrances</span>
                <span class="val">12 Gates Open</span>
              </div>
            </div>
          </div>

          <div class="live-feed">
            <div class="live-feed-title">Live System Feed</div>
            <div class="feed-item">
              <div class="feed-dot dot-green"></div>
              <div>
                <div class="feed-text">API Endpoint 'v2/events' successfully scaled</div>
                <div class="feed-time">45 ago</div>
              </div>
            </div>
            <div class="feed-item">
              <div class="feed-dot dot-red"></div>
              <div>
                <div class="feed-text">Failed login attempt - IP: 192.168.1.45</div>
                <div class="feed-time">12m ago</div>
              </div>
            </div>
            <div class="feed-item">
              <div class="feed-dot dot-muted"></div>
              <div>
                <div class="feed-text">Backup sequence initiated</div>
                <div class="feed-time">1h ago</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="fab">+</div>
</body>
</html>