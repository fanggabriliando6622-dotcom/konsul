@extends('layouts.app')

@section('title', 'Kesehatan Mental | RuangKonsul')

@section('meta_description', 'Panduan lengkap menjaga kesehatan mental dan kesejahteraan psikologis untuk hidup lebih bahagia.')

@push('styles')
<style>
    /* HERO WARNA BARU */
.rk-hero {
    background: linear-gradient(
        135deg,
        #1f3358 0%,
        #2c4572 50%,
        #324f80 100%
    );
    padding: 120px 0 140px;
    position: relative;
    overflow: hidden;
    color: #fff;
}
.blog-article { font-family: 'Inter', sans-serif; }
.blog-article img.featured { width:100%; height:360px; object-fit:cover; border-radius:16px; }
.blog-article .meta { display:flex; gap:20px; flex-wrap:wrap; margin-bottom:20px; }
.blog-article .meta span { display:flex; align-items:center; gap:6px; font-size:13px; font-weight:600; }
.blog-article .meta .text-pink { color:#e12454; }
.blog-article .meta .text-muted { color:#6b7c93; }

/* Mental Health Cards Grid */
.mental-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px; margin: 30px 0; }
.mental-card { background: #fff; padding: 28px; border-radius: 16px; border: 1px solid rgba(0,0,0,0.04); box-shadow: 0 4px 12px rgba(0,42,106,0.04); transition: all 0.3s; position: relative; overflow: hidden; }
.mental-card::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 4px; background: linear-gradient(90deg, #7c3aed, #6d28d9); }
.mental-card:hover { transform: translateY(-5px); box-shadow: 0 8px 24px rgba(0,42,106,0.08); }
.mental-card .icon { font-size: 40px; margin-bottom: 16px; display: block; }
.mental-card h4 { font-size: 18px; font-weight: 700; color: #1a2d4d; margin-bottom: 12px; }
.mental-card p { font-size: 14px !important; color: #6b7c93 !important; line-height: 1.6 !important; margin: 0 !important; }

/* Signs Box */
.signs-box { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin: 30px 0; }
.sign-item { background: #fff; padding: 20px; border-radius: 12px; border-left: 4px solid #ef4444; box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
.sign-item h6 { font-size: 14px; font-weight: 700; color: #ef4444; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
.sign-item p { margin: 0; color: #6b7c93; font-size: 13px; line-height: 1.5; }

/* Technique Cards */
.technique-item { background: #fff; border-radius: 16px; padding: 24px; margin-bottom: 20px; border: 1px solid rgba(0,0,0,0.04); position: relative; overflow: hidden; display: flex; gap: 20px; }
.technique-item .t-accent { position: absolute; top: 0; left: 0; width: 4px; height: 100%; }
.technique-item .icon-box { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 20px; }

/* Mindfulness Practice */
.practice-box { background: linear-gradient(135deg, #ede9fe 0%, #f3f0ff 100%); padding: 32px; border-radius: 16px; margin: 30px 0; border: 2px solid #ddd6fe; }
.practice-box h4 { font-size: 20px; font-weight: 700; color: #6d28d9; margin-bottom: 20px; text-align: center; }
.practice-step { background: #fff; padding: 20px; border-radius: 12px; margin-bottom: 16px; border-left: 4px solid #7c3aed; }
.practice-step .step-num { display: inline-block; background: #7c3aed; color: #fff; width: 28px; height: 28px; border-radius: 50%; text-align: center; line-height: 28px; font-weight: 700; font-size: 14px; margin-right: 12px; }
.practice-step p { margin: 0; color: #4a5568; font-size: 14px; display: inline; }

/* Warning Box */
.warning-box { background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%); padding: 28px; border-radius: 16px; margin: 30px 0; border: 2px solid #fecaca; }
.warning-box h4 { font-size: 18px; font-weight: 700; color: #dc2626; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
.warning-box p { color: #991b1b; font-size: 14px; line-height: 1.6; margin-bottom: 12px; }
.warning-box .help-line { background: #fff; padding: 16px; border-radius: 8px; margin-top: 16px; text-align: center; }
.warning-box .help-line strong { color: #dc2626; font-size: 16px; }

.blog-article p { font-size: 16px; color: #4a5568; line-height: 1.85; }
.rk-sidebar-card { background: #fff; border-radius: 16px; padding: 28px; border: 1px solid rgba(0,0,0,0.04); box-shadow: 0 4px 16px rgba(0,42,106,0.05); margin-bottom: 24px; }
.rk-sidebar-card h5 { font-size: 16px; font-weight: 700; color: #1a2d4d; margin-bottom: 16px; }
.rk-sidebar-card .post-item { padding: 12px 0; border-bottom: 1px solid rgba(0,0,0,0.04); }
.rk-sidebar-card .post-item:last-child { border-bottom:none; }
.rk-sidebar-card .post-item h6 a { color:#1a2d4d; text-decoration:none; transition:color 0.3s; }
.rk-sidebar-card .post-item h6 a:hover { color:#e12454; }

.cta-box-rk { background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%); padding: 32px; border-radius: 16px; text-align: center; color: #fff; margin-top: 40px; }
.btn-white-rk { background: #fff; color: #7c3aed; padding: 12px 28px; border-radius: 50px; font-weight: 700; text-decoration: none; display: inline-block; transition: all 0.3s; }

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
                <i class="icofont-brainstorming"></i> Kesehatan Mental
            </div>
            <h1>Jaga <span>Kesehatan Mental</span> Anda</h1>
            <div class="d-flex justify-content-center gap-4 mt-2 text-white-50 small fw-medium">
                <span><i class="icofont-calendar"></i> 15 Feb 2026</span>
                <span><i class="icofont-user"></i> Psikolog Klinis</span>
                <span><i class="icofont-clock-time"></i> 10 Menit Baca</span>
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
                    <img src="https://images.unsplash.com/photo-1499209974431-9dddcece7f88?w=1200&h=600&fit=crop" alt="Kesehatan Mental" class="featured mb-5">
                    
                    <p class="lead" style="font-size: 20px; font-weight: 600; color: #7c3aed; line-height: 1.6; margin-bottom: 30px;">
                        Kesehatan mental sama pentingnya dengan kesehatan fisik. Pikiran yang sehat adalah kunci untuk hidup yang bahagia dan bermakna!
                    </p>

                    <h3 class="fw-bold text-primary-rk mt-4 mb-3" style="font-size: 24px;">Apa Itu Kesehatan Mental?</h3>
                    <p>Kesehatan mental mencakup kesejahteraan emosional, psikologis, dan sosial kita. Ini memengaruhi cara kita berpikir, merasakan, dan bertindak. Kesehatan mental juga menentukan bagaimana kita menangani stres, berhubungan dengan orang lain, dan membuat pilihan dalam hidup.</p>

                    <div class="mental-grid">
                        <div class="mental-card">
                            <span class="icon">😊</span>
                            <h4>Kesejahteraan Emosional</h4>
                            <p>Kemampuan mengenali, mengekspresikan, dan mengelola emosi dengan sehat.</p>
                        </div>
                        <div class="mental-card">
                            <span class="icon">🧠</span>
                            <h4>Fungsi Kognitif</h4>
                            <p>Pikiran yang jernih, fokus, dan kemampuan membuat keputusan yang baik.</p>
                        </div>
                        <div class="mental-card">
                            <span class="icon">🤝</span>
                            <h4>Hubungan Sosial</h4>
                            <p>Membangun dan memelihara hubungan yang bermakna dengan orang lain.</p>
                        </div>
                        <div class="mental-card">
                            <span class="icon">⚖️</span>
                            <h4>Keseimbangan Hidup</h4>
                            <p>Kemampuan menyeimbangkan berbagai aspek kehidupan dengan harmonis.</p>
                        </div>
                    </div>

                    <h3 class="fw-bold text-primary-rk mt-5 mb-4" style="font-size: 24px;">Tanda-Tanda Masalah Kesehatan Mental</h3>
                    <p>Penting untuk mengenali tanda-tanda awal masalah kesehatan mental agar dapat segera mendapatkan bantuan.</p>

                    <div class="signs-box">
                        <div class="sign-item">
                            <h6>😔 Perubahan Mood</h6>
                            <p>Perubahan drastis dalam perasaan atau suasana hati yang berlangsung lama.</p>
                        </div>
                        <div class="sign-item">
                            <h6>😴 Gangguan Tidur</h6>
                            <p>Insomnia atau tidur berlebihan yang tidak biasa bagi Anda.</p>
                        </div>
                        <div class="sign-item">
                            <h6>🚫 Menarik Diri</h6>
                            <p>Menghindari aktivitas sosial atau hobi yang biasanya disukai.</p>
                        </div>
                        <div class="sign-item">
                            <h6>⚡ Energi Rendah</h6>
                            <p>Kelelahan kronis dan kurangnya motivasi untuk melakukan apapun.</p>
                        </div>
                        <div class="sign-item">
                            <h6>🍽️ Perubahan Nafsu Makan</h6>
                            <p>Makan terlalu banyak atau kehilangan nafsu makan secara signifikan.</p>
                        </div>
                        <div class="sign-item">
                            <h6>💭 Pikiran Negatif</h6>
                            <p>Pikiran pesimis berlebihan atau merasa tidak berharga.</p>
                        </div>
                    </div>

                    <h3 class="fw-bold text-primary-rk mt-5 mb-4" style="font-size: 24px;">6 Teknik Menjaga Kesehatan Mental</h3>

                    <div class="technique-item">
                        <div class="t-accent" style="background:#7c3aed;"></div>
                        <div class="icon-box" style="background:rgba(124,58,237,0.1);color:#7c3aed;"><i class="icofont-わけ-meditation"></i></div>
                        <div>
                            <h5 class="fw-bold mb-1">1. Praktik Mindfulness</h5>
                            <p class="mb-0">Meditasi dan mindfulness membantu Anda tetap hadir di momen ini, mengurangi kecemasan tentang masa depan atau penyesalan tentang masa lalu.</p>
                        </div>
                    </div>

                    <div class="technique-item">
                        <div class="t-accent" style="background:#2563eb;"></div>
                        <div class="icon-box" style="background:rgba(37,99,235,0.1);color:#2563eb;"><i class="icofont-pencil-alt-2"></i></div>
                        <div>
                            <h5 class="fw-bold mb-1">2. Journaling</h5>
                            <p class="mb-0">Menulis jurnal membantu mengekspresikan perasaan, memproses emosi, dan mendapatkan perspektif baru terhadap masalah.</p>
                        </div>
                    </div>

                    <div class="technique-item">
                        <div class="t-accent" style="background:#059669;"></div>
                        <div class="icon-box" style="background:rgba(5,150,105,0.1);color:#059669;"><i class="icofont-runner-alt-1"></i></div>
                        <div>
                            <h5 class="fw-bold mb-1">3. Olahraga Teratur</h5>
                            <p class="mb-0">Aktivitas fisik melepaskan endorfin yang meningkatkan mood dan mengurangi gejala depresi dan kecemasan.</p>
                        </div>
                    </div>

                    <div class="technique-item">
                        <div class="t-accent" style="background:#d97706;"></div>
                        <div class="icon-box" style="background:rgba(217,119,6,0.1);color:#d97706;"><i class="icofont-わけ-users"></i></div>
                        <div>
                            <h5 class="fw-bold mb-1">4. Koneksi Sosial</h5>
                            <p class="mb-0">Membangun hubungan yang mendukung dan berbicara dengan orang-orang terpercaya tentang perasaan Anda.</p>
                        </div>
                    </div>

                    <div class="technique-item">
                        <div class="t-accent" style="background:#10b981;"></div>
                        <div class="icon-box" style="background:rgba(16,185,129,0.1);color:#10b981;"><i class="icofont-わけ-clock-time"></i></div>
                        <div>
                            <h5 class="fw-bold mb-1">5. Manajemen Waktu</h5>
                            <p class="mb-0">Prioritaskan tugas, tetapkan batasan yang sehat, dan pastikan waktu untuk istirahat dan aktivitas yang menyenangkan.</p>
                        </div>
                    </div>

                    <div class="technique-item">
                        <div class="t-accent" style="background:#e12454;"></div>
                        <div class="icon-box" style="background:rgba(225,36,84,0.1);color:#e12454;"><i class="icofont-わけ-ban"></i></div>
                        <div>
                            <h5 class="fw-bold mb-1">6. Batasi Media Sosial</h5>
                            <p class="mb-0">Kurangi waktu di media sosial yang dapat memicu perbandingan sosial dan kecemasan. Fokuslah pada kehidupan nyata.</p>
                        </div>
                    </div>

                    <div class="practice-box">
                        <h4><i class="icofont-わけ-meditation-alt me-2"></i>Latihan Pernapasan 5 Menit</h4>
                        
                        <div class="practice-step">
                            <span class="step-num">1</span>
                            <p>Duduk nyaman dengan punggung tegak. Tutup mata Anda.</p>
                        </div>

                        <div class="practice-step">
                            <span class="step-num">2</span>
                            <p>Tarik napas dalam melalui hidung selama 4 hitungan.</p>
                        </div>

                        <div class="practice-step">
                            <span class="step-num">3</span>
                            <p>Tahan napas selama 4 hitungan.</p>
                        </div>

                        <div class="practice-step">
                            <span class="step-num">4</span>
                            <p>Hembuskan napas perlahan melalui mulut selama 6 hitungan.</p>
                        </div>

                        <div class="practice-step">
                            <span class="step-num">5</span>
                            <p>Ulangi siklus ini selama 5 menit. Fokus pada pernapasan Anda.</p>
                        </div>
                    </div>

                    <div class="warning-box">
                        <h4><i class="icofont-わけ-warning"></i> Kapan Harus Mencari Bantuan Profesional?</h4>
                        <p>Jangan ragu untuk mencari bantuan profesional jika:</p>
                        <ul style="margin-left:20px;color:#991b1b;font-size:14px;">
                            <li>Gejala berlangsung lebih dari 2 minggu dan mengganggu aktivitas harian</li>
                            <li>Anda memiliki pikiran untuk menyakiti diri sendiri atau orang lain</li>
                            <li>Merasa tidak berdaya atau putus asa secara terus-menerus</li>
                            <li>Mengalami perubahan drastis dalam perilaku atau kepribadian</li>
                            <li>Kesulitan menjalankan tanggung jawab sehari-hari</li>
                        </ul>
                        <div class="help-line">
                            <p style="margin:0;color:#991b1b;font-size:13px;">Hotline Kesehatan Mental 24/7</p>
                            <strong>119 ext. 8</strong>
                        </div>
                    </div>

                    <h3 class="fw-bold text-primary-rk mt-5 mb-3" style="font-size: 24px;">Kesehatan Mental Adalah Prioritas</h3>
                    <p>Ingatlah bahwa mencari bantuan adalah tanda kekuatan, bukan kelemahan. Kesehatan mental Anda layak mendapatkan perhatian dan perawatan yang sama dengan kesehatan fisik. Mulailah dengan langkah kecil hari ini untuk kesejahteraan mental yang lebih baik.</p>

                    <div class="cta-box-rk">
                        <h4>Konsultasi dengan Psikolog</h4>
                        <p>Bicarakan kesehatan mental Anda dengan psikolog profesional RuangKonsul dalam sesi yang aman dan rahasia.</p>
                        <a href="/appointment" class="btn-white-rk">Buat Janji Konsultasi <i class="icofont-long-arrow-right ms-2"></i></a>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-5 pt-3" style="border-top:1px solid rgba(0,0,0,0.06);">
                        <div class="d-flex gap-2">
                             <a href="#" style="background:rgba(124,58,237,0.08);color:#7c3aed;padding:6px 14px;border-radius:50px;font-size:12px;font-weight:600;text-decoration:none;">Mental Health</a>
                             <a href="#" style="background:rgba(37,99,235,0.08);color:#2563eb;padding:6px 14px;border-radius:50px;font-size:12px;font-weight:600;text-decoration:none;">Wellness</a>
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
                            <span>09 Maret 2018</span>
                            <h6><a href="#">Kesehatan Ditanganmu</a></h6>
                        </div>
                        <div class="post-item">
                            <span>20 Feb 2026</span>
                            <h6><a href="#">Panduan Nutrisi Harian</a></h6>
                        </div>
                        <div class="post-item">
                            <span>03 Maret 2018</span>
                            <h6><a href="#">Tubuh Sehat, Hidup Bahagia</a></h6>
                        </div>
                    </div>

                    <div class="rk-sidebar-card rk-reveal rk-right" style="--s:2;">
                         <div style="padding:24px;border-radius:16px;background:linear-gradient(135deg,rgba(124,58,237,0.1),rgba(124,58,237,0.02));text-align:center;">
                            <i class="icofont-わけ-heart-alt fs-1 mb-3" style="color:#7c3aed;"></i>
                            <p style="font-size:14px;color:#6b7c93;margin-bottom:8px;">Butuh Dukungan Mental?</p>
                            <h4 style="font-size:20px;font-weight:800;color:#7c3aed;margin:0;">Psikolog Siap Membantu</h4>
                            <a href="/appointment" class="btn px-4 py-2 mt-3 fs-13" style="background:#7c3aed;color:#fff;border-radius:50px;text-decoration:none;display:inline-block;">Konsultasi Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection