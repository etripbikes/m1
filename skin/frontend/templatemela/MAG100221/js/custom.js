var widthClassOptions = [];
var widthClassOptions = ({
		bestseller       : 'bestseller_default_width',
		newproduct       : 'newproduct_default_width',
		featured         : 'featured_default_width',
		special          : 'special_default_width',
		additional       : 'additional_default_width',
		related          : 'related_default_width',
		upsell	         : 'upsell_default_width',
		crosssell        : 'crosssell_default_width',
		brand			 : 'brand_default_width',
		testimonial 	 : 'testimonial_default_width',
		slider           : 'slider_default_width',
		blog			 : 'blog_default_width'
});


var $k =jQuery.noConflict();

$k(document).ready(function(){
	
	$k('input[type="checkbox"]').tmMark(); 
	$k('input[type="radio"]').tmMark();
	
	$k(".form-language select").selectbox();
	$k(".tm_top_currency select").selectbox();
	$k(".limiter select").selectbox();
	$k(".sort-by select").selectbox();
	$k(".block-brand-nav select").selectbox();
	
	
	$k('#additional-carousel').owlCarousel({
		items: 4,
		singleItem: false,
		navigation: true,
		navigationText: ['', ''],
		pagination: false,
		itemsDesktop : [1350,4],
		itemsDesktopSmall :	[979,3],
		itemsTablet :	[767,3]
	});

	
	$k('.nav-responsive').click(function() {
		$k('#nav-mobile').slideToggle();
		$k('.nav-responsive div').toggleClass('active');
    });
	
	$k("#category-treeview").treeview({
		animated: "slow",
		collapsed: true,
		unique: true
	});
	
	
	$k("#category-treeview li.active").addClass('collapsable');
	$k("#category-treeview li.active").removeClass('expandable');
	$k("#category-treeview li.active > .hitarea").addClass('collapsable-hitarea');
	$k("#category-treeview li.active > .hitarea").removeClass('expandable-hitarea');
	$k("#category-treeview li.active > ul").css('display','block');
	
	
	$k('#my-video').backgroundVideo({
		$videoWrap: $k('.wrapper_inner'),
    	$outerWrap: $k('.video-wrapper'),
    	preventContextMenu: true,
		pauseVideoOnViewLoss: false,
    	parallaxOptions: {
        	offset: 60,
        	effect: 1.7
    	}
	});
	
	
	$k('.cms-home ul.messages').addClass('container-width').insertAfter('.header-container');


	$k(".tab_product:not(:first)").hide();
	 
	 //to fix u know who
	 $k(".tab_product:first").show();
	 
	 //when we click one of the tabs
	 $k(".tabbernav_product  li  a").click(function(){
	
	 //get the ID of the element we need to show
	 stringref = $k(this).attr("href").split('#')[1];
	 
	 //hide the tabs that doesn't match the ID
	 $k('.tab_product:not(#'+stringref+')').hide();
	 //fix
	 if ($k.browser.msie && $k.browser.version.substr(0,3) == "6.0") {
	 $k('.tab_product#' + stringref).show();
	 }
	 else
	 //display our tab fading it in
	 $k('.tab_product#' + stringref).fadeIn();
	 
	 //stay with me
	 return false;
	 });
	 
	 $k(".tabbernav_product a").click(function(){
		$k(".tabbernav_product a").removeClass("selected");
		$k(this).addClass("selected");
		productListAutoSet();
		  
	}); 
	
	
	/*   F I T   V I D E O S */
	if($k().fitVids) {
		$k("body").fitVids();
	}
	
	$k(".lightbox").colorbox({ 
		opacity:  0.5,
		speed:    1000,
		width:	400,
		height:	300
    });

    $k('.page-title').prependTo('.breadcrumbs-outer .container-width');
	
});







function mobileToggleMenu(){
	
	if ($k(window).width() < 980)
	{
		$k("#footer .mobile_togglemenu,#footer .block .block-title .mobile_togglemenu").remove();
		$k("#footer h6 , #footer .block .block-title").append( "<a class='mobile_togglemenu'>&nbsp;</a>" );
		$k("#footer h6 , #footer .block .block-title").addClass('toggle');
		$k("#footer .mobile_togglemenu ,#footer .block .block-title .mobile_togglemenu ").click(function(){
			$k(this).parent().toggleClass('active').parent().find('ul').toggle('slow');
	});

	}else{
		$k("#footer h6 , #footer .block .block-title").parent().find('ul').removeAttr('style');
		$k("#footer h6 , #footer .block .block-title").removeClass('active');
		$k("#footer h6 , #footer .block .block-title").removeClass('toggle');
		$k("#footer .mobile_togglemenu ,#footer .block .block-title .mobile_togglemenu ").remove();
	}	
}
$k(document).ready(function(){mobileToggleMenu();});
$k(window).resize(function(){mobileToggleMenu();});

function mobileToggleColumn(){
	
	if ($k(window).width() < 980){ 
		$k('.sidebar .mobile_togglecolumn').remove();
		$k(".sidebar .block-title" ).append( "<span class='mobile_togglecolumn'>&nbsp;</span>" );		 
		$k(".sidebar .block-title" ).addClass('toggle');	 
		$k(".sidebar .mobile_togglecolumn").click(function(){
			$k(this).parent().toggleClass('selected').parent().find('.block-content').toggle('slow');
		});
	}
	else{ 
		$k(".sidebar .block-title" ).parent().find('.block-content').removeAttr('style');		 
		$k(".sidebar .block-title" ).removeClass('toggle');		 
		$k(".sidebar .block-title" ).removeClass('selected');
		$k('.sidebar .mobile_togglecolumn').remove();		 
	}
}
$k(document).ready(function(){mobileToggleColumn();});
$k(window).resize(function(){mobileToggleColumn();});


function menuResponsive(){
	 
	if ($k(window).width() < 980){ 
		$k('#advancedmenu').css('display','none');
		$k('.advanced_nav').css('display','none');
		$k('.nav-responsive').css('display','block');
		 var elem = document.getElementById("nav");
				 if(typeof elem !== 'undefined' && elem !== null) {
					document.getElementById("nav").id= "nav-mobile";
		
		if($k('.main-navigation').hasClass('treeview')!=true){
			$k(".nav-inner").addClass('responsive-menu');	 
			$k(".nav-inner #nav-mobile").treeview({
				animated: "slow",
				collapsed: true,
				unique: true		
			});
			$k('.nav-inner #nav-mobile a.active').parent().removeClass('expandable');
			$k('.nav-inner #nav-mobile a.active').parent().addClass('collapsable');
			$k('.nav-inner #nav-mobile .collapsable ul').css('display','block');	
			
		}
	  } 	 
	}else{
		$k('#advancedmenu').css('display','block');
		$k('.advanced_nav').css('display','block');
		$k('.nav-responsive').css('display','none');	
		$k(".nav-inner .hitarea").remove();
		$k(".nav-inner").removeClass('responsive-menu');	 
		$k("#nav-mobile").removeClass('treeview');
		$k(".nav-inner ul").removeAttr('style');
		$k('.nav-inner li').removeClass('expandable');
		$k('.nav-inner li').removeClass('collapsable');		 
		 var elem = document.getElementById("nav-mobile");
			 if(typeof elem !== 'undefined' && elem !== null) {
				document.getElementById("nav-mobile").id= "nav";
		}
	}

}
$k(document).ready(function(){menuResponsive();});
$k(window).resize(function(){menuResponsive();});
 
 
function productCarouselAutoSet() {
	$k(".main .product-carousel, .additional-carousel .product-carousel,.homeslider_cms .product-carousel,.container-width .product-carousel").each(function() {
		var objectID = $k(this).attr('id');
		var myObject = objectID.replace('-carousel','');
		if(myObject.indexOf("-") >= 0)
			myObject = myObject.substring(0,myObject.indexOf("-"));		
		if(widthClassOptions[myObject])
			var myDefClass = widthClassOptions[myObject];			
		else
			var myDefClass= 'grid_default_width';
		var slider = $k(".main #" + objectID + ", .additional-carousel #"+ objectID + ", .homeslider_cms #"+ objectID + ", .container-width #"+ objectID);
		slider.sliderCarousel({
			defWidthClss : myDefClass,
			subElement   : '.slider-item',
			subClass     : 'product-block',
			firstClass   : 'first_item_tm',
			lastClass    : 'last_item_tm',
			slideSpeed : 200,
			paginationSpeed : 800,
			autoPlay : false,
			stopOnHover : false,
			goToFirst : true,
			mouseDrag : false,
			touchDrag : false,
			goToFirstSpeed : 1000,
			goToFirstNav : true,
			pagination : true,
			paginationNumbers: false,
			responsive: true,
			responsiveRefreshRate : 200,
			baseClass : "slider-carousel",
			theme : "slider-theme",
			autoHeight : true,
			addClassActive : true
		});

		
		var nextButton = $k(this).parent().find('.next');
		var prevButton = $k(this).parent().find('.prev');
		nextButton.click(function(){
			slider.trigger('slider.next');
		})
		prevButton.click(function(){
			slider.trigger('slider.prev');
		})
	});
}
//$k(window).load(function(){productCarouselAutoSet();});
$k(document).ready(function(){productCarouselAutoSet();});


function productListAutoSet() {
	$k("ul.products-grid").each(function(){
	var objectID = $k(this).attr('id');
		if(objectID.length >0){		
			if(widthClassOptions[objectID.replace('-grid','')])
				var myDefClass= widthClassOptions[objectID.replace('-grid','')];
			}else{ 
			var myDefClass= 'grid_default_width';			
		}	
		$k(this).smartColumnsRows({
			defWidthClss : myDefClass,
			subElement   : 'li',
			subClass     : 'product-block'
		});
	});
}
$k(window).load(function(){productListAutoSet();});
$k(window).resize(function(){productListAutoSet();});

 


function mobileTabToggle(){
	//alert($k(window).width());
	if ($k(window).width() < 980)
	{
		$k(".padder .mobile_togglemenu").remove();
		$k(".padder h6").append( "<h5 class='mobile_togglemenu'>&nbsp;</h5>" );
		$k(".padder h6").addClass('toggle');
		$k(".padder .mobile_togglemenu").click(function(){
			$k(this).parent().toggleClass('active').parent().find('ol').toggle('slow');
		});

	}else{
		$k(".padder h6").parent().find('ol').removeAttr('style');
		$k(".padder h6").removeClass('active');
		$k(".padder h6").removeClass('toggle');
		$k(".padder .mobile_togglemenu").remove();
	}
}
$k(document).ready(function(){mobileTabToggle();});
$k(window).resize(function(){mobileTabToggle();});



// Can also be used with $k(document).ready()
$k(document).ready(function() {
	$k("#spinner").fadeOut("slow");
});	


$k(document).ready(function(){

jQuery(function($k){

	var max_elem = 3;

	var items = $k('#advancedmenu .menu');
	var surplus = items.slice(max_elem, items.length-1);
	surplus.wrapAll('<div class="level-top hidden_menu menu"><div class="category-wrapper"><ul>');
	$k('.hidden_menu').prepend('<div class="parentMenu"><a href="" class="level-top"><span>More</span></a></div>');
	

});

});




/*For Parallax*/

$k(window).load(function(){
					 
	var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent);
	if(!isMobile) {
		if($k(".parallax,.video-wrapper").length){$k(".parallax,.video-wrapper").sitManParallex({invert: false });};    
	}else{
		$k(".parallax,.video-wrapper").sitManParallex({ invert: true });
	}
	
	var str1 = $k('.tm_top_currency .sbSelector').text();
	var str2 = $k('.form-language .sbSelector').text();
	
	$k('.tm_top_currency .sbHolder .sbOptions li').each(function() {
			var newtext1 = $k(this);
  			var curr = newtext1.find('a');
			var sample1 = curr.text();
			
			if(str1 === sample1){
				$k(this).css("display","none");
			}
	});
	
	$k('.form-language .sbHolder .sbOptions li').each(function() {
			var newtext2 = $k(this);
  			var lang = newtext2.find('a');
			var sample2 =	lang.text();
			
			if(str2 === sample2){
				$k(this).css("display","none");
			}	
	});
	
});


function tabjs(){
	$k('#homecms_tab a').each(function() {
	 	var obj = $k(this);
		$k(obj.attr('href')).hide();
		obj.click(function(event) {
			event.preventDefault();
			$k('#homecms_tab a').each(function() {
				$k(this).removeClass('selected');					  
			});
			$k(this).addClass('selected');
			$k('.homecms').each(function() {
				$k(this).find('.tab_product').hide();
			});
			$k($k(this).attr('href')).fadeIn();
		});
	});
	$k('#homecms_tab').siblings('#tab-1').fadeIn();
}

$k(document).ready(function(){tabjs();});


function headerfix() {
 	if ($k(window).width() > 979){
		if ($k(this).scrollTop() > 200) {
				$k(".header-container").addClass('fixed');
				$k(".header-container + section").addClass('wrapped');
		} else{
				$k(".header-container").removeClass('fixed');
				$k(".header-container + section").removeClass('wrapped');
		}
		} else{
				$k(".header-container").removeClass('fixed');
				$k(".header-container + section").removeClass('wrapped');
		}
}

$k(window).resize(function() {headerfix();});
$k(document).ready(function() {headerfix();});
$k(window).scroll(function() {headerfix();});




$k(document).ready(function() {
							
$k("body").append("<a class='top_button' title='Back To Top' href=''>TOP</a>");

$k(window).scroll(function () {
	if ($k(this).scrollTop() > 70) {
		$k('.top_button').fadeIn();
	} else {
		$k('.top_button').fadeOut();
	}
});

// scroll body to 0px on click
$k('.top_button').click(function () {
	$k('body,html').animate({
		scrollTop: 0
	}, 800);
	return false;
});

});


function playvideo(){

	var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent);

	var vid = document.getElementById("my-video");

	if(isMobile) {
		$k(".video-box").click(function (event) {
			event.preventDefault();
			vid.play();
		});
	}

	}
$k(document).ready(function() {playvideo();});
$k(window).resize(function() {playvideo();});
