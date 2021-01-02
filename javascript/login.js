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
  apiUrl = setApiUrl("user", "validateLogin")
  $.ajax({
    url: apiUrl,
    type: POST,
    data: JSON.stringify( {
      loginEmail: loginEmail,
      loginPassword: loginPassword
    }),
    success: function(data){
      console.log(data);
      if (data.isUserValid === true){
          console.log("TRUE");
          //window.location.replace("index.php");
          window.location.replace("http://localhost/Exam/Html_Css/home.php");
        } else {
          console.log("ALERT");
          alert("Login credentials uncorrect");
        }
  }, failure: function(e) {
      console.log('failure: ' + e);
  }, error: function(e) {
      console.log('error: ' + e);
      console.log(JSON.stringify(e));
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
  apiUrl = setApiUrl("user", "createuser");
  $.ajax({
    url: apiUrl,
    type: POST,
    data: JSON.stringify({
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
    }),
    success: function(data) {
      if(data.isUserCreated == true) {
        $('form').animate({ height: "toggle", opacity: "toggle" }, "slow");
    } else {
        alert("Email already exists")
    }
}, failure: function(e) {
    console.log('failure: ' + e);
}, error: function(e) {
    console.log('error: ' + e);
    console.log(JSON.stringify(e));
}
});

}
function signOut(){
  console.log("hej");
  apiUrl = setApiUrl("user", "sign-out");
  $.ajax({
    url: apiUrl,
    type: POST,
    success: function() {
      window.location.reload();
    }
  });
}
function loginRejected(email){
    $('.divClass').click(function() {
      
    })

}
