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
            <h2 class="text-2xl font-bold text-gray-800">Edit Lead</h2>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <form action="{{ route('leads.update', $lead->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Calon Customer</label>
                    <input type="text" name="name" value="{{ old('name', $lead->name) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email (Optional)</label>
                        <input type="email" name="email" value="{{ old('email', $lead->email) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon / WA</label>
                        <input type="text" name="phone" value="{{ old('phone', $lead->phone) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Pemasangan</label>
                    <textarea name="address" rows="3" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('address', $lead->address) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Minat Layanan</label>
                    <select name="interested_product_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Layanan --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('interested_product_id', $lead->interested_product_id) == $product->id ? 'selected' : '' }}>
                                {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        @foreach(['New', 'Contacted', 'Qualified', 'Converted', 'Lost'] as $status)
                            <option value="{{ $status }}" {{ old('status', $lead->status) == $status ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan</label>
                    <textarea name="notes" rows="2"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('notes', $lead->notes) }}</textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('leads.index') }}"
                        class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">Batal</a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection