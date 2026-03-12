<footer class="footer section gray-bg">
	<div class="container">
		<div class="row">

			<!-- BRAND -->
			<div class="col-lg-4 col-sm-6 mb-4">
				<div class="widget">
					<div class="logo mb-3">
						<img src="{{ asset('images/produk/Logo landing page.png') }}" alt="RuangKonsul" class="img-fluid" style="max-width:180px;">
					</div>
					<p>
						RuangKonsul adalah platform konsultasi kesehatan terpercaya
						yang membantu Anda mendapatkan solusi terbaik secara aman,
						profesional, dan nyaman.
					</p>

					<ul class="list-inline footer-socials mt-4">
						<li class="list-inline-item">
						 <a href="https://www.tiktok.com/@ruangkonsul0220/  " target="_blank">
						 <i class="fa-brands fa-tiktok"></i>
						 </a>
						</li>
						<li class="list-inline-item">
							<a href="https://www.instagram.com/ruangkonsul0220/" target="_blank">
								<i class="icofont-instagram"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="https://wa.me/6285643050274" target="_blank">
								<i class="icofont-whatsapp"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>

			<!-- LAYANAN -->
			<div class="col-lg-2 col-md-6 col-sm-6 mb-4">
				<div class="widget">
					<h4 class="mb-3">Layanan</h4>
					<div class="divider mb-4"></div>
					<ul class="list-unstyled footer-menu">
						<li><a href="{{ route('detailproduk.show', 'K0001') }}">Kesehatan Mental</a></li>
						<li><a href="{{ route('detailproduk.show', 'K0002') }}">Kesehatan Seksual</a></li>
						<li><a href="{{ route('detailproduk.show', 'K0003') }}">Ibu dan Anak</a></li>
						<li><a href="{{ route('detailproduk.show', 'K0004') }}">Gaya Hidup Sehat</a></li>
						<li><a href="{{ route('detailproduk.show', 'K0005') }}">Penyakit Kronis</a></li>
						<li><a href="{{ route('detailproduk.show', 'K0006') }}">Gizi & Nutrisi</a></li>
					</ul>
				</div>
			</div>

			<!-- BANTUAN -->
			<div class="col-lg-2 col-md-6 col-sm-6 mb-4">
				<div class="widget">
					<h4 class="mb-3">Bantuan</h4>
					<div class="divider mb-4"></div>
					<ul class="list-unstyled footer-menu">
						<li><a href="{{ url('/penjelasan') }}">Tentang Kami</a></li>
						<li><a href="{{ route('privacy') }}">Kebijakan Privasi</a></li>
						<li><a href="{{ route('terms') }}">Syarat & Ketentuan</a></li>
						<li><a href="{{ url('/kontak') }}">Kontak</a></li>
					</ul>
				</div>
			</div>

			<!-- KONTAK -->
			<div class="col-lg-4 col-md-6 col-sm-6 mb-4">
				<div class="widget widget-contact">
					<h4 class="mb-3">Hubungi Kami</h4>
					<div class="divider mb-4"></div>

					<div class="footer-contact-block mb-3">
						<i class="icofont-email mr-2"></i>
						<span>ruangkonsul0220@gmail.com</span>
					</div>

					<div class="footer-contact-block mb-3">
						<i class="icofont-phone mr-2"></i>
						<span>0856-4305-0274</span>
					</div>

					<div class="footer-contact-block">
						<i class="icofont-location-pin mr-2"></i>
						<span>Semarang, Jawa Tengah</span>
					</div>
				</div>
			</div>

		</div>

		<!-- COPYRIGHT -->
		<div class="footer-btm pt-4 mt-4 border-top">
			<div class="row align-items-center">
				<div class="col-md-6">
					<p class="mb-0">
						© <span id="year"></span> RuangKonsul. All rights reserved.
					</p>
				</div>
				<div class="col-md-6 text-md-right mt-3 mt-md-0">
					<!-- back-to-top button removed -->
				</div>
			</div>
		</div>
	</div>
</footer>
	@include('landing.chatboot.ai')	