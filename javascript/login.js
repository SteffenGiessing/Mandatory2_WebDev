$(document).ready(function () {
  $(".message a").click(function () {
    $("form").animate({ height: "toggle", opacity: "toggle" }, "slow");
  });
  $(".login").click(function (){
      console.log("LoginClicked")
      login();
  });
  $(".createUser").click(function () {
    console.log("Clicked");
    CreateUser();
  });
});
function login(){
  let loginEmail = $("#loginEmail").val();
  let loginPassword = $("#loginPassword").val();
  console.log(loginEmail, ": ", loginPassword);
  $.ajax({
    url: "../Api/api.php",
    type: "POST",
    data: {
      entity: "customer",
      action: "loginCustomer",
      loginEmail: loginEmail,
      loginPassword: loginPassword
    },
    success: function(data){
        console.log(data)
        if ($.trim(data) == 'true'){
          window.location.replace("../Html_Css/home.php");
        } else {
          alert("password or email not correct");
        }
    }
  });
}

function CreateUser() {
  console.log("hitting function CreateUser");
  let firstName = $("#firstName").val();
  let lastName = $("#lastName").val();
  let password = $("#password").val();
  let company = $("#company").val();
  let address = $("#address").val();
  let city = $("#city").val();
  let state = $("#state").val();
  let country = $("#country").val();
  let postalCode = $("#postalCode").val();
  let phone = $("#phone").val();
  let fax = $("#fax").val();
  let email = $("#email").val();

  $.ajax({
    url: "../Api/api.php",
    type: "POST",
    data: {
      entity: "customer",
      action: "createCustomer",
      firstName: firstName,
      lastName: lastName,
      password: password,
      company: company,
      address: address,
      city: city,
      state: state,
      country: country,
      postalCode: postalCode,
      phone: phone,
      fax: fax,
      email: email
    },
    success: function(data) {
      let data2 = JSON.parse(data);
      console.log(data2)
      if (data2 == true){
        console.log("Hitting TRUE");
      } else {
        console.log("Hitting False")
          loginRejected(email);
      }
      console.log(data + " Added");
    },
  });
}
function loginRejected(email){
    $('.divClass').click(function() {
      
    })

}
