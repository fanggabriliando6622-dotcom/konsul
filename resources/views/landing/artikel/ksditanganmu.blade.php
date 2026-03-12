@extends('layouts.app')

@section('title', 'Kesehatan Ditanganmu | RuangKonsul')

@section('meta_description', 'Kesehatan Ditanganmu: Kendali Penuh untuk Hidup Lebih Baik. Pelajari 7 pilar kesehatan yang bisa Anda kendalikan.')

@push('styles')
<style>
.blog-article { font-family: 'Inter', sans-serif; }
.blog-article img.featured { width:100%; height:360px; object-fit:cover; border-radius:16px; }
.blog-article .meta { display:flex; gap:20px; flex-wrap:wrap; margin-bottom:20px; }
.blog-article .meta span { display:flex; align-items:center; gap:6px; font-size:13px; font-weight:600; }
.blog-article .meta .text-pink { color:#e12454; }
.blog-article .meta .text-muted { color:#6b7c93; }

/* Grid Styles for Power Cards */
.power-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin: 30px 0; }
.power-card { background: #fff; padding: 24px; border-radius: 16px; border: 1px solid rgba(0,0,0,0.04); box-shadow: 0 4px 12px rgba(0,42,106,0.04); transition: all 0.3s; }
.power-card:hover { transform: translateY(-5px); box-shadow: 0 8px 24px rgba(0,42,106,0.08); }
.power-card .icon { font-size: 32px; margin-bottom: 12px; display: block; }
.power-card h4 { font-size: 16px; font-weight: 700; color: #1a2d4d; margin-bottom: 8px; }
.power-card p { font-size: 14px !important; color: #6b7c93 !important; line-height: 1.5 !important; margin: 0 !important; }

/* Pillars Styles */
.pillar-item { background: #fff; border-radius: 16px; padding: 24px; margin-bottom: 20px; border: 1px solid rgba(0,0,0,0.04); position: relative; overflow: hidden; display: flex; gap: 20px; }
.pillar-item .p-accent { position: absolute; top: 0; left: 0; width: 4px; height: 100%; background: #e12454; }
.pillar-item .icon-box { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: rgba(34,58,102,0.06); color: var(--rk-primary); font-size: 20px; }

/* Challenge Section */
.challenge-rk { background: linear-gradient(135deg, #223a66 0%, #2b4c7e 100%); padding: 32px; border-radius: 16px; color: #fff; margin: 40px 0; text-align: center; }
.challenge-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 12px; margin-top: 24px; }
.challenge-item { background: rgba(255,255,255,0.1); padding: 16px; border-radius: 12px; backdrop-filter: blur(8px); }
.challenge-item .week { font-size: 18px; font-weight: 800; display: block; margin-bottom: 4px; }
.challenge-item .desc { font-size: 11px; opacity: 0.8; }

.blog-article p { font-size: 16px; color: #4a5568; line-height: 1.85; }
.rk-sidebar-card { background: #fff; border-radius: 16px; padding: 28px; border: 1px solid rgba(0,0,0,0.04); box-shadow: 0 4px 16px rgba(0,42,106,0.05); margin-bottom: 24px; }
.rk-sidebar-card h5 { font-size: 16px; font-weight: 700; color: #1a2d4d; margin-bottom: 16px; }
.rk-sidebar-card .post-item { padding: 12px 0; border-bottom: 1px solid rgba(0,0,0,0.04); }
.rk-sidebar-card .post-item:last-child { border-bottom:none; }
.rk-sidebar-card .post-item h6 a { color:#1a2d4d; text-decoration:none; transition:color 0.3s; }
.rk-sidebar-card .post-item h6 a:hover { color:#e12454; }

.cta-box-rk { background: linear-gradient(135deg, #e12454 0%, #ff4d6d 100%); padding: 32px; border-radius: 16px; text-align: center; color: #fff; margin-top: 40px; }
.btn-white-rk { background: #fff; color: #e12454; padding: 12px 28px; border-radius: 50px; font-weight: 700; text-decoration: none; display: inline-block; transition: all 0.3s; }

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
                <i class="icofont-hands-holding"></i> Gaya Hidup Sehat
            </div>
            <h1>Kesehatan <span>Ditanganmu Sendiri</span></h1>
            <div class="d-flex justify-content-center gap-4 mt-2 text-white-50 small fw-medium">
                <span><i class="icofont-calendar"></i> 09 Maret 2018</span>
                <span><i class="icofont-user"></i> Dr. Siti Nurhaliza</span>
                <span><i class="icofont-clock-time"></i> 7 Menit Baca</span>
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
                    <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=1200&h=600&fit=crop" alt="Kesehatan Ditanganmu" class="featured mb-5">
                    
                    <p class="lead" style="font-size: 20px; font-weight: 600; color: #e12454; line-height: 1.6; margin-bottom: 30px;">
                        Tahukah Anda bahwa 80% kondisi kesehatan kita ditentukan oleh pilihan dan kebiasaan sehari-hari? Ya, kesehatan sejati berada di tangan Anda sendiri!
                    </p>

                    <h3 class="fw-bold text-primary-rk mt-4 mb-3" style="font-size: 24px;">Filosofi Kendali Diri</h3>
                    <p>Konsep "Kesehatan Ditanganmu" menempatkan Anda sebagai pengendali utama. Anda memiliki kekuatan untuk menentukan arah kualitas hidup Anda melalui keputusan-keputusan kecil setiap harinya.</p>

                    <div class="power-grid">
                        <div class="power-card">
                            <span class="icon">🎯</span>
                            <h4>Menentukan Pilihan</h4>
                            <p>Memilih gaya hidup yang mendukung kesehatan optimal.</p>
                        </div>
                        <div class="power-card">
                            <span class="icon">🛡️</span>
                            <h4>Mencegah Penyakit</h4>
                            <p>Tindakan preventif sebelum masalah kesehatan muncul.</p>
                        </div>
                        <div class="power-card">
                            <span class="icon">⚡</span>
                            <h4>Meningkatkan Vitalitas</h4>
                            <p>Energi terjaga untuk menjalani hari lebih produktif.</p>
                        </div>
                        <div class="power-card">
                            <span class="icon">🌟</span>
                            <h4>Mencapai Potensi</h4>
                            <p>Hidup dengan kualitas terbaik yang bisa Anda miliki.</p>
                        </div>
                    </div>

                    <h3 class="fw-bold text-primary-rk mt-5 mb-4" style="font-size: 24px;">7 Pilar Utama yang Bisa Anda Kendalikan</h3>

                    <div class="pillar-item">
                        <div class="p-accent" style="background:#2563eb;"></div>
                        <div class="icon-box"><i class="icofont-restaurant"></i></div>
                        <div>
                            <h5 class="fw-bold mb-1">1. Nutrisi Berkualitas</h5>
                            <p class="mb-0">Makanan adalah bahan bakar tubuh. Minimalkan olahan, perbanyak whole foods.</p>
                        </div>
                    </div>

                    <div class="pillar-item">
                        <div class="p-accent" style="background:#e12454;"></div>
                        <div class="icon-box"><i class="icofont-dumbbell"></i></div>
                        <div>
                            <h5 class="fw-bold mb-1">2. Aktivitas Fisik Rutin</h5>
                            <p class="mb-0">Tubuh dirancang untuk bergerak. 150 menit olahraga per minggu rutin dianjurkan.</p>
                        </div>
                    </div>

                    <div class="pillar-item">
                        <div class="p-accent" style="background:#059669;"></div>
                        <div class="icon-box"><i class="icofont-bed-patient"></i></div>
                        <div>
                            <h5 class="fw-bold mb-1">3. Tidur Restoratif</h5>
                            <p class="mb-0">7-9 jam tidur berkualitas sangat krusial untuk regenerasi otak dan tubuh.</p>
                        </div>
                    </div>

                    <div class="pillar-item">
                        <div class="p-accent" style="background:#d97706;"></div>
                        <div class="icon-box"><i class="icofont-brainstorming"></i></div>
                        <div>
                            <h5 class="fw-bold mb-1">4. Manajemen Stres</h5>
                            <p class="mb-0">Meditasi dan teknik deep breathing membantu menurunkan tingkat kortisol tubuh.</p>
                        </div>
                    </div>

                    <div class="pillar-item">
                        <div class="p-accent" style="background:#7c3aed;"></div>
                        <div class="icon-box"><i class="icofont-water-drop"></i></div>
                        <div>
                            <h5 class="fw-bold mb-1">5. Hidrasi Optimal</h5>
                            <p class="mb-0">Penuhi asupan 2 liter air mineral per hari untuk fungsi organ yang stabil.</p>
                        </div>
                    </div>

                    <div class="pillar-item">
                        <div class="p-accent" style="background:#0891b2;"></div>
                        <div class="icon-box"><i class="icofont-users-social"></i></div>
                        <div>
                            <h5 class="fw-bold mb-1">6. Koneksi Sosial</h5>
                            <p class="mb-0">Hubungan positif meningkatkan imunitas dan memperpanjang masa hidup.</p>
                        </div>
                    </div>

                    <div class="pillar-item">
                        <div class="p-accent" style="background:#10b981;"></div>
                        <div class="icon-box"><i class="icofont-stethoscope"></i></div>
                        <div>
                            <h5 class="fw-bold mb-1">7. Medical Check-up</h5>
                            <p class="mb-0">Deteksi dini rutin mencegah masalah kesehatan menjadi kondisi serius nantinya.</p>
                        </div>
                    </div>

                    <div class="challenge-rk">
                        <h4 class="fw-bold mb-3"><i class="icofont-light-bulb me-2"></i> Challenge 30 Hari</h4>
                        <p class="mb-0">Pilih 3 pilar di atas dan jalani secara konsisten selama sebulan penuh. Rasakan perubahannya!</p>
                        <div class="challenge-grid">
                            <div class="challenge-item"><span class="week">Week 1</span><span class="desc">Adaptasi Baru</span></div>
                            <div class="challenge-item"><span class="week">Week 2</span><span class="desc">Membangun Konsistensi</span></div>
                            <div class="challenge-item"><span class="week">Week 3</span><span class="desc">Perubahan Terasa</span></div>
                            <div class="challenge-item"><span class="week">Week 4</span><span class="desc">Menjadi Kebiasaan</span></div>
                        </div>
                    </div>

                    <h3 class="fw-bold text-primary-rk mt-5 mb-3" style="font-size: 24px;">Ambil Kendali Sekarang!</h3>
                    <p>Kesehatan memang ada di tangan Anda. Setiap keputusan kecil yang Anda buat hari ini akan membentuk kondisi Anda di masa depan. Jangan menunggu terlambat - mulai ambil tindakan hari ini untuk hidup yang lebih bermakna.</p>

                    <div class="cta-box-rk">
                        <h4>Mulai Perjalanan Anda</h4>
                        <p>Konsultasikan rencana kesehatan preventif Anda dengan tim ahli RuangKonsul secara aman dan nyaman.</p>
                        <a href="/appointment" class="btn-white-rk">Mulai Konsultasi <i class="icofont-long-arrow-right ms-2"></i></a>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-5 pt-3" style="border-top:1px solid rgba(0,0,0,0.06);">
                        <div class="d-flex gap-2">
                             <a href="#" style="background:rgba(225,36,84,0.08);color:#e12454;padding:6px 14px;border-radius:50px;font-size:12px;font-weight:600;text-decoration:none;">Self Care</a>
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
                            <span>05 Maret 2018</span>
                            <h6><a href="{{ route('artikel.ksinvestasi') }}">Kesehatan Adalah Investasi Terbaik</a></h6>
                        </div>
                        <div class="post-item">
                            <span>03 Maret 2018</span>
                            <h6><a href="{{ route('artikel.tubuhsehat') }}">Tubuh Sehat, Hidup Bahagia</a></h6>
                        </div>
                        <div class="post-item">
                            <span>28 Januari 2019</span>
                            <h6><a href="{{ route('home') }}">Panduan Nutrisi Harian</a></h6>
                        </div>
                    </div>

                    <div class="rk-sidebar-card rk-reveal rk-right" style="--s:2;">
                         <div style="padding:24px;border-radius:16px;background:linear-gradient(135deg,rgba(34,58,102,0.06),rgba(34,58,102,0.02));text-align:center;">
                            <i class="icofont-headphone-alt-2 fs-1 text-primary-rk mb-3"></i>
                            <p style="font-size:14px;color:#6b7c93;margin-bottom:8px;">Butuh Bantuan Segera?</p>
                            <h4 style="font-size:20px;font-weight:800;color:#223a66;margin:0;">Hubungi Admin</h4>
                            <a href="/appointment" class="btn btn-main-rk px-4 py-2 mt-3 fs-13">Bantuan Lanjut</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection