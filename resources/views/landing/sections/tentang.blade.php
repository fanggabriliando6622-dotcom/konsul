@extends('layouts.app')

@section('title', 'Tentang Kami | RuangKonsul')

@section('meta_description', 'RuangKonsul adalah platform konsultasi kesehatan online yang aman, profesional, dan terpercaya')

@section('content')

<!-- ===== HERO ===== -->
<section class="rk-hero">
    <div class="rk-hero-dots">
        <span></span><span></span><span></span><span></span>
    </div>
    <div class="container">
        <div class="rk-hero-inner">
            <div class="rk-hero-badge">
                <i class="icofont-info-circle"></i> Tentang Kami
            </div>
            <h1>Mengenal <span>RuangKonsul</span></h1>
            <p class="rk-hero-desc">
                Platform konsultasi kesehatan online yang hadir untuk membantu masyarakat mendapatkan pendampingan medis dan kesehatan mental secara mudah, aman, dan profesional.
            </p>
        </div>
    </div>
</section>

<div class="rk-wave">
    <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 80L48 74.7C96 69.3 192 58.7 288 53.3C384 48 480 48 576 53.3C672 58.7 768 69.3 864 69.3C960 69.3 1056 58.7 1152 48C1248 37.3 1344 26.7 1392 21.3L1440 16V80H1392C1344 80 1248 80 1152 80C1056 80 960 80 864 80C768 80 672 80 576 80C480 80 384 80 288 80C192 80 96 80 48 80H0Z" fill="white"/>
    </svg>
</div>

<!-- ===== INTRO ===== -->
<section class="rk-section rk-bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 rk-reveal rk-left">
                <div class="rk-section-label" style="margin-bottom:20px;">
                    <i class="icofont-heart-beat"></i> Visi Kami
                </div>
                <h2 style="font-size:32px;font-weight:800;color:#1a2d4d;line-height:1.3;margin-bottom:0;">
                    Ruang Aman untuk Konsultasi Kesehatan Anda
                </h2>
            </div>
            <div class="col-lg-7 rk-reveal rk-right">
                <p style="font-size:16px;color:#6b7c93;line-height:1.8;">
                    <strong style="color:#1a2d4d;">RuangKonsul</strong> adalah platform konsultasi kesehatan online
                    yang hadir untuk membantu masyarakat mendapatkan pendampingan medis
                    dan kesehatan mental secara <strong style="color:#1a2d4d;">mudah, aman, dan profesional</strong>.
                </p>
                <p style="font-size:16px;color:#6b7c93;line-height:1.8;">
                    Kami memahami bahwa setiap individu memiliki kebutuhan kesehatan yang
                    berbeda. Oleh karena itu, RuangKonsul menyediakan ruang konsultasi yang
                    nyaman dan menjaga privasi, dengan dukungan tenaga kesehatan berpengalaman.
                </p>
                <p style="font-size:16px;color:#6b7c93;line-height:1.8;margin-bottom:0;">
                    Dengan memanfaatkan teknologi digital, kami berkomitmen menghadirkan
                    layanan kesehatan yang lebih inklusif, fleksibel, dan terpercaya.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ===== FEATURE CARDS ===== -->
<section class="rk-section rk-bg-light">
    <div class="container">
        <div class="rk-section-hdr rk-reveal rk-up">
            <div class="rk-section-label">
                <i class="icofont-star"></i> Keunggulan
            </div>
            <h2>Mengapa Memilih RuangKonsul?</h2>
            <p>Kami menyediakan layanan terbaik dengan standar profesional yang tinggi.</p>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="rk-card rk-reveal rk-up rk-stagger text-center" style="--s:0;--rk-card-accent:linear-gradient(90deg,#e12454,#ff6b8a);">
                    <div class="rk-icon-box mx-auto" style="background:linear-gradient(135deg,#e12454,#ff6b8a);">
                        <i class="icofont-shield-alt"></i>
                    </div>
                    <img src="{{ asset('images/about/Tentang dokter.jpeg') }}" alt="Privasi" class="img-fluid rounded-3 mb-3" style="height:160px;width:100%;object-fit:cover;">
                    <h4 style="font-size:17px;font-weight:700;color:#1a2d4d;">Privasi Terjamin</h4>
                    <p style="font-size:14px;color:#6b7c93;line-height:1.6;margin:0;">
                        Setiap sesi konsultasi dilakukan secara aman dan menjaga kerahasiaan data serta kenyamanan pengguna.
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="rk-card rk-reveal rk-up rk-stagger text-center" style="--s:1;--rk-card-accent:linear-gradient(90deg,#2563eb,#60a5fa);">
                    <div class="rk-icon-box mx-auto" style="background:linear-gradient(135deg,#2563eb,#60a5fa);">
                        <i class="icofont-doctor-alt"></i>
                    </div>
                    <img src="{{ asset('images/about/Tentang dokter 1.jpeg') }}" alt="Profesional" class="img-fluid rounded-3 mb-3" style="height:160px;width:100%;object-fit:cover;">
                    <h4 style="font-size:17px;font-weight:700;color:#1a2d4d;">Tenaga Profesional</h4>
                    <p style="font-size:14px;color:#6b7c93;line-height:1.6;margin:0;">
                        Ditangani oleh dokter dan tenaga kesehatan yang kompeten sesuai bidang keahliannya.
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="rk-card rk-reveal rk-up rk-stagger text-center" style="--s:2;--rk-card-accent:linear-gradient(90deg,#0d9488,#5eead4);">
                    <div class="rk-icon-box mx-auto" style="background:linear-gradient(135deg,#0d9488,#34d399);">
                        <i class="icofont-touch"></i>
                    </div>
                    <img src="{{ asset('images/about/Tentang dokter 2.jpeg') }}" alt="Fleksibel" class="img-fluid rounded-3 mb-3" style="height:160px;width:100%;object-fit:cover;">
                    <h4 style="font-size:17px;font-weight:700;color:#1a2d4d;">Akses Fleksibel</h4>
                    <p style="font-size:14px;color:#6b7c93;line-height:1.6;margin:0;">
                        Layanan konsultasi dapat diakses kapan saja dan di mana saja sesuai kebutuhan Anda.
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="rk-card rk-reveal rk-up rk-stagger text-center" style="--s:3;--rk-card-accent:linear-gradient(90deg,#7c3aed,#a78bfa);">
                    <div class="rk-icon-box mx-auto" style="background:linear-gradient(135deg,#7c3aed,#a78bfa);">
                        <i class="icofont-users-alt-5"></i>
                    </div>
                    <img src="{{ asset('images/about/Tentang dokter 3.webp') }}" alt="Humanis" class="img-fluid rounded-3 mb-3" style="height:160px;width:100%;object-fit:cover;">
                    <h4 style="font-size:17px;font-weight:700;color:#1a2d4d;">Pendekatan Humanis</h4>
                    <p style="font-size:14px;color:#6b7c93;line-height:1.6;margin:0;">
                        Kami mengedepankan empati, komunikasi yang jelas, dan solusi yang berfokus pada pasien.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== AWARDS ===== -->
<section class="rk-section rk-bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 rk-reveal rk-left">
                <div class="rk-section-label" style="margin-bottom:16px;">
                    <i class="icofont-badge"></i> Kredibilitas
                </div>
                <h2 style="font-size:30px;font-weight:800;color:#1a2d4d;margin-bottom:16px;">Komitmen & Kredibilitas</h2>
                <p style="font-size:15px;color:#6b7c93;line-height:1.7;">
                    RuangKonsul memiliki kredibilitas dari berbagai pencapaian dan berkomitmen menjaga standar pelayanan kesehatan yang tinggi melalui kerja sama dengan berbagai institusi dan tenaga profesional.
                </p>
            </div>
            <div class="col-lg-8 rk-reveal rk-right">
                <div class="row">
                    @for ($i = 1; $i <= 6; $i++)
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-3">
                        <div class="rk-card text-center rk-stagger" style="--s:{{ $i - 1 }};padding:24px;">
                            <img src="{{ asset('images/about/' . $i . '.png') }}" alt="Award {{ $i }}" class="img-fluid" style="max-height:80px;object-fit:contain;">
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== TEAM ===== -->
<section class="rk-section rk-bg-light">
    <div class="container">
        <div class="rk-section-hdr rk-reveal rk-up">
            <div class="rk-section-label">
                <i class="icofont-doctor-alt"></i> Tim Kami
            </div>
            <h2>Tenaga Profesional Kami</h2>
            <p>Tim RuangKonsul terdiri dari dokter dan tenaga kesehatan berpengalaman yang siap mendampingi Anda secara profesional.</p>
        </div>

        <div class="row">
            @php
                $teamMembers = [
                    ['img' => 'spesialis 12.png', 'name' => 'Dr. Ferryansyah', 'spec' => 'Psikolog Klinis & Urologi'],
                    ['img' => 'spesialis 13.png', 'name' => 'Dr. I Gusti Agung Triana S', 'spec' => 'Spesialis Urologi'],
                    ['img' => 'spesialis 14.png', 'name' => 'Dr. Mariska Yanti Tongku', 'spec' => 'Spesialis Anak'],
                    ['img' => 'spesialis 15.png', 'name' => 'Dr. Rafif Naufal Dani', 'spec' => 'Spesialis Anak & Kedokteran Olahraga'],
                ];
                $colors = [
                    'linear-gradient(135deg,#e12454,#ff6b8a)',
                    'linear-gradient(135deg,#2563eb,#60a5fa)',
                    'linear-gradient(135deg,#0d9488,#34d399)',
                    'linear-gradient(135deg,#7c3aed,#a78bfa)',
                ];
            @endphp

            @foreach($teamMembers as $idx => $member)
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="rk-card rk-reveal rk-up rk-stagger text-center" style="--s:{{ $idx }};padding:0;overflow:hidden;">
                    <img src="{{ asset('images/team/' . $member['img']) }}" alt="{{ $member['name'] }}" class="img-fluid w-100" style="height:260px;object-fit:cover;">
                    <div style="padding:20px 16px;position:relative;">
                        <div style="position:absolute;top:-20px;left:50%;transform:translateX(-50%);width:40px;height:40px;border-radius:12px;background:{{ $colors[$idx] }};display:flex;align-items:center;justify-content:center;">
                            <i class="icofont-stethoscope" style="color:#fff;font-size:18px;"></i>
                        </div>
                        <h4 style="font-size:16px;font-weight:700;color:#1a2d4d;margin:12px 0 4px;">{{ $member['name'] }}</h4>
                        <p style="font-size:13px;color:#e12454;font-weight:600;margin:0;">{{ $member['spec'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
