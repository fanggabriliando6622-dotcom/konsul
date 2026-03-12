@extends('layouts.app')

@section('title', 'Parenting | RuangKonsul')

@section('meta_description', 'RuangKonsul - Konsultasi parenting online untuk pola asuh yang sehat dan harmonis')

@section('content')

<section class="rk-hero-detail theme-parenting">
  <div class="rk-hero-dots">
      <span></span><span></span><span></span><span></span>
  </div>
  <div class="rk-container">
    <div class="rk-hero-badge-detail rk-reveal rk-up">
        <i class="icofont-baby"></i> IBU & ANAK
    </div>
    <h1 class="rk-reveal rk-up rk-stagger" style="--s:1">Ibu & <span class="rk-accent">Anak</span></h1>
    <p class="rk-reveal rk-up rk-stagger" style="--s:2">Pendampingan orang tua untuk membangun pola asuh sehat dan harmonis.</p>
  </div>
</section>

<!-- Wave separator -->
<div class="rk-wave">
    <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 80L48 74.7C96 69.3 192 58.7 288 53.3C384 48 480 48 576 53.3C672 58.7 768 69.3 864 69.3C960 69.3 1056 58.7 1152 48C1248 37.3 1344 26.7 1392 21.3L1440 16V80H1392C1344 80 1248 80 1152 80C1056 80 960 80 864 80C768 80 672 80 576 80C480 80 384 80 288 80C192 80 96 80 48 80H0Z" fill="#f8faff"/>
    </svg>
</div>

<section class="rk-content">
  <div class="rk-container">
    <div class="rk-content-grid">

      <div class="rk-article rk-reveal rk-left">
        <h2>Apa itu Parenting?</h2>
        <p>
          Parenting adalah proses mendampingi tumbuh kembang anak secara fisik,
          emosional, dan sosial melalui pola asuh yang tepat.
        </p>

        <div class="info-highlight">
          <p>
            <i class="icofont-info-circle"></i>
            Setiap anak unik dan membutuhkan pendekatan yang berbeda. RuangKonsul membantu Anda menemukan
            pola asuh terbaik sesuai karakter anak.
          </p>
        </div>

        <h3>Topik Konsultasi</h3>
        <ul>
          <li>Perilaku anak & tantrum</li>
          <li>Komunikasi orang tua–anak</li>
          <li>Pola disiplin positif</li>
          <li>Masalah remaja</li>
          <li>Stres orang tua</li>
        </ul>

        <h3>Kenapa RuangKonsul?</h3>
        <p>
          Pendekatan praktis, empatik, dan berbasis psikologi perkembangan anak.
        </p>
      </div>

      <div class="rk-video-box rk-reveal rk-right">
        <h2>Video Edukasi</h2>
        <div class="rk-video-wrapper">
          <iframe src="https://www.youtube.com/embed/L39tafd-kgo" allowfullscreen></iframe>
        </div>
        <p class="video-desc">
          <i class="icofont-info-circle"></i>
          <span>Tips parenting untuk membangun hubungan sehat dengan anak.</span>
        </p>
      </div>

    </div>
  </div>
</section>

<!-- ===== CTA SECTION ===== -->
<section class="rk-cta-alt">
    <div class="rk-container">
        <h2 class="rk-reveal rk-up">Siap Memulai <span class="rk-accent">Konsultasi?</span></h2>
        <p class="rk-reveal rk-up rk-stagger" style="--s:1">Konsultasikan masalah kesehatan Anda dengan dokter profesional kami sekarang juga.</p>
        <a href="{{ route('landing.dokter.kategori') }}" class="rk-btn rk-reveal rk-up rk-stagger" style="--s:2">
            Mulai Konsultasi <i class="icofont-long-arrow-right"></i>
        </a>
    </div>
</section>

@endsection