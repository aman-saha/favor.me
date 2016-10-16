 <?php
        $DB_SERVER="localhost";
        $DB_USER="root";
        $DB_PASS="root";
        $DB_NAME="favour.me";

    //Create a database connection
        $connection = mysqli_connect($DB_SERVER,$DB_USER,$DB_PASS,$DB_NAME);
        if (!$connection) 
        {
            die("Database connection failed: ");
        }

    //Select a database to use 
        $db_select = mysqli_select_db($connection,$DB_NAME);
        if (!$db_select) 
        {
            die("Database selection failed.....: ");
        }
?>
