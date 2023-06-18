@extends('layouts.sideNav')
@section('content')

<head>
    <title>Attendance Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        canvas {
            background-color: #f5f5f5;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <canvas id="attendanceChart" width="400" height="200"></canvas>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var months = {!! json_encode($months) !!};
            var attendancesCount = {!! json_encode($attendancesCount) !!};

            var ctx = document.getElementById("attendanceChart").getContext("2d");
            var myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: months,
                    datasets: [{
                        label: "Attendance Count",
                        data: attendancesCount,
                        backgroundColor: "rgba(24, 58, 110, 1)", // Dark blue color
                        borderWidth: 0
                    }]
                },
            });
        });
    </script>
</body>
@endsection
