<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Película</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
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

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h1 {
            color: #3498db;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <h1>Editar Película</h1>
    <main>
        
        <form method="POST" action="{{ route('updateMovie', ['id' => $movie->id]) }}">
            @csrf
            @method('PUT')
            
            <label for="title">Nombre:</label>
            <input type="text" id="title" name="title" value="{{ $movie->title }}" required>
            
            <label for="original_language">Lenguaje:</label>
            <input type="text" id="original_language" name="original_language" value="{{ $movie->original_language }}" required>
            
            <label for="original_title">Título Original:</label>
            <input type="text" id="original_title" name="original_title" value="{{ $movie->original_title }}" required>

            <label for="overview">Resumen:</label>
            <textarea style="height: 200px;" id="overview" name="overview" required>{{ $movie->overview }}</textarea>
            
            <label for="poster_path">Poster:</label>
            <input type="text" id="poster_path" name="poster_path" value="{{ $movie->poster_path }}" required>
            
            <button type="submit">Guardar Cambios</button>
        </form>
    </main>
</body>
</html>