<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login frontend</title>
</head>
<body>
<p>Login page test. It makes a call to the login endpoint (login.php).</p>
<p>
    <input type="text" placeholder="username" id="username">
    <input type="text" placeholder="email" id="email">
    <input type="text" placeholder="password" id="password">

    <button onclick="customregister()">Login</button>
</p>


<script>
    function customregister() {
        let username = document.getElementById("username").value;
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;

        const formData = new FormData();
        formData.append('username', username);
        formData.append('email', email);
        formData.append('password', password);

        fetch('/api/register', {
            method: 'POST',
            body: formData,
            headers : {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
            .then(response => response.json())
         .then(data => {
                console.log(data);
  /*              if(data.login == true) {
                    window.location.href = "/employee/test/ldap/home.php";
                } else {
                    alert(data.error);
                } */
            });

    }
</script>
</body>
</html>
