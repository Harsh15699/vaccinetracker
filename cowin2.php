<?php
session_start();
header("Refresh:60");
?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>// api url
var a =Number("<?php echo($_SESSION['districts'])?>");
var b ="<?php echo($_SESSION['date'])?>";
var c ="<?php if(isset($_SESSION['dose'])){echo($_SESSION['dose']);}?>";
var d ="<?php if(isset($_SESSION['vaccine'])){echo($_SESSION['vaccine']);}?>";
var e ="<?php if(isset($_SESSION['age'])){echo($_SESSION['age']);}?>";
//let url = 'https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/findByPin?pincode='+a+'&date='+b;
let url='https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/findByDistrict?district_id='+a+'&date='+b;


fetch(url)
.then(res => res.json())
.then((out) => {
  show(out);
})
.catch(err => { throw err });

function show(out) {
	let tab =
		`<tr class="thead-light">
		<th>Name Of Center</th>
    <th>Pincode</th>
		<th>No Of Slots Available</th>
    <th>No Of Slots Available Dose 2</th>
		<th>Age Limit</th>
		<th>Vaccine Name</th>
		</tr>`;

	// Loop to access all rows
	for (let r of out.sessions) {
    if(r.vaccine!=d && d!=""){
      continue;}
    if(c==2&&r.available_capacity_dose2==0){

      continue;
    }
    if(c==1&&r.available_capacity_dose1==0){

      continue;
    }
    if(r.min_age_limit>e && e!=""){
      continue;
    }
		tab += `<tr>
	<td>${r.name} </td>
  <td>${r.pincode}</td>
	<td>${r.available_capacity_dose1}</td>
  <td>${r.available_capacity_dose2}</td>
	<td>${r.min_age_limit}</td>
	<td>${r.vaccine}</td>
</tr>`;
}
	// Setting innerHTML as tab variable
	document.getElementById("vaccine").innerHTML = tab;
  var rowCount = $("#vaccine tr").length;
  if(rowCount>8){
    document.getElementById('footer').style.position="relative";
  }
  if(rowCount<=1){
    document.getElementById("warning").innerHTML="Currently there are no slots available in your given district with your preferred choice";}
 else if(rowCount!=sessionStorage.getItem("number")){
  sessionStorage.setItem("number", rowCount);
   var mp3 = '<source src="believer.mp3" type="audio/mpeg">';
  document.getElementById('audio').innerHTML="<audio autoplay loop>"+mp3+
  "</audio>";
              //alert(sessionStorage.getItem("number"));
}

}
</script>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="cowin.css">
  </head>
  <body>
    <header>
      <h1 id="header">Covid Vaccine Tracker</h1>
    </header>
    <table id="vaccine" class="table"></table>
    <h2 id="warning" style="color:red"></h2>
    <div id="audio"></div>
    <a href="./indexcowin.php">
    <button id="goback" type="button">Go To Home Page</button></a>
    <footer id="footer">
      <p>Designed and Developed for Covid Vaccine Tracker &copy 2021 Harsh Gautam</p>
    </footer>
  </body>
</html>
