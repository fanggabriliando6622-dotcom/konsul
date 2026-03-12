@extends('layouts.app')

@section('title', 'Kesehatan Adalah Investasi | RuangKonsul')

@section('meta_description', 'Kesehatan adalah investasi terbaik untuk masa depan - Pelajari mengapa Anda harus peduli kesehatan sejak dini.')

@push('styles')
<style>
.blog-article { font-family: 'Inter', sans-serif; }
.blog-article img.featured { width:100%; height:360px; object-fit:cover; border-radius:16px; }
.blog-article .meta { display:flex; gap:20px; flex-wrap:wrap; margin-bottom:20px; }
.blog-article .meta span { display:flex; align-items:center; gap:6px; font-size:13px; font-weight:600; }
.blog-article .meta .text-pink { color:#e12454; }
.blog-article .meta .text-muted { color:#6b7c93; }
.blog-article h2.article-title { font-size:28px; font-weight:800; color:#1a2d4d; line-height:1.3; margin-bottom:20px; }

/* Custom content styles from original */
.highlight-box {
    background: linear-gradient(135deg, rgba(34,58,102,0.05), rgba(34,58,102,0.01));
    border-left: 4px solid var(--rk-primary);
    border-radius: 0 12px 12px 0;
    padding: 24px 30px;
    margin: 28px 0;
}
.highlight-box ul { list-style: none; padding: 0; margin: 0; }
.highlight-box li { margin-bottom: 15px; display: flex; align-items: start; font-size: 15px; color: #4a5568; }
.highlight-box li i { color: var(--rk-primary); margin-right: 12px; margin-top: 4px; }

.stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin: 30px 0; }
.stat-card { background: #fff; padding: 24px; border-radius: 16px; text-align: center; border: 1px solid rgba(0,0,0,0.04); box-shadow: 0 4px 12px rgba(0,42,106,0.04); }
.stat-card .number { font-size: 28px; font-weight: 800; color: var(--rk-accent); display: block; margin-bottom: 4px; }
.stat-card .label { font-size: 12px; font-weight: 600; color: #6b7c93; text-transform: uppercase; letter-spacing: 0.5px; }

.tip-item { background: #fff; border-radius: 16px; padding: 20px; margin-bottom: 16px; border: 1px solid rgba(0,0,0,0.04); display: flex; gap: 20px; transition: all 0.3s; }
.tip-item:hover { transform: translateX(8px); box-shadow: 0 8px 24px rgba(0,42,106,0.06); }
.tip-item .step { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-weight: 800; color: #fff; }

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

.rk-sidebar-card { background: #fff; border-radius: 16px; padding: 28px; border: 1px solid rgba(0,0,0,0.04); box-shadow: 0 4px 16px rgba(0,42,106,0.05); margin-bottom: 24px; }
.rk-sidebar-card h5 { font-size: 16px; font-weight: 700; color: #1a2d4d; margin-bottom: 16px; }
.rk-sidebar-card .post-item { padding: 12px 0; border-bottom: 1px solid rgba(0,0,0,0.04); }
.rk-sidebar-card .post-item:last-child { border-bottom:none; }
.rk-sidebar-card .post-item span { font-size:12px; color:#6b7c93; }
.rk-sidebar-card .post-item h6 { font-size:14px; font-weight:600; margin:4px 0 0; }
.rk-sidebar-card .post-item h6 a { color:#1a2d4d; text-decoration:none; transition:color 0.3s; }
.rk-sidebar-card .post-item h6 a:hover { color:#e12454; }

.cta-box-rk { background: linear-gradient(135deg, #e12454 0%, #ff4d6d 100%); padding: 32px; border-radius: 16px; text-align: center; color: #fff; margin-top: 40px; }
.cta-box-rk h4 { font-weight: 800; margin-bottom: 12px; }
.cta-box-rk p { color: rgba(255,255,255,0.9) !important; font-size: 15px !important; margin-bottom: 24px !important; }
.btn-white-rk { background: #fff; color: #e12454; padding: 12px 28px; border-radius: 50px; font-weight: 700; text-decoration: none; display: inline-block; transition: all 0.3s; }
.btn-white-rk:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); color: #e12454; }

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
                <i class="icofont-heart-pulse"></i> Kesehatan & Gaya Hidup
            </div>
            <h1>Kesehatan Adalah <span>Investasi Terbaik</span></h1>
            <div class="d-flex justify-content-center gap-4 mt-2 text-white-50 small fw-medium">
                <span><i class="icofont-calendar"></i> 05 Maret 2018</span>
                <span><i class="icofont-user"></i> Dr. Ahmad Setiawan</span>
                <span><i class="icofont-clock-time"></i> 8 Menit Baca</span>
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
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="blog-article rk-card rk-reveal rk-up" style="padding:32px;">
                    <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=1200&h=600&fit=crop" alt="Kesehatan Investasi" class="featured mb-5">
                    
                    <p class="lead" style="font-size: 20px; font-weight: 600; color: #1a2d4d; line-height: 1.6; margin-bottom: 30px;">
                        Pernahkah Anda mendengar pepatah "kesehatan adalah harta yang paling berharga"? Ternyata, kesehatan bukan hanya sekadar harta, tetapi juga investasi terbaik yang bisa Anda lakukan untuk masa depan.
                    </p>

                    <h3 class="fw-bold text-primary-rk mt-4 mb-3" style="font-size: 24px;">Investasi Kesehatan vs Finansial</h3>
                    <p>Investasi biasanya identik dengan saham, properti, atau deposito. Namun, investasi kesehatan memiliki return yang jauh lebih berharga - kehidupan yang berkualitas. Ketika Anda menjaga kesehatan sejak dini, Anda sebenarnya sedang:</p>

                    <div class="highlight-box">
                        <ul>
                            <li><i class="icofont-check-circled"></i> <span><strong>Mencegah biaya medis di masa depan</strong> - Pencegahan jauh lebih murah daripada pengobatan.</span></li>
                            <li><i class="icofont-check-circled"></i> <span><strong>Meningkatkan produktivitas</strong> - Tubuh sehat mendorong kinerja optimal dalam bekerja dan berkarya.</span></li>
                            <li><i class="icofont-check-circled"></i> <span><strong>Memperpanjang masa produktif</strong> - Anda dapat tetap aktif dan mandiri hingga usia lanjut.</span></li>
                            <li><i class="icofont-check-circled"></i> <span><strong>Meningkatkan kualitas hidup</strong> - Menikmati setiap momen berharga bersama keluarga tanpa hambatan fisik.</span></li>
                        </ul>
                    </div>

                    <h3 class="fw-bold text-primary-rk mt-4 mb-3" style="font-size: 24px;">Return on Investment (ROI) Kesehatan</h3>
                    <p>Studi menunjukkan bahwa setiap investasi pada kesehatan preventif dapat menghemat biaya perawatan medis berkali-kali lipat di masa depan.</p>

                    <div class="stats-grid">
                        <div class="stat-card">
                            <span class="number">3-6x</span>
                            <span class="label">Hemat Biaya</span>
                        </div>
                        <div class="stat-card">
                            <span class="number">30%</span>
                            <span class="label">Produktivitas</span>
                        </div>
                        <div class="stat-card">
                            <span class="number">+10th</span>
                            <span class="label">Harapan Hidup</span>
                        </div>
                    </div>

                    <h3 class="fw-bold text-primary-rk mt-5 mb-4" style="font-size: 24px;">5 Cara Mulai Investasi Kesehatan</h3>
                    
                    <div class="tip-item">
                        <div class="step" style="background: #e12454;">1</div>
                        <div>
                            <h5 class="fw-bold mb-1">Olahraga Teratur</h5>
                            <p class="mb-0">Minimal 30 menit per hari, 5x seminggu untuk menjaga kebugaran jantung dan otot.</p>
                        </div>
                    </div>

                    <div class="tip-item">
                        <div class="step" style="background: #2563eb;">2</div>
                        <div>
                            <h5 class="fw-bold mb-1">Nutrisi Seimbang</h5>
                            <p class="mb-0">Penuhi kebutuhan sayur, buah, dan protein. Kurangi gula dan makanan olahan berlebih.</p>
                        </div>
                    </div>

                    <div class="tip-item">
                        <div class="step" style="background: #059669;">3</div>
                        <div>
                            <h5 class="fw-bold mb-1">Tidur Berkualitas</h5>
                            <p class="mb-0">7-8 jam per malam sangat penting untuk regenerasi sel dan pemulihan energi.</p>
                        </div>
                    </div>

                    <div class="tip-item">
                        <div class="step" style="background: #d97706;">4</div>
                        <div>
                            <h5 class="fw-bold mb-1">Kelola Stres</h5>
                            <p class="mb-0">Luangkan waktu untuk hobi atau meditasi guna menjaga keseimbangan kesehatan mental.</p>
                        </div>
                    </div>

                    <div class="tip-item">
                        <div class="step" style="background: #7c3aed;">5</div>
                        <div>
                            <h5 class="fw-bold mb-1">Check-up Rutin</h5>
                            <p class="mb-0">Lakukan pemeriksaan berkala untuk mendeteksi dini risiko masalah kesehatan sejak awal.</p>
                        </div>
                    </div>

                    <blockquote class="rk-quote">
                        "Jangan tunggu sampai sakit untuk mulai peduli kesehatan. Investasi kesehatan hari ini adalah hadiah terbaik untuk diri Anda di masa depan."
                    </blockquote>

                    <h3 class="fw-bold text-primary-rk mt-5 mb-3" style="font-size: 24px;">Kesimpulan</h3>
                    <p>Kesehatan adalah investasi jangka panjang yang memberikan return berlipat ganda. Tidak ada yang lebih berharga daripada memiliki tubuh yang sehat dan bugar untuk menjalani hidup dengan penuh semangat. Mulai investasi kesehatan Anda hari ini!</p>

                    <div class="cta-box-rk">
                        <h4>Mulai Konsultasi Sekarang</h4>
                        <p>Tim dokter profesional kami siap membantu Anda memulai investasi kesehatan yang tepat untuk masa depan.</p>
                        <a href="/appointment" class="btn-white-rk">Buat Janji Konsultasi <i class="icofont-long-arrow-right ms-2"></i></a>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-5 pt-3" style="border-top:1px solid rgba(0,0,0,0.06);">
                        <div class="d-flex gap-2">
                             <a href="#" style="background:rgba(225,36,84,0.08);color:#e12454;padding:6px 14px;border-radius:50px;font-size:12px;font-weight:600;text-decoration:none;">Investasi</a>
                             <a href="#" style="background:rgba(37,99,235,0.08);color:#2563eb;padding:6px 14px;border-radius:50px;font-size:12px;font-weight:600;text-decoration:none;">Preventif</a>
                        </div>
                        <div class="d-flex gap-3 align-items-center">
                            <span style="font-size:13px;color:#6b7c93;font-weight:600;">Share:</span>
                            <a href="#" style="color:#6b7c93;font-size:16px;"><i class="icofont-facebook"></i></a>
                            <a href="#" style="color:#6b7c93;font-size:16px;"><i class="icofont-twitter"></i></a>
                            <a href="#" style="color:#6b7c93;font-size:16px;"><i class="icofont-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="rk-sidebar-card rk-reveal rk-right" style="--s:0;">
                        <h5>Pencarian</h5>
                        <form action="#" class="search-form" style="position:relative;">
                            <input type="text" placeholder="Cari artikel..." style="border-radius:12px;padding:14px 16px;border:1px solid #e1e9f1;width:100%;font-size:14px;">
                        </form>
                    </div>

                    <div class="rk-sidebar-card rk-reveal rk-right" style="--s:1;">
                        <h5>Artikel Terkait</h5>
                        <div class="post-item">
                            <span>09 Maret 2018</span>
                            <h6><a href="{{ route('artikel.ksditanganmu') }}">Kesehatan Ditanganmu: Kendali Hidup</a></h6>
                        </div>
                        <div class="post-item">
                            <span>03 Maret 2018</span>
                            <h6><a href="{{ route('artikel.tubuhsehat') }}">Tubuh Sehat, Hidup Bahagia</a></h6>
                        </div>
                        <div class="post-item">
                            <span>28 Januari 2019</span>
                            <h6><a href="{{ route('home') }}">Menjaga Mental di Era Digital</a></h6>
                        </div>
                    </div>

                    <div class="rk-sidebar-card rk-reveal rk-right" style="--s:2;">
                         <div style="padding:24px;border-radius:16px;background:linear-gradient(135deg,rgba(225,36,84,0.06),rgba(225,36,84,0.02));text-align:center;">
                            <i class="icofont-ambulance-cross fs-1 text-pink mb-3"></i>
                            <p style="font-size:14px;color:#6b7c93;margin-bottom:8px;">Butuh Bantuan Segera?</p>
                            <h4 style="font-size:20px;font-weight:800;color:#e12454;margin:0;">+62-856-4305-0274</h4>
                            <a href="/appointment" class="btn btn-main-rk px-4 py-2 mt-3 fs-13">Kontak Kami</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection