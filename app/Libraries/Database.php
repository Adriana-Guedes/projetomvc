<?php
class Database{


    private  $hostname = "127.0.0.1";
    private  $bancodedados = "framework";
    private  $usuario = "root";
    private  $senha = "mryosoqtl123";
    private  $porta = '3306';
    private  $dbh;
    private  $stmt;

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



    //********************FUNÇÕES************************ */

    //para realização de querys sql
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    //recebe os valores solicitado nas querys
    public function bind($parametro, $valor, $tipo=null){
        if(is_null($tipo)):
            switch(true):
                case is_int($valor):
                    $tipo = PDO::PARAM_INT;
                    break;
                case is_bool($valor):
                    $tipo = PDO::PARAM_BOOL;
                    break;
                case is_null($valor):
                    $tipo = PDO::PARAM_NULL;
                    break;
                default:
                    $tipo = PDO::PARAM_STR;
                endswitch;
        endif;


        //prepara a instrução sql
        $this->stmt->bindValue($parametro, $valor, $tipo);
    }



    //executar o preparar o crud

    public function executa(){
        return $this->stmt->execute();
    }

    //vai executar a função acima/ RETORNA SÓ UM RESULTADO
    public function resultado(){
        $this->executa();
        return $this->stmt->fetch(PDO::FETCH_OBJ);

    }
    //vai executar a executa / RETORNA UM ARRAY DE RESULTADOS 
    public function resultados(){
        $this->executa();
        return $this->stmt->fetchALL(PDO::FETCH_OBJ);

    }

    //função para retornar numero de linhas 

    public function totalResultados(){
        return $this->stmt->rowCount();

    }

    //recupera o ultimo id inserido
    public function ultimoIdInserido(){
        return $this->stmt->lastInsertId();
    }


   
}

