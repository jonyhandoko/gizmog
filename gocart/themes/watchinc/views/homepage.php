<?php
	include('header.php');
?>

			<div class="banners">
				<div class="container-fluid">
					<div class="banner-big">
						<div class="owl-banner">
							<div id="owl-banner" class="owl-carousel">
								<div class="item">
									<img src="images/watchinc/banner/big-1.jpg" class="img-responsive">
								</div>
								<div class="item">
									<img src="images/watchinc/banner/big-1.jpg" class="img-responsive">
								</div>
								<div class="item">
									<img src="images/watchinc/banner/big-1.jpg" class="img-responsive">
								</div>
								<div class="item">
									<img src="images/watchinc/banner/big-1.jpg" class="img-responsive">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="container-fluid">
					<div class="banner-small">
						<div class="row">
							<div class="col-sm-4">
								<img src="images/watchinc/banner/small-1.jpg" class="img-responsive">
							</div>
							<div class="col-sm-4">
								<img src="images/watchinc/banner/small-2.jpg" class="img-responsive">
							</div>
							<div class="col-sm-4">
								<img src="images/watchinc/banner/small-3.jpg" class="img-responsive">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="featured">
				<div class="container-fluid">
					<div class="def-temp">
						<div class="head">
							<div class="row">
								<div class="col-xs-12">
									<h3 class="title">FEATURED PRODUCTS</h3>
								</div>
							</div>
						</div>
						<div class="thumbs owl-featured">
							<div id="owl-featured" class="owl-carousel">
								<?php if(count($products) > 0):?>
									<?php for($j=0;$j<1;$j++){?>
									<?php
										$cat_counter = 1;
										$i = 1;

										foreach($products as $product):
										$photo	= '<img class="img-responsive" src="'.base_url('images/nopicture.png').'" alt="'.lang('no_image_available').'"/>';
										$product->images	= array_values($product->images);

										if (!empty($product->images[0])) {
											$primary	= $product->images[0];
											foreach ($product->images as $photo) {
												if (isset($photo->primary)) {
													$primary	= $photo;
												}
											}

											$photo	= '<img class="img-responsive" src="'.base_url('uploads/product/thumb/'.$primary->filename).'" alt="'.$product->seo_title.'"/>';
										}
									?>
									<a href="<?php echo base_url($product->slug);?>" class="thumb">
										<div class="item">
											<div class="desc">
												<p class="brand-name"><?php echo strtoupper($product->brand['brand_name']);?></p>
												<p class="name"><?php echo $product->name;?></p>
											</div>
											<div class="image">
												<?php echo $photo; ?>
											</div>
											<div class="desc">
												<p class="price-tag"><?php echo format_currency($product->price); ?></p>
											</div>
										</div>
									</a>
									<?php endforeach; ?>
									<?php };?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="featured-tabs">
				<div class="container-fluid">
					<div class="def-temp">
						<div class="head">
							<div class="row">
								<div class="col-xs-12">
									<!-- <img src="images/watchinc/watch.png" class="img-responsive pull-left"> -->
									<h3 class="title">MEN WATCHES</h3>
								</div>
							</div>
						</div>
						<div class="thumbs">
							<div class="row">
								<?php if(count($menwatches) > 0):?>
									<?php
										$cat_counter = 1;
										$i = 1;

										foreach ($menwatches as $menwatch):
										$photo	= '<img class="img-responsive" src="'.base_url('images/nopicture.png').'" alt="'.lang('no_image_available').'"/>';
										$menwatch->images	= array_values($menwatch->images);

										if (!empty($menwatch->images[0])) {
											$primary	= $menwatch->images[0];
											foreach($menwatch->images as $photo) {
												if (isset($photo->primary)) {
													$primary	= $photo;
												}
											}

											$photo	= '<img class="img-responsive" src="'.base_url('uploads/product/thumb/'.$primary->filename).'" alt="'.$product->seo_title.'"/>';
										}
									?>
									<div class="col-sm-3">
										<a href="<?php echo base_url($menwatch->slug);?>" class="thumb">
											<div class="item">
												<div class="desc">
													<p class="brand-name"><?php echo strtoupper($menwatch->brand['brand_name']);?></p>
													<p class="name"><?php echo $menwatch->name;?></p>
												</div>
												<div class="image">
													<?php echo $photo; ?>
												</div>
												<div class="desc">
													<p class="price-tag"><?php echo format_currency($menwatch->price); ?></p>
												</div>
											</div>
										</a>
									</div>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="banner">
				<img src="images/watchinc/banner/fluid.jpg" class="img-responsive">
			</div>
			<div class="news">
				<div class="container-fluid">
					<div class="def-temp">
						<div class="head">
							<div class="row">
								<div class="col-xs-12">
									<!-- <img src="images/watchinc/watch.png" class="img-responsive pull-left"> -->
									<h3 class="title">LATEST NEWS</h3>
								</div>
							</div>
						</div>
						<div class="thumbs blog">
							<div class="row">
								<?php foreach($json as $key => $blog):?>
								<?php if($key != "msg"):?>
									<div class="col-sm-3 col-xs-6 col-xx">
										<?php
											$whiteSpace = '\s';
											$pattern = '/[^a-zA-Z0-9'  . $whiteSpace . ']/u';
											$title = preg_replace($pattern, '', (string) $blog->title);
											$link = str_replace(" ", "-", $title)."--".$blog->ID;
										?>
										<a href="<?php echo base_url('/blog/'.$link);?>" class="thumb">
											<div class="item">
												<div class="image">
													<img src="<?php echo $blog->thumbsmall;?>" class="img-responsive">
												</div>
												<div class="desc">
													<p class="brand-name"><?php echo $blog->title;?></p>
													<p><?php echo $blog->excerpt;?></p>
												</div>
											</div>
										</a>
									</div>
								<?php endif;?>
								<?php endforeach;?>
							</div>
						</div>
					</div>
				</div>
			</div>

<?php
	include('footer.php');
?>
