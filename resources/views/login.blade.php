<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login — RGRR WebMaker Philippines</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    :root {
      --bg: #04060f;
      --surface: #080d1c;
      --card: #0c1228;
      --accent: #2563eb;
      --accent2: #c8290a;
      --accent3: #f5a623;
      --text: #e8eaf5;
      --muted: #7888a8;
      --border: rgba(37,99,235,0.18);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      background: var(--bg);
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-weight: 300;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      position: relative;
    }

    /* ---- BACKGROUND EFFECTS ---- */
    .bg-glow-1 {
      position: fixed;
      width: 600px; height: 600px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(37,99,235,0.12) 0%, transparent 70%);
      top: -100px; left: -100px;
      pointer-events: none;
      animation: driftA 12s ease-in-out infinite alternate;
    }

    .bg-glow-2 {
      position: fixed;
      width: 500px; height: 500px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(200,41,10,0.09) 0%, transparent 70%);
      bottom: -80px; right: -80px;
      pointer-events: none;
      animation: driftB 15s ease-in-out infinite alternate;
    }

    .bg-glow-3 {
      position: fixed;
      width: 300px; height: 300px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(245,166,35,0.07) 0%, transparent 70%);
      top: 50%; right: 20%;
      transform: translateY(-50%);
      pointer-events: none;
    }

    @keyframes driftA {
      from { transform: translate(0, 0); }
      to   { transform: translate(60px, 80px); }
    }
    @keyframes driftB {
      from { transform: translate(0, 0); }
      to   { transform: translate(-50px, -60px); }
    }

    /* Noise overlay */
    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
      pointer-events: none;
      z-index: 0;
      opacity: 0.25;
    }

    /* ---- SPLIT LAYOUT ---- */
    .login-wrapper {
      position: relative;
      z-index: 1;
      display: grid;
      grid-template-columns: 1fr 1fr;
      width: 900px;
      max-width: 95vw;
      min-height: 560px;
      border-radius: 24px;
      overflow: hidden;
      border: 1px solid var(--border);
      box-shadow: 0 0 80px rgba(37,99,235,0.12), 0 40px 80px rgba(0,0,0,0.5);
      animation: fadeUp 0.7s ease both;
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(28px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ---- LEFT PANEL ---- */
    .login-panel-left {
      background: linear-gradient(145deg, rgba(37,99,235,0.2) 0%, rgba(200,41,10,0.12) 60%, rgba(4,6,15,0.95) 100%);
      background-color: var(--surface);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 52px 40px;
      position: relative;
      overflow: hidden;
      border-right: 1px solid var(--border);
    }

    /* Spinning rings on left panel */
    .ring {
      position: absolute;
      border-radius: 50%;
      border: 1px solid rgba(37,99,235,0.15);
      animation: spin 30s linear infinite;
    }
    .ring-1 { width: 220px; height: 220px; animation-duration: 20s; }
    .ring-2 { width: 340px; height: 340px; animation-duration: 32s; animation-direction: reverse; border-color: rgba(200,41,10,0.1); }
    .ring-3 { width: 460px; height: 460px; animation-duration: 45s; border-color: rgba(245,166,35,0.07); }

    @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

    .left-logo {
      position: relative;
      z-index: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
      text-align: center;
    }

    .logo-circle {
      width: 110px; height: 110px;
      border-radius: 50%;
      background: rgba(4,6,15,0.7);
      border: 2px solid rgba(37,99,235,0.35);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      box-shadow: 0 0 40px rgba(37,99,235,0.3), 0 0 80px rgba(37,99,235,0.1);
      animation: float 4s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50%       { transform: translateY(-10px); }
    }

    .logo-circle img {
      width: 90px; height: 90px;
      object-fit: contain;
    }

    .left-brand-rgrr {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1.6rem;
      letter-spacing: -0.02em;
      background: linear-gradient(135deg, #60a5fa, #2563eb);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .left-brand-sub {
      font-size: 0.75rem;
      color: var(--muted);
      letter-spacing: 0.1em;
      text-transform: uppercase;
      margin-top: -10px;
    }

    .left-tagline {
      font-size: 0.85rem;
      color: var(--muted);
      line-height: 1.7;
      max-width: 220px;
      margin-top: 8px;
    }

    /* Divider dots */
    .left-dots {
      display: flex;
      gap: 6px;
      margin-top: 12px;
    }

    .left-dots span {
      width: 6px; height: 6px;
      border-radius: 50%;
    }

    .left-dots span:nth-child(1) { background: #2563eb; }
    .left-dots span:nth-child(2) { background: #c8290a; }
    .left-dots span:nth-child(3) { background: #f5a623; }

    /* ---- RIGHT PANEL (FORM) ---- */
    .login-panel-right {
      background: var(--card);
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 52px 44px;
    }

    .form-heading {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1.75rem;
      letter-spacing: -0.03em;
      margin-bottom: 6px;
    }

    .form-subheading {
      font-size: 0.875rem;
      color: var(--muted);
      margin-bottom: 36px;
    }

    /* Error messages */
    .alert-error {
      background: rgba(200,41,10,0.1);
      border: 1px solid rgba(200,41,10,0.3);
      border-radius: 10px;
      padding: 12px 16px;
      font-size: 0.82rem;
      color: #f87171;
      margin-bottom: 24px;
    }

    /* ---- FORM FIELDS ---- */
    .field-group {
      margin-bottom: 18px;
    }

    .field-label {
      display: block;
      font-size: 0.78rem;
      font-weight: 500;
      color: var(--muted);
      letter-spacing: 0.06em;
      text-transform: uppercase;
      margin-bottom: 8px;
    }

    .field-wrap {
      position: relative;
    }

    .field-icon {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--muted);
      font-size: 0.85rem;
      pointer-events: none;
      transition: color 0.2s;
    }

    .field-input {
      width: 100%;
      background: rgba(255,255,255,0.04);
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 13px 14px 13px 40px;
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.9rem;
      outline: none;
      transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
    }

    .field-input::placeholder { color: #4a5568; }

    .field-input:focus {
      border-color: rgba(37,99,235,0.6);
      background: rgba(37,99,235,0.05);
      box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
    }

    .field-input:focus + .field-icon,
    .field-wrap:focus-within .field-icon {
      color: #60a5fa;
    }

    /* Password toggle */
    .toggle-pw {
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: var(--muted);
      cursor: pointer;
      font-size: 0.85rem;
      padding: 0;
      transition: color 0.2s;
    }

    .toggle-pw:hover { color: var(--text); }

    /* ---- REMEMBER / FORGOT ---- */
    .form-meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 28px;
      margin-top: 4px;
    }

    .check-label {
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      font-size: 0.82rem;
      color: var(--muted);
    }

    .check-label input[type="checkbox"] {
      appearance: none;
      width: 16px; height: 16px;
      border: 1px solid var(--border);
      border-radius: 4px;
      background: transparent;
      cursor: pointer;
      position: relative;
      transition: all 0.2s;
      flex-shrink: 0;
    }

    .check-label input[type="checkbox"]:checked {
      background: var(--accent);
      border-color: var(--accent);
    }

    .check-label input[type="checkbox"]:checked::after {
      content: '';
      position: absolute;
      left: 4px; top: 1px;
      width: 5px; height: 9px;
      border: 2px solid #fff;
      border-top: none;
      border-left: none;
      transform: rotate(45deg);
    }

    .forgot-link {
      font-size: 0.82rem;
      color: #60a5fa;
      text-decoration: none;
      transition: color 0.2s;
    }

    .forgot-link:hover { color: var(--text); }

    /* ---- SUBMIT BUTTON ---- */
    .btn-submit {
      width: 100%;
      background: linear-gradient(135deg, var(--accent), #1d4ed8);
      border: none;
      border-radius: 10px;
      padding: 14px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.95rem;
      font-weight: 500;
      color: #fff;
      cursor: pointer;
      transition: all 0.25s;
      box-shadow: 0 0 30px rgba(37,99,235,0.3);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      margin-bottom: 24px;
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 0 50px rgba(37,99,235,0.5);
    }

    .btn-submit:active { transform: translateY(0); }

    /* ---- DIVIDER ---- */
    .divider {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 22px;
      color: var(--muted);
      font-size: 0.75rem;
    }

    .divider::before, .divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--border);
    }

    /* ---- BOTTOM LINKS ---- */
    .form-footer {
      text-align: center;
      font-size: 0.82rem;
      color: var(--muted);
      margin-bottom: 14px;
    }

    .form-footer a {
      color: #60a5fa;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.2s;
    }

    .form-footer a:hover { color: var(--text); }

    .btn-back {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      width: 100%;
      background: transparent;
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 11px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.82rem;
      color: var(--muted);
      text-decoration: none;
      transition: all 0.2s;
    }

    .btn-back:hover {
      border-color: rgba(37,99,235,0.4);
      color: var(--text);
      background: rgba(37,99,235,0.05);
    }

    /* ---- RESPONSIVE ---- */
    @media (max-width: 700px) {
      .login-wrapper { grid-template-columns: 1fr; width: 95vw; }
      .login-panel-left { display: none; }
      .login-panel-right { padding: 40px 28px; }
    }
  </style>
</head>
<body>

  <!-- Background glows -->
  <div class="bg-glow-1"></div>
  <div class="bg-glow-2"></div>
  <div class="bg-glow-3"></div>

  <div class="login-wrapper">

    <!-- ===== LEFT PANEL ===== -->
    <div class="login-panel-left">
      <div class="ring ring-1"></div>
      <div class="ring ring-2"></div>
      <div class="ring ring-3"></div>

      <div class="left-logo">
        <div class="logo-circle">
          <img src="{{ asset('assets/logo_main.png') }}" alt="RGRR WebMaker Logo" onerror="this.style.display='none'" />
        </div>
        <div>
          <div class="left-brand-rgrr">RGRR WebMaker</div>
          <div class="left-brand-sub">Philippines</div>
        </div>
        <p class="left-tagline">Your Digital Wizard — web &amp; IT solutions for the Filipino people.</p>
        <div class="left-dots">
          <span></span><span></span><span></span>
        </div>
      </div>
    </div>

    <!-- ===== RIGHT PANEL (FORM) ===== -->
    <div class="login-panel-right">

      <h2 class="form-heading">Welcome back</h2>
      <p class="form-subheading">Log in to your RGRR WebMaker account</p>

      {{-- Error messages --}}
      @if ($errors->any())
        <div class="alert-error">
          <i class="fas fa-exclamation-circle" style="margin-right:6px;"></i>
          {{ $errors->first() }}
        </div>
      @endif

      @if (session('error'))
        <div class="alert-error">
          <i class="fas fa-exclamation-circle" style="margin-right:6px;"></i>
          {{ session('error') }}
        </div>
      @endif

      <form method="POST" action="{{ route('login.perform') }}">
        @csrf

        <!-- Email -->
        <div class="field-group">
          <label class="field-label" for="email">Email Address</label>
          <div class="field-wrap">
            <input
              type="email"
              id="email"
              name="email"
              class="field-input"
              placeholder="you@example.com"
              value="{{ old('email') }}"
              required
              autocomplete="email"
            />
            <i class="fas fa-envelope field-icon"></i>
          </div>
        </div>

        <!-- Password -->
        <div class="field-group">
          <label class="field-label" for="password">Password</label>
          <div class="field-wrap">
            <input
              type="password"
              id="password"
              name="password"
              class="field-input"
              placeholder="••••••••"
              required
              autocomplete="current-password"
            />
            <i class="fas fa-lock field-icon"></i>
            <button type="button" class="toggle-pw" onclick="togglePassword()" id="toggleBtn">
              <i class="fas fa-eye" id="eyeIcon"></i>
            </button>
          </div>
        </div>

        <!-- Remember Me + Forgot -->
        <div class="form-meta">
          <label class="check-label">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            Remember me
          </label>
          <a href="/forgot-password" class="forgot-link">Forgot password?</a>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-submit">
          <i class="fas fa-sign-in-alt"></i> Log In
        </button>

      </form>

      <div class="divider">or</div>

      <div class="form-footer" style="margin-bottom:20px;">
        No account yet? <a href="/register">Click here to Register</a>
      </div>

      <a href="/" class="btn-back">
        Back to Landing Page
      </a>

    </div>
  </div>

  <script>
    function togglePassword() {
      const pw = document.getElementById('password');
      const icon = document.getElementById('eyeIcon');
      if (pw.type === 'password') {
        pw.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        pw.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      }
    }
  </script>

</body>
</html>
