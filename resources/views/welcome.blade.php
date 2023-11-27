<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            width: 100%;
            text-align: center;
        }

        h1 {
            color: #3498db;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.2em;
            margin-bottom: 20px;
            text-align: center;
            width: 60%;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #2980b9;
        }
        </style>
    </head>
    <body class="antialiased">
            <h1>Prueba admission</h1>
            <p>Se requiere consultar las peliculas que se encuentran en cartelera mediante un API especializada para ello, las peliculas que se recuperen del endpoint se deben almacenar en una tabla de base de datos; motor que el desarrollador prefiera para que se puedan visulizar mediante una grilla en la vista del framework.</p>
            <h5>Para almacenar las peliculas que se encuentran en la cartelera de la API, haga click en el boton 'Obtener datos'</h5>
            <a href="{{ route('getMovies') }}">Obtener Datos</a>
    </body>
</html>
