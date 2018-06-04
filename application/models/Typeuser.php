<?php
defined('BASEPATH') or exit('No direct script access allowed');

class typeuser extends CI_Model
{
    public $id;
    public $libeller;
    public $status;

    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        //$this->db->method_name();
    }

    public function getAlltypeuser()
    {
        $query = $this->db->get("typeuser");
        return $query->result();
    }

    public function countAlltypeuser()
    {
        $query = $this->db->get_where("typeuser", array("status" => 0));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("typeuser", array("emailtypeuser" => $_POST['email']));
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
        $query = $this->db->get_where("typeuser", array("emailtypeuser" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("typeuser", array("logintypeuser" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->inserttypeuser($code) == true) {
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
        $query = $this->db->get_where("typeuser", array("emailtypeuser" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("typeuser", array("logintypeuser" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->inserttypeuser2($code) == true) {
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
        $this->db->set('passtypeuser', $code);
        $this->db->where('emailtypeuser', $_POST["email"]);
        if ($this->db->update("typeuser")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("typeuser")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passtypeuser', sha1($_POST["pass2"]));
        $this->db->where('passtypeuser', $code);
        if ($this->db->update("typeuser")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function inserttypeuser($code)
    {
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passtypeuser = sha1($_POST['password']);
        $this->datetypeuser = date("Y-m-d");
        $this->logintypeuser = $_POST['login'];
        $this->nomtypeuser = $_POST['nom'];
        $this->prenomtypeuser = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numerotypeuser = $_POST['tel'];
        $this->emailtypeuser = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("typeuser", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function inserttypeuser2($code)
    {
        $this->db->select_max("id");
        $id = $this->db->get("typeuser");
    /////////////// ===================== /////////////////////////
        $this->id = $id;
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passtypeuser = sha1($_POST['password']);
        $this->datetypeuser = date("Y-m-d");
        $this->logintypeuser = $_POST['login'];
        $this->nomtypeuser = $_POST['nom'];
        $this->prenomtypeuser = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numerotypeuser = $_POST['tel'];
        $this->emailtypeuser = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("typeuser", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function edittypeuser($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('logintypeuser', $_POST['logintypeuser']);
        $this->db->set('nomtypeuser', $_POST['nomtypeuser']);
        $this->db->set('prenomtypeuser', $_POST['prenomtypeuser']);
        $this->db->set('numerotypeuser', $_POST['numerotypeuser']);
        $this->db->set('emailtypeuser', $_POST['emailtypeuser']);
        $this->db->set('bptypeuser', $_POST['bptypeuser']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("typeuser")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passtypeuser', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('typeuser');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('phototypeuser', $lien); // please read the below note
        //$this->db->set('datetypeuser', time());
        $this->db->where('id', $user);

        $this->db->update('typeuser');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('typeuser');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('typeuser');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('typeuser');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('typeuser');
        return true;
    }

    public function connecttypeuser()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("typeuser", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordtypeuser($typeuser)
    {
        $this->passtypeuser = sha1($_POST['password']);
        $query = $this->db->get_where("typeuser", array('id' => $typeuser, 'passtypeuser' => $this->passtypeuser));
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

    public function gettypeuserByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("typeuser", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->gettypeuserByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAlltypeuserLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("typeuser", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAlltypeuserByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("typeuser", array('status!=' => $id));
        return $query->result();
    }

    public function gettypeuserByEmail($id)
    {
        $this->emailtypeuser = $id;

        $query = $this->db->get_where("typeuser", array('emailtypeuser' => $this->emailtypeuser));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->gettypeuserByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
