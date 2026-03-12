@extends('layouts.app')

@section('title','Riwayat Pesanan | RuangKonsul')

@section('content')

<style>
    .order-history-page { font-family: 'Inter', sans-serif; }
    .history-card {
        border: none;
        border-radius: 18px;
        box-shadow: 0 4px 20px rgba(0,42,106,0.05);
        transition: all 0.35s ease;
        background: #fff;
        margin-bottom: 20px;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.04);
    }
    .history-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0,42,106,0.1);
    }
    .history-header {
        background: #f8faff;
        padding: 16px 25px;
        border-bottom: 1px solid rgba(0,0,0,0.04);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .order-id {
        font-family: monospace;
        font-size: 1.05rem;
        font-weight: 700;
        color: #223a66;
        background: rgba(34,58,102,0.08);
        padding: 4px 12px;
        border-radius: 8px;
    }
    .history-body { padding: 25px; }
    .info-label {
        font-size: 12px;
        color: #6b7c93;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 4px;
        font-weight: 700;
    }
    .info-value {
        font-size: 15px;
        font-weight: 600;
        color: #1a2d4d;
    }
    .status-badge {
        padding: 8px 16px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .status-warning { background-color: rgba(255, 193, 7, 0.15); color: #d39e00; }
    .status-success { background-color: rgba(40, 167, 69, 0.15); color: #28a745; }
    .status-danger  { background-color: rgba(220, 53, 69, 0.15); color: #dc3545; }
    .btn-detail {
        border-radius: 30px;
        padding: 8px 24px;
        font-weight: 600;
        transition: all 0.2s;
        border: 2px solid #223a66;
        color: #223a66;
        background: transparent;
    }
    .btn-detail:hover {
        background: #223a66;
        color: #fff;
        transform: translateY(-2px);
    }
    .price-tag { font-size: 1.25rem; color: #0d9488; font-weight: 700; }
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,42,106,0.05);
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
                <i class="fas fa-shopping-bag"></i> Riwayat
            </div>
            <h1>Riwayat <span>Pesanan Anda</span></h1>
            <p class="rk-hero-desc">Pantau status pesanan dan lihat riwayat belanja Anda di RuangKonsul.</p>
        </div>
    </div>
</section>

<div class="rk-wave">
    <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 80L48 74.7C96 69.3 192 58.7 288 53.3C384 48 480 48 576 53.3C672 58.7 768 69.3 864 69.3C960 69.3 1056 58.7 1152 48C1248 37.3 1344 26.7 1392 21.3L1440 16V80H1392C1344 80 1248 80 1152 80C1056 80 960 80 864 80C768 80 672 80 576 80C480 80 384 80 288 80C192 80 96 80 48 80H0Z" fill="white"/>
    </svg>
</div>

<div class="container py-5 order-history-page">

    @if($pemesanan->count() > 0)
        <!-- List of Orders -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @foreach($pemesanan as $order)
                    <div class="history-card">
                        <!-- Card Header -->
                        <div class="history-header flex-column flex-sm-row gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <span class="order-id">
                                    <i class="fas fa-hashtag text-muted me-1"></i>{{ $order->pemesananId }}
                                </span>
                                <span class="text-muted fw-medium d-flex align-items-center">
                                    <i class="far fa-calendar-alt me-2"></i> {{ \Carbon\Carbon::parse($order->date)->format('d M Y') }}
                                </span>
                            </div>
                            
                            <div>
                                @if($order->pembayaran)
                                    @if($order->pembayaran->status == 'pending')
                                        <span class="status-badge status-warning">
                                            <i class="fas fa-clock"></i> Menunggu Pembayaran
                                        </span>
                                    @elseif($order->pembayaran->status == 'paid')
                                        <span class="status-badge status-success">
                                            <i class="fas fa-check-circle"></i> Sudah Dibayar
                                        </span>
                                    @else
                                        <span class="status-badge status-danger">
                                            <i class="fas fa-times-circle"></i> Gagal
                                        </span>
                                    @endif
                                @else
                                    <span class="badge bg-secondary rounded-pill px-3 py-2">Belum ada info</span>
                                @endif
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="history-body">
                            <div class="row align-items-center">
                                <div class="col-md-3 col-sm-6 mb-3 mb-md-0 border-end border-light d-none d-sm-block">
                                    <div class="info-label">Jumlah Item</div>
                                    <div class="info-value d-flex align-items-center gap-2">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle" style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; font-size: 0.75rem;">
                                            <i class="fas fa-box-open"></i>
                                        </div>
                                        {{ $order->detailPemesanan->count() }} Produk
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-6 mb-3 mb-md-0">
                                    <div class="info-label">Total Belanja</div>
                                    <div class="price-tag">
                                        Rp {{ number_format($order->totalPrice ?? 0, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="col-md-4 text-md-end text-center mt-3 mt-md-0">
                                    <a href="{{ route('order.success', $order->pemesananId) }}" class="btn btn-outline-primary btn-detail w-100 w-md-auto">
                                        Lihat Detail Pesanan <i class="fas fa-chevron-right ms-1 small"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="empty-state">
                    <div class="mb-4">
                        <i class="fas fa-shopping-cart text-muted opacity-25" style="font-size: 5rem;"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Wah, keranjang riwayatmu masih kosong!</h4>
                    <p class="text-muted mb-4">Sepertinya Anda belum pernah melakukan pesanan produk apapun. Yuk temukan berbagai produk kesehatan menarik di toko kami.</p>
                    <a href="{{ route('produk.index') }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">
                        <i class="fas fa-store me-2"></i> Mulai Belanja Sekarang
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>

@endsection
