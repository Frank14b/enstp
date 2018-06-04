<?php
defined('BASEPATH') or exit('No direct script access allowed');

class groupes extends CI_Model
{
    public $id;
    public $Fil_id;
    public $Use_id;
    public $Niv_id;
    public $libeller;
    public $theme;
    public $photo;
    public $status;
    public $dates;
    public $etat;

    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        //$this->db->method_name();
    }

    public function getAllgroupes($id)
    {
        $query = $this->db->get_where("groupes", array("Use_id " => $id));
        return $query->result();
    }

    public function getAllgroupes2($id)
    {
        $query = $this->db->get_where("groupes", array("Use_id !=" => $id));
        return $query->result();
    }

    public function countAllgroupes()
    {
        $query = $this->db->get_where("groupes", array("status" => 0));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("groupes", array("emailgroupes" => $_POST['email']));
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
        $query = $this->db->get_where("groupes", array("emailgroupes" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("groupes", array("logingroupes" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertgroupes($code) == true) {
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
        $query = $this->db->get_where("groupes", array("emailgroupes" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("groupes", array("logingroupes" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->insertgroupes2($code) == true) {
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
        $this->db->set('passgroupes', $code);
        $this->db->where('emailgroupes', $_POST["email"]);
        if ($this->db->update("groupes")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("groupes")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passgroupes', sha1($_POST["pass2"]));
        $this->db->where('passgroupes', $code);
        if ($this->db->update("groupes")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function insertgroupes($img, $code)
    {
        $this->libeller = $_POST['libeller']; // please read the below note
        $this->dates = date("Y-m-d");
        $this->theme = $_POST['theme'];
        $this->etat = $_POST['etat'];
        $this->status = $code;
        $this->photo = $img;
        $this->Use_id = $_SESSION['ens_userid'];

        if($_POST['Fil_id'] != 0){
            $this->Fil_id = $_POST['Fil_id'];
        }
        if($_POST['Niv_id'] != 0){
            $this->Niv_id = $_POST['Niv_id'];
        }

        if ($this->db->insert("groupes", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function editgroupes($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('logingroupes', $_POST['logingroupes']);
        $this->db->set('nomgroupes', $_POST['nomgroupes']);
        $this->db->set('prenomgroupes', $_POST['prenomgroupes']);
        $this->db->set('numerogroupes', $_POST['numerogroupes']);
        $this->db->set('emailgroupes', $_POST['emailgroupes']);
        $this->db->set('bpgroupes', $_POST['bpgroupes']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("groupes")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passgroupes', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('groupes');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('photogroupes', $lien); // please read the below note
        //$this->db->set('dategroupes', time());
        $this->db->where('id', $user);

        $this->db->update('groupes');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('groupes');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('groupes');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('groupes');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('groupes');
        return true;
    }

    public function connectgroupes()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("groupes", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordgroupes($groupes)
    {
        $this->passgroupes = sha1($_POST['password']);
        $query = $this->db->get_where("groupes", array('id' => $groupes, 'passgroupes' => $this->passgroupes));
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

    public function getgroupesByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("groupes", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getgroupesByElemt($id, $ele)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("groupes", array($ele => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->getgroupesByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAllgroupesLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("groupes", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAllgroupesByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("groupes", array('status!=' => $id));
        return $query->result();
    }

    public function getgroupesByEmail($id)
    {
        $this->emailgroupes = $id;

        $query = $this->db->get_where("groupes", array('emailgroupes' => $this->emailgroupes));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->getgroupesByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
