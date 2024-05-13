<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banime</title>
    <?= $this->renderSection('css') ?>
    <link rel="icon" href="/Assets/BanimeLogo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <?= $this->renderSection('head') ?>
</head>

<body>
    <header>
        <div class="header"></div>
        <nav>
            <img src="/Assets/Banime.png" alt="Profile" id="Logo">
            <div class="list-menu" id="listMenu">
                <i class="ph ph-list"></i>
            </div>

            <div class="navall navHidden" id="navList">
                <div class="Nav">
                    <a href="/"> HOME</a>
                    <a href="/katagori.php"> CATEGORIES</a>
                    <a href="/about.php"> ABOUT US</a>
                </div>
                <div class="Search">
                    <form method="get" action="index.php">
                        <input class="input hidden" type="text" name="search" id="input" placeholder="Search">
                    </form>
                    <i class="ph ph-magnifying-glass" id="search"></i>
                </div>
            </div>

            <div class="Login">
                <i class="ph ph-user-circle" onclick="toggleMenu()"></i>
            </div>

            <div class="sub-menu-warp" id="subMenu">
                <div class="sub-menu">
                    <div class="user-info">
                        <i class="ph ph-user-circle"></i>
                        <h2>Profile</h2>
                    </div>
                    <hr>

                    <a href="/Admin/login.php" class="sub-menu-link">
                        <i class="ph ph-key"></i>
                        <p>Admin Area</p>
                        <span>❯</span>
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="wrapper">
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 Banime. All rights reserved.</p>
    </footer>

    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <?= $this->renderSection('js') ?>
    <?= $this->renderSection('scripts') ?>
</body>

</html>
