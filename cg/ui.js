$(document).ready(function() {

  var panel_hidden = false;

  $("#panel_control_toggle").click(function() {

    if (panel_hidden == true) {
      
      $(".left_align").show();
      $(".container").css("margin-left", "260px");
      panel_hidden = false;
    }

    else {

      $(".left_align").hide();
      $(".container").css("margin-left", "0px");
      panel_hidden = true;
    }

  });

  $(".sections_list_settings_bttn").click(function() {

    var section_id = $(this).attr('value');

    $(".section_settings_id_" + section_id).slideToggle(100);
  });

  $(".sections_list_info_bttn").click(function () {

    var section_id = $(this).attr('value');

    $(".section_info_id_" + section_id).slideToggle(100);
  });

  $(".section_del_bttn").click(function(event) {

  });

  

});
