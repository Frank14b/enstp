<?php
defined('BASEPATH') or exit('No direct script access allowed');

class typecours extends CI_Model
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

    public function getAlltypecours()
    {
        $query = $this->db->get("typecours");
        return $query->result();
    }

    public function countAlltypecours()
    {
        $query = $this->db->get_where("typecours", array("status" => 0));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("typecours", array("emailtypecours" => $_POST['email']));
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
        $query = $this->db->get_where("typecours", array("emailtypecours" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("typecours", array("logintypecours" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->inserttypecours($code) == true) {
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
        $query = $this->db->get_where("typecours", array("emailtypecours" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("typecours", array("logintypecours" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->inserttypecours2($code) == true) {
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
        $this->db->set('passtypecours', $code);
        $this->db->where('emailtypecours', $_POST["email"]);
        if ($this->db->update("typecours")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("typecours")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passtypecours', sha1($_POST["pass2"]));
        $this->db->where('passtypecours', $code);
        if ($this->db->update("typecours")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function inserttypecours($code)
    {
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passtypecours = sha1($_POST['password']);
        $this->datetypecours = date("Y-m-d");
        $this->logintypecours = $_POST['login'];
        $this->nomtypecours = $_POST['nom'];
        $this->prenomtypecours = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numerotypecours = $_POST['tel'];
        $this->emailtypecours = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("typecours", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function inserttypecours2($code)
    {
        $this->db->select_max("id");
        $id = $this->db->get("typecours");
    /////////////// ===================== /////////////////////////
        $this->id = $id;
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passtypecours = sha1($_POST['password']);
        $this->datetypecours = date("Y-m-d");
        $this->logintypecours = $_POST['login'];
        $this->nomtypecours = $_POST['nom'];
        $this->prenomtypecours = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numerotypecours = $_POST['tel'];
        $this->emailtypecours = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("typecours", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function edittypecours($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('logintypecours', $_POST['logintypecours']);
        $this->db->set('nomtypecours', $_POST['nomtypecours']);
        $this->db->set('prenomtypecours', $_POST['prenomtypecours']);
        $this->db->set('numerotypecours', $_POST['numerotypecours']);
        $this->db->set('emailtypecours', $_POST['emailtypecours']);
        $this->db->set('bptypecours', $_POST['bptypecours']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("typecours")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passtypecours', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('typecours');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('phototypecours', $lien); // please read the below note
        //$this->db->set('datetypecours', time());
        $this->db->where('id', $user);

        $this->db->update('typecours');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('typecours');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('typecours');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('typecours');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('typecours');
        return true;
    }

    public function connecttypecours()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("typecours", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordtypecours($typecours)
    {
        $this->passtypecours = sha1($_POST['password']);
        $query = $this->db->get_where("typecours", array('id' => $typecours, 'passtypecours' => $this->passtypecours));
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

    public function gettypecoursByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("typecours", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->gettypecoursByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAlltypecoursLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("typecours", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAlltypecoursByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("typecours", array('status!=' => $id));
        return $query->result();
    }

    public function gettypecoursByEmail($id)
    {
        $this->emailtypecours = $id;

        $query = $this->db->get_where("typecours", array('emailtypecours' => $this->emailtypecours));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->gettypecoursByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
