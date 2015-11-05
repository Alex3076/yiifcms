<?php
/**
 * 
 * @author zhao jinhan <326196998@qq.com>
 * @link 
 *
 */
class Post extends CActiveRecord
{
	
	/**
	 * @return string 相关的数据库表的名称
	 */
	public function tableName()
	{
		return '{{post}}';
	}

	/**
	 * @return array 对模型的属性验证规则.
	 */
	public function rules()
	{
		return array(
			array('title, catalog_id', 'required'),
			array('catalog_id, special_id', 'numerical', 'integerOnly'=>true),
			array('user_id, view_count, favorite_count, update_time, reply_count, sort_order, create_time', 'length', 'max'=>10),
			array('copy_from', 'length', 'max'=>100),
			array('title, title_second, title_style, seo_title, seo_keywords, copy_url, redirect_url, tags', 'length', 'max'=>255),
			array('commend, top_line, reply_allow, status', 'length', 'max'=>1),
			array('content, introduce, seo_description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, title, title_second, title_style, catalog_id, special_id, introduce, seo_title, seo_description, seo_keywords, content, copy_from, copy_url, redirect_url, tags, view_count, commend, favorite_count, top_line, update_time, reply_count, reply_allow, sort_order, status, create_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array 关联规则.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
	        'catalog'=>array(self::BELONGS_TO, 'Catalog', 'catalog_id', 'alias'=>'catalog', 'select'=>'id,catalog_name,type'),
	    );
	}

	/**
	 * @return array 自定义属性标签 (name=>label)
	 */
	public function attributeLabels()
	{
        return array(
			'id'                => Yii::t('model','PostId'),
			'user_id'           => Yii::t('model','PostUserId'),		
			'title'             => Yii::t('model','PostTitle'),
			'title_second'      => Yii::t('model','PostTitleSecond'),			
			'title_style'       => Yii::t('model','PostTitleStyle'),	
			'catalog_id'        => Yii::t('model','PostCatalogId'),
			'special_id'        => Yii::t('model','PostSpecialId'),
			'introduce'         => Yii::t('model','PostIntroduce'),			
			'seo_title'         => Yii::t('model','PostSeoTitle'),
			'seo_description'   => Yii::t('model','PostSeoDescription'),
			'seo_keywords'      => Yii::t('model','PostSeoKeywords'),
			'content'           => Yii::t('model','PostContent'),
			'copy_from'         => Yii::t('model','PostCopyFrom'),
			'copy_url'          => Yii::t('model','PostCopyUrl'),
			'redirect_url'      => Yii::t('model','PostRedirectUrl'),
			'tags'              => Yii::t('model','PostTags'),
			'view_count'        => Yii::t('model','PostViewCount'),
			'commend'           => Yii::t('model','PostCommend'),
			'favorite_count'    => Yii::t('model','PostFavoriteCount'),
			'top_line'          => Yii::t('model','PostTopLine'),			
			'reply_count'       => Yii::t('model','PostReplyCount'),
			'reply_allow'       => Yii::t('model','PostReplyAllow'),
			'sort_order'        => Yii::t('model','PostSortOrder'),			
			'status'            => Yii::t('model','PostStatus'),
			'create_time'       => Yii::t('model','PostCreateTime'),
            'update_time'       => Yii::t('model','PostUpdateTime'),
		);		
	}


	/**
	 * 返回指定的AR类的静态模型.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Post the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * 获取一定条件下的文章
	 * @param array $params = ('condition'=> '额外条件', 'order'=>'排序', 'with'=>'关联表', 'limit'=>'条数', 'page'=>'是否分页')
	 * @param $pages 分页widget
	 * @return array
	 */
	public static function getList($params = array(), &$pages = null){
		
		$pages = array();
        
        $params['condition'] = isset($params['condition'])?$params['condition']:'';
        $params['order']     = isset($params['order'])?$params['order']:'';
        $params['with']      = isset($params['with'])?$params['with']:'';
        $params['limit']     = isset($params['limit'])?$params['limit']:'';
        $params['page']      = isset($params['page'])?$params['page']:'';
		
		//组合条件
		$criteria = new CDbCriteria();
		$criteria->condition = 't.status=:status';
		$params['condition'] && $criteria->condition .= $params['condition'];		
		$criteria->order = $params['order']?$params['order']:'t.id DESC';
		$criteria->with = array ( 'catalog' );
		$criteria->select = "t.title, t.id,t.title_style, ";
		$criteria->select .= " t.copy_from, t.copy_url, t.update_time,t.introduce, t.tags, t.view_count";
		$criteria->params = array(':status'=> 'Y');
		$params['with'] && $criteria->with = (array)$params['with'];
		
		$limit = $params['limit']>0?intval($params['limit']):15;
		//是否分页
		if($params['page']){
			//分页
			$count = self::model()->count( $criteria );
			$pages = new CPagination( $count );
			$pages->pageSize = $limit;
            $pages->applyLimit($criteria);
		}else{
			$criteria->limit = $limit;
		}	
		
		$data = self::model()->findAll($criteria);					
		return $data ? $data : array();
	}
	
}
