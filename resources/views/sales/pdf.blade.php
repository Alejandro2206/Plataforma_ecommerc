<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Balance</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .ingresos {
            background-color: lightgreen;
        }
        .egresos {
            background-color: lightcoral;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <img src="assets/imgs/logo/lizcompanylogo.jpg" alt="" width="100px" height="100px">
                <h2 class="mt-2">Ingresos del Mes</h2>
                <p>Fecha de generación del reporte: {{ now()->format('d/m/Y') }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th colspan="2" style="background-color: #3498db; text-align: center;">Resumen general</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <h4>Ingresos</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>Total de ventas:</td>
                            <td style="color: green; font-weight: bold;">${{ number_format($totalVentasPagadas, 2, '.', ',') }}</td>


                        </tr>
                        <tr>
                            <td colspan="2">
                                <h4>Egresos</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>Total de gastos:</td>
                            <<td style="color: red; font-weight: bold;">-${{ number_format($totalGastosPagados, 2, '.', ',') }}</td>


                        </tr>
                        <tr>
                            <td colspan="2">
                                <h3></h3>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Balance total:</td>
                            <td style="font-weight: bold;">${{ number_format($balance, 2, '.', ',') }}</td>


                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h3 class="mb-3">Resumen de ingresos</h3>
                <div class="ingresos">
    <p>Número de ventas: {{ $sales->where('status', 'Pagado')->count() }}</p>
    @php
        $totalVentasPagadas = 0;
        foreach($sales->where('status', 'Pagado') as $sale) {
            $totalVentasPagadas += $sale->total_amount;
        }
    @endphp
    <p>Total de ventas: ${{ number_format($totalVentasPagadas, 2, '.', ',') }}</p>

</div>

            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h3 class="mb-3">Resumen de egresos</h3>
                <div class="egresos">
                <p>Número de gastos: {{ count($gastos) }}</p>
                    @php
                        $totalGastosPagados = 0;
                        foreach($gastos as $gasto) {
                            $totalGastosPagados += $gasto->valor;
                        }
                    @endphp
                   <p>Total de gastos: ${{ number_format($totalGastosPagados, 2, '.', ',') }}</p>

                </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
