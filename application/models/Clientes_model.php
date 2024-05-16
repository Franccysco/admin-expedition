<?php
class Clientes_model extends MY_Model
{

    public $column_order = array("id", "status", "nome", "cnpj");
    public $column_search = array("id",);
    public $order = array("id" => "asc");


    public function __construct()
    {
        parent::__construct();
        $this->table = 'clientes';
    }

    

    //Atualiza status da cliente; Procurar uma solução melhor pra isso na view
    public function updateStatus($id_cliente, $status)
    {
        $cliente = $this->GetById($id_cliente);
        $cliente['status'] = $status;
        $this->Atualizar($id_cliente, $cliente);
    }

    public function chekckStatus($id_cliente)
    {
        $cliente = $this->GetById($id_cliente);
        if ($cliente['status'] == 0) {
            return 0;
        } else {
            return 1;
        }
    }

    public function GetByCnpj($cnpj)
    {
        if (is_null($cnpj))
            return false;

        $this->db->where('cnpj', $cnpj);
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return null;
        }
    }

    
}
