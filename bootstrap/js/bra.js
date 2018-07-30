var ManageBrand;

$(document).ready(function(){
	$("#navBrand").addClass('active');

	ManageBrand = $("#ManageBrand").DataTable();
	});
	$("#submitBrandForm").unbind('submit').bind('submit',function(){
		var brandName = $("#brandName").val();
		var natureName = $("#natureName").val();
		var brandStatus = $("brandStatus").val();
		if (brandName == "") {
			$("#brandName").after('<p class="text-danger">Brand Name field is required</p>');
			$("#brandName").closest('.form-group').addClass('has-error');
		}
		else{
			$("#brandName").find('.text-danger').remove();
			$("#brandName").closest('.form-group').addClass('has-success');
		}
		if (natureName == "") {
			$("#natureName").after('<p class="text-danger">Nature Name field is required</p>');
			$("#natureName").closest('.form-group').addClass('has-error');
		}
		else{
			$("#natureName").find('.text-danger').remove();
			$("#natureName").closest('.form-group').addClass('has-success');
		}
		if (brandStatus == "") {
			$("#brandStatus").after('<p class="text-danger">Brand Status field is required</p>');
			$("#brandStatus").closest('.form-group').addClass('has-error');
		}
		else{
			$("#brandStatus").find('.text-danger').remove();
			$("#brandStatus").closest('.form-group').addClass('has-success');
		}
});

