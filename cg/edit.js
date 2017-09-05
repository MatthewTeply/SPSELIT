$(document).ready(function() {

  var editMode = false;

  $(".content_edit_button").click(function($button) {

    var content_edit_id = $(this).val();

    $.ajax({

      type: 'POST',
      data: {content_edit_id},
      url: 'content.inc.php',
      success: function(response) {

        var res = response.split('<cg_break>');

        var edit_title = res[0];
        var edit_content = res[1];
        var edit_file = res[2];
        var edit_class = res[3];
        var edit_title_heading = res[4];

        $("#section_class").val(edit_class);
        $("#section_title").val(edit_title);
        $("#section_file").val(edit_file);
        $("#section_content").val(edit_content);
        $("#editor").html(edit_content);

        var headings = ["h1", "h2", "h3", "h4", "h5", "h6"];

        $("#section_title_heading").html("<option value='" + edit_title_heading + "' selected>" + edit_title_heading + "</option>");

        for(var h = 0; h < headings.length; h++) {

          if (edit_title_heading == headings[h]) {

            continue;
          }

          $("#section_title_heading").append("<option value='" + headings[h] + "'>" + headings[h] + "</option>");
        }

        var res_edit_file = edit_file.split("/");

        $("#section_edit_upload_p").html(res_edit_file[1]);
        $("#section_edit_upload_p").css("color", "green");

        var section_title = $("#section_title").val();
        var section_content = $("#section_content").val();
        var section_class = $("#section_class").val();

        $(".content_edit_id").val(content_edit_id);
        $(".content_edit_title").val(section_title);
        $(".content_edit_content").val(section_content);
        $(".content_edit_class").val(section_class);

        $(".content_edit_file").val(edit_file);

        $(".content_submit_form").hide();
        $(".content_edit_form").show();
        $("#custom-file-input").hide();
      }
    });

  });

  $("#section_title").keyup(function() {

    var section_title = $("#section_title").val();
    $(".content_edit_title").val(section_title);
  });

  $("#section_class").keyup(function() {

    var section_class = $("#section_class").val();
    $(".content_edit_class").val(section_class);
  });

  $("#section_title_heading").change(function() {

    var section_title_heading = $("#section_title_heading").val();
    $(".content_edit_title_heading").val(section_title_heading);
  });

  $("#section_upload").change(function() {

    var res_file = $("#section_upload").val().split("\\");

    $("#section_upload_p").html(res_file[2]);
    $("#section_upload_p").css("color", "green");
  });

  $("#section_edit_upload").change(function() {

    var res_file = $("#section_edit_upload").val().split("\\");

    $("#section_edit_upload_p").html(res_file[2]);
    $("#section_edit_upload_p").css("color", "green");
  });

  $("#content_edit_subm").click(function(e) {

    $(".content_edit_content").val($("#editor").html());
  });

});
