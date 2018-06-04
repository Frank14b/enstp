<?php
    $CI = &get_instance();
?>
                                <!-- ********** Hero Area Start ********** -->
<div class="hero-area">

<!-- ********** Hero Area Start ********** -->
<div class="hero-area height-400 bg-img background-overlay" style="background: url(<?=base_url()?>assets/img/student-education.jpg) center/cover; background-attachment:fixed"></div>
    <!-- ********** Hero Area End ********** -->
    <div class="container">
        <div class="row" style="min-height:350px; margin-top:-165px;">
        <?php
                    $nbr = $CI->documents->countAlldocuments();

                    $perPage = 6;

                    $nb = $this->uri->segment(3);
                    if(!isset($nb)){
                        $details = 0;
                    }else{
                        $details = $this->uri->segment(3);
                    }

                    if ($details) {
                        $ini = $details;
                        $max = $ini + $perPage;
                    } else {
                        $ini = 0;
                        $max = $perPage;
                    }


                    $lang = $_SESSION['abbr_lang'] ?? 'fr';
                    $config['base_url'] = base_url() . $lang . "/Documentation";
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
                        <div class="col-12 col-md-10 col-lg-10" style="background:#fff">
                            <div class="single-blog-post card" style="background:#fff; padding:20px">
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
                    }else{
                        $CI->pagination->initialize($config);
                        ?>
                        <?php
                        foreach ($val as $py):
                        ?>
                <div class="col-12 col-md-6 col-lg-4" style="margin-bottom:10px;">
                    <!-- Single Blog Post -->
                    <div class="single-blog-post" style="background:#fff">
                        <!-- Post Thumbnail -->
                        <div class="post-thumbnail">
                            <img src="<?php echo $py->photo ?? base_url() . 'assets/img/blog-img/b4.jpg' ?>" alt="">
                            <!-- Catagory -->
                            <div class="post-cta"><a href="#">Documents</a></div>
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <a href="#" class="headline">
                                <h5><?= $CI->typedoc->getOneData($py->Typ_id, "libeller") ?> | <?= $py->libeller ?></h5>
                            </a>
                            <p><?= substr($py->details, 0, 115) ?> ...</p>
                            <!-- Post Meta -->
                            <div class="post-meta">
                                <p><a href="#" class="post-author">VIRTEK</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                     <?php 
                     endforeach;
                    }
                     ?>
        </div>
        <div class="col-md-12" style="margin-bottom:30px; margin-top:20px;"><center><?php echo $this->pagination->create_links(); ?></center></div>
    </div>
</div>
</div>