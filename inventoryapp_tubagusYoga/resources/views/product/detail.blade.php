@extends('layouts.master')
@section('judul')
Detail Product
@endsection
@section('content')


<img src="{{ asset('image/' . $products->image) }}" class="card-img-top mb-3" alt="..." height="300px" width="200px">
<h4 class="text-primary">{{$products->name}}</h4>
<p  style="color: blue"><strong>Rp. {{ $products->price }}</strong></p>
<p  style="color: blue">Jumlah Stock : {{ $products->stock }}</p>
<p>{{$products->description}}</p>

<a href="/product" class="btn btn-secondary btn-sm">Kembali</a>
@endsection