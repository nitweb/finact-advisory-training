@extends('frontend.layout.user_master')
@section('meta')
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <title>About Us - Blissful Fashion </title>
    <!-- Flipbook StyleSheet -->
   <link href="{{ asset('frontend/dflip/css/dflip.min.css')}} " rel="stylesheet" type="text/css">

   <!-- Icons Stylesheet -->
   <link href="{{ asset('frontend/dflip/css/themify-icons.min.css')}}" rel="stylesheet" type="text/css">
   <style>
       ._df_thumb{
           margin: 0 auto;
           display: block;
           width: 300px;
           height: 360px;
       }
   </style>
@endsection


@section('user')
 <!-- page-title -->
 <div class="ttm-page-title-row ttm-bg ttm-bgimage-yes ttm-bgcolor-darkgrey clearfix">
    <div class="ttm-row-wrapper-bg-layer ttm-bg-layer"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="ttm-page-title-row-inner">
                    <div class="page-title-heading">
                        <h2 class="title">Company Profile</h2>
                    </div>
                    <div class="breadcrumb-wrapper">
                        <span>
                            <a title="Homepage" href="{{ url('/') }}">Home</a>
                        </span>
                        <span>Company Profile</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page-title end -->
<section class="ttm-row project-single-section clearfix">
   <div class="container">
       <div class="row">
           <div class="col-md-12">
                @php
                    $profile_pdf = App\Models\CompanyProfile::latest()->first();
                @endphp
                   <div class="_df_thumb" id="df_manual_thumb" height="100%" source="{{ asset('upload/company_profile/' . $profile_pdf->company_profile) }}" thumb="{{ asset('upload/thumbnail.png')}}"> Blissful Company Profile</div >
        <!-- Refer to other examples on how to create different types of flipbook -->
           </div>
       </div>
</section>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> 

   <!-- Flipbook main Js file -->
   <script src="{{asset('frontend/dflip/js/dflip.min.js')}}" type="text/javascript"></script>
@endsection
