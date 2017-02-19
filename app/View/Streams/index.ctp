<div class="right-contant" style="min-height:800px;">  
	<div class="col-md-12 channel_detail">
		
		<?php $this->Layout->sessionFlash(); ?>
		<h3><?php //echo $title_for_layout; ?></h3>
		<?php echo ($this->Element('Front/User/left_sub_menu'));?>
		<div class="tab-content">			
			
			<div class="table-responsive" style="float: left;margin-left: 14px;width: 50%;">
		
				<div class="col-md-12 streaming-box_70 set-left">
					<div class="row">
						<p class="hedding_in">My Streams </p>
						<span class="pull-right"><?php  echo ($this->Html->link('Add Stream', array('controller'=>'streams','action' => 'add'), array('escape' => false,'title'=>'start', 'type'=>'button', 'class'=>'btn btn-primary'))); ?></span>
					</div>
				</div>

				<?php if(!empty($data)){ $c=1; foreach($data as $key=>$val){ ?>
				<table class="table table-condensed table-striped">
					<thead>
						<tr>
							
							<th>Stream <?php echo $c; ?></th>
							<th></th>
							
						</tr>
					</thead>
					<tbody>
						
						<tr>
							<th class="colour_blue">Stream Image</th>
							<td style="">
							<?php
							
							$imagePath		=	IMAGE_PATH_FOR_TIM_THUMB.'/'.STREAM_IMAGE_FULL_DIR.'/';
								$image		=	$val['Stream']['stream_image'];
												
							$noImage	=	'avatar5.png';
							if($image &&  file_exists(WWW_ROOT.STREAM_IMAGE_FULL_DIR.DS.$image )) {
								echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=50&h=50&a=t',array('class'=>'','alt'=>$val['Stream']['title'],'class'=>'imgClass'));
							} else {
								echo $this->Html->image('Front/stream_no_image.png',array('escape'=>false,'class'=>'','alt'=>$val['Stream']['title'],'height'=>'50','width'=>'50','class'=>'imgClass'));
							} 
							
							
							
							?>
							
							</td>
							</tr>

							<tr>
							<th class="colour_blue resource-name">Stream Name</th>
							<td><?php echo $val['Stream']['title']; ?></td>
							</tr>

							<tr>
							<th class="colour_blue">Stream Key</th>
							<td><?php
								echo $val['Stream']['stream_key'];
							?></td>
							</tr>

							<tr>
							<th class="colour_blue">RTMP/FMS PUSH URL</th>
							<td><?php
								echo $val['Stream']['rtmp_url'];
							?></td>
							</tr>

							<tr>
							<th class="colour_blue">MPD URL</th>
							<td><?php
								echo $val['Stream']['stream_mpd_url'];
							?></td>
							</tr>

							<tr>
							<th class="colour_blue">HLS URL</th>
							<td><?php
								echo $val['Stream']['stream_hls_url'];
							?></td>
							</tr>

							<tr>
							<th class="colour_blue">Audio Sample Rate (Format)</th>
							<td><?php
								echo '48 kHz';
							?></td>
							</tr>

							<tr>
							<th class="colour_blue">Video Frame Rate (FPS)</th>
							<td><?php
								echo '24.00 FPS';
							?></td>
							</tr>

							<tr>
							<th class="colour_blue">Status</th>
							<td><?php if($val['Stream']['instance_status'] == 1){
								echo 'RUNNING';
							}else{ echo 'TERMINATED'; }
							?></td>
							</tr>

							<tr>
							<th class="colour_blue resource-link">Actions</th>
							<td>
							
							<?php 
							/*echo $this->Html->link($this->Html->image('Front/edit.png',array('alt'=>'edit','title'=>'edit')),array('controller'=>'streams','action'=>'edit',$val['Stream']['id']),array('escape'=>false,'alt'=>'edit','title'=>'edit'));*/

							/*echo ($this->Html->link('<span class="glyphicon glyphicon-facetime-video "></span>', array('action' => 'detail', $val['Stream']['id']), array('escape' => false,'style'=>'color:#343c47;','title'=>'Play')));
							echo "&nbsp;";*/
							
							
							/*echo ($this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $val['Stream']['id']), array('escape' => false,'style'=>'color:#343c47;','title'=>'Delete')));
							echo "&nbsp;";*/

							if($val['Stream']['instance_status'] == 1){
							echo ($this->Html->link('<span class="glyphicon glyphicon-off"></span>', array('action' => 'terminate', $val['Stream']['instance_id']), array('escape' => false,'style'=>'color:#343c47;','title'=>'Shutdown')));
							}
							
							/* if(!empty($val['Stream']['stream_key']))
							{
							
								
								
								
								if(empty($val['Stream']['state']))
								{
									echo "&nbsp;&nbsp;";
									echo ($this->Html->link('Start', array('action' => 'start', $val['Stream']['id']), array('escape' => false,'title'=>'start')));
								}
								elseif($val['Stream']['state'] == '1')
								{
									echo "&nbsp;&nbsp;";
									echo ($this->Html->link('Stop', array('action' => 'stop', $val['Stream']['id']), array('escape' => false,'title'=>'stop')));
								}
								elseif($val['Stream']['state'] == '2')
								{
									echo "&nbsp;&nbsp;";
									echo ($this->Html->link('Start', array('action' => 'start', $val['Stream']['id']), array('escape' => false,'title'=>'start')));
								}
							}
							 */
							?>
							
							
							
							
							</td>
						</tr>
						
						
							<td colspan="2"></td>
						</tr>						
					</tbody>
				</table>
					<?php $c++; } } else {?>
						
						<div>
							<td colspan="2"><?php  echo $this->Element('no_record_found',array('message'=>'No stream found.')); ?></td>
						</div>
						
						
						
						<?php
						}
						?>
						<tr>
			</div>
		</div>
	</div>
</div>
<?php echo $this->element('Front/footer'); ?>
