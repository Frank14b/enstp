<?php
  $_POST['M-Details'] = "Configuration Profil utilisateur";
?>


    <div class="page-wrapper mdc-toolbar-fixed-adjust">
      <main class="content-wrapper">
        <div class="mdc-layout-grid">
          <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
              <div class="mdc-card">
                <div class="mdc-layout-grid__inner">
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12 card">

<style>
   .gris{
     background:#aaa; 
     color:#fff
   }
</style>

<?php
$CI = &get_instance();

?>
                  </div>
                </div>
              </div>
            </div>

            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12" style="margin-top:-50px;">
            <div class="mdc-card">
                <div class="table-heading px-2 px-1 border-bottom">
                <div class="row">

                <div class="col-md-4">
                      <div class="row">
                          <div class="col-md-12">

              <div class="list-group">
                <div class="col-md-12" style="margin-bottom:15px; position:relative">
                   <div class="zs_cards card_vert" style="margin-bottom:20px">
                         <div class="card_image" style="background:#fff">
                         <img src="<?=base_url()?>assets/profile/<?php echo $CI->users->getOneData($_SESSION['ens_userid'], 'photo') ?? 'avatar6.png' ?>" alt="VIRTEK" class="" style="border-radius:0px; width:75%;"/>
                         </div>
                         <div class="card_date">
                             <span class="date_day"><?=explode("-", $CI->users->getOneData($_SESSION['ens_userid'], 'dates'))[2] ?? ""?></span>
                             <span class="date_month"><?=explode("-", $CI->users->getOneData($_SESSION['ens_userid'], 'dates'))[1] ?? ""?></span>
                             <span class="date_year"><?=explode("-", $CI->users->getOneData($_SESSION['ens_userid'], 'dates'))[0] ?? ""?></span>
                         </div>
                         <div class="body_card">
                             <div class="cat_card"><?=$CI->users->getOneData($_SESSION['ens_userid'], "role") . '&nbsp;, '.$CI->users->getOneData($_SESSION['ens_userid'], "matricule")?></div>
                             <div class="titre_card" style="font-size:0.7em; font-weight:bolder;"><h4><i class="now-ui-icons users_single-02"></i> <b style="float:right"><?=$CI->users->getOneData($_SESSION['ens_userid'], 'prenom') . '&nbsp;' . $CI->users->getOneData($_SESSION['ens_userid'], 'nom')?></b></h4>   
                             <div class="sous-titre_card" style="margin-top:20px;">Details</div>
                             <p class=" desc_card" style="font-weight:bold">
                             <i class="now-ui-icons ui-1_email-85"></i> Email : <a href="mailto:<?=$CI->users->getOneData($_SESSION['ens_userid'], "email")?>"><?=$CI->users->getOneData($_SESSION['ens_userid'], "email")?></a></div>
                             Numéro : <a href="tel:<?=$CI->users->getOneData($_SESSION['ens_userid'], "phone")?>"><?=$CI->users->getOneData($_SESSION['ens_userid'], "phone")?></a><br>
                             </p>
                         </div>
                         <div class="footer_card">
                             <a></a>
                         </div>
                    </div>
                </div>
             </div>

             <div class="list-group">
                <div class="col-md-12" style="margin-bottom:15px; position:relative">
                            <form method="post" class="addElemt">
                                 <input type="hidden" name="editUsers2"/>
                                    <div class="mdc-layout-grid__cell stretch-card">
                                        <label class="mdc-text-field w-100">Mon Niveau
                                            <select name="Niv_id" required class="mdc-text-field__input gNiveau form-control">
                                                <option  value="<?=$CI->users->getOneData($_SESSION['ens_userid'], 'Niv_id')?>"><?=$CI->niveau->getOneData($CI->users->getOneData($_SESSION['ens_userid'], 'Niv_id'),"libeller")?></option>
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

                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                                        <label class="mdc-text-field w-100">Ma Filiere
                                            <select name="Fil_id" required class="mdc-text-field__input gFiliere form-control">
                                                <option value="<?=$CI->users->getOneData($_SESSION['ens_userid'], 'Fil_id')?>"><?=$CI->filieres->getOneData($CI->users->getOneData($_SESSION['ens_userid'], 'Fil_id'), "libeller")?></option>
                                            </select>
                                            <div class="mdc-text-field__bottom-line"></div>
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm pull-right">Confirmer</button>
                                </form>
                </div>
             </div>
                          </div>
                      </div>
                  </div>


                  <div class="col-md-8">
                      <div class="col-md-12 card" style="padding:15px;">
                          <!-- Custom Tabs (Pulled to the right) -->
			                <div class="nav-tabs-custom" style="background: none;">
			                    <ul class="nav nav-tabs pull-right" style="background: none;">
			                        <li class="active">
			                            <a href="#tab_1-1" class="btn btn-primary btn-sm" data-toggle="tab"><i class="fa fa-user"></i>&nbsp; Generale</a>
			                        </li>
			                        
			                        <li>
			                            <a href="#tab_3-2" class="btn btn-primary btn-sm" data-toggle="tab"><i class="fa fa-eye"></i>&nbsp; Securité</a>
	                                </li>
	                                <li><a href="#" class="btn btn-success btn-sm" data-target="#picture" data-toggle="modal"><i class="fa fa-picture"></i>&nbsp; Changer ma Photo</a></li>
			                    </ul>
			                    <div class="tab-content">
			                        <div class="tab-pane active" id="tab_1-1"><br>
			                            <h5>Informations Générales :</h5><br>

			                            <form class="addElemt" method="POST">
					                                    <div class="row">
					                                        <input type="hidden" name="editProfile"/>
					                                        <div class="col-md-4">
					                                            <div class="form-group">
                                                                   <input type="hidden" name="editUsers1"/>
					                                                <label>Nom</label>
					                                                <input type="text" required class="form-control" name="nom"  placeholder="nom" value="<?=$CI->users->getOneData($_SESSION['ens_userid'], 'nom')?>">
					                                            </div>
					                                        </div>
					                                        <div class="col-md-4">
					                                            <div class="form-group">
					                                                <label>Prenom</label>
					                                                <input type="text" required class="form-control" name="prenom" placeholder="Prenom" value="<?=$CI->users->getOneData($_SESSION['ens_userid'], 'prenom')?>">
					                                            </div>
					                                        </div>
					                                        <div class="col-md-4">
					                                            <div class="form-group">
					                                                <label for="exampleInputEmail1">Email address</label>
					                                                <input type="email" required class="form-control" name="email" placeholder="Email" value="<?=$CI->users->getOneData($_SESSION['ens_userid'], 'email')?>">
					                                            </div>
					                                        </div>
					                                    </div>
					                                    <div class="row">
					                                        <div class="col-md-6 pr-1">
					                                            <div class="form-group">
					                                                <label>Numero</label>
					                                                <input type="number" required class="form-control" name="phone" placeholder="Numero" value="<?=$CI->users->getOneData($_SESSION['ens_userid'], 'phone')?>">
					                                            </div>
					                                        </div>
					                                        <div class="col-md-6 pl-1">
					                                            <div class="form-group">
					                                                <label>Login</label>
					                                                <input type="text" required class="form-control" name="matricule" placeholder="Matricule" value="<?=$CI->users->getOneData($_SESSION['ens_userid'], 'matricule')?>">
					                                            </div>
					                                        </div>
					                                    </div>

					                                    <div class="row">
					                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Date de Naissance</label>
                                                <input type="date" name="naiss" class="form-control" value="<?=$CI->users->getOneData($_SESSION['ens_userid'], 'naiss')?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mot de Passe</label>
                                                <input type="password" class="form-control" required name="password" placeholder="mon adresse" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-12" id="reponses"></div>
                                        <div class="col-md-12" id="push">
                                             <button type="submit" class="btn btn-primary">Confirmer</button>
                                             <button type="reset" class="btn btn-warning">Annuler</button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                        <!-- /.tab-pane -->
                        
                        <div class="tab-pane" id="tab_3-2"><br>
                            <h5>Mot de Passe :</h5><br>

               <form id="inscriptForm" method="POST">
                  <div class="row">
                    <input type="hidden" name="editPassword"/>
                    <div class="col-md-12 pr-1">
                        <div class="form-group">
                            <label>Mot de Passe actuel</label>
                            <input type="password" required class="form-control" name="pass1"  placeholder="Mot de Passe" value="">
                        </div>
                    </div>
                    <div class="col-md-12 pr-1">
                        <div class="form-group">
                            <label>Nouveau Mot de Passe</label>
                            <input type="password" required class="form-control" name="pass2" placeholder="Mot de Passe" value="">
                        </div>
                    </div>
                    <div class="col-md-12 pr-1">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Confirmer Mot de Passe</label>
                            <input type="password" required class="form-control" name="pass3" placeholder="Mot de Passe" value="">
                        </div>
                    </div>
                </div>

                   <div class="row">
                     <div class="col-md-12" id="reponses"></div>
                        <div class="col-md-12" id="push">
                           <button type="submit" class="btn btn-primary">Confirmer</button>
                           <button type="reset" class="btn btn-warning">Annuler</button>
                        </div>
                       </div>
               </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
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
                                        <button class="btn btn-sm btn-success cropped_imageUsers">Enregistrer</button>
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