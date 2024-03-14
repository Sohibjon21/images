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
        <div class="card-header">Загрузка изображеный <i class="text-info">(Максимальное количество 5.)</i></div>
        <div class="card-body text-center">
            <form action="{{ route('images.upload') }}" method="post" enctype="multipart/form-data"
                onsubmit="return checkFilesCount()">
                @csrf
                <input type="file" name="images[]" id="imageInput" max="5" accept="image/*" multiple>
                <input type="submit" value="Загрузить">
            </form>
        </div>
    </div>

    <script>
        function checkFilesCount() {
            var input = document.getElementById('imageInput');
            var files = input.files;
            if (files.length > 5) {
                alert('Максимальное количество 5.');
                return false;
            }
            return true;
        }
    </script>
@endsection
