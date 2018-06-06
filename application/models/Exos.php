<?php
defined('BASEPATH') or exit('No direct script access allowed');

class exos extends CI_Model
{
    public $id;
    public $Mat_id;
    public $Typ_id;
    public $libeller;
    public $details;
    public $status;
    public $dates;
    public $Use_id;

    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        //$this->db->method_name();
    }

    public function getAllexos()
    {
        $this->db->where("status != 3");
        $query = $this->db->get("exos");
        return $query->result();
    }

    public function getAllexosPaginate($min, $max)
    {
        $this->db->where("status = 0");
        $query = $this->db->get("exos", $max, $min);
        return $query->result();
    }

    public function countAllexos()
    {
        $query = $this->db->get_where("exos", array("status" => 0));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("exos", array("emailexos" => $_POST['email']));
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
        $query = $this->db->get_where("exos", array("emailexos" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("exos", array("loginexos" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertexos($code) == true) {
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
        $query = $this->db->get_where("exos", array("emailexos" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("exos", array("loginexos" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertexos2($code) == true) {
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
        $this->db->set('passexos', $code);
        $this->db->where('emailexos', $_POST["email"]);
        if ($this->db->update("exos")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("exos")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passexos', sha1($_POST["pass2"]));
        $this->db->where('passexos', $code);
        if ($this->db->update("exos")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function insertexos($file, $user)
    {
        $this->Typ_id = $_POST['Typ_id']; // please read the below note
        $this->dates = date("Y-m-d");
        $this->libeller = $_POST['libeller'];
        $this->details = $file;
        if(!empty($_POST['Mat_id'])){
           $this->Mat_id = $_POST['Mat_id'];
        }
        $this->status = 0;
        $this->Use_id = $user;

        if ($this->db->insert("exos", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertexos2($code)
    {
        $this->db->select_max("id");
        $id = $this->db->get("exos");
    /////////////// ===================== /////////////////////////
        $this->id = $id;
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passexos = sha1($_POST['password']);
        $this->dateexos = date("Y-m-d");
        $this->loginexos = $_POST['login'];
        $this->nomexos = $_POST['nom'];
        $this->prenomexos = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numeroexos = $_POST['tel'];
        $this->emailexos = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("exos", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function editexos($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('loginexos', $_POST['loginexos']);
        $this->db->set('nomexos', $_POST['nomexos']);
        $this->db->set('prenomexos', $_POST['prenomexos']);
        $this->db->set('numeroexos', $_POST['numeroexos']);
        $this->db->set('emailexos', $_POST['emailexos']);
        $this->db->set('bpexos', $_POST['bpexos']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("exos")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passexos', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('exos');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('photoexos', $lien); // please read the below note
        //$this->db->set('dateexos', time());
        $this->db->where('id', $user);

        $this->db->update('exos');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('exos');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('exos');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('exos');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('exos');
        return true;
    }

    public function connectexos()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("exos", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordexos($exos)
    {
        $this->passexos = sha1($_POST['password']);
        $query = $this->db->get_where("exos", array('id' => $exos, 'passexos' => $this->passexos));
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

    public function getexosByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("exos", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getfirstDatabyExos($id, $value)
    {
        if($this->getexosByID($id) == false){
            return 1;
        }else{
            foreach ($this->getexosByID($id) as $row):
                return $row->$value;
            endforeach;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->getexosByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAllexosLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("exos", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAllexosByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("exos", array('status!=' => $id));
        return $query->result();
    }

    public function getexosByEmail($id)
    {
        $this->emailexos = $id;

        $query = $this->db->get_where("exos", array('emailexos' => $this->emailexos));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->getexosByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
