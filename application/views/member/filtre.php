<?php
  $_POST['M-Details'] = "Acces Espace Filtre";
?>

    <div class="page-wrapper mdc-toolbar-fixed-adjust">
      <main class="content-wrapper">
        <div class="mdc-layout-grid">
        <div class="row">
              <div class="col-md-12">
              <?php 
               $CI = &get_instance();
                $val = $CI->niveau->getAllniveau();

                if(isset($power) or isset($supprimer)){
                  ?>
                    <div class="alert card" style="border-radius:0px; margin-top:-25px;<?php if(isset($power)){echo 'color:#096304d0';}else{ echo 'color:orange';} ?>">
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
<!-- Card image -->

<div class="view zoom card" style="width:100%; height:230px">
    <img src="<?=base_url()?>assets/img/blog-img/cours.jpg" class="img-circle" alt="VIRTEK." style="width:100%; margin-top:-260px;">
    <div class="mask pattern-3 flex-center waves-effect waves-light">
        <p class="white-text" style="font-size: 2.3em">" Elements à Filtrer "</p>
    </div>
</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
              <?php 
                $val = $CI->filtre->getAllfiltre();
                if($val == NULL){
                    ?>
                      vide
                    <?php 
                }else{
                    ?>
                     <div class="mdc-card">
                <div class="table-heading px-2 px-1 border-bottom">
                  <h1 class="mdc-card__title mdc-card__title--large">Liste des Mots dangereux <span class="badge badge-primary badge-pill"><?=$CI->filtre->countAllfiltre()?></span></h1>
                  <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addExos">Nouveau Mot dangereux</button>
                </div>
                <div class=" table-responsive scroll_bleu">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-left"></th>
                      <th>Libelle</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                      foreach($val as $row):
                        ?>
                    <tr>
                      <td class="text-left"><button class="col mdc-button" data-mdc-auto-init="MDCRipple"><i class="mdi mdi-pencil text-blue"></i></button></td>
                      <td><strong><?= $row->mots ?></strong></td>
                      <td><a href="<?=base_url().$_SESSION['abbr_lang']?>/dashboard/filtre/<?=$row->id?>/delete" class="col mdc-button" data-mdc-auto-init="MDCRipple"><i class="mdi mdi-delete text-red"></i></a></td>
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
                    <form>
                    <div class="mdc-layout-grid">
                    <div class="row"><div class="icon"><h5><i class="fa fa-user"></i> AJouter un utilisateur</h5><br></div>
            					<div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                          <label class="mdc-text-field w-100">
                            <input type="text" class="mdc-text-field__input">
                            <span class="mdc-text-field__label">Nom</span>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
            						</div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                          <label class="mdc-text-field w-100">
                            <input type="text" class="mdc-text-field__input">
                            <span class="mdc-text-field__label">Prenom</span>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
            						</div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                          <label class="mdc-text-field w-100">
                            <input type="text" class="mdc-text-field__input">
                            <span class="mdc-text-field__label">Email</span>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
            						</div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                          <label class="mdc-text-field w-100">
                            <input type="text" class="mdc-text-field__input">
                            <span class="mdc-text-field__label">Matricule</span>
                            <div class="mdc-text-field__bottom-line"></div>
                          </label>
            						</div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
              <div class="mdc-card" style="padding:0px">
                <section class="mdc-card__primary">
                  <h1 class="mdc-card__title mdc-card__title--large">Role Utilisateur</h1>
                </section>
                <section class="mdc-card__supporting-text">
                  <div class="template-demo">
                    <div id="hero-js-select" class="mdc-select" role="listbox">
                      <div class="mdc-select__surface" tabindex="0">
                        <div class="mdc-select__label">Pick a Food Group</div>
                        <div class="mdc-select__selected-text"></div>
                        <div class="mdc-select__bottom-line"></div>
                      </div>
                      <div class="mdc-simple-menu mdc-select__menu">
                        <ul class="mdc-list mdc-simple-menu__items">
                          <li class="mdc-list-item" role="option" tabindex="0">
                            Bread, Cereal, Rice, and Pasta
                          </li>
                          <li class="mdc-list-item" role="option" tabindex="0">
                            Vegetables
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </section>
              </div>
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