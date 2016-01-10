<?php
	include('header.php');
?>

			<div class="product">
				<div class="container-fluid">
					<?php if ($blog_page=="home"):?>
						<div class="def-temp">
							<div class="head">
								<div class="row">
								<div class="col-xs-12">
									<img src="<?php echo base_url('images/watchinc/watch.png');?>" class="img-responsive pull-left">
									<h3 class="title"><span class="orange">BLOG</span> WATCHINC</h3>
								</div>
								</div>
							</div>
						</div>
						<div class="blog">
							<div class="row">
								<?php foreach ($json as $key => $blog):?>
								<?php if ($key != "msg"):?>
								<div class="col-sm-4">
									<?php
										$whiteSpace = '\s';
										$pattern = '/[^a-zA-Z0-9'  . $whiteSpace . ']/u';
										$title = preg_replace($pattern, '', (string) $blog->title);
										$link = str_replace(" ", "-", $title)."--".$blog->ID;
									?>
									<div class="banner">
										<a class="blog-home" href="<?php echo base_url('/blog/'.$link);?>"><img src="<?php echo $blog->thumb;?>"/></a>
										<div class="excerpt">
											<h3><a class="blog-home" href="<?php echo base_url('/blog/'.$link);?>"><?php echo $blog->title;?></a></h3>
											<span class="post-date"><?php echo $blog->date;?></span><br/>
											<br/>
										</div>
									</div>
								</div>
								<?php endif;?>
								<?php endforeach;?>
							</div>
						</div>
					<?php else:?>
						<div class="row">
							<div class="col-sm-8">
								<?php print_r($detail);?>
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>

<?php
	include('footer.php');
?>
