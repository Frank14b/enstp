<?php
  $_POST['M-Details'] = "Acces a la zone des Cours";
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

<div class="view zoom card viewCours" style="width:100%; height:230px">
    <img src="<?=base_url()?>assets/img/blog-img/cours.jpg" class="img-circle" alt="VIRTEK." style="width:100%; margin-top:-260px;">
    <div class="mask pattern-7 flex-center waves-effect waves-light">
        <p class="white-text" style="font-size: 2.3em">" Cours "</p>
    </div>
</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="alpha mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12 card">
              <?php 
              if(isset($lists)){
                ?>
                <div class="table-heading px-2 px-1 border-bottom">
                  <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addChapter">Ajouter un nouveau element</button>
                  <a href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/cours" class="btn btn-warning btn-sm">Retour</a>
                </div>

                  <style>
                    .viewCours{
                      display:none;
                    }
                    .alpha{
                      margin-top:-50px;
                    }
                  </style>
                    <div class="col-md-12" style="padding:15px;">
                  <div class="row">
                    <div class="col-md-9">
                    <?php
                      if($CI->parties->getAllpartiesbyCours($lists) != false){
                         ?>
                         <div class="col-md-12" style="position:relative;"><b><h4><i class='now-ui-icons education_glasses'></i> &nbsp; Apercu du document</h4><br/>
                         <h5>Cours => <b><?=$CI->cours->getOneData($lists, "libeller")?></b> : Derniere Mise a jour => <?=explode(" ",$CI->cours->getOneData($lists, "dates"))[0]?><h5></b></div>
                         <div class="col-md-12" style="background:#fff; position:relative; height:auto; border:0px; margin-top:10px;" id="ob"></div><?php
                      }else{
                        ?>
                       <p class="mdc-typography--body1">Aucune donnee n'est disponible pour ce cours ! Abonnez vous pour recevoir des notifications des la disponibilite des parties | Chapitres de ce cours.</p>
                       <img src="<?=base_url()?>assets/img/blog-img/b2.jpg" class="img-circle" alt="VIRTEK" style="width:100%">
                       <?php 
                      }
                      ?>
                    </div>
                    <div class="col-md-3">
                              <h5></h5>
<div class="list-group card">
    <a href="#" class="list-group-item active waves-effect">
        Parties | Chapitres
    </a>
    <a href="#" class="list-group-item disabled waves-effect">
        Supports PDF's
    </a>
    <?php
    if($CI->parties->getAllpartiesbyCours($lists) != false){
    foreach($CI->parties->getAllpartiesbyCours($lists) as $mat):
      ?><a class="list-group-item list-group-item-action">
      <div class="mdc-switch">
                      <input type="radio" name="id" data-table="id" value="<?=$mat->id?>" id="basic-switch" class="mdc-switch__native-control partiesCchoise" />
                      <div class="mdc-switch__background">
                        <div class="mdc-switch__knob"></div>
                      </div>
                    </div>
      <?=$mat->libeller?>
       </a><?php
    endforeach;
  }else{
    echo'<div class="alert alert-primary">Aucune donnee disponible pour ce cours</div>';
  }
    ?>
    <a href="#" class="list-group-item disabled waves-effect">
        Supports Videos
    </a>
</div>
                  </div>            
                  </div>   
                <?php 

              }else{
              $nbr = $CI->cours->countAllcours();

              $perPage = 10;
              
              if($details){
                $ini = $details; 
                $max = $ini + $perPage;
              }else{
                $ini = 0; 
                $max = $perPage;
              }
              
              
                $lang = $_SESSION['abbr_lang'] ?? 'fr';
                $config['base_url']=base_url().$lang."/dashboard/cours/";
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

                $val = $CI->cours->getAllcoursPagination($ini, $max);
                if($val == NULL){
                    ?>
              <div class="mdc-layout-grid__cell text-center card mdc-layout-grid__cell--span-12 stretch-card" style="margin-top:30px;">
							<div class="mdc-card">
								<section class="mdc-card__primary">
									<h1 class="mdc-card__title mdc-card__title--large"><h3>Aucun Cours disponible dans votre panel</h3></h1>
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
									<a href="" class="btn btn-primary" data-toggle="modal" data-target="#addUsers">Ajouter un Cours</a>
								</section>
							</div>
						</div>
                    <?php 
                }else{
                    ?>
                     <div class="mdc-card col-md-12">
                <div class="table-heading px-2 px-1 border-bottom">
                  <h1 class="mdc-card__title mdc-card__title--large">Liste des Cours Ajoutes <span class="badge badge-primary badge-pill"><?=$nbr?> Cours</span></h1>
                  <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addUsers">Nouveau Cours</button>
                </div>
                
                <div class="row" style="background:#f5f5f5">
                <div class="col-md-7" style="margin-top:25px; margin-left:0%;">
                <div class="row">
                      <?php 
                      foreach($val as $row):
                        ?>
                    
            <div class="col-md-6" style="margin-bottom:15px; position:relative;">
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
              <div class="mdc-card card--with-avatar">
                <section class="mdc-card__primary card">
                  <div class="card__avatar"><img src="" alt=""></div>
                  <h1 class="mdc-card__title"><a href=""><?=substr($row->libeller, 0, 20)?></a><span class="badge badge-primary badge-pill" style="float:right"><?=$CI->parties->countByCol($row->id, 0, 'Cou_id')?></span></h1>
                  <h2 class="mdc-card__subtitle"><?=substr($CI->matieres->getOneData($row->Mat_id, "libeller"), 0, 20)?>..</h2>
                  <h2 class="mdc-card__subtitle"><?=$CI->typecours->getOneData($row->Typ_id, 'libeller') ?></h2>
                  <h2 class="mdc-card__subtitle"><?= $row->dates ?></h2>
                </section>
                <div class="mdc-card__social-footer bg-blue" style="background:#ddd;"> 
                  <div class="row">

                    <?php 
                      if($row->Use_id == $_SESSION['ens_userid']){
                        ?><center><a href="" class="btn btn-primary btn-sm" style="margin-top:-15px; margin-bottom:-15px;"><i class="mdi mdi-pencil"></i></a></center><?php 
                      }
                    ?>
                    
                    <center><a href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/cours/<?=$row->id?>/lists" class="btn btn-default btn-sm" style="margin-top:-15px; margin-bottom:-15px;"><i class="mdi mdi-eye"></i></a></center>
                  </div>
                </div>
              </div>
            </div>
            </div>
                    <?php 
                      endforeach;
                    ?><div class="col-md-12"><?php echo $this->pagination->create_links(); ?></div>
                    </div>
                    </div>
                    
                    <div class="col-md-5">
                      <div class="row">
                          <div class="col-md-12">
                              <h5></h5>
<div class="list-group">
    <a href="#" class="list-group-item active waves-effect">
        Choix de la Matiere requis
    </a>
    <?php
    foreach($CI->matieres->getAllmatieres() as $mat):
      ?><a class="list-group-item list-group-item-action <?php if($CI->cours->countByCol($mat->id, 0, 'Mat_id') == 0)echo'hidden';?>">
      <div class="mdc-switch">
                      <input type="radio" name="id" data-table="Mat_id" value="<?=$mat->id?>" id="basic-switch" class="mdc-switch__native-control forumchoise" />
                      <div class="mdc-switch__background">
                        <div class="mdc-switch__knob"></div>
                      </div>
                    </div>
      <?=$mat->libeller?><span class="badge badge-primary badge-pill" style="float:right"><?=$CI->cours->countByCol($mat->id, 0, 'Mat_id')?></span>
       </a><?php
    endforeach;
    ?>
</div>

<div class="list-group">
    <a href="#" class="list-group-item active waves-effect">
        Choix de la Rubrique requise
    </a>
    <?php
    foreach($CI->typecours->getAlltypecours() as $mat):
      ?><a class="list-group-item list-group-item-action <?php if($CI->cours->countByCol($mat->id, 0, 'Typ_id') == 0)echo'hidden';?>">
        <div class="mdc-switch">
                      <input type="radio" name="id" data-table="Typ_id" value="<?=$mat->id?>" id="basic-switch" class="forumchoise mdc-switch__native-control" />
                      <div class="mdc-switch__background">
                        <div class="mdc-switch__knob"></div>
                      </div>
                    </div>
        <?=$mat->libeller?><span class="badge badge-primary badge-pill" style="float:right"><?=$CI->cours->countByCol($mat->id, 0, 'Typ_id')?></span>
       </a><?php
    endforeach;
    ?>
</div>

                          </div>
                      </div>
                  </div>

            </div>


                    <?php 
                }
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
                    <form method="POST" class="addElemt">
                    <div class="col-md-12">
                    <div class="row"><div class="icon"><h5><i class="fa fa-user"></i> AJouter un Cours</h5><br></div>
                    <div class="col-md-12">
                                        <label class="mdc-text-field w-100">
                                            <input type="text" name="libeller" required class="mdc-text-field__input">
                                            <span class="mdc-text-field__label">Intituler</span>
                                            <div class="mdc-text-field__bottom-line"></div>
                                            <input type="hidden" name="addCours"/> 
                                        </label>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mdc-text-field w-100">
                                            <textarea required name="details" class="mdc-text-field__input"></textarea>
                                            <span class="mdc-text-field__label">Details</span>
                                            <div class="mdc-text-field__bottom-line"></div>
                                        </label>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="mdc-text-field w-100">Type de Cours
                                            <select name="Typ_id" class="mdc-text-field__input">
                                                <option  value=""></option>
                                                <?php
                                                foreach ($CI->typecours->getAlltypecours() as $typ):
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

                                    <div class="col-md-6">
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

                                    <div class="col-md-6">
                                        <label class="mdc-text-field w-100">Filieres
                                            <select name="Fil_id" class="mdc-text-field__input gFiliere">

                                            </select>
                                            <div class="mdc-text-field__bottom-line"></div>
                                        </label>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="mdc-text-field w-100">Matieres
                                            <select name="Mat_id" class="mdc-text-field__input gMatiere">

                                            </select>
                                            <div class="mdc-text-field__bottom-line"></div>
                                        </label>
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
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal modal-default fade" id="addChapter">
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
                    <form method="post" id="addSupportt" enctype="multipart/form-data">
                    <div class="mdc-layout-grid">
                    <div class="row"><div class="icon"><h5><i class="fa fa-user"></i> AJouter un(e) nouveau(elle) Chapitre | Partie</h5><br></div>
            					<div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                          <label class="mdc-text-field w-100">Chapitre | Partie
                            <input type="text" class="mdc-text-field__input" required name="libeller">
                            <span class="mdc-text-field__label"></span>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
            						</div>
                        <input name="Cou_id" type="hidden" required value="<?=$lists?>"/>
                        <input type="hidden" name="addSupportCours"/>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                        <label class="mdc-text-field w-100">Titre
                            <input type="text" class="mdc-text-field__input" required name="descript">
                            <span class="mdc-text-field__label"></span>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
            						</div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                        <label class="mdc-text-field w-100">Support du Cours
                            <input type="file" class="mdc-text-field__input" required name="icone" id="support">
                            <span class="mdc-text-field__label" style="margin-top:120px"></span>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
            						</div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                          <button type="submit" class="mdc-button mdc-button--raised w-100" data-mdc-auto-init="MDCRipple">
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
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->