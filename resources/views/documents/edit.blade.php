<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dokumen</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <h1 class="text-2xl font-bold text-white">
                📄 Google Docs
            </h1>

            <div class="space-x-3">

                <a href="{{ route('documents.index') }}"
                    class="bg-white text-blue-600 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">

                    ← Kembali

                </a>

                <button
                    type="submit"
                    form="updateForm"
                    class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg font-semibold shadow">

                    💾 Update

                </button>

            </div>

        </div>
    </nav>

    <div class="max-w-6xl mx-auto mt-10 px-5">

        @if(session('error'))

            <div class="bg-red-100 border border-red-400 text-red-700 px-5 py-4 rounded-xl mb-6">

                {{ session('error') }}

            </div>

        @endif

        <div class="bg-white rounded-2xl shadow-xl p-8">

            <div class="flex justify-between items-center mb-8">

                <div>

                    <h2 class="text-3xl font-bold text-gray-800">

                        Edit Dokumen

                    </h2>

                    <p id="editor-status"
                        class="text-gray-500 mt-2">

                        Tidak ada user lain di editor

                    </p>

                </div>

                <span class="text-5xl">
                    📝
                </span>

            </div>

            <form
                id="updateForm"
                action="/documents/{{ $document->id }}"
                method="POST">

                @csrf
                @method('PUT')

                <input
                    type="hidden"
                    name="last_updated_at"
                    value="{{ $document->updated_at }}">

                <div class="mb-6">

                    <label
                        class="block text-gray-700 font-semibold mb-2">

                        Judul Dokumen

                    </label>

                    <input
                        id="title-input"
                        type="text"
                        name="title"
                        value="{{ $document->title }}"
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                </div>

                <div>

                    <label
                        class="block text-gray-700 font-semibold mb-2">

                        Isi Dokumen

                    </label>

                    <textarea
                        id="editor"
                        name="content">{{ $document->content }}</textarea>

                </div>

            </form>

        </div>

    </div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>

window.addEventListener('load', function () {

    let typingTimer;
    let isUpdatingFromRealtime = false;

    function sendTyping() {

        if (isUpdatingFromRealtime) {
            return;
        }

        fetch('/documents/{{ $document->id }}/typing', {

            method: 'POST',

            headers: {

                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'

            }

        });

    }

    ClassicEditor

        .create(document.querySelector('#editor'))

        .then(editor => {

            editor.model.document.on('change:data', () => {

                sendTyping();

            });

            document
                .getElementById('title-input')
                .addEventListener('input', () => {

                    sendTyping();

                });

            if (!window.Echo) {
                return;
            }

            window.Echo
                .channel('document.{{ $document->id }}')

                .listen('.document.updated', (e) => {

                    isUpdatingFromRealtime = true;

                    editor.setData(e.document.content);

                    document.getElementById('title-input').value =
                        e.document.title;

                    setTimeout(function () {

                        isUpdatingFromRealtime = false;

                    }, 500);

                })

                .listen('.user.typing', () => {

                    const status =
                        document.getElementById('editor-status');

                    status.innerHTML =
                        '<span class="text-green-600 font-semibold">🟢 User lain sedang mengetik...</span>';

                    clearTimeout(typingTimer);

                    typingTimer = setTimeout(function () {

                        status.innerHTML =
                            '<span class="text-gray-500">Tidak ada user lain di editor</span>';

                    }, 700);

                });

        })

        .catch(error => {

            console.error(error);

        });

});

</script>

</body>

</html>