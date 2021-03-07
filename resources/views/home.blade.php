@extends('layouts.app')
@section('title')
    Dashboard
@endsection

@section('content')
    <div id="chart-pelanggan">

    </div>
@endsection

@section('js')
<script src="https://code.highcharts.com/highcharts.src.js"></script>
<script>
    Highcharts.chart('chart-pelanggan', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Grafik Aktivasi {{$tahun}}'
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Banyak Data Masuk'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Pelanggan',
        data: [{!! $data['1'] !!}, {!! $data['2'] !!}, {!! $data['3'] !!}, {!! $data['4'] !!}, {!! $data['5'] !!}, {!! $data['6'] !!}, {!! $data['7'] !!}, {!! $data['8'] !!}, {!! $data['9'] !!}, {!! $data['10'] !!}, {!! $data['11'] !!}, {!! $data['12'] !!}]
    }]
});
</script>
@endsection