<?php
$con = mysqli_connect('localhost', 'root', '', 'student_master');
include('functions/ip.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic details</title>
    <link rel="shortcut icon" href="./img/favicon-16x16.png" type="image/x-icon">
    <style>
        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 225, 255, 0.5);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(34, 158, 134, 0.8);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(30, 136, 229, 0.8);
        }
    </style>
    <style>

        body{
            background-color: rgb(245, 247, 245);
        }
        input[type='text'],input[type='email'],input[type='tel'],textarea{
        width: 100%;
        padding: 10px 0 10px 6px;
        border-radius: 3px;
        border: 1px solid #070707;
        margin-top: 10px;
        margin-bottom: 20px;
        }
        select{
        width: 100%;
        padding: 10px 0 10px 0px;
        border-radius: 3px;
        border: 1px solid #090909;
        margin-top: 10px;
        margin-bottom: 20px;	
        }
        input[type='text']:focus,input[type='email']:focus,input[type='tel']:focus,select:focus,textarea:focus{
        border: 1px solid #020202;
        box-shadow: 0 0 10px #090909;
        outline: none !important;
        }
        input[type='submit']{
        background: rgb(236, 241, 236);
        color: #01020b;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        }
        .main-job-application-form{
        color: #0b0b0b;
        max-width: 600px;
        margin: 0 auto;
        background:white;
        padding: 20px 45px 20px 25px;
        border-radius: 8px;
        border-width: 100px;
        border-color: #070707;
        }
        .form-group {
        margin-bottom: 20px;
        }
        </style>
</head>
<body>
     <?php


  if (isset($_POST['submit'])) {
    $eventlogo=$_FILES['filess']['name'];
    $user_image_tmp=$_FILES['filess']['tmp_name'];
    $position = $_POST['position'];
    $Title = $_POST['Title'];
    $Organisation = $_POST['Organisation'];
    $url = $_POST['url'];
    $Festival = $_POST['Festival'];
    $experience = $_POST['experience'];
    $Categories = $_POST['Categories'];
    $Skills = $_POST['Skills'];
    $Description = $_POST['Description'];
    $Participation_Type = $_POST['Participation_Type'];
    $min_team_members = $_POST['min_team_members'];
    $max_team_members = $_POST['max_team_members'];
    $registration_start = $_POST['registration_start'];//
    $registration_end = $_POST['registration_end'];//
    $number_registration = $_POST['number_registration'];
    $registration_data = $_POST['registration_data'];

    

    $user_ip=getIPAddress();
 
   
    $emailquery = "select * from `eventhost` where opportunity_title='$Title' ";
    $query = mysqli_query($con, $emailquery);

    $emailcount = mysqli_num_rows($query);

    $select_query="Select * from `eventhost` where opportunity_title='$Title'  and

    organisation_name='$Organisation'";

$result=mysqli_query($con, $select_query);

$rows_count=mysqli_num_rows($result);

if($rows_count>0){

echo "<script>alert('Already exist') </script>";

}
    else if($emailcount>0){
        ?>
        <script>
            alert("Already exists");
        </script>
        <?php
    }
    else{
      move_uploaded_file($user_image_tmp,"eventlogos/$eventlogo");
    $insert_query = "insert into `eventhost` (Event_logo,
    opportunity_type ,opportunity_title ,	organisation_name ,website_url ,festival ,mode_of_event ,categories ,skills_to_be_accessed
    ,Description ,participation_type , minimum_team_members, max_team_members, registration_start, registration_end, number, event_date 
    ,user_ip) values ('$eventlogo',
   '$position','$Title', '$Organisation', '$url', '$Festival', '$experience' ,' $Categories' ,'$Skills' ,'$Description', '$Participation_Type', $min_team_members
   , $max_team_members, '$registration_start', '$registration_end', $number_registration, '$registration_data' ,'$user_ip')";
    $sql_execute = mysqli_query($con, $insert_query);

    if ($sql_execute) {
      echo "<script>alert('Registered Successfully')</script>";
      echo "<script>window.open('cardsection.php','_self')</script>";
    }
    else{
      echo "<script>alert('Not Registered')</script>";
    }
  }
}
  ?>

    <h1 style="text-align: center;">Event Registration</h1>
    <div class="main-job-application-form">			
        <form action="#" method="POST" enctype="multipart/form-data">
            <!-- 1 -->
            <label for="file">Event Logo</label>
            <br>
        		
            <input type="file" name="filess" class="file" required><br>
            <small>Please upload the logo of the event</small><br><br>

            <!-- 2 -->
            <label for="position">Opportunity Type</label>
            <select name="position" class="position" id="position" placeholder="" required>
                <option value="">Select Opportunity Type</option>
                <option value="General & Case Competitions">General & Case Competitions</option>
                <option value="Scholarships">Scholarships</option>
                <option value="Hackathon and Coding challenges">Hackathon and Coding challenges</option>
                <option value="Workshops and Webinar">Workshops and Webinar</option>
                <option value="Jobs">Jobs</option>
                <option value="Scholarships">Scholarships</option>
            </select>

            <!-- 3 -->
        <label for="name">Opportunity Title</label>
        <input type="text" id="name" maxlength="190" name="Title" class="name" placeholder="Enter Title" required>

        <!-- 4 -->
        <label for="Organisation">Enter Your Organisation</label>
        <input type="text" name="Organisation" id="Organisation" class="email" placeholder="Enter Your Organisation" required>

        <!-- 5 -->
        <label for="tel">Website URL.<br>
        The URL can be your organization's website or an opportunity-related URL.</label>
        <input type="text" name="url" class="tel"  id="tel" placeholder="Enter URL of the events website" required>

        <!-- 6 -->
        <label for="position">Festival(optional)</label>
         <br>
        In case this event is a part of any fest.
        <input type="text" name="Festival" class="position" id="position" placeholder="Enter name of Festival" >

        <!-- 6 -->
        <div required>
        <label for="text" >Mode Of event</label><br>
        <input type="radio" id="exp1" name="experience" value="online" required="required">
        <label for="exp1">Online</label><br>
        <input type="radio" id="exp2" name="experience" value="offline" required="required">
        <label for="exp2">Offline</label><br>
        <input type="radio" id="exp3" name="experience" value="hybrid" required="required">
        <label for="exp3">Hybrid</label>

        </div>
        
        <!-- 7 -->
        <br>
        <br>
        <label for="position">Categories</label>
            <select name="Categories" class="position" id="position" placeholder="" required>
                <option value="">Select Categories</option>
                <option value="Article Writing">Article Writing</option>
                <option value="Awards">Awards</option>
                <option value="Case Study">Case Study</option>
                <option value="Coding Challenges">Coding Challenges</option>
            </select>


            <!-- 8 -->
            <label for="text">Skills to Be Accessed</label>
            <input type="text" name="Skills" id="email" class="email" placeholder="Enter Skills to engage Participants" required>

            <!-- 9 -->
            <label for="text">Description</label>
            <input type="text" name="Description" id="email" class="email" placeholder="Enter details about the event" required>

            <!-- 10 -->
            <label for="Email">Participation Type</label><br>
            <input type="radio" id="exp1" name="Participation_Type" value="Individual">
            <label for="exp1">Individual</label>
            <br>
            <input type="radio" id="exp2" name="Participation_Type" value="As A Team">
            <label for="exp2">As A Team</label>
            <br>
            <br>
            if As a team then select members
            <br>
            <br>
            <div class="form-group">
                <label for="team-members">Minimum Team Members:</label>
                <input type="number" id="team-members" name="min_team_members" min="0" value="0" required>
                <br>
                <br>
                <label for="team-members">Maximum Team Members:</label>
                <input type="number" id="team-members" name="max_team_members" min="0" value="0" required>
                <br>
                <br>
            </div>
            <div class="form-group">
                <label for="registration-start">Registration Start:</label>
                <input type="datetime-local" id="registration-start" name="registration_start" required>
            </div>
            <div class="form-group">
                <label for="registration-end">Registration End:</label>
                <input type="datetime-local" id="registration-end" name="registration_end" required>
            </div>
            <div class="form-group">
                <label for="number_registration">Number Of Registration Allowed</label>
                <input type="number" id="number_registration" name="number_registration" required>
            </div>
            <div class="form-group">
                <label for="registration-end">Event Date And Timing</label>
                <input type="datetime-local" id="registration-end" name="registration_data" required>
            </div>

            <input name="submit" type="submit" value="Submit">
        </form>
        </div>
</body>
</html>
