
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

            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
              
                <?php 

                if($val == NULL){
                    ?>
                      vide
                    <?php 
                }else{
                    ?>
                     <div class="mdc-card">
                <div class="table-heading px-2 px-1 border-bottom">
                <h1 class="mdc-card__title mdc-card__title--large">Liste des Niveaux Disponibles</h1>
                  <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addfil">Nouveau Niveau</button>
                </div>
                <div class=" table-responsive scroll_bleu">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-left"></th>
                      <th>Intituler</th>
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
                      <td><?= $row->details ?></td>
                      <td><a href="<?=base_url().$_SESSION['abbr_lang']?>/dashboard/niveau/<?=$row->id?>/delete" class="col mdc-button" data-mdc-auto-init="MDCRipple"><i class="mdi mdi-delete text-red"></i></a></td>
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
      
      <div class="modal modal-default fade" id="addfil">
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
                <div class="mdc-layout-grid">
                <div class="row"><div class="icon"><h5><i class="fa fa-user"></i> AJouter un Niveau</h5><br></div>
                  <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                      <label class="mdc-text-field w-100">
                        <input type="text" name="libeller" required class="mdc-text-field__input">
                        <span class="mdc-text-field__label">Intituler</span>
                        <div class="mdc-text-field__bottom-line"></div>
                        <input type="hidden" name="addNiveau"/>
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
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->