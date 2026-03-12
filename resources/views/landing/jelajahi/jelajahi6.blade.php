@extends('layouts.app')

@section('title', 'Gizi dan Nutrisi | RuangKonsul')

@section('meta_description', 'RuangKonsul - Konsultasi gizi dan nutrisi seimbang sesuai kebutuhan tubuh Anda')

@section('content')

<section class="rk-hero-detail theme-nutrisi">
  <div class="rk-hero-dots">
      <span></span><span></span><span></span><span></span>
  </div>
  <div class="rk-container">
    <div class="rk-hero-badge-detail rk-reveal rk-up">
        <i class="icofont-fruits"></i> GIZI & NUTRISI
    </div>
    <h1 class="rk-reveal rk-up rk-stagger" style="--s:1">Gizi & <span class="rk-accent">Nutrisi</span></h1>
    <p class="rk-reveal rk-up rk-stagger" style="--s:2">Panduan nutrisi seimbang sesuai kebutuhan tubuh Anda.</p>
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
        <h2>Mengapa Gizi Penting?</h2>
        <p>
          Asupan nutrisi yang tepat membantu menjaga energi, imun, dan kesehatan jangka panjang.
        </p>

        <div class="info-highlight">
          <p>
            <i class="icofont-info-circle"></i>
            Nutrisi yang tepat adalah fondasi kesehatan. RuangKonsul membantu Anda memahami kebutuhan gizi
            dan merencanakan pola makan yang sesuai.
          </p>
        </div>

        <h3>Topik Konsultasi</h3>
        <ul>
          <li>Pola makan seimbang</li>
          <li>Diet khusus</li>
          <li>Masalah berat badan</li>
          <li>Gizi anak & dewasa</li>
          <li>Perencanaan menu</li>
        </ul>

        <h3>Keunggulan Kami</h3>
        <p>
          Rekomendasi personal, praktis, dan berbasis kebutuhan individu.
        </p>
      </div>

      <div class="rk-video-box rk-reveal rk-right">
        <h2>Video Edukasi</h2>
        <div class="rk-video-wrapper">
          <iframe src="https://www.youtube.com/embed/z88lgOdF0-M" allowfullscreen></iframe>
        </div>
        <p class="video-desc">
          <i class="icofont-info-circle"></i>
          <span>Dasar gizi seimbang untuk hidup sehat.</span>
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