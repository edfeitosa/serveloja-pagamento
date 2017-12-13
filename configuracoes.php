<?php function function_configuracoes() { ?>

  <link type="text/css" href="<?php echo PASTA_PLUGIN; ?>css/style.css" rel="stylesheet" />
  <link type="text/css" href="<?php echo PASTA_PLUGIN; ?>css/forms.css" rel="stylesheet" />
  <script type="text/javascript" src="<?php echo PASTA_PLUGIN; ?>scripts/scripts.js"></script>
  <div id="headerPlugin">
      <div id="logo">
          <img src='<?php echo PASTA_PLUGIN; ?>images/logotipo_serveloja.png' alt='servloja' border='0' />
      </div>
  </div>
  <h1>Pagamentos Serveloja</h1>
  <h2>
    Caso você já seja cliente Serveloja, informe <b>Nome</b> e <b>Token</b> para validar o uso desta aplicação.
    Caso não, cadastra-se antes de continuar.
  </h2>
  <h3>Configurações da aplicação</h3>
  <p>Todos os campos marcados com <strong>(*)</strong> são de preenchimento obrigatório.</p>
  <form name="estado" method="post">
    <div class="tituloInput">Nome da Aplicação (*)</div>
    <input type="text" class="input" name="nome" value="" placeholder="Informe aqui, o nome da aplicação" />
    <br />
    <div class="tituloInput">Token da Aplicação (*)</div>
    <input type="text" class="input" name="token" value="" placeholder="Informe aqui, o token da aplicação" />
    <br />
    <div class="tituloInput">Prefixo das transações</div>
    <input type="text" class="input" name="prefixo" value="" placeholder="Informe aqui, o prefixo para idetificar as transações realizadas" />
    <br />
    <div class="tituloInput">Informe um e-mail para receber notificações sobre compras realizadas em seu site/loja</div>
    <input type="text" class="input" name="email" value="" placeholder="Informe aqui, o e-mail para contato" />
    <br />
    <div class="tituloInput">O que você pretende fazer com esta aplicação? (*)</div>
    <select class="select" name="ambiente">
        <option value="0">Apenas um teste, estou verificando o funcionamento</option>
        <option value="1">Vou utilizar em minha loja/site para receber pagamentos</option>
    </select>
    <br />
    <input type="hidden" name="id" value="" />
    <input type="submit" class="submit" name="salvar" value="Salvar" name="salvar" />
  </form>

<?php } ?>
