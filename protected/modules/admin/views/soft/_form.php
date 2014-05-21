<?php if (CHtml::errorSummary($model)):?>
<table id="tips">
  <tr>
    <td><div class="erro_div"><span class="error_message"> <?php echo CHtml::errorSummary($model); ?> </span></div></td>
  </tr>
</table>
<?php endif?>
<script type="text/javascript" src="<?php echo $this->_baseUrl?>/static/public/js/jscolor/jscolor.js"></script>
<?php $form=$this->beginWidget('CActiveForm',array('id'=>'xform','htmlOptions'=>array('name'=>'xform','enctype'=>'multipart/form-data'))); ?>
<table class="form_table">
  <tr>
    <td class="tb_title" ><?php echo Yii::t('admin','Title');?>：</td>
  </tr>
  <tr >
    <td >
    	<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>128, 'class'=>'validate[required]')); ?>
    </td>
  </tr>
 
  <tr>
    <td class="tb_title"><?php echo Yii::t('admin','Belong Category');?>：</td>
  </tr>
  <tr >
    <td ><select name="Soft[catalog_id]" id="Soft_catalog_id">
        <?php foreach((array)Catalog::get(0, $this->_catalog) as $catalog):?>
        <option value="<?php echo $catalog['id']?>" <?php $this->selected($catalog['id'], $model->catalog_id);?>><?php echo $catalog['str_repeat']?><?php echo $catalog['catalog_name']?></option>
        <?php endforeach;?>
      </select>
    </td>
  </tr>  
  <tr>
    <td class="tb_title"><?php echo Yii::t('admin','Cover Image');?>：</td>
  </tr>
  <tr >
    <td colspan="2" >
    	<input name="attach" type="file" id="attach" />
      	<?php if ($model->cover_image):?>
      	<a href="<?php echo $this->_baseUrl.'/'. $model->cover_image?>" target="_blank">
      		<img style="padding:5px; border:1px solid #cccccc;" src="<?php echo $this->_baseUrl.'/'. $model->cover_image;?>" width="50" align="absmiddle" />
      	</a>
      	<?php endif;?>     
  	</td>
  </tr>
  
  <tr>
    <td class="tb_title"><?php echo Yii::t('admin','Soft Upload');?>：</td>
  </tr>
  <tr >
    <td colspan="2" >
    	<?php echo $form->hiddenField($model,'fileid'); ?>
      	<form>
		  <input id="uploadFile" name="uploadFile" type="file" multiple="true">
		  <ul id="fileList">
		  		<?php if($model->fileid>0):?>
		  		<?php $file = Upload::model()->findByPk($model->fileid);?>
		  		<?php if($file):?>
		  		<li id="file_<?php echo $model->fileid;?>">
		  			<a href="/<?php echo $file->file_name;?>"><?php echo $file->real_name;?></a><br/>
		  			<a href="javascript:uploadifyRemove('<?php echo $model->fileid;?>','file_','Soft_fileid')">删除</a>
		  		</li>
		  		<?php endif;?>
		  		<?php endif;?>
		  </ul>
		  <div id="fileQueue" style="clear:both"></div>
		</form>		
  	</td>
  </tr>
  
  <tr>
  	<td class="tb_title"><?php echo Yii::t('admin','Soft Language');?>：
    	<?php echo $form->dropDownList($model,'language',array('zh_cn'=>Yii::t('admin','zh_cn'),'zh_tw'=>Yii::t('admin','zh_tw'), 'en'=>Yii::t('admin','en'), 'i18n'=>Yii::t('admin','i18n'))); ?>
  		&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo Yii::t('admin','Soft Rank');?>：
     	<?php echo $form->dropDownList($model,'softrank',array('5'=>Yii::t('admin','5 Stars'),'4'=>Yii::t('admin','4 Stars'),'3'=>Yii::t('admin','3 Stars'),'2'=>Yii::t('admin','2 Stars'),'1'=>Yii::t('admin','1 Stars'))); ?>
    	&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo Yii::t('admin','Soft Type');?>
    	<?php echo $form->dropDownList($model,'softtype',array('domestic'=>Yii::t('admin','Domestic Soft'),'foreign'=>Yii::t('admin','Foreign Soft'))); ?>
    	&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo Yii::t('admin','Soft OS');?>
    	<?php echo $form->checkBoxList($model,'os',array('Linux'=>'Linux', 'Win2003'=>'Win2003','WinXP'=>'WinXP', 'Win8'=>'Win8'), array('separator'=>'&nbsp;&nbsp;')); ?>
    </td>
  </tr>    
  <tr>
    <td class="tb_title"><?php echo Yii::t('admin','Description');?>：</td>
  </tr>
  <tr >
    <td ><?php echo $form->textArea($model,'introduce', array('class'=>'validate[required]')); ?>
      <?php $this->widget('application.widget.kindeditor.KindEditor',array(
	  'target'=>array(
	  	'#Soft_introduce'=>array('uploadJson'=>$this->createUrl('/admin/uploadify/basicexecute', array('from'=>'editor')),		
		'allowFileManager'=>true, 		
	  	'extraFileUploadParams'=>array(array('sessionId'=>Yii::app()->session->sessionID))))));?></td>
  </tr> 
  
  <tr>
    <td class="tb_title"><?php echo Yii::t('admin','Soft Link');?>：</td>
  </tr>
   <tr >
    <td  ><?php echo $form->textField($model,'softlink',array('size'=>60,'maxlength'=>128)); ?></td>
  </tr>
  <tr>
    <td class="tb_title"><?php echo Yii::t('admin','SEO Title');?>：</td>
  </tr>
  <tr >
    <td ><?php echo $form->textField($model,'seo_title',array('size'=>50,'maxlength'=>80)); ?></td>
  </tr>
  <tr>
    <td  class="tb_title"><?php echo Yii::t('admin','SEO Keywords');?>：</td>
  </tr>
  <tr >
    <td ><?php echo $form->textField($model,'seo_keywords',array('size'=>50,'maxlength'=>80)); ?></td>
  </tr>
  <tr>
    <td class="tb_title"><?php echo Yii::t('admin','SEO Description');?>：</td>
  </tr>
  <tr >
    <td ><?php echo CHtml::activeTextArea($model,'seo_description',array('rows'=>5, 'cols'=>80)); ?></td>
  </tr>  
  
  <tr >
    <td class="tb_title"><?php echo Yii::t('admin','Status');?>：</td>
  </tr>
  <tr >
    <td  ><?php echo $form->dropDownList($model,'status',array('Y'=>Yii::t('admin','Show'), 'N'=>Yii::t('admin','Hidden'))); ?></td>
  </tr>
  
  <tr class="submit">
  	<td colspan="2" >
    	<input name="oAttach" type="hidden" value="<?php echo $model->cover_image; ?>" />      	
      	<input type="submit" name="editsubmit" value="<?php echo Yii::t('common','Submit');?>" class="button" tabindex="3" />
     </td>
  </tr>
</table>
<script type="text/javascript">
$(function(){
	$("#xform").validationEngine();
	//上传
	 $('#uploadFile').uploadify({
	        'buttonText': '选择文件..',
	        'fileObjName': 'file',
	        'method': 'post',
	        'multi': true,
			'queueID': 'fileQueue',
	        'uploadLimit': 1,
	        'file_size_limit' : '50MB',
	        'fileTypeExts': '*.exe;*.zip;*.tar;*.gz;*.msi;*.7z;',
	        'buttonImage': '<?php echo $this->_baseUrl?>/static/public/js/uploadify/select.png',
	        'formData': {
	            'sessionId'   : '<?php echo Yii::app()->session->sessionID; ?>',
				'timestamp'   : '<?php echo time();?>',
				'token'       : '<?php echo md5('unique_salt'.time()); ?>'
	        },
	        'swf': '<?php echo $this->_baseUrl;?>/static/public/js/uploadify/uploadify.swf',
	        'uploader': '<?php echo $this->createUrl('uploadify/file')?>',  
	        'onUploadSuccess': function(file, data, response) { 		        
	            var json = $.parseJSON(data);   
	            if (json.state == 'success') {
	                $imgHtml = '<li id="file_' + json.fileId + '">';
	                $imgHtml += '<a href="javascript:;">' + json.realname;
	                $imgHtml += '</a>&nbsp;<br />';	                                
	                $imgHtml += '<a href="javascript:uploadifyRemove(&quot;' + json.fileId + '&quot;,&quot;file_&quot;,&quot;Soft_fileid&quot;)">删除</a>';
	                $("#Soft_fileid").val(json.fileId);	               
	                $("#fileList").append($imgHtml);
	            } else {
	                alert(json.message);
	            }
	        }
	    });
	 	
});

</script>
<?php $form=$this->endWidget(); ?>

<script type="text/javascript" src="<?php echo $this->_baseUrl?>/static/public/js/uploadify/jquery.uploadify.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_baseUrl?>/static/public/js/uploadify/uploadify.css">