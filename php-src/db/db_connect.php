<?php
        //Connecting to database

        //for local use
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "summarize";

        //for server use
        // $servername = "localhost";
        // $username = "id21342737_root";
        // $password = "rishovnagCU_23";
        // $database = "id21342737_summarize";

        $con = mysqli_connect($servername,$username,$password,$database);
?>