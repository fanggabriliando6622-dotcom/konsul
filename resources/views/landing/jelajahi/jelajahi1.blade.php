@extends('layouts.app')

@section('title', 'Kesehatan Mental | RuangKonsul')

@section('meta_description', 'RuangKonsul - Konsultasi kesehatan mental online yang aman, profesional, dan terpercaya')

@section('content')

<section class="rk-hero-detail theme-mental">
  <div class="rk-hero-dots">
      <span></span><span></span><span></span><span></span>
  </div>
  <div class="rk-container">
    <div class="rk-hero-badge-detail rk-reveal rk-up">
        <i class="icofont-heart-beat"></i> LAYANAN KESEHATAN
    </div>
    <h1 class="rk-reveal rk-up rk-stagger" style="--s:1">Kesehatan <span class="rk-accent">Mental</span></h1>
    <p class="rk-reveal rk-up rk-stagger" style="--s:2">Pendampingan profesional untuk menjaga keseimbangan emosional dan kualitas hidup Anda.</p>
  </div>
</section>

<!-- Wave separator -->
<div class="rk-wave">
    <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 80L48 74.7C96 69.3 192 58.7 288 53.3C384 48 480 48 576 53.3C672 58.7 768 69.3 864 69.3C960 69.3 1056 58.7 1152 48C1248 37.3 1344 26.7 1392 21.3L1440 16V80H1392C1344 80 1248 80 1152 80C1056 80 960 80 864 80C768 80 672 80 576 80C480 80 384 80 288 80C192 80 96 80 48 80H0Z" fill="#f8faff"/>
    </svg>
</div>

<!-- ================= CONTENT ================= -->
<section class="rk-content">
  <div class="rk-container">
    <div class="rk-content-grid">

      <!-- ARTIKEL -->
      <div class="rk-article rk-reveal rk-left">
        <h2>Apa itu Kesehatan Mental?</h2>
        <p>
          Kesehatan mental adalah kondisi di mana seseorang mampu mengelola emosi, berpikir secara positif,
          menghadapi tekanan hidup, serta menjalani aktivitas sehari-hari secara produktif.
        </p>

        <div class="info-highlight">
          <p>
            <i class="icofont-info-circle"></i>
            Di RuangKonsul, kami memahami bahwa setiap individu memiliki tantangan yang berbeda. Oleh karena itu,
            layanan kesehatan mental kami dirancang secara personal, aman, dan rahasia.
          </p>
        </div>

        <h3>Masalah yang Dapat Ditangani</h3>
        <ul>
          <li>Stres berlebihan & burnout</li>
          <li>Kecemasan dan overthinking</li>
          <li>Depresi ringan hingga sedang</li>
          <li>Masalah kepercayaan diri</li>
          <li>Kesulitan mengelola emosi</li>
        </ul>

        <h3>Kenapa Konsultasi di RuangKonsul?</h3>
        <p>
          Konsultasi dilakukan oleh tenaga profesional berpengalaman dengan pendekatan empati,
          berbasis solusi, dan berorientasi pada pemulihan jangka panjang.
        </p>
      </div>

      <!-- VIDEO -->
      <div class="rk-video-box rk-reveal rk-right">
        <h2>Video Edukasi</h2>
        <div class="rk-video-wrapper">
          <iframe
            src="https://www.youtube.com/embed/oxx564hMBUI"
            title="Edukasi Kesehatan Mental"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
          </iframe>
        </div>

        <p class="video-desc">
          <i class="icofont-info-circle"></i>
          <span>Video ini menjelaskan pentingnya menjaga kesehatan mental serta kapan waktu yang tepat
          untuk berkonsultasi dengan profesional.</span>
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