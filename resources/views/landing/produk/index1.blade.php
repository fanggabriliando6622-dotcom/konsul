@extends('layouts.app')

@section('title', 'Produk | RuangKonsul')

@section('meta_description', 'RuangKonsul - Konsultasi kesehatan online profesional')

@section('content')

<!-- ===== HERO ===== -->
<section class="rk-hero">
    <div class="rk-hero-dots">
        <span></span><span></span><span></span><span></span>
    </div>
    <div class="container">
        <div class="rk-hero-inner">
            <div class="rk-hero-badge">
                <i class="icofont-heartbeat"></i> Produk
            </div>
            <h1>Produk Kesehatan <span>RuangKonsul</span></h1>
            <p class="rk-hero-desc">Beragam solusi kesehatan terpercaya untuk mendukung kesejahteraan mental, fisik, dan keluarga Anda.</p>
        </div>
    </div>
</section>

<div class="rk-wave">
    <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 80L48 74.7C96 69.3 192 58.7 288 53.3C384 48 480 48 576 53.3C672 58.7 768 69.3 864 69.3C960 69.3 1056 58.7 1152 48C1248 37.3 1344 26.7 1392 21.3L1440 16V80H1392C1344 80 1248 80 1152 80C1056 80 960 80 864 80C768 80 672 80 576 80C480 80 384 80 288 80C192 80 96 80 48 80H0Z" fill="white"/>
    </svg>
</div>

<!-- ===== PRODUK ===== -->
<section class="section py-5">
  <div class="container">

    <!-- FILTER -->
    <div class="filter-menu">
      <button class="active" data-filter="all">Semua</button>
      @foreach($kategoris as $kategori)
        @php
          $filterClass = '';
          switch($kategori->kategoriId) {
            case 'K0001':
              $filterClass = 'mental';
              break;
            case 'K0002':
              $filterClass = 'seksual';
              break;
            case 'K0003':
              $filterClass = 'parenting';
              break;
            case 'K0004':
              $filterClass = 'lifestyle';
              break;
            case 'K0005':
              $filterClass = 'kronis';
              break;
            case 'K0006':
              $filterClass = 'nutrisi';
              break;
            default:
              $filterClass = strtolower(str_replace([' ', '&'], ['', ''], $kategori->kategoriName));
          }
        @endphp
        <button data-filter="{{ $filterClass }}">{{ $kategori->kategoriName }}</button>
      @endforeach
    </div>

    <div class="row" id="product-list">

      @forelse($kategoris as $kategori)
        @php
          $filterClass = '';
          $iconClass = '';
          $description = '';
          
          switch($kategori->kategoriId) {
            case 'K0001':
              $filterClass = 'mental';
              $iconClass = 'icofont-brain-alt text-lg';
              $description = 'Menyediakan berbagai jenis produk untuk kesehatan mental.';
              break;
            case 'K0002':
              $filterClass = 'seksual';
              $iconClass = 'icofont-heart-beat';
              $description = 'Menyediakan berbagai jenis obat-obatan dan alat-alat untuk membantu memelihara dan merawat kesehatan seksual.';
              break;
            case 'K0003':
              $filterClass = 'parenting';
              $iconClass = 'icofont-baby';
              $description = 'Menyediakan produk ibu & anak untuk memelihara kesehatan ibu & anak.';
              break;
            case 'K0004':
              $filterClass = 'lifestyle';
              $iconClass = 'icofont-runner-alt-1';
              $description = 'Terdapat produk berupa suplemen dan obat-obat untuk memelihara kesehatan tubuh.';
              break;
            case 'K0005':
              $filterClass = 'kronis';
              $iconClass = 'icofont-medical-sign-alt';
              $description = 'Terdapat beberapa jenis obat-obatan untuk penyakit kronis dan alat untuk membantu Anda apabila terkena penyakit kronis.';
              break;
            case 'K0006':
              $filterClass = 'nutrisi';
              $iconClass = 'icofont-apple';
              $description = 'Menyediakan produk yang dapat membantu memelihara kesehatan tubuh dan gizi dan nutrisi terpenuhi.';
              break;
            default:
              $filterClass = strtolower(str_replace([' ', '&'], ['', ''], $kategori->kategoriName));
              $iconClass = 'icofont-medical-sign';
              $description = 'Produk kesehatan berkualitas untuk kebutuhan Anda.';
          }
        @endphp

        <!-- {{ $kategori->kategoriName }} -->
        <div class="col-lg-4 col-md-6 mb-4 product-item {{ $filterClass }} rk-reveal rk-up rk-stagger" style="--s:{{ $loop->index % 6 }};">
          <div class="product-card">
            <div class="product-icon"><i class="{{ $iconClass }}"></i></div>
            <h4>{{ $kategori->kategoriName }}</h4>
            <p>{{ $description }}</p>
            <a href="{{ route('detailproduk.show', $kategori->kategoriId) }}" class="btn btn-detail">Lihat Detail</a>
          </div>
        </div>
      @empty
        <div class="col-12 text-center py-5">
          <h4>Belum ada kategori produk tersedia</h4>
          <p>Kategori produk akan segera ditambahkan</p>
        </div>
      @endforelse

    </div>
  </div>
</section>

@push('scripts')
<script>
  // Filter functionality
  document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-menu button');
    const productItems = document.querySelectorAll('.product-item');

    filterButtons.forEach(button => {
      button.addEventListener('click', function() {
        // Remove active class from all buttons
        filterButtons.forEach(btn => btn.classList.remove('active'));
        // Add active class to clicked button
        this.classList.add('active');

        const filter = this.getAttribute('data-filter');

        productItems.forEach(item => {
          if (filter === 'all' || item.classList.contains(filter)) {
            item.style.display = 'block';
            setTimeout(() => {
              item.style.opacity = '1';
              item.style.transform = 'scale(1)';
            }, 10);
          } else {
            item.style.opacity = '0';
            item.style.transform = 'scale(0.9)';
            setTimeout(() => {
              item.style.display = 'none';
            }, 300);
          }
        });
      });
    });

    // Initialize all items as visible with transition
    productItems.forEach(item => {
      item.style.transition = 'all 0.3s ease';
      item.style.opacity = '1';
      item.style.transform = 'scale(1)';
    });
  });
</script>
@endpush

@endsection