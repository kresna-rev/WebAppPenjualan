<?php
$username = $_POST['username'];
$password = $_POST['password'];
$btn = $_POST['btn'];
if($btn){
  
  $tt_jihyo = Login($username,$password);
  
}

if($_SESSION['id']){
  header("location:index.php");
}

$template = "depan";
$title = "Log In";
$content = "

        <div class='wrap-login100'>
          <form class='login100-form validate-form' method='post' autocomplete='off'>
            <span class='login100-form-logo'>
              <i class='zmdi zmdi-shopping-cart'></i>
            </span>

            <span class='login100-form-title p-b-34 p-t-27'> Log in </span>

            <div
              class='wrap-input100 validate-input'
              data-validate='Enter username'
            >
              <input
                class='input100'
                type='text'
                name='username'
                placeholder='Username'
              />
              <span class='focus-input100' data-placeholder='&#xf207;'></span>
            </div>

            <div
              class='wrap-input100 validate-input'
              data-validate='Enter password'
            >
              <input
                class='input100'
                type='password'
                name='password'
                placeholder='Password'
                id='show'
              />
              <span class='focus-input100' data-placeholder='&#xf191;'></span>
            </div>
            <div class='btn'>
              <span class='btn-show' onclick='myBtn()'>
                <i class='far fa-eye' id='eye1'></i>
                <i class='far fa-eye-slash' id='eye2'></i>
              </span>
            </div>

            <div class='container-login100-form-btn'>
              <button class='login100-form-btn' type='submit' name='btn' value='Log In'>Log In</button>
            </div>
          </form>
        </div>
      

    <div id='dropDownSelect1'></div>

";
