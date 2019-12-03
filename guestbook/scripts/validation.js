$("#emailFormat").hide();  // default to hide
$("#formMeetOther").hide();  // I may place these on a higher stylesheet later

let isValid = true;


//$("#guestbookForm").on("submit", validate);


// validate on click to be user friendly

$("#firstName").on("keyup", validateFirstName);
$("#lastName").on("keyup", validateLastName);
$("#linkedIn").on("keyup", validateLinkedIn);
$("#email").on("keyup", validateEmail);
$("#meetMethod").on("click", validateMeetMethod);


// showing and hiding the extra inputs
$("#mailList").on("click", toggleFormat);

$("#meetMethod").on("click", toggleOther);

function toggleFormat() {
    if ($("#mailList:checkbox:checked").length != 0) {
        $("#emailFormat").show();
    } else {
        $("#emailFormat").hide();
    }
}

function toggleOther(){
    let $meetMethod = $("#meetMethod").val();
    if ($meetMethod == "other"){
        $("#formMeetOther").show();
    } else {
        $("#formMeetOther").hide();
    }
}



function validate() {

    isValid = true;
    validateFirstName();
    validateLastName();

    validateLinkedIn();

    validateEmail();


    validateMeetMethod();



    return isValid;
}


// Separate validate functions.


function validateFirstName(){

    if( !$("#firstName").val()){
        $("#formFirstName").addClass("invalid");
        isValid = false;
    } else {
        $("#formFirstName").removeClass("invalid");
    }

    isValid = isValid && true;
}

function validateLastName(){

    if( !$("#lastName").val()){
        $("#formLastName").addClass("invalid");
        isValid = false;
    } else {
        $("#formLastName").removeClass("invalid");
    }

    isValid = isValid && true;
}


function validateEmail(){
    let $email = $("#email").val();
    if($("#mailList:checkbox:checked").length != 0) {
        if (!(/@/.test($email) && /\./.test($email))) {
            $("#formEmail").addClass("invalid");
            isValid = false;
        } else {
            $("#formEmail").removeClass("invalid");
        }
    } else {
        $("#formEmail").removeClass("invalid");
    }

}

function validateLinkedIn(){
    let pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
        '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
    let proper = pattern.test($("#linkedIn").val());
    if (!$("#linkedIn").val()){
        $("#formLinkedIn").removeClass("invalid");
    } else if (!proper) {
        $("#formLinkedIn").addClass("invalid");
        isValid = false;
    } else {
        $("#formLinkedIn").removeClass("invalid");
    }

}

function validateMeetMethod(){
    let $meetMethod = $("#meetMethod").val();
    if ($meetMethod == "none"){
        $("#formMeetMethod").addClass("invalid");
        isValid = false;
    } else {
        $("#formMeetMethod").removeClass("invalid");
    }
}