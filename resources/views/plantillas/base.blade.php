@extends('plantillas.principal')


@section('page_content')
    @yield('page_content')
@endsection

@section('menu')
    @include('plantillas.menu_navegacion')
@endsection

@section('footer')
    @include('plantillas.footer')
@endsection
