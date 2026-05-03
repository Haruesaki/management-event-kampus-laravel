<?php
$page_title = "Event Management";
$active_page = "event-management";
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CampusAdmin - Event Management</title>
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
    width: 260px; min-width: 260px; background: var(--bg-sidebar);
    border-right: 1px solid var(--border); display: flex; flex-direction: column; padding: 28px 0;
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
    background: linear-gradient(135deg, #1a4060, #2563eb);
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; font-weight: 700; flex-shrink: 0;
  }
  .admin-info .name { font-size: 13px; font-weight: 600; }
  .admin-info .role { font-size: 11px; color: var(--text-secondary); margin-top: 2px; }

  .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
  .topbar {
    height: 60px; border-bottom: 1px solid var(--border);
    display: flex; align-items: center; padding: 0 28px;
    background: var(--bg-base); gap: 16px; flex-shrink: 0;
  }
  .topbar-brand { font-family: 'Syne', sans-serif; font-size: 13px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; }
  .search-box {
    flex: 1; max-width: 420px; background: var(--bg-card); border: 1px solid var(--border);
    border-radius: 10px; display: flex; align-items: center; gap: 10px; padding: 0 14px; height: 38px;
  }
  .search-box input {
    background: none; border: none; outline: none; color: var(--text-primary);
    font-size: 13px; font-family: 'DM Sans', sans-serif; width: 100%;
  }
  .search-box input::placeholder { color: var(--text-muted); }
  .search-box svg { color: var(--text-muted); width: 15px; height: 15px; flex-shrink: 0; }
  .topbar-actions { margin-left: auto; display: flex; align-items: center; gap: 14px; }
  .icon-btn {
    width: 36px; height: 36px; border-radius: 9px; background: var(--bg-card);
    border: 1px solid var(--border); display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--text-secondary); transition: all 0.2s;
  }
  .icon-btn svg { width: 16px; height: 16px; }

  .content { flex: 1; overflow-y: auto; padding: 28px; display: flex; flex-direction: column; }

  /* HEADER */
  .page-header {
    display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;
  }
  .page-header-left .breadcrumb { font-size: 11px; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; color: var(--accent-purple-light); margin-bottom: 6px; }
  .page-header-left h1 { font-family: 'Syne', sans-serif; font-size: 32px; font-weight: 800; letter-spacing: -1px; }
  .btn-create {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 12px 22px; border-radius: 12px;
    background: linear-gradient(135deg, var(--accent-purple), #9b59f5);
    color: white; font-size: 14px; font-weight: 600;
    cursor: pointer; border: none; transition: all 0.2s; font-family: 'DM Sans', sans-serif;
    box-shadow: 0 4px 20px rgba(124,92,252,0.3);
  }
  .btn-create:hover { transform: translateY(-1px); box-shadow: 0 6px 28px rgba(124,92,252,0.4); }

  /* MAIN GRID */
  .main-grid { display: grid; grid-template-columns: 1fr 360px; gap: 20px; flex: 1; }

  /* LEFT: EVENT LIST */
  /* .events-left {} */
  .events-tabs { display: flex; gap: 0; border-bottom: 1px solid var(--border); margin-bottom: 16px; align-items: center; }
  .events-tab {
    padding: 10px 0; margin-right: 24px; font-size: 13px; font-weight: 600;
    cursor: pointer; color: var(--text-secondary); border-bottom: 2px solid transparent;
    margin-bottom: -1px; transition: all 0.2s;
  }
  .events-tab.active { color: var(--text-primary); border-bottom-color: var(--accent-purple); }
  .events-count { margin-left: auto; font-size: 12px; color: var(--text-muted); }

  .event-card {
    background: var(--bg-card); border: 1px solid var(--border);
    border-radius: 14px; overflow: hidden; margin-bottom: 12px;
    display: flex; transition: border-color 0.2s; cursor: pointer;
  }
  .event-card:hover { border-color: var(--border-light); }
  .event-thumb {
    width: 180px; min-width: 180px; position: relative; overflow: hidden;
    background: linear-gradient(135deg, #1a0a2e, #3b1f8c);
  }
  .event-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
  .event-thumb-placeholder {
    width: 180px; height: 100%;
    display: flex; align-items: center; justify-content: center; min-height: 130px;
  }
  .event-thumb-placeholder svg { width: 48px; height: 48px; opacity: 0.15; }
  .event-tag-status {
    position: absolute; top: 10px; right: 10px;
    font-size: 10px; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase;
    padding: 4px 10px; border-radius: 20px;
  }
  .tag-upcoming { background: rgba(124,92,252,0.9); color: white; }
  .tag-finished { background: rgba(0,0,0,0.7); color: var(--text-secondary); border: 1px solid var(--border); }

  .event-body { padding: 18px; flex: 1; display: flex; flex-direction: column; }
  .event-title { font-family: 'Syne', sans-serif; font-size: 18px; font-weight: 700; margin-bottom: 10px; }
  .event-meta { display: flex; gap: 16px; margin-bottom: 12px; flex-wrap: wrap; }
  .event-meta-item { display: flex; align-items: center; gap: 6px; font-size: 12px; color: var(--text-secondary); }
  .event-meta-item svg { width: 13px; height: 13px; flex-shrink: 0; }
  .event-footer { margin-top: auto; display: flex; align-items: center; justify-content: space-between; }
  .event-price { font-family: 'Syne', sans-serif; font-size: 20px; font-weight: 700; }
  .event-price.free { color: var(--text-secondary); font-size: 16px; font-weight: 600; }
  .price-badge {
    font-size: 10px; font-weight: 700; letter-spacing: 0.5px;
    padding: 4px 10px; border-radius: 20px; text-transform: uppercase; margin-left: 10px;
  }
  .badge-paid { background: rgba(34,197,94,0.12); color: var(--accent-green); }
  .event-actions { display: flex; gap: 8px; }
  .ev-btn {
    width: 32px; height: 32px; border-radius: 8px;
    background: var(--bg-card2); border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--text-secondary); transition: all 0.2s;
  }
  .ev-btn:hover { color: var(--text-primary); }
  .ev-btn svg { width: 14px; height: 14px; }

  /* BOTTOM STATS */
  .bottom-stats { display: flex; gap: 16px; margin-top: 16px; }
  .bottom-stat {
    display: flex; align-items: center; gap: 12px;
    background: var(--bg-card2); border: 1px solid var(--border);
    border-radius: 12px; padding: 14px 20px; flex: 1;
  }
  .bottom-stat-icon {
    width: 36px; height: 36px; border-radius: 10px;
    background: rgba(124,92,252,0.15); display: flex; align-items: center; justify-content: center;
    color: var(--accent-purple-light); flex-shrink: 0;
  }
  .bottom-stat-icon svg { width: 18px; height: 18px; }
  .bottom-stat-label { font-size: 11px; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 3px; }
  .bottom-stat-value { font-family: 'Syne', sans-serif; font-size: 18px; font-weight: 700; }
  .bottom-stat-value span { font-size: 12px; color: var(--text-muted); font-weight: 400; }

  /* RIGHT: CREATE FORM */
  .create-panel {
    background: var(--bg-card); border: 1px solid var(--border);
    border-radius: 16px; padding: 22px; height: fit-content; position: sticky; top: 0;
  }
  .panel-title {
    font-family: 'Syne', sans-serif; font-size: 18px; font-weight: 700;
    display: flex; align-items: center; gap: 8px; margin-bottom: 20px;
  }
  .panel-title-icon {
    width: 20px; height: 20px; color: var(--accent-purple-light);
  }
  .upload-zone {
    border: 2px dashed var(--border); border-radius: 12px; padding: 28px;
    text-align: center; cursor: pointer; transition: all 0.2s; margin-bottom: 18px;
  }
  .upload-zone:hover { border-color: var(--accent-purple); background: rgba(124,92,252,0.04); }
  .upload-zone svg { width: 32px; height: 32px; color: var(--text-muted); margin-bottom: 10px; }
  .upload-zone .upload-text { font-size: 13px; color: var(--text-secondary); }
  .upload-zone .upload-text span { color: var(--accent-purple-light); cursor: pointer; }
  .upload-zone .upload-hint { font-size: 11px; color: var(--text-muted); margin-top: 5px; text-transform: uppercase; letter-spacing: 0.5px; }

  .form-group { margin-bottom: 14px; }
  .form-label { font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: var(--text-secondary); margin-bottom: 8px; display: block; }
  .form-input {
    width: 100%; background: var(--bg-card2); border: 1px solid var(--border);
    border-radius: 10px; padding: 10px 14px; color: var(--text-primary);
    font-size: 13px; font-family: 'DM Sans', sans-serif; outline: none;
    transition: border-color 0.2s;
  }
  .form-input:focus { border-color: var(--accent-purple); }
  .form-input::placeholder { color: var(--text-muted); }
  .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
  .form-row-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; }
  .form-select {
    width: 100%; background: var(--bg-card2); border: 1px solid var(--border);
    border-radius: 10px; padding: 10px 14px; color: var(--text-primary);
    font-size: 13px; font-family: 'DM Sans', sans-serif; outline: none; cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238a8a9a' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 12px center;
  }
  .form-select:focus { border-color: var(--accent-purple); }

  .form-actions { display: flex; gap: 10px; margin-top: 20px; }
  .btn-publish {
    flex: 1; padding: 12px; border-radius: 10px;
    background: linear-gradient(135deg, var(--accent-purple), #9b59f5);
    color: white; font-size: 14px; font-weight: 600;
    cursor: pointer; border: none; font-family: 'DM Sans', sans-serif;
    transition: all 0.2s;
  }
  .btn-publish:hover { opacity: 0.9; }
  .btn-draft {
    padding: 12px 20px; border-radius: 10px;
    background: transparent; border: 1px solid var(--border);
    color: var(--text-secondary); font-size: 14px; font-weight: 600;
    cursor: pointer; font-family: 'DM Sans', sans-serif; transition: all 0.2s;
  }
  .btn-draft:hover { color: var(--text-primary); border-color: var(--border-light); }

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
      <a href="{{ route('admin.dashboard') }}" class="nav-item">
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
      <a href="{{ route('admin.events') }}" class="nav-item active">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
          <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
        </svg>
        Event Management
      </a>
      <a href="{{ route('admin.users.bulk') }}" class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polygon points="12 2 2 7 12 12 22 7 12 2"/>
          <polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/>
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
        <input type="text" placeholder="Search events or curators...">
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
      </div>
    </header>

    <div class="content">
      <div class="page-header">
        <div class="page-header-left">
          <div class="breadcrumb">Management</div>
          <h1>Curated Events</h1>
        </div>
        <button class="btn-create">+ Create New Event</button>
      </div>

      <div class="main-grid">
        <!-- EVENT LIST -->
        <div class="events-left">
          <div class="events-tabs">
            <div class="events-tab active">All Events</div>
            <div class="events-tab">Upcoming</div>
            <div class="events-tab">Finished</div>
            <span class="events-count">Showing 24 Events</span>
          </div>

          <?php
          $events = [
            [
              'title' => 'Neo-Retro Synthwave Night',
              'date' => 'Oct 24, 2024',
              'location' => 'Main Auditorium',
              'quota' => '450/500 Quota',
              'price' => '$25.00',
              'is_free' => false,
              'status' => 'UPCOMING',
              'status_class' => 'tag-upcoming',
              'has_paid' => true,
              'gradient' => 'linear-gradient(135deg, #0d0020 0%, #2d0060 40%, #1a003a 100%)',
              'overlay_color' => '#7c00ff',
            ],
            [
              'title' => 'Global Tech Symposium...',
              'date' => 'Sep 12, 2024',
              'location' => 'Hall B',
              'quota' => '120/120 Quota',
              'price' => 'FREE',
              'is_free' => true,
              'status' => 'FINISHED',
              'status_class' => 'tag-finished',
              'has_paid' => false,
              'gradient' => 'linear-gradient(135deg, #0a1020 0%, #1a2840 100%)',
              'overlay_color' => '#1a3460',
            ],
          ];
          foreach($events as $e): ?>
          <div class="event-card">
            <div class="event-thumb" style="background:<?= $e['gradient'] ?>;">
              <?php if($e['status'] === 'UPCOMING'): ?>
              <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;min-height:140px;position:relative;">
                <div style="position:absolute;inset:0;background:<?= $e['gradient'] ?>;"></div>
                <div style="position:absolute;top:0;left:0;right:0;bottom:0;background:radial-gradient(circle at 30% 70%, rgba(180,0,255,0.4) 0%, transparent 60%);"></div>
                <svg style="width:60px;height:60px;opacity:0.4;position:relative;z-index:1;" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1">
                  <circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8" fill="white" stroke="none"/>
                </svg>
              </div>
              <?php else: ?>
              <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;min-height:140px;background:<?= $e['gradient'] ?>;">
                <svg style="width:48px;height:48px;opacity:0.2;" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1">
                  <rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>
                </svg>
              </div>
              <?php endif; ?>
              <span class="event-tag-status <?= $e['status_class'] ?>"><?= $e['status'] ?></span>
            </div>
            <div class="event-body">
              <div class="event-title"><?= $e['title'] ?></div>
              <div class="event-meta">
                <div class="event-meta-item">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/>
                  </svg>
                  <?= $e['date'] ?>
                </div>
                <div class="event-meta-item">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                    <circle cx="12" cy="10" r="3"/>
                  </svg>
                  <?= $e['location'] ?>
                </div>
                <div class="event-meta-item">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/>
                    <line x1="8" y1="12" x2="16" y2="12"/>
                  </svg>
                  <?= $e['quota'] ?>
                </div>
              </div>
              <div class="event-footer">
                <div>
                  <span class="event-price <?= $e['is_free'] ? 'free' : '' ?>"><?= $e['price'] ?></span>
                  <?php if($e['has_paid']): ?>
                  <span class="price-badge badge-paid">Paid Entry</span>
                  <?php endif; ?>
                </div>
                <div class="event-actions">
                  <?php if($e['is_free']): ?>
                  <div class="ev-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                      <circle cx="12" cy="12" r="3"/>
                    </svg>
                  </div>
                  <?php else: ?>
                  <div class="ev-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                      <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                  </div>
                  <div class="ev-btn" style="color:var(--accent-red);">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <polyline points="3 6 5 6 21 6"/>
                      <path d="M19 6l-1 14H6L5 6"/>
                    </svg>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>

          <!-- BOTTOM STATS -->
          <div class="bottom-stats">
            <div class="bottom-stat">
              <div class="bottom-stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="2" y="6" width="20" height="12" rx="2"/>
                  <circle cx="12" cy="12" r="2"/>
                  <path d="M6 12h.01M18 12h.01"/>
                </svg>
              </div>
              <div>
                <div class="bottom-stat-label">Ticket Sales</div>
                <div class="bottom-stat-value">$12,450.00</div>
              </div>
            </div>
            <div class="bottom-stat">
              <div class="bottom-stat-icon" style="background:rgba(34,197,94,0.1);color:var(--accent-green);">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                  <polyline points="17 6 23 6 23 12"/>
                </svg>
              </div>
              <div>
                <div class="bottom-stat-label">Activity</div>
                <div class="bottom-stat-value" style="color:var(--accent-green);">+18% <span>vs last wk.</span></div>
              </div>
            </div>
          </div>
        </div>

        <!-- CREATE PANEL -->
        <div class="create-panel">
          <div class="panel-title">
            <svg class="panel-title-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            Event Curator
          </div>

          <div class="upload-zone">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <rect x="3" y="3" width="18" height="18" rx="2"/>
              <circle cx="8.5" cy="8.5" r="1.5"/>
              <polyline points="21 15 16 10 5 21"/>
            </svg>
            <div class="upload-text">Drop event poster or <span>browse</span></div>
            <div class="upload-hint">Recommended: 1200x800px</div>
          </div>

          <div class="form-group">
            <label class="form-label">Event Title</label>
            <input type="text" class="form-input" placeholder="Enter a cinematic title...">
          </div>

          <div class="form-row form-group">
            <div>
              <label class="form-label">Date</label>
              <input type="text" class="form-input" placeholder="mm/dd/yyyy">
            </div>
            <div>
              <label class="form-label">Location</label>
              <input type="text" class="form-input" placeholder="Venice Hall">
            </div>
          </div>

          <div class="form-row-3">
            <div class="form-group">
              <label class="form-label">Quota</label>
              <input type="number" class="form-input" placeholder="50">
            </div>
            <div class="form-group">
              <label class="form-label">Price ($)</label>
              <input type="text" class="form-input" placeholder="0.00">
            </div>
            <div class="form-group">
              <label class="form-label">Payment</label>
              <select class="form-select">
                <option>Active</option>
                <option>Inactive</option>
                <option>Free</option>
              </select>
            </div>
          </div>

          <div class="form-actions">
            <button class="btn-publish">Publish Event</button>
            <button class="btn-draft">Draft</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>