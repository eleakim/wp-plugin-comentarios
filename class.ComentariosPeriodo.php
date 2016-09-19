<?php

class ComentariosPeriodo {

    public function admin_menu() {
        add_menu_page('Comentarios por Período', 'Comentarios por Período', 8, 'comentarios_periodo', array('ComentariosPeriodo', 'config_page'));

        function load_comentario_wp_admin_style() {
            wp_register_style('comentario_wp_admin_css', plugins_url() . '/wp-plugin-comentarios/styles.css', false, '1.0.0');
            wp_enqueue_style('comentario_wp_admin_css');
        }
        add_action('admin_enqueue_scripts', 'load_comentario_wp_admin_style');
    }

    public function shortcode() {
        $configfile = COMPER_BASEPATH . 'config.json';
        if (!file_exists($configfile))
            return false;

        $filecontent = file_get_contents($configfile);
        $config = json_decode($filecontent);

        if ($config->status == 'off')
            return false;

        function by_period_comments($query) {
            $configfile = COMPER_BASEPATH . 'config.json';
            $filecontent = file_get_contents($configfile);
            $config = json_decode($filecontent);

            $ini = DateTime::createFromFormat('Y-m-d', $config->data_ini);
            $ini->sub(new DateInterval('P1D')); //Subtraindo um dia

            $end = DateTime::createFromFormat('Y-m-d', $config->data_end);
            $end->add(new DateInterval('P1D')); //Adicionando um dia

            $query->query_vars['date_query'] = array(
                array(
                    'after' => array(
                        'year' => $ini->format('Y'),
                        'month' => $ini->format('m'),
                        'day' => $ini->format('d')
                    ),
                    'before' => array(
                        'year' => $end->format('Y'),
                        'month' => $end->format('m'),
                        'day' => $end->format('d')
                    )
                )
            );
        }

        add_action('pre_get_comments', 'by_period_comments', 10, 1);
    }

    public function config_page() {
        if (!empty($_POST))
            ComentariosPeriodo::save_config();

        include COMPER_BASEPATH . 'config.php';
    }

    private static function save_config() {
        $handle = fopen(COMPER_BASEPATH . 'config.json', 'w');
        if(!isset($_POST['status']))        
            $_POST['status'] = 'off';
                
        $json = json_encode($_POST);
        fwrite($handle, $json);
    }

}
