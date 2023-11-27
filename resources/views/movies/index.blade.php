<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Películas</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            display: block;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        main {
            display: flex;
            justify-content: center;
        }

        h1 {
            color: #3498db;
        }

        table {
            align-items: center;
            justify-content: center;
            width: 80%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1>Listado de Películas</h1>
       <main>
        <table border="1">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Genero(s)</th>
                    <th>Lenguaje</th>
                    <th>Titulo original</th>
                    <th>Resumen</th>
                    <th>Poster</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($movies as $movie)
                <tr>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->genreNames }}</td>
                    <td>{{ $movie->original_language }}</td>
                    <td>{{ $movie->original_title }}</td>
                    <td>{{ $movie->overview }}</td>
                    <td>
                        <img src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" alt="Poster de la Película" style="width: 100px; height: auto;">
                    </td>
                    <td>
                        <a href="{{ route('editMovie', ['id' => $movie->id]) }}">Editar</a>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('deleteMovie', ['id' => $movie->id]) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Estás seguro?')">Borrar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>
</html>