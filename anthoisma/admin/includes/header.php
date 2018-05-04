<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $titre;?></title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
		<meta name="description" content="Gestion de contacts"/>

		<link rel="stylesheet" 
		      href="bootstrap/css/bootstrap.min.css" 
			  media="screen">
			  
		<link href="bootstrap/css/manager.css" rel="stylesheet" media="screen"/>
		<script src="js/bibliojs.js"></script>
	</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top menu">
		<div class="container-fluid">
			<div class="navbar-header">
			  <button class="navbar-toggle" data-toggle="collapse" 
			          data-target=".navHeaderCollapse">
					<span class="icon-bar"></span> 
			  </button>
			  <a class="navbar-brand" href="list.php">
				<span class="navbar-logo ">
					<img src="images/logo.png" class ="imgcongo" width="100%">
				</span>
			  </a>
			</div>

			<div>  
			  <ul class="nav navbar-nav collapse navbar-collapse n
			           avHeaderCollapse navbar-right ">
				<li><a class="lien" href="list.php">ALIMENTS</a></li>
				<li><a class="lien" href="user.php">UTILISATEURS</a></li>
				<li><a class="lien" href="logout.php">DECONNEXION</a></li>
			  </ul>
			</div>
		</div>
    </nav>