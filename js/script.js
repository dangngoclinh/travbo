jQuery(document).ready(function () {

    var body = jQuery("body");
    /*
     * Header Cart
     * */
    jQuery(document).mouseup(function (e) {
        var $header_cart = jQuery(".header-cart");
        var $pro_cart = jQuery(".pro-cart");
        var $header_cart_btn = jQuery(".header-cart .header-cart-button a");
        if ($header_cart.hasClass("active")) {
            if (!$pro_cart.is(e.target)
                && $pro_cart.has(e.target).length == 0
                && $header_cart_btn.has(e.target).length == 0) {
                jQuery(".header-cart .header-cart-button a").trigger("click");
            }
        }
    });

    jQuery(".header-cart .header-cart-button a").click(function (e) {
        e.preventDefault();
        jQuery(this).closest(".header-cart").toggleClass("active");
    });

    /*Remove product*/
    jQuery(".pro-table .cart-remove").click(function (e) {
        e.preventDefault();
        var $product = jQuery(this).closest("tr");
        $product.slideUp(400, function () {
            $product.remove();
        });
    });

    /*
     * Search Box
     * */
    jQuery(document).mouseup(function (e) {
        var $search_box = jQuery("#search .search-box-wrap");
        var $search = jQuery("#search");
        var $btn_search = jQuery("#search .btn-search");
        if ($search.hasClass("active")) {
            if (!$search_box.is(e.target)
                && $search_box.has(e.target).length == 0
                && $btn_search.has(e.target).length == 0) {
                $btn_search.trigger("click");
            }
        }
    });

    jQuery("#search .btn-search").click(function (e) {
        e.preventDefault();
        jQuery(this).closest("#search").toggleClass("active");
    });

    /*Rating*/
    jQuery(".ratebox").raterater({
        submitFunction: 'travbo_ratebox',
        allowChange: true,
        starWidth: 15,
        spaceWidth: 2,
        numStars: 5
    });

    /*Widget Tab*/
    jQuery(".widget-tabs .tab-link").click(function (e) {
        e.preventDefault();
        jQuery(".widget-tabs .tab-link").removeClass("active");
        jQuery(this).addClass("active");

        var data_tab = jQuery(this).attr("data-tab");
        var class_tab_name = "." + data_tab;
        var widget_tabs = jQuery(this).closest(".widget-tabs");
        var tabs_content = jQuery(".tabs-content", widget_tabs);

        //dis active all
        jQuery(".tab-content.active", tabs_content).fadeOut("slow", function () {
            jQuery(this).removeClass("active");
            jQuery(".tab-content" + class_tab_name, tabs_content).fadeIn("slow", function () {
                jQuery(this).addClass("active");
            });
        });

    });

    /*Main-Menu*/
    jQuery("#main-menu-pull").click(function (e) {
        e.preventDefault();
        body.toggleClass("menu-main-mobile-active");
    });

    var mobile_arrow = '<i class="mobile-arrow fa fa-chevron-down"></i>';
    jQuery('.menu-mobile .menu-item-has-children').append(mobile_arrow);

    jQuery(".menu-mobile .mobile-arrow").click(function () {
        var li = jQuery(this).closest('li');
        li.children(".sub-menu").slideToggle("slow", function () {
            if (li.hasClass("active")) {
                li.removeClass("active");
                li.children(".mobile-arrow").removeClass("fa-chevron-up");
                li.children(".mobile-arrow").addClass("fa-chevron-down");
            }
            else {
                li.addClass("active");
                li.children(".mobile-arrow").removeClass("fa-chevron-down");
                li.children(".mobile-arrow").addClass("fa-chevron-up");
            }
        })
    });

    jQuery(".pull-icon:before").animate({
        opacity: 0.25,
        left: "+=50",
        height: "toggle"
    }, 5000, function () {
        // Animation complete.
    });

    jQuery(".mf-module .owl-slider").owlCarousel({

        navigation: true, // Show next and prev buttons
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,

        navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        pagination: false
    });

    //reply button
    jQuery(".comments .reply-button").click(function (e) {
        e.preventDefault();
        var comments = jQuery(this).closest(".comments");
        var comment_item = jQuery(this).closest(".comment-item");
        var comment_form = jQuery(".comment-form-wrapper", comments);
        comment_item.append(comment_form);
    });

    //Template Option
    jQuery(".template-option .left-sidebar").click(function (e) {
        e.preventDefault();
        body.toggleClass("left-sidebar");
    });

    jQuery(".gallery-size-travbo_large").owlCarousel({

        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true

        // "singleItem:true" is a shortcut for:
        // items : 1,
        // itemsDesktop : false,
        // itemsDesktopSmall : false,
        // itemsTablet: false,
        // itemsMobile : false
    });

    jQuery(".slides").owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true,
        navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        pagination: false
    });

    jQuery(".gallery.gallery-columns-3").owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:false,
        navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        pagination: true,
        items : 3,
    });

    //Widget about me bg

});

function travbo_ratebox(id, rating) {
    jQuery.ajax({
        url: travbo_data.admin_ajax,
        type: 'POST',
        data: {
            action: 'travbo_ratebox',
            id: id,
            rating: rating
        },
        success: function(result) {
            alert('Thans for Voting ' + result.data.rating);
        }
    });
}