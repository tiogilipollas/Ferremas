<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferretería FERREMAS</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <span class="brand">FERREMAS</span>
            <ul class="nav-links">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Herramientas</a></li>
                <li><a href="{{ route('login') }}">Iniciar sesión</a></li>

            </ul>
        </div>
    </nav>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <h1 class="header-title">Bienvenido a FERREMAS</h1>
                <p class="header-description">Tu distribuidora de productos de ferretería y construcción en Santiago y todo Chile.</p>
            </div>
        </div>
    </header>

    <section class="featured-products">
    <div class="container">
        <h2 class="section-title">Productos Destacados</h2>
        <div class="product-grid">
            <div class="product">
                <img src="https://dojiw2m9tvv09.cloudfront.net/90227/product/aguarras-medio-litro3423.jpg" alt="Producto 1">
                <h3 class="product-title">Aguarras</h3>
                <p class="product-price">$3000</p>
            </div>
            <div class="product">
                <img src="https://www.uyustools.cl/wp-content/uploads/2017/01/MAT16YX_1.jpg" alt="Producto 2">
                <h3 class="product-title">Martillo</h3>
                <p class="product-price">$5000</p>
            </div>
            <div class="product">
                <img src="https://motosierraselbosque.cl/wp-content/uploads/2020/07/967-1569-78-1-scaled.jpg" alt="Producto 3">
                <h3 class="product-title">Motosierra</h3>
                <p class="product-price">$30000</p>
            </div>
        </div>
    </div>
</section>


<section class="product-categories">
    <div class="container">
        <h2 class="section-title">Categorías de Productos</h2>
        <div class="category-grid">
            <div class="category">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/82/Hand_tools.jpg/1200px-Hand_tools.jpg" alt="Categoría 1" class="category-image">
                <a href="#" class="category-link">
                    <span class="category-title">Herramientas</span>
                </a>
            </div>
            <div class="category">
                <img src="https://st3.depositphotos.com/1001335/14944/i/450/depositphotos_149444160-stock-illustration-materials-for-construction-3d-illustration.jpg" alt="Categoría 2" class="category-image">
                <a href="{{ route('materiales') }}" class="category-link">
                    <span class="category-title">Materiales</span>
                </a>
            </div>
        </div>
    </div>
</section>


    <section class="company-info">
        <div class="container">
            <h2 class="section-title">Sobre FERREMAS</h2>
            <p>Ferretería FERREMAS es una distribuidora de productos de ferretería y construcción establecida en Santiago desde la década de los 80. Contamos con 4 sucursales en la región metropolitana y 3 sucursales en regiones, con planes de expansión en todo Chile.</p>
            <p>En FERREMAS ofrecemos una amplia gama de productos, desde herramientas manuales y eléctricas, hasta materiales de construcción, pinturas, materiales eléctricos y accesorios diversos. Trabajamos con marcas reconocidas del sector, garantizando calidad y diversidad en nuestros productos.</p>
        </div>
    </section>


    <footer class="footer">
        <div class="container">
            <div class="footer-contact">
                <h3>Contacto</h3>
                <p>Dirección: Santiago, Chile</p>
                <p>Teléfono: +56 2 1234 5678</p>
                <p>Correo electrónico: info@ferremas.cl</p>
            </div>
            <div class="footer-links">
                <ul>
                    <li><a href="#">Acerca de nosotros</a></li>
                    <li><a href="#">Términos y condiciones</a></li>
                    <li><a href="#">Política de privacidad</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>
