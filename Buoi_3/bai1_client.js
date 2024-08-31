function validateForm() {
    var isValid = true;

    document.getElementById('tensacherror').innerHTML = "";
    document.getElementById('tacgiaerror').innerHTML = "";
    document.getElementById('nxberror').innerHTML = "";
    document.getElementById('namxberror').innerHTML = "";

    var tensach = document.forms["bookForm"]["tensach"].value;
    var tacgia = document.forms["bookForm"]["tacgia"].value;
    var nxb = document.forms["bookForm"]["nxb"].value;
    var namxb = document.forms["bookForm"]["namxb"].value;
    
    if (tensach == "") {
        document.getElementById('tensacherror').innerHTML = "Vui lòng điền tên sách!";
        isValid = false;
    }

    if (tacgia == "") {
        document.getElementById('tacgiaerror').innerHTML = "Vui lòng điền tên tác giả!";
        isValid = false;
    }

    if (nxb == "") {
        document.getElementById('nxberror').innerHTML = "Vui lòng điền nhà xuất bản!";
        isValid = false;
    }

    if (namxb == "") {
        document.getElementById('namxberror').innerHTML = "Vui lòng điền năm xuất bản!";
        isValid = false;
    } else if (isNaN(namxb)) {
        document.getElementById('namxberror').innerHTML = "Năm xuất bản phải là số!";
        isValid = false;
    }

    return isValid;
}
