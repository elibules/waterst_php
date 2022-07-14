<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //this causes the database library to be autoloaded
        //loading of any other models would happen here   
    }

    public function getOrders()
    {
        $sql = "select * from orders where user_id = " . $this->session->user_id;

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function sendMessage()
    {

        $name = filter_input(INPUT_POST, 'contactName', FILTER_DEFAULT);
        $email = filter_input(INPUT_POST, 'contactEmail', FILTER_DEFAULT);
        $message = filter_input(INPUT_POST, 'contactMessage', FILTER_DEFAULT);

        if (empty($name) || empty($email) || empty($message)) {
            return 'Missing fields, <a href="' . site_url() . '/main/contact">try again</a>';
        }

        $sql = "INSERT into messages (`name`, `email`, `message_body`) values ('$name', '$email', '$message')";

        $query =  $this->db->query($sql);
        if ($query) return "Message sent!";
        else return "Message not recieved, please try later.";
    }

    public function getMessages()
    {
        $sql = "select * from messages";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}