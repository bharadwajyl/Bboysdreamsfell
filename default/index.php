<?php $titles = array("" => ""); ?>


<?php $countries = array(""); ?>

<!--Fill the arrays once the page loads-->
<?php
$files = array();
$titles_var = array();
$insert = array();
foreach(scandir("./../") as $file){
    if(pathinfo($file, PATHINFO_EXTENSION) == "php" && $file != "UnaccessCode-381.php"){
        array_push($files, $file);
    }
}
foreach ($titles as $var => $val){ array_push($titles_var, $var); }
foreach ($files as $var){ if (!in_array($var, $titles_var)){ array_push($insert, $var); } }
if (!empty($insert)){
    $temp .= '<?php $titles = array("" => ""';
    foreach ($insert as $var){ $temp .= ',"'.$var.'" => ""'; }
    foreach ($titles as $var => $val){ $temp .= ', "'.$var.'" => "'.$val.'"'; }
    $temp .= '); ?>';
    $fil = "./index.php";
    $lines = file($fil);
    $lines[0] = $temp. "\r\n";
    file_put_contents($fil, $lines);
    $temp = "";
}

//Enable & Disable pages
if (isset($_POST["e_d"])){
    if (isset($_POST["files"])){
        switch ($_POST["operation"]){
            case 0:
            foreach ($_POST["files"] as $file){
                if ((strpos(file_get_contents("./../$file"), "require('assets/disable.php');") == true)){
                    $temp .= str_replace("<?php require('assets/disable.php'); ?>\r\n", "", file_get_contents("./../$file"));
                    $ofile = fopen("./../$file", "w");
                    file_put_contents("./../$file", $temp);
                    fclose($ofile);
                    $temp = "";
                }
            } 
            break;
            case 1:
            foreach ($_POST["files"] as $file){
                if ((strpos(file_get_contents("./../$file"), "require('assets/disable.php');") == false)){  
                    $temp .= '<?php error_reporting(0); $ip=$_SERVER["REMOTE_ADDR"];  date_default_timezone_set("Asia/Kolkata"); $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip)); $country=$ipdat->geoplugin_countryName; if($country == "Cyprus" || $ip == "127.0.0.1"'; 
                    $fil = "./index.php";
                    $lines = file($fil);
                    $c .= '<?php $countries = array(""';
                    foreach($_POST["country"] as $cnt){
                        $temp .= ' || $country=="'.$cnt.'"';
                        $c .= ', "'.$cnt.'"';
                    }
                    $c .= '); ?>';
                    $lines[3] = $c. "\r\n";
                    file_put_contents($fil, $lines);
                    $c = "";
                    $temp .= '){';
                    $temp .= 'require("UnaccessCode-381.php"); $file = fopen("log.txt","a"); fwrite($file, "***********\r\n '.$titles[$file].' Not allowed \r\n"); fwrite($file, $country); fwrite($file, "\r\n $ip \r\n *************\r\n"); fclose($file); die(\'<h6 class="w3-center w3-animate-zoom">error code:403 forbidden</h6>\'); } $file = fopen("log.txt","a"); fwrite($file, "***********\r\n '.$titles[$file].' Allowed \r\n"); fwrite($file, $country); fwrite($file, "\r\n $ip \r\n *************\r\n"); fclose($file); ?>';
                    $ofile = fopen("./../assets/disable.php", "w");
                    file_put_contents("./../assets/disable.php", $temp);
                    $temp = "";
                    $temp .= "<?php require('assets/disable.php'); ?>\r\n";
                    $temp .= file_get_contents("./../$file");
                    file_put_contents("./../$file", $temp);
                    fclose($ofile);
                    $temp = "";
                } else {
                    $temp .= '<?php error_reporting(0); $ip=$_SERVER["REMOTE_ADDR"]; date_default_timezone_set("Asia/Kolkata"); $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip)); $country=$ipdat->geoplugin_countryName; if($country == "Cyprus" || $ip == "127.0.0.1"';
                    $fil = "./index.php";
                    $lines = file($fil);
                    $c .= '<?php $countries = array(""';
                    foreach($_POST["country"] as $cnt){
                        $temp .= ' || $country=="'.$cnt.'"';
                        $c .= ', "'.$cnt.'"';
                    }
                    $c .= '); ?>';
                    $lines[3] = $c. "\r\n";
                    file_put_contents($fil, $lines);
                    $c = "";
                    $temp .= '){';
                    $temp .= 'require("UnaccessCode-381.php"); $file = fopen("log.txt","a"); fwrite($file, "***********\r\n '.$titles[$file].' Not allowed \r\n"); fwrite($file, $country); fwrite($file, "\r\n $ip \r\n *************\r\n"); fclose($file); die(\'<h6 class="w3-center w3-animate-zoom">error code:403 forbidden</h6>\'); } $file = fopen("log.txt","a"); fwrite($file, "***********\r\n '.$titles[$file].' Allowed \r\n"); fwrite($file, $country); fwrite($file, "\r\n $ip \r\n *************\r\n"); fclose($file); ?>';
                    $ofile = fopen("./../assets/disable.php", "w");
                    file_put_contents("./../assets/disable.php", $temp);
                    fclose($ofile);
                    $temp = "";
                }
            }
            break;
        }
    }
}

//Include header & footer
$path = array();
if (isset($_POST["head_foot"])){
    switch($_POST["operation"]){
        case 0:
            //Selected files
            foreach ($_POST["files"] as $file){
                unlink("./../$file");
            }
            foreach(scandir("./../") as $file){
                if(empty(pathinfo($file, PATHINFO_EXTENSION) == "php" && $file != "UnaccessCode-381.php")){
                    $fil = "./index.php";
                    $lines = file($fil);
                    $c .= '<?php $countries = array(""';
                    $c .= '); ?>';
                    $lines[3] = $c. "\r\n";
                    file_put_contents($fil, $lines);
                    $c = "";
                    $fil = "./index.php";
                    $lines = file($fil);
                    $lines[0] = '<?php $titles = array ("" => ""); ?>'. "\r\n";
                    file_put_contents($fil, $lines);
                    $lines[0] = "";
                    $fil = "./../assets/header.php";
                    $lines = file($fil);
                    $lines[0] = '<?php $titles = array ("" => ""); ?>'. "\r\n";
                    file_put_contents($fil, $lines);
                }
            }
            header("refresh: 1");
        break;
        case 1:
        //Selected files
        foreach ($_POST["files"] as $file){
            array_push($path, $file);
            if((strpos(file_get_contents("./../$file"), "require('assets/header.php')") == false) && (strpos(file_get_contents("./../$file"), "require('assets/footer.php')") == false)) {
                $temp .= "<?php require('assets/header.php'); ?>\r\n";
                $temp .= file_get_contents("./../$file");
                $temp .= "<?php require('assets/footer.php'); ?>\r\n";
                $ofile = fopen("./../$file", "w");
                file_put_contents("./../$file", $temp);
                fclose($ofile);
                $temp = "";
            }
        }
        
        foreach ($files as $ext){
            if ((!in_array($ext, $path)) && ((strpos(file_get_contents("./../$ext"), "require('assets/header.php')") == true) && (strpos(file_get_contents("./../$ext"), "require('assets/footer.php')") == true))){
                $temp .= str_replace("<?php require('assets/header.php'); ?>\r\n", "", file_get_contents("./../$ext"));
                $temp = str_replace("<?php require('assets/footer.php'); ?>\r\n", "", $temp);
                $ofile = fopen("./../$ext", "w");
                file_put_contents("./../$ext", $temp);
                fclose($ofile);
                $temp = "";
            }
        }
        break;
        default:
        break;
    }
}


//Set page titles
if (isset($_POST["page_title"])){
    $count = 0;
    $array .= '$titles = array("" => ""';
    foreach ($_POST["title"] as $title){
        $array .= ', "'.$files[$count].'"=>"'.$title.'"';
        $count++;
    }
    $array .= ');';
    $file = "./../assets/header.php";
    $lines = file($file);
    $temp = "<?php $array ?>";
    strpos(file_get_contents("./../assets/header.php"), '$titles') == false ?
        $lines[0] = $temp."\r\n".$lines[0] :
        $lines[0] = $temp."\r\n";
    file_put_contents($file, $lines);
    $temp = "";
    $file = "./index.php";
    $lines = file($file);
    $temp = "<?php $array ?>";
    $lines[0] = $temp."\r\n";
    file_put_contents($file, $lines);
    $temp = "";
}
?>

<!DOCTYPE html>
<html>
<head>
<!--TITLE-->
<title>Files management</title>
<style>
*, *:after, *:before {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

:root{
    --dark:#615530;
    --gray:rgba(1,1,1,0.7);
    --lite:rgba(255,255,255,0.7);
    --primary:#f7f5ca;
    --primary_dark:#e6cb9f;
}

@font-face {
    font-family: kanit_regular;
    src: url("font/Kanit-Regular.ttf");
}

@font-face {
    font-family: kanit_light;
    src: url("font/Kanit-Light.ttf");
}

body{
    margin:0;
    overflow-x:hidden !important;
    font-family:kanit_Light;
}

a, input, label, .btn{
    text-decoration:none !important;
    min-width: fit-content;
    width: fit-content;
    width: -webkit-fit-content;
    width: -moz-fit-content;
    outline:none !important;
}

.flex, .fixed_flex{
    display:flex;
}

.title, .sub_title{
    color:var(--dark);
    font-family:kanit_regular;
}

.sub_title{
    color:rgba(1,1,1,0.6);
}

.btn{
    padding:0.5rem;
    background-color:var(--primary_dark);
    border:2px solid var(--primary_dark);
    color:var(--gray);
    border-radius:5px;
}

.btn_1:active{
    box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;
}

section{
    padding:1rem;
}

section form{
    padding:1rem;  
    background-color:#f1f1f1;
    margin-bottom:1rem;
}

form label{
    align-items:center;
    position:relative;
    color:var(--gray);
}

form label input[type=checkbox]{
    margin-right:5px;
}

form aside{
    align-items:center;
    justify-content:right;
}

aside select{
    padding:0.5rem;
    border-radius:5px 0px 0px 5px;
    background-color:var(--primary);
    border:2px solid var(--primary_dark);
    color:#615530;
    border-right:0px;
}

aside .btn{
    display:block;
    border-radius:0px 5px 5px 0px;
    border-left:0px;
}

.alert{
    background-color:#f14343;
    color:var(--lite);
    border-radius:5px;
    width:100%;
    padding:0.5rem 1rem;
    margin-bottom:0.5rem;
}

ul{
    padding:0;
    margin:0;
}

li{
    list-style:none;
    position:relative;
    margin:1rem 0;
}

li input{
    padding:1rem;
    border:1px solid var(--gray);
    border-radius:5px;
    background-color:#f1f1f1;
    color:var(--gray);
}

li input:focus{
    color:var(--black);
}

li label{
    position:absolute;
    background-color:#f1f1f1;
    padding:0.1rem 0.3rem;
    z-index:1;
    font-size:13px;
    left:1rem;
    top:-0.8rem;
}

</style>
</head>
<body>
<section>
    
    <div class="alert">
        <p><b>Note:</b> Refresh the page twice or thrice to reflect the changes made previously. Donot perform another operation without refreshing the page once the operation is performed.</p>
    </div>

    <form method="POST">
        <h4 class="sub_title">1) Enable or disable page access</h4>
        <?php
        foreach($files as $file){
            if(strpos(file_get_contents("./../$file"), "require('assets/disable.php')") == true) {
                echo '
                    <label class="fixed_flex"><input type="checkbox" name="files[]" value="'.$file.'" checked="true" /> '.$file.'</label>
                ';
            } else {
                echo '
                    <label class="fixed_flex"><input type="checkbox" name="files[]" value="'.$file.'" /> '.$file.'</label>
                ';
            }
        }
        ?>
        <h5 class="sub_title">Countries</h5>
        <article class="fixed_flex">
            <label class="fixed_flex"><input type="checkbox" name="country[]" value="India" <?php if(in_array("India", $countries)) {print("checked");} ?> /> India</label>
            <label class="fixed_flex"><input type="checkbox" name="country[]" value="Pakistan" <?php if(in_array("Pakistan", $countries)) {print("checked");} ?> /> Pakistan</label>
            <label class="fixed_flex"><input type="checkbox" name="country[]" value="Bangladesh" <?php if(in_array("Bangladesh", $countries)) {print("checked");} ?> /> Bangladesh</label>
            <label class="fixed_flex"><input type="checkbox" name="country[]" value="Egypt" <?php if(in_array("Egypt", $countries)) {print("checked");} ?> /> Egypt</label>
            <label class="fixed_flex"><input type="checkbox" name="country[]" value="SriLanka" <?php if(in_array("SriLanka", $countries)) {print("checked");} ?> /> SriLanka</label>
            <label class="fixed_flex"><input type="checkbox" name="country[]" value="Philippines" <?php if(in_array("Philippines", $countries)) {print("checked");} ?> /> Philippines</label>
            <label class="fixed_flex"><input type="checkbox" name="country[]" value="Ireland" <?php if(in_array("Ireland", $countries)) {print("checked");} ?> /> Ireland</label>
            <label class="fixed_flex"><input type="checkbox" name="country[]" value="Mayanmar" <?php if(in_array("Mayanmar", $countries)) {print("checked");} ?> /> Mayanmar</label>
            <label class="fixed_flex"><input type="checkbox" name="country[]" value="Mexico" <?php if(in_array("Mexico", $countries)) {print("checked");} ?> /> Mexico</label>
            <label class="fixed_flex"><input type="checkbox" name="country[]" value="Nigeria" <?php if(in_array("Nigeria", $countries)) {print("checked");} ?> /> Nigeria</label>
            <label class="fixed_flex"><input type="checkbox" name="country[]" value="Indonesia" <?php if(in_array("Indonesia", $countries)) {print("checked");} ?> /> Indonesia</label>
            <label class="fixed_flex"><input type="checkbox" name="country[]" value="Serbia" <?php if(in_array("Serbia", $countries)) {print("checked");} ?> /> Serbia</label>
            <label class="fixed_flex"><input type="checkbox" name="country[]" value="Peru" <?php if(in_array("Peru", $countries)) {print("checked");} ?> /> Peru</label>
        </article>
        <aside class="flex">
            <select name="operation">
                <option value="0">Enable</option>
                <option value="1" selected>Disable</option>
            </select>
            <button class="btn btn_1" type="submit" name="e_d">Submit</button>
        </aside>
    </form>
    
    <form method="POST"> 
        <h4 class="sub_title">2) Set page titles</h4>
        <ul>
        <?php
        foreach($files as $file){
            echo '

                 <li>
                    <label>'.$file.'</label>

                    <input type="text" name="title[]" value="'.$titles[$file].'" maxlength="100" />

                </li>
            ';
        }
        ?>
        </ul>
        <aside class="flex">
            <select name="operation">
                <option value="1" selected>Modify</option>
            </select>
            <button class="btn btn_1" type="submit" name="page_title">Submit</button>
        </aside>
    </form>
    
    <form method="POST"> 
        <h4 class="sub_title">3) Add or remove header & footer</h4>
        <?php
        foreach($files as $file){
            if(strpos(file_get_contents("./../$file"), "require('assets/header.php')") == true) {
                echo '
                    <label class="fixed_flex"><input type="checkbox" name="files[]" value="'.$file.'" checked="true" /> '.$file.'</label>
                ';
            } else {
                echo '
                    <label class="fixed_flex"><input type="checkbox" name="files[]" value="'.$file.'" /> '.$file.'</label>
                ';
            }
        }
        ?>
        <aside class="flex">
            <select name="operation">
                <option value="0">Delete</option>
                <option value="1" selected>Add/Remove</option>
            </select>
            <button class="btn btn_1" type="submit" name="head_foot">Submit</button>
        </aside>
    </form>
    
</section>
</body>
</html>
