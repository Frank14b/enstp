<?php
defined('BASEPATH') or exit('No direct script access allowed');

class parties extends CI_Model
{
    public $id;
    public $libeller;
    public $Cou_id;
    public $details;
    public $status;
    public $dates;
    public $descript;

    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        //$this->db->method_name();
    }

    public function getAllparties()
    {
        $query = $this->db->get("parties");
        return $query->result();
    }

    public function getAllpartiesbyCours($id)
    {
        $query = $this->db->get_where("parties", array("Cou_id"=>$id, "status"=>0));
        if ($query->num_rows() != 0) 
        {
            return $query->result();
        }else{
            return false;
        }
    }

    public function countAllparties()
    {
        $query = $this->db->get_where("parties", array("status" => 0));
        return $query->num_rows();
    }

    public function countByCol($id, $status, $col){
        $query = $this->db->get_where("parties", array("status" => $status, "$col"=>$id));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("parties", array("emailparties" => $_POST['email']));
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
        $query = $this->db->get_where("parties", array("emailparties" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("parties", array("loginparties" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertparties($code) == true) {
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
        $query = $this->db->get_where("parties", array("emailparties" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("parties", array("loginparties" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertparties2($code) == true) {
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
        $this->db->set('passparties', $code);
        $this->db->where('emailparties', $_POST["email"]);
        if ($this->db->update("parties")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("parties")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passparties', sha1($_POST["pass2"]));
        $this->db->where('passparties', $code);
        if ($this->db->update("parties")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function insertparties($file)
    {
        $this->Cou_id= $_POST['Cou_id']; // please read the below note
        $this->dates = date("Y-m-d");
        $this->libeller = $_POST['libeller'];
        $this->details = $file;
        $this->descript = $_POST['descript'];
        $this->status = 0;

        if ($this->db->insert("parties", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertparties2($code)
    {
        $this->db->select_max("id");
        $id = $this->db->get("parties");
    /////////////// ===================== /////////////////////////
        $this->id = $id;
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passparties = sha1($_POST['password']);
        $this->dateparties = date("Y-m-d");
        $this->loginparties = $_POST['login'];
        $this->nomparties = $_POST['nom'];
        $this->prenomparties = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numeroparties = $_POST['tel'];
        $this->emailparties = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("parties", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function editparties($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('loginparties', $_POST['loginparties']);
        $this->db->set('nomparties', $_POST['nomparties']);
        $this->db->set('prenomparties', $_POST['prenomparties']);
        $this->db->set('numeroparties', $_POST['numeroparties']);
        $this->db->set('emailparties', $_POST['emailparties']);
        $this->db->set('bpparties', $_POST['bpparties']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("parties")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passparties', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('parties');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('photoparties', $lien); // please read the below note
        //$this->db->set('dateparties', time());
        $this->db->where('id', $user);

        $this->db->update('parties');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('parties');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('parties');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('parties');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('parties');
        return true;
    }

    public function connectparties()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("parties", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordparties($parties)
    {
        $this->passparties = sha1($_POST['password']);
        $query = $this->db->get_where("parties", array('id' => $parties, 'passparties' => $this->passparties));
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

    public function getpartiesByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("parties", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->getpartiesByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAllpartiesLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("parties", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAllpartiesByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("parties", array('status!=' => $id));
        return $query->result();
    }

    public function getpartiesByEmail($id)
    {
        $this->emailparties = $id;

        $query = $this->db->get_where("parties", array('emailparties' => $this->emailparties));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->getpartiesByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getfirstDatabyCours($id, $value)
    {
        if($this->getFirstPartcoursByID($id) == false){
            return 1;
        }else{
            foreach ($this->getFirstPartcoursByID($id) as $row):
                return $row->$value;
            endforeach;
        }
    }

    public function getFirstPartcoursByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $this->db->where("Cou_id", $id);
        $query = $this->db->get("parties", 1);
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
}
