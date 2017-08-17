<?php	// UTF-8 marker äöüÄÖÜß€

abstract class Page
{
    protected $_database = null;

    protected function __construct()
    {
        $this->_database = new MySQLi("localhost","root","","travelagency");

        if(!$this->_database->set_charset("utf8"))throw new Exception("404 not found: " . $this->_database->error);
        if(mysqli_connect_errno()) throw new Exception(mysqli_connect_error() ."don't connected : ");
    }


    protected function __destruct()
    {
      $this->_database->close();  // to do: close database
    }

    protected function generatePageHeader($headline = "")
    {
        $headline = htmlspecialchars($headline);
        header("Content-type: text/html; charset=UTF-8");
        echo <<<EOT
        <!DOCTYPE html>
        <html lang="de">
        <head>
        <script src="TravelAgency.js" type="text/javascript"></script>
        <meta charset="UTF-8">
        <title>$headline</title>
        </head>
<body>
EOT;

    }

    protected function generatePageFooter()
    {
            echo <<<EOT
        </body>
        </html>
EOT;
 // to do: output common end of HTML code
    }


    protected function processReceivedData()
    {
        if (get_magic_quotes_gpc()) {
            throw new Exception
            ("Bitte schalten Sie magic_quotes_gpc in php.ini aus!");
        }
    }
}