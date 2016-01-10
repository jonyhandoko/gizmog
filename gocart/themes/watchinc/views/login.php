<?php
	include('header.php');
?>

			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-4">
						<div class="form-login">
							<div class="greet">
								<h3>HELLO VALUE CUSTOMER</h3>
								<p>It Looks Like you wish to order without creating an account. So complete the form address below</p>
							</div>
							<?php echo form_open('secure/login', array('class'=>'form-horizontal', 'role'=>'form'))?>
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" name="email" placeholder="Username">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<input type="password" class="form-control" name="password" placeholder="Password">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<input type="hidden" value="<?php echo $redirect;?>" name="redirect"/>
										<input type="hidden" value="submitted" name="submitted"/>
										<button type="submit" class="btn btn-block btn-orange">LOG IN</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-sm-2">
						<h1 class="form-intersection">OR</h1>
					</div>
					<div class="col-sm-6">
						<div class="form-register">
							<div class="greet">
								<h3>NEW CUSTOMER</h3>
								<p>It Looks Like you wish to order without creating an account. So complete the form address below</p>
							</div>
							<?php echo form_open('secure/register', array('class'=>'form-horizontal', 'role'=>'form')); ?>
								<div class="form-group">
									<div class="col-sm-12">
										<input type="email" class="form-control" name="email" placeholder="Email">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-6">
										<input type="password" class="form-control" name="password" placeholder="Password">
									</div>
									<div class="col-sm-6">
										<input type="password" class="form-control" name="confirm" placeholder="Confirm Password">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-6">
										<input type="text" class="form-control" name="firstname" placeholder="First Name">
									</div>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="lastname" placeholder="Last Name">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control" name="address1" placeholder="Address">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control number" name="zip" placeholder="Zip Code">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<?php echo form_dropdown('province_id', $provinces_menu,  set_value('province_id', ''), '  id="f_province_id" class="form-control"');?>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<input type="text" class="form-control number" name="phone" placeholder="Phone Number">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
									<button type="submit" class="btn btn-block btn-orange">REGISTER</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

<?php
	include('footer.php');
?>
