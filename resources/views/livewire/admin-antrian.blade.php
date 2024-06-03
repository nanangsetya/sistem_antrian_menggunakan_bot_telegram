@push('styles')
    <style>
        .box-item {
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.07);
            padding: 10px 30px;
            background-color: #fff;
            border-radius: 40px;
            margin-bottom: 30px;
        }

        .box-item h4 a {
            font-size: 20px;
            font-weight: 700;
            margin-top: 8px;
            color: #2a2a2a;
            transition: all .3s;
        }

        .box-item p {
            margin-bottom: 0px;
        }

        .box-item:hover h4 a {
            color: #4b8ef1;
        }

    </style>

    <style>
        .border-button button {
            display: inline-block !important;
            padding: 10px 20px !important;
            color: #4b8ef1 !important;
            border: 1px solid #4b8ef1;
            text-transform: capitalize;
            font-size: 15px;
            display: inline-block;
            background-color: #fff;
            border-radius: 23px;
            font-weight: 500 !important;
            letter-spacing: 0.3px !important;
            transition: all .5s;
        }

        .border-button button:hover {
            background-color: #4b8ef1;
            color: #fff !important;
        }

    </style>
@endpush

<div>
    <div class="container" wire:poll>
        <div class="row">
            @foreach($queue as $q)
                <div class="col-lg col-md col-xs-12">
                    <div class="box-item">
                        <h4><a href="#">Antrian Sekarang : {{ $q->nomor }}</a></h4>
                    </div>
                    <div class="service-item first-service">
                        <img src="{{ asset('assets/assets/images/'.$q->icon.'.png') }}" alt="" class="icon" style="background-image: none">
                        <h4>{{ $q->deskripsi }}</h4>
                        <p>Total antrian : {{ $q->lastAntrian->nomor ?? 0 }}</p>
                        <div class="border-button">
                            <button wire:click="callAntrian({{ $q->id }})">Antrian Selanjutnya <i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
