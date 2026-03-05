@extends('user.layout')

@section('title', 'My Courses')
@section('page-title', 'My Courses')
@section('breadcrumb', 'Member Portal / My Courses')

@section('content')

<div class="page-header">
  <div>
    <h1>My Courses</h1>
    <p>Track your learning progress across all enrolled courses.</p>
  </div>
</div>

{{-- Stats --}}
<div class="stats-grid">

  <div style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #2563eb;border-radius:16px;padding:24px 20px;">
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
      <div style="width:38px;height:38px;border-radius:9px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#2563eb;font-size:0.9rem;">
        <i class="fas fa-book-open"></i>
      </div>
      <span style="font-size:0.73rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Enrolled</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2rem;color:var(--text);line-height:1;">{{ $totalEnrolled ?? 0 }}</div>
  </div>

  <div style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #1d4ed8;border-radius:16px;padding:24px 20px;">
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
      <div style="width:38px;height:38px;border-radius:9px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#1d4ed8;font-size:0.9rem;">
        <i class="fas fa-spinner"></i>
      </div>
      <span style="font-size:0.73rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">In Progress</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2rem;color:var(--text);line-height:1;">{{ $inProgress ?? 0 }}</div>
  </div>

  <div style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #2563eb;border-radius:16px;padding:24px 20px;">
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
      <div style="width:38px;height:38px;border-radius:9px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#2563eb;font-size:0.9rem;">
        <i class="fas fa-check-double"></i>
      </div>
      <span style="font-size:0.73rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Completed</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2rem;color:var(--text);line-height:1;">{{ $completed ?? 0 }}</div>
  </div>

  <div style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #1d4ed8;border-radius:16px;padding:24px 20px;">
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
      <div style="width:38px;height:38px;border-radius:9px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#1d4ed8;font-size:0.9rem;">
        <i class="fas fa-tasks"></i>
      </div>
      <span style="font-size:0.73rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Modules Done</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2rem;color:var(--text);line-height:1;">{{ $totalModulesDone ?? 0 }}</div>
  </div>

</div>

{{-- Course Cards --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:18px;margin-bottom:22px;">
  @forelse($enrollments ?? [] as $enrollment)
    @php
      $pct = $enrollment->course->total_modules > 0
        ? round(($enrollment->completed_modules / $enrollment->course->total_modules) * 100)
        : 0;
      $iconColors = ['#60a5fa','#93c5fd','#3b82f6','#2563eb'];
      $iconBgs    = ['rgba(37,99,235,0.14)','rgba(37,99,235,0.10)','rgba(59,130,246,0.14)','rgba(29,78,216,0.14)'];
      $topColors  = ['#2563eb','#1d4ed8','#3b82f6','#60a5fa'];
      $idx        = $loop->index % 4;
    @endphp
    <div style="background:var(--card);border:1px solid var(--border);border-radius:16px;overflow:hidden;transition:transform 0.2s,border-color 0.2s;"
         onmouseenter="this.style.transform='translateY(-3px)';this.style.borderColor='rgba(37,99,235,0.35)'"
         onmouseleave="this.style.transform='';this.style.borderColor=''">

      {{-- Top accent bar --}}
      <div style="height:3px;background:{{ $topColors[$idx] }};"></div>

      <div style="padding:22px;">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:14px;">
          <div style="width:44px;height:44px;border-radius:11px;background:{{ $iconBgs[$idx] }};color:{{ $iconColors[$idx] }};display:flex;align-items:center;justify-content:center;font-size:1rem;">
            <i class="fas fa-book"></i>
          </div>
          @if($pct == 100)
            <span class="badge badge-done">Completed</span>
          @elseif($pct == 0)
            <span class="badge badge-locked">Not Started</span>
          @else
            <span class="badge badge-active">In Progress</span>
          @endif
        </div>

        <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:0.92rem;margin-bottom:6px;">{{ $enrollment->course->title }}</div>
        <div style="font-size:0.76rem;color:var(--muted);line-height:1.5;margin-bottom:16px;">{{ $enrollment->course->description }}</div>

        {{-- Progress --}}
        <div style="margin-bottom:10px;">
          <div style="display:flex;justify-content:space-between;font-size:0.72rem;color:var(--muted);margin-bottom:6px;">
            <span>{{ $enrollment->completed_modules }} / {{ $enrollment->course->total_modules }} modules</span>
            <span style="color:{{ $topColors[$idx] }};">{{ $pct }}%</span>
          </div>
          <div class="progress-wrap"><div class="progress-bar" style="width:{{ $pct }}%;background:{{ $topColors[$idx] }};"></div></div>
        </div>

        @if($enrollment->course->duration_weeks)
          <div style="font-size:0.72rem;color:var(--muted);"><i class="fas fa-calendar-alt" style="font-size:0.65rem;margin-right:4px;"></i> {{ $enrollment->course->duration_weeks }} weeks</div>
        @endif
      </div>
    </div>
  @empty
    <div style="grid-column:1/-1;">
      <div class="content-card" style="padding:48px;text-align:center;">
        <i class="fas fa-graduation-cap" style="font-size:2.5rem;opacity:0.2;display:block;margin-bottom:14px;color:#2563eb;"></i>
        <div style="font-size:0.9rem;color:var(--muted);">You haven't been enrolled in any courses yet.</div>
        <div style="font-size:0.8rem;color:var(--muted);margin-top:6px;">Contact your admin to get enrolled.</div>
      </div>
    </div>
  @endforelse
</div>

{{-- Detailed Progress Table --}}
@if(($enrollments ?? collect())->count() > 0)
<div class="content-card">
  <div class="content-card-header">
    <h3><i class="fas fa-list"></i> Detailed Progress</h3>
  </div>
  <div style="overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;">
      <thead>
        <tr style="border-bottom:1px solid var(--border);">
          <th style="padding:12px 20px;text-align:left;font-size:0.72rem;text-transform:uppercase;letter-spacing:0.07em;color:var(--muted);font-weight:500;">Course</th>
          <th style="padding:12px 20px;text-align:left;font-size:0.72rem;text-transform:uppercase;letter-spacing:0.07em;color:var(--muted);font-weight:500;">Modules Done</th>
          <th style="padding:12px 20px;text-align:left;font-size:0.72rem;text-transform:uppercase;letter-spacing:0.07em;color:var(--muted);font-weight:500;">Progress</th>
          <th style="padding:12px 20px;text-align:left;font-size:0.72rem;text-transform:uppercase;letter-spacing:0.07em;color:var(--muted);font-weight:500;">Last Updated</th>
          <th style="padding:12px 20px;text-align:left;font-size:0.72rem;text-transform:uppercase;letter-spacing:0.07em;color:var(--muted);font-weight:500;">Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach($enrollments as $enrollment)
          @php
            $pct = $enrollment->course->total_modules > 0
              ? round(($enrollment->completed_modules / $enrollment->course->total_modules) * 100)
              : 0;
          @endphp
          <tr style="border-bottom:1px solid rgba(37,99,235,0.06);">
            <td style="padding:14px 20px;font-size:0.84rem;font-weight:500;">{{ $enrollment->course->title }}</td>
            <td style="padding:14px 20px;font-size:0.82rem;color:var(--muted);">{{ $enrollment->completed_modules }} / {{ $enrollment->course->total_modules }}</td>
            <td style="padding:14px 20px;min-width:140px;">
              <div style="display:flex;align-items:center;gap:8px;">
                <div class="progress-wrap"><div class="progress-bar" style="width:{{ $pct }}%;"></div></div>
                <span style="font-size:0.72rem;color:var(--muted);">{{ $pct }}%</span>
              </div>
            </td>
            <td style="padding:14px 20px;font-size:0.78rem;color:var(--muted);">{{ $enrollment->updated_at->diffForHumans() }}</td>
            <td style="padding:14px 20px;">
              @if($pct == 100)
                <span class="badge badge-done">Completed</span>
              @elseif($pct == 0)
                <span class="badge badge-locked">Not Started</span>
              @else
                <span class="badge badge-active">In Progress</span>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endif

@endsection