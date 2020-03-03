<?php include 'inc/header.php'; ?>
<?php

    // get product details
    $id=mysqli_real_escape_string($conn,$_GET['id']);

    // create query
    $query_product="SELECT * FROM products WHERE id=".$id;

    // get result
    $result_product=mysqli_query($conn,$query_product);  

    // fetch the data
    $product=mysqli_fetch_assoc($result_product);
    $product_id=$product['id'];
    $product_name=$product['product_name'];
    $product_price=$product['price'];

    // get customer details
    $query_customer="SELECT * FROM customers WHERE email=".$_SESSION['email'];

    // get result
    $result_customer=mysqli_query($conn,$query_customer);  

    // fetch the data
    $customer=mysqli_fetch_assoc($result_customer);
    $customer_id=$customer['id'];
    $customer_email=$customer['email'];


    $query_transaction="INSERT INTO transactions (customer_id,product_id,product_name,product_price) VALUES ('$customer_id','$product_id','$product_name','$product_price')";
        // get result
        $result=mysqli_query($conn,$query_transaction);
        if ($result){
            
            include "classes/class.phpmailer.php";
            include "classes/class.smtp.php";

            $mail = new PHPMailer; 
            $mail->IsSMTP(); 
            $mail->SMTPDebug = 1; 
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465; 
            $mail->IsHTML(true);
            $mail->Username = "sadi_test01@gmail.com";
            $mail->Password = "passwordi_gizala";
            $mail->setFrom('sadi_test01@gmail.com', 'Sadi');
            $mail->Subject = 'Alif sarmoya task';
            $address = $customer['email']; 
            $mail->Body = 'javoboi task kay mebroyan/malum meshavand?';
            $mail->addAddress($address, 'alif capital'); 
            if(!$mail->Send()){
                echo "Mailer Error: " . $mail->ErrorInfo;
            }else{
                echo "Message has been sent";
            }
            // to errorhoro nishon bta....dar poyon
            // echo "<script>window.alert('Transaction data has been saved sucessfully')
            // window.location='product.php'</script>";
            // header('Location: product.php');

            }else{
            echo '<script>window.alert("Transaction could not success")
            window.location="index.php"</script>ERROR: '.mysqli_error($conn);
            // header('Location: index.php');

        }

include 'inc/footer.php'; 
?> 

