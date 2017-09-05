$(document).ready(function() {

  var get_content_no = true;

  var arr = [];

  $(document).ajaxStart(function () {

    $(".loading_div").show();
  });

  $(document).ajaxStop(function () {

    $(".loading_div").hide();
  });

  $.ajax({

    type: 'POST',
    data: {get_content_no},
    url: 'cg/content.inc.php',
    success: function(response) {

      var noItems = response;

      $.ajax({

        type: 'POST',
        url: 'cg/content.inc_new.php',
        success: function(response) {

          var line = response.split('<new_line>');

          for (var i = 0; i < noItems; i++) {

            var res = line[i].split("<cg_break>");

            var title = res[0];
            var date = res[1];
            var content = res[2];
            var file = res[3];
            var class_name = res[4];
            var title_heading = res[5];
            var id = res[6];

            $("." + class_name).append("<article class='" + class_name  + "_div_" + i + "'>");

            if (title == "NULL" && content != "NULL")
              $("." + class_name  + "_div_" + i).append("<p class='cg_content'>" + content + "</p>");

            else if (content == "NULL" && title != "NULL")
              $("." + class_name  + "_div_" + i).append("<" + title_heading + " class='cg_title'>" + title + "</" + title_heading + ">");

            else if (content != "NULL" && title != "NULL")
              $("." + class_name + "_div_" + i).append("<" + title_heading + " class='cg_title'>" + title + "</" + title_heading + ">" + "<p class='cg_content'>" + content + "</p>");

            else
              console.log("No title, no content");

            if (file != 'NULL') {

              $("." + class_name  + "_div_" + i).append("<img src=cg/" + file +" class='cg_file'>");
              $("#" + file + "_a").hide();
            }

            if (date != 'NULL')
              $("." + class_name + "_div_" + i).append("<i class='cg_date'>" + date  + "</i>");

            $("." + class_name).append("</article>");
            
          }

        }
      });
    }
  });

});
