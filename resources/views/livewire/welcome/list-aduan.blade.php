<?php

use Illuminate\View\View;
use Carbon\Carbon;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Aduan;

new class extends Component {
    use WithPagination;

    public string $no_tracking = '';
    public ?Aduan $showing = null;

    public function rendering(View $view): void
    {
        $view->layout('layouts.welcome');
    }

    public function with(): array
    {
        return [
            'aduan' => Aduan::query()
                ->when($this->no_tracking, function ($query) {
                    $query->where('no_tracking', 'LIKE', ["%$this->no_tracking%"]);
                })
                ->latest()
                ->paginate(2),
        ];
    }

    public function edit(Aduan $aduan): void
    {
        $this->showing = $aduan;
    }
};
?>

<div>
    @if ($showing)
        <livewire:welcome.detail-aduan :showing="$showing" />
    @else
        <!-- Call to action-->
        <aside class="bg-primary bg-gradient rounded-3 p-4 p-sm-5 my-5">
            <div class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start">
                <div class="mb-4 mb-xl-0">
                    <div class="fs-3 fw-bold text-white">CARI DAN LACAK ADUANMU DISINI</div>
                </div>
                <div>
                    <div class="input-group">
                        <input class="form-control" type="text" wire:model.live="no_tracking" placeholder="Nomor Tiket Aduan..." aria-label="Nomor Tiket Aduan..." aria-describedby="button-newsletter" />
                        <button class="btn btn-outline-light" id="button-newsletter" type="button">LACAK</button>
                    </div>
                </div>
            </div>
        </aside>
        @foreach ($aduan as $item)
            <div class="row gx-5">
                <div class="col mb-5">
                    <div class="card h-100 shadow border-0">
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{ $item->status }}</div>
                            <a class="text-decoration-none link-dark stretched-link" wire:click="edit({{ $item->id }})"><div class="h5 card-title mb-3">{{ $item->judul_keluhan }}</div></a>
                            <p class="card-text mb-0">{{ $item->keluhan }}</p>
                        </div>
                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d" alt="..." />
                                    <div class="small">
                                        <div class="fw-bold">{{ $item->createdBy->name }}</div>
                                        <div class="text-muted">{{ Carbon::create($item->created_at)->translatedFormat('j F Y, H:i') }} WIB <div class="badge bg-primary bg-gradient rounded-pill">{{ $item->kategori }}</div></div>
                                        <div class="text-muted">No. Tracking: {{ $item->no_tracking }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="d-flex justify-content-between">
            @if ($aduan->previousPageUrl())
            <div class="text-start mb-5 mb-xl-0">
                <a class="text-decoration-none" href="{{ $aduan->previousPageUrl() }}">
                    <i class="bi bi-arrow-left ms-2"></i>
                    Sebelumnya
                </a>
            </div>
            @else
            <div class="text-start mb-5 mb-xl-0">
                <a class="text-muted" type="button" disabled>

                </a>
            </div>
            @endif
            @if ($aduan->nextPageUrl())
            <div class="text-end mb-5 mb-xl-0">
                <a class="text-decoration-none" href="{{ $aduan->nextPageUrl() }}">
                    Selanjutnya
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
            @else
            <div class="text-end mb-5 mb-xl-0">
                <a class="text-muted" type="button" disabled>

                </a>
            </div>
            @endif
        </div>
    @endif
</div>
