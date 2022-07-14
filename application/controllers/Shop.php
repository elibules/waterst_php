<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shop extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('shop_model');
    }

    public function index()
    {
        $data["page_title"] = "Shop All";
        $data["products"] = $this->shop_model->all();
        $this->load->view('templates/head', $data);
        $this->load->view('shop/shop', $data);
        $this->load->view('templates/foot', $data);
    }

    public function detail($id)
    {
        $data["product"] = $this->shop_model->detail($id);
        $data["page_title"] = "More Detail";
        $this->load->view('templates/head', $data);
        $this->load->view('shop/detail', $data);
        $this->load->view('templates/foot', $data);
    }

    public function cartItem($id)
    {
        echo json_encode($this->shop_model->detail($id));
    }

    public function cart()
    {
        $data["page_title"] = "Your Cart";
        $this->load->view('templates/head', $data);
        $this->load->view('shop/cart', $data);
        $this->load->view('templates/foot', $data);
    }

    public function checkout()
    {
        $order = file_get_contents('php://input');
        $result = $this->shop_model->checkout($order);
        if (!$result) {
            $data["message"] = "You order could not be completed";
            $data["page_title"] = "Message Below";
            $this->load->view('templates/head', $data);
            $this->load->view('templates/message', $data);
            $this->load->view('templates/foot', $data);
        }
    }

    public function filter($terms)
    {
        echo $this->shop_model->filter($terms);
    }
}