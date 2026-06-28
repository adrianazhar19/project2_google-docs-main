<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>{{ $document->title }}</title>

@vite(['resources/css/app.css','resources/js/app.js'])


</head>

<body class="bg-gray-100">

<nav class="bg-blue-600 shadow-lg">


<div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

    <h1 class="text-2xl font-bold text-white">

        📄 Google Docs

    </h1>

    <div class="space-x-3">

        <a
            href="{{ route('documents.index') }}"
            class="bg-white text-blue-600 px-4 py-2 rounded-lg font-semibold">

            ← Kembali

        </a>

        <a
            href="{{ route('documents.edit',$document->id) }}"
            class="bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-2 rounded-lg font-semibold">

            ✏ Edit

        </a>

    </div>

</div>


</nav>

<div class="max-w-5xl mx-auto mt-10 px-5">

<div class="bg-white rounded-2xl shadow-xl p-8">

    <h2
        id="document-title"
        class="text-4xl font-bold text-gray-800">

        {{ $document->title }}

    </h2>

    <p class="text-gray-500 mt-2">

        {{ $presenceCount }} user sedang membuka dokumen ini

    </p>

    <hr class="my-6">

    <h3 class="text-xl font-semibold mb-4">

        Isi Dokumen

    </h3>

    <div
        id="document-content"
        class="bg-gray-50 border rounded-xl p-6 min-h-[250px] leading-8">

        {!! $document->content !!}

    </div>

    <div class="mt-8">

        <label class="font-semibold text-gray-700">

            Share Link

        </label>

        <div class="flex mt-2">

            <input
                id="shareLink"
                value="{{ config('app.url') }}/documents/{{ $document->id }}"
                readonly
                class="flex-1 rounded-l-xl border-gray-300">

            <button
                onclick="copyLink()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 rounded-r-xl">

                Copy

            </button>

        </div>

    </div>

        <hr class="my-8">

        <div class="flex justify-between items-center">

            <h3 class="text-2xl font-bold text-gray-800">

                👥 Invite Collaborator

            </h3>

        </div>

        @if(session('success'))

            <div class="mt-4 bg-green-100 text-green-700 border border-green-300 rounded-lg p-4">

                {{ session('success') }}

            </div>

        @endif

        @if(session('error'))

            <div class="mt-4 bg-red-100 text-red-700 border border-red-300 rounded-lg p-4">

                {{ session('error') }}

            </div>

        @endif

        <form
            action="{{ route('documents.invite',$document->id) }}"
            method="POST"
            class="mt-6">

            @csrf

            <div class="grid md:grid-cols-3 gap-4">

                <input
                    type="email"
                    name="email"
                    placeholder="Masukkan email user..."
                    class="border rounded-xl px-4 py-3"
                    required>

                <select
                    name="role"
                    class="border rounded-xl px-4 py-3">

                    <option value="editor">

                        Editor

                    </option>

                    <option value="viewer">

                        Viewer

                    </option>

                </select>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white rounded-xl px-6 py-3 font-semibold">

                    Invite

                </button>

            </div>

        </form>

        <hr class="my-8">

        <h3 class="text-xl font-bold mb-4">

            Daftar Collaborator

        </h3>

        @forelse($document->collaborators as $collaborator)

            <div class="flex justify-between items-center border rounded-xl p-4 mb-3">

                <div>

                    <h4 class="font-semibold">

                        {{ $collaborator->user->name }}

                    </h4>

                    <p class="text-gray-500">

                        {{ $collaborator->user->email }}

                    </p>

                </div>

                <div class="flex items-center gap-2">

    <form
        action="{{ route('documents.collaborator.update', [$document->id, $collaborator->user_id]) }}"
        method="POST">

        @csrf
        @method('PUT')

        <select
            name="role"
            onchange="this.form.submit()"
            class="border rounded-lg px-3 py-2">

            <option
                value="editor"
                {{ $collaborator->role == 'editor' ? 'selected' : '' }}>
                Editor
            </option>

            <option
                value="viewer"
                {{ $collaborator->role == 'viewer' ? 'selected' : '' }}>
                Viewer
            </option>

        </select>

    </form>

    <form
        action="{{ route('documents.collaborator.destroy', [$document->id, $collaborator->user_id]) }}"
        method="POST">

        @csrf
        @method('DELETE')

        <button
            onclick="return confirm('Hapus collaborator ini?')"
            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">

            Hapus

        </button>

    </form>

</div>

            </div>

        @empty

            <div class="bg-gray-100 rounded-xl p-5 text-center text-gray-500">

                Belum ada collaborator.

            </div>

        @endforelse

    </div>

</div>

<hr class="my-8">

<p class="text-sm text-gray-500 text-center">

    Total Collaborator :
    <strong>

        {{ $document->collaborators->count() }}

    </strong>

</p>
<script>

function copyLink() {

    const copy = document.getElementById('shareLink');

    copy.select();

    copy.setSelectionRange(0, 99999);

    navigator.clipboard.writeText(copy.value);

    alert('Link berhasil disalin');

}

window.addEventListener('load', function () {

    if (window.Echo) {

        window.Echo
            .channel('document.{{ $document->id }}')

            .listen('.document.updated', (e) => {

                document.getElementById('document-title').innerText = e.document.title;

                document.getElementById('document-content').innerHTML = e.document.content;

            });

    }

});

</script>

</body>

</html>

