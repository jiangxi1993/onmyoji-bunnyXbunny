<?php

require_once 'common.php';

class playerDao {

    // checkplayer

    public  function checkPlayerStatus($player) {  //player object
        $playerName=$player->playerName;

        $sql = "select * from player where pname=:playername" ;
        $connMgr = new ConnectionManager();          
        $conn = $connMgr->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":playername",$playerName, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($row = $stmt->fetch()) {
            return true;
            }
            return false;
    }

    public function checkPlayerId($playerName) {  //player name string

        $sql = "select pid from player where pname=:playername" ;
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":playername",$playerName, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($row = $stmt->fetch()) {
            return $row['pid'];
        }
    }


   //add player

   public function addPlayer($playerName){ //player string

        $sql= "insert into player values(default,:playerName)";
        $conn_manager = new ConnectionManager();
        $conn  = $conn_manager->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":playerName",$playerName, PDO::PARAM_STR);
        $stmt->execute();

   }

   public function  getTotalnumberOfPlayer()
   {
       $hobbies = [];
       $hobby=null;
       $sql = "select count(pid) as totalplayers from player";
       $connMgr = new ConnectionManager();
       $conn = $connMgr->getConnection();
       $stmt = $conn->prepare($sql);
       $stmt->setFetchMode(PDO::FETCH_ASSOC);
       $stmt->execute();
       if ($row = $stmt->fetch()) {
           return $row['totalplayers'];
       }
   }

}


?>