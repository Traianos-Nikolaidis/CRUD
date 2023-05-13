@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card mt-4">
        <div class="card-body">
            <p class="card-text"> <span id="name">{{$person->name}}</span></p>
            <p class="card-text"> <span id="email">{{$person->email}}</span></p>
            <a href="/person/{{ $person->id }}/edit" class="btn btn-warning">EDIT</a>
            <form method="POST" action="/person/{{ $person->id }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <input type='submit' value='DELETE' class="btn btn-danger" onclick="return confirm('Are you sure?')" />
            </form>
        </div>
    </div>
</div>

@stop
