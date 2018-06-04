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
                                <?php
                                $CI = &get_instance();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12" style="margin-top:-60px;">
                    <div class="mdc-card">
                        <div class="table-heading px-2 px-1 border-bottom">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addSujet">Ajouter un Sujet</button>
                            <a href="<?= base_url() ?><?= $_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/forum" class="btn btn-warning btn-sm">Retour</a><br><br>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row" id="forumload">

                                        <?php
                                        if (isset($power) or isset($supprimer)) {
                                            ?>
                                            <div class="alert" style="border-radius:0px; background:#fff; margin-top:-25px;<?php
                                            if (isset($power)) {
                                                echo 'color:#096304d0';
                                            } else {
                                                echo 'color:orange';
                                            }
                                            ?>">
                                                <span>
                                                    <b><i class="now-ui-icons travel_info"></i> &nbsp; Infos - </b> <?= $power ?? $supprimer ?></span>
                                            </div>
                                            <?php
                                        }

                                        if (isset($d)) {
                                            ?>
                                            <div class="col-md-12">
                                                <section class="mdc-card__social-footer bg-blue">
                                                    <a href="<?= base_url() ?><?= $_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/messages/<?= $d ?>/d#basbas" id="clickbas"></a>
                                                </section>

                                                <div class="scroll scroll_bleu" style="max-height:1000px; overflow-y:auto">
                                                    <div class="col-md-12" style="margin-bottom:15px; position:relative">
                                                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
                                                            <div class="mdc-card card--with-avatar">
                                                                <section class="mdc-card__primary">
                                                                    <div class="card__avatar"><img src="" alt=""></div>
                                                                    <h1 class="mdc-card__title"><a href=""><?= $CI->forum->getOneData($d, 'libeller'); ?></a></h1>
                                                                    <h2 class="mdc-card__subtitle">Matiere: <b><?= $CI->matieres->getOneData($CI->forum->getOneData($d, 'Mat_id'), "libeller") ?></b></h2>
                                                                    <h2 class="mdc-card__subtitle">Filiere: <b><?= $CI->filieres->getOneData($CI->forum->getOneData($d, 'Fil_id'), "libeller") ?></b></h2>
                                                                    <h2 class="mdc-card__subtitle">Niveau : <b><?= $CI->niveau->getOneData($CI->forum->getOneData($d, 'Niv_id'), "libeller") ?></b>
                                                                        <a style="float:right">Publié le : <?= $CI->forum->getOneData($d, 'dates') ?></a></h2>
                                                                </section>
                                                                <section class="mdc-card__supporting-text pt-1">
                                                                    <hr>
                                                                    <p class="mb-2" style="background:#f5f5f5; padding:15px; text-align:justify"><?= $CI->forum->getOneData($d, 'details'); ?></p>

                                                                    <b style="float:right;"><span class="badge badge-primary badge-pill"><a id="countForumComment" data-id="<?= $d ?>" data-objet="Suj_id"><?= $CI->comments->CountcommentsByCol($d, 'Suj_id') ?></a> Commentaire(s)</span></b>
                                                                </section>

                                                                <style>
                                                                    .fAction{
                                                                        display:none;
                                                                    }
                                                                </style>

                                                                <div class="mdc-card card--with-avatar" id="forumComments" data-id="<?= $d ?>" data-objet="Suj_id">

                                                                </div>

                                                                <div class="row" style="margin:20px;">
                                                                    <div class="col-md-1">
                                                                        <img src="<?= base_url() ?>assets/profile/<?= $CI->users->getOneData($_SESSION['ens_userid'], 'photo') ?>" style="width:140%;"/>
                                                                    </div>
                                                                    <div class="col-md-11">
                                                                        <form method="POST" action="" id="addCommActu">
                                                                            <input type="hidden" name="addCommActu"/>
                                                                            <input type="text" style="width:100%" name="libeller" required class="mdc-text-field__input formComment" id="css-only-text-field-box" placeholder="Ajouter un Commentaire">
                                                                            <input type="hidden" name="Actu_id" value="0" required/>
                                                                            <input type="hidden" name="Suj_id" value="<?= $d ?>" required/>
                                                                            <input type="submit" style="position:fixed; right:0; z-index:-2; visibility:hidden"/>
                                                                        </form>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        } else {

                                            $nbr = $CI->forum->countAllforum();

                                            $perPage = 8;

                                            if (isset($delete)) {
                                                $details = 0;
                                            }

                                            if ($details) {
                                                $ini = $details;
                                                $max = $ini + $perPage;
                                            } else {
                                                $ini = 0;
                                                $max = $perPage;
                                            }


                                            $lang = $_SESSION['abbr_lang'] ?? 'fr';
                                            $config['base_url'] = base_url() . $lang . "/dashboard/forum/";
                                            $config['total_rows'] = $nbr;
                                            $config['per_page'] = $perPage;
                                            $config['first_link'] = 'Debut';
                                            $config['full_tag_open'] = '<nav><ul class="pagination">';
                                            $config['full_tag_close'] = '</ul></nav>';
                                            $config['cur_tag_open'] = '<li class="page-item active"><b class="page-link">';
                                            $config['cur_tag_close'] = '</b></li>';
                                            $config['num_tag_open'] = '<li class="page-item"><b class="page-link hover" style="background:#fff;margin-right:5px">';
                                            $config['num_tag_close'] = '</b></li>';
                                            $config['prev_tag_open'] = '<li class="page-item"><b class="page-link hover" style="background:#fff;margin-right:5px">';
                                            $config['prev_tag_close'] = '</b></li>';
                                            $config['next_tag_open'] = '<li class="page-item"><b class="page-link hover" style="background:#fff;margin-right:5px">';
                                            $config['next_tag_close'] = '</b></li>';

                                            $CI->pagination->initialize($config);

                                            if ($CI->forum->getAllforumpaginate($ini, $max) != false) {
                                                ?><div class="col-md-12"><h1 class="mdc-card__title mdc-card__title--large">Liste des Sujets Disponibles <span class="badge badge-primary badge-pill"><?= $nbr ?> Sujets</span></h1></div><?php
                                                foreach ($CI->forum->getAllforumpaginate($ini, $max) as $row):
                                                    ?>
                                                    <div class="col-md-6" style="margin-bottom:15px; position:relative">
                                                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
                                                            <div class="mdc-card card--with-avatar">
                                                                <section class="mdc-card__primary">
                                                                    <div class="card__avatar"><img src="" alt=""></div>
                                                                    <h1 class="mdc-card__title"><a href=""><?= $row->libeller ?></a></h1>
                                                                    <h2 class="mdc-card__subtitle"><?= $CI->matieres->getOneData($row->Mat_id, "libeller") ?></h2>
                                                                    <h2 class="mdc-card__subtitle"><?= $CI->filieres->getOneData($row->Fil_id, "libeller") ?></h2>
                                                                    <h2 class="mdc-card__subtitle"><?= $CI->niveau->getOneData($row->Niv_id, "libeller") ?></h2>
                                                                </section>
                                                                <section class="mdc-card__supporting-text pt-1">
                                                                    <p class="mb-2"><?= substr($row->details, 0, 100) ?> ...</p>
                                                                </section>
                                                                <section class="mdc-card__social-footer bg-blue">
                                                                    <div class="col">
                                                                        <?php
                                                                        if ($row->Use_id == $_SESSION['ens_userid']) {
                                                                            ?><center><a href="<?= base_url() . $_SESSION['abbr_lang'] ?>/dashboard/forum/<?= $row->id ?>/delete" class="btn btn-primary btn-sm" style="margin-top:-15px; margin-bottom:-15px;"><i class="mdi mdi-delete"></i></a></center><?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <div class="col">
                                                                        <?php
                                                                        if ($row->Use_id == $_SESSION['ens_userid']) {
                                                                            ?><center><a href="#" class="btn btn-primary btn-sm edit-elemt" data-edit="forum" id="<?= $row->id ?>" data-toggle="modal" data-target="#editSujets" style="margin-top:-15px; margin-bottom:-15px;"><i class="mdi mdi-pencil"></i></a></center><?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <div class="col">
                                                                        <a href="<?= base_url() ?><?= $_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/forum/<?= $row->id ?>/d" class="btn btn-primary btn-sm" style="margin-top:-15px; margin-bottom:-15px;"><i class="mdi mdi-eye"></i></a>
                                                                    </div>
                                                                </section>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                endforeach;
                                                ?><div class="col-md-12"><?php echo $this->pagination->create_links(); ?></div><?php
                                            } else {
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
                                        }
                                        ?>


                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>Triage rapide des Sujets</h5>
                                            <div class="list-group">
                                                <a href="#" class="list-group-item active waves-effect">
                                                    Choix du niveau requis
                                                </a>
                                                <?php
                                                foreach ($CI->niveau->getAllniveau() as $mat):
                                                    ?><a class="list-group-item list-group-item-action <?php if ($CI->forum->countByCol($mat->id, 0, 'Niv_id') == 0) echo'hidden'; ?>">
                                                        <div class="mdc-switch">
                                                            <input type="radio" name="id" data-table="Niv_id" value="<?= $mat->id ?>" id="basic-switch" class="mdc-switch__native-control forumchoise" />
                                                            <div class="mdc-switch__background">
                                                                <div class="mdc-switch__knob"></div>
                                                            </div>
                                                        </div>
                                                        <?= $mat->libeller ?><span class="badge badge-primary badge-pill" style="float:right"><?= $CI->forum->countByCol($mat->id, 0, 'Niv_id') ?></span>
                                                    </a><?php
                                                endforeach;
                                                ?>
                                            </div>

                                            <div class="list-group">
                                                <a href="#" class="list-group-item active waves-effect">
                                                    Choix de la Filiere requise
                                                </a>
                                                <?php
                                                foreach ($CI->filieres->getAllfilieres() as $mat):
                                                    ?><a class="list-group-item list-group-item-action <?php if ($CI->forum->countByCol($mat->id, 0, 'Fil_id') == 0) echo'hidden'; ?>">
                                                        <div class="mdc-switch">
                                                            <input type="radio" name="id" data-table="Fil_id" value="<?= $mat->id ?>" id="basic-switch" class="forumchoise mdc-switch__native-control" />
                                                            <div class="mdc-switch__background">
                                                                <div class="mdc-switch__knob"></div>
                                                            </div>
                                                        </div>
                                                        <?= $mat->libeller ?><span class="badge badge-primary badge-pill" style="float:right"><?= $CI->forum->countByCol($mat->id, 0, 'Fil_id') ?></span>
                                                    </a><?php
                                                endforeach;
                                                ?>
                                            </div>

                                            <div class="list-group">
                                                <a href="#" class="list-group-item active waves-effect">
                                                    Choix de la Matiere requise
                                                </a>
                                                <?php
                                                foreach ($CI->matieres->getAllmatieres() as $mat):
                                                    ?><a class="list-group-item list-group-item-action <?php if ($CI->forum->countByCol($mat->id, 0, 'Mat_id') == 0) echo'hidden'; ?>">
                                                        <div class="mdc-switch">
                                                            <input type="radio" name="id" data-table="Mat_id" value="<?= $mat->id ?>" id="basic-switch" class="forumchoise mdc-switch__native-control" />
                                                            <div class="mdc-switch__background">
                                                                <div class="mdc-switch__knob"></div>
                                                            </div>
                                                        </div>
                                                        <?= $mat->libeller ?><span class="badge badge-primary badge-pill" style="float:right"><?= $CI->forum->countByCol($mat->id, 0, 'Mat_id') ?></span>
                                                    </a><?php
                                                endforeach;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                    <h4 class="title">Ajouter un Sujet</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                            <i class="fa fa-power-off"></i>X
                        </button>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="addSujets">
                        <div class="col-md-12">
                            <div class="row"><div class="icon"></div>
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <label class="mdc-text-field w-100">
                                            <input type="text" name="libeller" required class="mdc-text-field__input">
                                            <span class="mdc-text-field__label">Intituler</span>
                                            <div class="mdc-text-field__bottom-line"></div>
                                            <input type="hidden" name="addSujets"/> 
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
                                        <label class="mdc-text-field w-100">Niveau
                                            <select name="Niv_id" class="mdc-text-field__input gNiveau">
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
                                            <select name="Fil_id" class="mdc-text-field__input gFiliere">

                                            </select>
                                            <div class="mdc-text-field__bottom-line"></div>
                                        </label>
                                    </div>

                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                        <label class="mdc-text-field w-100">Matieres
                                            <select name="Mat_id" class="mdc-text-field__input gMatiere">

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

    <div class="modal modal-default fade" id="editSujets">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title">Editer le Sujet</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                            <i class="fa fa-power-off"></i>X
                        </button>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="addSujets">
                        <div class="col-md-12">
                            <div class="row"><div class="icon"></div>
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <label class="mdc-text-field w-100">Intituler
                                            <input type="text" name="libeller" required class="mdc-text-field__input data-edit" data-elmt="libeller">
                                            <span class="mdc-text-field__label"></span>
                                            <div class="mdc-text-field__bottom-line"></div>
                                            <input type="hidden" name="editSujets"/> 
                                        </label>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mdc-text-field w-100">Details
                                            <textarea required name="details" class="mdc-text-field__input data-edit" data-elmt="details" style="min-height: 300px"></textarea>
                                            <span class="mdc-text-field__label"></span>
                                            <div class="mdc-text-field__bottom-line"></div>
                                        </label>
                                    </div>

                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                                        <label class="mdc-text-field w-100">Niveau
                                            <select name="Niv_id" class="mdc-text-field__input gNiveau">
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
                                            <select name="Fil_id" class="mdc-text-field__input gFiliere">

                                            </select>
                                            <div class="mdc-text-field__bottom-line"></div>
                                        </label>
                                    </div>

                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                        <label class="mdc-text-field w-100">Matieres
                                            <select name="Mat_id" class="mdc-text-field__input gMatiere">

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