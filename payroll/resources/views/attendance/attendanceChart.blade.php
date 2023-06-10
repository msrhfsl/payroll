@extends('layouts.sideNav')
@section('content')

<head>
    <title>Attendance Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="attendanceChart" width="400" height="200"></canvas>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var months = @json($months);
            var attendancesCount = @json($attendancesCount);

            var ctx = document.getElementById("attendanceChart").getContext("2d");
            var myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: months,
                    datasets: [{
                        label: "Attendance Count",
                        data: attendancesCount,
                        backgroundColor: "rgba(75, 192, 192, 0.2)",
                        borderColor: "rgba(75, 192, 192, 1)",
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }
                }
            });
        });
    </script>
</body>
@endsection