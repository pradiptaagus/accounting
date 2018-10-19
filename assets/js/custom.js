var url = "http://127.0.0.1/accounting/controller/";

// validasi input
function isEmpty(id, error, prefix){
	if ($('#'+id+'').val() === "") {
		$('#'+error+'').html('<i class="fa fa-times"></i> '+prefix+' harus diisi')
	}else if($('#'+id+'').val() !== ""){
		$('#'+error+'').html("");
	}
}


function displayTime(){
	var time = "";
	var currentTime = new Date();
	var year = currentTime.getFullYear();
	var month = currentTime.getMonth()+1;
	var day = currentTime.getDate();
	var hour = currentTime.getHours();
	var minute = currentTime.getMinutes();
	var second = currentTime.getSeconds();

	if (month < 10) {
		month = "0" + month
	}

	if (day < 10) {
		day = "0" + day
	}

	if (hour < 10) {
		hour = "0" + hour
	}

	if (minute < 10) {
		minute = "0" + minute
	}

	if (second < 10) {
		second = "0" + second
	}

	time += year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;

	return time;
}

// toastr
toastr.options = {
  	"closeButton": false,
  	"debug": false,
  	"newestOnTop": false,
  	"progressBar": false,
  	"positionClass": "toast-bottom-right",
  	"preventDuplicates": false,
  	"onclick": null,
  	"showDuration": "100",
  	"hideDuration": "100",
  	"timeOut": "3000",
  	"extendedTimeOut": "1000",
  	"showEasing": "linear",
  	"hideEasing": "linear",
  	"showMethod": "fadeIn",
  	"hideMethod": "fadeOut"
}