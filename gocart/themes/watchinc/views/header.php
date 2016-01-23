<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=1170, user-scalable=yes">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">

		<title>GIZMOG <?php if (isset($page_title)) echo ' - '.$page_title;?></title>

		<link href="<?php echo base_url('gocart/themes/'.$this->config->item('theme').'/css/init.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('gocart/themes/'.$this->config->item('theme').'/css/plug.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('gocart/themes/'.$this->config->item('theme').'/css/devs.css');?>" rel="stylesheet">

		<link href='http://fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>
		<script src="<?php echo base_url('gocart/themes/'.$this->config->item('theme').'/js/modernizr.min.js');?>"></script>
		<script src="<?php echo base_url('gocart/themes/'.$this->config->item('theme').'/js/init.js');?>"></script>

		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('images/watchinc/ico/apple-touch-icon-144-precomposed.ico');?>">
		<link rel="shortcut icon" href="<?php echo base_url('images/watchinc/ico/favicon.ico');?>">
	</head>
	<body>

		<div class="def-header">
			<div class="container">
				<nav class="navbar navbar-default navbar-static-top">
					<div class="navbar-header">
						<button class="navbar-toggle navbar-toggle-left collapsed" data-toggle="collapse" data-target="#category" aria-expanded="false" aria-controls="category">
							<img alt="Menu" src="<?php echo base_url('/images/watchinc/icon/menu.png');?>">
						</button>
						<button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#advance" aria-expanded="false" aria-controls="advance">
							<img alt="Bag" src="<?php echo base_url('/images/watchinc/icon/shopping-bag.png');?>">
						</button>
						<a class="navbar-brand" href="<?php echo base_url('/');?>">
							<img alt="Watchinc" src="<?php echo base_url('/images/watchinc/brand.png');?>" class="img-responsive">
						</a>
					</div>
					<div id="advance" class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-right navbar-right-in">
							<li>
								<form class="navbar-form navbar-right">
									<div class="form-group">
										<input type="text" placeholder="SEARCH" class="form-control">
									</div>
									<button type="submit" class="btn btn-default btn-search">
										<img src="<?php echo base_url('/images/watchinc/icon/search.png');?>">
									</button>
								</form>
							</li>
							<li class="auth">
								<a href="<?php echo base_url('/secure/login');?>" class="btn-auth">LOGIN</a>
							</li>
							<li class="auth">
								<a href="<?php echo base_url('/secure/login');?>" class="btn-auth">REGISTER</a>
							</li>
							<li class="dropdown">
								<a href="" class="dropdown-toggle cart-anchor" data-toggle="dropdown" role="button" aria-expanded="false">
									<div class="bag-count">
										<img src="<?php echo base_url('/images/watchinc/icon/shopping-bag.png');?>" class="def-icon">
										<span class="badge def-badge"><?php echo $this->go_cart->total_items();?></span>
									</div>
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu def-dropdown" role="menu">
									<?php
									$grandtotal = 0;
									$subtotal = 0;
									foreach ($this->go_cart->contents() as $cartkey=>$product_cart):?>
										<li>
											<a href="">
												<div class="media">
													<div class="media-left">
														<img class="media-object" width="70" src="<?php echo base_url('uploads/product/thumb/'.$product_cart['images']);?>">
													</div>
													<div class="media-body">
														<h5 class="media-heading"><?php echo $product_cart['name']; ?></h5>
														<p class="sub-heading"><?php echo $product_cart['quantity'] ?> X <?php echo format_currency($product_cart['base_price']);   ?></p>
													</div>
												</div>
											</a>
										</li>
										<li class="divider"></li>
									<?php endforeach; ?>
									<li class="total">
										<div class="separator">
											<div class="row">
												<div class="col-xs-6">
													<p>SUBTOTAL</p>
												</div>
												<div class="col-xs-6">
													<p class="text-right"><b><?php echo format_currency($this->go_cart->subtotal());?></b></p>
												</div>
											</div>
										</div>
										<button type="submit" onclick="window.location='<?php echo base_url('/cart/view_cart');?>';" class="btn btn-orange btn-block">CHECKOUT</button>
									</li>
								</ul>
							</li>
						</ul>
					</div>
					<div id="category" class="navbar-collapse yamm collapse">
						<ul class="nav navbar-nav text-center def-list">
							<li>
								<a href=""><i class="fa fa-home"></i></a>
							</li>
							<li class="dropdown yamm-fw">
								<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" href="">WATCHES</a>
								<ul class="dropdown-menu def-dropdown" role="menu">
									<li>
										<div>
											<div class="col-sm-8">
												<div class="row">
													<div class="col-sm-12">
														<h3>CATEGORIES</h3>
													</div>
													<div class="col-sm-6">
														<ul class="list-unstyled">
															<li><h5>NEW IN: MENS</h5></li>
															<li><h5>MEN'S WATCH: CLASSIC</h5></li>
															<li><h5>MEN'S WATCH: CASUAL</h5></li>
															<li><h5>MEN'S WATCH: DRESS</h5></li>
															<li><h5>MEN'S WATCH: SPORT</h5></li>
														</ul>
													</div>
													<div class="col-sm-6">
														<ul class="list-unstyled">
															<li><h5>NEW IN: LADIES</h5></li>
															<li><h5>LADIES' WATCH: CLASSIC</h5></li>
															<li><h5>LADIES' WATCH: CASUAL</h5></li>
															<li><h5>LADIES' WATCH: DRESS</h5></li>
															<li><h5>LADIES' WATCH: SPORT</h5></li>
														</ul>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-12">
														<h3>BRANDS</h3>
													</div>
													<div class="col-sm-6">
														<ul class="list-unstyled">
															<li><h5><a href="<?php echo base_url('/seiko');?>">SEIKO</a></h5></li>
														</ul>
													</div>
													<div class="col-sm-6">
														<ul class="list-unstyled">
															<li><h5><a href="<?php echo base_url('/seiko');?>">ALBA</a></h5></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="col-sm-4">
												<img width="100%" src="<?php echo base_url('/images/box-menu.jpg');?>"/>
											</div>
										</div>
									</li>
								</ul>
							</li>
							<li><a href="<?php echo base_url('/strap');?>">STRAP</a></li>
							<li><a href="<?php echo base_url('/new');?>">NEWS</a></li>
							<li><a href="<?php echo base_url('/sale');?>">SALE</a></li>
							<li><a href="<?php echo base_url('/blog');?>">ARTICLE</a></li>
							<li><a href="<?php echo base_url('/cart/confirmation_payment');?>">CONFIRM PAYMENT</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right text-center">
							<?php if($this->Customer_model->is_logged_in(false, false)):?>
								<li>
									<a href="<?php echo base_url('/secure/my_account');?>">Welcome, <?php echo strtoupper($this->customer['firstname']);?>!</a>
								</li>
								<li>
									<a href="<?php echo base_url('/secure/logout');?>" class="active">Sign out</a>
								</li>
								<?php else:?>
							<?php endif;?>
						</ul>
					</div>
				</nav>
			</div>
			<div class="search-block closed">
				<a class="search-close">CLOSE</a>
				<div class="container">
					<div class="row">
						<div class="col-sm-3"></div>
						<div class="col-sm-6">
							<form method="post" action="<?php echo base_url('/cart/search');?>">
								<div class="form-group">
									<label class="sr-only" for="exampleInputAmount">Search</label>
									<div class="input-group">
										<div class="input-group-addon">
											<img src="<?php echo base_url('/images/watchinc/icon/white-search.png');?>">
										</div>
										<input type="text" class="form-control" placeholder="Enter words you want to search">
									</div>
								</div>
							</form>
						</div>
						<div class="col-sm-3"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="def-content">
			<?php
				if ($this->session->flashdata('message')) {
					echo '<div class="gmessage">'.$this->session->flashdata('message').'</div>';
				}
				if ($this->session->flashdata('error')) {
					echo '<div class="error">'.$this->session->flashdata('error').'</div>';
				}
				if (!empty($error)) {
					echo '<div class="error">'.$error.'</div>';
				}
			?>
