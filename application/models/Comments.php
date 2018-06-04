<?php
defined('BASEPATH') or exit('No direct script access allowed');

class comments extends CI_Model
{
    public $id;
    public $Actu_id;
    public $Use_id;
    public $Suj_id;
    public $libeller;
    public $status;
    public $dates;

    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        //$this->db->method_name();
    }

    public function getAllcomments()
    {
        $query = $this->db->get("comments");
        return $query->result();
    }

    public function CountcommentsByCol($id, $col)
    {
        $this->db->from('comments');
        $this->db->join('users', 'users.id = comments.Use_id');
        $this->db->where("$col",$id);
        $this->db->where("comments.status",0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    public function getAllcommentsByCol($id, $col)
    {
        $this->db->from('users');
        $this->db->join('comments', 'users.id = comments.Use_id');
        $this->db->where("$col",$id);
        $this->db->where("comments.status",0);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result();
        }else{
            return false;
        }
    }

    public function countAllcomments()
    {
        $query = $this->db->get_where("comments", array("status" => 0));
        return $query->num_rows();
    }

    public function countByCol($id, $status, $col){
        $query = $this->db->get_where("comments", array("status" => $status, "$col"=>$id));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("comments", array("emailcomments" => $_POST['email']));
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
        $query = $this->db->get_where("comments", array("emailcomments" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("comments", array("logincomments" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertcomments($code) == true) {
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
        $query = $this->db->get_where("comments", array("emailcomments" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("comments", array("logincomments" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertcomments2($code) == true) {
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
        $this->db->set('passcomments', $code);
        $this->db->where('emailcomments', $_POST["email"]);
        if ($this->db->update("comments")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("comments")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passcomments', sha1($_POST["pass2"]));
        $this->db->where('passcomments', $code);
        if ($this->db->update("comments")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function insertcomments($code)
    {
        $this->Actu_id = $_POST['Actu_id']; // please read the below note

        if($_POST['Suj_id'] != 0){
            $this->Suj_id = $_POST['Suj_id'];
        }
        $this->dates = date("Y-m-d");
        $this->libeller = $_POST['libeller'];
        $this->Use_id = $_SESSION['ens_userid'];
        $this->status = $code;

        if ($this->db->insert("comments", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertcomments2($code)
    {
        $this->db->select_max("id");
        $id = $this->db->get("comments");
    /////////////// ===================== /////////////////////////
        $this->id = $id;
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passcomments = sha1($_POST['password']);
        $this->datecomments = date("Y-m-d");
        $this->logincomments = $_POST['login'];
        $this->nomcomments = $_POST['nom'];
        $this->prenomcomments = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numerocomments = $_POST['tel'];
        $this->emailcomments = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("comments", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function editcomments($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('logincomments', $_POST['logincomments']);
        $this->db->set('nomcomments', $_POST['nomcomments']);
        $this->db->set('prenomcomments', $_POST['prenomcomments']);
        $this->db->set('numerocomments', $_POST['numerocomments']);
        $this->db->set('emailcomments', $_POST['emailcomments']);
        $this->db->set('bpcomments', $_POST['bpcomments']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("comments")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passcomments', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('comments');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('photocomments', $lien); // please read the below note
        //$this->db->set('datecomments', time());
        $this->db->where('id', $user);

        $this->db->update('comments');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('comments');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('comments');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('comments');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('comments');
        return true;
    }

    public function connectcomments()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("comments", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordcomments($comments)
    {
        $this->passcomments = sha1($_POST['password']);
        $query = $this->db->get_where("comments", array('id' => $comments, 'passcomments' => $this->passcomments));
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

    public function getcommentsByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("comments", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->getcommentsByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAllcommentsLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("comments", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAllcommentsByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("comments", array('status!=' => $id));
        return $query->result();
    }

    public function getcommentsByEmail($id)
    {
        $this->emailcomments = $id;

        $query = $this->db->get_where("comments", array('emailcomments' => $this->emailcomments));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->getcommentsByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
