<?php
include 'includes/config.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payload'])) {
    $receivedData = json_decode($_POST['payload']);
    $receivedFunction = $_POST['setFunction'];

    if (function_exists($receivedFunction)) {
        $result = $receivedFunction($receivedData);
        echo $result;
    } else {
        echo "Invalid function name.";
    }
}


function Login($request = null)
{
    $username = $request->username;
    $password = $request->password;
    $passwordhashed = sha1($password);


    $checkUserDb = "SELECT *
    FROM login
    WHERE username = :username AND 
    password = :pass";
    $pdo = Database::connection();
    $stmt = $pdo->prepare($checkUserDb);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $passwordhashed, PDO::PARAM_STR);
    $stmt->execute();
    $numRows1 = $stmt->rowCount();
    $datas = $stmt->fetchAll();

    // $user_role = null; // Initialize $user_role here
    // $user_id = null;
    if($numRows1 == 1){
        foreach ($datas as $data) {
            $user_role = $data['role'];
            $_SESSION['id'] = $data['id'];
            $_SESSION['fullname'] = $data['full_name'];
        }
        $msg['title'] = "Successful";
        $msg['message'] = "Welcome";
        $msg['icon'] = "success";
        $msg['user_role'] = $user_role;
        echo json_encode($msg);
    }else{
        $msg['title'] = "Warning";
        $msg['message'] = "Wrong Username or Password";
        $msg['icon'] = "warning";
        echo json_encode($msg);
    }
   



}


?>