<?php
	include(APPPATH.'themes/'.$this->config->item('theme').'/views/header.php');
?>
<div class="product checkout">
		<div class="container-fluid" style="padding-top: 25px">
			<div class="def-temp">
				<div class="arrow-steps">
					<div class="row">
						<div class="col-xs-3">
							<div class="arrow-step">
								<p>CART</p>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="arrow-step active">
								<p>CHECKOUT</p>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="arrow-step">
								<p>CONFIRM ORDER</p>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="arrow-step">
								<p>THANK YOU</p>
							</div>
						</div>
					</div>
				</div>
					<div class="content">
						<div class="row">
							<div class="col-sm-6">
								<h3 class="title"><span class="orange">SHIPPING</span> ADDRESS</h3>
								<div class="register-form">
									<form id="order_submit_form" class="form-horizontal form-clean" action="<?php echo site_url('checkout/order_summary'); ?>" method="post">
										<?php
											$ship	= $customer['ship_address'];
										?>
										<div class="checkout_block" >
											<div id="customer_info_fields">
												<h3><?php echo lang('customer_information');?></h3>
												<img alt="loading" src="<?php echo base_url('images/ajax-loader.gif');?>"/>
											</div>
										</div>
										<div id="submit_button_container-fluid">
											<input type="hidden" name="process_order" value="true">
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="payment-box">
										<h3 class="title"><span class="orange">PAYMENT</span> METHOD</h3>
										<form>
											<div class="radio">
												<label>
													<input type="radio" class="radio-image"  name="payment_method" value="bank_transfer" checked>
													BANK TRANSFER
												</label>
											</div>
											<p><img src="<?php echo base_url('/images/watchinc/method/bank-bca.png');?>" class="bank-img">BANK BCA JONY HANDOKO - 3111147459</p>
											<!--<p><img src="<?php echo base_url('/images/watchinc/method/bank-mandiri.png');?>" class="bank-img">BANK MANDIRI JONY HANDOKO - 313131313</p>
											<!--<div class="radio">
												<label>
													<input type="radio" class="radio-image"  name="payment_method" value="doku_payment">
													DOKU PAYMENT
												</label>
											</div>
											<p><img src="<?php echo base_url('/images/watchinc/method/credit-doku.png');?>" class="bank-img">PAY WITH DOKU PAYMENT</p>-->
										</form>
									</div>
									<div class="payment-box">
										<h3 class="title"><span class="orange">DELIVERY</span> METHOD</h3>
										<form>
											<input type="radio" <?php if($this->go_cart->shipping_method()=="JNE REG") echo "checked";?> name="shipping_method" value="reg"/> <label><img src="<?php echo base_url('/images/watchinc/method/jne-reg.png');?>" class="radio-img"> JNE REG - <span class="jne_reg"><?php echo $jne->reg;?></span></label>
											<?php if($jne->yes==0):?>

											<?php else:?>
											<br/>
											<input type="radio" <?php if($this->go_cart->shipping_method()=="JNE YES") echo "checked";?> name="shipping_method" value="yes" /> <label><img src="<?php echo base_url('/images/watchinc/method/jne-yes.png');?>" class="radio-img"> JNE YES - <span class="jne_yes"><?php echo $jne->yes;?></span></label>
											<?php endif;?>
										</form>
									</div>
									<div class="order-box">
										<h3 class="title"><span class="orange">YOUR</span> ORDERS</h3>
										<div class="detail">
											<?php if ($this->go_cart->total_items()==0):?>
												<div class="message">There are no products in your cart!</div>
											<?php else: ?>
												<div class="items">
													<?php
														$grandtotal = 0;
														$subtotal = 0;

														foreach ($this->go_cart->contents() as $cartkey=>$product):
													?>
														<div class="row">
															<div class="col-xs-2">
																<img class="media-object" src="<?php echo base_url('uploads/product/thumb/'.$product['images']);?>" alt="cart-2.jpg">
															</div>
															<div class="col-xs-6">
																<p><b><?php echo $product['name']; ?></b></p>
																<p class="price"><?php echo $product['quantity'] ?>x <?php echo format_currency($product['base_price']);   ?></p>
															</div>
															<div class="col-xs-4"></div>
														</div>
													<?php endforeach;?>
												</div>
												<div class="total">
													<div class="row">
														<div class="col-xs-8">
															<p>CART SUBTOTAL</p>
														</div>
														<div class="col-xs-4">
															<p><?php echo format_currency($this->go_cart->subtotal());?></p>
														</div>
														<div class="col-xs-8">
															<p>SHIPPING (<span><?php echo $this->go_cart->shipping_method();?></span>) - <span><?php echo $this->go_cart->order_weight();?>kg</span></p>
														</div>
														<div class="col-xs-4">
															<p><?php echo "<span class='shipping'>".format_currency($this->go_cart->shipping_cost())."</span>";?></p>
														</div>
														<div class="col-xs-8 order-total">
															<p>ORDER TOTAL</p>
														</div>
														<?php $total = $this->go_cart->subtotal() + $this->go_cart->shipping_cost() - $this->go_cart->coupon_discount();?>
														<div class="col-xs-4 order-total"	>
															<?php echo "<span class='grandtotal'>".format_currency($total)."</span>"; ?>
														</div>
													</div>
												</div>
												<div class="actions">
													<div class="row">
															<input type="button" class="btn btn-black" onclick="return save_order();" value="CONTINUE" />
													</div>
												</div>
											<?php endif;?>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="test"></div>
				<div>
					<input type="hidden" id="php-boolean-isset-ship-address" value="<?php if(isset($customer['ship_address'])):?><?php echo '1';?><?php else:	?><?php echo '0';?><?php endif;?>">
					<input type="hidden" id="php-param-jne-yes" value="<?php echo $jne->yes*ceil($this->go_cart->order_weight());?>">
					<input type="hidden" id="php-param-jne-reg" value="<?php echo $jne->reg*ceil($this->go_cart->order_weight());?>">
					<input type="hidden" id="php-url-img-loader" value="<?php echo base_url('images/ajax-loader.gif');?>">
					<input type="hidden" id="php-url-checkout-customer-detail" value="<?php echo site_url('checkout/customer_details');?>">
					<input type="hidden" id="php-url-checkout-customer-form" value="<?php echo site_url('checkout/customer_form');?>">
					<input type="hidden" id="php-url-checkout-save-shipping-method-price" value="<?php echo site_url('checkout/save_shipping_method_price');?>">
					<input type="hidden" id="php-url-checkout-save-payment-method" value="<?php echo site_url('checkout/save_payment_method');?>">
					<input type="hidden" id="php-message-error-save-payment" value="<?php echo lang('error_save_payment');?>">
				</div>
			</div>
		</div>
</div>

<?php
	include(APPPATH.'themes/'.$this->config->item('theme').'/views/footer.php');
?>
