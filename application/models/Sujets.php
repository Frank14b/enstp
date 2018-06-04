<?php
defined('BASEPATH') or exit('No direct script access allowed');

class sujets extends CI_Model
{
    public $id;
    public $Mat_id;
    public $Fil_id;
    public $Niv_id;
    public $Use_id;
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

    public function getAllsujets()
    {
        $query = $this->db->get("sujets");
        return $query->result();
    }

    public function countAllsujets()
    {
        $query = $this->db->get_where("sujets", array("status" => 0));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("sujets", array("emailsujets" => $_POST['email']));
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
        $query = $this->db->get_where("sujets", array("emailsujets" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("sujets", array("loginsujets" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertsujets($code) == true) {
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
        $query = $this->db->get_where("sujets", array("emailsujets" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("sujets", array("loginsujets" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertsujets2($code) == true) {
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
        $this->db->set('passsujets', $code);
        $this->db->where('emailsujets', $_POST["email"]);
        if ($this->db->update("sujets")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("sujets")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passsujets', sha1($_POST["pass2"]));
        $this->db->where('passsujets', $code);
        if ($this->db->update("sujets")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function insertsujets($code)
    {
        $this->Use_id = $_SESSION['ens_userid']; // please read the below note
        $this->libeller = $_POST['libeller'];
        $this->dates = date("Y-m-d");
        $this->details = $_POST['details'];
        $this->Fil_id = $_POST['Fil_id'];
        $this->Niv_id = $_POST['Niv_id'];
        $this->Mat_id = $_POST['Mat_id'];
        $this->status = $code;

        if ($this->db->insert("sujets", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function editsujets($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('loginsujets', $_POST['loginsujets']);
        $this->db->set('nomsujets', $_POST['nomsujets']);
        $this->db->set('prenomsujets', $_POST['prenomsujets']);
        $this->db->set('numerosujets', $_POST['numerosujets']);
        $this->db->set('emailsujets', $_POST['emailsujets']);
        $this->db->set('bpsujets', $_POST['bpsujets']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("sujets")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passsujets', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('sujets');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('photosujets', $lien); // please read the below note
        //$this->db->set('datesujets', time());
        $this->db->where('id', $user);

        $this->db->update('sujets');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('sujets');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('sujets');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('sujets');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('sujets');
        return true;
    }

    public function connectsujets()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("sujets", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordsujets($sujets)
    {
        $this->passsujets = sha1($_POST['password']);
        $query = $this->db->get_where("sujets", array('id' => $sujets, 'passsujets' => $this->passsujets));
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

    public function getsujetsByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("sujets", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->getsujetsByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAllsujetsLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("sujets", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAllsujetsByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("sujets", array('status!=' => $id));
        return $query->result();
    }

    public function getsujetsByEmail($id)
    {
        $this->emailsujets = $id;

        $query = $this->db->get_where("sujets", array('emailsujets' => $this->emailsujets));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->getsujetsByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
