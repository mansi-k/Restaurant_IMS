<?php
if(isset($_POST['btn_editp']))
{
    $uid = $_SESSION['user'];
    $fname = trim(strip_tags($_POST['e-fname']));
    $lname = trim(strip_tags($_POST['e-lname']));
    $email = trim(strip_tags($_POST['e-email']));
    $addr = trim(strip_tags($_POST['e-addr']));
    $town = trim(strip_tags($_POST['e-town']));
    $phno = trim(strip_tags($_POST['e-phno']));
    $updpro = mysqli_query($bd,"UPDATE users SET u_fname='$fname', u_lname='$lname', u_email='$email', u_phone='$phno', u_address='$addr', u_tid='$town' WHERE u_id='$uid'");
    if($updpro)
    {
        $_SESSION['fn'] = $fname;
        $_SESSION['ln'] = $lname;
        $_SESSION['em'] = $email;
        $_SESSION['ph'] = $phno;
        $_SESSION['addr'] = $addr;
        $_SESSION['town'] = $town;
        ?>
        <script>
            window.alert("Successfully Updated");
        </script>
        <?php
    }
    else
    {
        ?>
        <script>
            window.alert("Unsuccessful");
        </script>
        <?php
    }
}

if(isset($_POST['btn_editpw']))
{
    echo "inside echo";
    $uid = $_SESSION['user'];
    $psw1 = $_POST['ne-pswd'];
    $psw2 = $_POST['ner-pswd'];
    $opsw = $_POST['oe-pswd'];
    $res = mysqli_query($bd,"SELECT * FROM users WHERE u_id='$uid'");
    $resl = mysqli_fetch_array($res);
    $oldp = $resl['pswd'];
    if($oldp == md5($opsw))
    {
        $epswd = md5($psw1);
        $updpw = mysqli_query($bd,"UPDATE users SET pswd='$epswd' WHERE u_id='$uid'");
        if ($updpw)
        {?>
            <script>
                window.alert("Successfully Updated");
            </script>
            <?php
            session_destroy();
            unset($_SESSION['user']);
            header("Location: index.php");
        }
        else
        {
            ?>
            <script>
                window.alert("Unsuccessful");
            </script>
            <?php
        }
    }
    else
    {
        ?>
        <script>
            alert("Unsuccessful");
        </script>
        <?php
    }
}
?>
<div id="epmodal" class="modal login form-modal">
    <div class="modal-content animate">
        <span onClick="document.getElementById('epmodal').style.display='none'" class="close" title="Close Modal">&times;</span>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#editpro">Edit Profile</a></li>
            <li><a data-toggle="tab" href="#epass">Change Password</a></li>
        </ul>
        <div class="tab-content">
            <div id="editpro" class="tab-pane fade in active">
                <h3>Edit Profile</h3><br>
                <form class="user-form" id="editp-form" method="post" name="editpform">
                    <label>First Name</label><br>
                    <input id="ep-fn" name="e-fname" class="form-control" placeholder="First Name" type="text" required onkeyup="unValidate_e(this)" value="<?php echo $_SESSION['fn'] ?>" maxlength="15"><br><br>
                    <label>Last Name</label><br>
                    <input id="ep-ln" name="e-lname" class="form-control" placeholder="Last Name" type="text" required onkeyup="unValidate_e(this)" value="<?php echo $_SESSION['ln'] ?>" maxlength="15"><br><br>
                    <label>Email</label><br>
                    <input id="ep-em" name="e-email" class="form-control" placeholder="Email" type="email" onkeyup="ajaxcalltimer_e()" required value="<?php echo $_SESSION['em'] ?>" maxlength="50">
                    <span id="ems1"></span><br><br>
                    <label>Phone No</label><br>
                    <input id="ep-ph" name="e-phno" class="form-control" placeholder="Phone No" type="text" onkeyup="phoneValidate_e()" required value="<?php echo $_SESSION['ph'] ?>" maxlength="10"><br><br>
                    <label>Address</label><br>
                    <input id="ep-ad" name="e-addr" class="form-control" placeholder="Address" type="text" required value="<?php echo $_SESSION['addr'] ?>" maxlength="100"><br><br>
                    <label>Select Town</label><br>
                    <select id="ep-tw" name="e-town" class="form-control seltown"></select><br><br>
                    <center>
                        <button id="ep-btn" class="submit-btn" type="submit" name="btn_editp" onClick="return checkAll_e()">Submit</button>
                    </center>
                </form>
            </div>
            <div id="epass" class="tab-pane fade">
                <h3>Change Password</h3><br>
                <form class="user-form" id="editpw-form" method="post" name="editpwform">
                    <label>Old Password</label>
                    <img src="images/icons/phide.png" class="pswshow" onclick="pswdshow(this,'#op-pw1')"><br>
                    <input id="op-pw1" name="oe-pswd" class="form-control" placeholder="Old Password" type="password" required><br><br>
                    <label>New Password</label>
                    <img src="images/icons/phide.png" class="pswshow" onclick="pswdshow(this,'#ne-pw1')"><br>
                    <input id="ne-pw1" name="ne-pswd" class="form-control" placeholder="New Password" type="password" onkeyup="passValidate_e()" required  maxlength="15"><br><br>
                    <label>Re-enter Password</label>
                    <img src="images/icons/phide.png" class="pswshow" onclick="pswdshow(this,'#ner-pw2')"><br>
                    <input id="ner-pw2" name="ner-pswd" class="form-control" placeholder="Re-enter Password" type="password" onkeyup="passMatch_e()" required  maxlength="15"><br><br>
                    <center>
                        <button id="epw-btn" class="submit-btn" type="submit" name="btn_editpw" onClick="return checkAll_epw()">Submit</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var cme;
    var eflag=true;
    var ajaxtimer = null;

    function unValidate_e(un)
    {
        var unval = un.value;
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

    function checkemail_e()
    {
        var em = document.getElementById( "ep-em" );
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
                        $("#ep-em").attr('class', 'form-control');
                        $( '#ems1' ).html(response);
                        cm=true;
                        eflag=true;
                        return true;
                    }
                    else if(response!="OK" && pattern.test(email))
                    {
                        $("#ep-em").attr('class', 'form-control invalid');
                        $( '#ems1' ).html('This email already exists!');
                        cm=false;
                        eflag=true;
                        return false;
                    }
                    else
                    {
                        $("#ep-em").attr('class', 'form-control invalid');
                        $( '#ems1' ).html('Incorrect email format!');
                        cm=false;
                        eflag=false;
                        return false;
                    }
                }

            });
        }
        else
        {
            $("#ep-em").attr('class', 'form-control invalid');
            $( '#ems1' ).html('');
            cm=false;
            return false;
        }
    }

    function ajaxcalltimer_e()
    {
        if (ajaxtimer != null)
            clearTimeout(ajaxtimer);
        ajaxtimer = setTimeout(checkemail_e, 1000);

    }

    function passValidate_e()
    {
        var fpsw = document.getElementById("ne-pw1");
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

    function passMatch_e()
    {
        var ps1 = document.getElementById("ne-pw1");
        var ps2 = document.getElementById("ner-pw2");
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

    function phoneValidate_e()
    {
        var ph = document.getElementById("ep-ph");
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

    function checkAll_e()
    {
        checkemail_e();
        if(phoneValidate_e() && eflag)
        {
            document.editpform.submit();
            return true;
        }
        else
        {
            alert("Details not valid!");
            return false;
        }
    }

    function checkAll_epw()
    {
        if(passValidate_e() && passMatch_e())
        {
            document.editpwform.submit();
            return true;
        }
        else
        {
            alert("Details not valid!");
            return false;
        }
    }

    var modal = document.getElementById('epmodal');

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

</script>