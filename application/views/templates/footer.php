<!-- ***** Footer Area Start ***** -->
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="footer-single-widget">
                    <a href="#"><img src="<?= base_url() ?>assets/img/core-img/logo.png" alt=""></a>
                    <div class="copywrite-text mt-30">
                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> | Made by <a href="">Frank Donald Fontcha</i>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="footer-single-widget">
                    <ul class="footer-menu">
                        <li><a href="#"><i class="fa fa-home"></i> Acceuil</a></li>
                        <li><a href="#"><i class="fa fa-sign-in"></i> Connexion</a></li>
                        <li><a href="#"><i class="fa fa-book"></i> Documents & Livres</a></li>
                        <li><a href="#"><i class="fa fa-phone"></i> Contacts</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="footer-single-widget">
                    <h5>Souscrire à la newsletter</h5>
                    <form action="#" method="post">
                        <input type="email" name="email" id="email" placeholder="Entrer votre adresse email">
                        <button type="button"><i class="fa fa-arrow-right"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ***** Footer Area End ***** -->

<!-- jQuery (Necessary for All JavaScript Plugins) -->
<script src="<?= base_url() ?>assets/js/jquery/jquery-2.2.4.min.js"></script>
<!-- Popper js -->
<script src="<?= base_url() ?>assets/js/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<!-- Plugins js -->
<script src="<?= base_url() ?>assets/js/plugins.js"></script>
<!-- Active js -->
<script src="<?= base_url() ?>assets/js/active.js"></script>

<script>

                            if (window.Notification && Notification.permission !== "denied")
                            {
                                Notification.requestPermission(function (status) {  // status is "granted", if accepted by user
                                    var n = new Notification('VIRTEK', {
                                        body: 'Bonjour ! Bienvenue sur VIRTEK',
                                        icon: '<?= base_url() ?>assets/img/core-img/favicon.ico' // optional
                                    });
                                });
                            }

                            $(document).ready(function () {
                                $('#getConnect').on('submit', function (e) {
                                    var $this = $(this);
                                    e.preventDefault();
                                    $this.find('#reponses').show();
                                    $this.find('#reponses').html('<div class="col-md-12 alert text-center" style="background: #f5f5f5;; padding:5px;"><center><img src="<?php echo base_url(); ?>css/img/preloader.gif" style="width: 80px; height: 80px; border-radius: 50%;"/><br>En cours de verification ...</center>'
                                            + '</div>');
                                    $this.find('#push').hide();
                                    $.ajax({
                                        type: "POST",
                                        url: "",
                                        data: $this.serialize(),
                                        dataType: 'json',
                                        success:
                                                function (data) {
                                                    if (data == 0) {
                                                        $this.find('#reponses').html('<div class="alert" style="background: #f5f5f5; color: green; margin-top: 0px;">'
                                                                + '<div class="col-md-12 text-center">Redirection en cours ...'
                                                                + '</div></div>');
                                                        $this.find('#push').show();
                                                        setTimeout(function () {
                                                            window.location.reload();
                                                        }, 1500);
                                                    } else {
                                                        $this.find('#push').show();
                                                        $this.find('#reponses').html('<div class="alert" style="background: #f5f5f5; color: #ff6565; margin-top: 0px;">'
                                                                + '<div class="col-md-12 text-center">'
                                                                + data + '</div></div>');
                                                        $this.find('#push').show();
                                                    }
                                                }
                                    });// you have missed this bracket
                                })
                            });
</script>

</body>

</html>