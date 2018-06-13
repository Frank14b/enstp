<?php
  $_POST['M-Details'] = "Acces a la zone de messagerie";
?>

    <div class="page-wrapper mdc-toolbar-fixed-adjust" style="margin-top:-0px">
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

            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
            <div class="mdc-card">
                <div class="table-heading px-2 px-1 border-bottom">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addSujet">Nouveau Message</button>
                <button class="btn btn-warning btn-sm" data-target="#addGroup" data-toggle="modal">Creer un groupe</button><br><br>
                <div class="row">

            <div class="col-md-4">
                      <div class="row">
                          <div class="col-md-12">
                              <h5>Demarrer une Discussion</h5>
<div class="list-group card">
    <a href="#" class="list-group-item active waves-effect">
                        <div id="demo-tf-box-wrapper"  style="height:30px;">
                          <div id="tf-box-example" class="mdc-text-field mdc-text-field--box w-100">
                            <input required pattern=".{2,}" type="text" id="tf-box" class="mdc-text-field__input" aria-controls="name-validation-message" style="color:#fff">
                            <label for="tf-box" class="mdc-text-field__label">Trouver un Utilisateur | Groupe</label>
                          </div>
                          <p class="mdc-text-field-helper-text mdc-text-field-helper-text--validation-msg" id="name-validation-msg">
                            Must be at least 2 characters
                          </p>
                        </div>
    </a>
    <a href="#" class="list-group-item list-group-item-action disabled" style="background:#f5f5f5">Groupes</a>
    <div class="scroll scroll_bleu" style="max-height:200px; overflow-y:auto">
    <?php
    foreach($CI->groupes->getAllgroupes2($_SESSION['ens_userid']) as $use):
      ?><a href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/messages/<?=$use->id?>/g" class="list-group-item list-group-item-action">
      <img src="<?=$use->photo?>" class="img-circle" style="width:30px; height:30px; margin-right:15px; margin-top:-10px"/><?=$use->libeller?>
      <span class="badge badge-primary badge-pill" style="float:right"><?=$CI->messages->countmessagesbyID($use->id, $_SESSION['ens_userid'])?></span></a><?php
    endforeach;
    ?>
    </div>
    <a href="#" class="list-group-item list-group-item-action disabled" style="background:#f5f5f5">Utilisateurs</a>
    <div class="scroll scroll_bleu" style="max-height:350px; overflow-y:auto">
    <?php
    foreach($CI->users->getAllusers2($_SESSION['ens_userid']) as $use):
      ?><a href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/messages/<?=$use->id?>/d" class="list-group-item list-group-item-action">
      <img src="<?=base_url()?>assets/profile/<?=$use->photo?>" class="img-circle" style="width:30px; height:30px; margin-right:15px; margin-top:-10px"/><?=$use->nom ?> &nbsp;<?=$use->prenom ?>
      <span class="badge badge-primary badge-pill" style="float:right"><?=$CI->messages->countmessagesbyID($use->id, $_SESSION['ens_userid'])?></span></a><?php
    endforeach;
    ?>
    </div>
    <a href="#" class="list-group-item list-group-item-action disabled" style="background:#f5f5f5">Mes Groupes</a>
    <div class="scroll scroll_bleu" style="max-height:200px; overflow-y:auto">
    <?php
    foreach($CI->groupes->getAllgroupes($_SESSION['ens_userid']) as $use):
      ?><a href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/messages/<?=$use->id?>/g" class="list-group-item list-group-item-action">
      <img src="<?=$use->photo?>" class="img-circle" style="width:30px; height:30px; margin-right:15px; margin-top:-10px"/><?=$use->libeller?>
      <span class="badge badge-primary badge-pill" style="float:right; margin-left:5px"><?=$CI->messages->countmessagesbyID($use->id, $_SESSION['ens_userid'])?></span>
      <span class="badge badge-danger badge-pill" style="float:right; margin-left:5px"><?=$CI->joins->countWoWantToJoin($use->id, 'status', 1)?></span>
      <span class="badge badge-success badge-pill" style="float:right"><?=$CI->joins->countWoWantToJoin($use->id, 'status', 0)?></span></a><?php
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

          <div class="col-md-12" style="margin-bottom:15px; margin-top:10px">
           <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
          <?php 
            if(isset($d) || isset($g)){
              ?>
              <div class="mdc-card card--with-avatar">

              <section class="mdc-card__social-footer bg-blue" style="background:#f5f5f5">
              <?php 
               if(isset($g)){
                 $myg = $CI->groupes->getOneData($g, "Use_id");
                 if($myg == $_SESSION['ens_userid']){
                 ?>
                   <button data-target="#groupMemberModal" data-toggle="modal" class="btn btn-primary btn-sm" style="margin:-15px; margin-left:2px; margin-right:2px;">Membres du Groupe &nbsp; <span class="badge badge-default badge-pill" style="float:right; font-size:1.0em"><?=$CI->joins->countWoWantToJoin($g, 'status', 0)?></span></button>
                   <button data-target="#groupAdesionModal" data-toggle="modal" class="btn btn-danger btn-sm" style="margin:-15px; margin-left:2px; margin-right:2px;">Demandes D'adhesion &nbsp; <span class="badge badge-danger badge-pill" style="float:right; font-size:1.0em"><?=$CI->joins->countWoWantToJoin($g, 'status', 1)?></span></button>
                   <button data-target="#groupModal" data-toggle="modal" class="btn btn-info btn-sm" style="margin:-15px; margin-left:2px; margin-right:2px;">Configuration</button>
                 <?php 
                 }
               }
              ?>
              </section>

                <a href="<?=base_url()?><?=$_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/messages/<?=$d ?? 0?>/d#basbas" id="clickbas"></a>

            <div class="row" style="margin:20px;" id="hautChat">
            <div class="col-md-1">
            <img src="<?=base_url()?>assets/profile/<?=$CI->users->getOneData($_SESSION['ens_userid'], 'photo')?>" style="width:140%;"/>
            </div>
            <div class="col-md-11">
            <form method="POST" action="" id="addMess">
              <input type="hidden" name="addMess"/>
              <input type="text" name="texte" required class="mdc-text-field__input" id="inputChat" placeholder="votre message">
              <input type="hidden" name="useid2" value="<?=$d ?? 0 ?>" required/>
              <input type="hidden" name="groid" value="<?=$g ?? 0 ?>"/>
              <input type="submit" style="position:fixed; right:0; z-index:-2; visibility:hidden"/>
            </form>
            </div>
            </div>
              <?php 
                if(isset($g)){
                  $d = $g;
                  $_POST['retrive'] = "groupe";
                }else{
                  $d = $d;
                  $_POST['retrive'] = "";
                }
              ?>

                <?php 
                  if(isset($g)){
                    if($CI->groupes->getOneData($g, "Use_id") != $_SESSION['ens_userid']){

                    if($CI->joins->checkIfexistJoins($_SESSION['ens_userid'], $g, 0) == false){
                      ?>
                      <style>
                        #hautChat, #basChat{
                          display:none;
                        }
                      </style>

            <div class="mdc-layout-grid__cell card mdc-layout-grid__cell--span-12 stretch-card" style="margin-top:30px">
							<div class="mdc-card">
								<section class="mdc-card__primary">
									<h1 class="mdc-card__title mdc-card__title--large"><h3>Tentative d'acces au groupe <b><?=$CI->groupes->getOneData($g, "libeller") ?></b></h3></h1>
								</section>
								<section class="mdc-card__supporting-text">
                  <p class="mdc-typography--body1">Vous n'etes pas membre du groupe veuillez valider votre adhesion en suivant le lien plus bas ! vous serrez notifier en cas de confirmation d'adhesion.</p>
                  <img src="<?=base_url()?>assets/img/blog-img/b2.jpg" class="img-circle" alt="VIRTEK" style="width:100%">
									<hr/>
                  <?php  
                    if($CI->joins->checkIfexistJoins($_SESSION['ens_userid'], $g, 1) == false){
                      echo '<a class="btn btn-primary" id="joinsGroupe">Devenir Membre</a>';
                    }else{
                      echo '<a class="btn btn-success disabled">Demande d\'adhesion envoyé</a>';
                    }
                  ?>
								</section>
							</div>
                      <?php 
                    }else{
                      ?>
                         <div id="retriveMess" class="scroll scroll_bleu" style="max-height:1000px; overflow-y:auto">
                         </div>
                      <?php 
                    }
                  }else{
                    ?>
                      <div id="retriveMess" class="scroll scroll_bleu" style="max-height:1000px; overflow-y:auto">
                      </div>
                    <?php
                  }
                  }else{
                    ?>
                      <div id="retriveMess" class="scroll scroll_bleu" style="max-height:1000px; overflow-y:auto">
                      </div>
                    <?php 
                  }
                ?>
                
                <section class="mdc-card__social-footer bg-blue" id="basChat">
                  <div class="col">
                    <small>DiSCUSSION</small>
                    <p>
                    <?php 
                    if(isset($d)){
                      echo $CI->messages->countmessagesbyID($d, $_SESSION['ens_userid']);
                    }else{
                      echo $CI->messages->countmessagesbyID($g, $_SESSION['ens_userid']);
                    }
                    ?></p>
                  </div>
                  <div class="col">
                    <small>DERNIERE DISCUSSION</small>
                    <p><?=explode(" ",$CI->messages->getMinDate($d, $_SESSION['ens_userid'], "desc"))[0]?></p>
                  </div>
                  <div class="col">
                    <small>DEPUIS LE</small>
                    <p><?=explode(" ",$CI->messages->getMinDate($d, $_SESSION['ens_userid'], "asc"))[0]?></p>
                  </div>
                </section>
              </div>

              <?php 
               }else{
                   ?>
            <div class="mdc-layout-grid__cell card mdc-layout-grid__cell--span-12 stretch-card" style="margin-top:30px">
							<div class="mdc-card">
								<section class="mdc-card__primary">
									<h1 class="mdc-card__title mdc-card__title--large"><h3>Bienvenue Dans votre Messagerie</h3></h1>
								</section>
								<section class="mdc-card__supporting-text">
									<h1 class="mdc-typography--headline">Chattez avec vos Camarades</h1>
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
									<a href="" class="btn btn-primary">Creer un groupe</a>
								</section>
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                                <i class="fa fa-power-off"></i>X
                            </button>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form>
                    <div class="mdc-layout-grid">
                    <div class="row"><div class="icon"></div>
            					<div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                          <label class="mdc-text-field w-100">
                            <input type="text" required class="mdc-text-field__input" placeholder="Trouver un Utilisateur | Groupe">
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
            						</div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                          
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


        <div class="modal modal-default fade" id="addGroup">
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
                    <form>
                    <div class="col-md-12">
                    <div class="row"><div class="icon"><h5><i class="fa fa-user"></i> Creez votre Groupe</h5><br></div>
            					<div class="row">
                        <div class="col-md-6">
                          <label class="mdc-text-field w-100">
                            <input type="text" name="libeller" id="libgroup" required class="mdc-text-field__input">
                            <span class="mdc-text-field__label">Nom</span>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
            						</div>
                        <div class="col-md-6">
                          <label class="mdc-text-field w-100">
                            <input type="text" name="theme" id="temgroup" required class="mdc-text-field__input">
                            <span class="mdc-text-field__label">Theme</span>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
            						</div>
                        <div class="col-md-6">
                          <label class="mdc-text-field w-100">Niveau
                            <select name="Niv_id" id="nivgroup" class="mdc-text-field__input gNiveau">
                            <option  value=""></option>
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

                        <div class="col-md-6">
                          <label class="mdc-text-field w-100">Filieres
                            <select name="Fil_id" id="filgroup" class="mdc-text-field__input gFiliere">
                          
                            </select>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
                        </div>
                    
                  <div class="col-md-6">
                    <label class="mdc-text-field w-100">Groupe Public 
                    <div class="mdc-switch">
                      <input type="radio" name="etat" value="0" id="basic-switch" checked class="mdc-switch__native-control etatgroup" />
                      <div class="mdc-switch__background">
                        <div class="mdc-switch__knob"></div>
                      </div>
                    </div>
                    </label>
                  </div>
                  <div class="col-md-6">
                    <label class="mdc-text-field w-100">Groupe Prive
                    <div class="mdc-switch">
                      <input type="radio" name="etat" value="1" id="basic-switch" class="mdc-switch__native-control etatgroup"/>
                      <div class="mdc-switch__background">
                        <div class="mdc-switch__knob"></div>
                      </div>
                    </div>
                    </label>
                  </div>
                        
                        <div class="col-md-12">
                           <div class="form_groupe">
                                <div class="form_element btn-sm btn-default btn" style="padding:0px; width:100%" data-toggle="modal" data-target="#picture">
                                    <a class="zs_label mdc-text-field w-100" style="margin-top:10px; font-weight:bold">Choisir une Photo</a>
                                </div>
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
                                        <button class="btn btn-sm btn-success cropped_imageGroup">Enregistrer</button>
                                    </center>
                                    <br>
                                    <div id="upload-imageProfile">
                                    </div>
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


    <div class="modal modal-default fade" id="groupModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-power-off"></i>x
                        </button>
                    </div>
                    <div class="modal-body">
                  <form>
                    <div class="col-md-12">
                    <div class="row"><div class="icon"><h5><i class="fa fa-user"></i> Configuration du groupe</h5><br></div>
            					<div class="row">
                        <div class="col-md-12">
                          <label class="mdc-text-field w-100">Libeller
                            <input type="text" name="libeller" value="<?=$CI->groupes->getOneData($g,'libeller')?>" id="libgroup" required class="mdc-text-field__input">
                            <span class="mdc-text-field__label"></span>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
            						</div>
                        <div class="col-md-12">
                          <label class="mdc-text-field w-100">Description
                            <input type="text" name="theme" id="temgroup" value="<?=$CI->groupes->getOneData($g,'theme')?>" required class="mdc-text-field__input">
                            <span class="mdc-text-field__label"></span>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
            				</div>
                  <div class="col-md-6">
                    <label class="mdc-text-field w-100">Groupe Public 
                    <div class="mdc-switch">
                      <input type="radio" name="etat" value="0" id="basic-switch" <?php if($CI->groupes->getOneData($g,'etat') ==0)echo'checked'?> class="mdc-switch__native-control etatgroup" />
                      <div class="mdc-switch__background">
                        <div class="mdc-switch__knob"></div>
                      </div>
                    </div>
                    </label>
                  </div>
                  <div class="col-md-6">
                    <label class="mdc-text-field w-100">Groupe Prive
                    <div class="mdc-switch">
                      <input type="radio" name="etat" value="1" id="basic-switch" <?php if($CI->groupes->getOneData($g,'etat') ==1)echo'checked'?> class="mdc-switch__native-control etatgroup"/>
                      <div class="mdc-switch__background">
                        <div class="mdc-switch__knob"></div>
                      </div>
                    </div>
                    </label>
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

        <style>
         .deleteMess{
           display:none;
         }

         .objetMess:hover .deleteMess{
           display:block;
         }
        </style>


        <div class="modal modal-default fade" id="groupAdesionModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-power-off"></i>x
                        </button>
                    </div>
                    <div class="modal-body">
                         <h5>Demandes D'hadesion au groupe</h5>

                         <div class="row">
                            <div class="col-md-12">
                                <?php 
                                   if(isset($g)){
                                     $data = $CI->joins->getAlldemandes($g);
                                     if($data == false){

                                     }else{
                                      ?><ol><?php
                                       foreach ($data as $row):
                                          ?>
                                             <li><img src="<?=base_url()?>assets/profile/<?=$CI->users->getOneData($row->Use_id, "photo")?>" class="img-circle" style="width:30px; height:30px; margin-right:15px; margin-top:-10px"/>
                                             <?= $CI->users->getOneData($row->Use_id, "prenom") ?> <?= $CI->users->getOneData($row->Use_id, "nom") ?> 
                                             &nbsp; <a class="btn btn-sm btn-primary">Autoriser</a>&nbsp; <a class="btn btn-sm btn-warning">Refuser</a></li>
                                          <?php
                                       endforeach;
                                       ?></ol><?php
                                     }
                                   }
                                ?>
                            </div>
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


        <div class="modal modal-default fade" id="groupMemberModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-power-off"></i>x
                        </button>
                    </div>
                    <div class="modal-body">
                         <h5>Membres du groupe</h5>

                         <div class="row">
                            <div class="col-md-12">
                                <?php 
                                   if(isset($g)){
                                     $data = $CI->joins->getAllMember($g);
                                     if($data == false){

                                     }else{
                                      ?><hr><ol><?php
                                       foreach ($data as $row):
                                          ?>
                                             <li style="float:right"><img src="<?=base_url()?>assets/profile/<?=$CI->users->getOneData($row->Use_id, "photo")?>" class="img-circle" style="width:30px; height:30px; margin-right:15px; margin-top:-10px"/>
                                             <?= $CI->users->getOneData($row->Use_id, "prenom") ?> <?= $CI->users->getOneData($row->Use_id, "nom") ?> 
                                             &nbsp; <a class="btn btn-sm btn-primary" style="float:right">Contacter</a>&nbsp; <a class="btn btn-sm btn-warning" style="float:right">Retirer</a></li>
                                          <?php
                                       endforeach;
                                       ?></ol><?php
                                     }
                                   }
                                ?>
                            </div>
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