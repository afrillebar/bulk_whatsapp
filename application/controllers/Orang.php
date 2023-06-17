<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_orang"); //load model orang
    }
    public function index()
    {
        $data["title"] = "List Data Orang";
        $data["data_orang"] = $this->M_orang->getAll();

        $this->load->view('_partials/header', $data);
        $this->load->view('v_orang', $data);
        $this->load->view('_partials/footer');
    }

    //method add digunakan untuk menampilkan form tambah data orang
    public function add()
    {
        $orang = $this->M_orang; //objek model
        $validation = $this->form_validation; //objek form validation
        $validation->set_rules($orang->rules()); //menerapkan rules validasi pada orang_model
        //kondisi jika semua kolom telah divalidasi, maka akan menjalankan method save pada orang_model
        if ($validation->run()) {
            $orang->save();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data orang berhasil disimpan. 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
            redirect("orang");
        }
        $data["title"] = "Tambah Data orang";
        $this->load->view('_partials/header', $data);
        $this->load->view('v_orang_add', $data);
        $this->load->view('_partials/footer');
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('orang');

        $orang = $this->M_orang;
        $validation = $this->form_validation;
        $validation->set_rules($orang->rules());

        if ($validation->run()) {
            $orang->update();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data orang berhasil disimpan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
            redirect("orang");
        }
        $data["title"] = "Edit Data orang";
        $data["data_orang"] = $orang->getById($id);
        if (!$data["data_orang"]) show_404();
        $this->load->view('_partials/header', $data);
        $this->load->view('v_orang_edit', $data);
        $this->load->view('_partials/footer');
    }

    public function delete()
    {
        $id = $this->input->get('id');
        if (!isset($id)) show_404();
        $this->M_orang->delete($id);
        $msg['success'] = true;
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data orang berhasil dihapus.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
        $this->output->set_output(json_encode($msg));
    }
}
