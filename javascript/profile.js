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
    Object.keys(data).forEach(function(keys)  {
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
    });
}
function EditUser(){
    console.log("Hitting Edit");
    let firstNameChange = $("#firstname").val();
    let lastNameChange = $("#lastname").val();
    let companyChange = $("#company").val();
    let addressChange = $("#address").val();
    let cityChange = $("#city").val();
    let stateChange = $("#state").val();
    let countryChange = $("#country").val();
    let postalCodeChange = $("#postalcode").val();
    let phoneChange = $("#phone").val();
    let faxChange = $("#faxChange").val();
    let emailChange = $("#email").val();
    let apiUrl = setApiUrl("profile", "editProfile");
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
            console.log(data)
            location.reload();
        }
    });
}
function editPassword() {
    console.log("hitting password change")
    let password = $("#password").val();
    console.log(password)
    let apiUrl = setApiUrl("profile", "changePassword")
    $.ajax({
        url: apiUrl,
        type: POST,
        data: JSON.stringify ({
            password: password
        }),
        success: function(data){
            console.log(data);
        }
    })
}
});
