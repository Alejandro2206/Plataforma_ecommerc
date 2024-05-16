<!doctype html>
<html lang="en">
<head>
    <title>Reporte de Usuarios</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous"
    />

    <style>
        /* Estilos para la tabla */
        table {
            width: 120%; /* Ajuste el porcentaje según sea necesario */
            border-collapse: collapse;
            border-top: 1px solid #000; /* Añadido para borde superior */
        }

        th, td {
            padding: 20px;
            text-align: left;
            border-bottom: 1px solid #000;
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

        th {
            background-color: #33A8FF;
            color: #000;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #ddd;
        }

        .mb-3 {
            margin-bottom: 1.5rem;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
<div class="row">
    <div class="col-md-12 text-center mb-4">
        <img src="assets/imgs/logo/lizcompanylogo.jpg" alt="" width="100px" height="100px">
        <h2 class="mt-2">Registro de Usuarios del Mes</h2>
        <p>Fecha de generación del reporte: {{ now()->format('d/m/Y') }}</p>
    </div>
</div>

<!-- Tabla para Ventas en Deuda -->

<h4 class="mb-3">Total de usuarios registrados: {{ $totalUsuarios }} </h4>
<?php
        $totalUsuarios = 0; 
    ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Correo Electrónico</th>
            <th>Fecha de registro</th>
        </tr>
    </thead>
    <tbody>
            @foreach ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ optional($usuario->created_at)->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
   
</table>

<!-- Bootstrap JavaScript Libraries -->
<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"
></script>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"
></script>
</body>
</html>
