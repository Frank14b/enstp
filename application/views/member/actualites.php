<?php
$_POST['M-Details'] = "Acces a la zone Actualites";
?>
<div class="page-wrapper mdc-toolbar-fixed-adjust">
    <main class="content-wrapper">
        <div class="mdc-layout-grid">
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                    <div class="mdc-card">
                        <div class="mdc-layout-grid__inner">
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12 card">

                                <style>
                                    .gris{
                                        background:#aaa; 
                                        color:#fff
                                    }
                                </style>

                                <?php
                                $CI = &get_instance();

                                if (isset($d)) {
                                    ?>
                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                        <div class="mdc-card">
                                            <div class="table-heading px-2 px-1 border-bottom">
                                                <a class="btn btn-primary btn-sm" href="<?= base_url() ?><?= $_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/forum">Parcourir les Sujets</a>
                                                <a href="<?= base_url() ?><?= $_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/actualites" class="btn btn-warning btn-sm">Retour</a><br><br>
                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="list-group">
                                                                    <a href="#" class="list-group-item active waves-effect">
                                                                        <div id="demo-tf-box-wrapper"  style="height:30px;">
                                                                            <div id="tf-box-example" class="mdc-text-field mdc-text-field--box w-100">
                                                                                <input required pattern=".{2,}" type="text" id="tf-box" class="mdc-text-field__input" aria-controls="name-validation-message" style="color:#444; background:#fff">
                                                                                <label for="tf-box" class="mdc-text-field__label">Trouver une Actualite | Rapide</label>
                                                                            </div>
                                                                            <p class="mdc-text-field-helper-text mdc-text-field-helper-text--validation-msg" id="name-validation-msg">
                                                                                Must be at least 2 characters
                                                                            </p>
                                                                        </div>
                                                                    </a>
                                                                    <a href="#" class="list-group-item list-group-item-action disabled" style="background:#f5f5f5; text-align:left">Sujets dans la meme lancé</a>
                                                                    <div class="scroll scroll_bleu" style="max-height:350px; overflow-y:auto">
                                                                        <?php
                                                                        foreach ($CI->actualites->getAllactualitesByEle($CI->actualites->getOneData($d, 'Rub_id'), "Rub_id") as $use):
                                                                            ?><a href="<?= base_url() ?><?= $_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/actualites/<?= $use->id ?>/d" class="list-group-item list-group-item-action <?php if ($use->id == $d) echo'disabled'; ?>">
                                                                            <?= $use->libeller ?> <?php if ($use->id == $d) echo'<span class="badge badge-primary badge-pill" style="float:right">actif</span>'; ?>
                                                                            </a><?php
                                                                        endforeach;
                                                                        ?>
                                                                    </div>
                                                                    <a href="#" class="list-group-item list-group-item-action disabled" style="background:#f5f5f5"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row">

                                                            <div class="col-md-12" style="margin-bottom:15px;">
                                                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                                                    <?php
                                                                    if (isset($d)) {
                                                                        ?>

                                                                        <section class="mdc-card__social-footer bg-blue" style="background:#f5f5f5; color:#444">
                                                                            <div class="col">
                                                                                <small>
                                                                                    .
                                                                                </small>
                                                                            </div>
                                                                        </section>

                                                                        <div class="mdc-card card--with-avatar">
                                                                            <section class="mdc-card__social-footer bg-blue">
                                                                                <a href="<?= base_url() ?><?= $_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/messages/<?= $d ?>/d#basbas" id="clickbas"></a>
                                                                            </section>

                                                                            <div class="scroll scroll_bleu" style="max-height:1000px; overflow-y:auto">
                                                                                <div class="col-md-12" style="margin-bottom:15px; position:relative">
                                                                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
                                                                                        <div class="mdc-card card--with-avatar">
                                                                                            <section class="mdc-card__primary">
                                                                                                <div class="card__avatar"><img src="" alt=""></div>
                                                                                                <h1 class="mdc-card__title"><a href=""><?= $CI->actualites->getOneData($d, 'libeller'); ?></a></h1>
                                                                                                <h2 class="mdc-card__subtitle"><?= $CI->rubriques->getOneData($CI->actualites->getOneData($d, 'Rub_id'), "libeller") ?></h2>
                                                                                                <h2 class="mdc-card__subtitle"><?= $CI->actualites->getOneData($d, 'dates') ?></h2>
                                                                                                <!--<h2 class="mdc-card__subtitle"><?= $CI->niveau->getOneData($row->Niv_id, "libeller") ?></h2>-->
                                                                                            </section>
                                                                                            <section class="mdc-card__supporting-text pt-1"><hr>
                                                                                                <p class="mb-2" style="background:#f5f5f5; padding:15px; text-align:justify;"><?= $CI->actualites->getOneData($d, 'details'); ?></p>

                                                                                                <b style="float:right;"><span class="badge badge-primary badge-pill"><a id="countForumComment" data-id="<?= $d ?>" data-objet="Suj_id"><?= $CI->comments->CountcommentsByCol($d, 'Suj_id') ?></a> Commentaire(s)</span></b>
                                                                                            </section>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <style>
                                                                                .fAction{
                                                                                    display:none;
                                                                                }
                                                                            </style>

                                                                            <div class="mdc-card card--with-avatar" id="forumComments" data-id="<?= $d ?>" data-objet="Actu_id">
                                                                            </div>

                                                                            <div class="row" style="margin:20px;">
                                                                                <div class="col-md-1">
                                                                                    <img src="<?= base_url() ?>assets/profile/<?= $CI->users->getOneData($_SESSION['ens_userid'], 'photo') ?>" style="width:140%;"/>
                                                                                </div>
                                                                                <div class="col-md-11">
                                                                                    <form method="POST" action="" id="addCommActu">
                                                                                        <input type="hidden" name="addCommActu"/>
                                                                                        <input type="text" style="width:100%" name="libeller" required class="mdc-text-field__input formComment" id="css-only-text-field-box" placeholder="Ajouter un Commentaire">
                                                                                        <input type="hidden" name="Actu_id" value="<?= $d ?>" required/>
                                                                                        <input type="hidden" name="Suj_id" value="0" required/>
                                                                                        <input type="submit" style="position:fixed; right:0; z-index:-2; visibility:hidden"/>
                                                                                    </form>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                        <?php
                                                                    } else {
                                                                        
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <div class="view zoom card hidden" style="width:100%; max-height:200px">
                                                                <img src="<?= base_url() ?>assets/img/blog-img/b24.jpg" class="img-circle" alt="Image of ballons flying over canyons with mask pattern one." style="width:100%; margin-top:-200px">
                                                                <div class="mask pattern-3 flex-center waves-effect waves-light">
                                                                    <p class="white-text" style="font-size: 2.3em">" Nos Actualites Recentes "</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12" style="margin-top:-60px;">
                                                <div class="mdc-card">
                                                    <div class="table-heading px-2 px-1 border-bottom">
                                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addSujet">Ajouter une Actualite</button>
                                                        <?php
                                                        if ($CI->users->getOneData($_SESSION['ens_userid'], 'role') == 'Admin') {
                                                            echo '<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#addRub">Rubriques</button>';
                                                        }
                                                        ?><br><br>
                                                        <div class="row">

                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <h5>Triage rapide des Actualites</h5>

                                                                        <div class="list-group">
                                                                            <a href="#" class="list-group-item active waves-effect">
                                                                                Choix de la Rubrique Requise
                                                                            </a>
                                                                            <?php
                                                                            foreach ($CI->rubriques->getAllrubriques() as $mat):
                                                                                ?><a class="list-group-item list-group-item-action <?php if ($CI->actualites->countByCol($mat->id, 0, 'Rub_id') == 0) echo'hidden'; ?>">
                                                                                    <div class="mdc-switch">
                                                                                        <input type="radio" name="cNiveau" value="<?= $mat->id ?>" id="basic-switch" class="mdc-switch__native-control" />
                                                                                        <div class="mdc-switch__background">
                                                                                            <div class="mdc-switch__knob"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?= $mat->libeller ?><span class="badge badge-primary badge-pill" style="float:right"><?= $CI->actualites->countByCol($mat->id, 0, 'Rub_id') ?></span>
                                                                                </a><?php
                                                                            endforeach;
                                                                            ?>
                                                                        </div>

                                                                        <div class="list-group">
                                                                            <a href="#" class="list-group-item active waves-effect" style="border-bottom:2px solid #f5f5f5; border-radius:0px">
                                                                                Choix du niveau requis
                                                                            </a>
                                                                            <?php
                                                                            foreach ($CI->niveau->getAllniveau() as $mat):
                                                                                ?><a class="list-group-item list-group-item-action <?php if ($CI->actualites->countByCol($mat->id, 0, 'Niv_id') == 0) echo'hidden'; ?>">
                                                                                    <div class="mdc-switch">
                                                                                        <input type="radio" name="cNiveau" value="<?= $mat->id ?>" id="basic-switch" class="mdc-switch__native-control" />
                                                                                        <div class="mdc-switch__background">
                                                                                            <div class="mdc-switch__knob"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?= $mat->libeller ?><span class="badge badge-primary badge-pill" style="float:right"><?= $CI->actualites->countByCol($mat->id, 0, 'Niv_id') ?></span>
                                                                                </a><?php
                                                                            endforeach;
                                                                            ?>
                                                                        </div>

                                                                        <div class="list-group">
                                                                            <a href="#" class="list-group-item active waves-effect" style="border-bottom:2px solid #f5f5f5; border-radius:0px">
                                                                                Choix de la Filiere requise
                                                                            </a>
                                                                            <?php
                                                                            foreach ($CI->filieres->getAllfilieres() as $mat):
                                                                                ?><a class="list-group-item list-group-item-action <?php if ($CI->actualites->countByCol($mat->id, 0, 'Fil_id') == 0) echo'hidden'; ?>">
                                                                                    <div class="mdc-switch">
                                                                                        <input type="radio" name="cNiveau" value="<?= $mat->id ?>" id="basic-switch" class="mdc-switch__native-control" />
                                                                                        <div class="mdc-switch__background">
                                                                                            <div class="mdc-switch__knob"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?= $mat->libeller ?><span class="badge badge-primary badge-pill" style="float:right"><?= $CI->actualites->countByCol($mat->id, 0, 'Fil_id') ?></span>
                                                                                </a><?php
                                                                            endforeach;
                                                                            ?>
                                                                        </div>

                                                                        <div class="list-group">
                                                                            <a href="#" class="list-group-item active waves-effect" style="border-radius:0px">
                                                                                Choix de la Matiere requise
                                                                            </a>
                                                                            <?php
                                                                            foreach ($CI->matieres->getAllmatieres() as $mat):
                                                                                ?><a class="list-group-item list-group-item-action <?php if ($CI->actualites->countByCol($mat->id, 0, 'Mat_id') == 0) echo'hidden'; ?>">
                                                                                    <div class="mdc-switch">
                                                                                        <input type="radio" name="cNiveau" value="<?= $mat->id ?>" id="basic-switch" class="mdc-switch__native-control" />
                                                                                        <div class="mdc-switch__background">
                                                                                            <div class="mdc-switch__knob"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?= $mat->libeller ?><span class="badge badge-primary badge-pill" style="float:right"><?= $CI->actualites->countByCol($mat->id, 0, 'Mat_id') ?></span>
                                                                                </a><?php
                                                                            endforeach;
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-8">
                                                                <div class="row">

                                                                    <?php
                                                                    if ($CI->actualites->getAllactualites() != false) {
                                                                        foreach ($CI->actualites->getAllactualites() as $row):
                                                                            ?>
                                                                            <div class="col-md-6" style="margin-bottom:15px; position:relative">
                                                                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
                                                                                    <div class="mdc-card card--with-avatar">
                                                                                        <section class="mdc-card__primary">
                                                                                            <div class="card__avatar"><img src="images/faces/face1.jpg" alt=""></div>
                                                                                            <h1 class="mdc-card__title"><a href=""><?= $row->libeller ?></a></h1>
                                                                                            <h2 class="mdc-card__subtitle"><?= $CI->matieres->getOneData($row->Mat_id, "libeller") ?></h2>
                                                                                            <h2 class="mdc-card__subtitle"><?= $CI->filieres->getOneData($row->Fil_id, "libeller") ?></h2>
                                                                                            <h2 class="mdc-card__subtitle"><?= $CI->niveau->getOneData($row->Niv_id, "libeller") ?></h2>
                                                                                            <h2 class="mdc-card__subtitle"><?= $CI->rubriques->getOneData($row->Rub_id, "libeller") ?></h2>
                                                                                        </section>
                                                                                        <section class="mdc-card__supporting-text pt-1">
                                                                                            <p class="mb-2"><?= substr($row->details, 0, 100) ?> ...</p>
                                                                                        </section>
                                                                                        <section class="mdc-card__social-footer bg-blue">
                                                                                            <div class="col">

                                                                                            </div>
                                                                                            <div class="col">
                                                                                                <a href="<?= base_url() ?><?= $_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/actualites/<?= $row->id ?>/d" class="btn btn-primary btn-sm" style="margin-top:-15px; margin-bottom:-15px;"><i class="mdi mdi-eye"></i></a>
                                                                                            </div>
                                                                                        </section>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                        endforeach;
                                                                    }else {
                                                                        ?>
                                                                        <div class="mdc-layout-grid__cell text-center card mdc-layout-grid__cell--span-12 stretch-card" style="margin-top:30px; margin-left:20px;">
                                                                            <div class="mdc-card">
                                                                                <section class="mdc-card__primary">
                                                                                    <h1 class="mdc-card__title mdc-card__title--large"><h3>Aucun Sujet disponible dans votre panel</h3></h1>
                                                                                </section>
                                                                                <section class="mdc-card__supporting-text">
                                                                                    <h1 class="mdc-typography--headline">Avec VIRTEK Chattez avec vos Camarades</h1>
                                                                                    <h1 class="mdc-typography--title">Echangez sur vos activites</h1>
                                                                                    <h2 class="mdc-typography--subheading2">Discussion Instantannee</h2>
                                                                                    <h2 class="mdc-theme--secondary mdc-typography--subheading1">Comment sa marche ?</h2>
                                                                                    <p class="mdc-typography--body1">
                                                                                        Demarrez une discussion avec lun de vos camarade en choisissant un utilisateur vis le menu de gauche.
                                                                                        <br>
                                                                                        Vous pouvez decider de creer un groupe de discussion et y integrer plusieurs de vos camarades pour avoir une discussion en groupe. Vous avez le choix 
                                                                                        et la possibilite de creer un groupe caractere privee ou publique selon le mode daudience que vous desirez pour le votre.
                                                                                        <br>
                                                                                        Vous pouvez decider de creer un groupe relatif a votre niveau detude. Ce groupe ne sera visible que par le utilisateurs ayant le meme niveau detude que vous.
                                                                                    </p>
                                                                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#addSujet">Ajouter un Sujet</a>
                                                                                </section>
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>


                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </main>

                                <!-- modal -->

                                <div class="modal modal-default fade" id="addSujet">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="title">Ajouter une Actualites</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                                                        <i class="fa fa-power-off"></i>X
                                                    </button>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" id="addSujets" enctype="multipart/form-data">
                                                    <div class="col-md-12">
                                                        <div class="row"><div class="icon"></div>
                                                            <div class="col-md-12">
                                                                <div class="col-md-12">
                                                                    <label class="mdc-text-field w-100">
                                                                        <input type="text" name="libeller" required class="mdc-text-field__input">
                                                                        <span class="mdc-text-field__label">Intituler</span>
                                                                        <div class="mdc-text-field__bottom-line"></div>
                                                                        <input type="hidden" name="addActu"/> 
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="mdc-text-field w-100">
                                                                        <textarea required name="details" class="mdc-text-field__input"></textarea>
                                                                        <span class="mdc-text-field__label">Details</span>
                                                                        <div class="mdc-text-field__bottom-line"></div>
                                                                    </label>
                                                                </div>

                                                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                                                                    <label class="mdc-text-field w-100">Rubrique
                                                                        <select name="Rub_id" required class="mdc-text-field__input" id="gNiveau">
                                                                            <option  value=""></option>
                                                                            <?php
                                                                            foreach ($CI->rubriques->getAllrubriques() as $typ):
                                                                                ?>
                                                                                <option  value="<?= $typ->id ?>">
                                                                                    <?= $typ->libeller ?>
                                                                                </option>
                                                                                <?php
                                                                            endforeach;
                                                                            ?>
                                                                        </select>
                                                                        <div class="mdc-text-field__bottom-line"></div>
                                                                    </label>
                                                                </div>

                                                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                                                                    <label class="mdc-text-field w-100">Niveau
                                                                        <select name="Niv_id" class="mdc-text-field__input" id="gNiveau">
                                                                            <option  value=""></option>
                                                                            <?php
                                                                            foreach ($CI->niveau->getAllniveau() as $typ):
                                                                                ?>
                                                                                <option  value="<?= $typ->id ?>">
                                                                                    <?= $typ->libeller ?>
                                                                                </option>
                                                                                <?php
                                                                            endforeach;
                                                                            ?>
                                                                        </select>
                                                                        <div class="mdc-text-field__bottom-line"></div>
                                                                    </label>
                                                                </div>

                                                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                                                                    <label class="mdc-text-field w-100">Filieres
                                                                        <select name="Fil_id" class="mdc-text-field__input" id="gFiliere">

                                                                        </select>
                                                                        <div class="mdc-text-field__bottom-line"></div>
                                                                    </label>
                                                                </div>

                                                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                                                    <label class="mdc-text-field w-100">Matieres
                                                                        <select name="Mat_id" class="mdc-text-field__input" id="gMatiere">

                                                                        </select>
                                                                        <div class="mdc-text-field__bottom-line"></div>
                                                                    </label>
                                                                </div>

                                                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                                                </div>
                                                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                                                    <button class="mdc-button mdc-button--raised w-100" data-mdc-auto-init="MDCRipple">
                                                                        Enregistrer
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        </div>

                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <!-- modal -->

                            <div class="modal modal-default fade" id="addRub">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="title">Ajouter une Rubrique</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                                                    <i class="fa fa-power-off"></i>X
                                                </button>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" id="addSujets" enctype="multipart/form-data">
                                                <div class="col-md-12">
                                                    <div class="row"><div class="icon"></div>
                                                        <div class="col-md-12">
                                                            <div class="col-md-12">
                                                                <label class="mdc-text-field w-100">
                                                                    <input type="text" name="libeller" id="libellerrub" required class="mdc-text-field__input">
                                                                    <span class="mdc-text-field__label">Intituler</span>
                                                                    <div class="mdc-text-field__bottom-line"></div>
                                                                    <input type="hidden" name="addRubr"/> 
                                                                </label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="mdc-text-field w-100">
                                                                    <textarea required name="details" id="detailsrub" class="mdc-text-field__input"></textarea>
                                                                    <span class="mdc-text-field__label">Description</span>
                                                                    <div class="mdc-text-field__bottom-line"></div>
                                                                </label>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form_groupe">
                                                                    <div class="form_element btn-sm btn-default btn" style="padding:10px; height:37px">
                                                                        <a class="zs_label mdc-text-field w-100" data-toggle="modal" data-target="#picture" style="margin-top:-10px; font-weight:bold">Choisir une Photo</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12"><hr>
                                                                <a href="" class="btn btn-sm btn-primary pull-right">Consulter les Rubriques</a>
                                                            </div>

                                                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    </div>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->

                        <div class="modal fade" role="dialog" id="picture">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">
                                            <i class="fa fa-image"></i>&nbsp; Choisir une Image</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <button type="button" class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                                <i class="fa fa-power-off"></i>
                                            </button>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <center>
                                                            <button class="btn btn-sm btn-primary btn-flat choose_image">
                                                                <i class="fa fa-image"></i>&nbsp; Choisir une Image</button>
                                                            <button class="btn btn-sm btn-info image_crop-rotate" data-deg="-90" id="RotateAntiClockwise">
                                                                <i class="fa fa-arrow-left"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-info image_crop-rotate" data-deg="90" id="RotateClockwise">
                                                                <i class="fa fa-arrow-right"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-success cropped_imageRub">Enregistrer</button>
                                                        </center>
                                                        <br>
                                                        <div id="upload-image">
                                                        </div>
                                                        <img class="img-thumbnail" id="imgprofile" src="<?php echo base_url() . 'assets/img/blog-img/b4.jpg' ?>" alt="<?php echo base_url(); ?>" />
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input type="file" id="images" style="display: none;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>