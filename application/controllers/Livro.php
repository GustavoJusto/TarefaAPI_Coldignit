<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Livro extends REST_Controller
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
            $data = $this->db->get_where('tb_livro',['cd_livro'=>$id])->row_array();
        }
        else
        {
            $data = $this->db->get("tb_livro")->result();
        }
   
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function index_post()
    {
        $input = $this->input->post();
        $this->db->insert('tb_livro',$input);
        $this->response("Livro adicionado com sucesso", REST_Controller::HTTP_OK);
    }

    public function index_put($id)
    {
        $input = $this->put();
        $this->db->update('tb_livro',$input, array('cd_livro'=>$id));
        $this->response(['Registro do livro editado com sucesso'], REST_Controller::HTTP_OK);
    }

    public function index_delete($id)
    {
        $this->db->delete('tb_livro', array('cd_livro'=>$id));
        $this->response(['Registro do livro deletado com sucesso'], REST_Controller::HTTP_OK);
    }
}