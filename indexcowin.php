<?php
session_start();
if(isset($_SESSION['pincode'])){
    unset($_SESSION['pincode']);
}
if(isset($_SESSION['date'])){
    unset($_SESSION['date']);
}
if(isset($_SESSION['dose'])){
    unset($_SESSION['dose']);
}
if(isset($_SESSION['vaccine'])){
    unset($_SESSION['vaccine']);
}
if(isset($_SESSION['age'])){
    unset($_SESSION['age']);
}
if(isset($_POST['submit'])){
    if(isset($_POST['pincode'])&&isset($_POST['date'])){
        $_SESSION['pincode']=$_POST['pincode'];
        $_SESSION['date']=$_POST['date'];
        if(isset($_POST['dose'])){
            $_SESSION['dose']=$_POST['dose'];
        }
        if(isset($_POST['vaccine'])){
            $_SESSION['vaccine']=$_POST['vaccine'];
        }
        if(isset($_POST['age'])){
            $_SESSION['age']=$_POST['age'];
        }
        header("Location:cowin.php");
    }
}
if(isset($_POST['submitbyd'])){
    if(isset($_POST['districts'])&&isset($_POST['date'])){
        $_SESSION['districts']=$_POST['districts'];
        $_SESSION['date']=$_POST['date'];
        if(isset($_POST['dose'])){
            $_SESSION['dose']=$_POST['dose'];}
        if(isset($_POST['vaccine'])){
            $_SESSION['vaccine']=$_POST['vaccine'];}
        if(isset($_POST['age'])){
            $_SESSION['age']=$_POST['age'];}
        header("Location:cowin2.php");
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="cowin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <header>
        <h1 id="header">Covid Vaccine Tracker</h1>
    </header>
    <div class="toggle">
        <button id="ByPin" class="button" type="button" onclick="bypin(this)">Search By Pin</button>
        <button id="ByDistrict"  class="button" type="button" onclick="bydis(this)">Search By District</button>
    </div>
    <div class="container mt-5" id="c1">
        <form  method="POST">
            <div class="row">
                <div class="col-xl-6 m-auto">
                    <div class="card shadow">
                        <div class="card-header">
                            <h2 class="card-title font-weight-bold">Search Slots by Pincode</h2>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="pincode">Pincode:</label>
                                <input type="text" name="pincode" class="form-control" placeholder="Enter Your 6 digit pincode" required/>
                            </div>
                            <div class="form-group">
                                <label for="date">Date:</label>
                                <input type="text" name="date" class="form-control"  placeholder="Date must be in this format dd-mm-yyyy" required />
                            </div>
                            <div class="form-group">
                                <label for="dose">Dose:</label>
                                <select name="dose" class="form-control" id="dose" placeholder="Select Either 1 or 2">
                                    <option selected disabled hidden>Select Dose</option>
                                    <option value="1">First</option>
                                    <option value="2">Second</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="vaccine">Vaccine:</label>
                                <select name="vaccine" class="form-control" id="vaccine" placeholder="Select the vaccine from below">
                                    <option selected disabled hidden>Select Vaccine</option>
                                    <option value="COVAXIN">Covaxin</option>
                                    <option value="COVISHIELD">Covishield</option>
                                    <option value="Sputnik V">Sputnik V</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="age">Age:</label>
                                <select name="age" class="form-control" placeholder="Enter Your Age" >
                                    <option selected disabled hidden>Select Age Group</options>
                                    <option value="18">18-44</option>
                                    <option value="45">45+</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" name="submit" class="btn btn-success" value="Check Slot">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <div class="container mt-5" id="c2">
        <form  method="POST">
            <div class="row">
                <div class="col-xl-6 m-auto">
                    <div class="card shadow">
                        <div class="card-header">
                            <h2 class="card-title font-weight-bold">Search Slots by District</h2>
                        </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="states">Choose Your State and District:</label>
                            <select name="states" id="states" class="form-control" oninput="selectdistrict()" required >
                            </select><br>
                            <select name="districts" class="form-control" id="districts" required >
                                <option selected disabled hidden>Districts</options>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="text" name="date" class="form-control"  placeholder="Date must be in this format dd-mm-yyyy" required />
                        </div>
                        <div class="form-group">
                            <label for="dose">Dose:</label>
                            <select name="dose" class="form-control" id="dose" placeholder="Select Either 1 or 2">
                                <option selected disabled hidden>Select Dose</options>
                                <option value="1">First</option>
                                <option value="2">Second</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="vaccine">Vaccine:</label>
                            <select name="vaccine" class="form-control" id="vaccine" placeholder="Select the vaccine from below">
                                <option selected disabled hidden>Select Vaccine</options>
                                <option value="COVAXIN">Covaxin</option>
                                <option value="COVISHIELD">Covishield</option>
                                <option value="Sputnik V">Sputnik V</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="age">Age:</label>
                            <select name="age" class="form-control" placeholder="Enter Your Age" >
                                <option selected disabled hidden>Select Age Group</options>
                                <option value="18">18-44</option>
                                <option value="45">45+</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                          <input type="submit" name="submitbyd" class="btn btn-success" value="Check Slot">
                      </div>
                  </div>
              </div>
          </div>
      </form>
  </div>

    <script>
        $.ajax({
                url: "https://cdn-api.co-vin.in/api/v2/admin/location/states",
                type: "GET",
                dataType: 'json',
                ContentType: 'application/json',
                success: function(data) {
                    let tab='<option value="" selected disabled hidden>States</options>';
                    for (let r of data.states) {
                        tab+='<option value="'+r.state_id+'">'+r.state_name+'</option>';
                    }
                    document.getElementById("states").innerHTML = tab;
                }
             });

        function selectdistrict(){
            var x=document.getElementById("states").value;
            $.ajax({
                    url: "https://cdn-api.co-vin.in/api/v2/admin/location/districts/"+x,
                    type: "GET",
                    dataType: 'json',
                    ContentType: 'application/json',
                    success: function(data) {
                        let tab='<option value="" selected disabled hidden>Districts</options>';
                        for (let r of data.districts) {
                            tab+='<option value="'+r.district_id+'">'+r.district_name+'</option>';
                        }
                    document.getElementById("districts").innerHTML = tab;
                    }
               });
          }
        function bypin(){
            document.getElementById('footer').style.position="relative";
            document.getElementById("c1").style.display="block";
            document.getElementById("c2").style.display="none";
        }
        function bydis(){
            document.getElementById('footer').style.position="relative";
            document.getElementById("c2").style.display="block";
            document.getElementById("c1").style.display="none";
        }
    </script>
    <footer id="footer">
        <p>Designed and Developed for Covid Vaccine Tracker &copy 2021 Harsh Gautam</p>
    </footer>
</body>
</html>
