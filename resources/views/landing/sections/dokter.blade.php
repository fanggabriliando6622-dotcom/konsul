@extends('layouts.app')

@section('content')

<style>
    .dokter-page { font-family: 'Inter', sans-serif; }
    
    .doctor-card {
        border-radius: 18px;
        transition: all 0.35s ease;
        overflow: hidden;
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.04);
        box-shadow: 0 4px 20px rgba(0,42,106,0.05);
    }
    
    .doctor-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 44px rgba(0,42,106,0.1) !important;
        border-color: rgba(225,36,84,0.15) !important;
    }

    .doctor-avatar-container {
        width: 110px;
        height: 110px;
        margin: 0 auto;
        border-radius: 50%;
        padding: 5px;
        background: linear-gradient(135deg, rgba(225,36,84,0.1), rgba(225,36,84,0.25));
        position: relative;
        z-index: 1;
    }

    .doctor-avatar {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #fff;
        background-color: #f8faff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .doctor-header-bg {
        height: 70px;
        background: linear-gradient(135deg, rgba(34,58,102,0.03) 0%, rgba(34,58,102,0.06) 100%);
        border-radius: 18px 18px 0 0;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
    }

    .doctor-specialty-badge {
        background-color: rgba(225,36,84,0.08);
        color: #e12454;
        font-size: 12px;
        letter-spacing: 0.8px;
        padding: 6px 14px;
        font-weight: 700;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-transform: uppercase;
    }

    .doctor-info-item {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        font-size: 13px;
        color: #6b7c93;
        background-color: #f8faff;
        padding: 8px 12px;
        border-radius: 12px;
        flex: 1;
    }
    .doctor-info-item i { color: #223a66; }
</style>

<!-- ===== HERO ===== -->
<section class="rk-hero">
    <div class="rk-hero-dots">
        <span></span><span></span><span></span><span></span>
    </div>
    <div class="container">
        <div class="rk-hero-inner">
            <div class="rk-hero-badge">
                <i class="icofont-doctor-alt"></i> Tenaga Medis
            </div>
            <h1>Daftar <span>Dokter</span></h1>
            <p class="rk-hero-desc">Temukan dokter yang tepat untuk kebutuhan kesehatan Anda yang siap melayani kapan saja.</p>
        </div>
    </div>
</section>

<div class="rk-wave">
    <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 80L48 74.7C96 69.3 192 58.7 288 53.3C384 48 480 48 576 53.3C672 58.7 768 69.3 864 69.3C960 69.3 1056 58.7 1152 48C1248 37.3 1344 26.7 1392 21.3L1440 16V80H1392C1344 80 1248 80 1152 80C1056 80 960 80 864 80C768 80 672 80 576 80C480 80 384 80 288 80C192 80 96 80 48 80H0Z" fill="white"/>
    </svg>
</div>

<div class="container pb-5 dokter-page section" style="margin-top: -60px;">
    <!-- Doctor Grid -->
    <div class="row g-4 mt-2">
        @forelse($dokter as $d)
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4 rk-reveal rk-up rk-stagger" style="--s:{{ $loop->index % 8 }};">
            <div class="card doctor-card h-100 text-center position-relative">
                
                <!-- Background decoration above avatar -->
                <div class="doctor-header-bg"></div>

                <div class="card-body pt-4 d-flex flex-column align-items-center mt-2 position-relative z-1">
                    
                    @php
                      $imagePath = $d->gambar ? (file_exists(public_path($d->gambar)) ? asset($d->gambar) : asset('storage/' . $d->gambar)) : 'https://ui-avatars.com/api/?name=' . urlencode($d->dokterName) . '&background=random';
                    @endphp
                    
                    <div class="doctor-avatar-container mb-3 shadow-sm">
                        <img src="{{ $imagePath }}" 
                             alt="{{ $d->dokterName }}" 
                             class="doctor-avatar"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($d->dokterName) }}&background=random'">
                    </div>

                    <h5 class="fw-bold mb-1 text-dark text-truncate w-100 px-2" title="{{ $d->dokterName }}" style="font-size: 17px; color: #1a2d4d !important;">
                        {{ $d->dokterName }}
                    </h5>

                    <div class="mt-2 mb-3">
                        <span class="doctor-specialty-badge">
                            <i class="icofont-stethoscope"></i>
                            {{ $d->namaBidang }}
                        </span>
                    </div>

                    <div class="d-flex w-100 gap-2 mt-auto">
                        <div class="doctor-info-item" title="Umur">
                            <i class="icofont-birthday-cake"></i> 
                            <span class="fw-bold text-dark">{{ $d->dokterAge }} thn</span>
                        </div>
                        <div class="doctor-info-item" title="Jenis Kelamin">
                            <i class="icofont-ui-user"></i> 
                            <span class="fw-bold text-dark text-capitalize">{{ $d->jenisKelamin }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="text-muted">
                <i class="icofont-doctor fa-3x mb-3 text-light" style="font-size: 48px;"></i>
                <p class="mb-0">Belum ada data dokter tersedia.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>

@endsection
