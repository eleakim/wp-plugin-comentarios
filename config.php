<?php
$configfile = COMPER_BASEPATH . 'config.json';

$status = 'on';
$data_ini = '';
$data_end = '';

if (file_exists($configfile)):
    $filecontent = file_get_contents($configfile);
    $config = json_decode($filecontent);

    $status = $config->status;
    $data_ini = $config->data_ini;
    $data_end = $config->data_end;
endif;
?>

<div class="wrap">
    <div id="icon-options-general" class="icon32"><br></div>
    <h2>Configurações</h2>

    <p><small>O shortcode para recuperar os comentários por período é <strong>[comments_by_period]</strong></small></p>

    <form method="post">
        <table class="form-table">
            <tbody>
                <tr id="switcher-wrap">
                    <th><label for="user_login">On/Off</label></th>
                    <td>                        
                        <div id="switcher-wrap">
                            <label class="switch">
                                <input type="checkbox" name="status" <?= ($status == 'on')?'checked="checked"':''; ?> />
                                <div class="slider round"></div>
                            </label>
                        </div>
                    </td>
                </tr>

                <tr class="period-date-wrap">
                    <th><label for="">Período</label></th>
                    <td>
                        <input type="date" name="data_ini" value="<?= $data_ini ?>" required="required" />
                        até 
                        <input type="date" name="data_end" value="<?= $data_end ?>" required="required" />
                    </td>                    
                </tr>
            </tbody>
        </table>

        <p class="submit">
            <input type="submit" id="submit" class="button button-primary" value="Atualizar">
        </p>
    </form>
</div>