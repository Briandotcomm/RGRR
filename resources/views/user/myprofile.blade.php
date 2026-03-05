@extends('user.layout')

@section('title', 'My Profile')
@section('page-title', 'My Profile')
@section('breadcrumb', 'Member Portal / My Profile')

@section('content')

@php $u = auth()->user(); @endphp

@if(session('success'))
  <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif
@if(session('error'))
  <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
@endif

<div class="page-header">
  <div>
    <h1>My Profile</h1>
    <p>View and update your personal information and skills.</p>
  </div>
</div>

<div style="display:grid;grid-template-columns:300px 1fr;gap:22px;align-items:start;">

  {{-- Profile Card --}}
  <div style="display:flex;flex-direction:column;gap:18px;">

    <div class="content-card" style="padding:28px 24px;text-align:center;">
      <div style="width:72px;height:72px;border-radius:18px;background:linear-gradient(135deg,var(--accent),var(--accent2));display:flex;align-items:center;justify-content:center;font-family:'Syne',sans-serif;font-weight:800;font-size:1.6rem;color:#fff;margin:0 auto 16px;box-shadow:0 0 30px rgba(37,99,235,0.35);">
        {{ strtoupper(substr($u->first_name ?? 'P', 0, 1) . substr($u->surname ?? 'M', 0, 1)) }}
      </div>
      <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:1rem;margin-bottom:4px;">
        {{ ($u->first_name ?? 'Preview') . ' ' . ($u->surname ?? 'Member') }}
      </div>
      <div style="font-size:0.78rem;color:var(--muted);margin-bottom:14px;">{{ $u->email ?? '—' }}</div>
      <span class="badge badge-active" style="font-size:0.72rem;">
        <i class="fas fa-circle" style="font-size:0.45rem;"></i>
        Active Member
      </span>
      <hr class="divider"/>
      <div style="display:flex;flex-direction:column;gap:10px;text-align:left;">
        <div style="display:flex;justify-content:space-between;font-size:0.8rem;">
          <span style="color:var(--muted);">School</span>
          <span style="font-weight:500;max-width:160px;text-align:right;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $u->school ?? '—' }}</span>
        </div>
        <div style="display:flex;justify-content:space-between;font-size:0.8rem;">
          <span style="color:var(--muted);">Year Level</span>
          <span style="font-weight:500;">{{ $u->year_level ?? '—' }}</span>
        </div>
        <div style="display:flex;justify-content:space-between;font-size:0.8rem;">
          <span style="color:var(--muted);">School Year</span>
          <span style="font-weight:500;">{{ $u->school_year ?? '—' }}</span>
        </div>
        <div style="display:flex;justify-content:space-between;font-size:0.8rem;">
          <span style="color:var(--muted);">Hours</span>
          <span style="font-weight:500;color:#60a5fa;">{{ ($u->hours ?? 0) }} hrs</span>
        </div>
        <div style="display:flex;justify-content:space-between;font-size:0.8rem;">
          <span style="color:var(--muted);">Member Since</span>
          <span style="font-weight:500;">{{ ($u && $u->created_at) ? $u->created_at->format('M Y') : '—' }}</span>
        </div>
      </div>
    </div>

    {{-- Skills preview --}}
    <div class="content-card" style="padding:20px;">
      <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:0.85rem;margin-bottom:12px;display:flex;align-items:center;gap:8px;">
        <i class="fas fa-star" style="color:#2563eb;font-size:0.8rem;"></i> My Skills
      </div>
      @php $skills = ($u && $u->skills) ? json_decode($u->skills) : []; @endphp
      @if(count($skills) > 0)
        <div style="display:flex;flex-wrap:wrap;gap:7px;">
          @foreach($skills as $skill)
            <span style="background:rgba(37,99,235,0.1);border:1px solid rgba(37,99,235,0.2);color:#93c5fd;font-size:0.72rem;padding:3px 10px;border-radius:999px;">{{ $skill }}</span>
          @endforeach
        </div>
      @else
        <p style="font-size:0.78rem;color:var(--muted);">No skills added yet. Update your profile to add skills.</p>
      @endif
    </div>

  </div>

  {{-- Edit Forms --}}
  <div style="display:flex;flex-direction:column;gap:18px;">

    {{-- Personal Info --}}
    <div class="content-card">
      <div class="content-card-header">
        <h3><i class="fas fa-user"></i> Personal Information</h3>
      </div>
      <form method="POST" action="{{ route('user.profile.update') }}" style="padding:24px;">
        @csrf @method('PUT')
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-input" value="{{ $u->first_name ?? '' }}" required/>
          </div>
          <div class="form-group">
            <label class="form-label">Surname</label>
            <input type="text" name="surname" class="form-input" value="{{ $u->surname ?? '' }}" required/>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Middle Initial</label>
            <input type="text" name="middle_initial" class="form-input" maxlength="1" value="{{ $u->middle_initial ?? '' }}" style="text-transform:uppercase;"/>
          </div>
          <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-input" value="{{ $u->email ?? '' }}" required/>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Home Address</label>
          <input type="text" name="address" class="form-input" value="{{ $u->address ?? '' }}"/>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">School Name</label>
            <input type="text" name="school" class="form-input" value="{{ $u->school ?? '' }}"/>
          </div>
          <div class="form-group">
            <label class="form-label">Year Level</label>
            <select name="year_level" class="form-select">
              @foreach(['1st Year','2nd Year','3rd Year','4th Year'] as $yr)
                <option {{ ($u->year_level ?? '') == $yr ? 'selected' : '' }}>{{ $yr }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div style="display:flex;justify-content:flex-end;margin-top:6px;">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
        </div>
      </form>
    </div>

    {{-- Bio & Skills --}}
    <div class="content-card">
      <div class="content-card-header">
        <h3><i class="fas fa-star"></i> Bio &amp; Skills</h3>
      </div>
      <form method="POST" action="{{ route('user.profile.skills') }}" style="padding:24px;">
        @csrf @method('PUT')
        <div class="form-group">
          <label class="form-label">Bio / Tagline <span style="color:var(--muted);font-size:0.7rem;text-transform:none;">(shown on public skills page if published)</span></label>
          <textarea name="bio" class="form-textarea" placeholder="A short description about yourself…">{{ $u->bio ?? '' }}</textarea>
        </div>
        <div class="form-group">
          <label class="form-label">Skills <span style="color:var(--muted);font-size:0.7rem;text-transform:none;">(comma-separated)</span></label>
          <input type="text" name="skills_raw" class="form-input"
            value="{{ ($u && $u->skills) ? implode(', ', json_decode($u->skills, true) ?? []) : '' }}"
            placeholder="HTML/CSS, JavaScript, Figma, Laravel…"/>
        </div>
        <div style="display:flex;justify-content:flex-end;margin-top:6px;">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Skills</button>
        </div>
      </form>
    </div>

  </div>
</div>

@endsection