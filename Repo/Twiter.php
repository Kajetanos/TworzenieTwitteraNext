<?php
include_once './connection.php';
include_once './Uzytkownik.php';

/*
 * We creat table 
 * CREATE TABLE `uzytkownik`.`twitter` ( `id` INT NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , 
 * `text` VARCHAR(250) NOT NULL , `creationDate` DATE NOT NULL , PRIMARY KEY (`id`), INDEX (`user_id`)) 
 * ENGINE = InnoDB;
 */

class Twitter extends Uzytkownik{
    
    private $id ;
    private $text;
    private $data;
    private $userId;
    /*
     * We create Setter for text and date(on date we using function date to take actual date) 
     * And getters for Id , text and data 
     */
    public function getId() {
        return $this->id;
    }
    public function getText() {
        return $this->text;
    }
    public function SetText($text) {
        $this->text=$text;
    }
    public function getUserId(){
        return $this->userId = parent::getId();
    }
    /**
     * 
     * @return type
     */
    public function getData() {
        
        return $this->data=$data= date("Y-m-d");
    }
    
    
    /**
     * create constructor with null param 
     */
    public function __construct() {
        
        $this->id = -1 ;
        $this->data="";
        $this->text="";
    }
    public function loadTweetById($id) {
        
        $db=new Connection();
        $result = $db ->query($sql="`Select` * from `twitter` Where `id`=$id");
        
        if( $result==TRUE && $result->num_rows == 1){
            
            $row=fetch_assoc();
            
            $tweet= new Twitter();
            $tweet ->id=$row['id'];
            $tweet ->data=$row['creationData'];
            $tweet ->text =$row['text'];
            return $tweet;
        }else{
            return FALSE;
        }
    }
    public function SaveToDb() {
       
        if($this->id=-1&&$this->text&&$this->data){
            
            $db=new Connection();
      
            $result= $db ->query($sql="INSERT INTO `twitter` (`id`, `text`, `data`) "
                    . 'VALUES'. '("NULL","'.$this->text.'", "'.$this->data.'")');
            
           $this->id=$result;
           var_dump($result);   
        }
        else{
            return FALSE;
        }
    }
    
    
}
$data= date("Y-m-d");
$tweetOne = new Twitter();
$tweetOne->SetText("Dobry wpis");
$tweetOne->getData();
$tweetOne->SaveToDb();
var_dump($tweetOne);
    
