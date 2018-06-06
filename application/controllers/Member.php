<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['abbr_lang'] = "fr";

if (!isset($_SESSION['ens_user'])) {
    $lang = $_SESSION['abbr_lang'] ?? "en";
    $url = "http://localhost/enstps/";
    $url1 = "https://ensjobs.cm/";
    header("Location:" . $url . $lang);
    die();
}

class Member extends CI_Controller {

    public function view($page = "acceuil") {
        if (!file_exists(APPPATH . '/views/member/' . $page . 'php')) {

            if ($page == "acceuil") {
                $titre = "dashboard";
            } else {
                $titre = $page;
            }


            $data['title'] = $titre;

            $this->load->model('matieres');
            $this->load->model('cours');
            $this->load->model('users');
            $this->load->model('typecours');
            $this->load->model('typeuser');
            $this->load->model('exos');
            $this->load->model('typeexos');
            $this->load->model('tutos');
            $this->load->model('niveau');
            $this->load->model('filieres');
            $this->load->model('messages');
            $this->load->model('documents');
            $this->load->model('typedoc');
            $this->load->model('filtre');
            $this->load->model('forum');
            $this->load->model('actualites');
            $this->load->model('rubriques');
            $this->load->model('comments');
            $this->load->model('groupes');
            $this->load->model('joins');
            $this->load->model('parties');
            $this->load->model('mouchar');

            $this->load->library('email');
            $this->load->library('user_agent');
            $this->load->library('pagination');
            //$this->load->model('Langue');

            $data['refer'] = $this->agent->referrer();

            $param1 = $this->uri->segment(4);
            $param2 = $this->uri->segment(5);

            if (isset($param2)) {
                $data[$param2] = $param1;

                if ($param2 == "delete") {
                    if ($this->$titre->delete_entry($param1)) {
                        $data['supprimer'] = $titre . " supprimer avec succes";
                    }
                } else if ($param2 == "power-off") {
                    if ($this->$titre->poweroff_entry($param1)) {
                        $data['power'] = $titre . " desactiver avec succes";
                    }
                } else if ($param2 == "power-on") {
                    if ($this->$titre->poweron_entry($param1)) {
                        $data['power'] = $titre . " activer avec succes";
                    }
                } else if (explode("-", $param2)[0] == "define") {
                    if ($this->post_offre->setPC($param1, explode("-", $param2)[1])) {
                        $data['define'] = "Postulant associé avec succes à l'offre";
                    }
                    $data['details'] = explode("-", $param2)[1];
                }
            } else {
                $data["details"] = $param1;
            }

            if ($this->uri->segment(3) == "bascule") {
                if ($this->users->getOneData($_SESSION['ens_userid'], 'role') == "Postulant") {
                    $role = "Entreprise";
                } else {
                    $role = "Postulant";
                }
                $this->users->basculeRole($_SESSION['ens_userid'], $role);
                header("Location:" . base_url() . $this->uri->segment(1) . "/dashboard");
            }

            if ($this->users->getOneData($_SESSION["ens_userid"], "status") != 0) {
                header("Location:" . base_url() . $this->uri->segment(1) . "/dashboard/deconnexion");
            }


            $data['roleUser'] = $this->users->getOneData($_SESSION['ens_userid'], 'role');

            $this->getFil();
            $this->getMat();
            $this->addSujets();
            $this->loadSujet();
            $this->getOneDataForum();
            $this->addCommActu();
            $this->addGroupe();
            $this->addUsers();
            $this->joinsGroupe();
            $this->forumComments();
            $this->countForumComment();
            $this->addSupportCours();
            $this->getOneDatabyCours();
            $this->addMatiere();
            $this->addFiliere();
            $this->addNiveau();
            $this->addExercice();
            $this->addRubr();
            $this->addActu();
            $this->addCours();

            if (isset($_POST['retriveMess'])) {
                $this->retriveMess();
                die();
            }

            $this->addMess();
            $this->vuMess();
            $this->adddoc();
            $this->getAllDataById();

            //$this->changeProfile();

            if (isset($_POST['sendsms'])) {
                $this->sendSMS();
            }


            $this->lang->load('form', $this->config->item('language'));
            $this->load->view('member/templates/header', $data);
            $this->load->view('member/' . $page);
            $this->load->view('member/templates/footer');

            $this->Mouchard($titre);
        } else {
            show_404();
        }
    }

    public function Mouchard($t) {
        $page = $t;
        $details = $_POST['M-Details'];
        $this->mouchar->insertmouchar($t, $details);
    }

//////////////////////////////// inscription ........................///////////////////////////

    public function Inscription() {
        if (isset($_POST['saveUserss'])) {
            $code = substr(sha1($_POST['email'] . time() . "ensJobs"), 0, 20);
            if ($this->users->checkIfExist2($code) != false) {
                $lang = $_SESSION['abbr_lang'] ?? "en";
                $message = "Bienvenue sur ensJobs cher utilisateur " . $_POST['login'] . " veuillez activer votre compte en validant le lien &lt;a href='" . base_url() . $lang . "/connexion/" . $code . "/activate'&gt;Activer mon compte&lt/a&gt;";
                //$this->users->sendMail("service@ensjobs.cm", $_POST['email'], "Confirmation du Compte", $message, "ensJobs", "ensJobs");

                $_POST['phone'] = $_POST['tel'];
                $_POST['Details'] = "Bienvenue sur ensJobs " . $_POST['login'];
                //$this->sendSMS();

                echo "0";
            } else {
                echo "Echec: soit Email ou login existant; soit veuillez reessayer plutard";
            }
            die();
        }
    }

    //////////////////////////////////////// add support cours form ////////////////////////////////////////

    public function addSupportCours() {
        if (isset($_POST['addSupportCours'])) {

            $numer = str_replace(" ", "_", $this->cours->getOneData($_POST['Cou_id'], "libeller") . $_POST['libeller']);

            $_FILES['icone']['name']; //Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.png).
            $_FILES['icone']['type']; //Le type du fichier. Par exemple, cela peut �tre � image.png �.
            $_FILES['icone']['size']; //La taille du fichier en octets.
            $_FILES['icone']['tmp_name']; //L'adresse vers le fichier upload� dans le r�pertoire temporaire.
            $_FILES['icone']['error'];

            $maxsize = 51000000;

            if ($_FILES['icone']['error'] > 0) {
                $erreur = "Erreur lors du transfert Veuillez re�ssayer ult�rieurement";

                echo '<center><div style="background-color: orange; padding:25px; color:#fff; position:fixed;">' . $erreur . '<br><hr style="border:1px dotted steelblue;"><br/></div></center>';
                die();
            } elseif ($_FILES['icone']['size'] > $maxsize) {
                echo '<center><div style="background-color: orange; padding:25px; color:#fff; position:fixed;"><b>Erreur</b> fichier trop volumineux veuillez choisir un pdf de 4MB max <br><hr style="border:1px dotted steelblue;"><br/></div></center>';
                die();
            }

            $extensions_valides = array('pdf', 'PDF');
            $extension_upload = strtolower(substr(strrchr($_FILES['icone']['name'], '.'), 1));

            if (in_array($extension_upload, $extensions_valides)) {
                
            } else {
                echo '<center><div style="background-color: orange; padding:25px; color:#fff; position:fixed;"><b>Erreur</b> fichier incorrect veuillez choisir un fichier au format valide : .pdf <br><hr style="border:1px dotted steelblue;"><br/></div></center>';
                die();
            }

            $nom = md5(uniqid(rand(), true));

            $nom = "assets/cours/" . $numer . ".{$extension_upload}";
            $resultat = move_uploaded_file($_FILES['icone']['tmp_name'], $nom);

            $file = $numer . '.' . $extension_upload;

            if (!$resultat) {
                $erreur = "Une erreur est survenue lors du transfert veuillez re�ssayer ult�rieurement";
                echo '<center><div style="background-color: orange; padding:25px; color:#fff; position:fixed;">' . $erreur . '<br><hr style="border:1px dotted steelblue;"><br/></div></center>';
                die();
            }

            if ($this->parties->insertparties($file) == true) {
                echo 0;
                die();
            } else {
                echo 'Echec d\'enregistrement veuillez reesayer';
                die();
            }
        }
    }

    /////////////////////////////////////////////////////// add exercices form //////////////////////////////////////

    public function addExercice() {
        if (isset($_POST['addExercice'])) {

            $numer = str_replace(" ", "_", $_POST['libeller']);

            $_FILES['icone']['name']; //Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.png).
            $_FILES['icone']['type']; //Le type du fichier. Par exemple, cela peut �tre � image.png �.
            $_FILES['icone']['size']; //La taille du fichier en octets.
            $_FILES['icone']['tmp_name']; //L'adresse vers le fichier upload� dans le r�pertoire temporaire.
            $_FILES['icone']['error'];

            $maxsize = 51000000;

            if ($_FILES['icone']['error'] > 0) {
                $erreur = "Erreur lors du transfert Veuillez re�ssayer ult�rieurement";

                echo '<center><div style="background-color: orange; padding:25px; color:#fff; position:fixed;">' . $erreur . '<br><hr style="border:1px dotted steelblue;"><br/></div></center>';
                die();
            } elseif ($_FILES['icone']['size'] > $maxsize) {
                echo '<center><div style="background-color: orange; padding:25px; color:#fff; position:fixed;"><b>Erreur</b> fichier trop volumineux veuillez choisir un pdf de 4MB max <br><hr style="border:1px dotted steelblue;"><br/></div></center>';
                die();
            }

            $extensions_valides = array('pdf', 'PDF');
            $extension_upload = strtolower(substr(strrchr($_FILES['icone']['name'], '.'), 1));

            if (in_array($extension_upload, $extensions_valides)) {
                
            } else {
                echo '<center><div style="background-color: orange; padding:25px; color:#fff; position:fixed;"><b>Erreur</b> fichier incorrect veuillez choisir un fichier au format valide : .pdf <br><hr style="border:1px dotted steelblue;"><br/></div></center>';
                die();
            }

            $nom = md5(uniqid(rand(), true));

            $nom = "assets/exos/" . $numer . ".{$extension_upload}";
            $resultat = move_uploaded_file($_FILES['icone']['tmp_name'], $nom);

            $file = $numer . '.' . $extension_upload;

            if (!$resultat) {
                $erreur = "Une erreur est survenue lors du transfert veuillez re�ssayer ult�rieurement";
                echo '<center><div style="background-color: orange; padding:25px; color:#fff; position:fixed;">' . $erreur . '<br><hr style="border:1px dotted steelblue;"><br/></div></center>';
                die();
            }

            if ($this->exos->insertexos($file, $_SESSION['ens_userid']) == true) {
                echo 0;
                die();
            } else {
                echo 'Echec d\'enregistrement veuillez reesayer';
                die();
            }
        }
    }

    public function getFil() {
        if (isset($_POST['getFil'])) {
            $val = $this->filieres->getfilieresByElemt($_POST['Niv_id'], "Niv_id");
            if ($val != false) {
                header('Content-type: application/json');
                print_r(json_encode($val));
            } else {
                echo 0;
            }
            die();
        }
    }

    public function getMat() {
        if (isset($_POST['getMat'])) {
            $val = $this->matieres->getmatieresByElemt($_POST['Fil_id'], "Fil_id");
            if ($val != false) {
                header('Content-type: application/json');
                print_r(json_encode($val));
            } else {
                echo 0;
            }
            die();
        }
    }

    public function getAllDataById() {
        if (isset($_POST['getAlloneDataById'])) {
            $table = $_POST['table'];
            $val = $this->$table->getOneData($_POST['id'], $_POST['elem']);
            echo $val;
            die();
        }
    }

    public function loadSujet() {
        if (isset($_POST['loadSujet'])) {
            $val = $this->forum->getAllForumByCol($_POST['id'], $_POST['col']);
            if ($val != false) {
                header('Content-type: application/json');
                print_r(json_encode($val));
            } else {
                echo 0;
            }
            die();
        }
    }

    public function countForumComment() {
        if (isset($_POST['countForumComment'])) {
            $nbr = $this->comments->CountcommentsByCol($_POST['id'], $_POST['objet']);
            echo $nbr;
            die();
        }
    }

    public function forumComments() {
        if (isset($_POST['forumComments'])) {
            $val = $this->comments->getAllcommentsByCol($_POST['id'], $_POST['objet']);
            if ($val != false) {
                header('Content-type: application/json');
                print_r(json_encode($val));
            } else {
                echo 0;
            }
            die();
        }
    }

    public function getOneDataForum() {
        if (isset($_POST['getOneDataForum'])) {
            $table = $_POST['table'];
            $val = $this->$table->getOneData($_POST['id'], $_POST['libeller']);
            echo json_encode($val);
            die();
        }
    }

    public function addCommActu() {
        if (isset($_POST['addCommActu'])) {
            $val = $this->comments->insertcomments(0);
            if ($val != false) {
                echo 1;
            } else {
                echo 0;
            }
            die();
        }
    }

    public function addActu() {
        if (isset($_POST['addActu'])) {
            $val = $this->actualites->insertactualites(0);
            if ($val != false) {
                echo 1;
            } else {
                echo 0;
            }
            die();
        }
    }

    public function addCours(){
        if (isset($_POST['addCours'])) {
            $val = $this->cours->insertcours(0, $_SESSION['ens_userid']);
            if ($val != false) {
                echo 1;
            } else {
                echo 0;
            }
            die();
        }
    }

    public function addMatiere() {
        if (isset($_POST['addMatiere'])) {
            $val = $this->matieres->insertmatieres(0);
            if ($val != false) {
                echo 1;
            } else {
                echo 0;
            }
            die();
        }
    }

    public function addFiliere() {
        if (isset($_POST['addFiliere'])) {
            $val = $this->filieres->insertfilieres(0);
            if ($val != false) {
                echo 1;
            } else {
                echo 0;
            }
            die();
        }
    }

    public function addNiveau() {
        if (isset($_POST['addNiveau'])) {
            $val = $this->niveau->insertniveau(0);
            if ($val != false) {
                echo 1;
            } else {
                echo 0;
            }
            die();
        }
    }

    public function joinsGroupe() {
        if (isset($_POST['joinsGroupe'])) {
            $code = $this->groupes->getOneData($_POST['id'], 'etat');
            $val = $this->joins->insertjoins($code);
            if ($val != false) {
                echo 1;
            } else {
                echo 0;
            }
            die();
        }
    }

    public function retriveMess() {
        if (isset($_POST['retriveMess'])) {
            if ($_POST['retriveMess'] == 'groupe') {
                $val = $this->messages->getmessagesByGroupID($_POST['useid'], $_POST['useid2']);
                if ($val != false) {
                    header('Content-type: application/json');
                    print_r(json_encode($val));
                    die();
                } else {
                    echo 0;
                }
                die();
            } else {
                $val = $this->messages->getmessagesByID($_POST['useid'], $_POST['useid2']);
                if ($val != false) {
                    header('Content-type: application/json');
                    print_r(json_encode($val));
                    die();
                } else {
                    echo 0;
                }
                die();
            }
        }
    }

    public function addMess() {
        if (isset($_POST['addMess'])) {
            $val = $this->messages->insertmessages(0);
            if ($val != false) {
                echo 1;
            } else {
                echo 0;
            }
            die();
        }
    }

    public function addSujets() {
        if (isset($_POST['addSujets'])) {
            $val = $this->forum->insertforum(0);
            if ($val != false) {
                echo 1;
            } else {
                echo 0;
            }
            die();
        }
    }

    public function addUsers() {
        if (isset($_POST['addUsers'])) {
            $role = $this->typeuser->getOneData($_POST['Typ_id'], 'libeller');
            $val = $this->users->insertusers(0, $role);
            if ($val != false) {
                echo 1;
            } else {
                echo 0;
            }
            die();
        }
    }

    public function vuMess() {
        if (isset($_POST['vuMess'])) {
            $val = $this->messages->updateMessVu($_POST['Use_id2'], $_SESSION['ens_userid']);
            if ($val != false) {
                echo 1;
            } else {
                echo 0;
            }
            die();
        }
    }

    public function getOneDatabyCours() {
        if (isset($_POST['getOneDatabyCours'])) {
            $val = $this->parties->getOneData($_POST['id'], 'details');
            if ($val != false) {
                echo $val;
            } else {
                echo 0;
            }
            die();
        }
    }

    public function adddoc() {
        if (isset($_POST['adddoc'])) {
            if (isset($_POST['imageP'])) {
                $croped_image = $_POST['imageP'];
                list($type, $croped_image) = explode(';', $croped_image);
                list(, $croped_image) = explode(',', $croped_image);
                $croped_image = base64_decode($croped_image);
                $name = time() . "png";
                $image_name = base_url() . 'assets/img/documents/' . $name;
                // upload cropped image to server
                //$id = $_SESSION['agz_userid'];

                if ($this->documents->insertdocuments($image_name, 0) == true) {
                    //$resultat = move_uploaded_file($_FILES['imageP']['tmp_name'], "../../images/gallery/proprioLogo/" . $image_name);
                    file_put_contents('assets/img/documents/' . $name, $croped_image);
                    echo 'Operation effectue avec succes';
                    die();
                } else {
                    echo 'echec lors de lajout du document';
                    die();
                }
            }
        }
    }

    public function addRubr() {
        if (isset($_POST['addRubr'])) {
            if (isset($_POST['imageP'])) {
                $croped_image = $_POST['imageP'];
                list($type, $croped_image) = explode(';', $croped_image);
                list(, $croped_image) = explode(',', $croped_image);
                $croped_image = base64_decode($croped_image);
                $name = time() . "png";

                $image_name = base_url() . 'assets/img/rubriques/' . $name;
                // upload cropped image to server
                //$id = $_SESSION['agz_userid'];

                if ($this->rubriques->insertrubriques($image_name, 0) == true) {
                    //$resultat = move_uploaded_file($_FILES['imageP']['tmp_name'], "../../images/gallery/proprioLogo/" . $image_name);
                    file_put_contents('assets/img/rubriques/' . $name, $croped_image);
                    echo 'Operation effectue avec succes';
                    die();
                } else {
                    echo 'echec lors de lajout de la rubrique';
                    die();
                }
            }
        }
    }

    public function addGroupe() {
        if (isset($_POST['addGroupe'])) {
            if (isset($_POST['imageP'])) {
                $croped_image = $_POST['imageP'];
                list($type, $croped_image) = explode(';', $croped_image);
                list(, $croped_image) = explode(',', $croped_image);
                $croped_image = base64_decode($croped_image);
                $name = time() . "png";
                $image_name = base_url() . 'assets/img/groupes/' . $name;
                // upload cropped image to server
                //$id = $_SESSION['agz_userid'];

                if ($this->groupes->insertgroupes($image_name, 0) == true) {
                    //$resultat = move_uploaded_file($_FILES['imageP']['tmp_name'], "../../images/gallery/proprioLogo/" . $image_name);
                    file_put_contents('assets/img/groupes/' . $name, $croped_image);
                    echo 'Operation effectue avec succes';
                    die();
                } else {
                    echo 'echec lors de lajout du document';
                    die();
                }

                die();
            }
        }
    }

    public function sendSMS() {
        require 'osms-php-master/src/Osms.php';

        //use Osms\Osms;

        $config = array(
            'clientId' => 'ythYdifKMRbkGJIst2uU2Zpt9IKooNQ3',
            'clientSecret' => 'bbxpxCGgjJ7gP5cR',
        );

        $osms = new Osms\Osms($config);
        // retrieve an access token
        $response = $osms->getTokenFromConsumerKey();

        if (!empty($response['access_token'])) {
            $senderAddress = 'tel:+237698924416';
            $receiverAddress = 'tel:+237' . $_POST['phone'];
            $message = $_POST['Details'];
            $senderName = 'ensJobs';

            $osms->sendSMS($senderAddress, $receiverAddress, $message, $senderName);

            echo 'Message Envoye avec Succes';
        } else {
            echo 'Echec denvoi du message reéssayer !';
        }
    }

}
