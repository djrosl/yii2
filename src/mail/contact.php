<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<p>Из сайта была отправлена форма: <b><?=$form_title?></b></p>
<table width="90%" style="border: 1px solid #dadada">
    <?php foreach ($fields as $k => $field): ?>
        <tr <?=$k%2 ? 'bgcolor="#dadada"' : ''?>>
            <td style="text-align: left; padding: 5px; width: 300px;"><?=$field['label']?></td>
            <td style="text-align: right; padding: 5px;"><?=$field['value']?></td>
        </tr>
    <?php endforeach; ?>
</table>
