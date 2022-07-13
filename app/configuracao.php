
<?php
/*
            ARQUIVO DE CONFIGURAÇÃO


    __FILE__ = Constante Mágica. Retorna o caminho completo e o nome do arquivo
    dirname  = retorna o caminho/path do diretorio pai
    define  e const =  Define uma constante. As constantes não podem ser alteradas depois de declaradas. 

*/
define('APP', dirname(__FILE__)); //Retorna pasta raiz onde se encontro o projeto 

define('URL','http://localhost/projetomvc'); //esse é o endereço do projeto guardado na variavel URL

define('APP_NOME','Curso de PHP7 Orientado a Objetos e mvc'); //nome do projeto salvo na variavel APP_NOME

const APP_VERSAO = '1.0.0';



//(podendo ser utilizado ou CONST OU DEFINE) constante de conexão do banco de dados, sendo utilizados como array no arquivo Database.php
define('DB',[ 
    'HOST'  => '127.0.0.1',
    'USUARIO'=> 'root',
    'SENHA'  => 'mryosoqtl123',
    'BANCO'  => 'framework',
    'PORTA'  => '3306',

]);

/* OUTRA FORMA DE FAZER UMA CONSTANTE DE CONEXÃO DE BANCO
define('HOST', '127.0.0.1');
define('USUARIO', 'root');
define('SENHA' , 'mryosoqtl123');
define('BANCO', 'framework');
define('PORTA' ,'3306');
*/
