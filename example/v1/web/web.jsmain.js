function getSuccess(desc = "สำเร็จ", title = "Success!") {
	swal({
		title: title,
		type: 'success',
		html: desc,
		confirmButtonColor: '#ff5656',
	});
}

function getError(desc = "เกิดข้อผิดพลาด", title = "Error!") {
	swal({
		title: title,
		type: 'error',
		html: desc,
		confirmButtonColor: '#ff5656',
	});
}
function module_edit(){
	$('a[data-toggle="modal"]').click(function() {
        var targetModal = $(this).data('target');
        $(targetModal).modal('show');
    });
}

function fetchHistory() {
	$.ajax({
	   url: 'history_item.php',
	   type: 'POST',
	   success: function(response) {
		  $('#history').html(response);
		  setTimeout(fetchHistory, 1000);
	   },
	   error: function() {
		  alert('An error occurred while processing your request.');
	   }
	});
 }
 function fetchPlayer() {
	$.ajax({
	   url: 'player.php',
	   type: 'POST',
	   success: function(response) {
		  $('#player').html(response);
		  setTimeout(fetchPlayer, 1000);
	   },
	   error: function() {
		  alert('An error occurred while processing your request.');
	   }
	});
 }

$(document).ready(function() {
	

	// Key Enter may be in future add more function
	$("#login-form input").on("keypress", function(e) {
		if (e.keyCode == 13) {
			clickLogin();
		}
	});

	// Sidebar Back To Home Page Muka
	$("#sidebarToggle").on('click', function(e) {
        e.preventDefault();
        location.href = "?page=home";
    });

	// Search Staff
	$("#btn-search-staff").on('click',function(e){
		e.preventDefault();
		searchStaff();
	})

	// Animation Center Image
	$(window).on('beforeunload', function() {
		$(window).scrollTop(0);
	});
	$(this).scrollTop(0);
	let animation = $("#animation");
	let top = 0;
	let isadded = true;
	setInterval(function() {
		if (top >= 20) {
			isadded = false;
		}
		if (top <= 0) {
			isadded = true;
		}
		if (isadded) {
			top += 0.1;
		} else {
			top -= 0.1;
		}
		animation.css("top", top + "px");
	}, 5);

	// Register form submit
	$('#registerForm').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			url: 'v1/action.php',
			type: 'POST',
			data: $(this).serialize(), // ส่งข้อมูลฟอร์ม
			success: function(response) {
				var data = JSON.parse(response);
				if (data.status === 'success') {
					getSuccess(data.desc, data.title);
					if (data.reload === 'true') {
						setTimeout(function() { location.reload(); }, 1500);
					}
				} else {
					getError(data.desc, data.title);
				}
			},
			error: function(xhr, status, error) {
				console.error('Error: ' + status + ' - ' + error);
				console.error('Response Text: ' + xhr.responseText);
				getError('การเชื่อมต่อล้มเหลว', 'Connection Failed');
			}
		});
	});
});

function clickLogout() {
	$.ajax({
		type: "POST",
		url: "v1/action.php",
		data: "action=logout",
		success: function(result_) {
			var result = JSON.parse(result_);
			switch(result.status){
				case "success":
					getSuccess(result.desc, result.title);
					break;
				case "error":
					getError(result.desc, result.title);
					break;
				default:
					getError();
			}
			if(result.reload == "true"){
				setTimeout(function(){ location.reload(); }, 1500);
			}
		},
		error: function(xhr, status, error) {
			console.error('Error: ' + status + ' - ' + error);
			console.error('Response Text: ' + xhr.responseText);
			getError('การเชื่อมต่อล้มเหลว', 'Connection Failed');
		}
	});
}

function pccafe($item) {
	$.ajax({
		type: "POST",
		url: "v1/action.php",
		data: "action=buycafe&cafeid=" + $item,
		success: function(result_) {
			var result = JSON.parse(result_);
			switch(result.status){
				case "success":
					getSuccess(result.desc, result.title);					
					break;
				case "error":
					getError(result.desc, result.title);
					break;
				default:
					getError();
			}
			if(result.reload == "true"){
				setTimeout(function(){ location.reload(); }, 1500);
			}
		}
	});
}

function buyitempoint($item) {
	$.ajax({
		type: "POST",
		url: "v1/action.php",
		data: "action=buyitempoint&itemid=" + $item,
		success: function(result_) {
			var result = JSON.parse(result_);
			switch(result.status){
				case "success":
					getSuccess(result.desc, result.title);
					$("#playerpoint").text(result.point);
					break;
				case "error":
					getError(result.desc, result.title);
					break;
				default:
					getError();
			}
			if(result.reload == "true"){
				setTimeout(function(){ location.reload(); }, 1500);
			}
		}
	});
	
}
function clickLogin() {
	$.ajax({
		type: "POST",
		url: "v1/action.php",
		data: $("#login-form").serialize(),
		success: function(result_) {
			var result = JSON.parse(result_);
			switch(result.status){
				case "success":
					getSuccess(result.desc, result.title);
					break;
				case "error":
					getError(result.desc, result.title);
					break;
				default:
					getError();
			}
			if(result.reload == "true"){
				setTimeout(function(){ location.reload(); }, 1500);
			}
		},
		error: function(xhr, status, error) {
			console.error('Error: ' + status + ' - ' + error);
			console.error('Response Text: ' + xhr.responseText);
			getError('การเชื่อมต่อล้มเหลว', 'Connection Failed');
		}
	});
}

function clickBan() {
	$.ajax({
		type: "POST",
		url: "v1/action.php",
		data: $("#ban-form").serialize(),
		success: function(result_) {
			var result = JSON.parse(result_);
			switch(result.status){
				case "success":
					getSuccess(result.desc, result.title);
					break;
				case "error":
					getError(result.desc, result.title);
					break;
				default:
					getError();
			}
			if(result.reload == "true"){
				setTimeout(function(){ location.reload(); }, 1500);
			}
		},
		error: function(xhr, status, error) {
			console.error('Error: ' + status + ' - ' + error);
			console.error('Response Text: ' + xhr.responseText);
			getError('การเชื่อมต่อล้มเหลว', 'Connection Failed');
		}
	});
}

function clickBanHwid() {
	$.ajax({
		type: "POST",
		url: "v1/action.php",
		data: $("#banhwid-form").serialize(),
		success: function(result_) {
			var result = JSON.parse(result_);
			switch(result.status){
				case "success":
					getSuccess(result.desc, result.title);
					break;
				case "error":
					getError(result.desc, result.title);
					break;
				default:
					getError();
			}
			if(result.reload == "true"){
				setTimeout(function(){ location.reload(); }, 1500);
			}
		},
		error: function(xhr, status, error) {
			console.error('Error: ' + status + ' - ' + error);
			console.error('Response Text: ' + xhr.responseText);
			getError('การเชื่อมต่อล้มเหลว', 'Connection Failed');
		}
	});
}

function clickRegister() {
	$.ajax({
		type: "POST",
		url: "v1/action.php",
		data: $("#register-form").serialize(),
		success: function(result_) {
			var result = JSON.parse(result_);
			switch(result.status){
				case "success":
					getSuccess(result.desc, result.title);
					break;
				case "error":
					getError(result.desc, result.title);
					break;
				default:
					getError();
			}
			if(result.reload == "true"){
				setTimeout(function(){ location.replace('index.php?page=home'); }, 1500);
			}
		},
		error: function(xhr, status, error) {
			console.error('Error: ' + status + ' - ' + error);
			console.error('Response Text: ' + xhr.responseText);
			getError('การเชื่อมต่อล้มเหลว', 'Connection Failed');
		}
	});
}
function searchStaff() {
	
    var staff_id = $("#subject_staff").val();
    if (staff_id == "0") {
        getError("กรุณาเลือกพนักงานก่อนดำเนินการ", "Error");
        return false;
    }
    $.ajax({
        type: "POST",
        url: "v1/action.php",
        data: {
            action: 'subject_staff',
            subject_staff: staff_id
        },
        success: function(result_) {
            var result = JSON.parse(result_);
            if (result.status == "success") {
                $("#staff-details").html(result.html);
                getSuccess(result.desc, result.title);
            } else {
                getError(result.desc, result.title);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error: ' + status + ' - ' + error);
            console.error('Response Text: ' + xhr.responseText);
            getError('การเชื่อมต่อล้มเหลว', 'Connection Failed');
        }
    });
    return false;
}

function clickPassword() {
	$.ajax({
		type: "POST",
		url: "v1/action.php",
		data: $("#password-form").serialize(),
		success: function(result_) {
			var result = JSON.parse(result_);
			switch(result.status){
				case "success":
					getSuccess(result.desc, result.title);
					break;
				case "error":
					getError(result.desc, result.title);
					break;
				default:
					getError();
			}
			if(result.reload == "true"){
				setTimeout(function(){ location.replace('index.php?page=home'); }, 1500);
			}
		},
		error: function(xhr, status, error) {
			console.error('Error: ' + status + ' - ' + error);
			console.error('Response Text: ' + xhr.responseText);
			getError('การเชื่อมต่อล้มเหลว', 'Connection Failed');
		}
	});
}
function Modal_Alert(message, type = "default") {
	$('#alert_box').modal('show');
	let class_name;
	switch (type) {
		case "error":
			class_name = "alert-danger";
			break;
		case "warning":
			class_name = "alert-warning";
			break;
		case "success":
			class_name = "alert-success";
			break;
		default:
			class_name = "alert-primary";
	}
	$('#alert_box #text_message').html('<div id="alert" class="alert ' + class_name + ' alert-dismissible fade show" role="alert" align="left">' +
		message + '</div>');
}

function changestatus(st,no){       
        if(st == 1){
            $('#regis_status'+no).html('ดำเนินการเรียบร้อย');
            $('#comment_status_'+no).val(st);
            $('#btn'+no).removeClass("btn-primary");  
            $('#btn'+no).addClass("btn-success");      
           

        }else if(st == 0){
            $('#regis_status'+no).html('รอดำเนินการ');
            $('#comment_status_'+no).val(st);
            $('#btn'+no).addClass("btn-primary");  
            $('#btn'+no).removeClass("btn-success"); 
        }
}

function saveComment(stu_no){
	var comment = $('#comment'+stu_no).val();
	$.ajax({
		type:"POST",
		url:"v1/action.php",
		data:$("#form_comment"+stu_no).serialize(),//only input
		success: function(response){
			$('#comment_zone'+stu_no).html(comment);
			$('#commentmodal'+stu_no).modal('toggle');
		}
	});

}