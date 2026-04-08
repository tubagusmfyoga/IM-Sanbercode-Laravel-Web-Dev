@extends('layouts.master')
@section('judul')
Transaction
@endsection
@section('content')
<form action="/transaction" method="POST">
    @csrf

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<div class="mb-3">
    <label for="product_id" class="form-label">Product</label>
    <select class="form-control" name="product_id">
        <option value="">--Select a Product--</option>
    @forelse ($products as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
    @empty
        <option value="">Tidak ada product</option>
    @endforelse
    </select>
</div>
<div class="mb-3"> 
    <label for="type" class="form-label">Type</label>
    <select class="form-control" name="type">
        <option value="">--Select Type--</option>
        <option value="in">Produk Masuk</option>
        <option value="out">Produk Keluar</option>
    </select>
</div>
<div>
    <label for="amount" class="form-label">Amount</label>
    <input type="number" class="form-control" name="amount">
</div>
<div class="mb-3">
    <label class="form-label">Notes</label>
    <textarea name="notes" class="form-control" cols="10" rows="5"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection