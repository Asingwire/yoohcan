<?php echo $this->Element('photo_upload_js');?>
<div class="right-contant">  
<?php echo ($this->Element('Front/User/left_sub_menu'));?>
 <div class="col-md-9 dshboard_detail">  
 <h3>Account Settings</h3>
 <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#menu1">Account Details</a></li>
    <li><a data-toggle="tab" href="#menu2">Streamings Settings</a></li>
    <li><a data-toggle="tab" href="#menu3">Channel Design</a></li>
  </ul>

  
  
  <div class="tab-content">
    <div id="menu1" class="tab-pane fade active in">
     <div class="account-setting">
       <div class="left-detail" style="border-right:none;">
        <div class="profile-pic">
		<span class="userimageid"> 
		<?php
			$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.PROFILE_IMAGE_FULL_DIR.'/';
			$image		=	$userData['User']['profile_image'];			
			if($image &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$image )) {
				echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=102&h=102&a=t',array('title'=>$userData['User']['first_name'],'alt'=>$userData['User']['first_name']));
			} else {					
				 echo $this->Html->image('Admin/avatar5.png',array('escape'=>false,'alt'=>'No Image'));
			}
		 ?>
		 </span>
		<h5><?php echo $this->Html->link('Edit Avtar','javascript:;',array('class'=>'upload','escape'=>false)); ?>		
		</h5>
		</div>
        <div class="bio-data">
			<?php 
				echo $this->Form->create('User', array('url'=>array('controller' => 'tests', 'action' => 'dashboard',$id),'type' => 'file'));
				echo($this->Form->hidden('User.id'));
				echo($this->Form->hidden('User.status', array('value' => 1)));
			?>
			
          <div class="full-field">
            <div class="field-haff">
            <label>First Name</label>
            <?php echo $this->Form->input('User.first_name', array('placeholder'=>"First Name",'label' => false, 'div'=>false,'required'=>'required')); ?>
			</div>
            <div class="field-haff last">
            <label>Last Name</label>
			<?php echo $this->Form->input('User.last_name', array('placeholder'=>"Last Name",'label' => false, 'div'=>false,'required'=>'required')); ?>
			</div>            
          </div>
         
		  
          <div class="full-field">
           <label>Bio</label>
           <?php echo $this->Form->input('User.bio_update', array('type'=>'textarea','placeholder'=>"Write Here...",'label' => false, 'div'=>false)); ?>
          </div>
		  <?php /* ?>
          <div class="full-field">
           <label>E-mail Address</label>
           <?php echo $this->Form->input('User.email', array('placeholder'=>"Email",'label' => false, 'div'=>false,'required'=>'required')); ?>
          </div>
		  <?php */ ?>
		  <div class="full-field">
			   <label>Background Image</label>
				<div class="">
				<span class="userbackground"> 
				<?php
					$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.BACKGROUND_IMAGE_FULL_DIR.'/';
					$image		=	$userData['User']['background_image'];			
					if($image &&  file_exists(WWW_ROOT.BACKGROUND_IMAGE_FULL_DIR.DS.$image )) {
						echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=102&h=102&a=t',array('title'=>$userData['User']['first_name'],'alt'=>$userData['User']['first_name']));
					} else {					
						 echo $this->Html->image('Admin/avatar5.png',array('escape'=>false,'alt'=>'No Image'));
					}
				 ?>
				 </span>
				<h5><?php echo $this->Html->link('Update Background','javascript:;',array('class'=>'uploadCover','escape'=>false)); ?>		
				</h5>
				</div>
			  </div>
		  <?php echo $this->Form->button('Save changes', array('div'=>false));?>
		  <?php echo $this->Form->end();?> 			
        </div>
       </div>
       <!--
       <div class="right-detail">
         <div class="full-field">
           <label>Company Name</label>
           <input type="text" placeholder="TOOJH" />
          </div>
          <div class="full-field">
           <label>Website</label>
           <input type="text" placeholder="Dashboard.com" />
          </div>
          <div class="full-field">
           <label>Social Profie</label>
           <input class="tw-field" type="text" placeholder="@jnander" />
            <input class="fb-field" type="text" placeholder="Nander" />
          </div>
       </div>
     -->
     </div>
     
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Streamings Settings content</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit 

voluptatem accusantium doloremque laudantium, totam rem 

aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Channel Design Content</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et 

quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>
  
  
  
  <?php /*
  <div class="payment-discription">
  <div class="left-dis">
  <span class="edit"><a href="#"><?php echo ($this->Html->image('Front/edit.png')); ?></a></span>
    <div class="visa">
	<?php //echo ($this->Html->image('../img/Front/visa.png')); ?>
    
    </div>
    <div class="ac-dtl">
    <h4>Your Bank Account</h4>
    <p><span>Used Number:</span> 582 333<br />
      <span>User ID:</span>WX890EDkwe25</p>
    </div>
  </div>
  <div class="right-dis">
   <h4>How to use Yoohcan <span><a href="#">Visit FAQ Page</a></span></h4>
   <p><a href="#">How can i connect my bank account ?</a>
   <a href="#">Best Live Streaming softwere ?</a>
   <a href="#">Can i steam in HD ?</a></p>
  </div>
  </div>
  */ ?>
</div>

 
  </div>
  

