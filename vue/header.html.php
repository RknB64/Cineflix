<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $titre ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">   
    <link rel="stylesheet" href="static/css/style.css" type="text/css" media="screen" />
</head>

<body class="body bg-secondary">

    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="" alt="CINEFLIX" width="30" height="24" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white-50" aria-current="page" href="#">ACCUEIL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white-50" href="#">CATALOGUE</a>
                    </li>
                </ul>
                <form class="d-flex flex-column" role="connexion">
                    
                        <button class="btn btn-secondary btn-sm" type="submit">Sign In / Sing Up</button>
                    
                </form>
            </div>
        </div>
    </nav>

    <form class="d-flex d-inline-block justify-content-evenly mt-4">
        <div class="d-flex d-inline-block">
            <input class="form-control me-2" type="search" placeholder="Rechercher par titre..." aria-label="Search">
            <button class="btn btn-dark btn-sm" type="submit">Search</button>
        </div>
        <div class="d-flex d-inline-block">
            <input class="form-control me-2" type="search" placeholder="Rechercher par ville..." aria-label="Search">
            <button class="btn btn-dark btn-sm" type="submit">Search</button>
        </div>
    </form>

    <div id="corps">
