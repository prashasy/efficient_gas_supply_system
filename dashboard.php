<?php
?>
<html>
<head>
	<title>Dashboard</title>
	</head>
	<body>

		<script type="text/javascript">
		function load_gas()
		{
			var credit=document.getElementById("money-display").value;
			var rate=400;
			if(credit<=0)
			{
				document.getElementById("Load_Message").innerHTML="You do not have enough credits. Please load money in wallet";
				return;
			}
			var gas_total=document.getElementById("gas-display").value+credit/rate;
			var reserved=0.2*gas_total;
			var gas=gas_total-reserved;

			document.getElementById("Load_Message").innerHTML="You have successfully loaded: "+gas_total;
			document.getElementById("gas-display").value=gas;
			document.getElementById("reserved_gas-display").value=reserved;
			document.getElementById("money-display").value=document.getElementById("money-display").value-credit;
			
		}

		function perform_usage()
		{
			var gas=document.getElementById("gas-display").value;
			var reserved=document.getElementById("reserved_gas-display").value;
			if(gas==0)
			{
				document.getElementById("status_message").innerHTML="You have exhausted your mains supply.\nSwitching to reserved supply";
				if(reserved==0)
				{
					document.getElementById("status_message").innerHTML="You have exhausted all your supply. Please recharge to continue usage";
					return
				}
				else 
				{
					document.getElementById("reserved_gas-display").value=reserved-10;
					return;
				}

			}
			else
			{
				if(gas<=20)
				{
					document.getElementById("status_message").innerHTML="You are about to finish your mains supply. Please reduce consumption";
				}
				document.getElementById("gas-display").value=gas-10;

			}



		}



		</script>



		<?php
		session_start(); //session starts
		if(isset($_SESSION['login']))
		{	
			$user=$_SESSION['login_user'];

			echo "<h1>Welcome  $user </h1>"; //Personalised welcome address
			echo "<a href=logout.php>Logout</a>"; //Logout Button
			?>
			<br>
			<label id="money-label"> Money Credits </label>
			<input id="money-display" type="number" min="0">
			<input type="button" onclick="load_gas()" value="Load Gas">
			<p id="Load_Message"></p>
			<label id="gas-label"> Gas Credits </label>
			<input id="gas-display" type="number" min="0" readonly>
			<label id="reserved_gas-label"> Reserved Gas Credits </label>
			<input id="reserved_gas-display" type="number" min="0" readonly>
			<br>
			<p id="status_message"></p>



			



			<?php
		}
		else
		{
			header("location: index.php");//redirection to home-page
		}
		?>
	</body>
</html>