@extends('layouts.app')

@section('content')
<div class="container py-4">

    <form action="/articles" method="GET" class="row g-2 mb-4">
        @if(request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif

        <div class="col-md-6">
            <input type="text" name="search" class="form-control" placeholder="Cari judul atau isi artikel..." value="{{ request('search') }}">
        </div>

        <div class="col-md-4">
            <select name="sort" class="form-select" onchange="this.form.submit()">
                <option value="">-- Urutkan Judul --</option>
                <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>Nama (A - Z)</option>
                <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Nama (Z - A)</option>
            </select>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Cari</button>
        </div>
    </form>

    <div class="mb-4">
        <h5>Pilih Kategori:</h5>
        <a href="/articles" class="btn btn-outline-secondary btn-sm {{ !request('category') ? 'active' : '' }}">
            Semua Artikel
        </a>
        @foreach($categories as $category)
            <a href="/articles?category={{ urlencode($category->name) }}&sort={{ request('sort') }}" class="btn btn-outline-primary btn-sm {{ request('category') == $category->name ? 'active' : '' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <div class="row">
        @forelse($articles as $article)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="text-muted small">Kategori: {{ $article->category->name }}</p>
                        <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                        <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-link p-0">Baca Selengkapnya →</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-5">Tidak ada artikel yang ditemukan.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection
