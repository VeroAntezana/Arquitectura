<?php

class iglesiaDB
{
    const DATABASE_NOMBRE = "iglesia"; // Nombre de la base de datos sin la extensión .db ( NO ES ARCHIVO)
    const TABLE_MINISTERIO = "ministerios";
    const TABLE_CARGO = "cargos";//oK
    const TABLE_TIPO_RELACION = "tipo_relacion";
    const TABLE_USUARIO = 'usuarios';
    const TABLE_PARENTESCO = 'parentescos';
    const TABLE_EVENTO = 'eventos';
    const TABLE_REGISTRO_EVENTO = 'registro_evento';
    const TABLE_DETALLE_EVENTO = 'detalle_evento';
    


    public function __construct()
    {

    }


    public function getConnection() : mysqli
    {
        $dbConfig = [
            'host' => 'localhost', // MacOS 127.0.0.1
            'username' => 'root',
            'password' => '',
            'database' => self::DATABASE_NOMBRE,
        ];

        $conn = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password']);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        
        $this->createDatabase($conn, $dbConfig['database']);

        $conn->select_db($dbConfig['database']);

        // Verificar la existencia de todas las tablas
        $tables = [
           
            self::TABLE_MINISTERIO,
            self::TABLE_CARGO,
            self::TABLE_TIPO_RELACION,
            self::TABLE_USUARIO,
            self::TABLE_PARENTESCO,
            self::TABLE_EVENTO,
            self::TABLE_REGISTRO_EVENTO,
            self::TABLE_DETALLE_EVENTO,
            
        ];

        foreach ($tables as $table) {
            if (!$this->tableExists($conn, $table)) {
                $this->createTables($conn);
                /* break;  // Salir del bucle si se crea una tabla */
            }
        }

        return $conn;
    }

    public function createDatabase(mysqli $conn,string $databaseName) : void
    {
        // Verificar si la base de datos ya existe
        $checkDatabaseQuery = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$databaseName'";
        $result = $conn->query($checkDatabaseQuery);

        if ($result->num_rows === 0) {
            // La base de datos no existe, procede a crearla
            $createDatabaseQuery = "CREATE DATABASE $databaseName";

            if ($conn->query($createDatabaseQuery) === TRUE) {
                error_log("Base de datos '$databaseName' creada con éxito");
            } else {
                error_log("Error al crear la base de datos: " . $conn->error);
            }
        } else {
            error_log("La base de datos '$databaseName' ya existe, no se creó nuevamente.");
        }
    }

    public function createTables($conn) : void
    {
        // Consulta SQL para crear la tabla "ministerioss" si no existe
        $createTableQueryMinisterios = " CREATE TABLE IF NOT EXISTS " . self::TABLE_MINISTERIO . " (
            id INT AUTO_INCREMENT PRIMARY KEY,
             nombre VARCHAR(255),
             descripcion VARCHAR(255)
            )";
    
        // Consulta SQL para crear la tabla "cargos" si no existe
        $createTableQueryCargos = " CREATE TABLE IF NOT EXISTS " . self::TABLE_CARGO . " (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255),
        descripcion VARCHAR(255),
        ministerio_id INT,
        FOREIGN KEY (ministerio_id) REFERENCES " . self::TABLE_MINISTERIO . "(id)
        )";

        
         // Consulta SQL para crear la tabla "tipo_relaciones" si no existe
         $createTableQueryTipoRelaciones = " CREATE TABLE IF NOT EXISTS " . self::TABLE_TIPO_RELACION . " (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255)
        )";

        // Consulta SQL para crear la tabla "usuarios" si no existe
         $createTableQueryUsuarios = " CREATE TABLE IF NOT EXISTS " . self::TABLE_USUARIO . " (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255),
        apellido VARCHAR(255),
        fechanacimiento DATE,
        ci VARCHAR(255),
        telefono INT,
        cargo_id INT,
        FOREIGN KEY (cargo_id) REFERENCES " . self::TABLE_CARGO . "(id)
         )";

        $createTableQueryParentesco = " CREATE TABLE IF NOT EXISTS " . self::TABLE_PARENTESCO . " (
        id INT AUTO_INCREMENT PRIMARY KEY,
        usuario_a INT,
        usuario_b INT,
        tipo_relacion_a INT,
        FOREIGN KEY (usuario_a) REFERENCES " . self::TABLE_USUARIO . "(id),
        FOREIGN KEY (usuario_b) REFERENCES " . self::TABLE_USUARIO . "(id),
        FOREIGN KEY (tipo_relacion_a) REFERENCES " . self::TABLE_TIPO_RELACION . "(id)
        )";

        $createTableQueryEventos = " CREATE TABLE IF NOT EXISTS " . self::TABLE_EVENTO . " (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255),
        descripcion VARCHAR(255)
        )";

        $createTableQueryRegistroEvento = " CREATE TABLE IF NOT EXISTS " . self::TABLE_REGISTRO_EVENTO . " (
        id INT AUTO_INCREMENT PRIMARY KEY,
        lugar VARCHAR(255),
        nota VARCHAR(255),
        fecha DATE,
        evento_id INT,
        FOREIGN KEY (evento_id) REFERENCES " . self::TABLE_EVENTO . "(id)
        )";

        $createTableQueryDetalleEvento = "CREATE TABLE IF NOT EXISTS " . self::TABLE_DETALLE_EVENTO . " (
            id INT AUTO_INCREMENT PRIMARY KEY,
            registro_evento_id INT,
            usuario_id INT,
            FOREIGN KEY (registro_evento_id) REFERENCES " . self::TABLE_REGISTRO_EVENTO . "(id),
            FOREIGN KEY (usuario_id) REFERENCES " . self::TABLE_USUARIO . "(id)
        )";
        
            $conn->query($createTableQueryMinisterios);
            $conn->query($createTableQueryCargos);
            $conn->query($createTableQueryTipoRelaciones);
            $conn->query($createTableQueryUsuarios);
            $conn->query($createTableQueryParentesco);
            $conn->query($createTableQueryEventos);
            $conn->query($createTableQueryRegistroEvento);
            $conn->query($createTableQueryDetalleEvento);
       

        error_log("Tablas creadas con éxito");
    }

    /* private function databaseExists($conn)
    {
        $result = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'ventasdb'");
        return $result->num_rows > 0;
    }
 */
    private function tableExists(mysqli $conn, string $tableName) : bool
    {
        $result = $conn->query("SHOW TABLES LIKE '$tableName'");
        return $result->num_rows > 0;
    }
}