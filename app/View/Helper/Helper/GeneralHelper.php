<?php
/**
 * General Helper
 *
 *
 * @category Helper
 */
class GeneralHelper extends AppHelper {
    /**
     * Other helpers used by this helper
     *
     * @var array
     * @access publicfdf
     */
	private $__callbacks = array(); 
	var $helpers = array('Html', 'Session', 'Form', 'Layout','Ajax');
	function displayingInformationFromConfig($option = null,$type = null){
		$options	=	Configure::read($type);
		foreach ($options as $key=>$value){
			if($key == $option){
				return $value;
			}
		}
	}
   function getCountryNameById($id = null){
      App::import('Model', 'Country');
		$CountryDetail = new Country();
		$countryName=$CountryDetail->find('first',array('conditions'=>array('Country.status'=>Configure::read('App.Status.active'),'Country.id'=>$id)));
		return $countryName['Country']['name'];
	}
	
   function wrap_long_txt($value=null,$start=null,$end=null){
		$len=strlen($value);
		if($len > $end){
			return mb_substr($value,$start,$end).'...';
		}else{
			return $value;
		}
	}
	function getCategoryNameById($id = null){
		/* App::import('Model','Category');
		$category=new Category(); 
		 $categoryName	=	$category->find('first', array('fields'=>array('name'),'conditions' => array('Category.id'=>$id,'Category.status'=>Configure::read('App.Status.active'))));		
		 return	$categoryName; 	 */
	}
	/*show date or time with different format*/
	function show_date_time($date_time=null,$type){		
		return date($type,strtotime(str_replace("-","/",$date_time)));
	}
	
	function get_income_expense_left($diary_variable = array(),$tot_amont = null)
	{
		
		$added_variable_amt = 0;
		if(empty($tot_amont)) return array('remaining'=>0,'percentage'=>100);
		foreach($diary_variable['DiaryVariable'] as $k_vari =>$v_vari){
			//pr($v_vari);
			$added_variable_amt = $added_variable_amt + $v_vari['amt_variable'];
		}
		$tot_amount_remaing = $tot_amont - $added_variable_amt;
		$tot_amount_remaing_per = ($added_variable_amt/$tot_amont) * 100;
		if($tot_amount_remaing_per >100){
			$tot_amount_remaing_per =100;
		}
		return array('remaining'=>$tot_amount_remaing,'percentage'=>$tot_amount_remaing_per);
		
	}
	
	
	function goal_status_bar($goal_varibale = array())
	{
		$target_amont = $goal_varibale['Goal']['amount'];
		$added_variable_amt = 0; 
		foreach($goal_varibale['GoalVariable'] as $key => $value ):
			$added_variable_amt = $added_variable_amt + $value['goal_amt'];
		endforeach;
		$tot_amount_remaing_per = ($added_variable_amt/$target_amont) * 100;
		$tot_percentage = ($added_variable_amt * 100)/($target_amont);
		if($tot_amount_remaing_per >100){
			$tot_amount_remaing_per = 100;
		}
		return array('remaining_goal'=>$added_variable_amt,'percentage_goal'=>$tot_amount_remaing_per,'tot_percentage'=>$tot_percentage); 
	}
	
	function process_bar_goal($goal_varibale = array(),$target_amont = null)
	{
		
		$added_variable_amt = 0;
		foreach($goal_varibale as $key => $value ):
			$added_variable_amt = $added_variable_amt + $value['GoalVariable']['goal_amt'];
		endforeach;
		$tot_amount_remaing_per = ($added_variable_amt/$target_amont) * 100;
		$tot_percentage = ($added_variable_amt * 100)/($target_amont);
		if($tot_amount_remaing_per >100){
			$tot_amount_remaing_per = 100;
		}
		return array('remaining_goal'=>$added_variable_amt,'percentage_goal'=>$tot_amount_remaing_per,'tot_percentage'=>number_format($tot_percentage,2)); 
	}
	function past_goal_complete($goal_varibale = array(),$target_amont = null)
	{
		$added_variable_amt = 0;
		foreach($goal_varibale as $key => $value ):
			$added_variable_amt = $added_variable_amt + $value['goal_amt'];
		endforeach;
		$tot_amount_remaing_per = ($added_variable_amt/$target_amont) * 100;
		$tot_percentage = ($added_variable_amt * 100)/($target_amont);
		if($tot_amount_remaing_per >100){
			$tot_amount_remaing_per = 100;
		}
		return array('remaining_goal'=>$added_variable_amt,'percentage_goal'=>$tot_amount_remaing_per,'tot_percentage'=>number_format($tot_percentage,2)); 
	}
	
	
	function calculate_budget_period($total_day ,$target_amt ,$goal_type   ){
		if(Configure::read('APP.budget_period_plan')=='weekly'){
			$number_of_budget_period =($total_day/7);
			$number_bp=(explode('.',$number_of_budget_period));
		}else if(Configure::read('APP.budget_period_plan')=='fortnightly'){
			$number_of_budget_period =($total_day/14);
			$number_bp=(explode('.',$number_of_budget_period));
		}else if(Configure::read('APP.budget_period_plan')=='monthly'){
			$number_of_budget_period =($total_day/30);
			$number_bp=(explode('.',$number_of_budget_period));
		
		}else if(Configure::read('APP.budget_period_plan')=='quarterly'){
			$number_of_budget_period =($total_day/90);
			$number_bp=(explode('.',$number_of_budget_period));
		}
		if($goal_type == "target_amount"){
			$remaning=($target_amt/$number_bp[0]);
		}else{
			$remaning=($target_amt*$number_bp[0]);
		}
		return $remaning;
	
	
	
	
		/* $budget_days_total =  $total_day;
		if(Configure::read('APP.budget_period_plan')=='weekly'){
			$number_of_budget_period =($budget_days_total/7);
			$number_bp=(explode('.',$number_of_budget_period));
			$remaning=($target_amt/$number_bp[0]);
			return $remaning;
			
		}else if(Configure::read('APP.budget_period_plan')=='fortnightly'){
			$number_of_budget_period =($budget_days_total/15);
			$number_bp=(explode('.',$number_of_budget_period));
			$remaning=($target_amt/$number_bp[0]);
			return $remaning;
		}else if(Configure::read('APP.budget_period_plan')=='monthly'){
			$number_of_budget_period =($budget_days_total/30);
			$number_bp=(explode('.',$number_of_budget_period));
			$remaning=($target_amt/$number_bp[0]);
			return $remaning;
		}else if(Configure::read('APP.budget_period_plan')=='quarterly'){
			$number_of_budget_period =($budget_days_total/90);
			$number_bp=(explode('.',$number_of_budget_period));
			$remaning=($target_amt/$number_bp[0]);
			return $remaning;
		} */
	
	}
	
	function dateDifference($startDate, $endDate)
	{
		$date1=date($endDate); // end date 
		$date2=date($startDate); // start date 
		//$date1=date('2014-3-1'); // end date 
		// $date2=date('2014-2-1'); // start date 
		
		/* echo "date1 : ".$date1."<br>";
		echo "date2 : ".$date2."<br>";
		echo "date difference in-days :: "; */
		$date_diff=strtotime($date1) - strtotime($date2);
		return  ($date_diff/(60 * 60 * 24)); //( 60 * 60 * 24) // seconds into days
	}
	
	function dateDifference1($previous, $next)
	{
			
		if(Configure::read('APP.budget_period_plan')=='weekly'){
			$budget_period_days =7;
		}else if(Configure::read('APP.budget_period_plan')=='fortnightly'){
			$budget_period_days =15;
		}else if(Configure::read('APP.budget_period_plan')=='monthly'){
			$budget_period_days =30;
		}else if(Configure::read('APP.budget_period_plan')=='quarterly'){
			$budget_period_days =90;
		}else{
			$budget_period_days =Configure::read('APP.budget_day');
		}
		$current_date 	= date('Y-m-d');
		$date1next=date($next); 
		$date_diff=strtotime($next) - strtotime($current_date);
		$budget_period_days1 =($date_diff/(60 * 60 * 24)); // seconds into days
			
		
		if($budget_period_days1 > $budget_period_days){
			$remaing_days = $budget_period_days;
			$remaing_days_per = 0;
		}else{
			if($budget_period_days1 >= 0){
				$remaing_days = $budget_period_days1;
				$remaing_days_per = (($budget_period_days - $budget_period_days1)/$budget_period_days)*100;
			}else{
				$remaing_days = 0;
				$remaing_days_per = 100;
			}
		}		
		$remaing_days = $remaing_days.' days';	
		return array('re_days'=>$remaing_days,'percentage'=>$remaing_days_per);	
	}
}