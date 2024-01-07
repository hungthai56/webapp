<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Media extends CI_Controller
{
    public function lang()
    {
        $lang = "";
        if (isset($_GET['lang'])) {
            $lang .= $_GET['lang'];
        } else {
            $lang .= "en";
        }

        return $lang;
    }

    public function arr_lang()
    {
        $arr = ["en", "vi", "kr", "jp"];
        return $arr;
    }

    public function __construct()
    {
        parent::__construct();
        // user access
        is_logged_in();
    }

    public function banner()
    {
        $data['title'] = 'Update Banner';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['banner'] = $this->db->get_where('banner')->row_array();

        $this->form_validation->set_rules('title', 'Title', 'required', [
            'required' => 'Full name is required!'
        ]);

        $this->form_validation->set_rules('text', 'Text', 'required', [
            'required' => 'Full name is required!'
        ]);

        $this->form_validation->set_rules('url', 'Url', 'required', [
            'required' => 'Full name is required!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('media/banner', $data);
            $this->load->view('templates/admin_footer');
        } else {

            // upload image
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = '6000';
                $config['upload_path'] = './assets/img/banner/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['banner']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . '/assets/img/banner/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data = [
                'id' => $this->input->post('id'),
                'title' => $this->input->post('title'),
                'text' => $this->input->post('text'),
                'url' => $this->input->post('url'),
            ];

            // var_dump($data);
            // return;

            $this->db->update('banner', $data, ['id' => $data['id']]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Profile changed successfully!</div>');
            redirect('media/banner');
        }

    }

    // media intro
    public function media_intro()
    {
        $data['title'] = 'Media Intro Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['media_intro'] = $this->db->get_where('media_intro', ['lang' => $this->lang()])->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('media/media_intro', $data);
        $this->load->view('templates/admin_footer');
    }

    public function edit_media_intro($id = null)
    {
        $data['title'] = 'Update Banner';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['banner'] = $this->db->get_where('banner')->row_array();
        $data['media_intro'] = $this->db->get_where('media_intro', ['id' => $id])->row_array();

        $this->form_validation->set_rules('title', 'Title', 'required', [
            'required' => 'Full name is required!'
        ]);

        $this->form_validation->set_rules('text', 'Text', 'required', [
            'required' => 'Full name is required!'
        ]);

        $this->form_validation->set_rules('url', 'Url', 'required', [
            'required' => 'Full name is required!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('media/edit_media_intro', $data);
            $this->load->view('templates/admin_footer');
        } else {

            // upload image
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = '6000';
                $config['upload_path'] = './assets/img/media/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['media_intro']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . '/assets/img/media/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data = [
                'id' => $this->input->post('id'),
                'title' => $this->input->post('title'),
                'text' => $this->input->post('text'),
                'url' => $this->input->post('url'),
            ];

            // var_dump($data);
            // return;

            $this->db->update('media_intro', $data, ['id' => $data['id']]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Profile changed successfully!</div>');
            redirect('media/media_intro');
        }

    }

    // infowebsite
    public function infowebsite()
    {
        $data['title'] = 'Update Info';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['info'] = $this->db->get_where('info', ['lang' => $this->lang()])->row_array();
        $data['lang'] = $this->lang();
        // var_dump($data);
        // return;

        $this->form_validation->set_rules('slogan', 'Slogan', 'required', [
            'required' => 'Full name is required!'
        ]);

        $this->form_validation->set_rules('email', 'Email', 'required', [
            'required' => 'Full name is required!'
        ]);

        $this->form_validation->set_rules('phone', 'Phone', 'required', [
            'required' => 'Full name is required!'
        ]);

        $this->form_validation->set_rules('text_footer', 'Text_footer', 'required', [
            'required' => 'Full name is required!'
        ]);

        $this->form_validation->set_rules('map', 'Map', 'required', [
            'required' => 'Full name is required!'
        ]);

        $this->form_validation->set_rules('titleinstall', 'Title Install', 'required', [
            'required' => 'Full name is required!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('media/infowebsite', $data);
            $this->load->view('templates/admin_footer');
        } else {
            // upload image
            $upload_image = $_FILES['logo']['name'];
            $upload_avt = $_FILES['avt']['name'];
            $upload_imageinstall = $_FILES['imageinstall']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = '6000';
                $config['upload_path'] = './assets/img/info/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('logo')) {
                    $old_image = $data['info']['logo'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . '/assets/img/info/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('logo', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            if ($upload_avt) {
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = '6000';
                $config['upload_path'] = './assets/img/info/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('avt')) {
                    $old_image = $data['info']['avt'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . '/assets/img/info/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('avt', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            if ($upload_imageinstall) {
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = '6000';
                $config['upload_path'] = './assets/img/info/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('imageinstall')) {
                    $old_image = $data['info']['imageinstall'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . '/assets/img/info/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('imageinstall', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            // return;
            $data = [
                'id' => $this->input->post('id'),
                'slogan' => $this->input->post('slogan'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'text_footer' => $this->input->post('text_footer'),
                'map' => $this->input->post('map'),
                'titleinstall' => $this->input->post('titleinstall'),
                'lang' => $this->lang()
            ];

            // var_dump($data);
            // return;

            $this->db->update('info', $data, ['id' => $data['id']]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Profile changed successfully!</div>');
            redirect('media/infowebsite?lang=' . $this->lang());
        }

    }
}