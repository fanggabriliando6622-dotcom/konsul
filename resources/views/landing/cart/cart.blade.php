@extends('layouts.app')

@section('title','Keranjang | RuangKonsul')

@section('content')

<style>
    .cart-page { font-family: 'Inter', sans-serif; }
    .cart-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,42,106,0.05);
        border: 1px solid rgba(0,0,0,0.04);
        overflow: hidden;
    }
    .cart-table th {
        background-color: #f8faff;
        color: #6b7c93;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 0.8px;
        border-bottom: 2px solid rgba(0,0,0,0.04);
        padding: 16px 24px;
    }
    .cart-table td {
        padding: 24px;
        vertical-align: middle;
        border-bottom: 1px solid rgba(0,0,0,0.04);
    }
    .cart-product-img {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        object-fit: cover;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
    .qty-input {
        border-radius: 8px;
        border: 1px solid #dde3ec;
        text-align: center;
        width: 80px;
        font-weight: 600;
        color: #1a2d4d;
    }
    .btn-update {
        background-color: #f8faff;
        color: #223a66;
        border: 1px solid rgba(34,58,102,0.1);
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s;
    }
    .btn-update:hover {
        background-color: #223a66;
        color: #fff;
    }
    .btn-remove {
        background-color: rgba(225,36,84,0.08);
        color: #e12454;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s;
    }
    .btn-remove:hover {
        background-color: #e12454;
        color: #fff;
    }
    .cart-summary {
        background: #f8faff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid rgba(0,0,0,0.04);
    }
    .empty-state {
        text-align: center;
        padding: 60px 20px;
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
                <i class="icofont-shopping-cart"></i> Transaksi
            </div>
            <h1>Keranjang <span>Belanja</span></h1>
            <p class="rk-hero-desc">Periksa kembali item produk kesehatan yang akan Anda pesan.</p>
        </div>
    </div>
</section>

<div class="rk-wave">
    <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 80L48 74.7C96 69.3 192 58.7 288 53.3C384 48 480 48 576 53.3C672 58.7 768 69.3 864 69.3C960 69.3 1056 58.7 1152 48C1248 37.3 1344 26.7 1392 21.3L1440 16V80H1392C1344 80 1248 80 1152 80C1056 80 960 80 864 80C768 80 672 80 576 80C480 80 384 80 288 80C192 80 96 80 48 80H0Z" fill="white"/>
    </svg>
</div>

<div class="container py-5 cart-page" style="margin-top:-60px;">

    @if($cartItems->count() > 0)
        <div class="cart-card rk-reveal rk-up">
            <div class="table-responsive">
                <table class="table cart-table mb-0">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                            <tr data-id="{{ $item->id }}">
                                <td style="width:40%;">
                                    <div class="d-flex align-items-center gap-3">
                                        @php
                                            $prodImg = $item->produk->gambar ?? '';
                                            $finalImg = file_exists(public_path($prodImg)) ? asset($prodImg) : asset('storage/' . $prodImg);
                                            if(empty($prodImg)) $finalImg = asset('images/no-image.png');
                                        @endphp
                                        <div style="flex-shrink:0;">
                                            <img src="{{ $finalImg }}" class="cart-product-img">
                                        </div>
                                        <div>
                                            <div class="fw-bold mb-1" style="color: #1a2d4d; font-size: 16px;">{{ $item->produk->produkName ?? '' }}</div>
                                            <span class="badge bg-light text-dark border">Kode: {{ $item->produkId }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-semibold text-dark">Rp {{ number_format($item->produk->price ?? 0,0,',','.') }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <input type="number" min="1" max="{{ $item->produk->qty ?? 0 }}" value="{{ $item->qty }}" class="form-control qty-input me-2">
                                        <button class="btn btn-sm btn-update" title="Update Jumlah" style="height: 38px;"><i class="icofont-refresh"></i></button>
                                    </div>
                                </td>
                                <td class="fw-bold" style="color: #0d9488;">Rp {{ number_format(($item->produk->price ?? 0) * $item->qty,0,',','.') }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-remove" title="Hapus Produk" style="height: 38px; width: 38px;"><i class="icofont-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>  
        </div>

        <div class="row justify-content-end mt-4 rk-reveal rk-up" style="--s:1;">
            <div class="col-md-5 col-lg-4">
                <div class="cart-summary">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted fw-bold text-uppercase" style="letter-spacing:0.5px; font-size: 13px;">Total Pembayaran</span>
                        <h4 class="fw-bold mb-0 text-dark">Rp {{ number_format($total ?? 0,0,',','.') }}</h4>
                    </div>
                    <a href="{{ route('checkout') }}" class="btn rk-btn rk-btn-primary w-100 rounded-pill py-3">
                        Lanjut Checkout <i class="icofont-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

    @else
        <div class="cart-card p-5 rk-reveal rk-up">
            <div class="empty-state">
                <i class="icofont-cart text-muted opacity-25" style="font-size: 80px;"></i>
                <h4 class="fw-bold mt-4 mb-3" style="color:#1a2d4d;">Keranjang Belanja Kosong</h4>
                <p class="text-muted mb-4">Sepertinya Anda belum menambahkan produk apapun ke keranjang. Yuk temukan berbagai produk kesehatan menarik di toko kami.</p>
                <a href="{{ route('produk.index') }}" class="btn rk-btn rk-btn-primary rounded-pill px-5 py-3">
                    <i class="icofont-search-folder me-2"></i> Eksplor Produk
                </a>
            </div>
        </div>
    @endif

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.btn-update').forEach(btn=>{
        btn.addEventListener('click', function(){
            const tr = this.closest('tr');
            const id = tr.dataset.id;
            const qty = tr.querySelector('.qty-input').value;

            fetch(`{{ url('/cart/update') }}/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ qty: qty })
            }).then(r=>r.json()).then(js => {
                if(js.success) location.reload(); else alert('Gagal update');
            }).catch(()=>alert('Gagal update'));
        });
    });

    document.querySelectorAll('.btn-remove').forEach(btn=>{
        btn.addEventListener('click', function(){
            const tr = this.closest('tr');
            const id = tr.dataset.id;

            fetch(`{{ url('/cart/remove') }}/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            }).then(r=>r.json()).then(js=>{
                if(js.success) location.reload(); else alert('Gagal hapus');
            }).catch(()=>alert('Gagal hapus'));
        });
    });
});
</script>
@endpush

@endsection
