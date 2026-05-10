<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prediksi Penjualan Roti</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-100">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg">
        <div class="p-6 border-b">
            <h1 class="text-2xl font-bold text-amber-700">
                DapoerPhy
            </h1>
            <p class="text-sm text-gray-500">
                Prediksi Penjualan
            </p>
        </div>

        <nav class="p-4 space-y-2">
            <a href="{{ route('dashboard') }}"
               class="block px-4 py-2 rounded hover:bg-amber-100">
                Dashboard
            </a>

            <a href="{{ route('roti.index') }}"
               class="block px-4 py-2 rounded hover:bg-amber-100">
                Data Roti
            </a>

            <a href="{{ route('penjualan.index') }}"
               class="block px-4 py-2 rounded hover:bg-amber-100">
                Penjualan
            </a>

            <a href="{{ route('prediksi.index') }}"
               class="block px-4 py-2 rounded hover:bg-amber-100">
                Prediksi
            </a>

            <a href="{{ route('grafik.index') }}"
               class="block px-4 py-2 rounded hover:bg-amber-100">
                Grafik
            </a>

            <a href="{{ route('laporan.index') }}"
               class="block px-4 py-2 rounded hover:bg-amber-100">
                Laporan
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1">

        <!-- Topbar -->
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-bold text-slate-700">
                Sistem Prediksi Penjualan
            </h2>

            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-600">
                    {{ auth()->user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="text-red-600 font-semibold hover:underline">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6">
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>