/**
 * Created by goekh on 07.08.2017.
 */

function fetchData() {
   'use strict';


   var newUsername = document.getElementsByName("newUsername")[0].value;
   var newPassport_number = document.getElementsByName("newPassport_number")[0].value;
   var newGender = document.getElementsByName("newGender")[0].value;
   var newNationality = document.getElementsByName("newNationality")[0].value;

   if(newUsername.length == "" || newPassport_number == "" || newGender.length == "" || newNationality.length == ""){

      alert("Data must be filled!");
      return false;
   }

else if(newUsername.length !="" && newPassport_number.length !="" && newGender.length !="" && newNationality.length !=""){
      alert("Data is be filled!");
      return true;
   }

   else{
   alert("Data must be filled");
   return false;
   }
}

function checkUsernameAndPassword(username,password) {
   'use strict';

      username= document.getElementsByName('username')[0].value;
      password = document.getElementsByName('passport_number')[0].value;



   if( (username.length === "" && password.length === "") ||
       (username.length === "Username" && password.length === "Password_number")){
      alert("username or password are not complete!");
      return false;
   }

 else if(username.length !== "Username" && password.length !== "Password_number")  {

       alert("Data is be filled");
     window.open('http://localhost/TravelAgencyManagementSystem/CustomerArea.php','CustomerArea');
     return true;
   }

else{
        alert("username or password are not complete!");
        return false;
    }

}
