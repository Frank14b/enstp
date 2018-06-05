<?php
defined('BASEPATH') or exit('No direct script access allowed');

class notifications extends CI_Model
{
    public $id;
    public $Use_id;
    public $libeller;
    public $liens;
    public $status;
    public $dates;
    public $autres;

    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        //$this->db->method_name();
    }

    public function getAllnotifications()
    {
        $this->db->where("status != 3");
        $query = $this->db->get("notifications");
        return $query->result();
    }

    public function countAllnotifications()
    {
        $query = $this->db->get_where("notifications", array("status" => 0));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("notifications", array("emailnotifications" => $_POST['email']));
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
        $query = $this->db->get_where("notifications", array("emailnotifications" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("notifications", array("loginnotifications" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertnotifications($code) == true) {
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
        $query = $this->db->get_where("notifications", array("emailnotifications" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("notifications", array("loginnotifications" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertnotifications2($code) == true) {
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
        $this->db->set('passnotifications', $code);
        $this->db->where('emailnotifications', $_POST["email"]);
        if ($this->db->update("notifications")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("notifications")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passnotifications', sha1($_POST["pass2"]));
        $this->db->where('passnotifications', $code);
        if ($this->db->update("notifications")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function insertnotifications($code)
    {
        $this->libeller = $_POST['libeller']; // please read the below note
        $this->details = $_POST['details'];
        $this->dates = date("Y-m-d");
        $this->status = $code;

        if ($this->db->insert("notifications", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertnotifications2($code)
    {
        $this->db->select_max("id");
        $id = $this->db->get("notifications");
    /////////////// ===================== /////////////////////////
        $this->id = $id;
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passnotifications = sha1($_POST['password']);
        $this->datenotifications = date("Y-m-d");
        $this->loginnotifications = $_POST['login'];
        $this->nomnotifications = $_POST['nom'];
        $this->prenomnotifications = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numeronotifications = $_POST['tel'];
        $this->emailnotifications = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("notifications", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function editnotifications($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('loginnotifications', $_POST['loginnotifications']);
        $this->db->set('nomnotifications', $_POST['nomnotifications']);
        $this->db->set('prenomnotifications', $_POST['prenomnotifications']);
        $this->db->set('numeronotifications', $_POST['numeronotifications']);
        $this->db->set('emailnotifications', $_POST['emailnotifications']);
        $this->db->set('bpnotifications', $_POST['bpnotifications']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("notifications")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passnotifications', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('notifications');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('photonotifications', $lien); // please read the below note
        //$this->db->set('datenotifications', time());
        $this->db->where('id', $user);

        $this->db->update('notifications');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('notifications');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('notifications');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('notifications');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('notifications');
        return true;
    }

    public function connectnotifications()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("notifications", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordnotifications($notifications)
    {
        $this->passnotifications = sha1($_POST['password']);
        $query = $this->db->get_where("notifications", array('id' => $notifications, 'passnotifications' => $this->passnotifications));
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

    public function getnotificationsByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("notifications", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->getnotificationsByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAllnotificationsLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("notifications", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAllnotificationsByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("notifications", array('status!=' => $id));
        return $query->result();
    }

    public function getnotificationsByEmail($id)
    {
        $this->emailnotifications = $id;

        $query = $this->db->get_where("notifications", array('emailnotifications' => $this->emailnotifications));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->getnotificationsByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
