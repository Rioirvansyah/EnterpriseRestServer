<?php

require APPPATH . '/libraries/REST_Controller.php';

class Kontak extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data kontak
    function index_get() {
        $id_kontak = $this->get('id_kontak');
        if ($id_kontak == '') {
            $kontak = $this->db->get('kontak')->result();
        } else {
            $this->db->where('id_kontak', $id_kontak);
            $kontak = $this->db->get('kontak')->result();
        }
        $this->response($kontak, 200);
    }

    // insert new data to kontak
    function index_post() {
        $data = array(
                    // 'id_kontak' => $this->post('id_kontak'),
                    'nama_kontak' => $this->post('nama_kontak'),
                    'email_kontak'    => $this->post('email_kontak'),
                    'subyek_kontak'    => $this->post('subyek_kontak'),
                    'pesan'    => $this->post('pesan'));
        $insert = $this->db->insert('kontak', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // update data kontak
    function index_put() {
        $id_kontak = $this->put('id_kontak');
        $data = array(
                    'id_kontak' => $this->put('id_kontak'),
                    'nama_kontak' => $this->put('nama_kontak'),
                    'email_kontak'    => $this->put('email_kontak'),
                    'subyek_kontak'    => $this->put('subyek_kontak'),
                    'pesan'    => $this->put('pesan'));
        $this->db->where('id_kontak', $id_kontak);
        $update = $this->db->update('kontak', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete kontak
    function index_delete() {
        $id_kontak = $this->delete('id_kontak');
        $this->db->where('id_kontak', $id_kontak);
        $delete = $this->db->delete('kontak');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}