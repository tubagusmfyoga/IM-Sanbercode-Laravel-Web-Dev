@extends('layouts.master')
@section('title', 'Welcome')
@section('judul',)
Edit Category
@endsection
@section('content')
<form action="/category/{{$category->id}}" method="POST">
    @csrf
    @method('PUT')

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
    <label class="form-label">Name</label>
    <input type="text" class="form-control" value="{{$category->name}}" name="name">
  </div>
  <div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" cols="30" rows="10">{{$category->description}}</textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection