<?php
defined('BASEPATH') or exit('No direct script access allowed');

class actualites extends CI_Model
{
    public $id;
    public $Rub_id;
    public $Use_id;
    public $libeller;
    public $details;
    public $status;
    public $dates;
    public $autres;

    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        //$this->db->method_name();
    }

    public function getAllactualites()
    {
        $query = $this->db->get("actualites");
        return $query->result();
    }

    public function getAllactualitesByEle($id, $name)
    {
        $query = $this->db->get_where("actualites", array("status" => 0, "$name"=>$id));
        return $query->result();
    }

    public function countAllactualites()
    {
        $query = $this->db->get_where("actualites", array("status" => 0));
        return $query->num_rows();
    }

    public function countByCol($id, $status, $col){
        $query = $this->db->get_where("actualites", array("status" => $status, "$col"=>$id));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("actualites", array("emailactualites" => $_POST['email']));
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
        $query = $this->db->get_where("actualites", array("emailactualites" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("actualites", array("loginactualites" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertactualites($code) == true) {
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
        $query = $this->db->get_where("actualites", array("emailactualites" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("actualites", array("loginactualites" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertactualites2($code) == true) {
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
        $this->db->set('passactualites', $code);
        $this->db->where('emailactualites', $_POST["email"]);
        if ($this->db->update("actualites")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("actualites")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passactualites', sha1($_POST["pass2"]));
        $this->db->where('passactualites', $code);
        if ($this->db->update("actualites")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function insertactualites($code)
    {
        $this->Rub_id = $_POST['Rub_id']; // please read the below note
        $this->dates = date("Y-m-d");
        $this->libeller = $_POST['libeller'];
        $this->details = $_POST['details'];
        $this->status = $code;
        //$this->photo = $img;
        $this->Use_id = $_SESSION['ens_userid'];

        if ($this->db->insert("actualites", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function editactualites($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('loginactualites', $_POST['loginactualites']);
        $this->db->set('nomactualites', $_POST['nomactualites']);
        $this->db->set('prenomactualites', $_POST['prenomactualites']);
        $this->db->set('numeroactualites', $_POST['numeroactualites']);
        $this->db->set('emailactualites', $_POST['emailactualites']);
        $this->db->set('bpactualites', $_POST['bpactualites']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("actualites")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passactualites', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('actualites');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('photoactualites', $lien); // please read the below note
        //$this->db->set('dateactualites', time());
        $this->db->where('id', $user);

        $this->db->update('actualites');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('actualites');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('actualites');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('actualites');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('actualites');
        return true;
    }

    public function connectactualites()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("actualites", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordactualites($actualites)
    {
        $this->passactualites = sha1($_POST['password']);
        $query = $this->db->get_where("actualites", array('id' => $actualites, 'passactualites' => $this->passactualites));
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

    public function getactualitesByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("actualites", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->getactualitesByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAllactualitesLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("actualites", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAllactualitesByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("actualites", array('status!=' => $id));
        return $query->result();
    }

    public function getactualitesByEmail($id)
    {
        $this->emailactualites = $id;

        $query = $this->db->get_where("actualites", array('emailactualites' => $this->emailactualites));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->getactualitesByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
