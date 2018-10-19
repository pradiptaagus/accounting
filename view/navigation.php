<nav class="navbar fixed-top navbar-expand-lg navbar-dark indigo">
    <a class="navbar-brand" href="#">Accounting</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
      aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav ml-auto mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="cashier.php">Kasir</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false">Master Data</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="product.php">Barang</a>
                    <a class="dropdown-item" href="customer.php">Pelanggan</a>
                    <a class="dropdown-item" href="supplier.php">Supplier</a>
                    <a class="dropdown-item" href="user.php">User</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false">Konfigurasi</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="position.php">Jabatan</a>
                    <a class="dropdown-item" href="category.php">Kategori</a>
                    <a class="dropdown-item" href="unit.php">Satuan</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="country.php">Negara</a>
                    <a class="dropdown-item" href="province.php">Propinsi</a>
                    <a class="dropdown-item" href="city.php">Kota</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false"><?php echo $_SESSION['username'] ?></a>
                <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Profil</a>
                    <a class="dropdown-item" href="../controller/logout.php">Keluar</a>
                </div>
            </li>
        </ul>
    </div>
</nav>