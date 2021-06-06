<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webservice extends CI_Controller
{
    protected $outputData = array('type' => 'error', 'msg' => 'Default Output');

    function __destruct()
    {
        header('Content-Type: text/json');

        $this->outputData['_POST'] = $_POST;
        exit(json_encode($this->outputData));
    }

    function registration($case, $param_1 = null)
    {
        switch ($case) {
            case 'insert':
            $this->load->model('RegistrationModel', 'registration');
            $this->outputData = $this->registration->insert($param_1);
            break;
            case 'update' :
            $this->load->model('RegistrationModel', 'registration');
            $this->outputData = $this->registration->update($param_1);
            break;

            case "delete":
            $this->load->model('RegistrationModel', 'registration');
            $this->outputData = $this->registration->delete($param_1);
            break;
        }
    }

    public function get(){
        $this->db->select("course.id as `c_id`, branches.id as `branch_id`, branch_name, GROUP_CONCAT(cName,'|',course.id) as cName, b_id");
        $this->db->join("course", "branches.id = course.b_id");
        $this->db->from("branches");
        $this->db->group_by("branch_name");

        $result = $this->db->get()->result();

        function call ($item){
            return explode('|', $item);
        }

        $this->outputData["type"] = "success";
        $array = explode(',', $result[0]->cName);
        $array = array_map(call, $array);
        $this->outputData["msg"] = $array;
    }

}