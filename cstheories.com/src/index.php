<!DOCTYPE html>
<html lang="en">
<head>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({
			google_ad_client: "ca-pub-8105909949822350",
			enable_page_level_ads: true
		});
	</script>
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
		<p>&copy; 2017 Debdipta Ghosh.  All rights reserved. | <a id="myLink" href="./privacy.html" target="_blank">Privacy Policy</a> | <a id="myLink" href="./contact.html" target="_blank">Contact us</a></p>
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
				<h1 style="color: #5e9ca0;">Welcome to <span style="color: #2b2301;">cstheories.com</span></h1>
				<p>
					<span style="color:#008000;"><span style="font-family:comic sans ms,cursive;"><span style="font-size:18px;"><strong>This section describes about Design Patterns using C++</strong></span></span></span></p>
				<p>
					<span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">&quot;Design Pattern&quot; describes a problem which occurs again and again in our environment, then provides a way to solve that problem. There is in general 22 design patterns and can be catagorized as per they purpose they serves.</span></span></p>
				<table border="1" cellpadding="1" cellspacing="1" style="width: 550px">
					<tbody>
						<tr>
							<td colspan="3" style="text-align: center;">
								<span style="color:#006400;"><span style="font-size:18px;"><strong><span style="font-family:courier new,courier,monospace;">Purpose</span></strong></span></span></td>
						</tr>
						<tr>
							<td style="text-align: center;">
								<span style="color:#006400;"><span style="font-size:18px;"><strong><span style="font-family:courier new,courier,monospace;">Creational</span></strong></span></span></td>
							<td style="text-align: center;">
								<span style="color:#006400;"><span style="font-size:18px;"><strong><span style="font-family:courier new,courier,monospace;">Structural</span></strong></span></span></td>
							<td style="text-align: center;">
								<span style="color:#006400;"><span style="font-size:18px;"><strong><span style="font-family:courier new,courier,monospace;">Behavioral</span></strong></span></span></td>
						</tr>
						<tr>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Factory Method</span></span></span></td>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Adapter</span></span></span></td>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Interpreter</span></span></span></td>
						</tr>
						<tr>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Abstract Factory</span></span></span></td>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Bridge</span></span></span></td>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Chain of Responsibility</span></span></span></td>
						</tr>
						<tr>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Builder</span></span></span></td>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Composite</span></span></span></td>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Command</span></span></span></td>
						</tr>
						<tr>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Prototype</span></span></span></td>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Decorator</span></span></span></td>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Iterator</span></span></span></td>
						</tr>
						<tr>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Singletone</span></span></span></td>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Facade</span></span></span></td>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Mediator</span></span></span></td>
						</tr>
						<tr>
							<td>
								&nbsp;</td>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Flyweight</span></span></span></td>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Momento</span></span></span></td>
						</tr>
						<tr>
							<td>
								&nbsp;</td>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Proxy</span></span></span></td>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Observer</span></span></span></td>
						</tr>
						<tr>
							<td>
								&nbsp;</td>
							<td>
								&nbsp;</td>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">State</span></span></span></td>
						</tr>
						<tr>
							<td>
								&nbsp;</td>
							<td>
								&nbsp;</td>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Strategy</span></span></span></td>
						</tr>
						<tr>
							<td>
								&nbsp;</td>
							<td>
								&nbsp;</td>
							<td>
								<span style="color:#2f4f4f;"><span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Visitor</span></span></span></td>
						</tr>
					</tbody>
				</table>
				<p style="box-sizing: border-box; margin: 0px 0px 10px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);">
					&nbsp;</p>
				<p style="box-sizing: border-box; margin: 0px 0px 10px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);">
					<span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">In general, a pattern has four essential elements:</span></span></p>
				<ol>
					<li style="box-sizing: border-box; margin: 0px 0px 10px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);">
						<span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">The <strong>Pattern Name</strong> is a handle we can use to desribe a design problem</span></span></li>
					<li style="box-sizing: border-box; margin: 0px 0px 10px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);">
						<span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">The <strong>problem </strong>describes when to apply the pattern. It describes the problem and the context. Sometimes, those problems will include a list of conditions that must be met before it makes sense to apply the pattern.</span></span></li>
					<li style="box-sizing: border-box; margin: 0px 0px 10px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);">
						<span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">The <strong>Solution </strong>describes th eelements that make upthe design, and their relationships, responsibilites, and collaborations. As a pattern is just like a template that can be applied in many different situations, the solution does not describe a particular design.</span></span></li>
					<li style="box-sizing: border-box; margin: 0px 0px 10px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);">
						<span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">The <strong>consequences </strong>describes are results of applying those patterns.</span></span><br />
						&nbsp;</li>
				</ol>
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
		<p>&copy; 2017 Debdipta Ghosh.  All rights reserved. | <a id="myLink" href="./privacy.html" target="_blank">Privacy Policy</a> | <a id="myLink" href="./contact.html" target="_blank">Contact us</a></p>
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
				<h1 style="color: #5e9ca0;">Welcome to <span style="color: #2b2301;">cstheories.com</span></h1>
				<p>
					<span style="color:#008000;"><span style="font-family:comic sans ms,cursive;"><span style="font-size:18px;"><strong>This section describes about Python programming language</strong></span></span></span></p>
				<p style="font-family: &quot;Open Sans&quot;, sans-serif; margin-bottom: 1.4em; -webkit-font-smoothing: antialiased; color: rgb(34, 34, 34); font-size: 18.656px; word-spacing: 4px; background-color: rgb(255, 255, 255);">
				<span style="font-family:courier new,courier,monospace;"><span style="font-size:16px;">Python is a powerful high-level, object-oriented programming language. It is created by Guido van Rossum. I</span></span><span style="font-family: &quot;courier new&quot;, courier, monospace; font-size: 16px;">t has some simple easy-to-use syntax, making it the perfect language for someone trying to learn computer programming for the first time.</span></p>
				<p style="font-family: &quot;Open Sans&quot;, sans-serif; margin-bottom: 1.4em; -webkit-font-smoothing: antialiased; color: rgb(34, 34, 34); font-size: 18.656px; word-spacing: 4px; background-color: rgb(255, 255, 255);">
					<span style="font-family:courier new,courier,monospace;"><span style="font-size:16px;">This is a comprehensive guide on how to get started in Python, why you should learn it and how you can learn it.</span></span></p>
				<p style="font-family: &quot;Open Sans&quot;, sans-serif; margin-bottom: 1.4em; -webkit-font-smoothing: antialiased; color: rgb(34, 34, 34); font-size: 18.656px; word-spacing: 4px; background-color: rgb(255, 255, 255);">
					<span style="font-family:courier new,courier,monospace;"><span style="font-size:18px;"><strong>Features of python:</strong></span></span></p>
				<ul>
					<li style="margin-bottom: 1.4em; -webkit-font-smoothing: antialiased; color: rgb(34, 34, 34); word-spacing: 4px; background-color: rgb(255, 255, 255);">
						<span style="font-family:courier new,courier,monospace;">A Simple language easier to learn</span></li>
					<li style="margin-bottom: 1.4em; -webkit-font-smoothing: antialiased; color: rgb(34, 34, 34); word-spacing: 4px; background-color: rgb(255, 255, 255);">
						<span style="font-family:courier new,courier,monospace;">Free and open source. Anyone can download and build python customizing it as per their requirements</span></li>
					<li style="margin-bottom: 1.4em; -webkit-font-smoothing: antialiased; color: rgb(34, 34, 34); word-spacing: 4px; background-color: rgb(255, 255, 255);">
						<span style="font-family:courier new,courier,monospace;">Portability: Same python code can work in different platforms like Linux, HP-UX, Windows, Mac</span></li>
					<li style="margin-bottom: 1.4em; -webkit-font-smoothing: antialiased; color: rgb(34, 34, 34); word-spacing: 4px; background-color: rgb(255, 255, 255);">
						<span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Extensible and Embedded: If your program need higher performance like C or C++, you can combine piece of you C/C++ code with python. As example. python numpy library that works on mathematical computation, written in C</span></span></li>
					<li style="margin-bottom: 1.4em; -webkit-font-smoothing: antialiased; color: rgb(34, 34, 34); word-spacing: 4px; background-color: rgb(255, 255, 255);">
						<span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Python is High level, interpreted language. It takes of garbage collection and memory management internally</span></span></li>
					<li style="margin-bottom: 1.4em; -webkit-font-smoothing: antialiased; color: rgb(34, 34, 34); word-spacing: 4px; background-color: rgb(255, 255, 255);">
						<span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Large common library to solve common task: Python have a vast amount of common library that help us writing code easily</span></span></li>
					<li style="margin-bottom: 1.4em; -webkit-font-smoothing: antialiased; color: rgb(34, 34, 34); word-spacing: 4px; background-color: rgb(255, 255, 255);">
						<span style="font-size:16px;"><span style="font-family:courier new,courier,monospace;">Object Oriented: Python is an object oriented language</span></span></li>
				</ul>
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
		<p>&copy; 2017 Debdipta Ghosh.  All rights reserved. | <a id="myLink" href="./privacy.html" target="_blank">Privacy Policy</a> | <a id="myLink" href="./contact.html" target="_blank">Contact us</a></p>
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
				<h1 style="color: #5e9ca0;">Welcome to <span style="color: #2b2301;">cstheories.com</span></h1>
				<p>
					<span style="color:#008000;"><span style="font-family:comic sans ms,cursive;"><span style="font-size:18px;"><strong>This section describes about different Computher science theories</strong></span></span></span></p>
					<p>
			<span style="font-size:18px;"><span style="font-family:courier new,courier,monospace;">There is an section &quot;Computer Science Concepts&quot;. There different advance topics are discussed related to Computer.</span></span></p>
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
		<p>&copy; 2017 Debdipta Ghosh.  All rights reserved. | <a id="myLink" href="./privacy.html" target="_blank">Privacy Policy</a> | <a id="myLink" href="./contact.html" target="_blank">Contact us</a></p>
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
				<h1 style="color: #5e9ca0;">Welcome to <span style="color: #2b2301;">cstheories.com</span></h1>
				<p>
					<span style="color:#008000;"><span style="font-family:comic sans ms,cursive;"><span style="font-size:18px;"><strong>This section describes about Analytics, Machine learning and Statistics</strong></span></span></span></p>
				<p>
					<strong><span style="color:#006400;"><span style="font-size:36px;"><span style="font-family:courier new,courier,monospace;">Analytics</span></span></span></strong></p>
				<p>
					&nbsp;</p>
				<p>
					<span style="font-size:18px;"><span style="font-family:courier new,courier,monospace;">Analytics is defined by the discovery, interpretation and communication of meaningful patterns in data set. There are extensive use of mathematics and statistics to get meaningful and valuable knowledge from data.</span></span></p>
				<p>
					<span style="font-family:courier new,courier,monospace;"><span style="font-size:18px;">This makes one mandatory to understand basics of statistics.&nbsp;</span></span></p>
				<p>
					&nbsp;</p>
				<p>
					<span style="font-family:courier new,courier,monospace;"><span style="font-size:18px;">While working at IBM, computer scientist Arthur Samual first used the term machine learning. He quoted, &quot;<strong>C<span style="background-color: rgb(255, 255, 255); color: rgb(84, 84, 84);">omputers the ability to learn without being explicitly programmed.</span></strong>&quot;</span></span></p>
				<p>
					<span style="font-size:18px;"><span style="font-family:courier new,courier,monospace;">Below are some example of analytics in field:</span></span></p>
				<ul>
					<li>
						<span style="font-size:18px;"><span style="font-family:courier new,courier,monospace;"><span class="mw-headline" id="Marketing_optimization">Marketing optimization</span></span></span></li>
					<li>
						<span style="font-size:18px;"><span style="font-family:courier new,courier,monospace;">People analytics</span></span></li>
					<li>
						<span style="font-size:18px;"><span style="font-family:courier new,courier,monospace;">Portfolio analytics</span></span></li>
					<li>
						<span style="font-size:18px;"><span style="font-family:courier new,courier,monospace;">Risk analytics</span></span></li>
					<li>
						<span style="font-size:18px;"><span style="font-family:courier new,courier,monospace;">Digital analytics</span></span></li>
					<li>
						<span style="font-size:18px;"><span style="font-family:courier new,courier,monospace;">Security analytics</span></span></li>
				</ul>
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
		<p>&copy; 2017 Debdipta Ghosh.  All rights reserved. | <a id="myLink" href="./privacy.html" target="_blank">Privacy Policy</a> | <a id="myLink" href="./contact.html" target="_blank">Contact us</a></p>
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
				<h1 style="color: #5e9ca0;">Welcome to <span style="color: #2b2301;">cstheories.com</span></h1>
				<p>
					<span style="color:#008000;"><span style="font-family:comic sans ms,cursive;"><span style="font-size:18px;"><strong>This section describes about Algorithms</strong></span></span></span></p>
				<p>
					<span style="color: rgb(51, 51, 51); font-family: &quot;courier new&quot;, courier, monospace; font-size: 18px; background-color: rgb(255, 255, 255);">Algorithms are back bone of computer science. </span></p>
				<p>
					<span style="color: rgb(51, 51, 51); font-family: &quot;courier new&quot;, courier, monospace; font-size: 18px; background-color: rgb(255, 255, 255);">In mathematics and Computer science, algorithms are problem solving operations. </span></p>
				<p>
					<span style="color: rgb(51, 51, 51); font-family: &quot;courier new&quot;, courier, monospace; font-size: 18px; background-color: rgb(255, 255, 255);">In this section, we have discussed a lot of algorithms using linked list, tree, array, hash table, stack, queue and more.</span></p>
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
		<p>&copy; 2017 Debdipta Ghosh.  All rights reserved. | <a id="myLink" href="./privacy.html" target="_blank">Privacy Policy</a> | <a id="myLink" href="./contact.html" target="_blank">Contact us</a></p>
	</footer>
</div>




<!--  
	<div class="tab-pane fade" id="ebooks">
		<div>
			<h1>ebooks</h1>
    		<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
    		<footer class="container-fluid text-center">
				<p>&copy; 2017 Debdipta Ghosh.  All rights reserved. | <a id="myLink" href="./privacy.html" target="_blank">Privacy Policy</a> | <a id="myLink" href="./contact.html" target="_blank">Contact us</a></p>
			</footer>
		</div>
  	</div>
-->





  <div class="tab-pane fade" id="about">
  	<div>
    	<p>
			<span style="color:#006400;"><span style="font-size:36px;"><strong><span style="font-family:courier new,courier,monospace;">About cstheories.com</span></strong></span></span></p>
		<p>
			&nbsp;</p>
		<p>
			<span style="font-size:18px;"><span style="font-family:courier new,courier,monospace;">This website covers programming language like C++ and Python from very basic. </span></span></p>
		<p>
			<span style="font-size:18px;"><span style="font-family:courier new,courier,monospace;">Advance topics like how we should design our code is discussed in section &quot;Design pattern&quot;.</span></span></p>
		<p>
			<span style="font-size:18px;"><span style="font-family:courier new,courier,monospace;">There is an section &quot;Computer Science Concepts&quot;. There different advance topics are discussed related to Computer.</span></span></p>
		<p>
			<span style="font-family:courier new,courier,monospace;"><span style="font-size:18px;">Algorithms are back bone of computer science. In mathematics and Computer science, algorithms are problem solving operations. In this section, we have discussed a lot of algorithms using linked list, tree, array, hash table, stack, queue and more.</span></span></p>
		<p>
			<strong><span style="font-family:courier new,courier,monospace;"><span style="font-size:18px;">&quot;Data, Data, Data...and it&#39;s everywhere&quot; - </span></span></strong><span style="font-family:courier new,courier,monospace;"><span style="font-size:18px;">This</span></span><strong><span style="font-family:courier new,courier,monospace;"><span style="font-size:18px;">&nbsp;</span></span></strong><span style="font-family:courier new,courier,monospace;"><span style="font-size:18px;">leads us writing this section of Analytics.&nbsp;</span></span></p>
	</div>      		
      		<footer class="container-fluid text-center">
				<p>&copy; 2017 Debdipta Ghosh.  All rights reserved. | <a id="myLink" href="./privacy.html" target="_blank">Privacy Policy</a> | <a id="myLink" href="./contact.html" target="_blank">Contact us</a></p>
			</footer>
  </div>

</div>
</body>
</html>