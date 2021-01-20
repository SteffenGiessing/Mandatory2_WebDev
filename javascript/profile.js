$(document).ready(function() { 
    $(".submitEditUser").click(function() {
        EditUser();
    });
    $(".editPassword").click(function() {
        editPassword();
    });
    let apiUrl = setApiUrl("profile", "getProfile"); 
    $.ajax({
    url: apiUrl,
    type: GET,
    success: function(data) {
        console.log(data);
        setupProfileTable(data);
    }, failure: function(e) {
        console.log("failure: " + e);
    }, error: function(e) {
        console.log("error: " + e);
        console.log(JSON.stringify(e));
    }
});
function setupProfileTable(data){
        $("#firstname").val(data.FirstName);
        $("#lastname").val(data.LastName);
        $("#company").val(data.Company);
        $("#address").val(data.Address);
        $("#city").val(data.City);
        $("#state").val(data.State);
        $("#country").val(data.Country);
        $("#postalcode").val(data.PostalCode);
        $("#phone").val(data.Phone);
        $("#fax").val(data.Fax);
        $("#email").val(data.Email);
 
}
function EditUser(){
    let firstNameChange = $("#firstname").val();
    let lastNameChange = $("#lastname").val();
    let companyChange = $("#company").val();
    let addressChange = $("#address").val();
    let cityChange = $("#city").val();
    let stateChange = $("#state").val();
    let countryChange = $("#country").val();
    let postalCodeChange = $("#postalcode").val();
    let phoneChange = $("#phone").val();
    let faxChange = $("#fax").val();
    let emailChange = $("#email").val();

    if( firstNameChange.length === 0  || lastNameChange.length === 0 || companyChange.length === 0  || addressChange.length === 0 || 
        cityChange.length === 0 || stateChange.length === 0 || countryChange.length === 0 || postalCodeChange.length === 0 ||
        phoneChange.length === 0 ||  faxChange.length === 0 ||  emailChange.length === 0 
    ) {
        $('div#snackbar').text('Please fill out all fields.');
        showSnackbar();
    } else if(
        !firstNameChange.match($regExInput) || !lastNameChange.match($regExInput) || !companyChange.match($regExInput) || !cityChange.match($regExInput) || 
        !stateChange.match($regExInput) || !countryChange.match($regExInput) || !postalCodeChange.match($regExInput) || !phoneChange.match($regExInput) || !faxChange.match($regExInput)
    ){
        $('div#snackbar').text("You Shall Not Pass!");
        showSnackbar();
    } else {

    let apiUrl = setApiUrl("profile", "editProfile");
    console.log("hitting");
    $.ajax({
        url: apiUrl,
        type: POST,
        data: JSON.stringify({
            firstNameChange: firstNameChange,
            lastNameChange: lastNameChange,
            companyChange: companyChange,
            addressChange: addressChange,
            cityChange: cityChange,
            stateChange: stateChange,
            countryChange: countryChange,
            postalCodeChange: postalCodeChange,
            phoneChange: phoneChange,
            faxChange: faxChange,
            emailChange: emailChange
        }),
        success: function(data) {
            $('div#snackbar').text("Successfully updated");
            showSnackbar();
            
        }
    });
}
}
function editPassword() {
    let password = $("#password").val();
    if(password.length === 0){
        $('div#snackbar').text("Please type your new password.");
        showSnackbar();
    } else if(!password.match($regExInput)) {
        $('div#snackbar').text("You Shall Not Pass!");
        showSnackbar();
    }else {
    let apiUrl = setApiUrl("profile", "changePassword")
    $.ajax({
        url: apiUrl,
        type: POST,
        data: JSON.stringify ({
            password: password
        }),
        success: function(data){
            $('div#snackbar').text("Successfully updated");
            showSnackbar();
        }
    })
}
}
});
