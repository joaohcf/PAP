var bannerStatus = 1;
var bannerTime = 4000;

var startBannerLoop = setInterval(function() {
    bannerLoop();
}, bannerTime);

document.getElementById("imgbanbtn-prev").onclick = function(){
    if(bannerStatus === 1){
        bannerStatus = 2;
    }else if (bannerStatus = 2){
        bannerStatus = 3;
    }else if (bannerStatus === 3){
        bannerStatus = 1;
    }
    bannerLoop();
}

document.getElementById("imgbanbtn-next").onclick = function(){
    bannerLoop();
}

function bannerLoop(){
    if(bannerStatus === 1) {
        document.getElementById("imgban2").style.opacity = "0";
        setTimeout(function(){
            document.getElementById("imgban1").style.right = "0px";
            document.getElementById("imgban1").style.zIndex = "10";
            document.getElementById("imgban2").style.right = "-100%";
            document.getElementById("imgban2").style.zIndex = "15";
            document.getElementById("imgban3").style.right = "100%";
            document.getElementById("imgban3").style.zIndex = "5";
        }, 500);
        setTimeout(function(){
            document.getElementById("imgban2").style.opacity = "1";
        }, 1000);
        bannerStatus = 2;
    }
    else if(bannerStatus === 2) {
        document.getElementById("imgban3").style.opacity = "0";
        setTimeout(function(){
            document.getElementById("imgban2").style.right = "0px";
            document.getElementById("imgban2").style.zIndex = "10";
            document.getElementById("imgban3").style.right = "-100%";
            document.getElementById("imgban3").style.zIndex = "15";
            document.getElementById("imgban1").style.right = "100%";
            document.getElementById("imgban1").style.zIndex = "5";
        }, 500);
        setTimeout(function(){
            document.getElementById("imgban3").style.opacity = "1";
        }, 1000);
        bannerStatus = 3;
    }
    else if(bannerStatus === 3) {
            document.getElementById("imgban1").style.opacity = "0";
            setTimeout(function(){
                document.getElementById("imgban3").style.right = "0px";
                document.getElementById("imgban3").style.zIndex = "10";
                document.getElementById("imgban1").style.right = "-100%";
                document.getElementById("imgban1").style.zIndex = "15";
                document.getElementById("imgban2").style.right = "100%";
                document.getElementById("imgban2").style.zIndex = "5";
            }, 500);
            setTimeout(function(){
                document.getElementById("imgban1").style.opacity = "1";
            }, 1000);
        bannerStatus = 1;
    }
}