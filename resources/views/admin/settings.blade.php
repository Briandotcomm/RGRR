@extends('admin.layout')

@section('title', 'Settings')
@section('page-title', 'Settings')
@section('breadcrumb', 'Admin / Settings')

@section('content')

@if(session('success'))
  <div class="alert alert-success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>
@endif
@if(session('error'))
  <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i>{{ session('error') }}</div>
@endif

<div class="page-header">
  <div>
    <h1>Settings</h1>
    <p>Configure the RGRR WebMaker admin panel and system preferences.</p>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:22px;">

  {{-- ===== ACCOUNT SETTINGS ===== --}}
  <div class="content-card">
    <div class="content-card-header"><h3><i class="fas fa-user-cog"></i> Account &amp; Profile</h3></div>
    <form method="POST" action="{{ route('admin.settings.account') }}" style="padding:24px;display:flex;flex-direction:column;gap:6px;">
      @csrf @method('PUT')
      <div class="form-group">
        <label class="form-label">Admin Name</label>
        <input type="text" name="name" class="form-input" value="{{ auth()->user()->name ?? '' }}" required/>
      </div>
      <div class="form-group">
        <label class="form-label">Admin Email</label>
        <input type="email" name="email" class="form-input" value="{{ auth()->user()->email ?? '' }}" required/>
      </div>
      <div class="form-group">
        <label class="form-label">Current Password <span style="color:var(--muted);font-size:0.7rem;text-transform:none;">(required to change password)</span></label>
        <input type="password" name="current_password" class="form-input" placeholder="Enter current password"/>
      </div>
      <div class="form-group">
        <label class="form-label">New Password</label>
        <input type="password" name="new_password" class="form-input" placeholder="Leave blank to keep current"/>
      </div>
      <div class="form-group">
        <label class="form-label">Confirm New Password</label>
        <input type="password" name="new_password_confirmation" class="form-input" placeholder="Confirm new password"/>
      </div>
      <button type="submit" class="btn btn-primary" style="align-self:flex-start;margin-top:6px;">
        <i class="fas fa-save"></i> Save Changes
      </button>
    </form>
  </div>

  {{-- ===== NOTIFICATION SETTINGS ===== --}}
  <div class="content-card">
    <div class="content-card-header"><h3><i class="fas fa-bell"></i> Notifications</h3></div>
    <form method="POST" action="{{ route('admin.settings.notifications') }}">
      @csrf @method('PUT')
      <div class="setting-row">
        <div class="setting-info"><h4>New Registration Alert</h4><p>Get notified when a new applicant registers.</p></div>
        <label class="toggle"><input type="checkbox" name="notify_registration" value="1" {{ $settings['notify_registration'] ?? true ? 'checked' : '' }}/><span class="toggle-slider"></span></label>
      </div>
      <div class="setting-row">
        <div class="setting-info"><h4>Payment Submission Alert</h4><p>Notify when a new payment proof is uploaded.</p></div>
        <label class="toggle"><input type="checkbox" name="notify_payment" value="1" {{ $settings['notify_payment'] ?? true ? 'checked' : '' }}/><span class="toggle-slider"></span></label>
      </div>
      <div class="setting-row">
        <div class="setting-info"><h4>Course Completion Alert</h4><p>Notify when a member completes a course.</p></div>
        <label class="toggle"><input type="checkbox" name="notify_completion" value="1" {{ $settings['notify_completion'] ?? false ? 'checked' : '' }}/><span class="toggle-slider"></span></label>
      </div>
      <div class="setting-row">
        <div class="setting-info"><h4>Weekly Summary Email</h4><p>Receive a weekly digest of all member activity.</p></div>
        <label class="toggle"><input type="checkbox" name="notify_weekly" value="1" {{ $settings['notify_weekly'] ?? true ? 'checked' : '' }}/><span class="toggle-slider"></span></label>
      </div>
      <div class="setting-row">
        <div class="setting-info"><h4>System Alerts</h4><p>Critical system and error notifications.</p></div>
        <label class="toggle"><input type="checkbox" name="notify_system" value="1" {{ $settings['notify_system'] ?? true ? 'checked' : '' }}/><span class="toggle-slider"></span></label>
      </div>
      <div style="padding:18px 26px;border-top:1px solid var(--border);">
        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save Notifications</button>
      </div>
    </form>
  </div>

  {{-- ===== SYSTEM SETTINGS ===== --}}
  <div class="content-card">
    <div class="content-card-header"><h3><i class="fas fa-sliders-h"></i> System Preferences</h3></div>
    <form method="POST" action="{{ route('admin.settings.system') }}">
      @csrf @method('PUT')
      <div class="setting-row">
        <div class="setting-info"><h4>Registration Open</h4><p>Allow new applicants to register through the public form.</p></div>
        <label class="toggle"><input type="checkbox" name="registration_open" value="1" {{ $settings['registration_open'] ?? true ? 'checked' : '' }}/><span class="toggle-slider"></span></label>
      </div>
      <div class="setting-row">
        <div class="setting-info"><h4>GCash Payment</h4><p>Enable GCash as a payment option during registration.</p></div>
        <label class="toggle"><input type="checkbox" name="gcash_enabled" value="1" {{ $settings['gcash_enabled'] ?? true ? 'checked' : '' }}/><span class="toggle-slider"></span></label>
      </div>
      <div class="setting-row">
        <div class="setting-info"><h4>Cash Payment</h4><p>Enable walk-in cash payment at the office.</p></div>
        <label class="toggle"><input type="checkbox" name="cash_enabled" value="1" {{ $settings['cash_enabled'] ?? true ? 'checked' : '' }}/><span class="toggle-slider"></span></label>
      </div>
      <div class="setting-row">
        <div class="setting-info"><h4>Public Skills Page</h4><p>Show the Member Skills section on the public landing page.</p></div>
        <label class="toggle"><input type="checkbox" name="skills_page_visible" value="1" {{ $settings['skills_page_visible'] ?? true ? 'checked' : '' }}/><span class="toggle-slider"></span></label>
      </div>
      <div class="setting-row">
        <div class="setting-info">
          <h4>Maintenance Mode</h4>
          <p>Put the site in maintenance mode. Visitors will see a holding page.</p>
        </div>
        <label class="toggle"><input type="checkbox" name="maintenance_mode" value="1" {{ $settings['maintenance_mode'] ?? false ? 'checked' : '' }}/><span class="toggle-slider"></span></label>
      </div>
      <div style="padding:18px 26px;border-top:1px solid var(--border);">
        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save System Settings</button>
      </div>
    </form>
  </div>

  {{-- ===== SITE INFORMATION ===== --}}
  <div class="content-card">
    <div class="content-card-header"><h3><i class="fas fa-info-circle"></i> Site Information</h3></div>
    <form method="POST" action="{{ route('admin.settings.site') }}" style="padding:24px;display:flex;flex-direction:column;gap:6px;">
      @csrf @method('PUT')
      <div class="form-group">
        <label class="form-label">Site Name</label>
        <input type="text" name="site_name" class="form-input" value="{{ $settings['site_name'] ?? 'RGRR WebMaker Philippines' }}" required/>
      </div>
      <div class="form-group">
        <label class="form-label">Office Address</label>
        <input type="text" name="office_address" class="form-input" value="{{ $settings['office_address'] ?? '3rd Floor HR Building II, Quezon Ave. Corner Gomez, Lucena City' }}"/>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Contact Number</label>
          <input type="text" name="contact_number" class="form-input" value="{{ $settings['contact_number'] ?? '09996540792' }}"/>
        </div>
        <div class="form-group">
          <label class="form-label">Email Address</label>
          <input type="email" name="contact_email" class="form-input" value="{{ $settings['contact_email'] ?? '' }}"/>
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Office Hours</label>
        <input type="text" name="office_hours" class="form-input" value="{{ $settings['office_hours'] ?? 'Monday – Friday, 9:00 AM – 5:00 PM' }}"/>
      </div>
      <div class="form-group">
        <label class="form-label">Facebook Page URL</label>
        <input type="url" name="facebook_url" class="form-input" placeholder="https://facebook.com/…" value="{{ $settings['facebook_url'] ?? '' }}"/>
      </div>
      <button type="submit" class="btn btn-primary" style="align-self:flex-start;margin-top:6px;">
        <i class="fas fa-save"></i> Update Info
      </button>
    </form>
  </div>

  {{-- ===== QR CODE / GCASH ===== --}}
  <div class="content-card">
    <div class="content-card-header"><h3><i class="fas fa-qrcode"></i> GCash QR Code</h3></div>
    <div style="padding:24px;">
      <p style="font-size:0.84rem;color:var(--muted);margin-bottom:18px;line-height:1.6;">Update the GCash QR code shown to applicants during payment. The current QR code is displayed below.</p>
      <div style="display:flex;gap:24px;align-items:flex-start;flex-wrap:wrap;">
        <div style="padding:14px;background:#fff;border-radius:14px;display:inline-block;box-shadow:0 0 30px rgba(37,99,235,0.15);">
          <img src="{{ asset('assets/qrcode.jpg') }}" style="width:140px;height:140px;object-fit:contain;border-radius:8px;display:block;" alt="Current QR Code"/>
        </div>
        <div style="flex:1;min-width:200px;">
          <form method="POST" action="{{ route('admin.settings.qrcode') }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-group">
              <label class="form-label">Upload New QR Code</label>
              <label style="display:flex;align-items:center;gap:12px;background:rgba(255,255,255,0.03);border:1px dashed rgba(37,99,235,0.25);border-radius:10px;padding:14px 16px;cursor:pointer;transition:all 0.2s;" onmouseenter="this.style.borderColor='rgba(37,99,235,0.5)'" onmouseleave="this.style.borderColor='rgba(37,99,235,0.25)'">
                <input type="file" name="qrcode" accept="image/*" style="display:none;" onchange="document.getElementById('qrFileName').textContent='📎 '+this.files[0].name"/>
                <div style="width:36px;height:36px;border-radius:8px;background:rgba(37,99,235,0.12);color:#60a5fa;display:flex;align-items:center;justify-content:center;"><i class="fas fa-upload"></i></div>
                <div>
                  <div style="font-size:0.82rem;font-weight:500;">Choose image</div>
                  <div style="font-size:0.73rem;color:var(--muted);">PNG, JPG — max 2MB</div>
                </div>
              </label>
              <div id="qrFileName" style="font-size:0.74rem;color:#60a5fa;margin-top:6px;min-height:16px;"></div>
            </div>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-upload"></i> Update QR Code</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- ===== BACKUP & DATA ===== --}}
  <div class="content-card" style="grid-column:1/-1;">
    <div class="content-card-header"><h3><i class="fas fa-database"></i> Backup &amp; Data Management</h3></div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:18px;padding:22px;">

      <div style="background:var(--card2);border:1px solid rgba(37,99,235,0.18);border-top:3px solid #2563eb;border-radius:14px;padding:22px;text-align:center;">
        <div style="width:48px;height:48px;background:rgba(37,99,235,0.12);color:#60a5fa;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;margin:0 auto 14px;"><i class="fas fa-download"></i></div>
        <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:0.9rem;margin-bottom:7px;">Export Members</div>
        <div style="font-size:0.76rem;color:var(--muted);margin-bottom:16px;line-height:1.5;">Download all official member data as a CSV file.</div>
        <a href="{{ route('admin.settings.exportMembers') }}" class="btn btn-ghost btn-sm" style="width:100%;justify-content:center;"><i class="fas fa-file-csv"></i> Export CSV</a>
      </div>

      <div style="background:var(--card2);border:1px solid rgba(37,99,235,0.18);border-top:3px solid #1d4ed8;border-radius:14px;padding:22px;text-align:center;">
        <div style="width:48px;height:48px;background:rgba(37,99,235,0.12);color:#60a5fa;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;margin:0 auto 14px;"><i class="fas fa-cloud-upload-alt"></i></div>
        <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:0.9rem;margin-bottom:7px;">Database Backup</div>
        <div style="font-size:0.76rem;color:var(--muted);margin-bottom:16px;line-height:1.5;">Create a full encrypted database backup file.</div>
        <a href="{{ route('admin.settings.backup') }}" class="btn btn-ghost btn-sm" style="width:100%;justify-content:center;"><i class="fas fa-shield-alt"></i> Backup Now</a>
      </div>

      <div style="background:var(--card2);border:1px solid rgba(37,99,235,0.18);border-top:3px solid #2563eb;border-radius:14px;padding:22px;text-align:center;">
        <div style="width:48px;height:48px;background:rgba(37,99,235,0.12);color:#60a5fa;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;margin:0 auto 14px;"><i class="fas fa-trash-alt"></i></div>
        <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:0.9rem;margin-bottom:7px;">Clear Rejected</div>
        <div style="font-size:0.76rem;color:var(--muted);margin-bottom:16px;line-height:1.5;">Permanently remove all rejected applicants from the database.</div>
        <form method="POST" action="{{ route('admin.settings.clearRejected') }}" onsubmit="return confirm('This will permanently delete all rejected applicants. Are you sure?')">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm" style="width:100%;justify-content:center;"><i class="fas fa-trash"></i> Clear Data</button>
        </form>
      </div>

    </div>
  </div>

</div>

@endsection