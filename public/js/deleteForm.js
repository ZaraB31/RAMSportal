function openForm(formName, elementID) {
    var x = document.getElementById(formName);
    x.style.display = 'block';
    route = "http://localhost:8000/" + formName + "/" + elementID;
    x.querySelector("form").action = route;
}