<?php

require_once './Page.php';

class Customer extends Page
{

    protected function __construct()
    {
        parent::__construct();

    }

    protected function __destruct()
    {
        parent::__destruct();
    }

    protected function generateView()
    {
        $this->generatePageHeader('Customer');
        echo <<<EOT

        <form method="post" action="Customer.php" onsubmit="return fetchData()">
      
      <!-- LOGIN AREA -->
         <fieldset>
         <table align="center">
        
        <tr>
            <th>
                Login
            </th>
        </tr>
      
        
        <tr>
            <td>
                <input type="text" name="username" id="usernameID" placeholder="Username">
            </td>
        </tr>
      
          <tr>
            <td>
                <input type="text" name="passport_number" id="passport_number_ID" placeholder="Passport number">
            </td>
        </tr>
        
          <tr align="center">
            <td>
                <input type="button" name="submitLogin" id="submitLoginID" value="Login now!" onclick="checkUsernameAndPassword(this,this)">
            </td>
        </tr>
        
         
        </table>   
        </fieldset>
      
      <!-- REGISTRATION AREA -->  
        
        
        <fieldset>
        
         <table align="center">
        
        <tr>
            <th>
                Registration
            </th>
        </tr>
        
        <tr>
            <td>
                <input type="text" name="newUsername" id="newUsernameID" placeholder="Name">
            </td>
        </tr>
        
        <tr>
            <td>
                <input type="text" name="newPassport_number" id="newPassport_number_ID" placeholder="passport_number">
            </td>
        </tr>
        
        <tr>
            <td>
                <input type="text" name="newGender" id="newGender_ID" placeholder="Gender">
            </td>
        </tr>
        
        <tr>
            <td>
                <input type="text" name="newNationality" id="newNationality_ID" placeholder="Nationality">
            </td>
        </tr>
       
         <tr align="center">
            <td>
                <input type="submit" name="newRegistrationSubmit" id="newRegistrationSubmit_ID" value="Registration now!">
            </td>
        </tr>
        
        </table>
        
        </fieldset>
        
</form>

EOT;

        $this->generatePageFooter();
    }

private function checkUserData($username_,$password_){
        $username = $this->_database->real_escape_string($username_);
        $password = $this->_database->real_escape_string($password_);

        $sqlSelectUserData ="select name,passport_number from flightcustomer where name='$username' AND passport_number='$password'";
        $sqlSelectUserDataQuery = $this->_database->query($sqlSelectUserData);
        $sqlSelectUserDataQuery->free();

        if(!$sqlSelectUserData)throw new Exception("404 not found: " . $this->_database->error);

        $count = $sqlSelectUserDataQuery->num_rows;

        return $count==1;

    }

    protected function processReceivedData()
    {
        parent::processReceivedData();

        /********* Registration **********/

        if (isset($_POST['newUsername']) && isset($_POST['newPassport_number']) && isset($_POST['newGender'])
            && isset($_POST['newNationality'])
        ) {

            $name = $this->_database->real_escape_string($_POST['newUsername']);
            $passport_number = $this->_database->real_escape_string($_POST['newPassport_number']);
            $gender = $this->_database->real_escape_string($_POST['newGender']);
            $nationality = $this->_database->real_escape_string($_POST['newNationality']);

            if (isset($_POST['newRegistrationSubmit'])) {
                $sqlInsert = "insert into flightcustomer(passport_number,name,gender,nationality) VALUES('$passport_number','$name','$gender','$nationality')";
                $sqlInsertQuery = $this->_database->query($sqlInsert);
                if (!$sqlInsertQuery) throw new Exception("404: " . $this->_database->error);

            }
        }

         /*********** Login ************/

            if (isset($_POST['username']) && isset($_POST['passport_number'])) {

                $userName = $this->_database->real_escape_string($_POST['username']);
                $passport_number_Login = $this->_database->real_escape_string($_POST['passport_number']);

                $sqlSelect = "select name,passport_number from flightcustomer where passport_numer='$passport_number_Login' AND name='$userName')";
                $sqlSelectQuery = $this->_database->query($sqlSelect);

                if (!$sqlSelectQuery) {
                    throw new Exception("405: " . $this->_database->error);
                }
                echo "Login succesfull";
            }

        }

    public static function main()
    {
        try {
            $page = new Customer();
            $page->generateView();
            $page->processReceivedData();


        } catch (Exception $exception) {
            header("Content-type:text/plain");
            $exception->getMessage();
        }
    }

}Customer::main();