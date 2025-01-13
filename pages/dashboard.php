  <!-- Custom styling plus plugins -->
  <link href="../css/animate.min.css" rel="stylesheet">
  <style>
     
.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}


.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}
  </style>
  
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Dashboard
                 
                </h3>
            </div>

            <div class="title_right">
          
            </div>
          </div>    </div>
    
          <div class="clearfix"></div>

        <div class="">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-md-3 col-xl-3">
          <a href="?pages=request_list">   <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Materials Request</h6>
                     <h1 class="text-right"><i class="fa fa-cart-plus f-left"></i><span>
                    <?php	$q=mysqli_query($conn,"SELECT count(id_mr) as cnt From material_request") or die(mysqli_error());
									$qr=mysqli_fetch_array($q);
									echo $qr['cnt'];?></span></h1>
                   
                </div>
            </div></a>
        </div>
        
        <div class="col-md-3 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Purchase Orders</h6>
                     <h1 class="text-right"><i class="fa fa-rocket f-left"></i><span>
                   <?php	$q=mysqli_query($conn,"SELECT count(id_po) as cnt From purchase_order") or die(mysqli_error());
									$qr=mysqli_fetch_array($q);
									echo $qr['cnt'];?></span></h1>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-xl-3">
             <a href="?pages=receive_item">  <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Orders Received (Today)</h6>
                    <h1 class="text-right"><i class="fa fa-sign-in f-left"></i><span>
                   <?php	$q=mysqli_query($conn,"SELECT count(id_receive) as cnt From receive_item where date='".date('Y-m-d')."'") or die(mysqli_error());
									$qr=mysqli_fetch_array($q);
									echo $qr['cnt'];?></span></h1>
                </div>
            </div></a>
        </div>
        
        <div class="col-md-3 col-xl-3">
        <a href="?pages=usage_item">   <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Usage</h6>
                     <h1 class="text-right"><i class="fa fa-refresh f-left"></i><span>
                   <?php	$q=mysqli_query($conn,"SELECT count(id_usage) as cnt From material_usage where date='".date('Y-m-d')."'") or die(mysqli_error());
									$qr=mysqli_fetch_array($q);
									echo $qr['cnt'];?></span></h1>
                </div>
            </div></a>
        </div>
	</div>
</div>


          <br />




          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel fixed_height_520">
                <div class="x_title">
                  <h2>HISTORY <small>Last Activity User</small></h2>
           
                  <div class="clearfix"></div>
                </div>
     <div class="x_content">
         
         <ul class="list-unstyled top_profiles scroll-view" tabindex="5001" style="overflow: hidden; outline: none; cursor: -webkit-grab;">
               <?php
                                            
    $level=$_SESSION['SES_LEVEL'];
    
	$no = 1;
	foreach($db->viewHistory() as $x){
	?>
                    
             
                        <li class="media event">
                          <a class="pull-left border-aero profile_thumb">
                            <i class="fa fa-user blue"></i>
                          </a>
                          <div class="media-body">
                            <a class="title" href="#">  <a><?php echo $x['history']?></a></a>
                            <p><strong><?php echo $x['action']?> By</strong> <?php echo $x['first_name']?> </p>
                            <p> <small><?php echo $x['date']?></small>
                            </p>
                          </div>
                        </li>
           <?php }?><br>
                      </ul>
         
         





              </div>     
     
     
     </div>
            </div>



            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel fixed_height_520">
                <div class="x_title">
                   <h2>MANUFACTURE PROGRESS
 <small></small></h2>
         
                  <div class="clearfix"></div>
                </div>
               

											
												<script type="text/javascript" src="../js/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script type="text/javascript" >
		$(function () {
  var chart; 
        $(document).ready(function() {
              chart = new Highcharts.Chart(
              {
                  
                 chart: {
                    renderTo: 'mygraph',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                 },   
                 title: {
                    text: 'MANUFACTURE STATUS '
                 },
                 tooltip: {
                    formatter: function() {
                        return '<b>'+
                        this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' % ';
                    }
                 },
                 
                
                 plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            color: '#000000',
                            connectorColor: 'green',
                            formatter: function() 
                            {
                                return '<b>' + this.point.name + '</b>: ' + Highcharts.numberFormat(this.percentage, 2) +' % ';
                            }
                        }
                    }
                 },
       
                    series: [{
                    type: 'pie',
                    name: 'Browser share',
                    data: [
                    <?php
                       
                       $qc=mysqli_query($conn,"SELECT * FROM manufacture_planning GROUP by status") or die(mysqli_error());
							while ($qrc=mysqli_fetch_array($qc)){
							
								
								if ($qrc['status']==0){
								    
								    $majorname="pending";
								 }else if ($qrc['status']==1){
								     $majorname="On progress";
								}else if ($qrc['status']==2){
								     $majorname="Completed";
								}else if ($qrc['status']==3){
								     $majorname="Finish";
								}
                         
                          $qasc=mysqli_query($conn,"SELECT count(*) AS total FROM manufacture_planning WHERE status='".$qrc['status']."'") or die(mysqli_error());
							$qrasc=mysqli_fetch_array($qasc);
                            $jumlah = $qrasc['total'];
                            ?>
                            [ 
                                '<?php echo $majorname ?>', <?php echo $jumlah; ?>
                            ],
                            <?php
                        }
                        ?>
             
                    ]
                }]
              });
        }); 
    
});
</script>
<!--grafik akan ditampilkan disini -->
<div id="mygraph" style="min-width: auto;
 height: auto; margin: 0 auto"></div>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
                      
               
             
        


<br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div> 
          </div>

 
