@extends('frontend.dashboard')
@section('frontend_title', 'Home')
@section('frontend_content')

    {{-- Hero Section --}}
    @include('frontend.home.01_hero')

    {{-- What We Do Section --}}
    @include('frontend.home.02_what_we_do')

    {{-- Services Section --}}
    @include('frontend.home.03_services')

    {{-- Counter Section --}}
    @include('frontend.home.04_counter')

    {{-- Why Choose Us Section --}}
    @include('frontend.home.05_why_choose_us')

    {{-- Global Remote Finance Section --}}
    @include('frontend.home.06_global_remote_finance')

    {{-- Testimonials Section --}}
    @include('frontend.home.07_testimonials')

    {{-- Blog Section --}}
    @include('frontend.home.08_blog')

    {{-- Call To Action Section --}}
    @include('frontend.home.09_call_to_action')

@endsection
