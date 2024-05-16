@extends('adminlte::page')

@section('title', 'Movimientos')

@section('content_header')
    <center><h1 style="font-weight: bold; font-size: 32px; color: #333;">Ingresos y Egresos del Mes</h1></center>
@stop

@section('content')
    <div class="container">
        <canvas id="grafico"></canvas>
    </div>
@stop

@section('css')
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('grafico').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($salesLabels) !!}, // Nombres de los meses
                datasets: [{
                    label: 'Ventas',
                    data:{!! json_encode(array_values($salesData)) !!}, // Datos de ventas del mes
                    backgroundColor: 'rgba(0, 123, 255, 0.6)', // Azul para ventas
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 1
                }, {
                    label: 'Gastos',
                    data: {!! json_encode(array_values($expensesData)) !!}, // Datos de gastos del mes
                    backgroundColor: 'rgba(255, 0, 0, 0.6)', // Rojo intenso para gastos
                    borderColor: 'rgba(255, 0, 0, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)' // Color de la cuadrícula en el eje Y
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)' // Color de la cuadrícula en el eje X
                        }
                    }
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 10,
                        bottom: 10
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@stop
