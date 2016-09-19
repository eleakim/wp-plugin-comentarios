<?php

/*
  Plugin Name: Comentarios por Período
  Plugin URI: https://github.com/eleakim/wp-plugin-comentarios
  Description: Plugin para WordPress para selecionar um período de tempo selecionado pelo administrador. O administrador deve definir o periodo de tempo via painel administrativo na página do plugoin. A funcionalidade é inserida através do shortcode [comments_by_period].
  Version: 1.0
  Author: Pedro H. de França
  Author URI: https://github.com/eleakim
  License: none
  Text Domain: comentarios_periodo
 */

define('COMPER_BASEPATH', plugin_dir_path(__FILE__));
require_once COMPER_BASEPATH . 'class.ComentariosPeriodo.php';

add_action('admin_menu', array('ComentariosPeriodo', 'admin_menu'));
add_shortcode('comments_by_period', array('ComentariosPeriodo', 'shortcode'));
