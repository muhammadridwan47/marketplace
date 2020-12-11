<!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Mhd Ridwan <?= date('Y'); ?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
  <script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url('assets/'); ?>js/demo/datatables-demo.js"></script>
    <!-- Page level plugins -->
  <script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.js"></script>

  <!-- Page level custom scripts -->
  <!-- <script src="<?= base_url('assets/'); ?>js/demo/chart-area-demo.js"></script> -->
  <!-- <script src="<?= base_url('assets/'); ?>js/demo/chart-pie-demo.js"></script> -->


  <script>

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
      label: "Earnings",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "#1cc88a",
      pointRadius: 3,
      pointBackgroundColor: "#fff",
      pointBorderColor: "#999",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [
             <?php 
                $this->db->select_sum('harga');
                $data1 = $this->db->get_where('transaksi_paypal',['date' =>'01-'.date('y')])->result_array();
               
                if ($data1[0]['harga']){
                  echo $data1[0]['harga'];
                }else{
                  
                  echo "0";

                } 


             ?>
      , 
            <?php 
                $this->db->select_sum('harga');
                $data2 = $this->db->get_where('transaksi_paypal',['date' =>'02-'.date('y')])->result_array();
               
                if ($data2[0]['harga']){
                  echo $data2[0]['harga'];
                }else{
                  
                  echo "0";

                } 


             ?>,
             <?php 
                $this->db->select_sum('harga');
                $data3 = $this->db->get_where('transaksi_paypal',['date' =>'03-'.date('y')])->result_array();
               
                if ($data3[0]['harga']){
                  echo $data3[0]['harga'];
                }else{
                  
                  echo "0";

                } 


             ?>
              ,
             <?php 
                $this->db->select_sum('harga');
                $data4 = $this->db->get_where('transaksi_paypal',['date' =>'04-'.date('y')])->result_array();
               
                if ($data4[0]['harga']){
                  echo $data4[0]['harga'];
                }else{
                  
                  echo "0";

                } 


             ?>
               ,
             <?php 
                $this->db->select_sum('harga');
                $data5 = $this->db->get_where('transaksi_paypal',['date' =>'05-'.date('y')])->result_array();
               
                if ($data5[0]['harga']){
                  echo $data5[0]['harga'];
                }else{
                  
                  echo "0";

                } 


             ?>
               , 
             <?php 
                $this->db->select_sum('harga');
                $data6 = $this->db->get_where('transaksi_paypal',['date' =>'06-'.date('y')])->result_array();
               
                if ($data6[0]['harga']){
                  echo $data6[0]['harga'];
                }else{
                  
                  echo "0";

                } 


             ?>
               ,
             <?php 
                $this->db->select_sum('harga');
                $data7 = $this->db->get_where('transaksi_paypal',['date' =>'07-'.date('y')])->result_array();
               
                if ($data7[0]['harga']){
                  echo $data7[0]['harga'];
                }else{
                  
                  echo "0";

                } 


             ?>
               , 
             <?php 
                $this->db->select_sum('harga');
                $data8 = $this->db->get_where('transaksi_paypal',['date' =>'08-'.date('y')])->result_array();
               
                if ($data8[0]['harga']){
                  echo $data8[0]['harga'];
                }else{
                  
                  echo "0";

                } 


             ?>
               , 
             <?php 
                $this->db->select_sum('harga');
                $data9 = $this->db->get_where('transaksi_paypal',['date' =>'09-'.date('y')])->result_array();
               
                if ($data9[0]['harga']){
                  echo $data9[0]['harga'];
                }else{
                  
                  echo "0";

                } 


             ?>
               ,
             <?php 
                $this->db->select_sum('harga');
                $data10 = $this->db->get_where('transaksi_paypal',['date' =>'10-'.date('y')])->result_array();
               
                if ($data10[0]['harga']){
                  echo $data10[0]['harga'];
                }else{
                  
                  echo "0";

                } 


             ?>
               ,
             <?php 
                $this->db->select_sum('harga');
                $data11 = $this->db->get_where('transaksi_paypal',['date' =>'11-'.date('y')])->result_array();
               
                if ($data11[0]['harga']){
                  echo $data11[0]['harga'];
                }else{
                  
                  echo "0";

                } 


             ?>
               , 
             <?php 
                $this->db->select_sum('harga');
                $data12 = $this->db->get_where('transaksi_paypal',['date' =>'12-'.date('y')])->result_array();
               
                if ($data12[0]['harga']){
                  echo $data12[0]['harga'];
                }else{
                  
                  echo "0";

                } 


             ?>
               ],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '$' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});



// pie

// Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ["Designer", "Referral","User"],
        datasets: [{
          data: [<?= count($this->db->get_where('user',['role_id' => 3])->result_array()) ?>, <?= count($this->db->get_where('user',['role_id' => 2])->result_array()) ?>,<?= count($this->db->get_where('user',['role_id' => 1])->result_array()) ?>],
          backgroundColor: ['#e74a3b', '#1cc88a','#fd7e14'],
          hoverBackgroundColor: ['#e83e8c', '#17a673','#fd7e14'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 80,
      },
    });

// tutup pie
</script>
<script>





    $('.custom-file-input').on('change',function(){
         let fileName = $(this).val().split('\\').pop();
         $(this).next('.custom-file-label').addClass('selected').html(fileName);
    });

      $('#logout').on('click',function(){

      $.ajax({
                url  : "<?= base_url() ?>auth/logout",
                dataType : "JSON",
                success: function(data){


                console.log(data);

          if(data.success)
           {
             location.reload();
           }                   

              }

            });


     
     });

      $('#logout1').on('click',function(){

      $.ajax({
                url  : "<?= base_url() ?>auth/logout",
                dataType : "JSON",
                success: function(data){


                console.log(data);

          if(data.success)
           {
             location.reload();
           }                   

              }

            });


     
     });    
  </script>

</body>

</html>
