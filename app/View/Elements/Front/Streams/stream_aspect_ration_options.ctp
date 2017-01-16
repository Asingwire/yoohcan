<?php
 echo ($this->Form->input('Stream.aspect_ratio', array('empty'=>'--Select--','options'=>$aspect_ration_options,'div' => false, 'label' => 'Aspect Ratio<span class="red_star_mendatry">*</span>',"data-live-search"=>"true")));

if(empty($aspect_ration_options))
{
	?>
		<script>
			$("#bitrate_renditions").html('');
		</script>
	<?php
}


 ?>