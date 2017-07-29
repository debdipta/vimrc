<!DOCTYPE html>
<html lang="en">
<head>
  <title>CS Concepts</title>
  <meta charset="utf-8">
  <link rel=icon href="favicon.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css\bootstrap.min.css">
  <link rel="stylesheet" href="css\font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="js\jquery.min.js"></script>
  <script src="js\bootstrap.min.js"></script>
  <script src="js\jquery.min.js"></script>
	<script>
	$(document).ready(function() {
		$("#menuitems a").click(function(e) {
			//Do stuff when clicked
			var tmp = $(e.target).attr("href") // clicked menu item
			var _id = tmp.split('/')[1]
			//alert(_id)
			var data_from_file = 'data_from_file_' + _id
			var target = tmp.slice(1)
			var _url = "get_text.php?get_data=true&file=" + target
			//alert(_url)
			$.ajax({
			  type: "GET",
			  url: _url,
			  error: function(data){
				alert("There was a problem");
			  },
			  success: function(data){
				  //alert(data);
				  document.getElementById(data_from_file).innerHTML = data;
			  }
		  })
		});
	});
	</script>
	  <style>
		.list-group.panel > .list-group-item {
		  border-bottom-right-radius: 4px;
		  border-bottom-left-radius: 4px
		}
		/* Remove the navbar's default margin-bottom and rounded borders */ 
		.navbar {
		  margin-bottom: 0;
		  border-radius: 0;
		}
		
		/* Set height of the grid so .sidenav can be 100% (adjust as needed) */
		.row.content {height: 450px}
		
		/* Set gray background color and 100% height */
		.sidenav {
		  padding-top: 20px;
		  background-color: #f1f1f1;
		  height: 100%;
		}
		
		/* Set black background color, white text and some padding */
		footer {
		  background-color: #555;
		  color: white;
		  padding: 15px;
		}
		
		/* On small screens, set height to 'auto' for sidenav and grid */
		@media screen and (max-width: 767px) {
		  .sidenav {
			height: auto;
			padding: 15px;
		  }
		  .row.content {height:auto;} 
		}
	  </style>

	<?php
		function listFolderFiles($dir){
			$ffs = scandir($dir);

			unset($ffs[array_search('.', $ffs, true)]);
			unset($ffs[array_search('..', $ffs, true)]);

			// prevent empty ordered elements
			if (count($ffs) < 1)
				return;
			foreach($ffs as $ff){
				if(is_dir($dir.'/'.$ff)) 	{
					echo '<a href=#'.$ff.' class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">'.$ff.'<i class="fa fa-caret-down"></i></a>';
					echo '<div class="collapse" id='.$ff.'>';
					//echo '<li>Folder:'.$ff;
					listFolderFiles($dir.'/'.$ff);
					echo '</div>';
				}else	{
					//echo 'File:'.strstr($ff,".html",true).'</li>';
					$pos = strpos($ff, ".html");
					if($pos === false)
						continue;
					echo '<div id="menuitems"><a href="#'.$dir.'/'.$ff.'" class="list-group-item">'. strstr($ff,".html",true).'</a></div>';
				}
			}
		}
	?>	  
</head>

<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">CS Theories</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul id="myTab" class="nav navbar-nav">
            <li class="active"><a data-toggle="tab" href="#cpp">C Plus Plus</a></li>
            <li><a data-toggle="tab" href="#python">Python</a></li>
            <li><a data-toggle="tab" href="#dp">Design Patterns</a></li>
			<li><a data-toggle="tab" href="#cs">Computer Science Concepts</a></li>
			<li><a data-toggle="tab" href="#analytics">Analytics</a></li>
			<li><a data-toggle="tab" href="#Algorithms">Algorithms</a></li>
			<li><a data-toggle="tab" href="#ebooks">eBooks Links</a></li>
			<li><a data-toggle="tab" href="#about">About</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
 
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="cpp">
		<div class="container-fluid text-center">    
		  <div class="row content">
			<div class="col-sm-2 sidenav">
			  <!-- menu -->
				<div class="list-group panel">
				  <?php
						listFolderFiles('src/cpp');
					?>
				</div>
			</div>
	
			<div id="data_from_file_cpp" class="col-sm-8 text-left"> 
				<h1>Welcome</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>	  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				<hr>
				<h3>Test</h3>
				<p>Lorem ipsum...</p>
			</div>
			<div class="col-sm-2 sidenav">
				<div class="well">
					<p>ADS</p>
				</div>
				<div class="well">
					<p>ADS</p>
				</div>
			</div>
		  </div>
		</div>
 	<footer class="container-fluid text-center">
		<p>Footer Text</p>
	</footer>
  </div>

  
  
  
  
<div class="tab-pane fade" id="dp">
		<div class="container-fluid text-center">    
		  <div class="row content">
			<div class="col-sm-2 sidenav">
			  <!-- menu -->
				<div class="list-group panel">
						<?php
							listFolderFiles('src/dp');
						?>
				</div>
			</div>
	
			<div id="data_from_file_dp" class="col-sm-8 text-left"> 
				<h1>Welcome Design Pattern</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				<hr>
				<h3>Test</h3>
				<p>Lorem ipsum...</p>
			</div>
			<div class="col-sm-2 sidenav">
				<div class="well">
					<p>ADS</p>
				</div>
				<div class="well">
					<p>ADS</p>
				</div>
			</div>
		  </div>
		</div>
	<footer class="container-fluid text-center">
		<p>Footer Text</p>
	</footer>
</div>
  
  
  
  
  
  
  
<div class="tab-pane fade" id="python">
		<div class="container-fluid text-center">    
		  <div class="row content">
			<div class="col-sm-2 sidenav">
			  <!-- menu -->
				<div class="list-group panel">
					<?php
						listFolderFiles('src/python');
					?>
				</div>
			</div>
	
			<div id="data_from_file_python" class="col-sm-8 text-left"> 
				<h1>Welcome Python</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				<hr>
				<h3>Test</h3>
				<p>Lorem ipsum...</p>
			</div>
			<div class="col-sm-2 sidenav">
				<div class="well">
					<p>ADS</p>
				</div>
				<div class="well">
					<p>ADS</p>
				</div>
			</div>
		  </div>
		</div>
	<footer class="container-fluid text-center">
		<p>Footer Text</p>
	</footer>
</div>
  
  
  
<div class="tab-pane fade" id="cs">
		<div class="container-fluid text-center">    
		  <div class="row content">
			<div class="col-sm-2 sidenav">
			  <!-- menu -->
				<div class="list-group panel">
					<?php
						listFolderFiles('src/cs');
					?>
				</div>
			</div>
	
			<div id="data_from_file_cs" class="col-sm-8 text-left"> 
				<h1>Welcome cs</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				<hr>
				<h3>Test</h3>
				<p>Lorem ipsum...</p>
			</div>
			<div class="col-sm-2 sidenav">
				<div class="well">
					<p>ADS</p>
				</div>
				<div class="well">
					<p>ADS</p>
				</div>
			</div>
		  </div>
		</div>
	<footer class="container-fluid text-center">
		<p>Footer Text</p>
	</footer>
</div>


<div class="tab-pane fade" id="analytics">
		<div class="container-fluid text-center">    
		  <div class="row content">
			<div class="col-sm-2 sidenav">
			  <!-- menu -->
				<div class="list-group panel">
					<?php
						listFolderFiles('src/analytics');
					?>
				</div>
			</div>
	
			<div id="data_from_file_analytics" class="col-sm-8 text-left"> 
				<h1>Welcome analytics</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				<hr>
				<h3>Test</h3>
				<p>Lorem ipsum...</p>
			</div>
			<div class="col-sm-2 sidenav">
				<div class="well">
					<p>ADS</p>
				</div>
				<div class="well">
					<p>ADS</p>
				</div>
			</div>
		  </div>
		</div>
	<footer class="container-fluid text-center">
		<p>Footer Text</p>
	</footer>
</div>



<div class="tab-pane fade" id="Algorithms">
		<div class="container-fluid text-center">    
		  <div class="row content">
			<div class="col-sm-2 sidenav">
			  <!-- menu -->
				<div class="list-group panel">
					<?php
						listFolderFiles('src/Algorithms');
					?>
				</div>
			</div>
	
			<div id="data_from_file_Algorithms" class="col-sm-8 text-left"> 
				<h1>Welcome Algorithms</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				<hr>
				<h3>Test</h3>
				<p>Lorem ipsum...</p>
			</div>
			<div class="col-sm-2 sidenav">
				<div class="well">
					<p>ADS</p>
				</div>
				<div class="well">
					<p>ADS</p>
				</div>
			</div>
		  </div>
		</div>
	<footer class="container-fluid text-center">
		<p>Footer Text</p>
	</footer>
</div>

  <div class="tab-pane fade" id="ebooks">
	<h1>ebooks</h1>
    <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
  </div>

  <div class="tab-pane fade" id="about">
	<h1>About</h1>
    <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
  </div>


</body>
</html>