<?php

    session_start();

    $message = "";
    
    include '../DB/connector.php';

    $query = "SELECT * FROM user_data";

    $result = mysqli_query($con,$query) or die("Error: ".mysqli_error($connect));

    /*Deleting users */
    if (isset($_GET["uname_del"])) {
        $user_name = $_GET["uname_del"];

        $del_query = "DELETE FROM user_data WHERE user_name = '$user_name'";
        $del_result = mysql_query($del_query);        
        header("Refresh:0 url=./user_details.php");
        if (!$del_result) {
            $err = mysql_error();
            print $err;
            exit();
        }

        
    }


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>User Details</title>

    <script type="text/javascript">
        function delete_test() {
            return confirm("Do you want to delete these information");
        }
    </script>

        <!-- CSS for page Background -->
        <link href="../../css/user_details.css" rel="stylesheet">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <!-- Footable is taken from a CDN Server -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.footable/2.0.3/css/footable.core.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.footable/2.0.3/css/footable.metro.min.css">
        <!--  <script src="js/jquery-1.11.3.min.js"></script>  -->
        <!--jquery-1.11.3.min.js from CDN -->
        <script
          src="https://code.jquery.com/jquery-1.11.3.js"
          integrity="sha256-IGWuzKD7mwVnNY01LtXxq3L84Tm/RJtNCYBfXZw3Je0="
          crossorigin="anonymous">          
        </script>
        <script src="https://cdn.jsdelivr.net/jquery.footable/2.0.3/footable.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.footable/2.0.3/footable.paginate.min.js"></script>
        
</head>
<body>

    <div class="jumbotron" id="jumbotron-one">
      <div class="header"><h1>User Information</h1></div>      
    </div>
    <!-- data-page-size = number of data to display -->
    <!-- data-XXX-text = text to display in the pagination bar -->
    <table class="footable" data-page-size="5" data-first-text="FIRST" data-next-text="NEXT" data-previous-text="PREVIOUS" data-last-text="LAST" >
            <thead>
            <tr>    
                <th>#</th>            
                <th>First Name</th>
                <th>Last Name</th>
                <th>NIC</th>
                <th>Gender</th>
                <th>District</th>
                <th>Email</th>
                <th></th>
                <th></th>
            </tr>
            </thead>

            <tbody>

                <!-- populate table from mysql database -->
            <?php             
            while($row1 = mysqli_fetch_array($result)):;?>
            <tr>
                <td><?php echo $row1[0];?></td>
                <td><?php echo $row1[1];?></td>
                <td><?php echo $row1[2];?></td>
                <td><?php echo $row1[3];?></td>                
                <td><?php echo $row1[4];?></td>
                <td><?php echo $row1[5];?></td>
                <td><?php echo $row1[6];?></td>
                <td><?php echo "<a href='../user/edit_user_details.php?uname=".urlencode($row1[7])."'>Edit</a>";?></td>
                <td><?php echo "<a onClick='return delete_test()' href='?uname_del=".urlencode($row1[7])."'>Delete</a>";?></td>
            </tr>
            <?php endwhile;?>

            </tbody>

            <!-- the pagination -->
            <!-- hide-if-no-paging = hide the pagination control -->
            <tfoot class="hide-if-no-paging">
            <td colspan="10">
                <div class="pagination"></div>
            </td>
            </tfoot>
        </table>

        
        


</body>

        <!--Footable Javascript-->
        <script type="text/javascript">
               
               $(document).ready(function(){
                   
                   $('.footable').footable();
                   
               });
               
        </script>
</html>