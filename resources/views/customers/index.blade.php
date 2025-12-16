@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Pelanggan Aktif</h2>
        </div>

        @if(session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 text-gray-900 font-medium uppercase text-xs">
                        <tr>
                            <th class="p-4">ID Pelanggan</th>
                            <th class="p-4">Nama Customer</th>
                            <th class="p-4">Paket Berlangganan</th>
                            <th class="p-4">Tanggal Gabung</th>
                            <th class="p-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $cust)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="p-4 font-mono text-gray-500">{{ $cust->user_account_number }}</td>
                                <td class="p-4">
                                    <p class="font-semibold text-gray-900">{{ $cust->name }}</p>
                                    <p class="text-xs text-gray-500 truncate max-w-[200px]">{{ $cust->billing_address }}</p>
                                </td>
                                <td class="p-4 text-blue-600 font-medium">{{ $cust->project->product->name }}</td>
                                <td class="p-4">{{ $cust->subscription_start_date->format('d M Y') }}</td>
                                <td class="p-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        {{ $cust->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-400">Belum ada pelanggan aktif.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection