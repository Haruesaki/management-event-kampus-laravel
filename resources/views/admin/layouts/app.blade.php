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
      <span class="topbar-brand">CampusAdmin</span>
      <div class="topbar-search">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
        </svg>
        <input type="text" placeholder="@yield('search_placeholder', 'Search system...')">
      </div>
      <div class="topbar-actions">
        <div class="topbar-icon">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
          </svg>
        </div>
        @hasSection('topbar_extra_icon')
          @yield('topbar_extra_icon')
        @else
          <div class="topbar-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="3"/>
              <path d="M19.07 4.93a10 10 0 010 14.14M4.93 4.93a10 10 0 000 14.14"/>
            </svg>
          </div>
        @endif
        <div class="topbar-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
      </div>
    </header>

    <div class="content">
      @yield('content')
    </div>
  </div>
</div>

@stack('scripts')
</body>
</html>