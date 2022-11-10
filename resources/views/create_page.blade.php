@extends('layouts.app')
@section('content')

<form method="POST" action="/create-page" id="page">
    @csrf
    <label for="title">Title of the page</label><br>
    <input type="text" name="title"><br>
</form>

<textarea rows="5" cols="50" name="description" form="page" placeholder="Content of your page goes here!">
</textarea>
<br>
<label for="signed">Would you like to sign your page?</label>
<input type="checkbox" name="signed" value="1" form="page">
<br>
<input class ="button" type="submit" value="Submit" form="page">

@endsection
