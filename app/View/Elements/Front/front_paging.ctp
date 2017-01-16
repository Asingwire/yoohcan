<?php if($this->Paginator->params['paging'][$paging_model_name]['pageCount'] >= 2){ ?>
<!--Pagination blue-->

<div class="pagination pagination-large">
    <ul class="pagination">
            <?php
                echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => '','disabledTag' => 'a'));
                echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => '','disabledTag' => 'a'));
            ?>
        </ul>
    </div>
	
	
	<style>
.pagination > .active > a, .pagination > .active > a:focus, .pagination > .active > a:hover, .pagination > .active > span, .pagination > .active > span:focus, .pagination > .active > span:hover{
background-color: #fff ;
    border-color: #fff ;
    color: #000;
    cursor: default;
    z-index: 3;

}

.pagination > li > a, .pagination > li > span {
    background-color: #1b1b19 ;
    border: 1px solid #fff;
    color: #fff;
    float: left;
    line-height: 1.42857;
    margin-left: -1px;
    padding: 6px 12px;
    position: relative;
    text-decoration: none;


}
.pagination > li > a:focus, .pagination > li > a:hover, .pagination > li > span:focus, .pagination > li > span:hover {

	 background-color: #fff;
    border-color: #fff;
    color: #000;
    z-index: 2;
}

	</style>

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