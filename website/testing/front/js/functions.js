$(document).ready(function() {
    $(".topNavR_sec nav li:last").addClass("last"), $("ul.quickLinks_block:last").addClass("last"), $(".aboutM3m_sec,.newsHom_sec,.industCSR_sec,.ourPresence_sec").addClass("equal_height"), $(".vertProjectSub_sec li:last-child").addClass("last"), $(".newsHomScroll li:last").addClass("last"), $(".tabs_div").hide(), $("ul.tabs li:first").addClass("active").show(), $(".tabs_div:first").show(), $("ul.tabs li").click(function() {
            $("ul.tabs li").removeClass("active"), $(this).addClass("active"), $(".tabs_div").hide();
            var e = $(this).find("a").attr("href");
            return $(e).fadeIn(500), !1
        }), 
		
		$("#tab1 ul.tabP li").mouseenter(function() {
            var e = $(this).attr("data-tab");
            $("#tab1 ul.tabP li").removeClass("navActv"), $("#tab1 .tabP_div").removeClass("navActv").css("opacity", 0).animate({
                opacity: 1
            }, 50), 
			$(this).addClass("navActv"), $("#" + e).addClass("navActv")
        });
		
		$("#tab2 ul.tabP li").mouseenter(function() {
            var e = $(this).attr("data-tab");
            $("#tab2 ul.tabP li").removeClass("navActv"), $("#tab2 .tabP_div").removeClass("navActv").css("opacity", 0).animate({
                opacity: 1
            }, 50), 
			$(this).addClass("navActv"), $("#" + e).addClass("navActv")
        });
		
		
		$("#tab3 ul.tabP li").mouseenter(function() {
            var e = $(this).attr("data-tab");
            $("#tab3 ul.tabP li").removeClass("navActv"), $("#tab3 .tabP_div").removeClass("navActv").css("opacity", 0).animate({
                opacity: 1
            }, 50), 
			$(this).addClass("navActv"), $("#" + e).addClass("navActv")
        });
		
		
		$("#tab4 ul.tabP li").mouseenter(function() {
            var e = $(this).attr("data-tab");
            $("#tab4 ul.tabP li").removeClass("navActv"), $("#tab4 .tabP_div").removeClass("navActv").css("opacity", 0).animate({
                opacity: 1
            }, 50), 
			$(this).addClass("navActv"), $("#" + e).addClass("navActv")
        }); 
		
		
		$("ul.tabBusns li").mouseenter(function() {
            var e = $(this).attr("data-tab");
            $("ul.tabBusns li").removeClass("actvNv"), $(".busns_div").removeClass("actvNv").css("opacity", 0).animate({
                opacity: 1
            }, 50), $(this).addClass("actvDv"), $("#" + e).addClass("actvDv")
        }), $("ul.tabBusns li").mouseleave(function() {
            var e = $(this).attr("data-tab");
            return $("ul.tabBusns li").removeClass("actvNv"), $(".busns_div").removeClass("actvNv").css("opacity", 1).animate({
                opacity: 0
            }, 50), $(this).removeClass("actvDv"), $("#" + e).removeClass("actvDv"), !1
        }), $(".bxMainSlider").bxSlider({
            mode: "fade",
            speed: 600,
            controls: !1,
            autoDelay: 1e3,
            pause: 6e3,
            auto: !0,
            preloadImages: "all",
            responsive: !0,
            hideControlOnEnd: !1,
            infiniteLoop: !0,
            touchEnabled: !0,
            pager: !0
        }),
        $(".projectHomSlider").bxSlider({
            speed: 600,
            controls: !0,
            pause: 6e3,
            preloadImages: "all",
            responsive: !0,
            hideControlOnEnd: !1,
            infiniteLoop: !0,
            touchEnabled: !0,
            pager: !1
        }),
        $(".videoslider").bxSlider({
            speed: 600,
            controls: !0,
            pause: 6e3,
            preloadImages: "all",
            responsive: !0,
            hideControlOnEnd: !1,
            infiniteLoop: !0,
            touchEnabled: !0,
            pager: !1,
            slideWidth: 350,
            minSlides: 1,
            maxSlides: 4,
            slideMargin: 20,
            nextSelector: '#next1',
            prevSelector: '#prev1',
        }),
        $(".awardSlider").bxSlider({
            speed: 600,
            controls: !0,
            pause: 6e3,
            preloadImages: "all",
            responsive: !0,
            hideControlOnEnd: !1,
            infiniteLoop: !0,
            touchEnabled: !0,
            pager: !1
        }),


        $(".innerNav").hide(), $("header nav li").children(".innerNav").hide(), $("header nav li").hover(function() {
            $(this).children(".innerNav").show().addClass("fadeInUpNav animated"), $(this).addClass("active")
        }, function() {
            $(this).children(".innerNav").hide().removeClass("fadeInUpNav animated"), $(this).removeClass("active")
        }), $(".mobile-menu").click(function() {
            return $(".mobile-show").slideToggle("slow"), $(".langNav").slideUp(300), $(".mobile-menu").toggleClass("active"), !1
        }), $(".mobile-menu, nav").click(function(e) {
            e.stopPropagation()
        }), screen.width < 1023 && $("html").click(function() {
            $(".mobile-show").slideUp()
        }), jQuery(".acrdClick").next(".acrdSec").hide();
    var e = window.location.href.slice(window.location.href.indexOf("?") + 1);
    "Architects" == e ? ($(".selected").not(".acrdClick:eq(0)").toggleClass("selected").next(".acrdSec").slideToggle(300), $(".acrdSec").slideUp(), $(".acrdClick:eq(0)").toggleClass("selected").next().slideToggle("")) : "Landscape" == e ? ($(".selected").not(".acrdClick:eq(1)").toggleClass("selected").next(".acrdSec").slideToggle(300), $(".acrdSec").slideUp(), $(".acrdClick:eq(1)").toggleClass("selected").next().slideToggle("")) : "Partners" == e ? ($(".selected").not(".acrdClick:eq(2)").toggleClass("selected").next(".acrdSec").slideToggle(300), $(".acrdSec").slideUp(), $(".acrdClick:eq(2)").toggleClass("selected").next().slideToggle("")) : "Golf_Course" == e ? ($(".selected").not(".acrdClick:eq(3)").toggleClass("selected").next(".acrdSec").slideToggle(300), $(".acrdSec").slideUp(), $(".acrdClick:eq(3)").toggleClass("selected").next().slideToggle("")) : "Structural" == e ? ($(".selected").not(".acrdClick:eq(4)").toggleClass("selected").next(".acrdSec").slideToggle(300), $(".acrdSec").slideUp(), $(".acrdClick:eq(4)").toggleClass("selected").next().slideToggle("")) : "Construction" == e ? ($(".selected").not(".acrdClick:eq(5)").toggleClass("selected").next(".acrdSec").slideToggle(300), $(".acrdSec").slideUp(), $(".acrdClick:eq(5)").toggleClass("selected").next().slideToggle("")) : "Equipment" == e ? ($(".selected").not(".acrdClick:eq(6)").toggleClass("selected").next(".acrdSec").slideToggle(300), $(".acrdSec").slideUp(), $(".acrdClick:eq(6)").toggleClass("selected").next().slideToggle("")) : ($(".selected").not(".acrdClick:eq(0)").toggleClass("selected").next(".acrdSec").slideToggle(300), $(".acrdSec").slideUp(), $(".acrdClick:eq(0)").toggleClass("selected").next().slideToggle("")), jQuery(".acrdClick").click(function(e) {
        $(".selected").not(this).toggleClass("selected").next(".acrdSec").slideToggle(300), $(this).toggleClass("selected").next().slideToggle("")
    }), screen.width < 1023 ? $(".launchClick").toggle(function() {
        $(".newLaunch_sec").animate({
            right: "0"
        }, 500), $(this).toggleClass("closed")
    }, function() {
        $(".newLaunch_sec").animate({
            right: "-88%"
        }, 500), $(this).toggleClass("closed")
    }) : screen.width >= 1024 && $(".launchClick").toggle(function() {
        $(".newLaunch_sec").animate({
            right: "0"
        }, 500), $(this).toggleClass("closed")
    }, function() {
        $(".newLaunch_sec").animate({
            right: "-93%"
        }, 500), $(this).toggleClass("closed")
    }), $("ul.residArrow li a").click(function() {
        return $(".ansDesignerSec").slideToggle("slow"), $("ul.residArrow li").toggleClass("active"), !1
    });
    var l = 0;
    $(".equal_height").each(function() {
        $(this).height() > l && (l = $(this).height())
    }), $(".equal_height").height(l)
});



jQuery(".arrowDown").click(function(e) {
    if ($(this).next(".eventShowSec").is(':visible')) {
        $(this).next(".eventShowSec").fadeOut(500);
        $(this).removeClass("selected");
        $(this).find("img").attr("src", "images/arrow_down.png");
    } else {
        $(".eventShowSec").fadeOut(500);
        $(".eventsRsec").find(".arrowDown img").attr("src", "images/arrow_down.png");
        //$("h3").removeClass("active");
        $(this).next(".eventShowSec").fadeIn(500);
        $(this).addClass("selected");
        $(this).find("img").attr("src", "images/close_button_green.png");
    }


    /*jQuery(".arrowDown").next(".eventShowSec").hide();
    jQuery(".arrowDown").click(function (e) {
        if ($(this).next(".eventShowSec").is(':visible')) {
            $(this).next(".eventShowSec").fadeOut(500);
            $(this).removeClass("selected");
            $(this).next('.closeBtn').hide();
            $(this).show();
        }
        else {
            $(".eventShowSec").fadeOut(500);
            //$("h3").removeClass("active");
            $(this).next(".eventShowSec").fadeIn(500);
            $(this).addClass("selected");
            $(this).next('.closeBtn').show();
            $(this).hide();
        }
    });
    jQuery(".closeBtn").click(function (e) {
        jQuery(".arrowDown").next(".eventShowSec").hide();
        $(this).prev('.arrowDown').show();
        $(this).hide();
        //$('.eventShowSec').removeClass('test');
    });*/




});