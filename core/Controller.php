<?php 


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
            
            $response = [
                'status' => 'OK',
                'message' => 'เข้าสู่ระบบสำเร็จ',
                'token' => '1234567890',
                'expire' => time() + 3600,
                'user' => $USER
            ];
            echo json_encode($response);

        } else {
            $response = [
                'status' => 'ERROR',
                'message' => 'เกิดข้อผิดพลาด กรุณาลองใหม่'
            ];
            echo json_encode($response);
        }
    } else {
            $response = [
                'status' => 'ERROR',
                'message' => 'ไม่พบข้อมูลผู้ใช้งาน'
            ];
            echo json_encode($response);
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
        print(json_encode(['status' => 'OK', 'message' => 'REGISTERED']));
    } else {
        print(json_encode(['status' => 'ERROR', 'message' => 'ERROR']));
    }
}

function __GET_PRODUCT_BY_ID($id, $conn) {
    print(json_encode(['status' => 'OK', 'message' => "GET_PRODUCT_BY_ID $id"]));
}

function __GET_ALL_PRODUCTS($conn) {

}   

?>