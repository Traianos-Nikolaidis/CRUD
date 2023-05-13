@extends('layouts.app')

@section('content')
<style>
    nav[aria-label] div div span.relative {
        display: none
    }
</style>
<div class="container mt-4">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('user') }} <br>
        {{ session('success') }}

    </div>
    @endif
    <div class="d-flex justify-content-between align-items-center">
        <h1>People</h1>
        <a href="/person/create" class="btn btn-primary">Create Person</a>
    </div>
    <form method="GET" action="" class="d-flex justify-content-end">
        <input type="text" name="searchName" class="form-control mr-2" placeholder="Search names" value="{{ $searchName }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    @foreach($people as $person)
    <div class="card mt-4">
        <div class="card-body">
            <p class="card-text"> <span id="name">{{$person->name}}</span></p>
            <p class="card-text"> <span id="email">{{$person->email}}</span></p>
            <a href="/person/{{ $person->id }}" class="btn btn-success">View</a>
            <a href="/person/{{ $person->id }}/edit" class="btn btn-warning">Edit</a>
            <form method="POST" action="/person/{{ $person->id }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <input type='submit' value='Delete' class="btn btn-danger" onclick="return confirm('Are you sure?')" />
            </form>
        </div>
    </div>
    @endforeach
    {{ $people->links() }}
</div>

@stop
