<?php

require APPPATH . '/libraries/REST_Controller.php';

class Penerbangan extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data penerbangan
    function index_get() {
        $penerbangan = $this->get('penerbangan');
        if ($penerbangan == '') {
            $this->db->select('no_penerbangan, nama_maskapai, tanggal_berangkat, tujuan, waktu_berangkat, waktu_sampai, keterangan');
            $this->db->from('penerbangan');
            $this->db->join('maskapai', 'penerbangan.kode_maskapai = maskapai.kode_maskapai', 'inner');
            $penerbangan = $this->db->get()->result();
        } else {
            $this->db->select('no_penerbangan, nama_maskapai, tanggal_berangkat, tujuan, waktu_berangkat, waktu_sampai, keterangan');
            $this->db->from('penerbangan');
            $this->db->join('maskapai', 'penerbangan.kode_maskapai = maskapai.kode_maskapai', 'inner');
            $this->db->where('penerbangan', $penerbangan);
            $penerbangan = $this->db->get()->result();
        }
        $this->response($penerbangan, 200);
    }

    // insert new data to penerbangan
    function index_post() {

        $this->db->where('id_penerbangan', $this->post('id_penerbangan'));
        $penerbangan = $this->db->get('penerbangan')->result();
        $this->db->where('kode_maskapai', $this->post('kode_maskapai'));
        $maskapai = $this->db->get('maskapai')->result();

        $data = array(
                    'no_penerbangan' => $this->post('no_penerbangan'),
                    'kode_maskapai' => $this->post('kode_maskapai'),
                    'tanggal_berangkat'    => $this->post('tanggal_berangkat'),
                    'tujuan'   => $this->post('tujuan'),
                    'waktu_berangkat'    => $this->post('waktu_berangkat'),
                    'waktu_sampai'    => $this->post('waktu_sampai'),
                    'keterangan'    => $this->post('keterangan'));
        $insert = $this->db->insert('penerbangan', $data);

        if (!$maskapai) {
            $this->response(array('status' => 'Maskapai tidak ada')); 
        }
        else{
            if ($insert) {
                $this->response($data, 200);
            } else {
                $this->response(array('status' => 'fail', 502));
            }            
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