<!DOCTYPE html>
<html>
<head>
    <title>Ejercicios</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Explorar Ejercicios</h1>

    <label for="bodyPart">Seleccionar parte del cuerpo:</label>
    <select id="bodyPart">
        <option value="">Selecciona una parte del cuerpo</option>
        @foreach ($bodyParts as $bodyPart)
            <option value="{{ $bodyPart }}">{{ $bodyPart }}</option>
        @endforeach
    </select>

    <div id="exercises-list"></div>

    <script>
        $(document).ready(function() {
            $('#bodyPart').change(function() {
                const bodyPart = $(this).val();
                if (bodyPart) {
                    $.get(`/api/exercises/bodypart/${bodyPart}`, function(data) {
                        $('#exercises-list').html('');
                        data.forEach(exercise => {
                            $('#exercises-list').append(`<p>${exercise.name}</p>`);
                        });
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        $('#exercises-list').html(`<p>Error al cargar los ejercicios: ${textStatus}</p>`);
                    });
                }
            });
        });
    </script>
</body>
</html>