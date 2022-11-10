@extends('layouts.app')
@section('content')
<h1>{{$user->name}}</h1>
@if (empty($page->title))
    <h2>No pages with the id</h2>
@else
    <h2>{{$page->title}}  ({{$avg_reading}})</h2>
    <p>{{$page->description}}</p>
    @if ($page->signed == True)
      <p margin=20px> {{$user->name}}</p>
    @endif
@endif
@endsection
