<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";

/*echo SendEmail("CLSC
Outremont Schedule for Monday 20-Feb-2023 to Sunday 26-Feb-2023", "Nothing to display for now."); */

//echo BuildEmails(); 

//echo BuildEmailsInfection(37); 

$function = $_POST["function"];

if ($function == "BuildEmails") {
    BuildEmails(); 
}
else if ($function == " BuildEmailsInfection") {
    BuildEmailsInfectionAuto();
}


function BuildEmails(){
  
    echo "<p> Here A</p>";    

    $con=mysqli_connect("localhost","root","","database1");
    //echo "<p>".$con."</p>";
    $query = "SELECT Employee.id, Facility.name, Facility.address, Employee.first_name, Employee.last_name, Employee.email, EmployeeSchedule.date, EmployeeSchedule.start_time, EmployeeSchedule.end_time 
    FROM Facility, Employee, EmployeeSchedule 
    WHERE Facility.id = EmployeeSchedule.facility_id 
    AND Employee.id = EmployeeSchedule.employee_id 
    AND EmployeeSchedule.date BETWEEN NOW() AND (NOW() + INTERVAL 14 DAY) 
    AND Employee.id in (SELECT EmployedHistory.employee_id FROM EmployedHistory WHERE EmployedHistory.end_date IS NULL) 
    ORDER BY Facility.name, Employee.id, EmployeeSchedule.date, EmployeeSchedule.start_time;";
    //echo "<p>".$query."</p>";

   
    
    
    $result = mysqli_query($con, $query);
  
   
    $idsAlreadySent = array();

    while($row = mysqli_fetch_assoc($result))
    {
       

       $currentID = $row['id']; 
       $currentIDFull = $row['id'].$row['name']; 
       if(in_array($currentIDFull, $idsAlreadySent)){
            continue; 
       }
       else{
            

            date_default_timezone_set('America/Los_Angeles');
            $date = date("Y-m-d", time());
            $dayofweek = date('l', strtotime($date));

            $date2 = date("Y-m-d", strtotime("+1 week"));
            $dayofweek2 = date('l', strtotime($date2));

            $subject = $row['name']." Schedule for ". $dayofweek. " ". $date  . " to  ".$dayofweek2. " ". $date2  ;
            $body = "<table>"; 
            $body = $body."<tr><th>Employee ID</th><th>Facility Name</th><th>Facility Address</th><th>Employee First Name</th><th>Employee Last Name</th><th>Email</th><th>Date</th><th>Start Time</th><th>End Time</th></tr>";

            $result2 = mysqli_query($con, $query);
            while($row2 = mysqli_fetch_assoc($result2))
            {
                if($row2['id'].$row2['name']== $currentIDFull){
                    $body = $body."\n"."<tr><td>" . implode("</td><td>",$row2) . "</td></tr>"; 
                }
            }

            $body = $body."\n"."</table>";

            
            SendEmail($subject, $body);
            array_push($idsAlreadySent, $currentID); 

            //$queryLog = "INSERT INTO `EmailLog` VALUES (".$date.",". $row['name'] .",". $row['email'].", ". substr($subject, 0, 200) .", ". substr($body, 0, 80).") ;";
            $queryLog = "INSERT INTO `EmailLog`(`date`, `facility_name`, `receiver_email`, `subject`, `body`) VALUES ('".date("Y-m-d H:i:s", time())."','".$row['name']."','".$row['email']."','".substr($subject, 0, 200)."','".substr($body, 0, 80)."');";  
            $resultLog = mysqli_query($con, $queryLog);
       }

    }
   
    mysqli_close($con);
    
}

function BuildEmailsInfection($IDOfInfectedEmployee){
  
   
    $con=mysqli_connect("localhost","root","","database1");
    $query = "SELECT EmployeeSchedule.employee_id, EmployeeSchedule.facility_id, Employee.first_name, Employee.last_name, Employee.email, Facility.name 
    FROM `EmployeeSchedule`, Employee, Facility 
    WHERE EmployeeSchedule.facility_id 
    IN (SELECT EmployeeSchedule.facility_id FROM EmployeeSchedule WHERE EmployeeSchedule.employee_id = $IDOfInfectedEmployee AND EmployeeSchedule.date BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW()) 
    AND EmployeeSchedule.date 
    IN (SELECT EmployeeSchedule.date FROM EmployeeSchedule WHERE EmployeeSchedule.employee_id = $IDOfInfectedEmployee AND EmployeeSchedule.date BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW()) 
    AND Facility.id = EmployeeSchedule.facility_id 
    AND Employee.id = EmployeeSchedule.employee_id 
    GROUP BY EmployeeSchedule.employee_id;";
    
    
    $result = mysqli_query($con, $query);
  
    
      
    $idsAlreadySent = array();

    while($row = mysqli_fetch_assoc($result))
    {
       
       $currentID = $row['id']; 
       $currentIDFull = $row['id'].$row['name']; 
       if(in_array($currentIDFull, $idsAlreadySent)){
            continue; 
       }
       else{
            

            

            $subject = "Warning To ".$row['first_name']." ".$row['last_name']; 
            $body = "Sent to ".$row['email']. " From ".$row['name']; 
            $body = $body."<br><br> One of your colleagues that you have worked with in the past two weeks has been infected with COVID-19.";

            
            
            SendEmail($subject, $body);
            array_push($idsAlreadySent, $currentID); 

            //$queryLog = "INSERT INTO `EmailLog` VALUES (".$date.",". $row['name'] .",". $row['email'].", ". substr($subject, 0, 200) .", ". substr($body, 0, 80).") ;";
            $queryLog = "INSERT INTO `EmailLog`(`date`, `facility_name`, `receiver_email`, `subject`, `body`) VALUES ('".date("Y-m-d H:i:s", time())."','".$row['name']."','".$row['email']."','".substr($subject, 0, 200)."','".substr($body, 0, 80)."');";  
            $resultLog = mysqli_query($con, $queryLog);
       }

    }
   
    mysqli_close($con);
    
}

function BuildEmailsInfectionAuto(){
  
    if(!isset($_POST["infectedID"])){
        return; 
    }
    $IDOfInfectedEmployee = $_POST["infectedID"];

    $con=mysqli_connect("localhost","root","","database1");
    $query = "SELECT EmployeeSchedule.employee_id, EmployeeSchedule.facility_id, Employee.first_name, Employee.last_name, Employee.email, Facility.name 
    FROM `EmployeeSchedule`, Employee, Facility 
    WHERE EmployeeSchedule.facility_id 
    IN (SELECT EmployeeSchedule.facility_id FROM EmployeeSchedule WHERE EmployeeSchedule.employee_id = $IDOfInfectedEmployee AND EmployeeSchedule.date BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW()) 
    AND EmployeeSchedule.date 
    IN (SELECT EmployeeSchedule.date FROM EmployeeSchedule WHERE EmployeeSchedule.employee_id = $IDOfInfectedEmployee AND EmployeeSchedule.date BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW()) 
    AND Facility.id = EmployeeSchedule.facility_id 
    AND Employee.id = EmployeeSchedule.employee_id 
    GROUP BY EmployeeSchedule.employee_id;";
    
    
    $result = mysqli_query($con, $query);

    
  
    $idsAlreadySent = array();

    while($row = mysqli_fetch_assoc($result))
    {
       
       $currentID = $row['id']; 
       $currentIDFull = $row['id'].$row['name']; 
       if(in_array($currentIDFull, $idsAlreadySent)){
            continue; 
       }
       else{
            

            

            $subject = "Warning To ".$row['first_name']." ".$row['last_name']; 
            $body = "Sent to ".$row['email']. " From ".$row['name']; 
            $body = $body."<br><br> One of your colleagues that you have worked with in the past two weeks has been infected with COVID-19.";

            
            
            SendEmail($subject, $body);
            array_push($idsAlreadySent, $currentID); 

            //$queryLog = "INSERT INTO `EmailLog` VALUES (".$date.",". $row['name'] .",". $row['email'].", ". substr($subject, 0, 200) .", ". substr($body, 0, 80).") ;";
            $queryLog = "INSERT INTO `EmailLog`(`date`, `facility_name`, `receiver_email`, `subject`, `body`) VALUES ('".date("Y-m-d H:i:s", time())."','".$row['name']."','".$row['email']."','".substr($subject, 0, 200)."','".substr($body, 0, 80)."');";  
            $resultLog = mysqli_query($con, $queryLog);
       }

    }
   
    mysqli_close($con);
    
}
function SendEmail($subject, $body){
//PHPMailer Object
$mail = new PHPMailer(true); //Argument true in constructor enables exceptions


//Host information:
    $mail->SMTPDebug = 2;
    $mail->SMTPSecure = 'ssl';                                      
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                   
    $mail->SMTPAuth   = true;                            
    $mail->Username   = 'lolantoalex@gmail.com';                
    $mail->Password   = 'lolantoalex91!';                       
    $mail->SMTPSecure = 'tls';                             
    $mail->Port       = 587; 
 
//From email address and name
$mail->From = "lolantoalex@gmail.com";
$mail->FromName = "HFESTS";

//To address and name

$mail->addAddress("lolantoalex@gmail.com"); //Recipient locked due to dummy data

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = $subject;
$mail->Body = $body;


try {
    $mail->send();
    echo "Message has been sent successfully";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
}
