@extends('admin.layouts.app')

@section('title', 'Bulk Operations')
@section('search_placeholder', 'Search operations...')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/bulk.css') }}">
@endpush

@section('content')
  <div class="page-title">Bulk Account Removal</div>
  <div class="page-desc">Streamline your administrative workflow. Import Excel or CSV files to decommission multiple student and staff accounts simultaneously.</div>

  <div class="ops-grid">
    {{-- LEFT --}}
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

    {{-- RIGHT: REMOVAL QUEUE --}}
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

  {{-- BOTTOM STATS --}}
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

  <div class="fab-help">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <circle cx="12" cy="12" r="10"/>
      <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/>
      <line x1="12" y1="17" x2="12.01" y2="17"/>
    </svg>
  </div>
@endsection
