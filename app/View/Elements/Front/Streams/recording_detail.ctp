<?php $this->Layout->sessionFlash(); ?>
<?php echo $this->Form->create('RecordingStream',array('url'=>array('controller'=>'channels','action'=>'edit_recording'),'id'=>'setting_recording_form','class'=>'form-horizontal')); ?>

	<div class="form-group">
		<div class="col-sm-12">
		<?php echo($this->Form->hidden('RecordingStream.id')); ?>
			<?php echo ($this->Form->input('RecordingStream.title', array('required' => false,'placeholder'=>'Streaming Title',"type"=>"text","div"=>false,"label"=>'Title',"class"=>"form-control"))); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<?php echo ($this->Form->input('RecordingStream.description', array('required' => false,'placeholder'=>'Description',"type"=>"textarea","div"=>false,"label"=>'Description',"class"=>"form-control"))); ?>
		</div>
	</div>

        <div class="modal-footer md-footer">
        <button type="button" class="btn btn-default can" data-dismiss="modal">CANCEL</button>
          <button type="button" id="streming_recording_submit" class="btn btn-default don">DONE</button>
        </div>
		
			<style>


.loading_stream {
		background-color: #fff;
		display: block;
		height: 100%;
		left: 0;
		opacity: 0.7;
		position: fixed;
		text-align: center;
		top: 207px;
		width: 100%;
		z-index: 99;
}

#loading-bank-image {
	left: 281px;
	position: absolute;
	right: 96px;
	top: 192px;
	z-index: 100;
}

</style>
<div class="loading_stream" id="loading_stream_img" style="visibility:hidden">
	<img id="loading-bank-image" src="../img/ajax-loader.gif">
</div>	
		
		
		
<?php echo $this->Form->end(); ?>
	