@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-dark text-white fw-bold py-3">
                    {{ $title }}
                </div>
                <div class="card-body p-4">
                    <form action="{{ $action }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ $product ? $product['name'] : '' }}" required placeholder="Masukkan nama produk">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required
                                      placeholder="Tuliskan spesifikasi produk...">{{ $product ? $product['description'] : '' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label fw-bold">Price (Rupiah)</label>
                            <input type="number" class="form-control" id="price" name="price"
                                   value="{{ $product ? $product['price'] : '' }}" required placeholder="Contoh: 150000">
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('products') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-success fw-bold px-4">Submit Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
