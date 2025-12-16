@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('leads.index') }}" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5" />
                    <path d="M12 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Proses Lead ke Project</h2>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <form action="{{ route('projects.store') }}" method="POST" class="space-y-6">
                @csrf

                @if($lead)
                    <input type="hidden" name="lead_id" value="{{ $lead->id }}">
                    <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 mb-4">
                        <h3 class="font-semibold text-blue-800 mb-2">Informasi Lead</h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-blue-600 block">Nama:</span>
                                <span class="text-gray-800">{{ $lead->name }}</span>
                            </div>
                            <div>
                                <span class="text-blue-600 block">Alamat:</span>
                                <span class="text-gray-800 truncate">{{ $lead->address }}</span>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Optional: Select Lead if not pre-filled -->
                @endif

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Paket yang Dipilih</label>
                        <select name="product_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ ($lead && $lead->interested_product_id == $product->id) ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Surveyor</label>
                        <input type="text" name="surveyor_name" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jadwal Instalasi</label>
                    <input type="date" name="installation_date" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('leads.index') }}"
                        class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">Batal</a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Buat
                        Project</button>
                </div>
            </form>
        </div>
    </div>
@endsection