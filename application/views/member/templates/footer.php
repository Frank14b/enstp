
<!-- partial:partials/_footer.html -->
<footer>
    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                <span class="text-muted">Copyright © <?= date("Y") ?> <a class="text-green" href="" target="_blank">VIRTEK</a>. All rights reserved. | Made by <a href="">Frank Fontcha</a></span>
            </div>
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6 d-flex justify-content-end">
                <span class="mt-0 text-right">Hand-crafted &amp; made with <i class="mdi mdi-heart text-red"></i></span>
            </div>
        </div>
    </div>
</footer>
<!-- partial -->
</div>
</div>
<!-- body wrapper -->
<!-- plugins:js -->
<script src="<?= base_url() ?>assets/admin/node_modules/material-components-web/dist/material-components-web.min.js"></script>
<script src="<?= base_url() ?>assets/admin/node_modules/jquery/dist/jquery.min.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="<?= base_url() ?>assets/admin/node_modules/chart.js/dist/Chart.min.js"></script>
<script src="<?= base_url() ?>assets/admin/node_modules/progressbar.js/dist/progressbar.min.js"></script>
<script src="<?= base_url() ?>assets/mdb/js/jquery-3.2.1.min.js"></script>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="<?= base_url() ?>assets/admin/js/misc.js"></script>
<script src="<?= base_url() ?>assets/admin/js/material.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="<?= base_url() ?>assets/admin/js/dashboard.js"></script>
<!-- End custom js for this page-->

<script src="<?= base_url() ?>assets/mdb/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/mdb/js/mdb.js"></script>
<script src="<?= base_url() ?>assets/mdb/js/popper.min.js"></script>

<script src="<?php echo base_url(); ?>assets/zonestyle/js/myJs.js"></script>
<script src="<?php echo base_url(); ?>assets/zonestyle/js/croppie.js"></script>
<script src="<?php echo base_url(); ?>assets/zonestyle/js/pdfobject.js"></script>

<script src="<?php echo base_url(); ?>assets/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables-responsive/dataTables.responsive.js"></script>

<?php
$CI = &get_instance();

if ($title == "profile") {
    ?>
    <script>

        // Note: This example requires that you consent to location sharing when
        // prompted by your browser. If you see the error "The Geolocation service
        // failed.", it means you probably did not give permission for the browser to
        // locate you.

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -35.997, lng: 250.644},
                zoom: 6
            });

            var infoWindow = new google.maps.InfoWindow({map: map});

            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    infoWindow.setPosition(pos);
                    infoWindow.setContent("Votre position");
                    map.setCenter(pos);
                }, function () {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                    'Error: The Geolocation service failed.' :
                    'Error: Your browser doesn\'t support geolocation.');
        }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpVz8n3SUhLlMZXgxyPZpoI-3OESQsMPU&callback=initMap"></script>
    <?php
}
?>

<script>

<?php
if (isset($lists)) {
    ?>
        var options = {
            fallbackLink: false,
            height: "1000px",

            pdfOpenParams: {
                view: 'FitH',
                scrollbars: '0',
                statusbar: '0',
                navpanes: '0',
                pagemode: 'thumbs',
    <?php
    if ($roleUser != "Admin") {
        ?> toolbar: '0', <?php
    }
    ?>
            }
        };
    <?php
    if ($roleUser == "Postulant" || $roleUser == "Admin") {
        $offres = "postulant";
        $file = "details";
        if ($this->uri->segment(3) == "offres") {
            $offres = "offres";
            $file = "details";
        }
    } else {
        $offres = "offres";
        $file = "details";

        if ($this->uri->segment(3) == "cv") {
            $offres = "postulant";
            $file = "details";
        }
    }
    ?>
        function loadPDF(link)
        {
            new PDFObject.embed("<?= base_url() ?>assets/cours/" + link, "#ob", options);
        }
        loadPDF("<?= $CI->parties->getfirstDatabyCours($lists, 'details'); ?>")

    <?php
}

if (isset($ex)) {
    ?>
        var options = {
            fallbackLink: false,
            height: "1000px",

            pdfOpenParams: {
                view: 'FitH',
                scrollbars: '0',
                statusbar: '0',
                navpanes: '0',
                pagemode: 'thumbs',
    <?php
    if ($roleUser != "Admin") {
        ?> toolbar: '0', <?php
    }
    ?>
            }
        };
    <?php
    if ($roleUser == "Postulant" || $roleUser == "Admin") {
        $offres = "postulant";
        $file = "details";
        if ($this->uri->segment(3) == "offres") {
            $offres = "offres";
            $file = "details";
        }
    } else {
        $offres = "offres";
        $file = "details";

        if ($this->uri->segment(3) == "cv") {
            $offres = "postulant";
            $file = "details";
        }
    }
    ?>
        function loadPDF(link)
        {
            new PDFObject.embed("<?= base_url() ?>assets/exos/" + link, "#ob", options);
        }
        loadPDF("<?= $CI->exos->getfirstDatabyExos($ex, 'details'); ?>")

    <?php
}
?>
    $(document).ready(function () {

        $('.partiesCchoise').on('change', function () {
            var id = $(this).val()
            $.ajax({
                type: 'POST',
                url: "",
                data: {'getOneDatabyCours': '', 'id': id},
                //contentType: "application/json",
                //dataType: 'json',
                success: function (data) {
                    if (data != 0) {
                        loadPDF(data)
                    } else {

                    }
                }
            })
        });


        $('.zs_form').zsForm();

        $('.mdc-expansion-panel').hide()
        $('.mdc-drawer-item').attr('data-toggle', 'expansionPanel').on('click', function () {
            $('.mdc-expansion-panel').hide()
            $(this).find('.mdc-expansion-panel').show()
        })

        function vumess(user2) {
            $.ajax({
                type: 'POST',
                url: "",
                data: {'vuMess': '', 'Use_id2': user2},
                //contentType: "application/json",
                //dataType: 'json',
                success: function (data) {
                    //alert(data)
                    if (data != 0) {
                        retriveMess()
                        //alert('ok')
                    } else {
                        //alert('no')
                    }
                }
            })
        }

        $('#addMess').on('submit', function (e) {
            e.preventDefault();
            var $this = $(this)
            $.ajax({
                type: 'POST',
                url: "",
                data: $this.serialize(),
                //contentType: "application/json",
                //dataType: 'json',
                success: function (data) {
                    //alert(data)
                    if (data != 0) {
                        retriveMess()
                        $this.find('#inputChat').val("")
                    } else {
                        alert('no')
                    }
                }
            })
        });

<?php
if (isset($g)) {
    ?>
            $('#joinsGroupe').on('click', function (e) {
                e.preventDefault();
                $(this).addClass('disabled')
                $.ajax({
                    type: 'POST',
                    url: "",
                    data: {'Use_id':<?= $_SESSION["ens_userid"] ?>, 'id': '<?= $g ?>', 'joinsGroupe': ''},
                    success: function (data) {
                        if (data != 0) {
                            window.location.reload();
                        } else {
                            alert('echec veuillez reessayer plutard !')
                            window.location.reload();
                        }
                    }
                })
            });
    <?php
}
?>

        $('#addSujets').on('submit', function (e) {
            e.preventDefault();
            var $this = $(this)
            $.ajax({
                type: 'POST',
                url: "",
                data: $this.serialize(),
                success: function (data) {
                    //alert(data)
                    if (data != 0) {
                        //console.log('ok')
                        window.location.reload()
                    } else {
                        alert('echec lors de lajout de lelement')
                    }
                }
            })
        });

        $('.gNiveau').on('change', function () {
            var idniv = $(this).val()

            $.ajax({
                type: 'POST',
                url: "",
                data: {'Niv_id': idniv, 'getFil': ''},
                //contentType: "application/json",
                dataType: 'json',
                success: function (data) {
                    //alert(data)
                    if (data != 0) {
                        $('.gFiliere').html('')
                        $('.gMatiere').html('')

                        $('.gFiliere').append('<option>--/-Choisir-/--</option>')
                        for (i in data) {
                            $('.gFiliere').append('<option value="' + data[i].id + '">' + data[i].libeller + '</option>')
                        }
                    } else {
                        $('.gFiliere').html('')
                        $('.gMatiere').html('')
                    }
                }
            })
        });

        $('.gFiliere').on('change', function () {
            var idfil = $(this).val()

            $.ajax({
                type: 'POST',
                url: "",
                data: {'Fil_id': idfil, 'getMat': ''},
                //contentType: "application/json",
                dataType: 'json',
                success: function (data) {
                    //alert(data)
                    if (data != 0) {
                        $('.gMatiere').html('')
                        $('.gMatiere').append('<option>--/-Choisir-/--</option>')
                        for (i in data) {
                            $('.gMatiere').append('<option value="' + data[i].id + '">' + data[i].libeller + '</option>')
                        }
                    } else {
                        $('.gMatiere').html('')
                    }
                }
            })
        });

        $('#addCommActu').on('submit', function (e) {
            var $this = $(this)
            e.preventDefault()
            $.ajax({
                type: 'POST',
                url: "",
                data: $this.serialize(),
                success: function (data) {
                    if (data != 0) {
                        $('.formComment').val("")
                    } else {
                        alert('Echec lors de lenvoi du commentaire')
                    }
                }
            });

            forumComments();
        });

        $('.addElemt').on('submit', function (e) {
            var $this = $(this)
            e.preventDefault()
            $.ajax({
                type: 'POST',
                url: "",
                data: $this.serialize(),
                success: function (data) {
                    if (data != 0) {
                        alert('Element enregistrer avec succes !')
                        window.location.reload()
                    } else {
                        alert('Echec lors de lenregistrement de lelement')
                    }
                }
            });
        })

        $('#addSupportt').on('submit', function (e) {
            var $this = $(this)
            e.preventDefault()
            $.ajax({
                type: 'POST',
                url: "",
                data: new FormData(this),
                contentType: false,
                processData: false,
                enctype: "multipart/form-data",
                success: function (data) {
                    //alert(data)
                    if (data == 0) {
                        window.location.reload()
                    } else {
                        alert('Echec lors de lenregistrement')
                    }
                }
            });
        });

        $('.forumchoise').on('change', function () {
            var table = $(this).attr('data-table')
            var id = $(this).val()

            //alert(id+' '+table)

            $.ajax({
                type: 'POST',
                url: "",
                data: {'col': table, 'id': id, 'loadSujet': ''},
                //contentType: "application/json",
                dataType: 'json',
                success: function (data) {
                    //alert(data)
                    if (data != 0) {
                        $('#forumload').html('<div class="col-md-12" id="contentLoad"><center><img src="<?= base_url() ?>assets/img/loading.gif" style="width:10%; margin-top:-15%;"/></center></div>')
                        for (i in data) {
                            $('#forumload').append('<div class="col-md-6" style="margin-bottom:15px; position:relative"><div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">'
                                    + '<div class="mdc-card card--with-avatar"><section class="mdc-card__primary"><div class="card__avatar"><img src="" alt=""></div><h1 class="mdc-card__title" title="' + data[i].libeller + '"><a href="">' + data[i].libeller.substring(0, 25) + '..</a><hr></h1>'
                                    + '<h2 class="mdc-card__subtitle felemtload" data-fid="' + data[i].Mat_id + '" data-ele="matieres"></h2></section>'
                                    + '<h2 class="mdc-card__subtitle felemtload" data-fid="' + data[i].Fil_id + '" data-ele="filieres"></h2></section>'
                                    + '<h2 class="mdc-card__subtitle felemtload" data-fid="' + data[i].Niv_id + '" data-ele="niveau"></h2></section>'
                                    + '<section class="mdc-card__supporting-text pt-1"><p class="mb-2">' + data[i].details.substring(0, 100) + ' ...</p></section><section class="mdc-card__social-footer bg-blue"><div class="col"><small>REPONSES</small></div>'
                                    + '<div class="col"><small><span class="badge badge-primary badge-pill">10</span></small></div>'
                                    + '<div class="col"><a href="<?= base_url() ?><?= $_SESSION['abbr_lang'] ?? 'fr' ?>/dashboard/forum/' + data[i].id + '/d" class="btn btn-primary btn-sm" style="margin-top:-15px; margin-bottom:-15px;"><i class="mdi mdi-eye"></i></a></div></section></div></div></div>');

                            ll()
                        }
                    } else {
                        $('#forumload').html('Aucune donnee trouve')
                    }
                }
            })
        });

        function ll() {
            $('.felemtload').attr('', function () {
                var $this = $(this)
                var id = $(this).attr('data-fid')
                var ele = $(this).attr('data-ele')
                $.ajax({
                    type: 'POST',
                    url: "",
                    data: {'id': id, 'table': ele, 'libeller': 'libeller', 'getOneDataForum': ''},
                    //contentType: "application/json",
                    dataType: 'json',
                    success: function (data) {
                        //alert(data)
                        if (data != 0) {
                            $this.html(data)
                            $('#contentLoad').hide()
                        } else {

                        }
                    }
                })
            });
        }

<?php
if (isset($d) or isset($g)) {
    if (isset($g)) {
        $d = $g;
        $_POST['retrive'] = "groupe";
    } else {
        $d = $d;
        $_POST['retrive'] = "";
    }
    ?>
            function retriveMess() {
                $('#retriveMess').attr('id', function () {
                    var $this = $(this)

    <?php
    if (!isset($g)) {
        ?>vumess(<?= $d ?>)<?php
    }
    ?>

                            $.ajax({
                                type: 'POST',
                                url: " ",
                                data: {'useid2':<?= $d ?>, 'useid':<?= $_SESSION["ens_userid"] ?>, 'retriveMess': '<?= $_POST["retrive"] ?>'},
                                //contentType: "application/json",
                                dataType: 'json',
                                success: function (data) {
                                    //alert(data)
                                    if (data != 0) {
                                        $this.html('');
                                        var vu = "none"
                                        var color = ""
                                        var card = ""
                                        var status = ""
                                        for (i in data) {
                                            if (<?= $_SESSION['ens_userid'] ?> == data[i].Use_id) {
                                                color = "#f5f5f5"
                                                card = "#fff"
                                                status = "etat"
                                                if (data[i].status == 1 || <?= $_SESSION['ens_userid'] ?> == data[i].Use_id2) {
                                                    vu = ""
                                                } else {
                                                    vu = "none"
                                                }
                                            } else {
                                                color = "#fff"
                                                card = "#fff"
                                                vu = "none"
                                                status = "etat2"
                                            }

                                            $this.append('<div class="col-md-12" style="background:' + color + '"><section class="mdc-card__primary objetMess"><div class="card__avatar"><img src="<?= base_url() ?>assets/profile/' + data[i].photo + '" alt="VIRTEK"></div>'
                                                    + '<h1 class="mdc-card__title">' + data[i].nom + '&nbsp;' + data[i].prenom + '</h1><h2 class="mdc-card__subtitle">@' + data[i].role + ' | ' + data[i].email + '<span style="float:right">' + data[i].dates + '</span></h2>'
                                                    + '<span class="social__icon-badge mdc-twitter mdi mdi-eye status-' + data[i].prenom + '" style="margin-right:15px; display: ' + vu + '"></span>'
                                                    + '<span class="social__icon-badge mdc-twitter mdi mdi-close deleteMess" data-id="' + data[i].id + '" data-status="' + status + '" style="margin-right:45px; cursor:pointer; color:red"></span></section>'
                                                    + '<section class="mdc-card__supporting-text pt-1">'
                                                    + '<p class="mb-2" style="padding:5px; background:' + card + '; margin-top:-9px; width:85%; margin-left:20%">' + data[i].texte + '</p></section></div><div id="basbas"></div>');
                                        }

                                        $('#clickbas').click()

                                    } else {
                                        $this.html('<section class="mdc-card__supporting-text"><div class="alert alert-primary">Aucun message disponible</div><br>'
                                                + '<h2 class="mdc-theme--secondary mdc-typography--subheading1">Comment sa marche ?</h2><p class="mdc-typography--body1">'
                                                + 'Demarrez une discussion avec lun de vos camarade en choisissant un utilisateur vis le menu de gauche.'
                                                + '<br>Vous pouvez decider de creer un groupe de discussion et y integrer plusieurs de vos camarades pour avoir une discussion en groupe. Vous avez le choix'
                                                + 'et la possibilite de creer un groupe caractere privee ou publique selon le mode daudience que vous desirez pour le votre.<br>Vous pouvez decider de creer un groupe relatif a votre niveau detude. Ce groupe ne sera visible que par le utilisateurs ayant le meme niveau detude que vous.</p>'
                                                + '<a href="#" class="btn btn-primary" data-target="#addGroup" data-toggle="modal">Creer un groupe</a></section>');
                                    }
                                }
                            })
                        });
                    }
                    retriveMess()
    <?php
}

if ($title == "forum" || $title == "actualites") {
    if (isset($d)) {
        ?>
                        function countComment(id, objet) {
                            $.ajax({
                                type: 'POST',
                                url: "",
                                data: {'id': id, 'objet': objet, 'countForumComment': ''},
                                success: function (data) {
                                    $('#countForumComment').html(data)
                                }
                            })
                        }

                        function forumComments() {
                            $('#forumComments').attr('', function () {
                                var $this = $(this)

                                var id = $this.attr('data-id')
                                var objet = $this.attr('data-objet')

                                $.ajax({
                                    type: 'POST',
                                    url: " ",
                                    data: {'id': id, 'objet': objet, 'forumComments': ''},
                                    //contentType: "application/json",
                                    dataType: 'json',
                                    success: function (data) {
                                        //alert(data)
                                        if (data != 0) {
                                            $this.html('');

                                            var action = ""
                                            for (i in data) {
                                                if (<?= $_SESSION['ens_userid'] ?> == data[i].Use_id) {
                                                    action = "block"
                                                } else {
                                                    action = ""
                                                }

                                                $this.append('<div class="col-md-12" style=""><section class="mdc-card__primary"><div class="card__avatar"><img src="<?= base_url() ?>assets/profile/' + data[i].photo + '" alt="VIRTEK"></div>'
                                                        + '<h1 class="mdc-card__title">' + data[i].nom + '&nbsp;' + data[i].prenom + '</h1><h2 class="mdc-card__subtitle">@' + data[i].role + ' | ' + data[i].email + '<span style="float:right">' + data[i].dates + '</span></h2>'
                                                        + '</section>'
                                                        + '<section class="mdc-card__supporting-text pt-1">'
                                                        + '<p class="mb-2" style="padding:5px; background:#f5f5f5; margin-top:4px; width:85%; float:right">' + data[i].libeller
                                                        + '<a class="fAction" style="float:right; display:' + action + ';"><i class="material-icons" style="font-size:1.2em; color:red">delete</i></a>&nbsp;&nbsp;'
                                                        + '<a class="fAction" style="float:right; display:' + action + ';"><i class="material-icons" style="font-size:1.2em; color:green">edit</i></a>&nbsp;&nbsp;</p></section></div><div id="basbas"></div>');
                                            }

                                            $('#clickbas').click()

                                        } else {
                                            $this.html('<section class="mdc-card__supporting-text"><div class="alert alert-primary">Aucun Commentaire disponible</div></section>');
                                        }
                                    }
                                });

                                countComment(id, objet)
                            });
                        }
                        forumComments()
        <?php
    }
}
?>

                $('.table').DataTable({
//                                dom: 'Bfrtip',
//                                buttons: [
//                                    'copy', 'csv', 'excel', 'pdf', 'print'
//                                ],

                    "responsive": false,
                    "bPaginate": true,
                    //"sPaginationType": "full_numbers",
                    "bLengthChange": false,
                    "bSort": true,
                    "bFilter": true,
                    "bInfo": false,
                    "bRetrieve": true,
                    "bAutoWidth": true,
                    "iDisplayLength": 20,
                    "bUrl": "",
                    "oLanguage": {
                        "sDecimal": "",
                        "sEmptyTable": "Aucune donnée disponible dans la Base de donnée",
                        "sInfo": " De: _START_ à:  _END_ Sur: _TOTAL_ Données",
                        "sInfoEmpty": "<?= t("resultat") ?>: 0",
                        "sInfoFiltered": "(<?= t("recherche_sur_un_total") ?> de _MAX_ <?= t("donnees") ?>)",
                        "sInfoPostFix": "",
                        "sThousands": ",",
                        "sLengthMenu": "Afficher _MENU_ Données",
                        "sLoadingRecords": "En cours de chargement...",
                        "sProcessing": "Processing...",
                        "sSearch": "<?= t("recherche_globale") ?>: &nbsp;",
                        "sZeroRecords": "<?= t("Aucune_donnée_trouvé") ?>",
                        "oPaginate": {
                            "sFirst": "Debut",
                            "sLast": "Fin",
                            "sNext": "Suiv",
                            "sPrevious": "Prec"
                        },
                        "Aria": {
                            "sortAscending": ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        }
                    },

                    "bStateSave": true,
                });
            })
</script>

<script>
    $(document).ready(function () {
        
        if($(document).width() < 800){
            $('.zone-menu').removeClass('mdc-persistent-drawer--open')
            $('.content-wrapper').addClass('drawer-minimized')
            $('.mdc-toolbar__menu-icon').on('click', function(){
                $('.content-wrapper').addClass('drawer-minimized')
            });  
        } 

        $('#support').change(function (e) {
            e.preventDefault();
            var $this = $(this);
            var ext = ['pdf', 'PDF', 'jpg', 'gif', 'bmp', 'png'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), ext) === -1) {
                alert('Erreur: Format non Valide image ou PDF requis');
                $this.val("");
            } else {
            }
        });

        $(".choose_image").click(function (e) {
            $("#images").click();
            e.preventDefault();
        });

        $('#images').change(function (e) {
            e.preventDefault();
            var $this = $(this);
            var ext = ['png', 'jpeg', 'jpg', 'gif', 'bmp'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), ext) === -1) {
                alert('Erreur: Format non Valide image requise');
                $this.val("");
                $('.cropped_image').fadeOut();
                $('#imgprofile').fadeIn();
                $('#upload-image').hide();
                $('#upload-imageProfile').hide();
            } else {
                $('#imgprofile').hide();
                $('#upload-image').fadeIn();
                $('.cropped_image').fadeIn();
                $('#upload-imageProfile').fadeIn();
            }
        });
    });

    $(document).ready(function () {
        $image_crop2 = $('#upload-image').croppie({
            enableExif: true,
            viewport: {
                width: 400,
                height: 170,
                type: 'square'
            },
            boundary: {
                width: 400,
                height: 250
            },
            showZoomer: true,
            enableResize: true,
            enableOrientation: true
        });

        //$image_crop.croppie('bind');
        $image_crop2.croppie('setZoom', 1.0);

        $("#RotateAntiClockwise").on("click", function () {
            $image_crop2.croppie('rotate', -90);
        });
        $("#RotateClockwise").on("click", function () {
            $image_crop2.croppie('rotate', 90);
        });

        $('#images').on('change', function () {
            var reader = new FileReader();
            reader.onload = function (e) {
                $image_crop2.croppie('bind', {
                    url: e.target.result,
                    orientation: 4
                }).then(function () {
                    console.log('jQuery bind complete');
                });

                $image_crop2.result('blob').then(function (blob) {
                    // do something with cropped blob
                });
            };
            reader.readAsDataURL(this.files[0]);
        });

        $('.cropped_imageDoc').on('click', function (ev) {
            var texte = $("#textedoc").val()
            var details = $("#detailsdoc").val()
            var typ = $("#typdoc").val()

            $image_crop2.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (response) {
                $.ajax({
                    url: "",
                    type: "POST",
                    data: {"imageP": response, "details": details, "texte": texte, "Typ_doc": typ, "adddoc": ""},
                    success: function (data) {
                        alert(data);
                        window.location.reload();
                    }
                });
            });
        });

        $('.cropped_imageRub').on('click', function (ev) {
            var texte = $("#libellerrub").val()
            var details = $("#detailsrub").val()

            $image_crop2.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (response) {
                $.ajax({
                    url: "",
                    type: "POST",
                    data: {"imageP": response, "details": details, "libeller": texte, "addRubr": ""},
                    success: function (data) {
                        alert(data);
                        window.location.reload();
                    }
                });
            });
        });
    });

    $(document).ready(function () {
        $image_crop = $('#upload-imageProfile').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'square'
            },
            boundary: {
                width: 250,
                height: 250
            },
            showZoomer: true,
            enableResize: true,
            enableOrientation: true
        });

        //$image_crop.croppie('bind');
        $image_crop.croppie('setZoom', 1.0);

        $("#RotateAntiClockwise").on("click", function () {
            $image_crop.croppie('rotate', -90);
        });
        $("#RotateClockwise").on("click", function () {
            $image_crop.croppie('rotate', 90);
        });

        $('#images').on('change', function () {
            var reader = new FileReader();
            reader.onload = function (e) {
                $image_crop.croppie('bind', {
                    url: e.target.result,
                    orientation: 4
                }).then(function () {
                    console.log('jQuery bind complete');
                });

                $image_crop.result('blob').then(function (blob) {
                    // do something with cropped blob
                });
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('.cropped_imageUsers').on('click', function (ev) {
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (response) {
                $.ajax({
                    url: "",
                    type: "POST",
                    data: {"imageP": response, "addProfile": ""},
                    success: function (data) {
                        alert(data);
                        window.location.reload();
                    }
                });
            });
        });

        $('.cropped_imageGroup').on('click', function (ev) {
            var libeller = $("#libgroup").val();
            var theme = $("#temgroup").val();
            var niveau = $("#nivgroup").val();
            var filiere = $("#filgroup").val();
            var etat = $(".etatgroup:checked").val();

            if (niveau == null || niveau == "") {
                niveau = 0
            }

            if (filiere == null || niveau == "") {
                filiere = 0
            }

            //alert(etat+filiere+niveau+theme)

            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (response) {
                $.ajax({
                    url: "",
                    type: "POST",
                    data: {"imageP": response, "theme": theme, "libeller": libeller, "Niv_id": niveau, "Fil_id": filiere, "etat": etat, "addGroupe": ""},
                    success: function (data) {
                        alert(data);
                        window.location.reload();
                    }
                });
            });
        });

        $('.edit-elemt').on('click', function () {
            var id = $(this).attr('id');
            var table = $(this).attr('data-edit');
            $('.data-edit').attr('', function () {
                var $this = $(this);
                var elem = $this.attr("data-elmt");
                //alert(elem);
                $.ajax({
                    url: "",
                    type: "POST",
                    data: {"id": id, "table": table, "elem":elem, "getAlloneDataById": ""},
                    success: function (data) {
                        $this.val(data);
                    }
                });
            });
        });
    });
</script>

<script>
    if (window.Notification && Notification.permission !== "denied")
    {
        Notification.requestPermission(function (status) {  // status is "granted", if accepted by user
            var n = new Notification('VIRTEK', {
                body: 'Bonjour ! Bienvenue sur VIRTEK <?= $CI->users->getOneData($_SESSION['ens_userid'], 'nom'); ?>',
                icon: '<?= base_url() ?>assets/img/core-img/favicon.ico' // optional
            });
        });
    }

    function AlertNotif(val)
    {
        if (window.Notification && Notification.permission !== "denied") {
            Notification.requestPermission(function (status) {  // status is "granted", if accepted by user
                var n = new Notification('VIRTEK', {
                    body: val,
                    icon: '<?= base_url() ?>assets/img/core-img/favicon.ico' // optional
                });
            });
        }
    }
    /*
     interface Notification : EventTarget {  
     // display methods  
     void show();  
     void cancel();  
     // event handler attributes  
     attribute Function ondisplay;  
     attribute Function onerror;  
     attribute Function onclose;  
     attribute Function onclick; 
     }
     
     interface NotificationCenter {  // Notification factory methods.  
     Notification createNotification(in DOMString iconUrl, in DOMString title, in DOMString body) throw optional Notification createHTMLNotification(in DOMString url) throws(Exception);  // Permission values  
     const unsigned int PERMISSION_ALLOWED = 0;  
     const unsigned int PERMISSION_NOT_ALLOWED = 1;  
     const unsigned int PERMISSION_DENIED = 2;  // Permission methods  
     int checkPermission();  
     void requestPermission(in Function callback); 
     } 
     interface Window { 
     ...  attribute NotificationCenter webkitNotifications; ... 
     }
     
     function browser_support_notification(){
     return window.webkitNotificattions;
     }
     browser_support_notification()
     
     function request_permission(){
     if(window.webkitNotifications.checkPermission()==0){
     window.webkitNotifications.createNotification();
     }else{
     window.webkitNotifications.requestPermission();
     }
     }
     request_permission()
     
     function plain_texte_notification(image, title, content){
     if(window.webkitNotifications.checkPermission() == 0){
     return window.webkitNotifications.createNotification(image, title, content); 
     }
     }
     plain_texte_notification()*/
</script>
</body>

<style>
    .crop_preview {
        background: #e1e1e1;
        width: 100%;
        padding: 30px;
        max-height: 500px;
        margin-top: 30px
    }

    .cropped_image {
        display: none;
    }

    #upload-image, #upload-imageProfile {
        display: none;
    }
</style>

<style>
    .form-inline {
        display: -ms-flexbox;
        display: block;
        -ms-flex-flow: row wrap;
        flex-flow: row wrap;
    }

    .paginate_button{
        background:#f5f5f5;
        cursor:pointer;
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 0px solid transparent;
        padding: .5rem .75rem;
        font-size: 1rem;
        line-height: 1.25;
        border-radius: .25rem;
        transition: all .15s ease-in-out;
        margin:5px;
    }
</style>

</html>