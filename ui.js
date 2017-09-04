$(document).ready(function() {

    //=SEARCH=

    var is_search_toggled = false;

    $("#search_bttn").click(function() {

        if(is_search_toggled == false) {

            $(".site_header_ul_menu_opt").stop().hide(0);
            $(".site_header_ul_search").stop().delay(100).show(0);

            $("#search_bttn").html("<i class='fa fa-times'></i>");
            $("#search_bttn").animate({

                "border-radius": "0px"
            }, 100);

            $("#search_inp").animate({

                "width": "400px"
            }, 200);


            is_search_toggled = true;
        }

        else {
         
            $("#search_bttn").html("<i class='fa fa-search'></i>");
            $("#search_bttn").animate({

                "border-radius": "50%"
            }, 100);

            $("#search_inp").animate({

                "width": "0px"
            }, 200);

            $(".site_header_ul_search").stop().delay(100).hide(0);
            $(".site_header_ul_menu_opt").stop().delay(200).show(0);

            is_search_toggled = false;
        }
    });
});