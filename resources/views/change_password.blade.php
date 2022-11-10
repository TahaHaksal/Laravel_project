@extends('layouts.app')
@section('content')

<form method="POST" action="/change-password">
    @csrf
    <label for="old_password">Old Password</label><br>
    <input type="password" name="old_password"><br>
    <label for="new_password">New Password</label><br>
    <input type="password" name="new_password"><br>
    <label for="new_password_confirmation">Confirm New Password</label><br>
    <input type="password" name="new_password_confirmation"><br>
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
