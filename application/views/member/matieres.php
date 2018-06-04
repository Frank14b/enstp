<?php
  $_POST['M-Details'] = "Acces a la zone Matieres";
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

<div class="view zoom card" style="width:100%; max-height:250px; display:none">
    <img src="<?=base_url()?>assets/img/core-img/header-bg.jpg" class="img-circle" alt="Image of ballons flying over canyons with mask pattern one." style="width:100%; margin-top:-200px">
    <div class="mask pattern-3 flex-center waves-effect waves-light">
        <p class="white-text" style="font-size: 2.3em">" <?=ucfirst(t('utilisateurs'))?> "</p>
    </div>
</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12" style="margin-top:-40px">
            <div class="row">
            <div class="col-md-7">
              <?php 
                $val = $CI->matieres->getAllmatieres();

                if(isset($power) or isset($supprimer)){
                  ?>
                    <div class="alert card" style="border-radius:0px; margin-top:-5px;<?php if(isset($power)){echo 'color:#096304d0';}else{ echo 'color:orange';} ?>">
                                              <span>
                                                  <b><i class="now-ui-icons travel_info"></i> &nbsp; Infos - </b> <?= $power ?? $supprimer ?></span>
                                          </div>
                  <?php 
              }

                if($val == NULL){
                    ?>
                      vide
                    <?php 
                }else{
                    ?>
              <div class="mdc-card" style="padding:15px;">
                <div class="table-heading px-2 px-1 border-bottom">
                <h1 class="mdc-card__title mdc-card__title--large">Liste des Matieres Disponible</h1>
                 </div>
                <div class=" table-responsive scroll_bleu">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-left"></th>
                      <th>Intituler</th>
                      <th>Filieres</th>
                      <th>Niveau</th>
                      <th>Details</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                      foreach($val as $row):
                        ?>
                    <tr>
                      <td class="text-left"><button class="col mdc-button" data-mdc-auto-init="MDCRipple"><i class="mdi mdi-pencil text-blue"></i></button></td>
                      <td><?= $row->libeller ?></td>
                      <td><?= $CI->filieres->getOneData($row->Fil_id, 'libeller') ?></td>
                      <td><?= $CI->niveau->getOneData($CI->filieres->getOneData($row->Fil_id, 'Niv_id'),'libeller') ?></td>
                      <td><?= $row->details ?></td>
                      <td><a href="<?=base_url().$_SESSION['abbr_lang']?>/dashboard/matieres/<?=$row->id?>/delete" class="col mdc-button" data-mdc-auto-init="MDCRipple"><i class="mdi mdi-delete text-red"></i></a></td>
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
        
            <div class="col-md-5 card" style="padding:15px;">
            <form method="POST" class="addElemt">
                    <div class="col-md-12">
                    <div class="row"><div class="icon"><h5><i class="fa fa-user"></i> AJouter une Matiere</h5><br></div>
            					<div class="col-md-12">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                          <label class="mdc-text-field w-100">
                            <input type="text" name="libeller" required class="mdc-text-field__input">
                            <span class="mdc-text-field__label">Intituler</span>
                            <div class="mdc-text-field__bottom-line"></div>
                            <input type="hidden" name="addMatiere"/>
                          </label>
            						</div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                          <label class="mdc-text-field w-100">
                            <input type="text" name="details" required class="mdc-text-field__input">
                            <span class="mdc-text-field__label">Description</span>
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

                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                          <label class="mdc-text-field w-100">Filieres
                            <select name="Fil_id" class="mdc-text-field__input gFiliere">
                               
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
                    <form>
                    <div class="mdc-layout-grid">
                    <div class="row"><div class="icon"><h5><i class="fa fa-user"></i> AJouter un utilisateur</h5><br></div>
            					<div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                          <label class="mdc-text-field w-100">
                            <input type="text" required class="mdc-text-field__input">
                            <span class="mdc-text-field__label">Nom</span>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
            						</div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                          <label class="mdc-text-field w-100">
                            <input type="text" required class="mdc-text-field__input">
                            <span class="mdc-text-field__label">Prenom</span>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
            						</div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                          <label class="mdc-text-field w-100">
                            <input type="text" required class="mdc-text-field__input">
                            <span class="mdc-text-field__label">Email</span>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
            						</div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                          <label class="mdc-text-field w-100">
                            <input type="text" required class="mdc-text-field__input">
                            <span class="mdc-text-field__label">Matricule</span>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
                        </div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                          <label class="mdc-text-field w-100">
                            <select name="typeuser" class="mdc-text-field__input">
                          <?php 
                            foreach($CI->typeuser->getAlltypeuser() as $typ):
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