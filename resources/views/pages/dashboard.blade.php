@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="card iq-mb-3">
                <div class="card-body">
                    <h4 class="card-title">Monitoring Sensor Gas</h4>
                    <p class="card-text">Grafik berikut adalah monitoring sensor gas 3 menit terakhir.</p>

                    <div id="monitoringGas"></div>

                    <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6">
            <div class="card iq-mb-3">
                <div class="card-body">
                    <h4 class="card-title">Monitoring Sensor Hujan</h4>
                    <p class="card-text">Grafik berikut adalah monitoring sensor hujan 3 menit terakhir.</p>

                    <div id="monitoringHujan"></div>

                    <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="card iq-mb-3">
                <div class="card-body">
                    <h4 class="card-title">Monitoring Sensor Suhu</h4>
                    <p class="card-text">Grafik berikut adalah monitoring sensor suhu 3 menit terakhir.</p>

                    <div id="monitoringSuhu"></div>

                    <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6">
            <div class="card iq-mb-3">
                <div class="card-body">
                    <h4 class="card-title">Monitoring Sensor Kelembapan</h4>
                    <p class="card-text">Grafik berikut adalah monitoring sensor kelembapan 3 menit terakhir.</p>

                    <div id="monitoringKelembapan"></div>

                    <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script>
        let chartGas, ChartHujan, ChartSuhu, ChartKelembapan;
        const updateInterval = 1000; // 1 detik


        async function requestMonitoringGas() {
            // load data
            const result = await fetch("{{ route('api.sensors.mq.index') }}");

            if (result.ok) {
                // cek jika berhasil
                const data = await result.json();
                const sensorData = data.data;

                // parse data
                const date = sensorData[0].created_at;
                const value = sensorData[0].value;

                // membuat point
                const point = [new Date(date).getTime(), Number(value)];

                // menambahkan point ke chart
                const series = chartGas.series[0],
                    shift = series.data.length > 20;
                // shift if the series is
                // longer than 20

                // add the point
                chartGas.series[0].addPoint(point, true, shift);

                // refresh data setiap x detik
                setTimeout(requestMonitoringGas, updateInterval); //1000ms = 1 detik
            }
        }

        async function requestMonitoringHujan() {
            // load data
            const result = await fetch("{{ route('api.sensors.mq.index') }}");

            if (result.ok) {
                // cek jika berhasil
                const data = await result.json();
                const sensorData = data.data;

                // parse data
                const date = sensorData[0].created_at;
                const value = sensorData[0].value;

                // membuat point
                const point = [new Date(date).getTime(), Number(value)];

                // menambahkan point ke chart
                const series = chartHujan.series[0],
                    shift = series.data.length > 20;
                // shift if the series is
                // longer than 20

                // add the point
                chartHujan.series[0].addPoint(point, true, shift);

                // refresh data setiap x detik
                setTimeout(requestMonitoringHujan, updateInterval); //1000ms = 1 detik
            }
        }

        async function requestMonitoringSuhu() {
            // load data
            const result = await fetch("{{ route('api.sensors.mq.index') }}");

            if (result.ok) {
                // cek jika berhasil
                const data = await result.json();
                const sensorData = data.data;

                // parse data
                const date = sensorData[0].created_at;
                const value = sensorData[0].value;

                // membuat point
                const point = [new Date(date).getTime(), Number(value)];

                // menambahkan point ke chart
                const series = chartSuhu.series[0],
                    shift = series.data.length > 20;
                // shift if the series is
                // longer than 20

                // add the point
                chartSuhu.series[0].addPoint(point, true, shift);

                // refresh data setiap x detik
                setTimeout(requestMonitoringSuhu, updateInterval); //1000ms = 1 detik
            }
        }

        async function requestMonitoringKelembapan() {
            // load data
            const result = await fetch("{{ route('api.sensors.mq.index') }}");

            if (result.ok) {
                // cek jika berhasil
                const data = await result.json();
                const sensorData = data.data;

                // parse data
                const date = sensorData[0].created_at;
                const value = sensorData[0].value;

                // membuat point
                const point = [new Date(date).getTime(), Number(value)];

                // menambahkan point ke chart
                const series = chartKelembapan.series[0],
                    shift = series.data.length > 20;
                // shift if the series is
                // longer than 20

                // add the point
                chartKelembapan.series[0].addPoint(point, true, shift);

                // refresh data setiap x detik
                setTimeout(requestMonitoringKelembapan, updateInterval); //1000ms = 1 detik
            }
        }

        window.addEventListener('load', function() {
            chartGas = new Highcharts.Chart({
                chart: {
                    renderTo: 'monitoringGas',
                    defaultSeriesType: 'spline',
                    events: {
                        load: requestMonitoringGas
                    }
                },
                title: {
                    text: ''
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Value',
                        margin: 20
                    }
                },
                series: [{
                    name: 'Sensor Gas',
                    data: []
                }]
            });

            chartHujan = new Highcharts.Chart({
                chart: {
                    renderTo: 'monitoringHujan',
                    defaultSeriesType: 'spline',
                    events: {
                        load: requestMonitoringHujan
                    }
                },
                title: {
                    text: ''
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Value',
                        margin: 20
                    }
                },
                series: [{
                    name: 'Sensor Hujan',
                    data: []
                }]
            });

            chartSuhu = new Highcharts.Chart({
                chart: {
                    renderTo: 'monitoringSuhu',
                    defaultSeriesType: 'spline',
                    events: {
                        load: requestMonitoringSuhu
                    }
                },
                title: {
                    text: ''
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Value',
                        margin: 20
                    }
                },
                series: [{
                    name: 'Sensor Suhu',
                    data: []
                }]
            });

            chartKelembapan = new Highcharts.Chart({
                chart: {
                    renderTo: 'monitoringKelembapan',
                    defaultSeriesType: 'spline',
                    events: {
                        load: requestMonitoringKelembapan
                    }
                },
                title: {
                    text: ''
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Value',
                        margin: 20
                    }
                },
                series: [{
                    name: 'Sensor Kelembapan',
                    data: []
                }]
            });

        });
    </script>
@endpush
