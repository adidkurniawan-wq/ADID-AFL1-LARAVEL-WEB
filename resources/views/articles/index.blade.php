<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Artikel - AFL 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('articles.index') }}">Portal Artikel</a>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <form action="{{ route('articles.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari judul atau isi artikel..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>

                <h3 class="mb-3">Semua Artikel</h3>

                @if($articles->isEmpty())
                    <div class="alert alert-warning">Tidak ada artikel yang ditemukan.</div>
                @else
                <div class="d-flex justify-content-end mb-3">
                    <form action="{{ route('articles.index') }}" method="GET" class="d-flex gap-2">
                        @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                        @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                        <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="">Urutkan Berdasarkan</option>
                            <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>Nama A-Z</option>
                            <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Nama Z-A</option>
                        </select>
                    </form>
                </div>
                    @foreach($articles as $article)
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body">
                                <span class="badge bg-secondary mb-2">{{ $article->category->name }}</span>
                                <h4 class="card-title fw-bold">{{ $article->title }}</h4>
                                <p class="card-text text-muted">{{ Str::limit($article->content, 150) }}</p>
                                <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-sm btn-outline-primary">Baca Selengkapnya &rarr;</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white fw-bold">Kategori</div>
                    <ul class="list-group list-group-flush">
                        <a href="{{ route('articles.index') }}" class="list-group-item list-group-item-action {{ !request('category') ? 'active' : '' }}">Semua Kategori</a>
                        @foreach($categories as $category)
                            <a href="{{ route('articles.index', ['category' => $category->slug]) }}" class="list-group-item list-group-item-action {{ request('category') == $category->slug ? 'active' : '' }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
