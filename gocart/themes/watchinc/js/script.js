(function() {
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



// Search
	function searchMan() {
		var d = document, s = d.getElementById('search'), sb = d.getElementsByClassName('search-block')[0], sc = sb.getElementsByClassName('search-close')[0], sfc = sb.getElementsByClassName('form-control')[0];

		s.addEventListener('click', function(e) {
			e.preventDefault();
			sb.className = 'search-block opened';
			sfc.focus();
		});

		sc.addEventListener('click', function(e) {
			e.preventDefault();
			sb.className = 'search-block closed';
			sfc.value = '';
		});
	}
	searchMan();



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
	$('.more').on('click',function() {
		var next_url = $('.next-pagination').attr('href');
		if (next_url) {
			$.ajax({
				url: next_url,
				cache: false,
				success: function(data) {
					$('.pagination').remove();
					$('div#product-content').append($( data ).find('#product-content').html());
					$('img.lazy').lazyload({effect: 'fadeIn'});
				}
			});
		} else {
			$('.more').remove();
		}
	});

	$('img.lazy').lazyload({effect: 'fadeIn'});



// Login
	// Not Used Didn't Found Selector Element
	/* $(document).ready(function() {
		$('#country_id').change(function() {
			$('#f_province_id').html("");
			$.post('<?php echo site_url('/places/get_jne_one_cities_menu');?>',{country:$('#country_id').val()}, function(data) {
			  $('#f_province_id').html(data);
			});
		});
	}); */



// Product
	$('#godetails').click(function() {
		var target = $('.gotab');
		$('html, body').animate({ scrollTop: target.offset().top - 50 }, 500);
		$('#detailstab').click();
		return false;
	});

}());
