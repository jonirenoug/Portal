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
})