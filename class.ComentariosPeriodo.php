<?php

class ComentariosPeriodo{
    
    public function admin_menu(){
        add_menu_page('Comentarios por Período', 'Comentarios por Período', 8, 'comentarios_periodo', array('ComentariosPeriodo', 'config_page'));
    }
    
    public function shortcode(){
        return 'Hue';
    }
    
    public function config_page(){
        if(!empty($_POST))
            ComentariosPeriodo::save_config();
        
        include COMPER_BASEPATH . 'config.php';
    }
    
    private static function save_config(){
        $handle = fopen(COMPER_BASEPATH . 'config.json', 'w');
        $json = json_encode($_POST);
        fwrite($handle, $json);        
    }
}