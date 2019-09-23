<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 

class Ngoding extends CI_Controller {

               

                function index(){

                                $this->load->library('sobatjagoan');

                                $this->sobatjagoan->nama_saya();

                echo "<br/>";

                $this->sobatjagoan->nama_kamu("Andi");

                }

 

}