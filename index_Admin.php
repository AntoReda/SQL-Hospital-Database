<!DOCTYPE HTML>

<!--
	Hyperspace by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>



	<head>
	
		<title> SQL Admin Website</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		
	
	</head>
	<body class>

<!--injecting Javascript-->
<script>
	//prevents the page from reloading after button press.
	// document.getElementById('form').addEventListener('submit', function(event) {
	// event.preventDefault()});

	//SEND SUNDAY EMAILS
	const d = new Date();
	let day = d.getDay();
	if(day == 0){
		sendEmails(); 
	}

	function addEntry(rowName){
		//displays the entry when you click on Add Entry button.
		const newEntry=document.querySelectorAll('[id='+rowName+']');
		for (var i = 0; i < newEntry.length; i++) 
		{
			newEntry[i].style="display:;"
		}
	}
	
	function cancel(rowName){
		//cancels the add entry row.
		const addEntryRow=document.querySelectorAll('[id='+rowName+']');
		for (var i = 0; i < addEntryRow.length; i++) 
		{
			addEntryRow[i].style="display:none;"
		}

		
	}

	function editEntry(rowName)
	{
		const newEntry=document.querySelectorAll('[id='+rowName+']');
		for (var i = 0; i < newEntry.length; i++) 
		{
			newEntry[i].style="display:;"
		}
	}

	function cancelEdit(rowName){
		const editEntryRow=document.querySelectorAll('[id='+rowName+']');
		for (var i = 0; i < editEntryRow.length; i++) 
		{
			editEntryRow[i].style="display:none;"
		}
	}
	function editMode(show, hide){

		const editBtn=document.querySelectorAll('[id='+show+']');
		const cancelBtn=document.querySelectorAll('[id='+hide+']');
		
		
		
		for (var i = 0; i < editBtn.length; i++) 
		{
			editBtn[i].style="display:none; "

		}
		for (var i = 0; i < cancelBtn.length; i++) 
		{
			cancelBtn[i].style="display:;"
			

		}
		
		
		
	}
	function unEditMode(show, hide){
		
		const showBtn=document.querySelectorAll('[id='+show+']');
		const hideyBtn=document.querySelectorAll('[id='+hide+']');

		
		

		for (var i = 0; i < showBtn.length; i++) 
		{
			showBtn[i].style="display:;"

		}
		
		for (var i = 0; i < hideyBtn.length; i++) 
		{
			hideyBtn[i].style="display:none;"

		}

		
		// Disable the form submission button after the form is submitted
document.querySelector('form').addEventListener('submit', function(event) {
    event.target.querySelector('button[type="submit"]').disabled = true;
});
	}

	

	
</script>
		

		<!-- Sidebar -->
			<section id="sidebar">
				<div class="inner">
					<nav>
						<ul>
							<li><a href="#intro">Welcome</a></li>
							<li><a href="#one">Employee</a></li>
							<li><a href="#two">Facility</a></li>
							<li><a href="#three">FacilityType</a></li>
							<li><a href="#four">EmployeeRole</a></li>
							<li><a href="#five">EmployedHistory</a></li>
							<li><a href="#six">Vaccination</a></li>
							<li><a href="#seven">WasVaccinated</a></li>
							<li><a href="#eight">Infection</a></li>
							<li><a href="#nine">WasInfected</a></li>
							<li><a href="#ten">EmployeeSchdule</a></li>
							
							<li><a href="#eleven">Back Home</a></li>
						</ul>
					</nav>
				</div>
			</section>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Intro -->
					<section id="intro" class="wrapper style1 fullscreen fade-up">
						<div class="inner">
						<?php 
							if (isset($_GET['error'])) {
								$error = $_GET['error'];
								echo "<h1 style='color:red; text-shadow: 2px 2px 4px navy; margin-top:1%;'>Error: $error</h1>";
							} 
						?>
						
							<h1>Welcome to the Admin Page</h1>
                            <h2>Here you can add, delete and edit the database</h2>
							
						</div>
					</section>
        
       
						
					
					<?php
					
						
						//editing array
						$edit[1] = "editEmp";
						$edit[2] = "editFacility";
						$edit[6] = "editVax";
						$edit[7] = "editWasVax";
						$edit[8] = "editInfection";
						$edit[9] = "editWasInfect";
						$edit[10] = "editSchedule";

						//adding array
						$add[1] = "addEmp";
						$add[2] = "addFacility";
						$add[6] = "addVax";
						$add[7] = "addWasVax";
						$add[8] = "addInfection";
						$add[9] = "addWasInfect";
						$add[10] = "addSchedule";

						//deleting submit array
						$deleteSubmit[1] = "deleteEmp";
						$deleteSubmit[2] = "deleteFacility";
						$deleteSubmit[6] = "deleteVax";
						$deleteSubmit[7] = "deleteWasVax";
						$deleteSubmit[8] = "deleteInfection";
						$deleteSubmit[9] = "deleteWasInfect";
						$deleteSubmit[10] = "deleteSchedule";

						//editing submit array
						$editSubmit[1] = "editSubmitEmp";
						$editSubmit[2] = "editSubmitFacility";
						$editSubmit[6] = "editSubmitVax";
						$editSubmit[7] = "editSubmitWasVax";
						$editSubmit[8] = "editSubmitInfection";
						$editSubmit[9] = "editSubmitWasInfect";
						$editSubmit[10] = "editSubmitSchedule";


						//show array
						$show[1] = "showThis1";
						$show[2] = "showThis2";
						$show[3] = "showThis3";
						$show[4] = "showThis4";
						$show[5] = "showThis5";
						$show[6] = "showThis6";
						$show[7] = "showThis7";
						$show[8] = "showThis8";
						$show[9] = "showThis9";
						$show[10] = "showThis10";

						//hide array
						$hide[0] = "hideThis0";
						$hide[1] = "hideThis1";
						$hide[2] = "hideThis2";
						$hide[3] = "hideThis3";
						$hide[4] = "hideThis4";
						$hide[5] = "hideThis5";
						$hide[6] = "hideThis6";
						$hide[7] = "hideThis7";
						$hide[8] = "hideThis8";
						$hide[9] = "hideThis9";
						$hide[10] = "hideThis10";
						
						//variable we use to reference the index in loops
						$index=0;
					?>
					
				<!-- One -->
				<section id="one" class="wrapper style3 fade-up">
					<div class="inner">
						<h2>Employee</h2>
					
						<?php
						
						$con=mysqli_connect("localhost","root","","database1");
						// Check connection
						if (mysqli_connect_errno())
						{
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}
			
						$result = mysqli_query($con,"SELECT * FROM Employee");
			
						echo "<table border='1'>
						<tr>
                        
                        <th>ID </th>
						<th>First Name</th>
						<th>Last Name</th>
                        <th>Date Of Birth</th>
                        <th>Citizenship</th>
                        <th>Email</th>
                        <th>Postal Code</th>
						<th>Address</th>
						<th>Phone</th>
						<th>Medicare</th>    
                        <th>Province</th>
                        <th>City</th>
                        
                        
                       
						<th id='" .$hide[1] ."' style='display:none;'>Edit</th>
						<th id='" .$hide[1] ."' style='display:none;'>Delete</th>
						</tr>";
			
						while($row = mysqli_fetch_array($result))
						{
						echo "<tr>";
                        echo "<td> " . $row['id'] . "</td>";
						echo "<td>" . $row['first_name'] . "</td>";
						echo "<td>" . $row['last_name'] . "</td>";
                        echo "<td>" . $row['dob'] . "</td>";
                        echo "<td>" . $row['citizenship'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['postal_code'] . "</td>";
						echo "<td>" . $row['address'] . "</td>";
						echo "<td>" . $row['phone'] . "</td>";
						echo "<td>" . $row['medicare'] . "</td>";
                        echo "<td>" . $row['province'] . "</td>";
                        echo "<td>" . $row['city'] . "</td>";
                        
                        
                        
						
						$index++;
							echo "<form action='redirect.php' method='post'>";
							echo "<td id='" .$hide[1] ."' style='display:none;'> <button class='addEntry' id = 'editButtons' name='editsubmit0' onclick='editEntry(\"". $edit[1]. "". $index ."\")' name='editsubmit0". $index ."'  type='button'>Edit</button></td>";
							echo "<td id='" .$hide[1] ."' style='display:none;'> <button type='submit' class='addEntry'  id = 'deleteButtons' style= background-color:red;'  name='" .$deleteSubmit[1] . $index ."' >Delete</button></td>";
							echo "</form>";
							echo "</tr>";
						}

						echo "<button id='" .$show[1] ."' class='addEntry' onclick='editMode(\"" . $show[1] ."\",\"" . $hide[1] ."\")'>Edit</button>";
						echo "<button id='" .$hide[1] ."'class='cancelEntry' style='display:none; background-color:red;' onclick='unEditMode(\"" . $show[1] ."\",\"" . $hide[1] ."\")'>Cancel</button>";
						echo "<button id='" .$hide[1] ."' class='addEntry' onclick='addEntry(\"". $add[1]. "\")' style='display:none;'>Add Entry</button>";
						echo "</table>";


						//hidden form to add an entry (currently invisible)
						echo "<div id='" .$add[1] ."' style='display:none;'>";
						echo "<form action='redirect.php' method='post' id='form'>";
						echo" <label for=TestName></label><br>";
						echo "<input name='empId' type='text' placeholder='ID' >";
						echo "<input name='empFName' type='text' placeholder='First Name'>";
						echo "<input name='empLName' type='text' placeholder='Last Name'>";
						echo "<input name='empDob' type='text' placeholder='DOB'>";
						echo "<input name='empCitizenship' type='text' placeholder='Citizenship'>";
						echo "<input name='empEmail' type='text' placeholder='Email'>";
						echo "<input name='empPCode' type='text' placeholder='Postal Code'>";
						echo "<input name='empProvince' type='text' placeholder='Province'>";
						echo "<input name='empCity' type='text' placeholder='City'>";
						echo "<input name='empAddress' type='text' placeholder='Address'>";
						echo "<input name='empPhone' type='text' placeholder='Phone'>";
						echo "<input name='empMedicare' type='text' placeholder='Medicare'>";

						echo "<button class='addEntry' name='submit1' type='submit'>Submit</button>";
						echo "<button class='addEntry' style='background-color:red;' type='button' onclick='cancel(\"". $add[1]. "\")'>Cancel</button>";
						echo "</form>";
						echo "</div>";
						for($i=0; $i<$index; $i++)
						{
							//hidden form to edit an entry (currently invisible)
							echo "<div id='" . $edit[1] . ($i+1)  ."' style='display:none;'>";
							echo "<form action = 'redirect.php' method='post' id='editentryform'>";
							echo" <label for=editName></label><br>";

							echo "<input name='editEmpId' type='text' placeholder='Edit: ID' >";
							echo "<input name='editEmpFName' type='text' placeholder='Edit: First Name'>";
							echo "<input name='editEmpLName' type='text' placeholder='Edit: Last Name'>";
							echo "<input name='editEmpDob' type='text' placeholder='Edit: DOB'>";
							echo "<input name='editEmpCitizenship' type='text' placeholder='Edit: Citizenship'>";
							echo "<input name='editEmpEmail' type='text' placeholder='Edit: Email'>";
							echo "<input name='editEmpPCode' type='text' placeholder='Edit: Postal Code'>";
							echo "<input name='editEmpProvince' type='text' placeholder='Edit: Province'>";
							echo "<input name='editEmpCity' type='text' placeholder='Edit: City'>";
							echo "<input name='editEmpAddress' type='text' placeholder='Edit: Address'>";
							echo "<input name='editEmpPhone' type='text' placeholder='Edit: Phone'>";
							echo "<input name='editEmpMedicare' type='text' placeholder='Edit: Medicare'>";
							echo "<button class='addEntry' name='" . $editSubmit[1] . ($i+1)  ."' type='submit'>Confirm</button>";
							echo "<button class='addEntry' style='background-color:red;' type='button' onclick='cancelEdit(\"". $edit[1]. ($i+1)  . "\")'>Cancel</button>";
							echo "</form>";
							echo "</div>";
						}
						$index=0;
						mysqli_close($con);
					?>
						
					</div>
				</section>

				<!-- Two -->
				<section id="two" class="wrapper style3 fade-up">
					<div class="inner">
						<h2>Facility</h2>
					
                        <?php
						$con=mysqli_connect("localhost","root","","database1");
						// Check connection
						if (mysqli_connect_errno())
						{
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}
			
						$result = mysqli_query($con,"SELECT * FROM Facility ");
			
						echo "<table border='1'>
						<tr>
						<th>ID</th>
						<th>Name</th>
                        <th>Address</th>
						<th>Postal Code</th>
						<th>Phone</th>
						<th>Web Address</th> 
						<th>Capacity</th> 
						<th>Type ID</th>
                        <th>City</th>
                        <th>Province</th>
                        
                        
                         
                       
                       
						<th id='" .$hide[2] ."' style='display:none;'>Edit</th>
						<th id='" .$hide[2] ."' style='display:none;'>Delete</th>      
						</tr>";
                        
                        $index = 0; 
						while($row = mysqli_fetch_assoc($result))
						{
                            echo "<tr><td>" . implode("</td><td>",$row) . "</td>";
							$index++;
							echo "<form action='redirect.php' method='post'>";
							echo "<td id='" .$hide[2] ."' style='display:none;'> <button class='addEntry' id = 'editButtons' name='editsubmit0' onclick='editEntry(\"". $edit[2]. "". $index ."\")' name='editsubmit0". $index ."'  type='button'>Edit</button></td>";
							echo "<td id='" .$hide[2] ."' style='display:none;'> <button type='submit' class='addEntry'  id = 'deleteButtons' style= background-color:red;'  name='" .$deleteSubmit[2] . $index ."' >Delete</button></td>";
							echo "</form>";
							echo "</tr>";
						}

						echo "<button id='" .$show[2] ."' class='addEntry' onclick='editMode(\"" . $show[2] ."\",\"" . $hide[2] ."\")'>Edit</button>";

						echo "<button id='" .$hide[2] ."'class='cancelEntry' style='display:none; background-color:red;' onclick='unEditMode(\"" . $show[2] ."\",\"" . $hide[2] ."\")'>Cancel</button>";
						echo "<button id='" .$hide[2] ."' class='addEntry' onclick='addEntry(\"". $add[2]. "\")' style='display:none;'>Add Entry</button>";
						echo "</table>";


						//hidden form to add an entry (currently invisible)
						echo "<div id='" .$add[2] ."' style='display:none;'>";
						echo "<form action='redirect.php' method='post' id='form'>";
						echo" <label for=TestName></label><br>";

						echo "<input name='facId' type='text' placeholder='Facility ID' >";
						echo "<input name='facName' type='text' placeholder='Facility Name'>";
						echo "<input name='facAddress' type='text' placeholder='Address'>";
						echo "<input name='facCity' type='text' placeholder='City'>";
						echo "<input name='facProvince' type='text' placeholder='Province'>";
						echo "<input name='facPCode' type='text' placeholder='Postal Code'>";
						echo "<input name='facPhone' type='text' placeholder='Phone Number'>";
						echo "<input name='facWeb' type='text' placeholder='Web Address'>";
						echo "<input name='facCapacity' type='text' placeholder='Capacity'>";
						echo "<input name='facTypeId' type='text' placeholder='Type ID'>";

						echo "<button class='addEntry' name='submit2' type='submit'>Submit</button>";
						echo "<button class='addEntry' style='background-color:red;' type='button' onclick='cancel(\"". $add[2]. "\")'>Cancel</button>";
						echo "</form>";
						echo "</div>";
						for($i=0; $i<$index; $i++)
						{
							//hidden form to edit an entry (currently invisible)
							echo "<div id='" . $edit[2] . ($i+1)  ."' style='display:none;'>";
							echo "<form action = 'redirect.php' method='post' id='editentryform'>";
							echo" <label for=editName></label><br>";

							echo "<input name='editfacId' type='text' placeholder='Edit: Facility ID' >";
							echo "<input name='editfacName' type='text' placeholder='Edit: Facility Name'>";
							echo "<input name='editfacAddress' type='text' placeholder='Edit: Address'>";
							echo "<input name='editfacCity' type='text' placeholder='Edit: City'>";
							echo "<input name='editfacProvince' type='text' placeholder='Edit: Province'>";
							echo "<input name='editfacPCode' type='text' placeholder='Edit: Postal Code'>";
							echo "<input name='editfacPhone' type='text' placeholder='Edit: Phone Number'>";
							echo "<input name='editfacWeb' type='text' placeholder='Edit: Web Address'>";
							echo "<input name='editfacCapacity' type='text' placeholder='Edit: Capacity'>";
							echo "<input name='editfacTypeId' type='text' placeholder='Edit: Type ID'>";

							echo "<button class='addEntry' name='" . $editSubmit[2] . ($i+1)  ."' type='submit'>Confirm</button>";
							echo "<button class='addEntry' style='background-color:red;' type='button' onclick='cancelEdit(\"". $edit[2]. ($i+1)  . "\")'>Cancel</button>";
							echo "</form>";
							echo "</div>";
						}
						$index=0;
						mysqli_close($con);
					?>
					</div>
				</section>
				<!-- Three -->
				<section id="three" class="wrapper style3 fade-up">
					<div class="inner">
						<h2>FacilityType</h2>
					
                        <?php
						$con=mysqli_connect("localhost","root","","database1");
						// Check connection
						if (mysqli_connect_errno())
						{
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}
			
						$result = mysqli_query($con,"SELECT * FROM FacilityType ORDER BY id");
			
						echo "<table border='1'>
						<tr>
						<th>ID</th>
						<th>Name</th>    
						</tr>";
                        
                        $index = 0; 
						while($row = mysqli_fetch_assoc($result))
						{
                            echo "<tr><td>" . implode("</td><td>",$row) . "</td></tr>";
						
						
                       
						}
						echo "</table>";
			
						mysqli_close($con);
					?>
						
					</div>
				</section>

				<!-- Four -->
				<section id="four" class="wrapper style3 fade-up">
					<div class="inner">
						<h2>EmployeeRole</h2>
					
						
                        <?php
						$con=mysqli_connect("localhost","root","","database1");
						// Check connection
						if (mysqli_connect_errno())
						{
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}
			
						$result = mysqli_query($con,"SELECT * FROM EmployeeRole");
			
						echo "<table border='1'>
						<tr>
						<th>ID</th>
						<th>Type</th>
                    
						</tr>";
                        
                        $index = 0; 
						while($row = mysqli_fetch_assoc($result))
						{
                            echo "<tr><td>" . implode("</td><td>",$row) . "</td></tr>";
						
						
                       
						}
						echo "</table>";
			
						mysqli_close($con);
					?>
						
					</div>
				</section>

				<!-- Five -->
				<section id="five" class="wrapper style3 fade-up">
					<div class="inner">
						<h2>EmployedHistory</h2>
					
						<?php
						$con=mysqli_connect("localhost","root","","database1");
						// Check connection
						if (mysqli_connect_errno())
						{
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}
			
						$result = mysqli_query($con,"SELECT * FROM EmployedHistory");
			
						echo "<table border='1'>
						<tr>
						<th>Facility ID</th>
                        <th>Employee ID</th>
                        <th>Employee Role ID</th>
                        <th>Start Date</th>
                        <th>End Date</th>
					
						</tr>";
                        
                        $index = 0; 
						while($row = mysqli_fetch_assoc($result))
						{
                            echo "<tr><td>" . implode("</td><td>",$row) . "</td></tr>";
						
						
                       
						}
						echo "</table>";
			
						mysqli_close($con);
					?>

					</div>
				</section>

				<!-- Six -->
				<section id="six" class="wrapper style3 fade-up">
					<div class="inner">
						<h2>Vaccination</h2>
					
						<?php
						$con=mysqli_connect("localhost","root","","database1");
						// Check connection
						if (mysqli_connect_errno())
						{
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}
			
						$result = mysqli_query($con,"SELECT * FROM Vaccination");
			
						echo "<table border='1'>
						<tr>
						<th>ID</th>
                        <th>Type </th>
                        <th id='" .$hide[6] ."' style='display:none;'>Edit</th>
						<th id='" .$hide[6] ."' style='display:none;'>Delete</th>
					
						</tr>";
                        
                        $index = 0; 
						while($row = mysqli_fetch_assoc($result))
						{
                            echo "<tr><td>" . implode("</td><td>",$row) . "</td>";
						
							$index++;
							echo "<form action='redirect.php' method='post'>";
							echo "<td id='" .$hide[6] ."' style='display:none;'> <button class='addEntry' id = 'editButtons' name='editsubmit0' onclick='editEntry(\"". $edit[6]. "". $index ."\")' name='editsubmit0". $index ."'  type='button'>Edit</button></td>";
							echo "<td id='" .$hide[6] ."' style='display:none;'> <button type='submit' class='addEntry'  id = 'deleteButtons' style= background-color:red;'  name='" .$deleteSubmit[6] . $index ."' >Delete</button></td>";
							echo "</form>";
							echo "</tr>";
						}

						echo "<button id='" .$show[6] ."' class='addEntry' onclick='editMode(\"" . $show[6] ."\",\"" . $hide[6] ."\")'>Edit</button>";

						echo "<button id='" .$hide[6] ."'class='cancelEntry' style='display:none; background-color:red;' onclick='unEditMode(\"" . $show[6] ."\",\"" . $hide[6] ."\")'>Cancel</button>";
						echo "<button id='" .$hide[6] ."' class='addEntry' onclick='addEntry(\"". $add[6]. "\")' style='display:none;'>Add Entry</button>";
						echo "</table>";


						//hidden form to add an entry (currently invisible)
						echo "<div id='" .$add[6] ."' style='display:none;'>";
						echo "<form action='redirect.php' method='post' id='form'>";
						echo" <label for=TestName></label><br>";

						echo "<input name='vaxId' type='text' placeholder='Vaccination ID' >";
						echo "<input name='vaxType' type='text' placeholder='Vaccination Type'>";
						

						echo "<button class='addEntry' name='submit6' type='submit'>Submit</button>";
						echo "<button class='addEntry' style='background-color:red;' type='button' onclick='cancel(\"". $add[6]. "\")'>Cancel</button>";
						echo "</form>";
						echo "</div>";
						for($i=0; $i<$index; $i++)
						{
							//hidden form to edit an entry (currently invisible)
							echo "<div id='" . $edit[6] . ($i+1)  ."' style='display:none;'>";
							echo "<form action = 'redirect.php' method='post' id='editentryform'>";
							echo" <label for=editName></label><br>";

							echo "<input name='editvaxId' type='text' placeholder='Edit: Vaccination ID' >";
							echo "<input name='editvaxType' type='text' placeholder='Edit: Vaccination Type'>";
							

							echo "<button class='addEntry' name='" . $editSubmit[6] . ($i+1)  ."' type='submit'>Confirm</button>";
							echo "<button class='addEntry' style='background-color:red;' type='button' onclick='cancelEdit(\"". $edit[6]. ($i+1)  . "\")'>Cancel</button>";
							echo "</form>";
							echo "</div>";
						}
						$index=0;
						mysqli_close($con);
					?>
						
					</div>
				</section>

				<!-- Seven -->
				<section id="seven" class="wrapper style3 fade-up">
					<div class="inner">
						<h2>WasVaccinated</h2>
						<?php
						$con=mysqli_connect("localhost","root","","database1");
						// Check connection
						if (mysqli_connect_errno())
						{
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}
			
						$result = mysqli_query($con,"SELECT * FROM Was_Vaccinated");
			
						echo "<table border='1'>
						<tr>
						<th>Employee ID</th>
                        <th>Vaccination ID </th>
                        <th>Dose Number </th>
                        <th>Location </th>
                        <th>Date </th>
						<th id='" .$hide[7] ."' style='display:none;'>Edit</th>
						<th id='" .$hide[7] ."' style='display:none;'>Delete</th>
						</tr>";
                        
						$index = 0; 
						while($row = mysqli_fetch_assoc($result))
						{
                            echo "<tr><td>" . implode("</td><td>",$row) . "</td>";
						
							$index++;
							echo "<form action='redirect.php' method='post'>";
							echo "<td id='" .$hide[7] ."' style='display:none;'> <button class='addEntry' id = 'editButtons' name='editsubmit0' onclick='editEntry(\"". $edit[7]. "". $index ."\")' name='editsubmit0". $index ."'  type='button'>Edit</button></td>";
							echo "<td id='" .$hide[7] ."' style='display:none;'> <button type='submit' class='addEntry'  id = 'deleteButtons' style= background-color:red;'  name='" .$deleteSubmit[7] . $index ."' >Delete</button></td>";
							echo "</form>";
							echo "</tr>";
						}

						echo "<button id='" .$show[7] ."' class='addEntry' onclick='editMode(\"" . $show[7] ."\",\"" . $hide[7] ."\")'>Edit</button>";

						echo "<button id='" .$hide[7] ."'class='cancelEntry' style='display:none; background-color:red;' onclick='unEditMode(\"" . $show[7] ."\",\"" . $hide[7] ."\")'>Cancel</button>";
						echo "<button id='" .$hide[7] ."' class='addEntry' onclick='addEntry(\"". $add[7]. "\")' style='display:none;'>Add Entry</button>";
						echo "</table>";


						//hidden form to add an entry (currently invisible)
						echo "<div id='" .$add[7] ."' style='display:none;'>";
						echo "<form action='redirect.php' method='post' id='form'>";
						echo" <label for=TestName></label><br>";

						echo "<input name='vaxEmpId' type='text' placeholder='Employee ID' >";
						echo "<input name='vaxID' type='text' placeholder='Vaccination ID'>";
						echo "<input name='vaxDn' type='text' placeholder='Dose number'>";
						echo "<input name='vaxLocation' type='text' placeholder='Location'>";
						echo "<input name='vaxDate' type='text' placeholder='Date'>";
						

						echo "<button class='addEntry' name='submit7' type='submit'>Submit</button>";
						echo "<button class='addEntry' style='background-color:red;' type='button' onclick='cancel(\"". $add[7]. "\")'>Cancel</button>";
						echo "</form>";
						echo "</div>";
						for($i=0; $i<$index; $i++)
						{
							//hidden form to edit an entry (currently invisible)
							echo "<div id='" . $edit[7] . ($i+1)  ."' style='display:none;'>";
							echo "<form action = 'redirect.php' method='post' id='editentryform'>";
							echo" <label for=editName></label><br>";

							echo "<input name='editvaxEmpId' type='text' placeholder='Edit: Employee ID' >";
							echo "<input name='editvaxID' type='text' placeholder='Edit: Vaccination ID'>";
							echo "<input name='editvaxDn' type='text' placeholder='Edit: Dose number'>";
							echo "<input name='editvaxLocation' type='text' placeholder='Edit: Location'>";
							echo "<input name='editvaxDate' type='text' placeholder='Edit: Date'>";
							

							echo "<button class='addEntry' name='" . $editSubmit[7] . ($i+1)  ."' type='submit'>Confirm</button>";
							echo "<button class='addEntry' style='background-color:red;' type='button' onclick='cancelEdit(\"". $edit[7]. ($i+1)  . "\")'>Cancel</button>";
							echo "</form>";
							echo "</div>";
						}
						$index=0;
						mysqli_close($con);
					?>
						
						
					</div>
				</section>

				<!-- Eight -->
				<section id="eight" class="wrapper style3 fade-up">
					<div class="inner">
						<h2>Infection</h2>
					
						<?php
						$con=mysqli_connect("localhost","root","","database1");
						// Check connection
						if (mysqli_connect_errno())
						{
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}
			
						$result = mysqli_query($con,"SELECT * FROM Infection");
			
						echo "<table border='1'>
						<tr>
						<th>ID</th>
                        <th>Type </th>
						<th id='" .$hide[8] ."' style='display:none;'>Edit</th>
						<th id='" .$hide[8] ."' style='display:none;'>Delete</th>
						</tr>";
                        
                        $index = 0; 
						while($row = mysqli_fetch_assoc($result))
						{
                            echo "<tr><td>" . implode("</td><td>",$row) . "</td>";
							$index++;
							echo "<form action='redirect.php' method='post'>";
							echo "<td id='" .$hide[8] ."' style='display:none;'> <button class='addEntry' id = 'editButtons' name='editsubmit0' onclick='editEntry(\"". $edit[8]. "". $index ."\")' name='editsubmit0". $index ."'  type='button'>Edit</button></td>";
							echo "<td id='" .$hide[8] ."' style='display:none;'> <button type='submit' class='addEntry'  id = 'deleteButtons' style= background-color:red;'  name='" .$deleteSubmit[8] . $index ."' >Delete</button></td>";
							echo "</form>";
							echo "</tr>";
						}

						echo "<button id='" .$show[8] ."' class='addEntry' onclick='editMode(\"" . $show[8] ."\",\"" . $hide[8] ."\")'>Edit</button>";

						echo "<button id='" .$hide[8] ."'class='cancelEntry' style='display:none; background-color:red;' onclick='unEditMode(\"" . $show[8] ."\",\"" . $hide[8] ."\")'>Cancel</button>";
						echo "<button id='" .$hide[8] ."' class='addEntry' onclick='addEntry(\"". $add[8]. "\")' style='display:none;'>Add Entry</button>";
						echo "</table>";


						//hidden form to add an entry (currently invisible)
						echo "<div id='" .$add[8] ."' style='display:none;'>";
						echo "<form action='redirect.php' method='post' id='form'>";
						echo" <label for=TestName></label><br>";

						echo "<input name='InfectionId' type='text' placeholder='Vaccination ID' >";
						echo "<input name='InfectionType' type='text' placeholder='Vaccination Type'>";
						

						echo "<button class='addEntry' name='submit8' type='submit'>Submit</button>";
						echo "<button class='addEntry' style='background-color:red;' type='button' onclick='cancel(\"". $add[8]. "\")'>Cancel</button>";
						echo "</form>";
						echo "</div>";
						for($i=0; $i<$index; $i++)
						{
							//hidden form to edit an entry (currently invisible)
							echo "<div id='" . $edit[8] . ($i+1)  ."' style='display:none;'>";
							echo "<form action = 'redirect.php' method='post' id='editentryform'>";
							echo" <label for=editName></label><br>";

							echo "<input name='editInfectionId' type='text' placeholder='Edit: Vaccination ID' >";
							echo "<input name='editInfectionType' type='text' placeholder='Edit: Vaccination Type'>";
							

							echo "<button class='addEntry' name='" . $editSubmit[8] . ($i+1)  ."' type='submit'>Confirm</button>";
							echo "<button class='addEntry' style='background-color:red;' type='button' onclick='cancelEdit(\"". $edit[8]. ($i+1)  . "\")'>Cancel</button>";
							echo "</form>";
							echo "</div>";
						}
						$index=0;
						mysqli_close($con);
					?>
						
						
					</div>
				</section>

				<!-- Nine -->
				<section id="nine" class="wrapper style3 fade-up">
					<div class="inner">
						<h2>WasInfected</h2>
                        <?php
						$con=mysqli_connect("localhost","root","","database1");
						// Check connection
						if (mysqli_connect_errno())
						{
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}
			
						$result = mysqli_query($con,"SELECT * FROM Was_Infected");
			
						echo "<table border='1'>
						<tr>
						<th>Employee ID</th>
                        <th>Infection ID </th>
                        <th>Date </th>
						<th id='" .$hide[9] ."' style='display:none;'>Edit</th>
						<th id='" .$hide[9] ."' style='display:none;'>Delete</th>
						</tr>";
                        
                        $index = 0; 
						while($row = mysqli_fetch_assoc($result))
						{
                            echo "<tr><td>" . implode("</td><td>",$row) . "</td>";
							$index++;
							echo "<form action='redirect.php' method='post'>";
							echo "<td id='" .$hide[9] ."' style='display:none;'> <button class='addEntry' id = 'editButtons' name='editsubmit0' onclick='editEntry(\"". $edit[9]. "". $index ."\")' name='editsubmit0". $index ."'  type='button'>Edit</button></td>";
							echo "<td id='" .$hide[9] ."' style='display:none;'> <button type='submit' class='addEntry'  id = 'deleteButtons' style= background-color:red;'  name='" .$deleteSubmit[9] . $index ."' >Delete</button></td>";
							echo "</form>";
							echo "</tr>";
						}

						echo "<button id='" .$show[9] ."' class='addEntry' onclick='editMode(\"" . $show[9] ."\",\"" . $hide[9] ."\")'>Edit</button>";

						echo "<button id='" .$hide[9] ."'class='cancelEntry' style='display:none; background-color:red;' onclick='unEditMode(\"" . $show[9] ."\",\"" . $hide[9] ."\")'>Cancel</button>";
						echo "<button id='" .$hide[9] ."' class='addEntry' onclick='addEntry(\"". $add[9]. "\")' style='display:none;'>Add Entry</button>";
						echo "</table>";


						//hidden form to add an entry (currently invisible)
						echo "<div id='" .$add[9] ."' style='display:none;'>";
						echo "<form action='redirect.php' method='post' id='form'>";
						echo" <label for=TestName></label><br>";

						echo "<input name='WasInfectEmpId' type='text' placeholder='Employee ID' >";
						echo "<input name='WasInfectInfectId' type='text' placeholder='Infection ID'>";
						echo "<input name='WasInfectDate' type='text' placeholder='Date'>";
						

						echo "<button class='addEntry' name='submit9' type='submit'>Submit</button>";
						echo "<button class='addEntry' style='background-color:red;' type='button' onclick='cancel(\"". $add[9]. "\")'>Cancel</button>";
						echo "</form>";
						echo "</div>";
						for($i=0; $i<$index; $i++)
						{
							//hidden form to edit an entry (currently invisible)
							echo "<div id='" . $edit[9] . ($i+1)  ."' style='display:none;'>";
							echo "<form action = 'redirect.php' method='post' id='editentryform'>";
							echo" <label for=editName></label><br>";

							echo "<input name='editWasInfectedEmpId' type='text' placeholder='Edit: Employee ID' >";
							echo "<input name='editWasInfectedInfectId' type='text' placeholder='Edit: Infection ID'>";
							echo "<input name='editWasInfectedDate' type='text' placeholder='Edit: Infection ID'>";
							

							echo "<button class='addEntry' name='" . $editSubmit[9] . ($i+1)  ."' type='submit'>Confirm</button>";
							echo "<button class='addEntry' style='background-color:red;' type='button' onclick='cancelEdit(\"". $edit[9]. ($i+1)  . "\")'>Cancel</button>";
							echo "</form>";
							echo "</div>";
						}
						$index=0;
						mysqli_close($con);
					?>
						
					</div>
				</section>
				<!-- Ten -->
				<section id="ten" class="wrapper style3 fade-up">
					<div class="inner">
						<h2>EmployeeSchedule</h2>
                        <?php
						$con=mysqli_connect("localhost","root","","database1");
						// Check connection
						if (mysqli_connect_errno())
						{
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}
			
						$result = mysqli_query($con,"SELECT * FROM EmployeeSchedule");
			
						echo "<table border='1'>
						<tr>
						<th>employee_id</th>
                        <th>facility_id</th>
                        <th>date</th>
						<th>start_time</th>
						<th>end_time</th>
						<th id='" .$hide[10] ."' style='display:none;'>Edit</th>
						<th id='" .$hide[10] ."' style='display:none;'>Delete</th>
						</tr>";
                        
                        $index = 0; 
						while($row = mysqli_fetch_assoc($result))
						{
                            echo "<tr><td>" . implode("</td><td>",$row) . "</td>";
							$index++;
							echo "<form action='redirect.php' method='post'>";
							echo "<td id='" .$hide[10] ."' style='display:none;'> <button class='addEntry' id = 'editButtons' name='editsubmit0' onclick='editEntry(\"". $edit[10]. "". $index ."\")' name='editsubmit0". $index ."'  type='button'>Edit</button></td>";
							echo "<td id='" .$hide[10] ."' style='display:none;'> <button type='submit' class='addEntry'  id = 'deleteButtons' style= background-color:red;'  name='" .$deleteSubmit[10] . $index ."' >Delete</button></td>";
							echo "</form>";
							echo "</tr>";
						}

						echo "<button id='" .$show[10] ."' class='addEntry' onclick='editMode(\"" . $show[10] ."\",\"" . $hide[10] ."\")'>Edit</button>";

						echo "<button id='" .$hide[10] ."'class='cancelEntry' style='display:none; background-color:red;' onclick='unEditMode(\"" . $show[10] ."\",\"" . $hide[10] ."\")'>Cancel</button>";
						echo "<button id='" .$hide[10] ."' class='addEntry' onclick='addEntry(\"". $add[10]. "\")' style='display:none;'>Add Entry</button>";
						echo "</table>";


						//hidden form to add an entry (currently invisible)
						echo "<div id='" .$add[10] ."' style='display:none;'>";
						echo "<form action='redirect.php' method='post' id='form'>";
						echo" <label for=TestName></label><br>";

						echo "<input name='ScheduleEmpId' type='text' placeholder='Employee ID' >";
						echo "<input name='ScheduleFacId' type='text' placeholder='Facility ID'>";
						echo "<input name='ScheduleDate' type='text' placeholder='Date Type'>";
						echo "<input name='ScheduleST' type='text' placeholder='Start Time Type'>";
						echo "<input name='ScheduleET' type='text' placeholder='End Time Type'>";
						

						echo "<button class='addEntry' name='submit10' type='submit'>Submit</button>";
						echo "<button class='addEntry' style='background-color:red;' type='button' onclick='cancel(\"". $add[10]. "\")'>Cancel</button>";
						echo "</form>";
						echo "</div>";
						for($i=0; $i<$index; $i++)
						{
							//hidden form to edit an entry (currently invisible)
							echo "<div id='" . $edit[10] . ($i+1)  ."' style='display:none;'>";
							echo "<form action = 'redirect.php' method='post' id='editentryform'>";
							echo" <label for=editName></label><br>";

							echo "<input name='editScheduleEmpId' type='text' placeholder='Edit: Employee ID' >";
							echo "<input name='editScheduleFacId' type='text' placeholder='Edit: Facility ID'>";
							echo "<input name='editScheduleDate' type='text' placeholder='Edit: Date Type'>";
							echo "<input name='editScheduleST' type='text' placeholder='Edit: Start Time Type'>";
							echo "<input name='editScheduleET' type='text' placeholder='Edit: End Time Type'>";
							

							echo "<button class='addEntry' name='" . $editSubmit[10] . ($i+1)  ."' type='submit'>Confirm</button>";
							echo "<button class='addEntry' style='background-color:red;' type='button' onclick='cancelEdit(\"". $edit[10]. ($i+1)  . "\")'>Cancel</button>";
							echo "</form>";
							echo "</div>";
						}
						$index=0;
						mysqli_close($con);
					?>
						
					</div>
				</section>
				<!-- Eleven -->
				<section id="eleven" class="wrapper style3 fade-up">
					<div class="inner">
						
								<?php
                                    function exec_query_to_table($query) {
                                        $con=mysqli_connect("localhost","root","","database1");
                                        if (mysqli_connect_errno())
                                        {
                                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                        }
                                        $result = mysqli_query($con, $query);
                
                                        // Output field names
                                        echo "<table><tr>";
                                        for($i = 0; $i < mysqli_num_fields($result); $i++) {
                                            $col_name = mysqli_fetch_field($result)->name;
                                            $col_name = ucwords(str_replace("_", " ", $col_name));
                                            echo "<th>{$col_name}</th>";
                                        }
                                        echo "</tr>";
                                        // Output field values by row
                                        while($row = mysqli_fetch_row($result)) {
                                            echo "<tr>";
                                            foreach($row as $col) {
                                                echo "<td>" . htmlspecialchars($col) . "</td>";
                                            }
                                            echo "</tr>";
                                        }
                                        echo "</table>";
                
                                        mysqli_close($con);
                                    }
                                ?>
							
                           <!--Twelve -->
				<section id="twelve" class="wrapper style3 fade-up">
					<div class="inner">
					<button  onclick="window.location.href='index.php'" > Back home </button>
					</div>
				</section>
		<!-- Footer -->
			<footer id="footer" class="wrapper style1-alt">
				<div class="inner">
					<ul class="menu">
						<li>&copy; Final Project. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</div>
			</footer>
					<!-- ----------------------------------------Queries--------------------------------------------------->
									<script>
										function toggleForm7() {
											const form = document.getElementById("myForm7");
											if (form.style.display === "none") {
												form.style.display = "block";
											} else {
												form.style.display = "none";
											}
										}
										function toggleForm8() {
											const form = document.getElementById("myForm8");
											if (form.style.display === "none") {
												form.style.display = "block";
											} else {
												form.style.display = "none";
											}
										}
										function toggleForm10() {
											const form = document.getElementById("myForm10");
											if (form.style.display === "none") {
												form.style.display = "block";
											} else {
												form.style.display = "none";
											}
										}
										function toggleForm11() {
											const form = document.getElementById("myForm11");
											if (form.style.display === "none") {
												form.style.display = "block";
											} else {
												form.style.display = "none";
											}
										}
										function toggleForm12() {
											const form = document.getElementById("myForm12");
											if (form.style.display === "none") {
												form.style.display = "block";
											} else {
												form.style.display = "none";
											}
										}
									</script>
									<!-- Query 6 Logic-->
									<div class="queries" id="6" style="display: none">
									<?php
									echo "<h2>Query 6</h2>";
									$con=mysqli_connect("localhost","root","","database1");
									// Execute query 6
									$query = "SELECT Facility.name, Facility.address, Facility.city, Facility.province, Facility.postal_code, Facility.phone, web_address, capacity, FacilityType.name as facility_type, 

									(SELECT Employee.first_name FROM Employee WHERE Employee.id in 
										(SELECT ManagedBy.employee_id FROM ManagedBy WHERE ManagedBy.facility_id = Facility.id)) as manager_fname, 
									
									(SELECT COUNT(EmployedHistory.employee_id) FROM EmployedHistory WHERE EmployedHistory.facility_id = Facility.id AND EmployedHistory.end_date IS NULL) As current_employee_count
									
									FROM Facility, FacilityType
									
									WHERE Facility.facilitytype_id = FacilityType.id
									
									ORDER BY Facility.province, Facility.city, Facility.facilitytype_id, current_employee_count";
									$result = mysqli_query($con, $query);

									// Output results in a table
									echo "<table>";
									echo "<tr><th>Name</th><th>Address</th><th>City</th><th>Province</th><th>Postal Code</th><th>Phone</th><th>Web Address</th><th>Capacity</th><th>Facility Type</th><th>Manager Name</th><th>Current Employee Count</th></tr>";
									while($row = mysqli_fetch_assoc($result))
									{
										echo "<tr><td>" . implode("</td><td>",$row) . "</td></tr>";
						
									}
									echo "</table>";
									mysqli_close($con);
                            		?>
									</div>





									<!-- Query 7 Logic-->
									<div class="queries" id="7" style="display: none;">
									<button onclick="toggleForm7()">Modify Facility ID</button>
									<form id="myForm7" method="post" action="" style="display: none;">
										<label for="facility_id">Enter Facility ID:</label>
										<input type="text" name="facility_id" id="facility_id" placeholder="Ex: 27">
										<input id = "submit-btn" type="submit" name="submit7" value="Submit">
									</form>
									
									<?php
									if(isset($_POST['submit7'])){

										$facility_id = $_POST['facility_id'];
										$temp = $facility_id;
										$facility_id = (int) $facility_id;
										if($facility_id>0 || $temp=='0')
										{
										$facility_id = (string) $facility_id;
										echo "Displaying Facility ID: $facility_id";
										$con=mysqli_connect("localhost","root","","database1");
										$query = "SELECT first_name, last_name, EmployedHistory.start_date, dob, medicare, phone,  address, city, province, postal_code, citizenship, email
												FROM Employee, EmployedHistory 
												WHERE Employee.id = EmployedHistory.employee_id 
												AND EmployedHistory.end_date IS NULL 
												AND EmployedHistory.facility_id = $facility_id
												ORDER BY EmployedHistory.employeerole_id, Employee.first_name, Employee.last_name";
												
										$result = mysqli_query($con, $query);
										// Output results in a table
										echo "<h2>Query 7</h2>";
										echo "<table>";
										echo "<tr><th>First Name</th><th>Last Name</th><th>Start Date</th><th>Date of Birth</th><th>Medicare</th><th>Phone</th><th>Address</th><th>City</th><th>Province</th><th>Postal Code</th><th>Citizenship</th><th>Email</th></tr>";
										
										while($row = mysqli_fetch_assoc($result))
										{
											echo "<tr><td>" . implode("</td><td>",$row) . "</td></tr>";
										}
										echo "</table>";
										
										mysqli_close($con);
										}else{
											echo "<h2 style='color:red; text-shadow: 2px 2px 4px navy; margin-top:1%;'>You entered: ' $temp ' This data type is invalid. Try again</h2>";
										}
									}
									?>
								</div>



									<!-- Query 8 Logic-->
									<div class="queries" id="8" style="display: none">
									<button onclick="toggleForm8()">Modify Attributes</button>
									<form id="myForm8" method="post" action="" style="display: none;">
										<label for="eid8">Enter Employee ID:</label>
										<input type="text" name="eid8" id="eid8" placeholder="Ex: 37">
										<label for="start_time8">Enter Start Time:</label>
										<input type="text" name="start_time8" id="start_time8" placeholder="Ex: 10:00:00">
										<label for="end_time8">Enter End Time:</label>
										<input type="text" name="end_time8" id="end_time8" placeholder="Ex: 20:00:00">
										<input id = "submit-btn" type="submit" name="submit8" value="Submit">
									</form>

									<?php
									echo "<h2>Query 8</h2>";
									if(isset($_POST['submit8']))
									{
										$eid8 = $_POST['eid8'];
										$eid8_temp = $eid8;
										$eid8 = (int)$eid8;
									
										$start_time8 = $_POST['start_time8'];
										$st8_temp =$start_time8;

										$end_time8 = $_POST['end_time8'];
										$et8_temp = $end_time8;

										
										if($eid8>0 || $eid8_temp=='0')
										{
											
											echo "Displaying Employee ID: $eid8  <br>";
											echo "Scheduled between:$start_time8 ";
											echo "and: $end_time8 <br>";
											$con=mysqli_connect("localhost","root","","database1");
											$query = "SELECT Facility.name, date, start_time, end_time 
											FROM EmployeeSchedule, Facility 
											WHERE EmployeeSchedule.start_time > '$start_time8'
											AND EmployeeSchedule.end_time < '$end_time8'
											AND EmployeeSchedule.employee_id = $eid8
											AND Facility.id = facility_id 
											ORDER BY Facility.name, date, start_time";
											$result = mysqli_query($con, $query);
											// Output results in a table
											echo "<table>";
											echo "<tr><th>Facility Name</th><th>Date</th><th>Start Time</th><th>End Time</th></tr>";
											while($row = mysqli_fetch_assoc($result))
											{
												echo "<tr><td>" . implode("</td><td>",$row) . "</td></tr>";
								
											}
											echo "</table>";
											mysqli_close($con);	
										}else{
											echo "<h2 style='color:red; text-shadow: 2px 2px 4px navy; margin-top:1%;'>You entered: ' $eid8_temp ' This data type is invalid. Try again</h2>";
										}
									}
                            		?>






									</div>
									<!-- Query 9 Logic-->
									<div class="queries" id="9" style="display: none">
									<?php
									echo "<h2>Query 9</h2>";
									$con=mysqli_connect("localhost","root","","database1");
									$query = "SELECT first_name, last_name, Was_Infected.date, Facility.name 
									FROM Employee, EmployedHistory, Was_Infected, Facility 
									WHERE Employee.id = EmployedHistory.employee_id 
									AND Employee.id = Was_Infected.employee_id 
									AND EmployedHistory.end_date IS NULL 
									AND EmployedHistory.employeerole_id = 2 
									AND Was_Infected.infection_id < 4 
									AND Was_Infected.date BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW() 
									AND Facility.id = EmployedHistory.facility_id 
									ORDER BY Facility.name, Employee.first_name;";
									$result = mysqli_query($con, $query);
									// Output results in a table
									echo "<table>";
									echo "<tr><th>First Name</th><th>Last Name</th><th>Date</th><th>Facility Name</th></tr>";
									while($row = mysqli_fetch_assoc($result))
									{
										echo "<tr><td>" . implode("</td><td>",$row) . "</td></tr>";
						
									}
									echo "</table>";
									mysqli_close($con);
                            		?>
									</div>

                                    <!-- Query 10 logic -->
									<div class="queries" id="10" style="display: none">
									<button onclick="toggleForm10()">Change Facility Name</button>
									<form id="myForm10" method="post" action="" style="display: none;">
										<label for="name10">Enter Facility name:</label>
										<input type="text" name="name10" id="name10" placeholder="Ex: Hospital Maisonneuve Rosemont">
										<input id = "submit-btn" type="submit" name="submit10" value="Submit">
									</form>
                                        <?php
                                        echo "<h2>Query 10</h2>";
										if(isset($_POST['submit10']))
										{
											$name10 = $_POST['name10'];
											echo "Displaying Facility name: $name10  <br>";
											$query = "SELECT facility_name, receiver_email, date, subject, body
                                            FROM EmailLog
                                            WHERE facility_name= '$name10'
                                            ORDER BY date ASC;";
                                        	exec_query_to_table($query);
										}
                                        ?>
                                    </div>

									<!-- Query 11 logic -->
									<div class="queries" id="11" style="display: none">
									<button onclick="toggleForm11()">Modify Facility ID</button>
									<form id="myForm11" method="post" action="" style="display: none;">
										<label for="fid11">Enter Facility ID:</label>
										<input type="text" name="fid11" id="fid11" placeholder="Ex: 27">
										<input id = "submit-btn" type="submit" name="submit11" value="Submit">
									</form>

									<?php
									echo "<h2>Query 11</h2>";
									if(isset($_POST['submit11']))
									{
										$fid11 = $_POST['fid11'];
										echo "Displaying Facility ID: $fid11  <br>";
										$con=mysqli_connect("localhost","root","","database1");
										// Execute query 11
										$query = "SELECT DISTINCT first_name, last_name, role  
										FROM Employee, EmployeeSchedule, EmployedHistory, EmployeeRole 
										WHERE EmployeeRole.id=EmployedHistory.employeerole_id AND Employee.id=EmployedHistory.employee_id 
										AND EmployedHistory.facility_id=EmployeeSchedule.facility_id AND EmployeeSchedule.employee_id = EmployedHistory.employee_id 
										AND (EmployedHistory.employeeRole_id=1 OR EmployedHistory.employeeRole_id=2)  AND (date BETWEEN(NOW() - INTERVAL 14 DAY) AND NOW()) 
										AND EmployeeSchedule.facility_id= '$fid11'
										ORDER BY role, first_name ASC";
										$result = mysqli_query($con, $query);
										// Output results in a table
										echo "<table>";
										echo "<tr><th>First Name</th><th> Last Name</th><th>Role</th></tr>";
										while ($row = mysqli_fetch_array($result)) {
										echo "<tr>";
										echo "<td>" . $row['first_name'] . "</td>";
										echo "<td>" . $row['last_name'] . "</td>";
										echo "<td>" . $row['role'] . "</td>";
										
										echo "</tr>";
										}
										echo "</table>";
										mysqli_close($con);
									}	
                            		?>
									</div>
									<!-- Query 12 logic -->
									<div class="queries" id="12" style="display: none">
									<button onclick="toggleForm12()">Modify Attributes</button>
									<form id="myForm12" method="post" action="" style="display: none;">
										<label for="fid12">Enter Employee ID:</label>
										<input type="text" name="fid12" id="fid12" placeholder="Ex: 27">
										<label for="start_date12">Enter Start Time:</label>
										<input type="text" name="start_date12" id="start_date12" placeholder="Ex: 2000-03-03">
										<label for="end_date12">Enter End Time:</label>
										<input type="text" name="end_date12" id="end_date12" placeholder="Ex: 2023-03-25">
										<input id = "submit-btn" type="submit" name="submit12" value="Submit">
									</form>
									<?php
									echo "<h2>Query 12</h2>";
									if(isset($_POST['submit12']))
									{
										$fid12 = $_POST['fid12'];
										
										$sd12 = $_POST['start_date12'];

										$ed12 = $_POST['end_date12'];
										

										echo "Displaying Employee ID: $fid12  <br>";
											echo "Scheduled between:$sd12 ";
											echo "and: $ed12 <br>";
											$con=mysqli_connect("localhost","root","","database1");
										// Execute query 12
										$query = "SELECT role, SUM(TIMEDIFF(end_time, start_time))DIV 10000 AS total_hours  
										FROM EmployeeSchedule, EmployeeRole, EmployedHistory 
										WHERE EmployedHistory.employeerole_id=EmployeeRole.id AND EmployeeSchedule.employee_id = EmployedHistory.employee_id 
										AND EmployeeSchedule.facility_id=EmployedHistory.facility_id AND EmployedHistory.facility_id='$fid12' AND (date BETWEEN '$sd12' AND '$ed12') 
										GROUP BY role
										ORDER BY role ASC";
										$result = mysqli_query($con, $query);
										// Output results in a table
										echo "<table>";
										echo "<tr><th>Role</th><th>Total Hours</th></tr>";
										while ($row = mysqli_fetch_array($result)) {
										echo "<tr>";
										echo "<td>" . $row['role'] . "</td>";
										echo "<td>" . $row['total_hours'] . "</td>";
										
										echo "</tr>";
										}
										echo "</table>";
										mysqli_close($con);
									}
                            		?>
									</div>
									<!-- Query 13 logic -->
									<div class="queries" id="13" style="display: none">
									<?php
									echo "<h2>Query 13</h2>";
									$con=mysqli_connect("localhost","root","","database1");
									// Execute query 13
									$query = "SELECT DISTINCT Facility.province, Facility.name AS facility, Facility.capacity, 
									COUNT(DISTINCT Was_Infected.employee_id) AS 'Infected Employees'
									FROM Facility, EmployedHistory, Employee, Was_Infected
									WHERE Facility.id = EmployedHistory.facility_id AND Employee.id = EmployedHistory.employee_id 
									AND Employee.id = Was_Infected.employee_id AND DATEDIFF(CURRENT_DATE(), Was_Infected.date)<=14
									GROUP BY Facility.name
									ORDER BY Facility.province ASC, COUNT(DISTINCT Was_Infected.employee_id) ASC";
									$result = mysqli_query($con, $query);
									// Output results in a table
									echo "<table>";
									echo "<tr><th>Province</th><th>Facility Name</th><th>Capacity</th><th>Infected Employees</th></tr>";
									while ($row = mysqli_fetch_array($result)) {
									echo "<tr>";
									echo "<td>" . $row['province'] . "</td>";
									echo "<td>" . $row['facility'] . "</td>";
									echo "<td>" . $row['capacity'] . "</td>";
									echo "<td>" . $row['Infected Employees'] . "</td>";
									
									echo "</tr>";
									}
									echo "</table>";
									mysqli_close($con);
                            		?>
									</div>
									<!-- Query 14 logic -->
									<div class="queries" id="14" style="display: none">
									<?php
									echo "<h2>Query 14</h2>";
									$con=mysqli_connect("localhost","root","","database1");
									// Execute query 14
									$query = "SELECT first_name, last_name, Employee.city, COUNT(employee_id) AS nb_of_facilities  
									FROM EmployedHistory, Employee, Facility    WHERE Facility.province ='QC' AND EmployedHistory.employeerole_id = 2 AND EmployedHistory.facility_id=Facility.id 
									AND Employee.id=EmployedHistory.employee_id AND end_date IS NULL 
									GROUP BY employee_id 
									ORDER BY city ASC, COUNT(employee_id) DESC";
									$result = mysqli_query($con, $query);
									// Output results in a table
									echo "<table>";
									echo "<tr><th>First Name</th><th>Last Name</th><th>City</th><th>Number of Facilities</th></tr>";
									while ($row = mysqli_fetch_array($result)) {
									echo "<tr>";
									echo "<td>" . $row['first_name'] . "</td>";
									echo "<td>" . $row['last_name'] . "</td>";
									echo "<td>" . $row['city'] . "</td>";
									echo "<td>" . $row['nb_of_facilities'] . "</td>";
									
									echo "</tr>";
									}
									echo "</table>";
									mysqli_close($con);
                            		?>
									</div>
									<!-- Query 15 logic -->
									<div class="queries" id="15" style="display: none">
									<?php
									echo "<h2>Query 15</h2>";
									$con=mysqli_connect("localhost","root","","database1");
									// Execute query 15
									$query = "SELECT first_name, last_name, start_date, dob, email, SUM(TIMEDIFF(end_time, start_time))DIV 10000 AS total_hours 
									FROM EmployedHistory, Employee, EmployeeSchedule 
									WHERE employeerole_id=1 AND end_date IS NULL AND EmployeeSchedule.employee_id = EmployedHistory.employee_id AND Employee.id=EmployedHistory.employee_id";
									$result = mysqli_query($con, $query);
									// Output results in a table
									echo "<table>";
									echo "<tr><th>First Name</th><th>Last Name</th><th>Start Date</th><th>Date of Birth</th><th>Email</th><th>Total Hours</th></tr>";
									while ($row = mysqli_fetch_array($result)) {
									echo "<tr>";
									echo "<td>" . $row['first_name'] . "</td>";
									echo "<td>" . $row['last_name'] . "</td>";
									echo "<td>" . $row['start_date'] . "</td>";
									echo "<td>" . $row['dob'] . "</td>";
									echo "<td>" . $row['email'] . "</td>";
									echo "<td>" . $row['total_hours'] . "</td>";
									
									echo "</tr>";
									}
									echo "</table>";
									mysqli_close($con);
                            		?>
									</div>
									<!-- Query 16 logic -->
									<div class="queries" id="16" style="display: none">
									<?php
									echo "<h2>Query 16</h2>";
									$con=mysqli_connect("localhost","root","","database1");
									// Execute query 16
									$query = "SELECT Employee.first_name , Employee.last_name , EmployedHistory.start_date AS 'First Work Day', 
									EmployeeRole.role, Employee.dob, Employee.email, 
									COALESCE((SELECT SUM(HOUR(TIMEDIFF(end_time, start_time)))
									FROM EmployeeSchedule 
									WHERE employee_id = Employee.id), 0) as 'Hours Scheduled'
									FROM Employee, Facility, EmployedHistory, EmployeeRole, Was_Infected 
									WHERE Employee.id = EmployedHistory.employee_id 
									AND EmployedHistory.facility_id = Facility.id 
									AND EmployedHistory.employeerole_id = EmployeeRole.id 
									AND Employee.id = Was_Infected.employee_id
									AND EmployedHistory.end_date IS NULL
									AND (EmployeeRole.role = 'Nurse' OR EmployeeRole.role = 'Doctor')
									GROUP BY Employee.id 
									HAVING COUNT(Employee.id) >= 3
									ORDER BY EmployeeRole.role, Employee.first_name, Employee.last_name";
									$result = mysqli_query($con, $query);
									// Output results in a table
									echo "<table>";
									echo "<tr><th>First Name</th><th>Last Name</th><th>First Work Day</th><th>Role</th><th>Date of Birth</th><th>Email</th><th>Hours Scheduled</th></tr>";
									while ($row = mysqli_fetch_array($result)) {
									echo "<tr>";
									echo "<td>" . $row['first_name'] . "</td>";
									echo "<td>" . $row['last_name'] . "</td>";
									echo "<td>" . $row['First Work Day'] . "</td>";
									echo "<td>" . $row['role'] . "</td>";
									echo "<td>" . $row['dob'] . "</td>";
									echo "<td>" . $row['email'] . "</td>";
									echo "<td>" . $row['Hours Scheduled'] . "</td>";
									
									echo "</tr>";
									}
									echo "</table>";
									mysqli_close($con);
                            		?>
									</div>
									<!-- Query 17 logic -->
									<div class="queries" id="17" style="display: none">
									<?php
									echo "<h2>Query 17</h2>";
									$con=mysqli_connect("localhost","root","","database1");
									// Execute query 17
									$query = "SELECT Employee.first_name , Employee.last_name , EmployedHistory.start_date AS 'First Work Day', 
									EmployeeRole.role, Employee.dob, Employee.email, 
									COALESCE((SELECT SUM(HOUR(TIMEDIFF(end_time, start_time)))
									FROM EmployeeSchedule 
									WHERE employee_id = Employee.id), 0) as 'Hours Scheduled'
									FROM Employee, Facility, EmployedHistory, EmployeeRole
									WHERE Employee.id = EmployedHistory.employee_id 
									AND EmployedHistory.facility_id = Facility.id 
									AND EmployedHistory.employeerole_id = EmployeeRole.id 
									AND EmployedHistory.end_date IS NULL
									AND (EmployeeRole.role = 'Nurse' OR EmployeeRole.role = 'Doctor')
									AND Employee.id NOT IN (SELECT employee_id FROM Was_Infected)
							 		ORDER BY EmployeeRole.role, Employee.first_name, Employee.last_name";
									$result = mysqli_query($con, $query);
									// Output results in a table
									echo "<table>";
									echo "<tr><th>First Name</th><th>Last Name</th><th>First Work Day</th><th>Role</th><th>Date of Birth</th><th>Email</th><th>Hours Scheduled</th></tr>";
									while ($row = mysqli_fetch_array($result)) {
									echo "<tr>";
									echo "<td>" . $row['first_name'] . "</td>";
									echo "<td>" . $row['last_name'] . "</td>";
									echo "<td>" . $row['First Work Day'] . "</td>";
									echo "<td>" . $row['role'] . "</td>";
									echo "<td>" . $row['dob'] . "</td>";
									echo "<td>" . $row['email'] . "</td>";
									echo "<td>" . $row['Hours Scheduled'] . "</td>";
									
									echo "</tr>";
									}
									echo "</table>";
									mysqli_close($con);
                            		?>
									</div>
                                    <div class="queries" id="18" style="display: none">
                                        <?php
                                        echo "<h2>Query 18</h2>";
                                        echo "<h3>You should show the trigger(s) used by your system</h3>";
                                        // Execute query 8
                                        $query = "SHOW TRIGGERS FROM database1;";
                                        
                                        exec_query_to_table($query);
                                        ?>
                                    </div>
                           
								<script>
                                    function activate_query(n) {
                                        var current_query = document.getElementById(n);
                                        var all_queries = document.getElementsByClassName("queries");
                                        for (var i = 0; i < all_queries.length; i++) {
                                            all_queries[i].style.display = "none";
                                        }
                                        current_query.style.display = "block";
                                    }                                
								
							

							
								function sendEmails() {
									
								// Make an AJAX call to mailing.php and call BuildEmails() function
								var xhr = new XMLHttpRequest();
								xhr.open("POST", "mailing.php", true);
								xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
								xhr.onreadystatechange = function() {
									if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
									alert("Emails sent successfully!");
									}
								}
								xhr.send("function=BuildEmails");
								}

								function sendEmailsInfections($InfectedID) {
									
									// Make an AJAX call to mailing.php and call BuildEmailsInfection() function
									var xhr = new XMLHttpRequest();
									xhr.open("POST", "mailing.php", true);
									xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
									xhr.onreadystatechange = function() {
										if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
										alert("Emails sent successfully!");
										}
									}
									xhr.send("function=BuildEmailsInfectionAuto&infectedID=".$InfectedID);
									}
							</script>
										
						
					</div>
				</section>
				
			</div>
				

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>