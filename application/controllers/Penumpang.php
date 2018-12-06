<?php

require APPPATH . '/libraries/REST_Controller.php';

class Penumpang extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data penumpang
    function index_get() {
        $no_ktp = $this->get('no_ktp');
        if ($no_ktp == '') {
            $penumpang = $this->db->get('penumpang')->result();
        } else {
            $this->db->where('no_ktp', $no_ktp);
            $penumpang = $this->db->get('penumpang')->result();
        }
        $this->response($penumpang, 200);
    }

    // insert new data to penumpang
    function index_post() {
        $data = array(
                    'no_ktp' => $this->post('no_ktp'),
                    'nama_penumpang' => $this->post('nama_penumpang'),
                    'telepon_penumpang'   => $this->post('telepon_penumpang'),
                    'email_penumpang'    => $this->post('email_penumpang'),
                    'jenis_penumpang'    => $this->post('jenis_penumpang'),
                    'username'    => $this->post('username'),
                    'password'    => $this->post('password'));
        $insert = $this->db->insert('penumpang', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // update data penumpang
    function index_put() {
        $no_ktp = $this->put('no_ktp');
        $data = array(
                    'no_ktp' => $this->put('no_ktp'),
                    'nama_penumpang' => $this->put('nama_penumpang'),
                    'telepon_penumpang'   => $this->put('telepon_penumpang'),
                    'email_penumpang'    => $this->put('email_penumpang'),
                    'jenis_penumpang'    => $this->put('jenis_penumpang'),
                    'username'    => $this->put('username'),
                    'password'    => $this->put('password'));
        $this->db->where('no_ktp', $no_ktp);
        $update = $this->db->update('penumpang', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete penumpang
    function index_delete() {
        $no_ktp = $this->delete('no_ktp');
        $this->db->where('no_ktp', $no_ktp);
        $delete = $this->db->delete('penumpang');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}