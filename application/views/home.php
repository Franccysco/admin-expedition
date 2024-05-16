<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Controle de acesso de clientes<small>Manter clientes</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url('')?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active"><a href="<?=base_url('home')?>">Clientes</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <?php if ($this->session->flashdata('error') == true): ?>
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-times-circle"></i> Erros</h4>
      <?php echo $this->session->flashdata('error');?>
    </div>
    <?php endif;?>

    <?php if ($this->session->flashdata('success') == true): ?>
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check-circle"></i> Sucesso</h4>
      <?php echo $this->session->flashdata('success'); ?>
    </div>
    <?php endif;?>

    <!-- Cadastrar Usuários -->
    <?php $rota = $this->uri->segment(2); if($rota == 'cadastro' ):?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Cadastrar Cliente</h3>
          </div>
          <form method="post" action="<?=base_url('salvar-cliente')?>" enctype="multipart/form-data">
            <div class="box-body">
              <div class="row">
                <div class="col-md-3">
                  <label id="nome">Nome</label>
                  <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome do usuário" value="<?=set_value('nome')?>"
                    required>
                </div>
                <div class="col-md-3">
                  <label id="cnpj">CNPJ</label>
                  <input type="text" id="cnpj" name="cnpj" class="form-control" placeholder="CNPJ do usuário" value="<?=set_value('cnpj')?>"
                    required>
                </div>
                <div class="col-md-3">
                  <label id="data">Data de Pagamento</label>
                  <input type="date" name="data_pagamento" class="form-control" placeholder="Data de pagamento" value="<?=set_value('data_pagamento')?>"
                    required>
                </div>
            
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control select2" style="width: 100%;">
                      <option selected>Selecione o status</option>
                      <option value="1">Ativo</option>
                      <option value="0">Inativo</option>
                    </select>
                  </div>
                </div>
        
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer" style="text-align: right;">
              <button type="reset" class="btn btn-default pull-left">Limpar</button>
              <button type="submit" class="btn btn-primary">Salvar</button>
              <a href="<?=base_url('home')?>" class="btn btn-danger">Cancelar</a>
            </div>
          </form>
          <!-- /.box-body -->
        </div>
      </div>
    </div>
    <?php endif;?>
    <!-- Editar Usuários -->
    <?php $id = $this->uri->segment(2);if ($id == 'editar'): ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Editar clientes</h3>
          </div>

          <!-- <php var_dump($cliente);
          echo $this->uri->segment(3);?> -->

          <form method="post" action="<?=base_url('atualizar-cliente')?>">
            <div class="box-body">
              <div class="row">

              <div class="col-md-3">
                  <label id="nome">Nome</label>
                  <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome do usuário" value="<?=$cliente_ed['nome']?>"
                    required>
                </div>
                <div class="col-md-3">
                  <label id="cnpj">CNPJ</label>
                  <input type="text" id="cnpj" name="cnpj" class="form-control" placeholder="CNPJ do usuário" value="<?=$cliente_ed['cnpj']?>"
                    required>
                </div>
                <div class="col-md-3">
                  <label id="data">Data de Pagamento</label>
                  <input type="date" name="data_pagamento" class="form-control" placeholder="Data de pagamento" value="<?=$cliente_ed['data_pagamento']?>"
                    required>
                </div>
                
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control select2" style="width: 100%;">
                      <option disabled="disabled">Selecione o status</option>

                      <?php if($cliente_ed['status'] == 1){?>

                      <option value="1" selected>Ativo</option>
                      <option value="0">Inativo</option>

                      <?php } else{?>
                      <option value="1">Ativo</option>
                      <option value="0" selected>Inativo</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                
              </div>
              <input type="hidden" name="id" value="<?=$cliente_ed['id']?>" />
            </div>
            <!-- /.box-body -->

            <div class="box-footer" style="text-align: right;">
              <button disabled type="reset" class="btn btn-default pull-left">Limpar</button>
              <button type="submit" class="btn btn-primary">Salvar</button>
              <a href="<?=base_url('clientes')?>" class="btn btn-danger">Cancelar</a>
            </div>
          </form>
          <!-- /.box-body -->
        </div>
      </div>
    </div>
    <?php endif;?>

    <!-- Lista de Usuários -->
    <div class="row">
      <div class="col-md-12">
        <div class="box box-defaut">

          <div class="box-header col-md-12">
            <a href="<?=base_url('clientes/cadastro')?>" class="btn btn-success pull-right">
              <i class="fa fa-plus-circle"></i> Cadastrar Cliente
            </a>
          </div>

          <div class="box-body">
            <table id="tables-exp" class="table table-striped dataTable" style="width: 100%">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Nome</th>
                  <th>CNPJ</th>
                  <th>Data de pagamento</th>
                  <th>Status</th>
                  <th style="width: 180px">Ações</th>
                </tr>
              </thead>
              <tbody>

                <?php if ($clientes == FALSE): ?>
                <tr>
                  <td colspan="6">
                    <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fa fa-exclamation-circle"></i> Cadastre um cliente!</h4>
                      Nenhum cliente encontrado
                    </div>
                  </td>
                </tr>
                <?php else: ?>
                <?php foreach ($clientes as $cliente){ ?>
                <tr>
                  <td>
                    <?=$cliente['id']?>
                  </td>
                  <td>
                    <?=$cliente['nome']?>
                  </td>
                  <td>
                    <?=$cliente['cnpj']?>
                  </td>
                  <td>
                    <?=data($cliente['data_pagamento'])?>
                  </td>
                  <td>
                    <?php echo ($cliente['status'] == 1) ? '<span class="label label-success">Ativo</span>' : '<span class="label label-default">Inativo</span>' ?>
                  </td>

                  <td>
                    <a href="<?=base_url('clientes/editar/'.$cliente['id'])?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>
                      Editar</a>
                    <?php if ($cliente['status'] == 1) {?>
                    <a href="#" data-toggle="modal" data-target="#desativar-cliente" data-customer="<?php echo $cliente['id'];?>"
                      data-rota="<?php echo base_url('desativar-cliente/');?>" data-nome="<?php echo $cliente['nome']?>" class="btn btn-success btn-xs"><i class="fa fa-toggle-on"></i>
                      Desativar</a>
                    <?php }else{?>
                    <a href="<?=base_url('ativar-cliente/'.$cliente['id'])?>" class="btn btn-default btn-xs"><i class="fa fa-toggle-off"></i>
                      Ativar</a>
                    <?php }?>

                    <a href="#" data-toggle="modal" data-target="#delete-modal" data-customer="<?php echo $cliente['id'];?>"
                      data-rota="<?php echo base_url('exluir-cliente/');?>" class="btn btn-danger btn-xs">
                      <i class="fa fa-trash"></i> Excluir</a>
                  </td>

                </tr>

                <?php } ?>
                <?php endif; ?>

              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->