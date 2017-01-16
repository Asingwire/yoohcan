<header>
  <div class="top-header">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-4 col-xs-6 logo "><?php echo $this->Html->link($this->Html->image('Front/logo.png',array('title'=>'Yoohcan','alt'=>'Yoohcan')),array('controller'=>'homes','action'=>'index'),array('escape' => false,'title'=>'Yoohcan','alt'=>'Yoohcan')); ?>
			<p class="homeSlogan"><?php echo Configure::read('SITE_SLOGAN');?></p>
		</div>
        <div class="col-md-6 col-sm-5 col-xs-6 search">
         
			  <?php 
			  $searchData = "";
			  if(!empty($this->request->data['Channel']['keyword'])){
				 $searchData = $this->request->data['Channel']['keyword'];
			  }
				echo $this->Form->create('Channel', array('url' => array('controller' => 'channels', 'action' => 'index')));
			  ?>	
            <input type="search" name="data[Channel][keyword]" value="<?php echo $searchData; ?>" />
		
            <input type="submit" />
          <?php echo ($this->Form->end());?>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="admin">
			<?php  
					$nickname = "&nbsp;";
			if($this->Session->check('Auth.User'))
			{
			
					
						$nickname = $userData['User']['nickname'];						
						$user_name = (strlen($nickname) > 19) ? substr($nickname,0,18).'...' : $nickname;
						
						
				
			?>
				<h5 class="dropdown" id="account_dropdown" style="font-size:16px">
					<span class="userimageid">
					<?php
					$image		=	$userData['User']['profile_image'];
					$imagePath		=	IMAGE_PATH_FOR_TIM_THUMB.'/'.PROFILE_IMAGE_FULL_DIR.'/';
					
					if($image &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$image )) {
						
						echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=50&h=50&a=t',array('alt'=>$user_name,'title'=>$user_name,'class'=>'imgClass'));
					}
					else
					{
						echo $this->Html->image('Admin/avatar5.png', array('width'=>'50','height'=>'50','alt'=>'no image','title'=>'no image'));
					}
					?>	
					</span>
					<?php  //echo $user_name; ?>
					
					<style>
					.user_nick_name{
						color: #4b96aa;
					
					
					}
					.user_nick_name:hover{
						color: #4b96aa;
					}
					</style>
					
					
					<?php  echo $user_name; ?> 
				</h5>
				<ul class="open-drop" id="account_open-drop">
				  <li><?php echo $this->Html->link('Account Settings',array('controller'=>'users','action'=>'dashboard'),array('escape' => false)); ?></li>
				  <?php /*<li><?php echo $this->Html->link('My Profile',array('controller'=>'users','action'=>'dashboard'),array('escape' => false)); ?></li>*/ ?>
				  <li><?php echo $this->Html->link('FAQ',array('controller'=>'static_pages', 'action'=>'page','slug'=>Faq), array('escape'=>false));?></li>
				  <li><?php echo $this->Html->link('Logout',array('controller'=>'users','action'=>'logout'),array('escape' => false)); ?></li>
				</ul>
			<?php
			}
			else
			{
			
			?>
				<h5 class="sign-up">
					<a href="javascript:;" data-toggle="modal" data-target="#signupModal" class="sign_btn">Sign Up</a>&nbsp;
					<a href="javascript:;" data-toggle="modal" data-target="#loginModal" class="login_btn">Login</a>&nbsp;
					
				</h5>
			<?php
			}
			?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php /* <div class="paddrileft"><?php //$this->Layout->sessionFlash(); ?></div> */ ?>
</header>


<script>


	

				
			


 	 
	function user_login(){
		
		/* if($("#login_terms_conditions").is(':checked'))
		{ */
			$('#loading_login_img').css('visibility','visible');
			 $.ajax({
			   type: "POST",
			   url: "<?php echo $this->Html->url(array("controller"=>"users","action"=>"login")) ;?>",
			   data: $("#login_form").serialize(), // serializes the form's elements.
			   success: function(data)
			   {	
				   $("#login_popup").html(data); // show response from the php script.
				   
			   }
			 });
		/* }
		else
		{
			$('#terms_checkbox').remove();
			$('#login_terms_conditions').after('<div id="terms_checkbox" class="error-message">Please check this box if you want to proceed.</div>');
		} */
	
	}
	
	function user_registration(){
		
		/* when the submit button in the modal is clicked, submit the form */
			$('#loading_signup_img').css('visibility','visible');	
			 $.ajax({
			   type: "POST",
			   url: "<?php echo $this->Html->url(array("controller"=>"users","action"=>"register")) ;?>",
			   data: $("#signup_form").serialize(), // serializes the form's elements.
			   success: function(data)
			   {					
				   $("#signup_popup").html(data); // show response from the php script.
				  // $(".white-outer input").attr("value",""); // show response from the php script.

			   }
			 });
	
	}



	$(document).ready(function(){
	
		$(function(){  
			$('#signupModal').on('click', function () {
			  $('.alert').remove();
			  $('.error-message').remove();
			});
			$('#loginModal').on('click', function () {
			  $('.alert').remove();
			  $('.error-message').remove();
			});
		});
	});	
	
		//$(".sign-up a").colorbox({ width: "100%"});
		$(document).on('click','#signup_submit',function(){
			user_registration();
		});	
		
		
		
		$(document).on('click','#login_submit_button',function(){	

			
		
			/* when the submit button in the modal is clicked, submit the form */
			user_login();
		});	
		
		$(document).on('click','.login_btn',function(){	

			
			if($('#loginModal').length == 1)
			{
				document.onkeypress = keyPress;
				function keyPress(e){
					var x = e || window.event;
					var key = (x.keyCode || x.which);		
					if(key == 13 || key == 3){
						  var button_value = $('input:button').val();
							user_login();						
					}
				}	
			}
			
		});	
		
		
		$(document).on('click','.sign_btn',function(){	

			
			if($('#signupModal').length == 1)
			{
				document.onkeypress = keyPress;
				function keyPress(e){
					var x = e || window.event;
					var key = (x.keyCode || x.which);		
					if(key == 13 || key == 3){
						  var button_value = $('input:button').val();							
							user_registration();
					}
				}
			}
			
		});	
		
		
				
		$(document).on('click','#foget_submit',function(){	
			$('#loading_forget_img').css('visibility','visible');	
			 $.ajax({
			   type: "POST",
			   url: "<?php echo $this->Html->url(array("controller"=>"users","action"=>"forgot_password")) ;?>",
			   data: $("#forget_form").serialize(), // serializes the form's elements.
			   success: function(data)
			   {
					
				   $("#forget_popup").html(data); // show response from the php script.
			   }
			 });
		});	
	
		
		
		
</script>


  <div class="modal fade" id="signupModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
	 
      <div class="modal-content">
	   <div class="container container_custom" id="signup_popup">
			<?php echo $this->Element('/Front/User/sign_up'); ?>
		</div>	
	   </div>
	</div>
  </div>
  
  <div class="modal fade" id="loginModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
			<div class="modal-content">
			<div class="container container_custom" id="login_popup">
				<?php echo $this->Element('/Front/User/login'); ?>
			</div>		
			</div>
	</div>
  </div>


<div class="modal fade" id="forgetModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
	  
		<div class="modal-content">
		<div class="container container_custom" id="forget_popup">
			<?php echo $this->Element('/Front/User/forget'); ?>
		</div>	
	   </div>
	  
	</div>
</div>
  
<script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
<div id="fb-root"></div>
<script type="text/javascript">
	function fbInit(){
		FB.init({appId: "<?php echo Configure::read("FACEBOOK_APP_ID");?>", status: true, cookie: false, xfbml: true});
		var response="";
		FB.login(function(response) 
		{
			if (response.authResponse) 
			{
				FB.api('/me', { locale: 'en_US', fields: 'id,first_name,last_name,name,email,picture' }, function(response)
				{
					var uid=response.id;
				if(uid > 1)
				{	
					fb_doLogin(response);
				}
				});
			}
		}, {
		scope:'email,user_friends'
		}); 
	}

	function fb_doLogin(response)
	{
		jQuery.ajax({
			type:'POST',	
			url: "<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'fbSessionData'));?>",
			data:response,
			beforeSend:function(xhr){
			},
			success: function(data){
				if(data == 0){				
					window.location.href = "<?php echo $this->Html->url(array('controller'=>'homes', 'action'=>'index'));?>";
				}else{
					window.location.href = "<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'dashboard'));?>";				
				}				
			}
		});
	}	
	
	/* $("#foggetLink").click(function(){        
         $('#loginModal').modal('hide');
    }); */
	
	
</script>


<script type="text/javascript">
	function fbverification(){
		FB.init({appId: "<?php echo Configure::read("FACEBOOK_APP_ID");?>", status: true, cookie: false, xfbml: true});
		var response="";
		FB.login(function(response) 
		{
			if (response.authResponse) 
			{
				FB.api('/me', { locale: 'en_US', fields: 'id,first_name,last_name,name, email,picture' }, function(response)
				{
					var uid=response.id;
				if(uid > 1)
				{	
					fb_verifi_user(response);
				}
				});
			}
		}, {
		scope:'email,user_friends'
		}); 
	}

	function fb_verifi_user(response)
	{
		jQuery.ajax({
			type:'POST',	
			url: "<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'fb_verifi_user'));?>",
			data:response,
			beforeSend:function(xhr){
			},
			success: function(data){
					window.location.href = "<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'dashboard'));?>";	
				
			}
		});
	}	
	

	
	/* $(document).on('click','#foggetLink',function(){
		$('#signupModal').modal('hide');
        $('#loginModal').modal('hide');
	})
	
	$(document).on('click','#login_submit',function(){
	
		$('#signupModal').modal('hide');
         $('#forgetModal').modal('hide');
	})
	
	$(document).on('click','#signupLink',function(){
		$('#forgetModal').modal('hide');
        $('#loginModal').modal('hide');
	})
	
	$(document).on('click','.create_account',function(){
		$('#loginModal').modal('hide');
		$('#signupModal').modal('show');
	})
	 */
	
	
	/* $("#foggetLink").click(function(){   
         $('#signupModal').modal('hide');
         $('#loginModal').modal('hide');
    });
	
	$("#login_submit").click(function(){        
         $('#signupModal').modal('hide');
         $('#loginModal').modal('hide');
    });
	
	$("#signupLink").click(function(){        
         $('#forgetModal').modal('hide');
         $('#loginModal').modal('hide');
    });
	
	$(".create_account").click(function(){    
		$('#loginModal').modal('hide');
		$('#signupModal').modal('show');
    }); */
	
	
	
	
	
	
	/* $("#foggetLink").click(function () {
	$("#loginModal").modal("hide");
	}); */
	
	
	$('.modal').on('hidden.bs.modal', function (e) {
		if($('.modal').hasClass('in')) {
		$('body').addClass('modal-open');
		}    
	});
	
	
	$(document).on('click','.social_icons',function(){
		//alert($(this).attr('data-attr'));
		/* if($("#login_terms_conditions").is(':checked'))
		{ */
			if($(this).attr('data-attr') == 'facebook_login')
			{
				fbInit();
			}
			else if($(this).attr('data-attr') == 'twitter_login')
			{
				window.location.href = "<?php echo $this->Html->url(array('controller'=>'users','action'=>'tlogin')); ?>";
			}
			else if($(this).attr('data-attr') == 'linkdin_login')
			{
				window.location.href = "<?php echo $this->Html->url(array('controller'=>'users','action'=>'linkedinlogin')); ?>";
				
			}
			
		/* }
		else
		{
			$('#terms_checkbox').remove();
			$('#login_terms_conditions').after('<div id="terms_checkbox" class="error-message">Please check this box if you want to proceed.</div>');
		} */
	
	})


</script>
	