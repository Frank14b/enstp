<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>VIRTEK | Acceuil</title>

    <!-- Favicon  -->
    <link rel="icon" href="<?=base_url()?>assets/img/core-img/favicon.ico">

    <!-- Style CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/style.css">

</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader">
        <div class="preload-content">
            <div id="world-load"></div>
        </div>
    </div>
    <!-- Preloader End -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg">
                        <!-- Logo -->
                        <a class="navbar-brand" href="<?=base_url()?>assets/index.html"><img src="<?=base_url()?>assets/img/core-img/logo.png" alt="ENSTP" style="width:70%"></a>
                        <!-- Navbar Toggler -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#worldNav" aria-controls="worldNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <!-- Navbar -->
                        <div class="collapse navbar-collapse" id="worldNav">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item <?php if($title == "acceuil") echo 'active' ?>">
                                    <a class="nav-link" href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? "fr"?>"><i class="fa fa-home"></i> <?= t('acceuil') ?> <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item <?php if($title == "Connexion") echo 'active' ?>">
                                    <a class="nav-link" href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? "fr"?>/connexion"><i class="fa fa-sign-in"></i> <?=ucfirst(t('connexion'))?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? "fr"?>/Documentation"><i class="fa fa-book"></i> Documents & Livres</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? "fr"?>/Contacts"><i class="fa fa-phone"></i> <?=ucfirst(t('contacts'))?></a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="<?=base_url()?>assets/#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Fr</a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#">Fr</a>
                                        <a class="dropdown-item" href="#">En</a>
                                    </div>
                                </li>
                            </ul>
                            <!-- Search Form  -->
                            <div id="search-wrapper">
                                <form action="#">
                                    <input type="text" id="search" placeholder="Search something...">
                                    <div id="close-icon"></div>
                                    <input class="d-none" type="submit" value="">
                                </form>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
