<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Productos</title>
</head>
<body>
    <h1>Agregar Productos</h1>
    <form action="{{ route('agregarproductos') }}" method="POST">
        @csrf
        <label for="nombre">Nombre del Producto:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>
        
        <label for="precio">Precio:</label><br>
        <input type="number" id="precio" name="precio" required><br>
        
        <label for="stock">Stock:</label><br>
        <input type="number" id="stock" name="stock" required><br>
        
        <label for="descripcion">Categoria:</label><br>
        <select id="descripcion" name="descripcion" required>
            <option value="">Selecciona una categoría</option>
            <optgroup label="Herramientas Manuales">
                <option value="Herramientas Manuales">Herramientas Manuales</option>
                <option value="Herramientas Eléctricas">Herramientas Eléctricas</option>
            </optgroup>
            <optgroup label="Materiales Básicos">
                <option value="Materiales Básicos">Materiales Básicos</option>
                <option value="Acabados">Acabados</option>
            </optgroup>
            <optgroup label="Equipos de Seguridad">
                <option value="Equipos de Seguridad">Equipos de Seguridad</option>
                <option value="Accesorios Varios">Accesorios Varios</option>
            </optgroup>
        </select><br>
        
        <button type="submit">Agregar Producto</button>
    </form>
</body>
</html>
