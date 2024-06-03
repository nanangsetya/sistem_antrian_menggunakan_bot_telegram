<div wire:poll>
    <div class="col-lg-8 offset-lg-2">
        <div class="section-heading">
            <h4>Antrian <em>Sekarang</em></h4>
            <img src="{{ asset('assets/assets/images/heading-line-dec.png') }}" alt="">
        </div>
    </div>

    <div class="col-12">
        <div class="row">
            @foreach($queue as $q)
                <div class="col-lg">
                    <div class="pricing-item-pro">
                        <span class="price">{{ $q->nomor }}</span>
                        <h4>{{ $q->deskripsi }}</h4>
                        <div class="icon">
                            <img src="{{ asset('assets/assets/images/'.$q->icon.'.png') }}" alt="">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-lg-8 offset-lg-2 mt-3">
        <div class="section-heading">
            <h4>Jumlah <em>Antrian</em></h4>
            <img src="{{ asset('assets/assets/images/heading-line-dec.png') }}" alt="">
        </div>
    </div>

    <div class="col-12">
        <div class="row">
            @foreach($total as $t)
                <div class="col-lg">
                    <div class="pricing-item-pro">
                        <span class="price">{{ $t->nomor }}</span>
                        <img src="{{ asset('assets/assets/images/'.$t->icon.'.png') }}" alt="" style="max-width: 50px">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
