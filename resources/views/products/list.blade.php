@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <x-alert message="Data inventori taktis berhasil dimuat ke dalam sistem." />

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 text-uppercase fw-bold m-0">Product Catalog</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary fw-bold shadow-sm">Add new product</a>
    </div>

    <div class="row">
        @foreach($products as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-dark">{{ $item['name'] }}</h5>
                        <p class="card-text text-muted flex-grow-1">{{ $item['description'] }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="text-primary fw-bold">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                            <div class="btn-group">
                                <a href="{{ route('products.show', $item['id']) }}" class="btn btn-sm btn-outline-secondary">Detail</a>
                                <a href="{{ route('products.edit', $item['id']) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
