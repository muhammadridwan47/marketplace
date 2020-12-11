
  <?php $this->load->view('templates/header_pages') ?>

	
<form  method="POST" id="upload" enctype="multipart/form-data">
<input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
<input type="hidden" name="jx" class="jx" value="<?= preg_replace('/[^A-Za-z0-9\  ]/', '',strtoupper(base64_encode(random_bytes(16)))); ?>">
 <section class="bg-white" >
   <div class="container">
     <div class="row">
       <div class="col-11">
         <div class="row justify-content-between">
         <div class="col-12 mt-5 mb-5">
                  <button class="btn  float-right text-white rounded-0 go-live" disabled style="background:#77C874;width:161.58px">Go Live</button>
            </div>

         </div>
       </div>
     </div>
   </div>
 </section>

  <div class="mt-4 mb-4" style="z-index: 9999 !important">
    
    <div class="container ">
      <div class="row justify-content-end">
        <div class="col-md-11">

            <div class="row">
              <div class="col-lg-8 bg-">
			          <div class="product-name">
			            <div class="row  mt-4 mb-1 justify-content-between">
			            	 
				              <div class="col-md-6 rounded-0">

                        <input class="form-control productName rounded-0" type="text" placeholder="Product Name" name="namaproduk" required style="border: 0.55px solid #F39B9D">

                      </div>
                      <div class="col-md-4 text-left">
                        <!-- <label for="tagline" class="col-sm-1 col-form-label">PRICE</label> -->

                        <!-- <input class="form-control text-right"  type="number" placeholder="$." name="price" required style="border: 0.55px solid #F39B9D"> -->
                        
                         <div class="form-group row  justify-content-end">
                            <label for="tagline" class="col-lg-3 col-form-label">PRICE</label>
                            <div class="col-lg-6">
                              
                              <input class="form-control label-price text-right rounded-0"  type="number" placeholder="000" name="price"  required style="border: 0.55px solid #F39B9D" >
                              <span class="mt-1 ml-2" style="position:absolute;top:0;font-size:20px">$.</span>
                            </div>
                          </div>



                       </div>
				        
                 </div>
                 
                 <div class="row mt-2 mb-3">
                   <div class="col">
                     <!-- <span>By <?= $user['name'] ?> in:</span>               -->
                           <select class="custom-select d-inline col-sm-2 select jenis rounded-0" name="jenis" required style="border: 0.55px solid #F39B9D">
                              <option selected disabled value="">Category</option>
                              <option value="Font">Font</option>
                              <option value="Graphic">Graphic</option>
                              <option  value="Photo">Photo</option>
                            </select>

                           <select class="custom-select d-inline col-sm-3 sub rounded-0" name="kategori" disabled  required style="border: 0.55px solid #F39B9D">
                              <option selected disabled value="null">Sub Categories</option>
                             
                            </select>

                    </div>
                 </div>


                 
				        </div>

                  <div class="image-produk">
                    <img src="<?= base_url('assets2/') ?>img/produk/new-image-upload.svg" class="img-fluid image1" id="image-product">
                  </div>
                  <div class="owl-carousel owl-theme image-small mt-sm-2 upload" >
                    <div class="item" data-item="1" >
                    <button  type="button"  class="close close-1 btn close-image text-danger" style="position:absolute;right:0;display:none" data-item="1">&times;</button>
                      <input type="file" class="gambar1"  name="gambar1">
                    
                      <img src="<?= base_url('assets2/') ?>img/produk/new-thumbnail-upload.svg" class="img-fluid imagethumbnail1" data-thumbnail="" >
                    </div>
                    <div class="item" data-item="2">
                    <button  type="button"  class="close close-2 btn close-image text-danger" style="position:absolute;right:0;display:none" data-item="2">&times;</button>
                     <input type="file"  name="gambar2" class="gambar2">
                      <img src="<?= base_url('assets2/') ?>img/produk/new-thumbnail-upload.svg" class="img-fluid imagethumbnail2" data-thumbnail="" >
                    </div>
                    <div class="item" data-item="3">
                    <button  type="button"  class="close close-3 btn close-image text-danger" style="position:absolute;right:0;display:none" data-item="3">&times;</button>
                     <input type="file"  name="gambar3" class="gambar3">
                      <img src="<?= base_url('assets2/') ?>img/produk/new-thumbnail-upload.svg" class="img-fluid imagethumbnail3" data-thumbnail="" >
                    </div>
                    <div class="item" data-item="4" class="gambar4">
                    <button  type="button"  class="close close-4 btn close-image text-danger" style="position:absolute;right:0;display:none" data-item="4">&times;</button>
                     <input type="file"  name="gambar4" class="gambar4">
                      <img src="<?= base_url('assets2/') ?>img/produk/new-thumbnail-upload.svg" class="img-fluid imagethumbnail4" data-thumbnail="" >
                    </div>
                    <div class="item" data-item="5" >
                    <button  type="button"  class="close close-5 btn close-image text-danger" style="position:absolute;right:0;display:none" data-item="5">&times;</button>
                     <input type="file"  name="gambar5" class="gambar5">
                      <img src="<?= base_url('assets2/') ?>img/produk/new-thumbnail-upload.svg" class="img-fluid imagethumbnail5" data-thumbnail="" >
                    </div>
                  </div>
              </div>

              <div class="col-lg-3 payment-upload d-none d-sm-block"  id="2">


              </div>

            </div>


        </div>
      </div>
    </div>
    

  </div>


  <nav class="navbar note-file-upload" >
   
      <div class="container justify-content-center">
            
              <div class="col-8 col-sm-7 ">
                <p class="text-white " >Files Included: <span class="format-file text-uppercase"></span></p>
              </div>

              <div class="col-4 col-sm-3 preview-font-upload" style="opacity: 0;">
                  <img src="<?= base_url('assets2/') ?>img/logo/pt.svg" class="float-right" >
                  <input type="text" class="float-right text-right"  placeholder="24 " readonly style="cursor:pointer"> 
              </div>
      </div>

     
          <div class="col-8 col-sm-7 d-sm-none" >
            <p class="text-white" >Files Included: <span class="format-file text-uppercase"></span></p>
          </div>

          <div class="col-4 col-sm-3 preview-font-upload d-sm-none" style="opacity: 0;">
              <img src="<?= base_url('assets2/') ?>img/logo/pt.svg" class="float-right" >
              <input type="text" class="float-right text-right"  placeholder="24 " readonly style="cursor:pointer"> 
          </div>
  </nav>


 



  <section class="" style="background-color: #EFEFEF;" >
  
  <div class="container mt-4 mb-4 render-font" style="display: none;">
      <div class="row justify-content-end">
        <div class="col-sm-11 ">

        <div class="row">
          <div class="col-sm-8">
              <input type="text" id="tulis" class="rounded-2"  placeholder=" TYPE TO TRY" style="width: 100%;height: 33.42px;border: 0.22px solid #F39B9D;" autocomplete="off">
              <input type="hidden" name="code" id="code">
            <div class="font-example mt-3 font" style="overflow-x: hidden;" >
             
            </div>
            
            
          </div>
        </div>
       
        </div>
      </div>
    </div>



    <div class="container ">
      <div class="row justify-content-end">
        <div class="col-sm-11 ">

          <p class="mt-3 mb-1" style="font-size: 16px !important;color: #161514;">Descriptions:</p>
          <div class="row">
            <div class="col-sm-10">


              <textarea class="form-control deskripsi rounded-0" placeholder="Type your product description here"  rows="5" name="deskripsi" required style="border: 0.55px solid #F39B9D;font-size:15px !important" ></textarea>

              <div class="form-group row mt-2">
                <label for="tagline" class="col-sm-2 col-md-1 col-form-label">Tagline</label>
                <div class="col-sm-6">
                  
                  <input type="text" class="form-control form-control-md tagline rounded-0" name="tagline" placeholder="Type and enter"  required style="border: 0.55px solid #F39B9D;font-size:15px !important" id="tagline">
                </div>
 
              </div>
          </div>

       
        </div>

        
      </div>




    </div>

      
    
  </section>




  <!-- <div class="container ">


  <section class="payment-mobile-upload d-block d-sm-none  mb-5 " id="1">

    <div class=" payment-upload " >
      <div class="row justify-content-center web-upload-payment-mobile " >

      </div>




    </div>

  </section>


</div> -->

</form>








	<?php $this->load->view('templates/footer_pages') ?>

	<script src="<?= base_url('assets2/')?>js/jquery-3.5.1.min.js"></script>
	<script src="<?= base_url('assets2/')?>js/auth.js"></script>
  <script src="<?= base_url('assets2/')?>js/owl.carousel.min.js"></script>
  <script>





    $(document).ready(function() {
      $('body').css('background','#EFEFEF');
      var owl = $('.owl-carousel');
      owl.owlCarousel({
        // nav: false,
        // loop: false,
        responsive: {
          0: {
            items: 5,
            margin: 5
          },
          600: {
            items: 5,
            margin: 8
          },
          1000: {
            items: 5,
            margin: 8
          }
        }
      })
    });


$('.select').on('change',function(){

        $('.web-upload-payment').remove();
        // $('.upload-premium').remove();
        // $('.upload-font-mobile').remove();
        // $('.upload-premium-mobile').remove();
  
    
        if ($('.select').val() == 'Font') {

          $('.sub').removeAttr('disabled');
          $('.sub-font').remove();
          $('.preview-font-upload').css('opacity','1');
          var arrFont = ['Display','Sans Serif','Serif','Script'];
          $.each(arrFont,function(index,obj)
          {
              var sub = `<option class="sub-font" value="${obj}">${obj}</option>`;
                $('.sub').append(sub);
          });


          let upload = `<div class="row justify-content-center web-upload-payment " >
                    <p class="col-9 text-center">Upload Only File for Sale 256 MB Max Zip File</p>
                    <div class="free-version col-12 position-relative">
                       <button type="button" class="btn col-12 text-white  btn-free" >
                         FREE VERSION FILE
                       <input type="file" required name="file" id="file" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0" class="mt-1">

                        </button>
                        <button class="btn text-white free-progress" type="button" style="background-color: #77C874;display:none" >
                          0%
                          <button  type="button"  class="btn close-free close-product close text-danger" data-product="free" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;display:none;">&times;</button>
                        </button>

                    </div>
                    
                    <div class="desktop-version mt-3 col-12">
                       <button type="button" class="btn col-12  text-white btn-desktop">
                         DESKTOP FILE
                         <input type="file" required id="desktop" name="desktop" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0;" class="mt-1">
                         
                       </button>
                       <button class="btn text-white desktop-progress" type="button" style="background-color: #77C874;display:none" >
                          0%
                       <button  type="button"  class="btn close-desktop close-product close text-danger" data-product="desktop" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;display:none;">&times;</button>

                       </button>
                    </div>
                    <div class="app-version mt-3 col-12">
                       <button type="button" class="btn btn-app  col-12 text-white" >
                         APP FILE
                         <input type="file" required id="app" name="app" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0;" class="mt-1">
                       </button>
                       <button class="btn text-white app-progress" type="button" style="background-color: #77C874;display:none" >
                          0%
                          <button  type="button"  class="btn close-app close-product close text-danger" data-product="app" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;display:none;">&times;</button>
                       </button>
                    </div>
                    <div class="web-version mt-3  mb-4 col-12">
                       <button type="button" class="btn btn-web  col-12 text-white" >
                         WEB FILE
                         <input type="file" required id="web" name="web" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0;" class="mt-1">
                       </button>
                       <button class="btn text-white web-progress" type="button" style="background-color: #77C874;display:none" >
                          0%
                          <button  type="button"  class="btn close-web close-product close text-danger" data-product="web" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;display:none;">&times;</button>
                       </button>
                    </div>

          

                </div>`;




          $('.payment-upload').append(upload);
          
        }else{
          $('.preview-font-upload').css('opacity','0');
          $(".render-font").css('display','none');
          // $(".font-example img").remove();

          let upload = `<div class="row justify-content-center web-upload-payment " >
                    <p class="col-9 text-center">Upload Only File for Sale 256 MB Max Zip File</p>
                    <div class="free-version col-12 position-relative">
                       <button type="button" class="btn col-12 text-white  btn-free" >
                         FREE VERSION FILE
                       <input type="file" required name="file" id="file" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0" class="mt-1">

                        </button>
                        <button class="btn text-white free-progress" type="button" style="background-color: #77C874;display:none" >
                          0%
                          <button  type="button"  class="btn close-free close-product close text-danger" data-product="free" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;display:none;">&times;</button>
                        </button>

                    </div>
                    <div class="premium-version mt-3 col-12">
                       <button type="button" class="btn col-12  text-white btn-premium">
                         PREMIUM FILE
                         <input type="file" required id="premium" name="premium" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0;" class="mt-1">
                       </button>
                       <button class="btn text-white premium-progress" type="button" style="background-color: #77C874;display:none" >
                          0%
                          <button  type="button"  class="btn close-premium close-product close text-danger" data-product="premium" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;display:none;">&times;</button>
                       </button>
                    </div>
                    


                </div>`;

          $('.payment-upload').append(upload);
        }

        if ($('.select').val() == 'Graphic') {

          $('.sub').removeAttr('disabled');
          $('.sub-font').remove();
          var arrFont = ['Icons','Illustrations','Web Elements','Objects','Patterns','Textures'];
          $.each(arrFont,function(index,obj)
          {
              var sub = `<option class="sub-font" value="${obj}">${obj}</option>`;
                $('.sub').append(sub);
          });
          
        }
        if ($('.select').val() == 'Photo') {

          $('.sub').removeAttr('disabled');
          $('.sub-font').remove();
          var arrFont = ['Abstract','Animals','Architecture','Arts & Entertainment','Beauty & Fashion','Business','Education','Food & Drink','Health','Holidays','Industrial','Nature','People','Sports','Technology','Transportation'];
          $.each(arrFont,function(index,obj)
          {
              var sub = `<option class="sub-font" value="${obj}">${obj}</option>`;
                $('.sub').append(sub);
          });
          
        }

});

  $(".payment-upload").on('change','input[name=file]', function(){
        // var form =   $('form');
        // var form_data = new FormData(form[0]);
        var form_data = new FormData();
        form_data.append("file", $('input[name=file]')[0].files[0]);
        form_data.append("np",$('.productName').val());
        form_data.append("jx",$('.jx').val());
        form_data.append("jenis",$('.jenis').val());
        form_data.append("kategori",$('.sub').val());
        form_data.append("deskripsi",$('.deskripsi').val());
        form_data.append("tagline",$('.tagline').val());
        form_data.append("price",$('.label-price').val());
        form_data.append($('#token').attr('name'),$('#token').val());

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".btn-free").css('display','none');
                        $(".free-progress").css('display','block');
                        $(".free-progress").css('width',Math.ceil(percentComplete) + '%');
                        $(".free-progress").html(Math.ceil(percentComplete)+'%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: '<?= base_url('upload/uploadProduct') ?>',
            data: form_data,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
            },
            success: function(e){
                console.log(e);

                $('#token').val(e.csrf_token);


	

                if(e.error){
                  Swal.fire({
                    type:'warning',
                    title: 'Oops...',
                    html: e.errors,
                    confirmButtonColor: '#DB000E',
                  });
                  
                  $(".free-progress").css('width','auto');
                  $(".free-progress").html('0%');
                  $(".free-progress").css('display','none');
                  $(".btn-free").css('display','block');
                  $('#file').val('');

                }
                if(e.success){
                  // $(".productName").attr('disabled','disabled');
                  // $(".label-price").attr('disabled','disabled');
                  // $(".custom-select").attr('disabled','disabled');
                  // $(".deskripsi").attr('disabled','disabled');
                  // $(".tagline").attr('disabled','disabled');
                  $(".btn-free").css('display','none');
                  // $(".btn-desktop").removeAttr('disabled');
                  // $(".btn-desktop input").css('display','inline');
                  // $(".btn-premium").removeAttr('disabled');
                  // $(".btn-premium input").css('display','inline');
                  $('.go-live').removeAttr('disabled');
                  $(".free-progress").css('width','100%');
                  $(".free-progress").html('Successfully');
                  $(".close-free").css('display','inline');
                  $(".format-file").html(e.format_file);
                }

            }
        });
    });

  $(".payment-upload").on('change','input[name=desktop]', function(){
        // var form =   $('form');
        var form_data = new FormData();
        form_data.append("desktop", $('input[name=desktop]')[0].files[0]);
        form_data.append("np",$('.productName').val());
        form_data.append("jx",$('.jx').val());
        form_data.append("jenis",$('.jenis').val());
        form_data.append("kategori",$('.sub').val());
        form_data.append("deskripsi",$('.deskripsi').val());
        form_data.append("tagline",$('.tagline').val());
        form_data.append("price",$('.label-price').val());
        form_data.append($('#token').attr('name'),$('#token').val());

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".btn-desktop").css('display','none');
                        $(".desktop-progress").css('display','block');
                        $(".desktop-progress").css('width',Math.ceil(percentComplete) + '%');
                        $(".desktop-progress").html(Math.ceil(percentComplete)+'%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: '<?= base_url('upload/uploadProduct') ?>',
            data: form_data,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
            },
            success: function(e){
                console.log(e);

                $('#token').val(e.csrf_token);


	

                if(e.error){
                  Swal.fire({
                    type:'warning',
                    title: 'Oops...',
                    html: e.errors,
                    confirmButtonColor: '#DB000E',
                  });
                  
                  $(".desktop-progress").css('width','auto');
                  $(".desktop-progress").html('0%');
                  $(".desktop-progress").css('display','none');
                  $(".btn-desktop").css('display','block');
                  $('#desktop').val('');

                }
                if(e.success){

                  $('#code').val(e.code);

                  var nilai = $('#tulis').val();
                  $.ajax({
                      url: '<?=base_url('product/render/') ?>'+e.code+'?s='+nilai,
                      
                      method: 'GET',
                      success : function(data){
                      // if (data.success) {
                      var dir = "<?= base_url('renderingfont/').$this->session->userdata('render').'/' ?>";
                      var fileextension = ".png";
                      $.ajax({
                        //This will retrieve the contents of the folder if the folder is configured as 'browsable'
                        url: dir,
                        success: function (data) {
                          //List all .png file names in the page
                    

                          $('.link').remove();
                          $('.link1').remove();
                          $(data).find("a:contains(" + fileextension + ")").each(function () {
                            var filename = this.href.replace(window.location, "renderingfont/").replace("<?= base_url('') ?>", "<?= base_url('renderingfont/').$this->session->userdata('render').'/' ?>");
                            $(".font").append("<img class='link mt-2' src='"+filename+"'><hr style='margin: 2px;' class='link1'>");
                          });
                        }
                      });			    					
                      // }
                      }
                  });

                  $(".render-font").css('display','block');
                  // $(".btn-free").css('display','none');
                  // $(".btn-app").removeAttr('disabled');
                  // $(".btn-app input").css('display','inline');
                  // $(".btn-web").removeAttr('disabled');
                  // $(".btn-web input").css('display','inline');s
                  $('.go-live').removeAttr('disabled');
                  $(".desktop-progress").css('width','100%');
                  $(".desktop-progress").html('Successfully');
                  $(".close-desktop").css('display','inline');
                  $(".format-file").html(e.format_file);
                }

            }
        });
    });


    $(".item img").click(function() {
      let thumbnail = $(this).attr('data-thumbnail');
      if(thumbnail != ""){
        $("#image-product").attr("src",thumbnail);
      }
    });

    $('#tulis').on('keyup',function(){

      var nilai = $('#tulis').val();
      // let size = $('.size').val();
      let size = '24';
      // let id = 24;


        $.ajax({
            url: '<?=base_url('product/render/')?>'+$('#code').val()+'/'+$.trim(size)+'?s='+nilai,
            // data,
            method: 'GET',
            dataType:'json',
            success : function(data){
            if (data.success) {
            var dir = "<?= base_url('renderingfont/').$this->session->userdata('render').'/' ?>";
            var fileextension = ".png";
            $.ajax({
              //This will retrieve the contents of the folder if the folder is configured as 'browsable'
              url: dir,
              success: function (data) {
                //List all .png file names in the page
          

                $('.link').remove();
                $('.link1').remove();
                $(data).find("a:contains(" + fileextension + ")").each(function () {
                  var filename = this.href.replace(window.location, "renderingfont/").replace("<?= base_url('') ?>", "<?= base_url('renderingfont/').$this->session->userdata('render').'/' ?>");
                  $(".font").append("<img class='link mt-2' src='"+filename+"'><hr style='margin: 2px;' class='link1'>");
                });
              }
            });			    					
            }
            }
        });
      });

  $(".payment-upload").on('change','input[name=app]',function(){
    var form_data = new FormData();
        form_data.append("app", $('input[name=app]')[0].files[0]);
        form_data.append("np",$('.productName').val());
        form_data.append("jx",$('.jx').val());
        form_data.append("jenis",$('.jenis').val());
        form_data.append("kategori",$('.sub').val());
        form_data.append("deskripsi",$('.deskripsi').val());
        form_data.append("tagline",$('.tagline').val());
        form_data.append("price",$('.label-price').val());
        form_data.append($('#token').attr('name'),$('#token').val());

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".btn-app").css('display','none');
                        $(".app-progress").css('display','block');
                        $(".app-progress").css('width',Math.ceil(percentComplete) + '%');
                        $(".app-progress").html(Math.ceil(percentComplete)+'%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: '<?= base_url('upload/uploadProduct') ?>',
            data: form_data,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
            },
            success: function(e){
                console.log(e);

                $('#token').val(e.csrf_token);


	

                if(e.error){
                  Swal.fire({
                    type:'warning',
                    title: 'Oops...',
                    html: e.errors,
                    confirmButtonColor: '#DB000E',
                  });
                  
                  $(".app-progress").css('width','auto');
                  $(".app-progress").html('0%');
                  $(".app-progress").css('display','none');
                  $(".btn-app").css('display','block');
                  $('#app').val('');

                }
                if(e.success){
                  $(".app-progress").css('width','100%');
                  $(".app-progress").html('Successfully');
                  $(".close-app").css('display','inline');
                  $(".format-file").html(e.format_file);
                  $('.go-live').removeAttr('disabled');
                }

            }
        });
    });
  $(".payment-upload").on('change','input[name=web]',function(){
    var form_data = new FormData();
        form_data.append("web", $('input[name=web]')[0].files[0]);
        form_data.append("np",$('.productName').val());
        form_data.append("jx",$('.jx').val());
        form_data.append("jenis",$('.jenis').val());
        form_data.append("kategori",$('.sub').val());
        form_data.append("deskripsi",$('.deskripsi').val());
        form_data.append("tagline",$('.tagline').val());
        form_data.append("price",$('.label-price').val());
        form_data.append($('#token').attr('name'),$('#token').val());

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".btn-web").css('display','none');
                        $(".web-progress").css('display','block');
                        $(".web-progress").css('width',Math.ceil(percentComplete) + '%');
                        $(".web-progress").html(Math.ceil(percentComplete)+'%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: '<?= base_url('upload/uploadProduct') ?>',
            data: form_data,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
            },
            success: function(e){
                console.log(e);

                $('#token').val(e.csrf_token);


	

                if(e.error){
                  Swal.fire({
                    type:'warning',
                    title: 'Oops...',
                    html: e.errors,
                    confirmButtonColor: '#DB000E',
                  });
                  
                  $(".web-progress").css('width','auto');
                  $(".web-progress").html('0%');
                  $(".web-progress").css('display','none');
                  $(".btn-web").css('display','block');
                  $('#web').val('');

                }
                if(e.success){
                  // $(".btn-image").removeAttr('disabled');
                  // $(".btn-image input").css('display','inline');
                  $(".web-progress").css('width','100%');
                  $(".web-progress").html('Successfully');
                  $(".close-web").css('display','inline');
                  $(".format-file").html(e.format_file);
                  $('.go-live').removeAttr('disabled');
                }

            }
        });
    });

  $(".payment-upload").on('change','input[name=premium]',function(){
    var form_data = new FormData();
        form_data.append("premium", $('input[name=premium]')[0].files[0]);
        form_data.append("np",$('.productName').val());
        form_data.append("jx",$('.jx').val());
        form_data.append("jenis",$('.jenis').val());
        form_data.append("kategori",$('.sub').val());
        form_data.append("deskripsi",$('.deskripsi').val());
        form_data.append("tagline",$('.tagline').val());
        form_data.append("price",$('.label-price').val());
        form_data.append($('#token').attr('name'),$('#token').val());

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".btn-premium").css('display','none');
                        $(".premium-progress").css('display','block');
                        $(".premium-progress").css('width',Math.ceil(percentComplete) + '%');
                        $(".premium-progress").html(Math.ceil(percentComplete)+'%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: '<?= base_url('upload/uploadProduct') ?>',
            data: form_data,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
            },
            success: function(e){
                console.log(e);

                $('#token').val(e.csrf_token);


	

                if(e.error){
                  Swal.fire({
                    type:'warning',
                    title: 'Oops...',
                    html: e.errors,
                    confirmButtonColor: '#DB000E',
                  });
                  
                  $(".premium-progress").css('width','auto');
                  $(".premium-progress").html('0%');
                  $(".premium-progress").css('display','none');
                  $(".btn-premium").css('display','block');
                  $('#premium').val('');

                }
                if(e.success){
                  // $(".btn-image").removeAttr('disabled');
                  // $(".btn-image input").css('display','inline');
                  $(".premium-progress").css('width','100%');
                  $(".premium-progress").html('Successfully');
                  $(".close-premium").css('display','inline');
                  $(".format-file").html(e.format_file);
                  $('.go-live').removeAttr('disabled');
                }

            }
        });
    });


    $(".close-image").on('click',function(){

      let dataItem = $(this).attr('data-item');

      // alert(dataItem);

      $(".image1").attr('src','<?= base_url('assets2/img/produk/new-image-upload.svg') ?>');
      $(".imagethumbnail"+dataItem).attr('src','<?= base_url('assets2/img/produk/new-thumbnail-upload.svg') ?>');
      $(".imagethumbnail"+dataItem).attr('data-thumbnail','<?= base_url('assets2/img/produk/new-image-upload.svg') ?>');
      $(".gambar"+dataItem).css('display','inline');
      $(".close-"+dataItem).css('display','none');
      


       var form_data = new FormData();
        form_data.append("jx",$('.jx').val());
        form_data.append("js",dataItem);
        form_data.append($('#token').attr('name'),$('#token').val());

        $.ajax({
              type: 'POST',
              url: '<?= base_url('upload/deleteimage') ?>',
              data: form_data,
              contentType: false,
              cache: false,
              processData:false,
              success: function(e){
                  console.log(e);
                  $('#token').val(e.csrf_token);
                  if(e.error){
                    Swal.fire({
                      type:'warning',
                      title: 'Oops...',
                      html: e.errors,
                      confirmButtonColor: '#DB000E',
                    });
                  }
                  if(e.success){
                    // alert('the image have been deleted');
                  }

              }
        });
     

    });

    $(".payment-upload").on('click',".close-product",function(){

      let dataItem = $(this).attr('data-product');

      // alert(dataItem);



      $(".btn-"+dataItem).css('display','block');
      $(".close-"+dataItem).css('display','none');
      $("."+dataItem+"-progress").css('display','none');
      $("#"+dataItem).val('');

      if (dataItem == 'desktop') {
        $(".render-font").css('display','none');
      }
      if (dataItem == 'free') {
        $("#file").val('');
      }

      
       var form_data = new FormData();
        form_data.append("jx",$('.jx').val());
        form_data.append("js",dataItem);
        form_data.append($('#token').attr('name'),$('#token').val());

        $.ajax({
              type: 'POST',
              url: '<?= base_url('upload/deleteproduct') ?>',
              data: form_data,
              contentType: false,
              cache: false,
              processData:false,
              success: function(e){
                  console.log(e);
                  $('#token').val(e.csrf_token);
                  if(e.error){
                    Swal.fire({
                      type:'warning',
                      title: 'Oops...',
                      html: e.errors,
                      confirmButtonColor: '#DB000E',
                    });
                  }
                  if(e.success){
                    //  alert('the product have been deleted');
                    $(".format-file").html(e.format_file);
                  }

              }
        });
      

    });
    

  $(".item").on('click',function(){

    let dataItem = $(this).attr('data-item');

    // alert(dataItem);

    $(".item").on('change','.gambar'+dataItem,function(){    

      var form_data = new FormData();
          form_data.append($('.gambar'+dataItem).attr('name'), $('.gambar'+dataItem)[0].files[0]);
          form_data.append("np",$('.productName').val());
          form_data.append("jx",$('.jx').val());
          form_data.append("jenis",$('.jenis').val());
          form_data.append("kategori",$('.sub').val());
          form_data.append("deskripsi",$('.deskripsi').val());
          form_data.append("tagline",$('.tagline').val());
          form_data.append("price",$('.label-price').val());
          form_data.append($('#token').attr('name'),$('#token').val());

      

                  $.ajax({
                      type: 'POST',
                      url: '<?= base_url('upload/uploadProduct') ?>',
                      data: form_data,
                      contentType: false,
                      cache: false,
                      processData:false,
                      beforeSend: function(){
                      },
                      success: function(e){
                          console.log(e);

                          $('#token').val(e.csrf_token);

                          if(e.error){
                            Swal.fire({
                              type:'warning',
                              title: 'Oops...',
                              html: e.errors,
                              confirmButtonColor: '#DB000E',
                            });
                            
                          }
                          if(e.success){
                           
                            if (dataItem == '1') {
                                $('.gambar'+dataItem).val('');
                                $(".image1").attr('src','<?= base_url('') ?>'+e.lok+e.image);
                                $(".imagethumbnail1").attr('src','<?= base_url('') ?>'+e.lok+e.imagethumbnail);
                                $(".imagethumbnail1").attr('data-thumbnail','<?= base_url('') ?>'+e.lok+e.image);
                                $(".gambar"+dataItem).css('display','none');
                                $(".close-"+dataItem).css('display','inline');


                            }else{
                              if (dataItem == '2') {
                                  $('.gambar'+dataItem).val('');
                                  $(".image1").attr('src','<?= base_url('') ?>'+e.lok+e.image);
                                  $(".imagethumbnail2").attr('src','<?= base_url('') ?>'+e.lok+e.imagethumbnail);
                                  $(".imagethumbnail2").attr('data-thumbnail','<?= base_url('') ?>'+e.lok+e.image);
                                  $(".gambar"+dataItem).css('display','none');
                                  $(".close-"+dataItem).css('display','inline');
                              }else{
                                if (dataItem == '3') {
                                    $('.gambar'+dataItem).val('');
                                    $(".image1").attr('src','<?= base_url('') ?>'+e.lok+e.image);
                                    $(".imagethumbnail3").attr('src','<?= base_url('') ?>'+e.lok+e.imagethumbnail);
                                    $(".imagethumbnail3").attr('data-thumbnail','<?= base_url('') ?>'+e.lok+e.image);
                                    $(".gambar"+dataItem).css('display','none');
                                    $(".close-"+dataItem).css('display','inline');
                                }else{
                                  if (dataItem == '4') {
                                      $('.gambar'+dataItem).val('');
                                      $(".image1").attr('src','<?= base_url('') ?>'+e.lok+e.image);
                                      $(".imagethumbnail4").attr('src','<?= base_url('') ?>'+e.lok+e.imagethumbnail);
                                      $(".imagethumbnail4").attr('data-thumbnail','<?= base_url('') ?>'+e.lok+e.image);
                                      $(".gambar"+dataItem).css('display','none');
                                      $(".close-"+dataItem).css('display','inline');
                                  }else{
                                    if (dataItem == '5') {
                                        $('.gambar'+dataItem).val('');
                                        $(".image1").attr('src','<?= base_url('') ?>'+e.lok+e.image);
                                        $(".imagethumbnail5").attr('src','<?= base_url('') ?>'+e.lok+e.imagethumbnail);
                                        $(".imagethumbnail5").attr('data-thumbnail','<?= base_url('') ?>'+e.lok+e.image);
                                        $(".gambar"+dataItem).css('display','none');
                                        $(".close-"+dataItem).css('display','inline');
                                    }   
                                  }
                                }
                              }
                            }

                            $('.go-live').removeAttr('disabled');

                          // if ($('.select').val() == 'Photo') {
                          //     if ($(".btn-image input").attr('name') == 'gambar2') {  
                          //       $('.go-live').removeAttr('disabled');
                          //     }
                          // }else{
                          //   if($(".imagethumbnail5").attr('data-thumbnail') != ""){
                          //       $('.go-live').removeAttr('disabled');
                          //     }
                          // }
                          }

                      }
                  });



                // }else{
                //            Swal.fire({
                //               type:'warning',
                //               title: 'Oops...',
                //               html:"your upload image " + this.width +" x "+ this.height+"px",
                //               confirmButtonColor: '#DB000E',
                //             });
                // }
          
     });
  });
	




      $(".web-open").on('click',function() {
        $(".web-value").toggle();
      });



      $('.go-live').on('click',function(e){
	    	e.preventDefault();
      var form_data = new FormData();
          form_data.append("np",$('.productName').val());
          form_data.append("jx",$('.jx').val());
          form_data.append("jenis",$('.jenis').val());
          form_data.append("kategori",$('.sub').val());
          form_data.append("deskripsi",$('.deskripsi').val());
          form_data.append("tagline",$('.tagline').val());
          form_data.append("price",$('.label-price').val());
          form_data.append($('#token').attr('name'),$('#token').val());

        $.ajax({
                  url  : '<?= base_url('upload/live') ?>',
                  type : "POST",
                  data: form_data,
                  contentType: false,
                  cache: false,
                  processData:false,
                  success: function(data){
                    console.log(data);
                    $('#token').val(data.csrf_token);
                    if(data.error)
                    {
                           Swal.fire({
                              type:'warning',
                              title: 'Oops...',
                              html: data.message,
                              confirmButtonColor: '#DB000E',
                            });                       
                    }   
                    if(data.success)
                    {
                      // location.reload();
                           Swal.fire({
                              type:'success',
                              title: 'success...',
                              html: 'success live product',
                              confirmButtonColor: '#DB000E',
                            });  


                    }   
                    
                  }

        });

	    });




   var vPortWidth  = $(window).width();
  
    if (vPortWidth <= 575) {
        $('#2').remove();
        location.replace('<?= base_url('profile') ?>');
    }else{
        $('#1').remove();
    }

	</script>
</body>
</html



