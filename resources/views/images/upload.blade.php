@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-1"></div>
        <div class="col-3">
            <a href="{{ route('index') }}">Главная</a> / Загрузка изображеный
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">Загрузка изображеный</div>
        <div class="card-body text-center">
            <form action="{{ route('images.upload') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="images[]" max="5" accept="image/*" multiple>
                <input type="submit" value="Загрузить">
            </form>
        </div>
    </div>
@endsection
