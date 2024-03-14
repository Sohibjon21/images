@extends('layouts.main')

@section('content')
    <div class="w-100 mt-5">
        <div class="card border-0 w-25 m-auto">

            <a class="btn btn-primary" href="{{ route('images.upload') }}">Загрузка изображеный</a>

            <a class="btn btn-primary mt-2" href="{{ route('images.show') }}">Галерея</a>

        </div>
    </div>
@endsection
