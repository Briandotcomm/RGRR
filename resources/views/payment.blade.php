<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment — RGRR WebMaker Philippines</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    :root {
      --bg: #04060f;
      --surface: #080d1c;
      --card: #0c1228;
      --card-deep: #080d1c;
      --accent: #2563eb;
      --accent2: #c8290a;
      --accent3: #f5a623;
      --text: #e8eaf5;
      --muted: #7888a8;
      --border: rgba(37,99,235,0.18);
      --green: #10b981;
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
      padding: 40px 20px;
      position: relative;
      overflow-x: hidden;
    }

    /* ---- BACKGROUND GLOWS ---- */
    .bg-glow-1 {
      position: fixed;
      width: 600px; height: 600px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(37,99,235,0.11) 0%, transparent 70%);
      top: -120px; left: -120px;
      pointer-events: none;
      animation: driftA 14s ease-in-out infinite alternate;
    }
    .bg-glow-2 {
      position: fixed;
      width: 480px; height: 480px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(200,41,10,0.08) 0%, transparent 70%);
      bottom: -80px; right: -80px;
      pointer-events: none;
      animation: driftB 18s ease-in-out infinite alternate;
    }
    .bg-glow-3 {
      position: fixed;
      width: 320px; height: 320px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(245,166,35,0.06) 0%, transparent 70%);
      top: 40%; left: 55%;
      pointer-events: none;
    }

    @keyframes driftA {
      from { transform: translate(0,0); }
      to   { transform: translate(70px, 90px); }
    }
    @keyframes driftB {
      from { transform: translate(0,0); }
      to   { transform: translate(-55px,-65px); }
    }

    body::before {
      content: '';
      position: fixed; inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
      pointer-events: none; z-index: 0; opacity: 0.25;
    }

    /* ---- WRAPPER ---- */
    .pay-wrapper {
      position: relative;
      z-index: 1;
      width: 100%;
      max-width: 620px;
      animation: fadeUp 0.7s ease both;
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(28px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ---- HEADER ---- */
    .pay-header {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 28px;
    }

    .pay-logo-wrap {
      width: 50px; height: 50px;
      border-radius: 13px;
      background: rgba(4,6,15,0.8);
      border: 1px solid rgba(37,99,235,0.3);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      box-shadow: 0 0 22px rgba(37,99,235,0.18);
      flex-shrink: 0;
    }

    .pay-logo-wrap img { width: 40px; height: 40px; object-fit: contain; }

    .pay-brand-name {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1.05rem;
      background: linear-gradient(135deg, #60a5fa, #2563eb);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      letter-spacing: -0.02em;
    }

    .pay-brand-sub {
      font-size: 0.68rem;
      color: var(--muted);
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    /* ---- CARD ---- */
    .pay-card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 0 60px rgba(37,99,235,0.08), 0 30px 60px rgba(0,0,0,0.4);
    }

    .pay-topbar {
      height: 3px;
      background: linear-gradient(90deg, var(--accent), var(--accent2), var(--accent3));
    }

    .pay-card-body { padding: 40px 44px 44px; }

    .pay-title {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1.55rem;
      letter-spacing: -0.03em;
      margin-bottom: 8px;
    }

    .pay-subtitle {
      font-size: 0.875rem;
      color: var(--muted);
      line-height: 1.6;
      margin-bottom: 32px;
    }

    /* ---- SUCCESS ALERT ---- */
    .alert-success {
      background: rgba(16,185,129,0.1);
      border: 1px solid rgba(16,185,129,0.3);
      border-radius: 12px;
      padding: 14px 18px;
      font-size: 0.875rem;
      color: #34d399;
      margin-bottom: 28px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .alert-info-box {
      background: rgba(37,99,235,0.08);
      border: 1px solid rgba(37,99,235,0.2);
      border-radius: 12px;
      padding: 16px 18px;
      font-size: 0.84rem;
      color: var(--muted);
      line-height: 1.65;
    }

    .alert-info-box strong { color: var(--text); }

    /* ---- PAYMENT OPTIONS ---- */
    .pay-options {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
      margin-bottom: 28px;
    }

    .pay-option {
      background: var(--card-deep);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 24px 20px;
      cursor: pointer;
      transition: all 0.3s ease;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .pay-option::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(37,99,235,0.07), transparent);
      opacity: 0;
      transition: opacity 0.3s;
    }

    .pay-option:hover {
      transform: translateY(-4px);
      border-color: rgba(37,99,235,0.45);
      box-shadow: 0 12px 30px rgba(37,99,235,0.15);
    }

    .pay-option:hover::before { opacity: 1; }

    .pay-option.active {
      border-color: var(--accent);
      box-shadow: 0 0 0 1px var(--accent), 0 12px 35px rgba(37,99,235,0.25);
      background: linear-gradient(145deg, rgba(37,99,235,0.12), var(--card-deep));
    }

    .pay-option.active::before { opacity: 1; }

    .pay-option-icon {
      width: 52px; height: 52px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.3rem;
      margin: 0 auto 14px;
      transition: all 0.3s;
    }

    .pay-option:nth-child(1) .pay-option-icon {
      background: rgba(37,99,235,0.12);
      color: #60a5fa;
    }

    .pay-option:nth-child(2) .pay-option-icon {
      background: rgba(16,185,129,0.12);
      color: #34d399;
    }

    .pay-option.active .pay-option-icon {
      box-shadow: 0 0 20px rgba(37,99,235,0.3);
    }

    .pay-option h5 {
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      font-size: 0.95rem;
      margin-bottom: 6px;
      color: var(--text);
      position: relative;
    }

    .pay-option p {
      font-size: 0.78rem;
      color: var(--muted);
      line-height: 1.5;
      margin: 0;
      position: relative;
    }

    /* Active tick badge */
    .pay-option .active-tick {
      position: absolute;
      top: 12px; right: 12px;
      width: 20px; height: 20px;
      background: var(--accent);
      border-radius: 50%;
      display: none;
      align-items: center;
      justify-content: center;
      font-size: 0.6rem;
      color: #fff;
    }

    .pay-option.active .active-tick { display: flex; }

    /* ---- EXPANDABLE SECTIONS ---- */
    .pay-section {
      display: none;
      animation: sectionIn 0.4s ease both;
    }

    .pay-section.visible { display: block; }

    @keyframes sectionIn {
      from { opacity: 0; transform: translateY(12px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* section divider */
    .section-label {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 0.72rem;
      font-weight: 500;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--accent);
      margin-bottom: 18px;
    }

    .section-label::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--border);
    }

    /* ---- QR DISPLAY ---- */
    .qr-wrap {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 14px;
      margin-bottom: 28px;
    }

    .qr-frame {
      padding: 16px;
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 0 40px rgba(37,99,235,0.2);
      display: inline-block;
    }

    .qr-frame img {
      display: block;
      width: 180px; height: 180px;
      object-fit: contain;
      border-radius: 8px;
    }

    .qr-caption {
      font-size: 0.8rem;
      color: var(--muted);
      text-align: center;
      line-height: 1.5;
    }

    .qr-caption strong { color: var(--text); }

    /* ---- FORM FIELDS ---- */
    .field-group {
      margin-bottom: 16px;
    }

    .field-label {
      display: block;
      font-size: 0.74rem;
      font-weight: 500;
      color: var(--muted);
      letter-spacing: 0.05em;
      text-transform: uppercase;
      margin-bottom: 7px;
    }

    .field-wrap { position: relative; }

    .field-icon {
      position: absolute;
      left: 13px; top: 50%;
      transform: translateY(-50%);
      color: var(--muted);
      font-size: 0.8rem;
      pointer-events: none;
      transition: color 0.2s;
    }

    .field-input {
      width: 100%;
      background: rgba(255,255,255,0.04);
      border: 1px solid var(--border);
      border-radius: 9px;
      padding: 12px 13px 12px 38px;
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.875rem;
      outline: none;
      transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
    }

    .field-input::placeholder { color: #3a4460; }

    .field-input:focus {
      border-color: rgba(37,99,235,0.55);
      background: rgba(37,99,235,0.05);
      box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
    }

    .field-wrap:focus-within .field-icon { color: #60a5fa; }

    /* File upload */
    .file-label {
      display: flex;
      align-items: center;
      gap: 12px;
      background: rgba(255,255,255,0.03);
      border: 1px dashed rgba(37,99,235,0.25);
      border-radius: 10px;
      padding: 14px 16px;
      cursor: pointer;
      transition: all 0.2s;
    }

    .file-label:hover {
      border-color: rgba(37,99,235,0.5);
      background: rgba(37,99,235,0.05);
    }

    .file-label input[type="file"] { display: none; }

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

    .file-text span { font-size: 0.74rem; color: var(--muted); }

    .file-name-display {
      font-size: 0.74rem;
      color: #60a5fa;
      margin-top: 6px;
      padding-left: 4px;
      min-height: 16px;
    }

    /* ---- SUBMIT BUTTONS ---- */
    .btn-submit {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 9px;
      background: linear-gradient(135deg, var(--accent), #1d4ed8);
      border: none;
      border-radius: 11px;
      padding: 14px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.95rem;
      font-weight: 500;
      color: #fff;
      cursor: pointer;
      transition: all 0.25s;
      box-shadow: 0 0 30px rgba(37,99,235,0.3);
      margin-top: 8px;
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 0 50px rgba(37,99,235,0.5);
    }

    .btn-submit.green {
      background: linear-gradient(135deg, #059669, #10b981);
      box-shadow: 0 0 30px rgba(16,185,129,0.25);
    }

    .btn-submit.green:hover {
      box-shadow: 0 0 50px rgba(16,185,129,0.45);
    }

    /* ---- BACK LINK ---- */
    .back-link {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      margin-top: 22px;
      font-size: 0.82rem;
      color: var(--muted);
      text-decoration: none;
      transition: color 0.2s;
    }

    .back-link:hover { color: var(--text); }

    /* ---- RESPONSIVE ---- */
    @media (max-width: 540px) {
      .pay-card-body { padding: 28px 22px 32px; }
      .pay-options { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

  <div class="bg-glow-1"></div>
  <div class="bg-glow-2"></div>
  <div class="bg-glow-3"></div>

  <div class="pay-wrapper">

    <!-- Header -->
    <div class="pay-header">
      <div class="pay-logo-wrap">
        <img src="{{ asset('assets/logo_main.png') }}" alt="RGRR WebMaker Logo" onerror="this.style.display='none'" />
      </div>
      <div>
        <div class="pay-brand-name">RGRR WebMaker</div>
        <div class="pay-brand-sub">Philippines</div>
      </div>
    </div>

    <!-- Card -->
    <div class="pay-card">
      <div class="pay-topbar"></div>
      <div class="pay-card-body">

        <h2 class="pay-title">Complete Your Registration </h2>
        <p class="pay-subtitle">Choose your preferred payment method below to activate your student account.</p>

        {{-- Success Message --}}
        @if(session('success'))
          <div class="alert-success">
            <i class="fas fa-check-circle" style="font-size:1.1rem;flex-shrink:0;"></i>
            <span>{{ session('success') }}</span>
          </div>
          @if(session('redirect'))
            <script>
              setTimeout(() => { window.location.href = "{{ session('redirect') }}"; }, 5000);
            </script>
          @endif
        @endif

        <!-- ===== PAYMENT OPTIONS ===== -->
        <div class="pay-options">

          <!-- CASH -->
          <div class="pay-option" id="cashOption" onclick="selectPayment('cash')">
            <div class="active-tick"><i class="fas fa-check"></i></div>
            <div class="pay-option-icon"><i class="fas fa-money-bill-wave"></i></div>
            <h5>Cash Payment</h5>
            <p>Pay in person at the RGRR WebMaker office.</p>
          </div>

          <!-- GCASH -->
          <div class="pay-option" id="gcashOption" onclick="selectPayment('gcash')">
            <div class="active-tick"><i class="fas fa-check"></i></div>
            <div class="pay-option-icon" style="background:rgba(16,185,129,0.12);color:#34d399;"><i class="fas fa-qrcode"></i></div>
            <h5>GCash</h5>
            <p>Scan QR code and upload your proof of payment.</p>
          </div>

        </div>

        <!-- ===== CASH SECTION ===== -->
        <div class="pay-section" id="cashSection">
          <div class="section-label"><i class="fas fa-money-bill-wave"></i> Cash Payment Details</div>

          <div class="alert-info-box" style="margin-bottom:22px;">
            <i class="fas fa-info-circle" style="color:#60a5fa;margin-right:8px;"></i>
            Please visit the <strong>RGRR WebMaker office</strong> at 3rd Floor HR Building II, Quezon Ave. Corner Gomez, Lucena City to complete your payment in person.
            Your account will remain <strong>Pending</strong> until payment is confirmed by the admin.
          </div>

          <form method="POST" action="{{ route('payment.process') }}">
            @csrf
            <input type="hidden" name="payment_method" value="cash">
            <button type="submit" class="btn-submit">
              <i class="fas fa-check-circle"></i> Confirm Cash Payment Selection
            </button>
          </form>
        </div>

        <!-- ===== GCASH SECTION ===== -->
        <div class="pay-section" id="gcashSection">
          <div class="section-label"><i class="fas fa-qrcode"></i> GCash Payment</div>

          <!-- QR Code -->
          <div class="qr-wrap">
            <div class="qr-frame">
              <img src="{{ asset('assets/qrcode.jpg') }}" alt="GCash QR Code" />
            </div>
            <div class="qr-caption">
              <strong>Scan with your GCash app</strong><br/>
              After payment, fill in your reference number and upload your screenshot below.
            </div>
          </div>

          <form method="POST" action="{{ route('payment.process') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="payment_method" value="gcash">

            <!-- Reference Number -->
            <div class="field-group">
              <label class="field-label">GCash Reference Number</label>
              <div class="field-wrap">
                <input type="text" name="reference_number" class="field-input" placeholder="e.g. 1234567890" required />
                <i class="fas fa-hashtag field-icon"></i>
              </div>
            </div>

            <!-- Proof of Payment -->
            <div class="field-group" style="margin-bottom:8px;">
              <label class="field-label">Proof of Payment</label>
              <label class="file-label" for="proof_file">
                <input type="file" id="proof_file" name="proof_of_payment" onchange="showFile(this,'proofName')" required />
                <div class="file-icon-wrap"><i class="fas fa-image"></i></div>
                <div class="file-text">
                  <strong>Upload Screenshot</strong>
                  <span>JPG, PNG, PDF — max 5MB</span>
                </div>
              </label>
              <div class="file-name-display" id="proofName"></div>
            </div>

            <button type="submit" class="btn-submit green">
              <i class="fas fa-paper-plane"></i> Submit Payment Details
            </button>
          </form>
        </div>

        <!-- Back link -->
        <a href="{{ route('register') }}" class="back-link">
        Back
        </a>

      </div>
    </div>

  </div>

  <script>
    function selectPayment(method) {
      const cashOpt   = document.getElementById('cashOption');
      const gcashOpt  = document.getElementById('gcashOption');
      const cashSec   = document.getElementById('cashSection');
      const gcashSec  = document.getElementById('gcashSection');

      // Reset both
      cashOpt.classList.remove('active');
      gcashOpt.classList.remove('active');
      cashSec.classList.remove('visible');
      gcashSec.classList.remove('visible');

      if (method === 'cash') {
        cashOpt.classList.add('active');
        cashSec.classList.add('visible');
      } else {
        gcashOpt.classList.add('active');
        gcashSec.classList.add('visible');
      }
    }

    function showFile(input, displayId) {
      const display = document.getElementById(displayId);
      display.textContent = input.files[0] ? '📎 ' + input.files[0].name : '';
    }

    // Drag-over glow on file label
    const fileLabel = document.querySelector('.file-label');
    if (fileLabel) {
      fileLabel.addEventListener('dragover', e => {
        e.preventDefault();
        fileLabel.style.borderColor = 'rgba(37,99,235,0.6)';
        fileLabel.style.background = 'rgba(37,99,235,0.08)';
      });
      fileLabel.addEventListener('dragleave', () => {
        fileLabel.style.borderColor = '';
        fileLabel.style.background = '';
      });
      fileLabel.addEventListener('drop', e => {
        e.preventDefault();
        fileLabel.style.borderColor = '';
        fileLabel.style.background = '';
        const inp = fileLabel.querySelector('input[type="file"]');
        if (e.dataTransfer.files[0]) {
          inp.files = e.dataTransfer.files;
          document.getElementById('proofName').textContent = '📎 ' + e.dataTransfer.files[0].name;
        }
      });
    }
  </script>

</body>
</html>
