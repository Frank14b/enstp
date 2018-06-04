<?php
defined('BASEPATH') or exit('No direct script access allowed');

class typedoc extends CI_Model
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

    public function getAlltypedoc()
    {
        $query = $this->db->get("typedoc");
        return $query->result();
    }

    public function countAlltypedoc()
    {
        $query = $this->db->get_where("typedoc", array("status" => 0));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("typedoc", array("emailtypedoc" => $_POST['email']));
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
        $query = $this->db->get_where("typedoc", array("emailtypedoc" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("typedoc", array("logintypedoc" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->inserttypedoc($code) == true) {
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
        $query = $this->db->get_where("typedoc", array("emailtypedoc" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("typedoc", array("logintypedoc" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->inserttypedoc2($code) == true) {
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
        $this->db->set('passtypedoc', $code);
        $this->db->where('emailtypedoc', $_POST["email"]);
        if ($this->db->update("typedoc")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("typedoc")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passtypedoc', sha1($_POST["pass2"]));
        $this->db->where('passtypedoc', $code);
        if ($this->db->update("typedoc")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function inserttypedoc($code)
    {
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passtypedoc = sha1($_POST['password']);
        $this->datetypedoc = date("Y-m-d");
        $this->logintypedoc = $_POST['login'];
        $this->nomtypedoc = $_POST['nom'];
        $this->prenomtypedoc = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numerotypedoc = $_POST['tel'];
        $this->emailtypedoc = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("typedoc", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function inserttypedoc2($code)
    {
        $this->db->select_max("id");
        $id = $this->db->get("typedoc");
    /////////////// ===================== /////////////////////////
        $this->id = $id;
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passtypedoc = sha1($_POST['password']);
        $this->datetypedoc = date("Y-m-d");
        $this->logintypedoc = $_POST['login'];
        $this->nomtypedoc = $_POST['nom'];
        $this->prenomtypedoc = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numerotypedoc = $_POST['tel'];
        $this->emailtypedoc = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("typedoc", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function edittypedoc($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('logintypedoc', $_POST['logintypedoc']);
        $this->db->set('nomtypedoc', $_POST['nomtypedoc']);
        $this->db->set('prenomtypedoc', $_POST['prenomtypedoc']);
        $this->db->set('numerotypedoc', $_POST['numerotypedoc']);
        $this->db->set('emailtypedoc', $_POST['emailtypedoc']);
        $this->db->set('bptypedoc', $_POST['bptypedoc']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("typedoc")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passtypedoc', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('typedoc');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('phototypedoc', $lien); // please read the below note
        //$this->db->set('datetypedoc', time());
        $this->db->where('id', $user);

        $this->db->update('typedoc');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('typedoc');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('typedoc');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('typedoc');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('typedoc');
        return true;
    }

    public function connecttypedoc()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("typedoc", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordtypedoc($typedoc)
    {
        $this->passtypedoc = sha1($_POST['password']);
        $query = $this->db->get_where("typedoc", array('id' => $typedoc, 'passtypedoc' => $this->passtypedoc));
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

    public function gettypedocByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("typedoc", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->gettypedocByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAlltypedocLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("typedoc", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAlltypedocByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("typedoc", array('status!=' => $id));
        return $query->result();
    }

    public function gettypedocByEmail($id)
    {
        $this->emailtypedoc = $id;

        $query = $this->db->get_where("typedoc", array('emailtypedoc' => $this->emailtypedoc));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->gettypedocByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
