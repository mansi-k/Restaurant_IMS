<?php
if((isset($_POST['btn_login'])))
{
    $login_id = $_POST['l-email'];
    $password = $_POST['l-pswd'];
    $epsw = md5($password);
    $res=mysqli_query($bd,"SELECT * FROM users WHERE u_email='$login_id' and u_pswd='$epsw'");
    $row=mysqli_fetch_array($res);
    $p = $row['u_pswd'];
    if($row['u_pswd'] == $epsw )
    {
        $_SESSION['user'] = $row['u_id'];
        $_SESSION['fn'] = $row['u_fname'];
        $_SESSION['ln'] = $row['u_lname'];
        $_SESSION['em'] = $row['u_email'];
        $_SESSION['ph'] = $row['u_phone'];
        $_SESSION['addr'] = $row['u_address'];
        $_SESSION['town'] = $row['u_tid'];
        header("Location: mycart.php");
    }
    else
    {?>
        <script>
            window.alert("Unsuccessful");
            window.location.href="index.php";
        </script>
        <?php
    }
}
if((isset($_POST['btn_signup'])))
{
    $fname = trim(strip_tags($_POST['s-fname']));
    $lname = trim(strip_tags($_POST['s-lname']));
    $email = trim(strip_tags($_POST['s-email']));
    $psw1 = $_POST['s-pswd'];
    $psw2 = $_POST['sr-pswd'];
    $addr = trim(strip_tags($_POST['s-addr']));
    $town = trim(strip_tags($_POST['s-town']));
    $phno = trim(strip_tags($_POST['s-phno']));
    if($psw1 == $psw2)
    {
        $epswd = md5($psw1);
        $insu = mysqli_query($bd,"INSERT INTO users 
  VALUES ('', '$fname', '$lname', '$email', '$epswd', '$phno', '$addr','$town')");
        if($insu)
        {?>
            <script>
                alert("Successfully Signed In");
                window.location.href='index.php';
            </script>
            <?php
        }
        else
        {?>
            <script>alert("Unsuccessful")</script>
            <?php
        }
    }
}
?>
<div id="lsmodal" class="modal login form-modal">
    <div class="modal-content animate">
        <span onClick="document.getElementById('lsmodal').style.display='none'" class="close" title="Close Modal">&times;</span>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#login">Login</a></li>
            <li><a data-toggle="tab" href="#sign-up">Sign Up</a></li>
        </ul>
        <div class="tab-content">
            <div id="login" class="tab-pane fade in active">
                <h3>Login</h3><br>
                <form class="user-form" id="login-form" method="post">
                    <label>Email ID</label><br>
                    <input name="l-email" class="form-control" placeholder="Email ID" type="email"><br><br>
                    <label>Password</label>
                    <img src="images/icons/phide.png" class="pswshow" onclick="pswdshow(this,'#logpw')"><br>
                    <input id="logpw" name="l-pswd" class="form-control" placeholder="Password" type="password"><br><br>
                    <center>
                        <button type="submit" class="submit-btn" name="btn_login">Login</button>
                    </center>
                </form>
            </div>
            <div id="sign-up" class="tab-pane fade">
                <h3>Sign Up</h3><br>
                <form class="user-form" id="sign-up-form" method="post" name="regform">
                    <label>First Name</label><br>
                    <input id="si-fn" name="s-fname" class="form-control" placeholder="First Name" type="text" required onkeyup="unValidate(this)" maxlength="15"><br><br>
                    <label>Last Name</label><br>
                    <input id="si-ln" name="s-lname" class="form-control" placeholder="Last Name" type="text" required onkeyup="unValidate(this)" maxlength="15" ><br><br>
                    <label>Email</label><br>
                    <input id="si-em" name="s-email" class="form-control" placeholder="Email" type="email" onkeyup="ajaxcalltimer()" required maxlength="50">
                    <span id="ems"></span><br><br>
                    <label>Phone No</label><br>
                    <input id="si-ph" name="s-phno" class="form-control" placeholder="Phone No" type="text" onkeyup="phoneValidate()" required maxlength="10"><br><br>
                    <label>Address</label><br>
                    <input id="si-ad" name="s-addr" class="form-control" placeholder="Address" type="text" required maxlength="100"><br><br>
                    <label>Select Town</label><br>
                    <select id="si-tw" name="s-town" class="form-control seltown"></select><br><br>
                    <label>Password</label>
                    <img src="images/icons/phide.png" class="pswshow" onclick="pswdshow(this,'#si-pw1')"><br>
                    <input id="si-pw1" name="s-pswd" class="form-control" placeholder="Password" type="password" onkeyup="passValidate()" required maxlength="15"><br><br>
                    <label>Re-enter Password</label>
                    <img src="images/icons/phide.png" class="pswshow" onclick="pswdshow(this,'#si-pw2')"><br>
                    <input id="si-pw2" name="sr-pswd" class="form-control" placeholder="Re-enter Password" type="password" onkeyup="passMatch()" required maxlength="15"><br><br>
                    <center>
                        <button id="si-btn" class="submit-btn" type="submit" name="btn_signup" onClick="return checkAll()">Sign Up</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var mod = document.getElementById('lsmodal');

    window.onclick = function(event) {
        if (event.target == mod) {
            mod.style.display = "none";
        }
    };

    var cm;
    var ajaxCallTimeoutID = null;

    function unValidate(un)
    {
        var unval = un.value;
        console.log(unval);
        if(/^[a-z''A-Z]+$/.test(unval) && unval.indexOf(" ")!=unval.length-1 && unval.indexOf(" ")!=0 && unval.length>1)
        {
            un.className="form-control";
            return true;
        }
        else
        {
            un.className="form-control invalid";
            return false;
        }
    }

    function checkemail()
    {
        var em = document.getElementById( "si-em" );
        var email = em.value;
        if(email!='')
        {
            $.ajax({
                type: 'POST',
                url: 'phpfunctions.php',
                data: {
                    'user_email':email
                },
                success: function(response) {
                    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
                    if(response=="OK" && pattern.test(email))
                    {
                        $("#si-em").attr('class', 'form-control');
                        $( '#ems' ).html(response);
                        cm=true;
                        return true;
                    }
                    else if(response!="OK" && pattern.test(email))
                    {
                        $("#si-em").attr('class', 'form-control invalid');
                        $( '#ems' ).html('This email already exists!');
                        cm=false;
                        return false;
                    }
                    else
                    {
                        $("#si-em").attr('class', 'form-control invalid');
                        $( '#ems' ).html('Incorrect email format!');
                        cm=false;
                        return false;
                    }
                }

            });
        }
        else
        {
            $("#si-em").attr('class', 'form-control invalid');
            $( '#ems' ).html('');
            cm=false;
            return false;
        }
    }

    function ajaxcalltimer()
    {
        if (ajaxCallTimeoutID != null)
            clearTimeout(ajaxCallTimeoutID);
        ajaxCallTimeoutID = setTimeout(checkemail, 1000);

    }

    function passValidate()
    {
        var fpsw = document.getElementById("si-pw1");
        var fpswval = fpsw.value;
        if(fpswval.length<8)
        {
            fpsw.className="form-control invalid";
            //document.getElementById("demo").innerHTML = "Hello JavaScript";
            return false;
        }
        else
        {
            fpsw.className="form-control";
            //document.getElementById("demo").innerHTML = "";
            return true;
        }
    }

    function passMatch()
    {
        var ps1 = document.getElementById("si-pw1");
        var ps2 = document.getElementById("si-pw2");
        var ps2val = ps2.value;
        if(ps1.value!=ps2val || ps2val.length<8)
        {
            ps2.className="form-control invalid";
            return false;
        }
        else
        {
            ps2.className="form-control";
            return true;
        }
    }

    function phoneValidate()
    {
        var ph = document.getElementById("si-ph");
        var phval = ph.value;
        if(phval.length==10 && (/^\d{10}$/.test(phval)))
        {
            ph.className="form-control";
            return true;
        }
        else
        {
            ph.className="form-control invalid";
            return false;
        }
    }

    function checkAll()
    {
        if(passValidate() && passMatch() && phoneValidate() && cm)
        {
            document.regform.submit();
            return true;
        }
        else
        {
            alert("Details not valid!");
            return false;
        }

    }

</script>