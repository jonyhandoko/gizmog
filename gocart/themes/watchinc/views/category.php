<?php
	include('header.php');
?>

			<div class="category">
				<div class="container">
					<div class="col-sm-3">
						<div class="filter">
							<div class="head-filter">
								<!-- <img src="<?php echo base_url('images/watchinc/watch.png');?>" class="img-responsive pull-left"> -->
								<h4 class="title-watch">FILTER BY</h4>
                <div class="clearfix"></div>
							</div>
							<div class="context-filter">
								<div class="divider-block">
									<span>SUBCATEGORY</span>
								</div>
								<div class="content-filter">
									<?php if (!empty($subcategories)):?>
										<ul class="list-unstyled">
											<?php foreach($subcategories as $a):?>
												<li>
													<a href="<?php echo base_url($a->slug);?>"><?php echo strtoupper($a->name);?></a>
												</li>
											<?php endforeach;?>
										</ul>
									<?php else: ?>
										<span>No Subcategories</span>
										<br/><br/>
										<?php if (isset($parent_category)):?>
											Back To <a class="orange" href="<?php base_url($parent_category->slug);?>"><?php echo $parent_category->name;?></a>
										<?php endif;?>
									<?php endif; ?>
								</div>
							</div>
							<div class="context-filter">
								<div class="divider-block">
									<span>PRICE RANGE</span>
								</div>
								<div class="content-filter">
									<ul class="list-unstyled">
										<li>
											<a href="#" class="priceFilter" price-filter="0.1000000">Under 1.000.000 IDR</a>
										</li>
										<li>
											<a href="#" class="priceFilter" price-filter="1000000.3000000">1.000.000 IDR - 3.000.000 IDR</a>
										</li>
										<li>
											<a href="#" class="priceFilter" price-filter="3000000.5000000">3.000.000 IDR - 5.000.000 IDR</a>
										</li>
										<li>
											<a href="#" class="priceFilter" price-filter="5000000.9000000">5.000.000 IDR - 9.000.000 IDR</a>
										</li>
										<li>
											<a href="#" class="priceFilter" price-filter="9000000.20000000">9.000.000 IDR - 20.000.000 IDR</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="filter">
							<div class="head-filter">
								<!-- <img src="<?php echo base_url('images/watchinc/watch.png');?>" class="img-responsive pull-left"> -->
								<h4 class="title-watch">PROMO WATCHES</h4>
                <div class="clearfix"></div>
							</div>
							<div class="context-filter">
								<div class="divider-block">
									<span>EXTRA PROMO</span>
								</div>
								<div class="content-filter">
									<ul class="list-unstyled">
										<li>Disc 50%</li>
										<li>Mega Clearance SEIKO</li>
										<li>Free Strap</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-9">
						<div class="head-temp">
							<div class="head-banner">
								<!-- <img src="<?php echo base_url('images/watchinc/watch.png');?>" class="img-responsive pull-left"> -->
								<?php if ($page_title=="New Arrivals" || $page_title=="Sale"):?>
									<h4 class="title-watch">PRODUCT WATCHES</h4>
								<?php elseif ($page_title=="Search"):?>
									<h4 class="title-watch">SEARCH PRODUCT - <?php echo $term;?></h4>
								<?php else:?>
									<h4 class="title-watch">PRODUCT WATCHES  - <?php echo $category->seo_title;?></span></h4>
									<?php if (!empty($category->image)):?>
										<div>
											<img width="100%" src="<?php echo base_url('uploads/category/'.$category->image);?>"/>
										</div>
									<?php endif;?>
									<div class="filter-parameters">
										<?php $counter=0; foreach($data_filter as $key => $df):	$counter++;?>
												<div id="dd" class="drops wrapper-dropdown-1" tabindex="<?php echo $counter;?>">
													<span class="filter-name" data-filter-code="filter<?php echo ucfirst($key);?>" data-filter-name="<?php echo $key;?>"><?php echo $key;?></span>
													<ul class="dropdown" tabindex="<?php echo $counter;?>">
														<?php foreach ($df as $dfvalue):?>
															<li class="coll-filter"><a href="#"><?php echo strtoupper($dfvalue);?></a></li>
														<?php endforeach;?>
													</ul>
												</div>
										<?php endforeach;?>
									</div>
								<?php endif;?>
							</div>
							<div class="filter-product"></div>
							<div class="filter-container">
								<?php
								$current_url = explode("?", $_SERVER['REQUEST_URI']);
								?>
								<a href="<?php echo $current_url[0] ;?>" class="filter-box btn-clear">CLEAR ALL</a>
								<div class="filter-list"> </div>
							</div>
						</div>
						<div class="def-temp">
							<div class="thumbs">
								<div class="row" id="product-content">
									<?php if (count($products) > 0):?>
										<?php for ($j=0;$j<1;$j++){?>
										<?php
											$cat_counter = 1;
											$i = 1;

											foreach ($products as $product):
											$photo	= '<img class="img-responsive lazy" style="background-image: url("../img/clock-gif.gif")" src="'.base_url('images/nopicture.png').'" alt="'.lang('no_image_available').'"/>';
											$product->images	= array_values($product->images);

											if (!empty($product->images[0])) {
												$primary	= $product->images[0];
												foreach ($product->images as $photo) {
													if (isset($photo->primary)) {
														$primary	= $photo;
													}
												}

												$photo	= '<img class="img-responsive lazy" src="'.base_url('gocart/themes/'.$this->config->item('theme').'/img/clock-gif.gif').'" data-original="'.base_url('uploads/product/thumb/'.$primary->filename).'" alt="'.$product->seo_title.'"/>';
											}
										?>
										<div class="col-sm-3 thumbnail-category">
											<a href="<?php echo base_url($product->slug);?>" class="thumb">
												<div class="item">
													<div class="desc">
														<?php if (!empty($product->brand['brand_name'])):?><p class="brand-name"><?php echo strtoupper($product->brand['brand_name']);?></p><?php endif;?>
															<p class="name"><?php echo $product->name;?></p>
															<?php if($product->sale == 1 && $product->saleprice > 0):
																$date = strtotime(date("Y-m-d"));
																if (strtotime($product->sale_enable_on) <= $date && strtotime($product->sale_disable_on) > $date):
															?>
														<?php endif;
														else: ?>
														<?php endif;?>
													</div>
													<div class="image"><?php echo $photo; ?></div>
													<div class="desc">
														<?php if($product->sale == 1 && $product->saleprice > 0):
																$date = strtotime(date("Y-m-d"));
																if (strtotime($product->sale_enable_on) <= $date && strtotime($product->sale_disable_on) > $date):
															?>
															<p><s><?php echo format_currency($product->price); ?></s></p>
															<p class="price-tag"><?php echo format_currency($product->saleprice); ?></p>
														<?php else: ?>
															<p class="price-tag"><?php echo format_currency($product->price); ?></p><br/>
														<?php endif;
														else: ?>
															<p class="price-tag"><?php echo format_currency($product->price); ?></p><br/>
														<?php endif;?>
													</div>
												</div>
											</a>
										</div>
										<?php endforeach; ?>
										<?php };?>
									<?php endif; ?>
									<span class="pagination def-pagination"><?php echo $this->pagination->create_view_all_links();?></span>
								</div>
								<div class="col-sm-12">
									<button type="submit" class="btn btn-orange btn-block more">LOAD MORE</button>
									<br/><br/>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

<?php
	include('footer.php');
?>
