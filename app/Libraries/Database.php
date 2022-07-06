<?php
class Database{


    private  $hostname = "127.0.0.1";
    private  $bancodedados = "framework";
    private  $usuario = "root";
    private  $senha = "mryosoqtl123";
    private  $porta = '3306';
    private  $dbh;
    private  $stmst;

    public function __construct()
    {
        //criação do objeto do tipo mysqli
         $dsn = 'mysql:host='.$this->hostname.';port='.$this->porta. ';dbname='.$this->bancodedados;
          $opcoes = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION

          ];
          
        try{
            $this->dbh = new PDO($dsn, $this->usuario, $this->senha, $opcoes);

        }catch(PDOException $e) {
            print "Error!: ".$e->getMessage()."<br/>";     
        die();
       }
    }

}

