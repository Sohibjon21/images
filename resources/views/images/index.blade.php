@extends('layouts.main')

@section('content')

<a href="{{ route('images.upload') }}">Upload</a>
<a href="{{ route('images.show') }}">Show</a>

@endsection