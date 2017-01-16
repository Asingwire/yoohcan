<?php if($this->Paginator->params['paging'][$paging_model_name]['pageCount'] >= 2){ ?>
<div class="pagination">
 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="background_paging">    
      <tr>
          <td class="paging">
			 <?php
			    echo $this->Paginator->prev($this->Html->image('/img/Admin/prev.gif', array('border' => '0')), array('escape' => false));
			    echo $this->Paginator->numbers(array('modulus' => '25'));			           
			    echo $this->Paginator->next($this->Html->image('/img/Admin/next.gif', array('border' => '0')), array('escape' => false));
			  ?>				
		 </td>
		</tr>
</table>
</div>
<?php } ?>

<?php 
  /* if($this->Paginator->params['paging'][$paging_model_name]['pageCount'] >= 2){
?>
<div class="col-xs-6">
	<div class="dataTables_paginate paging_bootstrap">
		<ul class="pagination">
			<li class="prev disabled">
				<?php 
				  echo $this->Paginator->prev('Previous', array('escape' => false));
				?>
			</li>
			<li><?php echo   $this->Paginator->numbers();?></li>
			<li class="next">
				<?php echo $this->Paginator->next('Next', array('escape' => false)); ?>
			</li>
		</ul>
	</div>
</div>
<?php */ 
 //   }
?>