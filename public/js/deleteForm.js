function openForm(formName, elementID) {
    var x = document.getElementById(formName);
    x.style.display = 'block';
    route = "/" + formName + "/" + elementID;
    x.querySelector("form").action = route;
}

function closeForm(formName) {
    var x = document.getElementById(formName);
    x.style.display = 'none';
}