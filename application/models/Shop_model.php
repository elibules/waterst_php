<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shop_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //this causes the database library to be autoloaded
        //loading of any other models would happen here   
    }

    public function all()
    {
        $sql = "select inventory.item_id, inventory.title, inventory.artist, inventory.release_date, inventory.price, inventory.image, qualities.quality_name, formats.format_name, categories.category_name from inventory, qualities, formats, categories where inventory.quality_id = qualities.quality_id and inventory.format_id = formats.format_id and inventory.category_id = categories.category_id order by inventory.title";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function detail($id)
    {
        $sql = "select inventory.item_id, inventory.title, inventory.artist, inventory.release_date, inventory.price, inventory.image, qualities.quality_name, formats.format_name, categories.category_name from inventory, qualities, formats, categories where inventory.quality_id = qualities.quality_id and inventory.format_id = formats.format_id and inventory.category_id = categories.category_id and inventory.item_id = " . $id;
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function checkout($order)
    {
        if (isset($this->session->user_id)) {
            $id = $this->session->user_id;
        } else $id = 0;

        $sql = "INSERT INTO `orders`(`order_info`,`user_id`, `fulfilled`) VALUES ('$order', $id, false)";
        $query = $this->db->query($sql);
        if ($query) {
            return true;
        } else
            return false;
    }

    public function filter($terms)
    {
        $formatFilter = "";
        $qualityFilter = "";
        $categoryFilter = "";
        $sortString = " order by ";

        if ($terms != "empty" || $terms != "") {
            $q_count = 0;
            $c_count = 0;
            $termArray = explode("_", $terms);
            foreach ($termArray as $term) {

                if ($term[0] == "f" && !empty($term)) {
                    if ($formatFilter == "") {
                        $formatFilter = " and (";
                    }
                    if ($termArray[0] == $term) {
                        $op = "";
                    } else $op = " or";
                    $term = str_replace("f-", "", $term);
                    $formatFilter .= "$op formats.format_name = '$term'";
                } else if ($term[0] == "q" && !empty($term[0])) {
                    if ($qualityFilter == "") {
                        $qualityFilter = " and (";
                    }
                    if ($q_count == 0) {
                        $q_count++;
                        $op = "";
                    } else $op = " or";
                    $term = str_replace("q-", "", $term);
                    $qualityFilter .= "$op qualities.quality_name = '$term'";
                } else if ($term[0] == "c" && !empty($term[0])) {
                    if ($categoryFilter == "") {
                        $categoryFilter = " and (";
                    }
                    if ($c_count == 0) {
                        $c_count++;
                        $op = "";
                    } else $op = " or";
                    $term = str_replace("c-", "", $term);
                    if ($term != '0') {
                        $categoryFilter .= "$op inventory.category_id = $term";
                    } else $categoryFilter = "";
                } else if ($term[0] == "s" && !empty($term[0])) {
                    $term = str_replace("-", " ", str_replace("s-", "", $term));
                    $sortString .= 'inventory.' . $term;
                }
            }
            if (!$formatFilter == "") $formatFilter .= ")";

            if (!$qualityFilter == "")  $qualityFilter .= ")";

            if (!$categoryFilter == "") $categoryFilter .= ")";

            if ($sortString == " order by ") $sortString .= "inventory.title";
        }



        $sql = "select inventory.item_id, inventory.title, inventory.artist, inventory.release_date, inventory.price, inventory.image, qualities.quality_name, formats.format_name, categories.category_name from inventory, qualities, formats, categories where inventory.quality_id = qualities.quality_id and inventory.format_id = formats.format_id and inventory.category_id = categories.category_id" . $formatFilter . $qualityFilter . $categoryFilter . $sortString;

        $query = $this->db->query($sql);


        return json_encode($query->result_array());
        // return json_encode($sql);
    }
}