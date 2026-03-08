<?php
session_start();
require_once __DIR__ . "/templates/header.php";
require_once __DIR__ . "/config/config.php";
require_once __DIR__ . "/controller/redirects/redirectIfBlocked.php";
?>
<?php if (isset($_GET['error'])): ?>
        <div class="error"><?php echo htmlspecialchars($_GET['error']); ?></div>
<?php endif; ?>

<head>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="/main/css/index.css">

</head>
<body>

    <div class="options">
        <div class="option active"
             style="--optionImage: url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=1200');">
            <div class="label">
                <div class="icon"><i class="fas fa-walking"></i></div>
                <div class="info">
                    <div class="main">Nature Walk</div>
                    <div class="sub">Beautiful mountain scenery</div>
                </div>
            </div>
        </div>

        <div class="option"
             style="--optionImage: url('https://images.unsplash.com/photo-1470770841072-f978cf4d019e?w=1200');">
            <div class="label">
                <div class="icon"><i class="fas fa-tree"></i></div>
                <div class="info">
                    <div class="main">Forest</div>
                    <div class="sub">Green & peaceful environment</div>
                </div>
            </div>
        </div>

        <div class="option"
             style="--optionImage: url('https://images.unsplash.com/photo-1482192596544-9eb780fc7f66?w=1200');">
            <div class="label">
                <div class="icon"><i class="fas fa-mountain"></i></div>
                <div class="info">
                    <div class="main">Mountains</div>
                    <div class="sub">Snowy high peaks</div>
                </div>
            </div>
        </div>

        <div class="option"
             style="--optionImage: url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=1200');">
            <div class="label">
                <div class="icon"><i class="fas fa-water"></i></div>
                <div class="info">
                    <div class="main">Lake View</div>
                    <div class="sub">Calm and relaxing water</div>
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


