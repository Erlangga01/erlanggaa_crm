@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
            <h2 class="text-2xl font-bold text-gray-800">Database Calon Customer</h2>
            <a href="{{ route('leads.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 text-sm font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Tambah Lead Manual
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-4 border-b border-gray-100 flex gap-2">
                <form action="{{ route('leads.index') }}" method="GET" class="relative flex-1 max-w-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-2.5 text-gray-400" width="18"
                        height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <input type="text" name=" search" value="{{ request('search') }}"
                        placeholder="Cari nama atau telepon..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 text-gray-900 font-medium uppercase text-xs">
                        <tr>
                            <th class="p-4">Nama Customer</th>
                            <th class="p-4">Kontak</th>
                            <th class="p-4">Minat Layanan</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($leads as $lead)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="p-4">
                                    <p class="font-semibold text-gray-900">{{ $lead->name }}</p>
                                    <p class="text-xs text-gray-500 truncate max-w-[200px]">{{ $lead->address }}</p>
                                </td>
                                <td class="p-4">
                                    <p>{{ $lead->email }}</p>
                                    <p class="text-xs text-gray-500">{{ $lead->phone }}</p>
                                </td>
                                <td class="p-4 text-blue-600 font-medium">{{ $lead->product->name ?? '-' }}</td>
                                <td class="p-4">
                                    @php
                                        $colors = [
                                            'New' => 'bg-blue-100 text-blue-700',
                                            'Contacted' => 'bg-yellow-100 text-yellow-700',
                                            'Converted' => 'bg-green-100 text-green-700',
                                            'Lost' => 'bg-red-100 text-red-700',
                                        ];
                                        $color = $colors[$lead->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $color }}">
                                        {{ $lead->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-right space-x-2">
                                    <a href="{{ route('leads.edit', $lead->id) }}"
                                        class="text-gray-500 hover:text-blue-600 font-medium text-xs">Edit</a>
                                    @if($lead->status !== 'Converted')
                                        <a href="{{ route('projects.create', ['lead_id' => $lead->id]) }}"
                                            class="text-white bg-green-600 hover:bg-green-700 px-3 py-1.5 rounded text-xs font-medium inline-flex items-center gap-1 transition-colors">
                                            Proses <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="5" y1="12" x2="19" y2="12" />
                                                <polyline points="12 5 19 12 12 19" />
                                            </svg>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-400">Belum ada data leads.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection