<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cliente extends MY_Controller
{

  public function verify_pagamento()
  {
    $response = array();
    // Recupera o cnpj do registro - através da URL - a ser buscado
    $cnpj = $this->uri->segment(3);
    // Se não foi passado um cnpj, então retorna um erro
    if (is_null($cnpj)) {
      $response = array(
        'status'   => 200,
        'error'    => "Falta passar parametro da busca",
        'success' => null
      );

      echo json_encode($response);
      die;
    }

    // Recupera os dados do registro a ser editado
    $cliente = $this->clientes_model->GetByCnpj($cnpj);

    if ($cliente) {
      $response = array(
        'status'   => 200,
        'error'    => null,
        'success' => $cliente['status'] == 1 ? "PAGO" : "PENDETE"
      );
    } else {
      $response = array(
        'status'   => 200,
        'error'    => null,
        'success' => "Cliente nao encontrado"
      );
    }

    echo json_encode($response);
  }
}
