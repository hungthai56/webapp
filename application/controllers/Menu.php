<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
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

    // index view menu
    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('templates/admin_footer');
    }

    // add menu
    public function addmenu()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required', [
            'required' => 'Menu name cannot be empty!'
        ]);

        $this->form_validation->set_rules('role', 'Role', 'required', [
            'required' => 'Menu name cannot be empty!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu'), 'role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New menu added!</div>');
            redirect('menu');
        }
    }

    // edit menu
    public function editmenu($id = null)
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required', [
            'required' => 'Menu name cannot be empty!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Menu Management';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['menu'] = $this->db->get_where('user_menu', ['id' => $id])->row_array();

            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('menu/edit_menu', $data);
            $this->load->view('templates/admin_footer');
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Failed to change menu!</div>');
        } else {
            $data = [
                'id' => $this->input->post('id'),
                'menu' => $this->input->post('menu')
            ];

            $this->db->update('user_menu', $data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Successfully changed menu!</div>');
            redirect('menu');
        }
    }

    // delete menu
    public function deletemenu($id = null)
    {
        $this->db->delete('user_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Menu deleted successfully!</div>');
        redirect('menu');
    }

    // index view sub menu
    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->model('Menu_model', 'menu');
        $data['submenu'] = $this->menu->getSubMenu();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('menu/submenu', $data);
        $this->load->view('templates/admin_footer');
    }

    // add sub menu
    public function addsubmenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->model('Menu_model', 'menu');
        $data['submenu'] = $this->menu->getSubMenu();

        $this->form_validation->set_rules('title', 'Submenu', 'required', [
            'required' => 'Submenu cannot be empty!'
        ]);
        $this->form_validation->set_rules('menu_id', 'Menu', 'required', [
            'required' => 'The menu must be chosen!'
        ]);
        $this->form_validation->set_rules('url', 'Url', 'required', [
            'required' => 'Url cannot be empty!'
        ]);
        $this->form_validation->set_rules('icon', 'Icon', 'required', [
            'required' => 'Icon cannot be empty!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];

            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Submenu data added successfully!</div>');
            redirect('menu/submenu');
        }
    }

    // edit sub menu
    public function editsubmenu($id = null)
    {
        $this->form_validation->set_rules('title', 'Submenu', 'required', [
            'required' => 'The submenu cannot be empty!'
        ]);
        $this->form_validation->set_rules('menu_id', 'Menu', 'required', [
            'required' => 'Menu must be selected!'
        ]);
        $this->form_validation->set_rules('url', 'Url', 'required', [
            'required' => 'Url cannot be empty!'
        ]);
        $this->form_validation->set_rules('icon', 'Icon', 'required', [
            'required' => 'Icon cannot be empty!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->model('Menu_model', 'menu');
            $data['title'] = 'Submenu Management';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['menu'] = $this->db->get('user_menu')->result_array();
            $data['submenu'] = $this->menu->getSubMenu();
            $data['submenu'] = $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();

            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('menu/edit_submenu', $data);
            $this->load->view('templates/admin_footer');
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Failed to change submenu data!</div>');
        } else {
            $data = [
                'id' => $this->input->post('id'),
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];

            $this->db->update('user_sub_menu', $data, ['id' => $data['id']]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Successfully changed submenu data!</div>');
            redirect('menu/submenu');
        }
    }

    // delete sub menu
    public function deletesubmenu($id = null)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Submenu successfully removed!</div>');
        redirect('menu/submenu');
    }


    // video manager
    public function video_menu()
    {
        $data['title'] = 'Video Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['video_manager'] = $this->db->order_by('id', 'DESC');
        $data['video_manager'] = $this->db->get_where('video_manager', ['lang' => $this->lang()])->result_array();
        $data['group'] = $this->db->get('video_group')->result_array();

        $query = "SELECT `video_manager`.`id`, `video_manager`.`youtube_link`, `video_manager`.`note`, `video_manager`.`user_create`, `video_manager`.`date_create`,`video_group`.`name` FROM `video_manager` JOIN `video_group` ON `video_group`.`id` = `video_manager`.`group_id` where `video_manager`.`lang` = '".$this->lang()."'";
        $data['video_manager'] = $this->db->query($query)->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('menu/video_menu', $data);
        $this->load->view('templates/admin_footer');
    }

    // add menu
    public function add_video_menu()
    {
        $data['title'] = 'Video Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['video_manager'] = $this->db->get_where('video_manager', ['lang' => $this->lang()])->result_array();

        $this->form_validation->set_rules('group_id', 'GroupId', 'required', [
            'required' => 'Menu name cannot be empty!'
        ]);

        $this->form_validation->set_rules('youtube_link', 'YoutubeLink', 'required', [
            'required' => 'Menu name cannot be empty!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('menu/video_menu', $data);
            $this->load->view('templates/admin_footer');
        } else {
            foreach ($this->arr_lang() as $key => $value) {
                $data = [
                    'group_id' => $this->input->post('group_id'),
                    'youtube_link' => $this->input->post('youtube_link'),
                    'note' => $this->input->post('note'),
                    'user_create' => 27,
                    'date_create' => date("Y-m-d"),
                    'lang' => $value
                ];
                $this->db->insert('video_manager', $data);
            }

            if ($this->db->affected_rows() > 0) {
                redirect('menu/video_menu');
            }
           
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Submenu data added successfully!</div>');
            
        }
    }

    // edit menu
    public function edit_video_menu($id = null)
    {
        $this->form_validation->set_rules('group_id', 'GroupId', 'required', [
            'required' => 'Menu name cannot be empty!'
        ]);

        $this->form_validation->set_rules('youtube_link', 'YoutubeLink', 'required', [
            'required' => 'Menu name cannot be empty!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Video Management';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['video_manager'] = $this->db->get_where('video_manager', ['id' => $id])->row_array();
            $data['group'] = $this->db->get('video_group')->result_array();

            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('menu/edit_video_menu', $data);
            $this->load->view('templates/admin_footer');
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Failed to change menu!</div>');
        } else {
            $data = [
                'id' => $this->input->post('id'),
                'group_id' => $this->input->post('group_id'),
                'youtube_link' => $this->input->post('youtube_link'),
                'note' => $this->input->post('note'),
            ];

            $this->db->update('video_manager', $data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Successfully changed menu!</div>');
            redirect('menu/video_menu');
        }
    }

    // delete menu
    public function delet_video_menu($id = null)
    {
        $this->db->delete('video_manager', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Menu deleted successfully!</div>');
        redirect('menu/video_menu');
    }


    // manager group video
    public function video_group()
    {
        $data['title'] = 'Video Group';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['video_group'] = $this->db->order_by('id', 'DESC');
        $data['video_group'] = $this->db->get('video_group')->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('menu/video_group', $data);
        $this->load->view('templates/admin_footer');
    }

    // add menu
    public function addvideo_group()
    {
        $data['title'] = 'Group Video Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['video_group'] = $this->db->get('video_group')->result_array();

        $this->form_validation->set_rules('groupname', 'GroupName', 'required', [
            'required' => 'Menu name cannot be empty!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('menu/video_group', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->db->insert('video_group', ['name' => $this->input->post('groupname')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New menu added!</div>');
            redirect('menu/video_group');
        }
    }

    // edit menu
    public function edit_video_group($id = null)
    {
        $this->form_validation->set_rules('groupname', 'GroupName', 'required', [
            'required' => 'Menu name cannot be empty!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Group Video Management';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['videogr'] = $this->db->get_where('video_group', ['id' => $id])->row_array();

            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('menu/edit_video_group', $data);
            $this->load->view('templates/admin_footer');
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Failed to change menu!</div>');
        } else {
            $data = [
                'id' => $this->input->post('id'),
                'name' => $this->input->post('groupname')
            ];
            // var_dump($data); return;
            $this->db->update('video_group', $data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Successfully changed menu!</div>');
            redirect('menu/video_group');
        }
    }

    // delete menu
    public function delet_video_group($id = null)
    {
        $this->db->delete('video_group', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Menu deleted successfully!</div>');
        redirect('menu/video_group');
    }

}