<?php
defined('BASEPATH') or exit('No direct script access allowed');

class filtre extends CI_Model
{
    public $id;
    public $mots;
    public $status;

    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        //$this->db->method_name();
    }

    public function getAllfiltre()
    {
        $this->db->where("status != 3");
        $query = $this->db->get("filtre");
        return $query->result();
    }

    public function countAllfiltre()
    {
        $query = $this->db->get_where("filtre", array("status" => 0));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("filtre", array("emailfiltre" => $_POST['email']));
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
        $query = $this->db->get_where("filtre", array("emailfiltre" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("filtre", array("loginfiltre" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertfiltre($code) == true) {
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
        $query = $this->db->get_where("filtre", array("emailfiltre" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("filtre", array("loginfiltre" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertfiltre2($code) == true) {
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
        $this->db->set('passfiltre', $code);
        $this->db->where('emailfiltre', $_POST["email"]);
        if ($this->db->update("filtre")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("filtre")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passfiltre', sha1($_POST["pass2"]));
        $this->db->where('passfiltre', $code);
        if ($this->db->update("filtre")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function insertfiltre($code)
    {
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passfiltre = sha1($_POST['password']);
        $this->datefiltre = date("Y-m-d");
        $this->loginfiltre = $_POST['login'];
        $this->nomfiltre = $_POST['nom'];
        $this->prenomfiltre = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numerofiltre = $_POST['tel'];
        $this->emailfiltre = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("filtre", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertfiltre2($code)
    {
        $this->db->select_max("id");
        $id = $this->db->get("filtre");
    /////////////// ===================== /////////////////////////
        $this->id = $id;
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passfiltre = sha1($_POST['password']);
        $this->datefiltre = date("Y-m-d");
        $this->loginfiltre = $_POST['login'];
        $this->nomfiltre = $_POST['nom'];
        $this->prenomfiltre = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numerofiltre = $_POST['tel'];
        $this->emailfiltre = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("filtre", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function editfiltre($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('loginfiltre', $_POST['loginfiltre']);
        $this->db->set('nomfiltre', $_POST['nomfiltre']);
        $this->db->set('prenomfiltre', $_POST['prenomfiltre']);
        $this->db->set('numerofiltre', $_POST['numerofiltre']);
        $this->db->set('emailfiltre', $_POST['emailfiltre']);
        $this->db->set('bpfiltre', $_POST['bpfiltre']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("filtre")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passfiltre', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('filtre');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('photofiltre', $lien); // please read the below note
        //$this->db->set('datefiltre', time());
        $this->db->where('id', $user);

        $this->db->update('filtre');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('filtre');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('filtre');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('filtre');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('filtre');
        return true;
    }

    public function connectfiltre()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("filtre", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordfiltre($filtre)
    {
        $this->passfiltre = sha1($_POST['password']);
        $query = $this->db->get_where("filtre", array('id' => $filtre, 'passfiltre' => $this->passfiltre));
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

    public function getfiltreByElemt($id, $ele)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("filtre", array($ele => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getfiltreByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("filtre", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->getfiltreByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAllfiltreLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("filtre", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAllfiltreByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("filtre", array('status!=' => $id));
        return $query->result();
    }

    public function getfiltreByEmail($id)
    {
        $this->emailfiltre = $id;

        $query = $this->db->get_where("filtre", array('emailfiltre' => $this->emailfiltre));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->getfiltreByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
