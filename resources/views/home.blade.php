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
        text: 'Grafik Aktivasi'
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
        data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 100]
    }]
});
</script>
@endsection