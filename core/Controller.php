<?php 
header("Access-Control-Allow-Origin: *");

function __LOGIN($DATA, $conn) {
   
    $NAME = $DATA['username'];
    $PASSWORD = $DATA['password'];
    $SQL = "SELECT * FROM user WHERE name = :name";
    $STMT = $conn->prepare($SQL);
    $STMT->bindParam(':name', $NAME);
    $STMT->execute();
    $USER = $STMT->fetch(PDO::FETCH_ASSOC);
    if ($USER) {
        if (password_verify($PASSWORD, $USER['password'])) {
            print(json_encode(['status' => 'OK', 'message' => 'LOGGED IN']));
        } else {
            print(json_encode(['status' => 'ERROR', 'message' => 'WRONG PASSWORD']));
        }
    } else {
            print(json_encode(['status' => 'ERROR', 'message' => 'USER NOT FOUND']));
    }
    
}

function __REGISTER($DATA, $conn) {

    $NAME = $DATA['username'];
    $PASSWORD = $DATA['password'];
    $PASSWORD_HASH = password_hash($PASSWORD, PASSWORD_DEFAULT);
    $SQL = "INSERT INTO user (name, password) VALUES (:name, :password)";
    $STMT = $conn->prepare($SQL);
    $STMT->bindParam(':name', $NAME);
    $STMT->bindParam(':password', $PASSWORD_HASH);
    $result = $STMT->execute();
    if ($result) {
        // print("REGISTERED");
        print(json_encode(['status' => 'OK', 'message' => 'REGISTERED']));
    } else {
        // print("ERROR");
        print(json_encode(['status' => 'ERROR', 'message' => 'ERROR']));
    }
}

?>