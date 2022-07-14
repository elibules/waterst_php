<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

    public function index()
    {
        $data["page_title"] = "Login or Make an Account";
        $this->load->view('templates/head', $data);
        $this->load->view('auth/login_register', $data);
        $this->load->view('templates/foot');
    }

    public function login()
    {
        $credentials = $this->input->post();
        $data["message"] = $this->auth_model->login($credentials);
        $data["page_title"] = "Message Below";
        $this->load->view('templates/head', $data);
        $this->load->view('auth/message', $data);
        $this->load->view('templates/foot');
    }

    public function register()
    {
        $credentials = $this->input->post();
        $data["message"] = $this->auth_model->register($credentials);
        $data["page_title"] = "Message Below";
        $this->load->view('templates/head', $data);
        $this->load->view('auth/message', $data);
        $this->load->view('templates/foot');
    }

    public function logout()
    {
        $data["message"] = "You've been logged out";
        $data["page_title"] = "Logged Out";
        $this->session->sess_destroy();
        $data["status"] = "0";
        $this->load->view('templates/head', $data);
        $this->load->view('auth/message', $data);
        $this->load->view('templates/foot');
    }

    public function reset()
    {
        $data["page_title"] = "Reset Password";
        $this->load->view('templates/head', $data);
        $this->load->view('auth/reset', $data);
        $this->load->view('templates/foot');
    }

    public function do_reset()
    {
        $credentials = $this->input->post();
        $data["page_title"] = "Message Below";
        $data["message"] = $this->auth_model->do_reset($credentials);
        $this->load->view('templates/head', $data);
        $this->load->view('auth/message', $data);
        $this->load->view('templates/foot');
    }
}
