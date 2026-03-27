@extends('layouts.app')

@section('title', 'Jadwal Janji Temu | RuangKonsul')

@section('content')
<style>
    .appointment-page { font-family: 'Inter', sans-serif; }
    .appointment-card {
        border-radius: 20px;
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.04);
        background: #ffffff;
        box-shadow: 0 4px 20px rgba(0,42,106,0.05);
    }
    .appointment-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 44px rgba(0,42,106,0.1) !important;
        border-color: rgba(225,36,84,0.15);
    }
    .icon-box-rk {
        width: 56px; height: 56px;
        background: linear-gradient(135deg, rgba(34,58,102,0.1), rgba(34,58,102,0.05));
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        margin-right: 16px;
        color: #223a66;
    }
    .info-label-rk {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #8898aa;
        font-weight: 700;
        margin-bottom: 4px;
    }
    .empty-state-rk {
        padding: 60px 20px;
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 4px 20px rgba(0,42,106,0.04);
        border: 1px dashed rgba(0,0,0,0.1);
    }
    .rk-hero-inner{
        padding: 15px;
    }
</style>

<!-- ===== HERO ===== -->
<section class="rk-hero">
    <div class="rk-hero-dots">
        <span></span><span></span><span></span><span></span>
    </div>
    <div class="container">
        <div class="rk-hero-inner">
            <div class="rk-hero-badge">
                <i class="icofont-calendar"></i> Jadwal Anda
            </div>
            <h1>Jadwal <span>Janji Temu</span></h1>
            <p class="rk-hero-desc">Berikut adalah riwayat dan jadwal janji temu reservasi klinik yang telah Anda buat di RuangKonsul.</p>
        </div>
    </div>
</section>

<div class="rk-wave">
    <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 80L48 74.7C96 69.3 192 58.7 288 53.3C384 48 480 48 576 53.3C672 58.7 768 69.3 864 69.3C960 69.3 1056 58.7 1152 48C1248 37.3 1344 26.7 1392 21.3L1440 16V80H1392C1344 80 1248 80 1152 80C1056 80 960 80 864 80C768 80 672 80 576 80C480 80 384 80 288 80C192 80 96 80 48 80H0Z" fill="#f8fafd"/>
    </svg>
</div>

<section class="section appointment-page py-5" style="background: #f8fafd; margin-top: -60px;">
    <div class="container">
        <!-- ===== SECTION 1: UPCOMING ===== -->
        <div class="row align-items-center mb-4 rk-reveal rk-up">
            <div class="col-auto">
                <div class="p-2 rounded-3 bg-primary text-white mb-2" style="width: fit-content;">
                    <i class="icofont-clock-time fs-4"></i>
                </div>
            </div>
            <div class="col">
                <h3 class="fw-bold text-dark mb-0">Jadwal Janji Temu</h3>
                <p class="text-muted small mb-0">Jadwal konsultasi aktif Anda yang akan segera datang.</p>
            </div>
        </div>

        <div class="row rk-reveal rk-up mb-5">
            @forelse($upcomingAppointments as $appointment)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4 rk-stagger" style="--s:{{ $loop->index % 6 }};">
                    <div class="card appointment-card d-flex flex-column h-100 p-1">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                                <div class="icon-box-rk">
                                    <i class="icofont-ui-calendar" style="font-size: 26px;"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-bold text-dark" style="font-size: 18px;">{{ \Carbon\Carbon::parse($appointment->date)->translatedFormat('d F Y') }}</h5>
                                    <div class="text-muted small fw-semibold d-flex align-items-center gap-1">
                                        <i class="icofont-clock-time text-accent-rk" style="color: #e12454;"></i> {{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }} WIB
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <h6 class="info-label-rk">Nama Pasien</h6>
                                <p class="mb-0 fw-bold" style="color: #1a2d4d; font-size: 15px;">
                                    <i class="icofont-user text-accent-rk me-2" style="color:#e12454;"></i>
                                    {{ $appointment->namaPasien ?? ($appointment->customer->name ?? 'Pasien') }}
                                </p>
                            </div>

                            <div class="mb-4">
                                <h6 class="info-label-rk">Dokter Praktik</h6>
                                <p class="mb-0 fw-bold" style="color: #1a2d4d; font-size: 15px;">
                                    <i class="icofont-doctor-alt text-primary me-2"></i>
                                    {{ $appointment->dokter->dokterName ?? 'Dokter tidak ditemukan' }}
                                </p>
                            </div>

                            <div class="mb-2">
                                <h6 class="info-label-rk">Pesan/Keluhan</h6>
                                <p class="mb-0 text-muted" style="font-style: italic; font-size: 14px; line-height: 1.6;">
                                    "{{ $appointment->pesan ?? '-' }}"
                                </p>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 px-4 pb-4 pt-0 mt-auto">
                            <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill fw-bold" style="font-size: 12px; background: rgba(34,58,102,0.08); color: #223a66;">
                                <i class="icofont-check-circled fs-6"></i> Terjadwal
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="p-5 text-center bg-white rounded-4 border border-dashed">
                        <p class="text-muted mb-0">Tidak ada jadwal janji temu yang aktif saat ini.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- ===== SECTION 2: HISTORY ===== -->
        <div class="row align-items-center mt-5 mb-4 rk-reveal rk-up">
            <div class="col-auto">
                <div class="p-2 rounded-3 bg-secondary text-white mb-2" style="width: fit-content;">
                    <i class="icofont-history fs-4"></i>
                </div>
            </div>
            <div class="col">
                <h3 class="fw-bold text-dark mb-0">Riwayat Janji Temu</h3>
                <p class="text-muted small mb-0">Daftar janji temu Anda yang sudah terlaksana sebelumnya.</p>
            </div>
        </div>

        <div class="row rk-reveal rk-up">
            @forelse($pastAppointments as $appointment)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4 rk-stagger" style="--s:{{ $loop->index % 6 }};">
                    <div class="card appointment-card d-flex flex-column h-100 p-1 opacity-75">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                                <div class="icon-box-rk bg-light text-muted">
                                    <i class="icofont-check-alt" style="font-size: 26px;"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-bold text-secondary" style="font-size: 18px;">{{ \Carbon\Carbon::parse($appointment->date)->translatedFormat('d F Y') }}</h5>
                                    <div class="text-muted small fw-semibold">
                                        {{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }} WIB
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <h6 class="info-label-rk">Nama Pasien</h6>
                                <p class="mb-0 fw-bold" style="color: #6c757d; font-size: 15px;">
                                    {{ $appointment->namaPasien ?? ($appointment->customer->name ?? 'Pasien') }}
                                </p>
                            </div>

                            <div class="mb-4">
                                <h6 class="info-label-rk">Dokter Praktik</h6>
                                <p class="mb-0 fw-bold" style="color: #6c757d; font-size: 15px;">
                                    {{ $appointment->dokter->dokterName ?? 'Dokter tidak ditemukan' }}
                                </p>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 px-4 pb-4 pt-0 mt-auto">
                            <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill fw-bold" style="font-size: 12px; background: #f1f4f9; color: #8898aa;">
                                <i class="icofont-history fs-6"></i> Selesai
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="p-4 text-center text-muted border rounded-4 bg-light">
                        <small>Belum ada riwayat janji temu.</small>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="row mt-5 rk-reveal rk-up">
            <div class="col-12 text-center">
                <a href="{{ url('/') }}" class="btn rk-btn btn-outline-primary rounded-pill px-4 py-2 border-2 fw-bold" style="color: #223a66; border-color: #223a66;">
                    <i class="icofont-arrow-left me-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
