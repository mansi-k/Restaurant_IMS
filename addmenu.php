<?php

if(isset($_POST['btn_mca']))
{
    $mcn = $_POST['c-name'];
    $mciq = mysqli_query($bd,"INSERT INTO menu_category VALUES('','$mcn')");
    if($mciq)
    {?>
        <script>
            alert("New Category Added");
            window.location.href = "adminmenu.php";
        </script>
    <?php
    }
    else
    {?>
        <script>
            alert("Failed");
        </script>
    <?php
    }
}

if(isset($_POST['btn_emca']))
{
    $emc1 = $_POST['emc-cat'];
    $emc2 = $_POST['ec-name'];
    $mciq = mysqli_query($bd,"UPDATE menu_category SET mc_name='$emc2' WHERE mc_id='$emc1'");
    if($mciq)
    {?>
        <script>
            alert("Category Edited");
            window.location.href = "adminmenu.php";
        </script>
        <?php
    }
    else
    {?>
        <script>
            alert("Failed");
        </script>
        <?php
    }
}

if(isset($_POST['btn_add_menu']))
{
    $mn = $_POST['me-name'];
    $md = $_POST['me-desc'];
    $mvn = $_POST['vnr'];
    $mp = $_POST['me-price'];
    $mc = $_POST['am-cat'];
    $msp = $_POST['spr'];
    $mt = $_POST['me-taste'];
    $maq = mysqli_query($bd,"INSERT INTO menu VALUES('','$mn','$md','$mvn','$mp','$mc','$mt')");
    if($maq)
    {
        if($msp=='yes')
        {
            $sourcePath = $_FILES['me_img']['tmp_name'];
            if($sourcePath!='' || $sourcePath!=NULL)
            {
                $targetPath = "images/menu_pics/" . $_FILES['me_img']['name']; // Target path where file is to be stored
                move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
                $imgn = $_FILES['me_img']['name'];
                $miq = mysqli_query($bd,"SELECT m_id FROM menu WHERE m_name='$mn' AND m_price='$mp'");
                $mir = mysqli_fetch_array($miq);
                $mia = $mir['m_id'];
                $msq = mysqli_query($bd, "INSERT INTO menu_special VALUES('','$mia','$imgn')");
                if($msq)
                {
                    ?>
                    <script>
                        alert('Success');
                        window.location.href='adminmenu.php';
                    </script>
                    <?php
                }
                else
                {
                    ?>
                    <script>
                        alert('Failed');
                        window.location.href='adminmenu.php';
                    </script>
                    <?php
                }
            }
            else
            {
                $miq = mysqli_query($bd,"SELECT m_id FROM menu WHERE m_name='$mn' AND m_price='$mp'");
                $mir = mysqli_fetch_array($miq);
                $mia = $mir['m_id'];
                $msq = mysqli_query($bd, "INSERT INTO menu_special VALUES('','$mia','')");
                if($msq)
                {
                    ?>
                    <script>
                        alert('Success');
                        window.location.href='adminmenu.php';
                    </script>
                    <?php
                }
                else
                {
                    ?>
                    <script>
                        alert('Failed');
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
        ?>
        <script>
            alert('Failed');
            window.location.href='adminmenu.php';
        </script>
        <?php
    }
}
?>

<ul class="nav nav-tabs nav-justified">
    <li class="active"><a data-toggle="tab" href="#atmenuitem">Menu Item</a></li>
    <li><a data-toggle="tab" href="#atmenucat">Menu Category</a></li>
</ul>
<div id="addmcforms" class="tab-content">
    <div id="atmenucat" class="tab-pane fade adminpane">
        <div class="formborder">
            <h3>Edit Menu Category</h3><br>
            <form class="user-form" id="menucatedit" method="post" name="editmcat">
                <label>Choose Menu Category</label>
                <select class="form-control" id="emcsel" name="emc-cat" required>
                    <?php
                    $mcq = mysqli_query($bd,"SELECT * FROM menu_category ORDER BY mc_id ASC");
                    while($mcr = mysqli_fetch_array($mcq))
                    {?>
                        <option value="<?php echo $mcr['mc_id'] ?>"><?php echo ucwords($mcr['mc_name']) ?></option>
                        <?php
                    }
                    ?>
                </select><br><br>
                <label>Menu Category Rename</label><br>
                <input id="emc-name" name="ec-name" class="form-control" placeholder="Category Name" type="text" required maxlength="25" onblur="replacesq(this)"><br><br>
                <center>
                    <button id="emc-btn" class="submit-btn" type="submit" name="btn_emca">Add New Category</button><br><br>
                </center>
            </form>
        </div><br><br>
        <div class="formborder">
            <h3>Add Menu Category</h3><br>
            <form class="user-form" id="menucatadd" method="post" name="addmcat">
                <label>Menu Category Name</label><br>
                <input id="mc-name" name="c-name" class="form-control" placeholder="Category Name" type="text" required maxlength="25" onblur="replacesq(this)"><br><br>
                <center>
                    <button id="mc-btn" class="submit-btn" type="submit" name="btn_mca">Add New Category</button><br><br>
                </center>
            </form>
        </div><br><br>
    </div>
    <div id="atmenuitem" class="tab-pane fade in active adminpane">
        <div class="formborder">
            <h3>Add Menu<span id="hmid"></span></h3><br>
            <form class="user-form" id="menu-add-form" method="post" name="addmenu" enctype="multipart/form-data">
                <label>Menu Item Name</label><br>
                <input id="am-name" name="me-name" class="form-control" placeholder="Menu Name" type="text" required maxlength="80" onblur="replacesq(this)"><br><br>
                <label>Description</label><br>
                <textarea id="am-desc" name="me-desc" class="form-control" placeholder="Description" maxlength="200" onblur="replacesq(this)"></textarea><br><br>
                <label>Veg/Non-veg</label>
                <label class="radio-inline"><input type="radio" name="vnr" value="veg" checked required>Veg</label>
                <label class="radio-inline"><input type="radio" name="vnr" value="non-veg">Non Veg</label><br><br>
                <label>Price</label><br>
                <input id="am-price" name="me-price" class="form-control" placeholder="Price" type="number" min="0" required><br><br>
                <label for="sel1">Menu Category</label><br>
                <select class="form-control" id="amsel" name="am-cat" required>
                <?php
                $mcq = mysqli_query($bd,"SELECT * FROM menu_category ORDER BY mc_id ASC");
                while($mcr = mysqli_fetch_array($mcq))
                {?>
                    <option value="<?php echo $mcr['mc_id'] ?>"><?php echo ucwords($mcr['mc_name']) ?></option>
                <?php
                }
                ?>
                </select><br><br>
                <label>Taste</label><br>
                <select name="me-taste" id="am-taste" class="form-control">
                    <option value=""></option>
                    <option value="spicy">Spicy</option>
                    <option value="extra-spicy">Extra Spicy</option>
                </select><br><br>
                <label>Special </label>
                <label class="radio-inline"><input type="radio" name="spr" value="yes" required>Yes</label>
                <label class="radio-inline"><input type="radio" name="spr" value="no" checked>No</label><br><br>
                <label>Menu Item Image</label><br>
                <img src="" id="aimgdisp"><br>
                <input id="me-img-btn" type="file" name="me_img" onchange="aimgcheck(this)"><br>
                <span id="aimgmsg"></span><br><br>
                <center>
                    <button id="amd-btn" class="submit-btn" type="submit" name="btn_add_menu">Add New Menu</button><br><br>
                </center>
            </form>
        </div>
    </div>
</div>

<script>
function aimgcheck(obj) {
    $("#aimgmsg").empty();
    var file = obj.files[0];
    var imagefile = file.type;
    var match= ["image/jpeg","image/png","image/jpg"];
    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
    {
        $('#aimgdisp').attr('src','');
        $('input:radio[name=spr][value=no]').prop('disabled',false);
        $("#aimgmsg").html("Please select a valid image file. Only jpeg, jpg and png images type allowed.");
        $(obj).empty();
        return false;
    }
    else
    {
        $('input:radio[name=spr][value=yes]').prop('checked',true);
        $('input:radio[name=spr][value=no]').prop('disabled',true);
        var reader = new FileReader();
        reader.onload = aimageIsLoaded;
        reader.readAsDataURL(obj.files[0]);
        return true;
    }
}

function aimageIsLoaded(e) {
    $('#aimgdisp').attr('src', e.target.result);
}

</script>