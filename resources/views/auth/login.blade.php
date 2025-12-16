<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT. Smart CRM</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8">
        <div class="text-center mb-8">
            <div class="bg-blue-600 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-white w-8 h-8" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">PT. Smart CRM</h1>
            <p className="text-gray-500 mt-2">Masuk untuk mengelola operasional</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded mb-4 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" required
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg transition-colors">
                Login
            </button>
        </form>

        <div class="mt-6 text-center text-xs text-gray-400">
            <p>Demo Accounts:</p>
            <p>Sales: sales@smart.co.id / password</p>
            <p>Manager: manager@smart.co.id / password</p>
        </div>
    </div>
</body>

</html>