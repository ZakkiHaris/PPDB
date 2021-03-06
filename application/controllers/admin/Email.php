<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Email');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('encryption');
    }

	public function index($page = 'email'){
        $session = $this->session->userdata('login'); 
        if($session != 'login'){
            $this->load->view('admin/login');
        }else{ 
            $data["jumlahPesan"] = $this->M_Email->jumlahPesan();
            $data["email"] = $this->M_Email->getAll();
            
                $this->load->view("admin/_partials/header");
                $this->load->view("admin/_partials/navbar", $data);
                $this->load->view("admin/".$page, $data);
                $this->load->view("admin/_partials/footer.php");
                $this->load->view("admin/_partials/modal");
                $this->load->view("admin/_partials/js.php");
        }
    }

    public function kirim()
    {
        $email = $this->M_Email;;
        $validation = $this->form_validation;
        $validation->set_rules($email->rules());

        if($validation->run()){
            $email->send();
            $this->session->set_flashdata('success', 'Email Berhasil Dikirim');
        }
            redirect(base_url());
    }

    public function detailEmail()
    {   
        $session = $this->session->userdata('login'); 
        if($session != 'login'){
            $this->load->view('admin/login');
        }else{ 
            $id=$this->uri->segment(4);
            $data["jumlahPesan"] = $this->M_Email->jumlahPesan();   
            $data["detailEmail"] = $this->M_Email->id($id);
            $this->load->view("admin/_partials/header");
            $this->load->view("admin/_partials/navbar", $data);
            $this->load->view("admin/detailEmail", $data);
            $this->load->view("admin/_partials/footer.php");
            $this->load->view("admin/_partials/modal");
            $this->load->view("admin/_partials/js.php");
        }
        
    }  

    public function tulisBalas()
    {   
        $session = $this->session->userdata('login'); 
        if($session != 'login'){
            $this->load->view('pages/login');
        }else{
            $id=$this->uri->segment(4);
            $data["detailEmail"] = $this->M_Email->id($id);
            $data["getEmail"] = $this->M_Email->getEmail($id);
            $this->load->view("admin/_partials/header");
            $this->load->view("admin/_partials/navbar");
            $this->load->view("admin/balasEmail", $data);
            $this->load->view("admin/_partials/footer.php");
            $this->load->view("admin/_partials/modal");
            $this->load->view("admin/_partials/js.php");
        }  
    }

    public function balas()
    {   
        $id = $this->input->post('id');
        $sekolah = $this->input->post('sekolah');
        $emailDari = $this->input->post('emailDari');
        $password = $this->encryption->decrypt($this->input->post('password_email'));
        $emailKepada = $this->input->post('emailKepada');
        $nama = $this->input->post('nama');
        $subjek = $this->input->post('subjek');
        $konten = $this->input->post('konten');
        $pesan = $this->input->post('pesan');

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => $emailDari,
            'smtp_pass' => $password,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
        );
        

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($emailDari, $sekolah);
        $this->email->to($emailKepada);
        $this->email->subject($subjek);
        $this->email->message($konten);
        
        $this->email->send();
        $this->M_Email->UpdateEmail($id, 'id');
        

        
        redirect(site_url('admin/email'));

    }

    function delete_multiple() {
        $this->load->model('M_Email');
        $this->M_Email->remove_checked_email();
        redirect('admin/email');
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->M_Email->delete($id)) {
            redirect(site_url('admin/email'));
        }
    }
}
