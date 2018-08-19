<?php 
    require_once 'common.php';
   
    class player{
        public $playName;
        public $playerId;
      

        function __construct($playerId,$playName)
        {
            $this->playerId=$playerId;
            $this->playName=$playName;
       }

    }
?>