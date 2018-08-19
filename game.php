<?php 
    require_once 'common.php';
   
    class game{
        public $gameId;
        public $gamePlayerId;
        public $gameScore;
        public $gamePhase;

        function __construct($gameId,$gamePlayerId,$gameScore,$gamePhase)
        {
            $this->gameId=$gameId;
            $this->gamePlayerId=$gamePlayerId;
            $this->gameScore=$gameScore;
            $this->gamePhase=$gamePhase;
        }

    }
?>