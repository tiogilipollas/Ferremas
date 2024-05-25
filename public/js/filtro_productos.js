$(document).ready(function() {
    // Manejar el envío del formulario de filtrado
    $('#filtroForm').on('submit', function(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto

        // Obtener el valor seleccionado del campo de categoría
        var categoria = $('#categoria').val();

        // Realizar una solicitud GET al servidor para obtener la lista de productos filtrada por categoría
        $.get("{{ route('productos.listar') }}", { categoria: categoria })
            .done(function(data) {
                // Actualizar la lista de productos en la vista con los datos recibidos del servidor
                $('#listaProductos').html(data);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                // Manejar los errores en caso de que la solicitud falle
                console.error('Error al cargar la lista de productos:', textStatus, errorThrown);
            });
    });
});
