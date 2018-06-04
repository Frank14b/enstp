<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cours extends CI_Model
{
    public $id;
    public $Mat_id;
    public $Typ_id;
    public $Use_id;
    public $libeller;
    public $details;
    public $status;
    public $code;
    public $dates;

    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        //$this->db->method_name();
    }

    public function getAllcours()
    {
        $query = $this->db->get("cours");
        return $query->result();
    }

    public function getAllcoursPagination($min, $max)
    {
        $query = $this->db->get("cours", $max, $min);
        return $query->result();
    }

    public function countAllcours()
    {
        $query = $this->db->get_where("cours", array("status" => 0));
        return $query->num_rows();
    }

    public function countByCol($id, $status, $col){
        $query = $this->db->get_where("cours", array("status" => $status, "$col"=>$id));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("cours", array("emailcours" => $_POST['email']));
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
        $query = $this->db->get_where("cours", array("emailcours" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("cours", array("logincours" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertcours($code) == true) {
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
        $query = $this->db->get_where("cours", array("emailcours" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("cours", array("logincours" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertcours2($code) == true) {
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
        $this->db->set('passcours', $code);
        $this->db->where('emailcours', $_POST["email"]);
        if ($this->db->update("cours")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("cours")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passcours', sha1($_POST["pass2"]));
        $this->db->where('passcours', $code);
        if ($this->db->update("cours")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function insertcours($code)
    {
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passcours = sha1($_POST['password']);
        $this->datecours = date("Y-m-d");
        $this->logincours = $_POST['login'];
        $this->nomcours = $_POST['nom'];
        $this->prenomcours = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numerocours = $_POST['tel'];
        $this->emailcours = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("cours", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertcours2($code)
    {
        $this->db->select_max("id");
        $id = $this->db->get("cours");
    /////////////// ===================== /////////////////////////
        $this->id = $id;
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passcours = sha1($_POST['password']);
        $this->datecours = date("Y-m-d");
        $this->logincours = $_POST['login'];
        $this->nomcours = $_POST['nom'];
        $this->prenomcours = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numerocours = $_POST['tel'];
        $this->emailcours = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("cours", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function editcours($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('logincours', $_POST['logincours']);
        $this->db->set('nomcours', $_POST['nomcours']);
        $this->db->set('prenomcours', $_POST['prenomcours']);
        $this->db->set('numerocours', $_POST['numerocours']);
        $this->db->set('emailcours', $_POST['emailcours']);
        $this->db->set('bpcours', $_POST['bpcours']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("cours")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passcours', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('cours');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('photocours', $lien); // please read the below note
        //$this->db->set('datecours', time());
        $this->db->where('id', $user);

        $this->db->update('cours');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('cours');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('cours');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('cours');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('cours');
        return true;
    }

    public function connectcours()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("cours", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordcours($cours)
    {
        $this->passcours = sha1($_POST['password']);
        $query = $this->db->get_where("cours", array('id' => $cours, 'passcours' => $this->passcours));
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

    public function getcoursByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("cours", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->getcoursByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAllcoursLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("cours", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAllcoursByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("cours", array('status!=' => $id));
        return $query->result();
    }

    public function getcoursByEmail($id)
    {
        $this->emailcours = $id;

        $query = $this->db->get_where("cours", array('emailcours' => $this->emailcours));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->getcoursByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
