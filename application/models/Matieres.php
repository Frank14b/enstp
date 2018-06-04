<?php
defined('BASEPATH') or exit('No direct script access allowed');

class matieres extends CI_Model
{
    public $id;
    public $Fil_id;
    //public $Niv_id;
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

    public function getAllmatieres()
    {
        $this->db->where("status != 3");
        $query = $this->db->get("matieres");
        return $query->result();
    }

    public function countAllmatieres()
    {
        $query = $this->db->get_where("matieres", array("status" => 0));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("matieres", array("emailmatieres" => $_POST['email']));
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
        $query = $this->db->get_where("matieres", array("emailmatieres" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("matieres", array("loginmatieres" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertmatieres($code) == true) {
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
        $query = $this->db->get_where("matieres", array("emailmatieres" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("matieres", array("loginmatieres" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertmatieres2($code) == true) {
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
        $this->db->set('passmatieres', $code);
        $this->db->where('emailmatieres', $_POST["email"]);
        if ($this->db->update("matieres")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("matieres")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passmatieres', sha1($_POST["pass2"]));
        $this->db->where('passmatieres', $code);
        if ($this->db->update("matieres")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function insertmatieres($code)
    {
        //$this->Niv_id = $_POST['Niv_id']; // please read the below note
        $this->dates = date("Y-m-d");
        $this->libeller = $_POST['libeller'];
        $this->details = $_POST['details'];
        $this->Fil_id = $_POST['Fil_id'];
        $this->status = $code;

        if ($this->db->insert("matieres", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertmatieres2($code)
    {
        $this->db->select_max("id");
        $id = $this->db->get("matieres");
    /////////////// ===================== /////////////////////////
        $this->id = $id;
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passmatieres = sha1($_POST['password']);
        $this->datematieres = date("Y-m-d");
        $this->loginmatieres = $_POST['login'];
        $this->nommatieres = $_POST['nom'];
        $this->prenommatieres = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numeromatieres = $_POST['tel'];
        $this->emailmatieres = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("matieres", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function editmatieres($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('loginmatieres', $_POST['loginmatieres']);
        $this->db->set('nommatieres', $_POST['nommatieres']);
        $this->db->set('prenommatieres', $_POST['prenommatieres']);
        $this->db->set('numeromatieres', $_POST['numeromatieres']);
        $this->db->set('emailmatieres', $_POST['emailmatieres']);
        $this->db->set('bpmatieres', $_POST['bpmatieres']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("matieres")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passmatieres', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('matieres');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('photomatieres', $lien); // please read the below note
        //$this->db->set('datematieres', time());
        $this->db->where('id', $user);

        $this->db->update('matieres');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('matieres');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('matieres');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('matieres');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('matieres');
        return true;
    }

    public function connectmatieres()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("matieres", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordmatieres($matieres)
    {
        $this->passmatieres = sha1($_POST['password']);
        $query = $this->db->get_where("matieres", array('id' => $matieres, 'passmatieres' => $this->passmatieres));
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

    public function getmatieresByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("matieres", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getmatieresByElemt($id, $ele)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("matieres", array($ele => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->getmatieresByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAllmatieresLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("matieres", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAllmatieresByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("matieres", array('status!=' => $id));
        return $query->result();
    }

    public function getmatieresByEmail($id)
    {
        $this->emailmatieres = $id;

        $query = $this->db->get_where("matieres", array('emailmatieres' => $this->emailmatieres));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->getmatieresByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
