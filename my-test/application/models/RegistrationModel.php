<?php

class RegistrationModel extends CI_Model
{
    protected $outputData = array('type' => 'error', 'msg' => 'Default oyuioputput');
      
    function insert($param_1){
        $validation = array(
            array(
                'field' => 'firstName',
                'label' => 'First Name',
                'rules' => 'required|alpha'
            ),
            array(
                'field' => 'lastName',
                'label' => 'Last Name',
                'rules' => 'required|alpha'
            ),
            array(
                'field' => 'email',
                'label' => "Email",
                'rules' => 'required|valid_email'
            ),
            array(
                'field' => 'password',
                'label' => "Password",
                'rules' => 'required|min_length[8]|max_length[16] '
            ),
            array(
                'field' => 'hobbies[]',
                'label' => "Hobbies",
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($validation);
        if ($this->form_validation->run()) {
            $hobbies = $this->input->post("hobbies[]");

            if (count($hobbies) >= 2) {
                $img = $_FILES["profilePic"]["name"];

                if (!empty($img)) {

                    $vars = array(
                        'firstName' => $this->input->post("firstName"),
                        'lastName' => $this->input->post("lastName"),
                        'email' => $this->input->post("email"),
                        'password' => md5($this->input->post("password")),
                        'profilePic' => null,
                        'hobbies' => implode(",", $hobbies),
                        'createTime' => date("Y-m-d h:i:s"),
                    );

                    $this->db->trans_start();

                    $this->db->set($vars)->insert("users");
                    if ($this->db->affected_rows() > 0) {
                        $id = $this->db->insert_id();

                        $config['upload_path'] = 'uploads/profile/';
                        $config['overwrite'] = true;
                        $config['allowed_types'] = 'jpg|png';
                        $config['max_size'] = 300;
                        $config['file_name'] = "$id-profile-img." . strtolower(pathinfo($_FILES['profilePic']['name'], PATHINFO_EXTENSION));

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('profilePic')) {
                            $error = array('error' => $this->upload->display_errors());

                            $this->outputData['type'] = 'error';
                            $this->outputData['swal'] = array(
                                'title' => 'Error',
                                'type' => 'error',
                                'html' => $error['error'],
                            );

                            $this->db->trans_rollback();

                        } else {
                            $this->db->set("profilePic", $config["file_name"])->where("id", $id)->update("users");
                            $this->outputData['type'] = 'success';
                            $this->outputData['swal'] = array(
                                'title' => 'Good Job!',
                                'type' => 'success',
                                'html' => "Registration Successfully.",
                            );

                            $this->db->trans_complete();
                        }
                    } else {
                        $this->outputData['type'] = 'error';
                        $this->outputData['swal'] = array(
                            'title' => 'Error',
                            'type' => 'error',
                            'html' => 'Try Again',
                        );
                    }

                } else {
                    $this->outputData['type'] = 'error';
                    $this->outputData['swal'] = array(
                        'title' => 'Error',
                        'type' => 'error',
                        'html' => 'Select any img',
                    );
                }

            } else {
                $this->outputData['type'] = 'error';
                $this->outputData['data'] = $hobbies;

                $this->outputData['swal'] = array(
                    'title' => 'Error',
                    'type' => 'error',
                    'html' => 'Select hobbies 2',
                );
            }


        } else {
            $this->outputData['msg'] = 'error';
            $this->outputData['swal'] = array(
                'title' => 'Error',
                'type' => 'error',
                'html' => $this->form_validation->error_string(),
            );
        }
        return $this->outputData;
    }

//    update---

    function update()
    {
        $validation = array(
            array(
                'field' => 'firstName',
                'label' => 'First Name',
                'rules' => 'required|alpha'
            ),
            array(
                'field' => 'lastName',
                'label' => 'Last Name',
                'rules' => 'required|alpha'
            ),
            array(
                'field' => 'email',
                'label' => "Email",
                'rules' => 'required|valid_email'
            ),
            array(
                'field' => 'hobbies[]',
                'label' => "Hobbies",
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($validation);
        if ($this->form_validation->run()) {
            $id = $this->input->post("id");
            $hobbies = $this->input->post("hobbies[]");

            if (count($hobbies) >= 2) {
                $img = $_FILES["profilePic"]["name"];

                if (!empty($img)) {

                    $config['upload_path'] = 'uploads/profile/';
                    $config['overwrite'] = true;
                    $config['allowed_types'] = 'jpg|png';
                    $config['max_size'] = 300;
                    $config['file_name'] = "$id-profile-img." . strtolower(pathinfo($_FILES['profilePic']['name'], PATHINFO_EXTENSION));

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('profilePic')) {
                        $error = array('error' => $this->upload->display_errors());

                        $this->outputData['type'] = 'error';
                        $this->outputData['swal'] = array(
                            'title' => 'Error',
                            'type' => 'error',
                            'html' => $error['error'],
                        );

                    } else {
                        $vars = array(
                            'firstName' => $this->input->post("firstName"),
                            'lastName' => $this->input->post("lastName"),
                            'email' => $this->input->post("email"),
                            'hobbies' => implode(",", $hobbies)
                        );

                        $this->db->set($vars)->where("id", $id)->update("users");
                        $this->outputData['type'] = 'success';
                        $this->outputData['redirect'] = true;
                        $this->outputData['url'] = base_url("registration");
                        $this->outputData['swal'] = array(
                            'title' => 'Good Job!',
                            'type' => 'success',
                            'html' => "Update Successfully.",
                        );
                    }

                } else {
                    $vars = array(
                        'firstName' => $this->input->post("firstName"),
                        'lastName' => $this->input->post("lastName"),
                        'email' => $this->input->post("email"),
                        'hobbies' => implode(",", $hobbies)
                    );

                    $this->db->set($vars)->where("id", $id)->update("users");
                    $this->outputData['type'] = 'success';
                    $this->outputData['redirect'] = true;
                    $this->outputData['url'] = base_url("registration");
                    $this->outputData['swal'] = array(
                        'title' => 'Good Job!',
                        'type' => 'success',
                        'html' => "Update Successfully.",
                    );
                }

            } else {
                $this->outputData['type'] = 'error';
                $this->outputData['data'] = $hobbies;

                $this->outputData['swal'] = array(
                    'title' => 'Error',
                    'type' => 'error',
                    'html' => 'Select hobbies 2',
                );
            }


        } else {
            $this->outputData['msg'] = 'error';
            $this->outputData['swal'] = array(
                'title' => 'Error',
                'type' => 'error',
                'html' => $this->form_validation->error_string(),
            );
        }
        return $this->outputData;

    }


//    delete---
    function delete()
    {
        $validation = array(
            array(
                'field' => 'id',
                'label' => 'Id',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($validation);
        if ($this->form_validation->run()) {

            $id = $this->input->post("id");
            $res = $this->db->select("id, profilePic")->where("id", $id)->get("users")->result()[0];
            if ($this->db->affected_rows() > 0) {
                if (file_exists("uploads/profile/" . $res->profilePic)) {
                    unlink("uploads/profile/" . $res->profilePic);
                }


                $this->db->where("id", $id)->delete("users");
                if ($this->db->affected_rows() > 0) {
                    $this->outputData['type'] = 'success';
                }

            } else {
                $this->outputData['type'] = 'error';
                $this->outputData['swal'] = array(
                    'title' => 'Error',
                    'type' => 'error',
                    'html' => "Profile Not delete",
                );
            }

        } else {
            $this->outputData['type'] = 'error';
            $this->outputData['swal'] = array(
                'title' => 'Error',
                'type' => 'error',
                'html' => $this->form_validation->error_string(),
            );
        }
        return $this->outputData;

    }
    
    
}