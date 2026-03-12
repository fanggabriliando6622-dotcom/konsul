@extends('layouts.app')

@section('title', 'Pelayanan | RuangKonsul')

@section('meta_description', 'RuangKonsul - Konsultasi kesehatan online profesional')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
/* ===== PELAYANAN PAGE STYLES ===== */
.pelayanan-hero {
    position: relative;
    padding: 140px 0 100px;
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 40%, #223a66 70%, #1a3055 100%);
    overflow: hidden;
    font-family: 'Inter', sans-serif;
}

.pelayanan-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(225, 36, 84, 0.15) 0%, transparent 70%);
    border-radius: 50%;
    animation: pulse-glow 4s ease-in-out infinite;
}

.pelayanan-hero::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -10%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    animation: pulse-glow 5s ease-in-out infinite reverse;
}

@keyframes pulse-glow {
    0%, 100% { transform: scale(1); opacity: 0.5; }
    50% { transform: scale(1.1); opacity: 1; }
}

.pelayanan-hero .hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
}

.pelayanan-hero .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.12);
    padding: 8px 20px;
    border-radius: 50px;
    color: rgba(255, 255, 255, 0.85);
    font-size: 14px;
    font-weight: 500;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 24px;
    animation: fadeInDown 0.8s ease;
}

.pelayanan-hero .hero-badge i {
    color: #e12454;
    font-size: 16px;
}

.pelayanan-hero h1 {
    font-size: 52px;
    font-weight: 800;
    color: #fff;
    margin-bottom: 20px;
    line-height: 1.15;
    letter-spacing: -1px;
    animation: fadeInUp 0.8s ease 0.2s both;
}

.pelayanan-hero h1 span {
    background: linear-gradient(135deg, #e12454, #ff6b8a);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.pelayanan-hero .hero-desc {
    font-size: 18px;
    color: rgba(255, 255, 255, 0.7);
    max-width: 650px;
    margin: 0 auto;
    line-height: 1.7;
    animation: fadeInUp 0.8s ease 0.4s both;
}

/* Floating decoration dots */
.hero-float-dots {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 1;
}

.hero-float-dots .dot {
    position: absolute;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.15);
    animation: float-dot 6s ease-in-out infinite;
}

.hero-float-dots .dot:nth-child(1) { top: 20%; left: 10%; animation-delay: 0s; }
.hero-float-dots .dot:nth-child(2) { top: 60%; left: 85%; animation-delay: 1s; }
.hero-float-dots .dot:nth-child(3) { top: 40%; left: 70%; animation-delay: 2s; width: 8px; height: 8px; }
.hero-float-dots .dot:nth-child(4) { top: 75%; left: 20%; animation-delay: 3s; }
.hero-float-dots .dot:nth-child(5) { top: 15%; left: 55%; animation-delay: 4s; width: 4px; height: 4px; }
.hero-float-dots .dot:nth-child(6) { top: 85%; left: 50%; animation-delay: 2.5s; }

@keyframes float-dot {
    0%, 100% { transform: translateY(0) scale(1); opacity: 0.3; }
    50% { transform: translateY(-20px) scale(1.5); opacity: 0.8; }
}

@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ===== SERVICES SECTION ===== */
.pelayanan-section {
    padding: 100px 0 80px;
    background: linear-gradient(180deg, #f8faff 0%, #ffffff 100%);
    position: relative;
    font-family: 'Inter', sans-serif;
}

.pelayanan-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 200px;
    background: linear-gradient(180deg, #0f172a 0%, transparent 100%);
    opacity: 0.03;
}

.section-header {
    text-align: center;
    margin-bottom: 70px;
    position: relative;
    z-index: 1;
}

.section-header .section-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, rgba(225, 36, 84, 0.08), rgba(225, 36, 84, 0.03));
    border: 1px solid rgba(225, 36, 84, 0.12);
    padding: 6px 18px;
    border-radius: 50px;
    color: #e12454;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-bottom: 20px;
}

.section-header h2 {
    font-size: 38px;
    font-weight: 800;
    color: #1a2d4d;
    margin-bottom: 16px;
    letter-spacing: -0.5px;
}

.section-header p {
    font-size: 17px;
    color: #6b7c93;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.7;
}

/* ===== SERVICE CARDS ===== */
.service-cards-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

@media (max-width: 992px) {
    .service-cards-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 576px) {
    .service-cards-grid {
        grid-template-columns: 1fr;
    }
    .pelayanan-hero h1 {
        font-size: 32px;
    }
    .pelayanan-hero .hero-desc {
        font-size: 15px;
    }
}

.service-card-new {
    background: #ffffff;
    border-radius: 20px;
    padding: 40px 32px 36px;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(0, 0, 0, 0.04);
    box-shadow: 0 4px 24px rgba(0, 42, 106, 0.06);
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    cursor: default;
    animation: cardFadeIn 0.6s ease both;
}

.service-card-new:nth-child(1) { animation-delay: 0.1s; }
.service-card-new:nth-child(2) { animation-delay: 0.2s; }
.service-card-new:nth-child(3) { animation-delay: 0.3s; }
.service-card-new:nth-child(4) { animation-delay: 0.4s; }
.service-card-new:nth-child(5) { animation-delay: 0.5s; }
.service-card-new:nth-child(6) { animation-delay: 0.6s; }

@keyframes cardFadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

.service-card-new::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--card-accent, #e12454), var(--card-accent-end, #ff6b8a));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
}

.service-card-new:hover::before {
    transform: scaleX(1);
}

.service-card-new::after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 120px;
    height: 120px;
    background: radial-gradient(circle at top right, var(--card-bg-glow, rgba(225, 36, 84, 0.04)), transparent 70%);
    border-radius: 0 20px 0 0;
    transition: all 0.4s ease;
}

.service-card-new:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(0, 42, 106, 0.12);
    border-color: rgba(0, 42, 106, 0.06);
}

.service-card-new:hover::after {
    width: 180px;
    height: 180px;
}

/* Card icon */
.service-card-new .card-icon {
    width: 72px;
    height: 72px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 24px;
    position: relative;
    z-index: 1;
    transition: all 0.4s ease;
    background: var(--card-icon-bg, linear-gradient(135deg, rgba(225, 36, 84, 0.08), rgba(225, 36, 84, 0.04)));
}

.service-card-new .card-icon i {
    font-size: 32px;
    color: var(--card-icon-color, #e12454);
    transition: all 0.3s ease;
}

.service-card-new:hover .card-icon {
    transform: scale(1.08);
    box-shadow: 0 8px 24px var(--card-icon-shadow, rgba(225, 36, 84, 0.15));
}

/* Card Number */
.service-card-new .card-number {
    position: absolute;
    top: 20px;
    right: 24px;
    font-size: 60px;
    font-weight: 800;
    color: rgba(0, 42, 106, 0.03);
    line-height: 1;
    z-index: 0;
    transition: color 0.4s ease;
    pointer-events: none;
}

.service-card-new:hover .card-number {
    color: rgba(0, 42, 106, 0.06);
}

/* Card Content */
.service-card-new h4 {
    font-size: 20px;
    font-weight: 700;
    color: #1a2d4d;
    margin-bottom: 14px;
    position: relative;
    z-index: 1;
}

.service-card-new p {
    font-size: 15px;
    color: #6b7c93;
    line-height: 1.7;
    margin-bottom: 20px;
    position: relative;
    z-index: 1;
}

.service-card-new .card-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--card-link-color, #e12454);
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    z-index: 1;
}

.service-card-new .card-link i {
    font-size: 12px;
    transition: transform 0.3s ease;
}

.service-card-new:hover .card-link {
    gap: 12px;
}

.service-card-new:hover .card-link i {
    transform: translateX(4px);
}

/* ===== CARD COLOR VARIANTS ===== */
/* Mental Health - Pink/Rose */
.service-card-new.card-mental {
    --card-accent: #e12454;
    --card-accent-end: #ff6b8a;
    --card-icon-bg: linear-gradient(135deg, rgba(225, 36, 84, 0.1), rgba(225, 36, 84, 0.04));
    --card-icon-color: #e12454;
    --card-icon-shadow: rgba(225, 36, 84, 0.2);
    --card-bg-glow: rgba(225, 36, 84, 0.05);
    --card-link-color: #e12454;
}

/* Sexual Health - Purple */
.service-card-new.card-seksual {
    --card-accent: #7c3aed;
    --card-accent-end: #a78bfa;
    --card-icon-bg: linear-gradient(135deg, rgba(124, 58, 237, 0.1), rgba(124, 58, 237, 0.04));
    --card-icon-color: #7c3aed;
    --card-icon-shadow: rgba(124, 58, 237, 0.2);
    --card-bg-glow: rgba(124, 58, 237, 0.05);
    --card-link-color: #7c3aed;
}

/* Parenting - Teal */
.service-card-new.card-parenting {
    --card-accent: #0d9488;
    --card-accent-end: #5eead4;
    --card-icon-bg: linear-gradient(135deg, rgba(13, 148, 136, 0.1), rgba(13, 148, 136, 0.04));
    --card-icon-color: #0d9488;
    --card-icon-shadow: rgba(13, 148, 136, 0.2);
    --card-bg-glow: rgba(13, 148, 136, 0.05);
    --card-link-color: #0d9488;
}

/* Healthy Lifestyle - Blue */
.service-card-new.card-lifestyle {
    --card-accent: #2563eb;
    --card-accent-end: #60a5fa;
    --card-icon-bg: linear-gradient(135deg, rgba(37, 99, 235, 0.1), rgba(37, 99, 235, 0.04));
    --card-icon-color: #2563eb;
    --card-icon-shadow: rgba(37, 99, 235, 0.2);
    --card-bg-glow: rgba(37, 99, 235, 0.05);
    --card-link-color: #2563eb;
}

/* Chronic Disease - Amber */
.service-card-new.card-kronis {
    --card-accent: #d97706;
    --card-accent-end: #fbbf24;
    --card-icon-bg: linear-gradient(135deg, rgba(217, 119, 6, 0.1), rgba(217, 119, 6, 0.04));
    --card-icon-color: #d97706;
    --card-icon-shadow: rgba(217, 119, 6, 0.2);
    --card-bg-glow: rgba(217, 119, 6, 0.05);
    --card-link-color: #d97706;
}

/* Nutrition - Green */
.service-card-new.card-nutrisi {
    --card-accent: #16a34a;
    --card-accent-end: #4ade80;
    --card-icon-bg: linear-gradient(135deg, rgba(22, 163, 74, 0.1), rgba(22, 163, 74, 0.04));
    --card-icon-color: #16a34a;
    --card-icon-shadow: rgba(22, 163, 74, 0.2);
    --card-bg-glow: rgba(22, 163, 74, 0.05);
    --card-link-color: #16a34a;
}

/* ===== CTA BANNER ===== */
.pelayanan-cta {
    padding: 80px 0;
    background: linear-gradient(135deg, #223a66 0%, #1a2d4d 50%, #0f172a 100%);
    position: relative;
    overflow: hidden;
    font-family: 'Inter', sans-serif;
}

.pelayanan-cta::before {
    content: '';
    position: absolute;
    top: -100px;
    right: -100px;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(225, 36, 84, 0.12), transparent 60%);
    border-radius: 50%;
}

.pelayanan-cta::after {
    content: '';
    position: absolute;
    bottom: -80px;
    left: -50px;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.08), transparent 60%);
    border-radius: 50%;
}

.cta-inner {
    text-align: center;
    position: relative;
    z-index: 1;
}

.cta-inner h2 {
    font-size: 36px;
    font-weight: 800;
    color: #fff;
    margin-bottom: 16px;
    letter-spacing: -0.5px;
}

.cta-inner p {
    font-size: 18px;
    color: rgba(255, 255, 255, 0.7);
    max-width: 550px;
    margin: 0 auto 36px;
    line-height: 1.7;
}

.cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 36px;
    background: linear-gradient(135deg, #e12454, #ff4d6d);
    color: #fff !important;
    font-size: 16px;
    font-weight: 700;
    border-radius: 50px;
    text-decoration: none !important;
    transition: all 0.3s ease;
    box-shadow: 0 8px 30px rgba(225, 36, 84, 0.3);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.cta-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(225, 36, 84, 0.4);
    background: linear-gradient(135deg, #c91e47, #e12454);
    color: #fff !important;
}

.cta-btn i {
    font-size: 14px;
    transition: transform 0.3s ease;
}

.cta-btn:hover i {
    transform: translateX(4px);
}

/* ===== STATS ROW ===== */
.stats-row {
    display: flex;
    justify-content: center;
    gap: 60px;
    margin-top: 60px;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
}

.stat-item .stat-number {
    font-size: 42px;
    font-weight: 800;
    color: #fff;
    line-height: 1;
    margin-bottom: 8px;
}

.stat-item .stat-number span {
    color: #e12454;
}

.stat-item .stat-label {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.5);
    text-transform: uppercase;
    letter-spacing: 1.5px;
    font-weight: 500;
}

@media (max-width: 768px) {
    .stats-row {
        gap: 30px;
    }
    .stat-item .stat-number {
        font-size: 32px;
    }
    .pelayanan-hero h1 {
        font-size: 36px;
    }
    .section-header h2 {
        font-size: 30px;
    }
    .cta-inner h2 {
        font-size: 28px;
    }
}
</style>
@endpush

@section('content')

<!-- ===== HERO SECTION ===== -->
<section class="pelayanan-hero">
    <div class="hero-float-dots">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="icofont-heart-beat"></i>
                Layanan Kami
            </div>
            <h1>Solusi Konsultasi<br><span>Kesehatan Terlengkap</span></h1>
            <p class="hero-desc">
                Dapatkan akses ke berbagai layanan konsultasi profesional yang dirancang khusus untuk membantu Anda mencapai kesehatan optimal secara menyeluruh.
            </p>
        </div>
    </div>
</section>

<!-- ===== SERVICES SECTION ===== -->
<section class="pelayanan-section">
    <div class="container">
        <div class="section-header">
            <div class="section-label">
                <i class="icofont-stethoscope-alt"></i>
                Pelayanan Profesional
            </div>
            <h2>Layanan Unggulan Kami</h2>
            <p>Kami menyediakan berbagai layanan konsultasi yang dirancang untuk membantu Anda memahami permasalahan secara menyeluruh dan menemukan solusi yang tepat.</p>
        </div>

        <div class="service-cards-grid">

            <!-- Kesehatan Mental -->
            <div class="service-card-new card-mental">
                <span class="card-number">01</span>
                <div class="card-icon">
                    <i class="icofont-brain-alt"></i>
                </div>
                <h4>Kesehatan Mental</h4>
                <p>Layanan konsultasi profesional untuk membantu mengelola stres, kecemasan, dan kesehatan mental secara aman, rahasia, dan berkelanjutan.</p>
                <a href="{{ url('/jelajahi1') }}" class="card-link">
                    Jelajahi Layanan <i class="icofont-long-arrow-right"></i>
                </a>
            </div>

            <!-- Kesehatan Seksual -->
            <div class="service-card-new card-seksual">
                <span class="card-number">02</span>
                <div class="card-icon">
                    <i class="icofont-heart-beat"></i>
                </div>
                <h4>Kesehatan Seksual</h4>
                <p>Konsultasi privat dan terpercaya untuk menjaga kesehatan seksual serta menangani permasalahan dengan pendekatan profesional.</p>
                <a href="{{ url('/jelajahi2') }}" class="card-link">
                    Jelajahi Layanan <i class="icofont-long-arrow-right"></i>
                </a>
            </div>

            <!-- Parenting -->
            <div class="service-card-new card-parenting">
                <span class="card-number">03</span>
                <div class="card-icon">
                    <i class="icofont-baby"></i>
                </div>
                <h4>Parenting</h4>
                <p>Pendampingan dan konsultasi bagi orang tua untuk mendukung tumbuh kembang anak secara sehat, optimal, dan penuh kesadaran.</p>
                <a href="{{ url('/jelajahi3') }}" class="card-link">
                    Jelajahi Layanan <i class="icofont-long-arrow-right"></i>
                </a>
            </div>

            <!-- Gaya Hidup Sehat -->
            <div class="service-card-new card-lifestyle">
                <span class="card-number">04</span>
                <div class="card-icon">
                    <i class="icofont-heart-beat-alt"></i>
                </div>
                <h4>Gaya Hidup Sehat</h4>
                <p>Panduan dan konsultasi untuk membangun pola hidup sehat, seimbang, serta kebiasaan positif yang berkelanjutan.</p>
                <a href="{{ url('/jelajahi4') }}" class="card-link">
                    Jelajahi Layanan <i class="icofont-long-arrow-right"></i>
                </a>
            </div>

            <!-- Penyakit Kronis -->
            <div class="service-card-new card-kronis">
                <span class="card-number">05</span>
                <div class="card-icon">
                    <i class="icofont-medical-sign-alt"></i>
                </div>
                <h4>Penyakit Kronis</h4>
                <p>Pendampingan dan konsultasi berkelanjutan untuk membantu pengelolaan penyakit kronis secara tepat dan terarah.</p>
                <a href="{{ url('/jelajahi5') }}" class="card-link">
                    Jelajahi Layanan <i class="icofont-long-arrow-right"></i>
                </a>
            </div>

            <!-- Gizi / Nutrisi -->
            <div class="service-card-new card-nutrisi">
                <span class="card-number">06</span>
                <div class="card-icon">
                    <i class="icofont-apple"></i>
                </div>
                <h4>Gizi / Nutrisi</h4>
                <p>Konsultasi gizi dan nutrisi untuk membantu memenuhi kebutuhan tubuh serta menjaga kesehatan jangka panjang.</p>
                <a href="{{ url('/jelajahi6') }}" class="card-link">
                    Jelajahi Layanan <i class="icofont-long-arrow-right"></i>
                </a>
            </div>

        </div>
    </div>
</section>

<!-- ===== CTA SECTION ===== -->
<section class="pelayanan-cta">
    <div class="container">
        <div class="cta-inner">
            <h2>Siap Memulai Konsultasi?</h2>
            <p>Konsultasikan masalah kesehatan Anda dengan dokter profesional kami sekarang juga.</p>
            <a href="{{ url('/kategori-dokter') }}" class="cta-btn">
                Mulai Konsultasi <i class="icofont-long-arrow-right"></i>
            </a>

            <div class="stats-row">
                <div class="stat-item">
                    <div class="stat-number">6<span>+</span></div>
                    <div class="stat-label">Layanan</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">100<span>%</span></div>
                    <div class="stat-label">Profesional</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">24<span>/7</span></div>
                    <div class="stat-label">Tersedia</div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection