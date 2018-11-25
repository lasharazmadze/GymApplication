function notAvaliable() {
    alert("სერვისი დროებით მიუწვდომელია.");
}
function confirmLogout() {
    if (confirm("ნამდვილად გსურთ სისტემიდან გასვლა?") === true) {
        window.location = "logout.php";
    }
}
function getPaidMonthsValue(val) {
    document.getElementById("paidmonthsval").innerHTML = "წინასწარ გადახდილია " + val + " თვის გადასახადი";
}
function validateSearchBox() {
    if (document.getElementById("idnumber").value === "") {
        alert("საძიებო ველი არ უნდა იყოს ცარიელი.");
    } else if (document.getElementById("referralidnumber").value === "") {
        alert("");
    }
}
function changeSelect() {
    if (document.getElementById("service").value === "Bodybuilding Gym") {
        document.getElementById("days").value = "ულიმიტო";
        document.getElementById("hours").value = "";
        document.getElementById("days").disabled = true;
        document.getElementById("hours").disabled = true;
    } else if (document.getElementById("days").value === "ულიმიტო") {
        document.getElementById("hours").value = "";
        document.getElementById("hours").disabled = true;
    } else {
        document.getElementById("days").disabled = false;
        document.getElementById("hours").disabled = false;
    }
}
function validateFields() {
    if (document.getElementById("firstname").value === "") {
        alert("სახელის ველი ცარიელია.");
    } else if (document.getElementById("lastname").value === "") {
        alert("გვარის ველი ცარიელია.");
        return false;
    } else if (document.getElementById("idnumber").value === "") {
        alert("პირადი ნომრის ველი ცარიელია.");
        return false;
    } else if (document.getElementById("service").value === "") {
        alert("სერვისის ველი ცარიელია.");
        return false;
        if (document.getElementById("service").value === "აერობიკა + ფიტნესი") {
            if (document.getElementById("days").value === "") {
                alert("დღეების ველი ცარიელია.");
                return false;
            } else if (document.getElementById("hours").value === "") {
                alert("საათების ველი ცარიელია.");
                return false;
            }
        }
    } else if (document.getElementById("regdate").value === "") {
        alert("რეგისტრაციის თარიღის ველი ცარიელია.");
        return false;
    } else if (document.getElementById("nextpaydate").value === "") {
        alert("მომდევნო გადახდს თარიღის ველი ცარიელია.");
        return false;
    } else {
        return true;
    }
}