<?php


//Declare class to access php file
class access{

    var $host = null;
    var $user = null;
    var $pass = null;
    var $name = null;
    var $conn = null;
    var $result = null;

// constructing class
function __construct($dbhost, $dbuser, $dbpass, $dbname){
    $this->host = $dbhost;
    $this->user = $dbuser;
    $this->pass = $dbpass;
    $this->name = $dbname;

}
// public function
public function connect() {
    // establish connection and store it in $conn
$this -> conn = new mysqli($this->host, $this->user, $this->pass, $this->name);
if (mysqli_connect_errno()){

    echo 'could not connect to database';
} 
    // support all languages
    $this->conn->set_charset('utf8');
}
public function disconnect() {
    if ($this->conn != null){
    $this->conn->close();
        }
    }

// Insert user details
public function registerUser($username, $password, $salt, $email, $fullname){  
    // sql command
        $sql = "INSERT INTO users SET username=?, password=?, salt=?, email=?, fullname=?, emailConfirmed=?";
        $defaultConfirm = 0;

        //store query result in $statement
        $statement = $this->conn->prepare($sql);

        //if statement fails
        if (!$statement){
            throw new Exception($statement->error);
            echo 'jasonerror';
        }
        // bind 5 parameters of type string to be placed in sql command
        $statement->bind_param('sssssi', $username, $password, $salt, $email, $fullname, $defaultConfirm);
        $returnvalue = $statement->execute();
        return $returnvalue;

    }

    //select user info
    public function selectUser($username){
        //sql command
        $sql = "SELECT * FROM users WHERE username='".$username."'";
        //assign result from $sql to $result var
        $result = $this->conn->query($sql);
        //if we have at least one result returned
        if ($result != null && (mysqli_num_rows($result) >= 1)){
            //assign results to $row as assosiative array
            $row = $result->fetch_array(MYSQLI_ASSOC);

            //if row is not empty
            if (!empty($row)) {
                $returnarray = $row; 
            }
        }
        return $returnarray;
    }

    //save email confirmation token
    public function saveToken($table,$id,$token){
        $sql = "INSERT INTO $table SET id=?, token=?";

        $statement = $this->conn->prepare($sql);

        if (!$statement){
            throw new Exception($statement->error);
        }
        $statement->bind_param("is", $id,$token);

        //launch execute
        $returnvalue = $statement->execute();
        return $returnvalue;

    }

//get ID of the user 
function getUserID($table, $token)
{
    $returnArray = array();
    //sql statement
    $sql = "SELECT id FROM $table WHERE token = $token";

    $result = $this->conn->query($sql);

    if ($result != null && (mysqli_num_rows($result) >= 1)){
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if(!empty($row)) {
            $returnArray = $row;

        }
    }
    return $returnArray;

}

// change status of email confirmation column
function emailConfrimationStatus($status, $id){
    $sql = "UPDATE users SET emailConfirmed=? WHERE id=?";
    $statement = $this->conn->prepare($sql);

    if (!$statement) {
        throw new Exception($statement->error);
    }

    $statement->bind_param("ii", $status, $id);

    $ReturnValue = $statement->execute();

    return $ReturnValue;


}

//delete token once email confirmed
function deleteToken($table, $token){
    $sql= "DELETE FROM $table WHERE token=?";
    $statement = $this->conn->prepare($sql);
    if(!$statement) {
        throw new Exception($statement->error);
    }

    $statement->bind_param("s", $token);
    $returnValue = $statement->execute();
    
    return $returnValue;

}
// Get user information
public function getUser($username) {
    $returnArray = array();
    $sql = "SELECT * FROM users WHERE username='".$username."'";
    $result = $this->conn->query($sql);

    if ($result != null && (mysqli_num_rows($result) >= 1)) {
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if (!empty($row)) {
            $returnArray = $row;
        }
    }
    return $returnArray;
}



}

?>