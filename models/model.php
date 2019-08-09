<?php 

/**
 * Clase Model
 * Permite conectarse a la base de datos y hacer operaciones sobre ella mediante lenguaje SQL.
 */
class Model {

  private static $instance = null;
  private $connection;

  private function __construct($servername, $port, $username, $password, $database) {
    $this->connection = new mysqli($servername, $username, $password, $database, $port);

    // Check connection
    if ($this->connection->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
  }

  public function createTable($tablename, $tableFields) {
    $fields = '~';
    foreach ($tableFields as $name => $type) {
      $fields = "$fields, $name $type";
    }
    $fields = str_replace("~,", "", $fields);
    $sql = "CREATE TABLE IF NOT EXISTS $tablename ($fields)";
    if ($this->connection->query($sql) !== TRUE) {
      die("Table creation failed: " . mysqli_connect_error());
      // TODO: implement logging here
    }
  }

  public function insertIntoTable($tablename, $data) {
    $sql = "INSERT INTO $tablename VALUES (\"" . join('", "', $data) . "\")";
    if ($this->connection->query($sql) !== TRUE) {
      // die("Table creation failed: " . mysqli_connect_error());
      // TODO: implement logging here
    }
  }

  public function runQueryAndgetResult($sql) {
    $result = $this->connection->query($sql);
    if ($result === TRUE) {
      $values = array();
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          array_push($values, $row);
        }
      }
      return $values;
    } else {
      // die("Table creation failed: " . mysqli_connect_error());
      // TODO: implement logging here
    }
  }

  public static function getInstance($host, $port, $username, $password, $database="test") {
    if (self::$instance == null) {
      self::$instance = new Model($host, $port, $username, $password, $database);
    }
    return self::$instance;
  }

}

?>