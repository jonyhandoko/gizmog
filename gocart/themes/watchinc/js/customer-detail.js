// Customer Detail

// User Logged In

	if ($('#different_address').is(':checked')) {
		toggle_billing_address_form(true);
	}

	$('*:disabled').addClass('disabled');

	$('.ship').change(function(){
		if ($('#different_address').is(':checked')) {
			copy_shipping_address();
		}
	});

	$('#ship_province_id').change(function() {
		populate_zone_menu('ship');
	});

	$('#bill_country_id').change(function() {
		populate_zone_menu('bill');
	});

	var shipping_required = document.getElementById('php-boolean-require-shipping').value;
	var shipping = Array();

	function populate_zone_menu(context, value) {
		$.post(document.getElementById('php-url-get-cities-menu').value, {provinceId: $('#ship_province_id').val()}, function(data) {
			$('#ship_city_id').html(data);
			if (context == 'ship' && $('#different_address').is(':checked')) {
				$('#bill_zone_id').html(data).val($('#bill_zone_id option:first').val());
			}
		});
	}

	function toggle_billing_address_form(checked) {
		if (!checked) {
			clear_billing_address();
			$('.bill').attr('disabled', false);
			$('.bill').removeClass('disabled');
		} else {
			copy_shipping_address();
			$('.bill').attr('disabled', true);
			$('.bill').addClass('disabled');
		}
	}

	function clear_billing_address() {
		$('.bill').val('');
	}

	function copy_shipping_address() {
		$('#bill_firstname').val($('#ship_firstname').val());
		$('#bill_lastname').val($('#ship_lastname').val());
		$('#bill_address1').val($('#ship_address1').val());
		$('#bill_address2').val($('#ship_address2').val());
		$('#bill_city').val($('#ship_city').val());
		$('#bill_zip').val($('#ship_zip').val());
		$('#bill_phone').val($('#ship_phone').val());
		$('#bill_email').val($('#ship_email').val());
		$('#bill_country_id').val($('#ship_country_id').val());
	}

	function save_customer() {
		$('#save_customer_loader').show();

		$('.payment-box, .order-box').removeAttr('style').find('input').removeAttr('disabled').removeClass('disabled');

		if ($('#different_address').is(':checked')) {
			$('.bill').attr('disabled', false);
			$('.bill').removeClass('disabled');
		}

		form_data  = $('#customer_info_form').serialize();

		$.post(document.getElementById('php-url-save-customer').value, form_data, function(response) {
			if (typeof response != "object") {
				display_error('customer', document.getElementById('php-message-communication-error').value);
				return;
			}

			if (response.status=='success') {
				$('#customer_info_fields').html(response.view);
				location.reload();
			} else if (response.status=='error') {
				display_error('customer', response.error);
				$('#save_customer_loader').hide();
			}
		}, 'json');
	}

	function display_error(id, error) {
		$('#customer_error_box').html(error);
		$('#customer_error_box').show();
	}


// User Not Logged In

	var address_type = 'ship';
	$('.address_picker').click(function() {
		$.colorbox({href: '#address_manager', inline: true, height: '400px', width: '400px'});
		address_type = $(this).attr('rel');
	});

	function populate_address(address_id) {

		if (address_id=='') return;
		if (shipping_required && address_type=='ship') {
			$('#shipping_loading').show();
			$('#shipping_method_list').hide();
		}

		var addresses = JSON.parse(document.getElementById('php-customer-addresses').value);
		$.each(addresses[address_id], function(key, value) {
			$('#'+address_type+'_'+key).val(value);
		});

		$('#'+address_type+'_address_id').val(address_id);

		$.post(document.getElementById('php-url-get-zone-menu').value, {id:$('#'+address_type+'_country_id').val()}, function(data) {
			if (address_type=='bill') {
				$('#different_address').attr('checked', false);
				$('.bill').attr('disabled', false);
				$('.bill').removeClass('disabled');
				$('#bill_zone_id').html(data);
				$('#bill_zone_id').val(zone_id);
			} else {
				if ($('#different_address').is(':checked')) {
					copy_shipping_address();
				}
			}
		});
	}


// General

	$('#country_id').change(function() {
		$('#ship_province_id').html(document.getElementById('php-url-jne-one-cities-menu').value);
		$.post('',{country:$('#country_id').val()}, function(data) {
			$('#ship_province_id').html(data);
		});
	});

	$('#address_list .my_account_address:even').addClass('address_bg');