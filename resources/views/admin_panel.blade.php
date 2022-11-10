
@extends('layouts.app')
@section('content')
<h2>Click to email adress to change user's info</h2>

@foreach ($users as $user)
<a href="/change-user/{{$user['id']}}">{{$user['email']}}</a>
<a class ="button" href="/delete-user/{{$user['id']}}">Delete</a>
<br>
@endforeach


<h2>Create a new user</h2>
<form method="POST" action="/create-user">
    @csrf
    <label for="name">Name:</label><br>
    <input type="text" name="fname"><br>
    <label for="email">Email:</label><br>
    <input type="text" name="email"><br>
    <label for="password">Password:</label><br>
    <input type="text" name="password"><br>
    <label for="isadmin">IsAdmin:</label><br>
    <input type="text" name="isadmin"><br>
    <input class ="button" type="submit" value="Submit">
</form>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@endsection
