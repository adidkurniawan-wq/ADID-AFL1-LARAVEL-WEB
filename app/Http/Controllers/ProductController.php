<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan halaman daftar 20 produk (Poin: 10 + 5)
    public function index()
    {
        $products = [];
        for ($i = 1; $i <= 20; $i++) {
            $products[] = [
                'id' => $i,
                'name' => "Produk Premium Taktis " . $i,
                'description' => "Spesifikasi dan keunggulan mutakhir untuk produk ke-" . $i,
                'price' => rand(100, 900) * 1000
            ];
        }
        return view('products.list', compact('products'));
    }

    // Mengakses halaman form tambah produk (Poin: 10)
    public function create()
    {
        return view('products.form', [
            'title' => 'Add New Product',
            'action' => route('products.store'),
            'product' => null
        ]);
    }

    // Mengakses halaman form edit produk dengan parameter wajib ID (Poin: 10)
    public function edit($id)
    {
        $product = [
            'id' => $id,
            'name' => "Produk Model " . $id,
            'description' => "Deskripsi bawaan produk ID " . $id,
            'price' => 250000
        ];
        return view('products.form', [
            'title' => 'Edit Product #' . $id,
            'action' => route('products.update', $id),
            'product' => $product
        ]);
    }

    // Menangani proses simpan data baru (Poin: 10)
    public function store(Request $request)
    {
        return "Data sukses dikirim via POST (Store)! Nama Produk: " . $request->input('name');
    }

    // Menangani proses update data dengan parameter wajib ID (Poin: 10)
    public function update(Request $request, $id)
    {
        return "Data Produk ID " . $id . " sukses diperbarui via POST (Update)!";
    }

    // Menampilkan detail produk tunggal dengan parameter wajib ID (Poin: 10)
    public function show($id)
    {
        return "Menampilkan deskripsi lengkap untuk Product ID: " . $id;
    }
}
