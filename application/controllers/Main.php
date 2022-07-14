<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
    }

    public function index()
    {
        $data["page_title"] = "Water St. CD & Vinyl";
        $data["this_page"] = "home";
        $this->load->view('templates/head', $data);
        $this->load->view('index', $data);
        $this->load->view('templates/foot', $data);
    }
    public function contact()
    {
        $data["page_title"] = "Contact Us!";
        $this->load->view('templates/head', $data);
        $this->load->view('main/contact', $data);
        $this->load->view('templates/foot', $data);
    }

    public function profile()
    {
        $data["page_title"] = "Profile";
        $data["orders"] = $this->main_model->getOrders();
        $this->load->view('templates/head', $data);
        $this->load->view('main/profile', $data);
        $this->load->view('templates/foot', $data);
    }

    public function sendMessage()
    {
        $data["page_title"] = "New Message Below";
        $data["message"] = $this->main_model->sendMessage();
        $this->load->view('templates/head', $data);
        $this->load->view('templates/message', $data);
        $this->load->view('templates/foot', $data);
    }

    public function getMessages()
    {
        $data["page_title"] = "User Messages";
        $data["messages"] = $this->main_model->getMessages();
        $this->load->view('templates/head', $data);
        $this->load->view('main/messages', $data);
        $this->load->view('templates/foot', $data);
    }
}
