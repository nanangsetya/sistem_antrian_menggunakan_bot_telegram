@extends('master')

@section('content')
<div id="pricing" class="pricing-tables">
    <div class="container">
        <div class="row">
            <livewire:show-antrian />
        </div>
    </div>
</div>

<div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6 align-self-center">
                        <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h2>Ambil Antrianmu Melalui Telegram</h2>
                                    <p>Klik tombol di bawah ini untuk menuju ke Bot Antrian.</p>
                                </div>
                                <div class="col-lg-12">
                                    <div class="white-button first-button scroll-to-section">
                                        <a href="https://web.telegram.org/k/#@AntreanCuciBot" target="_blank">Bot Antrian <i class="fab fa-telegram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                            <img src="{{ asset('images/slider.jpeg') }}" alt="" style="max-width: 400px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer id="newsletter">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="section-heading">
                    <h4>Info Lebih Lanjut</h4>
                </div>
            </div>
            <div class="col-lg-6 offset-lg-3">
                <form id="search" action="#" method="GET">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <fieldset>
                                <button type="button" class="main-button"><i class="far fa-envelope"></i> nsbbusiness01@gmail.com</button>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="copyright-text">
                    <p>Copyright © 2022 Chain App Dev Company. All Rights Reserved.
                        <br>Design: <a href="https://templatemo.com/" target="_blank" title="css templates">TemplateMo</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
@endsection
