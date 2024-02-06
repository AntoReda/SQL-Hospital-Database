<!DOCTYPE HTML>

<!--
	Hyperspace by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>



	<head>
	
		<title>COMP 353 Final Project</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	
		<!--Table Edit Scripts-->
		
	
	</head>
	<body class>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
					
					<script type="text/javascript">
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


<?php
					
						$con=mysqli_connect("localhost","root","","database1");

						// Check connection
						if (mysqli_connect_errno())
						{
							echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}

						//Test Logic
						$result = mysqli_query($con,"SELECT * FROM test") or die(mysqli_error($this->db_link));

						$index =0;

						while($row = mysqli_fetch_array($result))
						{
							$testName[$index] = $row['name'];
							$testAge[$index] = $row['age'];
							$testDOB[$index] = $row['DOB'];
							$index++;
						}


						

						//Removing entries
						for($i=0; $i<$index; $i++)
						{
							//the 'deletesubmit' is the name = ... to our different buttons which actually change dynamically using . $index . (the periods are used like concat in php)
							if (isset($_POST['deletesubmit0'. ($i+1)])) 
							{
								$name = $testName[$i];
								$age = $testAge[$i];
								$dob = $testDOB[$i];

							$sql = "DELETE FROM test WHERE name='$name' AND age='$age' AND DOB='$dob'";
							mysqli_query($con, $sql);
								
							}
							//Editing entries	
							if (isset($_POST['editsubmit0'. ($i+1)])) 
							{
								$name = $testName[$i];
								$age = $testAge[$i];
								$dob = $testDOB[$i];

								$editName = $_POST['editName'];
								$editAge = $_POST['editAge'];
								$editDob = $_POST['editDOB'];
							if($editName==NULL && $editAge==NULL&&$editDob==NULL)
							{
								
								header('Location: index_Admin.php');//do nothing
							}
							else
							if($editName==NULL && $editAge==NULL)
							{
								$sql = "UPDATE test SET DOB ='$editDob' WHERE name='$name'AND age='$age' AND DOB='$dob' ";
							}
							else
							if($editName==NULL && $editDob==NULL)
							{
								$sql = "UPDATE test SET age ='$editAge' WHERE name='$name'AND age='$age' AND DOB='$dob' ";
							}
							else
							if($editDob==NULL && $editAge==NULL)
							{
								$sql = "UPDATE test SET name='$editName' WHERE name='$name'AND age='$age' AND DOB='$dob' ";
							}
							else
							if($editName==NULL)
							{
								$sql = "UPDATE test SET age ='$editAge',DOB ='$editDob' WHERE name='$name'AND age='$age' AND DOB='$dob' ";
							}
							else
							if($editAge==NULL)
							{
								$sql = "UPDATE test SET name='$editName',DOB ='$editDob' WHERE name='$name'AND age='$age' AND DOB='$dob' ";
							}
							else
							if($editDob==NULL)
							{
								$sql = "UPDATE test SET name='$editName', age ='$editAge' WHERE name='$name'AND age='$age' AND DOB='$dob' ";
							}
							else
							$sql = "UPDATE test SET name='$editName', age ='$editAge',DOB ='$editDob' WHERE name='$name'AND age='$age' AND DOB='$dob' ";
							mysqli_query($con, $sql);
								
							}	
						}


						//Adding entries
						if(isset($_POST['submit'])) {
							$name = $_POST['Testname'];
							$age = $_POST['Testage'];
							$dob = $_POST['TestDOB'];

							$sql = "INSERT INTO test VALUES ('$name', '$age', '$dob')";
							mysqli_query($con, $sql);

						}
						/////////End of TEST//////////
						

						//Employee Logic
						$result = mysqli_query($con,"SELECT * FROM Employee") or die(mysqli_error($this->db_link));

						$index =0;

						while($row = mysqli_fetch_array($result))
						{
							$EmpId[$index] = $row['id'];
							$EmpFName[$index] = $row['first_name'];
							$EmpLName[$index] = $row['last_name'];
							$EmpDob[$index] = $row['dob'];
							$EmpCitizenship[$index] = $row['citizenship'];
							$EmpEmail[$index] = $row['email'];
							$EmpPcode[$index] = $row['postal_code'];
							$EmpProvince[$index] = $row['province'];
							$EmpCity[$index] = $row['city'];
							$EmpAddress[$index] = $row['address'];
							$EmpPhone[$index] = $row['phone'];
							$EmpMedicare[$index] = $row['medicare'];
							$index++;
						}

						
						for($i=0; $i<$index; $i++)
						{
							//Removing Entries
							if (isset($_POST['deleteEmp'. (($i+1))])) 
							{

								$id = $EmpId[$i];
								$first_name = $EmpFName[$i];
								$last_name = $EmpLName[$i];
								$dob = $EmpDob[$i];
								$citizenship = $EmpCitizenship[$i];
								$email = $EmpEmail[$i];
								$postal_code = $EmpPcode[$i];
								$province = $EmpProvince[$i];
								$city = $EmpCity[$i];
								$address = $EmpAddress[$i];
								$phone = $EmpPhone[$i];
								$medicare = $EmpMedicare[$i];

							$sql = "DELETE FROM Employee WHERE id='$id'";
							mysqli_query($con, $sql);
								
							}
							//Editing entries	
							if (isset($_POST['editSubmitEmp'. ($i+1)])) 
							{
								try{
								$id = $EmpId[$i];
								$first_name = $EmpFName[$i] ;
								$last_name = $EmpLName[$i];
								$dob = $EmpDob[$i];
								$citizenship = $EmpCitizenship[$i];
								$email = $EmpEmail[$i];
								$postal_code = $EmpPcode[$i];
								$province = $EmpProvince[$i];
								$city = $EmpCity[$i];
								$address = $EmpAddress[$i];
								$phone = $EmpPhone[$i];
								$medicare = $EmpMedicare[$i];

								$editid = $_POST['editEmpId'];
								$editfirst_name =$_POST['editEmpFName'];
								$editlast_name = $_POST['editEmpLName'];
								$editdob =$_POST['editEmpDob'];
								$editcitizenship = $_POST['editEmpCitizenship'];
								$editemail = $_POST['editEmpEmail'];
								$editpostal_code =$_POST['editEmpPCode'];
								$editprovince = $_POST['editEmpProvince'];
								$editcity = $_POST['editEmpCity'];
								$editaddress = $_POST['editEmpAddress'];
								$editphone = $_POST['editEmpPhone'];
								$editmedicare = $_POST['editEmpMedicare'];

								$sql = "UPDATE Employee SET id='$editid', first_name ='$editfirst_name', last_name= '$editlast_name',dob ='$editdob', citizenship = '$editcitizenship',email ='$editemail',postal_code ='$editpostal_code',province = '$editprovince', city = '$editcity', address ='$editaddress', phone ='$editphone', medicare = '$editmedicare'  WHERE id='$id'";
								mysqli_query($con, $sql);
								if (mysqli_error($con)) 
									{
										throw new Exception(mysqli_error($con));
									}
								} catch (Exception $e) {
									header('Location: index_Admin.php?error=' . urlencode($e->getMessage()));
									exit();
									}	
							}
							}
							
						
						//Adding entries
						if(isset($_POST['submit1'])) {
							try{
							$id = $_POST['empId'];
							$first_name =$_POST['empFName'];
							$last_name = $_POST['empLName'];
							$dob =$_POST['empDob'];
							$citizenship = $_POST['empCitizenship'];
							$email = $_POST['empEmail'];
							$postal_code =$_POST['empPCode'];
							$province = $_POST['empProvince'];
							$city = $_POST['empCity'];
							$address = $_POST['empAddress'];
							$phone = $_POST['empPhone'];
							$medicare = $_POST['empMedicare'];

							$sql = "INSERT INTO Employee VALUES ('$id', '$first_name', '$last_name','$dob', '$citizenship', '$email','$postal_code', '$province', '$city','$address','$phone','$medicare')";
							mysqli_query($con, $sql);
							if (mysqli_error($con)) 
									{
										throw new Exception(mysqli_error($con));
									}
								} catch (Exception $e) {
									header('Location: index_Admin.php?error=' . urlencode($e->getMessage()));
									exit();
									}	
							}

						


						// //Facility Logic
						$result = mysqli_query($con,"SELECT * FROM Facility") or die(mysqli_error($this->db_link));

						$index =0;

						while($row = mysqli_fetch_array($result))
						{
							$FacId[$index] = $row['id'];
							$FacName[$index] = $row['name'];
							$FacAddress[$index] = $row['address'];
							$FacCity[$index] = $row['city'];
							$FacProvince[$index] = $row['province'];
							$FacPcode[$index] = $row['postal_code'];
							$FacPhone[$index] = $row['phone'];
							$FacWeb[$index] = $row['web_address'];
							$FacCapacity[$index] = $row['capacity'];
							$FacFacility[$index] = $row['facilitytype_id'];
							$index++;
						}

						//Removing entries
						for($i=0; $i<$index; $i++)
						{
							//the 'deletesubmit' is the name = ... to our different buttons which actually change dynamically using . $index . (the periods are used like concat in php)
							if (isset($_POST['deleteFacility'. ($i+1)])) 
							{
								$id = $FacId[$i] ;
								$name = $FacName[$i] ;
								$address = $FacAddress[$i] ;
								$city = $FacCity[$i] ;
								$province = $FacProvince[$i] ;
								$pCode = $FacPcode[$i] ;
								$phone = $FacPhone[$i];
								$web = $FacWeb[$i] ;
								$capacity = $FacCapacity[$i] ;
								$facility = $FacFacility[$i];

								$sql = "DELETE FROM Facility WHERE id='$id'";
								mysqli_query($con, $sql);
								
							}
							//Editing entries	
							if (isset($_POST['editSubmitFacility'. ($i+1)])) 
							{
								try{
								$id = $FacId[$i] ;
								$name = $FacName[$i] ;
								$address = $FacAddress[$i] ;
								$city = $FacCity[$i] ;
								$province = $FacProvince[$i] ;
								$pCode = $FacPcode[$i] ;
								$phone = $FacPhone[$i];
								$web = $FacWeb[$i] ;
								$capacity = $FacCapacity[$i] ;
								$facility = $FacFacility[$i];
								
								$editid = $_POST['editfacId'];
								$editname = $_POST['editfacName'];
								$editaddress = $_POST['editfacAddress'];
								$editcity = $_POST['editfacCity'];
								$editprovince = $_POST['editfacProvince'];
								$editpCode = $_POST['editfacPCode'];
								$editphone = $_POST['editfacPhone'];
								$editweb = $_POST['editfacWeb'];
								$editcapacity = $_POST['editfacCapacity'];
								$editfacility = $_POST['editfacTypeId'];
								$sql = "UPDATE Facility SET id='$editid', name = '$editname', address ='$editaddress',city = '$editcity', province ='$editprovince', postal_code ='$editpCode',phone ='$editphone', web_address ='$editweb', capacity='$editcapacity',facilitytype_id='$editfacility' WHERE id ='$id'";
								mysqli_query($con, $sql);
								if (mysqli_error($con)) 
									{
										throw new Exception(mysqli_error($con));
									}
								} catch (Exception $e) {
									header('Location: index_Admin.php?error=' . urlencode($e->getMessage()));
									exit();
									}	
							}
						}
						//Adding entries
						if(isset($_POST['submit2'])) {
							try{
							$id = $_POST['facId'];
							$name = $_POST['facName'];
							$address = $_POST['facAddress'];
							$city = $_POST['facCity'];
							$province = $_POST['facProvince'];
							$pCode = $_POST['facPcode'];
							$phone = $_POST['facPhone'];
							$web = $_POST['facWeb'];
							$capacity = $_POST['facCapacity'];
							$facility = $_POST['facTypeId'];

							$sql = "INSERT INTO Facility VALUES ('$id', '$name', '$address','$city', '$province', '$pCode','$phone', '$web', '$capacity','$facility')";
							mysqli_query($con, $sql);
							if (mysqli_error($con)) 
									{
										throw new Exception(mysqli_error($con));
									}
								} catch (Exception $e) {
									header('Location: index_Admin.php?error=' . urlencode($e->getMessage()));
									exit();
									}	
							}

						

						//Vaccination Logic
						$result = mysqli_query($con,"SELECT * FROM Vaccination") or die(mysqli_error($this->db_link));

						$index =0;

						while($row = mysqli_fetch_array($result))
						{
							$VaxId[$index] = $row['id'];
							$VaxType[$index] = $row['type'];
							
							$index++;
						}

						//Removing entries
						for($i=0; $i<$index; $i++)
						{
							//the 'deletesubmit' is the name = ... to our different buttons which actually change dynamically using . $index . (the periods are used like concat in php)
							if (isset($_POST['deleteVax'. ($i+1)])) 
							{
								$id = $VaxId[$i] ;
								$type = $VaxType[$i] ;

								$sql = "DELETE FROM Vaccination WHERE id='$id'";
								mysqli_query($con, $sql);
								
							}
							//Editing entries	
							if (isset($_POST['editSubmitVax'. ($i+1)])) 
							{
								try{
								$id = $VaxId[$i] ;
								$type = $VaxType[$i] ;
								
								
								$editid = $_POST['editvaxId'];
								$edittype = $_POST['editvaxType'];
								
								$sql = "UPDATE Vaccination SET id='$editid', type = '$edittype' WHERE id ='$id'";
								mysqli_query($con, $sql);
								if (mysqli_error($con)) 
								{
									throw new Exception(mysqli_error($con));
								}
							} catch (Exception $e) {
								header('Location: index_Admin.php?error=' . urlencode($e->getMessage()));
								exit();
								}	
						}

							}
						
						//Adding entries
						if(isset($_POST['submit6'])) {

							
							try{
							$id = $_POST['vaxId'];
							$type = $_POST['vaxType'];
							

							$sql = "INSERT INTO 'Vaccination' VALUES ('$id', '$type')";
							mysqli_query($con, $sql);
							if (mysqli_error($con)) 
									{
										throw new Exception(mysqli_error($con));
									}
								} catch (Exception $e) {
									header('Location: index_Admin.php?error=' . urlencode($e->getMessage()));
									exit();
									}	
							

						}
						//Was_Vaccinated Logic
						$result = mysqli_query($con,"SELECT * FROM Was_Vaccinated") or die(mysqli_error($this->db_link));

						$index =0;

						while($row = mysqli_fetch_array($result))
						{
							$WvEmpID[$index] = $row['employee_id'];
							$WvVaxID[$index] = $row['vaccination_id'];
							$WvDoseNum[$index] = $row['dose_number'];
							$WvLocation[$index] = $row['location'];
							$WvDate[$index] = $row['date'];
							
							$index++;
						}

						//Removing entries
						for($i=0; $i<$index; $i++)
						{
							//the 'deletesubmit' is the name = ... to our different buttons which actually change dynamically using . $index . (the periods are used like concat in php)
							if (isset($_POST['deleteWasVax'. ($i+1)])) 
							{
								$EmpId = $WvEmpID[$i] ;
								$VaxID = $WvVaxID[$i] ;
								$DN = $WvDoseNum[$i] ;
								$Location = $WvLocation[$i] ;
								$Date = $WvDate[$i] ;

								$sql = "DELETE FROM Was_Vaccinated WHERE employee_id='$EmpId' AND dose_number='$DN' ";
								mysqli_query($con, $sql);
								
							}
							//Editing entries	
							if (isset($_POST['editSubmitWasVax'. ($i+1)])) 
							{
								try{
									$EmpId = $WvEmpID[$i] ;
									$VaxID = $WvVaxID[$i] ;
									$DN = $WvDoseNum[$i] ;
									$Location = $WvLocation[$i] ;
									$Date = $WvDate[$i] ;
								
								
								$editEmpId = $_POST['editvaxEmpId'];
								$editVaxId = $_POST['editvaxID'];
								$editDN = $_POST['editvaxDn'];
								$editLocation = $_POST['editvaxLocation'];
								$editDate = $_POST['editvaxDate'];
								
								$sql = "UPDATE Was_Vaccinated SET employee_id='$editEmpId', vaccination_id = '$editVaxId', dose_number ='$editDN',location='$editLocation', date = '$editDate' WHERE employee_id ='$EmpId'AND dose_number='$DN' ";
								mysqli_query($con, $sql);
								if (mysqli_error($con)) 
									{
										throw new Exception(mysqli_error($con));
									}
								} catch (Exception $e) {
									header('Location: index_Admin.php?error=' . urlencode($e->getMessage()));
									exit();
									}	
							}


							}

						//Adding entries
						if(isset($_POST['submit7'])) {
							try{
								$EmpId = $_POST['vaxEmpId'];
								$VaxId = $_POST['vaxID'];
								$DN = $_POST['vaxDn'];
								$Location = $_POST['vaxLocation'];
								$Date = $_POST['vaxDate'];
							
							
							$sql = "INSERT INTO Was_Vaccinated VALUES ('$EmpId', '$VaxId',$DN, $Location,'$Date' )";
							mysqli_query($con, $sql);
							
							
							
							if (mysqli_error($con)) 
									{
										throw new Exception(mysqli_error($con));
									}
								} catch (Exception $e) {
									header('Location: index_Admin.php?error=' . urlencode($e->getMessage()));
									exit();
									}	
									
									

						}




						//Infection Logic
						$result = mysqli_query($con,"SELECT * FROM Infection") or die(mysqli_error($this->db_link));

						$index =0;

						while($row = mysqli_fetch_array($result))
						{
							$InfectionId[$index] = $row['id'];
							$InfectionType[$index] = $row['type'];
							
							$index++;
						}

						//Removing entries
						for($i=0; $i<$index; $i++)
						{
							//the 'deletesubmit' is the name = ... to our different buttons which actually change dynamically using . $index . (the periods are used like concat in php)
							if (isset($_POST['deleteInfection'. ($i+1)])) 
							{
								$id = $InfectionId[$i] ;
								$type = $InfectionType[$i] ;

								$sql = "DELETE FROM Infection WHERE id='$id'";
								mysqli_query($con, $sql);
								
							}
							//Editing entries	
							if (isset($_POST['editSubmitInfection'. ($i+1)])) 
							{
								try{
								$id = $InfectionId[$i] ;
								$type = $InfectionType[$i] ;
								
								
								$editid = $_POST['editInfectionId'];
								$edittype = $_POST['editInfectionType'];
								
								$sql = "UPDATE Infection SET id='$editid', type = '$edittype' WHERE id ='$id'";
								mysqli_query($con, $sql);
								if (mysqli_error($con)) 
									{
										throw new Exception(mysqli_error($con));
									}
								} catch (Exception $e) {
									header('Location: index_Admin.php?error=' . urlencode($e->getMessage()));
									exit();
									}	
							}


							}
						
						//Adding entries
						if(isset($_POST['submit8'])) {
							try{
							$id = $_POST['InfectionId'];
							$type = $_POST['InfectionType'];
							

							$sql = "INSERT INTO Infection VALUES ('$id', '$type')";
							mysqli_query($con, $sql);
							if (mysqli_error($con)) 
									{
										throw new Exception(mysqli_error($con));
									}
								} catch (Exception $e) {
									header('Location: index_Admin.php?error=' . urlencode($e->getMessage()));
									exit();
									}	
							

						}

						//WasInfected Logic
						$result = mysqli_query($con,"SELECT * FROM Was_Infected") or die(mysqli_error($this->db_link));

						$index =0;

						while($row = mysqli_fetch_array($result))
						{
							$WiEmpID[$index] = $row['employee_id'];
							$WiInfectID[$index] = $row['infection_id'];
							$WiDate[$index] = $row['date'];
							
							$index++;
						}

						//Removing entries
						for($i=0; $i<$index; $i++)
						{
							//the 'deletesubmit' is the name = ... to our different buttons which actually change dynamically using . $index . (the periods are used like concat in php)
							if (isset($_POST['deleteWasInfect'. ($i+1)])) 
							{
								$EmpId = $WiEmpID[$i] ;
								$InfectId = $WiInfectID[$i] ;
								$Date = $WiDate[$i] ;

								$sql = "DELETE FROM Was_Infected WHERE employee_id='$EmpId' AND infection_id='$InfectId' AND date='$Date' ";
								mysqli_query($con, $sql);
								
							}
							//Editing entries	
							if (isset($_POST['editSubmitWasInfect'. ($i+1)])) 
							{
								try{
									$EmpId = $WiEmpID[$i] ;
									$InfectId = $WiInfectID[$i] ;
									$Date = $WiDate[$i] ;
								
								
								$editEmpId = $_POST['editWasInfectedEmpId'];
								$editInfectId = $_POST['editWasInfectedInfectId'];
								$editDate = $_POST['editWasInfectedDate'];
								
								$sql = "UPDATE Was_Infected SET employee_id='$editEmpId', infection_id = '$editInfectId', date = '$editDate' WHERE employee_id ='$EmpId'AND infection_id='$InfectId'AND date='$Date' ";
								mysqli_query($con, $sql);
								if (mysqli_error($con)) 
									{
										throw new Exception(mysqli_error($con));
									}
								} catch (Exception $e) {
									header('Location: index_Admin.php?error=' . urlencode($e->getMessage()));
									exit();
									}	
							}


							}
						
						//Adding entries
						if(isset($_POST['submit9'])) {
							try{
							$EmpId = $_POST['WasInfectEmpId'];
							$InfectionId = $_POST['WasInfectInfectId'];
							$Date = $_POST['WasInfectDate'];
							
							
							$sql = "INSERT INTO Was_Infected VALUES ('$EmpId', '$InfectionId','$Date' )";
							mysqli_query($con, $sql);
							
							
							
							if (mysqli_error($con)) 
									{
										throw new Exception(mysqli_error($con));
									}
								} catch (Exception $e) {
									header('Location: index_Admin.php?error=' . urlencode($e->getMessage()));
									exit();
									}	
							
							if (!mysqli_error($con)) {
								require_once('mailing.php');

								BuildEmailsInfection($EmpId);
								header('Location: index_Admin.php');

								//echo "sendEmailsInfections(".$EmpId.");";

								
							}
									
									

						}

						//EmployeeSchedule Logic
						$result = mysqli_query($con,"SELECT * FROM EmployeeSchedule") or die(mysqli_error($this->db_link));

						$index =0;

						while($row = mysqli_fetch_array($result))
						{
							$ScheduleEmpId[$index] = $row['employee_id'];
							$ScheduleFacId[$index] = $row['facility_id'];
							$ScheduleDate[$index] = $row['date'];
							$ScheduleST[$index] = $row['start_time'];
							$ScheduleET[$index] = $row['end_time'];
							
							$index++;
						}

						//Removing entries
						for($i=0; $i<$index; $i++)
						{
							//the 'deletesubmit' is the name = ... to our different buttons which actually change dynamically using . $index . (the periods are used like concat in php)
							if (isset($_POST['deleteSchedule'. ($i+1)])) 
							{
								$Eid = $ScheduleEmpId[$i] ;
								$Fid = $ScheduleFacId[$i] ;
								$date = $ScheduleDate[$i] ;
								$ST = $ScheduleST[$i] ;
								$ET = $ScheduleET[$i] ;

								$sql = "DELETE FROM EmployeeSchedule WHERE employee_id='$Eid' AND facility_id='$Fid' AND date='$date' AND start_time='$ST'";
								mysqli_query($con, $sql);
								
							}
							//Editing entries	
							if (isset($_POST['editSubmitSchedule'. ($i+1)])) 
							{
								try{
								$Eid = $ScheduleEmpId[$i] ;
								$Fid = $ScheduleFacId[$i] ;
								$date = $ScheduleDate[$i] ;
								$ST = $ScheduleST[$i] ;
								$ET = $ScheduleET[$i] ;
								
								
								$editEid = $_POST['editScheduleEmpId'];
								$editFid = $_POST['editScheduleFacId'];
								$editdate = $_POST['editScheduleDate'];
								$editST = $_POST['editScheduleST'];
								$editET = $_POST['editScheduleET'];
								
								$sql = "UPDATE EmployeeSchedule SET employee_id='$editEid', facility_id='$editFid',date='$editdate',start_time='$editST',end_time='$editET' WHERE employee_id ='$Eid' AND facility_id ='$Fid' AND date='$date' AND start_time='$ST' ";
								mysqli_query($con, $sql);
								if (mysqli_error($con)) 
									{
										throw new Exception(mysqli_error($con));
									}
								} catch (Exception $e) {
									header('Location: index_Admin.php?error=' . urlencode($e->getMessage()));
									exit();
									}	
							


							}
						}
						//Adding entries
						if(isset($_POST['submit10'])) {
							try{
							$Eid = $_POST['ScheduleEmpId'];
							$Fid = $_POST['ScheduleFacId'];
							$date = $_POST['ScheduleDate'];
							$ST = $_POST['ScheduleST'];
							$ET = $_POST['ScheduleET'];
							

							$sql = "INSERT INTO EmployeeSchedule VALUES ('$Eid', '$Fid', '$date','$ST','$ET')";
							mysqli_query($con, $sql);
							if (mysqli_error($con)) 
									{
										throw new Exception(mysqli_error($con));
									}
								} catch (Exception $e) {
									header('Location: index_Admin.php?error=' . urlencode($e->getMessage()));
									exit();
									}	
							

						}
                        header('Location: index_Admin.php');
						mysqli_close($con); 
                        
						
					?>
					</script>
					</br>
					<h2>Emails have been sent to all relevant parties who have come in contact with this employee in the last 2 weeks.</h2>
					<button  onclick="window.location.href='index.php'" > Back home </button>
					<button  onclick="window.location.href='index_Admin.php'" > Back to Admin Page </button>
					
	</body>
</html>
