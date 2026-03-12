@extends('layouts.app')

@section('title', 'Nutrisi | RuangKonsul')

@section('meta_description', 'Panduan lengkap nutrisi dan pola makan sehat untuk hidup lebih berkualitas.')

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

/* Nutrition Cards Grid */
.nutrition-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin: 30px 0; }
.nutrition-card { background: #fff; padding: 28px; border-radius: 16px; border: 1px solid rgba(0,0,0,0.04); box-shadow: 0 4px 12px rgba(0,42,106,0.04); transition: all 0.3s; position: relative; overflow: hidden; }
.nutrition-card::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 4px; background: linear-gradient(90deg, #10b981, #059669); }
.nutrition-card:hover { transform: translateY(-5px); box-shadow: 0 8px 24px rgba(0,42,106,0.08); }
.nutrition-card .icon { font-size: 40px; margin-bottom: 16px; display: block; }
.nutrition-card h4 { font-size: 18px; font-weight: 700; color: #1a2d4d; margin-bottom: 12px; }
.nutrition-card p { font-size: 14px !important; color: #6b7c93 !important; line-height: 1.6 !important; margin: 0 !important; }
.nutrition-card .highlight { background: rgba(16,185,129,0.1); padding: 12px; border-radius: 8px; margin-top: 12px; font-size: 13px; font-weight: 600; color: #059669; }

/* Food Groups */
.food-group { background: #fff; border-radius: 16px; padding: 24px; margin-bottom: 20px; border: 1px solid rgba(0,0,0,0.04); position: relative; overflow: hidden; }
.food-group .accent { position: absolute; top: 0; left: 0; width: 4px; height: 100%; }
.food-group h5 { font-size: 18px; font-weight: 700; color: #1a2d4d; margin-bottom: 12px; display: flex; align-items: center; gap: 12px; }
.food-group h5 .icon-box { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
.food-group ul { list-style: none; padding: 0; margin: 12px 0 0 0; }
.food-group ul li { padding: 8px 0; color: #6b7c93; font-size: 14px; display: flex; align-items: center; gap: 8px; }
.food-group ul li::before { content: '✓'; color: #10b981; font-weight: 700; font-size: 16px; }

/* Meal Plan Table */
.meal-plan-box { background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%); padding: 32px; border-radius: 16px; margin: 30px 0; border: 2px solid #d1fae5; }
.meal-plan-box h4 { font-size: 20px; font-weight: 700; color: #059669; margin-bottom: 20px; text-align: center; }
.meal-time { background: #fff; padding: 20px; border-radius: 12px; margin-bottom: 16px; border-left: 4px solid #10b981; }
.meal-time h6 { font-size: 14px; font-weight: 700; color: #059669; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
.meal-time p { margin: 0; color: #4a5568; font-size: 14px; line-height: 1.6; }

/* Tips Box */
.tips-box { background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); padding: 28px; border-radius: 16px; margin: 30px 0; border: 2px solid #fde68a; }
.tips-box h4 { font-size: 18px; font-weight: 700; color: #d97706; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
.tips-box ul { margin: 0; padding-left: 20px; }
.tips-box ul li { color: #78350f; margin-bottom: 8px; font-size: 14px; line-height: 1.6; }

.blog-article p { font-size: 16px; color: #4a5568; line-height: 1.85; }
.rk-sidebar-card { background: #fff; border-radius: 16px; padding: 28px; border: 1px solid rgba(0,0,0,0.04); box-shadow: 0 4px 16px rgba(0,42,106,0.05); margin-bottom: 24px; }
.rk-sidebar-card h5 { font-size: 16px; font-weight: 700; color: #1a2d4d; margin-bottom: 16px; }
.rk-sidebar-card .post-item { padding: 12px 0; border-bottom: 1px solid rgba(0,0,0,0.04); }
.rk-sidebar-card .post-item:last-child { border-bottom:none; }
.rk-sidebar-card .post-item h6 a { color:#1a2d4d; text-decoration:none; transition:color 0.3s; }
.rk-sidebar-card .post-item h6 a:hover { color:#e12454; }

.cta-box-rk { background: linear-gradient(135deg, #10b981 0%, #059669 100%); padding: 32px; border-radius: 16px; text-align: center; color: #fff; margin-top: 40px; }
.btn-white-rk { background: #fff; color: #059669; padding: 12px 28px; border-radius: 50px; font-weight: 700; text-decoration: none; display: inline-block; transition: all 0.3s; }

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
                <i class="icofont-restaurant"></i> Nutrisi Sehat
            </div>
            <h1>Panduan Lengkap <span>Nutrisi Harian</span></h1>
            <div class="d-flex justify-content-center gap-4 mt-2 text-white-50 small fw-medium">
                <span><i class="icofont-calendar"></i> 20 Feb 2026</span>
                <span><i class="icofont-user"></i> Dr. Nutritionist</span>
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
                    <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=1200&h=600&fit=crop" alt="Nutrisi Sehat" class="featured mb-5">
                    
                    <p class="lead" style="font-size: 20px; font-weight: 600; color: #059669; line-height: 1.6; margin-bottom: 30px;">
                        Nutrisi yang tepat adalah fondasi kesehatan optimal. Tubuh Anda adalah cerminan dari apa yang Anda makan!
                    </p>

                    <h3 class="fw-bold text-primary-rk mt-4 mb-3" style="font-size: 24px;">Mengapa Nutrisi Penting?</h3>
                    <p>Nutrisi bukan hanya tentang kalori, tetapi tentang memberikan tubuh bahan bakar berkualitas tinggi untuk fungsi optimal. Setiap sel, jaringan, dan organ membutuhkan nutrisi spesifik untuk bekerja dengan baik.</p>

                    <div class="nutrition-grid">
                        <div class="nutrition-card">
                            <span class="icon">🥗</span>
                            <h4>Energi Berkelanjutan</h4>
                            <p>Karbohidrat kompleks memberikan energi stabil sepanjang hari tanpa lonjakan gula darah.</p>
                            <div class="highlight">Pilih: Oatmeal, Quinoa, Ubi</div>
                        </div>
                        <div class="nutrition-card">
                            <span class="icon">💪</span>
                            <h4>Pembentukan Otot</h4>
                            <p>Protein berkualitas tinggi mendukung pertumbuhan dan perbaikan jaringan tubuh.</p>
                            <div class="highlight">Pilih: Dada Ayam, Ikan, Tahu</div>
                        </div>
                        <div class="nutrition-card">
                            <span class="icon">🧠</span>
                            <h4>Fungsi Otak Optimal</h4>
                            <p>Lemak sehat omega-3 mendukung kesehatan otak dan sistem saraf.</p>
                            <div class="highlight">Pilih: Salmon, Alpukat, Kacang</div>
                        </div>
                        <div class="nutrition-card">
                            <span class="icon">🛡️</span>
                            <h4>Imunitas Kuat</h4>
                            <p>Vitamin dan mineral memperkuat sistem kekebalan tubuh.</p>
                            <div class="highlight">Pilih: Sayuran Hijau, Buah Citrus</div>
                        </div>
                    </div>

                    <h3 class="fw-bold text-primary-rk mt-5 mb-4" style="font-size: 24px;">5 Kelompok Makanan Penting</h3>

                    <div class="food-group">
                        <div class="accent" style="background:#10b981;"></div>
                        <h5>
                            <div class="icon-box" style="background:rgba(16,185,129,0.1);color:#10b981;">🥬</div>
                            Sayuran & Buah-buahan
                        </h5>
                        <p style="color:#6b7c93;font-size:14px;margin-bottom:12px;">Sumber vitamin, mineral, serat, dan antioksidan</p>
                        <ul>
                            <li>Bayam, brokoli, wortel (sayuran berwarna)</li>
                            <li>Apel, pisang, berry (buah segar)</li>
                            <li>Target: 5 porsi per hari</li>
                        </ul>
                    </div>

                    <div class="food-group">
                        <div class="accent" style="background:#d97706;"></div>
                        <h5>
                            <div class="icon-box" style="background:rgba(217,119,6,0.1);color:#d97706;">🌾</div>
                            Karbohidrat Kompleks
                        </h5>
                        <p style="color:#6b7c93;font-size:14px;margin-bottom:12px;">Sumber energi utama dan serat</p>
                        <ul>
                            <li>Nasi merah, roti gandum utuh</li>
                            <li>Oatmeal, quinoa, ubi jalar</li>
                            <li>Target: 45-65% kalori harian</li>
                        </ul>
                    </div>

                    <div class="food-group">
                        <div class="accent" style="background:#e12454;"></div>
                        <h5>
                            <div class="icon-box" style="background:rgba(225,36,84,0.1);color:#e12454;">🍗</div>
                            Protein Berkualitas
                        </h5>
                        <p style="color:#6b7c93;font-size:14px;margin-bottom:12px;">Pembentuk dan perbaikan jaringan tubuh</p>
                        <ul>
                            <li>Dada ayam, ikan, telur</li>
                            <li>Tempe, tahu, kacang-kacangan</li>
                            <li>Target: 10-35% kalori harian</li>
                        </ul>
                    </div>

                    <div class="food-group">
                        <div class="accent" style="background:#2563eb;"></div>
                        <h5>
                            <div class="icon-box" style="background:rgba(37,99,235,0.1);color:#2563eb;">🥑</div>
                            Lemak Sehat
                        </h5>
                        <p style="color:#6b7c93;font-size:14px;margin-bottom:12px;">Mendukung fungsi hormon dan penyerapan vitamin</p>
                        <ul>
                            <li>Alpukat, minyak zaitun</li>
                            <li>Kacang almond, chia seeds</li>
                            <li>Target: 20-35% kalori harian</li>
                        </ul>
                    </div>

                    <div class="food-group">
                        <div class="accent" style="background:#7c3aed;"></div>
                        <h5>
                            <div class="icon-box" style="background:rgba(124,58,237,0.1);color:#7c3aed;">🥛</div>
                            Produk Susu & Alternatif
                        </h5>
                        <p style="color:#6b7c93;font-size:14px;margin-bottom:12px;">Sumber kalsium dan protein</p>
                        <ul>
                            <li>Susu rendah lemak, yogurt</li>
                            <li>Susu almond, susu kedelai</li>
                            <li>Target: 2-3 porsi per hari</li>
                        </ul>
                    </div>

                    <div class="meal-plan-box">
                        <h4><i class="icofont-ui-calendar me-2"></i>Contoh Menu Harian Seimbang</h4>
                        
                        <div class="meal-time">
                            <h6>🌅 Sarapan (07:00)</h6>
                            <p>Oatmeal dengan potongan pisang, almond, dan madu + Telur rebus + Teh hijau</p>
                        </div>

                        <div class="meal-time">
                            <h6>🍎 Snack Pagi (10:00)</h6>
                            <p>Greek yogurt dengan berry segar + Segenggam kacang mede</p>
                        </div>

                        <div class="meal-time">
                            <h6>☀️ Makan Siang (12:30)</h6>
                            <p>Nasi merah + Dada ayam panggang + Tumis brokoli wortel + Tahu + Salad</p>
                        </div>

                        <div class="meal-time">
                            <h6>🥤 Snack Sore (15:30)</h6>
                            <p>Smoothie bayam, pisang, dan protein powder + Roti gandum dengan selai kacang</p>
                        </div>

                        <div class="meal-time">
                            <h6>🌙 Makan Malam (19:00)</h6>
                            <p>Salmon panggang + Quinoa + Asparagus kukus + Salad sayuran hijau</p>
                        </div>
                    </div>

                    <div class="tips-box">
                        <h4><i class="icofont-light-bulb"></i> Tips Nutrisi Praktis</h4>
                        <ul>
                            <li>Minum 8-10 gelas air putih per hari untuk hidrasi optimal</li>
                            <li>Variasikan warna makanan di piring untuk nutrisi beragam</li>
                            <li>Batasi gula tambahan maksimal 25g per hari</li>
                            <li>Hindari makanan ultra-processed dan fast food</li>
                            <li>Meal prep di akhir pekan untuk menghemat waktu</li>
                            <li>Dengarkan sinyal lapar dan kenyang dari tubuh</li>
                            <li>Konsultasi dengan ahli gizi untuk rencana personal</li>
                        </ul>
                    </div>

                    <h3 class="fw-bold text-primary-rk mt-5 mb-3" style="font-size: 24px;">Mulai Perjalanan Nutrisi Anda</h3>
                    <p>Nutrisi yang baik adalah investasi terbaik untuk kesehatan jangka panjang. Tidak perlu sempurna, yang penting konsisten dan membuat pilihan yang lebih baik setiap hari.</p>

                    <div class="cta-box-rk">
                        <h4>Konsultasi Nutrisi Personal</h4>
                        <p>Dapatkan rencana nutrisi yang disesuaikan dengan kebutuhan dan tujuan kesehatan Anda bersama ahli gizi RuangKonsul.</p>
                        <a href="/appointment" class="btn-white-rk">Konsultasi Sekarang <i class="icofont-long-arrow-right ms-2"></i></a>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-5 pt-3" style="border-top:1px solid rgba(0,0,0,0.06);">
                        <div class="d-flex gap-2">
                             <a href="#" style="background:rgba(16,185,129,0.08);color:#059669;padding:6px 14px;border-radius:50px;font-size:12px;font-weight:600;text-decoration:none;">Nutrisi</a>
                             <a href="#" style="background:rgba(37,99,235,0.08);color:#2563eb;padding:6px 14px;border-radius:50px;font-size:12px;font-weight:600;text-decoration:none;">Pola Makan</a>
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
                            <span>03 Maret 2018</span>
                            <h6><a href="#">Tubuh Sehat, Hidup Bahagia</a></h6>
                        </div>
                        <div class="post-item">
                            <span>05 Maret 2018</span>
                            <h6><a href="#">Kesehatan Adalah Investasi</a></h6>
                        </div>
                    </div>

                    <div class="rk-sidebar-card rk-reveal rk-right" style="--s:2;">
                         <div style="padding:24px;border-radius:16px;background:linear-gradient(135deg,rgba(16,185,129,0.1),rgba(16,185,129,0.02));text-align:center;">
                            <i class="icofont-apple fs-1 mb-3" style="color:#059669;"></i>
                            <p style="font-size:14px;color:#6b7c93;margin-bottom:8px;">Butuh Panduan Nutrisi?</p>
                            <h4 style="font-size:20px;font-weight:800;color:#059669;margin:0;">Konsultasi Ahli Gizi</h4>
                            <a href="/appointment" class="btn px-4 py-2 mt-3 fs-13" style="background:#059669;color:#fff;border-radius:50px;text-decoration:none;display:inline-block;">Buat Jadwal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection