<?php

use Illuminate\View\View;
use Carbon\Carbon;
use Livewire\Volt\Component;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;
use App\Models\Aduan;
use App\Models\Respon;

new class extends Component {
    use WithPagination;

    #[Rule('required|string|max:255')]
    public string $respon_text = '';

    #[Rule('required|string|max:255')]
    public string $status_respon = '';

    public string $no_tracking = '';

    public string $nama = '';

    public array $listStatusRespon = [
        'Proses' => 'Proses',
        'Pengerjaan' => 'Pengerjaan',
        'Selesai' => 'Selesai',
        'Ditolak' => 'Ditolak',
    ];

    public ?Aduan $aduanSelected;

    public ?Respon $responSelected;

    public function rendering(View $view): void
    {
        $view->layout('layouts.app');
    }

    public function with(): array
    {
        return [
            'aduan' => Aduan::query()
                ->with('responLatest')
                ->when(!auth()->user()->hasRole('admin'), function ($query) {
                    $query->where('created_by', auth()->id());
                })
                ->when($this->no_tracking, fn ($q) => $q->where('no_tracking', $this->no_tracking))
                ->when($this->nama, fn ($q) => $q->whereHas('createdBy', fn ($que) => $que->where('name', 'LIKE', ["%$this->nama%"])))
                ->latest()
                ->paginate(3),
        ];
    }

    public function selectedAduan(Aduan $aduan): void
    {
        $this->aduanSelected = $aduan;
    }

    public function selectedRespon(Respon $respon): void
    {
        $this->responSelected = $respon;
        $this->respon_text = $respon->respon_text;
        $this->status_respon = $respon->status_respon;
    }

    public function sendRespon(): void
    {
        $validated = $this->validate();
        $respon = $this->aduanSelected->respon()->where('status_respon', $validated['status_respon'])->latest()->first();
        if (is_null($respon)) {
            $this->aduanSelected->respon()->create($validated);
        } else {
            $respon->update($validated);
        }
        $this->aduanSelected = new Aduan();
        $this->reset('respon_text', 'status_respon');
        $this->with();
    }

    public function updateRespon(): void
    {
        $validated = $this->validate();
        $this->responSelected->update($validated);
        $this->responSelected = new Respon();
        $this->reset('respon_text', 'status_respon');
        $this->with();
    }

    public function HapusRespon(Respon $respon): void
    {
        $respon->delete();
        $this->with();
    }

    public function cancelRespon(): void
    {
        $this->aduanSelected = new Aduan();
        $this->responSelected = new Respon();
        $this->reset('respon_text', 'status_respon');
    }
};
?>

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Aduan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form wire:submit='with' class="p-0 flex justify-between align-middle">
                <div>
                    <div class="flex justify-between items-end">
                        <div class="me-3">
                            <x-input-label for="no_tracking" :value="__('No. Tracking')" />
                            <x-text-input wire:model="no_tracking" id="respon" name="respon" type="respon" class="mt-1 block w-full me-3" autocomplete="respon" />
                        </div>
                        <div class="me-3">
                            <x-input-label for="nama" :value="__('Nama')" />
                            <x-text-input wire:model="nama" id="respon" name="respon" type="respon" class="mt-1 block w-full me-3" autocomplete="respon" />
                        </div>
                    </div>
                </div>
                <div>
                    <x-primary-button class="me-2">{{ __('Cari') }}</x-primary-button>
                </div>
                <x-action-message class="me-3" on="success">
                    {{ __('Berhasil Disimpan.') }}
                </x-action-message>
            </form>
            @foreach ($aduan as $item)
                <div class="my-2 bg-white shadow-sm rounded-lg divide-y">
                    <div class="p-6 flex space-x-2" wire:key="{{ $item->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="ms-2 text-gray-800">{{ $item->createdBy->name }} - </span>
                                    <small class="ml-2 text-sm text-gray-600">{{ Carbon::create($item->created_at)->translatedFormat('j F Y, H:i') }} WIB</small> ({{ ($item->responLatest) ? $item->responLatest->status_respon : "Diterima" }})<br>
                                    <small class="ml-2 text-sm text-gray-600">No. Tracking: {{ $item->no_tracking }}</small>
                                    @unless ($item->created_at->eq($item->updated_at))
                                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                    @endunless
                                </div>
                                @if (auth()->user()->hasRole('admin'))
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown-link wire:click="selectedAduan({{ $item->id }})">
                                                {{ __('Kirim Respon') }}
                                            </x-dropdown-link>
                                        </x-slot>
                                    </x-dropdown>
                                @endif
                            </div>
                            <p class="mt-4 text-xl font-semibold text-gray-900">{{ $item->judul_keluhan }}</p>
                            <p class="mt-4 text-lg text-gray-900">{{ $item->keluhan }}</p>
                            <div @class(['mt-4 space-y-4', 'border border-blue-500 mb-4 rounded-md' => count($item->respon)])>
                                @if(auth()->user()->hasRole('admin'))
                                    @if ($item->is($aduanSelected))
                                        <form wire:submit="sendRespon()" method="post" :key="$item->id" class="p-6 space-y-6">
                                            <div>
                                                <x-input-label for="Respon" :value="__('Respon')" />
                                                <x-textarea-input wire:model="respon_text" id="respon" name="respon" type="respon" class="mt-1 block w-full" autocomplete="respon" />
                                            </div>
                                            <div>
                                                <x-input-label for="status_respon" :value="__('Status Respon')" />
                                                <x-select-input :options="$listStatusRespon" wire:model="status_respon" id="status_respon" name="status_respon" type="status_respon" class="mt-1 block w-full" autocomplete="status_respon" />
                                                <x-input-error :messages="$errors->get('status_respon')" class="mt-2" />
                                            </div>
                                            <x-primary-button class="me-2">{{ __('Kirim Respon') }}</x-primary-button>
                                            <x-secondary-button wire:click='cancelRespon()'>{{ __('Batal') }}</x-secondary-button>

                                            <x-action-message class="me-3" on="success">
                                                {{ __('Berhasil Disimpan.') }}
                                            </x-action-message>
                                        </form>
                                    @endif
                                @endif
                                @foreach ($item->respon as $respon)
                                    <div class="bg-gray-200 p-4 rounded-md flex justify-between items-center">
                                        <div>
                                            <p class="text-gray-600"><span class="font-semibold">{{ $respon->createdBy->name }}</span> - {{ Carbon::create($respon->created_at)->translatedFormat('j F Y, H:i') }} WIB - <span class="font-semibold">({{ $respon->status_respon }})</span></p>
                                            @if ($respon->is($responSelected))
                                                <form wire:submit="updateRespon()" method="post" :key="$item->id" class="p-6 space-y-6">
                                                    <div>
                                                        <x-input-label for="Respon" :value="__('Respon')" />
                                                        <x-textarea-input wire:model="respon_text" id="respon" name="respon" type="respon" class="mt-1 block w-full" autocomplete="respon" />
                                                    </div>
                                                    <div>
                                                        <x-input-label for="status_respon" :value="__('Status Respon')" />
                                                        <x-select-input :options="$listStatusRespon" wire:model="status_respon" id="status_respon" name="status_respon" type="status_respon" class="mt-1 block w-full" autocomplete="status_respon" disabled />
                                                        <x-input-error :messages="$errors->get('status_respon')" class="mt-2" />
                                                    </div>
                                                    <x-primary-button class="me-2">{{ __('Kirim Respon') }}</x-primary-button>
                                                    <x-secondary-button wire:click='cancelRespon()'>{{ __('Batal') }}</x-secondary-button>

                                                    <x-action-message class="me-3" on="success">
                                                        {{ __('Berhasil Disimpan.') }}
                                                    </x-action-message>
                                                </form>
                                            @else
                                                <p>{{ $respon->respon_text }}</p>
                                            @endif
                                        </div>
                                        @if (auth()->user()->hasRole('admin'))
                                            <x-dropdown>
                                                <x-slot name="trigger">
                                                    <button>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                        </svg>
                                                    </button>
                                                </x-slot>
                                                <x-slot name="content">
                                                    <x-dropdown-link wire:click="selectedRespon({{ $respon->id }})">
                                                        {{ __('Edit Respon') }}
                                                    </x-dropdown-link>
                                                    <x-dropdown-link wire:click="HapusRespon({{ $respon->id }})">
                                                        {{ __('Hapus Respon') }}
                                                    </x-dropdown-link>
                                                </x-slot>
                                            </x-dropdown>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="flex-1">
                <div class="flex justify-end items-center">
                    @if ($aduan->previousPageUrl())
                        <div>
                            <a class="ms-2 text-xl font-semibold text-gray-900" role="button" href="{{ $aduan->previousPageUrl() }}">« sebelumnya</a>
                        </div>
                    @else
                        <div>
                            <a class="ms-2 text-xl text-gray-500" disabled>« sebelumnya</a>
                        </div>
                    @endif
                    @if ($aduan->nextPageUrl())
                        <div>
                            <a class="ms-4 text-xl font-semibold text-gray-900" role="button" href="{{ $aduan->nextPageUrl() }}">selanjutnya »</a>
                        </div>
                    @else
                        <div>
                            <a class="ms-2 text-xl text-gray-500" disabled>selanjutnya »</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
