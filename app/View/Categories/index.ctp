<div class="right-contant" style="min-height:800px;">
	<div class="channel_contant">
		<div class="header_title">
			<h2><?php echo $title_for_layout;?></h2> 
			<?php
		/* 	<ul class="grib_contrl">
				<li><?php echo $this->Html->link($this->Html->image('Front/grid_view.jpg',array('alt'=>'Grid View','title'=>'Grid View')),"#",array('escape'=>false,'alt'=>'Grid View','title'=>'Grid View')); ?></li>
				<li><?php echo $this->Html->link($this->Html->image('Front/list_view.jpg',array('alt'=>'List View','title'=>'List View')),"#",array('escape'=>false,'alt'=>'List View','title'=>'List View')); ?></li>
				<li><?php echo $this->Html->link($this->Html->image('Front/progress.jpg',array('alt'=>'Progress','title'=>'Progress')),"#",array('escape'=>false,'alt'=>'Progress','title'=>'Progress')); ?></li>
			</ul> */
			?>
		</div>
		<?php
		if(!empty($category_listing))
		{
		?>
		<ul class="channel_list">
		
			<?php
			foreach($category_listing as $category_key=>$category_value)
			{
				$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.CATEGORY_IMAGE_FULL_DIR.'/';
				$image		=	$category_value['Category']['image'];	
			?>
				<li>
					<div>
					<a href="<?php echo $this->Html->url(array('controller'=>'categories','action'=>'category_detail',$category_value['Category']['id'])); ?>">
						<?php
						if($image &&  file_exists(WWW_ROOT.CATEGORY_IMAGE_FULL_DIR.DS.$image )) {
							echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=280&h=158&a=t',array('title'=>$category_value['Category']['name'],'alt'=>$category_value['Category']['name'],'class'=>''));
						} else {					
							echo $this->Html->image('Front/channel-img.jpg',array('escape'=>false,'alt'=>'No Image','class'=>''));
						}
						?>
					</a>
							<span>
					
					<?php 
						$cat_name = "&nbsp;";
						if(!empty($category_value['Category']['name']))
						{
							$cat_name = $category_value['Category']['name'];
							$string = (strlen($cat_name) > 23) ? substr($cat_name,0,20).'...' : $cat_name;
						}
					
					
					?>
					
					<?php echo $this->Html->link($string,array('controller'=>'categories','action'=>'category_detail',$category_value['Category']['id']),array('escape'=>false,'alt'=>'Progress','title'=>'Progress','style'=>'color:#fff;float:left;width:100%!important;')); ?>
					</span>
					</div>					
				</li>
			<?php
			}
			?>
		</ul>
		<?php echo $this->element('Front/front_paging', array("paging_model_name" => "Category", "total_title" => "Category"));  ?>
		<?php
		}
		else
		{
			echo $this->Element('no_record_found',array('message'=>'No channels found.'));
		}
		?>
	</div>
 </div>
 <?php echo ($this->element('Front/footer'))?>