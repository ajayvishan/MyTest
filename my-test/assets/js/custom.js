$(document).on('click', '.url-btn', function () {
    url = $(this).data('url');
    console.log(url);
});
// form submit
$(document).on('submit', '.form-submit', function (e) {
    e.preventDefault();
    let form = $(this);
    let formData = new FormData($(form)[0]);

    $.ajax({
        url,
        type: 'post',
        cache: false,
        dataType: 'json',
        contentType: false,
        processData: false,
        data: formData,
        success: function (data) {
            console.log(data);
            if (data.swal) {
                Swal.fire(data.swal);
            }

            if(data.type == "success"){
                $("form").trigger("reset");
            }

            if(data.redirect){
                window.location = data.url;
            }
        },
        error: function (err) {
            console.log(err);
        }
    })
});



// password
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");
var lengthMax = document.getElementById("lengthMax");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() 
{
  // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if(myInput.value.match(lowerCaseLetters)) {  
        letter.classList.remove("invalid");
        letter.classList.add("valid");
    } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
    }
    
    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if(myInput.value.match(upperCaseLetters)) {  
        capital.classList.remove("invalid");
        capital.classList.add("valid");
    } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if(myInput.value.match(numbers)) {  
        number.classList.remove("invalid");
        number.classList.add("valid");
    } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
    }
    
    // Validate length
    if(myInput.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
    } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
    }

    // Validate lengthMax
    if(myInput.value.length <= 16) {
        lengthMax.classList.remove("invalid");
        lengthMax.classList.add("valid");
    } else {
        lengthMax.classList.remove("valid");
        lengthMax.classList.add("invalid");
    }
  
}

