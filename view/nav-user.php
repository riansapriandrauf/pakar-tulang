<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="">CF- TULANG</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav m-auto">
                <a class="nav-link mx-4" href="">Home</a>
                <a class="nav-link mx-4" href="diagnosa">Diagnosa</a>
            </div>
            <?php
            if (!isset($_SESSION['level']) || empty($_SESSION['level']) || $_SESSION['level'] != 2) { ?>
                <div class='navbar-nav m-auto'>
                    <a class='nav-link mx-4' href='Login'>Login</a>
                </div>
            <?php
            } else { ?>
                <div class='dropdown'>
                    <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>
                        <?= $_SESSION['nama_pasien'] ?>
                    </button>
                    <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
                        <form action='' method='post'>
                            <li><a href="logout" class='dropdown-item'>Logout</a></li>
                        </form>
                    </ul>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</nav>