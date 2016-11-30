<?php
/**
 *
 */
use yii\helpers\Html;

?>
<div id="<?=$slug?>" class="modal-overlay"><div class="modal-close"><span class="lg-close lg-icon"></span></div></div>

    <div class="modal-content">
        <form action="<?=$action?>" class="artist-order prepare-ajax">
            <header><?=$header?></header>
            <div class="text-center modal-sub-header">
                <?=$sub_header?>
            </div>
            <?php foreach($fields as $field){
                if($field['type'] == 'textarea') { ?>
                    <div class="form-group">
                        <label><?=$field['label']?></label>
                        <textarea name="<?=$field['slug']?>"></textarea>
                    </div>
                <?php } else { ?>
                    <div class="form-group">
                        <label><?=$field['label']?></label>
                        <input name="<?=$field['slug']?>" type="<?=$field['type']?>" value="<?=!empty($isLogged[$field['slug']]) ? $isLogged[$field['slug']] : ''?>">
                    </div>
                <?php }
            }?>
            <input type="hidden" name="form_title" data-label="Форма" value="<?=$form_title?>">
            <?php if($fields):?>
            <div class="text-center">
                <button class="btn btn-info">Отправить</button>
            </div>
            <?php endif; ?>
        </form>
    </div>

