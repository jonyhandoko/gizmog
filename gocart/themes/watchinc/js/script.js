// (function() {
// Header
	// Not Used and Do The Same Things
	/*
		var isMobile = {
			Android: function() {
				return navigator.userAgent.match(/Android/i);
			},
			BlackBerry: function() {
				return navigator.userAgent.match(/BlackBerry/i);
			},
			iOS: function() {
				return navigator.userAgent.match(/iPhone|iPad|iPod/i);
			},
			Opera: function() {
				return navigator.userAgent.match(/Opera Mini/i);
			},
			Windows: function() {
				return navigator.userAgent.match(/IEMobile/i);
			},
			any: function() {
				return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
			}
		};

		if (isMobile.any()) {
			document.write('<meta name="viewport" content="width=device-width, initial-scale=1">');
		} else {
			document.write('<meta name="viewport" content="width=1170, user-scalable=yes" />');
		}

		if (isMobile.any()) {console.log(
			document.write('<link href="<?php echo base_url('gocart/themes/'.$this->config->item('theme').'/css/init.css');?>" rel="stylesheet">');
			document.write('<link href="<?php echo base_url('gocart/themes/'.$this->config->item('theme').'/css/devs.css');?>" rel="stylesheet">');
		} else {
			document.write('<link href="<?php echo base_url('gocart/themes/'.$this->config->item('theme').'/css/init.css');?>" rel="stylesheet">');
			document.write('<link href="<?php echo base_url('gocart/themes/'.$this->config->item('theme').'/css/devs.css');?>" rel="stylesheet">');
		}
	*/



// Footer
	function DropDown(el) {
		this.dd = el;
		this.placeholder = this.dd.children('span');
		this.opts = this.dd.find('ul.dropdown > li');
		this.val = '';
		this.index = -1;
		this.initEvents();
	}
	DropDown.prototype = {
		initEvents : function() {
			var obj = this;
			obj.dd.on('click', function(event){
				if ($(this).hasClass('active')) {
					$('.wrapper-dropdown-1').removeClass('active');
				} else {
					$('.wrapper-dropdown-1').removeClass('active');
					$(this).toggleClass('active');
				}
				return false;
			});
			obj.opts.on('click',function(){
				var opt = $(this);
				obj.val = opt.text();
				obj.index = opt.index();
				/* var filtername = opt.parent().parent().find('span').attr('data-filter-name');
				if (obj.val=='NO FILTER') {
					opt.parent().parent().find('span').text(filtername);
				} else {
					opt.parent().parent().find('span').text(filtername+': ' + obj.val);
				} */
			});
		},
		getValue : function() {
			return this.val;
		},
		getIndex : function() {
			return this.index;
		}
	};

	// Initiator
	var dd = new DropDown( $('.drops') );
	$(document).click(function() {
		$('.wrapper-dropdown-1').removeClass('active');
	});

	function dropdownBase() {
		var Watchinc = {};
		Watchinc.queryParams = {};

		if (location.search.length) {
			for (var aKeyValue, i = 0, aCouples = location.search.substr(1).split('&'); i < aCouples.length; i++) {
				aKeyValue = aCouples[i].split('=');
				if (aKeyValue.length > 1) {
					if (decodeURIComponent(aKeyValue[1]).length > 0) {
						Watchinc.queryParams[decodeURIComponent(aKeyValue[0])] = decodeURIComponent(aKeyValue[1].replace('+',' ').replace('%2B',' '));
						$("#"+decodeURIComponent(aKeyValue[0])+" option[value='"+decodeURIComponent(aKeyValue[1]).replace('+',' ')+"']").attr('selected','selected');
						$(".filter-list").append("<a href='javascript:void(0);' class='filter-box' data-filter='"+decodeURIComponent(aKeyValue[0])+"'>"+decodeURIComponent(aKeyValue[1].replace('+',' ').replace('%2B',' '))+" <i class='fa fa-remove'></i></a>");
					}
				}
			}
			$('.filter-container').show();
		} else {
			$('.filter-container').hide();
		}

		$('.coll-filter a').click(function() {
			if ($(this).text()) {
				Watchinc.queryParams[$(this).parent().parent().parent().find('span').attr("data-filter-code")] = $(this).text();
			} else {
				delete Watchinc.queryParams[$(this).parent().parent().parent().find('span').attr("data-filter-code")];
			}
			location.search = $.param(Watchinc.queryParams);
		});

		var priceCheck = false;
		$('.priceFilter').click(function() {
			var Watchinc = {};
			Watchinc.queryParams = {};

			if (location.search.length) {
				for (var aKeyValue, i = 0, aCouples = location.search.substr(1).split('&'); i < aCouples.length; i++) {
					aKeyValue = aCouples[i].split('=');
					if (aKeyValue.length > 1) {
						if (decodeURIComponent(aKeyValue[1]).length > 0) {
							if (aKeyValue[0]=="filterPrice") {
								aKeyValue[1]=$(this).attr("price-filter");
								priceCheck = true;
							}
							Watchinc.queryParams[decodeURIComponent(aKeyValue[0])] = decodeURIComponent(aKeyValue[1].replace('+',' ').replace('%2B',' '));
						}
					}
				}
			}
			if (!priceCheck) {
				Watchinc.queryParams.filterPrice = $(this).attr('price-filter');
			}

			location.search = $.param(Watchinc.queryParams);
		});

		$('.filter-box').click(function() {
			delete Watchinc.queryParams[$(this).attr('data-filter')];
			location.search = $.param(Watchinc.queryParams);
		});
	}
	dropdownBase();



// Category
	var productContent = document.getElementById('product-content'), timer, isLoading;

	/* $(window).scroll(function() {
		if (timer) {
			window.clearTimeout(timer);
		}

			if (($(window).scrollTop() > $(productContent).height() - $(productContent).offset().top - 20) && !isLoading) {

				isLoadingData = true;
				var next_url = $('.next-pagination').attr('href');
				$('.load-font').hide();
				$('.load-gif').show();

				timer = window.setTimeout(function() {
					if (next_url) {
						$.ajax({
							url: next_url,
							cache: false,
							success: function(data) {
								isLoadingData  = false;
								$('.pagination').remove();
								$('div#product-content').append($( data ).find('#product-content').html());
								$('img.lazy').lazyload({effect: 'fadeIn'});
								$('.load-font').show();
								$('.load-gif').hide();
							}
						});
					} else {
						$('.more').remove();
					}
				}, 1500);
			}

	}); */

	$('.more').on('click',function() {
		var next_url = $('.next-pagination').attr('href');
		//var query_string = $('.query-string').attr('data-query');
		$('.load-font').hide();
		$('.load-gif').show();
		if (next_url) {
			$.ajax({
				//url: next_url+query_string,
				url: next_url,
				cache: false,
				success: function(data) {
					$('.pagination').remove();
					$('.query-string').remove();
					$('div#product-content').append($( data ).find('#product-content').html());
					$('img.lazy').lazyload({effect: 'fadeIn'});
					$('.load-font').show();
					$('.load-gif').hide();
				}
			});
		} else {
			$('.more').remove();
		}
	});

	$('img.lazy').lazyload({effect: 'fadeIn'});



// Login
	// Not Used Didn't Found Selector Element
	/*
		$('#country_id').change(function() {
			$('#f_province_id').html("");
			$.post('<?php echo site_url('/places/get_jne_one_cities_menu');?>',{country:$('#country_id').val()}, function(data) {
				$('#f_province_id').html(data);
			});
		});
	*/



// Product
	$('#godetails').click(function() {
		var target = $('.gotab');
		$('html, body').animate({ scrollTop: target.offset().top - 50 }, 500);
		$('#detailstab').click();
		return false;
	});



// My Account
	var pmdac = document.getElementById('php-message-delete-address-confirmation');
	var pmemha = document.getElementById('php-message-error-must-have-address');
	var pusda = document.getElementById('php-url-set-default-address');

	$('.delete_address').click(function() {
		if ($('.delete_address').length > 1) {
			if (confirm(pmdac.value)) {
				$.post("http://watchinc.co.id/secure/delete_address", { id: $(this).attr('rel') }, function(data) {
					$('#address_' + data).remove();
					$('#address_list .my_account_address').removeClass('address_bg');
					$('#address_list .my_account_address:even').addClass('address_bg');
				});
			}
		} else {
			alert(pmemha.value);
		}
	});

	$('.edit_address').click(function() {
		$.colorbox({href: pusda.value + $(this).attr('rel'), width:'600px', height:'500px'}, function() {
		});
	});

	$('#address_list .my_account_address:even').addClass('address_bg');

	function set_default(address_id, type) {
		$('.create_dialog_style').show();
		$.post('http://watchinc.co.id/secure/set_default_address/',{id:address_id, type:type}, function(data) {
			$('.create_dialog_style').hide();
		});
	}

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



// Checkout
	var pbisa = document.getElementById('php-boolean-isset-ship-address');
	var ppjy = document.getElementById('php-param-jne-yes');
	var ppjr = document.getElementById('php-param-jne-reg');
	var puil = document.getElementById('php-url-img-loader');
	var puccd = document.getElementById('php-url-checkout-customer-detail');
	var puccf = document.getElementById('php-url-checkout-customer-form');
	var pucssmp = document.getElementById('php-url-checkout-save-shipping-method-price');
	var pucspm = document.getElementById('php-url-checkout-save-payment-method');
	var pmesp = document.getElementById('php-message-error-save-payment');

	$('.input').focus(function(){
		$(this).addClass('input_hover');
	});
	$('.input').blur(function(){
		$(this).removeClass('input_hover');
	});

	if (pbisa) {
		if (pbisa.value == '1') {
			$.post(puccd.value, function(data) {
				$('#customer_info_fields').html(data);
			});
		} else {
			get_customer_form();
		}
	}

	$('input:radio[name=shipping_method]').change(function() {
		if (this.value == 'yes') {
			$.post(pucssmp.value, {method: 'JNE YES', price: ppjy.value}, function(data) {
				location.reload();
			});
		} else {
			$.post(pucssmp.value, {method: 'JNE REG', price: ppjr.value}, function(data) {
				location.reload();
			});
		}
	});

	function get_customer_form() {
		$('#save_customer_loader').show();
		$('#submit_button_container').hide();
		$('.payment-box, .order-box').css({
			opacity: '0.5',
			cursor: 'no-drop'
		}).find('input, button').attr('disabled', 'disabled');

		$('#shipping_payment_container').html('<div class="checkout_block"><img alt="loading" src="' +  puil.value + '"/><br style="clear: both;"/></div>').hide();
		$.post(puccf.value, function(data) {
			$('#customer_info_fields').html(data);
		});
	}

	function save_order() {
		var frm_data = $('input:radio[name=payment_method]:checked').serialize();
		if ($('input:radio[name=payment_method]:checked').val() == 'paypal_express') {
			$.post(pucspm.value, frm_data, function(response) {
				if (typeof response != 'object') {
					display_error('payment', pmesp.value);
					return;
				}
				if (response.status == 'success') {
					$('#order_submit_form').trigger('submit');
				} else if (response.status=='error') {
					display_error('payment', response.error);
				}
			}, 'json');
		} else if ($('input:radio[name=payment_method]:checked').val()=='bank_transfer') {
			$.post(pucspm.value, frm_data, function(response) {
				if (typeof response != 'object') {
					display_error('payment', pmesp.value);
					return;
				}
				if (response.status=='success') {
					$('#order_submit_form').trigger('submit');
				} else if(response.status=='error') {
					display_error('payment', response.error);
				}
			}, 'json');
		} else {
			alert("Please choose payment method");
		}
	}



// Customer Detail Static
	var pbau = document.getElementById('php-boolean-address-update');
	var pfcsc = document.getElementById('php-format-currency-shipping-cost');
	var pfct = document.getElementById('php-format-currency-total');
	var pfcjr = document.getElementById('php-format-currency-jne-reg');
	var pfcjy = document.getElementById('php-format-currency-jne-yes');

	$('#shipping_payment_container').show();
	$('#submit_button_container').show();

	if (pbau) {
		if (pbau.value == '1') {
			$('.shipping').html(pfcsc.value);
			$('.grandtotal').html(pfct.value);
			$('.jne_reg').html(pfcjr.value);
			$('.jne_yes').html(pfcjy.value);
			location.reload();
		}
	}

	$('.address').change(function(e) {
		$.post(puccd.value, function(data){});
	});



// Order Summary
  /*
	var logged_in_user = <?php if($this->Customer_model->is_logged_in(false, false)) echo "true"; else echo "false"; ?>;
	var shipping_required = <?php echo ($this->go_cart->requires_shipping()) ? 'true' : 'false'; ?>;
	var shipping = Array();
	var shipping_choice = '<?php $shipping=$this->go_cart->shipping_method(); if($shipping) print_r($shipping); ?>';
	var addr_context = '';
	var ship_to_bill_address = <?php if(isset($customer['ship_to_bill_address'])) { echo $customer['ship_to_bill_address']; } else { echo 'false'; } ?>;
	var addresses;
	var cart_total = <?php echo $this->go_cart->total(); ?>;

	function submit_payment_method() {
		errors = false;
		if (errors) {
			return false;
		}
		save_order();
	}

	function save_order() {
		if (cart_total > 0) {
			$('#order_submit_form').trigger('submit');
		}
	}
	*/

// }());
