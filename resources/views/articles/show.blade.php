@extends('layouts.app')

@section('content')
<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="/articles" class="btn btn-secondary btn-sm">← Kembali ke Daftar Artikel</a>
    </div>

    <article class="mb-5">
        <h1 class="display-4 fw-bold">{{ $article->title }}</h1>
        <p class="text-muted">Kategori: <span class="badge bg-primary">{{ $article->category->name }}</span> | Dipublikasikan: {{ $article->created_at->format('d M Y') }}</p>
        <hr>
        <div class="mt-4 fs-5" style="line-height: 1.8;">
            {!! nl2br(e($article->content)) !!}
        </div>
    </article>

    <section class="mt-5">
        <h3 class="fw-bold mb-4">Komentar ({{ $article->comments->count() }})</h3>

        <div class="list-group mb-4">
            @forelse($article->comments as $comment)
                <div class="list-group-item list-group-item-action p-3 mb-3 shadow-sm rounded border">
                    <div class="d-flex w-100 justify-content-between align-items-center mb-2">
                        <h6 class="fw-bold mb-0">Anonim</h6>
                        <small class="text-muted">
                            Dibuat: {{ $comment->created_at->format('d M Y H:i') }}
                            @if($comment->updated_at && $comment->updated_at != $comment->created_at)
                                <span class="text-warning d-block small text-end">(Diubah: {{ $comment->updated_at->format('d M Y H:i') }})</span>
                            @endif
                        </small>
                    </div>

                    <p class="mb-3 text-secondary" id="comment-text-{{ $comment->id }}">{{ $comment->body }}</p>

                    <div id="edit-form-{{ $comment->id }}" class="d-none mb-3">
                        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-2">
                                <textarea name="body" class="form-control" rows="2" required>{{ $comment->body }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="toggleEdit({{ $comment->id }})">Batal</button>
                        </form>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-warning btn-sm px-3" style="font-size: 12px;" onclick="toggleEdit({{ $comment->id }})">
                            Ubah
                        </button>
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm px-3" style="font-size: 12px;">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-4 border rounded bg-light">
                    <p class="text-muted mb-0">Belum ada komentar di artikel ini.</p>
                </div>
            @endforelse
        </div>
    </section>
</div>

<script>
function toggleEdit(id) {
    const textElement = document.getElementById(`comment-text-${id}`);
    const formElement = document.getElementById(`edit-form-${id}`);

    if (formElement.classList.contains('d-none')) {
        formElement.classList.remove('d-none');
        textElement.classList.add('d-none');
    } else {
        formElement.classList.add('d-none');
        textElement.classList.remove('d-none');
    }
}
</script>
@endsection
