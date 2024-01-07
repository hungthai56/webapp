<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {

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
    // index view web
    public function index()
    {
        $data['title'] = 'Web App';
        $data['user_menu'] = $this->db->order_by('id', 'ASC');
        $data['user_menu'] = $this->db->get_where('user_menu', ['role' => 2])->result_array();
        $data['banner'] = $this->db->get_where('banner')->result_array();
        $data['media_intro'] = $this->db->get_where('media_intro', ['lang' => $this->lang()])->result_array();
        $query = "SELECT video_manager.id, video_manager.youtube_link, video_manager.note, video_manager.user_create, video_manager.date_create,video_manager.group_id,video_group.name FROM video_manager JOIN video_group ON video_group.id = video_manager.group_id Group by video_manager.group_id ORDER BY video_group.name DESC";
        $data['video_manager'] = $this->db->query($query)->result_array();
        $data['info'] = $this->db->get_where('info', ['lang' => $this->lang()])->result_array();

        $this->load->view('templates/home_header', $data);
        $this->load->view('home/index');
        $this->load->view('templates/home_footer', $data);
    }



}