<!doctype html>
<html lang="en">
  <head>
    <title>Hello</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="public/css/employee.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <h1 class="content">Welcome Master DEV. season 2 ! </h1>
        <form class="form-login" action="/register.php" method="POST">
            <div id="Error" style="display: none"></div>
            <div id="Result" style="display: none"></div>
            <br>
            <div class="form-group">
                <label for="username">User Name</label>
                <input class="form-control" type="text" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password">

            </div>
            <div class="form-group">
                <label for="re_password">Re-Password</label>
                <input class="form-control" type="password" name="re_password" id="re_password">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input class="form-control" type="text" name="address" id="address">
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input class="form-control" type="text" name="phone" id="phone">
            </div>
            <div align="center" class="form-group" id="button">
                <button class="btn btn-success d-block" type="submit" id="submit">Login</button>
            </div>
            <div align="center" class="form-group">
                <div id="loading" style="display: none;"></div>
            </div>

        </form>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>

        function checkLength(name, str, len) {
            if(str.length > len)
                return true;
            else
                return name + " Must More Than " + len + " Characters";
        }

        function checkEmail(email) {
             if(/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email) == true)
                 return true;
             else
                 return "Wrong Format Of Email";
        }

        function checkCapital(str) {
            for(var i = 0; i < str.length; i++) {
                if(str.charCodeAt(i) >= 60 && str.charCodeAt(i) <= 90){
                    return true;
                }
            }
            return false;
        }

        function checkPassword(str1, str2) {
            var result = "";
            if(str1 !== str2)
                result += "Password And Re-Password Not Match. ";
            else if (str1.length <= 8) {
                result += "Password And Re-Password Must More Than 8 Character. ";
            } else if(checkCapital(str1) == false)
                result += "Password Must Have Less One Capital Character. "
            else
                return true
            return result;
        }

        function checkPhone(phone) {
            if(isNaN(phone))
                return "Wrong Format Of Phone Number";

            else if(phone.length == 11) {
                if(parseInt(phone / 1000000000) != 84)
                    return "Not Viet Nam's Phone Number";
                else
                    return true;
            }

            else if(phone.length == 10) {
                if(parseInt(phone / 1000000000) != 0)
                    return "Not Viet Nam's Phone Number";
                else
                    return true;
            } else {
                return "Wrong Format Of Phone Number";
            }

        }

        $("#submit").click(function (event) {
            event.preventDefault();

            var username = $("#username").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var re_password = $("#re_password").val();
            var address = $("#address").val();
            var phone = $("#phone").val();

            var errors = {};
            errors.username = checkLength("User Name",username, 3);
            errors.email = checkEmail(email);
            errors.password = checkPassword(password, re_password);
            errors.phone = checkPhone(phone);

            var print_error = "";
            for(element in errors) {
                if(errors[element] !== true) {
                    print_error += "<h3>" + errors[element] + "</h3><br>";
                }
            }

            if(print_error != "") {
                $("#Error").css("display", "block");
                $("#Result").css("display", "none");
                $("#Error").html(print_error);
            } else {
                $("#button").css("display", "none");
                $("#loading").css("display", "block");

                $.ajax({
                    url: "register.php",
                    type: "post",
                    data: {
                        username: username,
                        email: email,
                        password: password,
                        re_password: re_password,
                        address: address,
                        phone: phone
                    } ,
                    success: function (data) {
                        if(data == true) {
                            $("#Result").css("display", "block");
                            $("#Error").css("display", "none");
                            $("#Result").html("Register Successfully");
                        } else {
                            $("#Error").css("display", "block");
                            $("#Result").css("display", "none");
                            $("#Error").html(data);
                        }

                        $("#button").css("display", "block");
                        $("#loading").css("display", "none");
                    },
                    error: function() {
                        alert("ERROR While Submited");
                    }
                });
            }


        })
    </script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>