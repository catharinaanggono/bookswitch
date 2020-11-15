<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Courgette|Open+Sans&display=swap" rel="stylesheet"> 
	<script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>

</head>

<style>
	.panel{
		border:0;
		background: #B5C587 ;
		text-align:center;
		padding-top:50px;
	}

	body {
		background-size: cover;
		background-repeat:no-repeat;
		background-attachment:fixed;
	}

	@media only screen and (min-device-width: 500px) {
    body { 
    	margin:0;
		padding:0; 
		background-color: whitesmoke;
		background-size: cover;
		background-repeat:no-repeat;
		background-attachment:fixed;
		font-family:sans-serif;
    	}
	}

	body {
		margin:0;
		padding:0;
		overflow:hidden;
		background-color:black;
    }

	section{
		height:100%;
		width:100%;
		position:absolute ;  background:radial-gradient(#333,#000);
	}

	.leaf{
		position:absolute ;
		width:100%;
		height:100%;
		top:0;
		left:0;
	}

	.leaf div{
		position:absolute ;
		display:block ;
	}

	.leaf div:nth-child(1){
		left:20%; 
		animation:fall 15s linear infinite ;
		animation-delay:-2s;
	}

	.leaf div:nth-child(2){
		left:70%; 
		animation:fall 15s linear infinite ;
		animation-delay:-4s;
	}

	.leaf div:nth-child(3){
		left:10%; 
		animation:fall 20s linear infinite ;
		animation-delay:-7s;
	}

	.leaf div:nth-child(4){
		left:50%; 
		animation:fall 18s linear infinite ; 
		animation-delay:-5s;
	}

	.leaf div:nth-child(5){
		left:85%; 
		animation:fall 14s linear infinite ;
		animation-delay:-5s;
	}

	.leaf div:nth-child(6){
		left:15%; 
		animation:fall 16s linear infinite ;
		animation-delay:-10s;
	}

	.leaf div:nth-child(7){
		left:90%; 
		animation:fall 15s linear infinite ;
		animation-delay:-4s;
	}

	@keyframes fall{
		0%{
		opacity:1;
		top:-10%;
		transform:translateX (20px) rotate(0deg);
		}
		20%{
		opacity:0.8;
		transform:translateX (-20px) rotate(45deg);
		}
		40%{

		transform:translateX (-20px) rotate(90deg);
		}
		60%{

		transform:translateX (-20px) rotate(135deg); 
		}
		80%{

		transform:translateX (-20px) rotate(180deg);
		}
		100%{

		top:110%;
		transform:translateX (-20px) rotate(225deg);
		}
	}
	
	.leaf1{
		transform: rotateX(180deg);
	}

	h2{
		position:absolute ;
		top:40%;
		width:100%;
		font-family: 'Courgette', cursive;
		font-size:4em;
		text-align:center;
		transform:translate ;
		color:#fff;
		transform:translateY (-50%);
	}

	.container {
		width: 50%;
		height: 50%;
		position: absolute;
		top:0;
		bottom: 0;
		left: 0;
		right: 0;
		margin: auto;
		
	}

	#submitButton:hover
	{
		background-color: #A94241;
		border-color: white;
		color: white;
		border-color: #A94241;
	}

	button
	{
		border-color: white;
		background-color: #0D3D54;
		border-color: #0D3D54;
		color: white;
		text-align: center;
		height: 30px;
		width: 5px;
	}

	button {
            font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, 
            "Helvetica Neue", Arial, sans-serif, 
            "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            width: 50px;
            height: 50px;
    }

	.enlarge {
		font-size: 30px;
		color: #A94241; 
	}

	.backButton {
		background-color: Transparent;
		margin-left: -85%;
		margin-top: -90%;
		border: none;
	}

</style>

<body>

	<div class="leaf">
				<div><img src="../images/Fall-Autumn-Leaves-Transparent-PNG.png" height="75px" width="75px"></img></div>
				<div><img src="../images/Autumn-Fall-Leaves-Pictures-Collage-PNG.png" height="75px" width="75px"></img></div>
				<div><img src="../images/Autumn-Fall-Leaves-Clip-Art-PNG.png" height="75px" width="75px" ></img></div>
				<div><img  src="../images/Green-Leaves-PNG-File.png" height="75px" width="75px"></img></div>
				<div><img src="../images/Transparent-Autumn-Leaves-Falling-PNG.png" height="75px" width="75px"></img></div>
				<div><img src="../images/Realistic-Autumn-Fall-Leaves-PNG.png" height="75px" width="75px"></div>
				<div><img src="../images/autumn_leaves.png" height="75px" width="75px"></div>
						
				</div>
              
				<div class="leaf leaf1">
				<div>  <img src="../images/Fall-Autumn-Leaves-Transparent-PNG.png" height="75px" width="75px"></img></div>
				<div><img src="../images/Autumn-Fall-Leaves-Pictures-Collage-PNG.png" height="75px" width="75px"></img></div>
				<div>  <img src="../images/Autumn-Fall-Leaves-Clip-Art-PNG.png" height="75px" width="75px" ></img></div>
				<div><img  src="../images/Green-Leaves-PNG-File.png" height="75px" width="75px"></img></div>
				<div> <img src="../images/Transparent-Autumn-Leaves-Falling-PNG.png" height="75px" width="75px"></img></div>
				<div>   <img src="../images/Realistic-Autumn-Fall-Leaves-PNG.png" height="75px" width="75px"></div>
				<div><img src="../images/autumn_leaves.png" height="75px" width="75px"></div>
                     
				</div>

				<div class="leaf leaf2">
				<div>  <img src="../images/Fall-Autumn-Leaves-Transparent-PNG.png" height="75px" width="75px"></img></div>
				<div><img src="../images/Autumn-Fall-Leaves-Pictures-Collage-PNG.png" height="75px" width="75px"></img></div>
				<div>  <img src="../images/Autumn-Fall-Leaves-Clip-Art-PNG.png" height="75px" width="75px" ></img></div>
				<div><img  src="../images/Green-Leaves-PNG-File.png" height="75px" width="75px"></img></div>

				<div> <img src="../images/Transparent-Autumn-Leaves-Falling-PNG.png" height="75px" width="75px"></img></div>
				<div>   <img src="../images/Realistic-Autumn-Fall-Leaves-PNG.png" height="75px" width="75px"></div>
				<div><img src="../images/autumn_leaves.png" height="75px" width="75px"></div>
    </div>

	<!-- Display of Navbar -->
    <div class="bgded overlay" id="example"> 
	<div class="container">
	<div class="row">
	<div class="panel">	
	<button class=" black-background white chevron-left backButton" style = "left: 20px;" onclick="history.go(-1);"><i class="fas fa-chevron-left enlarge"></i></button>
    <br>
	<img src="../images/bookswitch.svg" alt="" style = "width: 70%;position:relative;" />
	<div class="panel-body">
	
	<!-- Login Form : Retrieve the login email and password -->
	<form method="post" action = "loginprocess.php">		
		
		<!-- Userid field -->
		<div class="form-group input-group">
		<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
		<input type="text" class="form-control" name="userid" placeholder="Username" required> 
		</div>

		
		<!-- Password field -->
		<div class="form-group input-group">
		<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
		<input type="password" class="form-control" name="password" placeholder="Password" required>
		</div>
		
		
		<?php

			if (isset($_GET["e"])) {
				if (($_GET["e"]) == "unf") {
					echo"<font color='red'>User not found</font>";
					echo "<br>";
					echo "<font color='red'>Please try again</font>";
				} else { 
					echo "<font color='red'>Incorrect Password</font>";
					echo "<br>";
					echo "<font color='red'>Please try again</font>";
				}
				echo "<br><br>";
			}

		?>

		<!-- Login button -->
		<div class="form-group">
		<button style = "width: 50%;position:relative;border-radius:5px;" id = "submitButton" name="submit">Log In</button>
		</div>

	</form>
	</div>
	</div>
	</div>
	</div>
	</div>	 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>