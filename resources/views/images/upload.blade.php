@extends('layouts.main')

@section('content')
    <form action="{{ route('images.upload') }}" method="post" enctype="multipart/form-data">
      @csrf
        <input type="file" name="images[]" multiple>
        <input type="submit" value="Загрузить">
    </form>
@endsection
