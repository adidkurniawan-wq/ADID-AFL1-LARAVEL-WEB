<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('articles.index') }}">Portal Artikel</a>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <a href="{{ route('articles.index') }}" class="btn btn-sm btn-secondary mb-3">&larr; Kembali ke Daftar</a>

                <div class="card shadow-sm p-4 mb-4">
                    <span class="badge bg-secondary align-self-start mb-2">{{ $article->category->name }}</span>
                    <h1 class="fw-bold mb-3">{{ $article->title }}</h1>
                    <small class="text-muted mb-4">Diterbitkan pada: {{ $article->created_at->format('d M Y') }}</small>
                    <hr>
                    <p style="line-height: 1.8; font-size: 1.1rem; white-space: pre-line;">{{ $article->content }}</p>
                </div>

                <div class="card shadow-sm p-4">
                    <h4 class="fw-bold mb-3">Komentar ({{ $article->comments->count() }})</h4>

                    @if($article->comments->isEmpty())
                        <p class="text-muted">Belum ada komentar. Jadi yang pertama berkomentar!</p>
                    @else
                    @foreach($article->comments as $comment)
    <div class="bg-white p-3 rounded mb-3 shadow-sm border-start border-primary border-3 d-flex justify-content-between align-items-center">
        <div>
            <p class="mb-1">{{ $comment->body }}</p>
            <small class="text-muted" style="font-size: 0.8rem;">
                Dibuat: {{ $comment->created_at->format('d M Y') }}
                @if($comment->created_at != $comment->updated_at)
                    • <span class="text-warning">Diubah: {{ $comment->updated_at->format('d M Y') }}</span> (Poin 4)
                @endif
            </small>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $comment->id }}">Ubah</button>

            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Yakin hapus komentar ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editModal{{ $comment->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Komentar</h5>
                        <button type="button" class="btn-close" data-bs-content="modal" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <textarea name="body" class="form-control" rows="3" required>{{ $comment->body }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
