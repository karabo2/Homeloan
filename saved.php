<!DOCTYPE html>
<html lang="en">
<head>
	<title>Navigation Bar</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/home.css">
	<script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
	</script>

	<script src=
"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
	</script>

	<script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
	</script>

</head>

<body>
	<div class="">
    <nav class="navbar navbar-expand-sm bg-success navbar-light">

      <!-- Brand/logo -->
			<a class="navbar-brand" href="index.html">
				<img src="logo/calculator.png" alt="logo" style="width:40px; display: inline-block">
				<h6 style="display: inline-block;"><strong> Home Loan Calculator</strong></h6>
			</a>


      <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#collapse_Navbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="collapse_Navbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Calculator</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="saved.php">Saved Calculations</a>
          </li>
        </ul>
      </div>
    </nav>
</div>

	<div class="container">
		<h2>Saved Loads</h2>
		<p>Load will be displayed on the table below, Click on the row to for more infor about the loan.</p>
		<?php

		// Create connection
		$conn = new mysqli('localhost', 'id11666997_root','laon#2','id11666997_lifecheqhomeloan');
		// Check connection
		if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT * FROM loan";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
				echo "<table id='customers' ><tr><th>Name</th><th>Purchase Price</th><th>Total loan Payment</th></tr>";
				while($row = mysqli_fetch_assoc($result)) {
					$name=$row['name'];$purchase= $row['purchase'];
					$deposit= $row['deposit']; $years=$row['years'];
					$rate =$row['rate'];$monthlypay= $row['monthlypay'];
					$interestpay=$row['interestpay'];$totalpay= $row['totalpay'];
					echo "<tr onClick='tablegraph($purchase,$deposit,$years,$rate,$monthlypay,$interestpay,$totalpay)'><td>" . $row["name"]. "</td><td>" . $row["purchase"]. "</td><td>" . $row["totalpay"]. "</td></tr>";
				}
				echo "</table>";
		} else {
				echo "0 results";
		}

		mysqli_close($conn);
		?>
		<hr class="new">
    </div>
		<div class="results" >
			<h2 id='title' style="color: #ffffff;"></h2>
			<div class="output">

				<h5 id='purchase'></h5>
				<h5 id='deposit'></h5>
				<h5 id='years'></h5>
				<h5 id='fixedrate'></h5>
				<h5 ><strong id="Payment" ></strong></h5>
				<h5 id="interest" ></h4>
				<h5 id="total" ></h4>
			</div>
			<div id='table'>
			</div>

			<div id="chartContainer"  style=" margin-top:30px;margin-bottom: 20px;height: auto; width: auto;"></div>
		</div>

	</div>

  <script type="text/javascript"src="scr/homecalculator.js" ></script>
	<script type="text/javascript">
		function tablegraph(purchase,deposit,years,rate,monthlypay,interestpay,totalpay){
			document.getElementById("title").innerHTML ='Result of the table you clicked';
			document.getElementById("purchase").innerHTML= "Purchase Price: R"+purchase.toString();
			document.getElementById("deposit").innerHTML= "Deposit: R"+deposit.toString();
			document.getElementById("years").innerHTML= "Years: "+years.toString();
			document.getElementById("fixedrate").innerHTML= "Fixed Rate: "+((rate*100).toFixed(2)).toString()+"%";

			document.getElementById("Payment").innerHTML = "Monthly Payment: R"+monthlypay.toString()+"pm";
			document.getElementById("interest").innerHTML= "Total Interest: R"+interestpay.toString();
			document.getElementById("total").innerHTML= "Total Amount: R"+totalpay.toString();
			purchase-=deposit;
			monthlypay=parseFloat(monthlypay);
			var interestPay=0;
		  var capitalPay=0;
		  //var rate=(1+interestRate/years)-1;
		  //deliting table if their was one
		  var tbl = document.getElementById('customer');
		  if(tbl) tbl.parentNode.removeChild(tbl);
		  //creating table
		  var div= document.getElementById("table");
		  var table = document.createElement("table");
		  table.setAttribute("id", "customer");
		  var row = table.insertRow(0);
		  var th1 = document.createElement("th");
		  var th2 = document.createElement("th");
		  var th3 = document.createElement("th");
		  th1.innerHTML='Year';
		  th2.innerHTML = 'Interest %';
		  th3.innerHTML = 'Capital %';
		  row.appendChild(th1);
		  row.appendChild(th2);
		  row.appendChild(th3);
		  var cell1 = null;
		  var cell2 = null;
		  var cell3 = null;
		  
		  inteY=[];
		  capY=[];
		  //intrest rate and capital rate on table
		  for (i=1; i <= years; i++){

		    row = table.insertRow(i);
		    interestPay=purchase*rate;
		    interestPay=(rate)*purchase;
		    capitalPay=monthlypay*12-interestPay;
		    purchase=purchase-(monthlypay*12-interestPay);
		    cell1 = row.insertCell(0);
		    cell2 = row.insertCell(1);
		    cell3 = row.insertCell(2);
		    cell1.innerHTML = i;
		    cell2.innerHTML = ((interestPay*100)/(monthlypay*12)).toFixed(0);
		    cell3.innerHTML = ((capitalPay*100)/(monthlypay*12)).toFixed(0);
		    inteY.push({ y: parseInt(((interestPay*100)/(monthlypay*12)).toFixed(0)), label: i.toString() });
		    capY.push({ y: parseInt(((capitalPay*100)/(monthlypay*12)).toFixed(0)), label: i.toString() });

		  }
		  div.appendChild(table);
			graph();
		}
		function graph(){
		  var chart = new CanvasJS.Chart("chartContainer", {
		  animationEnabled: true,
		  title:{
		    text: "Interest% vs Capital%"
		  },
		  axisY: {
		    title: "%"
		  },
		  legend: {
		    cursor:"pointer",
		    itemclick : toggleDataSeries
		  },
		  toolTip: {
		    shared: true,
		    content: toolTipFormatter
		  },
		  data: [{
		    type: "bar",
		    showInLegend: true,
		    name: "Interest%",
		    color: "gold",
		    dataPoints:inteY

		  },
		  {
		    type: "bar",
		    showInLegend: true,
		    name: "Capital%",
		    color: "silver",
		    dataPoints: capY
		  }]
		  });
		  chart.render();

		  function toolTipFormatter(e) {
		  var str = "";
		  var total = 0 ;
		  var str3;
		  var str2 ;
		  for (var i = 0; i < e.entries.length; i++){
		    var str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\">" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
		    total = e.entries[i].dataPoint.y + total;
		    str = str.concat(str1);
		  }
		  str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
		  str3 = "<span style = \"color:Tomato\">Total: </span><strong>" + total + "</strong><br/>";
		  return (str2.concat(str)).concat(str3);
		  }

		  function toggleDataSeries(e) {
		  if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		    e.dataSeries.visible = false;
		  }
		  else {
		    e.dataSeries.visible = true;
		  }
		  chart.render();
		  }
		}

	</script>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>



</body>

</html>
