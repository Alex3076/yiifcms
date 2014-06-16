<?php
/**
 * 
 * 后端控制类  所有控制器需要验证
 * @author zhaojinhan <326196998@qq.com>
 * @copyright Copyright (c) 2014-2015 Personal. All rights reserved.
 * @version v1.0.0
 * 
 */
class Backend extends BackendBase
{	
	public function init(){		
		parent::init();			
		parent::auth();
	}
	/**
	 * 所有后台权限控制
	 * 
	 * @param key Controller Name
	 * @pamra value Action Name
	 * 
	 * @return array
	 */
	public function acl(){
		$acl = array(
			'default' => 'login',       									//后台登录
			'setting' => array('seo','upload','template','custom'), 		//网站设置
			'catalog' => array('index','create','update','delete','batch'), //栏目管理
			'post' => array('index','create','update','delete','tags','batch'), //内容管理	
			'comment' => array('index','update','batch'),   //评论管理
			'recommendPosition' => array('index','create','update','delete', 'view','batch'), //推荐位管理
			'special' => array('index','create','update','delete','batch'), //专题管理
			'user' => array('index','create','update','delete','batch', 'group', 'groupCreate','groupUpdate'), 	//用户管理
			'question' => array('index','update','batch'), 					//留言管理
			'link' => array('index','create','update','delete','batch'), 	//链接管理
			'adPosition' => array('index','create','update','delete','batch'),//广告位管理
			'ad' => array('index','create','update','delete','batch'), 		//广告管理
			'attach' => array('index','batch'), 							//附件管理					
			'database' => array('index','query','doQuery','execute','export', 'database','operate'), 		//数据库管理
		
		);
		return $acl;
	}
	
	/**
	 * 校验权限
	 * 
	 * @param string $acl
	 * @return boolean
	 */
	public function checkAcl($acl=''){
		$bool = false;
		$groupid = Yii::app()->user->groupid;
		if($groupid && $acl){
			$group = UserGroup::model()->findByPk($groupid);			
			if($group->acl){
				if($groupid == $this->_adminGroupID && $group->acl == 'Administrator'){
					$bool = true;
				}else {
					$acl = str_replace('/', '|', $acl);				
					if(strstr($group->acl, $acl)){
						$bool = true;
					}
				}			
			}
		}
		return $bool;		
	}
}