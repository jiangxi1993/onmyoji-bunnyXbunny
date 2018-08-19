<?php
          require_once 'common.php';

          $GameplayerDao= new playerDao();
          $GameDao=new gameDao();
          $gameID=0;
          $gamePhase=0;
          $gameScore=0;
          $gamePlayerName="";


          if(isset($_REQUEST)){

              $gamePlayerName=$_REQUEST['gamePlayerName'];
              $gamePhase=intval($_REQUEST['gamePhase']);
              $gameScore=intval($_REQUEST['gameScore']);
              $_SESSION['playerName']= $gamePlayerName;
              if($GameplayerDao->checkPlayerId($gamePlayerName)!=''){

                  $playerID=$GameplayerDao->checkPlayerId($gamePlayerName);
                  $player=new player($playerID,$gamePlayerName);

              }else{
                  $GameplayerDao->addPlayer($gamePlayerName);
                  $playerID=$GameplayerDao->checkPlayerId($gamePlayerName);
                  $player=new player($playerID,$gamePlayerName);
              }

                  $game=new game($gameID,$player->playerId,$gameScore, $gamePhase);
                  $GameDao->addNewGame($game);

          }



?>