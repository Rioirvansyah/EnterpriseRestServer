<?php

require APPPATH . '/libraries/REST_Controller.php';

class Maskapai extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data maskapai
    function index_get() {
        $kode_maskapai = $this->get('kode_maskapai');
        if ($kode_maskapai == '') {
            $maskapai = $this->db->get('maskapai')->result();
        } else {
            $this->db->where('kode_maskapai', $kode_maskapai);
            $maskapai = $this->db->get('maskapai')->result();
        }
        $this->response($maskapai, 200);
    }

    // insert new data to maskapai
    function index_post() {
        $data = array(
                    'kode_maskapai' => $this->post('kode_maskapai'),
                    'nama_maskapai' => $this->post('nama_maskapai'),
                    'alamat_maskapai'    => $this->post('alamat_maskapai'),
                    'telepon_maskapai'   => $this->post('telepon_maskapai'),
                    'website_maskapai'    => $this->post('website_maskapai'));
        $insert = $this->db->insert('maskapai', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // update data maskapai
    function index_put() {
        $kode_maskapai = $this->put('kode_maskapai');
        $data = array(
                    'kode_maskapai' => $this->put('kode_maskapai'),
                    'nama_maskapai' => $this->put('nama_maskapai'),
                    'alamat_maskapai'    => $this->put('alamat_maskapai'),
                    'telepon_maskapai'   => $this->put('telepon_maskapai'),
                    'website_maskapai'    => $this->put('website_maskapai'));
        $this->db->where('kode_maskapai', $kode_maskapai);
        $update = $this->db->update('maskapai', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete maskapai
    function index_delete() {
        $kode_maskapai = $this->delete('kode_maskapai');
        $this->db->where('kode_maskapai', $kode_maskapai);
        $delete = $this->db->delete('maskapai');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}