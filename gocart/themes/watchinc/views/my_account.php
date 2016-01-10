<?php include('header.php');?>

<link type="text/css" href="<?php echo base_url('js/jquery/colorbox/colorbox.css');?>" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url('js/jquery/colorbox/jquery.colorbox-min.js');?>"></script>

<?php
	if (validation_errors()) {
		echo '<div class="error">'.validation_errors().'</div>';
	}
?>

<script>
	$(document).ready(function() {
		$('.delete_address').click(function() {
			if ($('.delete_address').length > 1) {
				if (confirm('<?php echo lang('delete_address_confirmation');?>')) {
					$.post("<?php echo site_url('secure/delete_address');?>", { id: $(this).attr('rel') }, function(data) {
						$('#address_'+data).remove();
						$('#address_list .my_account_address').removeClass('address_bg');
						$('#address_list .my_account_address:even').addClass('address_bg');
					});
				}
			} else {
				alert('<?php echo lang('error_must_have_address');?>');
			}
		});

		$('.edit_address').click(function() {
			$.colorbox({href: '<?php echo site_url('secure/address_form'); ?>/' + $(this).attr('rel'), width:'600px', height:'500px'}, function() {
				//$('input:submit, input:button, button').button();
			});
		});

		/* if ($.browser.webkit) {
			$('input:password').attr('autocomplete', 'off');
		} */
	});

	function set_default(address_id, type) {
		$('.create_dialog_style').show();
		$.post('<?php echo site_url('secure/set_default_address') ?>/',{id:address_id, type:type}, function(data) {
			$('.create_dialog_style').hide();
		});
	}
</script>

<?php
	// $company	= array('id'=>'company', 'class'=>'input1', 'name'=>'company', 'value'=> set_value('company', $customer['company']));
	$first		= array('id'=>'firstname', 'class'=>'input1', 'name'=>'firstname', 'value'=> set_value('firstname', $info->firstname));
	$last		= array('id'=>'lastname', 'class'=>'input1', 'name'=>'lastname1', 'value'=> set_value('lastname', $info->lastname));
	$email		= array('id'=>'email', 'class'=>'input1', 'name'=>'email', 'disabled'=>'disabled', 'value'=> set_value('email', $info->email));
	$phone		= array('id'=>'phone', 'class'=>'input1', 'name'=>'phone', 'value'=> set_value('phone', $info->phone));

	$password	= array('id'=>'password', 'class'=>'input1', 'name'=>'password', 'value'=>'');
	$confirm	= array('id'=>'confirm', 'class'=>'input1', 'name'=>'confirm', 'value'=>'');
?>

<!-- Container -->
<div class="container">
	<div style="margin-top: 40px; margin-bottom: 40px;">
		<div class="row">
			<div class="col-sm-3">
				<div class="preview change-mode-box">
					<div>
						<div class="media">
							<div class="media-left media-middle">
								<div class="photo-profile">
									<img class="media-object" src="<?php echo base_url('/images/watchinc/icon/user-outline.png');?>" alt="Jony Handoko">
								</div>
							</div>
							<div class="media-body media-middle">
								<h4 class="media-heading">Jony Handoko</h4>
							</div>
						</div>
					</div>
					<br>
					<div>
						<h4>Registered Email</h4>
						<p>asik01@gmail.com</p>
						<p><i>Subscribed to Newsletter</i></p>
					</div>
					<br>
					<div>
						<h4>Address 1 <span>(Default Shipping)</span></h4>
						<p>Jl. Madrasah 2 No. 30 D RT 8 RW 2 Kelurahan Kebon Jeruk Kecamatan Kebon Jeruk Jakarta Barat 11540</p>
					</div>
					<br>
					<div>
						<h4>Address 2</h4>
						<p>Mitra Building 10 Floor Jalan Gatot Subroto Kav 21 Jakarta Selatan 12950</p>
					</div>
					<br>
					<div>
						<h4>Phone Number</h4>
						<p>082111454536</p>
					</div>
					<br>
					<button type="button" class="btn btn-orange change-mode">EDIT</button>
				</div>
				<div class="edit change-mode-box" style="display: none;">
					<form>
						<div>
							<div class="media">
								<div class="media-left media-middle">
									<div class="photo-profile edit">
										<img class="media-object" src="<?php echo base_url('/images/watchinc/icon/user-outline.png');?>" alt="Jony Handoko">
										<a class="change-photo-profile">
											<img src="<?php echo base_url('/images/watchinc/icon/camera-outline.png');?>">
										</a>
										<input type="file" style="display: none;">
									</div>
								</div>
								<div class="media-body media-middle">
									<input type="text" class="form-control" placeholder="Name" value="Jony Handoko">
								</div>
							</div>
						</div>
						<br>
						<div>
							<h4>Registered Email</h4>
							<input type="text" class="form-control" placeholder="Email" value="asik01@gmail.com">
							<div class="checkbox">
								<label>
									<input type="checkbox" value=""> Subscribed to Newsletter
								</label>
							</div>
						</div>
						<br>
						<div>
							<h4>Address 1</h4>
							<textarea class="form-control" placeholder="Address 1" rows="4" style="resize: none;">Jl. Madrasah 2 No. 30 D RT 8 RW 2 Kelurahan Kebon Jeruk Kecamatan Kebon Jeruk Jakarta Barat 11540</textarea>
							<div class="radio">
								<label>
									<input type="radio" name="default_address"  value="address1" checked>Set as Default Shipping Address
								</label>
							</div>
						</div>
						<br>
						<div>
							<h4>Address 2</h4>
							<textarea class="form-control" placeholder="Address 2" rows="4" style="resize: none;">Mitra Building 10 Floor Jalan Gatot Subroto Kav 21 Jakarta Selatan 12950</textarea>
							<div class="radio">
								<label>
									<input type="radio" name="default_address"  value="address2">Set as Default Shipping Address
								</label>
							</div>
						</div>
						<br>
						<div>
							<h4>Phone Number</h4>
							<input type="text" class="form-control" placeholder="Phone Number" value="082111454536">
						</div>
						<br>
						<button type="submit" class="btn btn-orange change-mode">SAVE</button>
						<button type="button" class="btn btn-black change-mode">CANCEL</button>
					</form>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="tabs-orange">
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#order-history" aria-controls="order-history" role="tab" data-toggle="tab">ORDER HISTORY</a></li>
						<li role="presentation"><a href="#payment" aria-controls="payment" role="tab" data-toggle="tab">PAYMENT</a></li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="order-history">
							<table class="table table-hover table-center">
								<thead>
									<tr>
										<th>Date</th>
										<th>Order ID</th>
										<th>Amount</th>
										<th>Status</th>
										<th>Payment</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row">23 September 2015</th>
										<td>15676456644</td>
										<td>IDR 3.444.500</td>
										<td>Pending</td>
										<td class="act"><button type="button" class="btn btn-orange">Confirm</button></td>
									</tr>
									<tr>
										<th scope="row">23 Maret 2015</th>
										<td>15676456622</td>
										<td>IDR 1.444.500</td>
										<td>Pending</td>
										<td><span>Confirmed</span></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div role="tabpanel" class="tab-pane" id="payment">
							<h4>PAYMENT</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$('.change-mode').on('click', function(e) {
			e.preventDefault();
			$('.change-mode-box').slideToggle();
			$('html, body').animate({scrollTop: '165px'});
		});

		$('.photo-profile').on('click', '.change-photo-profile', function(e) {
			e.preventDefault();
			this.nextElementSibling.click();
		});

		$('.photo-profile').on('change', 'input', function() {
			readURL(this, this.parentElement.getElementsByTagName('img')[0]);
		});

		function readURL(input, img) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
				  img.src = e.target.result;
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
	</script>

	<div class="thing" style="display: none;">
		<div class="row">
			<div class="col-sm-2">
				<div class="list-group list-clean regular">
					<a href="/secure/my_account" class="list-group-item active">PROFILE</a>
					<a href="/secure/my_orders" class="list-group-item">ORDERS</a>
					<a href="/cart/confirmation_payment" class="list-group-item">PAYMENT</a>
				</div>
			</div>
			<div class="col-sm-10">
				<div class="greet">
					<h3 class="text-left">PROFILE</h3>
				</div>
				<div class="panel panel-as-table panel-lite">
					<div class="panel-body">
						<div class="row seperator">
							<div class="col-sm-6">
								<table>
									<tr>
										<td width="100">
											<?php echo lang('account_firstname');?><b class="r"> *</b>
											<br/>
											<?php echo form_input($first);?>
										</td>
										<td width="100">
											<?php echo lang('account_lastname');?><b class="r"> *</b>
											<br/>
											<?php echo form_input($last);?>
										</td>
									</tr>
									<tr>
										<td width="100">
											Email *
											<br/>
											<?php echo form_input($email);?>
										</td>
										<td width="100">
											Phone</b>
											<br/>
											<?php echo form_input($phone);?>
										</td>
									</tr>
									<tr>
										<td colspan="2"><input type="checkbox" name="email_subscribe" value="1" <?php if((bool)$info->email_subscribe) { ?> checked="checked" <?php } ?>/> <?php echo lang('account_newsletter_subscribe');?></td>
									</tr>
									<tr>
										<td width="100">
											Password
											<br/>
											<?php echo form_password($password);?>
										</td>
										<td width="100">
											Confirm Password
											<br/>
											<?php echo form_password($confirm);?>
										</td>
									</tr>
									<tr>
										<td colspan="2" align="right"><input type="submit" value="Save Information" class="button2"  /></td>
									</tr>
								</table>
							</div>
							<div class="col-sm-6">
								<?php if ($addresses != NULL):?>
								<table>
									<tr>
										<td colspan="2">
											<?php if(count($addresses)<2){?><input type="button" class="edit_address right" rel="0" value="<?php echo lang('add_address');?>"/><?php }?><span>(Max 2 addresses)</span>
										</td>
									</tr>
									<script type="text/javascript">
										$(document).ready(function(){
											$('#address_list .my_account_address:even').addClass('address_bg');
										});
									</script>
									<?php
									$c = 1;
									foreach($addresses as $a):?>
									<tr>
										<td width="80">Address <?php echo $c;?></td>
										<td>
											<div class="my_account_address" id="address_<?php echo $a['id'];?>">
												<div class="address_toolbar">
													<!--<input type="radio" name="bill_chk" onclick="set_default(<?php echo $a['id'] ?>, 'bill')" <?php if($customer['default_billing_address']==$a['id']) echo 'checked="checked"'?> /> <?php echo lang('default_billing');?> --><input type="radio" name="ship_chk" onclick="set_default(<?php echo $a['id'] ?>,'ship')" <?php if($customer['default_shipping_address']==$a['id']) echo 'checked="checked"'?>/> <?php echo lang('default_shipping');?>
												</div>
												<br/>
												<?php
												$b	= $a['field_data'];
												echo nl2br(format_address($b));
												$c++;
												?>
											</div>
										</td>
									</tr>
									<td colspan="2" align="right">
										<input type="button" class="delete_address button2" rel="<?php echo $a['id'];?>" value="<?php echo lang('form_delete');?>" />
										<input type="button" class="edit_address button2" rel="<?php echo $a['id'];?>" value="<?php echo lang('form_edit');?>" />
									</td>
									<?php endforeach;?>
								</table>
								<?php else: ?>
								<input type="button" class="edit_address right" rel="0" value="<?php echo lang('add_address');?>"/><span>(Max 2 addresses)</span>
								<p>Please fill at least 1 shipping address</p>
								<?php endif;?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ./Container -->

<?php include('footer.php');?>