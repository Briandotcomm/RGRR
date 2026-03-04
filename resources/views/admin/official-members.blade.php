@extends('admin.layout')

@section('title', 'Official Members')
@section('page-title', 'Official Members')
@section('breadcrumb', 'Admin / Official Members')

@section('content')

@if(session('success'))
  <div class="alert alert-success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>
@endif
@if(session('error'))
  <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i>{{ session('error') }}</div>
@endif

<div class="page-header">
  <div>
    <h1>Official Members</h1>
    <p>Manage all approved members of RGRR WebMaker Philippines.</p>
  </div>
  <button class="btn btn-primary" onclick="openModal('addMemberModal')">
    <i class="fas fa-plus"></i> Add Member
  </button>
</div>

{{-- Stats --}}
<div class="stats-grid">

  <div class="stat-card" style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #2563eb;border-radius:16px;padding:28px 24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#2563eb;font-size:1rem;">
        <i class="fas fa-users"></i>
      </div>
      <span style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Total Members</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:var(--text);line-height:1;">{{ $totalMembers }}</div>
  </div>

  <div class="stat-card" style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #1d4ed8;border-radius:16px;padding:28px 24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#1d4ed8;font-size:1rem;">
        <i class="fas fa-user-check"></i>
      </div>
      <span style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Active</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:var(--text);line-height:1;">{{ $activeMembers }}</div>
  </div>

  <div class="stat-card" style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #2563eb;border-radius:16px;padding:28px 24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#2563eb;font-size:1rem;">
        <i class="fas fa-user-clock"></i>
      </div>
      <span style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">On Leave</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:var(--text);line-height:1;">{{ $onLeaveMembers }}</div>
  </div>

  <div class="stat-card" style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #1d4ed8;border-radius:16px;padding:28px 24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#1d4ed8;font-size:1rem;">
        <i class="fas fa-graduation-cap"></i>
      </div>
      <span style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Graduated</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:var(--text);line-height:1;">{{ $graduatedMembers }}</div>
  </div>

</div>

{{-- Members table --}}
<div class="content-card">
  <div class="content-card-header">
    <h3><i class="fas fa-users"></i> Member List</h3>
    <div class="filter-bar">
      <div class="search-wrap">
        <i class="fas fa-search"></i>
        <input type="text" class="search-input" placeholder="Search name or email…" oninput="filterTable(this,'memberTable')"/>
      </div>
      <form method="GET" action="{{ route('admin.members') }}" style="display:contents;">
        <select name="status" class="filter-select" onchange="this.form.submit()">
          <option value="">All Status</option>
          <option value="active"    {{ request('status') == 'active'    ? 'selected' : '' }}>Active</option>
          <option value="on_leave"  {{ request('status') == 'on_leave'  ? 'selected' : '' }}>On Leave</option>
          <option value="graduated" {{ request('status') == 'graduated' ? 'selected' : '' }}>Graduated</option>
        </select>
        <select name="year_level" class="filter-select" onchange="this.form.submit()">
          <option value="">All Year Levels</option>
          <option value="1st Year" {{ request('year_level') == '1st Year' ? 'selected' : '' }}>1st Year</option>
          <option value="2nd Year" {{ request('year_level') == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
          <option value="3rd Year" {{ request('year_level') == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
          <option value="4th Year" {{ request('year_level') == '4th Year' ? 'selected' : '' }}>4th Year</option>
        </select>
      </form>
    </div>
  </div>
  <div style="overflow-x:auto;">
    <table class="data-table" id="memberTable">
      <thead>
        <tr>
          <th>Member</th>
          <th>School</th>
          <th>Year Level</th>
          <th>School Year</th>
          <th>Hours</th>
          <th>Progress</th>
          <th>Status</th>
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
                  <div class="m-name">{{ $member->first_name }} {{ $member->middle_initial ? $member->middle_initial.'.' : '' }} {{ $member->surname }}</div>
                  <div class="m-email">{{ $member->email }}</div>
                </div>
              </div>
            </td>
            <td>{{ $member->school }}</td>
            <td>{{ $member->year_level }}</td>
            <td>{{ $member->school_year }}</td>
            <td>{{ $member->hours }} hrs</td>
            <td>
              @php $pct = $member->progress_percent ?? 0; @endphp
              <div style="display:flex;align-items:center;gap:8px;">
                <div class="progress-wrap" style="min-width:80px;">
                  <div class="progress-bar" style="width:{{ $pct }}%;background:linear-gradient(90deg,#2563eb,#c8290a);"></div>
                </div>
                <span style="font-size:0.73rem;color:var(--muted);">{{ $pct }}%</span>
              </div>
            </td>
            <td>
              @if($member->status === 'active')
                <span class="badge badge-active">Active</span>
              @elseif($member->status === 'on_leave')
                <span class="badge badge-leave">On Leave</span>
              @else
                <span class="badge" style="background:rgba(255,255,255,0.06);color:var(--muted);border:1px solid var(--border);">Graduated</span>
              @endif
            </td>
            <td>
              <div class="actions">
                <button class="btn btn-ghost btn-sm" onclick="openEditModal({{ $member->id }})"><i class="fas fa-pen"></i></button>
                <form method="POST" action="{{ route('admin.members.destroy', $member->id) }}" style="display:inline;" onsubmit="return confirm('Delete this member?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="8" style="text-align:center;color:var(--muted);padding:36px;">No members found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div style="padding:18px 22px;">{{ $members->links() }}</div>
</div>

{{-- ===== ADD MEMBER MODAL ===== --}}
<div class="modal-overlay" id="addMemberModal">
  <div class="modal-box">
    <div class="modal-header">
      <h3><i class="fas fa-user-plus" style="color:#2563eb;margin-right:9px;"></i>Add Official Member</h3>
      <button class="modal-close" onclick="closeModal('addMemberModal')"><i class="fas fa-times"></i></button>
    </div>
    <form method="POST" action="{{ route('admin.members.store') }}">
      @csrf
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group"><label class="form-label">First Name</label><input type="text" name="first_name" class="form-input" required/></div>
          <div class="form-group"><label class="form-label">Surname</label><input type="text" name="surname" class="form-input" required/></div>
        </div>
        <div class="form-row">
          <div class="form-group"><label class="form-label">Middle Initial</label><input type="text" name="middle_initial" class="form-input" maxlength="1" style="text-transform:uppercase;text-align:center;"/></div>
          <div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-input" required/></div>
        </div>
        <div class="form-group"><label class="form-label">Home Address</label><input type="text" name="address" class="form-input" required/></div>
        <div class="form-group"><label class="form-label">School Name</label><input type="text" name="school" class="form-input" required/></div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Year Level</label>
            <select name="year_level" class="form-select">
              <option>1st Year</option><option>2nd Year</option><option>3rd Year</option><option>4th Year</option>
            </select>
          </div>
          <div class="form-group"><label class="form-label">School Year</label><input type="text" name="school_year" class="form-input" placeholder="2025-2026" required/></div>
        </div>
        <div class="form-row">
          <div class="form-group"><label class="form-label">Required Hours</label><input type="number" name="hours" class="form-input" required/></div>
          <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
              <option value="active">Active</option><option value="on_leave">On Leave</option><option value="graduated">Graduated</option>
            </select>
          </div>
        </div>
        <div class="form-group"><label class="form-label">Temporary Password</label><input type="password" name="password" class="form-input" required/></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="closeModal('addMemberModal')">Cancel</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Add Member</button>
      </div>
    </form>
  </div>
</div>

{{-- ===== EDIT MEMBER MODAL ===== --}}
<div class="modal-overlay" id="editMemberModal">
  <div class="modal-box">
    <div class="modal-header">
      <h3><i class="fas fa-pen" style="color:#2563eb;margin-right:9px;"></i>Edit Member</h3>
      <button class="modal-close" onclick="closeModal('editMemberModal')"><i class="fas fa-times"></i></button>
    </div>
    <form method="POST" id="editMemberForm">
      @csrf @method('PUT')
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group"><label class="form-label">First Name</label><input type="text" name="first_name" id="edit_first_name" class="form-input" required/></div>
          <div class="form-group"><label class="form-label">Surname</label><input type="text" name="surname" id="edit_surname" class="form-input" required/></div>
        </div>
        <div class="form-row">
          <div class="form-group"><label class="form-label">Middle Initial</label><input type="text" name="middle_initial" id="edit_middle_initial" class="form-input" maxlength="1" style="text-transform:uppercase;text-align:center;"/></div>
          <div class="form-group"><label class="form-label">Email</label><input type="email" name="email" id="edit_email" class="form-input" required/></div>
        </div>
        <div class="form-group"><label class="form-label">School Name</label><input type="text" name="school" id="edit_school" class="form-input" required/></div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Year Level</label>
            <select name="year_level" id="edit_year_level" class="form-select">
              <option>1st Year</option><option>2nd Year</option><option>3rd Year</option><option>4th Year</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" id="edit_status" class="form-select">
              <option value="active">Active</option><option value="on_leave">On Leave</option><option value="graduated">Graduated</option>
            </select>
          </div>
        </div>
        <div class="form-group"><label class="form-label">New Password <span style="color:var(--muted);font-size:0.7rem;text-transform:none;">(leave blank to keep current)</span></label><input type="password" name="password" class="form-input"/></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="closeModal('editMemberModal')">Cancel</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
      </div>
    </form>
  </div>
</div>

@endsection

@push('scripts')
<script>
  const membersData = @json($members->items());

  function openEditModal(id) {
    const member = membersData.find(m => m.id === id);
    if (!member) return;
    document.getElementById('edit_first_name').value     = member.first_name;
    document.getElementById('edit_surname').value        = member.surname;
    document.getElementById('edit_middle_initial').value = member.middle_initial ?? '';
    document.getElementById('edit_email').value          = member.email;
    document.getElementById('edit_school').value         = member.school;
    document.getElementById('edit_year_level').value     = member.year_level;
    document.getElementById('edit_status').value         = member.status;
    document.getElementById('editMemberForm').action     = `/admin/members/${id}`;
    openModal('editMemberModal');
  }
</script>
@endpush