<?php
defined('BASEPATH') or exit('No direct script access allowed');

class messages extends CI_Model
{
    public $id;
    public $texte;
    public $status;
    public $Use_id;
    public $Use_id2;
    public $Gro_id;
    public $etat;
    public $dates;

    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        //$this->db->method_name();
    }

    public function getAllmessages()
    {
        $query = $this->db->get("messages");
        return $query->result();
    }

    public function countAllmessages()
    {
        $query = $this->db->get_where("messages", array("status" => 0));
        return $query->num_rows();
    }

    public function countmessagesbyID($id, $id2)
    {
        $table = $this->db->dbprefix('messages');
        $sql = "SELECT * FROM $table,users WHERE ((Use_id=$id AND Use_id2=$id2 AND users.id=$id) OR (Use_id=$id2 AND Use_id2=$id AND users.id=$id2))";

        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("messages", array("emailmessages" => $_POST['email']));
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
        $query = $this->db->get_where("messages", array("emailmessages" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("messages", array("loginmessages" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertmessages($code) == true) {
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
        $query = $this->db->get_where("messages", array("emailmessages" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("messages", array("loginmessages" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertmessages2($code) == true) {
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
        $this->db->set('passmessages', $code);
        $this->db->where('emailmessages', $_POST["email"]);
        if ($this->db->update("messages")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("messages")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passmessages', sha1($_POST["pass2"]));
        $this->db->where('passmessages', $code);
        if ($this->db->update("messages")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function insertmessages($code)
    {
        $this->dates = date("Y-m-d h:i:s");
        $this->Use_id2 = $_POST['useid2'];
        $this->Use_id = $_SESSION['ens_userid'];
        $this->texte = $_POST['texte'];
        $this->status = $code;
        $this->etat = $code;
        $this->Gro_id = $_POST['groid'];

        if ($this->db->insert("messages", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function getMinDate($id, $id2, $order)
    {
        $table = $this->db->dbprefix('messages');
        $sql = "SELECT * FROM $table WHERE ((Use_id=$id AND Use_id2=$id2) OR (Use_id=$id2 AND Use_id2=$id)) order by id $order";

        $query = $this->db->query($sql);
        foreach($query->result() as $row):
            return $row->dates;
        endforeach;
    }

    public function insertmessages2($code)
    {
        $this->db->select_max("id");
        $id = $this->db->get("messages");
    /////////////// ===================== /////////////////////////
        $this->id = $id;
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passmessages = sha1($_POST['password']);
        $this->datemessages = date("Y-m-d");
        $this->loginmessages = $_POST['login'];
        $this->nommessages = $_POST['nom'];
        $this->prenommessages = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numeromessages = $_POST['tel'];
        $this->emailmessages = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("messages", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function editmessages($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('loginmessages', $_POST['loginmessages']);
        $this->db->set('nommessages', $_POST['nommessages']);
        $this->db->set('prenommessages', $_POST['prenommessages']);
        $this->db->set('numeromessages', $_POST['numeromessages']);
        $this->db->set('emailmessages', $_POST['emailmessages']);
        $this->db->set('bpmessages', $_POST['bpmessages']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("messages")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passmessages', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('messages');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('photomessages', $lien); // please read the below note
        //$this->db->set('datemessages', time());
        $this->db->where('id', $user);

        $this->db->update('messages');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('messages');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('messages');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('messages');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('messages');
        return true;
    }

    public function connectmessages()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("messages", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordmessages($messages)
    {
        $this->passmessages = sha1($_POST['password']);
        $query = $this->db->get_where("messages", array('id' => $messages, 'passmessages' => $this->passmessages));
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

    public function getmessagesByID($id, $id2){
        $table = $this->db->dbprefix('messages');
        //$this->db->order_by('id', 'desc');
        $sql = "SELECT * FROM users,$table WHERE ((Use_id=$id AND Use_id2=$id2 AND users.id=$id) OR (Use_id=$id2 AND Use_id2=$id AND users.id=$id2)) order by messages.id desc";

        $query = $this->db->query($sql);
        if($query->num_rows() != 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function getmessagesByGroupID($id, $id2){
        $table = $this->db->dbprefix('messages');
        $sql = "SELECT * FROM users,$table WHERE (Gro_id=$id2 AND users.id=messages.Use_id) order by messages.id desc";

        $query = $this->db->query($sql);
        if($query->num_rows() != 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function updateMessVu($id, $id2){
        $table = $this->db->dbprefix('messages');
        $sql = "UPDATE $table SET status=1 WHERE (Use_id=$id AND Use_id2=$id2)";

        $query = $this->db->query($sql);
        /*$this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('messages');*/
        return true;
    }

    public function getOneData($id, $value)
    {
        foreach ($this->getmessagesByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAllmessagesLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("messages", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAllmessagesByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("messages", array('status!=' => $id));
        return $query->result();
    }

    public function getmessagesByEmail($id)
    {
        $this->emailmessages = $id;

        $query = $this->db->get_where("messages", array('emailmessages' => $this->emailmessages));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->getmessagesByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
