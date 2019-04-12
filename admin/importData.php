<?php
session_start();

include("../includes/connections.php");
$user_name = $_SESSION['user_name'];

     $date_captured = date("y-m-d");
if(isset($_POST['importSubmit'])){
            $offtyp=$_SESSION['offtyp'];
            $offloc=$_SESSION['offloc']; 
            $mon=$_SESSION['mon'];
            $yer=$_SESSION['yer']; 
            $prog=$_SESSION['prog'];
            $ids=$_SESSION['id']; 
    //validate whether uploaded file is a csv file
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            //open uploaded csv file with read only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            //skip first line
            fgetcsv($csvFile);
            
            //parse data from csv file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                //check whether member already exists in database with same product_name
              //  $prevQuery = "SELECT id FROM unscheduled_part WHERE prog_title = '".$line[16]."'";
            //    $prevResult = $db->query($prevQuery);
             //   if($prevResult->num_rows > 0){
                    //update member data
               //     $db->query("UPDATE unscheduled_part SET office_type = '".$line[0]."', office_loc = '".$line[1]."', month = '".$line[2]."' WHERE prog_title = '".$line[16]."'");
              //  }else{
                    //insert member data into database
                      $db->query("INSERT INTO unscheduled_part (office_type, office_loc, month, year, name, org, gender, email, address, phone, qualification, designation, sector, added_date, added_by, prog_title, ids) VALUES ('$offtyp', '$offloc','$mon', '$yer','".$line[0]."','".$line[1]."', '".$line[2]."','".$line[3]."','".$line[4]."', '".$line[5]."', '".$line[6]."','".$line[7]."','".$line[8]."', '$date_captured', '$user_name','$prog', '$ids')");
              //  }
            }
            
            //close opened csv file
            fclose($csvFile);

            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

//redirect to the listing page
header("Location: add_unscheduled_part.php".$qstring);