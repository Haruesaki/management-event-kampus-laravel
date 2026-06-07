<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CampusAdmin - @yield('title', 'Admin Panel')</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/shared/layout.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/admin-common.css') }}">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@stack('styles')
</head>
<body>
<div class="layout">

  {{-- SIDEBAR (shared design) --}}
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
      <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
          <circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/>
          <path d="M16 3.13a4 4 0 010 7.75"/><path d="M21 21v-2a4 4 0 00-3-3.87"/>
        </svg>
        User Management
      </a>
      <a href="{{ route('admin.user_review') }}" class="nav-item {{ request()->routeIs('admin.user_review') ? 'active' : '' }}">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        User Review
      </a>
    </nav>
    <div class="sidebar-footer">
      <div class="role-card">
        <div class="role-card-avatar avatar-admin">{{ strtoupper(substr(Auth::user()->name ?? 'AD', 0, 2)) }}</div>
        <div class="role-card-info">
          <div class="role-card-name">{{ Auth::user()->name ?? 'Administrator' }}</div>
          <div class="role-card-label">Administrator</div>
        </div>
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

  {{-- MAIN --}}
  <div class="main">
    <header class="topbar">
      <a href="{{ route('admin.dashboard') }}" class="topbar-brand" style="text-decoration: none; color: inherit;">CampusAdmin</a>
    </header>
    <div class="content">
      @yield('content')
    </div>
  </div>
</div>

{{-- GLOBAL LOADER --}}
<div id="global-loader" class="loader-overlay">
    <div class="premium-loader"></div>
    <div class="loader-text">Memproses Data...</div>
</div>

@stack('scripts')
</body>
</html>