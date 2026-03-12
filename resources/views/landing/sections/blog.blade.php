@extends('layouts.app')

@section('title', 'Blog & Artikel Kesehatan | RuangKonsul')

@section('meta_description', 'Kumpulan artikel kesehatan terpercaya dari RuangKonsul. Tips gaya hidup sehat, nutrisi, dan kesehatan mental.')

@push('styles')
<style>
.blog-list-item { 
    margin-bottom: 30px; 
    transition: all 0.4s ease;
}
.blog-list-item:hover .img-wrapper img { transform: scale(1.05); }
.blog-list-item .img-wrapper { 
    border-radius: 20px; 
    overflow: hidden; 
    position: relative; 
    height: 240px; 
}
.blog-list-item .img-wrapper img { 
    width: 100%; 
    height: 100%; 
    object-fit: cover; 
    transition: all 0.6s ease;
}
.blog-list-item .category-badge {
    position: absolute;
    top: 20px;
    left: 20px;
    background: var(--rk-primary);
    color: white;
    padding: 6px 16px;
    border-radius: 50px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    z-index: 2;
}

.blog-list-item .content-card {
    background: white;
    padding: 24px;
    border-radius: 0 0 20px 20px;
    border: 1px solid rgba(0,0,0,0.04);
    border-top: none;
    box-shadow: 0 4px 20px rgba(0,0,0,0.03);
}

.blog-list-item .meta { 
    display: flex; 
    gap: 15px; 
    font-size: 12px; 
    color: #6b7c93; 
    margin-bottom: 12px;
    font-weight: 600;
}

.blog-list-item h3 { 
    font-size: 20px; 
    font-weight: 800; 
    color: #1a2d4d; 
    line-height: 1.4; 
    margin-bottom: 12px; 
}
.blog-list-item h3 a { color: #1a2d4d; text-decoration: none; transition: color 0.3s; }
.blog-list-item h3 a:hover { color: #e12454; }

.blog-list-item p { 
    font-size: 14px; 
    color: #4a5568; 
    line-height: 1.6; 
    margin-bottom: 20px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.blog-list-item .read-more {
    font-weight: 700;
    font-size: 13px;
    color: #e12454;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s;
}
.blog-list-item .read-more:hover { gap: 10px; }

/* Featured Post Styling */
.featured-post {
    margin-bottom: 50px;
}
.featured-post .rk-card {
    display: flex;
    flex-wrap: wrap;
    padding: 0;
    overflow: hidden;
    border: none;
}
.featured-post .featured-img {
    flex: 0 0 45%;
    min-height: 350px;
}
.featured-post .featured-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.featured-post .featured-content {
    flex: 1;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.featured-post .tag {
    color: #e12454;
    font-weight: 800;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-bottom: 12px;
}
.featured-post h2 {
    font-size: 32px;
    font-weight: 800;
    line-height: 1.25;
    margin-bottom: 20px;
}

@media (max-width: 991px) {
    .featured-post .rk-card { flex-direction: column; }
    .featured-post .featured-img { flex: 0 0 100%; min-height: 250px; }
}

.rk-sidebar-card { background: #fff; border-radius: 16px; padding: 28px; border: 1px solid rgba(0,0,0,0.04); box-shadow: 0 4px 16px rgba(0,42,106,0.05); margin-bottom: 24px; }
.rk-sidebar-card h5 { font-size: 16px; font-weight: 700; color: #1a2d4d; margin-bottom: 16px; }

@media (min-width: 992px) {
    .sidebar { position: sticky; top: 120px; }
}

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
                <i class="icofont-pencil-alt-5"></i> Blog & Artikel
            </div>
            <h1>Pusat <span>Informasi Kesehatan</span></h1>
            <p class="rk-hero-desc">
                Temukan berbagai tips dan wawasan medis terpercaya dari tim ahli RuangKonsul untuk mendukung gaya hidup sehat Anda.
            </p>
        </div>
    </div>
</section>

<div class="rk-wave">
    <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 80L48 74.7C96 69.3 192 58.7 288 53.3C384 48 480 48 576 53.3C672 58.7 768 69.3 864 69.3C960 69.3 1056 58.7 1152 48C1248 37.3 1344 26.7 1392 21.3L1440 16V80H1392C1344 80 1248 80 1152 80C1056 80 960 80 864 80C768 80 672 80 576 80C480 80 384 80 288 80C192 80 96 80 48 80H0Z" fill="#f8faff"/>
    </svg>
</div>

<!-- ===== BLOG CONTENT ===== -->
<section class="rk-section rk-bg-light" style="padding-top:40px;">
    <div class="container">
        
        <!-- Featured Post -->
        <div class="featured-post rk-reveal rk-up">
            <div class="rk-card">
                <div class="featured-img">
                    <img src="{{ asset('images/blog/Kesehatan Tubuh.jpeg') }}" alt="Featured">
                </div>
                <div class="featured-content">
                    <div class="tag">Headline Kesehatan</div>
                    <h2><a href="{{ route('artikel.kstubuhmental') }}" style="color:#1a2d4d;text-decoration:none;">Menjaga Kesehatan Tubuh dan Mental secara Menyeluruh</a></h2>
                    <p class="text-muted small mb-4">Kesehatan merupakan fondasi utama untuk menjalani kehidupan yang produktif dan berkualitas. Mens sana in corpore sano...</p>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('images/blog/testi 2.jpeg') }}" style="width:40px;height:40px;border-radius:50%;" alt="Author">
                            <div>
                                <h6 class="mb-0 fw-bold" style="font-size:13px;">Dr. Ahmad</h6>
                                <span class="text-muted small">Specialist</span>
                            </div>
                        </div>
                        <a href="{{ route('artikel.kstubuhmental') }}" class="btn btn-main-rk btn-sm">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Latest Articles Grid -->
            <div class="col-lg-8">
                <div class="row">
                    <!-- Post 1 -->
                    <div class="col-md-6 blog-list-item rk-reveal rk-up" style="--s:0;">
                        <div class="img-wrapper">
                            <span class="category-badge">Investasi</span>
                            <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=600&h=400&fit=crop" alt="Investasi">
                        </div>
                        <div class="content-card">
                            <div class="meta">
                                <span><i class="icofont-calendar"></i> 05 Mar 2018</span>
                                <span><i class="icofont-clock-time"></i> 8 Min</span>
                            </div>
                            <h3><a href="{{ route('artikel.ksinvestasi') }}">Kesehatan Adalah Investasi Terbaik</a></h3>
                            <p>Banyak yang lupa bahwa kesehatan adalah aset paling berharga yang memberikan return luar biasa di masa depan.</p>
                            <a href="{{ route('artikel.ksinvestasi') }}" class="read-more">Baca Lengkap <i class="icofont-long-arrow-right"></i></a>
                        </div>
                    </div>

                    <!-- Post 2 -->
                    <div class="col-md-6 blog-list-item rk-reveal rk-up" style="--s:1;">
                        <div class="img-wrapper">
                            <span class="category-badge">Self Care</span>
                            <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=600&h=400&fit=crop" alt="Self Care">
                        </div>
                        <div class="content-card">
                            <div class="meta">
                                <span><i class="icofont-calendar"></i> 09 Mar 2018</span>
                                <span><i class="icofont-clock-time"></i> 7 Min</span>
                            </div>
                            <h3><a href="{{ route('artikel.ksditanganmu') }}">Kesehatan Ditanganmu Sendiri</a></h3>
                            <p>Pelajari 7 pilar penting yang bisa anda kendalikan untuk memastikan tubuh tetap prima setiap hari.</p>
                            <a href="{{ route('artikel.ksditanganmu') }}" class="read-more">Baca Lengkap <i class="icofont-long-arrow-right"></i></a>
                        </div>
                    </div>

                    <!-- Post 3 -->
                    <div class="col-md-6 blog-list-item rk-reveal rk-up" style="--s:2;">
                        <div class="img-wrapper">
                            <span class="category-badge">Lifestyle</span>
                            <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=600&h=400&fit=crop" alt="Lifestyle">
                        </div>
                        <div class="content-card">
                            <div class="meta">
                                <span><i class="icofont-calendar"></i> 03 Mar 2018</span>
                                <span><i class="icofont-clock-time"></i> 9 Min</span>
                            </div>
                            <h3><a href="{{ route('artikel.tubuhsehat') }}">Tubuh Sehat, Hidup Lebih Bahagia</a></h3>
                            <p>Hubungan erat antara kebugaran fisik dan kesejahteraan mental serta hormon kebahagiaan alami.</p>
                            <a href="{{ route('artikel.tubuhsehat') }}" class="read-more">Baca Lengkap <i class="icofont-long-arrow-right"></i></a>
                        </div>
                    </div>

                    <!-- Post 4 -->
                    <div class="col-md-6 blog-list-item rk-reveal rk-up" style="--s:3;">
                        <div class="img-wrapper">
                            <span class="category-badge">Nutrisi</span>
                            <img src="{{ asset('images/blog/blog-1.jpg') }}" alt="Nutrisi">
                        </div>
                        <div class="content-card">
                            <div class="meta">
                                <span><i class="icofont-calendar"></i> 20 Feb 2026</span>
                                <span><i class="icofont-clock-time"></i> 5 Min</span>
                            </div>
                            <h3><a href="{{ route('artikel.nutrisi') }}">Panduan Nutrisi Harian Untuk Pekerja Produktif</a></h3>
                            <p>Bagaimana mengatur pola makan di tengah kesibukan kantor agar energi tetap stabil sepanjang hari.</p>
                            <a href="{{ route('artikel.nutrisi') }}" class="read-more">Baca Lengkap <i class="icofont-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Pagination Placeholder -->
                <div class="mt-4 mb-5 d-flex justify-content-center">
                    <nav aria-label="Page navigation">
                      <ul class="pagination pagination-rk">
                        <li class="page-item disabled"><a class="page-link" href="#"><i class="icofont-double-left"></i></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="icofont-double-right"></i></a></li>
                      </ul>
                    </nav>
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
                        <h5>Artikel Terbaru</h5>
                        <div class="post-item" style="padding:10px 0; border-bottom:1px solid rgba(0,0,0,0.05);">
                            <span class="text-muted small">09 Mar 2018</span>
                            <h6 class="mb-0"><a href="{{ route('artikel.ksditanganmu') }}" style="color:#1a2d4d;text-decoration:none;font-size:14px;font-weight:600;">Kesehatan Ditanganmu</a></h6>
                        </div>
                        <div class="post-item" style="padding:10px 0; border-bottom:1px solid rgba(0,0,0,0.05);">
                            <span class="text-muted small">05 Mar 2018</span>
                            <h6 class="mb-0"><a href="{{ route('artikel.ksinvestasi') }}" style="color:#1a2d4d;text-decoration:none;font-size:14px;font-weight:600;">Kesehatan Investasi</a></h6>
                        </div>
                        <div class="post-item" style="padding:10px 0;">
                            <span class="text-muted small">03 Mar 2018</span>
                            <h6 class="mb-0"><a href="{{ route('artikel.tubuhsehat') }}" style="color:#1a2d4d;text-decoration:none;font-size:14px;font-weight:600;">Tubuh Sehat Bahagia</a></h6>
                        </div>
                    </div>

                    <div class="rk-sidebar-card rk-reveal rk-right" style="--s:2;">
                        <h5>Kategori Populer</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('artikel.nutrisi') }}" class="badge bg-light text-dark p-2 text-decoration-none" style="border-radius:8px;">Nutrisi</a>
                            <a href="{{ route('artikel.mental') }}" class="badge bg-light text-dark p-2 text-decoration-none" style="border-radius:8px;">Mental</a>
                            <a href="{{ route('artikel.gaya') }}" class="badge bg-light text-dark p-2 text-decoration-none" style="border-radius:8px;">Gaya Hidup</a>
                        </div>
                    </div>

                    <div class="rk-sidebar-card rk-reveal rk-right" style="--s:3;">
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
                </div>
            </div>
        </div>
    </div>
</section>

@endsection