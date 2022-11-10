@extends('layouts.app')
@section('content')

<form action="/change-user-info/{{$user['id']}}" method="POST" >
    @csrf
    <label for="name">Name: ({{$user['name']}})</label><br>
    <input type="text" name="fname"><br>
    <label for="email">Email: ({{$user['email']}})</label><br>
    <input type="text" name="email"><br>
    <label for="isadmin">IsAdmin: ({{$user['is_admin']}})</label><br>
    <input type="text" name="isadmin"><br>
    <input class ="button" type="submit" value="Submit">
  </form>
  <p>Last updated at: {{$user['updated_at']}}</p>
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
