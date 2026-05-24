@extends('admin.layouts.app')

@section('title', 'User Management')
@section('search_placeholder', 'Search users...')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
@endpush

@section('content')
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
    <button class="btn-onboard" id="btnOnboard">
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

  {{-- INSIGHT POPUP --}}
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


  {{-- ════════════════════════════════════════ --}}
  {{-- ONBOARD NEW USER MODAL                   --}}
  {{-- ════════════════════════════════════════ --}}
  <div class="onboard-overlay" id="onboardOverlay">
    <div class="onboard-modal">

      <div class="modal-accent-bar"></div>

      <div class="modal-header">
        <div class="modal-header-left">
          <div class="modal-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/>
              <circle cx="9" cy="7" r="4"/>
              <line x1="19" y1="8" x2="19" y2="14"/>
              <line x1="16" y1="11" x2="22" y2="11"/>
            </svg>
          </div>
          <div>
            <div class="modal-title">Onboard New User</div>
            <div class="modal-subtitle">Register a new digital entity to the network</div>
          </div>
        </div>
        <div class="modal-close" id="modalClose">×</div>
      </div>

      <div class="modal-body">

        {{-- Live preview --}}
        <div class="avatar-preview-row">
          <div class="avatar-preview" id="avatarPreview">?</div>
          <div class="avatar-preview-info">
            <div class="avatar-preview-name" id="previewName">New Entity</div>
            <div class="avatar-preview-hint">Preview · auto-generated from input</div>
          </div>
          <span class="role-preview-badge peserta" id="previewBadge">PESERTA</span>
        </div>

        {{-- Name --}}
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">First Name</label>
            <input type="text" class="form-input" id="inputFirstName" placeholder="e.g. Lestari" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-input" id="inputLastName" placeholder="e.g. Ananta" autocomplete="off">
          </div>
        </div>

        {{-- Email --}}
        <div class="form-group">
          <label class="form-label">Email Address</label>
          <input type="email" class="form-input" placeholder="entity@campus.edu" autocomplete="off">
        </div>

        {{-- Role & Status --}}
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Assigned Role</label>
            <div class="select-wrapper">
              <select class="form-select" id="inputRole">
                <option value="peserta">Peserta</option>
                <option value="panitia">Panitia</option>
                <option value="admin">Admin</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Access Status</label>
            <div class="select-wrapper">
              <select class="form-select">
                <option>Active</option>
                <option>Offline</option>
                <option>Deactivated</option>
              </select>
            </div>
          </div>
        </div>

        {{-- Password --}}
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" class="form-input" placeholder="••••••••">
          </div>
          <div class="form-group">
            <label class="form-label">Confirm Password</label>
            <input type="password" class="form-input" placeholder="••••••••">
          </div>
        </div>

      </div>

      <div class="modal-divider"></div>

      <div class="modal-footer">
        <button class="btn-modal-cancel" id="modalCancel">Abort</button>
        <button class="btn-modal-submit">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
          Deploy Entity
        </button>
      </div>

    </div>
  </div>

@endsection

@push('scripts')
<script>
(function () {
  const overlay   = document.getElementById('onboardOverlay');
  const btnOpen   = document.getElementById('btnOnboard');
  const btnClose  = document.getElementById('modalClose');
  const btnCancel = document.getElementById('modalCancel');

  function openModal()  { overlay.classList.add('active');    document.body.style.overflow = 'hidden'; }
  function closeModal() { overlay.classList.remove('active'); document.body.style.overflow = ''; }

  btnOpen.addEventListener('click', openModal);
  btnClose.addEventListener('click', closeModal);
  btnCancel.addEventListener('click', closeModal);

  overlay.addEventListener('click', function (e) {
    if (e.target === overlay) closeModal();
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && overlay.classList.contains('active')) closeModal();
  });

  // Live preview — name & initials
  const inputFirst    = document.getElementById('inputFirstName');
  const inputLast     = document.getElementById('inputLastName');
  const previewName   = document.getElementById('previewName');
  const avatarPreview = document.getElementById('avatarPreview');
  const avatarColors  = ['#3b1f8c','#163a24','#2a1f4a','#1a1a2e','#7c1f5c','#1f3a5c'];

  function updatePreview() {
    const first = inputFirst.value.trim();
    const last  = inputLast.value.trim();
    previewName.textContent = [first, last].filter(Boolean).join(' ') || 'New Entity';
    const initials = [first[0], last[0]].filter(Boolean).join('').toUpperCase() || '?';
    avatarPreview.textContent = initials;
    if (initials !== '?') {
      const idx = (initials.charCodeAt(0) + (initials[1] ? initials.charCodeAt(1) : 0)) % avatarColors.length;
      avatarPreview.style.background = avatarColors[idx];
    } else {
      avatarPreview.style.background = '#2a2438';
    }
  }

  inputFirst.addEventListener('input', updatePreview);
  inputLast.addEventListener('input',  updatePreview);

  // Live preview — role badge
  const inputRole    = document.getElementById('inputRole');
  const previewBadge = document.getElementById('previewBadge');

  inputRole.addEventListener('change', function () {
    previewBadge.textContent = this.value.toUpperCase();
    previewBadge.className   = 'role-preview-badge ' + this.value;
  });
})();
</script>
@endpush
