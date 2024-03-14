@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-3">
                    <a href="{{ route('index') }}">Главная</a> / Галерея
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header bg-info">
                    <div class="row">

                        Название

                        @if (request()->has('sort_by') && request()->get('sort_by') == 'name' && request()->get('value') == 'desc')
                            <div class="col-1">
                                <a class="me-4"
                                    href= "{{ route('images.show', ['sort_by' => 'name', 'value' => 'asc']) }}">
                                    <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                                </a>
                            </div>
                        @else
                            <div class="col-1">
                                <a class="me-4"
                                    href= "{{ route('images.show', ['sort_by' => 'name', 'value' => 'desc']) }}">
                                    <i class="fa fa-sort-amount-desc" aria-hidden="true"></i>
                                </a>
                            </div>
                        @endif

                        Дата и время

                        @if (request()->has('sort_by') && request()->get('sort_by') == 'date_time' && request()->get('value') == 'desc')
                            <div class="col-1">
                                <a href= "{{ route('images.show', ['sort_by' => 'date_time', 'value' => 'asc']) }}">
                                    <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                                </a>
                            </div>
                        @else
                            <div class="col-1">

                                <a href= "{{ route('images.show', ['sort_by' => 'date_time', 'value' => 'desc']) }}">
                                    <i class="fa fa-sort-amount-desc" aria-hidden="true"></i>
                                </a>
                            </div>
                        @endif

                    </div>
                </div>
                <div class="card-body">
                    <div class="row m-auto ">

                        @foreach ($images as $image)
                            <div class="col-12 col-lg-3 col-md-4 mt-2">
                                <div class="card border border-info">
                                    {{-- <div class="card-header bg-info">{{ $image->name }}</div> --}}
                                    <div class="card-body text-center">
                                        <div class="">

                                            {{-- <img style="height:200px;width:200px;" src="{{ asset($image) }}" alt="Image"> --}}
                                            <a href="{{ asset('storage/images/' . $image->name) }}">
                                                <img style="height:200px;width:200px; border:1px solid #38c0c9"
                                                    src="{{ asset('storage/images/' . $image->name) }}" alt="Image">
                                            </a>
                                        </div>
                                        <div>{{ $image->name }} <a
                                                href="{{ route('images.download', ['image_name' => $image->name]) }}"
                                                class="btn bg-transparent text-success fa fa-download "></a></div>
                                        <div>{{ $image->uploaded_date_time }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
