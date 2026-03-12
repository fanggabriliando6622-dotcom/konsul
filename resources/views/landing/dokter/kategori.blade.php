@extends('layouts.app')

@section('title', 'Kategori Dokter | RuangKonsul')

@section('meta_description', 'RuangKonsul - Konsultasi kesehatan online profesional')

@section('content')

<!-- ===== HERO ===== -->
<section class="rk-hero">
    <div class="rk-hero-dots">
        <span></span><span></span><span></span><span></span>
    </div>
    <div class="container">
        <div class="rk-hero-inner">
            <div class="rk-hero-badge">
                <i class="icofont-doctor-alt"></i> Dokter
            </div>
            <h1>Pilih Kategori <span>Dokter</span></h1>
            <p class="rk-hero-desc">Konsultasi medis aman, nyaman, dan terpercaya dengan ahlinya.</p>
        </div>
    </div>
</section>

<div class="rk-wave">
    <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 80L48 74.7C96 69.3 192 58.7 288 53.3C384 48 480 48 576 53.3C672 58.7 768 69.3 864 69.3C960 69.3 1056 58.7 1152 48C1248 37.3 1344 26.7 1392 21.3L1440 16V80H1392C1344 80 1248 80 1152 80C1056 80 960 80 864 80C768 80 672 80 576 80C480 80 384 80 288 80C192 80 96 80 48 80H0Z" fill="#f8f9fa"/>
    </svg>
</div>

<section class="section py-5 bg-light" style="margin-top: -80px;">
    <div class="container" style="padding-top: 40px;">

        <!-- CATEGORY GRID -->
        <div class="row g-4">

            @php
                // Mapping kategori icon
                $iconMap = [
                    'kesehatan mental' => 'icofont-brain',
                    'gizi dan nutrisi' => 'icofont-apple',
                    'parenting' => 'icofont-baby-backpack',
                    'ibu dan anak' => 'icofont-baby-teddy-bear',
                    'kesehatan seksual' => 'icofont-heart-beat',
                    'penyakit kronis' => 'icofont-medical-sign-alt',
                    'gaya hidup sehat' => 'icofont-runner',
                    'umum' => 'icofont-stethoscope'
                ];
            @endphp

            @forelse($kategori as $k)

            @php
                $nama = strtolower($k->namaBidang);
                $icon = 'icofont-doctor'; // default

                if (str_contains($nama, 'psikolog') || str_contains($nama, 'mental') || str_contains($nama, 'jiwa')) {
                    $icon = 'icofont-brain';
                }
                elseif (str_contains($nama, 'anak') || str_contains($nama, 'pediatric')) {
                    $icon = 'icofont-baby';
                }
                elseif (str_contains($nama, 'urologi')) {
                    $icon = 'icofont-pills';
                }
                elseif (str_contains($nama, 'gizi')) {
                    $icon = 'icofont-apple';
                }
                elseif (str_contains($nama, 'dalam') || str_contains($nama, 'umum')) {
                    $icon = 'icofont-stethoscope-alt';
                }
                elseif (str_contains($nama, 'olahraga')) {
                    $icon = 'icofont-runner';
                }
                elseif (str_contains($nama, 'kulit') || str_contains($nama, 'kelamin')) {
                    $icon = 'icofont-dna-alt-1';
                }
                elseif (str_contains($nama, 'gigi')) {
                    $icon = 'icofont-tooth';
                }
                elseif (str_contains($nama, 'kandungan') || str_contains($nama, 'obgyn')) {
                    $icon = 'icofont-girl';
                }
            @endphp

            <div class="col-lg-4 col-md-6 mb-4">
                <a href="{{ route('landing.dokter.list', $k->namaBidang) }}"
                   class="text-decoration-none h-100 d-block">

                    <div class="card category-card shadow-sm border-0 h-100 p-4 text-center position-relative overflow-hidden rk-reveal rk-up rk-stagger" style="--s:{{ $loop->index % 6 }};">
                        
                        <!-- Background Decoration -->
                        <div class="card-deco"></div>

                        <div class="icon-wrapper mx-auto mb-3 d-flex align-items-center justify-content-center">
                            <i class="{{ $icon }} text-accent-rk"></i>
                        </div>

                        <h5 class="fw-bold text-primary-rk mb-2 position-relative z-1">
                            {{ ucwords($k->namaBidang) }}
                        </h5>

                        <div class="d-inline-flex justify-content-center gap-2 mb-2 position-relative z-1">
                            <span class="badge bg-light text-muted border">
                                <i class="icofont-doctor me-1"></i> {{ $k->count }} Dokter
                            </span>
                        </div>

                        @if($k->online_count > 0)
                            <div class="position-absolute top-0 end-0 m-3 z-1">
                                <span class="badge online-badge rounded-pill shadow-sm">
                                    <span class="pulse-dot"></span> {{ $k->online_count }} Online
                                </span>
                            </div>
                        @else
                            <div class="position-absolute top-0 end-0 m-3 z-1">
                                <span class="badge bg-light text-secondary rounded-pill border">
                                    Offline
                                </span>
                            </div>
                        @endif

                    </div>

                </a>
            </div>

            @empty

            <div class="col-12 text-center mt-5">
                <div class="empty-state">
                    <div class="empty-icon text-muted mb-3"><i class="icofont-search-document" style="font-size: 64px; opacity: 0.5;"></i></div>
                    <h4 class="text-primary-rk fw-bold mb-2">Kategori Tidak Ditemukan</h4>
                    <p class="text-muted">Maaf, spesialisasi medis yang Anda cari tidak tersedia saat ini.<br>Silakan coba kata kunci lain.</p>
                    <a href="{{ route('landing.dokter.kategori') }}" class="btn btn-outline-primary-rk rounded-pill mt-3">Tampilkan Semua Kategori</a>
                </div>
            </div>

            @endforelse

        </div>

    </div>
</section>

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dokter.css') }}">
<style>
    /* Global Variables */
    :root {
        --rk-primary: #223a66;
        --rk-accent: #e12454;
        --rk-bg-light: #f8fafd;
    }
    .text-primary-rk { color: var(--rk-primary) !important; }
    .text-accent-rk { color: var(--rk-accent) !important; }
    .bg-light-rk { background-color: var(--rk-bg-light); }

    .btn-outline-primary-rk {
        border: 2px solid var(--rk-primary);
        color: var(--rk-primary);
        background: transparent;
        font-weight: 600;
        transition: all 0.3s ease;
        padding: 8px 20px;
    }
    .btn-outline-primary-rk:hover {
        background: var(--rk-primary);
        color: white;
        box-shadow: 0 4px 12px rgba(34, 58, 102, 0.2);
    }

    /* Header Banner - now using shared rk-hero */

    /* Search Box */
    .search-card {
        border: 1px solid rgba(34,58,102,0.05) !important;
        box-shadow: 0 15px 35px rgba(34,58,102,0.08) !important;
        background: white;
    }
    .search-group {
        border-radius: 50rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        transition: all 0.3s;
    }
    .search-group:focus-within {
        box-shadow: 0 0 0 4px rgba(34,58,102,0.1);
    }
    .search-group .form-control {
        border-color: #eef2f6;
        padding-left: 0;
        padding-right: 120px; /* Space for absolute button */
    }
    .search-group .form-control:focus {
        box-shadow: none;
        border-color: #eef2f6;
    }
    .search-group .input-group-text {
        border-color: #eef2f6;
        background: transparent;
    }
    .btn-search {
        padding: 8px 24px;
        font-weight: 600;
        z-index: 5;
    }

    /* Category Card */
    .category-card {
        border-radius: 16px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        background: white;
        border: 1px solid rgba(0,0,0,0.03) !important;
    }
    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(34,58,102,0.12) !important;
        border-color: rgba(225,36,84,0.15) !important;
    }

    .card-deco {
        position: absolute;
        width: 150px; height: 150px;
        background: radial-gradient(circle, rgba(225,36,84,0.03) 0%, rgba(255,255,255,0) 70%);
        top: -50px; right: -50px;
        border-radius: 50%;
        transition: transform 0.5s;
    }
    .category-card:hover .card-deco {
        transform: scale(1.5);
    }

    .icon-wrapper {
        width: 70px; height: 70px;
        background: rgba(225,36,84,0.05); /* very light accent */
        border-radius: 50%;
        font-size: 32px;
        transition: all 0.3s;
        box-shadow: 0 4px 10px rgba(225,36,84,0.05) inset;
    }
    .category-card:hover .icon-wrapper {
        background: linear-gradient(135deg, var(--rk-accent), #f23d6a);
        color: white;
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 8px 20px rgba(225,36,84,0.25);
    }
    .category-card:hover .icon-wrapper i {
        color: white !important;
    }

    /* Online Badge Pulse */
    .online-badge {
        background: #e6f6ee;
        color: #129d5b;
        border: 1px solid rgba(18, 157, 91, 0.2);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        font-weight: 600;
        font-size: 11px;
    }
    .pulse-dot {
        width: 8px; height: 8px;
        background: #129d5b;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 0 0 rgba(18, 157, 91, 0.7);
        animation: pulse 1.5s infinite;
    }
    @keyframes pulse {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(18, 157, 91, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(18, 157, 91, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(18, 157, 91, 0); }
    }

</style>
@endpush
@endsection
