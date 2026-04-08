@extends('layouts.master')
@section('judul')
Tampil Transaction
@endsection
@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<a href="/transaction/create" class="btn btn-primary my-2">Input Transaction</a>
<table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nama</th>
        <th scope="col">Product</th>
        <th scope="col">Type (In/Out)</th>
        <th scope="col">Amount</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($transactions as $item)
        <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{$item->user->name}}</td>
      <td>{{$item->product->name}}</td>
      <td>
        @if ($item->type == "in")
            <span class="bg-primary text-white px-2 py-1 rounded">In</span>  
        @else
            <span class="bg-danger text-white px-2 py-1 rounded">Out</span>
        @endif
      </td>
      <td>{{$item->amount}}</td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="text-center">Data Transaction Masih Kosong</td>
    </tr>
        
    @endforelse
  </tbody>
</table>

@endsection