<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    date_default_timezone_set("America/Sao_Paulo");

    class MySql{

        private static $pdo;

        public static function conectar(){
            if(self::$pdo == null){
                try {
                    self::$pdo = new PDO('mysql:host=xxx;dbname=xxxx;charset=utf8','xxxx','xxxxxxx',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                    self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                } catch (Exception $e) {
                    echo 'Erro ao conectar';
                    echo '<pre>';
                    var_dump($e);
                    echo '</pre>';
                }
            }

            return self::$pdo;
        }


    }





    $conn = MySql::conectar();

    $sql = "SELECT * FROM cursos";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($cursos, JSON_UNESCAPED_UNICODE);

?>