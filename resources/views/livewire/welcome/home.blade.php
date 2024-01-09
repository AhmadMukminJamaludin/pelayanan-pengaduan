<x-welcome-layout>
    <!-- Header-->
    <header class="bg-primary py-5">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <div class="my-5 text-center text-xl-start">
                        <h1 class="display-8 fw-bolder text-white mb-2">SISTEM PELAYANAN PENGADUAN MASYARAKAT DESA PLESUNGAN</h1>
                        <p class="lead fw-normal text-white-50 mb-4">platform modern yang memudahkan warga untuk menyampaikan keluhan dan masukan secara efisien!</p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                            <a class="btn btn-outline-light btn-lg px-4 me-sm-3" href="{{ route('login') }}">Buat Pengaduan!</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" style="width: 300px" src="{{ asset('img/logo-karanganyar.png') }}" alt="..." /></div>
            </div>
        </div>
    </header>
    <livewire:welcome.aduan-terbaru />
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
                            <input class="form-control" type="text" placeholder="Nomor Tracking Aduan..." aria-label="Nomor Tracking Aduan..." aria-describedby="button-newsletter" />
                            <button class="btn btn-outline-light" id="button-newsletter" type="button">LACAK</button>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </section>
</x-welcome-layout>
