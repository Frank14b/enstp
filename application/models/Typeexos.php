<?php
defined('BASEPATH') or exit('No direct script access allowed');

class typeexos extends CI_Model
{
    public $id;
    public $libeller;
    public $status;
    public $photo;

    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        //$this->db->method_name();
    }

    public function getAlltypeexos()
    {
        $query = $this->db->get("typeexos");
        return $query->result();
    }

    public function countAlltypeexos()
    {
        $query = $this->db->get_where("typeexos", array("status" => 0));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("typeexos", array("emailtypeexos" => $_POST['email']));
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
        $query = $this->db->get_where("typeexos", array("emailtypeexos" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("typeexos", array("logintypeexos" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->inserttypeexos($code) == true) {
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
        $query = $this->db->get_where("typeexos", array("emailtypeexos" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("typeexos", array("logintypeexos" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->inserttypeexos2($code) == true) {
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
        $this->db->set('passtypeexos', $code);
        $this->db->where('emailtypeexos', $_POST["email"]);
        if ($this->db->update("typeexos")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("typeexos")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passtypeexos', sha1($_POST["pass2"]));
        $this->db->where('passtypeexos', $code);
        if ($this->db->update("typeexos")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function inserttypeexos($code)
    {
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passtypeexos = sha1($_POST['password']);
        $this->datetypeexos = date("Y-m-d");
        $this->logintypeexos = $_POST['login'];
        $this->nomtypeexos = $_POST['nom'];
        $this->prenomtypeexos = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numerotypeexos = $_POST['tel'];
        $this->emailtypeexos = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("typeexos", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function inserttypeexos2($code)
    {
        $this->db->select_max("id");
        $id = $this->db->get("typeexos");
    /////////////// ===================== /////////////////////////
        $this->id = $id;
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passtypeexos = sha1($_POST['password']);
        $this->datetypeexos = date("Y-m-d");
        $this->logintypeexos = $_POST['login'];
        $this->nomtypeexos = $_POST['nom'];
        $this->prenomtypeexos = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numerotypeexos = $_POST['tel'];
        $this->emailtypeexos = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("typeexos", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function edittypeexos($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('logintypeexos', $_POST['logintypeexos']);
        $this->db->set('nomtypeexos', $_POST['nomtypeexos']);
        $this->db->set('prenomtypeexos', $_POST['prenomtypeexos']);
        $this->db->set('numerotypeexos', $_POST['numerotypeexos']);
        $this->db->set('emailtypeexos', $_POST['emailtypeexos']);
        $this->db->set('bptypeexos', $_POST['bptypeexos']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("typeexos")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passtypeexos', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('typeexos');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('phototypeexos', $lien); // please read the below note
        //$this->db->set('datetypeexos', time());
        $this->db->where('id', $user);

        $this->db->update('typeexos');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('typeexos');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('typeexos');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('typeexos');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('typeexos');
        return true;
    }

    public function connecttypeexos()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("typeexos", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordtypeexos($typeexos)
    {
        $this->passtypeexos = sha1($_POST['password']);
        $query = $this->db->get_where("typeexos", array('id' => $typeexos, 'passtypeexos' => $this->passtypeexos));
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

    public function gettypeexosByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("typeexos", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->gettypeexosByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAlltypeexosLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("typeexos", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAlltypeexosByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("typeexos", array('status!=' => $id));
        return $query->result();
    }

    public function gettypeexosByEmail($id)
    {
        $this->emailtypeexos = $id;

        $query = $this->db->get_where("typeexos", array('emailtypeexos' => $this->emailtypeexos));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->gettypeexosByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
