<?php
defined('BASEPATH') or exit('No direct script access allowed');

class tutos extends CI_Model
{
    public $id;
    public $Mat_id;
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

    public function getAlltutos()
    {
        $query = $this->db->get("tutos");
        return $query->result();
    }

    public function countAlltutos()
    {
        $query = $this->db->get_where("tutos", array("status" => 0));
        return $query->num_rows();
    }

    public function checkIfuserExist($code)
    { // please read the below note
        $query = $this->db->get_where("tutos", array("emailtutos" => $_POST['email']));
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
        $query = $this->db->get_where("tutos", array("emailtutos" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("tutos", array("logintutos" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->inserttutos($code) == true) {
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
        $query = $this->db->get_where("tutos", array("emailtutos" => $_POST['email']));
        if ($query->num_rows() == 0) {
            $query2 = $this->db->get_where("tutos", array("logintutos" => $_POST['login']));
            if ($query2->num_rows() == 0) {
                if ($this->inserttutos2($code) == true) {
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
        $this->db->set('passtutos', $code);
        $this->db->where('emailtutos', $_POST["email"]);
        if ($this->db->update("tutos")) {
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($code)
    {
        $this->db->set('status', 0);
        $this->db->where('status', $code);
        if ($this->db->update("tutos")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function changePassword($code)
    {
        $this->db->set('passtutos', sha1($_POST["pass2"]));
        $this->db->where('passtutos', $code);
        if ($this->db->update("tutos")) {
            return 'ok';
        } else {
            return false;
        }
    }

    public function inserttutos($code)
    {
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passtutos = sha1($_POST['password']);
        $this->datetutos = date("Y-m-d");
        $this->logintutos = $_POST['login'];
        $this->nomtutos = $_POST['nom'];
        $this->prenomtutos = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numerotutos = $_POST['tel'];
        $this->emailtutos = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("tutos", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function inserttutos2($code)
    {
        $this->db->select_max("id");
        $id = $this->db->get("tutos");
    /////////////// ===================== /////////////////////////
        $this->id = $id;
        $this->idPays = $_POST['pays']; // please read the below note
        $this->passtutos = sha1($_POST['password']);
        $this->datetutos = date("Y-m-d");
        $this->logintutos = $_POST['login'];
        $this->nomtutos = $_POST['nom'];
        $this->prenomtutos = $_POST['prenom'];
        $this->role = $_POST['role'];
        $this->numerotutos = $_POST['tel'];
        $this->emailtutos = $_POST['email'];
        $this->matricule = 1;
        $this->status = $code;

        if ($this->db->insert("tutos", $this)) {
            return true;
        } else {
            return false;
        }
    }

    public function edittutos($user)
    {
        $this->db->set('idPays', $_POST['idPays']); // please read the below note
        $this->db->set('logintutos', $_POST['logintutos']);
        $this->db->set('nomtutos', $_POST['nomtutos']);
        $this->db->set('prenomtutos', $_POST['prenomtutos']);
        $this->db->set('numerotutos', $_POST['numerotutos']);
        $this->db->set('emailtutos', $_POST['emailtutos']);
        $this->db->set('bptutos', $_POST['bptutos']);
        $this->db->set('autre', $_POST['autre']);

        $this->db->where('id', $user);
        if ($this->db->update("tutos")) {
            return true;
        } else {
            return false;
        }
    }

    public function editPassword($user, $code)
    {
        $this->db->set('passtutos', sha1($_POST["pass3"])); // please read the below note
        $this->db->set('status', $code);
        $this->db->where('id', $user);

        $this->db->update('tutos');
        return true;
    }

    public function updateImage($lien, $user)
    {
        $this->db->set('phototutos', $lien); // please read the below note
        //$this->db->set('datetutos', time());
        $this->db->where('id', $user);

        $this->db->update('tutos');
        return true;
    }

    public function basculeRole($user, $role)
    {
        $this->db->set('role', $role); // please read the below note
        $this->db->where('id', $user);

        $this->db->update('tutos');
        return true;
    }

    public function poweroff_entry($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('tutos');
        return true;
    }

    public function poweron_entry($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('tutos');
        return true;
    }

    public function delete_entry($id)
    {
        $this->db->set('status', 3);
        $this->db->where('id', $id);
        $this->db->update('tutos');
        return true;
    }

    public function connecttutos()
    {
        $this->password = sha1($_POST['password']);
        $this->matricule = $_POST['matricule'];
        $query = $this->db->get_where("tutos", array('matricule' => $this->matricule, 'password' => $this->password));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkPasswordtutos($tutos)
    {
        $this->passtutos = sha1($_POST['password']);
        $query = $this->db->get_where("tutos", array('id' => $tutos, 'passtutos' => $this->passtutos));
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

    public function gettutosByID($id)
    {
        $this->id = $id;
        $this->status = 3;

        $query = $this->db->get_where("tutos", array('id' => $this->id));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneData($id, $value)
    {
        foreach ($this->gettutosByID($id) as $row):
            return $row->$value;
        endforeach;
    }

    public function getAlltutosLimit($min, $max)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("tutos", array('status !=' => 3), $max);
        return $query->result();
    }

    public function getAlltutosByStatus($id)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where("tutos", array('status!=' => $id));
        return $query->result();
    }

    public function gettutosByEmail($id)
    {
        $this->emailtutos = $id;

        $query = $this->db->get_where("tutos", array('emailtutos' => $this->emailtutos));
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneDatabyEmail($id, $value)
    {
        foreach ($this->gettutosByID($id) as $row):
            return $row->$value;
        endforeach;
    }
}
