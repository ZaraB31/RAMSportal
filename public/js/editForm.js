function openNameForm(formName, elementID, elementName) {
    form = open(formName, elementID);
    form.querySelector("input#name").value = elementName;
}

function openHospitalForm(formName, elementID, elementName, elementAddress) {
    form = open(formName, elementID);
    form.querySelector("input#name").value = elementName;
    form.querySelector("input#address").value = elementAddress;
}

function open(formName, elementID) {
    var x = document.getElementById(formName);
    x.style.display = 'block';
    route = "Admin/" + formName + "/" + elementID;
    var form = x.querySelector("form");
    form.action = route;

    return form;
}