<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="{{ asset('img/logo-karanganyar.png') }}" sizes="32x32" />
        <link rel="shortcut icon" href="{{ asset('img/logo-karanganyar.png') }}" sizes="192x192" />

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <!-- Scripts -->
        @vite(['resources/js/app.js'])
    </head>
    {{-- <body>
        @if (Route::has('login'))
            <livewire:welcome.navigation />
        @endif
    </body> --}}
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container px-5">
                    <a class="navbar-brand" href="index.html">SIADU</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    @if (Route::has('login'))
                        <livewire:welcome.navigation />
                    @endif
                </div>
            </nav>
            <!-- Header-->
            <header class="bg-primary py-5">
                <div class="container px-5">
                    <div class="row gx-5 align-items-center justify-content-center">
                        <div class="col-lg-8 col-xl-7 col-xxl-6">
                            <div class="my-5 text-center text-xl-start">
                                <h1 class="display-8 fw-bolder text-white mb-2">SISTEM PELAYANAN PENGADUAN MASYARAKAT DESA PLESUNGAN</h1>
                                <p class="lead fw-normal text-white-50 mb-4">platform modern yang memudahkan warga untuk menyampaikan keluhan dan masukan secara efisien!</p>
                                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                                    <a class="btn btn-outline-light btn-lg px-4 me-sm-3" href="#features">Buat Pengaduan!</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" style="width: 300px" src="{{ asset('img/logo-karanganyar.png') }}" alt="..." /></div>
                    </div>
                </div>
            </header>
            <section class="py-5 bg-light">
                <div class="container px-5">
                    <div class="row gx-5">
                        <div class="col-xl-8">
                            <h2 class="fw-bolder fs-5 mb-4">ADUAN TERBARU</h2>
                            <!-- News item-->
                            <div class="mb-5">
                                <div class="small">Ahmad Mukmin Jamaludin - 28 Desember 2023</div>
                                <a class="link-dark" href="#!"><h3>Jalan Provinsi Rusak Berat</h3></a>
                                <div class="small text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto facilis consectetur eveniet et. Facilis sit magni autem. Asperiores maiores sequi earum modi beatae hic aspernatur reiciendis eaque repudiandae nulla nemo voluptatem, accusamus voluptates reprehenderit dicta minus voluptatum nesciunt cum qui consequuntur ab. Fuga, laborum deleniti?</div>
                            </div>
                            <!-- News item-->
                            <div class="mb-5">
                                <div class="small">Arwinda Septiana - 28 Desember 2023</div>
                                <a class="link-dark" href="#!"><h3>Macet</h3></a>
                                <div class="small text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto facilis consectetur eveniet et. Facilis sit magni autem. Asperiores maiores sequi earum modi beatae hic aspernatur reiciendis eaque repudiandae nulla nemo voluptatem, accusamus voluptates reprehenderit dicta minus voluptatum nesciunt cum qui consequuntur ab. Fuga, laborum deleniti?</div>
                            </div>
                            <!-- News item-->
                            <div class="mb-5">
                                <div class="small">Ahmad Mukmin Jamaludin - 28 Desember 2023</div>
                                <a class="link-dark" href="#!"><h3>Pembuangan Sampah</h3></a>
                                <div class="small text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto facilis consectetur eveniet et. Facilis sit magni autem. Asperiores maiores sequi earum modi beatae hic aspernatur reiciendis eaque repudiandae nulla nemo voluptatem, accusamus voluptates reprehenderit dicta minus voluptatum nesciunt cum qui consequuntur ab. Fuga, laborum deleniti?</div>
                            </div>
                            <div class="text-end mb-5 mb-xl-0">
                                <a class="text-decoration-none" href="#">
                                    Lihat lebih banyak
                                    <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card border-0 h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex h-100 align-items-center justify-content-center">
                                        <div class="text-center">
                                            <div class="h6 fw-bolder">Contact</div>
                                            <p class="text-muted mb-4">
                                                For press inquiries, email us at
                                                <br />
                                                <a href="#!">plesungan@kabkaranganyar.com</a>
                                            </p>
                                            <div class="h6 fw-bolder">Follow us</div>
                                            <a class="fs-5 px-2 link-dark"><i class="bi-twitter"></i></a>
                                            <a class="fs-5 px-2 link-dark"><i class="bi-facebook"></i></a>
                                            <a class="fs-5 px-2 link-dark"><i class="bi-instagram"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Blog preview section-->
            <section class="py-5">
                <div class="container px-5 my-5">
                    <!-- Call to action-->
                    <aside class="bg-primary bg-gradient rounded-3 p-4 p-sm-5 mt-5">
                        <div class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start">
                            <div class="mb-4 mb-xl-0">
                                <div class="fs-3 fw-bold text-white">CARI DAN LACAK ADUANMU DISINI</div>
                            </div>
                            <div>
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="Nomor Tiket Aduan..." aria-label="Nomor Tiket Aduan..." aria-describedby="button-newsletter" />
                                    <button class="btn btn-outline-light" id="button-newsletter" type="button">LACAK</button>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </section>
        </main>
        <!-- Footer-->
        <footer class="bg-primary py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0 text-white">Copyright &copy; SIADU 2024</div></div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
