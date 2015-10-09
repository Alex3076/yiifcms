<?php if (CHtml::errorSummary($model)): ?>
    <table id="tips">
        <tr>
            <td>
                <div class="erro_div">
                    <span class="error_message"> <?php echo CHtml::errorSummary($model); ?> </span>
                </div>
            </td>
        </tr>
    </table>
<?php endif ?>
<script type="text/javascript" src="<?php echo $this->_static_public ?>/js/jscolor/jscolor.js"></script>
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'xform', 'htmlOptions' => array('name' => 'xform', 'enctype' => 'multipart/form-data'))); ?>
<table class="form_table">
    <tr>
        <td class="tb_title"><?php echo $form->label($model, 'title'); ?>：</td>
    </tr>
    <tr>
        <td><?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 128, 'class' => 'validate[required]')); ?>
            <input name="style[bold]" type="checkbox" id="style[bold]" <?php if ($style && $style['bold'] == 'Y'): ?> checked="checked" <?php endif; ?> value="Y" />
                   <?php echo Yii::t('admin', 'Blod'); ?>
            <input name="style[underline]" type="checkbox" <?php if ($style && $style['underline'] == 'Y'): ?> checked="checked" <?php endif; ?> id="style[underline]" value="Y" />
                   <?php echo Yii::t('admin', 'Underline'); ?>
            <input name="style[color]" class="color" id="style[color]" value="<?php echo isset($style['color']) ? $style['color'] : ''; ?>" size="5" />      
                   <?php echo Yii::t('admin', 'Color'); ?>
        </td>
    </tr>
    <tr>
        <td class="tb_title"><?php echo $form->label($model, 'title_second'); ?>：</td>
    </tr>
    <tr>
        <td><?php echo $form->textField($model, 'title_second', array('size' => 60, 'maxlength' => 128)); ?></td>
    </tr>
    <tr>
        <td class="tb_title"><?php echo $form->label($model, 'catalog_id'); ?>/<?php echo $form->label($model, 'special_id'); ?>：</td>
    </tr>
    <tr>
        <td>
            <select name="Post[catalog_id]" id="Post_catalog_id">
                <?php foreach ((array) Catalog::get(0, $this->_catalog) as $catalog): ?>
                    <option value="<?php echo $catalog['id'] ?>"
                            <?php Helper::selected($catalog['id'], $model->catalog_id); ?>><?php echo $catalog['str_repeat'] ?><?php echo $catalog['catalog_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <select name="Post[special_id]">
                <option value="0">==<?php echo $form->label($model, 'special_id'); ?>==</option>
                <?php foreach ((array) $this->_special as $speical): ?>
                    <option value="<?php echo $speical['id'] ?>"
                            <?php Helper::selected($speical['id'], $model->special_id); ?>><?php echo $speical['title'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="tb_title"><?php echo $form->label($model, 'copy_from'); ?>：</td>
    </tr>
    <tr>
        <td><?php echo $form->textField($model, 'copy_from', array('size' => 20, 'maxlength' => 128)); ?><?php echo Yii::t('admin', 'Web Address'); ?><?php echo $form->textField($model, 'copy_url', array('size' => 50, 'maxlength' => 128)); ?></td>
    </tr>
    <tr>
        <td class="tb_title"><?php echo $form->label($model, 'redirect_url'); ?>：</td>
    </tr>
    <tr>
        <td><?php echo $form->textField($model, 'redirect_url', array('size' => 60, 'maxlength' => 128)); ?></td>
    </tr>	
    <tr>
        <td class="tb_title"><?php echo $form->label($model, 'content'); ?>：</td>
    </tr>
    <tr>
        <td>
            <?php echo $form->textArea($model, 'content'); ?>
            <?php $this->widget('application.widget.kindeditor.KindEditor', array('id' => 'Post_content')); ?>
        </td>
    </tr>
    <tr>
        <td class="tb_title"><?php echo $form->label($model, 'introduce'); ?>：</td>
    </tr>
    <tr>
        <td><?php echo CHtml::activeTextArea($model, 'introduce', array('rows' => 5, 'cols' => 90)); ?></td>
    </tr>
    <tr>
        <td class="tb_title"><?php echo $form->label($model, 'tags'); ?>(逗号或空格隔开)：</td>
    </tr>
    <tr>
        <td><?php echo $form->textField($model, 'tags', array('size' => 50, 'maxlength' => 255)); ?>
            <input type="button" value="自动提取"	onclick="keywordGet('Post_title', 'Post_content', 'Post_tags')" />
        </td>
    </tr>
    <tr>
        <td>
            <?php echo $form->label($model, 'favorite_count'); ?>：<?php echo $form->textField($model, 'favorite_count', array('size' => 5, 'maxlength' => 10)); ?> 
            <?php echo $form->label($model, 'view_count'); ?>：<?php echo $form->textField($model, 'view_count', array('size' => 5, 'maxlength' => 10)); ?> 
            <?php echo $form->label($model, 'sort_order'); ?>: <?php echo $form->textField($model, 'sort_order', array('size' => 5, 'maxlength' => 10)); ?>
        </td>
    </tr>
    <tr>
        <td class="tb_title"><?php echo $form->label($model, 'status'); ?>：</td>
    </tr>
    <tr>
        <td>
            <?php echo $form->dropDownList($model, 'status', array('Y' => Yii::t('admin', 'Show'), 'N' => Yii::t('admin', 'Hidden'))); ?>
            <?php echo $form->dropDownList($model, 'top_line', array('Y' => Yii::t('common', 'Stick'), 'N' => Yii::t('common', 'Cancel Stick'))); ?>
            <?php echo $form->dropDownList($model, 'reply_allow', array('Y' => Yii::t('common', 'Allow Comment'), 'N' => Yii::t('common', 'Deny Comment'))); ?>
        </td>
    </tr>
    <tr>
        <td class="tb_title"><?php echo $form->label($model, 'seo_title'); ?>：</td>
    </tr>
    <tr>
        <td><?php echo $form->textField($model, 'seo_title', array('size' => 50, 'maxlength' => 80)); ?></td>
    </tr>
    <tr>
        <td class="tb_title"><?php echo $form->label($model, 'seo_keywords'); ?>：</td>
    </tr>
    <tr>
        <td><?php echo $form->textField($model, 'seo_keywords', array('size' => 50, 'maxlength' => 80)); ?></td>
    </tr>
    <tr>
        <td class="tb_title"><?php echo $form->label($model, 'seo_description'); ?>：</td>
    </tr>
    <tr>
        <td><?php echo CHtml::activeTextArea($model, 'seo_description', array('rows' => 5, 'cols' => 80)); ?></td>
    </tr>
    <tr class="submit">
        <td colspan="2">			
            <input type="submit" name="editsubmit" value="<?php echo Yii::t('common', 'Submit'); ?>" class="button" tabindex="3" />
        </td>
    </tr>
</table>
<?php
$this->endWidget();
