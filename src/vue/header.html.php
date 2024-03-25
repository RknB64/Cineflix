<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $titre ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="static/css/style.css" type="text/css" media="screen" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="static/js/film.js"></script>


    <?php if (isset($stylesheet)) : ?>
        <link rel="stylesheet" href="static/css/<?= $stylesheet ?>.css" type="text/css" media="screen" />
    <?php endif; ?>

</head>

<body class="body bg-black">

    <nav class="navbar navbar-expand-lg bg-dark position-sticky top-0 start-0 z-3" data-bs-theme="dark" style="--bs-bg-opacity: .7;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="static/img/logo.png" alt="CINEFLIX" width="30" height="24" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="#">ACCUEIL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">CINEMA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">STREAMING</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" id="search-box"  method="GET">
                    <input class="form-control me-2" type="search" name="ville" placeholder="Rechercher un cinéma" aria-label="Search">
                    <div class="btn" data-bs-toggle="modal" data-bs-target="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>
                    </div>
                </form>


            </div>
        </div>
    </nav>
    <!-- Modal -->
    <div class="modal fade" data-bs-theme="dark" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header d-flex justify-content-around text-white">
                    <div>
                        <a href="" class="modal-title fs-5 link-offset-2 link-underline link-underline-opacity-0 text-white" id="exampleModalLabel">Se connecter</a>
                    </div>
                    <div>
                        <a href="" class="modal-title fs-5 link-offset-2 link-underline link-underline-opacity-0 text-white" id="exampleModalLabel">S'enregistrer</a>
                    </div>
                    <div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body text-white-50">
                    Accédez à votre programme de fidélité, vos réservations, vos rechargements et bien plus encore.
                    <hr>
                    <div class="input-group flex-nowrap bg-dark">
                        <span class="input-group-text bg-dark" id="addon-wrapping">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="bi bi-at" viewBox="0 0 16 16">
                                <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914" />
                            </svg>
                        </span>
                        <input type="text" class="form-control bg-dark-subtle" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
                    </div>
                    <br>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text bg-dark" id="addon-wrapping">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="bi bi-lock" viewBox="0 0 16 16">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1" />
                            </svg>
                        </span>
                        <input type="password" class="form-control bg-dark-subtle" placeholder="password" aria-label="password" aria-describedby="addon-wrapping">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-light" type="button">Connexion</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="corps">