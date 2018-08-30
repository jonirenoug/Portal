$(document).ready( function () {
	$("#form-register").validate({
		rules: {
			email_address:{
				required: true,
				email: true
			},
			passregister: "required",
			confirm_passregister: {
				equalTo: "#passregister"
			}
		}
	});
	$(".upload-button").on('click', function() {
       $(".file-upload").click();
        var readURL = function(input) {
	        if (input.files && input.files[0]) {
	            var reader = new FileReader();

	            reader.onload = function (e) {
	                $('.profile-pic').attr('src', e.target.result);
	            }
	    
	            reader.readAsDataURL(input.files[0]);
	        }
	    }

	    $(".file-upload").on('change', function(){
	        readURL(this);
	    });
    });
    $(".forgotten-password").validate({
		rules: {
			password: "required",
			password_confirmation: {
				equalTo: "#password"
			}
		}
	});
})