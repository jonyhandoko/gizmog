<?php
	include('header.php');
?>

			<div class="checkout">
				<div class="container-fluid">
					<div class="def-temp">
						<div class="arrow-steps">
							<div class="row">
								<div class="col-xs-3">
									<div class="arrow-step">
										<p>CART</p>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="arrow-step">
										<p>CHECKOUT</p>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="arrow-step">
										<p>CONFIRM ORDER</p>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="arrow-step active">
										<p>THANK YOU</p>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-2"></div>
							<div class="col-sm-8">
								<div class="box text-center">
									<h3 class="title"><span class="orange">THANK</span> YOU</h3>
										<div class="words">
											<h4 class="text-uppercase">Payment for your order was successfully processed</h4><br>
											<p>Your Order Number : <b><?php echo $order_id;?></b></p>
											<p>Payment Method : <b><?php echo $payment['details']; ?></b></p>
												<?php
													if ($payment['details'] == "Paypal Express") {
												?>
													<p>Amount : $<?php echo $payment['total']; ?> USD</p>
													<p>Thankyou for your shopping with Scarlet</p>
													<p>You can review this order and download your invoice from the "<b>Order history</b>" section of your account by clicking "<a href="<?php echo base_url('secure/my_account');?>">My account</a>" on our Website</p>
												<?php
													} else {
												?>
													<p>Amount: <?php echo format_currency($this->go_cart->total()); ?></p>
													<p>Please transfer your payment to : <b> BCA -  5810332893</b> / <b>Mandiri -  1680000137669</b></p>
													<br/><br/>
													<p>
														<i>You have a maximum of 2 days to pay and confirm your payment.</i><br>
														<i>Automatic cancellation will take place if no payment confirmation received.</i>
													</p>
												<?php
													}
												?>
										</div>
								</div>
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
				</div>
			</div>

<?php
	include('footer.php');
?>