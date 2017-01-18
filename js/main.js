var app = angular.module("fragmag",[]);

app.controller('formUploader',function($scope){
	$scope.reset = function(){
		$scope.fname="";
		$scope.email="";

	}
})

$(document).ready(function(){
	$("#fragmagForm").ajaxForm({
		beforeSend:function(){
			$(".progress").show();
		},
		uploadProgress:function(event,position,total,percentComplete){
			$(".progress-bar").width(percentComplete+'%');
			$(".sr-only").html(percentComplete+'%');
		},
		success:function(){

			$(".progress").hide();
		},
		complete:function(response){
			if (response.responseText == '1' ){
					console.log("Uploaded");
					$("#status").html('<div class="alert alert-warning alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Congrajulation!</strong>Your article is submited .</div>');
			}else{
				$("#status").html('<div class="alert alert-warning alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>'+response.responseText+' .</div>');
			;

			}
		}

	});
	$(".progress").hide();
});