<?php
session_start();
require_once __DIR__ . "/templates/header.php";
require_once __DIR__ . "/config/config.php";
require_once __DIR__ . "/controller/redirects/redirectIfBlocked.php";
?>

<head>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="/main/css/index.css">

</head>

<body>
    
    <?php if (isset($_GET['error'])): ?>
        <div class="error-global">
            <div class="error"><?php echo htmlspecialchars($_GET['error']); ?></div>
        </div>
    <?php endif; ?>
    <div class="options">
        
        <div class="option active"
             style="--optionImage: url('https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=1200');">
            <div class="label">
                <div class="icon"><i class="fas fa-network-wired"></i></div>
                <div class="info">
                    <div class="main">Redes y Conexiones</div>
                    <div class="sub">Infraestructura y comunicación de datos</div>
                </div>
            </div>
        </div>

        <div class="option"
             style="--optionImage: url('https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=1200');">
            <div class="label">
                <div class="icon"><i class="fas fa-database"></i></div>
                <div class="info">
                    <div class="main">Bases de Datos</div>
                    <div class="sub">Almacenamiento y gestión de la información</div>
                </div>
            </div>
        </div>

        <div class="option"
             style="--optionImage: url('https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=1200');">
            <div class="label">
                <div class="icon"><i class="fas fa-laptop-code"></i></div>
                <div class="info">
                    <div class="main">Desarrollo Web</div>
                    <div class="sub">Implantación y programación del proyecto</div>
                </div>
            </div>
        </div>

        <div class="option"
             style="--optionImage: url('https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=1200');">
            <div class="label">
                <div class="icon"><i class="fas fa-shield-alt"></i></div>
                <div class="info">
                    <div class="main">Ciberseguridad</div>
                    <div class="sub">Protección, roles y control de accesos</div>
                </div>
            </div>
        </div>

    </div>

    <script>
        const options = document.querySelectorAll(".option");
        let currentIndex = 0;

        // Manual click activation
        options.forEach((option, index) => {
            option.addEventListener("click", () => {
                setActive(index);
            });
        });

        // Function to activate selected slide
        function setActive(index) {
            options.forEach(o => o.classList.remove("active"));
            options[index].classList.add("active");
            currentIndex = index;
        }

        // Auto slide every 3 seconds
        setInterval(() => {
            currentIndex = (currentIndex + 1) % options.length;
            setActive(currentIndex);
        }, 10000);
    </script>

</body>

<?php
require_once __DIR__ . "/templates/footer.php";
?>