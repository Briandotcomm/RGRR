@extends('admin.layout')

@section('title', 'Modules & Courses')
@section('page-title', 'Modules & Courses')
@section('breadcrumb', 'Admin / Modules & Courses')

@section('content')

@if(session('success'))
  <div class="alert alert-success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>
@endif
@if(session('error'))
  <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i>{{ session('error') }}</div>
@endif

<div class="page-header">
  <div>
    <h1>Modules &amp; Courses</h1>
    <p>Create and manage training courses. Monitor member progress.</p>
  </div>
  <button class="btn btn-primary" onclick="openModal('addCourseModal')">
    <i class="fas fa-plus"></i> Add Course
  </button>
</div>

{{-- Stats --}}
<div class="stats-grid">

  <div class="stat-card" style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #2563eb;border-radius:16px;padding:28px 24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#2563eb;font-size:1rem;">
        <i class="fas fa-book-open"></i>
      </div>
      <span style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Total Courses</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:var(--text);line-height:1;">{{ $totalCourses }}</div>
  </div>

  <div class="stat-card" style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #1d4ed8;border-radius:16px;padding:28px 24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#1d4ed8;font-size:1rem;">
        <i class="fas fa-user-graduate"></i>
      </div>
      <span style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Enrolled Members</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:var(--text);line-height:1;">{{ $totalEnrolled }}</div>
  </div>

  <div class="stat-card" style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #2563eb;border-radius:16px;padding:28px 24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#2563eb;font-size:1rem;">
        <i class="fas fa-tasks"></i>
      </div>
      <span style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Total Modules</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:var(--text);line-height:1;">{{ $totalModules }}</div>
  </div>

  <div class="stat-card" style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #1d4ed8;border-radius:16px;padding:28px 24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#1d4ed8;font-size:1rem;">
        <i class="fas fa-check-double"></i>
      </div>
      <span style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Completions</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:var(--text);line-height:1;">{{ $totalCompletions }}</div>
  </div>

</div>

{{-- Member Progress Tracker --}}
<div class="content-card">
  <div class="content-card-header">
    <h3><i class="fas fa-chart-line"></i> Member Progress Tracker</h3>
    <div class="filter-bar">
      <div class="search-wrap">
        <i class="fas fa-search"></i>
        <input type="text" class="search-input" placeholder="Search member…" oninput="filterTable(this,'progressTable')"/>
      </div>
      <form method="GET" action="{{ route('admin.modules') }}" style="display:contents;">
        <select name="course_id" class="filter-select" onchange="this.form.submit()">
          <option value="">All Courses</option>
          @foreach($courses as $course)
            <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
          @endforeach
        </select>
      </form>
    </div>
  </div>
  <div style="overflow-x:auto;">
    <table class="data-table" id="progressTable">
      <thead>
        <tr>
          <th>Member</th>
          <th>Course</th>
          <th>Modules Done</th>
          <th>Progress</th>
          <th>Last Active</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($enrollments as $enrollment)
          <tr>
            <td>
              <div class="member-cell">
                <div class="m-avatar" style="background:{{ $enrollment->member->avatar_color ?? 'linear-gradient(135deg,#2563eb,#1d4ed8)' }};">
                  {{ strtoupper(substr($enrollment->member->first_name,0,1).substr($enrollment->member->surname,0,1)) }}
                </div>
                <div>
                  <div class="m-name">{{ $enrollment->member->first_name }} {{ $enrollment->member->surname }}</div>
                  <div class="m-email">{{ $enrollment->member->email }}</div>
                </div>
              </div>
            </td>
            <td>{{ $enrollment->course->title }}</td>
            <td>{{ $enrollment->completed_modules }} / {{ $enrollment->course->total_modules }}</td>
            <td>
              @php $pct = $enrollment->course->total_modules > 0 ? round(($enrollment->completed_modules / $enrollment->course->total_modules) * 100) : 0; @endphp
              <div style="display:flex;align-items:center;gap:9px;">
                <div class="progress-wrap" style="min-width:100px;">
                  <div class="progress-bar" style="width:{{ $pct }}%;background:linear-gradient(90deg,#2563eb,#1d4ed8);"></div>
                </div>
                <span style="font-size:0.73rem;color:var(--muted);">{{ $pct }}%</span>
              </div>
            </td>
            <td style="color:var(--muted);font-size:0.78rem;">{{ $enrollment->updated_at->diffForHumans() }}</td>
            <td>
              @if($pct == 100)
                <span class="badge" style="background:rgba(37,99,235,0.12);color:#60a5fa;border:1px solid rgba(37,99,235,0.22);">Completed</span>
              @elseif($pct == 0)
                <span class="badge" style="background:rgba(255,255,255,0.06);color:var(--muted);border:1px solid var(--border);">Not Started</span>
              @elseif($pct < 30)
                <span class="badge badge-pending">Slow Progress</span>
              @else
                <span class="badge badge-active">In Progress</span>
              @endif
            </td>
            <td>
              <div class="actions">
                <button class="btn btn-ghost btn-sm" onclick="openUpdateProgressModal({{ $enrollment->id }}, {{ $enrollment->completed_modules }}, {{ $enrollment->course->total_modules }})">
                  <i class="fas fa-edit"></i> Update
                </button>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="7" style="text-align:center;color:var(--muted);padding:36px;">No enrollments yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div style="padding:18px 22px;">{{ $enrollments->links() }}</div>
</div>

{{-- Course Cards --}}
<div class="content-card">
  <div class="content-card-header">
    <h3><i class="fas fa-graduation-cap"></i> All Courses</h3>
  </div>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:18px;padding:22px;">
    @forelse($courses as $course)
      @php
        $iconColors = ['#60a5fa','#93c5fd','#3b82f6','#2563eb'];
        $iconBgs    = ['rgba(37,99,235,0.14)','rgba(37,99,235,0.10)','rgba(59,130,246,0.14)','rgba(29,78,216,0.14)'];
        $topColors  = ['#2563eb','#1d4ed8','#3b82f6','#60a5fa'];
        $iconClass  = ['fas fa-code','fas fa-database','fas fa-palette','fas fa-gamepad'];
        $idx        = $loop->index % 4;
      @endphp
      <div style="background:var(--card2);border:1px solid var(--border);border-radius:15px;padding:22px;position:relative;overflow:hidden;transition:all 0.2s;" onmouseenter="this.style.transform='translateY(-3px)';this.style.borderColor='rgba(37,99,235,0.35)'" onmouseleave="this.style.transform='';this.style.borderColor=''">
        <div style="position:absolute;top:0;left:0;right:0;height:3px;background:{{ $topColors[$idx] }};"></div>
        <div style="width:44px;height:44px;border-radius:11px;background:{{ $iconBgs[$idx] }};color:{{ $iconColors[$idx] }};display:flex;align-items:center;justify-content:center;font-size:1rem;margin-bottom:15px;">
          <i class="{{ $course->icon ?? $iconClass[$idx] }}"></i>
        </div>
        <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:0.9rem;margin-bottom:7px;">{{ $course->title }}</div>
        <div style="font-size:0.77rem;color:var(--muted);line-height:1.55;margin-bottom:16px;">{{ $course->description }}</div>
        <div style="display:flex;justify-content:space-between;align-items:center;">
          <div style="font-size:0.73rem;color:var(--muted);"><i class="fas fa-user" style="font-size:0.65rem;"></i> {{ $course->enrollments_count }} enrolled &nbsp;·&nbsp; {{ $course->total_modules }} modules</div>
          <div style="display:flex;gap:6px;">
            <button class="btn btn-ghost btn-sm" onclick="openEditCourseModal({{ $course->id }})"><i class="fas fa-pen"></i></button>
            <form method="POST" action="{{ route('admin.modules.destroy', $course->id) }}" style="display:inline;" onsubmit="return confirm('Delete this course?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
            </form>
          </div>
        </div>
      </div>
    @empty
      <div style="grid-column:1/-1;text-align:center;color:var(--muted);padding:36px;font-size:0.88rem;">No courses yet. Click "Add Course" to create one.</div>
    @endforelse
  </div>
</div>

{{-- ===== ADD COURSE MODAL ===== --}}
<div class="modal-overlay" id="addCourseModal">
  <div class="modal-box">
    <div class="modal-header">
      <h3><i class="fas fa-plus" style="color:#2563eb;margin-right:9px;"></i>Add New Course</h3>
      <button class="modal-close" onclick="closeModal('addCourseModal')"><i class="fas fa-times"></i></button>
    </div>
    <form method="POST" action="{{ route('admin.modules.store') }}">
      @csrf
      <div class="modal-body">
        <div class="form-group"><label class="form-label">Course Title</label><input type="text" name="title" class="form-input" placeholder="e.g. Web Dev Basics" required/></div>
        <div class="form-group"><label class="form-label">Description</label><textarea name="description" class="form-textarea" placeholder="Brief course description…" required></textarea></div>
        <div class="form-row">
          <div class="form-group"><label class="form-label">Total Modules</label><input type="number" name="total_modules" class="form-input" min="1" required/></div>
          <div class="form-group"><label class="form-label">Duration (weeks)</label><input type="number" name="duration_weeks" class="form-input" min="1"/></div>
        </div>
        <div class="form-group">
          <label class="form-label">Category</label>
          <select name="category" class="form-select">
            <option>Web Development</option>
            <option>UI/UX Design</option>
            <option>Database Systems</option>
            <option>Game Development</option>
            <option>IT Solutions</option>
            <option>WordPress</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="closeModal('addCourseModal')">Cancel</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Create Course</button>
      </div>
    </form>
  </div>
</div>

{{-- ===== EDIT COURSE MODAL ===== --}}
<div class="modal-overlay" id="editCourseModal">
  <div class="modal-box">
    <div class="modal-header">
      <h3><i class="fas fa-pen" style="color:#2563eb;margin-right:9px;"></i>Edit Course</h3>
      <button class="modal-close" onclick="closeModal('editCourseModal')"><i class="fas fa-times"></i></button>
    </div>
    <form method="POST" id="editCourseForm">
      @csrf @method('PUT')
      <div class="modal-body">
        <div class="form-group"><label class="form-label">Course Title</label><input type="text" name="title" id="ec_title" class="form-input" required/></div>
        <div class="form-group"><label class="form-label">Description</label><textarea name="description" id="ec_description" class="form-textarea" required></textarea></div>
        <div class="form-row">
          <div class="form-group"><label class="form-label">Total Modules</label><input type="number" name="total_modules" id="ec_modules" class="form-input" min="1" required/></div>
          <div class="form-group"><label class="form-label">Duration (weeks)</label><input type="number" name="duration_weeks" id="ec_duration" class="form-input" min="1"/></div>
        </div>
        <div class="form-group">
          <label class="form-label">Category</label>
          <select name="category" id="ec_category" class="form-select">
            <option>Web Development</option><option>UI/UX Design</option><option>Database Systems</option><option>Game Development</option><option>IT Solutions</option><option>WordPress</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="closeModal('editCourseModal')">Cancel</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
      </div>
    </form>
  </div>
</div>

{{-- ===== UPDATE PROGRESS MODAL ===== --}}
<div class="modal-overlay" id="updateProgressModal">
  <div class="modal-box" style="max-width:380px;">
    <div class="modal-header">
      <h3><i class="fas fa-tasks" style="color:#2563eb;margin-right:9px;"></i>Update Progress</h3>
      <button class="modal-close" onclick="closeModal('updateProgressModal')"><i class="fas fa-times"></i></button>
    </div>
    <form method="POST" id="updateProgressForm">
      @csrf @method('PUT')
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">Modules Completed <span id="progress_max_label" style="color:var(--muted);text-transform:none;font-size:0.72rem;"></span></label>
          <input type="number" name="completed_modules" id="progress_modules" class="form-input" min="0" required/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="closeModal('updateProgressModal')">Cancel</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
      </div>
    </form>
  </div>
</div>

@endsection

@push('scripts')
<script>
  const coursesData = @json($courses);

  function openEditCourseModal(id) {
    const c = coursesData.find(x => x.id === id);
    if (!c) return;
    document.getElementById('ec_title').value       = c.title;
    document.getElementById('ec_description').value = c.description;
    document.getElementById('ec_modules').value     = c.total_modules;
    document.getElementById('ec_duration').value    = c.duration_weeks ?? '';
    document.getElementById('ec_category').value    = c.category ?? 'Web Development';
    document.getElementById('editCourseForm').action = `/admin/modules/${id}`;
    openModal('editCourseModal');
  }

  function openUpdateProgressModal(enrollmentId, completed, total) {
    document.getElementById('progress_modules').value    = completed;
    document.getElementById('progress_modules').max      = total;
    document.getElementById('progress_max_label').textContent = `(max: ${total})`;
    document.getElementById('updateProgressForm').action  = `/admin/enrollments/${enrollmentId}`;
    openModal('updateProgressModal');
  }
</script>
@endpush