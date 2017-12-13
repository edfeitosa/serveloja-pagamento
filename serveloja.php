<?php
/**
 * Plugin Name: Serveloja
 * Plugin URI: http://www.serveloja.com.br
 * Description: Plugin para realização de pagamentos via website, utilizando soluções fornecidas pela Serveloja.
 * Version: 1.0
 * Author: TI Serveloja
 * Author URI: http://www.serveloja.com.br
**/

// ativação
function create_db_table() {
  global $wpdb;
  $tabela_aplicacao = $wpdb->prefix . 'aplicacao';
  $tabela_cartoes = $wpdb->prefix . 'cartoes';
  $charset_collate = $wpdb->get_charset_collate();
  $sql = "CREATE TABLE $tabela_aplicacao (
      `apl_id` int(11) NOT NULL AUTO_INCREMENT,
      `apl_nome` varchar(32) NOT NULL,
      `apl_token` varchar(32) NOT NULL,
      `apl_prefixo` varchar(50),
      `apl_email` varchar(100),
      `apl_ambiente` varchar(1) NOT NULL,
      PRIMARY KEY (`apl_id`)
    ) $charset_collate;
    CREATE TABLE $tabela_cartoes (
      `car_id` int(11) NOT NULL AUTO_INCREMENT,
      `car_cod` varchar(32) NOT NULL,
      `car_bandeira` varchar(50) NOT NULL,
      `car_parcelas` varchar(3) NOT NULL,
      PRIMARY KEY (`car_id`)
    ) $charset_collate;
  ";
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
}

register_activation_hook(__FILE__, 'create_db_table');
define('PASTA_PLUGIN', WP_PLUGIN_URL.'/serveloja/');
define('PCON_DIR', plugin_dir_path(__FILE__));
require PCON_DIR.'/settings.php';
require PCON_DIR.'/functions.php';
$serveloja_functions = new Serveloja_functions();
require_once(PCON_DIR . 'configuracoes.php');

// desativação
function delete_db_table() {
  global $wpdb;
  $tabela_aplicacao = $wpdb->prefix . 'aplicacao';
  $tabela_cartoes = $wpdb->prefix . 'cartoes';
  $wpdb->query("DROP TABLE IF EXISTS $tabela_aplicacao");
  $wpdb->query("DROP TABLE IF EXISTS $tabela_cartoes");
  delete_option("serveloja");
  delete_site_option('serveloja');
}

register_deactivation_hook( __FILE__, 'delete_db_table');

// menu
add_action('admin_menu', 'addCustomMenuItem');
function addCustomMenuItem() {
  add_menu_page('Configurações', 'Serveloja', 'manage_options', 'configuracoes', 'function_configuracoes', 'dashicons-businessman', 6);
} ?>
