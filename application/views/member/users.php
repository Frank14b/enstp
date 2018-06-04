<?php
$_POST['M-Details'] = "Acces a la zone Utilisateurs";
?>

<div class="page-wrapper mdc-toolbar-fixed-adjust">
    <main class="content-wrapper">
        <div class="mdc-layout-grid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $CI = &get_instance();
                    $val = $CI->niveau->getAllniveau();

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
                    ?>
                </div>
            </div>
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                    <div class="mdc-card">
                        <div class="mdc-layout-grid__inner">
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12 card">
                                <?php
                                $CI = &get_instance();
                                ?>
                                <!-- Card image -->

                                <div class="view zoom card hidden" style="width:100%; max-height:250px">
                                    <img src="<?= base_url() ?>assets/img/core-img/header-bg.jpg" class="img-circle" alt="Image of ballons flying over canyons with mask pattern one." style="width:100%; margin-top:-200px">
                                    <div class="mask pattern-3 flex-center waves-effect waves-light">
                                        <p class="white-text" style="font-size: 2.3em">" <?= ucfirst(t('utilisateurs')) ?> "</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12" style="margin-top:-40px">
                    <?php
                    $val = $CI->users->getAllusers();
                    if ($val == NULL) {
                        ?>
                        vide
                        <?php
                    } else {
                        ?>
                        <div class="mdc-card">
                            <div class="table-heading px-2 px-1 border-bottom">
                                <h1 class="mdc-card__title mdc-card__title--large">Liste des Utilisateurs Inscrits</h1>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addUsers">Nouvel Utilisateur</button>
                            </div>
                            <div class=" table-responsive scroll_bleu">
                                <table class="table" style="margin-top:15px;">
                                    <thead>
                                        <tr>
                                            <th class="text-left"></th>
                                            <th><img src="<?= base_url() ?>assets/profile/defaut.png" class="img-circle" style="width:30px; height:30px; margin-right:15px; margin-top:-10px; float:left;"/>Nom & Prenom</th>
                                            <th>Matricule</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($val as $row):
                                            ?>
                                            <tr>
                                                <td class="text-left"><button class="col mdc-button edit-elemt" data-edit="users" id="<?= $row->id ?>" data-toggle="modal" data-target="#editUsers" data-mdc-auto-init="MDCRipple"><i class="mdi mdi-pencil text-blue"></i></button></td>
                                                <td><img src="<?= base_url() ?>assets/profile/<?= $row->photo ?>" class="img-circle" style="width:30px; height:30px; margin-right:15px; margin-top:-10px; float:left;"/><?= $row->nom ?>&nbsp;<?= $row->prenom ?></td>
                                                <td><?= $row->matricule ?></td>
                                                <td><a href="mailto:<?= $row->email ?>" class="badge badge-primary badge-pill" style="font-size:0.9em"><?= $row->email ?></a></td>
                                                <td><?= $row->role ?></td>
                                                <td><a href="<?= base_url() . $_SESSION['abbr_lang'] ?>/dashboard/users/<?= $row->id ?>/delete" class="col mdc-button" data-mdc-auto-init="MDCRipple"><i class="mdi mdi-delete text-red"></i></a></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>

    <div class="modal modal-default fade" id="addUsers">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                            <i class="fa fa-power-off"></i>X
                        </button>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addSujets" method="POST">
                        <div class="col-md-12">
                            <div class="row"><div class="icon"><h5><i class="fa fa-user"></i> AJouter un utilisateur</h5><br></div>
                                <div class="col-md-12">
                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                                        <label class="mdc-text-field w-100">
                                            <input type="text" name="nom" required class="mdc-text-field__input">
                                            <span class="mdc-text-field__label">Nom</span>
                                            <div class="mdc-text-field__bottom-line"></div>
                                        </label>
                                    </div>
                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                                        <label class="mdc-text-field w-100">
                                            <input type="text" name="prenom" required class="mdc-text-field__input">
                                            <span class="mdc-text-field__label">Prenom</span>
                                            <div class="mdc-text-field__bottom-line"></div>
                                        </label>
                                    </div>
                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                        <label class="mdc-text-field w-100">
                                            <input type="text" name="email" required class="mdc-text-field__input">
                                            <span class="mdc-text-field__label">Email</span>
                                            <div class="mdc-text-field__bottom-line"></div>
                                        </label>
                                    </div>
                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                        <label class="mdc-text-field w-100">
                                            <input type="text" name="matricule" required class="mdc-text-field__input">
                                            <span class="mdc-text-field__label">Matricule</span>
                                            <div class="mdc-text-field__bottom-line"></div>
                                        </label>
                                    </div>
                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                        <label class="mdc-text-field w-100">
                                            <select name="Typ_id" required class="mdc-text-field__input" id="typUser">
                                                <option value="">--/Choisir un Type Utilisateur/--</option>
                                                <?php
                                                foreach ($CI->typeuser->getAlltypeuser() as $typ):
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
                                    <input type="hidden" name="addUsers" value=""/>
                                    <input type="hidden" name="photo" value="defaut.png"/>

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
                <div class="col-md-12">
                    <div class="panel-group" id="accordion1">
                        <div class="panel">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne"><h4><i class="fa fa-plus"></i> Procédure dajout rapide</h4></a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    Cette partie vous donne la possibilité de faire vos enregistrement via un fichier Excel (.csv)
                                    <h6></h6>
                                    <form method="post" action="./Apercu/operation/users.php" class="savedata" id="login">
                                        <div class="md-form"> <i class="fa fa-file"></i>&nbsp;
                                            <label for="formS"> Choisir le fichier</label>
                                            <input type="file" name="fichier" required="" autocomplete="off" style="color:#888;" id="formS" class="form-control">
                                        </div><hr>
                                        <button type="submit" class="btn btn-primary btn-sm" id="push">Enregistrement</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal modal-default fade" id="editUsers">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                        <i class="fa fa-power-off"></i>X
                    </button>
                </button>
            </div>
            <div class="modal-body">
                <form id="addSujets" method="POST">
                    <div class="col-md-12">
                        <div class="row"><div class="icon"><h5><i class="fa fa-user"></i> Editer l'utilisateur</h5><br></div>
                            <div class="col-md-12">
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                                    <label class="mdc-text-field w-100">Nom
                                        <input type="text" name="nom" data-elmt="nom" required class="mdc-text-field__input data-edit">
                                        <span class="mdc-text-field__label"></span>
                                        <div class="mdc-text-field__bottom-line"></div>
                                    </label>
                                </div>
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                                    <label class="mdc-text-field w-100">Prenom
                                        <input type="text" name="prenom" data-elmt="prenom" required class="mdc-text-field__input data-edit">
                                        <span class="mdc-text-field__label"></span>
                                        <div class="mdc-text-field__bottom-line"></div>
                                    </label>
                                </div>
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                    <label class="mdc-text-field w-100">Email
                                        <input type="text" name="email" data-elmt="email" required class="mdc-text-field__input data-edit">
                                        <span class="mdc-text-field__label"></span>
                                        <div class="mdc-text-field__bottom-line"></div>
                                    </label>
                                </div>
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                    <label class="mdc-text-field w-100">Matricule
                                        <input type="text" name="matricule" data-elmt="matricule" required class="mdc-text-field__input data-edit">
                                        <span class="mdc-text-field__label"></span>
                                        <div class="mdc-text-field__bottom-line"></div>
                                    </label>
                                </div>
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                    <label class="mdc-text-field w-100">
                                        <select name="Typ_id" required class="mdc-text-field__input" id="typUser">
                                            <option value="">--/Choisir un Type Utilisateur/--</option>
                                            <?php
                                            foreach ($CI->typeuser->getAlltypeuser() as $typ):
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
                                <input type="hidden" name="editUsers" value=""/>

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
            <div class="modal-footer">

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


