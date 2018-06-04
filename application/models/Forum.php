<?php
defined('BASEPATH') or exit('No direct script access allowed');

class forum extends CI_Model
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

    public function getAllforum()
    {
        $this->db->where("status == 0");
        $query = $this->db->get("sujets");
        return $query->result();
    }

    public function getAllforumpaginate($min, $max)
    {
        $this->db->where("status = 0");
        $query = $this->db->get("sujets", $max, $min);
        return $query->result();
    }

    public function getAllForumByCol($id, $col)
    {
        $query = $this->db->get_where("sujets", array("status" => 0, "$col"=>$id));
        if ($query->num_rows() != 0) {
            return $query->result();
        }else{
            return false;
        }
    }

    public function countAllforum()
    {
        $query = $this->db->get_where("sujets", array("status" => 0));
        return $query->num_rows();
    }

    public function countByCol($id, $status, $col){
        $query = $this->db->get_where("sujets", array("status" => $status, "$col"=>$id));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("sujets", array("emailforum" => $_POST['email']));
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
        $query = $this->db->get_where("sujets", array("emailforum" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("sujets", array("loginforum" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertforum($code) == true) {
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
        $query = $this->db->get_where("sujets", array("emailforum" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("sujets", array("loginforum" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertforum2($code) == true) {
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
        $this->db->set('passforum', $code);
        $this->db->where('emailforum', $_POST["email"]);
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
        $this->db->set('passforum', sha1($_POST["pass2"]));
        $this->db->where('passforum', $code);
        if ($this->db->update("sujets")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function insertforum($code)
    {
        $this->Fil_id = $_POST['Fil_id']; // please read the below note
        $this->Mat_id = $_POST['Mat_id'];
        $this->dates = date("Y-m-d");
        $this->libeller = $_POST['libeller'];
        $this->Use_id = $_SESSION['ens_userid'];
        $this->Niv_id = $_POST['Niv_id'];
        $this->details = $_POST['details'];
        $this->status = $code;

        if ($this->db->insert("sujets", $this)) {
            return true;
        } else {
            return false;
        }
    }


    public function editforum($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('loginforum', $_POST['loginforum']);
        $this->db->set('nomforum', $_POST['nomforum']);
        $this->db->set('prenomforum', $_POST['prenomforum']);
        $this->db->set('numeroforum', $_POST['numeroforum']);
        $this->db->set('emailforum', $_POST['emailforum']);
        $this->db->set('bpforum', $_POST['bpforum']);
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
        $this->db->set('passforum', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('forum');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('photoforum', $lien); // please read the below note
        //$this->db->set('dateforum', time());
        $this->db->where('id', $user);

        $this->db->update('forum');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('forum');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('forum');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('forum');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('sujets');
        return true;
    }

    public function connectforum()
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

    public function checkPasswordforum($forum)
    {
        $this->passforum = sha1($_POST['password']);
        $query = $this->db->get_where("sujets", array('id' => $forum, 'passforum' => $this->passforum));
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

    public function getforumByID($id)
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
        foreach ($this->getforumByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAllforumLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("sujets", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAllforumByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("sujets", array('status!=' => $id));
        return $query->result();
    }

    public function getforumByEmail($id)
    {
        $this->emailforum = $id;

        $query = $this->db->get_where("sujets", array('emailforum' => $this->emailforum));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->getforumByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
