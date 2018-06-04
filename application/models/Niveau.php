<?php
defined('BASEPATH') or exit('No direct script access allowed');

class niveau extends CI_Model
{
    public $id;
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

    public function getAllniveau()
    {
        $this->db->where("status != 3");
        $query = $this->db->get("niveau");
        return $query->result();
    }

    public function countAllniveau()
    {
        $query = $this->db->get_where("niveau", array("status" => 0));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("niveau", array("emailniveau" => $_POST['email']));
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
        $query = $this->db->get_where("niveau", array("emailniveau" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("niveau", array("loginniveau" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertniveau($code) == true) {
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
        $query = $this->db->get_where("niveau", array("emailniveau" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("niveau", array("loginniveau" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertniveau2($code) == true) {
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
        $this->db->set('passniveau', $code);
        $this->db->where('emailniveau', $_POST["email"]);
        if ($this->db->update("niveau")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("niveau")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passniveau', sha1($_POST["pass2"]));
        $this->db->where('passniveau', $code);
        if ($this->db->update("niveau")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function insertniveau($code)
    {
        $this->libeller = $_POST['libeller']; // please read the below note
        $this->details = $_POST['details'];
        $this->dates = date("Y-m-d");
        $this->status = $code;

        if ($this->db->insert("niveau", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertniveau2($code)
    {
        $this->db->select_max("id");
        $id = $this->db->get("niveau");
    /////////////// ===================== /////////////////////////
        $this->id = $id;
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passniveau = sha1($_POST['password']);
        $this->dateniveau = date("Y-m-d");
        $this->loginniveau = $_POST['login'];
        $this->nomniveau = $_POST['nom'];
        $this->prenomniveau = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numeroniveau = $_POST['tel'];
        $this->emailniveau = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("niveau", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function editniveau($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('loginniveau', $_POST['loginniveau']);
        $this->db->set('nomniveau', $_POST['nomniveau']);
        $this->db->set('prenomniveau', $_POST['prenomniveau']);
        $this->db->set('numeroniveau', $_POST['numeroniveau']);
        $this->db->set('emailniveau', $_POST['emailniveau']);
        $this->db->set('bpniveau', $_POST['bpniveau']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("niveau")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passniveau', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('niveau');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('photoniveau', $lien); // please read the below note
        //$this->db->set('dateniveau', time());
        $this->db->where('id', $user);

        $this->db->update('niveau');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('niveau');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('niveau');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('niveau');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('niveau');
        return true;
    }

    public function connectniveau()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("niveau", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordniveau($niveau)
    {
        $this->passniveau = sha1($_POST['password']);
        $query = $this->db->get_where("niveau", array('id' => $niveau, 'passniveau' => $this->passniveau));
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

    public function getniveauByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("niveau", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->getniveauByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAllniveauLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("niveau", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAllniveauByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("niveau", array('status!=' => $id));
        return $query->result();
    }

    public function getniveauByEmail($id)
    {
        $this->emailniveau = $id;

        $query = $this->db->get_where("niveau", array('emailniveau' => $this->emailniveau));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->getniveauByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
