@extends('layouts.master')
@section('judul')
List Product
@endsection
@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(Auth::check() && Auth::user()->role === 'admin')
<a href="/product/create" class="btn btn-primary btn-sm btn-lg my-2">Tambah</a>
@endif

<div class ="row my-3">
@forelse ($products as $item)
<div class="col-md-4 mb-2">
        <div class="card h-100 d-flex flex-column">
            <img src="{{ asset('image/' . $item->image) }}" class="card-img-top mb-3 img-fluid" sizes="width: 300px; height: 300px; height: 300px; object-fit: cover;" alt="...">
            <div class="card-body flex-grow-1">
                <span class="badge bg-primary me-auto text-white">{{ $item->category->name }}</span>
                <h4 class="card-title">{{ $item->name }}</h4>
                <p class="card-text" style="color: blue"><strong>Rp. {{ $item->price }}</strong></p>
                <p class="card-text" style="color: blue">Jumlah Stock : {{ $item->stock }}</p>
                <p class="card-text">
                <div id="desc-short-{{$loop->index}}">
                {{ Str::limit($item->description, 100) }}
                </div>
                <div id="desc-full-{{$loop->index}}" style="display: none;">
                {{ $item->description }}
                </div>
            </div>
                <a href="javascript:void(0);" class="toggleDesc" data-index="{{$loop->index}}">See more</a>
            </p>
            <div class='d-grid'>
            <a href="/product/{{ $item->id }}" class="btn btn-primary btn-lg">Read More</a>
            </div>
            @if(Auth::check() && Auth::user()->role === 'admin')
            <div class="row my-3">
                <div class="col">
                    {{--Edit--}}
                    <div class="d-grid">
                    <a href="/product/{{ $item->id }}/edit" class="btn btn-warning btn-lg mt-2">Edit</a>
                    </div>
                </div>
                <div class="col">
                    {{--Delete--}}
                    <form action="/product/{{ $item->id }}" method="POST" class="d-inline d-grid">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger btn-lg mt-2" onclick="return confirm('Apa kamu yakin?')" value="Delete">
                    </form>
                </div>
            </div>
            @endif
        </div>
</div>
@empty

    <h4>Product Kosong</h4>
    
@endforelse
 

@endsection


<script>
document.addEventListener("DOMContentLoaded", function() {
    const toggleLinks = document.querySelectorAll(".toggleDesc");

    toggleLinks.forEach(function(link) {
        link.addEventListener("click", function() {
            const index = this.getAttribute("data-index");
            const shortDesc = document.getElementById("desc-short-" + index);
            const fullDesc = document.getElementById("desc-full-" + index);

            if (fullDesc.style.display === "none") {
                shortDesc.style.display = "none";
                fullDesc.style.display = "inline";
                this.textContent = "See less";
            } else {
                shortDesc.style.display = "inline";
                fullDesc.style.display = "none";
                this.textContent = "See more";
            }
        });
    });
});
</script>
