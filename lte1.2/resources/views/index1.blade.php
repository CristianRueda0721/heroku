<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="wild=device-width, initial-scale=1.0" />
    <title>Servicentro La 22</title>
    <link rel="stylesheet" href="{{asset('css/css.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="js/script.js"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <style>

        a{
            text-decoration: none;
        }
    </style>




</head>

<body>

<header class="header">

<a href="#" class="logo">

<img src="{{ asset('Imagenes/logo.PNG') }}" alt="">
</a>

<nav class="navbar">
    <a href="#home">Inicio</a>
    <a href="#about">Acerca de Nosotros</a>
    <a href="#products">Nuestro Portafolio</a>
    <a href="#contact">Contactanos</a>






</nav>



<!--Seccion Log-IN -->

<div class="navbar">
    <div>
    <a href="{{ url('/login') }}"> Ingresar </a>

<a href="{{ url('/register') }}"> Registrarse </a>
    </div>

<!--Seccion Log-IN -->


<div class="fas fa-bars" id="menu-btn"></div>

</div>



</header>



<div id="home">
    <div class="slider">
        <div class="myslide " style="display: block;">
            <div class="txt">
            <h3>Servicentro La 22</h3>
            <p>¡Hola!<br> Contamos con servicio de mantenimiento correctivo o
                preventivo para tu vehículo, y adelantamos cualquier procedimiento de mecánica general.</p>
            <a href="#" class="btn">Obten nuestros servicios</a>
        </div>
        <img src="{{ asset('Imagenes/silhouette-black-sports-car-with-headlights-black-background.jpg') }}" style="width: 100%;height: 100%;">
        </div>

        <div class="myslide ">
            <div class="txt">
            <h3>Nuestra especialidad</h3>
            <p><br>Nuestro taller se espicializa exclusivamente en reparacion en automoviles y vehiculos pesados.</p>
        </div>
        <img src="{{ asset('Imagenes/ff44760a-4fa9-4c29-9bd3-6fd91bd981d0.png') }}" style="width: 100%;height: 100%;">
        </div>

        <div class="myslide ">
            <div class="txt">
            <h3>Nuestros Mecanicos</h3>
            <p><br>Nuestros mecanicos cuentan con gran profecionalidad a los vehiculos a nuestros clientes.</p>
        </div>
        <img src="{{ asset('Imagenes/3f177e4a-94b9-437a-879d-d98f3de92a52.png') }}" style="width: 100%;height: 100%;">
        </div>

        <div class="myslide ">
            <div class="txt">
            <h3>¿Por que nosotros?</h3>
            <p><br>Servicentro La 22 Siempre brinda calidad y elegancia a nuestros servicios. </p>
        </div>
        <img src="{{ asset('Imagenes/luxurious-car-parked-highway-with-illuminated-headlight-sunset.jpg') }}" style="width: 100%;height: 100%;">
        </div>

        <div class="myslide">
            <div class="txt">
            <h3>¡Cuente con Nosotros!</h3>
            <p><br>Cuente con la confianza y el respaldo de su vehiculo de cada uno de nuestros procuctos.</p>
        </div>
        <img src="{{ asset('Imagenes/51a728de-bf48-4fb2-9022-504e557cedb4.png') }}" style="width: 100%; height: 100%;">
        </div>


        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

         <div class="dotsbox" style="text-align: center;">
            <span class="dot" onclick="currentSlide(1)"></span>
			<span class="dot" onclick="currentSlide(2)"></span>
			<span class="dot" onclick="currentSlide(3)"></span>
			<span class="dot" onclick="currentSlide(4)"></span>
			<span class="dot" onclick="currentSlide(5)"></span>
        </div>

    </div>
</div>


<section class="about" id="about">
    <h1 class="heading"><span>Nuestra </span> Empresa</h1>
    <div class="row">
    <div class="imagen">
        <img src="{{ asset('Imagenes/auto-repairmen-examining-undercarriage-car-workshop.jpg') }}" alt="">
   </div>
   <div class="content">
    <h3>Servicentro La 22</h3>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis ipsam natus ex, accusamus dolorum dolore unde illo deserunt architecto perferendis delectus omnis atque reiciendis eveniet consectetur fuga quaerat necessitatibus rem.</p>

    <a href="#" class="btn">Volver a Inicio</a>



   </div>
</div>
</section>

<!--Seccion de Nuestro portafolio -->

<section class="menu" id="products">
    <h1 class="heading"> Nuestro  <span>Portafolio </span></h1>
<div class="box-container">
    <div class="box">
        <img src="{{ asset('Imagenes/Firmware-cuate.png') }}" alt="">
        <h3 >REPROGRAMACIÓN DE ECU y TCM</h3>
        <div class="price">$400.000</div>
        <a href="{{ url('/error404') }}" class="btn">Añadir</a>
    </div>
    <div class="box">
        <img src="{{ asset('Imagenes/Car accesories-bro.png') }}" alt="">
        <h3>MECANICA GENERAL</h3>
        <div class="price">$500.000 - $1.000.000</div>
        <a href="{{ url('/error404') }}" class="btn">Añadir</a>
    </div>
    <div class="box">
        <img src="{{ asset('Imagenes/Hybrid car-bro (1).png') }}" alt="">
        <h3>CAMBIOS DE ACEITE</h3>
        <div class="price">$750.000</div>
        <a href="{{ url('/error404') }}" class="btn">Añadir</a>
    </div>

</div>
</section>

<!--Seccion de Productos -->
<!--Seccion de Criticas -->

<!--Seccion de Contactos -->
<section class="contact" id="contact">
    <h1 class="heading"><span>Contactanos</span></h1>
    <div class="row">
        <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15908.013903949246!2d-74.106463!3d4.5933977!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f99d6c60415f5%3A0xf4d380c4ef5e83a3!2sAUTO%20SPORT%20DESiGN!5e0!3m2!1ses!2sco!4v1676292772880!5m2!1ses!2sco" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <form id="claimForm" action="{{ route('submitClaim') }}" method="POST">
    @csrf
    <h3>Tengamos Contacto</h3>
    <div class="inputBox">
        <span class="fas fa-user"></span>
        <input type="text" name="nombre" placeholder="Escribe tu nombre" required>
    </div>
    <div class="inputBox">
        <span class="fas fa-envelope-circle-check"></span>
        <input type="email" name="email" placeholder="E-mail" required>
    </div>
    <div class="inputBox">
        <span class="fas fa-phone"></span>
        <input type="tel" name="telefono" placeholder="Numero telefonico" required>
    </div>
    <div class="inputBox">
        <span class="fas fa-person"></span>
        <input type="text" name="identificacion" placeholder="Numero de identificación" required>
    </div>
    <div class="inputBox">
        <span class="fas fa-heading"></span>
        <input type="text" name="asunto" placeholder="Asunto" required>
    </div>
    <div class="inputBox">
        <span class="fas fa-message"></span>
        <textarea class="campo" name="mensaje" placeholder="Cuerpo del mensaje" rows="11" required></textarea>
    </div>

    <input type="submit" value="¡Envianos tu solicitud!" class="btn">

</form>


    </div>
</section>

<!--Seccion de Contactos -->
<!--Seccion de Final del Encabezado -->
<section class="footer">
    <div class="share">
        <a href="#" class="fa-brands fa-facebook-f"></a>
        <a href="#" class="fa-brands fa-twitter"></a>
        <a href="#" class="fa-brands fa-instagram"></a>

        <a href="#" class="fa-brands fa-linkedin-in"></a>

    </div>
    <div class="links">
    <a href="#home">Inicio</a>
    <a href="#about">Acerca de Nosotros</a>
    <a href="#products">Nuestro Portafolio</a>
    <a href="#contact">Contactanos</a>

    </div>
 <div class="credit">Creado por <span>GAES 4</span> / Sena - Sena Servicio Nacional de Aprendizaje </div>
</section>
<script src="{{ asset('js/Carrusel.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
