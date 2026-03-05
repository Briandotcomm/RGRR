@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Admin / Dashboard')

@section('content')

<div class="page-header">
  <div>
    <h1>Good morning, Admin</h1>
    <p>Here's what's happening with RGRR WebMaker Philippines today.</p>
  </div>
  <a href="{{ route('admin.pending') }}" class="btn btn-primary">
    <i class="fas fa-clock"></i> Review Pending
  </a>
</div>

{{-- Stats --}}
<div class="stats-grid">
  <div class="stat-card" style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #2563eb;border-radius:16px;padding:28px 24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#2563eb;font-size:1rem;">
        <i class="fas fa-users"></i>
      </div>
      <span style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Official Members</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:var(--text);line-height:1;">{{ $officialMembersCount }}</div>
    <div style="margin-top:10px;font-size:0.78rem;color:#2563eb;display:flex;align-items:center;gap:6px;">
      <i class="fas fa-arrow-up"></i> +{{ $newMembersThisMonth }} this month
    </div>
  </div>

  <div class="stat-card" style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #2563eb;border-radius:16px;padding:28px 24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#2563eb;font-size:1rem;">
        <i class="fas fa-clock"></i>
      </div>
      <span style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Pending Approval</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:var(--text);line-height:1;">{{ $pendingCount }}</div>
    <div style="margin-top:10px;font-size:0.78rem;color:#c8290a;display:flex;align-items:center;gap:6px;">
      <i class="fas fa-exclamation-circle"></i> Needs review
    </div>
  </div>

  <div class="stat-card" style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #1d4ed8;border-radius:16px;padding:28px 24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#2563eb;font-size:1rem;">
        <i class="fas fa-graduation-cap"></i>
      </div>
      <span style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Active Courses</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:var(--text);line-height:1;">{{ $courseCount }}</div>
    <div style="margin-top:10px;font-size:0.78rem;color:#2563eb;display:flex;align-items:center;gap:6px;">
      <i class="fas fa-book-open"></i> Total courses
    </div>
  </div>

  <div class="stat-card" style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #1d4ed8;border-radius:16px;padding:28px 24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#1d4ed8;font-size:1rem;">
        <i class="fas fa-peso-sign"></i>
      </div>
      <span style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Revenue This Month</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:var(--text);line-height:1;">₱{{ number_format($revenueThisMonth) }}</div>
    <div style="margin-top:10px;font-size:0.78rem;color:#ef4444;display:flex;align-items:center;gap:6px;">
      <i class="fas fa-arrow-up"></i> GCash + Cash
    </div>
  </div>
</div>

{{-- Registration Chart --}}
<div class="content-card">
  <div class="content-card-header">
    <h3><i class="fas fa-chart-bar"></i> Member Registrations (Last 7 Months)</h3>
  </div>
  <div style="padding:24px;">
    <div style="height:180px;background:rgba(37,99,235,0.04);border-radius:12px;display:flex;align-items:flex-end;justify-content:center;gap:10px;padding:18px;overflow:hidden;">
      @foreach($monthlyRegistrations as $month)
        <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:6px;">
          <div style="width:100%;border-radius:5px 5px 0 0;background:linear-gradient(to top,{{ $loop->last ? '#c8290a,rgba(200,41,10,0.4)' : '#2563eb,rgba(37,99,235,0.3)' }});height:{{ $month['percent'] }}%;min-height:6px;transition:opacity 0.2s;" title="{{ $month['count'] }} registrations"></div>
        </div>
      @endforeach
    </div>
    <div style="display:flex;justify-content:space-around;margin-top:10px;font-size:0.72rem;color:var(--muted);padding:0 4px;">
      @foreach($monthlyRegistrations as $month)
        <span>{{ $month['label'] }}</span>
      @endforeach
    </div>
  </div>
</div>

{{-- Recent Members --}}
<div class="content-card" style="margin-top:4px;">
  <div class="content-card-header">
    <h3><i class="fas fa-users"></i> Recent Members</h3>
    <a href="{{ route('admin.members') }}" class="btn btn-ghost btn-sm">View All</a>
  </div>
  <div style="overflow-x:auto;">
    <table class="data-table">
      <thead>
        <tr>
          <th>Member</th>
          <th>School</th>
          <th>Year Level</th>
          <th>Joined</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @forelse($recentMembers as $member)
          <tr>
            <td>
              <div class="member-cell">
                <div class="m-avatar" style="background:{{ $member->avatar_color ?? 'linear-gradient(135deg,#2563eb','#c8290a)' }};">
                  {{ strtoupper(substr($member->first_name, 0, 1) . substr($member->surname, 0, 1)) }}
                </div>
                <div>
                  <div class="m-name">{{ $member->first_name }} {{ $member->surname }}</div>
                  <div class="m-email">{{ $member->email }}</div>
                </div>
              </div>
            </td>
            <td>{{ $member->school_name }}</td>
            <td>{{ $member->year_level }}</td>
            <td style="color:var(--muted);font-size:0.78rem;">{{ $member->created_at->format('M d, Y') }}</td>
            <td><span class="badge badge-active">Active</span></td>
          </tr>
        @empty
          <tr><td colspan="5" style="text-align:center;color:var(--muted);padding:28px;">No members yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection