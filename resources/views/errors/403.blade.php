@extends('errors::illustrated-layout')

@section('image')
    <div style="background-image: url({{ asset('/img/errors/default.jpg') }});"
        class="absolute pin bg-contain bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('title', __('Forbidden'))
@section('code', '403 ✋')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
