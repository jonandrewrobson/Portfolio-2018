(function($) { 'use strict';

	// Calculate clients viewport
	function viewport() {
		var e = window, a = 'inner';
		if(!('innerWidth' in window )) {
			a = 'client';
			e = document.documentElement || document.body;
		}
		return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
	}

	// Strech center aligned images

	var centerAlignedImages = function () {

		viewport();
		var w=window,d=document,
		e=d.documentElement,
		g=d.getElementsByTagName('body')[0],
		x=w.innerWidth||e.clientWidth||g.clientWidth, // Viewport Width
		y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

		var body = $('body');


		if(body.hasClass('single') || body.hasClass('page') && !body.hasClass('page-template-gallery-page')){
			var centerAlignImg = $('.content-area .aligncenter');

			if(centerAlignImg.length){
				$('#primary').imagesLoaded(function(){
					centerAlignImg.each(function(){
						var $this = $(this);
						var centerAlignImgWidth;
						var entryContentWidth = $('.entry-content').width();

						if($this.is('img')){
							centerAlignImgWidth = $this.prop('naturalWidth');
						}
						else{
							centerAlignImgWidth = $this.find('img').prop('naturalWidth');
							if(x > 1024){
								$this.css({width: centerAlignImgWidth});
							}
							else{
								$this.css({width: ''});
							}
						}


						if(x > 1024){
							if(centerAlignImgWidth > entryContentWidth){
								if(centerAlignImgWidth > 1000){
									$this.css({marginLeft: -((1000 - entryContentWidth) / 2)});
								}
								else{
									$this.css({marginLeft: -((centerAlignImgWidth - entryContentWidth) / 2)});
								}
							}
						}
						else{
							$this.css({marginLeft: ''});
						}
						$this.css('opacity', 1);
					});
				});

			}
		};
	};

	$(document).ready(function($){

		// Calculate clients viewport
		function viewport() {
			var e = window, a = 'inner';
			if(!('innerWidth' in window )) {
				a = 'client';
				e = document.documentElement || document.body;
			}
			return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
		}

		var w=window,d=document,
		e=d.documentElement,
		g=d.getElementsByTagName('body')[0],
		x=w.innerWidth||e.clientWidth||g.clientWidth, // Viewport Width
		y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

		// Global Vars

		var body = $('body'),
			mainContent = $('#content'),
			sidebar = $('.sidebar-hide-scroll');


		// auto resize textareas

		var txt = $('textarea');

		txt.each(function(){

			var content = null;

			$(this).addClass('txtstuff');
			$(this).after('<div class="hiddendiv common"></div>');

			var hiddenDiv = $(this).next('.hiddendiv');
			hiddenDiv.css('width', $(this).width());

			$(document).on('resize', function(){
				hiddenDiv.css('width', $(this).width());
			});

			$(this).on('keyup', function () {

				content = $(this).val();

				content = content.replace(/\n/g, '<br>');
				hiddenDiv.html(content + '<br class="lbr">');
				hiddenDiv.css('width', $(this).width());

				$(this).css('height', hiddenDiv.height());

			});
		});

		// Outline none on mousedown for focused elements

		body.on('mousedown', '*', function(e) {
			if(($(this).is(':focus') || $(this).is(e.target)) && $(this).css('outline-style') == 'none') {
				$(this).css('outline', 'none').on('blur', function() {
					$(this).off('blur').css('outline', '');
				});
			}
		});

		// Disable search submit if input empty
		$( '.search-submit' ).prop( 'disabled', true );
		$( '.search-field' ).keyup( function() {
			$('.search-submit').prop( 'disabled', this.value === "" ? true : false );
		});

		// Dropcaps

		if(body.hasClass('single') || body.hasClass('page')){

			var dropcap = $('span.dropcap');
			if(dropcap.length){
				dropcap.each(function(){
					var $this = $(this);
					$this.attr('data-dropcap', $this.text());
					$this.parent().css({
						"position" : "relative",
						"z-index" : 0
					});
				});
			}
		};

		// dropdown button

		var menuDropdownLink = $('.main-navigation .menu-item-has-children>a, .main-navigation .page_item_has_children>a');

		var dropDownArrow = $('<button class="dropdown-toggle clear-button"><span class="screen-reader-text">toggle child menu</span><span class="dropdown-symbol"></span></button>');

		menuDropdownLink.after(dropDownArrow);


		// dropdown open on click

		var dropDownButton = $('button.dropdown-toggle');

		dropDownButton.on('click', function(e){
			e.preventDefault();
			var $this = $(this);
			$this.parent('li').toggleClass('toggle-on').find('.toggle-on').removeClass('toggle-on');
			$this.parent('li').siblings().removeClass('toggle-on');
		});

		$('.main-navigation .menu').on('mouseleave', function () {
			$(this).find('.toggle-on').removeClass('toggle-on');
		});

		// Checkbox and Radio buttons

		//if buttons are inside label
		function radio_checkbox_animation() {
			var checkBtn = $('label').find('input[type="checkbox"]');
			var checkLabel = checkBtn.parent('label');
			var radioBtn = $('label').find('input[type="radio"]');

			checkLabel.addClass('checkbox');

			checkLabel.click(function(){
				var $this = $(this);
				if($this.find('input').is(':checked')){
					$this.addClass('checked');
				}
				else{
					$this.removeClass('checked');
				}
			});

			var checkBtnAfter = $('label + input[type="checkbox"]');
			var checkLabelBefore = checkBtnAfter.prev('label');

			checkLabelBefore.click(function(){
				var $this = $(this);
				$this.toggleClass('checked');
			});

			radioBtn.change(function(){
				var $this = $(this);
				if($this.is(':checked')){
					$this.parent('label').siblings().removeClass('checked');
					$this.parent('label').addClass('checked');
				}
				else{
					$this.parent('label').removeClass('checked');
				}
			});
		}

		radio_checkbox_animation();

		// Sharedaddy

		function shareDaddy(){
			var shareTitle = $('.sd-sharing .sd-title');

			if(shareTitle.length){
				var shareWrap = shareTitle.closest('.sd-sharing-enabled');
				shareWrap.attr({'tabindex': '0'});
				shareTitle.on('click touchend', function(){
					$(this).closest('.sd-sharing-enabled').toggleClass('sd-open');
				});

				$(document).keyup(function(e) {
					if(shareWrap.find('a').is(':focus') && e.keyCode == 9){
						shareWrap.addClass('sd-open');
					}
					else if(!(shareWrap.find('a').is(':focus')) && e.keyCode == 9){
						shareWrap.removeClass('sd-open');
					}
				});
			}
		}

		shareDaddy();

		// Big search field

		var bigSearchWrap = $('div.search-wrap');
		var bigSearchButtons = $('div.search-button');
		var bigSearchField = bigSearchWrap.find('.search-field');
		var bigSearchTrigger = $('.big-search-trigger');
		var bigSearchCloseBtn = $('.big-search-close');
		var bigSearchClose = bigSearchButtons.add(bigSearchCloseBtn);

		// close sidemenu modal on ESC

		var toggleBigSearch = function() {
			if(body.hasClass('big-search')){
				body.removeClass('big-search');
				setTimeout(function(){
					$('.search-wrap').find('.search-field').blur();
				}, 50);
			} else {
				body.addClass('big-search');
				setTimeout(function(){
					$('.search-wrap').find('.search-field').focus();
				}, 50);
			};
		}


		bigSearchCloseBtn.on('touchend click', function(e){
			e.preventDefault();
		});

		bigSearchClose.on('touchend click', function(){
			var $this = $(this);
			toggleBigSearch();
		});

		bigSearchTrigger.on('touchend click', function(e){
			e.preventDefault();
			e.stopPropagation();
			toggleBigSearch();
		});

		bigSearchField.on('touchend click', function(e){
			e.stopPropagation();
		});

		$().on('touchend click', function(e){
			e.stopPropagation();
		});

		// open / close info on portfolio single

		$('.info-toggle').on('touchend, click', function(){

			body.toggleClass('show-info');

			if (body.hasClass('show-info')) {
				$.fn.fullpage.setMouseWheelScrolling(false);
			} else {
				$.fn.fullpage.setMouseWheelScrolling(true);
			}
		})

		// close sidemenu modal on ESC

		$(document).keyup(function(e) {
			if (e.keyCode == 27) {
				if (body.hasClass('sidebar-open')) {
					toggleSidebar();
				}
			}
		});

		// Disable scroll if big search sidemenu is open

		// left: 37, up: 38, right: 39, down: 40,
		// spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
		var keys = {37: 1, 38: 1, 39: 1, 40: 1, 32: 1, 33: 1, 34: 1, 35: 1, 36: 1};

		var preventDefault = function (e) {
			e = e || window.event;
				if (e.preventDefault)
					e.preventDefault();
				e.returnValue = false;
		};

		var preventDefaultForScrollKeys = function (e) {
			if (keys[e.keyCode]) {
				preventDefault(e);
				return false;
			}
		};

		$(".sidebar-holder").mCustomScrollbar({
			theme: "minimal",
			scrollInertia: 60,
		});

		// toggle sidebar (widget area)
		$('.sidebar-toggle').on('click touchstart', function() {
			toggleSidebar();
		});

		var toggleSidebarDelay = false;
		var toggleSidebar = function () {
			if (toggleSidebarDelay) {
			} else {
				toggleSidebarDelay = true;
				setTimeout(function(){
					toggleSidebarDelay = false;
				}, 400);
				if (body.hasClass('sidebar-open')) {
					body.removeClass('sidebar-open');

					mainContent.css({
						'-webkit-transform': 'none',
						'-moz-transform': 'none',
						'-ms-transform': 'none',
						'-o-transform': 'none',
						'transform': 'none'
					});

					if ($('html').hasClass('fp-enabled')) {
						$.fn.fullpage.setMouseWheelScrolling(true);
					};

					body.mCustomScrollbar("update");

					mainContent.unbind('click');
				} else {
					body.addClass('sidebar-open');

					if ( !body.hasClass('has-video-header') ) {
						var sidebarWidth = parseInt(sidebar.outerWidth(false), 10);

						if (body.hasClass('rtl')) {
							var translateSidebarWidth = 'translateX(' + sidebarWidth + 'px )';
						} else {
							var translateSidebarWidth = 'translateX(-' + sidebarWidth + 'px )';
						}

						mainContent.css({
							'-webkit-transform': translateSidebarWidth,
							'-moz-transform': translateSidebarWidth,
							'-ms-transform': translateSidebarWidth,
							'-o-transform': translateSidebarWidth,
							'transform': translateSidebarWidth
						});
					};
					if ($('html').hasClass('fp-enabled')) {
						$.fn.fullpage.setMouseWheelScrolling(false);
					};

					body.mCustomScrollbar("disable",false);

					mainContent.on('click', function(){
						toggleSidebar();
						return false;
					})
				}
			}
		}


		$('.widget').each(function(){
			var titleWidth = $(this).find('.widget-title').css('width');
			$(this).css('min-height', titleWidth);
		});

		if ($('body.page-template-home-slider').length) {
			$('#content').css({
				'display': 'block',
			});
		}


		// enable fullPage js on archive page

		var slider = $('.featured-slider');
		var archive = $('.archive-list');
		var portfolio = $('.portfolio-images-wrapper');

		var activeSec = 0;

		if (slider.length) {

			var autoScroll = false;
			if (slider.hasClass('autoplay-slider')) {
				autoScroll = true;
				var autoScrollNext = true,
					autoScrollInterval = 5000,
					moveDown = function () {
						if (autoScrollNext) {
							$.fn.fullpage.moveSectionDown()
						}
					};
			}

			slider.fullpage({
				scrollingSpeed: 600,
				continuousVertical: true,
				fitToSectionDelay: 100,
				sectionSelector: 'article',
				afterLoad: function(anchorLink, index){
					var startSection = index;
					$('.slick-dots-wrapper .current').text(startSection);

					if (autoScroll) {
						autoScrollNext = false;
						setTimeout(function(){
							autoScrollNext = true;
						}, autoScrollInterval)
					};
				},
				onLeave: function(index, nextIndex, direction){
					var goingSection = nextIndex;

					$('.slick-dots-wrapper .current').text(goingSection);
				},
				afterRender: function(){

					if (autoScroll) {
						var slideTimeout = setInterval(moveDown, autoScrollInterval);

						$('.featured-slider .entry-header, .view-post-link a').hover(
							function() {
								autoScrollNext = false;
								setTimeout(function(){
									autoScrollNext = true;
								}, autoScrollInterval)
							}, function() {

						});
					}
				},
			});


		} else if (archive.length) {

			if ($('#infinite-handle').length) {
				$('#infinite-handle').addClass('archive-item fp-auto-height');
			}

			archive.fullpage({
				scrollingSpeed: 600,
				sectionSelector: '.archive-item',
				onLeave: function() {
					activeSec = $('.archive-item.active').index();
					activeSec += 1;
				},
				responsiveWidth: '900',
			});
		} else if (portfolio.length) {

			var numberOfSlides = parseInt($('.slick-dots-wrapper .count').text()) + 2;

			portfolio.fullpage({
				scrollingSpeed: 600,
				sectionSelector: '.portfolio-item',
				onLeave: function(index, nextIndex, direction){
					var goingSection = nextIndex;

					$('.slick-dots-wrapper .current').text(goingSection - 1);

					if ( goingSection == numberOfSlides || goingSection == 1) {
						$('.slick-dots-wrapper').addClass('hide');
					} else {
						$('.slick-dots-wrapper').removeClass('hide');
					}
				},
				afterRender: function(){
					setTimeout(function(){
						if ($('.portfolio-item.entry-header').hasClass('active')){
							$.fn.fullpage.moveTo(2);
						}
					}, 2000);
				},
			});

			$('.single-jetpack-portfolio .entry-content').mCustomScrollbar({
				theme: "minimal",
				scrollInertia: 60,
			});
		} else {
		}

		$(document.body).on('post-load', function(){

			if ($('.portfolio-archive').length && body.hasClass('portfolio-grid')) {

				var $container = $('#post-load');
				// Reactivate masonry on post load
				var newEl = $container.children().not('article.post-loaded, span.infinite-loader').addClass('post-loaded');

				newEl.imagesLoaded(function () {

					// Reactivate masonry on post load

					var newElNeedAnimate = $container.children().not('.animate, span.infinite-loader');

					$container.masonry('appended', newElNeedAnimate, true).masonry('layout');

					setTimeout(function(){
						newEl.each(function(i){
							var $this = $(this);

							if($this.find('iframe').length){
								var $iframe = $this.find('iframe');
								var $iframeSrc = $iframe.attr('src');

								$iframe.load($iframeSrc, function(){
									$container.masonry('layout');
								});
							}

							setTimeout(function(){
								newEl.eq(i).addClass('animate');
							}, 100 * (i+1));
						});
					}, 150);

				});
			}

			// turn on title display on hovering over featured images
			if ( body.hasClass('portfolio-hover-title') && x > 1200 ) {


				$('.portfolio-archive .row .has-post-thumbnail .archive-background').each(function(){
					$(this).mouseout(function() {
						$('.portfolio-archive .row .has-post-thumbnail .archive-background .entry-header').css('display', 'none');
					});
					$(this).mouseenter(function() {
						$(this).find('.entry-header').css('display', 'block');

						return false;
					});

					$(this).mousemove(function(e) {
						$(this).find('.entry-header').css({
							'left': e.clientX,
							'top': e.clientY,
							'display': 'block'
						});
					});
				})
			}

			if (archive.length) {
				setTimeout(function(){

					var infiniteHandles = $('#infinite-handle');
					infiniteHandles.addClass('archive-item fp-auto-height');

					$.fn.fullpage.destroy('all');
					$('.archive-item').eq(activeSec).addClass('active');
					$('.infinite-loader').remove();
					$('.archive-list article').each(function(){
						var height = $(this).find('.archive-item-holder').outerHeight(false);

						$(this).find('.entry-meta').css('width', height);
					});

					archive.fullpage({
						scrollingSpeed: 600,
						sectionSelector: '.archive-item',
						onLeave: function() {
							activeSec = $('.archive-item.active').index();
							activeSec += 1;
						},
						responsiveWidth: '900',
					});
					$.fn.fullpage.fitToSection();
				}, 50)
			}

			radio_checkbox_animation();

		});

		// entry meta on archive list

		if ( $('.archive-list').length ) {
			$('.archive-list article').each(function(){
				var height = $(this).find('.archive-item-holder').outerHeight(false);
				$(this).find('.entry-meta').css('width', height);
			});
		}

		if ( $('.portfolio-archive').length) {

			// turn on title display on hovering over featured images
			if ( body.hasClass('portfolio-hover-title') && x > 1200 ) {


				$('.portfolio-archive .row .has-post-thumbnail .archive-background').each(function(){
					$(this).mouseout(function() {
						$('.portfolio-archive .row .has-post-thumbnail .archive-background .entry-header').css('display', 'none');
					});
					$(this).mouseenter(function() {
						$(this).find('.entry-header').css('display', 'block');

						return false;
					});

					$(this).mousemove(function(e) {

						if (body.hasClass('sidebar-open')) {
							var sidebarWidth = parseInt(sidebar.outerWidth(false), 10);
							if (body.hasClass('rtl')) {
								$(this).find('.entry-header').css({
									'left': e.clientX - sidebarWidth,
									'top': e.clientY,
									'display': 'block'
								});
							} else {
								$(this).find('.entry-header').css({
									'left': e.clientX + sidebarWidth,
									'top': e.clientY,
									'display': 'block'
								});
							}
						} else {
							$(this).find('.entry-header').css({
								'left': e.clientX,
								'top': e.clientY,
								'display': 'block'
							});
						}
					});
				})
			}
		}

	}); // End Document Ready

	$(window).on('load pageshow', function(){

		// Calculate clients viewport
		function viewport() {
			var e = window, a = 'inner';
			if(!('innerWidth' in window )) {
				a = 'client';
				e = document.documentElement || document.body;
			}
			return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
		}

		var w=window,d=document,
		e=d.documentElement,
		g=d.getElementsByTagName('body')[0],
		x=w.innerWidth||e.clientWidth||g.clientWidth, // Viewport Width
		y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

		// Global Vars

		var body = $('body');

		if ( $('.portfolio-archive').length && body.hasClass('portfolio-grid')) {
			var $container = $('#post-load');

			$container.imagesLoaded( function() {
				$container.masonry({
					//itemSelector: '.masonry article',
					transitionDuration: 0
				}).masonry('layout');

				var masonryChild = $container.find('article.hentry, #infinite-handle');

				masonryChild.each(function(i){
					setTimeout(function(){
						masonryChild.eq(i).addClass('post-loaded animate');
					}, 100 * (i+1));
				});

			});

		}

		// Preloader - show content

		var preload = function() {

			$('body').addClass('show');
			$('body').removeClass('leaving');
		};

		centerAlignedImages();

		preload();


	}); // End Window Load

	$(window).resize(function(){

		// Calculate clients viewport
		function viewport() {
			var e = window, a = 'inner';
			if(!('innerWidth' in window )) {
				a = 'client';
				e = document.documentElement || document.body;
			}
			return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
		}

		var w=window,d=document,
		e=d.documentElement,
		g=d.getElementsByTagName('body')[0],
		x=w.innerWidth||e.clientWidth||g.clientWidth, // Viewport Width
		y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

		// Global Vars

		var body = $('body'),
			mainContent = $('#content'),
			sidebar = $('.sidebar-hide-scroll');


		centerAlignedImages();

		if (body.hasClass('sidebar-open')) {

			if ( !body.hasClass('has-video-header') ) {
				var sidebarWidth = parseInt(sidebar.outerWidth(false), 10);

				if (body.hasClass('rtl')) {
					var translateSidebarWidth = 'translateX(' + sidebarWidth + 'px )';
				} else {
					var translateSidebarWidth = 'translateX(-' + sidebarWidth + 'px )';
				}
				mainContent.css({
					'-webkit-transform': translateSidebarWidth,
					'-moz-transform': translateSidebarWidth,
					'-ms-transform': translateSidebarWidth,
					'-o-transform': translateSidebarWidth,
					'transform': translateSidebarWidth,
				});
			};
		};

		$('.widget').each(function(){
			var titleWidth = $(this).find('.widget-title').css('width');
			$(this).css('min-height', titleWidth);
		});

	});

	// window unload

	$(window).on('beforeunload', function () {

		$('body').addClass('leaving');

		setTimeout(function() {
			$('#site-navigation').removeClass('toggled');
			$('body').removeClass('main-menu-open');
			return true;
		}, 150)

	});

})(jQuery);
