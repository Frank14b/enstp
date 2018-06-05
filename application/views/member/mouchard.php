<?php
$_POST['M-Details'] = "Acces a la zone Mouchard";
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
                <?php
                    $val = $CI->mouchar->getAllmouchar();
                    if ($val == NULL) {
                        ?>
                        vide
                        <?php
                    } else {
                        ?>
                        <div class="mdc-card">
                            <div class="table-heading px-2 px-1 border-bottom">
                                <h1 class="mdc-card__title mdc-card__title--large">Traffic Complet sur l'application</h1>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#addUsers">Tout Effacé</button>
                            </div>
                            <div class=" table-responsive scroll_bleu">
                                <table class="table" style="margin-top:15px;">
                                    <thead>
                                        <tr>
                                            
                                            <th><img src="<?= base_url() ?>assets/img/loading.gif" class="img-circle" style="width:30px; height:30px; margin-right:15px; margin-top:-10px; float:left;"/>Utilisateurs</th>
                                            <th>Page</th>
                                            <th>Details</th>
                                            <th>Dates</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($val as $row):
                                            ?>
                                            <tr>
                                                
                                                <td><img src="<?= base_url() ?>assets/profile/<?= $CI->users->getOneData($row->Use_id, "photo")?>" class="img-circle" style="width:30px; height:30px; margin-right:15px; margin-top:-10px; float:left;"/><?= $CI->users->getOneData($row->Use_id, "nom")?>&nbsp;<?= $CI->users->getOneData($row->Use_id, "prenom")?></td>
                                                <td><?= $row->libeller ?></td>
                                                <td><a class="badge badge-primary badge-pill" style="font-size:0.9em"><?= $row->details ?></a></td>
                                                <td><?= $row->dates ?></td>
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