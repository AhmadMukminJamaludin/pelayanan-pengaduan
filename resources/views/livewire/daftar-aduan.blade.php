<?php

use Illuminate\View\View;
use Carbon\Carbon;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Aduan;

new class extends Component {
    use WithPagination;

    public function rendering(View $view): void
    {
        $view->layout('layouts.app');
    }

    public function with(): array
    {
        return [
            'aduan' => Aduan::query()
                ->where('created_by', auth()->id())
                ->latest()
                ->paginate(10),
        ];
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
            @foreach ($aduan as $item)
                <div class="my-2 bg-white shadow-sm rounded-lg divide-y">
                    <div class="p-6 flex space-x-2" wire:key="{{ $item->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="ms-2 text-gray-800">{{ $item->createdBy->name }}</span>
                                    <small class="ml-2 text-sm text-gray-600">{{ Carbon::create($item->created_at)->translatedFormat('j F Y, H:i') }}</small>
                                    @unless ($item->created_at->eq($item->updated_at))
                                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                    @endunless
                                </div>
                                @if ($item->createdBy->is(auth()->user()))
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown-link wire:click="edit({{ $item->id }})">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                                        </x-slot>
                                    </x-dropdown>
                                @endif
                            </div>
                            <p class="mt-4 text-xl font-semibold text-gray-900">{{ $item->judul_keluhan }}</p>
                            <p class="mt-4 text-lg text-gray-900">{{ $item->keluhan }}</p>
                            {{-- @if ($item->is($editing))
                                <livewire:chirps.edit :chirp="$item" :key="$item->id" />
                            @else
                                <p class="mt-4 text-lg text-gray-900">{{ $item->message }}</p>
                            @endif --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
