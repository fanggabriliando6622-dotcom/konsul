@extends('layouts.app')

@section('title', 'Gaya Hidup Sehat | RuangKonsul')

@section('meta_description', 'Panduan lengkap menjalani gaya hidup sehat untuk meningkatkan kualitas hidup Anda secara menyeluruh.')

@push('styles')
<style>
.blog-article { font-family: 'Inter', sans-serif; }
.blog-article img.featured { width:100%; height:360px; object-fit:cover; border-radius:16px; }
.blog-article .meta { display:flex; gap:20px; flex-wrap:wrap; margin-bottom:20px; }
.blog-article .meta span { display:flex; align-items:center; gap:6px; font-size:13px; font-weight:600; }
.blog-article .meta .text-pink { color:#e12454; }
.blog-article .meta .text-muted { color:#6b7c93; }

/* Lifestyle Cards Grid */
.lifestyle-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin: 30px 0; }
.lifestyle-card { background: #fff; padding: 28px; border-radius: 16px; border: 1px solid rgba(0,0,0,0.04); box-shadow: 0 4px 12px rgba(0,42,106,0.04); transition: all 0.3s; position: relative; overflow: hidden; }
.lifestyle-card::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 4px; background: linear-gradient(90deg, #e12454, #ff4d6d); }
.lifestyle-card:hover { transform: translateY(-5px); box-shadow: 0 8px 24px rgba(0,42,106,0.08); }
.lifestyle-card .icon { font-size: 40px; margin-bottom: 16px; display: block; }
.lifestyle-card h4 { font-size: 18px; font-weight: 700; color: #1a2d4d; margin-bottom: 12px; }
.lifestyle-card p { font-size: 14px !important; color: #6b7c93 !important; line-height: 1.6 !important; margin: 0 !important; }

/* Habit Builder */
.habit-builder { background: linear-gradient(135deg, #fef3c7 0%, #fef9c3 100%); padding: 32px; border-radius: 16px; margin: 30px 0; border: 2px solid #fde047; }
.habit-builder h4 { font-size: 20px; font-weight: 700; color: #ca8a04; margin-bottom: 20px; text-align: center; }
.habit-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; }
.habit-item { background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
.habit-item .habit-icon { font-size: 32px; margin-bottom: 12px; display: block; }
.habit-item h6 { font-size: 15px; font-weight: 700; color: #1a2d4d; margin-bottom: 8px; }
.habit-item .habit-desc { font-size: 13px; color: #6b7c93; line-height: 1.5; }

/* Daily Routine */
.routine-timeline { margin: 30px 0; }
.routine-item { display: flex; gap: 20px; margin-bottom: 24px; position: relative; padding-left: 40px; }
.routine-item::before { content: ''; position: absolute; left: 14px; top: 40px; bottom: -24px; width: 2px; background: #e1e9f1; }
.routine-item:last-child::before { display: none; }
.routine-time { position: absolute; left: 0; top: 0; width: 30px; height: 30px; border-radius: 50%; background: #e12454; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 700; z-index: 1; }
.routine-content { background: #fff; padding: 20px; border-radius: 12px; flex: 1; border: 1px solid rgba(0,0,0,0.04); }
.routine-content h6 { font-size: 16px; font-weight: 700; color: #1a2d4d; margin-bottom: 8px; }
.routine-content p { margin: 0; color: #6b7c93; font-size: 14px; line-height: 1.6; }
.routine-content .time-label { display: inline-block; background: rgba(225,36,84,0.1); color: #e12454; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; margin-bottom: 8px; }

/* Benefits Grid */
.benefit-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin: 30px 0; }
.benefit-box { background: #fff; padding: 24px; border-radius: 12px; border-left: 4px solid #10b981; box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
.benefit-box h6 { font-size: 15px; font-weight: 700; color: #059669; margin-bottom: 8px; }
.benefit-box p { margin: 0; color: #6b7c93; font-size: 13px; line-height: 1.5; }

/* Action Steps */
.action-steps { background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 100%); padding: 32px; border-radius: 16px; margin: 30px 0; border: 2px solid #bfdbfe; }
.action-steps h4 { font-size: 20px; font-weight: 700; color: #1e40af; margin-bottom: 20px; text-align: center; }
.step-box { background: #fff; padding: 20px; border-radius: 12px; margin-bottom: 16px; border-left: 4px solid #2563eb; display: flex; gap: 16px; align-items: start; }
.step-box .step-num { width: 36px; height: 36px; border-radius: 50%; background: #2563eb; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 16px; flex-shrink: 0; }
.step-box .step-content h6 { font-size: 15px; font-weight: 700; color: #1a2d4d; margin-bottom: 6px; }
.step-box .step-content p { margin: 0; color: #6b7c93; font-size: 14px; line-height: 1.5; }

.blog-article p { font-size: 16px; color: #4a5568; line-height: 1.85; }
.rk-sidebar-card { background: #fff; border-radius: 16px; padding: 28px; border: 1px solid rgba(0,0,0,0.04); box-shadow: 0 4px 16px rgba(0,42,106,0.05); margin-bottom: 24px; }
.rk-sidebar-card h5 { font-size: 16px; font-weight: 700; color: #1a2d4d; margin-bottom: 16px; }

.cta-box-rk { background: linear-gradient(135deg, #e12454 0%, #ff4d6d 100%); padding: 32px; border-radius: 16px; text-align: center; color: #fff; margin-top: 40px; }
.btn-white-rk { background: #fff; color: #e12454; padding: 12px 28px; border-radius: 50px; font-weight: 700; text-decoration: none; display: inline-block; transition: all 0.3s; }

/* Popular Articles Extra Styling */
.rk-popular-item {
    display: flex;
    align-items: center;
    gap: 24px;
    padding: 12px;
    border-radius: 15px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid transparent;
    margin-bottom: 8px;
}
.rk-popular-item:hover {
    background: #fff;
    border-color: rgba(225,36,84,0.15);
    transform: translateX(8px);
    box-shadow: 0 10px 25px rgba(0,42,106,0.06);
}
.rk-popular-item .img-container {
    position: relative;
    width: 65px;
    height: 65px;
    border-radius: 10px;
    overflow: hidden;
    flex-shrink: 0;
}
.rk-popular-item .rank-badge {
    position: absolute;
    top: 5px;
    left: 5px;
    width: 20px;
    height: 20px;
    background: #e12454;
    color: white;
    font-size: 10px;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    z-index: 3;
    box-shadow: 0 2px 4px rgba(225,36,84,0.3);
}
.rk-popular-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.rk-popular-item:hover img {
    transform: scale(1.1);
}
.rk-popular-item h6 {
    transition: color 0.3s;
}
.rk-popular-item:hover h6 {
    color: #e12454 !important;
}

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
                <i class="icofont-heart-beat"></i> Gaya Hidup Sehat
            </div>
            <h1>Transformasi Melalui <span>Gaya Hidup Sehat</span></h1>
            <div class="d-flex justify-content-center gap-4 mt-2 text-white-50 small fw-medium">
                <span><i class="icofont-calendar"></i> 03 Mar 2018</span>
                <span><i class="icofont-user"></i> Tim RuangKonsul</span>
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
                    <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=1200&h=600&fit=crop" alt="Gaya Hidup Sehat" class="featured mb-5">
                    
                    <p class="lead" style="font-size: 20px; font-weight: 600; color: #e12454; line-height: 1.6; margin-bottom: 30px;">
                        Gaya hidup sehat bukan tentang kesempurnaan, tetapi tentang membuat pilihan-pilihan kecil yang konsisten setiap hari untuk hidup yang lebih baik!
                    </p>

                    <h3 class="fw-bold text-primary-rk mt-4 mb-3" style="font-size: 24px;">Apa Itu Gaya Hidup Sehat?</h3>
                    <p>Gaya hidup sehat adalah pola hidup yang mengintegrasikan kebiasaan-kebiasaan positif dalam berbagai aspek kehidupan - fisik, mental, emosional, dan sosial. Ini bukan diet sementara atau program olahraga 30 hari, tetapi komitmen jangka panjang terhadap kesejahteraan holistik.</p>

                    <div class="lifestyle-grid">
                        <div class="lifestyle-card">
                            <span class="icon">🏃</span>
                            <h4>Aktivitas Fisik</h4>
                            <p>Bergerak secara teratur meningkatkan kesehatan jantung, kekuatan otot, dan kesehatan mental.</p>
                        </div>
                        <div class="lifestyle-card">
                            <span class="icon">🥗</span>
                            <h4>Nutrisi Seimbang</h4>
                            <p>Mengonsumsi makanan bergizi yang mendukung fungsi tubuh optimal.</p>
                        </div>
                        <div class="lifestyle-card">
                            <span class="icon">😴</span>
                            <h4>Tidur Berkualitas</h4>
                            <p>Mendapatkan 7-9 jam tidur restoratif setiap malam untuk pemulihan tubuh.</p>
                        </div>
                        <div class="lifestyle-card">
                            <span class="icon">🧘</span>
                            <h4>Manajemen Stres</h4>
                            <p>Teknik relaksasi dan mindfulness untuk menjaga keseimbangan emosional.</p>
                        </div>
                        <div class="lifestyle-card">
                            <span class="icon">💧</span>
                            <h4>Hidrasi Optimal</h4>
                            <p>Minum cukup air untuk mendukung semua fungsi tubuh.</p>
                        </div>
                        <div class="lifestyle-card">
                            <span class="icon">🚭</span>
                            <h4>Hindari Toksin</h4>
                            <p>Menghindari rokok, alkohol berlebihan, dan zat berbahaya lainnya.</p>
                        </div>
                    </div>

                    <h3 class="fw-bold text-primary-rk mt-5 mb-4" style="font-size: 24px;">Rutinitas Harian Ideal</h3>

                    <div class="routine-timeline">
                        <div class="routine-item">
                            <div class="routine-time">🌅</div>
                            <div class="routine-content">
                                <span class="time-label">06:00 - 06:30</span>
                                <h6>Bangun Pagi & Hidrasi</h6>
                                <p>Bangun di waktu yang konsisten. Minum 1-2 gelas air putih hangat untuk kickstart metabolisme.</p>
                            </div>
                        </div>

                        <div class="routine-item">
                            <div class="routine-time">🏃</div>
                            <div class="routine-content">
                                <span class="time-label">06:30 - 07:15</span>
                                <h6>Olahraga Pagi</h6>
                                <p>30-45 menit aktivitas fisik: jogging, yoga, atau gym. Olahraga pagi meningkatkan energi sepanjang hari.</p>
                            </div>
                        </div>

                        <div class="routine-item">
                            <div class="routine-time">🍳</div>
                            <div class="routine-content">
                                <span class="time-label">07:30 - 08:00</span>
                                <h6>Sarapan Bergizi</h6>
                                <p>Sarapan dengan protein, karbohidrat kompleks, dan lemak sehat. Contoh: oatmeal dengan buah dan kacang.</p>
                            </div>
                        </div>

                        <div class="routine-item">
                            <div class="routine-time">💼</div>
                            <div class="routine-content">
                                <span class="time-label">09:00 - 12:00</span>
                                <h6>Kerja Produktif</h6>
                                <p>Focus work dengan break 5-10 menit setiap jam. Lakukan peregangan ringan dan jaga postur tubuh.</p>
                            </div>
                        </div>

                        <div class="routine-item">
                            <div class="routine-time">🥗</div>
                            <div class="routine-content">
                                <span class="time-label">12:30 - 13:30</span>
                                <h6>Makan Siang & Istirahat</h6>
                                <p>Makan siang seimbang. Jalan kaki 10-15 menit setelah makan untuk membantu pencernaan.</p>
                            </div>
                        </div>

                        <div class="routine-item">
                            <div class="routine-time">😴</div>
                            <div class="routine-content">
                                <span class="time-label">22:00</span>
                                <h6>Tidur Berkualitas</h6>
                                <p>Tidur di waktu yang konsisten. Pastikan ruangan gelap, sejuk, dan tenang untuk tidur optimal.</p>
                            </div>
                        </div>
                    </div>

                    <h3 class="fw-bold text-primary-rk mt-5 mb-4" style="font-size: 24px;">Membangun Kebiasaan Sehat</h3>

                    <div class="habit-builder">
                        <h4><i class="icofont-target me-2"></i>Kebiasaan Kecil, Dampak Besar</h4>
                        <div class="habit-row">
                            <div class="habit-item">
                                <span class="habit-icon">💧</span>
                                <h6>Minum Air Saat Bangun</h6>
                                <p class="habit-desc">Mulai hari dengan 2 gelas air putih untuk rehidrasi.</p>
                            </div>
                            <div class="habit-item">
                                <span class="habit-icon">🚶</span>
                                <h6>10.000 Langkah/Hari</h6>
                                <p class="habit-desc">Target aktivitas fisik harian yang mudah dicapai.</p>
                            </div>
                            <div class="habit-item">
                                <span class="habit-icon">📱</span>
                                <h6>Digital Detox Malam</h6>
                                <p class="habit-desc">No gadget 1 jam sebelum tidur untuk tidur lebih nyenyak.</p>
                            </div>
                        </div>
                    </div>

                    <h3 class="fw-bold text-primary-rk mt-5 mb-4" style="font-size: 24px;">Manfaat Gaya Hidup Sehat</h3>

                    <div class="benefit-grid">
                        <div class="benefit-box">
                            <h6>💪 Energi Meningkat</h6>
                            <p>Stamina lebih baik untuk menjalani aktivitas sehari-hari tanpa mudah lelah.</p>
                        </div>
                        <div class="benefit-box">
                            <h6>🛡️ Imunitas Kuat</h6>
                            <p>Sistem kekebalan tubuh lebih baik melawan penyakit dan infeksi.</p>
                        </div>
                        <div class="benefit-box">
                            <h6>🧠 Fokus Tajam</h6>
                            <p>Konsentrasi dan produktivitas meningkat signifikan.</p>
                        </div>
                        <div class="benefit-box">
                            <h6>😊 Mood Stabil</h6>
                            <p>Kesehatan mental lebih baik dengan mood yang lebih positif.</p>
                        </div>
                    </div>

                    <div class="action-steps">
                        <h4><i class="icofont-rocket-alt-1 me-2"></i>Langkah Memulai Hari Ini</h4>
                        
                        <div class="step-box">
                            <div class="step-num">1</div>
                            <div class="step-content">
                                <h6>Set Goal yang Realistis</h6>
                                <p>Mulai dengan 1-2 kebiasaan kecil. Jangan overwhelm diri dengan terlalu banyak perubahan sekaligus.</p>
                            </div>
                        </div>

                        <div class="step-box">
                            <div class="step-num">2</div>
                            <div class="step-content">
                                <h6>Track Progress Anda</h6>
                                <p>Gunakan journal atau app untuk mencatat kemajuan. Seeing progress akan memotivasi Anda.</p>
                            </div>
                        </div>

                        <div class="step-box">
                            <div class="step-num">3</div>
                            <div class="step-content">
                                <h6>Be Patient & Consistent</h6>
                                <p>Perubahan butuh waktu. Fokus pada konsistensi, bukan kesempurnaan. Progress over perfection!</p>
                            </div>
                        </div>
                    </div>

                    <h3 class="fw-bold text-primary-rk mt-5 mb-3" style="font-size: 24px;">Mulai Transformasi Anda</h3>
                    <p>Gaya hidup sehat adalah marathon, bukan sprint. Setiap hari adalah kesempatan baru untuk membuat pilihan yang lebih baik. Perubahan kecil hari ini akan menciptakan transformasi besar di masa depan.</p>

                    <div class="cta-box-rk">
                        <h4>Dapatkan Panduan Personal</h4>
                        <p>Konsultasikan rencana gaya hidup sehat yang disesuaikan dengan kondisi dan tujuan Anda bersama tim ahli RuangKonsul.</p>
                        <a href="/appointment" class="btn-white-rk">Mulai Konsultasi <i class="icofont-long-arrow-right ms-2"></i></a>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-5 pt-3" style="border-top:1px solid rgba(0,0,0,0.06);">
                        <div class="d-flex gap-2">
                             <a href="#" style="background:rgba(225,36,84,0.08);color:#e12454;padding:6px 14px;border-radius:50px;font-size:12px;font-weight:600;text-decoration:none;">Lifestyle</a>
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
                    <div class="rk-sidebar-card rk-reveal rk-right" style="--s:1;">
                        <h5 class="mb-4 d-flex align-items-center gap-2">
                            <i class="icofont-fire-burn" style="color:#e12454;"></i> Terlaris & Populer
                        </h5>
                        <div class="d-flex flex-column">
                            <a href="{{ route('artikel.ksinvestasi') }}" class="rk-popular-item text-decoration-none">
                                <div class="img-container">
                                    <div class="rank-badge">1</div>
                                    <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=100&h=100&fit=crop" alt="Popular">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-bold" style="font-size:14px;color:#1a2d4d;line-height:1.4;">Kesehatan Adalah Investasi Terbaik</h6>
                                    <div class="d-flex align-items-center gap-2" style="font-size:11px;color:#6b7c93;font-weight:600;">
                                        <i class="icofont-eye text-pink"></i> 5.2k Pembaca
                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('artikel.kstubuhmental') }}" class="rk-popular-item text-decoration-none">
                                <div class="img-container">
                                    <div class="rank-badge">2</div>
                                    <img src="{{ asset('images/blog/Kesehatan Tubuh.jpeg') }}" alt="Popular">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-bold" style="font-size:14px;color:#1a2d4d;line-height:1.4;">Menjaga Tubuh dan Mental Menyeluruh</h6>
                                    <div class="d-flex align-items-center gap-2" style="font-size:11px;color:#6b7c93;font-weight:600;">
                                        <i class="icofont-eye text-pink"></i> 4.8k Pembaca
                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('artikel.tubuhsehat') }}" class="rk-popular-item text-decoration-none">
                                <div class="img-container">
                                    <div class="rank-badge">3</div>
                                    <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=100&h=100&fit=crop" alt="Popular">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-bold" style="font-size:14px;color:#1a2d4d;line-height:1.4;">Tubuh Sehat, Hidup Lebih Bahagia</h6>
                                    <div class="d-flex align-items-center gap-2" style="font-size:11px;color:#6b7c93;font-weight:600;">
                                        <i class="icofont-eye text-pink"></i> 3.9k Pembaca
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="rk-sidebar-card rk-reveal rk-right" style="--s:2;">
                         <div style="padding:24px;border-radius:16px;background:linear-gradient(135deg,rgba(225,36,84,0.1),rgba(225,36,84,0.02));text-align:center;">
                            <i class="icofont-heartbeat fs-1 mb-3" style="color:#e12454;"></i>
                            <p style="font-size:14px;color:#6b7c93;margin-bottom:8px;">Siap Berubah?</p>
                            <h4 style="font-size:20px;font-weight:800;color:#e12454;margin:0;">Konsultasi Gratis</h4>
                            <a href="/appointment" class="btn px-4 py-2 mt-3 fs-13" style="background:#e12454;color:#fff;border-radius:50px;text-decoration:none;display:inline-block;">Hubungi Kami</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection