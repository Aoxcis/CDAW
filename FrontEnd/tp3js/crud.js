"use strict";

let currentEditingParagraph = null;

document.addEventListener("DOMContentLoaded", function() {
    let modifiers = document.getElementsByClassName("modify");
    Array.from(modifiers).forEach(m => m.addEventListener("click",modify));

    let remover = document.getElementsByClassName("remove");
    Array.from(remover).forEach(m => m.addEventListener("click",deleter));

    let addNew = document.getElementById("addNew");
    addNew.addEventListener("click", adder);

    document.getElementById("myForm").addEventListener("submit", function(e) {
        e.preventDefault(); // Prevent actual form submission
        submitForm();
    });
}); 

function modify(e)
{
    var userDiv = e.currentTarget.parentNode;
    var paragraph = userDiv.querySelector("p");
    currentEditingParagraph = paragraph;
    document.forms.myForm.style.display = "block";

    document.forms.myForm.elements["comment"].value = paragraph.textContent;
}

function deleter(e)
{
    alert(e.type +" on remove for "+ e.currentTarget.parentNode.id+" !");
    e.currentTarget.parentNode.remove();
}

function adder(e){
    var userDiv = document.createElement("div");
    userDiv.id = "user"+document.getElementsByClassName("user").length;
    userDiv.className = "user";

    var name = document.createElement("h4");
    name.textContent = "New User";
    userDiv.appendChild(name);

    var paragraph = document.createElement("p");
    paragraph.textContent = "New text";
    userDiv.appendChild(paragraph);

    var modifyButton = document.createElement("button");
    modifyButton.textContent = "Modify";
    modifyButton.className = "modify";
    modifyButton.addEventListener("click", modify);
    userDiv.appendChild(modifyButton);

    var removeButton = document.createElement("button");
    removeButton.textContent = "Remove";
    removeButton.className = "remove";
    removeButton.addEventListener("click", deleter);
    userDiv.appendChild(removeButton);

    document.getElementById("users").appendChild(userDiv);
}

function submitForm(e){
    let value = document.forms.myForm.elements["comment"].value;
    if(value === ""){
        alert("Please enter a comment before submitting");
        return;
    }

    if(currentEditingParagraph){
        currentEditingParagraph.textContent = value;
        currentEditingParagraph = null;
    }
    document.forms.myForm.elements["comment"].value = "";
    alert
}


