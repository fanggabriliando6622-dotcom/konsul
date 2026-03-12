@extends('layouts.app')

@section('title','Checkout | RuangKonsul')

@push('styles')
<style>
    /* ===== CHECKOUT PAGE STYLES ===== */
    .ck-page { background: #f0f2f5; min-height: 100vh; padding: 40px 0 60px; }

    .ck-header {
        text-align: center;
        margin-bottom: 32px;
    }
    .ck-header h2 {
        color: #223a66;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 6px;
    }
    .ck-header p { color: #6F8BA4; font-size: 14px; }

    .ck-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 2px 12px rgba(34,58,102,0.07);
        margin-bottom: 20px;
        overflow: hidden;
    }
    .ck-card-head {
        padding: 18px 24px;
        border-bottom: 1px solid #eef2f6;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .ck-card-head i {
        font-size: 22px;
        color: #e12454;
    }
    .ck-card-head h5 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #223a66;
    }
    .ck-card-body { padding: 24px; }

    /* Stripe top decoration */
    .ck-stripe {
        height: 4px;
        background: linear-gradient(90deg, #223a66 0%, #2b4c7e 40%, #e12454 60%, #f23d6a 100%);
    }

    /* Form inputs */
    .ck-input { border-radius: 8px; border: 1px solid #dde3ec; padding: 10px 14px; font-size: 14px; transition: border 0.2s; }
    .ck-input:focus { border-color: #223a66; box-shadow: 0 0 0 3px rgba(34,58,102,0.08); }
    textarea.ck-input { resize: vertical; }

    /* Product table */
    .ck-product { display: flex; align-items: center; padding: 14px 24px; border-bottom: 1px solid #f3f5f8; }
    .ck-product:last-child { border-bottom: none; }
    .ck-product-img {
        width: 56px; height: 56px; border-radius: 10px; overflow: hidden;
        border: 1px solid #eee; margin-right: 14px; flex-shrink: 0;
    }
    .ck-product-img img { width: 100%; height: 100%; object-fit: cover; }
    .ck-product-name { font-weight: 600; color: #222; font-size: 14px; flex: 1; }
    .ck-product-price { width: 130px; text-align: center; color: #555; font-size: 14px; }
    .ck-product-qty { width: 80px; text-align: center; color: #555; font-size: 14px; }
    .ck-product-subtotal { width: 140px; text-align: right; font-weight: 700; color: #223a66; font-size: 14px; }

    .ck-product-footer {
        background: #f8fafd;
        padding: 14px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .ck-product-footer .total-label { color: #6F8BA4; font-size: 14px; }
    .ck-product-footer .total-value { color: #223a66; font-size: 20px; font-weight: 700; }

    /* Payment method buttons */
    .ck-pay-group { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 20px; }
    .ck-pay-btn {
        padding: 12px 20px;
        border: 2px solid #dde3ec;
        background: #fff;
        border-radius: 10px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        color: #555;
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        position: relative;
        overflow: hidden;
    }
    .ck-pay-btn i { font-size: 18px; }
    .ck-pay-btn:hover { border-color: #223a66; color: #223a66; background: #f8fafd; }
    .ck-pay-btn.active {
        border-color: #223a66;
        color: #223a66;
        background: linear-gradient(135deg, rgba(34,58,102,0.04), rgba(34,58,102,0.08));
        box-shadow: 0 2px 8px rgba(34,58,102,0.12);
    }
    .ck-pay-btn.active::after {
        content: "✓";
        position: absolute;
        top: -1px; right: -1px;
        background: #223a66;
        color: #fff;
        font-size: 10px;
        width: 20px; height: 20px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 0 8px 0 8px;
    }

    .ck-pay-detail {
        background: #f8fafd;
        border: 1px solid #eef2f6;
        border-radius: 10px;
        padding: 18px;
        display: none;
        animation: fadeSlide 0.3s ease;
    }
    .ck-pay-detail.show { display: block; }
    @keyframes fadeSlide {
        from { opacity: 0; transform: translateY(-8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Summary section */
    .ck-summary {
        background: linear-gradient(135deg, #223a66, #2b4c7e);
        border-radius: 14px;
        padding: 28px;
        color: #fff;
    }
    .ck-summary-row { display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 14px; opacity: 0.85; }
    .ck-summary-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 16px;
        margin-top: 14px;
        border-top: 1px solid rgba(255,255,255,0.15);
    }
    .ck-summary-total .lbl { font-size: 16px; font-weight: 600; }
    .ck-summary-total .val { font-size: 26px; font-weight: 700; }

    .ck-btn-submit {
        display: block;
        width: 100%;
        padding: 16px;
        background: #e12454;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        margin-top: 18px;
        transition: all 0.3s;
        box-shadow: 0 4px 16px rgba(225,36,84,0.35);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .ck-btn-submit:hover {
        background: #c91d47;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(225,36,84,0.45);
    }
    .ck-btn-submit:disabled {
        background: #8a9bb5;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }
    .ck-btn-back {
        display: block;
        width: 100%;
        text-align: center;
        margin-top: 12px;
        color: rgba(255,255,255,0.7);
        font-size: 13px;
        text-decoration: none;
    }
    .ck-btn-back:hover { color: #fff; }

    .ck-secure { display: flex; align-items: center; gap: 8px; color: rgba(255,255,255,0.6); font-size: 12px; margin-top: 14px; justify-content: center; }
    .ck-secure i { font-size: 14px; }

    /* Loader overlay */
    .ck-loader-overlay {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(255,255,255,0.97);
        z-index: 99999;
        display: none;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .ck-loader-overlay.show { display: flex; }
    .ck-loader-spinner {
        width: 64px; height: 64px;
        border: 5px solid #eef2f6;
        border-top: 5px solid #223a66;
        border-radius: 50%;
        animation: ckSpin 0.9s linear infinite;
        margin-bottom: 20px;
    }
    .ck-loader-overlay h4 { color: #223a66; font-weight: 700; margin-bottom: 4px; }
    .ck-loader-overlay p { color: #6F8BA4; font-size: 14px; }
    @keyframes ckSpin {
        to { transform: rotate(360deg); }
    }
    .ck-loader-success .ck-loader-spinner {
        border-top-color: #28a745;
        animation: none;
        border: 5px solid #28a745;
    }
    .ck-loader-success .ck-loader-spinner::after {
        content: "✓";
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        font-size: 28px;
        color: #28a745;
        font-weight: 700;
    }
    .ck-loader-success h4 { color: #28a745 !important; }

    /* Responsive */
    @media (max-width: 768px) {
        .ck-product-price, .ck-product-qty { display: none; }
        .ck-product-subtotal { width: auto; }
        .ck-pay-group { flex-direction: column; }
        .ck-pay-btn { width: 100%; justify-content: center; }
    }
</style>
@endpush

@section('content')

<!-- Loader Overlay -->
<div class="ck-loader-overlay" id="ckLoader">
    <div class="ck-loader-spinner"></div>
    <h4 id="ckLoaderTitle">Memproses Pembayaran...</h4>
    <p id="ckLoaderDesc">Mohon tunggu, jangan tutup halaman ini.</p>
</div>

<div class="ck-page">
    <div class="container" style="max-width: 960px;">

        <!-- Header -->
        <div class="ck-header">
            <h2><i class="icofont-cart"></i> Checkout</h2>
            <p>Lengkapi data berikut untuk menyelesaikan pemesanan Anda</p>
        </div>

        <form action="{{ route('order.process') }}" method="POST" id="ckForm">
            @csrf

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger mb-4" style="border-radius: 10px;">
                    <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <div class="row g-4">
                <div class="col-lg-7">

                    <!-- ALAMAT PENGIRIMAN -->
                    <div class="ck-card">
                        <div class="ck-stripe"></div>
                        <div class="ck-card-head">
                            <i class="icofont-location-pin"></i>
                            <h5>Alamat Pengiriman</h5>
                        </div>
                        <div class="ck-card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Nama Penerima</label>
                                    <input type="text" class="form-control ck-input" name="nama_penerima" value="{{ old('nama_penerima', $customer->customerName) }}" required placeholder="Nama lengkap penerima">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">No. Telepon</label>
                                    <input type="text" class="form-control ck-input" name="no_telp_penerima" value="{{ old('no_telp_penerima', $customer->customerNoTelp) }}" required placeholder="08xxxxxxxxxx">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Alamat Lengkap</label>
                                    <textarea class="form-control ck-input" name="alamat_pengiriman" rows="3" required placeholder="Jl. ..., RT/RW, Kel, Kec, Kota, Kode Pos">{{ old('alamat_pengiriman', $customer->alamat) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PRODUK DIPESAN -->
                    <div class="ck-card">
                        <div class="ck-card-head">
                            <i class="icofont-box"></i>
                            <h5>Produk Dipesan</h5>
                        </div>
                        @foreach($cartItems as $item)
                        <div class="ck-product">
                            <div class="ck-product-img">
                                <img src="{{ asset('storage/' . ($item->produk->gambar ?? '')) }}" alt="{{ $item->produk->produkName ?? '' }}">
                            </div>
                            <div class="ck-product-name">
                                {{ $item->produk->produkName ?? 'Produk' }}
                                <div class="text-muted" style="font-size:12px; font-weight:400;">SKU: {{ $item->produkId }}</div>
                            </div>
                            <div class="ck-product-price">Rp {{ number_format($item->produk->price ?? 0, 0, ',', '.') }}</div>
                            <div class="ck-product-qty">×{{ $item->qty }}</div>
                            <div class="ck-product-subtotal">Rp {{ number_format(($item->produk->price ?? 0) * $item->qty, 0, ',', '.') }}</div>
                        </div>
                        @endforeach
                        <div class="ck-product-footer">
                            <span class="total-label">Total ({{ $cartItems->sum('qty') }} produk)</span>
                            <span class="total-value">Rp {{ number_format($total ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- METODE PEMBAYARAN -->
                    <div class="ck-card">
                        <div class="ck-card-head">
                            <i class="icofont-credit-card"></i>
                            <h5>Metode Pembayaran</h5>
                        </div>
                        <div class="ck-card-body">
                            <input type="hidden" name="metodePembayaran" id="payMethodInput" value="Transfer Bank (BCA)">

                            <div class="ck-pay-group">
                                <button type="button" class="ck-pay-btn active" data-method="transfer" onclick="selectPayment(this)">
                                    <i class="icofont-bank-alt"></i> Transfer Bank
                                </button>
                                <button type="button" class="ck-pay-btn" data-method="kartu" onclick="selectPayment(this)">
                                    <i class="icofont-credit-card"></i> Kartu Kredit/Debit
                                </button>
                                <button type="button" class="ck-pay-btn" data-method="ewallet" onclick="selectPayment(this)">
                                    <i class="icofont-smart-phone"></i> E-Wallet
                                </button>
                            </div>

                            <!-- Transfer Bank Detail -->
                            <div class="ck-pay-detail show" id="detail-transfer">
                                <label class="small fw-bold mb-2 d-block">Pilih Bank Tujuan</label>
                                <select class="form-select ck-input" id="selectBank" onchange="document.getElementById('payMethodInput').value = this.value;">
                                    <option value="Transfer Bank (BCA)">BCA — Virtual Account</option>
                                    <option value="Transfer Bank (Mandiri)">Mandiri — Virtual Account</option>
                                    <option value="Transfer Bank (BNI)">BNI — Virtual Account</option>
                                    <option value="Transfer Bank (BRI)">BRI — Virtual Account</option>
                                    <option value="Transfer Bank (BSI)">BSI — Virtual Account</option>
                                </select>
                                <div class="mt-2 text-muted" style="font-size:12px;">
                                    <i class="icofont-info-circle"></i> Nomor virtual account akan dikirim setelah pesanan dibuat.
                                </div>
                            </div>

                            <!-- Kartu Kredit/Debit Detail -->
                            <div class="ck-pay-detail" id="detail-kartu">
                                <label class="small fw-bold mb-2 d-block">Informasi Kartu</label>
                                <div class="row g-2">
                                    <div class="col-12">
                                        <input type="text" class="form-control ck-input" placeholder="Nomor Kartu (16 digit)" maxlength="19">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control ck-input" placeholder="Berlaku Hingga (MM/YY)" maxlength="5">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control ck-input" placeholder="CVV" maxlength="4">
                                    </div>
                                </div>
                                <div class="mt-2 text-muted" style="font-size:12px;">
                                    <i class="icofont-lock"></i> Data kartu Anda terenkripsi dan aman.
                                </div>
                            </div>

                            <!-- E-Wallet Detail -->
                            <div class="ck-pay-detail" id="detail-ewallet">
                                <label class="small fw-bold mb-2 d-block">Pilih E-Wallet</label>
                                <select class="form-select ck-input" id="selectEwallet" onchange="document.getElementById('payMethodInput').value = this.value;">
                                    <option value="GoPay">GoPay</option>
                                    <option value="OVO">OVO</option>
                                    <option value="ShopeePay">ShopeePay</option>
                                    <option value="DANA">DANA</option>
                                    <option value="LinkAja">LinkAja</option>
                                </select>
                                <div class="mt-2 text-muted" style="font-size:12px;">
                                    <i class="icofont-info-circle"></i> Anda akan diarahkan ke aplikasi e-wallet setelah menekan Buat Pesanan.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- SIDEBAR SUMMARY -->
                <div class="col-lg-5">
                    <div class="ck-summary" style="position: sticky; top: 100px;">
                        <h5 style="margin: 0 0 18px; font-size: 16px; font-weight: 700; color: #fff;">Ringkasan Belanja</h5>

                        <div class="ck-summary-row">
                            <span>Subtotal ({{ $cartItems->sum('qty') }} produk)</span>
                            <span>Rp {{ number_format($total ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="ck-summary-row">
                            <span>Ongkos Kirim</span>
                            <span>Gratis</span>
                        </div>
                        <div class="ck-summary-row">
                            <span>Biaya Layanan</span>
                            <span>Rp 0</span>
                        </div>

                        <div class="ck-summary-total">
                            <span class="lbl">Total</span>
                            <span class="val">Rp {{ number_format($total ?? 0, 0, ',', '.') }}</span>
                        </div>

                        <button type="submit" class="ck-btn-submit" id="btnSubmit">
                            <i class="icofont-check-circled"></i> Buat Pesanan
                        </button>
                        <a href="{{ route('cart.index') }}" class="ck-btn-back">← Kembali ke Keranjang</a>

                        <div class="ck-secure">
                            <i class="icofont-lock"></i>
                            <span>Transaksi aman & terenkripsi · RuangKonsul</span>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function selectPayment(btn) {
    // Remove active from all buttons
    document.querySelectorAll('.ck-pay-btn').forEach(function(b) { b.classList.remove('active'); });
    // Hide all details
    document.querySelectorAll('.ck-pay-detail').forEach(function(d) { d.classList.remove('show'); });

    // Activate clicked
    btn.classList.add('active');
    var method = btn.getAttribute('data-method');
    var detail = document.getElementById('detail-' + method);
    if (detail) { detail.classList.add('show'); }

    // Update hidden input
    var input = document.getElementById('payMethodInput');
    if (method === 'transfer') {
        input.value = document.getElementById('selectBank').value;
    } else if (method === 'kartu') {
        input.value = 'Kartu Kredit / Debit';
    } else if (method === 'ewallet') {
        input.value = document.getElementById('selectEwallet').value;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('ckForm').addEventListener('submit', function(e) {
        e.preventDefault();

        var payVal = document.getElementById('payMethodInput').value;
        if (!payVal) {
            alert('Silakan pilih metode pembayaran.');
            return;
        }

        var form = this;
        var btn = document.getElementById('btnSubmit');
        var loader = document.getElementById('ckLoader');
        var title = document.getElementById('ckLoaderTitle');
        var desc = document.getElementById('ckLoaderDesc');

        // Disable button & show loader
        btn.disabled = true;
        btn.innerHTML = '<i class="icofont-spinner-alt-1"></i> Memproses...';
        loader.classList.add('show');

        // Step 1: Processing animation (2s)
        setTimeout(function() {
            title.textContent = 'Verifikasi Pembayaran...';
            desc.textContent = 'Menghubungkan ke gateway pembayaran.';
        }, 800);

        // Step 2: Success state (2.5s)
        setTimeout(function() {
            loader.classList.add('ck-loader-success');
            title.textContent = 'Pembayaran Berhasil!';
            desc.textContent = 'Pesanan Anda sedang disiapkan.';
        }, 2200);

        // Step 3: Submit form (3.2s)
        setTimeout(function() {
            form.submit();
        }, 3200);
    });
});
</script>
@endpush

@endsection
