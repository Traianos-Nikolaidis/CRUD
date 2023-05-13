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
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <form method="POST" action="/person/{{ $person->id }}" class="mt-5">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" required name="name" id="name" value="{{ $person->name }}" class="form-control" />
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="{{ $person->email }}" class="form-control" />
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Update Person" class="btn btn-primary" />
        </div>
    </form>
</div>
@stop
