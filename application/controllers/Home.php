<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->verify_login();

    }

    public function index()
    {

        $dados['titulo'] = 'Home';
        $dados['clientes'] = $this->clientes_model->GetAll('id');

        $this->render_page("home", $dados);

    }

     /**
     * Processa o formulário para salvar os dados
     */
    public function Salvar()
    {
        // Executa o processo de validação do formulário
        $validacao = self::Validar();
        // Verifica o status da validação do formulário
        // Se não houverem erros, então insere no banco e informa ao usuário
        // caso contrário informa ao usuários os erros de validação
        if ($validacao) {
            // Recupera os dados do formulário
            $cliente = $this->input->post();
            // Insere os dados no banco recuperando o status dessa operação
            $status = $this->clientes_model->Inserir($cliente);
            // Checa o status da operação gravando a mensagem na seção
            if (!$status) {
                $this->session->set_flashdata('error', 'Não foi possível inserir o cliente.');
            } else {
                $this->session->set_flashdata('success', 'Cliente inserido com sucesso.');
                // Redireciona o usuário para a home
                redirect(base_url('home'));
            }
        } else {
            $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
        }
        // Carrega a home
        $dados['titulo'] = 'Home';

        $this->render_page("home", $dados);

    }

    /**
     * Carrega a view para edição dos dados
     */
    public function Editar()
    {
        // Recupera o ID do registro - através da URL - a ser editado
        $id = $this->uri->segment(3);
        // Se não foi passado um ID, então redireciona para a home clientes
        if (is_null($id)) {
            redirect(base_url('home'));
        }

        // Recupera os dados do registro a ser editado
        $dados['cliente_ed'] = $this->clientes_model->GetById($id);
        // Passa as clientes para o array que será enviado à home
        $dados['clientes'] = $this->clientes_model->GetAll('id');
        // Carrega a view passando os dados do registro
        $dados['titulo'] = 'clientes';

        $this->render_page("home", $dados);
    }

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

            echo json_encode($response); die;
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

    /**
     * Processa o formulário para atualizar os dados
     */
    public function Atualizar()
    {
        // Realiza o processo de validação dos dados
        $validacao = self::Validar('update');
        // Verifica o status da validação do formulário
        // Se não houverem erros, então insere no banco e informa ao usuário
        // caso contrário informa ao usuários os erros de validação
        if ($validacao) {
            // Recupera os dados do formulário
            $cliente = $this->input->post();
            // Atualiza os dados no banco recuperando o status dessa operação
            $status = $this->clientes_model->Atualizar($cliente['id'], $cliente);
            // Checa o status da operação gravando a mensagem na seção
            if (!$status) {
                $dados['cliente'] = $this->clientes_model->GetById($cliente['id']);
                $this->session->set_flashdata('error', 'Não foi possível atualizar o cliente.');

            } else {
                $this->session->set_flashdata('success', 'Cliente atualizado com sucesso.');
                // Redireciona o usuário para a home clientes
                redirect(base_url('home'));
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());

        }

        // Passa as clientes para o array que será enviado à home
        $dados['clientes'] = $this->clientes_model->GetAll('id');
        // Carrega a view para edição
        $dados['titulo'] = 'clientes';

        $this->render_page("home", $dados);
    }

    /**
     * Realiza o processo de exclusão dos dados
     */
    public function Excluir()
    {
        // Recupera o ID do registro - através da URL - a ser editado
        $id = $this->uri->segment(2);
        // Se não foi passado um ID, então redireciona para a home
        if (is_null($id)) {
            redirect();
        }

        // Remove o registro do banco de dados recuperando o status dessa operação
        $status = $this->clientes_model->Excluir($id);
        // Checa o status da operação gravando a mensagem na seção
        if ($status) {
            $this->session->set_flashdata('success', '<p>Cliente excluído com sucesso.</p>');
        } else {
            $this->session->set_flashdata('error', '<p>Não foi possível excluir o cliente.</p>');
        }
        // Redirecionao o usuário para a home
        redirect(base_url('home'));
    }

    /**
     * Valida os dados do formulário
     *
     * @param string $operacao Operação realizada no formulário: insert ou update
     *
     * @return boolean
     */
    private function Validar($operacao = 'insert')
    {
        // Com base no parâmetro passado
        // determina as regras de validação
        switch ($operacao) {
            case 'insert':
                $rules['nome'] = array('trim', 'required', 'min_length[3]');
                $rules['cnpj'] = array('trim', 'required', 'min_length[3]');
                $rules['data_pagamento'] = array('trim', 'required');
                $rules['status'] = array('trim', 'required');

                break;

            case 'update':
                $rules['nome'] = array('trim', 'required', 'min_length[3]');
                $rules['cnpj'] = array('trim', 'required', 'min_length[3]');
                $rules['data_pagamento'] = array('trim', 'required');
                $rules['status'] = array('trim', 'required');

                break;

            default:
                $rules['nome'] = array('trim', 'required', 'min_length[3]');
                $rules['cnpj'] = array('trim', 'required', 'min_length[3]');
                $rules['data_pagamento'] = array('trim', 'required');
                $rules['status'] = array('trim', 'required');

                break;
        }
        $this->form_validation->set_rules('nome', 'Nome', $rules['nome']);
        $this->form_validation->set_rules('cnpj', 'CNPJ', $rules['cnpj']);
        $this->form_validation->set_rules('data_pagamento', 'Data de pagamento', $rules['data_pagamento']);
        $this->form_validation->set_rules('status', 'Status', $rules['status']);

        // Executa a validação e retorna o status
        return $this->form_validation->run();
    }
   



  
  
 

    

}
