@extends('layouts.app')

@section('title','Syarat & Ketentuan | RuangKonsul')
@section('meta_description','Syarat dan Ketentuan Penggunaan RuangKonsul')

@section('content')

@push('styles')
<style>

.terms-wrapper{
    position:relative;
    z-index:10;
}

.terms-card{
    background:#ffffff;
    border-radius:20px;
    padding:40px;
    box-shadow:0 10px 50px rgba(0,42,106,0.05);
    border: 1px solid rgba(0,0,0,0.04);
}

.terms-card h4{
    font-weight:700;
    color:#223a66;
    margin-bottom:25px;
}

.terms-ol{
    counter-reset:item;
    padding-left:0;
}

.terms-ol li{
    list-style:none;
    margin-bottom:20px;
    padding-left:60px;
    position:relative;
    font-size:15px;
    color:#6b7c93;
    line-height: 1.6;
}

.terms-ol li strong{
    color:#223a66;
}

.terms-ol li::before{
    content:counter(item);
    counter-increment:item;
    position:absolute;
    left:0;
    top:0;
    width:40px;
    height:40px;
    background:#e12454;
    color:#fff;
    border-radius:50%;
    text-align:center;
    line-height:40px;
    font-weight:700;
    box-shadow:0 4px 15px rgba(225,36,84,0.25);
}

.terms-footer{
    background:rgba(225,36,84,0.05);
    padding:18px;
    border-radius:10px;
    margin-top:25px;
    font-size:13px;
}

@media(max-width:768px){
    .page-hero-terms h1{
        font-size:30px;
    }

    .terms-card{
        padding:25px;
    }

    .terms-ol li{
        padding-left:50px;
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
                <i class="icofont-law-document"></i> Dokumen
            </div>
            <h1>Syarat & <span>Ketentuan</span></h1>
            <p class="rk-hero-desc">Harap membaca syarat penggunaan sebelum menggunakan layanan RuangKonsul</p>
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

    <div class="terms-wrapper">
        <div class="terms-card rk-reveal rk-up">

            <h4>Ringkasan Ketentuan Penggunaan</h4>

            <ol class="terms-ol">

                <li>
                    <strong>Umur & Kelayakan:</strong>
                    Pengguna minimal berusia 18 tahun atau telah mendapatkan izin dari wali sah untuk menggunakan layanan konsultasi kesehatan online.
                </li>

                <li>
                    <strong>Penggunaan Layanan:</strong>
                    Pengguna wajib memberikan informasi yang benar, lengkap dan tidak melakukan penyalahgunaan terhadap fitur konsultasi maupun sistem RuangKonsul.
                </li>

                <li>
                    <strong>Pembayaran:</strong>
                    Seluruh transaksi layanan konsultasi dilakukan melalui sistem pembayaran yang tersedia dan tunduk pada ketentuan checkout.
                </li>

                <li>
                    <strong>Pengembalian & Penggantian:</strong>
                    Ketentuan refund atau penggantian layanan mengikuti kebijakan masing-masing produk atau layanan kesehatan yang tersedia.
                </li>

                <li>
                    <strong>Perubahan Ketentuan:</strong>
                    RuangKonsul berhak melakukan perubahan terhadap syarat penggunaan sewaktu-waktu dan akan diumumkan melalui halaman ini.
                </li>

            </ol>

            <div class="terms-footer">
                Dokumen ini merupakan template syarat penggunaan layanan RuangKonsul. Untuk penggunaan resmi disarankan berkonsultasi dengan pihak hukum terkait.
            </div>

        </div>
    </div>

  </div>
</section>

@endsection
