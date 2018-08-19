<?php

  require_once 'common.php';

class gameDao
{
    public function addNewGame($game) //game object
    {
        $sql= "insert into gameresult values(default,:gameScore,:gamePhase,:gamePlayer)";
        $conn_manager = new ConnectionManager();
        $conn  = $conn_manager->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":gameScore",$game->gameScore, PDO::PARAM_INT);
        $stmt->bindParam(":gamePhase",$game->gamePhase, PDO::PARAM_INT);
        $stmt->bindParam(":gamePlayer",$game->gamePlayerId, PDO::PARAM_INT);
        $stmt->execute();

    }

    public function getTotalNumberOfgame(){
        $sql = "select count(gid) as TotalNumberOfgame from gameresult ";
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if ($row = $stmt->fetch()) {
            return $row['TotalNumberOfgame'];
        }

    }

    public function getTopGameResult()
    {
        $games = [];
        $game=null;
        $gp=[];

        $sql="select gid,pid,pname,gscore,gphase 
                     from((select * from gameresult as g left join player as p on g.gplayer = p.pid) as temp) 
                     where temp.gscore in
                     (select max(gscore) from gameresult as g left join player as p on g.gplayer = p.pid group by p.pid) 
                     order by gscore desc limit 10 ";

        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $gp=[];
           $game=new game($row['gid'],$row['pid'],$row['gscore'],$row['gphase']);
           $gp=array($game,$row['pname']);
           array_push($games,$gp);
        }
        return $games;

    }




}



?>