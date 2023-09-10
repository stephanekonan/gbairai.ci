@extends('layouts.site')

@section('content')

<span>{{ $post->title }}</span>
<span>{{ $post->description }}</span>
<span>{{ $post->category->name }}</span>
<span>{{ $post->user->username }}</span>

@endsection
