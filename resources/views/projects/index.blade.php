@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Project & Instalasi</h2>
            @if(Auth::user()->role === 'manager')
                <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold">Manager Mode</span>
            @endif
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
                            <th class="p-4">ID Project</th>
                            <th class="p-4">Nama Pelanggan</th>
                            <th class="p-4">Layanan</th>
                            <th class="p-4">Surveyor / Sales</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Approval Manager</th>
                            <th class="p-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $proj)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="p-4 font-mono text-gray-500">#{{ $proj->id }}</td>
                                <td class="p-4 font-semibold text-gray-900">{{ $proj->lead->name }}</td>
                                <td class="p-4 text-blue-600 font-medium">{{ $proj->product->name }}</td>
                                <td class="p-4">
                                    <p>{{ $proj->surveyor_name }}</p>
                                    <p class="text-xs text-gray-500">{{ $proj->sales->name }}</p>
                                </td>
                                <td class="p-4">
                                    @php
                                        $colors = [
                                            'Survey' => 'bg-purple-100 text-purple-700',
                                            'Pending Approval' => 'bg-yellow-100 text-yellow-700',
                                            'Installation' => 'bg-orange-100 text-orange-700',
                                            'Completed' => 'bg-green-100 text-green-700',
                                            'Cancelled' => 'bg-red-100 text-red-700',
                                        ];
                                        $color = $colors[$proj->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $color }}">
                                        {{ $proj->status }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    @if($proj->is_manager_approved)
                                        <div class="flex items-center gap-1 text-green-600 font-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                            </svg>
                                            Disetujui
                                        </div>
                                    @else
                                        <div class="text-orange-500 font-medium">Menunggu</div>
                                    @endif
                                </td>
                                <td class="p-4 text-right">
                                    {{-- Manager Action: Approve --}}
                                    @if(!$proj->is_manager_approved && Auth::user()->role === 'manager')
                                        <form action="{{ route('projects.approve', $proj->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-1.5 rounded text-xs font-medium mr-2 transition-colors">
                                                Approve
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Sales/Ops Action: Finish Installation --}}
                                    @if($proj->is_manager_approved && $proj->status === 'Installation')
                                        <form action="{{ route('projects.finish', $proj->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded text-xs font-medium transition-colors">
                                                Selesai Instalasi
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Sales cannot proceed without approval --}}
                                    @if(!$proj->is_manager_approved && Auth::user()->role === 'sales')
                                        <span class="text-xs text-gray-400 italic">Perlu Approval Manager</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-gray-400">Belum ada project berjalan. Proses dari
                                    menu Leads.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection