<div>
    <div id="clients" class="the-clients">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="section-heading">
                        <h4>Check What <em>The Clients Say</em> About Our App Dev</h4>
                        <img src="{{ asset('assets/assets/images/heading-line-dec.png') }}" alt="">
                        <select name="year" class="form-control" wire:change="$emit('changeYear', $event.target.value)">
                            @for($i = 0; $i < count($years); $i++)
                                <option value="{{ $years[$i] }}">{{ $years[$i] }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div id="graphic"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        const chart = Highcharts.chart('graphic', {
            chart: {
                type: 'column'
            },
            title: {
                text: '',
                align: 'left'
            },
            xAxis: {
                categories: [
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
                ],
                crosshair: true,
                accessibility: {
                    description: 'Months'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total'
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: {!! $data !!}
        });

    </script>

    <script>
        window.addEventListener('chartChanged', (e) => {
            chart.update({
                series: JSON.parse(e.detail.item)
            });
        });
    </script>

@endpush
