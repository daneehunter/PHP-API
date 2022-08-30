<?php
ini_set('mssql.charset', 'UTF-8');


if(!function_exists('mssql_connect')){
    function sea_connect()
    {       
        $mssql=parse_ini_file('..\\connect.ini',true);
        
        //Csatlakozás MSSQL szerverhez
        $link_mssql=odbc_connect($mssql["mssql"]["odbc"], $mssql["mssql"]["user"], $mssql["mssql"]["psw"]);
        //Kapcsolat ellenőrzés
        if (!$link_mssql){
            exit("Hiba:" . odbc_errormsg() );
        }
        else{
            return $link_mssql;
        }
    }
}


if(!function_exists('oracle')){
    function connect_oracle(){
        
        $oracle=parse_ini_file('..\\connect.ini',true);
        $oracleconn = oci_connect($oracle["oracle"]["user"], $oracle["oracle"]["psw"], $oracle["oracle"]["host"], $oracle["oracle"]["sid"]);
        if(!$oracleconn){
            echo "Nem sikerült kapcsolódni az adatbázishoz, keresse a fejlesztőt!";
            $e = oci_error();
            echo htmlentities($e['message']);
        }
        else{
            return $oracleconn;
        }
    }
}


if(!function_exists('mysql')){
    function connect_mysql(){
        
        $mysql=parse_ini_file('..\\connect.ini',true);
        $mysqlconn = mysqli_connect($mysql["mysql"]["srvn"], $mysql["mysql"]["user"], $mysql["mysql"]["psw"]);
        if(!$mysqlconn){
            
            die("Nem sikerült kapcsolódni az adatbázishoz, keresse a fejlesztőt! " . mysqli_connect_error());
        }
        else{
            return $mysqlconn;
        }
    }
}




if(!function_exists('closeAllDb')){
	function closeAllDb()
    {
        oci_close(connect_gyakorlodb());
		odbc_close(nexon_connect());
        mysqli_close(connect_mysql());
		
	}
}

if(!function_exists('send_mail')){
    function send_mail($to,$toname,$subject,$content)
    {

        //Meghívom a mailert
        include_once('MailParamsController.php');
        $mail->setFrom('Honnan', 'Hová');
       
        $mail->addAddress($to,$toname);

        $mail->Subject = $subject;
        $mail->Body    = $content;


        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            trigger_error($mail->ErrorInfo);
        }
    }
}


?>