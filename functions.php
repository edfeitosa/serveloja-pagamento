<?php
  class Serveloja_functions {

    private function script($div) {
      return '<script type="text/javascript">Fecha_mensagem("' . $div . '");</script>';
    }

    private function resposta($id, $class, $mensagem) {
      return '<div id="' . $id . '" class="' . $class . '">' . $mensagem . '</div>';
    }

    // aplicações
    private function insert_aplicacao() {

    }

    private function update_aplicacao() {

    }

    private function query_aplicacao() {

    }

    public function save_configuracoes($apl_nome, $apl_token, $apl_prefixo, $apl_email, $apl_ambiente, $apl_id) {
      if ($apl_id == "0") {
        $mensagem = Serveloja_functions::resposta("mensagem_retorno", "sucesso", "Estou inserindo");
      } else {
        $mensagem = Serveloja_functions::resposta("mensagem_retorno", "sucesso", "Estou editando");
      }
      $fecha_div = Serveloja_functions::script("mensagem_retorno");
      return $mensagem . $fecha_div;
    }

    public function total_aplicacoes() {
      global $wpdb;
      $rows = $wpdb->get_results("SELECT apl_id, apl_nome, apl_token, apl_prefixo, apl_email, apl_ambiente FROM " . $wpdb->prefix . "aplicacoes ORDER BY apl_id DESC");
      if (count($rows) == 0) {
        return "0";
      } else {
        return $rows;
      }
    }

  }
?>
