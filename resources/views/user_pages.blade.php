@extends('layouts.app')
@section('content')

<style>
    form {
    display: inline-block; //Or display: inline;
}
</style>

<div class="container">
    @foreach ($pages as $page)
        <a display="inline" href="/page/{{$page->id}}">{{ $page->title }}</a>
        <button class = "button" onclick="window.location.href='/edit-page/{{$page->id}}'">Edit</button>
        <form action="/delete-page" method="Post">
            @csrf
            <button name="id" class="button" type="submit" value="{{$page->id}}">Delete</button>
        </form>
        <br>
    @endforeach
</div>

{{ $pages->links() }}

@endsection
