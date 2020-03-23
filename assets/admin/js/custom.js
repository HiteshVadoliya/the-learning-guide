$(document).ready(function() {
	
	$(document).on("click",".rowDelete",function(){
		var id = $(this).attr("data-id");             
        var url = $(this).attr("data-url");             
        var field = $(this).attr("data-i");             
        var table = $(this).attr("data-td");
        var ajaxtable = $(this).hasClass('ajaxTable');
        
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function (isConfirm) {
            
            if (isConfirm) {
                $.ajax({
                    url: url,
                    dataType: "JSON",
                    method:"POST",
                    data: {
                        "id": id,
                        "td": table,
                        "i": field,
                    },
                    success: function ()
                    {
                        if(ajaxtable == true) {
                            let abc = $('.pagination .active a').text();
                            if(abc >= 1) {
                                abc -= 1;
                             }
                            let pagenum = abc * 10;
                            gettour(pagenum);
                        }
                        else {    
                            $('#datatable-scroller').DataTable().ajax.reload();
                        }
                        swal("Deleted!", "Your data has been deleted.", "success");
                    }
                });

            }
        });
               
}); 	
});