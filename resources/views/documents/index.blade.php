<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Dokumen</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-600 shadow-lg">

        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <h1 class="text-2xl font-bold text-white">
                📄 Google Docs
            </h1>

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">

                    Logout

                </button>

            </form>

        </div>

    </nav>

    <!-- Content -->
    <div class="max-w-6xl mx-auto mt-10 px-5">

        <div class="flex justify-between items-center mb-8">

            <div>

                <h2 class="text-4xl font-bold text-gray-800">

                    Daftar Dokumen

                </h2>

                <p class="text-gray-500">

                    Kelola semua dokumen Anda

                </p>

            </div>

            <a href="{{ route('documents.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow">

                + Buat Dokumen

            </a>

        </div>

        @if($documents->count())

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($documents as $document)

                    <div
                        class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition">

                        <h3 class="text-xl font-bold text-gray-800 mb-3">

                            {{ $document->title }}

                        </h3>

                        <p class="text-gray-500 mb-5">

                            {!! Str::limit(strip_tags($document->content),120) !!}

                        </p>

                        <div class="flex justify-between items-center">

                            <div class="space-x-2">

                                <a href="{{ route('documents.show',$document->id) }}"
                                    class="text-blue-600 font-semibold hover:underline">

                                    Open

                                </a>

                                <a href="{{ route('documents.edit',$document->id) }}"
                                    class="text-yellow-600 font-semibold hover:underline">

                                    Edit

                                </a>

                            </div>

                            <form action="{{ route('documents.destroy',$document->id) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Yakin ingin menghapus dokumen ini?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">

                                    Delete

                                </button>

                            </form>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div
                class="bg-white rounded-2xl shadow-lg p-10 text-center">

                <h3 class="text-2xl font-bold text-gray-700">

                    Belum ada dokumen

                </h3>

                <p class="text-gray-500 mt-2">

                    Silakan buat dokumen pertama Anda.

                </p>

            </div>

        @endif

    </div>

</body>

</html>
```
