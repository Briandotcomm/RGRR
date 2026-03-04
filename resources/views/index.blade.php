<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>RGRR WebMaker Philippines — Your Digital Wizard</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    :root {
      --bg: #04060f;
      --surface: #080d1c;
      --card: #0c1228;
      --accent: #2563eb;
      --accent2: #c8290a;
      --accent3: #e05a3a;
      --accent4: #ef4444;
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
      overflow-x: hidden;
    }

    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
      pointer-events: none;
      z-index: 999;
      opacity: 0.3;
    }

    /* ---- NAVBAR ---- */
    nav {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 100;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 40px;
      height: 72px;
      background: rgba(4,4,10,0.75);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid var(--border);
      animation: slideDown 0.6s ease both;
    }

    @keyframes slideDown {
      from { transform: translateY(-100%); opacity: 0; }
      to   { transform: translateY(0); opacity: 1; }
    }

    .nav-brand {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      flex-shrink: 0;
    }

    .nav-brand .wizard-icon-sm {
      width: 36px;
      height: 36px;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1rem;
    }

    .nav-brand .brand-text {
      display: flex;
      flex-direction: column;
      line-height: 1.1;
    }

    .brand-rgrr {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1.1rem;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .brand-webmaker {
      font-size: 0.7rem;
      color: var(--muted);
      font-weight: 400;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 4px;
      list-style: none;
    }

    .nav-links a {
      text-decoration: none;
      color: var(--muted);
      font-size: 0.875rem;
      font-weight: 400;
      padding: 8px 14px;
      border-radius: 8px;
      transition: color 0.2s, background 0.2s;
      white-space: nowrap;
    }

    .nav-links a:hover {
      color: var(--text);
      background: rgba(37,99,235,0.1);
    }

    .nav-actions { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }

    .btn-login {
      font-family: 'DM Sans', sans-serif;
      font-size: 0.875rem;
      font-weight: 500;
      color: var(--text);
      background: transparent;
      border: 1px solid var(--border);
      padding: 9px 20px;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.2s;
      text-decoration: none;
    }

    .btn-login:hover { border-color: var(--accent); color: var(--accent); }

    .btn-join {
      font-family: 'DM Sans', sans-serif;
      font-size: 0.875rem;
      font-weight: 500;
      color: #fff;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      border: none;
      padding: 9px 22px;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.2s;
      box-shadow: 0 0 20px rgba(37,99,235,0.3);
      text-decoration: none;
      position: relative;
      overflow: hidden;
    }

    .btn-join:hover { box-shadow: 0 0 35px rgba(37,99,235,0.5); transform: translateY(-1px); }

    /* ---- HERO ---- */
    .hero {
      min-height: 100vh;
      display: flex;
      align-items: center;
      padding: 120px 40px 80px;
      position: relative;
      overflow: hidden;
    }

    .hero-glow {
      position: absolute;
      width: 700px;
      height: 700px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(37,99,235,0.15) 0%, transparent 70%);
      top: 50%; left: 50%;
      transform: translate(-50%, -55%);
      pointer-events: none;
    }

    .hero-glow2 {
      position: absolute;
      width: 400px; height: 400px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(200,41,10,0.12) 0%, transparent 70%);
      bottom: 10%; right: 10%;
      pointer-events: none;
    }

    .hero .container { max-width: 1200px; margin: 0 auto; width: 100%; display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(37,99,235,0.1);
      border: 1px solid rgba(37,99,235,0.3);
      border-radius: 999px;
      padding: 7px 18px;
      font-size: 0.8rem;
      color: var(--accent);
      font-weight: 500;
      margin-bottom: 28px;
      animation: fadeUp 0.8s 0.2s ease both;
    }

    .hero h1 {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: clamp(2.5rem, 6vw, 5rem);
      line-height: 1;
      letter-spacing: -0.04em;
      animation: fadeUp 0.8s 0.35s ease both;
    }

    .hero h1 .grad {
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .hero p {
      margin-top: 24px;
      font-size: 1.05rem;
      color: var(--muted);
      line-height: 1.7;
      animation: fadeUp 0.8s 0.5s ease both;
    }

    .hero-cta {
      margin-top: 40px;
      display: flex;
      gap: 14px;
      flex-wrap: wrap;
      animation: fadeUp 0.8s 0.65s ease both;
    }

    .cta-primary {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-family: 'DM Sans', sans-serif;
      font-size: 1rem;
      font-weight: 500;
      color: #fff;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      border: none;
      padding: 14px 32px;
      border-radius: 10px;
      cursor: pointer;
      text-decoration: none;
      box-shadow: 0 0 35px rgba(37,99,235,0.3);
      transition: all 0.25s;
    }

    .cta-primary:hover { transform: translateY(-2px); box-shadow: 0 0 55px rgba(37,99,235,0.5); }

    .cta-secondary {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-family: 'DM Sans', sans-serif;
      font-size: 1rem;
      color: var(--text);
      background: transparent;
      border: 1px solid var(--border);
      padding: 14px 32px;
      border-radius: 10px;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.25s;
    }

    .cta-secondary:hover { border-color: rgba(37,99,235,0.5); background: rgba(37,99,235,0.07); }

    /* Hero Visual */
    .hero-visual {
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      height: 400px;
    }

    .magic-circles { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; }

    .magic-circle {
      position: absolute;
      border-radius: 50%;
      border: 1px solid rgba(37,99,235,0.25);
      animation: spin 20s linear infinite;
    }

    /* Blue/red only circles */
    .circle-1 { width: 220px; height: 220px; animation-duration: 15s; border-color: rgba(37,99,235,0.3); }
    .circle-2 { width: 330px; height: 330px; animation-duration: 25s; animation-direction: reverse; border-color: rgba(200,41,10,0.2); }
    .circle-3 { width: 420px; height: 420px; animation-duration: 35s; border-color: rgba(37,99,235,0.12); }

    @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

    /* UPDATED: Transparent orb — no black background */
    .wizard-orb {
      width: 320px;
      height: 320px;
      border-radius: 50%;
      background: transparent;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1;
      box-shadow: 0 0 60px rgba(37,99,235,0.45), 0 0 120px rgba(200,41,10,0.2);
      animation: float 4s ease-in-out infinite;
      overflow: visible;
      border: 2px solid rgba(37,99,235,0.3);
    }

    .wizard-orb img {
      width: 300px;
      height: 300px;
      object-fit: contain;
      border-radius: 50%;
      filter: drop-shadow(0 0 18px rgba(37,99,235,0.6)) drop-shadow(0 0 8px rgba(200,41,10,0.4));
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-16px); }
    }

    /* ---- STATS ---- */
    .stats {
      display: flex;
      justify-content: center;
      gap: 60px;
      flex-wrap: wrap;
      padding: 50px 60px;
      background: var(--surface);
      border-top: 1px solid var(--border);
      border-bottom: 1px solid var(--border);
    }

    .stat-item { text-align: center; }

    /* Blue/red only gradient on numbers */
    .stat-item .number {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 2.5rem;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .stat-item .label { font-size: 0.85rem; color: var(--muted); margin-top: 4px; }

    /* ---- GENERIC SECTION STYLES ---- */
    .section-wrap { padding: 100px 60px; max-width: 1200px; margin: 0 auto; }
    .full-section { background: var(--surface); border-top: 1px solid var(--border); }
    .full-section .section-wrap { max-width: 100%; padding-left: 0; padding-right: 0; }
    .full-section .section-inner { max-width: 1200px; margin: 0 auto; padding: 0 60px; }

    .section-tag {
      display: inline-block;
      font-size: 0.75rem;
      font-weight: 500;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--accent);
      margin-bottom: 14px;
      background: rgba(37,99,235,0.1);
      padding: 5px 14px;
      border-radius: 999px;
      border: 1px solid rgba(37,99,235,0.25);
    }

    .section-title {
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      font-size: clamp(2rem, 4vw, 3rem);
      letter-spacing: -0.03em;
      line-height: 1.1;
      margin-bottom: 16px;
    }

    .section-sub { color: var(--muted); font-size: 1rem; max-width: 520px; line-height: 1.7; }

    /* ---- ABOUT ---- */
    .about-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 60px;
      align-items: center;
      margin-top: 60px;
    }

    .about-visual {
      position: relative;
      height: 380px;
      border-radius: 20px;
      background: var(--card);
      border: 1px solid var(--border);
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .about-visual::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(37,99,235,0.12), rgba(200,41,10,0.08));
    }

    .about-orb {
      width: 180px; height: 180px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      filter: blur(40px);
      opacity: 0.6;
      animation: pulse 4s ease-in-out infinite;
      z-index: 1;
    }

    .about-icon-overlay {
      position: absolute;
      font-size: 5rem;
      opacity: 0.15;
      z-index: 0;
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); opacity: 0.6; }
      50% { transform: scale(1.15); opacity: 0.8; }
    }

    .about-text p { color: var(--muted); line-height: 1.8; margin-bottom: 14px; font-size: 0.95rem; }

    .about-stats { display: flex; gap: 32px; margin-top: 28px; flex-wrap: wrap; }

    .about-stat .num {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1.8rem;
    }

    .about-stat:nth-child(1) .num { color: var(--accent); }
    .about-stat:nth-child(2) .num { color: var(--accent2); }
    .about-stat:nth-child(3) .num { color: var(--accent); }
    .about-stat .lbl { color: var(--muted); font-size: 0.78rem; margin-top: 2px; }

    /* ---- ADVANTAGE ---- */
    .adv-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 22px;
      margin-top: 60px;
    }

    .adv-card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 32px 28px;
      transition: all 0.3s;
      position: relative;
      overflow: hidden;
    }

    .adv-card::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(37,99,235,0.05), transparent);
      opacity: 0;
      transition: opacity 0.3s;
    }

    .adv-card:hover { transform: translateY(-4px); border-color: rgba(37,99,235,0.4); }
    .adv-card:hover::before { opacity: 1; }

    .adv-icon {
      width: 52px; height: 52px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.4rem;
      margin-bottom: 20px;
    }

    .adv-card h3 { font-family: 'Syne', sans-serif; font-weight: 700; font-size: 1.05rem; margin-bottom: 10px; }
    .adv-card p { color: var(--muted); font-size: 0.875rem; line-height: 1.7; }

    /* ---- SERVICES ---- */
    .svc-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      margin-top: 60px;
    }

    .svc-card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 28px 24px;
      transition: all 0.3s;
      position: relative;
      overflow: hidden;
    }

    .svc-card::after {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 3px;
      border-radius: 16px 16px 0 0;
      background: linear-gradient(90deg, var(--accent), var(--accent2));
      opacity: 0;
      transition: opacity 0.3s;
    }

    .svc-card:hover { transform: translateY(-4px); border-color: rgba(37,99,235,0.35); }
    .svc-card:hover::after { opacity: 1; }

    .svc-icon { font-size: 2rem; margin-bottom: 16px; }
    .svc-card h3 { font-family: 'Syne', sans-serif; font-weight: 700; font-size: 0.95rem; margin-bottom: 14px; }

    .svc-card ul { list-style: none; padding: 0; }
    .svc-card ul li {
      color: var(--muted);
      font-size: 0.8rem;
      padding: 5px 0;
      display: flex;
      align-items: center;
      gap: 8px;
      border-bottom: 1px solid rgba(255,255,255,0.04);
    }

    .svc-card ul li:last-child { border-bottom: none; }
    .svc-card ul li i { font-size: 0.65rem; flex-shrink: 0; }

    /* Blue/red only icon colors */
    .card-blue .svc-icon   { color: var(--accent); }
    .card-purple .svc-icon { color: var(--accent2); }
    .card-red .svc-icon    { color: var(--accent4); }
    .card-cyan .svc-icon   { color: var(--accent); }
    .card-indigo .svc-icon { color: #1d4ed8; }
    .card-green .svc-icon  { color: var(--accent); }
    .card-yellow .svc-icon { color: var(--accent2); }
    .card-pink .svc-icon   { color: var(--accent4); }

    /* ---- WHY CHOOSE US ---- */
    .why-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 22px;
      margin-top: 60px;
    }

    .why-card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 36px 28px;
      text-align: center;
      transition: all 0.3s;
    }

    .why-card:hover { transform: translateY(-4px); border-color: rgba(37,99,235,0.4); }

    .why-icon {
      width: 64px; height: 64px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.6rem;
      margin: 0 auto 20px;
    }

    .why-card h4 { font-family: 'Syne', sans-serif; font-weight: 700; font-size: 1rem; margin-bottom: 12px; }
    .why-card p { color: var(--muted); font-size: 0.85rem; line-height: 1.7; }

    /* ---- CONTACT ---- */
    .contact-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
      margin-top: 60px;
    }

    .contact-card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 40px 32px;
      text-align: center;
      transition: all 0.3s;
    }

    .contact-card:hover { border-color: rgba(37,99,235,0.4); transform: translateY(-3px); }

    .contact-icon {
      width: 56px; height: 56px;
      border-radius: 14px;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.3rem;
      margin: 0 auto 20px;
      box-shadow: 0 0 25px rgba(37,99,235,0.3);
    }

    .contact-card h3 { font-family: 'Syne', sans-serif; font-weight: 700; font-size: 1.1rem; margin-bottom: 12px; }
    .contact-card p { color: var(--muted); font-size: 0.9rem; line-height: 1.7; }
    .contact-card a { color: var(--accent); text-decoration: none; transition: color 0.2s; }
    .contact-card a:hover { color: var(--accent2); }

    /* ---- CTA ---- */
    .cta-section {
      background: var(--surface);
      border-top: 1px solid var(--border);
      padding: 100px 60px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .cta-glow {
      position: absolute;
      width: 600px; height: 400px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(37,99,235,0.12) 0%, transparent 70%);
      top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      pointer-events: none;
    }

    .cta-section h2 { font-family: 'Syne', sans-serif; font-weight: 800; font-size: clamp(2rem, 4vw, 3rem); letter-spacing: -0.03em; margin-bottom: 16px; position: relative; }
    .cta-section p { color: var(--muted); font-size: 1rem; margin-bottom: 40px; position: relative; }

    .cta-big {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      font-family: 'DM Sans', sans-serif;
      font-size: 1.1rem;
      font-weight: 500;
      color: #fff;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      border: none;
      padding: 18px 44px;
      border-radius: 12px;
      cursor: pointer;
      text-decoration: none;
      box-shadow: 0 0 45px rgba(37,99,235,0.35);
      transition: all 0.25s;
      position: relative;
    }

    .cta-big:hover { transform: translateY(-3px); box-shadow: 0 0 70px rgba(37,99,235,0.55); }

    /* ---- FOOTER ---- */
    footer {
      border-top: 1px solid var(--border);
      padding: 60px;
    }

    .footer-grid {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 2fr 1fr 1fr;
      gap: 60px;
      margin-bottom: 50px;
    }

    .footer-logo { margin-bottom: 16px; display: flex; align-items: center; gap: 10px; }

    .footer-desc { color: var(--muted); font-size: 0.9rem; line-height: 1.7; max-width: 300px; }

    footer h5 { font-family: 'Syne', sans-serif; font-weight: 700; font-size: 0.95rem; margin-bottom: 16px; }

    footer a {
      display: block;
      color: var(--muted);
      text-decoration: none;
      font-size: 0.875rem;
      padding: 5px 0;
      transition: color 0.2s;
    }

    footer a:hover { color: var(--text); }

    .footer-bottom {
      max-width: 1200px;
      margin: 0 auto;
      padding-top: 28px;
      border-top: 1px solid var(--border);
      text-align: center;
      color: var(--muted);
      font-size: 0.85rem;
    }

    /* ---- ANIMATIONS ---- */
    @keyframes fadeUp {
      from { transform: translateY(30px); opacity: 0; }
      to   { transform: translateY(0); opacity: 1; }
    }

    .fade-up {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.7s ease, transform 0.7s ease;
    }

    .fade-up.visible { opacity: 1; transform: translateY(0); }

    /* ---- WHY CHOOSE US NEW GRID ---- */
    .why-grid-new {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 16px;
      margin-top: 60px;
    }

    .why-card-new {
      display: flex;
      align-items: flex-start;
      gap: 18px;
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 24px 24px;
      transition: all 0.3s;
    }

    .why-card-new:hover {
      transform: translateY(-3px);
      border-color: rgba(37,99,235,0.35);
      background: rgba(255,255,255,0.02);
    }

    .why-card-icon {
      width: 46px; height: 46px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      flex-shrink: 0;
    }

    .why-card-body h4 {
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      font-size: 0.95rem;
      margin-bottom: 6px;
      color: var(--text);
    }

    .why-card-body p {
      color: var(--muted);
      font-size: 0.82rem;
      line-height: 1.65;
      margin: 0;
    }

    @media (max-width: 768px) {
      .why-grid-new { grid-template-columns: 1fr; }
    }

    /* ---- NEW SERVICE TWO-COLUMN LAYOUT ---- */
    .svc-two-col {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 28px;
      margin-top: 60px;
      align-items: start;
    }

    .svc-big-card {
      border-radius: 20px;
      border: 1px solid var(--border);
      overflow: hidden;
      background: var(--card);
      transition: transform 0.3s, border-color 0.3s;
    }

    .svc-big-card:hover {
      transform: translateY(-4px);
    }

    .svc-big-header {
      padding: 36px 32px 28px;
      position: relative;
      overflow: hidden;
    }

    .svc-blue-header {
      background: linear-gradient(135deg, rgba(37,99,235,0.25) 0%, rgba(37,99,235,0.05) 100%);
      border-bottom: 1px solid rgba(37,99,235,0.2);
    }

    .svc-red-header {
      background: linear-gradient(135deg, rgba(200,41,10,0.25) 0%, rgba(200,41,10,0.05) 100%);
      border-bottom: 1px solid rgba(200,41,10,0.2);
    }

    .svc-big-icon {
      width: 56px; height: 56px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      margin-bottom: 16px;
    }

    .svc-blue-header .svc-big-icon {
      background: rgba(37,99,235,0.2);
      color: #60a5fa;
      box-shadow: 0 0 20px rgba(37,99,235,0.3);
    }

    .svc-red-header .svc-big-icon {
      background: rgba(200,41,10,0.2);
      color: #f87171;
      box-shadow: 0 0 20px rgba(200,41,10,0.3);
    }

    .svc-big-header h2 {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1.6rem;
      letter-spacing: -0.02em;
      margin-bottom: 10px;
    }

    .svc-big-header p {
      color: var(--muted);
      font-size: 0.875rem;
      line-height: 1.6;
    }

    .svc-big-body {
      padding: 8px 0 8px;
    }

    .svc-item {
      display: flex;
      align-items: flex-start;
      gap: 16px;
      padding: 18px 28px;
      border-bottom: 1px solid rgba(255,255,255,0.04);
      transition: background 0.2s;
    }

    .svc-item:last-child { border-bottom: none; }

    .svc-item:hover {
      background: rgba(255,255,255,0.03);
    }

    .svc-item-icon {
      width: 38px; height: 38px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.9rem;
      flex-shrink: 0;
      margin-top: 2px;
    }

    .svc-item-text {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .svc-item-text strong {
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      font-size: 0.9rem;
      color: var(--text);
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .svc-item-text span {
      color: var(--muted);
      font-size: 0.8rem;
      line-height: 1.6;
    }

    /* Coming soon badge — blue/red only */
    .coming-badge {
      display: inline-block;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.65rem;
      font-weight: 500;
      background: rgba(200,41,10,0.15);
      color: var(--accent3);
      border: 1px solid rgba(200,41,10,0.3);
      padding: 2px 8px;
      border-radius: 999px;
      letter-spacing: 0.05em;
      text-transform: uppercase;
    }

    /* ---- MOBILE ---- */
    @media (max-width: 1024px) {
      .svc-grid { grid-template-columns: repeat(2, 1fr); }
      .why-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
      nav { padding: 0 20px; }
      .nav-links { display: none; }
      .hero .container { grid-template-columns: 1fr; text-align: center; }
      .hero-visual { display: none; }
      .hero-cta { justify-content: center; }
      .section-wrap { padding: 60px 24px; }
      .full-section .section-inner { padding: 0 24px; }
      .about-grid { grid-template-columns: 1fr; }
      .adv-grid { grid-template-columns: 1fr; }
      .svc-grid { grid-template-columns: 1fr; }
      .svc-two-col { grid-template-columns: 1fr; }
      .why-grid { grid-template-columns: 1fr; }
      .contact-grid { grid-template-columns: 1fr; }
      .footer-grid { grid-template-columns: 1fr; gap: 32px; }
      .stats { gap: 30px; padding: 40px 24px; }
      .cta-section { padding: 70px 24px; }
      footer { padding: 40px 24px; }
    }
  </style>
</head>
<body>

  <!-- ===== NAVBAR ===== -->
  <nav>
    <a href="#" class="nav-brand">
      <img src="{{ asset('assets/logo_main.png') }}" alt="RGRR WebMaker Logo" style="height:52px;width:52px;object-fit:contain;border-radius:8px;" onerror="this.style.display='none'" />
      <div class="brand-text">
        <span class="brand-rgrr">RGRR</span>
        <span class="brand-webmaker">WebMaker</span>
      </div>
    </a>

    <ul class="nav-links">
      <li><a href="#about-us">About Us</a></li>
      <li><a href="#advantage">Advantage</a></li>
      <li><a href="#services">Services</a></li>
      <li><a href="#why-choose-us">Why Choose Us?</a></li>
      <li><a href="#contact">Contact Us</a></li>
      <li><a href="#organization">Organization</a></li>
    </ul>

    <div class="nav-actions">
      <a href="/login" class="btn-login">Log In</a>
      <a href="/register" class="btn-join">Join Now</a>
    </div>
  </nav>

  <!-- ===== HERO ===== -->
  <div class="hero">
    <div class="hero-glow"></div>
    <div class="hero-glow2"></div>
    <div class="container">
      <div class="hero-left">
        <div class="hero-badge"><i class="fas fa-hat-wizard"></i> Your Digital Wizard</div>
        <h1>RGRR WebMaker<br/><span class="grad">Philippines</span></h1>
        <p>The web solution and IT solution for the Filipino people — serving government and private sectors for over 15 years.</p>
        <div class="hero-cta">
          <a href="/register" class="cta-primary">Join Now</a>
          <a href="#services" class="cta-secondary">View Services</a>
        </div>
      </div>
      <div class="hero-visual">
        <div class="magic-circles">
          <div class="magic-circle circle-1"></div>
          <div class="magic-circle circle-2"></div>
          <div class="magic-circle circle-3"></div>
        </div>
        <div class="wizard-orb">
          <img src="{{ asset('assets/logo_main.png') }}" alt="RGRR Wizard" />
        </div>
      </div>
    </div>
  </div>

  <!-- ===== STATS ===== -->
  <div class="stats fade-up">
    <div class="stat-item">
      <div class="number">15+</div>
      <div class="label">Years in Business</div>
    </div>
    <div class="stat-item">
      <div class="number">30%</div>
      <div class="label">Government Clients</div>
    </div>
    <div class="stat-item">
      <div class="number">70%</div>
      <div class="label">Private Sector</div>
    </div>
    <div class="stat-item">
      <div class="number">Global</div>
      <div class="label">Reach &amp; Growing</div>
    </div>
  </div>

  <!-- ===== ABOUT US ===== -->
  <div class="section-wrap" id="about-us">
    <div class="section-tag">About Us</div>
    <h2 class="section-title">About Our Company</h2>
    <p class="section-sub">A trusted digital solutions partner for the Filipino people and beyond.</p>
    <div class="about-grid fade-up">
      <div class="about-visual" style="height:auto; padding:0; overflow:hidden;">
        <video width="100%" height="100%" controls style="border-radius:20px; display:block; object-fit:cover; min-height:320px;">
          <source src="{{ asset('assets/vid.mp4') }}" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
      <div class="about-text">
        <div class="section-tag">Our Story</div>
        <h3 class="section-title" style="font-size: 1.8rem; margin-top:12px;">Over 11 years of building digital solutions that matter</h3>
        <p>RGRR WebMaker Philippines is a business existing under Philippine law for more than 11 years. It is engaged in web hosting, web development, web design, SSL reseller, software development, systems integration, computer networking, and many more.</p>
        <p>Our company has customers all over the Philippines, 30% from the government sector and 70% from the private sector. Though WebMaker Philippines is for the Filipino people, it has been growing throughout the years and gained customers from other countries.</p>
        <p>The mission of WebMaker Philippines is to create jobs and expand its existing community service.</p>
        <div class="about-stats">
          <div class="about-stat">
            <div class="num">11+</div>
            <div class="lbl">Years Established</div>
          </div>
          <div class="about-stat">
            <div class="num">100%</div>
            <div class="lbl">Filipino-Owned</div>
          </div>
          <div class="about-stat">
            <div class="num">PH &amp; Beyond</div>
            <div class="lbl">Customer Reach</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ===== ADVANTAGE ===== -->
  <div class="full-section" id="advantage">
    <div style="max-width:1200px; margin:0 auto; padding: 100px 60px;">
      <div class="section-tag">Advantage</div>
      <h2 class="section-title">Why RGRR WebMaker<br/>stands apart.</h2>
      <p class="section-sub">We've built every layer of our solutions to give Filipino businesses a competitive edge.</p>
      <div class="adv-grid fade-up">
        <div class="adv-card">
          <div class="adv-icon" style="background: rgba(37,99,235,0.12); color: var(--accent);">
            <i class="fas fa-magic"></i>
          </div>
          <h3>Innovative Approach</h3>
          <p>We combine cutting-edge technology with creative thinking to deliver solutions that stand out from the crowd.</p>
        </div>
        <div class="adv-card">
          <div class="adv-icon" style="background: rgba(200,41,10,0.12); color: var(--accent2);">
            <i class="fas fa-bolt"></i>
          </div>
          <h3>Fast Delivery</h3>
          <p>Rapid development without compromising quality. We respect deadlines and deliver on time, every time.</p>
        </div>
        <div class="adv-card">
          <div class="adv-icon" style="background: rgba(37,99,235,0.12); color: var(--accent);">
            <i class="fas fa-headset"></i>
          </div>
          <h3>24/7 Support</h3>
          <p>Round-the-clock technical support to ensure your digital solutions run smoothly at all times.</p>
        </div>
        <div class="adv-card">
          <div class="adv-icon" style="background: rgba(200,41,10,0.12); color: var(--accent2);">
            <i class="fas fa-shield-alt"></i>
          </div>
          <h3>Secure Solutions</h3>
          <p>Top-notch security protocols to protect your data and ensure compliance with industry standards.</p>
        </div>
        <div class="adv-card">
          <div class="adv-icon" style="background: rgba(37,99,235,0.12); color: var(--accent);">
            <i class="fas fa-globe-asia"></i>
          </div>
          <h3>Government &amp; Private Trust</h3>
          <p>Trusted by both government agencies and private companies across the Philippines and internationally.</p>
        </div>
        <div class="adv-card">
          <div class="adv-icon" style="background: rgba(200,41,10,0.12); color: var(--accent2);">
            <i class="fas fa-briefcase"></i>
          </div>
          <h3>15+ Years Experience</h3>
          <p>Over a decade and a half of proven expertise in web and IT solutions under Philippine law.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- ===== SERVICES ===== -->
  <div class="section-wrap" id="services">
    <div class="section-tag">Services</div>
    <h2 class="section-title">Our Magical Services</h2>
    <p class="section-sub">Two powerful pillars — everything you need to build, grow, and protect your digital presence.</p>

    <div class="svc-two-col fade-up">

      <!-- WEB SOLUTIONS -->
      <div class="svc-big-card">
        <div class="svc-big-header svc-blue-header">
          <div class="svc-big-icon"><i class="fas fa-globe"></i></div>
          <h2>Web Solutions</h2>
          <p>Everything you need to establish and grow your online presence — from design to hosting.</p>
        </div>
        <div class="svc-big-body">
          <div class="svc-item">
            <div class="svc-item-icon" style="background:rgba(37,99,235,0.12);color:#2563eb;"><i class="fas fa-paint-brush"></i></div>
            <div class="svc-item-text">
              <strong>Web Design</strong>
              <span>Custom-branded websites crafted with a dedicated branding consultant to make your identity shine online.</span>
            </div>
          </div>
          <div class="svc-item">
            <div class="svc-item-icon" style="background:rgba(37,99,235,0.12);color:#2563eb;"><i class="fas fa-laptop-code"></i></div>
            <div class="svc-item-text">
              <strong>Web Development</strong>
              <span>From simple informational sites to complex, feature-rich web platforms — we build it all.</span>
            </div>
          </div>
          <div class="svc-item">
            <div class="svc-item-icon" style="background:rgba(37,99,235,0.12);color:#2563eb;"><i class="fas fa-lock"></i></div>
            <div class="svc-item-text">
              <strong>SSL Certificates</strong>
              <span>Secure your website and build visitor trust with industry-standard SSL encryption.</span>
            </div>
          </div>
          <div class="svc-item">
            <div class="svc-item-icon" style="background:rgba(37,99,235,0.12);color:#2563eb;"><i class="fas fa-server"></i></div>
            <div class="svc-item-text">
              <strong>Web Hosting</strong>
              <span>Reliable hosting options — Dedicated, Cloud, or Shared — tailored to your traffic and budget needs.</span>
            </div>
          </div>
          <div class="svc-item">
            <div class="svc-item-icon" style="background:rgba(37,99,235,0.12);color:#2563eb;"><i class="fas fa-envelope"></i></div>
            <div class="svc-item-text">
              <strong>Email Hosting</strong>
              <span>Professional business email hosting that keeps your communications secure and branded.</span>
            </div>
          </div>
          <div class="svc-item svc-item-coming">
            <div class="svc-item-icon" style="background:rgba(200,41,10,0.12);color:#c8290a;"><i class="fas fa-search"></i></div>
            <div class="svc-item-text">
              <strong>SEO <span class="coming-badge">Coming Soon</span></strong>
              <span>Search engine optimization services to help your website rank higher and reach more customers.</span>
            </div>
          </div>
        </div>
      </div>

      <!-- IT SOLUTIONS -->
      <div class="svc-big-card">
        <div class="svc-big-header svc-red-header">
          <div class="svc-big-icon"><i class="fas fa-microchip"></i></div>
          <h2>IT Solutions</h2>
          <p>Comprehensive technology solutions to power your operations and keep your systems running smoothly.</p>
        </div>
        <div class="svc-big-body">
          <div class="svc-item">
            <div class="svc-item-icon" style="background:rgba(200,41,10,0.12);color:#c8290a;"><i class="fas fa-code"></i></div>
            <div class="svc-item-text">
              <strong>Software Development</strong>
              <span>Custom software for every industry — online stores, school management, accounting, hospital systems, and more.</span>
            </div>
          </div>
          <div class="svc-item">
            <div class="svc-item-icon" style="background:rgba(200,41,10,0.12);color:#c8290a;"><i class="fas fa-network-wired"></i></div>
            <div class="svc-item-text">
              <strong>Systems Integration</strong>
              <span>Seamlessly connect your existing platforms, tools, and workflows into one unified, efficient ecosystem.</span>
            </div>
          </div>
          <div class="svc-item">
            <div class="svc-item-icon" style="background:rgba(200,41,10,0.12);color:#c8290a;"><i class="fas fa-cogs"></i></div>
            <div class="svc-item-text">
              <strong>Custom Software Development</strong>
              <span>We build software that adapts to your business — not the other way around. Fully tailored to your unique processes.</span>
            </div>
          </div>
          <div class="svc-item">
            <div class="svc-item-icon" style="background:rgba(200,41,10,0.12);color:#c8290a;"><i class="fas fa-shield-alt"></i></div>
            <div class="svc-item-text">
              <strong>Automatic Backup Solutions</strong>
              <span>Military-grade encrypted backups that run automatically, so your critical data is always safe and recoverable.</span>
            </div>
          </div>
          <div class="svc-item">
            <div class="svc-item-icon" style="background:rgba(200,41,10,0.12);color:#c8290a;"><i class="fas fa-tools"></i></div>
            <div class="svc-item-text">
              <strong>Network Maintenance</strong>
              <span>Proactive monitoring and maintenance of your network infrastructure to prevent downtime and maximize performance.</span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>


  <!-- ===== WHY CHOOSE US ===== -->
  <div class="full-section" id="why-choose-us">
    <div style="max-width:1200px; margin:0 auto; padding: 100px 60px;">
      <div class="section-tag">Why Choose Us?</div>
      <h2 class="section-title">The clear choice for<br/>Filipino businesses.</h2>
      <p class="section-sub">From future-ready technology to lifetime warranties — here's what sets us apart.</p>
      <div class="why-grid-new fade-up">

        <div class="why-card-new">
          <div class="why-card-icon" style="background:rgba(37,99,235,0.12);color:#60a5fa;">
            <i class="fas fa-hat-wizard"></i>
          </div>
          <div class="why-card-body">
            <h4>Future Ready</h4>
            <p>Let our wizards reprogram your entire app, software, system, or website to stay compatible with the latest technologies.</p>
          </div>
        </div>

        <div class="why-card-new">
          <div class="why-card-icon" style="background:rgba(200,41,10,0.12);color:#f87171;">
            <i class="fas fa-certificate"></i>
          </div>
          <div class="why-card-body">
            <h4>Warranty</h4>
            <p>Our warranty is at least 2 years for each of our work. While on selected services it is a lifetime warranty!</p>
          </div>
        </div>

        <div class="why-card-new">
          <div class="why-card-icon" style="background:rgba(37,99,235,0.12);color:#60a5fa;">
            <i class="fas fa-lock"></i>
          </div>
          <div class="why-card-body">
            <h4>Better Security</h4>
            <p>We have a very effective zero-hack protocol protecting your systems, data, and digital assets at all times.</p>
          </div>
        </div>

        <div class="why-card-new">
          <div class="why-card-icon" style="background:rgba(200,41,10,0.12);color:#f87171;">
            <i class="fas fa-user-shield"></i>
          </div>
          <div class="why-card-body">
            <h4>Better Privacy</h4>
            <p>We treat your privacy with utmost respect all the time — your data is yours and yours alone.</p>
          </div>
        </div>

        <div class="why-card-new">
          <div class="why-card-icon" style="background:rgba(37,99,235,0.12);color:#60a5fa;">
            <i class="fas fa-copyright"></i>
          </div>
          <div class="why-card-body">
            <h4>Copyright Protection</h4>
            <p>Full copyright protection to keep your files, data, business, and creative assets legally protected.</p>
          </div>
        </div>

        <div class="why-card-new">
          <div class="why-card-icon" style="background:rgba(200,41,10,0.12);color:#f87171;">
            <i class="fas fa-headset"></i>
          </div>
          <div class="why-card-body">
            <h4>24/7 Technical Support</h4>
            <p>Our technical support is NOT when available only — it is available all the time, every day, without exception.</p>
          </div>
        </div>

        <div class="why-card-new">
          <div class="why-card-icon" style="background:rgba(37,99,235,0.12);color:#60a5fa;">
            <i class="fas fa-award"></i>
          </div>
          <div class="why-card-body">
            <h4>10 Years of Experience</h4>
            <p>Our business has been growing for over a decade. Our people carry more than 10 years of hands-on experience.</p>
          </div>
        </div>

        <div class="why-card-new">
          <div class="why-card-icon" style="background:rgba(200,41,10,0.12);color:#f87171;">
            <i class="fas fa-star"></i>
          </div>
          <div class="why-card-body">
            <h4>Reliability</h4>
            <p>Our wizards are passionate and dedicated to keep learning and advancing to the latest technologies available.</p>
          </div>
        </div>

        <div class="why-card-new">
          <div class="why-card-icon" style="background:rgba(37,99,235,0.12);color:#60a5fa;">
            <i class="fas fa-server"></i>
          </div>
          <div class="why-card-body">
            <h4>Better Server</h4>
            <p>From hardware to software, you can count on regular security checks and updates to keep your mission-critical systems running.</p>
          </div>
        </div>

        <div class="why-card-new">
          <div class="why-card-icon" style="background:rgba(200,41,10,0.12);color:#f87171;">
            <i class="fas fa-cloud-upload-alt"></i>
          </div>
          <div class="why-card-body">
            <h4>Advanced Backup</h4>
            <p>Automatic backup with military-grade encryption — your critical data is always safe, secure, and recoverable.</p>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- ===== CONTACT ===== -->
  <div class="section-wrap" id="contact">
    <div class="section-tag">Contact Us</div>
    <h2 class="section-title">Get In Touch</h2>
    <p class="section-sub">Ready to start your magical digital journey? Contact us today!</p>
    <div class="contact-grid fade-up">
      <div class="contact-card">
        <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
        <h3>Location</h3>
        <p>3rd Floor HR Building II<br/>Quezon Ave. Corner Gomez<br/>Lucena City, Philippines<br/>4301</p>
      </div>
      <div class="contact-card">
        <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
        <h3>Phone</h3>
        <p><a href="tel:09996540792">09996540792</a></p>
      </div>
      <div class="contact-card">
        <div class="contact-icon"><i class="fas fa-clock"></i></div>
        <h3>Business Hours</h3>
        <p>Monday – Friday<br/>9:00 AM – 5:00 PM</p>
      </div>
    </div>
  </div>

  <!-- ===== CTA ===== -->
  <div class="cta-section">
    <div class="cta-glow"></div>
    <h2>Ready to Create Magic Together?</h2>
    <p>Join our community and let's transform your digital dreams into reality.</p>
    <a href="/register" class="cta-big">Join Now</a>
  </div>

  <!-- ===== FOOTER ===== -->
  <footer>
    <div class="footer-grid">
      <div>
        <div class="footer-logo">
          <img src="{{ asset('assets/logo_main.png') }}" alt="RGRR WebMaker Logo" style="height:52px;width:52px;object-fit:contain;border-radius:8px;" onerror="this.style.display='none'" />
          <div>
            <div class="brand-rgrr">RGRR WebMaker</div>
            <div class="brand-webmaker">Philippines</div>
          </div>
        </div>
        <p class="footer-desc">Transforming digital dreams into reality with expertise, innovation, and a touch of magic.</p>
      </div>
      <div>
        <h5>Quick Links</h5>
        <a href="#about-us">About Us</a>
        <a href="#services">Services</a>
        <a href="#contact">Contact Us</a>
        <a href="/login">Log In</a>
        <a href="/register">Join Now</a>
      </div>
      <div>
        <h5>Services</h5>
        <a href="#services">Web Development</a>
        <a href="#services">Game Development</a>
        <a href="#services">Database Solutions</a>
        <a href="#services">Webinar Services</a>
      </div>
    </div>
    <div class="footer-bottom">
      &copy; 2024 RGRR WebMaker Philippines. All rights reserved.
    </div>
  </footer>

  <script>
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) entry.target.classList.add('visible');
      });
    }, { threshold: 0.1 });

    document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

    const navbar = document.querySelector('nav');
    window.addEventListener('scroll', () => {
      navbar.style.background = window.scrollY > 50 ? 'rgba(4,4,10,0.95)' : 'rgba(4,4,10,0.75)';
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          e.preventDefault();
          window.scrollTo({ top: target.offsetTop - 80, behavior: 'smooth' });
        }
      });
    });
  </script>
</body>
</html>
