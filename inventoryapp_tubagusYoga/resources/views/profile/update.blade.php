@extends('layouts.master')
@section('judul')
Update Profile
@endsection
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
</div>
@endif
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form action="/profile" method="POST">
    @csrf
    @method("PUT")
    <div class="mb-3">
        <label class="form-label">Age</label>
        <input type="number" class="form-control" name="age" value="{{ old('age', $profile->age) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Bio</label>
        <textarea name="bio" class="form-control" cols="30" rows="10">{{ old('bio', $profile->bio) }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection