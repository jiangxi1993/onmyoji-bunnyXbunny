<?php

require_once 'common.php';

$GameDao=new gameDao();

$games=$GameDao->getTopGameResult();

$rank=1;
?>


<html>
<head>
    <meta charset="utf-8" />
    <style type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Knewave" rel="stylesheet">
     body {
        background-color:transparent;
    }
     th{
         padding:15px;
         font-family: 'Knewave', cursive;
         font-size: 18px;
         color: cyan;
         margin:0 auto;
         text-shadow: 2px 2px 2px black;
         -webkit-text-stroke: 0.4px black;
         font-weight:bold;
         
     }
     td{
        padding-top:6px;
        font-family: 'Knewave', cursive;
        font-size: 18px;
        font-weight:bold;
        color: cyan;
         margin:0 auto;
         text-shadow: 2px 2px 2px black;
         -webkit-text-stroke: 0.4px black;
       
     }
     table {
         margin:0 auto;
         border:0;
         text-align:center;
         padding:5px;
         position:fixed;
         top:0;
         left:20px'
         width:100%;
    }
   
    
    </style> 
</head>
<body>
    <table>
    <tr>
        <th>Rank</th>
        <th>Player</th>
        <th>Highest<br>Score</th>
        <th>Defended<br>phases</th>
    </tr>

  <?php
     
    foreach($games as $gameArrray){

        
        $player=$gameArrray[1];
        $Hscore=$gameArrray[0]->gameScore;
        $gphase=$gameArrray[0]->gamePhase;
        echo "<tr>";
        echo "<td >{$rank}</td>";
        $rank++;
        echo "<td>{$player}</td>";
        echo "<td>{$Hscore}</td>";
        echo "<td>{$gphase}</td></tr>";       

    }?>
    </table>
</body>
</html>