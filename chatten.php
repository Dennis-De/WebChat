<?php
session_start ();
//Login-Formular
function loginForm() {
    echo '
   <div id="loginform">
   <form action="chatten.php" method="post">
       <p>Bitte gib deinen Chat-Namen ein:</p>
       <label for="name">Name: </label>
       <input type="text" name="name" id="name" />
       <input type="submit" name="enter" id="enter" value="Weiter zum Chat" />
   </form>
   </div>
   ';
}
 
if (isset ( $_POST ['enter'] )) {
    if ($_POST ['name'] != "") {
        $_SESSION ['name'] = stripslashes ( htmlspecialchars ( $_POST ['name'] ) );
        $fp = fopen ( "log.html", 'a' );
        fwrite ( $fp, "<div class='msgln'><i>User " . $_SESSION ['name'] . " ist dem Chat beigetreten.</i><br></div>" );
        fclose ( $fp );
    } else {
        echo '<span class="error">Bitte gib einen Chat-Namen ein! </span>';
    }
}
 
if (isset ( $_GET ['logout'] )) {
    
    // Simple exit message
    $fp = fopen ( "log.html", 'a' );
    fwrite ( $fp, "<div class='msgln'><i>User " . $_SESSION ['name'] . " hat den Chat verlassen.</i><br></div>" );
    fclose ( $fp );
    
    session_destroy ();
    header ( "Location: chatten.php" ); // Redirect the user
}
 
?>
<!DOCTYPE html>
<html>
<head>
<title>Chat - Customer Module</title>
<link type="text/css" rel="stylesheet" href="style2.css" />
</head>
<body>
    <?php
    if (! isset ( $_SESSION ['name'] )) {
        loginForm ();
    } else {
        ?>
<div id="wrapper">
        <div id="menu">
            <p class="welcome">
                Herzlich Willkommen <b><?php echo $_SESSION['name']; ?></b>
            </p>
            <p class="logout">
                <a id="exit" href="#">Chat beenden</a>
            </p>
            <div style="clear: both"></div>
        </div>
        <div id="chatbox"><?php
        if (file_exists ( "log.html" ) && filesize ( "log.html" ) > 0) {
            $handle = fopen ( "log.html", "r" );
            $contents = fread ( $handle, filesize ( "log.html" ) );
            fclose ( $handle );
            
            echo $contents;
        }
        ?></div>
 
        <form name="message" action="">
            <input name="usermsg" type="text" id="usermsg" size="63" /> <input
                name="submitmsg" type="submit" id="submitmsg" value="Send" />
        </form>
    </div>
    <script type="text/javascript"
        src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    <script type="text/javascript">
// jQuery Document
$(document).ready(function(){
});
 
//jQuery Document
$(document).ready(function(){
    //If user wants to end session
    $("#exit").click(function(){
        var exit = confirm("Sind Sie sicher, dass Sie den Chat beenden möchten?");
        if(exit==true){window.location = 'chatten.php?logout=true';}      
    });
});
 
//If user submits the form
$("#submitmsg").click(function(){
        var clientmsg = $("#usermsg").val();
        $.post("post.php", {text: clientmsg});              
        $("#usermsg").attr("value", "");
        loadLog;
    return false;
});
 
function loadLog(){     
    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
    $.ajax({
        url: "log.html",
        cache: false,
        success: function(html){        
            $("#chatbox").html(html); //Insert chat log into the #chatbox div   
            
            //Auto-scroll           
            var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
            if(newscrollHeight > oldscrollHeight){
                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
            }               
        },
    });
}
 
setInterval (loadLog, 2500);
</script>
<?php
    }
    ?>
    <script type="text/javascript"
        src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    <script type="text/javascript">
</script>
</body>
</html>
