@extends('layouts.app')

@section('title', 'Kontak | RuangKonsul')

@section('meta_description', 'Hubungi RuangKonsul - Konsultasi kesehatan online profesional')

@section('content')

<!-- ===== HERO ===== -->
<section class="rk-hero">
    <div class="rk-hero-dots">
        <span></span><span></span><span></span><span></span>
    </div>
    <div class="container">
        <div class="rk-hero-inner">
            <div class="rk-hero-badge">
                <i class="icofont-phone"></i> Hubungi Kami
            </div>
            <h1>Kami Siap <span>Membantu Anda</span></h1>
            <p class="rk-hero-desc">
                Punya pertanyaan atau butuh bantuan? Jangan ragu untuk menghubungi tim RuangKonsul. Kami siap merespons setiap kebutuhan Anda.
            </p>
        </div>
    </div>
</section>

<div class="rk-wave">
    <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 80L48 74.7C96 69.3 192 58.7 288 53.3C384 48 480 48 576 53.3C672 58.7 768 69.3 864 69.3C960 69.3 1056 58.7 1152 48C1248 37.3 1344 26.7 1392 21.3L1440 16V80H1392C1344 80 1248 80 1152 80C1056 80 960 80 864 80C768 80 672 80 576 80C480 80 384 80 288 80C192 80 96 80 48 80H0Z" fill="white"/>
    </svg>
</div>

<!-- ===== CONTACT INFO CARDS ===== -->
<section class="rk-section rk-bg-white" style="padding-top:60px;">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="rk-card rk-reveal rk-up rk-stagger text-center" style="--s:0;--rk-card-accent:linear-gradient(90deg,#e12454,#ff6b8a);">
                    <div class="rk-icon-box mx-auto" style="background:linear-gradient(135deg,#e12454,#ff6b8a);">
                        <i class="icofont-live-support"></i>
                    </div>
                    <h4 style="font-size:18px;font-weight:700;color:#1a2d4d;margin-bottom:8px;">Telepon</h4>
                    <p style="font-size:15px;color:#6b7c93;margin:0;">+62 856-4305-0274</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="rk-card rk-reveal rk-up rk-stagger text-center" style="--s:1;--rk-card-accent:linear-gradient(90deg,#2563eb,#60a5fa);">
                    <div class="rk-icon-box mx-auto" style="background:linear-gradient(135deg,#2563eb,#60a5fa);">
                        <i class="icofont-email"></i>
                    </div>
                    <h4 style="font-size:18px;font-weight:700;color:#1a2d4d;margin-bottom:8px;">Email</h4>
                    <p style="font-size:15px;color:#6b7c93;margin:0;">RuangKonsul@gmail.com</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="rk-card rk-reveal rk-up rk-stagger text-center" style="--s:2;--rk-card-accent:linear-gradient(90deg,#0d9488,#5eead4);">
                    <div class="rk-icon-box mx-auto" style="background:linear-gradient(135deg,#0d9488,#34d399);">
                        <i class="icofont-location-pin"></i>
                    </div>
                    <h4 style="font-size:18px;font-weight:700;color:#1a2d4d;margin-bottom:8px;">Lokasi</h4>
                    <p style="font-size:15px;color:#6b7c93;margin:0;">Jl. Kanal No. 5a Lamper Lor, Semarang</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== CONTACT FORM ===== -->
<section class="rk-section rk-bg-light" style="padding-top:60px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="rk-section-hdr rk-reveal rk-up">
                    <div class="rk-section-label">
                        <i class="icofont-envelope"></i> Kirim Pesan
                    </div>
                    <h2>Hubungi Kami</h2>
                    <p>Konsultasikan keluhan kesehatan Anda kapan saja bersama tenaga profesional di RuangKonsul.</p>
                </div>

                <div class="rk-card rk-reveal rk-up" style="padding:40px 36px;">
                    <form id="contact-form" class="contact__form">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success contact__msg" style="display:none;border-radius:12px;" role="alert">
                                    Pesan Anda berhasil dikirim.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label style="font-size:12px;font-weight:700;color:#1a2d4d;text-transform:uppercase;letter-spacing:0.8px;margin-bottom:8px;display:flex;align-items:center;gap:6px;">
                                        <i class="icofont-user" style="color:#e12454;"></i> Nama Lengkap
                                    </label>
                                    <input name="name" id="name" type="text" class="form-control" placeholder="Masukkan nama Anda" required style="border-radius:12px;padding:14px 16px;border:1px solid #e1e9f1;font-size:15px;">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label style="font-size:12px;font-weight:700;color:#1a2d4d;text-transform:uppercase;letter-spacing:0.8px;margin-bottom:8px;display:flex;align-items:center;gap:6px;">
                                        <i class="icofont-email" style="color:#2563eb;"></i> Email
                                    </label>
                                    <input name="email" id="email" type="email" class="form-control" placeholder="Masukkan email Anda" required style="border-radius:12px;padding:14px 16px;border:1px solid #e1e9f1;font-size:15px;">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label style="font-size:12px;font-weight:700;color:#1a2d4d;text-transform:uppercase;letter-spacing:0.8px;margin-bottom:8px;display:flex;align-items:center;gap:6px;">
                                        <i class="icofont-speech-comments" style="color:#0d9488;"></i> Topik
                                    </label>
                                    <input name="subject" id="subject" type="text" class="form-control" placeholder="Topik pertanyaan" style="border-radius:12px;padding:14px 16px;border:1px solid #e1e9f1;font-size:15px;">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label style="font-size:12px;font-weight:700;color:#1a2d4d;text-transform:uppercase;letter-spacing:0.8px;margin-bottom:8px;display:flex;align-items:center;gap:6px;">
                                        <i class="icofont-phone" style="color:#7c3aed;"></i> Nomor Telepon
                                    </label>
                                    <input name="phone" id="phone" type="text" class="form-control" placeholder="Nomor telepon Anda" style="border-radius:12px;padding:14px 16px;border:1px solid #e1e9f1;font-size:15px;">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label style="font-size:12px;font-weight:700;color:#1a2d4d;text-transform:uppercase;letter-spacing:0.8px;margin-bottom:8px;display:flex;align-items:center;gap:6px;">
                                <i class="icofont-pencil-alt-5" style="color:#d97706;"></i> Pesan
                            </label>
                            <textarea name="message" id="message" class="form-control" rows="6" placeholder="Tulis pesan Anda di sini..." required style="border-radius:12px;padding:14px 16px;border:1px solid #e1e9f1;font-size:15px;resize:vertical;"></textarea>
                        </div>
                        <div class="text-center mt-4">
                            <button type="button" class="rk-btn" onclick="sendMail()" style="width:100%;justify-content:center;">
                                Kirim Pesan <i class="icofont-long-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== MAP ===== -->
<section class="rk-section rk-bg-white" style="padding-top:40px;">
    <div class="container">
        <div class="rk-reveal rk-up" style="border-radius:18px;overflow:hidden;box-shadow:0 8px 30px rgba(0,42,106,0.08);">
            <iframe 
                src="https://www.google.com/maps?q=Optima%20Multi%20Sinergi&z=16&output=embed"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                style="width:100%;height:360px;border:0;display:block;">
            </iframe>
        </div>
    </div>
</section>

<script>
function sendMail() {
    var name = encodeURIComponent(document.getElementById('name').value);
    var email = encodeURIComponent(document.getElementById('email').value);
    var subject = encodeURIComponent(document.getElementById('subject').value || 'Contact Form');
    var phone = encodeURIComponent(document.getElementById('phone').value);
    var message = encodeURIComponent(document.getElementById('message').value);
    var body = `Nama: ${name}%0AEmail: ${email}%0APhone: ${phone}%0AMessage: ${message}`;
    var mailtoLink = `mailto:fanggabriliando6622@gmail.com?subject=${subject}&body=${body}`;
    window.location.href = mailtoLink;
}
</script>

@endsection
