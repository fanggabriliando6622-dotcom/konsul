@extends('layouts.app')

@section('title', 'Kesehatan Tubuh & Mental | RuangKonsul')

@section('meta_description', 'Menjaga kesehatan tubuh dan mental secara menyeluruh adalah kunci investasi masa depan Anda.')

@push('styles')
<style>
.blog-article { font-family: 'Inter', sans-serif; }
.blog-article img.featured { width:100%; height:360px; object-fit:cover; border-radius:16px; }
.blog-article .meta { display:flex; gap:20px; flex-wrap:wrap; margin-bottom:20px; }
.blog-article .meta span { display:flex; align-items:center; gap:6px; font-size:13px; font-weight:600; }
.blog-article .meta .text-pink { color:#e12454; }

.highlight-section { background: rgba(34,58,102,0.03); border-radius: 20px; padding: 30px; margin: 30px 0; }
.step-card { background: #fff; padding: 20px; border-radius: 16px; border: 1px solid rgba(0,0,0,0.04); margin-bottom: 16px; display: flex; gap: 20px; align-items: center; }
.step-card .icon { width: 50px; height: 50px; background: rgba(225,36,84,0.1); color: #e12454; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0; }

.blog-article blockquote.rk-quote {
    background: linear-gradient(135deg, rgba(225,36,84,0.05), rgba(225,36,84,0.01));
    border-left: 4px solid #e12454;
    border-radius: 0 12px 12px 0;
    padding: 24px 30px;
    margin: 28px 0;
    font-size: 17px;
    font-weight: 600;
    color: #1a2d4d;
    font-style: italic;
    line-height: 1.6;
}
.blog-article p { font-size: 16px; color: #4a5568; line-height: 1.85; }

.cta-box-rk { background: linear-gradient(135deg, #223a66 0%, #1e3a5f 100%); padding: 32px; border-radius: 16px; text-align: center; color: #fff; margin-top: 40px; }
.btn-white-rk { background: #fff; color: #223a66; padding: 12px 28px; border-radius: 50px; font-weight: 700; text-decoration: none; display: inline-block; transition: all 0.3s; }

@media (min-width: 992px) {
    .sidebar { position: sticky; top: 120px; }
}
</style>
@endpush

@section('content')

<!-- ===== HERO ===== -->
<section class="rk-hero">
    <div class="rk-hero-dots">
        <span></span><span></span><span></span><span></span>
    </div>
    <div class="container">
        <div class="rk-hero-inner">
            <div class="rk-hero-badge">
                <i class="icofont-heart"></i> Holistic Health
            </div>
            <h1>Kesehatan Tubuh <span>& Mental</span></h1>
            <div class="d-flex justify-content-center gap-4 mt-2 text-white-50 small fw-medium">
                <span><i class="icofont-calendar"></i> 28 Januari 2026</span>
                <span><i class="icofont-user"></i> Editorial RuangKonsul</span>
                <span><i class="icofont-clock-time"></i> 6 Menit Baca</span>
            </div>
        </div>
    </div>
</section>

<div class="rk-wave">
    <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 80L48 74.7C96 69.3 192 58.7 288 53.3C384 48 480 48 576 53.3C672 58.7 768 69.3 864 69.3C960 69.3 1056 58.7 1152 48C1248 37.3 1344 26.7 1392 21.3L1440 16V80H1392C1344 80 1248 80 1152 80C1056 80 960 80 864 80C768 80 672 80 576 80C480 80 384 80 288 80C192 80 96 80 48 80H0Z" fill="#f8faff"/>
    </svg>
</div>

<!-- ===== ARTICLE CONTENT ===== -->
<section class="rk-section rk-bg-light" style="padding-top:40px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-article rk-card rk-reveal rk-up" style="padding:32px;">
                    <img src="{{ asset('images/blog/Kesehatan Tubuh.jpeg') }}" alt="Kesehatan Tubuh" class="featured mb-5">
                    
                    <p class="lead" style="font-size: 20px; font-weight: 600; color: #1a2d4d; line-height: 1.6; margin-bottom: 30px;">
                        "Mens sana in corpore sano" - Di dalam tubuh yang sehat terdapat jiwa yang kuat. Paradigma ini tetap relevan di era modern saat ini.
                    </p>

                    <p>Kesehatan merupakan fondasi utama untuk menjalani kehidupan yang produktif dan berkualitas. Pemahaman dasar tentang kondisi tubuh, seperti tekanan darah, kadar gula, dan kolesterol, sangat penting untuk mendeteksi risiko penyakit sejak dini.</p>

                    <div class="highlight-section">
                        <h4 class="fw-bold mb-4">Pentingnya Keseimbagan</h4>
                        <div class="step-card">
                            <div class="icon"><i class="icofont-check"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Kesehatan Fisik</h6>
                                <p class="mb-0 small">Pemeriksaan rutin dapat mencegah penyakit kronis seperti diabetes dan hipertensi yang sering berkembang tanpa gejala.</p>
                            </div>
                        </div>
                        <div class="step-card">
                            <div class="icon"><i class="icofont-brain"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Kesehatan Mental</h6>
                                <p class="mb-0 small">Menangani stres, kecemasan, dan kelelahan digital (burnout) sedini mungkin sebelum berdampak pada fisik.</p>
                            </div>
                        </div>
                    </div>

                    <p>Di era modern, tekanan pekerjaan, akademik, serta penggunaan teknologi yang berlebihan dapat memicu burnout. Menjaga kesehatan mental dapat dilakukan dengan mengatur waktu istirahat, membatasi paparan digital, serta menerapkan self-care secara rutin.</p>

                    <blockquote class="rk-quote">
                        Menjaga kesehatan adalah investasi terbaik agar dapat menikmati hidup dengan bahagia bersama keluarga tercinta.
                    </blockquote>

                    <p>Melalui platform RuangKonsul, Anda dapat berkonsultasi langsung dengan tenaga medis berpengalaman kapan saja dan di mana saja tanpa harus datang ke fasilitas kesehatan secara fisik. Dapatkan solusi terbaik untuk menjaga kesehatan Anda.</p>

                    <div class="cta-box-rk">
                        <h4>Dapatkan Konsultasi Medis</h4>
                        <p>Jangan tunggu sakit, mulailah berdiskusi dengan dokter kami untuk langkah pencegahan yang tepat.</p>
                        <a href="/appointment" class="btn-white-rk">Hubungi Dokter <i class="icofont-long-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="rk-sidebar-card rk-reveal rk-right" style="--s:0;">
                        <h5>Artikel Terkait</h5>
                        <div class="post-item">
                            <span>05 Mar 2018</span>
                            <h6><a href="{{ route('artikel.ksinvestasi') }}">Kesehatan Adalah Investasi</a></h6>
                        </div>
                        <div class="post-item">
                            <span>09 Mar 2018</span>
                            <h6><a href="{{ route('artikel.ksditanganmu') }}">Kesehatan Ditanganmu</a></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
