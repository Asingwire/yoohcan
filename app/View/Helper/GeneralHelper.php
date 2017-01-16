<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('SessionHelper', 'View/Helper');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
App::uses('Model', 'Model');
class GeneralHelper extends Helper {

	var $helpers = array('Html', 'Session');
	
	
	public  function nicetime($date){
		if(empty($date)) {
			return "No date provided";
		}
	 
		$periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
		$lengths         = array("60","60","24","7","4.35","12","10");
	 
		$now             = time();
		$unix_date         = strtotime($date);
	 
		   // check validity of date
		if(empty($unix_date)) {    
			return "Bad date";
		}
	 
		// is it future date or past date
		if($now > $unix_date) {    
			$difference     = $now - $unix_date;
			$tense         = "ago";
	 
		} else {
			$difference     = $unix_date - $now;
			$tense         = "from now";
		}
	 
		for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
			$difference /= $lengths[$j];
		}
	 
		$difference = round($difference);
	 
		if($difference != 1) {
			$periods[$j].= "s";
		}
	 
		return "$difference $periods[$j] {$tense}";
	}
	
	
	
	function getCategoriesList() {
		$categoryObj	= 	ClassRegistry::init('Category');
		$categoryList	=	$categoryObj->find('list',array('conditions'=>array('Category.status'=>1)));
		
		return $categoryList;
		
	}
	
	function getCategoriesArray() {
		
		$categoryObj	= 	ClassRegistry::init('Category');
		$categoryList	=	$categoryObj->find('all',array('fields'=>array('id','name'),'conditions'=>array('Category.status'=>1)));
		
		return $categoryList;
		
	}
	
	/*
		function : getRestaurantCategoryName
		parameter : catids
	*/
	
	function getRestaurantCategoryName($ids = null) {
		
		$categoryObj	= 	ClassRegistry::init('Category');
		$catArray		=	$categoryObj->find('all',array('fields'=>array('name'),'conditions'=>array('Category.id'=>$ids)));
		
		$catNames	=	'';
		if(!empty($catArray)) {
			foreach ($catArray AS $row) {
				$catNameArray[]	=	$row['Category']['name'];
			}
			$catNames	=	implode(',',$catNameArray);
		}
		
		return $catNames;
	}
	
	
	function getRestaurantRating($restaurant_id = null) {
		
		$feedbackObj	= 	ClassRegistry::init('UserFeedback');
		
		$feedbackAvg	=	$feedbackObj->find('first',array('fields'=>array('AVG(UserFeedback.rating) AS rating'),'conditions'=>array('UserFeedback.restaurant_id'=>$restaurant_id,'UserFeedback.status'=>1)));
		
		$feedbackCount	=	$feedbackObj->find('count',array('conditions'=>array('UserFeedback.restaurant_id'=>$restaurant_id,'UserFeedback.status'=>1)));
		
		$data['rating_count']	=	$feedbackCount;
		$data['rating_avg']		=	number_format($feedbackAvg[0]['rating']);
		
		return $data;
	}
	
	
	function checkRestaurantOffers($restaurant_id = null) {
		
		$couponObj		= 	ClassRegistry::init('Coupon');
		$currentDate	=	time();
		$couponCount	=	$couponObj->find('count',array('conditions'=>array('Coupon.restaurant_id'=>$restaurant_id,'Coupon.status'=>1,'Coupon.start_date <='=>$currentDate,'Coupon.end_date > '=>$currentDate)));
		
		return $couponCount;
	}
	
	function getRestaurantOffers($restaurant_id = null) {
		
		$couponObj		= 	ClassRegistry::init('Coupon');
		$currentDate	=	time();
		$coupons	=	$couponObj->find('all',array('conditions'=>array('Coupon.restaurant_id'=>$restaurant_id,'Coupon.status'=>1,'Coupon.start_date <='=>$currentDate,'Coupon.end_date > '=>$currentDate)));
		
		return $coupons;
	}
	
	function getPopularCategories() {
		
		$categoryObj	= 	ClassRegistry::init('Category');
		$restaurantObj	= 	ClassRegistry::init('Restaurant');
		
		$restaurantArray	=	$restaurantObj->find('all',array('fields'=>array('Restaurant.id','Restaurant.restaurant_category_id'),'conditions'=>array('Restaurant.status'=>1)));
		
		if(!empty($restaurantArray)) {
			foreach ($restaurantArray AS $restaurant) {
				$categories	=	explode(',',$restaurant['Restaurant']['restaurant_category_id']);
				if(!empty($categories)) {
					foreach ($categories AS $key=>$val) {
						if(isset($result[$val])) {
							$result[$val]['sort']	+=	1;		
						} else {
							$catInfo	=	$categoryObj->find('first',array('fields'=>array('Category.id','Category.name'),'conditions'=>array('Category.id'=>$val)));
							$result[$val]['sort']	=	1;
							$result[$val]['id']			=	$catInfo['Category']['id'];
							$result[$val]['name']		=	$catInfo['Category']['name'];
						}
					}
				}
			}
		}
		
		$this->aasort($result,"sort");
		
		if(count($result) >= 6) {
			array_splice($result, 6, count($result));
		}
		
		CakeSession::write('popular_categories', $result);
		
		return $result;
	}
	
	function getPopularRestaurants() {
		
		$restaurantObj		= 	ClassRegistry::init('Restaurant');
		$restaurantArray	=	$restaurantObj->find('all',array('fields'=>array('Restaurant.id','Restaurant.name','Restaurant.slug'),'conditions'=>array('Restaurant.status'=>1),'order'=>array('Restaurant.avg_rating'=>'DESC'),'limit'=>6));
		
		CakeSession::write('popular_restaurants', $restaurantArray);
		
		return $restaurantArray;
	}
	
	function aasort (&$array, $key) {
		$sorter=array();
		$ret=array();
		reset($array);
		foreach ($array as $ii => $va) {
			$sorter[$ii]=$va[$key];
		}
		arsort($sorter);
		foreach ($sorter as $ii => $va) {
			$ret[]=$array[$ii];
		}
		$array=$ret;
	}
	
	function getRelativeTime($date) {
		$diff = time() - strtotime($date);
		if ($diff<60)
			return $diff . " second" . $this->plural($diff) . " ago";
		$diff = round($diff/60);
		if ($diff<60)
			return $diff . " minute" . $this->plural($diff) . " ago";
		$diff = round($diff/60);
		if ($diff<24)
			return $diff . " hour" . $this->plural($diff) . " ago";
		$diff = round($diff/24);
		if ($diff<7)
			return $diff . " day" . $this->plural($diff) . " ago";
		$diff = round($diff/7);
		if ($diff<4)
			return $diff . " week" . $this->plural($diff) . " ago";
		return "on " . date("M j, Y", strtotime($date));
	}
	
	
	function plural($num) {
		if ($num != 1)
		return "s";
	}
	
	public function getStaticPages(){	
		
		$staticPageObj		= 	ClassRegistry::init('StaticPage');
		$staticPageObjArray	=	$staticPageObj->find('all',array('conditions'=>array('StaticPage.status'=>1),'order'=>array('StaticPage.title'=>'asc')));
		return $staticPageObjArray;
		
	}
	
	
	
}
