@extends('layouts.master')
@section('judul')
Detail Category
@endsection
@section('content')

<h1 class="text-primary">{{$category->name}}</h1>
<p>{{$category->description}}</p>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Stock</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($category->products as $item)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$item->name}}</td>
            <td>{{$item->stock}}</td>
            <td>
                <a href="/product/{{$item->id}}" class="btn btn-info btn-sm">Detail</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">Tidak ada produk dalam kategori ini.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<a href="/category" class="btn btn-secondary btn-sm">Kembali</a>
@endsection