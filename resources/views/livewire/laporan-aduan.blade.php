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

    public string $no_tracking = '';

    public string $nama = '';

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
                ->paginate(10),
        ];
    }
}; ?>

<div x-data="laporan">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Aduan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form wire:submit='with' class="p-0 flex justify-between align-middle">
                <div>
                    <div class="flex justify-between items-end">
                        <div class="me-3">
                            <x-input-label for="no_tracking" :value="__('No. Tracking')" />
                            <x-text-input wire:model="no_tracking" x-model="no_tracking" id="respon" name="respon" type="respon" class="mt-1 block w-full me-3" autocomplete="respon" />
                        </div>
                        <div class="me-3">
                            <x-input-label for="nama" :value="__('Nama')" />
                            <x-text-input wire:model="nama" id="respon" x-model="nama" name="respon" type="respon" class="mt-1 block w-full me-3" autocomplete="respon" />
                        </div>
                    </div>
                </div>
                <div>
                    <x-primary-button class="me-2">{{ __('Cari') }}</x-primary-button>
                    <x-secondary-button x-on:click='cetak()'>{{ __('Download') }}</x-secondary-button>
                </div>

                <x-action-message class="me-3" on="success">
                    {{ __('Berhasil Disimpan.') }}
                </x-action-message>
            </form>
            <table class="w-full text-md text-left text-gray-500 dark:text-gray-400">
                <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">No. Tracking</th>
                        <th scope="col" class="py-3 px-6">Nama</th>
                        <th scope="col" class="py-3 px-6">Judul Keluhan</th>
                        <th scope="col" class="py-3 px-6">Tanggal Aduan</th>
                        <th scope="col" class="py-3 px-6">Kategori</th>
                        <th scope="col" class="py-3 px-6">Status Respon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aduan as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="py-4 px-6">{{ $item->no_tracking }}</td>
                            <td class="py-4 px-6">{{ $item->createdBy->name }}</td>
                            <td class="py-4 px-6">{{ $item->judul_keluhan }}</td>
                            <td class="py-4 px-6">{{ date('d-m-Y H:i:s', strtotime($item->created_at)) }}</td>
                            <td class="py-4 px-6">{{ $item->kategori }}</td>
                            <td class="py-4 px-6">{{ $item->responLatest->status_respon }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function laporan() {
        return {
            no_tracking: '',
            nama: '',
            cetak() {
                let url = `/cetak-laporan?no_tracking=${this.no_tracking}&nama=${this.nama}`;
                let height = 1000;
                let width = 800;
                var left = ( screen.width - width ) / 2;
                var top = ( screen.height - height ) / 2;
                var newWindow = window.open( url, "center window", 'resizable = yes, width=' + width + ', height=' + height + ', top='+ top + ', left=' + left);
            },
        }
    }
</script>
@endpush
