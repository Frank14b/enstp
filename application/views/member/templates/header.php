<!DOCTYPE html>
<html lang="en">

<?php
$CI = &get_instance();
?>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>VIRTEK | <?= $title ?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=base_url()?>assets/admin/node_modules/mdi/css/materialdesignicons.min.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?=base_url()?>assets/admin/css/style.css">
  <!-- endinject -->
  <link rel="icon" href="<?=base_url()?>assets/img/core-img/favicon.ico">

  <link rel="stylesheet" href="<?=base_url()?>assets/mdb/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/mdb/css/mdb.min.css">

  <link href="<?php echo base_url(); ?>assets/zonestyle/css/croppie.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/zonestyle/css/cards.css" rel="stylesheet"/>
  <link href="<?php echo base_url(); ?>assets/zonestyle/css/form.css" rel="stylesheet"/>
  
  <link rel="stylesheet" href="<?=base_url()?>assets/print.css" type="text/css" media="print">
</head>

<body>

<style>
    html::-webkit-scrollbar-track,
    .scroll::-webkit-scrollbar-track {
        box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
        background-color: #aaa;
        border-radius: 0px;
        height: 8px;
        width: 8px;
        opacity: 0.5;
    }

    /* line 16, zonestyle.scss */

    html::-webkit-scrollbar,
    .scroll::-webkit-scrollbar {
        width: 8px;
        background-color: #f5f5f5;
        cursor: pointer;
        height: 8px;
    }

    /* line 23, zonestyle.scss */

    html::-webkit-scrollbar:hover,
    .scroll::-webkit-scrollbar:hover {
        width: 8px;
        background-color: #fff;
        cursor: pointer;
        height: 8px;
    }

    /* line 30, zonestyle.scss */

    html::-webkit-scrollbar-thumb,
    .scroll::-webkit-scrollbar-thumb {
        border-radius: 0px;
        background-color: #fff;
        cursor: pointer;
    }

    /* line 35, zonestyle.scss */

    HTML {
        overflow-x: hidden;
    }

    /* line 38, zonestyle.scss */

    .no_scroll {
        overflow: hidden;
    }

    /* line 41, zonestyle.scss */

    .scroll_v_h,
    .scroll_h_v {
        overflow: auto;
    }

    /* line 44, zonestyle.scss */

    .scroll_v {
        overflow-y: auto;
        overflow-x: hidden;
    }

    /* line 48, zonestyle.scss */

    .scroll_h {
        overflow-x: auto;
        overflow-y: hidden;
        height: 8px;
    }

    /* line 53, zonestyle.scss */

    .scroll_hover {
        transition-duration: 0.6s;
    }

    /* line 54, zonestyle.scss */

    .scroll_hover .scroll::-webkit-scrollbar {
        width: 0px;
        background-color: none;
        cursor: pointer;
        height: 0px;
    }

    /* line 63, zonestyle.scss */

    .scroll_hover:hover .scroll::-webkit-scrollbar {
        width: 8px;
        background-color: #fff;
        cursor: pointer;
        height: 8px;
    }

    /* line 69, zonestyle.scss */

    .scroll_hover:hover .scroll::-webkit-scrollbar-thumb {
        background-color: #f5f5f5;
    }

    /* line 73, zonestyle.scss */

    .scroll_bleu::-webkit-scrollbar-thumb {
        background-color: #229CDD;
        opacity: 0.5;
    }

    /* line 77, zonestyle.scss */

    .scroll_bleu::-webkit-scrollbar-track {
        background-color: #fff;
        opacity: 0.5;
        border: 1px solid lightblue;
    }

    /* line 82, zonestyle.scss */

    .scroll_bleu::-webkit-scrollbar {
        opacity: 0.5;
    }

    /* line 86, zonestyle.scss */

    .scroll_hover:hover .scroll_bleu::-webkit-scrollbar-thumb {
        background-color: #229CDD;
        opacity: 0.5;
    }

    /* line 90, zonestyle.scss */

    .scroll_hover:hover .scroll_bleu::-webkit-scrollbar-track {
        background-color: #fff;
        opacity: 0.5;
        border: 1px solid lightblue;
    }

    /* line 95, zonestyle.scss */

    .scroll_hover:hover .scroll_bleu::-webkit-scrollbar {
        opacity: 0.5;
    }

    /* line 100, zonestyle.scss */

    .scroll_noir::-webkit-scrollbar-thumb {
        background-color: #555;
        opacity: 0.5;
    }

    /* line 104, zonestyle.scss */

    .scroll_noir::-webkit-scrollbar-track {
        background-color: #fff;
        opacity: 0.5;
        border: 1px solid #aaa;
    }

    /* line 109, zonestyle.scss */

    .scroll_noir::-webkit-scrollbar {
        opacity: 0.5;
    }

    /* line 113, zonestyle.scss */

    .scroll_hover:hover .scroll_noir::-webkit-scrollbar-thumb {
        background-color: #555;
        opacity: 0.5;
    }

    /* line 117, zonestyle.scss */

    .scroll_hover:hover .scroll_noir::-webkit-scrollbar-track {
        background-color: #fff;
        opacity: 0.5;
        border: 1px solid #aaa;
    }

    /* line 122, zonestyle.scss */

    .scroll_hover:hover .scroll_noir::-webkit-scrollbar {
        opacity: 0.5;
    }

    /* line 127, zonestyle.scss */

    .scroll_red::-webkit-scrollbar-thumb {
        background-color: red;
        opacity: 0.5;
    }

    /* line 131, zonestyle.scss */

    .scroll_red::-webkit-scrollbar-track {
        background-color: #fff;
        opacity: 0.5;
        border: 1px solid lightcoral;
    }

    /* line 136, zonestyle.scss */

    .scroll_red::-webkit-scrollbar {
        opacity: 0.5;
    }

    /* line 140, zonestyle.scss */

    .scroll_hover:hover .scroll_red::-webkit-scrollbar-thumb {
        background-color: red;
        opacity: 0.5;
    }

    /* line 144, zonestyle.scss */

    .scroll_hover:hover .scroll_red::-webkit-scrollbar-track {
        background-color: #fff;
        opacity: 0.5;
        border: 1px solid lightcoral;
    }

    /* line 149, zonestyle.scss */

    .scroll_hover:hover .scroll_red::-webkit-scrollbar {
        opacity: 0.5;
    }

    .hover {
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    }

    .menus {
        display: none;
    }

    .visible {
        display: block;
    }

    @media only screen and (max-width: 800px){
      .small-hide{
        display:none;
      }
    }
</style>

<style>
   .hidden{
       display:none;
   }
   .mdc-persistent-drawer .mask .mdc-drawer-item .mdc-drawer-link{
     background:#fff;
   }
   .mdc-expansion-panel{
     background:#fff;
   }
</style>

  <div class="body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <aside class="mdc-persistent-drawer mdc-persistent-drawer--open zone-menu" style="bottom:0;z-index:9999;">
      <nav class="mdc-persistent-drawer__drawer card">
        <div class="mdc-persistent-drawer__toolbar-spacer" style="background:#fff">
          <a href="<?=base_url()?>assets/admin/index.html" class="brand-logo">
						<img src="<?=base_url()?>assets/img/core-img/logo.png" alt="logo" style="width:50%">
					</a>
        </div>
        <div class="mdc-list-group" style=" background:url('<?=base_url()?>assets/img/blog-img/b2.jpg')center/cover">
        <div class="mask pattern-7 waves-effect waves-light">  
          <nav class="mdc-list mdc-drawer-menu scroll scroll_bleu" style="height:auto; overflow-y:auto;">
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link btn  <?php if($title=="dashboard") echo'btn-primary' ?>" href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">desktop_mac</i>
                <?=t('form_tableau_bord')?>
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link btn <?php if($title=="messages") echo'btn-primary' ?>" href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/messages">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">track_changes</i>
                Messagerie
              </a>
            </div>

            <?php
              if($CI->users->getOneData($_SESSION['ens_userid'], "role") == "Admin"){
            ?>
            <div class="mdc-list-item mdc-drawer-item" href="#" data-toggle="expansionPanel" target-panel="ui-sub-menu">
              <a class="mdc-drawer-link btn <?php if($title=="users") echo'btn-primary' ?>" href="#">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">dashboard</i>
                 <?=t('utilisateurs')?>
                <i class="mdc-drawer-arrow material-icons">arrow_drop_down</i>
              </a>
              <div class="mdc-expansion-panel" id="ui-sub-menu">
                <nav class="mdc-list mdc-drawer-submenu">
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/users">
                      Utilisateurs
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item hidden" style="display:none;">
                    <a class="mdc-drawer-link" href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/typeusers">
                      Types Utilisateurs
                    </a>
                  </div>
                </nav>
              </div>
            </div>
            <?php 
              }
            ?>

            <div class="mdc-list-item mdc-drawer-item" href="#" data-toggle="expansionPanel" target-panel="ui-sub-menu2">
              <a class="mdc-drawer-link btn <?php if($title=="cours" || $title=="exercices" || $title=="tutoriels") echo'btn-primary' ?>" href="#">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">dashboard</i>
                 Cours | Exos
                <i class="mdc-drawer-arrow material-icons">arrow_drop_down</i>
              </a>
              <div class="mdc-expansion-panel hidden" id="ui-sub-menu2">
                <nav class="mdc-list mdc-drawer-submenu">
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/cours">
                      Vos Cours
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/exercices">
                      Vos Exercices
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/tutoriels">
                      Vos Tutoriels
                    </a>
                  </div>
                </nav>
              </div>
            </div>

            <?php
              if($CI->users->getOneData($_SESSION['ens_userid'], "role") == "Admin"){
            ?>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link btn <?php if($title=="mouchard") echo'btn-primary' ?>" href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/mouchard">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">pie_chart_outlined</i>
                Mouchard
              </a>
            </div>
            <?php 
              }
            ?>

            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link btn <?php if($title=="abonnements") echo'btn-primary' ?>" href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/abonnements">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">pie_chart_outlined</i>
                Abonnements
              </a>
            </div>

            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link btn <?php if($title=="forum") echo'btn-primary' ?>" href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/forum">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">pie_chart_outlined</i>
                Forum
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item" href="<?=base_url()?>assets/admin/#" data-toggle="expansionPanel" target-panel="sample-page-submenu">
              <a class="mdc-drawer-link btn <?php if($title=="documents") echo'btn-primary' ?>" href="#" <?php if($title=="documents" || $title=="actualites") echo'btn-primary' ?>>
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">pages</i>
                Documentation
                <i class="mdc-drawer-arrow material-icons">arrow_drop_down</i>
              </a>
              <div class="mdc-expansion-panel hidden" id="sample-page-submenu">
                <nav class="mdc-list mdc-drawer-submenu">
                <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/actualites">
                      Actualites
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/documents">
                      Documents | Livres
                    </a>
                  </div>
                </nav>
              </div>
            </div>

            <?php
              if($CI->users->getOneData($_SESSION['ens_userid'], "role") == "Admin"){
            ?>
            <div class="mdc-list-item mdc-drawer-item" href="#" data-toggle="expansionPanel" target-panel="ui-sub-menu3">
              <a class="mdc-drawer-link btn <?php if($title=="matieres"||$title=="filtre"||$title=="filieres"||$title=="niveau") echo'btn-primary' ?>" href="#">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">dashboard</i>
                 Configuration
                <i class="mdc-drawer-arrow material-icons">arrow_drop_down</i>
              </a>
              <div class="mdc-expansion-panel hidden" id="ui-sub-menu3" style="background:#fff">
                <nav class="mdc-list mdc-drawer-submenu">
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/matieres">
                      Matieres
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/filieres">
                      Filieres
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/niveau">
                      Niveaux
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/filtre">
                      Filtres
                    </a>
                  </div>
                </nav>
              </div>
            </div>
            <?php 
              }
            ?>
            
          </nav>
          </div>
        </div>
      </nav>
    </aside>
    <!-- partial -->
    <!-- partial:partials/_navbar.html -->
    <header class="mdc-toolbar mdc-elevation--z4 mdc-toolbar--fixed">
      <div class="mdc-toolbar__row">
        <section class="mdc-toolbar__section mdc-toolbar__section--align-start">
          <a href="#" class="menu-toggler material-icons mdc-toolbar__menu-icon">menu</a>
          <span class="mdc-toolbar__input">
            <div class="mdc-text-field">
              <input type="text" class="mdc-text-field__input small-hide" id="css-only-text-field-box" placeholder="Search anything...">
            </div>
          </span>
        </section>
        <section class="mdc-toolbar__section mdc-toolbar__section--align-end" role="toolbar">
          <div class="mdc-menu-anchor small-hide">
            <a href="#" class="mdc-toolbar__icon toggle mdc-ripple-surface" data-toggle="dropdown" toggle-dropdown="notification-menu" data-mdc-auto-init="MDCRipple">
              <i class="material-icons">notifications</i>
              <span class="dropdown-count">3</span>
            </a>
            <div class="mdc-simple-menu mdc-simple-menu--right" tabindex="-1" id="notification-menu">
              <ul class="mdc-simple-menu__items mdc-list" role="menu" aria-hidden="true">
                <li class="mdc-list-item" role="menuitem" tabindex="0">
                  <i class="material-icons mdc-theme--primary mr-1">notifications</i>
                   Nouvelle Connexion 
                </li>
              </ul>
            </div>
          </div>

          <div class="mdc-menu-anchor">
            <a href="#" class="mdc-toolbar__icon mdc-ripple-surface small-hide" data-mdc-auto-init="MDCRipple">
              <i class="material-icons">widgets</i>
            </a>
          </div>
          <div class="mdc-menu-anchor mr-1">
            <a style="color:#fff" href="<?=base_url()?>assets/admin/#" class="mdc-toolbar__icon toggle mdc-ripple-surface" data-toggle="dropdown" toggle-dropdown="logout-menu" data-mdc-auto-init="MDCRipple">
            <img src="<?=base_url()?>assets/profile/<?=$CI->users->getOneData($_SESSION['ens_userid'], 'photo')?>" class="img-circle small-hide" style="width:30px; height:30px; margin-right:15px; margin-top:-7px; float:left;"/>  
            <b class="small-hide"><?=$CI->users->getOneData($_SESSION['ens_userid'],'prenom')?></b>
            <i class="material-icons">more_vert</i>
            </a>
            <div class="mdc-simple-menu mdc-simple-menu--right" tabindex="-1" id="logout-menu">
                <ul class="mdc-simple-menu__items mdc-list" role="menu" aria-hidden="true">
                  <li class="mdc-list-item" role="menuitem" tabindex="0">
                    <i class="material-icons mdc-theme--primary mr-1">settings</i>
                     <a href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/profil">Parametres</a>
                  </li>
                  <li class="mdc-list-item" role="menuitem" tabindex="0">
                    <i class="material-icons mdc-theme--primary mr-1">power_settings_new</i>
                     <a href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/deconnexion">Deconnexion</a>
                  </li>
                </ul>
            </div>
          </div>
        </section>
      </div>
    </header>
    <!-- partial -->