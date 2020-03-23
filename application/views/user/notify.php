<?php //if(!empty($this->session->USER['UId'])){ ?>
	<style type="text/css">
		.close-custom {
		    float: right;
		    font-size: 20px;
		    font-weight: bold;
		    line-height: 1;
		    color: #fff;
		    background: #ff0000 !important;
		    width: 20px;
		    opacity: 1 !important;
		    border-radius: 50%;
		}
		.custom-notify{
			background: #fff;

		}
		.custom-notify .title{
			color: #000;
			font-size: 23px;
		}
		.custom-notify .msg{
			color: #7b7b7b;
			font-size: 18px;
		}
	</style>
<link href="<?php echo FRONTENDPATH ?>css/animate.min.css" rel="stylesheet">
<script src="<?php echo FRONTENDPATH ?>js/bootstrap-notify.min.js"></script>
<script type="text/javascript">


    function checkForNotify (){
    	$.ajax({
            type: 'POST',
            url: '<?php echo base_url('Home/get_notify'); ?>',
            global: false,
            success: function(response) {
                response = jQuery.parseJSON(response);
                var data = response.notify;
                $.each(data,function(key,value){
                	
                	//update_notification(value['id']);
                	
                	if(value["type"] == 'Blog'){
                		var v_title = 'New blog post!'
                	}
                	if(value["type"] == 'School'){
                		var v_title = 'New school profile!'
                	}
                	if(value["type"] == 'Teacher'){
                		var v_title = 'New teacher profile!'
                	}
                	$.notify({
                         title: v_title+'<br>',
                         message: value["title"]+'<br><small class="text-warning">Click here to read more</small>',
                         url: value["link"]
                    },{
                        placement: {
                        from: "bottom",
                        align: "right"
                     },
                     	icon_type: 'class',
						template: '<div data-notify="container" class="custom-notify text-left col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
							'<button type="button" aria-hidden="true" class="close close-custom" data-notify="dismiss">×</button>' +
							'<span data-notify="icon"></span> ' +
							'<span data-notify="title" class="title">{1}</span> ' +
							'<span data-notify="message" class="msg">{2}</span>' +
							'<div class="progress" data-notify="progressbar">' +
								'<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
							'</div>' +
							'<a href="{3}" target="{4}" data-notify="url"></a>' +
						'</div>' 


                    });

                });
            }
        });
    }

    check = setInterval(checkForNotify, 6000);

   	function update_notification(id) {
   			$.ajax({
   		        type: 'POST',
   		        url: '<?php echo base_url('Home/update_notify'); ?>',
   		        data : { id: id },
   		        global: false,
   		        success: function(response) {

   		        }
   		    });
   	}
</script>
<?php //} ?>