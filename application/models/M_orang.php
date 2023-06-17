<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_orang extends CI_Model
{
    private $table = 'tb_orang';

    //validasi form, method ini akan mengembailkan data berupa rules validasi form       
    public function rules()
    {
        return [
            [
                'field' => 'Nama_orang',  //samakan dengan atribute name pada tags input
                'label' => 'Nama_orang',  // label yang kan ditampilkan pada pesan error
                'rules' => 'trim|required' //rules validasi
            ],
            [
                'field' => 'No_telp',
                'label' => 'No_telp',
                'rules' => 'numeric|min_length[9]|max_length[15]'
            ],
        ];
    }

    //menampilkan data orang berdasarkan id orang
    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id_orang" => $id])->row();
        //query diatas seperti halnya query pada mysql 
        //select * from orang where id_orang='$id'
    }

    //menampilkan semua data orang
    public function getAll()
    {
        $this->db->from($this->table);
        $this->db->order_by("id_orang", "asc");
        $this->db->limit(20);
        $query = $this->db->get();
        return $query->result();
        //fungsi diatas seperti halnya query 
        //select * from orang order by id_orang desc
    }

    //menyimpan data orang
    public function save()
    {
        $data = array(
            "nama_orang" => $this->input->post('Nama_orang'),
            "no_telp" => $this->input->post('No_telp'),
            "link_sebar" => $this->input->post('Link_sebar'),
        );
        return $this->db->insert($this->table, $data);
    }

    //edit data orang
    public function update()
    {
        $data = array(
            "nama_orang" => $this->input->post('Nama_orang'),
            "no_telp" => $this->input->post('No_telp'),
            "link_sebar" => $this->input->post('Link_sebar'),
        );
        return $this->db->update($this->table, $data, array('id_orang' => $this->input->post('id_orang')));
    }

    //hapus data orang
    public function delete($id)
    {
        return $this->db->delete($this->table, array("id_orang" => $id));
    }
}
