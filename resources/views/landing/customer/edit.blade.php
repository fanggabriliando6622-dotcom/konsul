@extends('layouts.app')

@section('title', 'Edit Profil | RuangKonsul')

@section('content')

<!-- ===== HERO ===== -->
<section class="rk-hero">
    <div class="rk-hero-dots">
        <span></span><span></span><span></span><span></span>
    </div>
    <div class="container">
        <div class="rk-hero-inner">
            <div class="rk-hero-badge">
                <i class="icofont-ui-edit"></i> Edit Profil
            </div>
            <h1>Edit <span>Profil</span></h1>
            <p class="rk-hero-desc">Perbarui data diri, alamat, dan informasi akun Anda</p>
        </div>
    </div>
</section>

<div class="rk-wave">
    <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 80L48 74.7C96 69.3 192 58.7 288 53.3C384 48 480 48 576 53.3C672 58.7 768 69.3 864 69.3C960 69.3 1056 58.7 1152 48C1248 37.3 1344 26.7 1392 21.3L1440 16V80H1392C1344 80 1248 80 1152 80C1056 80 960 80 864 80C768 80 672 80 576 80C480 80 384 80 288 80C192 80 96 80 48 80H0Z" fill="#f8f9fa"/>
    </svg>
</div>

<section class="section py-5 bg-light" style="margin-top: -60px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 rk-reveal rk-up">
                <div class="card profile-card border-0 shadow-sm rounded-4 overflow-hidden p-0">
                    <div class="card-body p-0">
                        
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="edit-profile-form">
                            @csrf
                            @method('PUT')

                            <div class="row g-0">
                                <!-- LEFT COLUMN: Avatar & Security -->
                                <div class="col-md-4 bg-light-rk p-4 p-md-5 border-end">
                                    <div class="text-center mb-5">
                                        <label for="avatarUpload" class="cursor-pointer position-relative avatar-edit-wrapper">
                                            @if($customer->avatar)
                                                <img id="avatarPreview" src="{{ asset($customer->avatar) }}" alt="Avatar" class="profile-avatar shadow-sm mb-3">
                                            @else
                                                <div id="avatarPlaceholder" class="profile-avatar shadow-sm d-flex align-items-center justify-content-center mb-3 mx-auto" 
                                                     style="background: linear-gradient(135deg, #223a66, #e12454); color: white; font-size: 48px; font-weight: bold;">
                                                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                                                </div>
                                                <img id="avatarPreview" src="#" alt="Avatar" class="profile-avatar shadow-sm mb-3 d-none">
                                            @endif
                                            
                                            <div class="avatar-edit-icon" data-bs-toggle="tooltip" title="Ganti Foto">
                                                <i class="icofont-camera"></i>
                                            </div>
                                        </label>
                                        <input type="file" id="avatarUpload" name="avatar" class="d-none" accept="image/*" onchange="previewImage(this);">
                                        
                                        <h5 class="fw-bold text-primary-rk mt-2 mb-1">{{ $customer->name }}</h5>
                                        <p class="text-muted small">Maksimal ukuran file 2MB <br>(JPG, JPEG, PNG)</p>
                                    </div>

                                    <hr class="my-4" style="border-color: #dde3ec;">

                                    <h6 class="fw-bold text-primary-rk mb-3"><i class="icofont-lock text-accent-rk me-2"></i> Keamanan Akun</h6>
                                    <p class="text-muted small mb-3">Isi kolom di bawah ini hanya jika Anda ingin mengganti kata sandi (password) lama Anda.</p>
                                    
                                    <div class="form-group mb-3 custom-input">
                                        <label class="form-label small text-muted fw-bold">Password Baru</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="icofont-key text-primary-rk"></i></span>
                                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diganti">
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 custom-input">
                                        <label class="form-label small text-muted fw-bold">Konfirmasi Password Baru</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="icofont-key text-primary-rk"></i></span>
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                                        </div>
                                    </div>
                                </div>

                                <!-- RIGHT COLUMN: Personal Details -->
                                <div class="col-md-8 p-4 p-md-5 bg-white">
                                    <h5 class="fw-bold text-primary-rk border-bottom pb-3 mb-4">
                                        <i class="icofont-user-alt-3 text-accent-rk me-2"></i> Detail Informasi Personal
                                    </h5>

                                    @if($errors->any())
                                        <div class="alert alert-danger mb-4" style="border-radius: 10px;">
                                            <ul class="mb-0 small ps-3">
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="row g-4">
                                        <!-- Nama & Email -->
                                        <div class="col-md-6">
                                            <div class="form-group custom-input">
                                                <label class="form-label small text-muted fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                                <input type="text" name="name" value="{{ old('name', $customer->name) }}" class="form-control form-control-lg" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group custom-input">
                                                <label class="form-label small text-muted fw-bold">Alamat Email <span class="text-danger">*</span></label>
                                                <input type="email" name="email" value="{{ old('email', $customer->email) }}" class="form-control form-control-lg" required>
                                            </div>
                                        </div>

                                        <!-- Phone & Gender -->
                                        <div class="col-md-6">
                                            <div class="form-group custom-input">
                                                <label class="form-label small text-muted fw-bold">Nomor Telepon</label>
                                                <input type="text" name="phone" value="{{ old('phone', $customer->customerNoTelp) }}" class="form-control form-control-lg" placeholder="08xxxxxxxxxx">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group custom-input">
                                                <label class="form-label small text-muted fw-bold">Jenis Kelamin</label>
                                                <select name="gender" class="form-select form-control-lg">
                                                    <option value="">Pilih Jenis Kelamin</option>
                                                    <option value="Laki-laki" {{ old('gender', $customer->customerJenisKelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                    <option value="Perempuan" {{ old('gender', $customer->customerJenisKelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Address -->
                                        <div class="col-12">
                                            <div class="form-group custom-input">
                                                <label class="form-label small text-muted fw-bold">Alamat Lengkap (Domisili)</label>
                                                <textarea name="address" class="form-control" rows="3" placeholder="Masukkan alamat pengiriman utama Anda">{{ old('address', $customer->alamat) }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column flex-sm-row justify-content-end gap-3 mt-5 border-top pt-4">
                                        <a href="{{ route('landing.customer.profile') }}" class="btn btn-outline-secondary px-4 py-2 rounded-pill fw-bold">Batal</a>
                                        <button type="submit" class="btn btn-main px-5 py-2 rounded-pill shadow-sm">
                                            <i class="icofont-save me-2"></i> Simpan Perubahan
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    :root {
        --rk-primary: #223a66;
        --rk-accent: #e12454;
        --rk-bg-light: #f8fafd;
    }
    .text-primary-rk { color: var(--rk-primary) !important; }
    .text-accent-rk { color: var(--rk-accent) !important; }
    .bg-light-rk { background-color: var(--rk-bg-light); }

    /* Header Banner Removed, using shared rk-hero */

    .profile-card {
        border-radius: 16px;
        border: 1px solid rgba(0,0,0,0.03) !important;
        box-shadow: 0 15px 35px rgba(34,58,102,0.08) !important;
    }

    /* Avatar Edit */
    .avatar-edit-wrapper {
        display: inline-block;
        width: 140px; height: 140px;
        border-radius: 50%;
        margin: 0 auto;
        position: relative;
    }
    .profile-avatar {
        width: 140px; height: 140px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        transition: opacity 0.3s;
    }
    .avatar-edit-wrapper:hover .profile-avatar {
        opacity: 0.8;
    }
    .avatar-edit-icon {
        position: absolute;
        bottom: 5px; right: 5px;
        width: 40px; height: 40px;
        background: var(--rk-accent);
        color: white;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        border: 3px solid white;
        font-size: 18px;
        transition: transform 0.2s, background 0.3s;
        box-shadow: 0 4px 10px rgba(225,36,84,0.3);
    }
    .avatar-edit-wrapper:hover .avatar-edit-icon {
        background: #c91d47;
        transform: scale(1.1);
    }
    .cursor-pointer { cursor: pointer; }

    /* Custom Form Inputs */
    .custom-input .form-label {
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 11px;
    }
    .custom-input .form-control, .custom-input .form-select, .custom-input .input-group-text {
        background-color: #fcfdfe;
        border: 1px solid #dde3ec;
        border-radius: 8px;
        color: #333;
        font-weight: 500;
        transition: all 0.25s ease;
    }
    .custom-input .form-control:focus, .custom-input .form-select:focus {
        border-color: var(--rk-primary);
        box-shadow: 0 0 0 4px rgba(34, 58, 102, 0.08);
        background-color: #fff;
    }
    .custom-input textarea.form-control { resize: none; }
    .custom-input .input-group-text { border-right: none; }
    .custom-input .input-group .form-control { border-left: none; padding-left: 0; }
    .custom-input .input-group .form-control:focus { box-shadow: none; border-color: #dde3ec; }
    .custom-input .input-group:focus-within {
        border-radius: 8px;
        box-shadow: 0 0 0 4px rgba(34, 58, 102, 0.08);
    }
    .custom-input .input-group:focus-within .form-control, .custom-input .input-group:focus-within .input-group-text {
        border-color: var(--rk-primary);
    }

    .btn-main {
        background: linear-gradient(135deg, var(--rk-primary), #2b4c7e);
        border: none;
        color: white;
        transition: all 0.3s;
    }
    .btn-main:hover {
        background: linear-gradient(135deg, var(--rk-accent), #f23d6a);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(225, 36, 84, 0.3) !important;
    }
</style>
@endpush

@push('scripts')
<script>
    function previewImage(input) {
        var placeholder = document.getElementById('avatarPlaceholder');
        var preview = document.getElementById('avatarPreview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                if(placeholder) placeholder.classList.add('d-none');
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection
