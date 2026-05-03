<?php
$page_title = "Bulk Operations";
$active_page = "bulk-operations";
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CampusAdmin - Bulk Operations</title>
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
    font-family: 'Syne', sans-serif; font-size: 18px; font-weight: 800;
    color: var(--accent-purple-light); letter-spacing: -0.5px;
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
    background: var(--accent-pink); border-radius: 0 2px 2px 0;
  }
  .nav-item svg { width: 18px; height: 18px; flex-shrink: 0; }
  .sidebar-footer { padding: 16px 16px 0; border-top: 1px solid var(--border); margin-top: auto; }
  .admin-card {
    display: flex; align-items: center; gap: 12px;
    padding: 12px; border-radius: 12px; background: rgba(255,255,255,0.04);
    border: 1px solid var(--border);
  }
  .admin-avatar {
    width: 38px; height: 38px; border-radius: 8px;
    overflow: hidden; flex-shrink: 0; background: var(--bg-card2);
  }
  .admin-avatar img { width: 100%; height: 100%; object-fit: cover; }
  .admin-avatar-placeholder {
    width: 100%; height: 100%; background: linear-gradient(135deg, #2a1f4a, #4a2f6a);
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; font-weight: 700;
  }
  .admin-info .name { font-size: 13px; font-weight: 600; }
  .admin-info .role { font-size: 11px; color: var(--text-secondary); margin-top: 2px; }
  .online-dot {
    width: 8px; height: 8px; border-radius: 50%; background: var(--accent-green);
    margin-left: auto; box-shadow: 0 0 6px rgba(34,197,94,0.6);
  }

  .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
  .topbar {
    height: 56px; border-bottom: 1px solid var(--border);
    display: flex; align-items: center; padding: 0 24px;
    background: var(--bg-sidebar); gap: 16px; flex-shrink: 0;
  }
  .search-box {
    flex: 1; max-width: 340px; background: var(--bg-card); border: 1px solid var(--border);
    border-radius: 8px; display: flex; align-items: center; gap: 10px; padding: 0 12px; height: 36px;
  }
  .search-box input {
    background: none; border: none; outline: none; color: var(--text-primary);
    font-size: 13px; font-family: 'DM Sans', sans-serif; width: 100%;
  }
  .search-box input::placeholder { color: var(--text-muted); }
  .search-box svg { color: var(--text-muted); width: 14px; height: 14px; flex-shrink: 0; }
  .topbar-actions { margin-left: auto; display: flex; align-items: center; gap: 12px; }
  .icon-btn {
    width: 34px; height: 34px; border-radius: 8px; background: var(--bg-card);
    border: 1px solid var(--border); display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--text-secondary); transition: all 0.2s;
  }
  .icon-btn svg { width: 15px; height: 15px; }

  .content { flex: 1; overflow-y: auto; padding: 28px 28px 0; }

  /* HEADER */
  .page-title { font-family: 'Syne', sans-serif; font-size: 34px; font-weight: 800; letter-spacing: -1.5px; margin-bottom: 6px; }
  .page-desc { font-size: 13px; color: var(--text-secondary); line-height: 1.6; max-width: 560px; margin-bottom: 28px; }

  /* MAIN GRID */
  .ops-grid { display: grid; grid-template-columns: 1fr 1.05fr; gap: 20px; margin-bottom: 24px; }

  /* LEFT PANEL */
  .left-panel { display: flex; flex-direction: column; gap: 16px; }

  .upload-card {
    background: var(--bg-card); border: 1px solid var(--border);
    border-radius: 16px; padding: 32px; text-align: center;
  }
  .upload-icon-wrap {
    width: 64px; height: 64px; border-radius: 16px;
    background: rgba(124,92,252,0.12); border: 1px solid rgba(124,92,252,0.2);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 16px; color: var(--accent-purple-light);
  }
  .upload-icon-wrap svg { width: 30px; height: 30px; }
  .upload-title { font-family: 'Syne', sans-serif; font-size: 18px; font-weight: 700; margin-bottom: 8px; }
  .upload-desc { font-size: 13px; color: var(--text-secondary); line-height: 1.6; margin-bottom: 20px; }
  .btn-select {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 10px 28px; border-radius: 10px;
    background: transparent; border: 1px solid var(--border-light);
    color: var(--text-primary); font-size: 13px; font-weight: 600;
    cursor: pointer; font-family: 'DM Sans', sans-serif; transition: all 0.2s;
  }
  .btn-select:hover { background: var(--bg-hover); border-color: var(--accent-purple); }

  .warning-card {
    background: rgba(220, 38, 38, 0.06); border: 1px solid rgba(220, 38, 38, 0.2);
    border-radius: 14px; padding: 18px; display: flex; gap: 14px; align-items: flex-start;
  }
  .warning-icon {
    width: 36px; height: 36px; border-radius: 50%; background: rgba(220,38,38,0.15);
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    color: var(--accent-red);
  }
  .warning-icon svg { width: 18px; height: 18px; }
  .warning-title { font-size: 14px; font-weight: 700; color: var(--accent-red); margin-bottom: 6px; }
  .warning-text { font-size: 12px; color: rgba(239,68,68,0.7); line-height: 1.6; }

  .checklist-card {
    background: var(--bg-card); border: 1px solid var(--border);
    border-radius: 14px; padding: 18px;
  }
  .checklist-title {
    font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;
    color: var(--text-muted); margin-bottom: 14px;
  }
  .check-item { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; font-size: 13px; }
  .check-item:last-child { margin-bottom: 0; }
  .check-circle {
    width: 20px; height: 20px; border-radius: 50%; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    background: rgba(34,197,94,0.12); border: 1px solid rgba(34,197,94,0.25);
  }
  .check-circle svg { width: 11px; height: 11px; color: var(--accent-green); }

  /* RIGHT PANEL */
  .queue-card {
    background: var(--bg-card); border: 1px solid var(--border);
    border-radius: 16px; overflow: hidden;
  }
  .queue-header {
    padding: 18px 20px; border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between;
  }
  .queue-title { font-family: 'Syne', sans-serif; font-size: 17px; font-weight: 700; }
  .queue-sub { font-size: 12px; color: var(--text-secondary); margin-top: 3px; }
  .queue-status {
    font-size: 10px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;
    color: var(--accent-yellow); background: rgba(245,158,11,0.1);
    padding: 4px 10px; border-radius: 20px;
  }

  .queue-list { padding: 8px 0; }
  .queue-item {
    display: flex; align-items: center; gap: 12px;
    padding: 12px 20px; transition: background 0.15s; cursor: pointer;
  }
  .queue-item:hover { background: var(--bg-card2); }
  .queue-avatar { position: relative; width: 42px; height: 42px; flex-shrink: 0; }
  .queue-avatar-img {
    width: 42px; height: 42px; border-radius: 50%; overflow: hidden;
    background: var(--bg-card2);
  }
  .queue-avatar-img img { width: 100%; height: 100%; object-fit: cover; }
  .queue-avatar-img-placeholder {
    width: 100%; height: 100%; display: flex; align-items: center;
    justify-content: center; font-size: 14px; font-weight: 700;
    background: linear-gradient(135deg, #2a1f4a, #4a2f6a);
  }
  .queue-del-badge {
    position: absolute; bottom: -1px; right: -1px;
    width: 16px; height: 16px; border-radius: 50%;
    background: var(--accent-red); border: 2px solid var(--bg-card);
    display: flex; align-items: center; justify-content: center;
  }
  .queue-del-badge svg { width: 8px; height: 8px; color: white; }
  .queue-info { flex: 1; min-width: 0; }
  .queue-name { font-size: 14px; font-weight: 600; }
  .queue-meta { font-size: 11px; color: var(--text-secondary); margin-top: 2px; }
  .queue-role {
    font-size: 10px; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase;
    padding: 4px 10px; border-radius: 6px; flex-shrink: 0;
  }
  .qrole-peserta { background: rgba(224,64,160,0.12); color: var(--accent-pink); }
  .qrole-panitia { background: rgba(34,197,94,0.12); color: var(--accent-green); }
  .queue-detail-btn {
    width: 28px; height: 28px; border-radius: 6px;
    background: var(--bg-card2); border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--text-muted); flex-shrink: 0;
  }
  .queue-detail-btn svg { width: 13px; height: 13px; }

  .queue-footer { padding: 16px 20px; border-top: 1px solid var(--border); }
  .confirm-row { display: flex; align-items: center; gap: 10px; margin-bottom: 14px; }
  .confirm-checkbox {
    width: 18px; height: 18px; border-radius: 4px; flex-shrink: 0;
    background: var(--bg-card2); border: 2px solid var(--border);
    cursor: pointer; display: flex; align-items: center; justify-content: center;
    transition: all 0.2s;
  }
  .confirm-checkbox:hover { border-color: var(--accent-red); }
  .confirm-text { font-size: 12px; color: var(--text-secondary); }

  .btn-execute {
    width: 100%; padding: 14px; border-radius: 12px;
    background: linear-gradient(135deg, var(--accent-red), var(--accent-pink));
    color: white; font-size: 14px; font-weight: 700;
    cursor: pointer; border: none; font-family: 'Syne', sans-serif;
    letter-spacing: -0.5px; transition: all 0.2s;
    box-shadow: 0 4px 20px rgba(239,68,68,0.3);
  }
  .btn-execute:hover { transform: translateY(-1px); box-shadow: 0 6px 28px rgba(239,68,68,0.4); }

  /* BOTTOM STATS */
  .bottom-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; padding-bottom: 28px; }
  .bottom-stat {
    background: var(--bg-card); border: 1px solid var(--border);
    border-radius: 14px; padding: 18px 20px;
    border-left: 3px solid var(--border);
  }
  .bottom-stat.stat-pink { border-left-color: var(--accent-pink); }
  .bottom-stat.stat-red { border-left-color: var(--accent-red); }
  .bottom-stat.stat-purple { border-left-color: var(--accent-purple); }
  .bstat-label { font-size: 11px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; color: var(--text-muted); margin-bottom: 10px; }
  .bstat-value { font-family: 'Syne', sans-serif; font-size: 28px; font-weight: 800; letter-spacing: -1.5px; }
  .bstat-sub { font-size: 13px; color: var(--text-secondary); margin-top: 4px; }
  .bstat-value.pink { color: var(--accent-pink); }
  .bstat-sub.permanent { color: var(--accent-red); font-weight: 600; }

  /* FAB HELP */
  .fab-help {
    position: fixed; bottom: 24px; right: 24px;
    width: 48px; height: 48px; border-radius: 50%;
    background: var(--bg-card2); border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--text-secondary); transition: all 0.2s;
    box-shadow: 0 4px 16px rgba(0,0,0,0.4);
  }
  .fab-help:hover { color: var(--text-primary); border-color: var(--accent-purple); }
  .fab-help svg { width: 22px; height: 22px; }

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
      <div class="brand-name">CampusAdmin</div>
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
  <a href="{{ route('admin.events') }}" class="nav-item">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
      <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
    </svg>
    Event Management
  </a>
  <a href="{{ route('admin.bulk') }}" class="nav-item active">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <polygon points="12 2 2 7 12 12 22 7 12 2"/>
      <polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/>
    </svg>
    Bulk Operations
  </a>
</nav>
    <div class="sidebar-footer">
      <div class="admin-card">
        <div class="admin-avatar">
          <div class="admin-avatar-placeholder">NC</div>
        </div>
        <div class="admin-info">
          <div class="name">Admin Avatar</div>
          <div class="role">Active Now</div>
        </div>
        <div class="online-dot"></div>
      </div>
    </div>
  </aside>

  <!-- MAIN -->
  <div class="main">
    <header class="topbar">
      <div class="search-box">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
        </svg>
        <input type="text" placeholder="Search operations...">
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
      <div class="page-title">Bulk Account Removal</div>
      <div class="page-desc">Streamline your administrative workflow. Import Excel or CSV files to decommission multiple student and staff accounts simultaneously.</div>

      <div class="ops-grid">
        <!-- LEFT -->
        <div class="left-panel">
          <div class="upload-card">
            <div class="upload-icon-wrap">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                <polyline points="17 8 12 3 7 8"/>
                <line x1="12" y1="3" x2="12" y2="15"/>
                <path d="M7 19h10"/>
                <circle cx="17" cy="19" r="3" style="stroke:var(--accent-purple-light);"/>
              </svg>
            </div>
            <div class="upload-title">Import Removal List</div>
            <div class="upload-desc">Drag and drop your .xlsx or .csv file here<br>to begin the parsing process.</div>
            <button class="btn-select">Select File</button>
          </div>

          <div class="warning-card">
            <div class="warning-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                <line x1="12" y1="9" x2="12" y2="13"/>
                <line x1="12" y1="17" x2="12.01" y2="17"/>
              </svg>
            </div>
            <div>
              <div class="warning-title">Destructive Action</div>
              <div class="warning-text">Deleting accounts is irreversible. This will purge all associated academic records, event logs, and metadata for both Panitia and Peserta roles. Ensure you have a local backup.</div>
            </div>
          </div>

          <div class="checklist-card">
            <div class="checklist-title">Requirement Checklist</div>
            <?php
            $checks = [
              'Column A: Unique User ID (NIM/NIP)',
              'Valid Role: Panitia or Peserta only',
              'Maximum 500 records per batch',
            ];
            foreach($checks as $c): ?>
            <div class="check-item">
              <div class="check-circle">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                  <polyline points="20 6 9 17 4 12"/>
                </svg>
              </div>
              <?= $c ?>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- RIGHT: REMOVAL QUEUE -->
        <div class="queue-card">
          <div class="queue-header">
            <div>
              <div class="queue-title">Removal Queue</div>
              <div class="queue-sub">5 accounts detected in last_import.csv</div>
            </div>
            <span class="queue-status">Pending Verification</span>
          </div>

          <div class="queue-list">
            <?php
            $queue = [
              ['initials'=>'AP','name'=>'Aditya Pratama','meta'=>'NIM: 2021081024 · Batch 2021','role'=>'PESERTA','role_class'=>'qrole-peserta','color1'=>'#3b1f5c','color2'=>'#6b3fa0'],
              ['initials'=>'SR','name'=>'Siti Rahmawati','meta'=>'NIM: 2019082210 · Batch 2019','role'=>'PANITIA','role_class'=>'qrole-panitia','color1'=>'#1a3a2a','color2'=>'#2a5a40'],
              ['initials'=>'BS','name'=>'Budi Santoso','meta'=>'NIM: 2022091105 · Batch 2022','role'=>'PESERTA','role_class'=>'qrole-peserta','color1'=>'#3b1f5c','color2'=>'#6b3fa0'],
              ['initials'=>'ML','name'=>'Maya Lestari','meta'=>'NIM: 2021081024 · Batch 2021','role'=>'PESERTA','role_class'=>'qrole-peserta','color1'=>'#3a1f3a','color2'=>'#6a3f6a'],
              ['initials'=>'HW','name'=>'Hendrik Wijaya','meta'=>'NIP: 198102401 · Staff Admin','role'=>'PANITIA','role_class'=>'qrole-panitia','color1'=>'#1a2a3a','color2'=>'#2a4a5a'],
            ];
            foreach($queue as $q): ?>
            <div class="queue-item">
              <div class="queue-avatar">
                <div class="queue-avatar-img">
                  <div class="queue-avatar-img-placeholder" style="background:linear-gradient(135deg, <?= $q['color1'] ?>, <?= $q['color2'] ?>);"><?= $q['initials'] ?></div>
                </div>
                <div class="queue-del-badge">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                  </svg>
                </div>
              </div>
              <div class="queue-info">
                <div class="queue-name"><?= $q['name'] ?></div>
                <div class="queue-meta"><?= $q['meta'] ?></div>
              </div>
              <span class="queue-role <?= $q['role_class'] ?>"><?= $q['role'] ?></span>
              <div class="queue-detail-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/>
                  <line x1="8" y1="18" x2="21" y2="18"/>
                  <line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/>
                  <line x1="3" y1="18" x2="3.01" y2="18"/>
                </svg>
              </div>
            </div>
            <?php endforeach; ?>
          </div>

          <div class="queue-footer">
            <div class="confirm-row">
              <div class="confirm-checkbox" onclick="this.innerHTML=this.innerHTML?'':'<svg viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'white\' stroke-width=\'3\' width=\'10\' height=\'10\'><polyline points=\'20 6 9 17 4 12\'/></svg>'; this.style.background=this.style.background?'':'var(--accent-red)'; this.style.borderColor=this.style.borderColor?'':'var(--accent-red)';"></div>
              <span class="confirm-text">I confirm these 5 accounts are correct for deletion.</span>
            </div>
            <button class="btn-execute">Execute Batch Delete</button>
          </div>
        </div>
      </div>

      <!-- BOTTOM STATS -->
      <div class="bottom-stats">
        <div class="bottom-stat stat-purple">
          <div class="bstat-label">Total Deletion Capacity</div>
          <div class="bstat-value">2,500</div>
          <div class="bstat-sub">per day</div>
        </div>
        <div class="bottom-stat stat-pink">
          <div class="bstat-label">Deleted This Month</div>
          <div class="bstat-value pink">412</div>
          <div class="bstat-sub">users purged</div>
        </div>
        <div class="bottom-stat stat-red">
          <div class="bstat-label">Recovery Window</div>
          <div class="bstat-value">0hr</div>
          <div class="bstat-sub permanent">Permanent</div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="fab-help">
  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
    <circle cx="12" cy="12" r="10"/>
    <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/>
    <line x1="12" y1="17" x2="12.01" y2="17"/>
  </svg>
</div>
</body>
</html>