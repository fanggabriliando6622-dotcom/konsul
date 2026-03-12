@extends('layouts.app')

@section('title', 'Daftar Dokter | RuangKonsul')

@section('meta_description', 'RuangKonsul - Konsultasi kesehatan online profesional')

@section('content')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dokter.css') }}">
<style>
    /* Doctor Card Styling */
    .doctor-card {
        border-radius: 28px;
        border: none !important;
        background: white;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275), z-index 0s;
        box-shadow: 0 10px 40px rgba(34,58,102,0.06) !important;
        position: relative;
        padding: 120px 25px 40px !important;
        margin-top: 130px !important; /* Spacing for the floating avatar */
        overflow: visible !important;
        z-index: 5; /* Sit above the background */
        display: flex;
        flex-direction: column;
    }
    
    .doctor-card:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 30px 70px rgba(34,58,102,0.18) !important;
        z-index: 100 !important;
    }

    .doctor-avatar-wrapper {
        position: absolute;
        top: -80px; /* Centered nicely on the edge */
        left: 50%;
        transform: translateX(-50%);
        z-index: 20;
        pointer-events: none;
    }

    .doctor-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 8px solid white;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        transition: all 0.5s ease;
        background: white;
    }
    
    .doctor-card:hover .doctor-avatar {
        transform: scale(1.1);
        border-color: var(--rk-accent);
        box-shadow: 0 15px 45px rgba(225, 36, 84, 0.3);
    }

    .doctor-name {
        font-size: 24px;
        font-weight: 800;
        color: var(--rk-primary);
        margin-bottom: 8px;
        line-height: 1.2;
    }

    .badge-category {
        background: #f1f6ff;
        color: var(--rk-primary);
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 8px 18px;
        border-radius: 30px;
        margin-bottom: 15px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    /* Status Badges */
    .status-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 7px 20px;
        border-radius: 30px;
        text-transform: uppercase;
        background: #ebfbee;
        color: #1e7e34;
        border: 1px solid rgba(40, 167, 69, 0.1);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 15px;
    }
    .status-badge.offline {
        background: #f8f9fa;
        color: #6c757d;
        border-color: #dee2e6;
    }

    .price-tag {
        font-size: 26px;
        color: var(--rk-primary);
        font-weight: 900;
        margin: 10px 0 20px;
    }

    .schedule-info {
        background: #f8fafd;
        padding: 15px;
        border-radius: 20px;
        font-size: 14px;
        color: #5a6b8a;
        border: 1px solid #edf2f9;
        margin-bottom: 25px;
        text-align: center;
    }

    /* Pulse for Online Status */
    .pulse-dot {
        width: 10px;
        height: 10px;
        background: #28a745;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 0 rgba(40, 167, 69, 0.4);
        animation: pulse-dot 1.5s infinite;
    }
    @keyframes pulse-dot {
        0% { transform: scale(0.9); box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(40, 167, 69, 0); }
        100% { transform: scale(0.9); box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
    }

    /* --- PERBAIKAN POSISI HERO --- */
    .rk-hero {
        padding: 70px 0 120px !important; /* Mengurangi padding atas agar teks naik */
    }

    .rk-hero-inner {
        margin-top: -40px; /* Menarik konten ke arah atas */
    }

    .rk-hero-badge {
        margin-bottom: 10px !important; /* Memperkecil jarak badge ke judul */
    }

    /* Hero Typography Refinement */
    .rk-hero-title {
        font-size: 56px;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 10px; /* Dikurangi dari 12px agar lebih rapat */
        line-height: 1.1;
        letter-spacing: -1.5px;
    }
    .rk-hero-title span {
        background: linear-gradient(135deg, #e12454, #ff6b8a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .rk-breadcrumb-nav {
        margin-bottom: 20px; /* Dikurangi dari 24px */
    }
    .rk-breadcrumb {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
        font-size: 14px;
        font-weight: 500;
    }
    .rk-breadcrumb li a {
        color: rgba(255, 255, 255, 0.75);
        text-decoration: none;
        transition: color 0.3s;
    }
    .rk-breadcrumb li a:hover {
        color: #ffffff;
    }
    .rk-breadcrumb .separator {
        color: rgba(255, 255, 255, 0.3);
        font-size: 12px;
    }
    .rk-breadcrumb .active {
        color: #ff4d6d;
        font-weight: 700;
    }

    .rk-hero-desc {
        font-size: 18px;
        line-height: 1.6; /* Dikurangi sedikit dari 1.8 agar lebih compact */
        color: rgba(255, 255, 255, 0.7);
        max-width: 650px;
        margin: 0 auto;
        font-weight: 400;
    }
    .rk-hero-desc strong {
        color: #ffffff;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .rk-hero { padding: 50px 0 80px !important; }
        .rk-hero-inner { margin-top: -20px; }
        .rk-hero-title { font-size: 38px; }
        .rk-hero-desc { font-size: 16px; }
        .rk-breadcrumb { font-size: 13px; gap: 8px; }
    }

    /* Buttons */
    .btn-action {
        border-radius: 20px;
        padding: 16px 25px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 14px;
        width: 100%;
    }
    
    .btn-pay {
        background: #ffc107;
        color: #212529;
        box-shadow: 0 6px 20px rgba(255, 193, 7, 0.25);
    }
    .btn-pay:hover {
        background: #eeb000;
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(255, 193, 7, 0.35);
        color: #212529;
    }

    .btn-consult {
        background: linear-gradient(135deg, var(--rk-primary), #2b4c7e);
        color: white;
        box-shadow: 0 6px 20px rgba(34, 58, 102, 0.25);
    }
    .btn-consult:hover {
        background: linear-gradient(135deg, var(--rk-accent), #f23d6a);
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(225, 36, 84, 0.35);
        color: white;
    }

    .btn-active {
        background: linear-gradient(135deg, #129d5b, #17c671);
        color: white;
        box-shadow: 0 6px 20px rgba(18, 157, 91, 0.25);
    }
    .btn-active:hover {
        opacity: 0.95;
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(18, 157, 91, 0.35);
        color: white;
    }
</style>
@endpush

<!-- ===== HERO ===== -->
<section class="rk-hero">
    <div class="rk-hero-dots">
        <span></span><span></span><span></span><span></span>
    </div>
    <div class="container">
        <div class="rk-hero-inner">
            <div class="rk-hero-badge">
                <i class="icofont-medical-sign"></i> Kategori Dokter
            </div>
            
            <!-- Title -->
            <h1 class="rk-hero-title">
                Dokter <span>{{ ucwords($kategori) }}</span>
            </h1>
            
            <!-- Breadcrumb -->
            <nav class="rk-breadcrumb-nav">
                <ol class="rk-breadcrumb">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="separator">/</li>
                    <li><a href="{{ route('landing.dokter.kategori') }}">Kategori</a></li>
                    <li class="separator">/</li>
                    <li class="active">{{ ucwords($kategori) }}</li>
                </ol>
            </nav>

            <!-- Description -->
            <p class="rk-hero-desc">
                Konsultasikan kesehatan Anda dengan spesialis <strong>{{ strtolower($kategori) }}</strong> terbaik yang berpengalaman dan profesional di bidangnya.
            </p>
        </div>
    </div>
</section>

<div class="rk-wave" style="position: relative; z-index: 1;">
    <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 80L48 74.7C96 69.3 192 58.7 288 53.3C384 48 480 48 576 53.3C672 58.7 768 69.3 864 69.3C960 69.3 1056 58.7 1152 48C1248 37.3 1344 26.7 1392 21.3L1440 16V80H1392C1344 80 1248 80 1152 80C1056 80 960 80 864 80C768 80 672 80 576 80C480 80 384 80 288 80C192 80 96 80 48 80H0Z" fill="#f8f9fa"/>
    </svg>
</div>

<section class="section py-5 bg-light" style="margin-top: -80px; position: relative; z-index: 10;">
    <div class="container" style="overflow: visible;">

        <div class="row g-5 justify-content-center" style="overflow: visible;">
            @foreach($dokter as $d)
            <div class="col-lg-4 col-md-6 mb-5 rk-reveal rk-up rk-stagger" style="--s:{{ $loop->index % 6 }}; position: relative; z-index: 5;">

                <div class="doctor-card text-center">
                    
                    <!-- Floating Avatar -->
                    <div class="doctor-avatar-wrapper">
                        @php
                          $imagePath = file_exists(public_path($d->gambar)) ? asset($d->gambar) : asset('storage/' . $d->gambar);
                        @endphp
                        <img src="{{ $imagePath }}"
                             class="doctor-avatar shadow-lg"
                             alt="{{ $d->dokterName }}">
                    </div>

                    <h4 class="doctor-name">
                        {{ $d->dokterName }}
                    </h4>

                    <div class="text-center">
                        <span class="badge-category">
                            <i class="icofont-stethoscope"></i> {{ ucwords($d->namaBidang) }}
                        </span>
                    </div>

                    <!-- Status Label -->
                    @php
                        $status = strtolower($d->statusDokter ?? 'offline');
                        $isOnline = ($status === 'online' || $status === 'tersedia');
                    @endphp

                    <div>
                        <span class="status-badge {{ $isOnline ? '' : 'offline' }}">
                            @if($isOnline) <span class="pulse-dot"></span> @endif
                            {{ $isOnline ? 'Tersedia Sekarang' : 'Offline' }}
                        </span>
                    </div>

                    <div class="price-tag">
                        Rp {{ number_format($d->hargaKonsultasi, 0, ',', '.') }}
                    </div>

                    <!-- Schedule Box -->
                    <div class="schedule-info">
                        <i class="icofont-clock-time me-1"></i>
                        <span class="fw-bold">Jadwal:</span> 
                        {{ \Carbon\Carbon::parse($d->jadwalPraktik)->format('d M Y, H:i') }}
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-auto">
                        @auth('customer')
                            @if(isset($d->chat) && $d->chat)
                                @if($d->chat->is_paid)
                                    <a href="{{ route('landing.dokter.chat', $d->dokterId) }}" class="btn-action btn-active">
                                        <i class="icofont-chat"></i> Buka Konsultasi
                                    </a>
                                @else
                                    <a href="{{ route('landing.dokter.checkoutChat', $d->chat->chatDokterId) }}" class="btn-action btn-pay">
                                        <i class="icofont-pay"></i> Lanjutkan Pembayaran
                                    </a>
                                @endif
                            @else
                                <form action="{{ route('landing.dokter.storeChat', $d->dokterId) }}" method="POST" class="w-100">
                                    @csrf
                                    <button type="submit" class="btn-action btn-consult">
                                        <i class="icofont-doctor-alt"></i> Chat Dokter
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn-action btn-consult">
                                <i class="icofont-login"></i> Login untuk Chat
                            </a>
                        @endauth
                    </div>

                </div>

            </div>
            @endforeach
        </div>

    </div>
</section>
@endsection