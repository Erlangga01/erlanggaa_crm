@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Master Layanan Internet</h2>
            <a href="{{ route('products.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 text-sm font-medium hover:bg-blue-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Tambah Layanan
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 relative hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m7.5 4.27 9 5.15" />
                            <path
                                d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z" />
                            <path d="m3.3 7 8.7 5 8.7-5" />
                            <path d="M12 22V12" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-gray-900 mb-1">{{ $product->name }}</h3>
                    <p class="text-2xl font-bold text-blue-600 mb-4">
                        Rp {{ number_format($product->price, 0, ',', '.') }} <span
                            class="text-sm font-normal text-gray-500">/bln</span>
                    </p>
                    <div class="text-sm text-gray-500 mb-4 space-y-1">
                        <p>{{ $product->description }}</p>
                        <p class="font-medium text-gray-700">Bandwidth: {{ $product->bandwidth_mbps }} Mbps</p>
                    </div>
                    <div class="pt-4 border-t border-gray-100 flex gap-2">
                        <a href="{{ route('products.edit', $product->id) }}"
                            class="flex-1 px-3 py-2 bg-gray-50 text-gray-700 rounded text-sm font-medium hover:bg-gray-100 text-center transition-colors">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menonaktifkan produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-3 py-2 text-red-600 rounded text-sm font-medium hover:bg-red-50 transition-colors">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection