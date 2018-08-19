<?php

    /**
     * 
     * Programmer: JIANG XI
     *
 
     *This page is created for personal study only. 

     *It helps the site owner to revise and practise previously learnt knowledge about web development.

     *The site used Javascript HTML PHP and CSS technologies.

     *Best resolution 1920x1080。

     * 
     * 
     */

    require_once 'common.php';
    $visitorDao=new visitorCountDao();
    $GameplayerDao= new playerDao();
    $hostname=gethostname();
    $totalvisitor=$visitorDao->retrieveVisitorCount();
    $playerName='';


    if(isset($_SESSION['hostname'])!=true){

        if($hostname!=""&&isset($hostname)){
            $visitorDao->updateVisitor($hostname);
            $_SESSION['hostname']=$hostname;
        }
        else{
            $hostname=date('d-m-Y-H-i-s');
            $_SESSION['hostname']=$hostname;
        }

        $totalvisitor++;
    }

    if(isset($_SESSION['playerName'])!=true){
        $playerName="player-".($GameplayerDao->getTotalnumberOfPlayer()+1);
        $_SESSION['playerName']= $playerName;

    }else{
        $playerName=($_SESSION['playerName']);
    }



?>

<html>

    <head>
        
        <title>Bunny X Bunny - A Dojin Game for Onmyoji Fans -Beta 1 </title>
        <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/1/15/%E6%A5%B5%E6%9D%B1%E4%BC%9A.png">
        <link href="https://fonts.googleapis.com/css?family=Knewave" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Merienda" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="BunnyxbunnyStyle.css">
    </head>

    <body> 
        <div id="background">
           
          <!--  <img id="logo" src="img/decorations/gamelogo.png"> -->
            <div id="top-decoration" class="windows"><img src="img/decorations/header.png"></div>
            <img id="bg-decoration-2" src="img/decorations/bg-decoration2.png">
            <img id="bg-decoration-3" src="img/decorations/bg-decoration3.png">      
            <img id="bg-decoration-1" src="img/decorations/bg-decoration1.png"></div>


           

        <div id="containerCage">
            <div id="pageContainer">
                
                <button id="startGame"><img id="startGameBg"src="img/decorations/fonts-img/font-website-start.png"></button>
                <button id="restartGame"></button>
              
                <p id="lifeSection"><img id="lifeImg"src="img/decorations/fonts-img/font-website-life.png"><p id="paper-doll-p"></p>
                <p>
                <!-- <button id="howToplay">howToplay</button>-->
                <div id="base-display"><span id="PageTop" name="PageTop"></span></div>
                    <p id="scoreSection" ><img id="scoreImg"src="img/decorations/fonts-img/font-website-score.png"><span id="score">-</span></p>
                    <div class="clear"></div>  
                    <p><div id="base"></div>
                     
                    <img id="platform" src="img/decorations/platform.png" >
                    
                    <div id="howToplayBackgoundColor"></div>
                    
                    <div id="howToplaySection">  
                        <img id="howToplayBackgound" src="img/decorations/howtoplay.png">
                        <img id="howToplayLogo" src="img/decorations/fonts-img/font-website-howto.png">
                        <img id="howToplayText" src="img/decorations/fonts-img/howtoplayText.png">                 
                    </div>
                    
                    <div id="chc-display"><embed id="backgroundMusic" src="" loop="true" autostart="true"  hidden="true" volume="50"></embed></div>
                   
                    <div id="rankSection">
                        <img id="rankLogo" src="img/decorations/fonts-img/font-website-stat.png">
                        <img id="rankBackgound" src="img/decorations/rank2.png">
                        <iframe id="rankPage" src="./rank.php" ></iframe>
                    </div>

                    <div id="playernameSection">
                        <img id="playerNameImg" src="img/decorations/fonts-img/font-website-nickname.png">
                        <form><input type="text" name="playnameInput" id="playnameInput" value="<?php echo $playerName;?>"></form>
                        <h2 id="playerNameDisplay"></h2>
                    </div>

            </div>


            <img id="bunnyLogo" src="img/decorations/bunny.gif">
            <a href="#PageTop"><img id="goTop" src="img/decorations/fonts-img/top.png"></a>
            <div id="left-window" class="windows"><img src="img/decorations/window-left.png"></div>
            <div id="right-window" class="windows"><img src="img/decorations/window-right.png"></div>
            <div id="totalvisitSection" ><img id="totalvisits" src="img/decorations/fonts-img/totalvisits.png"><h3 id="visitorCount"></h3></div>
            <div id="disclaimer"><p>
                    Copyright disclaimer:<br>
                This page has been created for personal study & practice only.<br>
                It helps the student(jx) to revise and practise previously learnt knowledge about web development and coding logic.<br>
                The site used AJAX,Javascript,HTML,SQL, PHP and CSS  techniques .<br>
                I do NOT own any audio files nor the images (excepted the logo) featured in this game. <br>
                All rights belong to it's rightful owner/owner's. No copyright infringement intended.<br>
               <a href="https://github.com/jiangxi1993/onmyoji-bunnyXbunny"> Source code </a><br>
                The slogan of "A dojin game for onmyoji fans" is only used for the purpose of simulating the context of project development.<br>
                The new personal gallary site of JX will be available soon.
                </>
            </div>
            
       </div>


        <script type="text/javascript">
            var shapeArray=[];
            var numOfShape=5;
            var shapeZeroId=0;
            var score=0;
            var life=3;
            var continueGame=false;
            var imgID="1";
            var shapePressed=0;
            var repeatPhase;
            var phaseinterval=2500;
            var totalVistor=0;
            var phase=0;
            var playerName='';

            initilizePage();

            document.getElementById("startGame").onclick=function(){
                initilizeGame();
                updateMusic(2,"true");

             };


           function initilizePage(){
                 document.getElementById("restartGame").style.display="none";
                 hideElement();
                 updateMusic(3,"true");
                 document.getElementById("scoreImg").style.display="none";
                 document.getElementById("score").style.visibility="hidden";
                 totalVistor="<?php echo $totalvisitor ?>";

                 document.getElementById("visitorCount").innerHTML=totalVistor;
                 document.getElementById('playnameInput').focus();

            }



           function initilizeGame(){

                createShapes(numOfShape);
                updateLife(true);
                playerName=document.getElementById("playnameInput").value;
                document.getElementById("playnameInput").style.visibility="hidden";
                document.getElementById("playerNameDisplay").style.visibility="visible"
                document.getElementById("playerNameImg").style.visibility="hidden";
                document.getElementById("playerNameDisplay").innerText=playerName;
                document.getElementById("chc-display").style.visibility="hidden";
                document.getElementById("startGame").style.display="none";
                document.getElementById("restartGame").style.display="block";
                document.getElementById("lifeImg").style.display="block";
                document.getElementById("scoreImg").style.display="block";
                document.getElementById("score").style.visibility="visible";
                document.getElementById("base-display").style.opacity="0.5";
                document.getElementById("shape0").onclick=function(){
                    updateScore(shapeZeroId);
                    updateLife(true);
                    shapePressed=1;
                    shapeReactions(0);
                    phase++;

                };

                document.getElementById("shape1").onclick=function(){
                    shapeReactions(1);
                    updateLife(false);
                    shapePressed=1;
                    phase++;
                };
                document.getElementById("shape2").onclick=function(){
                    shapeReactions(2);
                    updateLife(false);
                    shapePressed=1;
                    phase++;
                };
                document.getElementById("shape3").onclick=function(){
                    shapeReactions(3);
                    updateLife(false);
                    shapePressed=1;
                    phase++;
                };
                document.getElementById("shape4").onclick=function(){
                    shapeReactions(4);
                    updateLife(false);
                    shapePressed=1;
                    phase++;
                };

                document.getElementById("restartGame").onclick=function(){
                    window.location.replace("index.php");
                };

                repeatNextPhase(phaseinterval);
                appearAfterDelay();

           }






            function createShapes(a){
                var str='';

                for(var i=0; i<a; i++){
                str="shape"+i;
                console.log(str);
                shapeArray.push(str);
                imgID=selectCoinFace(i);
                document.getElementById("base").innerHTML+= '<div id="shape'+i+'" class="shape"><img id="role'+i+'" class="role" src="img/role_element/'+imgID+'.png"><img id="coin'+4+'"class="shapeBackground" src="img/decorations/coin.png"></div>';

               }

            }

           function updateMusic(numofmusic,loopTimes){
               var MusicSrc="";
               if(numofmusic==1){
                 MusicSrc="music/gameEnd.mp3";
               }
               else if(numofmusic==2){
                MusicSrc="music/gameStart.mp3";
               }
               else if(numofmusic==3){
                MusicSrc="music/pageLoad.mp3";
               }
               else{
                MusicSrc="music/exitbackground.mp3";
               }

                document.getElementById("chc-display").innerHTML='<embed id="backgroundMusic" src="'+MusicSrc+'" loop="'+loopTimes+'"autostart="true"  hidden="true" volume="40">';

           }

           function hideElement(){
            document.getElementById("lifeImg").style.display="none";
           }



            function makeShapeAppear(){
                var top =0;
                var left =0;
                var imgSrc="img/role_element/"+imgID+".png";

                for(var i=0;i<shapeArray.length;i++){
                    top =Math.floor(Math.random()*500);
                    left =Math.floor(Math.random()*700);

                    imgID=selectCoinFace(i);
                    imgSrc="img/role_element/"+imgID+".png"
                    console.log(imgSrc);
                    document.getElementById("role"+[i]).src=imgSrc;
                    document.getElementById(shapeArray[i]).style.backgroundColor="red";
                    document.getElementById(shapeArray[i]).style.borderColor=getRandomColor();
                    document.getElementById(shapeArray[i]).style.top=top+"px";
                    document.getElementById(shapeArray[i]).style.left=left+"px";
                    document.getElementById(shapeArray[i]).style.display="block";
                }
            }

            function repeatNextPhase(phasetime){
                repeatPhase=setInterval(function(){

                        if(shapePressed==0){

                            shapeReactions(4);
                            updateLife(false);
                            shapePressed=1;
                            phase++;
                        }else if(shapePressed==1){

                            shapePressed=0;
                        }else{
                            clearInterval(repeatPhase);
                        }

                            },phasetime);
            }

            function selectCoinFace(num){
                if(num==0){
                 shapeZeroId=generateTargetCoin();
                return shapeZeroId.toString();
                 }
                else{
                return generateTrapCoins().toString();
                }

            }

            function generateTargetCoin(){
                var selector;
                var id=1;
                selector=Math.floor(Math.random()*100);
                if(selector>=0 && selector <50){
                    id=1;
                }
                else if(selector>=50 && selector <65){
                    id=2;
                }
                else if(selector>=65 && selector <75){
                    id=3;
                }
                else if(selector>=75 && selector <90){
                    id=4;
                }
                else{
                    id=5;
                }
                return id;
            }


            function generateTrapCoins(){
                return generateRandomInt(200,319); // image id ranges
            }


            function generateRandomInt(min,max){
              return Math.floor(Math.random() * (max - min) ) + min;
            }

            function shapeReactions(n){


                   for(var i=0;i<shapeArray.length;i++){

                    document.getElementById(shapeArray[i]).style.display="none";
                }

                 appearAfterDelay();
            }


            function updateScore(n){
                if(n==1){
                    score+=100;
                }
                else if(n==2){
                    score+=150;
                }
                else if(n==3){
                    score+=180;
                }
                else if(n==4){
                    score+=200;
                }
                else {
                    score+=120;
                    life++;
                }
                document.getElementById("score").innerHTML=+score ;

            }

            function updateLife(conditions){
                if(conditions==false){
                    life--;
                }
                if(life>5){
                    life=5;
                }
                document.getElementById("paper-doll-p").innerHTML=constrcutLifeIndicator(life);

                if(life===0){
                    continueGame=false;
                    setTimeout(terminateGame,800);
                }

            }

            function constrcutLifeIndicator(numOfLife){
                var indicatorString='';
                for(var i=0;i<numOfLife;i++){

                    indicatorString+=' <img class="paper-doll-list" src="img/indicator/paper_doll.png" >';
                }
                return indicatorString;
            }


            function appearAfterDelay(){
                setTimeout(makeShapeAppear,800);
            }


            function terminateGame(){
                shapePressed=3;
                clearInterval(repeatPhase);
                updateMusic(1,"false");
                document.getElementById("base-display").style.background="url(img/decorations/fonts-img/gameover.png) top center no-repeat";
                document.getElementById("base-display").style.top="80px";
                document.getElementById("base-display").style.left="120px";
                document.getElementById("chc-display").style.visibility="visible";
                document.getElementById("base-display").style.opacity="1";
                hideElement();
                document.getElementById("base").innerHTML='';
                setTimeout(function(){updateMusic(4,"true");},3800);
                shapePressed=3;
                updateGameRecord();
                document.getElementById('rankPage').contentWindow.location.reload(true);
            }


            function createXmlHttp() {// prepare for ajax submission
                var xmlHttp = null;

                try {
                    //Firefox, Opera 8.0+, Safari
                    xmlHttp = new XMLHttpRequest();
                } catch (e) {
                    //IE
                    try {
                        xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                }
                return xmlHttp;

            }

            function getPlayerName(){
                return  document.getElementById("playerNameDisplay").innerText;
            }


            function submitResult(gameScore,gamePhase,gamePlayerName) {
                var xmlHttp = createXmlHttp();
                if (!xmlHttp) {
                    alert("AJAX is not supported by your browser！");
                    return 0;
                }

                var url = 'updateGameResult.php';
                var postData = "";
                postData = "gamePlayerName=" + gamePlayerName;
                postData += "&gameScore=" + gameScore.toString();
                postData += "&gamePhase=" + gamePhase.toString();

                xmlHttp.open("POST", url, true);
                xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlHttp.onreadystatechange = function () {

                    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                            alert('Game Record Updated');
                    }
                }
                xmlHttp.send(postData);

            }

            function updateGameRecord(){
                var gamePlayerName=getPlayerName();
                var gamePhase=phase;
                var gameScore=score;
                submitResult(gameScore,gamePhase,gamePlayerName);
            }

            function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
            }

        </script>

    </body>

</html>