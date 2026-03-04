@extends('admin.layout')

@section('title', 'Member Skills')
@section('page-title', 'Member Skills')
@section('breadcrumb', 'Admin / Member Skills')

@section('content')

@if(session('success'))
  <div class="alert alert-success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>
@endif

<div class="page-header">
  <div>
    <h1>Member Skills</h1>
    <p>Manage and publish member skill profiles to the public landing page.</p>
  </div>
  <button class="btn btn-primary" onclick="openModal('bulkPublishModal')">
    <i class="fas fa-globe"></i> Publish to Landing Page
  </button>
</div>

{{-- Stats --}}
<div class="stats-grid">

  <div class="stat-card" style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #2563eb;border-radius:16px;padding:28px 24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#2563eb;font-size:1rem;">
        <i class="fas fa-star"></i>
      </div>
      <span style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Skill Profiles</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:var(--text);line-height:1;">{{ $totalProfiles }}</div>
  </div>

  <div class="stat-card" style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #1d4ed8;border-radius:16px;padding:28px 24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#1d4ed8;font-size:1rem;">
        <i class="fas fa-check-circle"></i>
      </div>
      <span style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Published</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:var(--text);line-height:1;">{{ $publishedProfiles }}</div>
  </div>

  <div class="stat-card" style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #2563eb;border-radius:16px;padding:28px 24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#2563eb;font-size:1rem;">
        <i class="fas fa-eye-slash"></i>
      </div>
      <span style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Unpublished</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:var(--text);line-height:1;">{{ $unpublishedProfiles }}</div>
  </div>

  <div class="stat-card" style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #1d4ed8;border-radius:16px;padding:28px 24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#1d4ed8;font-size:1rem;">
        <i class="fas fa-tools"></i>
      </div>
      <span style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Skills Logged</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:var(--text);line-height:1;">{{ $totalSkillsLogged }}</div>
  </div>

</div>

{{-- Skills table --}}
<div class="content-card">
  <div class="content-card-header">
    <h3><i class="fas fa-star"></i> Member Skill Profiles</h3>
    <div class="filter-bar">
      <div class="search-wrap">
        <i class="fas fa-search"></i>
        <input type="text" class="search-input" placeholder="Search member…" oninput="filterTable(this,'skillsTable')"/>
      </div>
      <form method="GET" action="{{ route('admin.skills') }}" style="display:contents;">
        <select name="published" class="filter-select" onchange="this.form.submit()">
          <option value="">All</option>
          <option value="1" {{ request('published') === '1' ? 'selected' : '' }}>Published</option>
          <option value="0" {{ request('published') === '0' ? 'selected' : '' }}>Unpublished</option>
        </select>
      </form>
    </div>
  </div>
  <div style="overflow-x:auto;">
    <table class="data-table" id="skillsTable">
      <thead>
        <tr>
          <th>Member</th>
          <th>Skills</th>
          <th>Bio</th>
          <th>Courses Done</th>
          <th>Published</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($members as $member)
          <tr>
            <td>
              <div class="member-cell">
                <div class="m-avatar" style="background:{{ $member->avatar_color ?? 'linear-gradient(135deg,#2563eb,#c8290a)' }};">
                  {{ strtoupper(substr($member->first_name,0,1).substr($member->surname,0,1)) }}
                </div>
                <div>
                  <div class="m-name">{{ $member->first_name }} {{ $member->surname }}</div>
                  <div class="m-email">{{ $member->email }}</div>
                </div>
              </div>
            </td>
            <td>
              @if($member->skills && count(json_decode($member->skills)) > 0)
                @foreach(json_decode($member->skills) as $skill)
                  <span class="skill-tag">{{ $skill }}</span>
                @endforeach
              @else
                <span style="font-size:0.78rem;color:var(--muted);">No skills added</span>
              @endif
            </td>
            <td style="max-width:200px;font-size:0.78rem;color:var(--muted);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
              {{ $member->bio ?? '—' }}
            </td>
            <td style="font-size:0.82rem;">{{ $member->completed_courses_count ?? 0 }} courses</td>
            <td>
              @if($member->is_published)
                <span class="badge badge-active">Published</span>
              @else
                <span class="badge" style="background:rgba(255,255,255,0.06);color:var(--muted);border:1px solid var(--border);">Unpublished</span>
              @endif
            </td>
            <td>
              <div class="actions">
                <button class="btn btn-ghost btn-sm" onclick="openEditSkillModal({{ $member->id }})">
                  <i class="fas fa-pen"></i> Edit
                </button>
                @if($member->is_published)
                  <form method="POST" action="{{ route('admin.skills.unpublish', $member->id) }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-eye-slash"></i> Unpublish</button>
                  </form>
                @else
                  <form method="POST" action="{{ route('admin.skills.publish', $member->id) }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-globe"></i> Publish</button>
                  </form>
                @endif
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:36px;">No member profiles yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div style="padding:18px 22px;">{{ $members->links() }}</div>
</div>

{{-- ===== EDIT SKILL MODAL ===== --}}
<div class="modal-overlay" id="editSkillModal">
  <div class="modal-box">
    <div class="modal-header">
      <h3><i class="fas fa-star" style="color:#2563eb;margin-right:9px;"></i>Edit Member Skills — <span id="es_name"></span></h3>
      <button class="modal-close" onclick="closeModal('editSkillModal')"><i class="fas fa-times"></i></button>
    </div>
    <form method="POST" id="editSkillForm">
      @csrf @method('PUT')
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">Skills <span style="color:var(--muted);font-size:0.72rem;text-transform:none;">(comma-separated)</span></label>
          <input type="text" name="skills_raw" id="es_skills" class="form-input" placeholder="HTML/CSS, JavaScript, Figma"/>
        </div>
        <div class="form-group">
          <label class="form-label">Bio / Tagline <span style="color:var(--muted);font-size:0.72rem;text-transform:none;">(shown on landing page)</span></label>
          <textarea name="bio" id="es_bio" class="form-textarea" placeholder="Short description shown publicly…"></textarea>
        </div>
        <div class="form-group">
          <label class="form-label">Visibility</label>
          <select name="is_published" id="es_published" class="form-select">
            <option value="1">Published — Visible on landing page</option>
            <option value="0">Unpublished — Hidden</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="closeModal('editSkillModal')">Cancel</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-globe"></i> Save &amp; Update</button>
      </div>
    </form>
  </div>
</div>

{{-- ===== BULK PUBLISH MODAL ===== --}}
<div class="modal-overlay" id="bulkPublishModal">
  <div class="modal-box" style="max-width:480px;">
    <div class="modal-header">
      <h3><i class="fas fa-globe" style="color:#2563eb;margin-right:9px;"></i>Publish to Landing Page</h3>
      <button class="modal-close" onclick="closeModal('bulkPublishModal')"><i class="fas fa-times"></i></button>
    </div>
    <form method="POST" action="{{ route('admin.skills.bulkPublish') }}">
      @csrf
      <div class="modal-body">
        <p style="font-size:0.86rem;color:var(--muted);margin-bottom:18px;line-height:1.6;">Select which members to feature in the <strong style="color:var(--text);">Member Skills</strong> section of the public landing page.</p>
        <div style="display:flex;flex-direction:column;gap:12px;max-height:300px;overflow-y:auto;">
          @foreach($allMembers as $member)
            <label style="display:flex;align-items:center;gap:12px;cursor:pointer;padding:10px 14px;border-radius:9px;border:1px solid var(--border);transition:background 0.2s;" onmouseenter="this.style.background='rgba(37,99,235,0.06)'" onmouseleave="this.style.background=''">
              <input type="checkbox" name="member_ids[]" value="{{ $member->id }}" {{ $member->is_published ? 'checked' : '' }} style="accent-color:#2563eb;width:15px;height:15px;"/>
              <div class="m-avatar" style="background:{{ $member->avatar_color ?? 'linear-gradient(135deg,#2563eb,#c8290a)' }};width:28px;height:28px;border-radius:7px;font-size:0.65rem;">
                {{ strtoupper(substr($member->first_name,0,1).substr($member->surname,0,1)) }}
              </div>
              <div>
                <div style="font-size:0.84rem;font-weight:500;">{{ $member->first_name }} {{ $member->surname }}</div>
                <div style="font-size:0.72rem;color:var(--muted);">
                  @if($member->skills)
                    {{ implode(', ', array_slice(json_decode($member->skills), 0, 3)) }}
                  @else
                    No skills added yet
                  @endif
                </div>
              </div>
            </label>
          @endforeach
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="closeModal('bulkPublishModal')">Cancel</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Apply &amp; Publish</button>
      </div>
    </form>
  </div>
</div>

@endsection

@push('scripts')
<script>
  const membersData = @json($members->items());

  function openEditSkillModal(id) {
    const m = membersData.find(x => x.id === id);
    if (!m) return;
    document.getElementById('es_name').textContent    = m.first_name + ' ' + m.surname;
    document.getElementById('es_skills').value         = m.skills ? JSON.parse(m.skills).join(', ') : '';
    document.getElementById('es_bio').value            = m.bio ?? '';
    document.getElementById('es_published').value      = m.is_published ? '1' : '0';
    document.getElementById('editSkillForm').action    = `/admin/skills/${id}`;
    openModal('editSkillModal');
  }
</script>
@endpush