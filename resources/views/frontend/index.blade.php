@extends('frontend.master')

@section('frontend_title', 'Home')

@section('frontend_content')

    {{-- ############### Slider ############### --}}
    @include('frontend.home.slider')

     {{-- ############### Our Services ############### --}}
     @include('frontend.home.our_services')

    {{-- ############### About Us ############### --}}
    @include('frontend.home.about_us')

    {{-- ############### Happy Customer ############### --}}
    {{-- @include('frontend.home.happy_customer') --}}

    {{-- ############### Our Clients ############### --}}
    @include('frontend.home.our_clients')

    {{-- ############### Our Team ############### --}}
    @include('frontend.home.our_team')

@endsection
