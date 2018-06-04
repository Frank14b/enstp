<?php
$_POST['M-Details'] = "Acces a la zone de Documenation";
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
                                <!-- Card image -->

                                <div class="view zoom card" style="width:100%;">
                                    <img src="<?= base_url() ?>assets/img/blog-img/bg3.jpg" class="img-circle" alt="Image of ballons flying over canyons with mask pattern one." style="width:100%">
                                    <div class="mask pattern-2 flex-center waves-effect waves-light">
                                        <p class="white-text" style="font-size: 2.3em">" Documents | Livres "</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                    <?php
                    $nbr = $CI->documents->countAlldocuments();

                    $perPage = 12;

                    if ($details) {
                        $ini = $details;
                        $max = $ini + $perPage;
                    } else {
                        $ini = 0;
                        $max = $perPage;
                    }


                    $lang = $_SESSION['abbr_lang'] ?? 'fr';
                    $config['base_url'] = base_url() . $lang . "/dashboard/documents/";
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

                    $val = $CI->documents->getAlldocumentspaginate($ini, $max);
                    if ($val == NULL) {
                        ?>
                        <div class="mdc-layout-grid__cell text-center card mdc-layout-grid__cell--span-12 stretch-card" style="margin-top:30px">
                            <div class="mdc-card">
                                <section class="mdc-card__primary">
                                    <h1 class="mdc-card__title mdc-card__title--large"><h3>Aucun document disponible dans votre panel</h3></h1>
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
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#addUsers">Ajouter un Document</a>
                                </section>
                            </div>
                        </div>
                        <?php
                    } else {
                        $CI->pagination->initialize($config);
                        ?>
                        <div class="mdc-card">
                            <div class="table-heading px-2 px-1 border-bottom">
                                <h1 class="mdc-card__title mdc-card__title--large">Liste des Documents du Systeme</h1>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addUsers">Nouveau Document</button>
                            </div>

                            <div class="row">
                                <div class="col-lg-12" style="margin-top:25px;">
                                    <div class="row" style="padding-left:15px;">
                                        <?php
                                        foreach ($val as $py):
                                            ?>
                                            <div class="col-md-4">
                                                <div class="zs_cards card_vert" style="margin-bottom:20px;position:relative">
                                                    <a class="" style="position:absolute; top:8px; z-index:2; background:none; color:#fff; padding:5px;"><i class="mdi mdi-pencil"></i></a> 
                                                    <div class="card_image view zoom" style="">

                                                        <img src="<?php echo $py->photo ?? base_url() . 'assets/img/blog-img/b4.jpg' ?>" class="" style="border-radius:0px;"/>
                                                        <div class="mask rgba-black-light flex-center waves-effect waves-light">
                                                            <p class="white-text" style="font-size: 2.3em"></p>
                                                        </div>
                                                    </div>
                                                    <div class="card_date">
                                                        <?php $py->dates = date("Y-m-d") ?>
                                                        <span class="date_day"><?= explode("-", $py->dates)[2] ?></span>
                                                        <span class="date_month"><?= explode("-", $py->dates)[1] ?></span>
                                                        <span class="date_year"><?= explode("-", $py->dates)[0] ?></span>
                                                    </div>
                                                    <div class="body_card">
                                                        <div class="cat_card"><?= $CI->typedoc->getOneData($py->Typ_id, "libeller") ?></div>
                                                        <div class="titre_card" style="font-size:0.7em; font-weight:bolder; text-align:right"><h4><?= $py->libeller ?></h4></div>
                                                        <div class="sous-titre_card">Details</div>
                                                        <p class=" desc_card">
                                                            <?= substr($py->details, 0, 115) ?> ...
                                                            <button class="btn btn-sm btn-primary"><i class="mdi mdi-pencil"></i></button>
                                                            <button class="btn btn-sm btn-danger pull-right"><i class="mdi mdi-delete"></i></button>
                                                        </p>
                                                    </div>
                                                    <div class="footer_card">
                                                        <a>VIRTEK</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        endforeach;
                                        ?>
                                        <div class="col-md-12"><?php echo $this->pagination->create_links(); ?></div>
                                    </div>
                                </div>
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
                    <form method="POST" class="zs_form" enctype="multipart/form-data">
                        <div class="mdc-layout-grid">
                            <div class="row"><div class="icon"><h5><i class="fa fa-user"></i> AJouter un Document</h5><br></div>
                                <div class="mdc-layout-grid__inner">
                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                                        <label class="mdc-text-field w-100">
                                            <input type="text" id="textedoc" name="libeller" required class="mdc-text-field__input">
                                            <span class="mdc-text-field__label">Titre</span>
                                            <div class="mdc-text-field__bottom-line"></div>
                                        </label>
                                    </div>
                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                                        <label class="mdc-text-field w-100">
                                            <input type="text" id="detailsdoc" name="details" required class="mdc-text-field__input">
                                            <span class="mdc-text-field__label">Details</span>
                                            <div class="mdc-text-field__bottom-line"></div>
                                        </label>
                                    </div>
                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                        <label class="mdc-text-field w-100">
                                            <select name="typeuser" id="typdoc" required class="mdc-text-field__input">
                                                <option value=""></option>
                                                <?php
                                                foreach ($CI->typedoc->getAlltypedoc() as $typ):
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

                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                        <div class="form_groupe">
                                            <div class="form_element btn-sm btn-default btn" style="padding:0px; height:40px">
                                                <a class="zs_label mdc-text-field w-100" data-toggle="modal" data-target="#picture" style="margin-top:-40px; font-weight:bold">Choisir une Photo</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                    </div>
                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">

                                    </div>
                                </div>
                            </div>
                    </form>

                </div>
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
                                    <button class="btn btn-sm btn-success cropped_imageDoc">Enregistrer</button>
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