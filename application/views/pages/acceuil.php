

    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area">

        <!-- Hero Slides Area -->
        <div class="hero-slides owl-carousel">
        <div class="single-hero-slide bg-img background-overlay" style="background-image: url(<?=base_url()?>assets/img/student-education.jpg);"></div>
            <!-- Single Slide -->
            <div class="single-hero-slide bg-img background-overlay" style="background-image: url(<?=base_url()?>assets/img/blog-img/bg1.jpg);"></div>
            <div class="single-hero-slide bg-img background-overlay" style="background-image: url(<?=base_url()?>assets/img/traditional-vs-online-school-title.png);"></div>
            <!-- Single Slide -->
            <div class="single-hero-slide bg-img background-overlay" style="background-image: url(<?=base_url()?>assets/img/blog-img/bg2.jpg);"></div>
        </div>

        <!-- Hero Post Slide -->
        <div class="hero-post-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="hero-post-slide">
                            <!-- Single Slide -->
                            <div class="single-slide d-flex align-items-center">
                                <div class="post-number">
                                    <p>1</p>
                                </div>
                                <div class="post-title">
                                    <a href="single-blog.html">Bienvenue sur VIRTEK</a>
                                </div>
                            </div>
                            <!-- Single Slide -->
                            <div class="single-slide d-flex align-items-center">
                                <div class="post-number">
                                    <p>2</p>
                                </div>
                                <div class="post-title">
                                    <a href="single-blog.html">Obtenez toute l'actualite du campus</a>
                                </div>
                            </div>
                            <!-- Single Slide -->
                            <div class="single-slide d-flex align-items-center">
                                <div class="post-number">
                                    <p>3</p>
                                </div>
                                <div class="post-title">
                                    <a href="single-blog.html">Les cours, exercices, corriges,... aux formats texte, video et images</a>
                                </div>
                            </div>
                            <!-- Single Slide -->
                            <div class="single-slide d-flex align-items-center">
                                <div class="post-number">
                                    <p>4</p>
                                </div>
                                <div class="post-title">
                                    <a href="single-blog.html">Abonez vous pour rester informer et beneficier de la documentation</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ********** Hero Area End ********** -->

    <div class="main-content-wrapper section-padding-100">
        <div class="container">
            <!-- ============== Related Post ============== -->
        <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Single Blog Post -->
                    <div class="single-blog-post">
                        <!-- Post Thumbnail -->
                        <div class="post-thumbnail">
                            <img src="<?=base_url()?>assets/img/core-img/Fotolia_55608174_S.jpg" alt="">
                            <!-- Catagory -->
                            <div class="post-cta"><a href="#">Froum</a></div>
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <a href="#" class="headline">
                                <h5>Vous avez et vous rencontrez des problemes lors de vos differents traitements dexercices et autres?</h5>
                            </a>
                            <p>Grace au forum VITERK retrouvez toute la communautes estudiantine de l'ENSTP et exposez y vos differents problemes pour pouvoir en debatre et vous apporter des solutions rapides et partager !</p>
                            <!-- Post Meta -->
                            <div class="post-meta">
                                <p><a href="#" class="post-author">VIRTEK</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Single Blog Post -->
                    <div class="single-blog-post">
                        <!-- Post Thumbnail -->
                        <div class="post-thumbnail">
                            <img src="<?=base_url()?>assets/img/traditional-vs-online-school-title.png" alt="">
                            <!-- Catagory -->
                            <div class="post-cta"><a href="#">Cours, Exercices & corriges</a></div>
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <a href="#" class="headline">
                                <h5>Les cours, exercices, corriges, resumes de cours aux formats texte, video et images</h5>
                            </a>
                            <p>Accedez a votre compte pour beneficier de la notre espacE Cours & exos. Vous pourrez vous aboner pour rester informer des nouveautes sur les cours</p>
                            <!-- Post Meta -->
                            <div class="post-meta">
                                <p><a href="#" class="post-author">VIRTEK</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Single Blog Post -->
                    <div class="single-blog-post">
                        <!-- Post Thumbnail -->
                        <div class="post-thumbnail">
                            <img src="<?=base_url()?>assets/img/core-img/header-bg.jpg" alt="">
                            <!-- Catagory -->
                            <div class="post-cta"><a href="#">Messagerie</a></div>
                            <!-- Video Button -->
                            <a href="https://www.youtube.com/watch?v=IhnqEwFSJRg" class="video-btn"><i class="fa fa-play"></i></a>
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <a href="#" class="headline">
                                <h5>Vous avez besoin dun coatching direct a tout instant, en tout lieux, de vos cammarades, de vos profs?</h5>
                            </a>
                            <p>Vous avez la possibilite via votre compte de demarrer une discussion avec vos amis, vos profs pour obtenir une assistance particuliere sur vos problemes tout en restant dans un cadre confidentiel.</p>
                            <!-- Post Meta -->
                            <div class="post-meta">
                                <p><a href="#" class="post-author">VIRTEK</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center cards hover" style="background:#f5f5f5; margin-top:20px; border-radius:0px">
                <!-- ========== Single Blog Post ========== -->
                
                <?php
    $CI = &get_instance();
?>

                <?php
                    $val = $CI->documents->getAlldocumentspaginate(0, 3);
                    if ($val == NULL) {
                        ?>
                    <div class="col-12 col-md-12 col-lg-12">
                    <div class="single-blog-post post-style-3 mt-50 wow fadeInUpBig" data-wow-delay="0.6s">
                        <!-- Post Thumbnail -->
                        <div class="post-thumbnail">
                            <img src="<?=base_url()?>assets/img/student-education.jpg" alt="" style="height:500px;">
                            <!-- Post Content -->
                            <div class="post-content d-flex align-items-center justify-content-between" >
                                <!-- Catagory -->
                                <div class="post-tag"><a href="#">Documents & Livres</a></div>
                                <!-- Headline -->
                                <h1 class="mdc-typography--headline" style="color:#fff">Oups ! Aucun document disponible trouvé</h1>
                                    <h1 class="mdc-typography--title" style="color:#fff">Echangez sur vos activites</h1>
                                    <h2 class="mdc-typography--subheading2" style="color:#fff">Discussion Instantannee</h2>
                                    <h2 class="mdc-theme--secondary mdc-typography--subheading1" style="color:#fff">Comment sa marche ?</h2>
                                    <p class="mdc-typography--body1" style="color:#fff">
                                        Demarrez une discussion avec lun de vos camarade en choisissant un utilisateur vis le menu de gauche.
                                        <br>
                                        Vous pouvez decider de creer un groupe de discussion et y integrer plusieurs de vos camarades pour avoir une discussion en groupe. Vous avez le choix 
                                        et la possibilite de creer un groupe caractere privee ou publique selon le mode daudience que vous desirez pour le votre.
                                        <br>
                                        Vous pouvez decider de creer un groupe relatif a votre niveau detude. Ce groupe ne sera visible que par le utilisateurs ayant le meme niveau detude que vous.
                                    </p>
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <p><center><a href="#" class="post-author btn btn-primary">M'abonner a la Bibliotheque</a></center></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        <?php
                    }else{
                        //$CI->pagination->initialize($config);
                        ?>
                        <div class="col-12 col-md-12 col-lg-12" style="margin-bottom:10px; margin-top:15px;">
                          <h2>Documents & Livres</h2>
                        </div>
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
                     ?>
                       <div class="col-12 col-md-12 col-lg-12" style="margin-bottom:10px;"><hr>
                       <p><center><a href="#" class="post-author btn btn-primary">Plus de Documents & Livres</a></center></p>
                        </div>
                     <?php 
                    }
                     ?>
            </div>

            <div class="row justify-content-center cards">
                <!-- ========== Single Blog Post ========== -->
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="single-blog-post post-style-3 mt-50 wow fadeInUpBig" data-wow-delay="0.6s">
                        <!-- Post Thumbnail -->
                        <div class="post-thumbnail">
                            <img src="<?=base_url()?>assets/img/blog-img/bg3.jpg" alt="">
                            <!-- Post Content -->
                            <div class="post-content d-flex align-items-center justify-content-between">
                                <!-- Catagory -->
                                <div class="post-tag"><a href="#">Actualites</a></div>
                                <!-- Headline -->
                                <a href="#" class="headline">
                                    <h5><b>Oups !</b> Aucune nouvelle actualite disponible abonnez vous pour rester informer</h5>
                                </a>
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <p><center><a href="#" class="post-author btn btn-primary">M'abonner aux Actualites</a></center></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
    <div class="container-fluid bg-img background-overlay" style="background: url(<?=base_url()?>assets/img/education-for-sale.jpg)center/cover; background-attachment:fixed">
    <div class="row" style="background:linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.3))">            
    <div class="col-md-2"></div>
                <div class="col-12 col-lg-8">
                    <div class="post-a-comment-area mt-70">
                        <h5 style="color:#fff">Envoyez nous un message</h5>
                        <!-- Contact Form -->
                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="group">
                                        <input type="text" name="name" id="name" required style="background:none; color:#fff">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Enter your name</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="group">
                                        <input type="email" name="email" id="email" required style="background:none; color:#fff">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Enter your email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group">
                                        <textarea name="message" id="message" required style="background:none; color:#fff"></textarea>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Enter your comment</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn world-btn">Envoyer le Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</div>

