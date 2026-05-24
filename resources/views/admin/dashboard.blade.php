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
<link rel="stylesheet" href="{{ asset('css/shared/layout.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
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
        </svg>
        Dashboard
      </a>
      <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
          <circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/>
          <path d="M16 3.13a4 4 0 010 7.75"/><path d="M21 21v-2a4 4 0 00-3-3.87"/>
        </svg>
        User Management
      </a>
      <a href="{{ route('admin.events') }}" class="nav-item {{ request()->routeIs('admin.events*') ? 'active' : '' }}">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
          <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
          <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
        </svg>
        Event Management
      </a>
      <a href="{{ route('admin.users.bulk') }}" class="nav-item {{ request()->routeIs('admin.users.bulk') ? 'active' : '' }}">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
          <polygon points="12 2 2 7 12 12 22 7 12 2"/>
          <polyline points="2 17 12 22 22 17"/>
          <polyline points="2 12 12 17 22 12"/>
        </svg>
        Bulk Operations
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
        <input type="text" placeholder="Search system...">
      </div>
      <div class="topbar-actions">
        <div class="topbar-icon">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
          </svg>
        </div>
        <div class="topbar-icon">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="3"/>
            <path d="M19.07 4.93a10 10 0 010 14.14M4.93 4.93a10 10 0 000 14.14"/>
          </svg>
        </div>
        <div class="topbar-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
      </div>
    </header>

    <div class="content">
      <div style="display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:28px;">
        <div>
          <h1 style="font-family:'Poppins',sans-serif;font-size:32px;font-weight:800;letter-spacing:-1px;">System Overview</h1>
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

{{-- GLOBAL LOADER --}}
<div id="global-loader" class="loader-overlay">
    <div class="premium-loader"></div>
    <div class="loader-text">Memproses Data...</div>
</div>

</body>
</html>