@extends('admin.layout')

@section('title', 'Pending Applications')
@section('page-title', 'Pending Applications')
@section('breadcrumb', 'Admin / Pending Applications')

@section('content')

@if(session('success'))
  <div class="alert alert-success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>
@endif
@if(session('error'))
  <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i>{{ session('error') }}</div>
@endif

<div class="page-header">
  <div>
    <h1>Pending Applications</h1>
    <p>Review applicant information, verify payments, and approve or reject registrations.</p>
  </div>
  @if($pendingCount > 0)
    <span class="badge badge-pending" style="padding:8px 16px;font-size:0.82rem;">{{ $pendingCount }} awaiting review</span>
  @endif
</div>

{{-- Stats --}}
<div class="stats-grid">

  <div class="stat-card" style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #2563eb;border-radius:16px;padding:28px 24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#2563eb;font-size:1rem;">
        <i class="fas fa-hourglass-half"></i>
      </div>
      <span style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Total Pending</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:var(--text);line-height:1;">{{ $pendingCount }}</div>
  </div>

  <div class="stat-card" style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #1d4ed8;border-radius:16px;padding:28px 24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#1d4ed8;font-size:1rem;">
        <i class="fas fa-mobile-alt"></i>
      </div>
      <span style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">GCash Payments</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:var(--text);line-height:1;">{{ $gcashCount }}</div>
  </div>

  <div class="stat-card" style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #2563eb;border-radius:16px;padding:28px 24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#2563eb;font-size:1rem;">
        <i class="fas fa-money-bill-wave"></i>
      </div>
      <span style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Cash Payments</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:var(--text);line-height:1;">{{ $cashCount }}</div>
  </div>

  <div class="stat-card" style="background:var(--card);border:1px solid rgba(37,99,235,0.22);border-top:3px solid #1d4ed8;border-radius:16px;padding:28px 24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
      <div style="width:40px;height:40px;border-radius:10px;background:rgba(37,99,235,0.12);display:flex;align-items:center;justify-content:center;color:#1d4ed8;font-size:1rem;">
        <i class="fas fa-times-circle"></i>
      </div>
      <span style="font-size:0.78rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;font-weight:500;">Rejected This Month</span>
    </div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;color:var(--text);line-height:1;">{{ $rejectedThisMonth }}</div>
  </div>

</div>

{{-- Queue table --}}
<div class="content-card">
  <div class="content-card-header">
    <h3><i class="fas fa-clock"></i> Applicant Queue</h3>
    <div class="filter-bar">
      <div class="search-wrap">
        <i class="fas fa-search"></i>
        <input type="text" class="search-input" placeholder="Search applicant…" oninput="filterTable(this,'pendingTable')"/>
      </div>
      <form method="GET" action="{{ route('admin.pending') }}" style="display:contents;">
        <select name="payment_method" class="filter-select" onchange="this.form.submit()">
          <option value="">All Payment</option>
          <option value="gcash" {{ request('payment_method') == 'gcash' ? 'selected' : '' }}>GCash</option>
          <option value="cash"  {{ request('payment_method') == 'cash'  ? 'selected' : '' }}>Cash</option>
        </select>
      </form>
    </div>
  </div>
  <div style="overflow-x:auto;">
    <table class="data-table" id="pendingTable">
      <thead>
        <tr>
          <th>Applicant</th>
          <th>School</th>
          <th>Year / SY</th>
          <th>Hours</th>
          <th>Payment</th>
          <th>Submitted</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($applicants as $applicant)
          <tr>
            <td>
              <div class="member-cell">
                <div class="m-avatar" style="background:linear-gradient(135deg,#2563eb,#1d4ed8);">
                  {{ strtoupper(substr($applicant->first_name,0,1).substr($applicant->surname,0,1)) }}
                </div>
                <div>
                  <div class="m-name">{{ $applicant->first_name }} {{ $applicant->surname }}</div>
                  <div class="m-email">{{ $applicant->email }}</div>
                </div>
              </div>
            </td>
            <td>{{ $applicant->school }}</td>
            <td>{{ $applicant->year_level }} / {{ $applicant->school_year }}</td>
            <td>{{ $applicant->hours }} hrs</td>
            <td>
              @if($applicant->payment_method === 'gcash')
                <span class="badge badge-gcash"><i class="fas fa-qrcode" style="font-size:0.65rem;"></i> GCash</span>
              @else
                <span class="badge badge-cash"><i class="fas fa-money-bill-wave" style="font-size:0.65rem;"></i> Cash</span>
              @endif
            </td>
            <td style="color:var(--muted);font-size:0.78rem;">{{ $applicant->created_at->format('M d, Y') }}</td>
            <td>
              <div class="actions">
                <button class="btn btn-warning btn-sm" onclick="openViewModal({{ $applicant->id }})">
                  <i class="fas fa-eye"></i> View
                </button>
                <form method="POST" action="{{ route('admin.pending.approve', $applicant->id) }}" style="display:inline;">
                  @csrf
                  <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Approve</button>
                </form>
                <button class="btn btn-danger btn-sm" onclick="openRejectModal({{ $applicant->id }})">
                  <i class="fas fa-times"></i> Reject
                </button>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="7" style="text-align:center;color:var(--muted);padding:36px;">🎉 No pending applications. All caught up!</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div style="padding:18px 22px;">{{ $applicants->links() }}</div>
</div>

{{-- ===== VIEW APPLICANT MODAL ===== --}}
<div class="modal-overlay" id="viewApplicantModal">
  <div class="modal-box" style="max-width:600px;">
    <div class="modal-header">
      <h3><i class="fas fa-user" style="color:#2563eb;margin-right:9px;"></i>Applicant Details — <span id="modal_name"></span></h3>
      <button class="modal-close" onclick="closeModal('viewApplicantModal')"><i class="fas fa-times"></i></button>
    </div>
    <div class="modal-body">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:20px;">
        <div><label style="font-size:0.68rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;display:block;margin-bottom:4px;">Full Name</label><span id="modal_fullname" style="font-size:0.86rem;"></span></div>
        <div><label style="font-size:0.68rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;display:block;margin-bottom:4px;">Email</label><span id="modal_email" style="font-size:0.86rem;"></span></div>
        <div><label style="font-size:0.68rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;display:block;margin-bottom:4px;">Home Address</label><span id="modal_address" style="font-size:0.86rem;"></span></div>
        <div><label style="font-size:0.68rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;display:block;margin-bottom:4px;">School</label><span id="modal_school" style="font-size:0.86rem;"></span></div>
        <div><label style="font-size:0.68rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;display:block;margin-bottom:4px;">Year Level</label><span id="modal_year_level" style="font-size:0.86rem;"></span></div>
        <div><label style="font-size:0.68rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;display:block;margin-bottom:4px;">School Year</label><span id="modal_school_year" style="font-size:0.86rem;"></span></div>
        <div><label style="font-size:0.68rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;display:block;margin-bottom:4px;">Required Hours</label><span id="modal_hours" style="font-size:0.86rem;"></span></div>
        <div><label style="font-size:0.68rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;display:block;margin-bottom:4px;">Payment Method</label><span id="modal_payment" style="font-size:0.86rem;"></span></div>
        <div id="modal_ref_wrap"><label style="font-size:0.68rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;display:block;margin-bottom:4px;">GCash Ref #</label><span id="modal_reference" style="font-size:0.86rem;"></span></div>
        <div><label style="font-size:0.68rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;display:block;margin-bottom:4px;">Submitted</label><span id="modal_submitted" style="font-size:0.86rem;"></span></div>
      </div>
      <div id="modal_proof_wrap">
        <label style="font-size:0.75rem;font-weight:500;color:var(--muted);letter-spacing:0.05em;text-transform:uppercase;display:block;margin-bottom:8px;">Proof of Payment</label>
        <img id="modal_proof_img" src="" style="width:100%;max-height:200px;object-fit:contain;border-radius:12px;background:#fff;padding:8px;" alt="Payment Proof"/>
      </div>
      <div style="margin-top:18px;">
        <label class="form-label">Admin Notes (optional)</label>
        <textarea class="form-textarea" id="modal_notes" placeholder="Add a note…"></textarea>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="closeModal('viewApplicantModal')">Close</button>
      <form method="POST" id="rejectFromViewForm" style="display:inline;">
        @csrf
        <input type="hidden" name="notes" id="reject_notes_view"/>
        <button type="submit" class="btn btn-danger"><i class="fas fa-times"></i> Reject</button>
      </form>
      <form method="POST" id="approveFromViewForm" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Approve</button>
      </form>
    </div>
  </div>
</div>

{{-- ===== REJECT WITH REASON MODAL ===== --}}
<div class="modal-overlay" id="rejectModal">
  <div class="modal-box" style="max-width:420px;">
    <div class="modal-header">
      <h3><i class="fas fa-times" style="color:#f87171;margin-right:9px;"></i>Reject Application</h3>
      <button class="modal-close" onclick="closeModal('rejectModal')"><i class="fas fa-times"></i></button>
    </div>
    <form method="POST" id="rejectForm">
      @csrf
      <div class="modal-body">
        <p style="font-size:0.86rem;color:var(--muted);margin-bottom:18px;line-height:1.6;">Please provide a reason for rejection. This will be recorded for admin reference.</p>
        <div class="form-group">
          <label class="form-label">Reason for Rejection</label>
          <textarea name="notes" class="form-textarea" placeholder="e.g. Invalid payment proof, incomplete documents…" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="closeModal('rejectModal')">Cancel</button>
        <button type="submit" class="btn btn-danger"><i class="fas fa-times"></i> Confirm Reject</button>
      </div>
    </form>
  </div>
</div>

@endsection

@push('scripts')
<script>
  const applicants = @json($applicants->items());

  function openViewModal(id) {
    const a = applicants.find(x => x.id === id);
    if (!a) return;
    document.getElementById('modal_name').textContent       = a.first_name + ' ' + a.surname;
    document.getElementById('modal_fullname').textContent   = a.first_name + ' ' + (a.middle_initial ? a.middle_initial + '. ' : '') + a.surname;
    document.getElementById('modal_email').textContent      = a.email;
    document.getElementById('modal_address').textContent    = a.address;
    document.getElementById('modal_school').textContent     = a.school;
    document.getElementById('modal_year_level').textContent = a.year_level;
    document.getElementById('modal_school_year').textContent= a.school_year;
    document.getElementById('modal_hours').textContent      = a.hours + ' hrs';
    document.getElementById('modal_payment').textContent    = a.payment_method === 'gcash' ? 'GCash' : 'Cash';
    document.getElementById('modal_submitted').textContent  = new Date(a.created_at).toLocaleDateString('en-PH', {year:'numeric',month:'short',day:'numeric'});

    const refWrap = document.getElementById('modal_ref_wrap');
    if (a.payment_method === 'gcash' && a.reference_number) {
      refWrap.style.display = 'block';
      document.getElementById('modal_reference').textContent = a.reference_number;
    } else {
      refWrap.style.display = 'none';
    }

    const proofWrap = document.getElementById('modal_proof_wrap');
    const proofImg  = document.getElementById('modal_proof_img');
    if (a.proof_of_payment) {
      proofWrap.style.display = 'block';
      proofImg.src = '/storage/' + a.proof_of_payment;
    } else {
      proofWrap.style.display = 'none';
    }

    document.getElementById('approveFromViewForm').action = `/admin/pending/${id}/approve`;
    document.getElementById('rejectFromViewForm').action  = `/admin/pending/${id}/reject`;

    openModal('viewApplicantModal');
  }

  function openRejectModal(id) {
    document.getElementById('rejectForm').action = `/admin/pending/${id}/reject`;
    openModal('rejectModal');
  }
</script>
@endpush