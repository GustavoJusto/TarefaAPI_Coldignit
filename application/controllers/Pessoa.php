<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Pessoa extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index_get($id = 0)
    {
        if(!empty($id))
        {
            $data = $this->db->get_where('tb_pessoa',['cd_pessoa'=>$id])->row_array();
        }
        else
        {
            $data = $this->db->get("tb_pessoa")->result();
        }
   
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function index_post()
    {
        $input = $this->input->post();
        $this->db->insert('tb_pessoa',$input);
        $this->response("Registro feito com sucesso", REST_Controller::HTTP_OK);
    }

    public function index_put($id)
    {
        $input = $this->put();
        $this->db->update('tb_pessoa',$input, array('cd_pessoa'=>$id));
        $this->response(['Registro alterado com sucesso'], REST_Controller::HTTP_OK);
    }

    public function index_delete($id)
    {
        $this->db->delete('tb_pessoa', array('cd_pessoa'=>$id));
        $this->response(['Registro Deletado com sucesso'], REST_Controller::HTTP_OK);
    }
}