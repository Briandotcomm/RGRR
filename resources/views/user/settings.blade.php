@extends('user.layout')

@section('title', 'Settings')
@section('page-title', 'Settings')
@section('breadcrumb', 'Member Portal / Settings')

@section('content')

@php 
    $u = \App\Models\User::find(1); // Mock user for testing purposes
@endphp

@if(session('success'))
  <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif
@if(session('error'))
  <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
@endif

<div class="page-header">
  <div>
    <h1>Settings</h1>
    <p>Manage your account preferences and security.</p>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:22px;">
  {{-- Change Password --}}
  <div class="content-card">
    <div class="content-card-header">
      <h3><i class="fas fa-lock"></i> Change Password</h3>
    </div>
    <form method="POST" action="{{ route('user.settings.password') }}" style="padding:24px;display:flex;flex-direction:column;gap:4px;">
      @csrf @method('PUT')
      <div class="form-group">
        <label class="form-label">Current Password</label>
        <input type="password" name="current_password" class="form-input" placeholder="Enter your current password" required/>
      </div>
      <div class="form-group">
        <label class="form-label">New Password</label>
        <input type="password" name="new_password" class="form-input" placeholder="At least 8 characters" required/>
      </div>
      <div class="form-group">
        <label class="form-label">Confirm New Password</label>
        <input type="password" name="new_password_confirmation" class="form-input" placeholder="Repeat new password" required/>
      </div>
      <div style="display:flex;justify-content:flex-end;margin-top:6px;">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Password</button>
      </div>
    </form>
  </div>

  {{-- Notification Preferences --}}
  <div class="content-card">
    <div class="content-card-header">
      <h3><i class="fas fa-bell"></i> Notification Preferences</h3>
    </div>
    <form method="POST" action="{{ route('user.settings.notifications') }}">
      @csrf @method('PUT')

      @php
        $prefs = $u->notification_preferences ?? [];
      @endphp

      @foreach([
        ['key' => 'notify_courses',      'label' => 'Course Updates',      'desc' => 'Notify me when my course progress is updated by admin.'],
        ['key' => 'notify_announcements','label' => 'Announcements',        'desc' => 'Receive general announcements from RGRR WebMaker.'],
        ['key' => 'notify_profile',      'label' => 'Profile Changes',      'desc' => 'Alert me when my profile is edited by an admin.'],
      ] as $pref)
        <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 22px;border-bottom:1px solid rgba(37,99,235,0.06);">
          <div>
            <div style="font-family:'Syne',sans-serif;font-weight:600;font-size:0.85rem;margin-bottom:3px;">{{ $pref['label'] }}</div>
            <div style="font-size:0.75rem;color:var(--muted);">{{ $pref['desc'] }}</div>
          </div>
          <label style="position:relative;display:inline-block;width:42px;height:22px;flex-shrink:0;margin-left:16px;">
            <input type="checkbox" name="{{ $pref['key'] }}" value="1"
              {{ ($prefs[$pref['key']] ?? true) ? 'checked' : '' }}
              style="opacity:0;width:0;height:0;"/>
            <span style="position:absolute;cursor:pointer;inset:0;border-radius:999px;transition:0.2s;background:rgba(255,255,255,0.1);border:1px solid var(--border);"
                  onclick="this.style.background=this.previousElementSibling.checked?'rgba(255,255,255,0.1)':'rgba(37,99,235,0.6)';"></span>
          </label>
        </div>
      @endforeach

      <div style="padding:16px 22px;">
        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save Preferences</button>
      </div>
    </form>
  </div>

  {{-- Account Info (read-only) --}}
  <div class="content-card">
    <div class="content-card-header">
      <h3><i class="fas fa-id-badge"></i> Account Information</h3>
    </div>
    <div style="padding:20px;display:flex;flex-direction:column;gap:0;">
      @php
        $info = [
          ['label' => 'Full Name',    'value' => trim(($u->first_name ?? '') . ' ' . ($u->surname ?? ''))],
          ['label' => 'Email',        'value' => $u->email ?? '—'],
          ['label' => 'School',       'value' => $u->school ?? '—'],
          ['label' => 'Year Level',   'value' => $u->year_level ?? '—'],
          ['label' => 'School Year',  'value' => $u->school_year ?? '—'],
          ['label' => 'Status',       'value' => ucfirst($u->status ?? 'active')],
          ['label' => 'Member Since', 'value' => ($u && $u->created_at) ? $u->created_at->format('M d, Y') : '—'],
        ];
      @endphp
      @foreach($info as $item)
        <div style="display:flex;justify-content:space-between;align-items:center;padding:11px 0;border-bottom:1px solid rgba(37,99,235,0.06);">
          <span style="font-size:0.78rem;color:var(--muted);">{{ $item['label'] }}</span>
          <span style="font-size:0.82rem;font-weight:500;color:var(--text);">{{ $item['value'] }}</span>
        </div>
      @endforeach
      <div style="margin-top:16px;">
        <a href="{{ route('user.profile') }}" class="btn btn-ghost btn-sm"><i class="fas fa-pen"></i> Edit Profile</a>
      </div>
    </div>
  </div>

  {{-- Danger Zone --}}
  <div class="content-card" style="border-color:rgba(200,41,10,0.2);">
    <div class="content-card-header" style="border-bottom-color:rgba(200,41,10,0.15);">
      <h3><i class="fas fa-exclamation-triangle" style="color:#f87171;"></i>
        <span style="color:#f87171;">Danger Zone</span>
      </h3>
    </div>
    <div style="padding:24px;display:flex;flex-direction:column;gap:16px;">
      <div style="background:rgba(200,41,10,0.06);border:1px solid rgba(200,41,10,0.15);border-radius:12px;padding:18px 20px;">
        <div style="font-family:'Syne',sans-serif;font-weight:600;font-size:0.85rem;margin-bottom:4px;color:#f87171;">Delete Account</div>
        <div style="font-size:0.78rem;color:var(--muted);margin-bottom:14px;line-height:1.6;">
          Permanently delete your account and all associated data. This action cannot be undone.
          Contact the admin if you need assistance.
        </div>
        <button type="button" class="btn btn-sm"
          style="background:rgba(200,41,10,0.15);color:#f87171;border:1px solid rgba(200,41,10,0.3);"
          onclick="if(confirm('Are you absolutely sure? This cannot be undone.')) document.getElementById('deleteAccountForm').submit();">
          <i class="fas fa-trash"></i> Delete My Account
        </button>
        <form id="deleteAccountForm" method="POST" action="{{ route('user.settings.delete') }}" style="display:none;">
          @csrf @method('DELETE')
        </form>
      </div>
    </div>
  </div>

</div>

@endsection