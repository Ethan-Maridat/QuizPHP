<?php
// sqlite3 db.sqlite 
$pdo=new PDO('sqlite:db.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// insertion 
// $nbRows = $pdo->exec("INSERT INTO COMPANY (ID,NAME,AGE,ADDRESS,SALARY) VALUES (1, 'test', 25, 'Texas', 15000.00 );");




foreach ($rows as $row) {
    echo $row['ID'] . "\n";
    echo $row['NAME'] . "\n";
    echo $row['AGE'] . "\n";
    echo $row['ADDRESS'] . "\n";
    echo $row['SALARY'] . "\n";
}

$stmt=$pdo->prepare("SELECt * FROM COMPANY WHERE ID=?;");

$stmt->execute([1]);
$company=$stmt->fetch();
;

echo "ID: " . $company['ID'] . ",nom: " . $company['NAME'] . ", age: " . $company['AGE'] . ", address: " . $company['ADDRESS'] . ", salary: " . $company['SALARY'] . "\n";
