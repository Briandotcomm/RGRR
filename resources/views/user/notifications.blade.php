@extends('user.layout')

@section('title', 'Notifications')
@section('page-title', 'Notifications')
@section('breadcrumb', 'Member Portal / Notifications')

@section('content')

@php
    // Use data passed from the controller (fall back to zero if not set)
    $totalCount = $totalCount ?? 0;
    $unreadCount = $unreadCount ?? 0;
@endphp

<div class="page-header">
  <div>
    <h1>Notifications</h1>
    <p>Stay up to date with your latest updates and announcements.</p>
  </div>
  @if(($unreadCount ?? 0) > 0)
    <form method="POST" action="{{ route('user.notifications.readAll') }}">
      @csrf
      <button type="submit" class="btn btn-ghost btn-sm"><i class="fas fa-check-double"></i> Mark All as Read</button>
    </form>
  @endif
</div>

{{-- Summary cards --}}
<div class="stats-grid" style="grid-template-columns:repeat(3,1fr);">

  <div style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #2563eb;border-radius:16px;padding:24px 20px;">
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
      <div style="width:38px;height:38px;border-radius:9px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#2563eb;font-size:0.9rem;">
        <i class="fas fa-bell"></i>
      </div>
      <span style="font-size:0.73rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Total</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2rem;color:var(--text);line-height:1;">{{ $totalCount }}</div>
  </div>

  <div style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #1d4ed8;border-radius:16px;padding:24px 20px;">
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
      <div style="width:38px;height:38px;border-radius:9px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#1d4ed8;font-size:0.9rem;">
        <i class="fas fa-envelope"></i>
      </div>
      <span style="font-size:0.73rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Unread</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2rem;color:var(--text);line-height:1;">{{ $unreadCount }}</div>
  </div>

  <div style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #2563eb;border-radius:16px;padding:24px 20px;">
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
      <div style="width:38px;height:38px;border-radius:9px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#2563eb;font-size:0.9rem;">
        <i class="fas fa-envelope-open"></i>
      </div>
      <span style="font-size:0.73rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Read</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2rem;color:var(--text);line-height:1;">{{ $totalCount - $unreadCount }}</div>
  </div>

</div>

{{-- Notifications List --}}
<div class="content-card">
  <div class="content-card-header">
    <h3><i class="fas fa-bell"></i> All Notifications</h3>
  </div>
  <div>
    @forelse($notifications ?? [] as $notif)
      <div style="display:flex;gap:14px;padding:16px 22px;border-bottom:1px solid rgba(37,99,235,0.06);transition:background 0.2s;{{ !$notif->read_at ? 'background:rgba(37,99,235,0.04);' : '' }}"
           onmouseenter="this.style.background='rgba(37,99,235,0.05)'" onmouseleave="this.style.background='{{ !$notif->read_at ? 'rgba(37,99,235,0.04)' : '' }}'">

        {{-- Icon --}}
        <div style="width:40px;height:40px;border-radius:10px;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:0.9rem;
          {{ $notif->type === 'course' ? 'background:rgba(37,99,235,0.12);color:#60a5fa;' : ($notif->type === 'approval' ? 'background:rgba(37,99,235,0.15);color:#93c5fd;' : 'background:rgba(37,99,235,0.08);color:#2563eb;') }}">
          <i class="fas {{ $notif->type === 'course' ? 'fa-graduation-cap' : ($notif->type === 'approval' ? 'fa-check-circle' : 'fa-bell') }}"></i>
        </div>

        <div style="flex:1;min-width:0;">
          <div style="font-size:0.84rem;color:{{ $notif->read_at ? 'var(--muted)' : 'var(--text)' }};line-height:1.5;margin-bottom:4px;">
            {{ $notif->message }}
          </div>
          <div style="font-size:0.7rem;color:var(--muted);">{{ $notif->created_at->diffForHumans() }}</div>
        </div>

        <div style="display:flex;align-items:center;gap:8px;flex-shrink:0;">
          @if(!$notif->read_at)
            <span style="width:8px;height:8px;border-radius:50%;background:#2563eb;display:inline-block;"></span>
            <form method="POST" action="{{ route('user.notifications.read', $notif->id) }}">
              @csrf
              <button type="submit" class="btn btn-ghost btn-sm" style="padding:4px 10px;font-size:0.7rem;">Mark Read</button>
            </form>
          @else
            <span style="font-size:0.7rem;color:var(--muted);">Read</span>
          @endif
        </div>

      </div>
    @empty
      <div style="padding:48px;text-align:center;color:var(--muted);">
        <i class="fas fa-bell-slash" style="font-size:2.5rem;opacity:0.2;display:block;margin-bottom:14px;"></i>
        <div style="font-size:0.88rem;">You're all caught up! No notifications yet.</div>
      </div>
    @endforelse
  </div>
  @if(isset($notifications) && method_exists($notifications, 'hasPages') && $notifications->hasPages())
    <div style="padding:16px 22px;">{{ $notifications->links() }}</div>
  @endif
</div>

@endsection