﻿<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap Login &amp; Register Templates</title>

        <!-- CSS -->
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/register/form-elements.css">
        <link rel="stylesheet" href="../assets/css/register/style.css">
        <link rel="stylesheet" href="../assets/css/common.css">

    </head>

    <body style="background: rgba(223, 220, 220, 0.842);">
        <script src="verifyInputs.js"></script>
        <!-- Top content -->

        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-5 ">
                            <div class="social-login">
                                <div class="social-login-buttons">
                                    <a class="btn btn-link-1 btn-link-1-google-plus" href="../index logged in.php">
                                        <i class="fab fa-google-plus-g"></i> Register Using Google+
                                    </a>
                                    </a>
                                    <a href="../index.php">
                                        <button class="btn btn-primary" style="background:#007bff;">
                                            <i class="fas fa-home"></i> Back To Home
                                        </button>
                                    </a> 
                                </div>
                            </div>
                            <div class="form-box">

                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Sign up now</h3>
                                        <p id="logmsg">Fill in the form below to get instant access:</p>
                                    </div>
                                    <div class="form-top-right">
                                        <i class="fas fa-pencil-alt"></i>
                                    </div>
                                </div>

                                <div class="form-bottom" >
                                    <form action="/register" method="POST">
                                        {!! csrf_field() !!}
                                    <!--<form role="form" action="../index logged in.php" method="post" class="registration-form">-->

                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">First name</label>
                                        <input  type="text" name="username" placeholder="Username..." class="form-username form-control" id="username">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-email">Email</label>
                                        <input  type="email" name="email" placeholder="Email..." class="form-email form-control" id="email">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-about-yourself">About yourself</label>
                                        <textarea name="description" placeholder="About yourself..." class="form-about-yourself form-control" id="about-yourself"></textarea>
                                    </div>
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label class="sr-only" for="form-password">Last name</label>
                                        <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="password">
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-confirm-password">Last name</label>
                                        <input type="password" name="password_confirmation" placeholder="Confirm Password..." class="form-confirm-password form-control"
                                               id="confirm-password">
                                    </div>
                                    <a id="submitBtn" class="btn btn-lg center-block btn-primary" style="background:#007bff;">Register</a>
                                            <button id="submitform" type="submit" hidden="true"></button>
                                    </form>
                                    <!--  </form> -->
                                    <div class="login-link">
                                        <h3>
                                            <a href="./login">Login here </a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Javascript -->
        <script src="../assets/js/jquery-1.11.1.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.backstretch.min.js"></script>
        <script src="../assets/js/scripts.js"></script>

        <script>
            let btn = document.getElementById('submitBtn');
            if(btn!=null)
            {
                btn.onclick = function()
                {
                    //let username = document.getElementById('username').value;
                    //let email = document.getElementById('email').value;
                    let password = document.getElementById('password').value;
                    let passwrodConfirme = document.getElementById('confirm-password').value;
                    var regexPW = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)[a-zA-Z!$%^&*_@#~?\\d]{8,72}$");

                    if(username.length==0)
                    {
                        let message = "You Must Have A Username";
                        document.getElementById('logmsg').style.color = "red";
                        document.getElementById('logmsg').innerText = message;
                        return;
                    }
                   if(email.length==0)
                    {
                        let message = "You Must Have A Email";
                        document.getElementById('logmsg').style.color = "red";
                        document.getElementById('logmsg').innerText = message;
                        return;
                    }
                    if(!regexPW.test(password))
                    {
                        let message = "Your password must contain a minimum of 8 characters, at least 1 uppercase letter, 1 lowercase letter and 1 one number";
                        document.getElementById('logmsg').style.color = "red";
                        document.getElementById('logmsg').innerText = message;
                        return;
                    }
                    if(password!=passwrodConfirme)
                    {
                        let message = "Passwords do not match";
                        document.getElementById('logmsg').style.color = "red";
                        document.getElementById('logmsg').innerText = message;
                        return;
                    }

                    document.getElementById('submitform').click();
                }
            }
        </script>

    </body>

</html>