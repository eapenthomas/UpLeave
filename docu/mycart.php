<?php
require_once"dbconfig.php";
if(isset($_SESSION['login']))
{
	
}
else
{
	header("location:ragister.php");
}

$result=select("SELECT *
FROM cart
INNER JOIN items ON cart.elecid = items.elecid WHERE userid='".$_SESSION['userid']."'");
$result1=select("SELECT sum(price)
FROM cart
INNER JOIN items ON cart.elecid = items.elecid WHERE userid='".$_SESSION['userid']."'");
$result2=select("select * from user where userid='".$_SESSION['userid']."'");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Dorne - Directory &amp; Listing Template | Listing</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link href="style.css" rel="stylesheet">

    <!-- Responsive CSS -->
    <link href="css/responsive/responsive.css" rel="stylesheet">

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="dorne-load"></div>
    </div>

    <!-- ***** Search Form Area ***** -->
    <div class="dorne-search-form d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-close-btn" id="closeBtn">
                        <i class="pe-7s-close-circle" aria-hidden="true"></i>
                    </div>
                    <form action="#" method="get">
                        <input type="search" name="caviarSearch" id="search" placeholder="Search Your Desire Destinations or Events">
                        <input type="submit" class="d-none" value="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ***** Header Area Start ***** -->
    <header class="header_area" id="header">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <div class="col-12 h-100">
                    <nav class="h-100 navbar navbar-expand-lg">
					 <a class="navbar-brand" href="index.php">ONLINE MEDICINE STORE</a>
                       
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#dorneNav" aria-controls="dorneNav" aria-expanded="false" aria-label="Toggle navigation"><span class="fa fa-bars"></span></button>
                        <!-- Nav -->
                        <div class="collapse navbar-collapse" id="dorneNav">
                            <ul class="navbar-nav mr-auto" id="dorneMenu">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php"> <span class="sr-only">(current)</span></a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="mycart.php"></a>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link" href="logout.php"></a>
                                </li>
                            </ul>
                            
                           
						       <div class="dorne-signin-btn">
							   <?php
							   if(isset($_SESSION['login']))
							   {
								   ?><a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                              
								<a class="nav-link" href="mycart.php">My Cart</a>
								<a class="nav-link" href="mycart.php">Category</a>
                              
                                	<a class="nav-link" href="logout.php">Logout</a>
								   
								   <?php
							   }
								   else
								   {
									   ?>
									   <a href="#">Sign in  or Register</a>
								<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
								
								   <?php
								   }
							   
							   ?>
                                
                            </div>
                           
                            
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Breadcumb Area Start ***** -->
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/hero-1.jpg)"></div>
	</br>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-1 text-center"></div>
        <div class="col-lg-10 text-center">
		
          <div class="alert alert-light" role="alert">
  <p style="color:red;font-weight:bold;font-size:20px;">My Cart Details<p>
</div>
        </div>
		 <div class="col-lg-1 text-center"></div>
       
	   
	   
      </div>
	  <div class="row">
	  <div class="col-lg-1"></div>
	  <div class="col-lg-10">
<div class="card text-center">
  
  <table class="table">
  <tr style="font-weight:bold">
<td>
S.No.
</td>
<td>
Book name
</td>
<td>
Price
</td>
<td>
Remove
</td>
  </tr>
  <?php
  $n=1;
  while($p=mysqli_fetch_array($result))
  {extract($p); 
  ?>
  <tr>
  <td><?=$n?>.</td>
  <td><?=ucwords($Title)?></td>
  <td><?=$price?>  /-</td>
  <td><a href="myphp.php?dele=yes&id=<?=$cartid?>">
          <span class="btn btn-danger">X</span>
        </a></td>
  <?php
	 $n++;
	 }
  ?>
  </tr>
</table>
  <div class="card-footer text-muted">
  <?php
  while($t=mysqli_fetch_array($result1))
  {extract($t);
  ?>
     <a href="index.php" class="btn btn-danger" style="font-weight:bold">Total Price- <?=$t[0]?>  /-</a>
	 
          <a href="payment.php?price=<?=$t[0]?>"><span class="btn btn-success">Buy</span></a>
     	 <?php
  }
	 ?>
  </div>
  <div class="card-footer text-muted">
     <a href="index.php" class="btn btn-primary">Continue shopping</a>
  </div>
</div>	  
	  
	  </div></div>
	<footer class="dorne-footer-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-md-flex align-items-center justify-content-between">
                    <div class="footer-text">
                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://projecttunnel.com/" target="_blank">Projecttunnel</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
    </footer>
    <!-- ****** Footer Area End ****** -->

    <!-- jQuery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap-4 js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/others/plugins.js"></script>
    <!-- Active JS -->
    <script src="js/active.js"></script>
<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>

</html>