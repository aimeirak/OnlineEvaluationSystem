var ManageBrand;

$(document).ready(function(){
	$("#navBrand").addClass('active');

	ManageBrand = $("#ManageBrand").DataTable();
	});
	$("#submitBrandForm").unbind('submit').bind('submit',function(){
		$(".text-danger").remove();
		$(".form-group").removeClass('has-error').removeClass('has-success');
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
		if (brandName && natureName && brandStatus) {
			var form = $(this);
			$("#createBrandbtn").button('loading');
			$.ajax{{
				url:form.attr('action'),
				type:form.attr('method'),
				data:form.serialize(),
				datatype:'json',
				success:function(response){
					$("#createBrandbtn").button('reset');
					if (response.success == true) {
						ManageBrand.ajax.reload(null,false);
						$("#submitBrandForm")[0].reset();
						$(".text-danger").remove();
						$(".form-group").removeClass('has-error').removeClass('has-success');
						$("#add-brand-messages").html('<div class="alert alert-success">'+'<button type="button" class="close" data-dismiss="alert" arial-label="close"><span arial-hidden="true">&times;</spaan>''<strong><i class="glyphicon glyphicon-ok-sign"></i></strong>'+ response.messages + '</div>');
						$(".alert-success").delay(500).show(10,function(){
							$(this).delay(3000).hide(10,function(){
								$(this).remove();
							});
						});
					}
				}
			}};
		}
		return false;
	});
});

