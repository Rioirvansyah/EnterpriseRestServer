<?php

require APPPATH . '/libraries/REST_Controller.php';

class Penerbangan extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data penerbangan
    function index_get() {
        $no_penerbangan = $this->get('no_penerbangan');
        if ($no_penerbangan == '') {
            $penerbangan = $this->db->get('penerbangan')->result();
        } else {
            $this->db->where('no_penerbangan', $no_penerbangan);
            $penerbangan = $this->db->get('penerbangan')->result();
        }
        $this->response($penerbangan, 200);
    }

    // insert new data to penerbangan
    function index_post() {
        $data = array(
                    'no_penerbangan' => $this->post('no_penerbangan'),
                    'kode_maskapai' => $this->post('kode_maskapai'),
                    'tanggal_berangkat'    => $this->post('tanggal_berangkat'),
                    'tujuan'   => $this->post('tujuan'),
                    'waktu_berangkat'    => $this->post('waktu_berangkat'),
                    'waktu_sampai'    => $this->post('waktu_sampai'),
                    'keterangan'    => $this->post('keterangan'));
        $insert = $this->db->insert('penerbangan', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // update data penerbangan
    function index_put() {
        $no_penerbangan = $this->put('no_penerbangan');
        $data = array(
                    'no_penerbangan' => $this->put('no_penerbangan'),
                    'kode_maskapai' => $this->put('kode_maskapai'),
                    'tanggal_berangkat'    => $this->put('tanggal_berangkat'),
                    'tujuan'   => $this->put('tujuan'),
                    'waktu_berangkat'    => $this->put('waktu_berangkat'),
                    'waktu_sampai'    => $this->put('waktu_sampai'),
                    'keterangan'    => $this->put('keterangan'));
        $this->db->where('no_penerbangan', $no_penerbangan);
        $update = $this->db->update('penerbangan', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete penerbangan
    function index_delete() {
        $no_penerbangan = $this->delete('no_penerbangan');
        $this->db->where('no_penerbangan', $no_penerbangan);
        $delete = $this->db->delete('penerbangan');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}