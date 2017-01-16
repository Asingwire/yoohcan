<div class="right-contant" style="min-height:800px;">  

<div class="col-md-12 dshboard_detail">  
 <h3 class="static-hd"><?php echo $data['StaticPage']['title']; ?></h3>

  <div class="tab-content">
    <div id="menu1" class="tab-pane fade active in">
		<div class="account-setting static-main-cnt" style="border-top:1px solid #e8e9ed;border-radius:5px;margin-bottom:30px;">
			<?php 
				if(!empty($data)) {
					echo $data['StaticPage']['description'];
				}
			?>
		</div>
    </div>
  </div> 
</div>
</div>


<?php echo ($this->element('Front/footer'))?>
