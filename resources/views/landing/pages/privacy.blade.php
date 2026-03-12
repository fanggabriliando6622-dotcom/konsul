@extends('layouts.app')

@section('title','Kebijakan Privasi | RuangKonsul')
@section('meta_description','Kebijakan Privasi RuangKonsul')

@section('content')

@push('styles')
<style>

.policy-wrapper{
    position:relative;
    z-index:10;
}

.policy-card{
    background:#ffffff;
    border-radius:20px;
    padding:35px;
    box-shadow:0 10px 50px rgba(0,42,106,0.05);
    margin-bottom:20px;
    border: 1px solid rgba(0,0,0,0.04);
}

.policy-card h4,
.policy-card h5,
.policy-card h6{
    color:#223a66;
    font-weight:700;
}

.policy-list{
    padding-left:0;
    list-style:none;
}

.policy-list li{
    margin-bottom:15px;
    padding-left:35px;
    position:relative;
    font-size:15px;
    color:#6b7c93;
}

.policy-list li::before{
    content:'✔';
    position:absolute;
    left:0;
    top:0;
    width:22px;
    height:22px;
    background:#e12454;
    color:#fff;
    border-radius:50%;
    text-align:center;
    line-height:22px;
    font-size:12px;
}

.policy-footer{
    background:rgba(225,36,84,0.05);
    padding:15px;
    border-radius:10px;
    font-size:13px;
    margin-top:20px;
}

.contact-btn{
    border-radius:30px;
    padding:10px 24px;
    background: transparent;
    color: #223a66;
    border: 2px solid #223a66;
    font-weight: 700;
}
.contact-btn:hover {
    background: #223a66;
    color: #fff;
}

@media(max-width:768px){
    .policy-card{
        padding:25px;
    }
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
                <i class="icofont-shield-alt"></i> Kebijakan
            </div>
            <h1>Kebijakan <span>Privasi</span></h1>
            <p class="rk-hero-desc">Privasi Anda penting — berikut ringkasan bagaimana kami mengelola data Anda.</p>
        </div>
    </div>
</section>

<div class="rk-wave">
    <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 80L48 74.7C96 69.3 192 58.7 288 53.3C384 48 480 48 576 53.3C672 58.7 768 69.3 864 69.3C960 69.3 1056 58.7 1152 48C1248 37.3 1344 26.7 1392 21.3L1440 16V80H1392C1344 80 1248 80 1152 80C1056 80 960 80 864 80C768 80 672 80 576 80C480 80 384 80 288 80C192 80 96 80 48 80H0Z" fill="white"/>
    </svg>
</div>

<section class="py-5" style="margin-top:-60px;">
  <div class="container">

    <div class="policy-wrapper">
        <div class="row">

            <div class="col-lg-8">
                <div class="policy-card">

                    <h4>Ringkasan</h4>
                    <p class="text-muted">
                        Kami mengumpulkan beberapa informasi dasar untuk menyediakan layanan, memperbaiki pengalaman,
                        dan mengamankan akun Anda.
                    </p>

                    <h5 class="mt-4">Informasi yang Kami Kumpulkan</h5>
                    <ul class="policy-list">
                        <li><strong>Informasi Akun:</strong> nama, email, nomor telepon.</li>
                        <li><strong>Transaksi & Pesanan:</strong> riwayat pembelian dan pengiriman.</li>
                        <li><strong>Interaksi:</strong> pesan chat, form, dan preferensi layanan.</li>
                    </ul>

                    <h5 class="mt-4">Bagaimana Kami Menggunakannya</h5>
                    <ul class="policy-list">
                        <li>Menyediakan layanan konsultasi dan pemesanan produk.</li>
                        <li>Mengirim notifikasi terkait pesanan dan update layanan.</li>
                        <li>Meningkatkan fitur dan keamanan platform kami.</li>
                    </ul>

                    <h5 class="mt-4">Keamanan & Hak Anda</h5>
                    <p class="text-muted">
                        Kami menerapkan langkah teknis dan organisasi untuk melindungi data.
                        Anda berhak meminta akses, koreksi, atau penghapusan data melalui kontak layanan kami.
                    </p>

                    <div class="policy-footer">
                        Catatan: Ini adalah template awal. Sesuaikan konten ini dengan kebijakan hukum dan praktik perusahaan.
                    </div>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="policy-card">

                    <h5>Kontak Privacy</h5>
                    <p>Butuh bantuan terkait data pribadi?</p>

                    <a href="{{ url('/kontak') }}" class="btn btn-outline-primary btn-sm contact-btn">
                        Hubungi Kami
                    </a>

                    <hr>

                    <h6>Pembaruan Kebijakan</h6>
                    <p class="small text-muted">
                        Kebijakan dapat diperbarui. <br>
                        Tanggal terakhir pembaruan: <strong>2026-02-13</strong>
                    </p>

                </div>
            </div>

        </div>
    </div>

  </div>
</section>

@endsection
