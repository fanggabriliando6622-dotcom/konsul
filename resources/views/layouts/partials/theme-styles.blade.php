<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
/* =======================================================
   RUANGKONSUL UNIFIED THEME — Shared across all pages
   ======================================================= */

/* --- Font --- */
.rk-page { font-family: 'Inter', sans-serif; }

/* --- Page Hero (replaces old page-title bg-1) --- */
.rk-hero {
    position: relative;
    padding: 160px 0 100px;
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 40%, #223a66 100%);
    overflow: hidden;
    font-family: 'Inter', sans-serif;
}
.rk-hero::before {
    content: '';
    position: absolute;
    top: -40%;
    right: -15%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(225,36,84,0.12) 0%, transparent 70%);
    border-radius: 50%;
    animation: rkPulse 5s ease-in-out infinite;
}
.rk-hero::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -10%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(59,130,246,0.08) 0%, transparent 70%);
    border-radius: 50%;
    animation: rkPulse 6s ease-in-out infinite reverse;
}
@keyframes rkPulse {
    0%, 100% { transform: scale(1); opacity: 0.5; }
    50%      { transform: scale(1.1); opacity: 1; }
}

/* Floating dots in hero */
.rk-hero-dots { position: absolute; inset: 0; pointer-events: none; z-index: 1; }
.rk-hero-dots span {
    position: absolute;
    width: 5px; height: 5px;
    border-radius: 50%;
    background: rgba(255,255,255,0.12);
    animation: rkDotFloat 6s ease-in-out infinite;
}
.rk-hero-dots span:nth-child(1) { top: 20%; left: 10%; animation-delay: 0s; }
.rk-hero-dots span:nth-child(2) { top: 55%; left: 85%; animation-delay: 1.2s; width: 7px; height: 7px; }
.rk-hero-dots span:nth-child(3) { top: 35%; left: 65%; animation-delay: 2.4s; }
.rk-hero-dots span:nth-child(4) { top: 75%; left: 22%; animation-delay: 3.6s; width: 4px; height: 4px; }
@keyframes rkDotFloat {
    0%, 100% { transform: translateY(0) scale(1); opacity: 0.2; }
    50%      { transform: translateY(-18px) scale(1.5); opacity: 0.7; }
}

.rk-hero-inner {
    position: relative;
    z-index: 2;
    text-align: center;
}

.rk-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.07);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,1);
    padding: 8px 20px;
    border-radius: 50px;
    color: rgba(255,255,255,1);
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    margin-bottom: 24px;
    animation: rkFadeDown 0.8s ease both;
}
.rk-hero-badge i { color: #e12454; font-size: 16px; }

.rk-hero h1 {
    font-size: 48px;
    font-weight: 800;
    color: #fff;
    line-height: 1.15;
    letter-spacing: -1px;
    margin-bottom: 18px;
    animation: rkFadeUp 0.8s ease 0.15s both;
}
.rk-hero h1 span {
    background: linear-gradient(135deg, #e12454, #ff6b8a);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.rk-hero-desc {
    font-size: 17px;
    color: rgba(255,255,255,0.65);
    max-width: 620px;
    margin: 0 auto;
    line-height: 1.7;
    animation: rkFadeUp 0.8s ease 0.3s both;
}

@keyframes rkFadeDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
@keyframes rkFadeUp   { from { opacity: 0; transform: translateY(30px); }  to { opacity: 1; transform: translateY(0); } }

/* --- Wave Separator --- */
.rk-wave {
    position: relative;
    margin-top: -80px;
    z-index: 3;
    line-height: 0;
}
.rk-wave svg {
    display: block;
    width: 100%;
    height: 80px;
}

/* --- Section Headers --- */
.rk-section-hdr { text-align: center; margin-bottom: 60px; font-family: 'Inter', sans-serif; }
.rk-section-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, rgba(225,36,84,0.08), rgba(225,36,84,0.02));
    border: 1px solid rgba(225,36,84,0.1);
    padding: 6px 18px;
    border-radius: 50px;
    color: #e12454;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-bottom: 18px;
}
.rk-section-hdr h2 { font-size: 34px; font-weight: 800; color: #1a2d4d; margin-bottom: 14px; letter-spacing: -0.5px; }
.rk-section-hdr p  { font-size: 16px; color: #6b7c93; max-width: 600px; margin: 0 auto; line-height: 1.7; }

/* --- Shared Card Style --- */
.rk-card {
    background: #fff;
    border-radius: 18px;
    padding: 36px 28px 30px;
    box-shadow: 0 4px 20px rgba(0,42,106,0.05);
    border: 1px solid rgba(0,0,0,0.04);
    transition: all 0.35s ease;
    position: relative;
    overflow: hidden;
}
.rk-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: var(--rk-card-accent, linear-gradient(90deg, #e12454, #ff6b8a));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.35s;
}
.rk-card:hover::before { transform: scaleX(1); }
.rk-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 44px rgba(0,42,106,0.1);
}

/* --- Shared icon box --- */
.rk-icon-box {
    width: 64px; height: 64px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    transition: all 0.35s;
}
.rk-icon-box i { font-size: 28px; color: #fff; }

/* --- Shared CTA button --- */
.rk-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 15px 32px;
    background: linear-gradient(135deg, #e12454, #ff4d6d);
    color: #fff !important;
    font-size: 14px;
    font-weight: 700;
    border-radius: 50px;
    text-decoration: none !important;
    box-shadow: 0 6px 24px rgba(225,36,84,0.25);
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    border: none;
    cursor: pointer;
}
.rk-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 32px rgba(225,36,84,0.35);
    background: linear-gradient(135deg, #c91e47, #e12454);
    color: #fff !important;
}
.rk-btn i { font-size: 13px; transition: transform 0.3s; }
.rk-btn:hover i { transform: translateX(4px); }

.rk-btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 32px;
    background: transparent;
    border: 2px solid #223a66;
    color: #223a66 !important;
    font-size: 14px;
    font-weight: 700;
    border-radius: 50px;
    text-decoration: none !important;
    transition: all 0.3s;
}
.rk-btn-outline:hover {
    background: #223a66;
    color: #fff !important;
    transform: translateY(-2px);
}

/* --- Scroll Reveal --- */
.rk-reveal {
    opacity: 0;
    transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    will-change: opacity, transform;
}
.rk-reveal.rk-up    { transform: translateY(50px); }
.rk-reveal.rk-left  { transform: translateX(-60px); }
.rk-reveal.rk-right { transform: translateX(60px); }
.rk-reveal.rk-scale { transform: scale(0.85); }
.rk-reveal.rk-visible {
    opacity: 1;
    transform: translateY(0) translateX(0) scale(1);
}
.rk-stagger { transition-delay: calc(var(--s, 0) * 0.12s); }

/* --- Section backgrounds --- */
.rk-bg-white   { background: #fff; }
.rk-bg-light   { background: linear-gradient(180deg, #f8faff 0%, #fff 100%); }
.rk-bg-dark    { background: linear-gradient(135deg, #223a66 0%, #1a2d4d 50%, #0f172a 100%); }
.rk-section    { padding: 90px 0; font-family: 'Inter', sans-serif; }

/* --- Responsive --- */
@media (max-width: 768px) {
    .rk-hero { padding: 130px 0 80px; }
    .rk-hero h1 { font-size: 32px; }
    .rk-hero-desc { font-size: 15px; }
    .rk-section-hdr h2 { font-size: 28px; }
    .rk-wave { margin-top: -40px; }
    .rk-wave svg { height: 40px; }
    .rk-reveal { transition-duration: 0.6s; }
    .rk-reveal.rk-up { transform: translateY(30px); }
    .rk-reveal.rk-left, .rk-reveal.rk-right { transform: translateX(0) translateY(30px); }
}
@media (max-width: 576px) {
    .rk-hero h1 { font-size: 28px; }
}

/* --- Reduced motion --- */
@media (prefers-reduced-motion: reduce) {
    .rk-reveal { transition-duration: 0.01s !important; }
    .rk-hero-dots span, .rk-hero::before, .rk-hero::after { animation: none !important; }
}
/* --- Detail Page Hero & Content --- */
.rk-hero-detail {
    padding: 160px 0 100px;
    background: var(--rk-theme-bg, linear-gradient(135deg, #0f172a 0%, #1e3a5f 40%, #223a66 100%));
    color: #fff;
    text-align: center;
    position: relative;
    overflow: hidden;
    font-family: 'Inter', sans-serif;
}

.rk-hero-detail::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, var(--rk-theme-accent-light, rgba(225,36,84,0.12)) 0%, transparent 70%);
    border-radius: 50%;
    animation: rkPulse 6s ease-in-out infinite;
}

.rk-hero-detail::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -10%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(59,130,246,0.06) 0%, transparent 70%);
    border-radius: 50%;
    animation: rkPulse 7s ease-in-out infinite reverse;
}

.rk-hero-detail .rk-container {
    position: relative;
    z-index: 5;
}

/* Hero Badge (matches beranda section labels) */
.rk-hero-badge-detail {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.12);
    padding: 8px 22px;
    border-radius: 50px;
    color: rgba(255,255,255,0.9);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 28px;
    animation: rkFadeDown 0.8s ease both;
}
.rk-hero-badge-detail i {
    color: var(--rk-theme-accent, #e12454);
    font-size: 16px;
}

.rk-hero-detail h1 {
    font-size: 52px;
    font-weight: 800;
    color: #fff;
    margin-bottom: 22px;
    letter-spacing: -1.2px;
    line-height: 1.15;
    animation: rkFadeUp 0.8s ease both;
}

/* Pink accent text in hero heading — like beranda */
.rk-hero-detail h1 .rk-accent {
    background: linear-gradient(135deg, var(--rk-theme-accent, #e12454), #ff6b8a);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.rk-hero-detail p {
    font-size: 19px;
    color: rgba(255, 255, 255, 0.75);
    max-width: 680px;
    margin: 0 auto;
    line-height: 1.75;
    animation: rkFadeUp 0.8s ease 0.2s both;
}

.rk-content {
    padding: 100px 0;
    background: #f8faff;
    font-family: 'Inter', sans-serif;
}

.rk-content-grid {
    display: grid;
    grid-template-columns: 1.4fr 0.6fr; /* Give more space to article, less to video */
    gap: 60px;
}

@media (max-width: 1200px) {
    .rk-content-grid {
        grid-template-columns: 1.3fr 0.7fr;
        gap: 40px;
    }
}

@media (max-width: 992px) {
    .rk-content-grid {
        grid-template-columns: 1fr;
    }
}

.rk-article {
    background: #fff;
    padding: 45px;
    border-radius: 24px;
    box-shadow: 0 10px 40px rgba(0, 42, 106, 0.06);
    border: 1px solid rgba(0, 0, 0, 0.03);
    transition: all 0.35s ease;
    position: relative;
    overflow: hidden;
}

/* Top accent bar on article card */
.rk-article::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--rk-theme-accent, #e12454), #ff6b8a);
}

.rk-article:hover {
    box-shadow: 0 16px 50px rgba(0, 42, 106, 0.1);
    transform: translateY(-4px);
}

.rk-article h2 {
    font-size: 32px;
    font-weight: 800;
    color: #1a2d4d;
    margin-bottom: 24px;
    letter-spacing: -0.5px;
    position: relative;
    padding-bottom: 18px;
}

/* Accent underline on article heading */
.rk-article h2::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, var(--rk-theme-accent, #e12454), #ff6b8a);
    border-radius: 2px;
}

.rk-article h3 {
    font-size: 22px;
    font-weight: 700;
    color: #223a66;
    margin-top: 36px;
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    gap: 12px;
}

/* Accent dot before h3 */
.rk-article h3::before {
    content: '';
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: var(--rk-theme-accent, #e12454);
    flex-shrink: 0;
    box-shadow: 0 0 8px var(--rk-theme-accent-light, rgba(225,36,84,0.3));
}

.rk-article p {
    font-size: 16px;
    line-height: 1.85;
    color: #6b7c93;
    margin-bottom: 22px;
}

.rk-article ul {
    padding-left: 0;
    list-style: none;
    margin-bottom: 30px;
}

.rk-article li {
    margin-bottom: 0;
    color: #5d6d82;
    padding: 14px 14px 14px 36px;
    position: relative;
    font-weight: 500;
    border-bottom: 1px solid #f0f4f8;
    transition: all 0.3s ease;
    border-radius: 8px;
}

.rk-article li:last-child {
    border-bottom: none;
}

.rk-article li::before {
    content: '\efaf';
    font-family: 'IcoFont';
    position: absolute;
    left: 6px;
    color: var(--rk-theme-accent, #e12454);
    font-size: 18px;
}

.rk-article li:hover {
    background: var(--rk-theme-accent-light, rgba(225,36,84,0.05));
    padding-left: 42px;
    color: #223a66;
}

/* Info highlight box */
.info-highlight {
    background: linear-gradient(135deg, var(--rk-theme-accent-light, rgba(225,36,84,0.06)), rgba(34,58,102,0.04));
    border-left: 4px solid var(--rk-theme-accent, #e12454);
    padding: 22px 24px;
    border-radius: 14px;
    margin: 28px 0;
    transition: all 0.3s ease;
}

.info-highlight:hover {
    box-shadow: 0 6px 20px var(--rk-theme-accent-light, rgba(225,36,84,0.12));
    transform: translateX(4px);
}

.info-highlight p {
    margin: 0 !important;
    color: #223a66 !important;
    font-weight: 600;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 15px !important;
    line-height: 1.7 !important;
}

.info-highlight i {
    color: var(--rk-theme-accent, #e12454);
    font-size: 20px;
    flex-shrink: 0;
    margin-top: 2px;
}

.rk-video-box {
    background: #fff;
    padding: 30px;
    border-radius: 24px;
    box-shadow: 0 10px 40px rgba(0, 42, 106, 0.05);
    border: 1px solid rgba(0, 0, 0, 0.03);
    position: sticky;
    top: 100px;
    max-width: 450px;
    margin-left: auto;
    transition: all 0.35s ease;
    overflow: hidden;
    align-self: start;
}

/* Top accent bar on video card */
.rk-video-box::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--rk-theme-accent, #e12454), #ff6b8a);
}

.rk-video-box:hover {
    box-shadow: 0 16px 50px rgba(0, 42, 106, 0.1);
    transform: translateY(-4px);
}

@media (max-width: 992px) {
    .rk-video-box {
        position: static;
        max-width: 100%;
        margin-left: 0;
    }
}

.rk-video-box h2 {
    font-size: 22px;
    font-weight: 800;
    color: #1a2d4d;
    margin-bottom: 18px;
    letter-spacing: -0.5px;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Video icon before heading */
.rk-video-box h2::before {
    content: '\ef8e';
    font-family: 'IcoFont';
    font-size: 20px;
    color: var(--rk-theme-accent, #e12454);
}

.rk-video-wrapper {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
    border-radius: 14px;
    margin-bottom: 20px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.rk-video-wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
    display: block;
}

.video-desc {
    font-size: 14px;
    color: #6b7c93;
    line-height: 1.7;
    text-align: left;
    padding: 16px 18px;
    background: linear-gradient(135deg, var(--rk-theme-accent-light, rgba(225,36,84,0.05)), rgba(34,58,102,0.03));
    border-radius: 12px;
    border-left: 3px solid var(--rk-theme-accent, #e12454);
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 0;
}

.video-desc i {
    color: var(--rk-theme-accent, #e12454);
    font-size: 18px;
    flex-shrink: 0;
    margin-top: 2px;
}

/* --- Theme Color Variants (Subtle Tone matching Homepage) --- */
.theme-mental {
    --rk-theme-bg: linear-gradient(135deg, #0f172a 0%, #1e3a5f 40%, #5c182a 100%);
    --rk-theme-accent: #e12454;
    --rk-theme-accent-light: rgba(225, 36, 84, 0.1);
}

.theme-seksual {
    --rk-theme-bg: linear-gradient(135deg, #0f172a 0%, #1e3a5f 40%, #3a1a5f 100%);
    --rk-theme-accent: #7c3aed;
    --rk-theme-accent-light: rgba(124, 58, 237, 0.1);
}

.theme-parenting {
    --rk-theme-bg: linear-gradient(135deg, #0f172a 0%, #1e3a5f 40%, #0d4a4d 100%);
    --rk-theme-accent: #0d9488;
    --rk-theme-accent-light: rgba(13, 148, 136, 0.1);
}

.theme-lifestyle {
    --rk-theme-bg: linear-gradient(135deg, #0f172a 0%, #1e3a5f 40%, #1a3a5f 100%);
    --rk-theme-accent: #2563eb;
    --rk-theme-accent-light: rgba(37, 99, 235, 0.1);
}

.theme-kronis {
    --rk-theme-bg: linear-gradient(135deg, #0f172a 0%, #1e3a5f 40%, #5f3a0a 100%);
    --rk-theme-accent: #d97706;
    --rk-theme-accent-light: rgba(217, 119, 6, 0.1);
}

.theme-nutrisi {
    --rk-theme-bg: linear-gradient(135deg, #0f172a 0%, #1e3a5f 40%, #0d4d2a 100%);
    --rk-theme-accent: #16a34a;
    --rk-theme-accent-light: rgba(22, 163, 74, 0.1);
}

.rk-container {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}

@media (min-width: 576px) { .rk-container { max-width: 540px; } }
@media (min-width: 768px) { .rk-container { max-width: 720px; } }
@media (min-width: 992px) { .rk-container { max-width: 960px; } }
@media (min-width: 1200px) { .rk-container { max-width: 1140px; } }

/* Shared Footer CTA (Simplified from Homepage) */
.rk-cta-alt {
    padding: 90px 0;
    background: linear-gradient(135deg, #223a66 0%, #0f172a 100%);
    text-align: center;
    color: #fff;
    position: relative;
    overflow: hidden;
    font-family: 'Inter', sans-serif;
}

.rk-cta-alt::before {
    content: '';
    position: absolute;
    top: -100px;
    right: -100px;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(225,36,84,0.1) 0%, transparent 70%);
    border-radius: 50%;
    animation: rkPulse 6s ease-in-out infinite;
}

.rk-cta-alt::after {
    content: '';
    position: absolute;
    bottom: -100px;
    left: -100px;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(59,130,246,0.06) 0%, transparent 70%);
    border-radius: 50%;
    animation: rkPulse 7s ease-in-out infinite reverse;
}

.rk-cta-alt .rk-container {
    position: relative;
    z-index: 2;
}

.rk-cta-alt h2 {
    font-size: 36px;
    font-weight: 800;
    margin-bottom: 16px;
    color: #fff;
}

.rk-cta-alt h2 .rk-accent {
    background: linear-gradient(135deg, #e12454, #ff6b8a);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.rk-cta-alt p {
    font-size: 17px;
    color: rgba(255,255,255,0.7);
    max-width: 550px;
    margin: 0 auto 32px;
    line-height: 1.75;
}

/* Responsive adjustments for detail pages */
@media (max-width: 768px) {
    .rk-hero-detail { padding: 120px 0 80px; }
    .rk-hero-detail h1 { font-size: 36px; }
    .rk-hero-detail p { font-size: 16px; }
    .rk-article { padding: 30px; }
    .rk-article h2 { font-size: 26px; }
    .rk-article h3 { font-size: 20px; }
    .rk-cta-alt h2 { font-size: 28px; }
    .rk-cta-alt { padding: 70px 0; }
}

@media (max-width: 576px) {
    .rk-hero-detail h1 { font-size: 30px; }
    .rk-article { padding: 24px; }
    .rk-video-box { padding: 24px; }
    .rk-cta-alt h2 { font-size: 24px; }
}


</style>

