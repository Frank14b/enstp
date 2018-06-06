<?php
  $_POST['M-Details'] = "Acces a la zone des Exercices";
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

<div class="view zoom card" style="width:100%; height:230px">
    <img src="<?=base_url()?>assets/img/blog-img/cours.jpg" class="img-circle" alt="VIRTEK." style="width:100%; margin-top:-260px;">
    <div class="mask pattern-8 flex-center waves-effect waves-light">
        <p class="white-text" style="font-size: 2.3em">" Exercices "</p>
    </div>
</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12 card">
              <?php 

if(isset($ex)){
  ?>
    <div class="col-md-12">
     <div class="col-md-12"><a href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/exercices" class="btn btn-warning btn-sm">Retour</a></div>
     <div class="col-md-12" style="background:#fff; position:relative; height:auto; border:0px; margin-top:10px;" id="ob"></div>
     </div>
  <?php

}else{
$nbr = $CI->exos->countAllexos();

$perPage = 16;

if (isset($delete)) {
  $details = 0;
}

if (!isset($details)) {
  $details = 0;
}

if($details){
  $ini = $details; 
  $max = $ini + $perPage;
}else{
  $ini = 0; 
  $max = $perPage;
}


  $lang = $_SESSION['abbr_lang'] ?? 'fr';
  $config['base_url']=base_url().$lang."/dashboard/exercices/";
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

                $val = $CI->exos->getAllexosPaginate($ini, $max);
                if($val == NULL){
                    ?>
                      vide
                    <?php 
                }else{
                    ?>
                <div class="mdc-card">
                <div class="table-heading px-2 px-1 border-bottom">
                  <h1 class="mdc-card__title mdc-card__title--large">Liste des Exercices Ajoutes <span class="badge badge-primary badge-pill"><?=$CI->exos->countAllexos()?> Exercices</span></h1>
                  <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addExos">Nouvel Exercice</button>
                </div>
                <div class="col-md-12" style="margin-top:10px">
                <div class="row">

                      <?php 
                      foreach($val as $row):
                        ?>
            <div class="col-md-3" style="margin-bottom:15px; position:relative;">
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
              <div class="mdc-card card--with-avatar">
                <section class="mdc-card__primary card">
                  <div class="card__avatar"><img src="" alt=""></div>
                  <h1 class="mdc-card__title"><a href="<?=base_url().$_SESSION['abbr_lang']?>/dashboard/exercices/<?=$row->id?>/ex"><?=substr($row->libeller, 0, 20)?></a></h1>
                  <h2 class="mdc-card__subtitle"><?=substr($CI->matieres->getOneData($row->Mat_id, "libeller"), 0, 20)?>..
                  <?php if(empty($row->Mat_id))echo'Aucune Matiere associer';?></h2>
                  <h2 class="mdc-card__subtitle"><?=$CI->typeexos->getOneData($row->Typ_id, 'libeller') ?></h2>
                  <h2 class="mdc-card__subtitle"><?= $row->dates ?></h2>
                </section>
                <div class="mdc-card__social-footer bg-blue" style="background:#ddd;"> 
                  <div class="row">
                    <?php if($_SESSION["ens_userid"] == $row->Use_id){
                      ?>
                      <center><a href="" class="btn btn-primary btn-sm hidden" style="margin-top:-15px; margin-bottom:-15px;"><i class="mdi mdi-pencil"></i></a></center>
                      <?php
                    }
                    ?>
                    <center><a href="<?=base_url().$_SESSION['abbr_lang']?>/dashboard/exercices/<?=$row->id?>/ex" class="btn btn-default btn-sm" style="margin-top:-15px; margin-bottom:-15px;"><i class="mdi mdi-eye"></i></a></center>
                  </div>
                </div>
              </div>
            </div>
            </div>
                    <?php 
                      endforeach;
                    ?>

                    <div class="col-md-12"><hr><?php echo $this->pagination->create_links(); ?></div>
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
      
      <div class="modal modal-default fade" id="addExos">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5><i class="fa fa-user"></i> AJouter un Exercice</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                                <i class="fa fa-power-off"></i>X
                            </button>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form method="post" id="addSuppor" style="margin-top:-37px;" enctype="multipart/form-data">
                    <div class="row">
                    <div class="col-md-12"><div class="icon"></div>
            					<div class="mdc-layout-grid">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                          <label class="mdc-text-field w-100">
                            <input type="text" name="libeller" class="mdc-text-field__input">
                            <span class="mdc-text-field__label">Intituler</span>
                            <div class="mdc-text-field__bottom-line"></div>
                            <input type="hidden" name="addExercice"/>
                          </label>
            						</div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6 hidden">
                          <label class="mdc-text-field w-100">
                            <input type="text" name="details" class="mdc-text-field__input">
                            <span class="mdc-text-field__label">Description</span>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
            						</div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                          <label class="mdc-text-field w-100">Niveau
                            <select name="Typ_id" class="mdc-text-field__input">
                          <?php 
                            foreach($CI->typeexos->getAlltypeexos() as $typ):
                          ?>
                          <option  value="<?=$typ->id?>">
                            <?=$typ->libeller?>
                            </option>
                          <?php 
                            endforeach;
                          ?>
                            </select>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
                        </div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                          <label class="mdc-text-field w-100">Niveau
                            <select name="Niv_id" class="mdc-text-field__input gNiveau">
                          <?php 
                            foreach($CI->niveau->getAllniveau() as $typ):
                          ?>
                          <option  value="<?=$typ->id?>">
                            <?=$typ->libeller?>
                            </option>
                          <?php 
                            endforeach;
                          ?>
                            </select>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
                        </div>
                      <div class="row">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6 col-md-6">
                          <label class="mdc-text-field w-100">Filiere
                            <select name="Fil_id" class="mdc-text-field__input gFiliere">
                          
                            </select>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
                        </div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6 col-md-6">
                          <label class="mdc-text-field w-100">Matiere
                            <select name="Mat_id" class="mdc-text-field__input gMatiere">
                          
                            </select>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
                        </div>
                      </div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                        <label class="mdc-text-field w-100">Support PDF
                            <input type="file" class="mdc-text-field__input" required name="icone" id="support">
                            <span class="mdc-text-field__label" style="margin-top:120px"></span>
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
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->