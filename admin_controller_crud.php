<?php

session_start();
if (!isset($_SESSION['fullname'])) {
    header('Location:login.php');
    exit;
}

include 'includes/config.php';

$pdo = Database::connection();

if (isset($_POST['admin'])) {
    $admin = $_POST['admin'];
    $password = sha1($_POST['password']); // Hash the password
    $fullname = $_POST['fullname'];
    $role = 0;

    // Check if course already exists
    $check_course_query = "SELECT * FROM login WHERE  username = :admin AND full_name = :fullname AND role = 0";
    $stmt = $pdo->prepare($check_course_query);
    $stmt->bindParam(':admin', $admin, PDO::PARAM_STR);
    $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
    $stmt->execute();


    if ($stmt->rowCount() > 0) {
       
        $data = array(
            'status' => 'data_exist',
        );
        echo json_encode($data);
    } else {
        $insert_user_query = "INSERT INTO `login` (`username`, `full_name`, `password`, `role`)
        VALUES (:admin, :fullname, :password, :role)";
        $stmt = $pdo->prepare($insert_user_query);
        $stmt->bindParam(':admin', $admin, PDO::PARAM_STR);
        $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_INT);
        $insert_user_result = $stmt->execute(); // Store the result of the execution

        if ($insert_user_result) {
            $data = array(
                'status' => 'success',
            );
            echo json_encode($data);
        } else {
            $data = array(
                'status' => 'failed',
            );
            echo json_encode($data);
        }
    }
}

else if(isset($_POST['id'])){
    $id = $_POST['id'];
    $sql = "SELECT * FROM `login` WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($userData) {
            $data = $userData;
        } else {
            $data = array(
                'status' => 'failed',
                'message' => 'Data not found'
            );
   
        }
    } else {
        $data = array(
            'status' => 'failed',
            'error' => $stmt->errorInfo()
        );

    }
    echo json_encode($data);
}

elseif (isset($_POST['hiddendata_update'])) {
    $id = $_POST['hiddendata_update'];
    $password = sha1($_POST['password']);
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];

    $sql = "UPDATE login SET username = :username, full_name = :fullname, password = :password WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        ':username' => $username,
        ':id' => $id,
        ':fullname' => $fullname,
        ':password' => $password
    ])) {
        $data = array(
            'status' => 'success'
        );
    } else {
        $data = array(
            'status' => 'failed',
            'error' => $stmt->errorInfo()
        );
    }
    echo json_encode($data);

}
else if(isset($_POST['remove'])) {
    $id = $_POST['remove'];

    try {
        $stmt = $pdo->prepare("DELETE FROM `login` WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = array(
            'status' => 'success',
        );
        echo json_encode($data);
    } catch (PDOException $e) {
        $data = array(
            'status' => 'failed',
            'error' => $e->getMessage(),
        );
        echo json_encode($data);
    }
}

//registrar
else if (isset($_POST['registrar'])) {
    $registrar = $_POST['registrar'];
    $passwordR = sha1($_POST['passwordR']); // Hash the password
    $fullnameR = $_POST['fullnameR'];
    $role = 1;

    // Check if course already exists
    $check_course_query = "SELECT * FROM login WHERE  username = :registrar AND full_name = :fullnameR AND role = 1";
    $stmt = $pdo->prepare($check_course_query);
    $stmt->bindParam(':registrar', $registrar, PDO::PARAM_STR);
    $stmt->bindParam(':fullnameR', $fullnameR, PDO::PARAM_STR);
    $stmt->execute();


    if ($stmt->rowCount() > 0) {
       
        $data = array(
            'status' => 'data_exist',
        );
        echo json_encode($data);
    } else {
        $insert_user_query = "INSERT INTO `login` (`username`, `full_name`, `password`, `role`)
        VALUES (:registrar, :fullnameR, :passwordR, :role)";
        $stmt = $pdo->prepare($insert_user_query);
        $stmt->bindParam(':registrar', $registrar, PDO::PARAM_STR);
        $stmt->bindParam(':fullnameR', $fullnameR, PDO::PARAM_STR);
        $stmt->bindParam(':passwordR', $passwordR, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_INT);
        $insert_user_result = $stmt->execute(); // Store the result of the execution

        if ($insert_user_result) {
            $data = array(
                'status' => 'success',
            );
            echo json_encode($data);
        } else {
            $data = array(
                'status' => 'failed',
            );
            echo json_encode($data);
        }
    }
}

else if(isset($_POST['idR'])){
    $id = $_POST['idR'];
    $sql = "SELECT * FROM `login` WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($userData) {
            $data = $userData;
        } else {
            $data = array(
                'status' => 'failed',
                'message' => 'Data not found'
            );
   
        }
    } else {
        $data = array(
            'status' => 'failed',
            'error' => $stmt->errorInfo()
        );

    }
    echo json_encode($data);
}

elseif (isset($_POST['hiddendata_registrar'])) {
    $idR = $_POST['hiddendata_registrar'];
    $passwordR = sha1($_POST['passwordR']);
    $usernameR = $_POST['usernameR'];
    $fullnameR = $_POST['fullnameR'];

    $sql = "UPDATE login SET username = :usernameR, full_name = :fullnameR, password = :passwordR WHERE id = :idR";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        ':usernameR' => $usernameR,
        ':idR' => $idR,
        ':fullnameR' => $fullnameR,
        ':passwordR' => $passwordR
    ])) {
        $data = array(
            'status' => 'success'
        );
    } else {
        $data = array(
            'status' => 'failed',
            'error' => $stmt->errorInfo()
        );
    }
    echo json_encode($data);

}
else if(isset($_POST['removeR'])) {
    $id = $_POST['removeR'];

    try {
        $stmt = $pdo->prepare("DELETE FROM `login` WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = array(
            'status' => 'success',
        );
        echo json_encode($data);
    } catch (PDOException $e) {
        $data = array(
            'status' => 'failed',
            'error' => $e->getMessage(),
        );
        echo json_encode($data);
    }
}