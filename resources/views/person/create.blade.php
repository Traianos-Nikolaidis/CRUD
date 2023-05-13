@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">New Person</h1>
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
    <form method="POST" action="/person" class="mt-5">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" required name="name" id="name" placeholder="John Doe" value="{{ old('name') }}" class="form-control" />
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" placeholder="johndoe@example.com" value="{{ old('email') }}" class="form-control" />
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary" />
        </div>
    </form>
</div>
@stop
