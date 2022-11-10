@extends('layouts.app')
@section('content')

<form method="POST" action="/change-user-info">
    @csrf
    <label for="name">Name: ({{$user['name']}})</label><br>
    <input type="text" name="fname"><br>
    <label for="email">Email: ({{$user['email']}})</label><br>
    <input type="text" name="email"><br>
    <input class ="button" type="submit" value="Submit">
</form>

<a class="button" href="/change-password">Change password</a>

<form method="Post" action="/delete-user">
    @csrf
    <button class ="button" type="submit">Delete your account!</button>
</form>

@endsection
