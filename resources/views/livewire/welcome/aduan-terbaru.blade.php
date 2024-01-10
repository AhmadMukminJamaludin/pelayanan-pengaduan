<?php

use Illuminate\View\View;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Aduan;

new class extends Component {
    use WithPagination;

    public function rendering(View $view): void
    {
        $view->layout('layouts.welcome');
    }

    public function with(): array
    {
        return [
            'aduan' => Aduan::query()
                ->latest()
                ->paginate(3),
        ];
    }
}; ?>

<div>
    <section class="py-5 bg-light">
        <div class="container px-5">
            <div class="row gx-5">
                <div class="col-xl-8">
                    <h2 class="fw-bolder fs-5 mb-4">ADUAN TERBARU</h2>
                    @foreach ($aduan as $item)
                    <div class="mb-5">
                        <div class="small">{{ $item->createdBy->name }} - {{ Carbon\Carbon::create($item->created_at)->translatedFormat('j F Y, H:i') }} WIB</div>
                        <a class="link-dark" href="#!"><h3>{{ $item->judul_keluhan }}</h3></a>
                        <div class="small text-muted">{{ Str::limit($item->keluhan, 250, '...') }}</div>
                    </div>
                    @endforeach
                    <div class="text-end mb-5 mb-xl-0">
                        <a class="text-decoration-none" href="{{ route('welcome.daftar-aduan') }}">
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
</div>
