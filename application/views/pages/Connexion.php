
<!-- ********** Hero Area Start ********** -->
<div class="hero-area">

<!-- ********** Hero Area Start ********** -->
<div class="hero-area height-400 bg-img background-overlay" style="background: url(<?=base_url()?>assets/img/student-education.jpg) center/cover; background-attachment:fixed"></div>
    <!-- ********** Hero Area End ********** -->
    <div class="container">
        <div class="row" style="min-height:350px;">
            <div class="col-md-3"></div>
                <div class="col-md-6 col-sm-6" style="margin-top:-60px; margin-bottom:20px; position:absolute; margin-top:-250px; z-index:99">
                    <div class="post-a-comment-area mt-70" style="background:#fff">
                    <center><h5>Accedez a votre Compte !</h5></center>
                        <!-- Contact Form -->
                        <form action="" method="post" id="getConnect">
                            <div class="row">
                                   <div class="col-12 col-md-12">
                                        <center><img src="<?=base_url()?>assets/img/avatar6.png" style="width:10%"/></center><br>
                                    </div>
                                <div class="col-12 col-md-6">
                                    <input type="hidden" name="connectUser"/>

                                    <div class="group">
                                        <input type="text" name="matricule" id="name" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Enter your matricule</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="group">
                                        <input type="password" name="password" id="pass" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Enter your password</label>
                                    </div>
                                </div>
                                <div class="col-12">

                                </div>
                                <div class="col-12">
                                    <center><button type="submit" id="push" class="btn btn-sm btn-primary">Connexion</button>
                                    <br><br>
                                    <a href="#" data-target="#retoreID" data-toggle="modal">Identifiants de Connexion Oublies ?</a>
                                    </center>
                                </div>
                                <div class="col-12 col-md-12" id="reponses"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ********** Hero Area End ********** -->

    <div class="modal modal-default fade" id="retoreID">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                                <i class="fa fa-power-off"></i>
                            </button>
                        </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="" style="margin-top:-0px;">
                        <div class="row">
                               <div class="col-12 col-md-12">
                                    <input type="hidden" name="restoreLink"/>
                                    <div class="group">
                                        <input type="email" name="email" id="email2" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Enter votre adresse email</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-12">
                                    <div class="group">
                                        <input type="text" name="matricule" id="mat" required>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Enter votre matricule</label>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-12">
                          <button class="btn btn-primary btn-sm" data-mdc-auto-init="MDCRipple">
                            Soumettre
                          </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
