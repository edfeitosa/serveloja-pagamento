<?php function function_configuracoes() { ?>

 <!-- scripts e estilos -->
  <link type="text/css" href="<?php echo PASTA_PLUGIN; ?>css/style.css" rel="stylesheet" />
  <link type="text/css" href="<?php echo PASTA_PLUGIN; ?>css/forms.css" rel="stylesheet" />
  <script type="text/javascript" src="<?php echo PASTA_PLUGIN; ?>scripts/scripts.js"></script>

  <?php // carrega funções php
  require_once (PCON_DIR.'/functions.php');
  $funcoes = new Serveloja_functions; ?>

  <?php // verifica se já existem informações sobre a aplicação
    $dados = $funcoes::total_aplicacoes();
    $apl_id = ($funcoes::total_aplicacoes() == "0") ? "0" : $dados[0]->apl_id;
    $apl_nome = ($funcoes::total_aplicacoes() == "0") ? "" : $dados[0]->apl_nome;
    $apl_token = ($funcoes::total_aplicacoes() == "0") ? "" : $dados[0]->apl_token;
    $apl_prefixo = ($funcoes::total_aplicacoes() == "0") ? "" : $dados[0]->apl_prefixo;
    $apl_email = ($funcoes::total_aplicacoes() == "0") ? "" : $dados[0]->apl_email;
    $apl_ambiente = ($funcoes::total_aplicacoes() == "0") ? "" : $dados[0]->apl_ambiente;
  ?>

  <!-- cabeçalho -->
  <div id="headerPlugin">
      <div id="logo">
          <img src='<?php echo PASTA_PLUGIN; ?>images/logotipo_serveloja.png' alt='servloja' border='0' />
      </div>
  </div>

  <?php // post configurações principais
  if (isset($_POST["salvar_config"])) {
    echo $funcoes::save_configuracoes(
      $_POST["apl_nome"],
      $_POST["apl_token"],
      $_POST["apl_prefixo"],
      $_POST["apl_email"],
      $_POST["apl_ambiente"],
      $_POST["apl_id"]
    );
  } ?>

  <h1>Pagamentos Serveloja</h1>
  <h2>
    Caso você já seja cliente Serveloja, informe <b>Nome</b> e <b>Token</b> para validar o uso desta aplicação.
    Caso não, cadastra-se antes de continuar.
  </h2>
  <h3>Configurações da aplicação</h3>
  <p>Todos os campos marcados com <strong>(*)</strong> são de preenchimento obrigatório.</p>
  <form name="configuracoes" method="post" action="">
    <div class="tituloInput">Nome da Aplicação (*)</div>
    <input type="text" class="input" name="apl_nome" value="<?php echo $apl_nome; ?>" placeholder="Informe aqui, o nome da aplicação" />
    <br />
    <div class="tituloInput">Token da Aplicação (*)</div>
    <input type="text" class="input" name="apl_token" value="<?php echo $apl_token; ?>" placeholder="Informe aqui, o token da aplicação" />
    <br />
    <div class="tituloInput">Prefixo das transações</div>
    <input type="text" class="input" name="apl_prefixo" value="<?php echo $apl_prefixo; ?>" placeholder="Informe aqui, o prefixo para idetificar as transações realizadas" />
    <br />
    <div class="tituloInput">Informe um e-mail para receber notificações sobre compras realizadas em seu site/loja</div>
    <input type="text" class="input" name="apl_email" value="<?php echo $apl_email; ?>" placeholder="Informe aqui, o e-mail para contato" />
    <br />
    <div class="tituloInput">O que você pretende fazer com esta aplicação? (*)</div>
    <select class="select" name="apl_ambiente">
        <option value="0" <?php if ($apl_ambiente == "0") { echo 'selected="selected"'; } ?>>Apenas um teste, estou verificando o funcionamento</option>
        <option value="1" <?php if ($apl_ambiente == "1") { echo 'selected="selected"'; } ?>>Vou utilizar em minha loja/site para receber pagamentos</option>
    </select>
    <br />
    <input type="hidden" name="apl_id" value="<?php echo $apl_id; ?>" />
    <input type="submit" class="submit" name="salvar_config" value="Salvar" name="salvar" />
  </form>

<?php } ?>
