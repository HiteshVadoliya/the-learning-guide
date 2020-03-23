$(document).ready(function() {
	$('#Description').ckeditor();
	$('#Update').click(function(event) {
      if(requireandmessage('Title','Title') || requireandmessage('Description','Description')){
        return false;
      }
    });
    $(".Image").on("change", function (event) {
        var id = $(this).attr("id");
        filename = event.target.files[0].name;
        file = filename.split(".").pop().toLowerCase();
        $("#Preview"+id).fadeIn("fast").attr('src','');
        if(file == "jpg" || file == "png" || file == "jpeg"){
            var tmppath = URL.createObjectURL(event.target.files[0]);
            $("#Preview"+id).fadeIn("fast").attr('src',tmppath);
            $('#'+id+'-error').html('');
        } else {
          $('#'+id+'-error').html("Please Select Correct File Only.!!!");
          $(this).val("");
        }
    });
});