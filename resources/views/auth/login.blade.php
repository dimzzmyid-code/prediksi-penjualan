<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>DapoerPhy - Admin Login</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&family=Epilogue:wght@600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    fontFamily: {
                        body: ['Plus Jakarta Sans'],
                        display: ['Epilogue'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .parchment-glow {
            box-shadow: 0 10px 30px -5px rgba(141, 75, 0, 0.08);
        }
    </style>
</head>

<body class="bg-slate-100 min-h-screen flex items-center justify-center p-6">

<main class="w-full max-w-7xl bg-white rounded-[2rem] overflow-hidden shadow-2xl flex flex-col md:flex-row parchment-glow">

    <!-- LEFT IMAGE -->
    <section class="relative w-full md:w-1/2 h-64 md:h-auto">
        <img
            src="https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=1200&q=80"
            alt="Bakery"
            class="absolute inset-0 w-full h-full object-cover"
        >

        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative z-10 h-full flex flex-col justify-end p-10 text-white">
            <h1 class="text-5xl font-bold font-display">DapoerPhy</h1>
            <p class="text-xl italic opacity-90">Master Baker Admin</p>
        </div>
    </section>

    <!-- RIGHT LOGIN -->
    <section class="w-full md:w-1/2 flex items-center justify-center p-8 md:p-14 bg-white">
        <div class="w-full max-w-md">

            <header class="mb-8">
                <h2 class="text-4xl font-bold text-slate-800 mb-2">Selamat Datang</h2>
                <p class="text-slate-500">
                    Silakan masuk untuk mengelola produksi harian Anda.
                </p>
            </header>

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('status'))
                <div class="mb-4 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- EMAIL -->
                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-600">
                        Email
                    </label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-600"
                        placeholder="admin@dapoerphy.com"
                    >
                </div>

                <!-- PASSWORD -->
                <div>
                    <div class="flex justify-between mb-2">
                        <label class="text-sm font-semibold text-slate-600">
                            Password
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-sm text-amber-700 hover:underline">
                                Lupa Password?
                            </a>
                        @endif
                    </div>

                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-600"
                        placeholder="••••••••"
                    >
                </div>

                <!-- REMEMBER -->
                <label class="flex items-center gap-3 text-sm text-slate-600">
                    <input
                        type="checkbox"
                        name="remember"
                        class="rounded border-slate-300 text-amber-600 focus:ring-amber-600"
                    >
                    Tetap masuk di perangkat ini
                </label>

                <!-- BUTTON -->
                <button
                    type="submit"
                    class="w-full bg-amber-700 hover:bg-amber-800 text-white font-semibold py-3 rounded-xl transition shadow-lg"
                >
                    Masuk ke Dashboard
                </button>
            </form>

            <!-- REGISTER -->
            <p class="mt-6 text-center text-sm text-slate-500">
                Belum punya akun?
                <a href="{{ route('register') }}"
                   class="text-amber-700 font-semibold hover:underline">
                    Register
                </a>
            </p>

        </div>
    </section>
</main>

</body>
</html>