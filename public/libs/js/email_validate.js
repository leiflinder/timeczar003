function showPassword_psw1() {
    var x = document.getElementById("psw1");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
    var y = document.getElementById("psw2");
    if (y.type === "password") {
        y.type = "text";
    } else {
        y.type = "password";
    }
}

var email = document.getElementById("email");
var myInput = document.getElementById("psw1");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");


// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if (myInput.value.match(lowerCaseLetters)) {
        letter.classList.remove("invalid");
        letter.classList.add("valid");
    } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
    }

    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if (myInput.value.match(upperCaseLetters)) {
        capital.classList.remove("invalid");
        capital.classList.add("valid");
    } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if (myInput.value.match(numbers)) {
        number.classList.remove("invalid");
        number.classList.add("valid");
    } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
    }

    // Validate length
    if (myInput.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
    } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
    }

    var password = document.getElementById('psw1');
    var confirm = document.getElementById('psw2');
    //Store the Confirmation Message Object ...
    var message = document.getElementById('confirm-message2');
    //Set the colors we will be using ...
    var good_color = "#66cc66";
    var bad_color = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if (password.value == confirm.value) {
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        // confirm.style.backgroundColor = good_color;
        confirm.style.borderColor = good_color;
        message.style.color = good_color;
        message.innerHTML = '<p>Passwords Match</p>';
        this.validNumber = this.validNumber + 1;
        //validNumber.innerHTML = this.validNumber;
        validNumber.innerHTML = '<p>Number here</p>';
    } else {
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        confirm.style.borderColor = bad_color;
        message.style.color = bad_color;
        message.innerHTML = '<p>Passwords Do Not Match</p>';
    }

}


function checkPass() {
    //Store the password field objects into variables ...
    var password = document.getElementById('psw1');
    var confirm = document.getElementById('psw2');
    //Store the Confirmation Message Object ...
    var message = document.getElementById('confirm-message2');
    //Set the colors we will be using ...
    var good_color = "#66cc66";
    var bad_color = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if (password.value == confirm.value) {
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        confirm.style.borderColor = good_color;
        message.style.color = good_color;
        message.innerHTML = '<p>Passwords Match</p>';
    } else {
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        confirm.style.borderColor = bad_color;
        message.style.color = bad_color;
        message.innerHTML = '<p>Passwords Do Not Match</p>';
    }

}