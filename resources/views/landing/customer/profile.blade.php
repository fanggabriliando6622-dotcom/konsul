@extends('layouts.app')

@section('title', 'Profile & Riwayat | RuangKonsul')

@section('content')

<!-- ===== HERO ===== -->
<section class="rk-hero">
    <div class="rk-hero-dots">
        <span></span><span></span><span></span><span></span>
    </div>
    <div class="container">
        <div class="rk-hero-inner">
            <div class="rk-hero-badge">
                <i class="icofont-ui-user"></i> Akun Anda
            </div>
            <h1>Profil <span>Saya</span></h1>
            <p class="rk-hero-desc">Kelola informasi data diri dan riwayat kesehatan belanja Anda</p>
        </div>
    </div>
</section>

<div class="rk-wave">
    <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 80L48 74.7C96 69.3 192 58.7 288 53.3C384 48 480 48 576 53.3C672 58.7 768 69.3 864 69.3C960 69.3 1056 58.7 1152 48C1248 37.3 1344 26.7 1392 21.3L1440 16V80H1392C1344 80 1248 80 1152 80C1056 80 960 80 864 80C768 80 672 80 576 80C480 80 384 80 288 80C192 80 96 80 48 80H0Z" fill="#f8f9fa"/>
    </svg>
</div>

<section class="section py-5 bg-light" style="margin-top: -60px;">
    <div class="container">
        <div class="row">
            
            <!-- KIRI: Kartu Profil Utama -->
            <div class="col-lg-4 mb-4 rk-reveal rk-left">
                <div class="card profile-card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="card-body p-4 text-center">
                        
                        <!-- Avatar Container -->
                        <div class="avatar-wrapper mb-4 mx-auto position-relative">
                            @if($customer->avatar)
                                @php
                                    $avatarPath = file_exists(public_path($customer->avatar)) ? asset($customer->avatar) : asset('storage/' . $customer->avatar);
                                @endphp
                                <img src="{{ $avatarPath }}" 
                                     alt="Avatar {{ $customer->customerName }}" 
                                     class="profile-avatar shadow-sm">
                            @else
                                <div class="profile-avatar shadow-sm d-flex align-items-center justify-content-center" 
                                     style="background: linear-gradient(135deg, #223a66, #e12454); color: white; font-size: 48px; font-weight: bold;">
                                    {{ strtoupper(substr($customer->customerName, 0, 1)) }}
                                </div>
                            @endif
                            <a href="{{ route('profile.edit') }}" class="edit-avatar-badge" data-bs-toggle="tooltip" title="Edit Profil">
                                <i class="icofont-ui-edit"></i>
                            </a>
                        </div>

                        <h4 class="fw-bold text-primary-rk mb-1">{{ $customer->customerName }}</h4>
                        <p class="text-muted small mb-3">{{ $customer->customerEmail }}</p>
                        
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-light border">
                            <i class="icofont-badge text-accent-rk"></i> 
                            <span class="small fw-bold text-muted">Customer Member</span>
                        </div>

                        <hr class="my-4" style="border-color: #eef2f6;">

                        <div class="d-flex justify-content-between text-start px-3 mb-3">
                            <div>
                                <h6 class="text-primary-rk fw-bold mb-0">Total Transaksi</h6>
                                <span class="text-muted small">Pesanan Selesai</span>
                            </div>
                            <div class="text-center">
                                <span class="h4 fw-bold text-accent-rk mb-0">{{ \App\Models\Pemesanan::where('customerId', $customer->customerId)->count() }}</span>
                            </div>
                        </div>

                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary-rk w-100 rounded-pill py-2 mt-2">
                            <i class="icofont-ui-settings me-1"></i> Edit Profil
                        </a>

                    </div>
                </div>
            </div>

            <!-- KANAN: Detail Informasi -->
            <div class="col-lg-8 rk-reveal rk-right">
                <div class="card profile-card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 p-md-5">
                        <h5 class="fw-bold text-primary-rk mb-4 pb-3 border-bottom d-flex align-items-center gap-2">
                            <i class="icofont-id-card fs-4 text-accent-rk"></i> Informasi Personal
                        </h5>

                        <div class="row g-4">
                            <!-- Field: Nama Lengkap -->
                            <div class="col-md-6">
                                <div class="info-box">
                                    <div class="info-icon bg-blue-light text-primary-rk"><i class="icofont-user-alt-3"></i></div>
                                    <div class="info-content">
                                        <label>Nama Lengkap</label>
                                        <p>{{ $customer->customerName }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Field: Email -->
                            <div class="col-md-6">
                                <div class="info-box">
                                    <div class="info-icon bg-pink-light text-accent-rk"><i class="icofont-email"></i></div>
                                    <div class="info-content">
                                        <label>Alamat Email</label>
                                        <p>{{ $customer->customerEmail }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Field: No HP -->
                            <div class="col-md-6">
                                <div class="info-box">
                                    <div class="info-icon bg-blue-light text-primary-rk"><i class="icofont-ui-touch-phone"></i></div>
                                    <div class="info-content">
                                        <label>Nomor Telepon</label>
                                        <p>{{ $customer->customerNoTelp ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Field: Jenis Kelamin -->
                            <div class="col-md-6">
                                <div class="info-box">
                                    <div class="info-icon bg-pink-light text-accent-rk"><i class="icofont-group-students"></i></div>
                                    <div class="info-content">
                                        <label>Jenis Kelamin</label>
                                        <p>{{ $customer->customerJenisKelamin ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Field: Alamat Lengkap -->
                            <div class="col-12">
                                <div class="info-box">
                                    <div class="info-icon bg-blue-light text-primary-rk"><i class="icofont-location-pin"></i></div>
                                    <div class="info-content w-100">
                                        <label>Alamat Lengkap (Domisili)</label>
                                        <p class="mb-0" style="line-height: 1.6;">{{ $customer->alamat ?? 'Belum ada alamat tersimpan.' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Riwayat Pesanan Bumper -->
                        <div class="mt-5 pt-4 border-top">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <h5 class="fw-bold text-primary-rk mb-1">Riwayat Pesanan Terbaru</h5>
                                    <p class="text-muted small mb-0">Lihat status pesanan produk atau alat kesehatan Anda</p>
                                </div>
                            </div>
                            
                            <a href="{{ route('order.history') }}" class="btn btn-outline-primary-rk rounded-pill d-inline-flex align-items-center gap-2">
                                <i class="icofont-history"></i> Buka Halaman Riwayat Transaksi Menggunakan Laman Ini
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@push('styles')
<style>
    /* Color Variables */
    :root {
        --rk-primary: #223a66;
        --rk-accent: #e12454;
        --rk-blue-light: rgba(34, 58, 102, 0.08);
        --rk-pink-light: rgba(225, 36, 84, 0.08);
    }
    .text-primary-rk { color: var(--rk-primary) !important; }
    .text-accent-rk { color: var(--rk-accent) !important; }
    .bg-blue-light { background: var(--rk-blue-light); }
    .bg-pink-light { background: var(--rk-pink-light); }
    
    .btn-outline-primary-rk {
        border: 2px solid var(--rk-primary);
        color: var(--rk-primary);
        background: transparent;
        font-weight: 600;
        transition: all 0.3s ease;
        padding: 10px 24px;
    }
    .btn-outline-primary-rk:hover {
        background: var(--rk-primary);
        color: white;
        box-shadow: 0 4px 12px var(--rk-blue-light);
    }

    /* Header Banner Removed, using shared rk-hero */

    /* Card Styling */
    .profile-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.03) !important;
    }
    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(34,58,102,0.08) !important;
    }

    /* Avatar */
    .avatar-wrapper {
        width: 130px; height: 130px;
    }
    .profile-avatar {
        width: 100%; height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 8px 24px rgba(34,58,102,0.15) !important;
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .profile-card:hover .profile-avatar {
        transform: scale(1.05);
    }
    .edit-avatar-badge {
        position: absolute;
        bottom: 5px; right: 5px;
        width: 36px; height: 36px;
        background: var(--rk-accent);
        color: white;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        border: 3px solid white;
        font-size: 16px;
        transition: all 0.2s;
        text-decoration: none;
    }
    .edit-avatar-badge:hover {
        background: #c91d47;
        color: white;
        transform: scale(1.1);
    }

    /* Info Box Layout */
    .info-box {
        display: flex; align-items: flex-start; gap: 16px;
        padding: 16px;
        border-radius: 12px;
        border: 1px solid rgba(0,0,0,0.04);
        background: #fff;
        transition: all 0.3s;
    }
    .info-box:hover {
        border-color: rgba(34,58,102,0.1);
        background: #f8fafd;
    }
    .info-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; flex-shrink: 0;
    }
    .info-content label {
        display: block;
        font-size: 11px; text-transform: uppercase;
        letter-spacing: 0.5px; color: #888;
        margin-bottom: 4px; font-weight: 600;
    }
    .info-content p {
        margin: 0; color: #333; font-weight: 500; font-size: 15px;
    }

</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endpush
@endsection
