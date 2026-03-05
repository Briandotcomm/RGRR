<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Admin') — RGRR WebMaker Philippines</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    /* ============================================================
       ROOT & RESET
    ============================================================ */
    :root {
      --bg:        #04060f;
      --surface:   #080d1c;
      --card:      #0c1228;
      --card2:     #0f1730;
      --accent:    #2563eb;
      --accent2:   #c8290a;
      --accent3:   #f5a623;
      --green:     #10b981;
      --text:      #e8eaf5;
      --muted:     #7888a8;
      --border:    rgba(37,99,235,0.18);
      --sidebar-w: 260px;
      --topbar-h:  66px;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }

    body {
      background: var(--bg);
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-weight: 300;
      min-height: 100vh;
      overflow-x: hidden;
      font-size: 15px;
    }

    body::before {
      content: '';
      position: fixed; inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
      pointer-events: none; z-index: 0; opacity: 0.2;
    }

    .shell { display: flex; min-height: 100vh; position: relative; z-index: 1; }

    /* ============================================================
       SIDEBAR
    ============================================================ */
    .sidebar {
      width: var(--sidebar-w);
      background: var(--surface);
      border-right: 1px solid var(--border);
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0; left: 0; bottom: 0;
      z-index: 50;
      transition: transform 0.3s ease;
    }

    .sidebar-brand {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 0 22px;
      height: var(--topbar-h);
      border-bottom: 1px solid var(--border);
      flex-shrink: 0;
    }

    .sidebar-logo {
      width: 38px; height: 38px;
      border-radius: 10px;
      overflow: hidden;
      background: rgba(4,6,15,0.8);
      border: 1px solid rgba(37,99,235,0.3);
      display: flex; align-items: center; justify-content: center;
      box-shadow: 0 0 14px rgba(37,99,235,0.2);
      flex-shrink: 0;
    }

    .sidebar-logo img { width: 30px; height: 30px; object-fit: contain; }

    .sidebar-brand-text { display: flex; flex-direction: column; line-height: 1.2; }

    .brand-name {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 0.9rem;
      background: linear-gradient(135deg, #60a5fa, #2563eb);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .brand-sub {
      font-size: 0.62rem;
      color: var(--muted);
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .sidebar-admin-badge {
      margin: 18px 16px 10px;
      background: rgba(37,99,235,0.1);
      border: 1px solid rgba(37,99,235,0.2);
      border-radius: 10px;
      padding: 12px 14px;
      display: flex;
      align-items: center;
      gap: 11px;
    }

    .admin-avatar {
      width: 36px; height: 36px;
      border-radius: 9px;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      display: flex; align-items: center; justify-content: center;
      font-size: 0.85rem;
      font-weight: 700;
      color: #fff;
      flex-shrink: 0;
    }

    .admin-info { display: flex; flex-direction: column; line-height: 1.25; min-width: 0; }
    .admin-name { font-size: 0.82rem; font-weight: 500; color: var(--text); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .admin-role { font-size: 0.67rem; color: #60a5fa; text-transform: uppercase; letter-spacing: 0.06em; }

    .sidebar-nav { flex: 1; overflow-y: auto; padding: 10px 12px; }
    .sidebar-nav::-webkit-scrollbar { width: 3px; }
    .sidebar-nav::-webkit-scrollbar-thumb { background: var(--border); border-radius: 2px; }

    .nav-section-label {
      font-size: 0.64rem;
      font-weight: 500;
      color: var(--muted);
      letter-spacing: 0.12em;
      text-transform: uppercase;
      padding: 16px 10px 7px;
    }

    .nav-item {
      display: flex;
      align-items: center;
      gap: 11px;
      padding: 11px 14px;
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.2s;
      margin-bottom: 3px;
      color: var(--muted);
      font-size: 0.87rem;
      text-decoration: none;
      position: relative;
    }

    .nav-item:hover { background: rgba(37,99,235,0.09); color: var(--text); }

    .nav-item.active {
      background: rgba(37,99,235,0.15);
      color: #fff;
      border: 1px solid rgba(37,99,235,0.28);
    }

    .nav-item.active .nav-icon { color: #60a5fa; }

    .nav-icon {
      width: 18px;
      text-align: center;
      font-size: 0.85rem;
      flex-shrink: 0;
    }

    .nav-badge {
      margin-left: auto;
      background: var(--accent2);
      color: #fff;
      font-size: 0.62rem;
      font-weight: 600;
      padding: 2px 7px;
      border-radius: 999px;
      line-height: 1.5;
    }

    .nav-badge.green { background: var(--green); }
    .nav-badge.gold  { background: var(--accent3); color: #111; }

    .sidebar-footer {
      padding: 14px;
      border-top: 1px solid var(--border);
    }

    .nav-logout {
      display: flex;
      align-items: center;
      gap: 11px;
      padding: 11px 14px;
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.2s;
      color: var(--muted);
      font-size: 0.87rem;
      border: none;
      background: transparent;
      width: 100%;
      text-align: left;
    }

    .nav-logout:hover { background: rgba(200,41,10,0.1); color: #f87171; }

    /* ============================================================
       TOPBAR
    ============================================================ */
    .topbar {
      position: fixed;
      top: 0;
      left: var(--sidebar-w);
      right: 0;
      height: var(--topbar-h);
      background: rgba(8,13,28,0.9);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 32px;
      z-index: 40;
    }

    .topbar-left { display: flex; align-items: center; gap: 16px; }

    .topbar-title {
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      font-size: 1.05rem;
      letter-spacing: -0.01em;
    }

    .topbar-breadcrumb { font-size: 0.78rem; color: var(--muted); margin-top: 2px; }

    .topbar-right { display: flex; align-items: center; gap: 14px; }

    .topbar-btn {
      width: 38px; height: 38px;
      border-radius: 10px;
      background: rgba(255,255,255,0.04);
      border: 1px solid var(--border);
      display: flex; align-items: center; justify-content: center;
      cursor: pointer;
      color: var(--muted);
      font-size: 0.85rem;
      transition: all 0.2s;
      position: relative;
    }

    .topbar-btn:hover { border-color: rgba(37,99,235,0.4); color: var(--text); }

    .notif-dot {
      position: absolute;
      top: 7px; right: 7px;
      width: 7px; height: 7px;
      background: var(--accent2);
      border-radius: 50%;
      border: 1px solid var(--surface);
    }

    .topbar-date { font-size: 0.78rem; color: var(--muted); }

    /* ============================================================
       MAIN CONTENT AREA
    ============================================================ */
    .main {
      margin-left: var(--sidebar-w);
      padding-top: var(--topbar-h);
      min-height: 100vh;
      flex: 1;
    }

    .page-body {
      padding: 32px 36px;
      animation: pageIn 0.35s ease both;
    }

    @keyframes pageIn {
      from { opacity: 0; transform: translateY(10px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ============================================================
       SHARED UI COMPONENTS
    ============================================================ */

    /* Page header */
    .page-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      margin-bottom: 32px;
      flex-wrap: wrap;
      gap: 14px;
    }

    .page-header h1 {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1.65rem;
      letter-spacing: -0.03em;
    }

    .page-header p { font-size: 0.87rem; color: var(--muted); margin-top: 5px; }

    /* Stat cards */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 18px;
      margin-bottom: 30px;
    }

    .stat-card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 24px 22px;
      position: relative;
      overflow: hidden;
      transition: transform 0.2s, border-color 0.2s;
    }

    .stat-card:hover { transform: translateY(-2px); border-color: rgba(37,99,235,0.35); }

    .stat-card::after {
      content: '';
      position: absolute;
      top: 0; right: 0;
      width: 90px; height: 90px;
      border-radius: 50%;
      opacity: 0.07;
      transform: translate(25px,-25px);
    }

    .stat-card.blue::after  { background: var(--accent); }
    .stat-card.red::after   { background: var(--accent2); }
    .stat-card.gold::after  { background: var(--accent3); }
    .stat-card.green::after { background: var(--green); }

    .stat-icon {
      width: 42px; height: 42px;
      border-radius: 11px;
      display: flex; align-items: center; justify-content: center;
      font-size: 0.95rem;
      margin-bottom: 16px;
    }

    .stat-icon.blue  { background: rgba(37,99,235,0.14); color: #60a5fa; }
    .stat-icon.red   { background: rgba(200,41,10,0.14); color: #f87171; }
    .stat-icon.gold  { background: rgba(245,166,35,0.14); color: #f5a623; }
    .stat-icon.green { background: rgba(16,185,129,0.14); color: #34d399; }

    .stat-value {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 2rem;
      letter-spacing: -0.04em;
      line-height: 1;
      margin-bottom: 5px;
    }

    .stat-label { font-size: 0.8rem; color: var(--muted); }

    .stat-change {
      font-size: 0.74rem;
      margin-top: 10px;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .stat-change.up   { color: #34d399; }
    .stat-change.pend { color: var(--accent3); }

    /* Content card */
    .content-card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 18px;
      overflow: hidden;
      margin-bottom: 22px;
    }

    .content-card-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px 26px;
      border-bottom: 1px solid var(--border);
      flex-wrap: wrap;
      gap: 12px;
    }

    .content-card-header h3 {
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      font-size: 0.98rem;
      display: flex;
      align-items: center;
      gap: 9px;
    }

    .content-card-header h3 i { color: #60a5fa; font-size: 0.88rem; }

    /* Filter bar */
    .filter-bar { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }

    .search-wrap { position: relative; }
    .search-wrap i {
      position: absolute;
      left: 12px; top: 50%;
      transform: translateY(-50%);
      color: var(--muted);
      font-size: 0.75rem;
      pointer-events: none;
    }

    .search-input {
      background: rgba(255,255,255,0.04);
      border: 1px solid var(--border);
      border-radius: 9px;
      padding: 9px 13px 9px 32px;
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.82rem;
      outline: none;
      width: 220px;
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    .search-input::placeholder { color: #3a4460; }
    .search-input:focus { border-color: rgba(37,99,235,0.5); box-shadow: 0 0 0 3px rgba(37,99,235,0.1); }

    .filter-select {
      background: rgba(255,255,255,0.04);
      border: 1px solid var(--border);
      border-radius: 9px;
      padding: 9px 13px;
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.82rem;
      outline: none;
      cursor: pointer;
    }

    .filter-select option { background: var(--card); }

    /* Buttons */
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      padding: 9px 18px;
      border-radius: 9px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.83rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s;
      border: none;
      white-space: nowrap;
      text-decoration: none;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--accent), #1d4ed8);
      color: #fff;
      box-shadow: 0 0 20px rgba(37,99,235,0.22);
    }
    .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 0 35px rgba(37,99,235,0.4); }

    .btn-success { background: rgba(16,185,129,0.14); color: #34d399; border: 1px solid rgba(16,185,129,0.25); }
    .btn-success:hover { background: rgba(16,185,129,0.25); }

    .btn-danger { background: rgba(200,41,10,0.12); color: #f87171; border: 1px solid rgba(200,41,10,0.25); }
    .btn-danger:hover { background: rgba(200,41,10,0.22); }

    .btn-warning { background: rgba(245,166,35,0.12); color: #f5a623; border: 1px solid rgba(245,166,35,0.25); }
    .btn-warning:hover { background: rgba(245,166,35,0.22); }

    .btn-ghost { background: transparent; color: var(--muted); border: 1px solid var(--border); }
    .btn-ghost:hover { border-color: rgba(37,99,235,0.4); color: var(--text); }

    .btn-sm { padding: 6px 12px; font-size: 0.75rem; border-radius: 7px; }

    /* Table */
    .data-table { width: 100%; border-collapse: collapse; }

    .data-table th {
      padding: 13px 18px;
      text-align: left;
      font-size: 0.72rem;
      font-weight: 500;
      color: var(--muted);
      letter-spacing: 0.08em;
      text-transform: uppercase;
      border-bottom: 1px solid var(--border);
    }

    .data-table td {
      padding: 15px 18px;
      font-size: 0.84rem;
      border-bottom: 1px solid rgba(37,99,235,0.07);
      vertical-align: middle;
    }

    .data-table tr:last-child td { border-bottom: none; }
    .data-table tr:hover td { background: rgba(37,99,235,0.04); }

    /* Member cell */
    .member-cell { display: flex; align-items: center; gap: 11px; }

    .m-avatar {
      width: 34px; height: 34px;
      border-radius: 9px;
      display: flex; align-items: center; justify-content: center;
      font-size: 0.72rem;
      font-weight: 700;
      color: #fff;
      flex-shrink: 0;
    }

    .m-name { font-weight: 500; font-size: 0.86rem; }
    .m-email { font-size: 0.73rem; color: var(--muted); }

    /* Badges */
    .badge {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 4px 11px;
      border-radius: 999px;
      font-size: 0.72rem;
      font-weight: 500;
      white-space: nowrap;
    }

    .badge::before { content: ''; width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0; }

    .badge-active   { background: rgba(16,185,129,0.12); color: #34d399; border: 1px solid rgba(16,185,129,0.22); }
    .badge-active::before { background: #34d399; }

    .badge-pending  { background: rgba(245,166,35,0.12); color: #f5a623; border: 1px solid rgba(245,166,35,0.22); }
    .badge-pending::before { background: #f5a623; }

    .badge-rejected { background: rgba(200,41,10,0.12); color: #f87171; border: 1px solid rgba(200,41,10,0.22); }
    .badge-rejected::before { background: #f87171; }

    .badge-cash  { background: rgba(37,99,235,0.12); color: #60a5fa; border: 1px solid rgba(37,99,235,0.22); }
    .badge-gcash { background: rgba(16,185,129,0.12); color: #34d399; border: 1px solid rgba(16,185,129,0.22); }
    .badge-leave { background: rgba(245,166,35,0.12); color: #f5a623; border: 1px solid rgba(245,166,35,0.22); }
    .badge-leave::before { background: #f5a623; }

    /* Progress */
    .progress-wrap {
      background: rgba(255,255,255,0.06);
      border-radius: 999px;
      height: 7px;
      overflow: hidden;
      min-width: 90px;
    }

    .progress-bar { height: 100%; border-radius: 999px; background: linear-gradient(90deg, var(--accent), #60a5fa); }
    .progress-bar.green { background: linear-gradient(90deg, var(--green), #34d399); }
    .progress-bar.gold  { background: linear-gradient(90deg, var(--accent3), #fcd34d); }

    /* Actions cell */
    .actions { display: flex; gap: 6px; flex-wrap: wrap; }

    /* Modal */
    .modal-overlay {
      position: fixed; inset: 0;
      background: rgba(4,6,15,0.85);
      backdrop-filter: blur(8px);
      z-index: 200;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .modal-overlay.open { display: flex; animation: mfadeIn 0.2s ease; }

    @keyframes mfadeIn { from { opacity: 0; } to { opacity: 1; } }

    .modal-box {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 20px;
      width: 100%;
      max-width: 520px;
      overflow: hidden;
      animation: scaleIn 0.25s ease;
      max-height: 90vh;
      overflow-y: auto;
    }

    @keyframes scaleIn { from { transform: scale(0.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }

    .modal-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 22px 26px;
      border-bottom: 1px solid var(--border);
      position: sticky; top: 0;
      background: var(--card);
      z-index: 1;
    }

    .modal-header h3 {
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      font-size: 1.02rem;
    }

    .modal-close { background: none; border: none; color: var(--muted); cursor: pointer; font-size: 1rem; transition: color 0.2s; }
    .modal-close:hover { color: var(--text); }

    .modal-body { padding: 26px; }
    .modal-footer { padding: 18px 26px; border-top: 1px solid var(--border); display: flex; justify-content: flex-end; gap: 10px; }

    /* Form elements */
    .form-group { margin-bottom: 18px; }

    .form-label {
      display: block;
      font-size: 0.75rem;
      font-weight: 500;
      color: var(--muted);
      letter-spacing: 0.05em;
      text-transform: uppercase;
      margin-bottom: 8px;
    }

    .form-input, .form-select, .form-textarea {
      width: 100%;
      background: rgba(255,255,255,0.04);
      border: 1px solid var(--border);
      border-radius: 9px;
      padding: 11px 14px;
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.87rem;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-textarea { resize: vertical; min-height: 90px; }
    .form-select option { background: var(--card); }

    .form-input:focus, .form-select:focus, .form-textarea:focus {
      border-color: rgba(37,99,235,0.55);
      box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
    }

    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

    /* Alert boxes */
    .alert {
      padding: 14px 18px;
      border-radius: 12px;
      font-size: 0.85rem;
      margin-bottom: 20px;
      display: flex;
      align-items: flex-start;
      gap: 10px;
      line-height: 1.55;
    }

    .alert i { margin-top: 2px; flex-shrink: 0; }
    .alert-info    { background: rgba(37,99,235,0.08); border: 1px solid rgba(37,99,235,0.2); color: var(--muted); }
    .alert-info i  { color: #60a5fa; }
    .alert-success { background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); color: #34d399; }
    .alert-danger  { background: rgba(200,41,10,0.1); border: 1px solid rgba(200,41,10,0.3); color: #f87171; }

    /* Skill tag */
    .skill-tag {
      display: inline-block;
      background: rgba(37,99,235,0.1);
      border: 1px solid rgba(37,99,235,0.2);
      color: #60a5fa;
      font-size: 0.72rem;
      padding: 3px 11px;
      border-radius: 999px;
      margin: 3px 2px;
    }

    /* Toggle switch */
    .setting-row {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      padding: 20px 26px;
      border-bottom: 1px solid rgba(37,99,235,0.07);
      gap: 20px;
    }

    .setting-row:last-child { border-bottom: none; }
    .setting-info h4 { font-size: 0.9rem; font-weight: 500; margin-bottom: 4px; }
    .setting-info p  { font-size: 0.8rem; color: var(--muted); line-height: 1.5; }

    .toggle { position: relative; width: 42px; height: 23px; flex-shrink: 0; }
    .toggle input { display: none; }

    .toggle-slider {
      position: absolute; inset: 0;
      background: rgba(255,255,255,0.08);
      border: 1px solid var(--border);
      border-radius: 999px;
      cursor: pointer;
      transition: 0.3s;
    }

    .toggle-slider::before {
      content: '';
      position: absolute;
      width: 17px; height: 17px;
      background: var(--muted);
      border-radius: 50%;
      top: 2px; left: 2px;
      transition: 0.3s;
    }

    .toggle input:checked + .toggle-slider { background: rgba(37,99,235,0.3); border-color: var(--accent); }
    .toggle input:checked + .toggle-slider::before { transform: translateX(19px); background: #60a5fa; }

    /* Responsive */
    @media (max-width: 1200px) {
      .stats-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
      :root { --sidebar-w: 0px; }
      .sidebar { transform: translateX(-260px); width: 260px; }
      .sidebar.open { transform: translateX(0); }
      .topbar { left: 0; }
      .main { margin-left: 0; }
      .stats-grid { grid-template-columns: 1fr 1fr; }
      .form-row { grid-template-columns: 1fr; }
      .page-body { padding: 20px 18px; }
    }
  </style>
  @stack('styles')
</head>
<body>
<div class="shell">

  {{-- ===== SIDEBAR ===== --}}
  <aside class="sidebar" id="sidebar">

    <div class="sidebar-brand">
      <div class="sidebar-logo">
        <img src="{{ asset('assets/logo_main.png') }}" alt="RGRR" onerror="this.style.display='none'"/>
      </div>
      <div class="sidebar-brand-text">
        <span class="brand-name">RGRR WebMaker</span>
        <span class="brand-sub">Admin Panel</span>
      </div>
    </div>

    <div class="sidebar-admin-badge">
      <div class="admin-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
      <div class="admin-info">
        <span class="admin-name">{{ auth()->user()->name ?? 'Administrator' }}</span>
        <span class="admin-role">Super Admin</span>
      </div>
    </div>

    <nav class="sidebar-nav">
      <div class="nav-section-label">Main</div>

      <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fas fa-home nav-icon"></i>
        <span>Dashboard</span>
      </a>

      <a href="{{ route('admin.members') }}" class="nav-item {{ request()->routeIs('admin.members*') ? 'active' : '' }}">
        <i class="fas fa-users nav-icon"></i>
        <span>Official Members</span>
        <span class="nav-badge green">{{ $officialMembersCount ?? 0 }}</span>
      </a>

      <a href="{{ route('admin.pending') }}" class="nav-item {{ request()->routeIs('admin.pending*') ? 'active' : '' }}">
        <i class="fas fa-clock nav-icon"></i>
        <span>Pending</span>
        @if(($pendingCount ?? 0) > 0)
          <span class="nav-badge">{{ $pendingCount }}</span>
        @endif
      </a>

      <div class="nav-section-label">Content</div>

      <a href="{{ route('admin.modules') }}" class="nav-item {{ request()->routeIs('admin.modules*') ? 'active' : '' }}">
        <i class="fas fa-graduation-cap nav-icon"></i>
        <span>Modules / Courses</span>
      </a>

      <a href="{{ route('admin.skills') }}" class="nav-item {{ request()->routeIs('admin.skills*') ? 'active' : '' }}">
        <i class="fas fa-star nav-icon"></i>
        <span>Member Skills</span>
      </a>

      <div class="nav-section-label">System</div>

      <a href="{{ route('admin.settings') }}" class="nav-item {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
        <i class="fas fa-cog nav-icon"></i>
        <span>Settings</span>
      </a>
    </nav>

    <div class="sidebar-footer">
      <button class="nav-logout" onclick="document.getElementById('logoutModal').classList.add('open')">
        <i class="fas fa-sign-out-alt nav-icon"></i>
        <span>Logout</span>
      </button>
    </div>

  </aside>

  {{-- ===== TOPBAR ===== --}}
  <header class="topbar">
    <div class="topbar-left">
      <button class="topbar-btn" onclick="document.getElementById('sidebar').classList.toggle('open')" id="menuBtn" style="display:none;">
        <i class="fas fa-bars"></i>
      </button>
      <div>
        <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
        <div class="topbar-breadcrumb">@yield('breadcrumb', 'Admin / Dashboard')</div>
      </div>
    </div>
    <div class="topbar-right">
      <span class="topbar-date" id="liveDate"></span>
      <div class="topbar-btn">
        <i class="fas fa-bell"></i>
        <span class="notif-dot"></span>
      </div>
    </div>
  </header>

  {{-- ===== PAGE CONTENT ===== --}}
  <main class="main">
    <div class="page-body">
      @yield('content')
    </div>
  </main>

</div>

{{-- ===== LOGOUT MODAL ===== --}}
<div class="modal-overlay" id="logoutModal">
  <div class="modal-box" style="max-width:380px;">
    <div class="modal-header">
      <h3><i class="fas fa-sign-out-alt" style="color:#f87171;margin-right:9px;"></i>Confirm Logout</h3>
      <button class="modal-close" onclick="document.getElementById('logoutModal').classList.remove('open')"><i class="fas fa-times"></i></button>
    </div>
    <div class="modal-body">
      <p style="font-size:0.9rem;color:var(--muted);line-height:1.6;">Are you sure you want to log out of the RGRR WebMaker Admin Panel?</p>
    </div>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="document.getElementById('logoutModal').classList.remove('open')">Cancel</button>
      <a href="{{ route('logout') }}" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Yes, Logout</a>
    </div>
  </div>
</div>

{{-- ===== SHARED SCRIPTS ===== --}}
<script>
  // Live date
  function updateDate() {
    document.getElementById('liveDate').textContent = new Date().toLocaleDateString('en-PH', {
      weekday: 'short', month: 'short', day: 'numeric', year: 'numeric'
    });
  }
  updateDate();
  setInterval(updateDate, 60000);

  // Modal helpers
  function openModal(id)  { document.getElementById(id).classList.add('open'); }
  function closeModal(id) { document.getElementById(id).classList.remove('open'); }

  // Close modal on overlay click
  document.querySelectorAll('.modal-overlay').forEach(el => {
    el.addEventListener('click', function(e) { if (e.target === this) this.classList.remove('open'); });
  });

  // Table search filter
  function filterTable(input, tableId) {
    const val = input.value.toLowerCase();
    document.querySelectorAll('#' + tableId + ' tbody tr').forEach(row => {
      row.style.display = row.textContent.toLowerCase().includes(val) ? '' : 'none';
    });
  }

  // Mobile sidebar
  function checkMobile() {
    const btn = document.getElementById('menuBtn');
    if (btn) btn.style.display = window.innerWidth <= 768 ? 'flex' : 'none';
  }
  checkMobile();
  window.addEventListener('resize', checkMobile);
</script>
@stack('scripts')

</body>
</html>
