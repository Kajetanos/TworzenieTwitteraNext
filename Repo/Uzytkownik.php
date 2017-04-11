


<?php


include_once './connection.php';


class Uzytkownik{
    
    
    
    private $id;               
    private $email;
    private $userName;
    private $hashedPassword;
    

    
    
    
    
    public function __construct(){
        
        $this->id=-1;
        $this->email='';
        $this->userName='';
        $this->hashedPassword='';
    }
    
    /**
     * There is we create hashed param newPassword with function SetPassword
     * @param type $newPassword
     */
    public function setPassword($newPassword) {
        
        $newHashedPassword= password_hash($newPassword, PASSWORD_BCRYPT);
        $this->hashedPassword=$newHashedPassword;
        
    }
    
    /**
     * 
     * @param type $email this is seter to email param
     */
    public function setEmail($email) {
        $this->email=$email;
    }
    /**
     * there we have setter for userName param
     * @param type $userName
     */
    public function setUserName($userName) {
        $this->userName=$userName;
    }
    /**
     * 
     * @return type this is geteer with return type userName
     */
     
    public function getName() {
        return $this->userName;
    }
    /**
     * this is getter return email
     * @return type
     */
    public function getEmail() {
        return $this->email;
    }
    /**
     * this is getter with return type Id
     * @return type
     */
    public function getId() {
        return $this->id;
    }
   /**
    * 
    * @return boolean
    * 
    * This is function to save records what we create at setters
    * we can do this when we have all params to Object Uzytkownik
    */
    public function Save() {
        
        if($this->id=-1&&$this->email&&$this->userName&&$this->hashedPassword){
            
            $db=new Connection();
      
            $result= $db ->query($sql="INSERT INTO `uzytkownicy` (`id`, `email`, `username`, `hashedPassword`) "
                    . 'VALUES'. '("NULL","'.$this->email.'", "'.$this->userName.'","'.$this->hashedPassword.'")');
            
           $this->id=$result;
           var_dump($result);   
        }
 
        else {
            $result=$db->query($sql = 'UPDATE `uzytkownicy` SET `username`="'
                    .$this->userName.'",`email`="'.$this->email.'",`hashedPassword`="'
                    .$this->hashedPassword.'" WHERE `uzytkownicy`.`id`= "'.$this->id.'"');
            //UPDATE `uzytkownicy` SET `email` = 'nowy numer dwa' WHERE `uzytkownicy`.`id` = 1
            if($result==TRUE){
                return TRUE;
            }
            
            
        }
        return FALSE;
    }
    
    /**
     * 
     * @param type $id
     * @return \Uzytkownik
     * 
     * This is static function to showing param of Object at MySQL with autoIncrement value $id 
     * 
     * We doing query and checking number at MySql when if is true 
     * we create return object Uzytkownik after we have array assoc 
     */
    static public function ShowByUserNameValue($id) {
        
        $db=new Connection();
          //fetch_row get one Row from MySql
          
        $result = $db->query($sql="SELECT * FROM `uzytkownicy` WHERE `id`=$id");
        if($result==TRUE && $result->num_rows==1){
            
                $row=$result->fetch_assoc();
              
                $loadUser= new Uzytkownik();
                $loadUser->id=$row['id'];
                $loadUser->userName=$row['username'];
                $loadUser->email=$row['email'];
                $loadUser->hashedPassword=$row['hashedPassword'];
                
                
                echo "<br> id = $loadUser->id"
                    ."<br>email = $loadUser->email"
                    ."<br>username = $loadUser->userName";
                
                
               return $loadUser;   
               
        }else{
            
            echo"<br>uzytkownik o podanym username " .$id."  nie istnieje :/";
        }
    }
    
    /**
     * 
     * @return \Uzytkownik
     * 
     * This is static function to load all ussers at MySql
     */
    static public function LoadAllUsers() {
        
        $db=new Connection();
        
        $result=$db->query($sql ="SELECT * FROM `uzytkownicy`");
        $ret=[];
        
        if($result==true && $result->num_rows!=0){
            
            foreach ($result as $row){
                $loadUser= new Uzytkownik();
                $loadUser->id=$row['id'];
                $loadUser->email=$row['email'];
                $loadUser->userName=$row['username'];
                $loadUser->hashedPassword=$row['hashedPassword'];
                $ret[]=$loadUser;
            }
            
        }var_dump($ret);
        return $ret;
    }
    public function deleteById () {
        
        $db=new Connection();
        
        if($this->id != -1){
            
            $result = $db->query($sql ='DELETE FROM `uzytkownicy` WHERE `id`= "'.$this->id.'"');
            //"SELECT * FROM `uzytkownicy` WHERE `id`=$id"
            //DELETE FROM `uzytkownicy` WHERE `uzytkownicy`.`id` = 1
            if($result==TRUE){
                
                $this->id=-1;
                return true;
                
            }
            return false;
        }
        return TRUE;
    }
    
    
    
    
    
}

$uzytkownik1=new Uzytkownik();
$uzytkownik1->setEmail("uzytkownik@email.com");
$uzytkownik1->setUserName("Uzytkownik1");
$uzytkownik1->setPassword("noweHaslo");
$uzytkownik1->Save();


var_dump($uzytkownik1);
$uzytkowni2=new Uzytkownik();
$uzytkowni2->setEmail("kaka");
$uzytkowni2->setUserName("kala");
$uzytkowni2->setPassword("sdfaf");
$uzytkowni2->Save();

        

Uzytkownik::ShowByUserNameValue(1);
 Uzytkownik::ShowByUserNameValue("15");
 $uzytkowni2->setEmail("kaka222");
 $uzytkowni2->setUserName("Kajtas");
 $uzytkowni2->Save();
 var_dump($uzytkowni2);
 Uzytkownik::ShowByUserNameValue("2");
 $uzytkownik1->deleteById();
 
 Uzytkownik::LoadAllUsers();