@extends('layouts.app')

@section('title', 'Beranda | RuangKonsul')

@section('meta_description', 'RuangKonsul - Konsultasi kesehatan online profesional')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
/* ===================================================================
   HOMEPAGE REDESIGN — MODERN, DYNAMIC & EYE-CATCHING
   =================================================================== */

/* ---------- UTILITY ---------- */
.hp-font { font-family: 'Inter', sans-serif; }

/* ---------- HERO ---------- */
.hp-hero {
    position: relative;
    min-height: 92vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 40%, #223a66 100%);
    overflow: hidden;
    font-family: 'Inter', sans-serif;
}

.hp-hero::before {
    content: '';
    position: absolute;
    top: -30%;
    right: -15%;
    width: 700px;
    height: 700px;
    background: radial-gradient(circle, rgba(225,36,84,0.12) 0%, transparent 70%);
    border-radius: 50%;
    animation: hp-pulse 6s ease-in-out infinite;
}

.hp-hero::after {
    content: '';
    position: absolute;
    bottom: -25%;
    left: -10%;
    width: 550px;
    height: 550px;
    background: radial-gradient(circle, rgba(59,130,246,0.09) 0%, transparent 70%);
    border-radius: 50%;
    animation: hp-pulse 7s ease-in-out infinite reverse;
}

@keyframes hp-pulse {
    0%,100% { transform: scale(1); opacity:.5; }
    50%     { transform: scale(1.12); opacity:1; }
}

/* floating particles */
.hp-particles { position:absolute;inset:0;pointer-events:none;z-index:1; }
.hp-particles span {
    position:absolute;
    width:5px;height:5px;border-radius:50%;
    background:rgba(255,255,255,.12);
    animation: hp-float 7s ease-in-out infinite;
}
.hp-particles span:nth-child(1){top:18%;left:8%;animation-delay:0s;}
.hp-particles span:nth-child(2){top:55%;left:88%;animation-delay:1.2s;width:7px;height:7px;}
.hp-particles span:nth-child(3){top:38%;left:65%;animation-delay:2.4s;}
.hp-particles span:nth-child(4){top:72%;left:22%;animation-delay:3.6s;width:4px;height:4px;}
.hp-particles span:nth-child(5){top:12%;left:50%;animation-delay:4.8s;}
.hp-particles span:nth-child(6){top:82%;left:45%;animation-delay:2s;width:6px;height:6px;}
.hp-particles span:nth-child(7){top:28%;left:30%;animation-delay:5.2s;}
.hp-particles span:nth-child(8){top:65%;left:72%;animation-delay:1.6s;width:3px;height:3px;}

@keyframes hp-float {
    0%,100% { transform:translateY(0) scale(1); opacity:.25; }
    50%     { transform:translateY(-22px) scale(1.6); opacity:.8; }
}

.hp-hero-inner { position:relative;z-index:2; }

.hp-hero-badge {
    display:inline-flex;align-items:center;gap:8px;
    background:rgba(255,255,255,.07);
    backdrop-filter:blur(10px);
    border:1px solid rgba(255,255,255,.1);
    padding:8px 20px;border-radius:50px;
    color:rgba(255,255,255,.85);
    font-size:13px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;
    margin-bottom:28px;
    animation: hp-fadeDown .8s ease both;
}
.hp-hero-badge i { color:#e12454;font-size:16px; }

.hp-hero h1 {
    font-size:54px;font-weight:800;color:#fff;
    line-height:1.15;letter-spacing:-1.2px;
    margin-bottom:22px;
    animation: hp-fadeUp .8s ease .15s both;
}
.hp-hero h1 span {
    background:linear-gradient(135deg,#e12454,#ff6b8a);
    -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
}

.hp-hero-desc {
    font-size:18px;color:rgba(255,255,255,.68);
    max-width:540px;line-height:1.75;
    margin-bottom:36px;
    animation: hp-fadeUp .8s ease .3s both;
}

.hp-hero-actions {
    display:flex;gap:16px;flex-wrap:wrap;
    animation: hp-fadeUp .8s ease .45s both;
}

.hp-btn-primary {
    display:inline-flex;align-items:center;gap:10px;
    padding:16px 34px;
    background:linear-gradient(135deg,#e12454,#ff4d6d);
    color:#fff !important;font-size:15px;font-weight:700;
    border-radius:50px;text-decoration:none !important;
    box-shadow:0 8px 28px rgba(225,36,84,.3);
    transition:all .3s ease;text-transform:uppercase;letter-spacing:.8px;
}
.hp-btn-primary:hover {
    transform:translateY(-3px);
    box-shadow:0 12px 36px rgba(225,36,84,.4);
    background:linear-gradient(135deg,#c91e47,#e12454);
    color:#fff !important;
}
.hp-btn-primary i { font-size:13px;transition:transform .3s; }
.hp-btn-primary:hover i { transform:translateX(4px); }

.hp-btn-outline {
    display:inline-flex;align-items:center;gap:10px;
    padding:16px 34px;
    background:transparent;
    border:2px solid rgba(255,255,255,.25);
    color:#fff !important;font-size:15px;font-weight:600;
    border-radius:50px;text-decoration:none !important;
    transition:all .3s ease;letter-spacing:.5px;
}
.hp-btn-outline:hover {
    background:rgba(255,255,255,.08);
    border-color:rgba(255,255,255,.4);
    transform:translateY(-2px);
    color:#fff !important;
}

/* Hero right visual */
.hp-hero-visual {
    position:relative;
    display:flex;align-items:center;justify-content:center;
    animation: hp-fadeUp 1s ease .5s both;
}

.hp-hero-img-wrap {
    position:relative;
    border-radius:24px;
    overflow:hidden;
    box-shadow:0 30px 60px rgba(0,0,0,.25);
}

.hp-hero-img-wrap img {
    width:100%;height:auto;display:block;
    border-radius:24px;
}

/* glass stat cards on hero image */
.hp-hero-stat {
    position:absolute;
    background:rgba(255,255,255,.12);
    backdrop-filter:blur(16px);
    border:1px solid rgba(255,255,255,.15);
    border-radius:16px;padding:16px 20px;
    color:#fff;
    z-index:3;
    animation: hp-fadeUp 1s ease .7s both;
}
.hp-hero-stat.stat-1 { bottom:24px;left:-30px; }
.hp-hero-stat.stat-2 { top:24px;right:-24px; }

.hp-hero-stat .stat-val { font-size:28px;font-weight:800;line-height:1; }
.hp-hero-stat .stat-val small { font-size:14px;color:#e12454;font-weight:700; }
.hp-hero-stat .stat-lbl { font-size:12px;opacity:.75;margin-top:4px; }

@keyframes hp-fadeDown { from{opacity:0;transform:translateY(-20px)}to{opacity:1;transform:translateY(0)} }
@keyframes hp-fadeUp   { from{opacity:0;transform:translateY(30px)} to{opacity:1;transform:translateY(0)} }

/* ---------- SCHEDULE BANNER ---------- */
.hp-schedule-bar {
    background: linear-gradient(135deg, #f0f6ff 0%, #e8f0fe 100%);
    border-bottom: 1px solid rgba(34,58,102,.06);
    padding: 28px 0;
    font-family:'Inter',sans-serif;
}
.hp-schedule-bar .bar-inner {
    display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;
}
.hp-schedule-bar h4 { color:#223a66;font-weight:700;margin:0 0 4px; }
.hp-schedule-bar p  { color:#6b7c93;margin:0; }
.hp-schedule-bar .btn-sched {
    display:inline-flex;align-items:center;gap:8px;
    padding:12px 28px;
    background:linear-gradient(135deg,#223a66,#2b4f8a);
    color:#fff !important;font-weight:700;font-size:14px;
    border-radius:50px;text-decoration:none !important;
    transition:all .3s;text-transform:uppercase;letter-spacing:.5px;
    box-shadow:0 4px 16px rgba(34,58,102,.2);
}
.hp-schedule-bar .btn-sched:hover {
    transform:translateY(-2px);box-shadow:0 8px 24px rgba(34,58,102,.3);
    color:#fff !important;
}

/* ---------- ABOUT SECTION ---------- */
.hp-about {
    padding:100px 0;
    background:#fff;
    font-family:'Inter',sans-serif;
}

.hp-about-label {
    display:inline-flex;align-items:center;gap:8px;
    background:linear-gradient(135deg,rgba(225,36,84,.08),rgba(225,36,84,.02));
    border:1px solid rgba(225,36,84,.1);
    padding:6px 18px;border-radius:50px;
    color:#e12454;font-size:12px;font-weight:700;
    text-transform:uppercase;letter-spacing:1.5px;
    margin-bottom:20px;
}

.hp-about h2 {
    font-size:36px;font-weight:800;color:#1a2d4d;
    margin-bottom:20px;letter-spacing:-.5px;line-height:1.2;
}

.hp-about-text {
    font-size:16px;color:#6b7c93;line-height:1.8;margin-bottom:20px;
}

.hp-about-features {
    list-style:none;padding:0;margin:0 0 30px;
}
.hp-about-features li {
    display:flex;align-items:center;gap:12px;
    font-size:15px;color:#3d5a80;font-weight:500;
    padding:10px 0;
    border-bottom:1px solid rgba(0,0,0,.04);
}
.hp-about-features li:last-child{border-bottom:none;}
.hp-about-features li .feat-icon {
    width:36px;height:36px;border-radius:10px;
    display:flex;align-items:center;justify-content:center;
    flex-shrink:0;
}
.hp-about-features li .feat-icon i { font-size:16px;color:#fff; }
.hp-about-features li:nth-child(1) .feat-icon { background:linear-gradient(135deg,#e12454,#ff6b8a); }
.hp-about-features li:nth-child(2) .feat-icon { background:linear-gradient(135deg,#2563eb,#60a5fa); }
.hp-about-features li:nth-child(3) .feat-icon { background:linear-gradient(135deg,#0d9488,#5eead4); }

.hp-about-img {
    position:relative;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 24px 48px rgba(0,42,106,.1);
}
.hp-about-img img { width:100%;height:auto;display:block;border-radius:20px; }

/* floating badge on about image */
.hp-about-badge {
    position:absolute;bottom:20px;left:20px;
    background:rgba(255,255,255,.95);
    backdrop-filter:blur(12px);
    border-radius:14px;padding:16px 22px;
    box-shadow:0 8px 24px rgba(0,0,0,.1);
    display:flex;align-items:center;gap:14px;
}
.hp-about-badge .badge-icon {
    width:48px;height:48px;border-radius:12px;
    background:linear-gradient(135deg,#223a66,#2b4f8a);
    display:flex;align-items:center;justify-content:center;
}
.hp-about-badge .badge-icon i { color:#fff;font-size:20px; }
.hp-about-badge .badge-text { line-height:1.3; }
.hp-about-badge .badge-text strong { display:block;color:#1a2d4d;font-size:16px; }
.hp-about-badge .badge-text span { color:#6b7c93;font-size:12px; }

/* ---------- HIGHLIGHT CARDS ---------- */
.hp-highlight {
    padding:0 0 80px;
    background:#fff;
    margin-top:-40px;
    position:relative;
    z-index:5;
    font-family:'Inter',sans-serif;
}

.hp-highlight-grid {
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:24px;
}

.hp-hl-card {
    background:#fff;
    border-radius:18px;
    padding:36px 28px 32px;
    box-shadow:0 8px 30px rgba(0,42,106,.07);
    border:1px solid rgba(0,0,0,.03);
    transition:all .35s ease;
    position:relative;overflow:hidden;
}

.hp-hl-card::before {
    content:'';position:absolute;top:0;left:0;right:0;height:4px;
    background:var(--hl-accent,linear-gradient(90deg,#e12454,#ff6b8a));
    transform:scaleX(0);transform-origin:left;transition:transform .35s;
}
.hp-hl-card:hover::before { transform:scaleX(1); }

.hp-hl-card:hover {
    transform:translateY(-8px);
    box-shadow:0 16px 44px rgba(0,42,106,.12);
}

.hp-hl-icon {
    width:56px;height:56px;border-radius:14px;
    display:flex;align-items:center;justify-content:center;
    margin-bottom:20px;
}
.hp-hl-icon i { font-size:26px;color:#fff; }

.hp-hl-card:nth-child(1) .hp-hl-icon { background:linear-gradient(135deg,#e12454,#ff6b8a); }
.hp-hl-card:nth-child(1) { --hl-accent:linear-gradient(90deg,#e12454,#ff6b8a); }
.hp-hl-card:nth-child(2) .hp-hl-icon { background:linear-gradient(135deg,#2563eb,#60a5fa); }
.hp-hl-card:nth-child(2) { --hl-accent:linear-gradient(90deg,#2563eb,#60a5fa); }
.hp-hl-card:nth-child(3) .hp-hl-icon { background:linear-gradient(135deg,#0d9488,#34d399); }
.hp-hl-card:nth-child(3) { --hl-accent:linear-gradient(90deg,#0d9488,#34d399); }

.hp-hl-card h4 { font-size:18px;font-weight:700;color:#1a2d4d;margin-bottom:8px; }
.hp-hl-card span { font-size:13px;color:#e12454;font-weight:600;text-transform:uppercase;letter-spacing:1px;display:block;margin-bottom:10px; }
.hp-hl-card p  { font-size:14px;color:#6b7c93;line-height:1.65;margin:0; }

.hp-hl-card .w-hours li {
    font-size:14px;color:#6b7c93;
    padding:7px 0;
    border-bottom:1px solid rgba(0,0,0,.04);
}
.hp-hl-card .w-hours li:last-child { border:none; }

/* ---------- STATS ---------- */
.hp-stats {
    padding:70px 0;
    background:linear-gradient(135deg,#223a66 0%,#1a2d4d 50%,#0f172a 100%);
    position:relative;overflow:hidden;
    font-family:'Inter',sans-serif;
}
.hp-stats::before {
    content:'';position:absolute;top:-80px;right:-60px;
    width:350px;height:350px;
    background:radial-gradient(circle,rgba(225,36,84,.1),transparent 60%);
    border-radius:50%;
}
.hp-stats-grid {
    display:flex;justify-content:center;gap:60px;flex-wrap:wrap;
    position:relative;z-index:1;
}
.hp-stat-item { text-align:center; }
.hp-stat-item .val { font-size:48px;font-weight:800;color:#fff;line-height:1; }
.hp-stat-item .val small { color:#e12454;font-size:22px;font-weight:700; }
.hp-stat-item .lbl { font-size:13px;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:1.5px;font-weight:500;margin-top:8px; }

/* ---------- SERVICES ---------- */
.hp-services {
    padding:100px 0 80px;
    background:linear-gradient(180deg,#f8faff 0%,#fff 100%);
    font-family:'Inter',sans-serif;
}

.hp-section-hdr { text-align:center;margin-bottom:64px; }
.hp-section-label {
    display:inline-flex;align-items:center;gap:8px;
    background:linear-gradient(135deg,rgba(225,36,84,.08),rgba(225,36,84,.02));
    border:1px solid rgba(225,36,84,.1);
    padding:6px 18px;border-radius:50px;
    color:#e12454;font-size:12px;font-weight:700;
    text-transform:uppercase;letter-spacing:1.5px;
    margin-bottom:18px;
}
.hp-section-hdr h2 { font-size:36px;font-weight:800;color:#1a2d4d;margin-bottom:14px;letter-spacing:-.5px; }
.hp-section-hdr p  { font-size:16px;color:#6b7c93;max-width:580px;margin:0 auto;line-height:1.7; }

.hp-svc-grid {
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:28px;
}

/* --- service card --- */
.hp-svc-card {
    background:#fff;
    border-radius:18px;
    padding:36px 28px 30px;
    position:relative;overflow:hidden;
    border:1px solid rgba(0,0,0,.04);
    box-shadow:0 4px 20px rgba(0,42,106,.05);
    transition:all .4s cubic-bezier(.25,.46,.45,.94);
    animation:hp-cardIn .6s ease both;
}
.hp-svc-card:nth-child(1){animation-delay:.1s}
.hp-svc-card:nth-child(2){animation-delay:.18s}
.hp-svc-card:nth-child(3){animation-delay:.26s}
.hp-svc-card:nth-child(4){animation-delay:.34s}
.hp-svc-card:nth-child(5){animation-delay:.42s}
.hp-svc-card:nth-child(6){animation-delay:.5s}

@keyframes hp-cardIn { from{opacity:0;transform:translateY(28px)}to{opacity:1;transform:translateY(0)} }

.hp-svc-card::before {
    content:'';position:absolute;top:0;left:0;right:0;height:4px;
    background:linear-gradient(90deg,var(--svc-c1,#e12454),var(--svc-c2,#ff6b8a));
    transform:scaleX(0);transform-origin:left;transition:transform .4s;
}
.hp-svc-card:hover::before { transform:scaleX(1); }

.hp-svc-card:hover {
    transform:translateY(-10px);
    box-shadow:0 20px 48px rgba(0,42,106,.11);
}

.hp-svc-card .svc-num {
    position:absolute;top:16px;right:20px;
    font-size:56px;font-weight:800;
    color:rgba(0,42,106,.03);line-height:1;
    pointer-events:none;transition:color .4s;
}
.hp-svc-card:hover .svc-num { color:rgba(0,42,106,.06); }

.hp-svc-icon {
    width:64px;height:64px;border-radius:16px;
    display:flex;align-items:center;justify-content:center;
    margin-bottom:22px;position:relative;z-index:1;
    transition:all .35s;
    background:var(--svc-bg,linear-gradient(135deg,rgba(225,36,84,.1),rgba(225,36,84,.04)));
}
.hp-svc-icon i { font-size:28px;color:var(--svc-c1,#e12454);transition:all .3s; }
.hp-svc-card:hover .hp-svc-icon { transform:scale(1.06);box-shadow:0 8px 20px var(--svc-shadow,rgba(225,36,84,.15)); }

.hp-svc-card h4 { font-size:19px;font-weight:700;color:#1a2d4d;margin-bottom:12px;position:relative;z-index:1; }
.hp-svc-card p  { font-size:14px;color:#6b7c93;line-height:1.7;margin-bottom:18px;position:relative;z-index:1; }

.hp-svc-link {
    display:inline-flex;align-items:center;gap:8px;
    color:var(--svc-c1,#e12454) !important;font-size:13px;font-weight:700;
    text-decoration:none !important;transition:all .3s;position:relative;z-index:1;
    text-transform:uppercase;letter-spacing:.5px;
}
.hp-svc-link i { font-size:12px;transition:transform .3s; }
.hp-svc-card:hover .hp-svc-link i { transform:translateX(5px); }

/* color variants */
.hp-svc-card.c-mental   { --svc-c1:#e12454;--svc-c2:#ff6b8a;--svc-bg:linear-gradient(135deg,rgba(225,36,84,.1),rgba(225,36,84,.04));--svc-shadow:rgba(225,36,84,.18); }
.hp-svc-card.c-seksual  { --svc-c1:#7c3aed;--svc-c2:#a78bfa;--svc-bg:linear-gradient(135deg,rgba(124,58,237,.1),rgba(124,58,237,.04));--svc-shadow:rgba(124,58,237,.18); }
.hp-svc-card.c-parent   { --svc-c1:#0d9488;--svc-c2:#5eead4;--svc-bg:linear-gradient(135deg,rgba(13,148,136,.1),rgba(13,148,136,.04));--svc-shadow:rgba(13,148,136,.18); }
.hp-svc-card.c-lifestyle{ --svc-c1:#2563eb;--svc-c2:#60a5fa;--svc-bg:linear-gradient(135deg,rgba(37,99,235,.1),rgba(37,99,235,.04));--svc-shadow:rgba(37,99,235,.18); }
.hp-svc-card.c-kronis   { --svc-c1:#d97706;--svc-c2:#fbbf24;--svc-bg:linear-gradient(135deg,rgba(217,119,6,.1),rgba(217,119,6,.04));--svc-shadow:rgba(217,119,6,.18); }
.hp-svc-card.c-nutrisi  { --svc-c1:#16a34a;--svc-c2:#4ade80;--svc-bg:linear-gradient(135deg,rgba(22,163,74,.1),rgba(22,163,74,.04));--svc-shadow:rgba(22,163,74,.18); }

/* ---------- DOCTORS ---------- */
.hp-doctors {
    padding:100px 0;
    background:#fff;
    font-family:'Inter',sans-serif;
}

.hp-doc-img {
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 24px 48px rgba(0,42,106,.1);
    position:relative;
}
.hp-doc-img img { width:100%;height:auto;display:block;border-radius:20px; }

.hp-doc-content h2 {
    font-size:36px;font-weight:800;color:#1a2d4d;
    margin-bottom:20px;letter-spacing:-.5px;
}
.hp-doc-content p {
    font-size:16px;color:#6b7c93;line-height:1.8;
    text-align:justify;margin-bottom:30px;
}

/* ---------- TESTIMONIALS ---------- */
.hp-testi {
    padding:100px 0;
    background:linear-gradient(180deg,#f8faff 0%,#f0f4ff 100%);
    font-family:'Inter',sans-serif;
}

.hp-testi-grid {
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
    gap:28px;
}

.hp-testi-card {
    background:#fff;
    border-radius:18px;
    padding:32px 28px;
    box-shadow:0 4px 20px rgba(0,42,106,.05);
    border:1px solid rgba(0,0,0,.03);
    transition:all .35s;position:relative;
}
.hp-testi-card:hover {
    transform:translateY(-6px);
    box-shadow:0 16px 40px rgba(0,42,106,.1);
}

.hp-testi-card .testi-quote {
    position:absolute;top:20px;right:24px;
    font-size:48px;color:rgba(225,36,84,.08);line-height:1;
}

.hp-testi-top {
    display:flex;align-items:center;gap:14px;margin-bottom:18px;
}
.hp-testi-top img {
    width:56px;height:56px;border-radius:50%;
    object-fit:cover;border:3px solid #f0f4ff;
}
.hp-testi-top .t-name { font-weight:700;color:#1a2d4d;font-size:15px; }
.hp-testi-top .t-role { font-size:12px;color:#6b7c93; }

.hp-testi-card h4 { font-size:16px;font-weight:700;color:#1a2d4d;margin-bottom:10px; }
.hp-testi-card p  { font-size:14px;color:#6b7c93;line-height:1.65;margin:0; }

/* star rating */
.hp-stars { display:flex;gap:3px;margin-bottom:14px; }
.hp-stars i { color:#fbbf24;font-size:14px; }

/* ---------- PARTNERS ---------- */
.hp-partners {
    padding:100px 0;
    background:#fff;
    font-family:'Inter',sans-serif;
}

.hp-partner-grid {
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:28px;
}

.hp-partner-card {
    background:#fff;
    border-radius:18px;
    padding:36px 28px 30px;
    text-align:center;
    box-shadow:0 4px 20px rgba(0,42,106,.05);
    border:1px solid rgba(0,0,0,.04);
    transition:all .35s;
}
.hp-partner-card:hover {
    transform:translateY(-8px);
    box-shadow:0 16px 40px rgba(0,42,106,.1);
}

.hp-partner-logo {
    max-height:72px;object-fit:contain;margin-bottom:18px;
}

.hp-partner-card h4 { font-size:17px;font-weight:700;color:#1a2d4d;margin-bottom:10px; }
.hp-partner-card p  { font-size:14px;color:#6b7c93;line-height:1.6;margin-bottom:14px; }
.hp-partner-card .pdate {
    display:inline-flex;align-items:center;gap:6px;
    font-size:12px;color:#e12454;font-weight:600;
}
.hp-partner-card .pdate i { font-size:14px; }

/* ---------- RESPONSIVE ---------- */
@media(max-width:992px){
    .hp-hero { min-height:auto;padding:120px 0 60px; }
    .hp-hero h1 { font-size:38px; }
    .hp-hero-visual { margin-top:50px; }
    .hp-highlight-grid { grid-template-columns:1fr; }
    .hp-svc-grid { grid-template-columns:repeat(2,1fr); }
    .hp-partner-grid { grid-template-columns:repeat(2,1fr); }
    .hp-stats-grid { gap:40px; }
}
@media(max-width:768px){
    .hp-hero h1 { font-size:32px; }
    .hp-hero-desc { font-size:15px; }
    .hp-hero-stat { display:none; }
    .hp-about h2,.hp-section-hdr h2,.hp-doc-content h2 { font-size:28px; }
    .hp-stat-item .val { font-size:36px; }
    .hp-stats-grid { gap:30px; }
}
@media(max-width:576px){
    .hp-hero h1 { font-size:28px; }
    .hp-hero-actions { flex-direction:column; }
    .hp-svc-grid { grid-template-columns:1fr; }
    .hp-partner-grid { grid-template-columns:1fr; }
    .hp-testi-grid { grid-template-columns:1fr; }
}

/* ==========================================================
   SCROLL-REVEAL ANIMATION SYSTEM
   ========================================================== */

/* --- Base hidden state --- */
.reveal {
    opacity: 0;
    transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    will-change: opacity, transform;
}

/* Directional variants */
.reveal-up    { transform: translateY(50px); }
.reveal-down  { transform: translateY(-50px); }
.reveal-left  { transform: translateX(-60px); }
.reveal-right { transform: translateX(60px); }
.reveal-scale { transform: scale(0.85); }
.reveal-rotate { transform: rotate(-4deg) translateY(30px); }

/* Visible state */
.reveal.revealed {
    opacity: 1;
    transform: translateY(0) translateX(0) scale(1) rotate(0deg);
}

/* Stagger delays for grid children */
.stagger-item { transition-delay: calc(var(--stagger, 0) * 0.12s); }

/* Longer / shorter durations */
.reveal-fast { transition-duration: 0.5s; }
.reveal-slow { transition-duration: 1.1s; }

/* --- Continuous floating animation for decorative elements --- */
@keyframes hp-gentle-float {
    0%, 100% { transform: translateY(0); }
    50%      { transform: translateY(-12px); }
}
.hp-float-anim { animation: hp-gentle-float 3.5s ease-in-out infinite; }

/* --- Shimmer / shine sweep for buttons on scroll --- */
@keyframes hp-shine {
    0%   { left: -75%; }
    100% { left: 125%; }
}
.hp-btn-primary.revealed::after,
.hp-btn-outline.revealed::after {
    content: '';
    position: absolute;
    top: 0; left: -75%;
    width: 50%; height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    animation: hp-shine 0.8s ease 0.6s;
    pointer-events: none;
}
.hp-btn-primary, .hp-btn-outline { position: relative; overflow: hidden; }

/* --- Pulsing glow ring for hero stat cards --- */
@keyframes hp-ring-pulse {
    0%   { box-shadow: 0 0 0 0 rgba(225,36,84,0.25); }
    70%  { box-shadow: 0 0 0 12px rgba(225,36,84,0); }
    100% { box-shadow: 0 0 0 0 rgba(225,36,84,0); }
}
.hp-hero-stat { animation: hp-ring-pulse 2.5s ease-in-out infinite, hp-fadeUp 1s ease .7s both; }

/* --- Typing cursor blink for hero badge --- */
@keyframes hp-blink {
    0%, 100% { opacity: 1; }
    50%      { opacity: 0; }
}
.hp-hero-badge::after {
    content: '|';
    margin-left: 4px;
    animation: hp-blink 1s step-end infinite;
    color: #e12454;
    font-weight: 300;
}

/* --- Icon bounce on card hover --- */
@keyframes hp-icon-bounce {
    0%   { transform: scale(1); }
    40%  { transform: scale(1.18); }
    60%  { transform: scale(0.95); }
    100% { transform: scale(1.06); }
}
.hp-svc-card:hover .hp-svc-icon,
.hp-hl-card:hover .hp-hl-icon {
    animation: hp-icon-bounce 0.5s ease;
}

/* --- About image subtle zoom --- */
.hp-about-img img {
    transition: transform 6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}
.hp-about-img.revealed img {
    transform: scale(1.04);
}

/* --- Stats counter glow --- */
@keyframes hp-count-glow {
    0%   { text-shadow: 0 0 0 transparent; }
    50%  { text-shadow: 0 0 30px rgba(225,36,84,0.3); }
    100% { text-shadow: 0 0 0 transparent; }
}
.hp-stat-item.revealed .val {
    animation: hp-count-glow 1.5s ease 0.5s;
}

/* --- Testimonial card tilt on hover --- */
.hp-testi-card {
    transition: all 0.35s ease, transform 0.4s ease;
}
.hp-testi-card:hover {
    transform: translateY(-6px) rotate(-0.5deg);
}

/* --- Partner logo grayscale -> color on scroll --- */
.hp-partner-logo {
    filter: grayscale(100%);
    transition: filter 0.6s ease, transform 0.4s ease;
}
.hp-partner-card.revealed .hp-partner-logo {
    filter: grayscale(0%);
}
.hp-partner-card:hover .hp-partner-logo {
    transform: scale(1.08);
}

/* --- Section divider line animation --- */
.hp-section-hdr .hp-section-label {
    transition: all 0.6s ease;
}
.hp-section-hdr.revealed .hp-section-label {
    animation: hp-fadeDown 0.6s ease both;
}

/* --- Wave separator between hero and about --- */
.hp-wave-separator {
    position: relative;
    margin-top: -80px;
    z-index: 3;
    line-height: 0;
}
.hp-wave-separator svg {
    display: block;
    width: 100%;
    height: 80px;
}

/* --- Accessibility: respect reduced-motion --- */
@media (prefers-reduced-motion: reduce) {
    .reveal { transition-duration: 0.01s !important; }
    .hp-particles span,
    .hp-hero::before,
    .hp-hero::after,
    .hp-hero-stat,
    .hp-hero-badge::after,
    .hp-float-anim { animation: none !important; }
}

/* --- Responsive animation timing --- */
@media (max-width: 768px) {
    .reveal { transition-duration: 0.6s; }
    .reveal-up { transform: translateY(30px); }
    .reveal-left, .reveal-right { transform: translateX(0) translateY(30px); }
    .stagger-item { transition-delay: calc(var(--stagger, 0) * 0.08s) !important; }
    .hp-wave-separator { margin-top: -40px; }
    .hp-wave-separator svg { height: 40px; }
}
</style>
@endpush

@section('content')

<!-- ===== HERO ===== -->
<section class="hp-hero">
    <div class="hp-particles">
        <span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span>
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hp-hero-inner">
                <div class="hp-hero-badge">
                    <i class="icofont-heart-beat"></i> Health Care Solution
                </div>
                <h1>Solusi Praktis untuk <span>Kesehatan Anda</span></h1>
                <p class="hp-hero-desc">
                    Konsultasi kesehatan yang praktis, profesional, dan aman untuk mendukung keputusan terbaik bagi kesehatan Anda bersama tenaga ahli berpengalaman.
                </p>
                <div class="hp-hero-actions">
                    <a href="{{ url('/appointment') }}" class="hp-btn-primary">
                        Buat Janji Layanan <i class="icofont-long-arrow-right"></i>
                    </a>
                    <a href="{{ url('/pelayanan') }}" class="hp-btn-outline">
                        Jelajahi Layanan
                    </a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="hp-hero-visual">
                    <div class="hp-hero-img-wrap">
                        <img src="{{ asset('images/about/Beranda.jpeg') }}" alt="RuangKonsul">
                    </div>
                    <div class="hp-hero-stat stat-1">
                        <div class="stat-val">40<small>+</small></div>
                        <div class="stat-lbl">Dokter Ahli</div>
                    </div>
                    <div class="hp-hero-stat stat-2">
                        <div class="stat-val">24<small>/7</small></div>
                        <div class="stat-lbl">Layanan Aktif</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Wave separator -->
<div class="hp-wave-separator">
    <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 80L48 74.7C96 69.3 192 58.7 288 53.3C384 48 480 48 576 53.3C672 58.7 768 69.3 864 69.3C960 69.3 1056 58.7 1152 48C1248 37.3 1344 26.7 1392 21.3L1440 16V80H1392C1344 80 1248 80 1152 80C1056 80 960 80 864 80C768 80 672 80 576 80C480 80 384 80 288 80C192 80 96 80 48 80H0Z" fill="white"/>
    </svg>
</div>

<!-- ===== APPOINTMENT SCHEDULE BANNER ===== -->
@if(auth('customer')->check())
    @php
        $hasAppointments = \App\Models\FormAppointment::where('customerId', auth('customer')->user()->customerId)->exists();
    @endphp
    @if($hasAppointments)
    <section class="hp-schedule-bar hp-font">
        <div class="container">
            <div class="bar-inner">
                <div>
                    <h4><i class="icofont-calendar mr-2"></i> Anda memiliki jadwal janji temu aktif</h4>
                    <p>Klik tombol di samping untuk melihat detail jadwal dan riwayat konsultasi Anda.</p>
                </div>
                <a href="{{ route('appointment.schedule') }}" class="btn-sched">
                    <i class="icofont-calendar"></i> Lihat Jadwal Saya
                </a>
            </div>
        </div>
    </section>
    @endif
@endif

<!-- ===== ABOUT ===== -->
<section class="hp-about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 reveal reveal-left">
                <div class="hp-about-label">
                    <i class="icofont-stethoscope-alt"></i> Tentang Kami
                </div>
                <h2>Platform Konsultasi Kesehatan Terpercaya</h2>
                <p class="hp-about-text">
                    RuangKonsul adalah platform konsultasi kesehatan yang membantu Anda
                    mendapatkan pendampingan profesional secara praktis, aman, dan terpercaya.
                </p>
                <p class="hp-about-text">
                    Kami hadir untuk memberikan ruang yang nyaman bagi setiap individu
                    dalam memahami permasalahan kesehatan dan menemukan solusi terbaik
                    dengan dukungan tenaga ahli berpengalaman.
                </p>

                <ul class="hp-about-features">
                    <li>
                        <div class="feat-icon"><i class="icofont-shield-alt"></i></div>
                        Privasi terjamin & aman
                    </li>
                    <li>
                        <div class="feat-icon"><i class="icofont-doctor-alt"></i></div>
                        Ditangani tenaga profesional
                    </li>
                    <li>
                        <div class="feat-icon"><i class="icofont-touch"></i></div>
                        Akses fleksibel & mudah
                    </li>
                </ul>

                <a href="{{ url('/penjelasan') }}" class="hp-btn-primary" style="font-size:14px;padding:14px 30px;">
                    Pelajari Lebih Lanjut <i class="icofont-long-arrow-right"></i>
                </a>
            </div>

            <div class="col-lg-6">
                <div class="hp-about-img reveal reveal-right">
                    <img src="{{ asset('images/about/Beranda.jpeg') }}" alt="Tentang RuangKonsul">
                    <div class="hp-about-badge">
                        <div class="badge-icon">
                            <i class="icofont-heart-beat"></i>
                        </div>
                        <div class="badge-text">
                            <strong>Terpercaya</strong>
                            <span>Sejak 2021</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== HIGHLIGHT CARDS ===== -->
<section class="hp-highlight">
    <div class="container">
        <div class="hp-highlight-grid">

            <div class="hp-hl-card reveal reveal-up hp-tilt stagger-item" style="--stagger:0">
                <div class="hp-hl-icon"><i class="icofont-heartbeat"></i></div>
                <span>Produk Kesehatan Terpadu</span>
                <h4>Alat dan Produk Kesehatan</h4>
                <p>RuangKonsul menyediakan berbagai produk kesehatan mencakup kesehatan mental, kesehatan seksual, parenting, gaya hidup sehat, pengelolaan penyakit kronis, serta gizi dan nutrisi.</p>
                <a href="{{ url('/produk') }}" class="hp-btn-primary" style="font-size:13px;padding:12px 24px;margin-top:16px;">
                    Jelajahi Produk <i class="icofont-long-arrow-right"></i>
                </a>
            </div>

            <div class="hp-hl-card reveal reveal-up hp-tilt stagger-item" style="--stagger:1">
                <div class="hp-hl-icon"><i class="icofont-ui-clock"></i></div>
                <span>Jadwal Operasional</span>
                <h4>Jam Layanan</h4>
                <ul class="w-hours list-unstyled mb-0">
                    <li class="d-flex justify-content-between">
                        Minggu - Rabu <span>08:00 - 17:00</span>
                    </li>
                    <li class="d-flex justify-content-between">
                        Kamis - Jumat <span>09:00 - 17:00</span>
                    </li>
                    <li class="d-flex justify-content-between">
                        Sabtu - Minggu <span>10:00 - 17:00</span>
                    </li>
                </ul>
            </div>

            <div class="hp-hl-card reveal reveal-up hp-tilt stagger-item" style="--stagger:2">
                <div class="hp-hl-icon"><i class="icofont-support"></i></div>
                <span>Layanan Darurat</span>
                <h4>1-800-700-6200</h4>
                <p>Dapatkan dukungan cepat untuk kondisi darurat kapan pun dibutuhkan. Tim kami siap membantu dan menghubungkan Anda dengan layanan medis terbaik.</p>
            </div>

        </div>
    </div>
</section>

<!-- ===== STATS ===== -->
<section class="hp-stats">
    <div class="container">
        <div class="hp-stats-grid">
            <div class="hp-stat-item reveal reveal-up stagger-item" style="--stagger:0">
                <div class="val" data-count="58" data-suffix="k">0<small>k</small></div>
                <div class="lbl">Pengguna Puas</div>
            </div>
            <div class="hp-stat-item reveal reveal-up stagger-item" style="--stagger:1">
                <div class="val" data-count="650" data-suffix="+">0<small>+</small></div>
                <div class="lbl">Konsultasi Selesai</div>
            </div>
            <div class="hp-stat-item reveal reveal-up stagger-item" style="--stagger:2">
                <div class="val" data-count="40" data-suffix="+">0<small>+</small></div>
                <div class="lbl">Dokter Ahli</div>
            </div>
            <div class="hp-stat-item reveal reveal-up stagger-item" style="--stagger:3">
                <div class="val" data-count="20" data-suffix="+">0<small>+</small></div>
                <div class="lbl">Cabang</div>
            </div>
        </div>
    </div>
</section>

<!-- ===== SERVICES ===== -->
<section class="hp-services">
    <div class="container">
        <div class="hp-section-hdr reveal reveal-up">
            <div class="hp-section-label">
                <i class="icofont-stethoscope-alt"></i> Pelayanan Kami
            </div>
            <h2>Layanan Unggulan Kami</h2>
            <p>Kami menyediakan berbagai layanan konsultasi yang dirancang untuk membantu Anda memahami permasalahan secara menyeluruh dan menemukan solusi yang tepat.</p>
        </div>

        <div class="hp-svc-grid">

            <div class="hp-svc-card c-mental reveal reveal-up hp-tilt stagger-item" style="--stagger:0">
                <span class="svc-num">01</span>
                <div class="hp-svc-icon"><i class="icofont-brain-alt"></i></div>
                <h4>Kesehatan Mental</h4>
                <p>Layanan konsultasi profesional untuk membantu mengelola stres, kecemasan, dan kesehatan mental secara aman, rahasia, dan berkelanjutan.</p>
                <a href="{{ url('/jelajahi1') }}" class="hp-svc-link">Jelajahi <i class="icofont-long-arrow-right"></i></a>
            </div>

            <div class="hp-svc-card c-seksual reveal reveal-up hp-tilt stagger-item" style="--stagger:1">
                <span class="svc-num">02</span>
                <div class="hp-svc-icon"><i class="icofont-heart-beat"></i></div>
                <h4>Kesehatan Seksual</h4>
                <p>Konsultasi privat dan terpercaya untuk menjaga kesehatan seksual serta menangani permasalahan dengan pendekatan profesional.</p>
                <a href="{{ url('/jelajahi2') }}" class="hp-svc-link">Jelajahi <i class="icofont-long-arrow-right"></i></a>
            </div>

            <div class="hp-svc-card c-parent reveal reveal-up hp-tilt stagger-item" style="--stagger:2">
                <span class="svc-num">03</span>
                <div class="hp-svc-icon"><i class="icofont-baby"></i></div>
                <h4>Parenting</h4>
                <p>Pendampingan dan konsultasi bagi orang tua untuk mendukung tumbuh kembang anak secara sehat, optimal, dan penuh kesadaran.</p>
                <a href="{{ url('/jelajahi3') }}" class="hp-svc-link">Jelajahi <i class="icofont-long-arrow-right"></i></a>
            </div>

            <div class="hp-svc-card c-lifestyle reveal reveal-up hp-tilt stagger-item" style="--stagger:3">
                <span class="svc-num">04</span>
                <div class="hp-svc-icon"><i class="icofont-heart-beat-alt"></i></div>
                <h4>Gaya Hidup Sehat</h4>
                <p>Panduan dan konsultasi untuk membangun pola hidup sehat, seimbang, serta kebiasaan positif yang berkelanjutan.</p>
                <a href="{{ url('/jelajahi4') }}" class="hp-svc-link">Jelajahi <i class="icofont-long-arrow-right"></i></a>
            </div>

            <div class="hp-svc-card c-kronis reveal reveal-up hp-tilt stagger-item" style="--stagger:4">
                <span class="svc-num">05</span>
                <div class="hp-svc-icon"><i class="icofont-medical-sign-alt"></i></div>
                <h4>Penyakit Kronis</h4>
                <p>Pendampingan dan konsultasi berkelanjutan untuk membantu pengelolaan penyakit kronis secara tepat dan terarah.</p>
                <a href="{{ url('/jelajahi5') }}" class="hp-svc-link">Jelajahi <i class="icofont-long-arrow-right"></i></a>
            </div>

            <div class="hp-svc-card c-nutrisi reveal reveal-up hp-tilt stagger-item" style="--stagger:5">
                <span class="svc-num">06</span>
                <div class="hp-svc-icon"><i class="icofont-apple"></i></div>
                <h4>Gizi / Nutrisi</h4>
                <p>Konsultasi gizi dan nutrisi untuk membantu memenuhi kebutuhan tubuh serta menjaga kesehatan jangka panjang.</p>
                <a href="{{ url('/jelajahi6') }}" class="hp-svc-link">Jelajahi <i class="icofont-long-arrow-right"></i></a>
            </div>

        </div>
    </div>
</section>

<!-- ===== DOCTORS ===== -->
<section class="hp-doctors">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="hp-doc-img reveal reveal-left">
                    <img src="{{ asset('images/about/Foto dokter.jpeg') }}" alt="Dokter RuangKonsul">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hp-doc-content reveal reveal-right">
                    <div class="hp-about-label">
                        <i class="icofont-doctor-alt"></i> Tim Profesional
                    </div>
                    <h2>Dokter Ahli & Berpengalaman</h2>
                    <p>
                        Seluruh tenaga kerja kesehatan RuangKonsul telah memiliki standarisasi
                        kompetensi sesuai dengan bidang keahlian masing-masing serta berpengalaman
                        dalam memberikan pelayanan medis secara profesional. Tim dokter kami siap
                        memberikan konsultasi kesehatan secara cepat, aman, dan terpercaya guna
                        membantu Anda mendapatkan solusi terbaik untuk setiap permasalahan kesehatan
                        yang dihadapi, kapan pun dan di mana pun Anda berada.
                    </p>
                    <a href="{{ route('landing.dokter.kategori') }}" class="hp-btn-primary" style="font-size:14px;padding:14px 30px;">
                        Jelajahi Dokter <i class="icofont-long-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== TESTIMONIALS ===== -->
<section class="hp-testi">
    <div class="container">
        <div class="hp-section-hdr reveal reveal-up">
            <div class="hp-section-label">
                <i class="icofont-quote-right"></i> Testimoni
            </div>
            <h2>Testimoni Pengguna</h2>
            <p>Pengalaman nyata dari para pengguna yang telah merasakan manfaat layanan konsultasi di RuangKonsul.</p>
        </div>

        <div class="hp-testi-grid">

            <div class="hp-testi-card reveal reveal-up hp-tilt stagger-item" style="--stagger:0">
                <span class="testi-quote"><i class="icofont-quote-right"></i></span>
                <div class="hp-testi-top">
                    <img src="{{ asset('images/team/testi 1.jpeg') }}" alt="Andi Pratama">
                    <div>
                        <div class="t-name">Andi Pratama</div>
                        <div class="t-role">Pengguna Aktif</div>
                    </div>
                </div>
                <div class="hp-stars">
                    <i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i>
                </div>
                <h4>Layanan yang sangat membantu!</h4>
                <p>Konsultasi di RuangKonsul sangat praktis dan nyaman. Penjelasan yang diberikan jelas dan mudah dipahami.</p>
            </div>

            <div class="hp-testi-card reveal reveal-up hp-tilt stagger-item" style="--stagger:1">
                <span class="testi-quote"><i class="icofont-quote-right"></i></span>
                <div class="hp-testi-top">
                    <img src="{{ asset('images/team/testi 2.jpeg') }}" alt="Siti Aisyah">
                    <div>
                        <div class="t-name">Siti Aisyah</div>
                        <div class="t-role">Pengguna Aktif</div>
                    </div>
                </div>
                <div class="hp-stars">
                    <i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i>
                </div>
                <h4>Tenaga profesional & responsif</h4>
                <p>Saya merasa didengarkan dan dibimbing dengan baik. Layanannya aman dan menjaga privasi.</p>
            </div>

            <div class="hp-testi-card reveal reveal-up hp-tilt stagger-item" style="--stagger:2">
                <span class="testi-quote"><i class="icofont-quote-right"></i></span>
                <div class="hp-testi-top">
                    <img src="{{ asset('images/team/testi 3.jpeg') }}" alt="Budi Santoso">
                    <div>
                        <div class="t-name">Budi Santoso</div>
                        <div class="t-role">Pengguna Aktif</div>
                    </div>
                </div>
                <div class="hp-stars">
                    <i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i>
                </div>
                <h4>Sangat direkomendasikan</h4>
                <p>RuangKonsul membantu saya memahami kondisi kesehatan dengan lebih tenang dan terarah.</p>
            </div>

            <div class="hp-testi-card reveal reveal-up hp-tilt stagger-item" style="--stagger:3">
                <span class="testi-quote"><i class="icofont-quote-right"></i></span>
                <div class="hp-testi-top">
                    <img src="{{ asset('images/team/testi 2.jpeg') }}" alt="Dewi Lestari">
                    <div>
                        <div class="t-name">Dewi Lestari</div>
                        <div class="t-role">Pengguna Aktif</div>
                    </div>
                </div>
                <div class="hp-stars">
                    <i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i>
                </div>
                <h4>Pelayanan nyaman & terpercaya</h4>
                <p>Saya merasa lebih percaya diri setelah berkonsultasi. Prosesnya mudah dan tidak ribet.</p>
            </div>

            <div class="hp-testi-card reveal reveal-up hp-tilt stagger-item" style="--stagger:4">
                <span class="testi-quote"><i class="icofont-quote-right"></i></span>
                <div class="hp-testi-top">
                    <img src="{{ asset('images/team/testi 1.jpeg') }}" alt="Rizky Maulana">
                    <div>
                        <div class="t-name">Rizky Maulana</div>
                        <div class="t-role">Pengguna Aktif</div>
                    </div>
                </div>
                <div class="hp-stars">
                    <i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i>
                </div>
                <h4>Layanan modern & solutif</h4>
                <p>Konsultasi online yang sangat membantu di tengah kesibukan. Solusi yang diberikan benar-benar relevan.</p>
            </div>

        </div>
    </div>
</section>

<!-- ===== PARTNERS ===== -->
<section class="hp-partners">
    <div class="container">
        <div class="hp-section-hdr reveal reveal-up">
            <div class="hp-section-label">
                <i class="icofont-building"></i> Mitra Kami
            </div>
            <h2>Kerja Sama Rumah Sakit</h2>
            <p>RuangKonsul bekerja sama dengan rumah sakit terpercaya di Indonesia untuk menghadirkan layanan kesehatan yang aman, profesional, dan terintegrasi.</p>
        </div>

        <div class="hp-partner-grid">

            <div class="hp-partner-card reveal reveal-up stagger-item" style="--stagger:0">
                <img src="{{ asset('images/about/RSCM.png') }}" alt="RSUPN Dr. Cipto Mangunkusumo" class="hp-partner-logo">
                <h4>RSUPN Dr. Cipto Mangunkusumo</h4>
                <p>Rumah sakit rujukan nasional yang menyediakan layanan medis dan kesehatan mental berbasis standar internasional.</p>
                <span class="pdate"><i class="icofont-calendar"></i> Bekerja sama sejak 2021</span>
            </div>

            <div class="hp-partner-card reveal reveal-up stagger-item" style="--stagger:1">
                <img src="{{ asset('images/about/Siloam.svg') }}" alt="Siloam Hospitals" class="hp-partner-logo">
                <h4>Siloam Hospitals Group</h4>
                <p>Jaringan rumah sakit swasta terbesar di Indonesia dengan layanan konsultasi medis dan psikologis berbasis teknologi digital.</p>
                <span class="pdate"><i class="icofont-calendar"></i> Bekerja sama sejak 2022</span>
            </div>

            <div class="hp-partner-card reveal reveal-up stagger-item" style="--stagger:2">
                <img src="{{ asset('images/about/RS pertamina.png') }}" alt="RS Pertamina Pusat" class="hp-partner-logo">
                <h4>RS Pertamina Pusat</h4>
                <p>Rumah sakit nasional dengan fokus layanan kesehatan terpadu dan dukungan kesehatan mental bagi masyarakat luas.</p>
                <span class="pdate"><i class="icofont-calendar"></i> Bekerja sama sejak 2023</span>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    // =========================================================
    //  1. SCROLL-REVEAL  (IntersectionObserver)
    // =========================================================
    const revealEls = document.querySelectorAll('.reveal');

    if ('IntersectionObserver' in window) {
        const revealObs = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    revealObs.unobserve(entry.target); // animate once
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

        revealEls.forEach(function(el) { revealObs.observe(el); });
    } else {
        // fallback: show everything
        revealEls.forEach(function(el) { el.classList.add('revealed'); });
    }

    // =========================================================
    //  2. COUNTER ANIMATION  (counts from 0 → target)
    // =========================================================
    const counters = document.querySelectorAll('[data-count]');

    function animateCounter(el) {
        const target = parseInt(el.getAttribute('data-count'), 10);
        const suffix = el.getAttribute('data-suffix') || '';
        const duration = 2000; // ms
        const startTime = performance.now();

        function update(now) {
            const elapsed = now - startTime;
            const progress = Math.min(elapsed / duration, 1);
            // ease-out quad
            const eased = 1 - (1 - progress) * (1 - progress);
            const current = Math.floor(eased * target);
            el.innerHTML = current + '<small>' + suffix + '</small>';
            if (progress < 1) requestAnimationFrame(update);
        }
        requestAnimationFrame(update);
    }

    if ('IntersectionObserver' in window) {
        const counterObs = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    counterObs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(function(el) { counterObs.observe(el); });
    } else {
        counters.forEach(function(el) { animateCounter(el); });
    }

    // =========================================================
    //  3. PARALLAX-LITE  (subtle Y shift on scroll)
    // =========================================================
    const parallaxEls = document.querySelectorAll('[data-parallax]');
    let ticking = false;

    function onScroll() {
        if (!ticking) {
            requestAnimationFrame(function() {
                const scrollY = window.pageYOffset;
                parallaxEls.forEach(function(el) {
                    const speed = parseFloat(el.getAttribute('data-parallax')) || 0.15;
                    const rect = el.getBoundingClientRect();
                    if (rect.top < window.innerHeight && rect.bottom > 0) {
                        const offset = (scrollY - el.offsetTop) * speed;
                        el.style.transform = 'translateY(' + offset + 'px)';
                    }
                });
                ticking = false;
            });
            ticking = true;
        }
    }
    window.addEventListener('scroll', onScroll, { passive: true });

    // =========================================================
    //  4. TILT ON HOVER  (3D perspective tilt for cards)
    // =========================================================
    document.querySelectorAll('.hp-tilt').forEach(function(card) {
        card.addEventListener('mousemove', function(e) {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = ((y - centerY) / centerY) * -6;
            const rotateY = ((x - centerX) / centerX) * 6;
            card.style.transform = 'perspective(800px) rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg) translateY(-8px)';
        });
        card.addEventListener('mouseleave', function() {
            card.style.transform = 'perspective(800px) rotateX(0) rotateY(0) translateY(0)';
            card.style.transition = 'transform 0.5s ease';
        });
        card.addEventListener('mouseenter', function() {
            card.style.transition = 'transform 0.15s ease';
        });
    });

    // =========================================================
    //  5. SMOOTH SCROLL for anchor links
    // =========================================================
    document.querySelectorAll('a[href^="#"]').forEach(function(link) {
        link.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

});
</script>
@endpush