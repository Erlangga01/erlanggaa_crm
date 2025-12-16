<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Smart CRM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="min-h-screen bg-gray-50 font-sans flex">

    <!-- Sidebar Desktop -->
    <aside class="hidden lg:flex w-64 bg-white border-r border-gray-200 flex-col fixed h-full z-10">
        <div class="p-6 flex items-center gap-2 border-b border-gray-100">
            <div class="bg-blue-600 p-1.5 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-white w-5 h-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <span class="font-bold text-xl text-gray-900">Smart CRM</span>
        </div>

        <nav class="flex-1 p-4 space-y-1">
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="7" height="9" x="3" y="3" rx="1" />
                    <rect width="7" height="5" x="14" y="3" rx="1" />
                    <rect width="7" height="9" x="14" y="12" rx="1" />
                    <rect width="7" height="5" x="3" y="16" rx="1" />
                </svg>
                Dashboard
            </a>
            <!-- Leads -->
            <a href="{{ route('leads.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('leads.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                </svg>
                Leads / Calon
            </a>
            <!-- Products -->
            <a href="{{ route('products.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('products.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m7.5 4.27 9 5.15" />
                    <path
                        d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z" />
                    <path d="m3.3 7 8.7 5 8.7-5" />
                    <path d="M12 22V12" />
                </svg>
                Master Produk
            </a>
            <!-- Projects -->
            <a href="{{ route('projects.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('projects.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="20" height="14" x="2" y="7" rx="2" ry="2" />
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                </svg>
                Project & Approval
            </a>
            <!-- Customers -->
            <a href="{{ route('customers.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('customers.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                Pelanggan
            </a>
        </nav>

        <div class="p-4 border-t border-gray-100">
            <div class="flex items-center gap-3 px-4 py-3 mb-2">
                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex-1 overflow-hidden">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate capitalize">{{ Auth::user()->role }}</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" x2="9" y1="12" y2="12" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 lg:ml-64 p-6 pt-20 lg:pt-6">
        @yield('content')
    </main>

</body></html>