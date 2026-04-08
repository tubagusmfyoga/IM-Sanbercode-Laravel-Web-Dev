@extends('layouts.master')
@section('judul')
Tambah Product
@endsection
@section('content')
<form action="/product" method="POST" enctype="multipart/form-data">
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
    <label for="category_id" class="form-label">Category</label>
    <select class="form-control" name="category_id">
      <option value="">--Select a Category--</option>
      @forelse ($categories as $item)
          <option value="{{ $item->id }}">{{ $item->name }}</option>
      @empty
          <option value="">Tidak ada kategori</option>
        @endforelse
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" class="form-control" name="name">
  </div>
  <div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="file" class="form-control" name="image">
  </div>
  <div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <input type="number" class="form-control" name="price">
  </div>
  <div class="mb-3">
    <label for="stock" class="form-label">Stock</label>
    <input type="number" class="form-control" name="stock">
  </div>
  <div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection