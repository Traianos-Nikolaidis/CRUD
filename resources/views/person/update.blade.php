@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Update Person</h1>
    @if($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $err)
        <p>{{ $err }}</p>
        @endforeach
    </div>
    @endif
    <form method="POST" action="/person/{{ $p->id }}" class="mt-5">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" required name="name" id="name" value="{{ $p->name }}" class="form-control" />
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text"  name="email" id="email" value="{{ $p->email }}" class="form-control" />
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Update Person" class="btn btn-primary" />
        </div>
    </form>
</div>
@endsection
