@extends('layouts.app')

@section('title', $kategori->kategoriName . ' | RuangKonsul')
@section('meta_description', 'RuangKonsul - Jelajahi koleksi ' . $kategori->kategoriName . ' berkualitas untuk kesehatan Anda.')

@section('content')

@push('styles')
<style>
    :root {
        --rk-primary: #223a66;
        --rk-accent: #e12454;
        --rk-success: #28a745;
        --rk-warning: #ffc107;
        --rk-bg-light: #f8fafd;
    }

    /* --- Hero Section Refinement --- */
    .rk-hero {
        padding: 80px 0 120px !important; /* Menaikkan posisi agar tidak terlalu rendah */
        position: relative;
    }

    .rk-hero-inner {
        margin-top: -30px; /* Menarik konten teks ke arah atas */
    }

    /* --- Breadcrumbs --- */
    .breadcrumb-rk {
        background: transparent;
        padding: 0;
        margin-bottom: 20px;
    }
    .breadcrumb-item-rk {
        color: rgba(255,255,255,0.7);
        font-size: 13px;
    }
    .breadcrumb-item-rk a {
        color: white;
        text-decoration: none;
        opacity: 0.8;
    }
    .breadcrumb-item-rk a:hover {
        opacity: 1;
    }
    .breadcrumb-item-rk.active {
        background: white;
        padding: 4px 14px;
        border-radius: 50px;
        color: #e12454 !important;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    /* --- Product Card Premium --- */
    .product-card-premium {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        border: none !important;
        box-shadow: 0 10px 30px rgba(34,58,102,0.05) !important;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        display: flex;
        flex-direction: column; /* Memperbaiki typo flex-column */
    }
    
    .product-card-premium:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(34,58,102,0.12) !important;
    }

    /* --- Perbaikan Container Gambar --- */
    .product-image-container {
        position: relative;
        overflow: hidden;
        height: 240px;
        display: flex;             /* Memastikan gambar di tengah secara flexbox */
        align-items: center;       /* Center vertikal */
        justify-content: center;    /* Center horizontal */
        background: #ffffff;        /* Background netral agar gambar terlihat jelas */
        padding: 20px;             /* Memberi ruang agar gambar tidak menempel tepi */
    }
    
    .product-image-container img {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
        object-fit: contain;       /* Gambar menyesuaikan kotak tanpa terpotong (contain) */
        transition: transform 0.6s ease;
    }
    
    .product-card-premium:hover .product-image-container img {
        transform: scale(1.1);
    }

    /* --- Badges --- */
    .badge-stock-rk {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 5;
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .badge-in-stock { background: var(--rk-success); color: white; }
    .badge-low-stock { background: var(--rk-warning); color: #333; }
    .badge-out-of-stock { background: #6c757d; color: white; }

    /* --- Card Body --- */
    .product-body-premium {
        padding: 25px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .product-category-label {
        color: var(--rk-accent);
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
        display: block;
    }

    .product-name-rk {
        color: var(--rk-primary);
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 12px;
        line-height: 1.4;
        min-height: 50px;
    }

    .product-price-rk {
        font-size: 20px;
        font-weight: 800;
        color: var(--rk-primary);
        margin-bottom: 5px;
    }

    .product-stock-text {
        font-size: 13px;
        color: #6c757d;
        margin-bottom: 20px;
    }

    /* --- Buttons --- */
    .product-actions-rk {
        display: flex;
        gap: 10px;
        margin-top: auto; /* Memastikan tombol selalu di bawah card */
    }
    
    .btn-cart-rk {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        border: 2px solid #e1e9f1;
        background: white;
        color: var(--rk-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        transition: all 0.3s;
    }
    
    .btn-cart-rk:hover {
        background: var(--rk-primary);
        color: white;
        border-color: var(--rk-primary);
        transform: translateY(-2px);
    }
    
    .btn-buy-rk {
        flex: 1;
        background: linear-gradient(135deg, var(--rk-primary), #2b4c7e);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    
    .btn-buy-rk:hover {
        background: linear-gradient(135deg, var(--rk-accent), #f23d6a);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(225, 36, 84, 0.3);
        color: white;
    }

    /* --- Others --- */
    .floating-cart-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 100;
        background: white;
        padding: 12px 25px;
        border-radius: 50px;
        box-shadow: 0 10px 30px rgba(34,58,102,0.2);
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: var(--rk-primary);
        font-weight: 700;
        border: 2px solid var(--rk-primary);
        transition: all 0.3s ease;
    }

    .empty-state-prod {
        text-align: center;
        padding: 60px 20px;
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
            <div class="rk-hero-badge" style="margin-bottom:12px;">
                <i class="icofont-medical-sign"></i> Kategori Produk
            </div>
            
            <h1 class="mb-3">{{ $kategori->kategoriName }}</h1>
            
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center breadcrumb-rk mb-0" style="background:transparent;padding:0;">
                    <li class="breadcrumb-item-rk"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item-rk mx-2">/</li>
                    <li class="breadcrumb-item-rk"><a href="{{ route('produk.index') }}">Produk Kesehatan</a></li>
                    <li class="breadcrumb-item-rk mx-2">/</li>
                    <li class="breadcrumb-item-rk active">{{ $kategori->kategoriName }}</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<div class="rk-wave">
    <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 80L48 74.7C96 69.3 192 58.7 288 53.3C384 48 480 48 576 53.3C672 58.7 768 69.3 864 69.3C960 69.3 1056 58.7 1152 48C1248 37.3 1344 26.7 1392 21.3L1440 16V80H1392C1344 80 1248 80 1152 80C1056 80 960 80 864 80C768 80 672 80 576 80C480 80 384 80 288 80C192 80 96 80 48 80H0Z" fill="#f8f9fa"/>
    </svg>
</div>

<section class="section py-5 bg-light rk-product-section">
    <div class="container">

        @if($produks->count() > 0)
            <div class="row g-4">
                @foreach($produks as $produk)
                <div class="col-lg-4 col-md-6 mb-4 rk-reveal rk-up rk-stagger" style="--s:{{ $loop->index % 6 }};">
                    <div class="card product-card-premium h-100">
                        <!-- Image Container -->
                        <div class="product-image-container">
                            @php
                                $prodImg = $produk->gambar ?? '';
                                if ($prodImg) {
                                    // 1. Cek di folder public langsung (untuk aset statis)
                                    if (file_exists(public_path($prodImg))) {
                                        $finalImg = asset($prodImg);
                                    } 
                                    // 2. Cek di folder storage (punya Filament)
                                    elseif (file_exists(storage_path('app/public/' . $prodImg))) {
                                        $finalImg = asset('storage/' . $prodImg);
                                    }
                                    else {
                                        $finalImg = asset('images/produk/logo.png');
                                    }
                                } else {
                                    $finalImg = asset('images/produk/logo.png');
                                }
                            @endphp
                            <img src="{{ $finalImg }}" alt="{{ $produk->produkName }}">
                            
                            <!-- Stock Badge -->
                            @if($produk->qty == 0)
                                <span class="badge-stock-rk badge-out-of-stock">Stok Habis</span>
                            @elseif($produk->qty < 10)
                                <span class="badge-stock-rk badge-low-stock">Stok Terbatas</span>
                            @else
                                <span class="badge-stock-rk badge-in-stock">Tersedia</span>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="product-body-premium">
                            <span class="product-category-label">{{ $kategori->kategoriName }}</span>
                            <h4 class="product-name-rk text-dark">{{ $produk->produkName }}</h4>
                            
                            @if($produk->deskripsi)
                            <p class="product-desc-rk text-muted mb-2" style="font-size:13px; line-height:1.6;">{{ Str::limit($produk->deskripsi, 100) }}</p>
                            @endif

                            <div class="product-price-rk">
                                Rp {{ number_format($produk->price ?? 0, 0, ',', '.') }}
                            </div>
                            <div class="product-stock-text">
                                <i class="icofont-box me-1"></i> Sisa Stok: <strong>{{ $produk->qty }} unit</strong>
                            </div>

                            <!-- Detail Info Toggle -->
                            @if($produk->kegunaan || $produk->dosis || $produk->efek_samping)
                            <div class="product-detail-toggle mb-3">
                                <a class="btn btn-sm btn-outline-info w-100 rounded-pill" 
                                   data-toggle="collapse" 
                                   href="#detailProduk{{ $produk->produkId }}" 
                                   role="button" 
                                   aria-expanded="false"
                                   style="font-size:12px; font-weight:600;">
                                    <i class="icofont-info-circle me-1"></i> Lihat Detail Produk
                                </a>
                                <div class="collapse mt-2" id="detailProduk{{ $produk->produkId }}">
                                    <div class="card card-body border-0 bg-light" style="border-radius:12px; font-size:13px;">
                                        @if($produk->kegunaan)
                                        <div class="mb-2">
                                            <strong style="color: var(--rk-primary);"><i class="icofont-check-circled me-1"></i> Kegunaan:</strong>
                                            <p class="mb-1 text-muted ps-3">{{ $produk->kegunaan }}</p>
                                        </div>
                                        @endif
                                        @if($produk->dosis)
                                        <div class="mb-2">
                                            <strong style="color: var(--rk-success);"><i class="icofont-pills me-1"></i> Dosis:</strong>
                                            <p class="mb-1 text-muted ps-3">{{ $produk->dosis }}</p>
                                        </div>
                                        @endif
                                        @if($produk->efek_samping)
                                        <div class="mb-0">
                                            <strong style="color: var(--rk-accent);"><i class="icofont-warning me-1"></i> Efek Samping:</strong>
                                            <p class="mb-0 text-muted ps-3">{{ $produk->efek_samping }}</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Actions -->
                            <div class="product-actions-rk">
                                @if($produk->qty > 0)
                                    <button type="button" 
                                            class="btn-cart-rk add-to-cart-btn" 
                                            data-id="{{ $produk->produkId }}"
                                            title="Tambah ke Keranjang">
                                        <i class="icofont-shopping-cart"></i>
                                    </button>
                                    <button type="button" 
                                            class="btn-buy-rk buy-now-btn" 
                                            data-id="{{ $produk->produkId }}" 
                                            data-name="{{ $produk->produkName }}">
                                        Beli Sekarang
                                    </button>
                                @else
                                    <button class="btn btn-secondary w-100 rounded-4" disabled style="height: 50px; font-weight: 700;">
                                        Habis
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state-prod">
                <div class="empty-icon-prod"><i class="icofont-search-folder"></i></div>
                <h4 class="fw-bold text-dark">Maaf, Produk Belum Tersedia</h4>
                <p class="text-muted">Kategori ini sedang kosong, silakan cek kategori lainnya.</p>
                <a href="{{ route('landing.dokter.kategori') }}" class="btn btn-outline-primary mt-3 px-4 py-2 rounded-pill font-weight-bold">
                    Eksplor Kategori Lain
                </a>
            </div>
        @endif

    </div>
</section>



<!-- Modal untuk pilih quantity saat Buy Now -->
<div class="modal fade" id="buyNowModal" tabindex="-1" aria-labelledby="buyNowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content overflow-hidden border-0" style="border-radius: 24px; box-shadow: 0 20px 60px rgba(34, 58, 102, 0.25);">
            <div class="modal-header px-4 py-4" style="background: linear-gradient(135deg, var(--rk-primary), #2b4c7e); border: none;">
                <h5 class="modal-title text-white fw-bold d-flex align-items-center gap-2" id="buyNowModalLabel">
                    <i class="icofont-cart-alt fs-4"></i> Konfirmasi Pembelian
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.8; font-size: 24px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4 p-md-5">
                <div class="mb-4">
                    <label class="form-label small text-muted text-uppercase fw-bold ls-1 d-block mb-2">Item Terpilih</label>
                    <input type="text" class="form-control border-0 bg-light fw-bold py-3 px-3 text-dark fs-15 rounded-4" id="productNameDisplay" readonly>
                </div>
                <div class="mb-2">
                    <label class="form-label small text-muted text-uppercase fw-bold ls-1 d-block mb-3">Tentukan Jumlah</label>
                    <div class="d-flex align-items-center justify-content-center gap-3">
                        <button type="button" id="decreaseQty" class="btn btn-light shadow-sm d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border-radius: 12px; font-size: 20px;">-</button>
                        <input type="number" class="form-control text-center border-0 bg-light fw-bold fs-4" id="quantityInput" min="1" value="1" readonly style="width: 100px; height: 50px; border-radius: 12px;">
                        <button type="button" id="increaseQty" class="btn btn-light shadow-sm d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border-radius: 12px; font-size: 20px;">+</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 p-4 pt-0">
                <div class="row w-100 g-3">
                    <div class="col-sm-6 text-center text-sm-left">
                        <button type="button" class="btn btn-light w-100 py-3 rounded-pill fw-bold text-muted border" data-dismiss="modal">Batal</button>
                    </div>
                    <div class="col-sm-6 text-center text-sm-right">
                        <button type="button" class="btn w-100 py-3 rounded-pill fw-bold text-white" id="confirmBuyNowBtn" style="background: var(--rk-accent); box-shadow: 0 8px 20px rgba(225, 36, 84, 0.25);">Lanjut Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){

    // Handle Add to Cart
    document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const produkId = this.dataset.id;
            const originalIcon = this.innerHTML;
            this.innerHTML = '<i class="icofont-spinner-alt-3 icofont-spin"></i>';
            this.disabled = true;

            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    produk_id: produkId,
                    qty: 1
                })
            })
            .then(r => r.json())
            .then(js => {
                this.innerHTML = originalIcon;
                this.disabled = false;
                if(js.success) {
                    // Update header cart count if possible or just show toast
                    alert('Produk berhasil ditambahkan ke keranjang!');
                } else {
                    alert('Gagal: ' + (js.error || 'Terjadi kesalahan'));
                }
            })
            .catch(err => {
                this.innerHTML = originalIcon;
                this.disabled = false;
                console.error('Error:', err);
                alert('Gagal menambahkan ke keranjang');
            });
        });
    });

    // Handle Buy Now
    let selectedProductId = null;

    document.querySelectorAll('.buy-now-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            selectedProductId = this.dataset.id;
            const productName = this.dataset.name;

            document.getElementById('productNameDisplay').value = productName;
            document.getElementById('quantityInput').value = 1;
            $('#buyNowModal').modal('show');
        });
    });

    // Quantity increase/decrease
    const quantityInput = document.getElementById('quantityInput');

    document.getElementById('increaseQty').addEventListener('click', function() {
        quantityInput.value = parseInt(quantityInput.value) + 1;
    });

    document.getElementById('decreaseQty').addEventListener('click', function() {
        const currentVal = parseInt(quantityInput.value);
        if(currentVal > 1) quantityInput.value = currentVal - 1;
    });

    // Confirm Buy Now
    document.getElementById('confirmBuyNowBtn').addEventListener('click', function() {
        @guest('customer')
            window.location.href = '{{ route("login") }}';
            return;
        @endguest

        const qty = parseInt(quantityInput.value);
        this.innerHTML = '<i class="icofont-spinner-alt-3 icofont-spin"></i> Memproses...';
        this.disabled = true;

        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                produk_id: selectedProductId,
                qty: qty
            })
        })
        .then(r => r.json())
        .then(js => {
            if(js.success) {
                window.location.href = '{{ route("checkout") }}';
            } else {
                this.innerHTML = 'Lanjut Checkout';
                this.disabled = false;
                alert('Gagal: ' + (js.error || 'Terjadi kesalahan'));
            }
        })
        .catch(err => {
            this.innerHTML = 'Lanjut Checkout';
            this.disabled = false;
            console.error('Error:', err);
            alert('Gagal memproses pesanan');
        });
    });

});
</script>
@endpush

@endsection