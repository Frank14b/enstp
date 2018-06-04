<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mouchar extends CI_Model
{
    public $id;
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

    public function getAllmouchar()
    {
        $this->db->where("status != 3");
        $query = $this->db->get("mouchar");
        return $query->result();
    }

    public function countAllmouchar()
    {
        $query = $this->db->get_where("mouchar", array("status" => 0));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("mouchar", array("emailmouchar" => $_POST['email']));
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
        $query = $this->db->get_where("mouchar", array("emailmouchar" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("mouchar", array("loginmouchar" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertmouchar($code) == true) {
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
        $query = $this->db->get_where("mouchar", array("emailmouchar" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("mouchar", array("loginmouchar" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertmouchar2($code) == true) {
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
        $this->db->set('passmouchar', $code);
        $this->db->where('emailmouchar', $_POST["email"]);
        if ($this->db->update("mouchar")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("mouchar")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passmouchar', sha1($_POST["pass2"]));
        $this->db->where('passmouchar', $code);
        if ($this->db->update("mouchar")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function insertmouchar($tache, $details)
    {
        // please read the below note

        if(isset($_SESSION['ens_userid'])){
            $this->db->where("Use_id",$_SESSION['ens_userid']);
        }

        $this->db->where("details",$details);
        $query = $this->db->get("mouchar");

        if($query->num_rows() == 0)
        {
            $this->dates = date("Y-m-d");
            $this->libeller = $tache;
            $this->details = $details;
            if(isset($_SESSION['ens_userid'])){
                $this->Use_id = $_SESSION['ens_userid'];
            }
            $this->status = 0;

            if ($this->db->insert("mouchar", $this)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function insertmouchar2($code)
    {
        $this->db->select_max("id");
        $id = $this->db->get("mouchar");
    /////////////// ===================== /////////////////////////
        $this->id = $id;
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passmouchar = sha1($_POST['password']);
        $this->datemouchar = date("Y-m-d");
        $this->loginmouchar = $_POST['login'];
        $this->nommouchar = $_POST['nom'];
        $this->prenommouchar = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numeromouchar = $_POST['tel'];
        $this->emailmouchar = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("mouchar", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function editmouchar($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('loginmouchar', $_POST['loginmouchar']);
        $this->db->set('nommouchar', $_POST['nommouchar']);
        $this->db->set('prenommouchar', $_POST['prenommouchar']);
        $this->db->set('numeromouchar', $_POST['numeromouchar']);
        $this->db->set('emailmouchar', $_POST['emailmouchar']);
        $this->db->set('bpmouchar', $_POST['bpmouchar']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("mouchar")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passmouchar', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('mouchar');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('photomouchar', $lien); // please read the below note
        //$this->db->set('datemouchar', time());
        $this->db->where('id', $user);

        $this->db->update('mouchar');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('mouchar');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('mouchar');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('mouchar');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('mouchar');
        return true;
    }

    public function connectmouchar()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("mouchar", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordmouchar($mouchar)
    {
        $this->passmouchar = sha1($_POST['password']);
        $query = $this->db->get_where("mouchar", array('id' => $mouchar, 'passmouchar' => $this->passmouchar));
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

    public function getmoucharByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("mouchar", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getmoucharByElemt($id, $ele)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("mouchar", array($ele => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->getmoucharByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAllmoucharLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("mouchar", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAllmoucharByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("mouchar", array('status!=' => $id));
        return $query->result();
    }

    public function getmoucharByEmail($id)
    {
        $this->emailmouchar = $id;

        $query = $this->db->get_where("mouchar", array('emailmouchar' => $this->emailmouchar));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->getmoucharByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
