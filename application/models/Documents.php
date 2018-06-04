<?php
defined('BASEPATH') or exit('No direct script access allowed');

class documents extends CI_Model
{
    public $id;
    public $Typ_id;
    public $libeller;
    public $details;
    public $status;
    public $dates;
    public $photo;

    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        //$this->db->method_name();
    }

    public function getAlldocuments()
    {
        $query = $this->db->get("documents");
        return $query->result();
    }

    public function getAlldocumentspaginate($min, $max){
        //$this->db->limit($min, $max);
        $query = $this->db->get("documents", $max, $min);
        return $query->result();
    }

    public function countAlldocuments()
    {
        $query = $this->db->get_where("documents", array("status" => 0));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("documents", array("emaildocuments" => $_POST['email']));
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
        $query = $this->db->get_where("documents", array("emaildocuments" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("documents", array("logindocuments" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertdocuments($code) == true) {
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
        $query = $this->db->get_where("documents", array("emaildocuments" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("documents", array("logindocuments" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertdocuments2($code) == true) {
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
        $this->db->set('passdocuments', $code);
        $this->db->where('emaildocuments', $_POST["email"]);
        if ($this->db->update("documents")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("documents")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passdocuments', sha1($_POST["pass2"]));
        $this->db->where('passdocuments', $code);
        if ($this->db->update("documents")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function insertdocuments($img, $code)
    {
        $this->Typ_id = $_POST['Typ_doc']; // please read the below note
        $this->dates = date("Y-m-d");
        $this->libeller = $_POST['texte'];
        $this->details = $_POST['details'];
        $this->status = $code;
        $this->photo = $img;

        if ($this->db->insert("documents", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function editdocuments($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('logindocuments', $_POST['logindocuments']);
        $this->db->set('nomdocuments', $_POST['nomdocuments']);
        $this->db->set('prenomdocuments', $_POST['prenomdocuments']);
        $this->db->set('numerodocuments', $_POST['numerodocuments']);
        $this->db->set('emaildocuments', $_POST['emaildocuments']);
        $this->db->set('bpdocuments', $_POST['bpdocuments']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("documents")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passdocuments', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('documents');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('photodocuments', $lien); // please read the below note
        //$this->db->set('datedocuments', time());
        $this->db->where('id', $user);

        $this->db->update('documents');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('documents');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('documents');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('documents');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('documents');
        return true;
    }

    public function connectdocuments()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("documents", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPassworddocuments($documents)
    {
        $this->passdocuments = sha1($_POST['password']);
        $query = $this->db->get_where("documents", array('id' => $documents, 'passdocuments' => $this->passdocuments));
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

    public function getdocumentsByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("documents", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->getdocumentsByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAlldocumentsLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("documents", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAlldocumentsByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("documents", array('status!=' => $id));
        return $query->result();
    }

    public function getdocumentsByEmail($id)
    {
        $this->emaildocuments = $id;

        $query = $this->db->get_where("documents", array('emaildocuments' => $this->emaildocuments));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->getdocumentsByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
