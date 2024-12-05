<?php
class Mcustomer extends CI_Model
{
  function tampilCustomer()
  {
    // //melakukan query
    // $q = $this->db->get("user");
    // $d = $q->result_array();

    // return $d;

    $this->db->select('Id_User, Nama_User, Email_User, No_Hp, Foto_User');
    $this->db->from('user');
    $this->db->where('Role_Id', 'customer');
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      log_message('error', 'Tidak ada data customer: ' . $this->db->last_query());
      return [];
    }
  }

  function detail($id_user): mixed
  {
    $this->db->where('Id_User', $id_user);

    // Melakukan query
    $q = $this->db->get("user");

    // Mengambil baris pertama (satu data)
    $d = $q->row_array();

    return $d;
  }
}
