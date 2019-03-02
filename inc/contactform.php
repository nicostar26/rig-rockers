<?php
$msg ="";
$msgClass = "";

//CHECK FOR SUBMIT

if(filter_has_var(INPUT_POST, 'submit')){
    // Get form Data
    $email = htmlspecialchars($_POST['email']);
    $name = htmlspecialchars($_POST['name']);
    $message = htmlspecialchars($_POST['message']);

    //Check Required Fields

    if(!empty($email) && !empty($name) && !empty($message)){
        //PASSED
        //Check Email
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            //FAILED
            $msg = 'Please enter a valid email';
        $msgClass = "alert-danger";
        }else{
            //PASSED
            //Recipient Email
            $toEmail = '01rigrockers@gmail.com';
            $subject = 'Contact Request From '.$name;
            $body = '<h2>Contact Request</h2>
                    <h4>Name</h4><p>'.$name.'</p>
                    <h4>Email</h4><p>'.$email.'</p>
                    <h4>Message</h4><p>'.$message.'</p>
                    
                    ';

            //Email Headers
            $headers = "MIME-Version: 1.0" ."\r\n";
            $headers .="Content-Type:text/html;charset=UTF-8' . '\r\n";

            //Additional Headers

            $headers .= "From: " .$name. "<" .$email. ">" . "\r\n";

            if(mail($toEmail, $subject, $body, $headers)){
                // Email Sent
                $msg = 'Your Email Has Been Sent';
                $msgClass = "alert-success";
            
            }
                else{
                $msg = 'Your Email Was Not Sent';
                $msgClass = "alert-danger";
                }
        
        }
    }else {
        //FAILED
        $msg = 'Please fill in all fields';
        $msgClass = "alert-danger";
        }
}
?>

<div class="container">
    <?php if($msg != ''): ?>
    <div class = "alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
<?php endif; ?>
    <div class="contactus">
        <h1>Contact Us</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo isset($_POST["name"]) ? $name : ''; ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo isset($_POST["email"]) ? $email : ''; ?>">
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea name="message" class="form-control"><?php echo isset($_POST["message"]) ? $message : ''; ?></textarea>
            </div>
            <br>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
</div>