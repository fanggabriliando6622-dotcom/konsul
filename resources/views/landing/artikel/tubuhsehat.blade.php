@extends('layouts.app')

@section('title', 'Tubuh Sehat Hidup Bahagia | RuangKonsul')

@section('meta_description', 'Tubuh Sehat, Hidup Bahagia: Kunci menjalani kehidupan yang bermakna. Pelajari hubungan antara kesehatan fisik dan mental.')

@push('styles')
<style>
.blog-article { font-family: 'Inter', sans-serif; }
.blog-article img.featured { width:100%; height:360px; object-fit:cover; border-radius:16px; }
.blog-article .meta { display:flex; gap:20px; flex-wrap:wrap; margin-bottom:20px; }
.blog-article .meta span { display:flex; align-items:center; gap:6px; font-size:13px; font-weight:600; }
.blog-article .meta .text-pink { color:#e12454; }
.blog-article .meta .text-muted { color:#6b7c93; }

/* Hormon Section */
.hormon-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin: 30px 0; }
.hormon-card { background: #fff; padding: 24px; border-radius: 16px; border: 1px solid rgba(0,0,0,0.04); text-align: center; transition:all 0.3s; }
.hormon-card:hover { box-shadow: 0 8px 24px rgba(0,42,106,0.06); transform: translateY(-4px); }
.hormon-card .emoji { font-size: 32px; margin-bottom: 8px; display: block; }
.hormon-card h5 { font-size: 16px; font-weight: 700; margin-bottom: 4px; color: #1a2d4d; }
.hormon-card p { font-size: 12px !important; color: #6b7c93 !important; line-height: 1.4 !important; margin: 0 !important; }

/* Finding Cards */
.finding-item { background: rgba(34,58,102,0.03); border-left: 4px solid var(--rk-primary); padding: 20px; border-radius: 0 12px 12px 0; margin-bottom: 16px; display: flex; gap: 16px; align-items: center; }
.finding-item .percent { font-size: 24px; font-weight: 800; color: var(--rk-primary); flex-shrink: 0; }

/* Timeline Habits */
.habit-list { list-style: none; padding: 0; margin: 30px 0; }
.habit-item { position: relative; padding-left: 40px; margin-bottom: 24px; }
.habit-item::before { content: ''; position: absolute; left: 0; top: 0; bottom: -24px; width: 2px; background: rgba(34,58,102,0.1); }
.habit-item:last-child::before { display: none; }
.habit-item .dot { position: absolute; left: -6px; top: 4px; width: 14px; height: 14px; border-radius: 50%; background: #e12454; border: 3px solid #fff; box-shadow: 0 0 0 2px #e12454; }
.habit-item h5 { font-size: 17px; font-weight: 700; color: #1a2d4d; margin-bottom: 4px; }

/* Formula Box */
.formula-box { background: linear-gradient(135deg, #059669 0%, #10b981 100%); padding: 32px; border-radius: 16px; color: #fff; text-align: center; margin: 40px 0; }
.formula-box .formula { font-size: 22px; font-weight: 800; letter-spacing: 1px; display: block; margin-bottom: 8px; }

.blog-article p { font-size: 16px; color: #4a5568; line-height: 1.85; }
.rk-sidebar-card { background: #fff; border-radius: 16px; padding: 28px; border: 1px solid rgba(0,0,0,0.04); box-shadow: 0 4px 16px rgba(0,42,106,0.05); margin-bottom: 24px; }
.rk-sidebar-card h5 { font-size: 16px; font-weight: 700; color: #1a2d4d; margin-bottom: 16px; }

.cta-box-rk { background: linear-gradient(135deg, #059669 0%, #10b981 100%); padding: 32px; border-radius: 16px; text-align: center; color: #fff; margin-top: 40px; }
.btn-white-rk { background: #fff; color: #059669; padding: 12px 28px; border-radius: 50px; font-weight: 700; text-decoration: none; display: inline-block; transition: all 0.3s; }
.btn-white-rk:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); color: #059669; }

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
                <i class="icofont-smile"></i> Happiness & Wellness
            </div>
            <h1>Tubuh Sehat <span>Hidup Bahagia</span></h1>
            <div class="d-flex justify-content-center gap-4 mt-2 text-white-50 small fw-medium">
                <span><i class="icofont-calendar"></i> 03 Maret 2018</span>
                <span><i class="icofont-user"></i> Dr. Budi Hartono</span>
                <span><i class="icofont-clock-time"></i> 9 Menit Baca</span>
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
                    <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=1200&h=600&fit=crop" alt="Tubuh Sehat Hidup Bahagia" class="featured mb-5">
                    
                    <p class="lead" style="font-size: 20px; font-weight: 600; color: #059669; line-height: 1.6; margin-bottom: 30px;">
                        Kebahagiaan sejati bukan hanya tentang pencapaian materi, tetapi fondasi utamanya adalah kesehatan tubuh dan pikiran yang prima.
                    </p>

                    <h3 class="fw-bold text-primary-rk mt-4 mb-3" style="font-size: 24px;">Hormon Kebahagiaan Alami</h3>
                    <p>Ketika tubuh sehat dan aktif, otak memproduksi neurotransmiter yang meningkatkan suasana hati secara alami. Kenali "obat bahagia" internal Anda:</p>

                    <div class="hormon-grid">
                        <div class="hormon-card">
                            <span class="emoji">😊</span>
                            <h5>Serotonin</h5>
                            <p>Mood stabilizer alami yang menjaga ketenangan.</p>
                        </div>
                        <div class="hormon-card">
                            <span class="emoji">⚡</span>
                            <h5>Dopamin</h5>
                            <p>Hormon motivasi dan sistem penghargaan otak.</p>
                        </div>
                        <div class="hormon-card">
                            <span class="emoji">🎉</span>
                            <h5>Endorfin</h5>
                            <p>Penghilang rasa sakit dan pemberi rasa euforia.</p>
                        </div>
                        <div class="hormon-card">
                            <span class="emoji">🤗</span>
                            <h5>Oksitosin</h5>
                            <p>Hormon kasih sayang dan penguat ikatan sosial.</p>
                        </div>
                    </div>

                    <h3 class="fw-bold text-primary-rk mt-5 mb-3" style="font-size: 24px;">Penelitian: Koreksi Kesehatan & Bahagia</h3>
                    
                    <div class="finding-item">
                        <span class="percent">85%</span>
                        <p class="mb-0">Orang yang rutin aktif fisik melaporkan tingkat kebahagiaan 85% lebih tinggi dibanding yang pasif.</p>
                    </div>

                    <div class="finding-item" style="border-left-color: #2563eb;">
                        <span class="percent" style="color:#2563eb;">2x</span>
                        <p class="mb-0">Tidur berkualitas 7-9 jam meningkatkan mood positif hingga dua kali lipat di hari berikutnya.</p>
                    </div>

                    <div class="finding-item" style="border-left-color: #d97706;">
                        <span class="percent" style="color:#d97706;">40%</span>
                        <p class="mb-0">Nutrisi yang seimbang terbukti secara klinis mengurangi risiko gangguan depresi hingga 40%.</p>
                    </div>

                    <h3 class="fw-bold text-primary-rk mt-5 mb-3" style="font-size: 24px;">8 Kebiasaan Untuk Hidup Bahagia</h3>
                    
                    <ul class="habit-list">
                        <li class="habit-item">
                            <div class="dot"></div>
                            <h5>Sinar Matahari Pagi</h5>
                            <p class="text-muted small">Meningkatkan vitamin D dan mengatur jam biologis tubuh.</p>
                        </li>
                        <li class="habit-item">
                            <div class="dot"></div>
                            <h5>Gerak Aktif 30 Menit</h5>
                            <p class="text-muted small">Membangkitkan endorfin untuk kebahagiaan instan.</p>
                        </li>
                        <li class="habit-item">
                            <div class="dot"></div>
                            <h5>Nutrisi Pelangi</h5>
                            <p class="text-muted small">Penuhi variasi sayur dan buah untuk perlindungan otak.</p>
                        </li>
                        <li class="habit-item">
                            <div class="dot"></div>
                            <h5>Hidrasi Cukup</h5>
                            <p class="text-muted small">Cegah penurunan kognitif dengan asupan air yang stabil.</p>
                        </li>
                        <li class="habit-item">
                            <div class="dot"></div>
                            <h5>Tidur Menengah</h5>
                            <p class="text-muted small">Optimalkan restorasi sel saraf selama istirahat malam.</p>
                        </li>
                        <li class="habit-item">
                            <div class="dot"></div>
                            <h5>Mindfulness</h5>
                            <p class="text-muted small">Latih kehadiran penuh untuk menurunkan stres kronis.</p>
                        </li>
                        <li class="habit-item">
                            <div class="dot"></div>
                            <h5>Ikatan Sosial</h5>
                            <p class="text-muted small">Habiskan waktu berkualitas bersama orang-orang terkasih.</p>
                        </li>
                        <li class="habit-item">
                            <div class="dot"></div>
                            <h5>Tujuan Hidup</h5>
                            <p class="text-muted small">Kembangkan passion dan hobi yang memberikan kepuasan jiwa.</p>
                        </li>
                    </ul>

                    <div class="formula-box">
                        <span class="formula">KESEHATAN + HUBUNGAN + PURPOSE</span>
                        <p class="mb-0 fw-bold fs-5">= KEBAHAGIAAN SEJATI</p>
                    </div>

                    <h3 class="fw-bold text-primary-rk mt-5 mb-3" style="font-size: 24px;">Kesimpulan</h3>
                    <p>Tubuh yang sehat bukan sekadar bebas dari penyakit, melainkan alat yang memungkinkan Anda menjalani hidup yang penuh makna. Mulailah perubahan kecil hari ini demi masa depan yang lebih bahagia.</p>

                    <div class="cta-box-rk">
                        <h4>Mulai Perjalanan Kebahagiaan</h4>
                        <p>Jadwalkan konsultasi kesehatan holistik Anda dengan tim berpengalaman kami sekarang juga.</p>
                        <a href="/appointment" class="btn-white-rk">Jadwalkan Sekarang <i class="icofont-long-arrow-right ms-2"></i></a>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-5 pt-3" style="border-top:1px solid rgba(0,0,0,0.06);">
                        <div class="d-flex gap-2">
                             <a href="#" style="background:rgba(5,150,105,0.08);color:#059669;padding:6px 14px;border-radius:50px;font-size:12px;font-weight:600;text-decoration:none;">Happiness</a>
                             <a href="#" style="background:rgba(37,99,235,0.08);color:#2563eb;padding:6px 14px;border-radius:50px;font-size:12px;font-weight:600;text-decoration:none;">Mindfulness</a>
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
                        <form action="#" class="search-form">
                            <input type="text" placeholder="Cari artikel..." style="border-radius:12px;padding:14px 16px;border:1px solid #e1e9f1;width:100%;font-size:14px;">
                        </form>
                    </div>

                    <div class="rk-sidebar-card rk-reveal rk-right" style="--s:1;">
                        <h5>Artikel Terkait</h5>
                        <div class="post-item">
                            <span>05 Maret 2018</span>
                            <h6><a href="{{ route('artikel.ksinvestasi') }}">Kesehatan Adalah Investasi Utama</a></h6>
                        </div>
                        <div class="post-item">
                            <span>09 Maret 2018</span>
                            <h6><a href="{{ route('artikel.ksditanganmu') }}">Kesehatan Ditanganmu Sendiri</a></h6>
                        </div>
                        <div class="post-item">
                            <span>28 Januari 2019</span>
                            <h6><a href="{{ route('home') }}">Rahasia Mental Yang Kuat</a></h6>
                        </div>
                    </div>

                    <div class="rk-sidebar-card rk-reveal rk-right" style="--s:2;">
                         <div style="padding:24px;border-radius:16px;background:linear-gradient(135deg,rgba(5,150,105,0.06),rgba(5,150,105,0.02));text-align:center;">
                            <i class="icofont-medical-sign-alt fs-1 text-success mb-3"></i>
                            <p style="font-size:14px;color:#6b7c93;margin-bottom:8px;">Butuh Konsultasi Mendalam?</p>
                            <h4 style="font-size:20px;font-weight:800;color:#059669;margin:0;">Layanan Bantuan</h4>
                            <a href="/appointment" class="btn btn-main-rk px-4 py-2 mt-3 fs-13" style="background:linear-gradient(135deg, #059669, #10b981);">Buat Janji</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection