@extends('layouts.app')

@section('title','Checkout | RuangKonsul')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="{{ asset('css/location-picker.css') }}">
<style>
    /* ===== CHECKOUT PAGE STYLES ===== */
    .ck-page { background: #f0f2f5; min-height: 100vh; padding: 40px 0 60px; }

    .ck-header { text-align: center; margin-bottom: 32px; }
    .ck-header h2 { color: #223a66; font-size: 28px; font-weight: 700; margin-bottom: 6px; }
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
        display: flex; align-items: center; gap: 10px;
    }
    .ck-card-head i { font-size: 22px; color: #e12454; }
    .ck-card-head h5 { margin: 0; font-size: 16px; font-weight: 700; color: #223a66; }
    .ck-card-body { padding: 24px; }

    .ck-stripe {
        height: 4px;
        background: linear-gradient(90deg, #223a66 0%, #2b4c7e 40%, #e12454 60%, #f23d6a 100%);
    }

    /* Form inputs */
    .ck-input {
        border-radius: 8px; border: 1px solid #dde3ec;
        padding: 10px 14px; font-size: 14px; transition: border 0.2s;
        width: 100%; display: block;
    }
    .ck-input:focus {
        border-color: #223a66;
        box-shadow: 0 0 0 3px rgba(34,58,102,0.08);
        outline: none;
    }
    select:disabled {
        background-color: #f5f7fa; color: #aab4c4;
        cursor: not-allowed; opacity: 1;
    }

    /* Sembunyikan dropdown & UI internal dari location-picker component
       agar tidak double dengan field yang kita buat di checkout.blade */
    .loc-manual-edit, .loc-selected, .loc-coords, .loc-accuracy-badge { display: none !important; }

    /* ===== LOCATION BOX ===== */
    .ck-loc-box {
        border: 1.5px solid #dde3ec;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 4px;
        transition: border-color 0.2s;
    }
    .ck-loc-box.saved { border-color: #28a745; }
    .ck-loc-box.editing { border-color: #223a66; }

    /* Alamat tersimpan — tampilan ringkas */
    .ck-loc-saved {
        display: none;
        padding: 14px 16px;
        background: #f0fdf4;
        align-items: center;
        gap: 12px;
    }
    .ck-loc-saved.show { display: flex; }
    .ck-loc-saved-icon {
        width: 40px; height: 40px; border-radius: 50%;
        background: #28a745; display: flex; align-items: center;
        justify-content: center; flex-shrink: 0;
    }
    .ck-loc-saved-icon i { color: #fff; font-size: 18px; }
    .ck-loc-saved-text { flex: 1; }
    .ck-loc-saved-text .label {
        font-size: 11px; font-weight: 700; color: #28a745;
        text-transform: uppercase; letter-spacing: 0.5px;
    }
    .ck-loc-saved-text .addr {
        font-size: 13px; color: #222; font-weight: 600; margin-top: 2px;
    }
    .ck-loc-saved-text .region {
        font-size: 12px; color: #6F8BA4; margin-top: 2px;
    }
    .ck-loc-edit-btn {
        background: none; border: 1.5px solid #223a66; color: #223a66;
        border-radius: 8px; padding: 7px 14px; font-size: 13px;
        font-weight: 600; cursor: pointer; white-space: nowrap;
        transition: all 0.2s; display: flex; align-items: center; gap: 6px;
    }
    .ck-loc-edit-btn:hover { background: #223a66; color: #fff; }

    /* Peta & form picker — tampilan saat editing */
    .ck-loc-picker { display: block; }
    .ck-loc-picker.hidden { display: none; }

    /* Tombol Simpan Alamat */
    .ck-btn-save-addr {
        width: 100%; padding: 13px;
        background: #223a66; color: #fff;
        border: none; border-radius: 0 0 10px 10px;
        font-size: 14px; font-weight: 700;
        cursor: pointer; transition: all 0.25s;
        display: flex; align-items: center;
        justify-content: center; gap: 8px;
    }
    .ck-btn-save-addr:hover { background: #1a2d52; }
    .ck-btn-save-addr.loading {
        background: #8a9bb5; cursor: not-allowed;
    }
    .ck-btn-save-addr.manual {
        border-radius: 10px; margin-top: 15px;
        background: linear-gradient(135deg, #223a66 0%, #2b4c7e 100%);
        box-shadow: 0 4px 12px rgba(34,58,102,0.15);
    }
    .ck-btn-save-addr.manual:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(34,58,102,0.25); background: #1a2d52; }

    /* Notifikasi sukses simpan */
    .ck-addr-toast {
        display: none;
        background: #d1fae5; border: 1px solid #6ee7b7;
        border-radius: 8px; padding: 10px 14px;
        font-size: 13px; color: #065f46;
        align-items: center; gap: 8px;
        margin-top: 10px;
        animation: fadeSlide 0.3s ease;
    }
    .ck-addr-toast.show { display: flex; }

    /* Section title */
    .ck-section-title {
        font-size: 12px; font-weight: 700; color: #6F8BA4;
        text-transform: uppercase; letter-spacing: 0.6px;
        margin: 20px 0 14px;
        display: flex; align-items: center; gap: 8px;
    }
    .ck-section-title::after {
        content: ''; flex: 1; height: 1px; background: #eef2f6;
    }

    /* Product table */
    .ck-product { display: flex; align-items: center; padding: 14px 24px; border-bottom: 1px solid #f3f5f8; }
    .ck-product:last-child { border-bottom: none; }
    .ck-product-img { width: 56px; height: 56px; border-radius: 10px; overflow: hidden; border: 1px solid #eee; margin-right: 14px; flex-shrink: 0; }
    .ck-product-img img { width: 100%; height: 100%; object-fit: cover; }
    .ck-product-name { font-weight: 600; color: #222; font-size: 14px; flex: 1; }
    .ck-product-price { width: 130px; text-align: center; color: #555; font-size: 14px; }
    .ck-product-qty { width: 80px; text-align: center; color: #555; font-size: 14px; }
    .ck-product-subtotal { width: 140px; text-align: right; font-weight: 700; color: #223a66; font-size: 14px; }
    .ck-product-footer { background: #f8fafd; padding: 14px 24px; display: flex; align-items: center; justify-content: space-between; }
    .ck-product-footer .total-label { color: #6F8BA4; font-size: 14px; }
    .ck-product-footer .total-value { color: #223a66; font-size: 20px; font-weight: 700; }

    /* Payment */
    .ck-pay-group { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 20px; }
    .ck-pay-btn {
        padding: 12px 20px; border: 2px solid #dde3ec; background: #fff;
        border-radius: 10px; cursor: pointer; font-size: 14px; font-weight: 600;
        color: #555; transition: all 0.25s ease; display: flex; align-items: center;
        gap: 8px; position: relative; overflow: hidden;
    }
    .ck-pay-btn i { font-size: 18px; }
    .ck-pay-btn:hover { border-color: #223a66; color: #223a66; background: #f8fafd; }
    .ck-pay-btn.active {
        border-color: #223a66; color: #223a66;
        background: linear-gradient(135deg, rgba(34,58,102,0.04), rgba(34,58,102,0.08));
        box-shadow: 0 2px 8px rgba(34,58,102,0.12);
    }
    .ck-pay-btn.active::after {
        content: "✓"; position: absolute; top: -1px; right: -1px;
        background: #223a66; color: #fff; font-size: 10px;
        width: 20px; height: 20px; display: flex; align-items: center;
        justify-content: center; border-radius: 0 8px 0 8px;
    }
    .ck-pay-detail {
        background: #f8fafd; border: 1px solid #eef2f6; border-radius: 10px;
        padding: 18px; display: none; animation: fadeSlide 0.3s ease;
    }
    .ck-pay-detail.show { display: block; }
    @keyframes fadeSlide {
        from { opacity: 0; transform: translateY(-8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Summary */
    .ck-summary { background: linear-gradient(135deg, #223a66, #2b4c7e); border-radius: 14px; padding: 28px; color: #fff; }
    .ck-summary-row { display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 14px; opacity: 0.85; }
    .ck-summary-total { display: flex; justify-content: space-between; align-items: center; padding-top: 16px; margin-top: 14px; border-top: 1px solid rgba(255,255,255,0.15); }
    .ck-summary-total .lbl { font-size: 16px; font-weight: 600; }
    .ck-summary-total .val { font-size: 26px; font-weight: 700; }

    .ck-btn-submit {
        display: block; width: 100%; padding: 16px;
        background: #e12454; color: #fff; border: none; border-radius: 10px;
        font-size: 16px; font-weight: 700; cursor: pointer; margin-top: 18px;
        transition: all 0.3s; box-shadow: 0 4px 16px rgba(225,36,84,0.35);
        text-transform: uppercase; letter-spacing: 0.5px;
    }
    .ck-btn-submit:hover { background: #c91d47; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(225,36,84,0.45); }
    .ck-btn-submit:disabled { background: #8a9bb5; cursor: not-allowed; transform: none; box-shadow: none; }
    .ck-btn-back { display: block; width: 100%; text-align: center; margin-top: 12px; color: rgba(255,255,255,0.7); font-size: 13px; text-decoration: none; }
    .ck-btn-back:hover { color: #fff; }
    .ck-secure { display: flex; align-items: center; gap: 8px; color: rgba(255,255,255,0.6); font-size: 12px; margin-top: 14px; justify-content: center; }

    /* Loader */
    .ck-loader-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255,255,255,0.97); z-index: 99999; display: none; flex-direction: column; justify-content: center; align-items: center; }
    .ck-loader-overlay.show { display: flex; }
    .ck-loader-spinner { width: 64px; height: 64px; border: 5px solid #eef2f6; border-top: 5px solid #223a66; border-radius: 50%; animation: ckSpin 0.9s linear infinite; margin-bottom: 20px; }
    .ck-loader-overlay h4 { color: #223a66; font-weight: 700; margin-bottom: 4px; }
    .ck-loader-overlay p  { color: #6F8BA4; font-size: 14px; }
    @keyframes ckSpin { to { transform: rotate(360deg); } }
    .ck-loader-success .ck-loader-spinner { border-top-color: #28a745; animation: none; border: 5px solid #28a745; }
    .ck-loader-success .ck-loader-spinner::after { content: "✓"; display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; font-size: 28px; color: #28a745; font-weight: 700; }
    .ck-loader-success h4 { color: #28a745 !important; }

    @media (max-width: 768px) {
        .ck-product-price, .ck-product-qty { display: none; }
        .ck-product-subtotal { width: auto; }
        .ck-pay-group { flex-direction: column; }
        .ck-pay-btn { width: 100%; justify-content: center; }
    }
</style>
@endpush

@section('content')

<div class="ck-loader-overlay" id="ckLoader">
    <div class="ck-loader-spinner"></div>
    <h4 id="ckLoaderTitle">Memproses Pembayaran...</h4>
    <p id="ckLoaderDesc">Mohon tunggu, jangan tutup halaman ini.</p>
</div>

<div class="ck-page">
    <div class="container" style="max-width: 960px;">

        <div class="ck-header">
            <h2><i class="icofont-cart"></i> Checkout</h2>
            <p>Lengkapi data berikut untuk menyelesaikan pemesanan Anda</p>
        </div>

        <form action="{{ route('order.process') }}" method="POST" id="ckForm">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger mb-4" style="border-radius: 10px;">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-4">
                <div class="col-lg-7">

                    <!-- ====== ALAMAT PENGIRIMAN ====== -->
                    <div class="ck-card">
                        <div class="ck-stripe"></div>
                        <div class="ck-card-head">
                            <i class="icofont-location-pin"></i>
                            <h5>Alamat Pengiriman</h5>
                        </div>
                        <div class="ck-card-body">

                            {{-- Nama & Telepon --}}
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Nama Penerima</label>
                                    <input type="text" class="form-control ck-input" name="nama_penerima"
                                        value="{{ old('nama_penerima', $customer->name) }}"
                                        required placeholder="Nama lengkap penerima">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">No. Telepon</label>
                                    <input type="text" class="form-control ck-input" name="no_telp_penerima"
                                        value="{{ old('no_telp_penerima', $customer->customerNoTelp) }}"
                                        required placeholder="08xxxxxxxxxx">
                                </div>
                            </div>

                            {{-- ===== LOCATION BOX ===== --}}
                            <label class="form-label small fw-bold mb-2">
                                <i class="icofont-map text-danger me-1"></i> Lokasi Pengiriman
                            </label>

                            <div class="ck-loc-box" id="locBox">

                                {{-- Tampilan setelah alamat disimpan --}}
                                <div class="ck-loc-saved" id="locSaved">
                                    <div class="ck-loc-saved-icon">
                                        <i class="icofont-location-pin"></i>
                                    </div>
                                    <div class="ck-loc-saved-text">
                                        <div class="label">✓ Alamat Tersimpan</div>
                                        <div class="addr" id="locSavedAddr">—</div>
                                        <div class="region" id="locSavedRegion">—</div>
                                    </div>
                                    <button type="button" class="ck-loc-edit-btn" id="btnEditLoc" onclick="editLocation()">
                                        <i class="icofont-ui-edit"></i> Ubah Lokasi
                                    </button>
                                </div>

                                {{-- Peta & picker --}}
                                <div class="ck-loc-picker" id="locPicker">
                                    <x-location-picker
                                        inputName="alamat_pengiriman"
                                        latName="latitude"
                                        lngName="longitude"
                                        :address="old('alamat_pengiriman', $customer->alamat ?? '')"
                                        :latitude="old('latitude', $customer->latitude ?? '')"
                                        :longitude="old('longitude', $customer->longitude ?? '')"
                                        mapId="checkoutMap"
                                        placeholder="Cari atau klik peta untuk pilih lokasi..."
                                    />

                                    {{-- Tombol Simpan Alamat --}}
                                    <button type="button" class="ck-btn-save-addr" id="btnSaveAddr" onclick="saveAddress()">
                                        <i class="icofont-check-circled"></i> Simpan Alamat & Isi Wilayah Otomatis
                                    </button>
                                </div>

                            </div>

                            {{-- Toast sukses --}}
                            <div class="ck-addr-toast" id="addrToast">
                                <i class="icofont-check-circled" style="font-size:16px;"></i>
                                <span>Alamat berhasil disimpan! Wilayah otomatis terisi.</span>
                            </div>

                            {{-- ===== DETAIL WILAYAH ===== --}}
                            <div class="ck-section-title">
                                <i class="icofont-map-pins" style="color:#e12454;font-size:14px;"></i>
                                Detail Wilayah
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Provinsi</label>
                                    <select id="provinsi" name="provinsi" class="ck-input" required>
                                        <option value="">-- Pilih Provinsi --</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Kabupaten / Kota</label>
                                    <select id="kota" name="kota" class="ck-input" required disabled>
                                        <option value="">Pilih Kabupaten/Kota</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Kecamatan</label>
                                    <select id="kecamatan" name="kecamatan" class="ck-input" required disabled>
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Desa / Kelurahan</label>
                                    <select id="desa" name="desa" class="ck-input" required disabled>
                                        <option value="">Pilih Desa/Kelurahan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Kode Pos</label>
                                    <input type="text" id="kodepos" name="kodepos" class="ck-input" placeholder="Contoh: 51381" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Alamat Lengkap (No. Rumah / Gedung / Patokan)</label>
                                    <textarea id="detail_alamat" name="detail_alamat" class="ck-input" rows="2" placeholder="Nama jalan, Gedung, No. Rumah, Keterangan tambahan..." required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="button" class="ck-btn-save-addr manual" id="btnSaveManual" onclick="saveManualAddress()">
                                        <i class="icofont-check-circled"></i> Simpan Lokasi dari Detail Wilayah
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- ====== PRODUK DIPESAN ====== -->
                    <div class="ck-card">
                        <div class="ck-card-head">
                            <i class="icofont-box"></i>
                            <h5>Produk Dipesan</h5>
                        </div>
                        @foreach($cartItems as $item)
                        <div class="ck-product">
                            <div class="ck-product-img">
                                <img src="{{ asset($item->produk->gambar ?? 'images/produk/logo.png') }}" alt="{{ $item->produk->produkName ?? '' }}">
                            </div>
                            <div class="ck-product-name">
                                {{ $item->produk->produkName ?? 'Produk' }}
                                <div class="text-muted" style="font-size:12px;font-weight:400;">SKU: {{ $item->produkId }}</div>
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

                    <!-- ====== METODE PEMBAYARAN ====== -->
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
                            <div class="ck-pay-detail" id="detail-kartu">
                                <label class="small fw-bold mb-2 d-block">Informasi Kartu</label>
                                <div class="row g-3">
                                    <div class="col-12"><input type="text" class="form-control ck-input" placeholder="Nomor Kartu (16 digit)" maxlength="19"></div>
                                    <div class="col-6"><input type="text" class="form-control ck-input" placeholder="Berlaku Hingga (MM/YY)" maxlength="5"></div>
                                    <div class="col-6"><input type="text" class="form-control ck-input" placeholder="CVV" maxlength="4"></div>
                                </div>
                                <div class="mt-2 text-muted" style="font-size:12px;"><i class="icofont-lock"></i> Data kartu Anda terenkripsi dan aman.</div>
                            </div>
                            <div class="ck-pay-detail" id="detail-ewallet">
                                <label class="small fw-bold mb-2 d-block">Pilih E-Wallet</label>
                                <select class="form-select ck-input" id="selectEwallet" onchange="document.getElementById('payMethodInput').value = this.value;">
                                    <option value="GoPay">GoPay</option>
                                    <option value="OVO">OVO</option>
                                    <option value="ShopeePay">ShopeePay</option>
                                    <option value="DANA">DANA</option>
                                    <option value="LinkAja">LinkAja</option>
                                </select>
                                <div class="mt-2 text-muted" style="font-size:12px;"><i class="icofont-info-circle"></i> Anda akan diarahkan ke e-wallet setelah menekan Buat Pesanan.</div>
                            </div>
                        </div>
                    </div>

                </div>{{-- /col-lg-7 --}}

                <!-- ====== SIDEBAR ====== -->
                <div class="col-lg-5">
                    <div class="ck-summary" style="position:sticky;top:100px;">
                        <h5 style="margin:0 0 18px;font-size:16px;font-weight:700;color:#fff;">Ringkasan Belanja</h5>
                        <div class="ck-summary-row">
                            <span>Subtotal ({{ $cartItems->sum('qty') }} produk)</span>
                            <span>Rp {{ number_format($total ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="ck-summary-row"><span>Ongkos Kirim</span><span>Gratis</span></div>
                        <div class="ck-summary-row"><span>Biaya Layanan</span><span>Rp 0</span></div>
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
<script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ $midtransClientKey }}"></script>
<script>
/* =========================
   PAYMENT METHOD
========================== */
function selectPayment(btn) {
    document.querySelectorAll('.ck-pay-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.ck-pay-detail').forEach(d => d.classList.remove('show'));
    btn.classList.add('active');
    var method = btn.getAttribute('data-method');
    var detail = document.getElementById('detail-' + method);
    if (detail) detail.classList.add('show');
    var input = document.getElementById('payMethodInput');
    if (method === 'transfer')     input.value = document.getElementById('selectBank').value;
    else if (method === 'kartu')   input.value = 'Kartu Kredit / Debit';
    else if (method === 'ewallet') input.value = document.getElementById('selectEwallet').value;
}

/* =========================
   GLOBALS
========================== */
var BASE_URL     = 'https://ibnux.github.io/data-indonesia';
var allProvinsi  = [];   // cache data provinsi
var addrSaved    = false;

/* =========================
   WILAYAH HELPERS
========================== */
function setLoading(el, text) { el.innerHTML = '<option value="">' + text + '</option>'; el.disabled = true; }
function setIdle(el, text)    { el.innerHTML = '<option value="">' + text + '</option>'; el.disabled = true; }

function populate(el, data, placeholder) {
    el.innerHTML = '<option value="">-- ' + placeholder + ' --</option>';
    data.forEach(function(item) {
        var opt = document.createElement('option');
        opt.value = item.nama; opt.textContent = item.nama; opt.dataset.id = item.id;
        el.appendChild(opt);
    });
    el.disabled = false;
}

/* =========================
   AUTO-FILL WILAYAH
   Cocokkan nama dari OSM ke dropdown
========================== */
function normalizeStr(str) {
    return str.toUpperCase()
        .replace(/KABUPATEN\s*/g, 'KAB. ')
        .replace(/KOTA\s*/g, '')
        .replace(/KELURAHAN\s*/g, '')
        .replace(/DESA\s*/g, '')
        .trim();
}

function findBestMatch(list, keyword) {
    if (!keyword) return null;
    var kw = normalizeStr(keyword);
    // 1. exact
    for (var i = 0; i < list.length; i++) {
        if (normalizeStr(list[i].nama) === kw) return list[i];
    }
    // 2. contains
    for (var i = 0; i < list.length; i++) {
        if (normalizeStr(list[i].nama).indexOf(kw) !== -1 || kw.indexOf(normalizeStr(list[i].nama)) !== -1) return list[i];
    }
    return null;
}

/* Ambil data wilayah dari OSM berdasarkan lat/lng lalu auto-isi dropdown */
function autoFillWilayah(lat, lng, callback) {
    var selProvinsi  = document.getElementById('provinsi');
    var selKota      = document.getElementById('kota');
    var selKecamatan = document.getElementById('kecamatan');
    var selDesa      = document.getElementById('desa');

    // Reverse geocode via Nominatim
    fetch('https://nominatim.openstreetmap.org/reverse?format=json&lat=' + lat + '&lon=' + lng + '&addressdetails=1')
        .then(function(r) { return r.json(); })
        .then(function(geo) {
            var addr     = geo.address || {};
            var osmProv  = addr.state        || '';   // provinsi
            var osmKota  = addr.county || addr.city || addr.town || addr.municipality || '';
            var osmKec   = addr.suburb || addr.district || addr.village || '';
            var osmDesa  = addr.quarter || addr.neighbourhood || addr.hamlet || addr.village || '';

            console.log('[AutoFill] OSM address:', addr);

            // Step 1: cocokkan Provinsi
            if (!allProvinsi || allProvinsi.length === 0) {
                if (callback) callback(false, 'Data provinsi belum termuat. Silakan tunggu sebentar.');
                return;
            }

            var matchProv = findBestMatch(allProvinsi, osmProv);
            if (!matchProv) { if (callback) callback(false, 'Provinsi tidak ditemukan: ' + osmProv); return; }

            // Set provinsi
            for (var i = 0; i < selProvinsi.options.length; i++) {
                if (selProvinsi.options[i].value === matchProv.nama) {
                    selProvinsi.selectedIndex = i; break;
                }
            }

            setLoading(selKota, 'Mencocokkan kota...');
            setIdle(selKecamatan, 'Pilih Kecamatan');
            setIdle(selDesa, 'Pilih Desa/Kelurahan');

            // Step 2: load & cocokkan Kota
            fetch(BASE_URL + '/kabupaten/' + matchProv.id + '.json')
                .then(function(r) { return r.json(); })
                .then(function(kotaList) {
                    populate(selKota, kotaList, 'Pilih Kabupaten/Kota');

                    var matchKota = findBestMatch(kotaList, osmKota);
                    if (!matchKota) { if (callback) callback(false, 'Kota tidak ditemukan: ' + osmKota); return; }

                    for (var i = 0; i < selKota.options.length; i++) {
                        if (selKota.options[i].value === matchKota.nama) {
                            selKota.selectedIndex = i; break;
                        }
                    }

                    setLoading(selKecamatan, 'Mencocokkan kecamatan...');

                    // Step 3: load & cocokkan Kecamatan
                    fetch(BASE_URL + '/kecamatan/' + matchKota.id + '.json')
                        .then(function(r) { return r.json(); })
                        .then(function(kecList) {
                            populate(selKecamatan, kecList, 'Pilih Kecamatan');

                            var matchKec = findBestMatch(kecList, osmKec);
                            if (!matchKec) {
                                // coba pakai osmDesa sebagai fallback pencarian kecamatan
                                matchKec = findBestMatch(kecList, osmDesa);
                            }
                            if (!matchKec) { if (callback) callback(true, null, addr, null); return; }

                            for (var i = 0; i < selKecamatan.options.length; i++) {
                                if (selKecamatan.options[i].value === matchKec.nama) {
                                    selKecamatan.selectedIndex = i; break;
                                }
                            }

                            setLoading(selDesa, 'Mencocokkan desa...');

                            // Step 4: load & cocokkan Desa
                            fetch(BASE_URL + '/kelurahan/' + matchKec.id + '.json')
                                .then(function(r) { return r.json(); })
                                .then(function(desaList) {
                                    populate(selDesa, desaList, 'Pilih Desa/Kelurahan');

                                    var matchDesa = findBestMatch(desaList, osmDesa);
                                    if (matchDesa) {
                                        for (var i = 0; i < selDesa.options.length; i++) {
                                            if (selDesa.options[i].value === matchDesa.nama) {
                                                selDesa.selectedIndex = i; break;
                                            }
                                        }
                                    }

                                    if (callback) callback(true, null, addr, {
                                        provinsi: matchProv.nama,
                                        kota: matchKota.nama,
                                        kecamatan: matchKec.nama,
                                        desa: matchDesa ? matchDesa.nama : ''
                                    });
                                });
                        });
                });
        })
        .catch(function(err) {
            console.error('[AutoFill] Gagal reverse geocode:', err);
            if (callback) callback(false, 'Gagal terhubung ke server lokasi.');
        });
}

/* =========================
   SIMPAN ALAMAT
========================== */
function saveAddress() {
    var btn = document.getElementById('btnSaveAddr');

    // Ambil lat/lng dari hidden input location-picker
    var latInput = document.getElementById('latitude') ||
                   document.querySelector('input[name="latitude"]');
    var lngInput = document.getElementById('longitude') ||
                   document.querySelector('input[name="longitude"]');
    var addrInput = document.querySelector('input[name="alamat_pengiriman"]') ||
                    document.getElementById('locAddressHidden_checkoutMap');

    var lat = latInput  ? parseFloat(latInput.value)  : null;
    var lng = lngInput  ? parseFloat(lngInput.value)  : null;
    var addr = addrInput ? addrInput.value : '';

    // Juga coba ambil dari teks yang tampil di UI location-picker
    if (!addr) {
        var addrDisplay = document.getElementById('locSelectedAddr_checkoutMap');
        if (addrDisplay) addr = addrDisplay.textContent.trim();
    }

    if (!lat || !lng) {
        alert('Silakan pilih titik lokasi di peta terlebih dahulu.');
        return;
    }

    // Loading state
    btn.classList.add('loading');
    btn.innerHTML = '<i class="icofont-spinner-alt-2"></i> Menyimpan & mencocokkan wilayah...';
    btn.disabled  = true;

    autoFillWilayah(lat, lng, function(success, errMsg, osmAddr, wilayah) {
        btn.classList.remove('loading');
        btn.disabled = false;

        if (!success) {
            btn.innerHTML = '<i class="icofont-check-circled"></i> Simpan Alamat & Isi Wilayah Otomatis';
            alert('Wilayah tidak otomatis terisi (' + errMsg + ').\nSilakan pilih wilayah secara manual.');
            return;
        }

        // Tampilkan ringkasan alamat tersimpan
        var detailInput = document.getElementById('detail_alamat');
        var posInput    = document.getElementById('kodepos');

        // Isi kode pos jika ada dari OSM (biasanya ada di osmAddr.postcode)
        if (osmAddr && osmAddr.postcode && !posInput.value) {
            posInput.value = osmAddr.postcode;
        }

        var displayAddr = detailInput.value || addr ||
            (osmAddr ? [osmAddr.road, osmAddr.city_district].filter(Boolean).join(', ') : 'Lokasi dipilih dari peta');

        var regionParts = [];
        if (wilayah) {
            regionParts = [wilayah.desa, wilayah.kecamatan, wilayah.kota, wilayah.provinsi];
        } else if (osmAddr) {
            regionParts = [osmAddr.village, osmAddr.suburb, osmAddr.city, osmAddr.state];
        }
        var regionText = regionParts.filter(Boolean).join(', ');
        if (posInput.value) regionText += ' (' + posInput.value + ')';

        document.getElementById('locSavedAddr').textContent   = displayAddr;
        document.getElementById('locSavedRegion').textContent = regionText;

        // Switch tampilan: sembunyikan picker, tampilkan ringkasan
        document.getElementById('locSaved').classList.add('show');
        document.getElementById('locPicker').classList.add('hidden');
        document.getElementById('locBox').classList.add('saved');
        document.getElementById('locBox').classList.remove('editing');

        // Tampilkan toast sukses
        var toast = document.getElementById('addrToast');
        toast.classList.add('show');
        setTimeout(function() { toast.classList.remove('show'); }, 3500);

        // Reset button
        btn.innerHTML = '<i class="icofont-check-circled"></i> Simpan Alamat & Isi Wilayah Otomatis';

        addrSaved = true;
    });
}

/* =========================
   SIMPAN ALAMAT (MANUAL)
========================== */
function saveManualAddress() {
    var prov  = document.getElementById('provinsi').value;
    var kota  = document.getElementById('kota').value;
    var kec   = document.getElementById('kecamatan').value;
    var desa  = document.getElementById('desa').value;
    var kode  = document.getElementById('kodepos').value;
    var detail = document.getElementById('detail_alamat').value;

    if (!prov || !kota || !kec || !desa || !detail) {
        alert('Silakan lengkapi semua data wilayah dan alamat lengkap terlebih dahulu.');
        return;
    }

    // Tampilkan ringkasan
    var regionText = [desa, kec, kota, prov].filter(Boolean).join(', ');
    if (kode) regionText += ' (' + kode + ')';

    document.getElementById('locSavedAddr').textContent   = detail;
    document.getElementById('locSavedRegion').textContent = regionText;

    // Switch tampilan: sembunyikan picker & form, tampilkan ringkasan
    document.getElementById('locSaved').classList.add('show');
    document.getElementById('locPicker').classList.add('hidden');
    document.getElementById('locBox').classList.add('saved');
    document.getElementById('locBox').classList.remove('editing');

    // Toast sukses
    var toast = document.getElementById('addrToast');
    toast.querySelector('span').textContent = 'Alamat berhasil disimpan!';
    toast.classList.add('show');
    setTimeout(function() { toast.classList.remove('show'); }, 3500);

    addrSaved = true;
}

/* =========================
   EDIT LOKASI
========================== */
function editLocation() {
    document.getElementById('locSaved').classList.remove('show');
    document.getElementById('locPicker').classList.remove('hidden');
    document.getElementById('locBox').classList.remove('saved');
    document.getElementById('locBox').classList.add('editing');
    addrSaved = false;
}

/* =========================
   DROPDOWN WILAYAH (manual)
   Tetap bisa diubah manual jika
   auto-fill tidak cocok
========================== */
document.addEventListener('DOMContentLoaded', function () {

    var selProvinsi  = document.getElementById('provinsi');
    var selKota      = document.getElementById('kota');
    var selKecamatan = document.getElementById('kecamatan');
    var selDesa      = document.getElementById('desa');

    setIdle(selKota,      'Pilih Kabupaten/Kota');
    setIdle(selKecamatan, 'Pilih Kecamatan');
    setIdle(selDesa,      'Pilih Desa/Kelurahan');

    // Load provinsi & simpan ke cache global
    fetch(BASE_URL + '/provinsi.json')
        .then(function(r) { return r.json(); })
        .then(function(data) {
            allProvinsi = data;
            populate(selProvinsi, data, 'Pilih Provinsi');
        })
        .catch(function() {
            selProvinsi.innerHTML = '<option value="">⚠ Gagal memuat — refresh halaman</option>';
        });

    selProvinsi.addEventListener('change', function() {
        var id = this.selectedOptions[0] ? this.selectedOptions[0].dataset.id : null;
        setIdle(selKecamatan, 'Pilih Kecamatan');
        setIdle(selDesa, 'Pilih Desa/Kelurahan');
        if (!id) { setIdle(selKota, 'Pilih Kabupaten/Kota'); return; }
        setLoading(selKota, 'Memuat kota...');
        fetch(BASE_URL + '/kabupaten/' + id + '.json')
            .then(function(r) { return r.json(); })
            .then(function(data) { populate(selKota, data, 'Pilih Kabupaten/Kota'); })
            .catch(function() { selKota.innerHTML = '<option value="">⚠ Gagal</option>'; selKota.disabled = false; });
    });

    selKota.addEventListener('change', function() {
        var id = this.selectedOptions[0] ? this.selectedOptions[0].dataset.id : null;
        setIdle(selDesa, 'Pilih Desa/Kelurahan');
        if (!id) { setIdle(selKecamatan, 'Pilih Kecamatan'); return; }
        setLoading(selKecamatan, 'Memuat kecamatan...');
        fetch(BASE_URL + '/kecamatan/' + id + '.json')
            .then(function(r) { return r.json(); })
            .then(function(data) { populate(selKecamatan, data, 'Pilih Kecamatan'); })
            .catch(function() { selKecamatan.innerHTML = '<option value="">⚠ Gagal</option>'; selKecamatan.disabled = false; });
    });

    selKecamatan.addEventListener('change', function() {
        var id = this.selectedOptions[0] ? this.selectedOptions[0].dataset.id : null;
        if (!id) { setIdle(selDesa, 'Pilih Desa/Kelurahan'); return; }
        setLoading(selDesa, 'Memuat desa...');
        fetch(BASE_URL + '/kelurahan/' + id + '.json')
            .then(function(r) { return r.json(); })
            .then(function(data) { populate(selDesa, data, 'Pilih Desa/Kelurahan'); })
            .catch(function() { selDesa.innerHTML = '<option value="">⚠ Gagal</option>'; selDesa.disabled = false; });
    });

    // Kode Pos & Detail Alamat Sync (jika ada input manual)
    // opsional: tambahkan logic jika ingin sinkronisasi manual ke hidden fields

    /* =========================
       LOCATION PICKER INIT
    ========================== */
    new LocationPicker({
        mapId: 'checkoutMap',
        lat:  {{ $customer->latitude  ?? -6.2 }},
        lng:  {{ $customer->longitude ?? 106.816666 }},
        zoom: {{ ($customer->latitude) ? 16 : 13 }},
    });

    /* =========================
       FORM SUBMIT
    ========================== */
    var form   = document.getElementById('ckForm');
    var btn    = document.getElementById('btnSubmit');
    var loader = document.getElementById('ckLoader');
    var title  = document.getElementById('ckLoaderTitle');
    var desc   = document.getElementById('ckLoaderDesc');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Pastikan alamat sudah disimpan
        if (!addrSaved) {
            alert('Silakan klik "Simpan Alamat" atau "Simpan Alamat & Isi Wilayah Otomatis" terlebih dahulu.');
            document.getElementById('locBox').scrollIntoView({ behavior: 'smooth' });
            return;
        }

        var payVal = document.getElementById('payMethodInput').value;
        if (!payVal) { alert('Silakan pilih metode pembayaran.'); return; }

        // Pastikan hidden address terisi
        var addrHidden = document.getElementById('locAddressHidden_checkoutMap');
        if (addrHidden && !addrHidden.value) {
            var addrDisplay = document.getElementById('locSelectedAddr_checkoutMap');
            if (addrDisplay) addrHidden.value = addrDisplay.textContent;
        }

        btn.disabled  = true;
        btn.innerHTML = '<i class="icofont-spinner-alt-1"></i> Memproses...';
        loader.classList.add('show');

        // Prepare FormData
        var formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.snap_token) {
                // Hide loader before popup
                loader.classList.remove('show');
                btn.disabled = false;
                btn.innerHTML = '<i class="icofont-check-circled"></i> Buat Pesanan';

                // Trigger Snap popup
                window.snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        // Optional: trigger manual status verification for local dev
                        fetch("/payment/verify/" + data.order_id)
                        .then(() => {
                            window.location.href = "{{ route('order.history') }}";
                        });
                    },
                    onPending: function(result) {
                        fetch("/payment/verify/" + data.order_id)
                        .then(() => {
                            window.location.href = "{{ route('order.history') }}";
                        });
                    },
                    onError: function(result) {
                        alert("Pembayaran gagal!");
                        console.log(result);
                    },
                    onClose: function() {
                        alert('Anda menutup pop-up sebelum menyelesaikan pembayaran.');
                    }
                });
            } else if (data.error) {
                alert(data.error);
                loader.classList.remove('show');
                btn.disabled = false;
                btn.innerHTML = '<i class="icofont-check-circled"></i> Buat Pesanan';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Terjadi kesalahan sistem.");
            loader.classList.remove('show');
            btn.disabled = false;
            btn.innerHTML = '<i class="icofont-check-circled"></i> Buat Pesanan';
        });
    });

}); // end DOMContentLoaded
</script>
@endpush

@endsection