@extends('templates.mobile')

@section('body_class', 'sc5-2')

@section('content')

    <div class="body-overlay" id="body-overlay"></div>

    <div class="term-condition-page">
        <div class="container">
            <a class="btn back-page-btn" href="{{ route('mobile-intro') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3>E-SIAGA</h3>
            <h4>Terms and Conditions</h4>
            <p>Turpis venenatis sagittis accum san commodo. Aliquet a elementum pellentesque porta luctus ultricies. Vestibulum ac dignissim ultrices donec quam sapien mattis libero. Phasellus vitae diam sagittis nisi egestas ultrices vel eros iaculis. Arcu nulla non feugiat arcu tellus accumsan imperdiet neque dapibus. Sem ornare ac cras justo risus sit dignissim risus at.
                Lorem ipsum dolor sit amet consectetur. Sed nisi et in urna tellus ac. Turpis venenatis sagittis accum san commodo. Aliquet a elementum pellentesque porta luctus ultricies. Vestibulum ac dignissim ultrices donec quam sapien
                mattis libero. Phasellus vitae diam sagittis nisi egestas ultrices vel eros iaculis. Arcu nulla non feugiat arcu tellus accumsan imperdiet neque dapibus. Sem ornare ac cras justo risus sit dignissim risus at.</p>
            <div class="btn-wrap">
                <a class="btn btn-border" href="{{ route('mobile-landing') }}">Cancel</a>
                <a class="btn btn-base" href="{{ route('mobile-register') }}">Agree</a>
            </div>
        </div>
    </div>

    <!-- back-to-top end -->
    <div class="back-to-top">
        <span class="back-top"><i class="fas fa-angle-double-up"></i></span>
    </div>

@endsection
