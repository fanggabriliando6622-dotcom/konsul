@extends('layouts.app')

@section('title', 'Konfirmasi Pembayaran | RuangKonsul')

@section('content')

<style>
    .payment-page { font-family: 'Inter', sans-serif; }
    
    .doctor-img-wrapper {
        position: relative;
        animation: floatUp 3s ease-in-out infinite;
    }
    @keyframes floatUp { 0%, 100% {transform:translateY(0)} 50% {transform:translateY(-15px)} }
    
    /* Radio Options Style */
    .payment-option-label {
        display: flex; align-items: center; gap: 16px;
        padding: 18px 22px;
        border: 2px solid #eef2f6;
        border-radius: 18px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fff;
        margin-bottom: 14px;
    }
    .payment-option-label:hover { 
        border-color: rgba(34,58,102,0.2); 
        background: #f8fafd;
        transform: translateY(-2px);
    }
    .payment-option input[type="radio"]:checked + .payment-option-label {
        border-color: #223a66;
        background: rgba(34,58,102,0.02);
        box-shadow: 0 10px 20px rgba(34,58,102,0.05);
    }
    .payment-icon-rk {
        width: 52px; height: 52px;
        border-radius: 14px;
        background: #f1f4f9;
        color: #223a66;
        display: flex; align-items: center; justify-content: center;
        font-size: 26px; flex-shrink: 0;
    }
    .payment-option input[type="radio"]:checked + .payment-option-label .payment-icon-rk {
        background: #223a66; color: white;
    }
    .payment-check-rk {
        width: 24px; height: 24px; border-radius: 50%;
        background: #223a66; color: white;
        display: flex; align-items: center; justify-content: center;
        font-size: 12px; opacity: 0; transform: scale(0.5);
        transition: all 0.3s; margin-left: auto;
    }
    .payment-option input[type="radio"]:checked + .payment-option-label .payment-check-rk {
        opacity: 1; transform: scale(1);
    }
</style>

<!-- ===== HERO ===== -->
<section class="rk-hero">
    <div class="rk-hero-dots">
        <span></span><span></span><span></span><span></span>
    </div>
    <div class="container">
        <div class="rk-hero-inner">
            <div class="rk-hero-badge">
                <i class="icofont-credit-card"></i> Pembayaran
            </div>
            <h1>Selesaikan <span>Konsultasi</span></h1>
            <p class="rk-hero-desc">Satu langkah lagi untuk terhubung dengan dokter terbaik kami.</p>
        </div>
    </div>
</section>

<div class="rk-wave">
    <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 80L48 74.7C96 69.3 192 58.7 288 53.3C384 48 480 48 576 53.3C672 58.7 768 69.3 864 69.3C960 69.3 1056 58.7 1152 48C1248 37.3 1344 26.7 1392 21.3L1440 16V80H1392C1344 80 1248 80 1152 80C1056 80 960 80 864 80C768 80 672 80 576 80C480 80 384 80 288 80C192 80 96 80 48 80H0Z" fill="#f8fafd"/>
    </svg>
</div>

<section class="section py-5" style="background: #f8fafd; margin-top: -60px; min-height: 85vh;">
    <div class="container">
        <div class="row g-4 justify-content-center rk-reveal rk-up mt-2">
            
            <!-- LEFT: Doctor Detail -->
            <div class="col-lg-5 col-md-11">
                <div id="rk-checkout-doc-card" class="h-100 shadow-lg" style="background: #223a66 !important; background: linear-gradient(135deg, #223a66 0%, #1a2744 100%) !important; border-radius: 24px; padding: 50px 30px; position: relative; overflow: hidden; color: #ffffff !important; text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 550px;">
                    <!-- Pattern overlay for extra flair -->
                    <div style="position: absolute; top: -50px; right: -50px; width: 250px; height: 250px; background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%); border-radius: 50%; z-index: 1;"></div>
                    
                    <div class="doctor-img-wrapper" style="position: relative; z-index: 5; margin-bottom: 30px;">
                        @php
                            $imagePath = file_exists(public_path($chat->dokter->gambar)) 
                                ? asset($chat->dokter->gambar) 
                                : asset('storage/' . $chat->dokter->gambar);
                        @endphp
                        <img src="{{ $imagePath }}" alt="{{ $chat->dokter->dokterName }}" class="doctor-avatar-pay" style="width: 150px; height: 150px; border-radius: 50%; border: 6px solid rgba(255,255,255,0.25); object-fit: cover; box-shadow: 0 15px 35px rgba(0,0,0,0.4); background: #fff;">
                    </div>
                    
                    <div class="doctor-info-text text-center" style="position: relative; z-index: 5;">
                        <h2 class="fw-bold mb-2" style="color: #ffffff !important; font-size: 30px; letter-spacing: -0.5px; font-family: 'Exo', sans-serif;">{{ $chat->dokter->dokterName }}</h2>
                        <p class="mb-0 fs-6" style="color: rgba(255,255,255,0.9) !important; font-weight: 500;"><i class="icofont-stethoscope me-1"></i> {{ ucwords($chat->dokter->namaBidang) }}</p>
                    </div>

                    <div class="price-box-rk text-center" style="background: rgba(0,0,0,0.2) !important; backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 30px 20px; margin-top: 30px; position: relative; z-index: 5; width: 100%;">
                        <p class="text-uppercase mb-2" style="color: rgba(255,255,255,0.6) !important; letter-spacing:2.5px; font-size:10px; font-weight: 800;">TOTAL BIAYA KONSULTASI</p>
                        <h2 class="fw-bold mb-3" style="color: #ffffff !important; font-size: 42px; font-family: 'Exo', sans-serif;">Rp {{ number_format($chat->price ?? $chat->dokter->hargaKonsultasi, 0, ',', '.') }}</h2>
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill shadow-sm" style="background: rgba(255,255,255,0.15); font-size: 13px; color: #ffffff !important; border: 1px solid rgba(255,255,255,0.1);">
                            <i class="icofont-clock-time"></i> 1 Bulan Akses Unlimited
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Payment Methods -->
            <div class="col-lg-7 col-md-11">
                <div class="payment-method-card h-100 shadow-lg" style="background: #ffffff !important; border-radius: 24px; padding: 45px; border: 1px solid rgba(0,0,0,0.05);">
                    <h4 class="fw-bold text-dark mb-4" style="font-size: 24px;">Pilih Metode Pembayaran</h4>

                    <form id="paymentForm" action="{{ route('landing.dokter.processChatPayment', $chat->chatDokterId) }}" method="POST">
                        @csrf
                        
                        <div class="payment-option">
                            <input type="radio" id="transfer" name="metodePembayaran" value="transfer" class="d-none" required checked>
                            <label for="transfer" class="payment-option-label shadow-sm">
                                <div class="payment-icon-rk"><i class="icofont-bank-transfer-alt"></i></div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Transfer Bank</h6>
                                    <p class="text-muted small mb-0">BCA, Mandiri, BNI, dll</p>
                                </div>
                                <div class="payment-check-rk"><i class="icofont-check"></i></div>
                            </label>
                        </div>

                        <div class="payment-option">
                            <input type="radio" id="kartu" name="metodePembayaran" value="kartu" class="d-none">
                            <label for="kartu" class="payment-option-label shadow-sm">
                                <div class="payment-icon-rk"><i class="icofont-credit-card"></i></div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Kartu Kredit</h6>
                                    <p class="text-muted small mb-0">Visa, Mastercard, JCB</p>
                                </div>
                                <div class="payment-check-rk"><i class="icofont-check"></i></div>
                            </label>
                        </div>

                        <div class="payment-option">
                            <input type="radio" id="ewallet" name="metodePembayaran" value="gopay" class="d-none">
                            <label for="ewallet" class="payment-option-label shadow-sm">
                                <div class="payment-icon-rk"><i class="icofont-wallet"></i></div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">E-Wallet & Digital</h6>
                                    <p class="text-muted small mb-0">GoPay, OVO, Dana, LinkAja</p>
                                </div>
                                <div class="payment-check-rk"><i class="icofont-check"></i></div>
                            </label>
                        </div>

                        <div class="alert mt-4 mb-4 border-0 d-flex align-items-center gap-3 shadow-sm rounded-4" style="background: rgba(34,58,102,0.05);">
                            <i class="icofont-lock fs-3 text-primary"></i>
                            <div>
                                <h6 class="fw-bold text-dark mb-1" style="font-size: 14px;">Pembayaran Aman</h6>
                                <p class="mb-0 text-muted" style="font-size: 13px;">Data dilindungi dengan enkripsi SSL 256-bit.</p>
                            </div>
                        </div>

                        <div class="d-flex flex-column gap-3 mt-4">
                            <button type="submit" id="submitBtn" class="btn w-100 py-3 rounded-pill fw-bold text-uppercase shadow" style="background: #e12454 !important; color: #ffffff !important; border: none; letter-spacing:1.5px; transition: all 0.3s ease;">
                                <i class="icofont-pay me-2"></i> BAYAR SEKARANG
                            </button>
                            <a href="{{ route('landing.dokter.list', ['kategori' => $chat->dokter->namaBidang]) }}" class="btn w-100 py-2 fw-bold text-uppercase" style="color: #6F8BA4 !important; font-size: 12px; letter-spacing: 1px;">
                                Batal & Kembali
                            </a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = this;
        const submitBtn = document.getElementById('submitBtn');
        const originalHTML = submitBtn.innerHTML;
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="icofont-spinner-alt-3 icofont-spin me-2"></i> Memproses...';

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: 'Pembayaran Berhasil! 🎉',
                    text: data.message,
                    icon: 'success',
                    confirmButtonText: 'Buka Chat Sekarang',
                    confirmButtonColor: '#223a66',
                    buttonsStyling: true,
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = data.redirect;
                    }
                });
            } else {
                throw new Error(data.message || 'Terjadi kesalahan saat memproses pembayaran');
            }
        })
        .catch(error => {
            Swal.fire({
                title: 'Pembayaran Gagal!',
                text: error.message,
                icon: 'error',
                confirmButtonColor: '#e12454'
            });
            
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalHTML;
        });
    });
</script>
@endpush

@endsection