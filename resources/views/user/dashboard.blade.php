@extends('user.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Member Portal / Dashboard')

@section('content')

<div class="page-header">
  <div>
    <h1>Welcome back, {{ auth()->user()->first_name ?? 'Member' }} 👋</h1>
    <p>Here's an overview of your progress and activity at RGRR WebMaker Philippines.</p>
  </div>
</div>

{{-- Stats --}}
<div class="stats-grid">

  <div style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #2563eb;border-radius:16px;padding:24px 20px;">
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
      <div style="width:38px;height:38px;border-radius:9px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#2563eb;font-size:0.9rem;">
        <i class="fas fa-graduation-cap"></i>
      </div>
      <span style="font-size:0.73rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Courses Enrolled</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2rem;color:var(--text);line-height:1;">{{ $enrolledCourses ?? 0 }}</div>
  </div>

  <div style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #1d4ed8;border-radius:16px;padding:24px 20px;">
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
      <div style="width:38px;height:38px;border-radius:9px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#1d4ed8;font-size:0.9rem;">
        <i class="fas fa-check-double"></i>
      </div>
      <span style="font-size:0.73rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Courses Completed</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2rem;color:var(--text);line-height:1;">{{ $completedCourses ?? 0 }}</div>
  </div>

  <div style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #2563eb;border-radius:16px;padding:24px 20px;">
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
      <div style="width:38px;height:38px;border-radius:9px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#2563eb;font-size:0.9rem;">
        <i class="fas fa-clock"></i>
      </div>
      <span style="font-size:0.73rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Hours Logged</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2rem;color:var(--text);line-height:1;">{{ auth()->user()->hours ?? 0 }}<span style="font-size:1rem;color:var(--muted);font-weight:400;"> hrs</span></div>
  </div>

  <div style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #1d4ed8;border-radius:16px;padding:24px 20px;">
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
      <div style="width:38px;height:38px;border-radius:9px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#1d4ed8;font-size:0.9rem;">
        <i class="fas fa-star"></i>
      </div>
      <span style="font-size:0.73rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Skills Listed</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2rem;color:var(--text);line-height:1;">{{ $skillsCount ?? 0 }}</div>
  </div>

</div>

<div style="display:grid;grid-template-columns:1fr 340px;gap:20px;">

  {{-- Course Progress --}}
  <div class="content-card">
    <div class="content-card-header">
      <h3><i class="fas fa-chart-line"></i> My Course Progress</h3>
      <a href="{{ route('user.courses') }}" class="btn btn-ghost btn-sm">View All</a>
    </div>
    <div style="padding:8px 0;">
      @forelse($enrollments ?? [] as $enrollment)
        <div style="display:flex;align-items:center;gap:14px;padding:14px 22px;border-bottom:1px solid rgba(37,99,235,0.06);">
          <div style="width:38px;height:38px;border-radius:9px;background:rgba(37,99,235,0.12);color:#60a5fa;display:flex;align-items:center;justify-content:center;font-size:0.85rem;flex-shrink:0;">
            <i class="fas fa-book"></i>
          </div>
          <div style="flex:1;min-width:0;">
            <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:0.85rem;margin-bottom:6px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
              {{ $enrollment->course->title }}
            </div>
            <div style="display:flex;align-items:center;gap:8px;">
              <div class="progress-wrap"><div class="progress-bar" style="width:{{ $enrollment->percent }}%;"></div></div>
              <span style="font-size:0.72rem;color:var(--muted);white-space:nowrap;">{{ $enrollment->percent }}%</span>
            </div>
          </div>
          <div>
            @if($enrollment->percent == 100)
              <span class="badge badge-done">Completed</span>
            @elseif($enrollment->percent == 0)
              <span class="badge badge-locked">Not Started</span>
            @else
              <span class="badge badge-active">In Progress</span>
            @endif
          </div>
        </div>
      @empty
        <div style="padding:36px;text-align:center;color:var(--muted);font-size:0.85rem;">
          <i class="fas fa-graduation-cap" style="font-size:2rem;margin-bottom:12px;display:block;opacity:0.3;"></i>
          No courses enrolled yet. Check with your admin.
        </div>
      @endforelse
    </div>
  </div>

  {{-- Recent Notifications --}}
  <div class="content-card">
    <div class="content-card-header">
      <h3><i class="fas fa-bell"></i> Recent Notifications</h3>
      <a href="{{ route('user.notifications') }}" class="btn btn-ghost btn-sm">All</a>
    </div>
    <div>
      @forelse($notifications ?? [] as $notif)
        <div style="display:flex;gap:10px;padding:12px 18px;border-bottom:1px solid rgba(37,99,235,0.06);{{ !$notif->read_at ? 'background:rgba(37,99,235,0.03);' : '' }}">
          <div style="width:7px;height:7px;border-radius:50%;background:{{ $notif->read_at ? 'var(--muted)' : '#2563eb' }};margin-top:5px;flex-shrink:0;"></div>
          <div>
            <div style="font-size:0.8rem;color:var(--text);line-height:1.5;">{{ $notif->message }}</div>
            <div style="font-size:0.7rem;color:var(--muted);margin-top:2px;">{{ $notif->created_at->diffForHumans() }}</div>
          </div>
        </div>
      @empty
        <div style="padding:28px;text-align:center;color:var(--muted);font-size:0.82rem;">No notifications yet.</div>
      @endforelse
    </div>
  </div>

</div>

{{-- Member Info Card --}}
<div class="content-card">
  <div class="content-card-header">
    <h3><i class="fas fa-id-card"></i> My Member Info</h3>
    <a href="{{ route('user.profile') }}" class="btn btn-ghost btn-sm"><i class="fas fa-pen"></i> Edit Profile</a>
  </div>
  <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:0;padding:0;">
    @php
      $u = auth()->user();
      $middleInitial = $u ? ($u->middle_initial ? $u->middle_initial . '. ' : '') : '';
      $fields = [
        ['label' => 'Full Name',    'value' => trim(($u->first_name ?? 'Preview') . ' ' . $middleInitial . ($u->surname ?? 'Member'))],
        ['label' => 'Email',        'value' => $u->email ?? '—'],
        ['label' => 'School',       'value' => $u->school ?? '—'],
        ['label' => 'Year Level',   'value' => $u->year_level ?? '—'],
        ['label' => 'School Year',  'value' => $u->school_year ?? '—'],
        ['label' => 'Hours',        'value' => ($u->hours ?? 0) . ' hrs'],
        ['label' => 'Status',       'value' => ucfirst($u->status ?? 'active')],
        ['label' => 'Member Since', 'value' => ($u && $u->created_at) ? $u->created_at->format('M d, Y') : '—'],
      ];
    @endphp
    @foreach($fields as $field)
      <div style="padding:16px 20px;border-bottom:1px solid rgba(37,99,235,0.06);border-right:1px solid rgba(37,99,235,0.06);">
        <div style="font-size:0.67rem;text-transform:uppercase;letter-spacing:0.07em;color:var(--muted);margin-bottom:4px;">{{ $field['label'] }}</div>
        <div style="font-size:0.84rem;font-weight:500;color:var(--text);">{{ $field['value'] }}</div>
      </div>
    @endforeach
  </div>
</div>

@endsection