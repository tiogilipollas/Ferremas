import express from 'express';
import { createConnection } from 'mysql2/promise';
import bodyParser from 'body-parser';

const app = express();

// Middleware para configurar CORS
app.use((req, res, next) => {
    res.setHeader('Access-Control-Allow-Origin', 'https://ferremas.test');
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
    res.setHeader('Access-Control-Allow-Headers', 'Content-Type');
    next();
});

// Ruta para manejar la solicitud de compra
app.post('/purchase', (req, res) => {
    try {
        // Lógica para procesar la compra y actualizar el stock
        // Esto puede involucrar interacciones con la base de datos u otros servicios

        // Ejemplo de respuesta exitosa
        res.status(200).json({ message: 'Compra exitosa' });

    } catch (error) {
        console.error('Error al procesar la compra:', error);
        // Manejar errores y devolver respuesta adecuada
        res.status(500).json({ error: 'Error al procesar la compra' });
    }
});

// Middleware para manejar datos JSON
app.use(bodyParser.json());

// Ruta para obtener el stock de un producto
app.get('/get-stock', async (req, res) => {
    const productName = req.query.name;
    try {
        const stock = await getStockForProduct(productName);
        res.json({ stock });
    } catch (error) {
        console.error('Error al obtener el stock del producto:', error);
        res.status(500).json({ error: 'Error al obtener el stock del producto' });
    }
});

// Función para obtener el stock de un producto por su nombre
async function getStockForProduct(name) {
    const dbConfig = {
        host: 'localhost',
        user: 'root',
        database: 'ferremas',
        password: ''
    };

    let connection;
    try {
        connection = await createConnection(dbConfig);
        const [rows] = await connection.execute('SELECT stock FROM Productos WHERE nombre = ?', [name]);
        if (rows.length > 0) {
            return rows[0].stock; // Retorna el stock del producto
        } else {
            throw new Error('Producto no encontrado');
        }
    } catch (error) {
        console.error('Error al obtener el stock del producto:', error.message);
        throw error; // Propaga el error
    } finally {
        if (connection) {
            await connection.end(); // Asegúrate de cerrar la conexión
        }
    }
}

// Configuración de puerto y escucha del servidor
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Servidor escuchando en http://localhost:${PORT}`);
});
