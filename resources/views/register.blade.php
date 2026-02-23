<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register — RGRR WebMaker Philippines</title>
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

    html { scroll-behavior: smooth; }

    body {
      background: var(--bg);
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-weight: 300;
      min-height: 100vh;
      display: flex;
      align-items: flex-start;
      justify-content: center;
      padding: 40px 20px;
      position: relative;
      overflow-x: hidden;
    }

    /* ---- BACKGROUND EFFECTS ---- */
    .bg-glow-1 {
      position: fixed;
      width: 600px; height: 600px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(37,99,235,0.1) 0%, transparent 70%);
      top: -100px; left: -100px;
      pointer-events: none;
      animation: driftA 14s ease-in-out infinite alternate;
    }

    .bg-glow-2 {
      position: fixed;
      width: 500px; height: 500px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(200,41,10,0.08) 0%, transparent 70%);
      bottom: -80px; right: -80px;
      pointer-events: none;
      animation: driftB 18s ease-in-out infinite alternate;
    }

    .bg-glow-3 {
      position: fixed;
      width: 350px; height: 350px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(245,166,35,0.06) 0%, transparent 70%);
      top: 40%; left: 60%;
      pointer-events: none;
    }

    @keyframes driftA {
      from { transform: translate(0, 0); }
      to   { transform: translate(70px, 90px); }
    }
    @keyframes driftB {
      from { transform: translate(0, 0); }
      to   { transform: translate(-60px, -70px); }
    }

    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
      pointer-events: none;
      z-index: 0;
      opacity: 0.25;
    }

    /* ---- MAIN WRAPPER ---- */
    .register-wrapper {
      position: relative;
      z-index: 1;
      width: 100%;
      max-width: 680px;
      animation: fadeUp 0.7s ease both;
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(28px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ---- HEADER ---- */
    .reg-header {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 32px;
    }

    .reg-logo-wrap {
      width: 54px; height: 54px;
      border-radius: 14px;
      background: rgba(4,6,15,0.8);
      border: 1px solid rgba(37,99,235,0.3);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      box-shadow: 0 0 25px rgba(37,99,235,0.2);
      flex-shrink: 0;
    }

    .reg-logo-wrap img {
      width: 44px; height: 44px;
      object-fit: contain;
    }

    .reg-brand {
      display: flex;
      flex-direction: column;
    }

    .reg-brand-name {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1.1rem;
      background: linear-gradient(135deg, #60a5fa, #2563eb);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      letter-spacing: -0.02em;
    }

    .reg-brand-sub {
      font-size: 0.7rem;
      color: var(--muted);
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    /* ---- CARD ---- */
    .reg-card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 0 60px rgba(37,99,235,0.08), 0 30px 60px rgba(0,0,0,0.4);
    }

    /* Step bar at top of card */
    .reg-topbar {
      height: 3px;
      background: linear-gradient(90deg, var(--accent), var(--accent2), var(--accent3));
    }

    .reg-card-body {
      padding: 40px 44px 44px;
    }

    .reg-title {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1.6rem;
      letter-spacing: -0.03em;
      margin-bottom: 6px;
    }

    .reg-subtitle {
      font-size: 0.875rem;
      color: var(--muted);
      margin-bottom: 36px;
    }

    /* ---- ERROR ALERT ---- */
    .alert-error {
      background: rgba(200,41,10,0.1);
      border: 1px solid rgba(200,41,10,0.3);
      border-radius: 10px;
      padding: 12px 16px;
      font-size: 0.82rem;
      color: #f87171;
      margin-bottom: 28px;
    }

    /* ---- SECTION DIVIDERS ---- */
    .form-section {
      margin-bottom: 28px;
    }

    .section-label {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 0.72rem;
      font-weight: 500;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--accent);
      margin-bottom: 16px;
    }

    .section-label::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--border);
    }

    .section-label i {
      font-size: 0.75rem;
    }

    /* ---- FIELD ROWS ---- */
    .field-row {
      display: grid;
      gap: 14px;
      margin-bottom: 14px;
    }

    .field-row.cols-3 { grid-template-columns: 1fr 1fr 80px; }
    .field-row.cols-2 { grid-template-columns: 1fr 1fr; }
    .field-row.cols-3-equal { grid-template-columns: 1fr 1fr 1fr; }
    .field-row.cols-1 { grid-template-columns: 1fr; }

    /* ---- FIELD STYLES ---- */
    .field-group {
      display: flex;
      flex-direction: column;
      gap: 7px;
    }

    .field-label {
      font-size: 0.74rem;
      font-weight: 500;
      color: var(--muted);
      letter-spacing: 0.05em;
      text-transform: uppercase;
    }

    .field-wrap {
      position: relative;
    }

    .field-icon {
      position: absolute;
      left: 13px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--muted);
      font-size: 0.8rem;
      pointer-events: none;
      transition: color 0.2s;
    }

    .field-input,
    .field-select {
      width: 100%;
      background: rgba(255,255,255,0.04);
      border: 1px solid var(--border);
      border-radius: 9px;
      padding: 11px 13px 11px 36px;
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.875rem;
      outline: none;
      transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
      appearance: none;
    }

    .field-input.no-icon,
    .field-select.no-icon {
      padding-left: 13px;
    }

    .field-input::placeholder { color: #3a4460; }

    .field-input:focus,
    .field-select:focus {
      border-color: rgba(37,99,235,0.55);
      background: rgba(37,99,235,0.05);
      box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
    }

    .field-wrap:focus-within .field-icon { color: #60a5fa; }

    /* Select arrow */
    .select-wrap::after {
      content: '\f107';
      font-family: 'Font Awesome 6 Free';
      font-weight: 900;
      position: absolute;
      right: 13px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--muted);
      pointer-events: none;
      font-size: 0.75rem;
    }

    .field-select option {
      background: var(--card);
      color: var(--text);
    }

    /* hours suffix */
    .field-suffix {
      position: absolute;
      right: 13px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 0.75rem;
      color: var(--muted);
      pointer-events: none;
    }

    /* password toggle */
    .toggle-pw {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: var(--muted);
      cursor: pointer;
      font-size: 0.8rem;
      padding: 0;
      transition: color 0.2s;
    }
    .toggle-pw:hover { color: var(--text); }

    /* ---- FILE UPLOAD ---- */
    .file-label {
      display: flex;
      align-items: center;
      gap: 12px;
      background: rgba(255,255,255,0.03);
      border: 1px dashed rgba(37,99,235,0.25);
      border-radius: 9px;
      padding: 14px 16px;
      cursor: pointer;
      transition: all 0.2s;
    }

    .file-label:hover {
      border-color: rgba(37,99,235,0.5);
      background: rgba(37,99,235,0.05);
    }

    .file-label input[type="file"] {
      display: none;
    }

    .file-icon-wrap {
      width: 36px; height: 36px;
      border-radius: 8px;
      background: rgba(37,99,235,0.12);
      color: #60a5fa;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.9rem;
      flex-shrink: 0;
    }

    .file-text strong {
      display: block;
      font-size: 0.82rem;
      font-weight: 500;
      color: var(--text);
      margin-bottom: 2px;
    }

    .file-text span {
      font-size: 0.74rem;
      color: var(--muted);
    }

    .file-name-display {
      font-size: 0.74rem;
      color: #60a5fa;
      margin-top: 6px;
      padding-left: 4px;
      min-height: 16px;
    }

    /* ---- TERMS ---- */
    .terms-row {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      padding: 16px 18px;
      background: rgba(37,99,235,0.04);
      border: 1px solid var(--border);
      border-radius: 10px;
      margin-bottom: 28px;
    }

    .terms-check {
      appearance: none;
      width: 18px; height: 18px;
      border: 1px solid var(--border);
      border-radius: 5px;
      background: transparent;
      cursor: pointer;
      position: relative;
      flex-shrink: 0;
      margin-top: 1px;
      transition: all 0.2s;
    }

    .terms-check:checked {
      background: var(--accent);
      border-color: var(--accent);
    }

    .terms-check:checked::after {
      content: '';
      position: absolute;
      left: 5px; top: 2px;
      width: 5px; height: 9px;
      border: 2px solid #fff;
      border-top: none;
      border-left: none;
      transform: rotate(45deg);
    }

    .terms-text {
      font-size: 0.82rem;
      color: var(--muted);
      line-height: 1.6;
    }

    .terms-text a {
      color: #60a5fa;
      text-decoration: none;
      transition: color 0.2s;
    }

    .terms-text a:hover { color: var(--text); }

    /* ---- BUTTONS ---- */
    .btn-row {
      display: flex;
      gap: 14px;
    }

    .btn-back {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 7px;
      flex: 0 0 auto;
      background: transparent;
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 13px 22px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.875rem;
      color: var(--muted);
      text-decoration: none;
      transition: all 0.2s;
    }

    .btn-back:hover {
      border-color: rgba(37,99,235,0.4);
      color: var(--text);
      background: rgba(37,99,235,0.05);
    }

    .btn-submit {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      background: linear-gradient(135deg, var(--accent), #1d4ed8);
      border: none;
      border-radius: 10px;
      padding: 13px 24px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.95rem;
      font-weight: 500;
      color: #fff;
      cursor: pointer;
      transition: all 0.25s;
      box-shadow: 0 0 30px rgba(37,99,235,0.3);
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 0 50px rgba(37,99,235,0.5);
    }

    .btn-submit:active { transform: translateY(0); }

    /* ---- FOOTER NOTE ---- */
    .reg-footer-note {
      text-align: center;
      font-size: 0.8rem;
      color: var(--muted);
      margin-top: 22px;
    }

    .reg-footer-note a {
      color: #60a5fa;
      text-decoration: none;
      font-weight: 500;
    }

    .reg-footer-note a:hover { color: var(--text); }

    /* ---- RESPONSIVE ---- */
    @media (max-width: 600px) {
      body { padding: 24px 14px; }
      .reg-card-body { padding: 28px 22px 32px; }
      .field-row.cols-3 { grid-template-columns: 1fr 1fr; }
      .field-row.cols-3 .field-group:last-child { grid-column: span 2; }
      .field-row.cols-3-equal { grid-template-columns: 1fr; }
      .field-row.cols-2 { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

  <!-- Background glows -->
  <div class="bg-glow-1"></div>
  <div class="bg-glow-2"></div>
  <div class="bg-glow-3"></div>

  <div class="register-wrapper">

    <!-- Header -->
    <div class="reg-header">
      <div class="reg-logo-wrap">
        <img src="{{ asset('assets/logo_main.png') }}" alt="RGRR WebMaker Logo" onerror="this.style.display='none'" />
      </div>
      <div class="reg-brand">
        <div class="reg-brand-name">RGRR WebMaker</div>
        <div class="reg-brand-sub">Philippines</div>
      </div>
    </div>

    <!-- Card -->
    <div class="reg-card">
      <div class="reg-topbar"></div>
      <div class="reg-card-body">

        <h2 class="reg-title">Create your account ✨</h2>
        <p class="reg-subtitle">Join RGRR WebMaker Philippines — fill in your details below to get started.</p>

        {{-- Validation errors --}}
        @if ($errors->any())
          <div class="alert-error">
            <i class="fas fa-exclamation-circle" style="margin-right:6px;"></i>
            {{ $errors->first() }}
          </div>
        @endif

        <form method="POST" action="{{ route('register.process') }}" enctype="multipart/form-data">
          @csrf

          <!-- ===== PERSONAL INFO ===== -->
          <div class="form-section">
            <div class="section-label"><i class="fas fa-user"></i> Personal Information</div>

            <!-- Name row -->
            <div class="field-row cols-3">
              <div class="field-group">
                <label class="field-label">First Name</label>
                <div class="field-wrap">
                  <input type="text" name="first_name" class="field-input" placeholder="Juan" value="{{ old('first_name') }}" required />
                  <i class="fas fa-user field-icon"></i>
                </div>
              </div>
              <div class="field-group">
                <label class="field-label">Surname</label>
                <div class="field-wrap">
                  <input type="text" name="surname" class="field-input no-icon" placeholder="dela Cruz" value="{{ old('surname') }}" required />
                </div>
              </div>
              <div class="field-group">
                <label class="field-label">M.I.</label>
                <div class="field-wrap">
                  <input type="text" name="middle_initial" id="middleInitial" class="field-input no-icon" placeholder="A" maxlength="1" value="{{ old('middle_initial') }}" style="text-align:center;text-transform:uppercase;" />
                </div>
              </div>
            </div>

            <!-- Address -->
            <div class="field-row cols-1">
              <div class="field-group">
                <label class="field-label">Home Address</label>
                <div class="field-wrap">
                  <input type="text" name="address" class="field-input" placeholder="123 Rizal St., Lucena City, Quezon" value="{{ old('address') }}" required />
                  <i class="fas fa-map-marker-alt field-icon"></i>
                </div>
              </div>
            </div>

            <!-- Email -->
            <div class="field-row cols-1">
              <div class="field-group">
                <label class="field-label">Email Address</label>
                <div class="field-wrap">
                  <input type="email" name="email" class="field-input" placeholder="you@example.com" value="{{ old('email') }}" required />
                  <i class="fas fa-envelope field-icon"></i>
                </div>
              </div>
            </div>
          </div>

          <!-- ===== SCHOOL INFO ===== -->
          <div class="form-section">
            <div class="section-label"><i class="fas fa-graduation-cap"></i> School Information</div>

            <!-- School Name -->
            <div class="field-row cols-1">
              <div class="field-group">
                <label class="field-label">School Name</label>
                <div class="field-wrap">
                  <input type="text" name="school" class="field-input" placeholder="e.g. Quezon National High School" value="{{ old('school') }}" required />
                  <i class="fas fa-school field-icon"></i>
                </div>
              </div>
            </div>

            <!-- Year / SY / Hours -->
            <div class="field-row cols-3-equal">
              <div class="field-group">
                <label class="field-label">Year Level</label>
                <div class="field-wrap select-wrap">
                  <select name="year_level" class="field-select no-icon" style="padding-left:13px;">
                    <option value="">Select year</option>
                    <option {{ old('year_level') == '1st Year' ? 'selected' : '' }}>1st Year</option>
                    <option {{ old('year_level') == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                    <option {{ old('year_level') == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                    <option {{ old('year_level') == '4th Year' ? 'selected' : '' }}>4th Year</option>
                  </select>
                </div>
              </div>
              <div class="field-group">
                <label class="field-label">School Year</label>
                <div class="field-wrap">
                  <input type="text" name="school_year" class="field-input" placeholder="2025-2026" pattern="\d{4}-\d{4}" value="{{ old('school_year') }}" required />
                  <i class="fas fa-calendar-alt field-icon"></i>
                </div>
              </div>
              <div class="field-group">
                <label class="field-label">Required Hours</label>
                <div class="field-wrap">
                  <input type="number" name="hours" class="field-input" placeholder="240" value="{{ old('hours') }}" required style="padding-right:36px;" />
                  <i class="fas fa-clock field-icon"></i>
                  <span class="field-suffix">hrs</span>
                </div>
              </div>
            </div>
          </div>

          <!-- ===== PASSWORD ===== -->
          <div class="form-section">
            <div class="section-label"><i class="fas fa-lock"></i> Security</div>

            <div class="field-row cols-2">
              <div class="field-group">
                <label class="field-label">Create Password</label>
                <div class="field-wrap">
                  <input type="password" name="password" id="password" class="field-input" placeholder="••••••••" required />
                  <i class="fas fa-lock field-icon"></i>
                  <button type="button" class="toggle-pw" onclick="togglePw('password','eyeIcon1')">
                    <i class="fas fa-eye" id="eyeIcon1"></i>
                  </button>
                </div>
              </div>
              <div class="field-group">
                <label class="field-label">Confirm Password</label>
                <div class="field-wrap">
                  <input type="password" name="password_confirmation" id="confirmPassword" class="field-input" placeholder="••••••••" required />
                  <i class="fas fa-lock field-icon"></i>
                  <button type="button" class="toggle-pw" onclick="togglePw('confirmPassword','eyeIcon2')">
                    <i class="fas fa-eye" id="eyeIcon2"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- ===== DOCUMENTS ===== -->
          <div class="form-section">
            <div class="section-label"><i class="fas fa-paperclip"></i> Required Documents</div>

            <div class="field-row cols-2">
              <!-- MOA -->
              <div class="field-group">
                <label class="field-label">Memorandum of Agreement</label>
                <label class="file-label" for="document">
                  <input type="file" id="document" name="document" onchange="showFile(this,'moaName')" />
                  <div class="file-icon-wrap"><i class="fas fa-file-contract"></i></div>
                  <div class="file-text">
                    <strong>Attach MOA</strong>
                    <span>PDF, DOC, JPG — optional</span>
                  </div>
                </label>
                <div class="file-name-display" id="moaName"></div>
              </div>

              <!-- School ID -->
              <div class="field-group">
                <label class="field-label">School ID Scan</label>
                <label class="file-label" for="school_id">
                  <input type="file" id="school_id" name="school_id" onchange="showFile(this,'idName')" required />
                  <div class="file-icon-wrap" style="background:rgba(200,41,10,0.12);color:#f87171;"><i class="fas fa-id-card"></i></div>
                  <div class="file-text">
                    <strong>Attach School ID <span style="color:#f87171;font-size:0.7rem;">*required</span></strong>
                    <span>JPG, PNG, PDF accepted</span>
                  </div>
                </label>
                <div class="file-name-display" id="idName"></div>
              </div>
            </div>
          </div>

          <!-- ===== TERMS ===== -->
          <div class="terms-row">
            <input type="checkbox" class="terms-check" id="terms" name="terms" required />
            <label class="terms-text" for="terms">
              I have read and agree to the
              <a href="#" target="_blank">Terms and Conditions</a>
              of RGRR WebMaker Philippines. I confirm that all information provided is accurate and truthful.
            </label>
          </div>

          <!-- ===== BUTTONS ===== -->
          <div class="btn-row">
            <a href="/" class="btn-back">
            Back
            </a>
            <button type="submit" class="btn-submit">
              <i class="fas fa-user-plus"></i> Create Account
            </button>
          </div>

        </form>

      </div>
    </div>

    <!-- Footer note -->
    <div class="reg-footer-note">
      Already have an account? <a href="/login">Log in here</a>
    </div>

  </div>

  <script>
    // Auto-uppercase Middle Initial
    const miField = document.getElementById('middleInitial');
    miField.addEventListener('input', function () {
      this.value = this.value.toUpperCase().replace(/[^A-Z]/g, '');
    });

    // Password visibility toggle
    function togglePw(fieldId, iconId) {
      const field = document.getElementById(fieldId);
      const icon  = document.getElementById(iconId);
      if (field.type === 'password') {
        field.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        field.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      }
    }

    // Show selected file name
    function showFile(input, displayId) {
      const display = document.getElementById(displayId);
      if (input.files && input.files[0]) {
        display.textContent = '📎 ' + input.files[0].name;
      } else {
        display.textContent = '';
      }
    }

    // Drag-over glow on file labels
    document.querySelectorAll('.file-label').forEach(label => {
      label.addEventListener('dragover', e => {
        e.preventDefault();
        label.style.borderColor = 'rgba(37,99,235,0.6)';
        label.style.background  = 'rgba(37,99,235,0.08)';
      });
      label.addEventListener('dragleave', () => {
        label.style.borderColor = '';
        label.style.background  = '';
      });
      label.addEventListener('drop', e => {
        e.preventDefault();
        label.style.borderColor = '';
        label.style.background  = '';
        const fileInput = label.querySelector('input[type="file"]');
        const displayId = label.nextElementSibling.id;
        if (e.dataTransfer.files[0]) {
          fileInput.files = e.dataTransfer.files;
          document.getElementById(displayId).textContent = '📎 ' + e.dataTransfer.files[0].name;
        }
      });
    });
  </script>

</body>
</html>
