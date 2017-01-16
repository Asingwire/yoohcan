<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
<?php echo $this->Html->script('bootstrap.min');?>
<?php echo $this->Html->script('auto_populate/jquery.mockjax');?>
<?php echo $this->Html->script('auto_populate/bootstrap-typeahead');?>


<script>
            $(function() {
               /*  function displayResult(item) {
                    $('.alert').show().html('You selected <strong>' + item.value + '</strong>: <strong>' + item.text + '</strong>');
                } */
                

                $('#demo5').typeahead({
                    ajax: {
                        url: '<?php echo $this->Html->url(array('controller'=>'tests','action'=>'auto_suggestion_list'));?>',
                        method: 'post',
                        triggerLength: 1
                    }/* ,
                    onSelect: displayResult */
                });
                
            });
        </script>

                    
	<div class="well col-md-5" style="margin-left:100px;">
		<input id="demo5" type="text" class="col-md-12 form-control" placeholder="Search ..." autocomplete="off" />
	</div>
	



      