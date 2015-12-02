    var distanceBall=0; 
    var directionBall=1; 
    var timerToggle=null; 
    
    function animateBall() {   
        document.getElementById("basketball").style.top=distanceBall + "px";
        distanceBall+=directionBall;
        if (distanceBall>200) { directionBall=-1; }
        if (0>distanceBall) { directionBall=1; }
        timerToggle=setTimeout(function() { animateBall(); },10);
    }
    
    function checkButton() {
        if (document.getElementById("ballButton").value=="Animate Basketball") {
            document.getElementById("ballButton").value="Stop Basketball";
            animateBall();
        } else {
            document.getElementById("ballButton").value="Animate Basketball";
            clearTimeout(timerToggle);
        }
    }
