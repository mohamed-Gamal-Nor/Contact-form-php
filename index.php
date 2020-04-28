<?php
    // check if user coming from a requset
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $user =  filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $mail =  filter_var($_POST['email'],FILTER_SANITIZE_EMAIL) ;
        $phone =  filter_var($_POST['cellphone'], FILTER_SANITIZE_NUMBER_INT) ;
        $message =  filter_var($_POST['message'], FILTER_SANITIZE_STRING);
        // create array of errors
        $formErrors = array();
        if(strlen($user) < 3){
            $formErrors[] = 'Username Must Be Larger than <strong>3</strong> Characters';
        }elseif(empty($mail)){
            $formErrors[] = 'Email Can\'t Be <strong>Empty</strong>';
        }elseif(empty($phone)){
            $formErrors[] = 'Phone Can\'t Be <strong>Empty</strong>';
        }else if(strlen($message)< 10){
            $formErrors[] = 'Message Must Be Larger than <strong>10</strong> Characters';
        }
        $headers = "From: " . $mail .'\r\n';
        $myEmail = 'midogamal3339@gmail.com';
        if(empty($formErrors)){
            mail($myEmail,"new Contact Form",$message . "<br>" . $phone,$headers);
            $user="";
            $mail="";
            $phone="";
            $message="";
            $success = "<div class='alert alert-success'>We Have Recived Your Message</div>";
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Contact Form</title>
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@600&display=swap" rel="stylesheet">
</head>

<body>
    <!--start form html-->
    <div class="container">
        <h1 class="text-center">Contact Me</h1>

        <form class="contact-form" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <?php if(! empty($formErrors)){?>
            <div class="alert alert-danger alert-dismissible fade show" role="start">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php
                    foreach($formErrors as $error){
                        echo $error ."<br>";
                    }
                ?>
            </div>
            <?php } ?>
            <?php
                if(isset($success)){
                    echo $success;
                }
            ?>
            <div class="form-group">
                <input class="form-control username" type="text" name="username" placeholder="Type Your Username"
                    value="<?php if(isset($user)){echo $user;}?>">
                <i class="fas fa-user fa-fw"></i>
                <span class="astrisx">*</span>
                <span class="custom-alert">Username Must Be Larger than <strong>3</strong> Characters</span>
            </div>
            <div class="form-group">
                <input class="form-control email" type="email" name="email" placeholder="please Type a Valid Email"
                    value="<?php if(isset($mail)){echo $mail;}?>">
                <i class=" fas fa-at fa-fw"></i>
                <span class="astrisx">*</span>
                <span class="custom-alert">Email Can't Be <strong>Empty</strong></span>
            </div>
            <div class="form-group">
                <input class="form-control phone" type="text" name="cellphone" placeholder="Please Type Your Cell Phone"
                    value="<?php if(isset($phone)){echo $phone;}?>">
                <i class=" fas fa-mobile fa-fw"></i>
                <span class="astrisx">*</span>
                <span class="custom-alert">Phone Can't Be <strong>Empty</strong></span>
            </div>
            <div class="form-group">
                <textarea class="form-control message" placeholder="Your Message"
                    name="message"><?php if(isset($message)){echo $message;}?></textarea>
                <span class="astrisx">*</span>
                <span class="custom-alert">Message Must Be Larger than <strong>10</strong> Characters</span><br>
            </div>
            <input class=" btn btn-success" type="submit" value="Send Message">
            <i class="fas fa-paper-plane send-icon fa-fw"></i>
        </form>
    </div>
    <!--end form html-->
    <script src="./js/jquery-3.3.1.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/main.js"></script>
</body>

</html>