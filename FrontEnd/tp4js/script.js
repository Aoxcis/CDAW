let index = 0;

document.addEventListener("DOMContentLoaded", function(){
    const medias = document.querySelectorAll("#medias > div");
    const focus = document.getElementById("focus");
    

    document.addEventListener("keydown", function(e){
        if(e.key === "ArrowRight"){
            index++;
            if(index >= medias.length){
                index = 0;
            }
            updateFocus();
        }
        if(e.key === "ArrowLeft"){
            index--;
            if(index < 0){
                index = medias.length - 1;
            }
            updateFocus();
        }
    });
});


function updateFocus(){
    alert("index: "+index);
    const medias = document.querySelectorAll(".media");
    const focus = document.getElementById("focus");

    focus.innerHTML = medias[index].innerHTML;

}