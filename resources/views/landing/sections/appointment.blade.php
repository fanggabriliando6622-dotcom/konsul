@extends('layouts.app')

@section('title', 'Buat Janji Temu | RuangKonsul')
@section('meta_description', 'RuangKonsul - Konsultasi kesehatan online profesional terpercaya')

@section('content')

@push('styles')
<style>
    :root {
        --rk-primary: #223a66;
        --rk-accent: #e12454;
        --rk-blue-light: rgba(34, 58, 102, 0.08);
        --rk-pink-light: rgba(225, 36, 84, 0.08);
    }

    /* Card Styling */
    .appointment-card {
        border-radius: 20px;
        border: none !important;
        background: white;
        transition: all 0.4s ease;
        overflow: hidden;
        margin-top:50px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .appointment-card .card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .card-accent-border {
        height: 6px;
        background: linear-gradient(90deg, var(--rk-primary), var(--rk-accent));
        width: 100%;
    }

    /* Form Styling */
    .form-label-rk {
        font-weight: 700;
        font-size: 12px;
        color: var(--rk-primary);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .form-control-rk {
        border-radius: 12px;
        border: 1px solid #e1e9f1;
        padding: 14px 16px !important;
        font-size: 15px;
        transition: all 0.3s ease;
        background-color: #fcfdfe;
        height: auto !important;
        line-height: 1.5;
    }
    select.form-control-rk {
        appearance: auto;
        cursor: pointer;
    }
    .form-control-rk:focus {
        border-color: var(--rk-primary);
        box-shadow: 0 0 0 4px var(--rk-blue-light);
        background-color: white;
    }
    .input-icon-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        background-color: #fcfdfe;
        border: 1px solid #e1e9f1;
        border-radius: 12px;
        transition: all 0.3s ease;
        padding-left: 16px;
    }
    .input-icon-wrapper:focus-within {
        border-color: var(--rk-primary);
        box-shadow: 0 0 0 4px var(--rk-blue-light);
        background-color: white;
    }
    .input-icon-wrapper i {
        color: #adb5bd;
        font-size: 18px;
        flex-shrink: 0;
    }
    .input-icon-wrapper .form-control-rk {
        border: none !important;
        background: transparent !important;
        padding-left: 12px !important;
        box-shadow: none !important;
        width: 100%;
    }
    .input-icon-wrapper:focus-within i {
        color: var(--rk-primary);
    }

    /* Sidebar info */
    .info-item {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        align-items: flex-start;
    }
    .info-item h6{
        color: black;
    }
    .info-icon-box {
        width: 45px;
        height: 45px;
        background: var(--rk-blue-light);
        color: var(--rk-primary);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }
    
    /* Sidebar content wrapper untuk push tombol ke bawah */
    .sidebar-content {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .info-items-wrapper {
        flex: 0 0 auto;
    }
    
    .spacer-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 20px 0;
    }
    
    .bottom-cta {
        flex: 0 0 auto;
        margin-top: auto;
    }
    
    /* Stats box */
    .stats-box {
        background: linear-gradient(135deg, var(--rk-blue-light), var(--rk-pink-light));
        border-radius: 16px;
        padding: 20px;
        text-align: center;
        border: 1px solid rgba(34, 58, 102, 0.1);
    }
    
    .stats-item {
        margin-bottom: 15px;
    }
    
    .stats-item:last-child {
        margin-bottom: 0;
    }
    
    .stats-number {
        font-size: 28px;
        font-weight: 800;
        color: var(--rk-primary);
        display: block;
        line-height: 1;
        margin-bottom: 5px;
    }
    
    .stats-label {
        font-size: 13px;
        color: #6c757d;
        font-weight: 600;
    }
    
    .divider-stats {
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(34, 58, 102, 0.2), transparent);
        margin: 15px 0;
    }

    .btn-main-rk {
        background: linear-gradient(135deg, #e12454, #ff4d6d);
        color: white;
        border: none;
        padding: 14px 30px;
        border-radius: 50px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(225, 36, 84, 0.25);
    }
    .btn-main-rk:hover {
        background: linear-gradient(135deg, #c91e47, #e12454);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(225, 36, 84, 0.3);
        color: white;
    }
    .btn-outline-rk {
        border: 2px solid var(--rk-primary);
        color: var(--rk-primary);
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 700;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }
    .btn-outline-rk:hover {
        background: var(--rk-primary);
        color: white;
    }
    
    /* Row alignment */
    .appointment-row {
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
    }
    
    .appointment-row > [class*='col-'] {
        display: flex;
        flex-direction: column;
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
                <i class="icofont-calendar"></i> Appointment
            </div>
            <h1 class="rk-reveal rk-up">Buat <span>Janji Temu</span></h1>
            <p class="rk-hero-desc rk-reveal rk-up rk-stagger" style="--s:1">Langkah praktis untuk konsultasi kesehatan yang lebih baik bersama dokter ahli kami.</p>
        </div>
    </div>
</section>

<div class="rk-wave">
    <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 80L48 74.7C96 69.3 192 58.7 288 53.3C384 48 480 48 576 53.3C672 58.7 768 69.3 864 69.3C960 69.3 1056 58.7 1152 48C1248 37.3 1344 26.7 1392 21.3L1440 16V80H1392C1344 80 1248 80 1152 80C1056 80 960 80 864 80C768 80 672 80 576 80C480 80 384 80 288 80C192 80 96 80 48 80H0Z" fill="#f8f9fa"/>
    </svg>
</div>

<section class="rk-section rk-bg-light" style="padding-top: 0;">
    <div class="container" style="margin-top: -100px; position: relative; z-index: 10;">
        
        @if(session('success'))
            <div class="row justify-content-center">
                <div class="col-lg-10 mb-4">
                    <div class="alert alert-success border-0 shadow-sm rounded-4 d-flex align-items-center p-4">
                        <div class="rounded-circle bg-success text-white p-2 d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="icofont-check-alt fs-5"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Berhasil!</h6>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center g-4 appointment-row">
            <!-- Form Card -->
            <div class="col-lg-7">
                <div class="card appointment-card rk-reveal rk-left shadow-lg">
                    <div class="card-accent-border"></div>
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                            <div>
                                <h3 class="fw-bold text-primary-rk mb-1 text-dark">Lengkapi Formulir</h3>
                                <p class="text-muted small mb-0">Silakan isi jadwal dan dokter pilihan Anda.</p>
                            </div>
                            <div class="text-accent-rk fs-1 d-none d-sm-block"><i class="icofont-medical-sign"></i></div>
                        </div>

                        @if(auth()->guard('customer')->check())
                            <form method="POST" action="{{ route('appointment.store') }}">
                                @csrf
                                <div class="row g-4 pt-2">
                                    <div class="col-12">
                                        <label class="form-label-rk">Identitas Pasien</label>
                                        <div class="input-icon-wrapper">
                                            <i class="icofont-id-card"></i>
                                            <input type="text" class="form-control form-control-rk fw-bold" value="{{ auth()->guard('customer')->user()->name }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label-rk">Dokter Spesialis</label>
                                        <div class="input-icon-wrapper">
                                            <i class="icofont-doctor-alt"></i>
                                            <select name="dokterId" class="form-control form-control-rk" required>
                                                <option value="" disabled selected>Pilih Dokter...</option>
                                                @foreach($dokters as $dokter)
                                                    <option value="{{ $dokter->dokterId }}">
                                                        {{ $dokter->dokterName }} @if($dokter->namaBidang) — Spesialis {{ $dokter->namaBidang }} @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label-rk">Tanggal Konsultasi</label>
                                        <div class="input-icon-wrapper">
                                            <i class="icofont-calendar"></i>
                                            <input name="date" type="date" class="form-control form-control-rk" required min="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label-rk">Waktu / Jam</label>
                                        <div class="input-icon-wrapper">
                                            <i class="icofont-clock-time"></i>
                                            <input name="time" type="time" class="form-control form-control-rk" required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label-rk">Keluhan / Pesan Tambahan</label>
                                        <div class="input-icon-wrapper">
                                            <textarea name="pesan" class="form-control form-control-rk" rows="4" placeholder="Jelaskan kebutuhan konsultasi atau keluhan singkat Anda..."></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-5">
                                        <button type="submit" class="btn btn-main-rk w-100 py-3">
                                            Buat Janji Sekarang <i class="icofont-long-arrow-right ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <div class="text-center py-5">
                                <div class="mb-4">
                                    <i class="icofont-lock fs-1 text-accent-rk"></i>
                                </div>
                                <h4 class="fw-bold">Akses Terbatas</h4>
                                <p class="text-muted px-lg-5">Silakan masuk ke akun RuangKonsul Anda terlebih dahulu untuk dapat memesan jadwal dengan dokter kami.</p>
                                <div class="mt-4 gap-3 d-flex justify-content-center">
                                    <a href="{{ route('login') }}" class="btn btn-main-rk">Login / Masuk</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="col-lg-5">
                <div class="card appointment-card shadow-lg rk-reveal rk-right">
                    <div class="card-accent-border"></div>
                    <div class="card-body p-4">
                        <div class="sidebar-content">
                            <!-- Info Items -->
                            <div class="info-items-wrapper">
                                <h5 class="fw-bold text-primary-rk mb-4 text-dark">Kenapa Kami?</h5>
                            
                                <div class="info-item">
                                    <div class="info-icon-box"><i class="icofont-wall-clock"></i></div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Cepat & Mudah</h6>
                                        <p class="text-muted small mb-0">Atur jadwal hanya dalam hitungan detik tanpa antre.</p>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-icon-box"><i class="icofont-badge"></i></div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Dokter Ahli</h6>
                                        <p class="text-muted small mb-0">Ratusan dokter spesialis tersertifikasi siap membantu.</p>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-icon-box"><i class="icofont-support"></i></div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Bantuan 24/7</h6>
                                        <p class="text-muted small mb-0">Tim support kami siaga membantu kapan pun dibutuhkan.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Spacer Content dengan Stats -->
                            <div class="spacer-content">
                                <div class="stats-box">
                                    <div class="stats-item">
                                        <span class="stats-number">500+</span>
                                        <span class="stats-label">Dokter Berpengalaman</span>
                                    </div>
                                    <div class="divider-stats"></div>
                                    <div class="stats-item">
                                        <span class="stats-number">10K+</span>
                                        <span class="stats-label">Pasien Terlayani</span>
                                    </div>
                                    <div class="divider-stats"></div>
                                    <div class="stats-item">
                                        <span class="stats-number">4.9/5</span>
                                        <span class="stats-label">Rating Kepuasan</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Bottom CTA -->
                            @auth('customer')
                            <div class="bottom-cta">
                                <div class="p-4 rounded-4 bg-blue-light text-center border">
                                    <p class="text-dark small mb-3 fw-medium">Sudah punya jadwal aktif?</p>
                                    <a href="{{ route('appointment.schedule') }}" class="btn btn-outline-rk py-2 px-3 fw-bold w-100 fs-13">Lihat Jadwal Saya</a>
                                </div>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const revealEls = document.querySelectorAll('.rk-reveal');
    const revealObs = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('rk-visible');
            }
        });
    }, { threshold: 0.1 });
    revealEls.forEach(el => revealObs.observe(el));
});
</script>
@endpush

@endsection