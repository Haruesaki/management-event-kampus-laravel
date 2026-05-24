@extends('admin.layouts.app')

@section('title', 'Event Management')
@section('search_placeholder', 'Search events...')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/events.css') }}">
@endpush

@section('content')
  <div class="page-header">
    <div class="page-header-left">
      <div class="breadcrumb">Management</div>
      <h1>Curated Events</h1>
    </div>
    <button class="btn-create">+ Create New Event</button>
  </div>

  <div class="main-grid">
    {{-- EVENT LIST --}}
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

      {{-- BOTTOM STATS --}}
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

    {{-- CREATE PANEL --}}
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
@endsection