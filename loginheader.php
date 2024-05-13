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

        <!-- Tampilan header saat user sudah login -->
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
                <hr>

                <!-- Ganti link dan isi sub-menu sesuai dengan kebutuhan -->
                <div class="button-nav">
                    <button onclick="window.location=('/logout.php')">Logout</button>
                </div>
            </div>
        </div>
    </nav>
</header>
