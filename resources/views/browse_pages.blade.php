@extends('layouts.app')
@section('content')

<div class="container">
    @foreach ($pages as $page)
        <a display="inline" href="/page/{{$page->id}}">{{ $page->title }}</a>
        <br>
    @endforeach
</div>

{{ $pages->links() }}

@endsection
