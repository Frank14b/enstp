<?php
defined('BASEPATH') or exit('No direct script access allowed');

class joins extends CI_Model
{
    public $id;
    public $Use_id;
    public $status;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        //$this->db->method_name();
    }

    public function getAlljoins()
    {
        $query = $this->db->get("joins");
        return $query->result();
    }

    public function getAlldemandes($id)
    {
        $this->db->where("id", $id);
        $this->db->where("status", 1);
        $query = $this->db->get("joins");
        if ($query->num_rows() == 0) 
        {
            return false;
        } else {
            return $query->result();
        }
    }

    public function getAllMember($id)
    {
        $this->db->where("id", $id);
        $this->db->where("status", 0);
        $query = $this->db->get("joins");
        if ($query->num_rows() == 0) 
        {
            return false;
        } else {
            return $query->result();
        }
    }

    public function countAlljoins()
    {
        $query = $this->db->get_where("joins", array("status" => 0));
        return $query->num_rows();
    }

    public function countWoWantToJoin($id, $objet, $value)
    {
        $query = $this->db->get_where("joins", array("id" => $id, "$objet"=>$value));
        return $query->num_rows();
    }

    public function checkIfexistJoins($user, $id, $code)
    { // please read the below note
        $query = $this->db->get_where("joins", array("Use_id" => $user, "id"=>$id, "status"=>$code));
        if ($query->num_rows() == 1) 
        {
            return true;
        } else {
            return false;
        }
    }

    public function checkIfExist($code)
    { // please read the below note
        $query = $this->db->get_where("joins", array("emailjoins" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("joins", array("loginjoins" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertjoins($code) == true) {
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
        $query = $this->db->get_where("joins", array("emailjoins" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("joins", array("loginjoins" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertjoins2($code) == true) {
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
        $this->db->set('passjoins', $code);
        $this->db->where('emailjoins', $_POST["email"]);
        if ($this->db->update("joins")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("joins")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passjoins', sha1($_POST["pass2"]));
        $this->db->where('passjoins', $code);
        if ($this->db->update("joins")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function insertjoins($code)
    {
        $this->id = $_POST['id']; // please read the below note
        $this->Use_id = $_POST['Use_id'];
        $this->status = $code;

        if ($this->db->insert("joins", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertjoins2($code)
    {
        $this->db->select_max("id");
        $id = $this->db->get("joins");
    /////////////// ===================== /////////////////////////
        $this->id = $id;
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passjoins = sha1($_POST['password']);
        $this->datejoins = date("Y-m-d");
        $this->loginjoins = $_POST['login'];
        $this->nomjoins = $_POST['nom'];
        $this->prenomjoins = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numerojoins = $_POST['tel'];
        $this->emailjoins = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("joins", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function editjoins($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('loginjoins', $_POST['loginjoins']);
        $this->db->set('nomjoins', $_POST['nomjoins']);
        $this->db->set('prenomjoins', $_POST['prenomjoins']);
        $this->db->set('numerojoins', $_POST['numerojoins']);
        $this->db->set('emailjoins', $_POST['emailjoins']);
        $this->db->set('bpjoins', $_POST['bpjoins']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("joins")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passjoins', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('joins');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('photojoins', $lien); // please read the below note
        //$this->db->set('datejoins', time());
        $this->db->where('id', $user);

        $this->db->update('joins');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('joins');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('joins');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('joins');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('joins');
        return true;
    }

    public function connectjoins()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("joins", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordjoins($joins)
    {
        $this->passjoins = sha1($_POST['password']);
        $query = $this->db->get_where("joins", array('id' => $joins, 'passjoins' => $this->passjoins));
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

    public function getjoinsByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("joins", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->getjoinsByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAlljoinsLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("joins", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAlljoinsByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("joins", array('status!=' => $id));
        return $query->result();
    }

    public function getjoinsByEmail($id)
    {
        $this->emailjoins = $id;

        $query = $this->db->get_where("joins", array('emailjoins' => $this->emailjoins));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->getjoinsByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
