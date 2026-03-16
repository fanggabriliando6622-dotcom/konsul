<header>

    <!-- ================= TOP BAR ================= -->
    <div class="header-top-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <ul class="top-bar-info list-inline-item pl-0 mb-0">
                        <li class="list-inline-item">
                            <a href="mailto:ruangkonsul@gmail.com">
                                <i class="icofont-support-faq mr-2"></i>
                                ruangkonsul0220@gmail.com
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <i class="icofont-location-pin mr-2"></i>
                            Jl. Kanal No. 5a Lamper Lor, Semarang
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <a href="tel:+6285643050274" style="color: white;">
                        <span style="color: white;">Call Now : </span>
                        <span class="h4" style="color: white;">0856-4305-0274</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= NAVBAR ================= -->
    <nav class="navbar navbar-expand-lg navigation">
        <div class="container">

            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/produk/Logo landing page.png') }}" class="img-fluid">
            </a>

            <button class="navbar-toggler" type="button"
                    data-toggle="collapse"
                    data-target="#navbarmain"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarmain">
                <span class="icofont-navigation-menu"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarmain">

                <ul class="navbar-nav ml-auto">

                    @foreach ($menus as $menu)
                        @if (isset($menu['dropdown']))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle"
                                   href="#"
                                   data-toggle="dropdown"
                                   data-bs-toggle="dropdown">
                                    {{ $menu['title'] }}
                                </a>
                                <div class="dropdown-menu">
                                    @foreach ($menu['dropdown'] as $sub)
                                        <a class="dropdown-item" href="{{ url($sub['url']) }}">
                                            {{ $sub['title'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ isset($menu['route']) ? route($menu['route']) : url($menu['url']) }}">
                                    {{ $menu['title'] }}
                                </a>
                            </li>
                        @endif
                    @endforeach

                </ul>

                <!-- ================= RIGHT SECTION ================= -->
                <div class="ml-auto d-flex align-items-center">

                    <!-- ===== CART ICON ===== -->
                    <div class="dropdown mr-3">

                        <!-- ICON -->
                        <a href="{{ route('cart.index') }}"
                           class="position-relative"
                           data-toggle="dropdown"
                           data-bs-toggle="dropdown"
                           onclick="event.stopPropagation();">

                            <i class="icofont-cart"
                               style="font-size:24px; color:#1F4C8F;"></i>

                            <span id="cart-count"
                                  style="
                                    position:absolute;
                                    top:-8px;
                                    right:-10px;
                                    background:#E63946;
                                    color:white;
                                    font-size:12px;
                                    padding:3px 7px;
                                    border-radius:50%;
                                    font-weight:600;">
                                @auth('customer')
                                    {{ \App\Models\Cart::where('customerId', Auth::guard('customer')->user()->customerId)->sum('qty') }}
                                @else
                                    {{ session('cart') ? collect(session('cart'))->sum('quantity') : 0 }}
                                @endauth
                            </span>
                        </a>

                        <!-- MINI CART -->
                        <div class="dropdown-menu dropdown-menu-right p-3"
                             style="width:320px; max-height:400px; overflow-y:auto;">

                            <h6 class="mb-3">Keranjang Saya</h6>

                            @auth('customer')
                                @php
                                    $cartItems = \App\Models\Cart::where('customerId', Auth::guard('customer')->user()->customerId)
                                        ->with('produk')
                                        ->get();
                                @endphp

                                @forelse($cartItems as $item)
                                    <div class="d-flex mb-3 border-bottom pb-2">
                                        <div style="width:50px; height:50px;">
                                            <img src="{{ asset($item->produk->gambar ?? 'images/no-image.png') }}"
                                                 style="width:100%; height:100%; object-fit:cover;">
                                        </div>

                                        <div class="ml-2 flex-grow-1">
                                            <small>{{ $item->produk->produkName ?? '' }}</small>
                                            <div>
                                                <small>
                                                    {{ $item->qty }} x
                                                    Rp {{ number_format($item->produk->price ?? 0,0,',','.') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted mb-0">Keranjang kosong</p>
                                @endforelse
                            @else
                                @if(session('cart') && count(session('cart')) > 0)
                                    @foreach(session('cart') as $item)
                                        <div class="d-flex mb-3 border-bottom pb-2">
                                            <div style="width:50px; height:50px;">
                                                <img src="{{ asset($item['gambar'] ?? 'images/no-image.png') }}"
                                                     style="width:100%; height:100%; object-fit:cover;">
                                            </div>

                                            <div class="ml-2 flex-grow-1">
                                                <small>{{ $item['name'] }}</small>
                                                <div>
                                                    <small>
                                                        {{ $item['quantity'] }} x
                                                        Rp {{ number_format($item['price'],0,',','.') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-muted mb-0">Keranjang kosong</p>
                                @endif
                            @endauth

                            <a href="{{ route('cart.index') }}"
                               class="btn btn-primary btn-sm btn-block mt-3">
                                Lihat Keranjang
                            </a>

                        </div>
                    </div>

                    <!-- ===== LOGIN / PROFILE ===== -->
                    @auth('customer')
                        @php $authCustomer = Auth::guard('customer')->user(); @endphp
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle rounded-pill"
                               data-toggle="dropdown"
                               style="gap: 8px; border: 2px solid #223a66; padding: 4px 16px 4px 4px; background: rgba(34, 58, 102, 0.05); transition: all 0.3s ease;">
                                
                                @if($authCustomer->avatar)
                                    <img src="{{ asset($authCustomer->avatar) }}"
                                         alt="{{ $authCustomer->customerName }}"
                                         style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
                                @else
                                    <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #223a66, #e12454); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 14px;">
                                        {{ strtoupper(substr($authCustomer->customerName, 0, 1)) }}
                                    </div>
                                @endif
                                
                                <span style="font-weight: 700; color: #223a66; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">
                                    {{ $authCustomer->customerName }}
                                </span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" style="border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.15); border: none; min-width: 240px; padding: 12px 0; margin-top: 10px;">
                                <div style="padding: 12px 20px; border-bottom: 1px solid #f0f0f0; margin-bottom: 8px;">
                                    <div style="font-weight:700; color:#223a66; font-size:15px;">{{ $authCustomer->customerName }}</div>
                                    <div style="font-size:13px; color:#6F8BA4;">{{ $authCustomer->customerEmail }}</div>
                                </div>
                                <a href="{{ route('landing.customer.profile') }}" class="dropdown-item" style="padding: 10px 20px; font-size: 14px; font-weight: 500;">
                                    <i class="icofont-ui-user mr-3" style="color:#223a66; font-size: 18px;"></i> Profil Saya
                                </a>
                                <a href="{{ route('order.history') }}" class="dropdown-item" style="padding: 10px 20px; font-size: 14px; font-weight: 500;">
                                    <i class="icofont-listing-box mr-3" style="color:#223a66; font-size: 18px;"></i> Riwayat Pesanan
                                </a>
                                <div style="border-top: 1px solid #f0f0f0; margin-top: 8px; padding-top: 8px;">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item" style="padding: 10px 20px; font-size: 14px; font-weight: 500; color: #e12454;">
                                            <i class="icofont-logout mr-3" style="font-size: 18px;"></i> Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                           class="btn btn-login-sm">
                            Login
                        </a>
                    @endauth

                </div>

            </div>
        </div>
    </nav>
</header>

@if(session('welcome') && Auth::guard('customer')->check())
    <div id="welcomeToast" style="position:fixed;top:90px;right:20px;z-index:2000;">
        <div style="background:linear-gradient(135deg,#223a66,#2b4c7e);color:white;padding:14px 18px;border-radius:12px;box-shadow:0 12px 30px rgba(34,58,102,0.25);min-width:260px;display:flex;align-items:center;gap:12px;">
            <div style="font-size:22px;">👋</div>
            <div style="flex:1">
                <div style="font-weight:700;font-size:15px;">Selamat datang, {{ Auth::guard('customer')->user()->customerName }}!</div>
                <div style="font-size:13px;opacity:0.9;margin-top:4px;">Senang melihat Anda kembali. Lanjutkan kebutuhan kesehatan Anda.</div>
            </div>
            <button id="welcomeClose" style="background:transparent;border:none;color:rgba(255,255,255,0.9);font-size:18px;cursor:pointer;">✖</button>
        </div>
    </div>

    <style>
        #welcomeToast { animation: rk-slide-in 450ms cubic-bezier(.2,.9,.3,1); }
        #welcomeToast.hide { animation: rk-slide-out 350ms forwards cubic-bezier(.2,.9,.3,1); }
        @keyframes rk-slide-in { from { transform: translateY(-8px); opacity:0 } to { transform: translateY(0); opacity:1 } }
        @keyframes rk-slide-out { from { transform: translateY(0); opacity:1 } to { transform: translateY(-8px); opacity:0 } }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            var el = document.getElementById('welcomeToast');
            var btn = document.getElementById('welcomeClose');
            if(!el) return;
            var t = setTimeout(function(){ el.classList.add('hide'); }, 5000);
            el.addEventListener('animationend', function(e){ if(el.classList.contains('hide')) el.remove(); });
            btn.addEventListener('click', function(){ clearTimeout(t); el.classList.add('hide'); });
        });
    </script>

@endif