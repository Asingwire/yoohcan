            <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('Home', array('controller' => 'admins', 'action' => 'dashboard', 'plugin' => null)); ?></a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3> 1
                                        <sup style="font-size: 20px">&nbsp;</sup>
                                    </h3>
                                    <p>
                                        Admin
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
								
								<a class="small-box-footer" href="<?php echo Router::url(array('controller'=>'admins','action'=>'index'))?>">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                                
                            </div>
                        </div><!-- ./col -->
						
                        
						
						
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                       <?php echo ($userCount);?>
                                    </h3>
                                    <p>
                                        Users
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
								<a class="small-box-footer" href="<?php echo Router::url(array('controller'=>'users','action'=>'index'))?>">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                               
                            </div>
                        </div><!-- ./col -->
						
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>
                                       <?php echo ($planCount); ?>
                                    </h3>
                                    <p>
                                        Plans
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-document-text"></i>
                                </div>
                                <a class="small-box-footer" href="<?php echo Router::url(array('controller'=>'plans','action'=>'index'))?>">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
						
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?php echo ($emailTemplateCount);?>
                                    </h3>
                                    <p>
                                        Email Templates
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-android-mail"></i>
                                </div>
                                <a class="small-box-footer" href="<?php echo Router::url(array('controller'=>'email_templates','action'=>'index'))?>">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
						
						
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-teal">
                                <div class="inner">
                                    <h3>
                                        <?php echo ($staticPagesCount);?>
                                    </h3>
                                    <p>
                                        Static Pages
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-document-text"></i>
                                </div>
                                <a class="small-box-footer" href="<?php echo Router::url(array('controller'=>'static_pages','action'=>'index'))?>">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
						
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-light-yellow">
                                <div class="inner">
                                    <h3>
                                        <?php echo ($streamCount);?>
                                    </h3>
                                    <p>
                                        Streaming
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-document-text"></i>
                                </div>
                                <a class="small-box-footer" href="<?php echo Router::url(array('controller'=>'streams','action'=>'live'))?>">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
						
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-maroon">
                                <div class="inner">
                                    <h3>
                                        <?php echo ($channelCount);?>
                                    </h3>
                                    <p>
                                        Channels
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-document-text"></i>
                                </div>
                                <a class="small-box-footer" href="<?php echo Router::url(array('controller'=>'channels','action'=>'index'))?>">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
						
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-kypta-n">
                                <div class="inner">
                                    <h3>
                                        <?php echo ($videoCount);?>
                                    </h3>
                                    <p>
                                        Videos
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-document-text"></i>
                                </div>
                                <a class="small-box-footer" href="<?php echo Router::url(array('controller'=>'channels','action'=>'index'))?>">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
						
						
						
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-kypta">
                                <div class="inner">
                                    <h3> <?php echo $transactionCount; ?>
                                        <sup style="font-size: 20px">&nbsp;</sup>
                                    </h3>
                                    <p>
                                        Transactions
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-usd"></i>
                                </div>
								
								<a class="small-box-footer" href="<?php echo Router::url(array('controller'=>'transactions','action'=>'index'))?>">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                                
                            </div>
                        </div><!-- ./col -->
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3> <?php echo $CategoryCount; ?>
                                        <sup style="font-size: 20px">&nbsp;</sup>
                                    </h3>
                                    <p>
                                        Category
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>								
								<a class="small-box-footer" href="<?php echo Router::url(array('controller'=>'categories','action'=>'index'))?>">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>                                
                            </div>
                        </div>
						
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-uni-n">
                                <div class="inner">
                                    <h3> 1
                                        <sup style="font-size: 20px">&nbsp;</sup>
                                    </h3>
                                    <p>
                                       Global Setting
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>								
								<a class="small-box-footer" href="<?php echo Router::url(array('controller'=>'settings','action'=>'index'))?>">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>                                
                            </div>
                        </div>
						
						
						
                    </div><!-- /.row -->
					 
                    
                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                            
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->
                    
                    
                    
                   
				</section><!-- /.content -->