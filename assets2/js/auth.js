$(':input[type="number"]').keypress(function(e) {
	if(!((e.keyCode > 95 && e.keyCode < 106)
	|| (e.keyCode > 47 && e.keyCode < 58) 
	|| e.keyCode == 8)) {
	  return false;
  }
});


// waktu daily 

// Mengatur waktu akhir perhitungan mundur
// var countDownDate = new Date("june 27, 2020 17:41:25").getTime();
var wtk = $('.wtk').val();


// alert(wtk);
var countDownDate = new Date(wtk).getTime();
// var countDownDate = ;

// Memperbarui hitungan mundur setiap 1 detik
var x = setInterval(function() {

  // Untuk mendapatkan tanggal dan waktu hari ini
  var now = new Date().getTime();
    
  // Temukan jarak antara sekarang dan tanggal hitung mundur
  var distance = countDownDate - now;
    
  // Perhitungan waktu untuk hari, jam, menit dan detik
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Keluarkan hasil dalam elemen dengan id = "demo"
  $(".second").html(seconds);
  $(".minute").html(minutes);
  $(".hour").html(hours);



  
  if (wtk == '') {
	$(".second").html(0);
	$(".minute").html(0);
	$(".hour").html(0);
  }

//   document.getElementById("demo").innerHTML =  hours + "h "
//   + minutes + "m " + seconds + "s ";
    
  // Jika hitungan mundur selesai, tulis beberapa teks 
  if (distance < 0) {
    clearInterval(x);
	// document.getElementById("demo").innerHTML = "EXPIRED";
	$(".second").html(0);
	$(".minute").html(0);
	$(".hour").html(0);
	$.ajax({
		url  : almt+"product/daily",
		type : "POST",
		data : {n : 'n',csrf_test_name : $('#ncr').val()},
		dataType : "JSON",
		success: function(data){
			console.log(data);
			csrf_token = data.csrf_token;
			if(data.success)
			{

				$(".second").html(0);
				$(".minute").html(0);
				$(".hour").html(0);

			}                

	  }
	  

	});	


  }
}, 1000);
// tutup waktu dayli

$('#logout').on('click',function(){
	$(':input[type="text"]').val('');
	$(':input[type="password"]').val('');
});
$('#loginmenu').on('click',function(){
	$(':input[type="text"]').val('');
	$(':input[type="password"]').val('');
	$('.modal-backdrop').css("opacity","0 !important");
	
});
$('.registermenu').on('click',function(){
	$(':input[type="text"]').val('');
	$(':input[type="password"]').val('');
});

var csrf_token = ' ';
	var almt = $('#url').val();

		$('.create-account').on('click',function(e){
			e.preventDefault();
			$('.is-invalid').removeClass('is-invalid');

              if (csrf_token === ' ') {

      			  csrf_token = csrf_token = $('#ncr').val();
   			  }
			
				 $('.create-account').css("display","none");
				 $('.spinner-registration').css("display","inline-block");

   			 var tambah = $('<input type="hidden" class="tkn"name="csrf_test_name" >').val(csrf_token);
   			 $('#ncr').val(csrf_token);
   			 $('.tkn').remove();
   			 $('#form-registration').append(tambah);
			$.ajax({
                url  : almt+"auth/registration",
                type : "POST",
                data : $('#form-registration').serialize(),
                dataType : "JSON",
                success: function(data){


                csrf_token = data.csrf_token;

                console.log(data);

				     if(data.error)
				     {
						$('.create-account').css("display","inline-block");
						$('.spinner-registration').css("display","none");

					     if(data.name_error)
					     {
					      
					         $('.register-name').addClass('is-invalid');
					     }
					     else
					     {
					     	 $('.register-name').removeClass('is-invalid');
					     }

					     if(data.email_error)
					     {
					   
					      $('.register-email').addClass('is-invalid');
					       Swal.fire({
							  type:'warning',
							  title: 'Oops...',
							  html: data.email_error,
							  confirmButtonColor: '#DB000E',

							});
					     }
					     else
					     {
					      $('.register-email').removeClass('is-invalid');
					     }	

					     if(data.username_error)
					     {
					      $('.register-username').addClass('is-invalid');
					        Swal.fire({
							  type:'warning',
							  title: 'Oops...',
							  html: data.username_error,
							  confirmButtonColor: '#DB000E',

							});
					     }
					     else
					     {
					      $('.register-username').removeClass('is-invalid');
					     }
				   
					     if(data.password_error)
					     {
					      $('.register-password').addClass('is-invalid');
					        // Swal.fire({
							//   type:'warning',
							//   title: 'Oops...',
							//   html: data.password_error,
							//   confirmButtonColor: '#DB000E',

							// });					      
					     }
					     else
					     {
					      $('.register-password').removeClass('is-invalid');
				         }


		
				    }

				    if(data.success)
				    {
						$('.create-account').css("display","inline-block");
						$('.spinner-registration').css("display","none");
						
				    	$('#name_error').html('');
				    	$('#email_error').html('');
				    	$('#username_create_error').html('');
				    	$('#password_error').html('');

				    	Swal.fire({
						  type:'success',
						  title: 'Success',
						  text: 'your account has been created! please check your email',

						});
						

				    }                

              }

            });


	   
	 });	

	$('.sign-in').on('click',function(e){
			e.preventDefault();

			$('.is-invalid').removeClass('is-invalid');

			$('.sign-in').css("display","none");
			$('.spinner-login').css("display","inline-block");


              if (csrf_token === ' ') {

      			  csrf_token = $('#ncr').val();
   			  }


   			 var tambah = $('<input type="hidden" class="tkn"name="csrf_test_name" >').val(csrf_token);
   			 $('#ncr').val(csrf_token);
   			 $('.tkn').remove();
   			 $('#form').append(tambah);
			$.ajax({
                url  : almt+"auth/login",
                type : "POST",
                data : $('#form').serialize(),
                dataType : "JSON",
                success: function(data){

                csrf_token = data.csrf_token;

                console.log(data);

				     if(data.error)
				     {
						$('.sign-in').css("display","inline-block");
						$('.spinner-login').css("display","none");

					     if(data.username_error)
					     {
					    
					      $('.login-username').addClass('is-invalid');
					     }
					     else
					     {
					     
					      $('.login-username').removeClass('is-invalid');
					     }

				   
					     if(data.password)
					     {
					     
					      $('.login-password').addClass('is-invalid');
					     }
					     else
					     {
					      
					      $('.login-password').removeClass('is-invalid');
				         }

				         if(data.not_registered)
					     {
					      $('.register-password').addClass('is-invalid');
					        Swal.fire({
							  type:'warning',
							  title: 'Oops...',
							  html: data.not_registered,
							  confirmButtonColor: '#DB000E',

							});	
					     }

				         if(data.not_active)
					     {
					      $('.register-password').addClass('is-invalid');
					        Swal.fire({
							  type:'warning',
							  title: 'Oops...',
							  html: data.not_active,
							  confirmButtonColor: '#DB000E',

							});	
					     }
		
				    }
				    if(data.success)
				    {
				    	location.reload();
				    }                

              }

            });


	   
	});






		$('.forgot-password').on('click',function(e){
			e.preventDefault();
			$('.is-invalid').removeClass('is-invalid');
			$('.forgot-password').css("display","none");
			$('.spinner-forgot').css("display","inline-block");


              if (csrf_token === ' ') {

      			  csrf_token = csrf_token = $('#ncr').val();
   			  }

   			 var tambah = $('<input type="hidden" class="tkn"name="csrf_test_name" >').val(csrf_token);
   			 $('#ncr').val(csrf_token);
   			 $('.tkn').remove();
   			 $('#forgot-password').append(tambah);
			$.ajax({
                url  : almt+"auth/forgotpassword",
                type : "POST",
                data : $('#forgot-password').serialize(),
                dataType : "JSON",
                success: function(data){


                csrf_token = data.csrf_token;

                console.log(data);

				     if(data.error)
				     {
						$('.forgot-password').css("display","inline-block");
						$('.spinner-forgot').css("display","none");

					     if(data.email_error)
					     {
					      $('.forgot-email').addClass('is-invalid');

					        Swal.fire({
							  type:'warning',
							  title: 'Oops...',
							  html: data.email_error,
							  confirmButtonColor: '#DB000E',

							});	
					     }
					     else
					     {
					      $('.forgot-email').removeClass('is-invalid');
					     }	
		
				    }

				    if(data.success)
				    {
						$('.forgot-password').css("display","inline-block");
						$('.spinner-forgot').css("display","none");

				      Swal.fire({
						  type:'success',
						  title: 'Success',
						  html: data.success,

						});
						
						

				    }                

              }

            });


	   
	 });

		$('#logout').on('click',function(){
		$('.is-invalid').removeClass('is-invalid');
			$.ajax({
                url  : almt+"auth/logout",
                dataType : "JSON",
                success: function(data){


                console.log(data);

				  if(data.success)
				   {
					location.replace(almt)
				   }                   

              }

            });


	   
	 	 });