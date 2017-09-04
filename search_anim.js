$(document).ready(function() {

    //=SEARCH AREA=

    var search_toggled = false;

    $("#search_bttn").click(function() {

        if(search_toggled == false) {

            $(".site_header_social").animate({

                "border-radius": "20px",
            }, 75);

            $("#search_inp").toggle();
            $("#search_inp").animate({

                "width": "270px"
            }, 75);
            $("#search_inp").delay(75).animate({

                "width": "220px"
            }, 75);
            $("#search_bttn").html("<i class='fa fa-times'></i>");

            search_toggled = true;
        }

        else {

            $("#search_inp").animate({

                "width": "0px"
            }, 75);
            $("#search_inp").delay(10).toggle(0);
            $("#search_bttn").html("<i class='fa fa-search'></i>");
        
            search_toggled = false;            
        }
    });
});