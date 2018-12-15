<?php

require APPPATH . '/libraries/REST_Controller.php';

class Tiket extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data tiket
    function index_get() {
        $tiket = $this->get('tiket');
        if ($tiket == '') {
            $this->db->select('id_tiket, nama_penumpang, tiket.no_penerbangan, jumlah, harga_total');
            $this->db->from('tiket');
            $this->db->join('penumpang', 'tiket.no_ktp = penumpang.no_ktp', 'inner');
            $this->db->join('penerbangan', 'tiket.no_penerbangan = penerbangan.no_penerbangan', 'inner');
            $tiket = $this->db->get()->result();
        } else {
            $this->db->select('id_tiket, nama_penumpang, tiket.no_penerbangan, jumlah, harga_total');
            $this->db->from('tiket');
            $this->db->join('penumpang', 'tiket.no_ktp = penumpang.no_ktp', 'inner');
            $this->db->join('penerbangan', 'tiket.no_penerbangan = penerbangan.no_penerbangan', 'inner');
            $this->db->where('id_tiket', $tiket);
            $tiket = $this->db->get()->result();
        }
        $this->response($tiket, 200);
    }

    // insert new data to tiket
    function index_post() {
        $data = array(
                    'id_tiket' => $this->post('id_tiket'),
                    'no_ktp' => $this->post('no_ktp'),
                    'no_penerbangan'    => $this->post('no_penerbangan'),
                    'jumlah'   => $this->post('jumlah'),
                    'harga_total'    => $this->post('harga_total'));
        $insert = $this->db->insert('tiket', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // update data tiket
    function index_put() {
        $id_tiket = $this->put('id_tiket');
        $data = array(
                    'id_tiket' => $this->put('id_tiket'),
                    'no_ktp' => $this->put('no_ktp'),
                    'no_penerbangan'    => $this->put('no_penerbangan'),
                    'jumlah'   => $this->put('jumlah'),
                    'harga_total'    => $this->put('harga_total'));
        $this->db->where('id_tiket', $id_tiket);
        $update = $this->db->update('tiket', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete tiket
    function index_delete() {
        $id_tiket = $this->delete('id_tiket');
        $this->db->where('id_tiket', $id_tiket);
        $delete = $this->db->delete('tiket');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}