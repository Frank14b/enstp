<?php
defined('BASEPATH') or exit('No direct script access allowed');

class rubriques extends CI_Model
{
    public $id;
    public $libeller;
    public $details;
    public $status;
    public $photo;

    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        //$this->db->method_name();
    }

    public function getAllrubriques()
    {
        $query = $this->db->get("rubriques");
        return $query->result();
    }

    public function countAllrubriques()
    {
        $query = $this->db->get_where("rubriques", array("status" => 0));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("rubriques", array("emailrubriques" => $_POST['email']));
        if ($query->num_rows() == 1) 
        {
            if ($this->restorPassword($code) == true) {
                return true;
            }

        } else {
            return false;
        }
    }

    public function checkIfExist($code)
    { // please read the below note
        $query = $this->db->get_where("rubriques", array("emailrubriques" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("rubriques", array("loginrubriques" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertrubriques($code) == true) {
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function checkIfExist2($code)
    { // please read the below note
        $query = $this->db->get_where("rubriques", array("emailrubriques" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("rubriques", array("loginrubriques" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertrubriques2($code) == true) {
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function restorPassword($code)
    {
        $this->db->set('status', $code);
        $this->db->set('passrubriques', $code);
        $this->db->where('emailrubriques', $_POST["email"]);
        if ($this->db->update("rubriques")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("rubriques")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passrubriques', sha1($_POST["pass2"]));
        $this->db->where('passrubriques', $code);
        if ($this->db->update("rubriques")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function insertrubriques($file, $code)
    {
        $this->libeller = $_POST['libeller'];
        $this->details = $_POST['details'];
        $this->photo = $file;
        $this->status = $code;

        if ($this->db->insert("rubriques", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertrubriques2($code)
    {
        $this->db->select_max("id");
        $id = $this->db->get("rubriques");
    /////////////// ===================== /////////////////////////
        $this->id = $id;
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passrubriques = sha1($_POST['password']);
        $this->daterubriques = date("Y-m-d");
        $this->loginrubriques = $_POST['login'];
        $this->nomrubriques = $_POST['nom'];
        $this->prenomrubriques = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numerorubriques = $_POST['tel'];
        $this->emailrubriques = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("rubriques", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function editrubriques($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('loginrubriques', $_POST['loginrubriques']);
        $this->db->set('nomrubriques', $_POST['nomrubriques']);
        $this->db->set('prenomrubriques', $_POST['prenomrubriques']);
        $this->db->set('numerorubriques', $_POST['numerorubriques']);
        $this->db->set('emailrubriques', $_POST['emailrubriques']);
        $this->db->set('bprubriques', $_POST['bprubriques']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("rubriques")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passrubriques', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('rubriques');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('photorubriques', $lien); // please read the below note
        //$this->db->set('daterubriques', time());
        $this->db->where('id', $user);

        $this->db->update('rubriques');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('rubriques');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('rubriques');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('rubriques');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('rubriques');
        return true;
    }

    public function connectrubriques()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("rubriques", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordrubriques($rubriques)
    {
        $this->passrubriques = sha1($_POST['password']);
        $query = $this->db->get_where("rubriques", array('id' => $rubriques, 'passrubriques' => $this->passrubriques));
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function sendMail($from, $to, $subject, $mess, $to1, $to2)
    {
        $this->email->from($from, "AGZJobs");
        $this->email->to($to);
        $this->email->cc($to1);
        $this->email->bcc($to2);

        $this->email->subject($subject);
        $this->email->message($mess);

        $this->email->send();
    }

    public function startSession($id, $user)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['ens_user'] = $user;
        $_SESSION['ens_userid'] = $id;
    }

    public function getrubriquesByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("rubriques", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->getrubriquesByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAllrubriquesLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("rubriques", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAllrubriquesByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("rubriques", array('status!=' => $id));
        return $query->result();
    }

    public function getrubriquesByEmail($id)
    {
        $this->emailrubriques = $id;

        $query = $this->db->get_where("rubriques", array('emailrubriques' => $this->emailrubriques));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->getrubriquesByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
