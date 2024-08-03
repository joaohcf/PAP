function navbarmenu(){
    var menu = document.getElementById('navbarmenu'); 
    menu.classList.toggle('enable');
}

function setImageProduto(imgs) {
    var expandImg = document.getElementById("expandedImg");
    var imgText = document.getElementById("imgtext");
    expandImg.src = imgs.src;
    imgText.innerHTML = imgs.alt;
    expandImg.parentElement.style.display = "block";
}

function setSettings(btn){
    var info = document.getElementById('Informações');
    var end = document.getElementById('Moradas');
    var enc = document.getElementById('Encomendas');
    var fav = document.getElementById('Favoritos');

    function hide(){
        info.classList.remove('active');
        end.classList.remove('active');
        enc.classList.remove('active');
        fav.classList.remove('active');
    }

    if(btn.id == 'toInformações'){
        hide();
        info.classList.add('active');
    }else if(btn.id == 'toMoradas'){
        hide();
        end.classList.add('active');
    }else if(btn.id == 'toEncomendas'){
        hide();
        enc.classList.add('active');
    }else if(btn.id == 'toFavoritos'){
        hide();
        fav.classList.add('active');
    }
}

function newaddress(){
    // Get the modal
    var modal = document.getElementById('new-address');
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            }
        }
    }

function deleteaccount(){
    // Get the modal
    var modal = document.getElementById('delete-account');
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            }
        }
    }

function shownewpsw(){
    var check = document.getElementById('check');
    var newpsw = document.getElementById('newpassword');

    // If the checkbox is checked, display the output text
    if (check.checked == true){
        newpsw.style.display = "block";
    } else {
        newpsw.style.display = "none";
    }
}