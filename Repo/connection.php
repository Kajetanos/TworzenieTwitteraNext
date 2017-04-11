

<?php



class Connection{

    
    public $mysqli;

public function __construct(){

    require './config.php';
    
    $this->mysqli=new mysqli($servername,$username,$password,$baseName);

if($this->mysqli->connect_error){
    die("Połączenie zerwane Błąd=".$this->mysqli->connect_error);
}else{
    echo " <br>Połączenie udane ";
}
}


public function query($sql) {
    $result = $this->mysqli->query($sql);
        return $result;
}
 public function __destruct() {
        $this->mysqli->close();
        $this->mysqli=null;
    }
}





