<?php

require_once 'common.php';

class visitorCountDao {

    // get total visitor number

    public  function retrieveVisitorCount() {
        $sql = "select count(vid) as totalvisits from visitor";
         
        $connMgr = new ConnectionManager();          
        $conn = $connMgr->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($row = $stmt->fetch()) {
            return $row['totalvisits'];
        }
    }


   //Update total visitor number

   public function updateVisitor($visitor_name){

        $sql= "insert into visitor values(default,:vname)";
        $conn_manager = new ConnectionManager();
        $conn  = $conn_manager->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":vname",$visitor_name, PDO::PARAM_STR);
        $stmt->execute();

   } 
}


?>