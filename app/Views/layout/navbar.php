<header class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img id="logo" src="<?= base_url() ?>/assets/img/logo.jpeg" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Mapel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Fitur Belajar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tentang</a>
                </li>
                <form method="" class="mr-2 my-auto form-width d-inline-block">
                    <div class="input-group">
                        <span class="input-group-append">
                            <button class="btn cari border border-right-0" type="submit" name="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                        <input type="text" class="form-control border border-left-0" placeholder="Cari Materi Pelajaran" name="keyword">
                    </div>
                </form>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <i class="fa fa-bell"></i>
                </li>
                <li class="nav-item">
                    <i class="fas fa-envelope"></i>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="btn btn-waring dropdown-toggle nav-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="profile" src="<?= base_url() ?>/assets/img/profile-default.png">
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>