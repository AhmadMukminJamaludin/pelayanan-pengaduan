<?php
use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;
use App\Models\Aduan;

layout('layouts.app');
state([
    'judul_keluhan' => '',
    'keluhan' => '',
    'kategori' => '',
    'listKategori' => [
        'Infrastruktur' => 'Infrastruktur',
        'Pelayanan Publik' => 'Pelayanan Publik',
        'Keamanan dan Ketertiban' => 'Keamanan dan Ketertiban',
        'Administrasi' => 'Administrasi',
        'Kesejahteraan Masyarakat' => 'Kesejahteraan Masyarakat',
        'Fasilitas Umum' => 'Fasilitas Umum',
    ]
]);

rules([
    'judul_keluhan' => ['required', 'string', 'max:255'],
    'keluhan' => ['required', 'string'],
    'kategori' => ['required'],
]);

$submit = function () {
    $validated = $this->validate();
    $aduan = Aduan::create($validated);
    $this->reset('judul_keluhan', 'keluhan', 'kategori');
    $this->dispatch('success');
};

?>

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formulir Aduan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex flex-row gap-4">
                    <div class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Formulir Aduan') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Dengan mengisi form ini dan mengirimkan Aduan, Anda telah menyetujui Ketentuan Layanan dan Kebijakan Privasi kami.") }}
                            </p>
                        </header>
                        <form wire:submit.prevent="submit" class="mt-6 space-y-6">
                            <div>
                                <x-input-label for="judul_keluhan" :value="__('Judul Keluhan')" />
                                <x-text-input wire:model="judul_keluhan" id="judul_keluhan" name="judul_keluhan" type="text" class="mt-1 block w-full" autofocus autocomplete="judul_keluhan" />
                                <x-input-error :messages="$errors->get('judul_keluhan')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="keluhan" :value="__('Keluhan')" />
                                <x-textarea-input wire:model="keluhan" id="keluhan" name="keluhan" type="keluhan" class="mt-1 block w-full" autocomplete="keluhan" />
                                <x-input-error :messages="$errors->get('keluhan')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="kategori" :value="__('Kategori')" />
                                <x-select-input :options="$listKategori" wire:model="kategori" id="kategori" name="kategori" type="kategori" class="mt-1 block w-full" autocomplete="kategori" />
                                <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Adukan') }}</x-primary-button>

                                <x-action-message class="me-3" on="success">
                                    {{ __('Berhasil Disimpan.') }}
                                </x-action-message>
                            </div>
                        </form>
                    </div>
                    <div class="max-w-xl">
                        <header>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Dengan mengisi form ini dan mengirimkan Aduan, Anda telah menyetujui Ketentuan Layanan dan Kebijakan Privasi kami.") }}
                            </p>
                        </header>
                        <form wire:submit.prevent="submit" class="mt-6 space-y-6">
                            <div>
                                <x-input-label for="judul_keluhan" :value="__('Judul Keluhan')" />
                                <x-text-input wire:model="judul_keluhan" id="judul_keluhan" name="judul_keluhan" type="text" class="mt-1 block w-full" autofocus autocomplete="judul_keluhan" />
                                <x-input-error :messages="$errors->get('judul_keluhan')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="keluhan" :value="__('Keluhan')" />
                                <x-textarea-input wire:model="keluhan" id="keluhan" name="keluhan" type="keluhan" class="mt-1 block w-full" autocomplete="keluhan" />
                                <x-input-error :messages="$errors->get('keluhan')" class="mt-2" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
