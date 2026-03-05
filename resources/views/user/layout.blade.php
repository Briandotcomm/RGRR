<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Member Portal') — RGRR WebMaker</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    :root {
      --bg:       #04060f;
      --surface:  #080d1c;
      --card:     #0c1228;
      --card2:    #0e1530;
      --accent:   #2563eb;
      --accent2:  #1d4ed8;
      --red:      #c8290a;
      --text:     #e8eaf5;
      --muted:    #7888a8;
      --border:   rgba(37,99,235,0.18);
      --sidebar-w: 240px;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }

    body {
      background: var(--bg);
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-weight: 300;
      display: flex;
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* ---- SIDEBAR ---- */
    .sidebar {
      width: var(--sidebar-w);
      min-height: 100vh;
      background: var(--surface);
      border-right: 1px solid var(--border);
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0; left: 0; bottom: 0;
      z-index: 50;
      transition: transform 0.3s;
    }

    .sidebar-logo {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 22px 20px 18px;
      border-bottom: 1px solid var(--border);
      text-decoration: none;
    }

    .sidebar-logo img {
      width: 38px; height: 38px;
      object-fit: contain;
      border-radius: 8px;
    }

    .sidebar-logo-text .brand-rgrr {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1rem;
      background: linear-gradient(135deg, var(--accent), var(--red));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      display: block;
      line-height: 1.1;
    }

    .sidebar-logo-text .brand-sub {
      font-size: 0.65rem;
      color: var(--muted);
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    /* Member badge */
    .sidebar-member {
      padding: 16px 20px;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .sidebar-avatar {
      width: 36px; height: 36px;
      border-radius: 9px;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      font-size: 0.8rem;
      color: #fff;
      flex-shrink: 0;
    }

    .sidebar-member-info .name {
      font-size: 0.82rem;
      font-weight: 500;
      color: var(--text);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      max-width: 148px;
    }

    .sidebar-member-info .role {
      font-size: 0.68rem;
      color: var(--accent);
      background: rgba(37,99,235,0.1);
      border: 1px solid rgba(37,99,235,0.2);
      border-radius: 999px;
      padding: 1px 8px;
      display: inline-block;
      margin-top: 2px;
    }

    /* Nav links */
    .sidebar-nav {
      flex: 1;
      padding: 16px 12px;
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .nav-section-label {
      font-size: 0.62rem;
      font-weight: 500;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--muted);
      padding: 8px 8px 4px;
      margin-top: 6px;
    }

    .sidebar-link {
      display: flex;
      align-items: center;
      gap: 11px;
      padding: 10px 12px;
      border-radius: 10px;
      text-decoration: none;
      color: var(--muted);
      font-size: 0.875rem;
      font-weight: 400;
      transition: all 0.2s;
      position: relative;
    }

    .sidebar-link i { width: 16px; text-align: center; font-size: 0.85rem; flex-shrink: 0; }

    .sidebar-link:hover {
      color: var(--text);
      background: rgba(37,99,235,0.08);
    }

    .sidebar-link.active {
      color: #fff;
      background: linear-gradient(135deg, rgba(37,99,235,0.25), rgba(37,99,235,0.10));
      border: 1px solid rgba(37,99,235,0.25);
    }

    .sidebar-link.active i { color: #60a5fa; }

    .sidebar-link .notif-dot {
      margin-left: auto;
      width: 18px; height: 18px;
      border-radius: 50%;
      background: var(--red);
      color: #fff;
      font-size: 0.6rem;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .sidebar-bottom {
      padding: 12px;
      border-top: 1px solid var(--border);
    }

    .sidebar-link.logout:hover {
      color: #f87171;
      background: rgba(200,41,10,0.08);
    }

    /* ---- MAIN CONTENT ---- */
    .main-wrap {
      margin-left: var(--sidebar-w);
      flex: 1;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* Top bar */
    .topbar {
      height: 60px;
      background: rgba(8,13,28,0.85);
      backdrop-filter: blur(16px);
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 32px;
      position: sticky;
      top: 0;
      z-index: 40;
    }

    .topbar-left h2 {
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      font-size: 1rem;
      color: var(--text);
    }

    .topbar-left p {
      font-size: 0.72rem;
      color: var(--muted);
      margin-top: 1px;
    }

    .topbar-right {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .topbar-notif {
      width: 36px; height: 36px;
      border-radius: 9px;
      border: 1px solid var(--border);
      background: transparent;
      color: var(--muted);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      position: relative;
      text-decoration: none;
      transition: all 0.2s;
    }

    .topbar-notif:hover { border-color: var(--accent); color: var(--accent); }

    .topbar-notif .dot {
      position: absolute;
      top: 6px; right: 6px;
      width: 7px; height: 7px;
      border-radius: 50%;
      background: var(--red);
      border: 1.5px solid var(--surface);
    }

    /* Page content */
    .page-content {
      padding: 32px;
      flex: 1;
    }

    /* ---- SHARED COMPONENTS ---- */
    .page-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      margin-bottom: 28px;
      flex-wrap: wrap;
      gap: 14px;
    }

    .page-header h1 {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1.6rem;
      letter-spacing: -0.02em;
    }

    .page-header p { color: var(--muted); font-size: 0.875rem; margin-top: 4px; }

    /* Stats grid */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 16px;
      margin-bottom: 24px;
    }

    /* Content card */
    .content-card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 16px;
      margin-bottom: 22px;
      overflow: hidden;
    }

    .content-card-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 18px 22px;
      border-bottom: 1px solid var(--border);
    }

    .content-card-header h3 {
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      font-size: 0.9rem;
      display: flex;
      align-items: center;
      gap: 9px;
    }

    .content-card-header h3 i { color: var(--accent); font-size: 0.85rem; }

    /* Badges */
    .badge {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      font-size: 0.72rem;
      font-weight: 500;
      padding: 3px 10px;
      border-radius: 999px;
    }

    .badge-active  { background: rgba(37,99,235,0.12); color: #60a5fa; border: 1px solid rgba(37,99,235,0.22); }
    .badge-pending { background: rgba(245,166,35,0.10); color: #f5a623; border: 1px solid rgba(245,166,35,0.2); }
    .badge-done    { background: rgba(37,99,235,0.18); color: #93c5fd; border: 1px solid rgba(37,99,235,0.3); }
    .badge-locked  { background: rgba(255,255,255,0.05); color: var(--muted); border: 1px solid var(--border); }

    /* Buttons */
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.82rem;
      font-weight: 500;
      padding: 8px 18px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.2s;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      color: #fff;
      box-shadow: 0 0 20px rgba(37,99,235,0.25);
    }

    .btn-primary:hover { box-shadow: 0 0 35px rgba(37,99,235,0.45); transform: translateY(-1px); }

    .btn-ghost {
      background: transparent;
      color: var(--muted);
      border: 1px solid var(--border);
    }

    .btn-ghost:hover { color: var(--text); border-color: rgba(37,99,235,0.4); }

    .btn-sm { padding: 6px 14px; font-size: 0.78rem; }

    /* Progress bar */
    .progress-wrap {
      background: rgba(255,255,255,0.06);
      border-radius: 999px;
      height: 6px;
      overflow: hidden;
      flex: 1;
    }

    .progress-bar {
      height: 100%;
      border-radius: 999px;
      background: linear-gradient(90deg, var(--accent), #60a5fa);
      transition: width 0.4s ease;
    }

    /* Form elements */
    .form-group { margin-bottom: 16px; }
    .form-label {
      display: block;
      font-size: 0.75rem;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.07em;
      color: var(--muted);
      margin-bottom: 7px;
    }

    .form-input, .form-select, .form-textarea {
      width: 100%;
      background: rgba(255,255,255,0.04);
      border: 1px solid var(--border);
      border-radius: 9px;
      padding: 10px 14px;
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.875rem;
      outline: none;
      transition: border-color 0.2s;
    }

    .form-input:focus, .form-select:focus, .form-textarea:focus {
      border-color: var(--accent);
      background: rgba(37,99,235,0.04);
    }

    .form-textarea { resize: vertical; min-height: 90px; }
    .form-select { cursor: pointer; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

    /* Alerts */
    .alert {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px 18px;
      border-radius: 10px;
      font-size: 0.84rem;
      margin-bottom: 20px;
    }

    .alert-success { background: rgba(37,99,235,0.1); border: 1px solid rgba(37,99,235,0.25); color: #60a5fa; }
    .alert-danger  { background: rgba(200,41,10,0.1); border: 1px solid rgba(200,41,10,0.25); color: #f87171; }

    /* Divider */
    .divider { border: none; border-top: 1px solid var(--border); margin: 20px 0; }

    /* Mobile */
    @media (max-width: 768px) {
      .sidebar { transform: translateX(-100%); }
      .sidebar.open { transform: translateX(0); }
      .main-wrap { margin-left: 0; }
      .stats-grid { grid-template-columns: 1fr 1fr; }
      .page-content { padding: 20px; }
      .form-row { grid-template-columns: 1fr; }
    }

    @media (max-width: 480px) {
      .stats-grid { grid-template-columns: 1fr; }
    }
  </style>
  @stack('styles')
</head>
<body>

  <!-- ===== SIDEBAR ===== -->
  <aside class="sidebar" id="sidebar">

    <a href="{{ route('user.dashboard') }}" class="sidebar-logo">
      <img src="{{ asset('assets/logo_main.png') }}" alt="RGRR" onerror="this.style.display='none'"/>
      <div class="sidebar-logo-text">
        <span class="brand-rgrr">RGRR WebMaker</span>
        <span class="brand-sub">Member Portal</span>
      </div>
    </a>

    <div class="sidebar-member">
      <div class="sidebar-avatar">
        {{ strtoupper(substr(auth()->user()->first_name ?? 'M', 0, 1) . substr(auth()->user()->surname ?? 'E', 0, 1)) }}
      </div>
      <div class="sidebar-member-info">
        <div class="name">{{ (auth()->user()->first_name ?? 'Preview') . ' ' . (auth()->user()->surname ?? 'Member') }}</div>
        <span class="role">Active Member</span>
      </div>
    </div>

    <nav class="sidebar-nav">
      <span class="nav-section-label">Main</span>

      <a href="{{ route('user.dashboard') }}"
         class="sidebar-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
        <i class="fas fa-home"></i> Dashboard
      </a>

      <a href="{{ route('user.profile') }}"
         class="sidebar-link {{ request()->routeIs('user.profile') ? 'active' : '' }}">
        <i class="fas fa-user"></i> My Profile
      </a>

      <a href="{{ route('user.notifications') }}"
         class="sidebar-link {{ request()->routeIs('user.notifications') ? 'active' : '' }}">
        <i class="fas fa-bell"></i> Notifications
        @php $unread = auth()->user() ? (auth()->user()->unread_notifications_count ?? 0) : 0; @endphp
        @if($unread > 0)
          <span class="notif-dot">{{ $unread }}</span>
        @endif
      </a>

      <span class="nav-section-label">Learning</span>

      <a href="{{ route('user.courses') }}"
         class="sidebar-link {{ request()->routeIs('user.courses') ? 'active' : '' }}">
        <i class="fas fa-graduation-cap"></i> My Courses
      </a>

      <span class="nav-section-label">Account</span>

      <a href="{{ route('user.settings') }}"
         class="sidebar-link {{ request()->routeIs('user.settings') ? 'active' : '' }}">
        <i class="fas fa-cog"></i> Settings
      </a>
    </nav>

    <div class="sidebar-bottom">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="sidebar-link logout" style="width:100%;background:none;border:none;cursor:pointer;text-align:left;">
          <i class="fas fa-sign-out-alt"></i> Logout
        </button>
      </form>
    </div>

  </aside>

  <!-- ===== MAIN ===== -->
  <div class="main-wrap">

    <header class="topbar">
      <div class="topbar-left">
        <h2>@yield('page-title', 'Dashboard')</h2>
        <p>@yield('breadcrumb', 'Member Portal')</p>
      </div>
      <div class="topbar-right">
        <a href="{{ route('user.notifications') }}" class="topbar-notif">
          <i class="fas fa-bell" style="font-size:0.85rem;"></i>
          @if(($unread ?? 0) > 0)<span class="dot"></span>@endif
        </a>
        <div style="width:34px;height:34px;border-radius:9px;background:linear-gradient(135deg,var(--accent),var(--accent2));display:flex;align-items:center;justify-content:center;font-family:'Syne',sans-serif;font-weight:700;font-size:0.75rem;color:#fff;">
          {{ strtoupper(substr(auth()->user()->first_name ?? 'M', 0, 1) . substr(auth()->user()->surname ?? 'E', 0, 1)) }}
        </div>
      </div>
    </header>

    <main class="page-content">
      @yield('content')
    </main>

  </div>

  <script>
    // Mobile sidebar toggle
    function toggleSidebar() {
      document.getElementById('sidebar').classList.toggle('open');
    }
  </script>
  @stack('scripts')
</body>
</html>