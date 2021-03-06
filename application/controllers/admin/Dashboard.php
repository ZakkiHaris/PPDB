<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Siswa');
        $this->load->library('form_validation');
    }

	public function index(){
        $session = $this->session->userdata('login'); 
        if($session != 'login'){
            $this->load->view('pages/login');
        }else{ 
            $data["jumlahSiswa"] = $this->M_Siswa->jumlahSiswa();
            $data["jumlahDiterima"] = $this->M_Siswa->jumlahDiterima();
            $data["jumlahDitolak"] = $this->M_Siswa->jumlahDitolak();

            $this->load->view("admin/_partials/header");     
            $this->load->view("admin/_partials/navbar");
            $this->load->view("admin/dashboard", $data);
            $this->load->view("admin/_partials/modal");
            $this->load->view("admin/_partials/js");
            $this->load->view("admin/_partials/footer");
        }
    }


    public function user()
    {
        $data['user'] = $this->admin->hitungJumlahUser();
 
        $this->load->view('dashboard', $data);

        var_dumb($data);
        exit;
    }

}
