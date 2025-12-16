@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Overview</h2>
            <span class="text-sm text-gray-500">{{ now()->translatedFormat('l, d F Y') }}</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Leads -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                <div class="p-3 rounded-full bg-blue-50 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Leads</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['leads'] }}</p>
                </div>
            </div>

            <!-- Projects -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                <div class="p-3 rounded-full bg-orange-50 text-orange-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="14" x="2" y="7" rx="2" ry="2" />
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Project Berjalan</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['projects'] }}</p>
                </div>
            </div>

            <!-- Customers -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                <div class="p-3 rounded-full bg-green-50 text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pelanggan Aktif</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['customers'] }}</p>
                </div>
            </div>

            <!-- Products -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                <div class="p-3 rounded-full bg-purple-50 text-purple-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m7.5 4.27 9 5.15" />
                        <path
                            d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z" />
                        <path d="m3.3 7 8.7 5 8.7-5" />
                        <path d="M12 22V12" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Produk</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['products'] }}</p>
                </div>
            </div>
        </div>

        <!-- Recent Leads -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-semibold mb-4">Leads Terbaru</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 text-gray-900 font-medium">
                        <tr>
                            <th class="p-3">Nama</th>
                            <th class="p-3">Produk Diminati</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Tanggal Input</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentLeads as $lead)
                            <tr class="border-b border-gray-100 last:border-0 hover:bg-gray-50">
                                <td class="p-3 font-medium">{{ $lead->name }}</td>
                                <td class="p-3">{{ $lead->product->name ?? '-' }}</td>
                                <td class="p-3">
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                        {{ $lead->status }}
                                    </span>
                                </td>
                                <td class="p-3">{{ $lead->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-4 text-center text-gray-400">Belum ada lead terbaru.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection