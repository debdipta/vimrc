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
			//alert(tmp)
			var _id = tmp.split('/')[1]
			//alert(_id)
			var data_from_file = 'data_from_file_' + _id
			var target = tmp.slice(1)
			//target += '.html'
			var _url = "get_text.php?action=read_data_file&file=" + target + ".html"
			//alert(_url)
			$.ajax({
			  type: "GET",
			  url: _url,
			  error: function(data){
				alert("There was a problem while loading "+_url);
			  },
			  success: function(data){
				  //alert(data);
				  document.getElementById(data_from_file).innerHTML = data;
			  }
		  })
		});
	});
	</script>
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
					echo '<div id="menuitems"><a href="#'.$dir.'/'. strstr($ff,".html",true).'" class="list-group-item">'. strstr($ff,".html",true).'</a></div>';
				}
			}
		}
	?>
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
				<h1 style="color: #5e9ca0;">Welcome to <span style="color: #2b2301;">cstheories.com</span></h1>
				<p>
					<span style="color:#008000;"><span style="font-family:comic sans ms,cursive;"><span style="font-size:18px;"><strong>This section describes about C++ Prgramming language</strong></span></span></span></p>
				<p>
					<span style="font-size:18px;"><span style="font-family:courier new,courier,monospace;"><strong>Introduction to Object:&nbsp;</strong></span></span></p>
				<p>
					<span style="font-family:courier new,courier,monospace;"><span style="font-size:16px;">In Object Oriented Programming like CPlusPlus, Object is an instance of a Class, that may consist of variables as data, functions as methods. &quot;Class&quot; in C++ means classification. Class helps in differenciating one object from another. While learning C++, it is important to learn the language syntaxes as well as &quot;the need&quot; moving into world of C++.</span></span></p>
				<p>
					<strong><span style="font-size:18px;"><span style="font-family:courier new,courier,monospace;">Connection between C and C++ :</span></span></strong></p>
				<p>
					<span style="font-family:courier new,courier,monospace;"><span style="font-size:16px;">There are couple of C features used in C++. And also some unique C++ concepts introduced in&nbsp;<strong>Opps</strong>. Difference in suructures in C &nbsp;and C++. How C++ class evolved from structure of C.</span></span></p>
				<p>
					<font face="courier new, courier, monospace"><span style="font-size: 18px;"><b>Data abstraction and hiding implementation:</b></span></font></p>
				<p>
					<span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">C++ introduces a new way of creating data variables and abstracting those. In a C++ class, there are three types of access specifiers - private, protected and public.&nbsp;This means that you&nbsp;</span></span><span style="font-size: 16px; font-family: &quot;courier new&quot;, courier, monospace;">can separate the underlying implementation from the interface that&nbsp;</span><span style="font-size: 16px; font-family: &quot;courier new&quot;, courier, monospace;">the client programmer sees, and thus allow that implementation to&nbsp;</span><span style="font-size: 16px; font-family: &quot;courier new&quot;, courier, monospace;">be easily changed without affecting client code</span></p>
				<p>
					<span style="font-size:18px;"><strong style="font-family: &quot;courier new&quot;, courier, monospace; font-size: 18px;">Function overloading and default arguments:&nbsp;</strong></span></p>
				<div>
					<span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">C++ allow to use same function name but with different parameters in a single library. This is intended to help managing big projects. This feature is called function overloading, ossible suing same function name as long as different parameters.</span></span></div>
				<div>
					&nbsp;</div>
				<div>
					<strong><span style="font-size:18px;"><span style="font-family:courier new,courier,monospace;">References and Copy constructor:</span></span></strong></div>
				<div>
					<span style="font-family:courier new,courier,monospace;"><span style="font-size:16px;">C pointer differs from C++ pointers by strong type checking feature in c++. C++ also allows to pass variables in parameters as reference. Also there is concept of copy constructor, that controls how an object can be sent in function parameters and returned from.</span></span></div>
				<div>
					&nbsp;</div>
				<div>
					<span style="font-size:18px;"><strong><span style="font-family:courier new,courier,monospace;">Operator Overloading:</span></strong></span></div>
				<div>
					<span style="font-family:courier new,courier,monospace;">In operator overloading, C++ allows to customise usage of different operators. Sometings to make some addtional type checking, operator overloading is required. Also in order to make an operator member to the class.</span></div>
				<div>
					&nbsp;</div>
				<div>
					<span style="font-size:18px;"><strong><span style="font-family:courier new,courier,monospace;">Dynamic object creation:</span></strong></span></div>
				<div>
					<span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">C++ have to operator, operator <strong>new</strong> to allocate buffer in heap, <strong>delete </strong>operator to release from heap. These two operators can also be overloaded to control allocation of buffer in heap.</span></span></div>
				<div>
					&nbsp;</div>
				<div>
					<strong><span style="font-size:18px;"><span style="font-family:courier new,courier,monospace;">Inheritance and composition:</span></span></strong></div>
				<div>
					<div>
						<span style="font-family:courier new,courier,monospace;"><span style="font-size:16px;">Data abstraction allows&nbsp;</span></span><span style="font-size: 16px; font-family: &quot;courier new&quot;, courier, monospace;">us to create new types from scratch, but with composition and&nbsp;</span><span style="font-size: 16px; font-family: &quot;courier new&quot;, courier, monospace;">inheritance, we can create new types from existing types. With&nbsp;</span><span style="font-size: 16px; font-family: &quot;courier new&quot;, courier, monospace;">composition, a new type can be assambled using other types as pieces,&nbsp;</span><span style="font-size: 16px; font-family: &quot;courier new&quot;, courier, monospace;">and with inheritance, a more specific version of an&nbsp;</span><span style="font-size: 16px; font-family: &quot;courier new&quot;, courier, monospace;">existing types are craeted.</span></div>
					<div>
						&nbsp;</div>
					<div>
						<span style="font-size:18px;"><strong><span style="font-family:courier new,courier,monospace;">Polymorphism and Virtual functions:</span></strong></span></div>
					<div>
						<span style="font-family:courier new,courier,monospace;">Polymorphism is usage of inheritance to create a family of types.</span></div>
					<div>
						&nbsp;</div>
					<div>
						<span style="font-size:18px;"><strong><span style="font-family:courier new,courier,monospace;">Templates:</span></strong></span></div>
					<div>
						<div>
							<span style="font-family:courier new,courier,monospace;">Templates allow to reuse source code&nbsp;</span><span style="font-family: &quot;courier new&quot;, courier, monospace;">by providing the compiler with a way to substitute type names in&nbsp;</span><span style="font-family: &quot;courier new&quot;, courier, monospace;">the body of a class or function. This supports the use of container&nbsp;</span><span style="font-family: &quot;courier new&quot;, courier, monospace;">class libraries, which are important tools for the rapid, robust&nbsp;</span><span style="font-family: &quot;courier new&quot;, courier, monospace;">development of object-oriented programs</span></div>
					</div>
				</div>
				<h3>Go through right table learning from scratch and example</h3>
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