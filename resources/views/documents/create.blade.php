<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Dokumen</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-600 shadow-lg">

        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <h1 class="text-2xl font-bold text-white">
                📄 Google Docs
            </h1>

            <a href="{{ route('documents.index') }}"
                class="bg-white text-blue-600 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">

                ← Kembali

            </a>

        </div>

    </nav>

    <!-- Content -->
    <div class="max-w-4xl mx-auto mt-10 px-5">

        <div class="bg-white rounded-2xl shadow-xl p-8">

            <h2 class="text-3xl font-bold text-gray-800 mb-2">

                Buat Dokumen Baru

            </h2>

            <p class="text-gray-500 mb-8">

                Isi data dokumen yang ingin Anda simpan.

            </p>

            <form action="{{ route('documents.store') }}" method="POST">

                @csrf

                <!-- Judul -->
                <div class="mb-6">

                    <label class="block text-gray-700 font-semibold mb-2">

                        Judul Dokumen

                    </label>

                    <input
                        type="text"
                        name="title"
                        placeholder="Masukkan judul dokumen..."
                        required
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                </div>

                <!-- Isi -->
                <div class="mb-8">

                    <label class="block text-gray-700 font-semibold mb-2">

                        Isi Dokumen

                    </label>

                    <textarea
                        name="content"
                        rows="12"
                        placeholder="Tulis isi dokumen di sini..."
                        required
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>

                </div>

                <div class="flex justify-end gap-4">

                    <a href="{{ route('documents.index') }}"
                        class="px-6 py-3 rounded-xl bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold">

                        Batal

                    </a>

                    <button
                        type="submit"
                        class="px-8 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-lg transition">

                        💾 Simpan Dokumen

                    </button>

                </div>

            </form>

        </div>

    </div>

</body>

</html>
```
