<?php
defined('BASEPATH') or exit('No direct script access allowed');

class filieres extends CI_Model
{
    public $id;
    public $Niv_id;
    public $libeller;
    public $details;
    public $status;
    public $dates;

    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        //$this->db->method_name();
    }

    public function getAllfilieres()
    {
        $this->db->where('status != 3');
        $query = $this->db->get("filieres");
        return $query->result();
    }

    public function countAllfilieres()
    {
        $query = $this->db->get_where("filieres", array("status" => 0));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("filieres", array("emailfilieres" => $_POST['email']));
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
        $query = $this->db->get_where("filieres", array("emailfilieres" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("filieres", array("loginfilieres" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertfilieres($code) == true) {
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
        $query = $this->db->get_where("filieres", array("emailfilieres" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("filieres", array("loginfilieres" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertfilieres2($code) == true) {
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
        $this->db->set('passfilieres', $code);
        $this->db->where('emailfilieres', $_POST["email"]);
        if ($this->db->update("filieres")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("filieres")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passfilieres', sha1($_POST["pass2"]));
        $this->db->where('passfilieres', $code);
        if ($this->db->update("filieres")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function insertfilieres($code)
    {
        $this->Niv_id = $_POST['Niv_id']; // please read the below note
        $this->dates = date("Y-m-d");
        $this->libeller = $_POST['libeller'];
        $this->details = $_POST['details'];
        $this->status = $code;

        if ($this->db->insert("filieres", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertfilieres2($code)
    {
        $this->db->select_max("id");
        $id = $this->db->get("filieres");
    /////////////// ===================== /////////////////////////
        $this->id = $id;
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passfilieres = sha1($_POST['password']);
        $this->datefilieres = date("Y-m-d");
        $this->loginfilieres = $_POST['login'];
        $this->nomfilieres = $_POST['nom'];
        $this->prenomfilieres = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numerofilieres = $_POST['tel'];
        $this->emailfilieres = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("filieres", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function editfilieres($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('loginfilieres', $_POST['loginfilieres']);
        $this->db->set('nomfilieres', $_POST['nomfilieres']);
        $this->db->set('prenomfilieres', $_POST['prenomfilieres']);
        $this->db->set('numerofilieres', $_POST['numerofilieres']);
        $this->db->set('emailfilieres', $_POST['emailfilieres']);
        $this->db->set('bpfilieres', $_POST['bpfilieres']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("filieres")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passfilieres', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('filieres');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('photofilieres', $lien); // please read the below note
        //$this->db->set('datefilieres', time());
        $this->db->where('id', $user);

        $this->db->update('filieres');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('filieres');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('filieres');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('filieres');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('filieres');
        return true;
    }

    public function connectfilieres()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("filieres", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordfilieres($filieres)
    {
        $this->passfilieres = sha1($_POST['password']);
        $query = $this->db->get_where("filieres", array('id' => $filieres, 'passfilieres' => $this->passfilieres));
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

    public function getfilieresByElemt($id, $ele)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("filieres", array($ele => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getfilieresByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("filieres", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->getfilieresByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAllfilieresLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("filieres", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAllfilieresByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("filieres", array('status!=' => $id));
        return $query->result();
    }

    public function getfilieresByEmail($id)
    {
        $this->emailfilieres = $id;

        $query = $this->db->get_where("filieres", array('emailfilieres' => $this->emailfilieres));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->getfilieresByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
