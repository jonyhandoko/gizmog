<?php include(APPPATH.'themes/'.$this->config->item('theme').'/views/header.php'); ?>

	<script type="text/javascript">
		$(document).ready(function() {
			// $('.continue_shopping').buttonset();

			// higlight  fields
			$('.input').focus(function(){
				$(this).addClass('input_hover');
			});

			// higlight fields
			$('.input').blur(function(){
				$(this).removeClass('input_hover');
			});

			<?php if(isset($customer['ship_address'])):?>
				$.post('<?php echo site_url('checkout/customer_details');?>', function(data){
					// populate the form with their information
					$('#customer_info_fields').html(data);
					// $('input:button, input:submit, button').button();
				});
			<?php else:	?>
				get_customer_form();
			<?php endif;?>

			$('input:radio[name=shipping_method]').change(function() {
				if (this.value=="yes") {
					$.post('<?php echo site_url('checkout/save_shipping_method_price');?>',{method: 'JNE YES', price: '<?php echo $jne->yes*ceil($this->go_cart->order_weight());?>'}, function(data){
						location.reload();
					});
				} else {
					$.post('<?php echo site_url('checkout/save_shipping_method_price');?>',{method: 'JNE REG', price: '<?php echo $jne->reg*ceil($this->go_cart->order_weight());?>'}, function(data){
						location.reload();
					});
				}
			});
		});

		function get_customer_form() {
			// the loader will only show if someone is editing their existing information
			$('#save_customer_loader').show();
			// hide the button again
			$('#submit_button_container').hide();

			$('.payment-box, .order-box').css({
				opacity: '0.5',
				cursor: 'no-drop'
			}).find('input, button').attr('disabled', 'disabled');

			// remove the shipping and payment forms
			$('#shipping_payment_container').html('<div class="checkout_block"><img alt="loading" src="<?php echo base_url('images/ajax-loader.gif');?>"/><br style="clear:both;"/></div>').hide();
			$.post('<?php echo site_url('checkout/customer_form'); ?>', function(data){
				// populate the form with their information
				$('#customer_info_fields').html(data);
				// $('input:button, input:submit, button').button();		
			});
		}

		function save_order() {
			//submit additional order details
			frm_data = $('input:radio[name=payment_method]:checked').serialize();
			if ($('input:radio[name=payment_method]:checked').val()=='paypal_express'){
				$.post('<?php echo site_url('checkout/save_payment_method');?>', frm_data, function(response) {

					// alert(response);
					if (typeof response != "object") {
						display_error('payment', '<?php echo lang('error_save_payment') ?>');
						return;
					}

					if (response.status=='success') {
						// send them on to place the order
						$('#order_submit_form').trigger('submit');
					} else if (response.status=='error') {
						display_error('payment', response.error);
					}
				}, 'json');
			} else if ($('input:radio[name=payment_method]:checked').val()=='bank_transfer') {
				$.post('<?php echo site_url('checkout/save_payment_method');?>', frm_data, function(response) {
					if (typeof response != "object") {
						display_error('payment', '<?php echo lang('error_save_payment') ?>');
						return;
					}

					if (response.status=='success') {
						// send them on to place the order
						$('#order_submit_form').trigger('submit');
					} else if(response.status=='error') {
						display_error('payment', response.error);
					}
				}, 'json');
			} else {
				alert("Please choose payment method");
			}
		}
	</script>

	<div class="product">
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
			</div>
			<div class="content">
				<div class="row" style="margin-bottom: 30px;">
					<div class="col-sm-6">
						<h3 class="title" style="margin-top: 10px;"><span class="orange">SHIPPING</span> ADDRESS</h3>
						<div class="register-form" style="padding: 35px;">
							<form id="order_submit_form" action="<?php echo site_url('checkout/order_summary'); ?>" method="post">
								<?php
								$ship	= $customer['ship_address'];
								?>
								<div class="checkout_block" >
									<div id="customer_info_fields">
										<h3><?php echo lang('customer_information');?></h3>
										<img alt="loading" src="<?php echo base_url('images/ajax-loader.gif');?>"/>
									</div>
								</div>
								<div id="submit_button_container" style="display:none; text-align:center; padding-top:10px;">
									<input type="hidden" name="process_order" value="true">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="payment-box" style="border: 1px solid #CCC; padding: 10px 30px; margin-bottom: 25px;">
								<h3 class="title" style="margin-top: 10px; margin-bottom: 20px;"><span class="orange">PAYMENT</span> METHOD</h3>
								<form>
									<div class="radio">
										<label>
											<input type="radio" style="margin-top: 2px;"  name="payment_method" value="bank_transfer" checked>
											BANK TRANSFER
										</label>
									</div>
									<p><img src="<?php echo base_url('/images/watchinc/method/bank-bca.png');?>" style="margin-right: 15px;">BANK BCA JONY HANDOKO - 313131313</p>
									<p><img src="<?php echo base_url('/images/watchinc/method/bank-mandiri.png');?>" style="margin-right: 15px;">BANK MANDIRI JONY HANDOKO - 313131313</p>
								</form>
							</div>
							<div class="payment-box" style="border: 1px solid #CCC; padding: 10px 30px; margin-bottom: 25px;">
								<h3 class="title" style="margin-top: 10px;"><span class="orange">DELIVERY</span> METHOD</h3>
								<form>
									<input type="radio" style="margin-top: 2px;" <?php if($this->go_cart->shipping_method()=="JNE REG") echo "checked";?> name="shipping_method" value="reg" /> <label style="margin-left: 4px;"><img src="<?php echo base_url('/images/watchinc/method/jne-reg.png');?>" style="margin-right: 15px; width: 60px; margin-top: 8px;"> JNE REG - <span class="jne_reg"><?php echo $jne->reg;?></span></label>
									<br/>
									<input type="radio" style="margin-top: 2px;" <?php if($this->go_cart->shipping_method()=="JNE YES") echo "checked";?> name="shipping_method" value="yes" /> <label style="margin-left: 4px;"><img src="<?php echo base_url('/images/watchinc/method/jne-yes.png');?>" style="margin-right: 15px; width: 60px; margin-top: 8px;"> JNE YES - <span class="jne_yes"><?php echo $jne->yes;?></span></label>
									<!-- <div class="radio">
										<label>
											<input type="radio"  name="shipping_method" value="bank_transfer" <?php if($this->go_cart->shipping_method()=="JNE REG") echo "checked";?>>
											JNE REG - <span class="jne_reg"><?php echo $jne->reg;?></span>
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio"  name="shipping_method" value="bank_transfer" <?php if($this->go_cart->shipping_method()=="JNE YES") echo "checked";?>>
											JNE YES - <span class="jne_yes"><?php echo $jne->yes;?></span>
										</label>
									</div> -->
								</form>
							</div>
							<div class="order-box" style="border: 1px solid #CCC; padding: 10px 30px;">
								<h3 class="title" style="margin-top: 10px;"><span class="orange">YOUR</span> ORDERS</h3>
								<div class="row" style="padding: 20px;">
									<?php if ($this->go_cart->total_items()==0):?>
										<div class="message">There are no products in your cart!</div>
									<?php else: ?>
										<div class="row" style="margin-bottom: 20px;">
											<?php
												$grandtotal = 0;
												$subtotal = 0;

												foreach ($this->go_cart->contents() as $cartkey=>$product):
											?>
												<div class="col-xs-2">
													<img class="media-object" width="50" src="<?php echo base_url('uploads/product/thumb/'.$product['images']);?>" alt="cart-2.jpg">
												</div>
												<div class="col-xs-6" style="text-align: left">
													<p><b><?php echo $product['name']; ?></b></p>
													<p class="price"><?php echo $product['quantity'] ?>x <?php echo format_currency($product['base_price']);   ?></p>
												</div>
												<div class="col-xs-4"></div>
											<?php endforeach;?>
										</div>
										<div class="row">
											<div class="col-xs-8">
												<p>CART SUBTOTAL</p>
											</div>
											<div class="col-xs-4">
												<p><?php echo format_currency($this->go_cart->subtotal());?></p>
											</div>
											<div class="col-xs-8">
												<p>SHIPPING (<span style="font-size: 11px"><?php echo $this->go_cart->shipping_method();?></span>)</p>
											</div>
											<div class="col-xs-4">
												<p><?php echo "<span class='shipping'>".format_currency($this->go_cart->shipping_cost())."</span>";?></p>
											</div>
											<div class="col-xs-8" style="background-color: #F5F5F5; padding-top: 10px; padding-bottom: 10px;">
												<p style="margin-bottom: 0;">ORDER TOTAL</p>
											</div>
											<div class="col-xs-4" style="background-color: #F5F5F5; padding-top: 10px; padding-bottom: 10px;"	>
												<?php echo "<span class='grandtotal'>".format_currency($this->go_cart->total())."</span>"; ?>
											</div>
										</div>
										<div class="row" style="text-align: right; margin-top: 15px;">
												<input type="button" class="btn btn-black" onclick="return save_order();" value="CONTINUE" style="border-radius: 0;" /><!--onclick="submit_payment_method()"-->
										</div>
									<?php endif;?>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php include(APPPATH.'themes/'.$this->config->item('theme').'/views/footer.php'); ?>