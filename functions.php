<?php
  class Serveloja_functions {

    // acesso api
    private function servidor() {
      return "http://desenvolvimento.redeserveloja.com/Novo/webapi/";
    }

    // métodos
    private function metodos_acesso($url, $method, $param) {
      if ($method == "get") {
        /* em caso do método GET, os parâmetros serão adicionados na URL, como padrão */
        $con = curl_init(Serveloja_functions::servidor() . $url . "?" . $param);
        curl_setopt($con, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($con, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
          )
        );
      } else {
        /* em caso de POST, os parãmetros serão adicionados a um array, ex: array("id" => "$id", "symbol" => "$symbol"); */
        $con = curl_init(Serveloja_functions::servidor() . $url . "?" . $param);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($con, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($param))
          )
        );
      }
      curl_setopt($con, CURLOPT_TIMEOUT, 5);
      curl_setopt($con, CURLOPT_CONNECTTIMEOUT, 5);
      curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
      $data = curl_exec($con);
      curl_close($con);
      return $data;
    }

    // verifica se token informado por usuário é válido
    private function valida_token($url, $method, $param) {
        return Serveloja_functions::metodos_acesso($url, $method, $param);
    }

    // fecha div via javascript após alguns segundos
    private function script($div) {
      return '<script type="text/javascript">Fecha_mensagem("' . $div . '");</script>';
    }

    // exibe a mensagem e classe conforme setado
    private function div_resposta($id, $class, $mensagem) {
      return '<div id="' . $id . '" class="' . $class . '">' . $mensagem . '</div>' . Serveloja_functions::script($id);
    }

    // ações no banco para aplicação
    private function insert_aplicacao($apl_nome, $apl_token, $apl_prefixo, $apl_email, $apl_ambiente) {
      global $wpdb;
      $wpdb->insert(
          $wpdb->prefix . "aplicacao",
          array('apl_nome' => $apl_nome,
                'apl_token' => $apl_token,
                'apl_prefixo' => $apl_prefixo,
                'apl_email' => $apl_email,
                'apl_ambiente' => $apl_ambiente
          ),
          array('%s', '%s', '%s', '%s', '%s')
      );
      return Serveloja_functions::div_resposta("fecha_mensagem", "sucesso", "Os dados foram adicionados com sucesso");
    }

    private function update_aplicacao($apl_nome, $apl_token, $apl_prefixo, $apl_email, $apl_ambiente, $apl_id) {
      global $wpdb;
      $wpdb->update(
          $wpdb->prefix . "aplicacao",
          array('apl_nome' => $apl_nome,
                'apl_token' => $apl_token,
                'apl_prefixo' => $apl_prefixo,
                'apl_email' => $apl_email,
                'apl_ambiente' => $apl_ambiente
          ),
          array('apl_id' => $apl_id),
          array('%s', '%s', '%s', '%s', '%s'),
          array('%s')
      );
      return Serveloja_functions::div_resposta("fecha_mensagem", "sucesso", "Os dados foram modificados com sucesso");
    }

    public function save_configuracoes($apl_nome, $apl_token, $apl_prefixo, $apl_email, $apl_ambiente, $apl_id) {
      if ($apl_nome == "" || $apl_token == "" || $apl_ambiente == "") {
        return Serveloja_functions::div_resposta("fecha_mensagem", "erro", "Os campos marcados com (*) devem ser preencidos");
      } else {
        if ($apl_id == "0") {
          return Serveloja_functions::insert_aplicacao($apl_nome, $apl_token, $apl_prefixo, $apl_email, $apl_ambiente);
        } else {
          return Serveloja_functions::update_aplicacao($apl_nome, $apl_token, $apl_prefixo, $apl_email, $apl_ambiente, $apl_id);
        }
      }
    }

    public function aplicacao() {
      global $wpdb;
      $rows = $wpdb->get_results("SELECT apl_id, apl_nome, apl_token, apl_prefixo, apl_email, apl_ambiente FROM " . $wpdb->prefix . "aplicacao ORDER BY apl_id DESC LIMIT 1");
      if (count($rows) == 0) {
        return "0";
      } else {
        return $rows;
      }
    }

  }
?>
