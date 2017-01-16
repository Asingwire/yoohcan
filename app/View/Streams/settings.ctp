<div class="right-contant"> 
<?php 
/* <div class="dashboard-menu col-md-3" style="display:none;">
<h4>Menu <span><a href="#"><img src="images/setting.png" alt="" /></a></span></h4>
<ul class="dashbord-menu01">
<li><a href="#">Account Settings</a></li>
<li><a href="#">Messages</a><span>54</span></li>
<li><a href="#">Channel</a></li>
<li><a href="#">Video Manager</a></li>
<li><a href="#">Logout</a></li>
</ul>

<h4>Your Products <span><a href="#"><img src="images/setting.png" alt="" /></a></span></h4>
<ul class="dashbord-menu02">
<li class="faq"><a href="#">FAQ</a></li>
<li class="tutorial"><a href="#">Tutorials</a></li>
<li class="help"><a href="#">Help</a></li>
<li class="statist"><a href="#">Statistics</a></li>
</ul>

<h4>MOre At yoohcan <span><a href="#"><img src="images/setting.png" alt="" /></a></span></h4>
<ul class="dashbord-menu03">
<li><a href="#">About</a></li>
<li><a href="#">Blog</a></li>
<li><a href="#">Press</a></li>
<li><a href="#">Terms</a></li>
<li><a href="#">Privacy</a></li>   
</ul>


</div> */
?>
	<div class="col-md-12 channel_detail">  
		<h3><?php echo $title_for_layout; ?></h3>
		<?php echo ($this->Element('Front/User/left_sub_menu'));?>

		<div class="col-md-10">
			<div class="col-md-8 streaming-box_70">
				<p>Streaming Settings</p>
				<div class="stream-details-box">
					<div class="full-box">
						<h3 class="heading">Stream Details</h3>
						<div class="button-redio radio1">

						<input id="radio1" type="radio" name="radio" value="1" checked="checked"><label for="radio1"><span><span></span></span>Static</label>
						</div>
						<div class="button-redio">
						<input id="radio2" type="radio" name="radio" value="2"><label for="radio2"><span><span></span></span>Dynamic</label>
						</div>
					</div>
					<div class="full-box">
						<h3 class="heading">Stream Key</h3>
						<div class="renew_box">
						<input name="" type="text" class="form-control frm" placeholder="dsfd dsdsg sfds" />
						<a class="RENEW_BTN" href="#">RENEW</a>
						</div>
						<div class="tongle_list">
						<p>Show credentials (toggle on/off) <span><input type="checkbox" name="check-3" value="6" class="lcs_check lcs_tt1" checked="checked" autocomplete="off" /></span></p>
						</div> 
					</div>
					<div class="full-box">
						<div class="tongle_list ">
						<p class="disable">Video recordings (toggle on/off) <span> <input type="checkbox" name="check-1" value="4" class="lcs_check" autocomplete="off" /></span></p>
						</div>       

					</div>
					<div class="full-box">
						<h3 class="heading">Region</h3>
						<div class="drop-menu">
						<select class="selectpicker">
						<option>Automatic</option>
						<option>Automatic</option>
						<option>Automatic</option>
						</select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4  streaming-box_30">
				<div class="stream-details-box">
					<div class="full-box border-none">
					<h3 class="heading">Is this your first time streaming?</h3>
					<p>Here’s a few streaming apps.</p>
					</div>
					<div class="full-box border-none">
						<ul class="strem-logo">
						<li><?php echo $this->Html->link($this->Html->image('Front/stream-logo1.png'),"#",array('escape'=>false)); ?></li>
						<li><?php echo $this->Html->link($this->Html->image('Front/stream-logo2.png'),"#",array('escape'=>false)); ?></li>
						<li><?php echo $this->Html->link($this->Html->image('Front/stream-logo3.png'),"#",array('escape'=>false)); ?></li>
						<li><?php echo $this->Html->link($this->Html->image('Front/stream-logo4.png'),"#",array('escape'=>false)); ?></li>
						<li><?php echo $this->Html->link($this->Html->image('Front/stream-logo5.png'),"#",array('escape'=>false)); ?></li>
						<li><?php echo $this->Html->link($this->Html->image('Front/stream-logo6.png'),"#",array('escape'=>false)); ?></li>
						<li><?php echo $this->Html->link($this->Html->image('Front/stream-logo7.png'),"#",array('escape'=>false)); ?></li>
						</ul>
					</div>
					<div class="full-box border-none">
						<a class="fq_link" href="#">Visit FAQ Page for more info</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>