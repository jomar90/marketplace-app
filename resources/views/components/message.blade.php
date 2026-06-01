@props(['type' => 'info'])

@php
    $classes = match ($type) {
        'success' => 'bg-green-100 text-green-800 border-green-300',
        'error' => 'bg-red-100 text-red-800 border-red-300',
        'warning' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
        default => 'bg-blue-100 text-blue-800 border-blue-300',
    };
@endphp

@if (session()->has('message'))
    <div class="border px-4 py-3 rounded mb-4 {{ $classes }}">
        {{ session('message') }}
    </div>
@endif
