<?php
 class SQL {
    public $conn;

    public function connect_sql ($servername, $username, $password) {
        $this->conn = new mysqli ($servername, $username, $password);
        if ($this->conn->connect_error)
           die ("<script>console.log('Connection failed: {$this->conn ->connect_error}');</script>");
        else print ("<script>console.log('<--> Connected to server successfully <-->');</script>");
    }

    public function create_db ($dbase) {
        $query = "CREATE DATABASE $dbase";
        if ($this->conn->query ($query) === TRUE)
           print ("<script>console.log('<--> Database created successfully <-->');</script>");
        else print ("<script>console.log('Database exists');</script>");
    }

    public function create_table ($table, $table_value) {
        $create_table = "CREATE TABLE {$table} (";
        foreach ($table_value as $key => $val)
            $create_table .= $key. " ". $val. ", ";
        
        $create_table = substr($create_table, 0, strlen($create_table)-2);
        $create_table .= ");";
        if ($this->conn->query ($create_table) === TRUE)
            print ("<script>console.log('Table {$table} created successfully');</script>");
        else print ("<script>console.log('Error creating table: {$this->conn->error}');</script>");
    }

    public function set_db ($dbase) {
        if (!$this->conn->select_db($dbase)){
            $this->create_db ($dbase);
            $this->conn->select_db($dbase);
            return false;
        } 
        return true;
    }

    public function add_record ($table, $record_value) {
        $record = "INSERT INTO {$table} (";
        foreach ($record_value as $key => $val)
            $record .= $key. ", ";
        $record = substr($record, 0, strlen($record)-2);
        $record .= ") VALUES (";
        foreach ($record_value as $val)
            $record .= "'{$val}'". ", ";
        $record = substr($record, 0, strlen($record)-2);
        $record .= ");";

        if ($this->conn->query ($record) === TRUE){
            print ("<script>console.log('The record was added successfully');</script>");
            return true;
        }
        else print ("<script>console.log('Error: {$record}; {$this->conn->error}');</script><br>");
        return false;
    }

 }

 // Get email, name and message
 $email = $_POST['email'];
 $name = $_POST['name'];
 $message = $_POST['message'];
/*
 // Connect to mysql
 $sql = new SQL ();
 $sql->connect_sql("localhost", "root", "");
 // Database and table
 $dbase = "contacts";
 $table = "mail";
 // Check if exist this database and table, if not exist, create database and table
 if (!$sql->set_db ($dbase) || $sql->conn->query ("SELECT 1 FROM {$table} LIMIT 1") === FALSE) {
    $table_value = array(
        "Email" => "VARCHAR(125)",
        "Name" => "VARCHAR(125)",
        "Message" => "TEXT",
    );
    $sql->create_table($table, $table_value);
 }
 // Values for save in table
 $record_value = array(
     "Email" => $email,
     "Name" => $name,
     "Message" => $message
 );
 // Add values
 if ($sql->add_record ($table, $record_value))
    print ("Mesajul a fost salvat in baza de date.<br>");
 else print ("Ne pare rau, ceva a mers incorect.<br>");
*/
 $to = "andrian.gav@gmail.com"; // this is your Email address
 $from = $email; // this is the sender's Email address
 $subject = "Form submission";
 $subject2 = "Copy of your form submission";
 $send_message = $name . " wrote the following:" . "\n\n" . $message;
 $send_message2 = "Here is a copy of your message " . $name . "\n\n" . $message;
 echo $from . " to: " . $to . "<br>" . $send_message. "<br>";

 $headers = "From:" . $from;
 $headers2 = "From:" . $to;

 if (mail($to, $subject, $send_message, $headers)) {
    //mail($from,$subject2,$send_message2,$headers2); // sends a copy of the message to the sender
    echo "Mail Sent. Thank you " . $name . ", we will contact you shortly.";

 }
 //header('refresh:5;url=http://localhost'); //to redirect to another page.

?>