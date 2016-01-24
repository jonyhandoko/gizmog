<?php include('header.php'); ?>

	<div class="cart">
		<div class="container-fluid">
			<div class="def-temp">
				<div class="arrow-steps">
					<div class="row">
						<div class="col-xs-3">
							<div class="arrow-step active">
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
							<div class="arrow-step">
								<p>THANK YOU</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="view-cart">
					<div class="row">
						<div class="col-xs-12">
							<?php echo form_open('cart/update_cart', array('id'=>'update_cart_form'));?>
								<?php if ($this->go_cart->total_items()==0):?>
									<div class="message">There are no products in your cart!</div>
								<?php else: ?>
									<div class="panel panel-as-table">
										<div class="panel-heading">
											<div class="row">
												<div class="col-sm-6">
													<p>PRODUCT</p>
												</div>
												<div class="col-sm-2">
													<p>PRICE</p>
												</div>
												<div class="col-sm-2">
													<p>QUANTITY</p>
												</div>
												<div class="col-sm-2">
													<p>TOTAL</p>
												</div>
											</div>
										</div>
										<div class="panel-body">
											<?php
											$grandtotal = 0;
											$subtotal = 0;
											// print_r($this->go_cart->contents());
											foreach ($this->go_cart->contents() as $cartkey=>$product):
											?>
												<div class="row">
													<div class="col-sm-6">
														<div class="media">
															<div class="pull-left">
																<img class="media-object" width="100" src="<?php echo base_url('uploads/product/thumb/'.$product['images']);?>" alt="cart-2.jpg">
															</div>
															<div class="media-body">
																<p><?php echo $product['name']; ?></p>
																<!--<p><i>Perspiciatis unde omnis iste natus errorsit voluptatem</i></p>-->
																<a href="<?php echo site_url('cart/remove_item/'.$cartkey);?>" class="red-text">DELETE</a>
															</div>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="row">
															<div class="col-xs-6 col-sm-12">
																<p class="price"><?php echo format_currency($product['base_price']);   ?></p>
															</div>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="row">
															<div class="col-xs-6 col-sm-12">
																<input type="text" class="form-control number" name="cartkey[<?php echo $cartkey;?>]" placeholder="quantity" value="<?php echo $product['quantity'] ?>">
															</div>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="row">
															<div class="col-xs-6 col-sm-12">
																<p class="price"><?php $subtotal = $product['base_price'] * $product['quantity']; echo format_currency($subtotal); $grandtotal += $subtotal;   ?></p>
															</div>
														</div>
													</div>
												</div>
											<?php endforeach;?>
										</div>
										<div class="panel-footer">
											<div class="row">
												<div class="col-xs-12">
													<a href="../" class="btn btn-orange pull-right">CONTINUE SHOPPING</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
						<?php endif;?>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="coupon">
								<div class="panel panel-as-table">
									<h3 class="title"><span class="orange">HAVE</span> A COUPON?</h3>
									<!-- <input type="text" class="input2" name="coupon_code">
									<input type="submit" class="button2" value="apply"> -->
									<div class="form-inline">
										<div class="form-group">
											<label for="coupon-code" class="sr-only">Coupon Code</label>
											<input type="text" class="form-control" id="coupon-code" name="coupon_code" placeholder="Coupon Code">
										</div>
										<button type="submit" class="btn btn-orange">APPLY</button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="total">
								<div class="panel panel-as-table">
									<h3 class="title"><span class="orange">CART</span> TOTAL</h3>
									<div class="row">
										<div class="col-sm-6">
											<span>CART SUBTOTAL</span>
										</div>
										<div class="col-sm-6 text-right">
											<?php echo format_currency($this->go_cart->subtotal());?>
										</div>
										<div class="col-sm-6">
											<span>SHIPPING</span>
										</div>
										<div class="col-sm-6 text-right">
											<?php echo format_currency($this->go_cart->shipping_cost());?>
										</div>
										<div class="col-sm-6">
											<span>VOUCHER</span>
										</div>
										<div class="col-sm-6 text-right">
											<?php echo format_currency(0-$this->go_cart->coupon_discount());   ?>
										</div>
										<div class="col-sm-6">
											<span>ORDER TOTAL</span>
										</div>
										<div class="col-sm-6 text-right">
											<?php echo format_currency($this->go_cart->total());?>
										</div>
										<div class="col-sm-12">
											<input id="redirect_path" type="hidden" name="redirect" value=""/>
											<br/><button class="btn btn-black pull-right" onClick="$('#redirect_path').val('checkout');">PROCEED TO CHECKOUT</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php include('footer.php'); ?>