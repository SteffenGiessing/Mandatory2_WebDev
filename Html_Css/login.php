<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../javascript/jquery-3.5.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../javascript/functions.js"></script>
    <script type="text/javascript" src="../javascript/login.js"></script>
    <link rel="stylesheet" href="css.css">
</head>
<body>
<div class="login-page">
    <div class="form">
      <form class="register-form">
        <input type="text" id="firstName" placeholder="First name"/>
        <input type="text" id="lastName" placeholder="Last name"/>
        <input type="password" id="password"placeholder="Password"/>
        <input type="text" id="company"placeholder="Company"/>
        <input type="text"id="address" placeholder="Address"/>
        <input type="text" id="city"placeholder="City"/>
        <input type="text" id="state"placeholder="State"/>
        <input type="text" id="country"placeholder="Country"/>
        <input type="zip" id="postalCode"placeholder="Postal Code"/>
        <input type="tel" id="phone" placeholder="Phone"/>
        <input type="text"id="fax" placeholder="Fax"/>
        <input type="email"id="email"placeholder="Email address"/>
        <button class="createUser">create</button>
        <p class="message">Already registered? <a href="#">Sign In</a></p>
      </form>
      <form class="login-form">
        <input type="email", id="loginEmail" placeholder="email"/>
        <input type="password", id="loginPassword" placeholder="password"/>
        <button class="login">login</button>
        <p class="message">Not registered? <a href="#">Create an account</a></p>
      </form>
    </div>
  </div>

  <div class="loginRejectModal" id="modal">
      <div class="modalContent" id="modalContent">
          Email: <span id="modalEmail"></span><br>
          
      </div>
  </div>
</body>
</html>