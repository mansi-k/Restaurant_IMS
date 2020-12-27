<?php

if(isset($_POST['btn_up_menu']))
{
    $id = $_POST['nipmid'];
    $mn = $_POST['m-name'];
    $md = $_POST['m-desc'];
    $vn = $_POST['vnradio'];
    $mp = $_POST['m-price'];
    $mc = $_POST['m-mcsel'];
    $mt = ($_POST['m-taste']=='0'?'':$_POST['m-taste']);
    $sp = $_POST['spradio'];
    $upmq = mysqli_query($bd,"UPDATE menu SET m_name='$mn', m_desc='$md', m_nveg='$vn', m_price='$mp', m_cat='$mc', m_taste='$mt' WHERE m_id='$id'");
    if($upmq)
    {
        if($sp == 'yes')
        {
            $sourcePath = $_FILES['btn_m_img']['tmp_name']; // Storing source path of the file in a variable
            if($sourcePath!='' || $sourcePath!=NULL)
            {
                $targetPath = "images/menu_pics/" . $_FILES['btn_m_img']['name']; // Target path where file is to be stored
                move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
                $imgn = $_FILES['btn_m_img']['name'];
                $chsmq = mysqli_query($bd, "SELECT * FROM menu_special WHERE ms_mid='$id'");
                if (mysqli_num_rows($chsmq) == 0)
                {
                    $upsmq = mysqli_query($bd, "INSERT INTO menu_special VALUES ('','$id','$imgn')");
                    if ($upsmq)
                    {
                        ?>
                        <script>
                            alert('Success');
                            window.location.href='adminmenu.php';
                        </script>
                        <?php
                    }
                }
                else
                {
                    $smr = mysqli_fetch_array($chsmq);
                    $smid = $smr['ms_id'];
                    $smg = $smr['ms_image'];
                    $insmq = mysqli_query($bd, "UPDATE menu_special SET ms_image='$imgn' WHERE ms_id='$smid'");
                    if ($insmq)
                    {
                        $imgp = 'images/menu_pics/'.$smg;
                        if(file_exists($imgp))
                            unlink($imgp);
                        ?>
                        <script>
                            alert('Success');
                            window.location.href='adminmenu.php';
                        </script>
                        <?php
                    }
                }
            }
            else
            {
                ?>
                <script>
                    alert('Success');
                    window.location.href='adminmenu.php';
                </script>
                <?php
            }
        }
        else
        {
            $smq1 = mysqli_query($bd,"SELECT * FROM menu_special WHERE ms_mid='$id'");
            if(mysqli_num_rows($smq1)>0)
            {
                $sma1 = mysqli_fetch_array($smq1);
                $smid = $sma1['ms_mid'];
                $smg = $sma1['ms_image'];
                $imgp = 'images/menu_pics/'.$smg;
                $rsmq = mysqli_query($bd,"DELETE FROM menu_special WHERE ms_mid='$id'");
                if(file_exists($imgp))
                    unlink($imgp);
            }
            ?>
            <script>
                alert('Success');
                window.location.href='adminmenu.php';
            </script>
            <?php
        }
    }
    else
    {
        ?>
        <script>
            alert('Fail <?php echo $md ?>');
        </script>
        <?php
    }
}
?>

<div id="menumodal" class="modal login form-modal">
    <div class="modal-content animate">
        <span onClick="document.getElementById('menumodal').style.display='none'" class="close" title="Close Modal">&times;</span>
        <div>
            <h3>Edit Menu ID : <span id="hmid"></span></h3><br>
            <form class="user-form" id="menu-edit-form" method="post" name="emenuform" enctype="multipart/form-data">
                <input type="text" id="ipmid" style="display:none" name="nipmid">
                <label>Menu Item Name</label><br>
                <input id="em-name" name="m-name" class="form-control" placeholder="Menu Name" type="text" required maxlength="80" onblur="replacesq(this)"><br><br>
                <label>Description</label><br>
                <textarea id="em-desc" name="m-desc" class="form-control" placeholder="Description" required maxlength="200" onblur="replacesq(this)"></textarea><br><br>
                <label>Veg/Non-veg</label>
                <label class="radio-inline"><input type="radio" name="vnradio" value="veg">Veg</label>
                <label class="radio-inline"><input type="radio" name="vnradio" value="non-veg">Non Veg</label><br><br>
                <label>Price</label><br>
                <input id="em-price" name="m-price" class="form-control" placeholder="Price" type="number" min="0" required><br><br>
                <label for="sel1">Menu Category</label><br>
                <select class="form-control" id="mcsel" name="m-mcsel"></select><br><br>
                <label>Taste</label><br>
                <select name="m-taste" id="em-taste" class="form-control">
                    <option value="0"></option>
                    <option value="spicy">Spicy</option>
                    <option value="extra-spicy">Extra Spicy</option>
                </select><br><br>
                <label>Special </label>
                <label class="radio-inline"><input type="radio" name="spradio" value="yes">Yes</label>
                <label class="radio-inline"><input type="radio" name="spradio" value="no">No</label><br><br>
                <label>Menu Item Image</label><br>
                <img src="" id="em-img">
                <input id="m-img-btn" type="file" name="btn_m_img" onchange="imgcheck(this)"><br>
                <span id="upimgmsg"></span><br><br>
                <center>
                    <button id="emp-btn" class="submit-btn" type="submit" name="btn_up_menu">Update</button>
                </center>
            </form>
        </div>
    </div>
</div>
<script>
    var modal = document.getElementById('menumodal');

    window.onclick = function(event) {
        if (event.target == modal) {
            $('#m-img-btn').val('');
            $('#m-img-btn').empty();
            $('input:radio[name=spradio][value=no]').prop('disabled',false);
            modal.style.display = "none";
        }
    };

    function imgcheck(obj) {
        $("#upimgmsg").empty();
        if(obj.value == '')
            return true;
        var file = obj.files[0];
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg"];
        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
        {
            $('#em-img').attr('src','');
            $('input:radio[name=spradio][value=no]').prop('disabled',false);
            $("#upimgmsg").html("Please select a valid image file. Only jpeg, jpg and png images type allowed.");
            $(obj).empty();
            return false;
        }
        else
        {
            $('input:radio[name=spradio][value=yes]').prop('checked',true);
            $('input:radio[name=spradio][value=no]').prop('disabled',true);
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(obj.files[0]);
            return true;
        }
    }

    function imageIsLoaded(e) {
        $('#em-img').attr('src', e.target.result);
    }

    /*
    $("#menu-edit-form").on('submit',(function(e) {
        e.preventDefault();
        var id = $('#hmid').text();
        $.ajax({
            url: "phpfunctions.php", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: {
                new FormData(this),
                'updatemid': id
            }, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(resp)   // A function to be called if request succeeds
            {
                alert(resp);
                $('#menumodal').css('display','none');
                $('#admeditmenu').load(document.URL +  ' #admeditmenu');
            }
        });
    }));


    function updatemenu()
    {
        var ema = {};
        ema['id'] = $('h3 #hmid').text();
        ema['mn'] = $('#em-name').val();
        ema['md'] = $('#em-desc').val();
        ema['vn'] = $('input[name=vnradio]').val();
        ema['mp'] = $('#em-price').val();
        ema['mc'] = $('#mcsel').val();
        ema['mt'] = $('#em-taste').val();
        ema['sp'] = $('input[name=spradio]').val();
        ema['mi'] = $('#m-img-btn').val();
        var jema = JSON.stringify(ema);
        $.ajax({
            type: 'POST',
            url: 'phpfunctions.php',
            data: {
                'jupmenu': jema
            },
            success: function(resp) {
                alert(resp);
                $('#menumodal').css('display','none');
                $('#admeditmenu').load(document.URL +  ' #admeditmenu');
            }
        });
    }
    */
</script>