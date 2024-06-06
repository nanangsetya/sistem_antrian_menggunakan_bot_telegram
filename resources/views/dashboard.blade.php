@extends('master')

@section('content')
<div id="services" class="services section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
                    <h4>Dashboard <em>Antrian</em></h4>
                    <img src="assets/images/heading-line-dec.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <livewire:admin-antrian />
</div>

<livewire:show-graphic />
@endsection
