@extends('layouts.app')

@section('title','Pesanan Berhasil | RuangKonsul')

@section('content')

@push('styles')
<style>
    :root {
        --rk-primary: #223a66;
        --rk-accent: #e12454;
        --rk-success: #28a745;
        --rk-light: #f8fafd;
    }

    .success-page {
        background: var(--rk-light);
        min-height: 80vh;
        display: flex;
        align-items: center;
        padding: 40px 0;
    }

    .success-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(34, 58, 102, 0.1);
        overflow: hidden;
        border: none;
    }

    .success-header {
        background: linear-gradient(135deg, var(--rk-primary), #2b4c7e);
        padding: 40px 20px;
        color: white;
        text-align: center;
        position: relative;
    }

    .success-icon-wrapper {
        width: 80px;
        height: 80px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        color: var(--rk-success);
        font-size: 40px;
        animation: scaleIn 0.5s ease;
    }

    @keyframes scaleIn {
        from { transform: scale(0); }
        to { transform: scale(1); }
    }

    .order-meta-info {
        background: #f1f4f9;
        padding: 20px;
        border-radius: 15px;
        margin-top: -30px;
        position: relative;
        z-index: 2;
        margin-left: 20px;
        margin-right: 20px;
        display: flex;
        justify-content: space-around;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .meta-item label {
        display: block;
        font-size: 11px;
        text-transform: uppercase;
        color: #7d8ea3;
        font-weight: 700;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .meta-item span {
        font-weight: 700;
        color: var(--rk-primary);
        font-size: 15px;
    }

    .compact-details {
        padding: 40px 30px 30px;
    }

    .section-title-rk {
        font-size: 14px;
        font-weight: 800;
        color: var(--rk-primary);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .section-title-rk::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #eee;
    }

    /* Product List */
    .product-list-strip {
        max-height: 250px;
        overflow-y: auto;
        padding-right: 5px;
    }
    .product-list-strip::-webkit-scrollbar { width: 4px; }
    .product-list-strip::-webkit-scrollbar-thumb { background: #eee; border-radius: 10px; }

    .product-item-sm {
        display: flex;
        align-items: center;
        padding: 12px;
        border-radius: 12px;
        background: #fcfdfe;
        border: 1px solid #f0f3f7;
        margin-bottom: 10px;
        transition: all 0.2s;
    }
    .product-item-sm:hover {
        border-color: #dee4ed;
        background: #fff;
    }
    .product-img-sm {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        object-fit: cover;
        margin-right: 15px;
    }
    .product-info-sm h6 {
        margin: 0;
        font-size: 14px;
        font-weight: 600;
    }

    /* Actions */
    .btn-main-rk {
        background: linear-gradient(135deg, var(--rk-primary), #2b4c7e);
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 50px;
        font-weight: 700;
        transition: all 0.3s;
    }
    .btn-main-rk:hover {
        background: linear-gradient(135deg, var(--rk-accent), #f23d6a);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(225, 36, 84, 0.3);
        color: white;
    }
    .btn-outline-rk {
        border: 2px solid var(--rk-primary);
        color: var(--rk-primary);
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 700;
        transition: all 0.3s;
        text-decoration: none;
    }
    .btn-outline-rk:hover {
        background: #f1f4f9;
        color: var(--rk-primary);
    }

    .badge-paid {
        background: #e6f7ed;
        color: #129d5b;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .summary-box {
        background: var(--rk-light);
        border-radius: 15px;
        padding: 20px;
    }

</style>
@endpush

<div class="success-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                
                <div class="card success-card">
                    <!-- Top Gradient Header -->
                    <div class="success-header">
                        <div class="success-icon-wrapper">
                            <i class="icofont-check-alt"></i>
                        </div>
                        <h2 class="fw-bold text-white mb-2">Terima Kasih!</h2>
                        <p class="text-white-50 mb-4">Pesanan Anda telah berhasil diterima dan sedang kami proses.</p>
                    </div>

                    <!-- Meta Info Stats -->
                    <div class="order-meta-info">
                        <div class="meta-item">
                            <label>ID Pesanan</label>
                            <span>#{{ $pemesanan->pemesananId }}</span>
                        </div>
                        <div class="meta-item">
                            <label>Status</label>
                            @if($pemesanan->pembayaran && $pemesanan->pembayaran->status == 'paid')
                                <span class="badge-paid">LUNAS</span>
                            @else
                                <span class="badge badge-warning">PENDING</span>
                            @endif
                        </div>
                        <div class="meta-item">
                            <label>Tanggal</label>
                            <span>{{ \Carbon\Carbon::parse($pemesanan->date)->format('d M Y') }}</span>
                        </div>
                    </div>

                    <div class="compact-details">
                        <div class="row g-4">
                            <!-- Left: Items -->
                            <div class="col-md-12">
                                <div class="section-title-rk">Produk Dipesan</div>
                                <div class="product-list-strip">
                                    @foreach($pemesanan->detailPemesanan as $detail)
                                    <div class="product-item-sm">
                                        @php
                                            $prodImg = $detail->produk->gambar ?? '';
                                            $finalProdImg = asset('images/produk/logo.png');
                                            if ($prodImg) {
                                                if (file_exists(public_path($prodImg))) {
                                                    $finalProdImg = asset($prodImg);
                                                } elseif (file_exists(storage_path('app/public/' . $prodImg))) {
                                                    $finalProdImg = asset('storage/' . $prodImg);
                                                }
                                            }
                                        @endphp
                                        <img src="{{ $finalProdImg }}" alt="" class="product-img-sm">
                                        <div class="product-info-sm flex-grow-1">
                                            <h6>{{ strLimit($detail->produk->produkName ?? 'Produk', 35) }}</h6>
                                            <small class="text-muted">Rp {{ number_format($detail->hargaSatuan ?? 0, 0, ',', '.') }} × {{ $detail->qty }}</small>
                                        </div>
                                        <div class="text-right fw-bold text-dark">
                                            Rp {{ number_format(($detail->hargaSatuan ?? 0) * ($detail->qty ?? 1), 0, ',', '.') }}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Right: Logistics & Payment -->
                            <div class="col-md-6">
                                <div class="section-title-rk">Kepada Penerima</div>
                                <div class="d-flex gap-2 align-items-start mb-2">
                                    <i class="icofont-ui-user text-accent-rk mt-1"></i>
                                    <div>
                                        <div class="fw-bold text-dark small">{{ $pemesanan->nama_penerima }}</div>
                                        <div class="text-muted small">{{ $pemesanan->no_telp_penerima }}</div>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 align-items-start">
                                    <i class="icofont-location-pin text-accent-rk mt-1"></i>
                                    <div class="text-muted small">{{ strLimit($pemesanan->alamat_pengiriman, 60) }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="section-title-rk">Pembayaran</div>
                                <div class="summary-box">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted small">Metode:</span>
                                        <span class="fw-bold small">{{ $pemesanan->pembayaran->metodePembayaran ?? 'Manual' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between pt-2 border-top">
                                        <span class="text-dark fw-bold">Total Akhir</span>
                                        <span class="text-accent-rk fw-bold fs-5">Rp {{ number_format($pemesanan->totalPrice, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bottom Actions -->
                        <div class="text-center mt-5 pt-4 border-top">
                            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                                <a href="{{ route('order.history') }}" class="btn btn-main-rk">
                                    <i class="icofont-history me-2"></i> Pantau Pesanan Saya
                                </a>
                                <a href="{{ route('produk.index') }}" class="btn btn-outline-rk">
                                    Kembali Belanja
                                </a>
                            </div>
                            <p class="text-muted small mt-4">Punya kendala? <a href="#" class="text-primary-rk text-decoration-none fw-bold">Hubungi Customer Service</a></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@php
function strLimit($string, $limit) {
    if (strlen($string) > $limit) {
        return substr($string, 0, $limit) . '...';
    }
    return $string;
}
@endphp
