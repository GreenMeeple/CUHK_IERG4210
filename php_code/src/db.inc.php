<?php
function ierg4210_DB() {
    $db = new PDO('sqlite:' . __DIR__ . '/../cart.db');
	$db->query('PRAGMA foreign_keys = ON;');
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	return $db;
}

function ierg4210_fetchcat() {
    // DB manipulation
    global $db;
    $db = ierg4210_DB();
    $q = $db->prepare("SELECT * FROM categories;");
    if ($q->execute())
        return $q->fetchAll();
}

function ierg4210_cat_fetchproduct() {
    // DB manipulation
    global $db;
    $db = ierg4210_DB();
    $q = $db->prepare("SELECT * FROM products;");
    if ($q->execute())
        return $q->fetchAll();
}

function ierg4210_cat_fetchitems($id) {
    global $db;
    $db = ierg4210_DB();
    $q = $db->prepare("SELECT * FROM products WHERE catid=?;");
		$q->bindParam(1,$id);
    if ($q->execute())
        return $q->fetchAll();
}

function ierg4210_fetch_item($id) {
    global $db;
    $db = ierg4210_DB();
    $q = $db->prepare("SELECT * FROM products WHERE pid=?;");
		$q->bindParam(1,$id);
    if ($q->execute())
        return $q->fetchAll();
}

// Since this form will take file upload, we use the tranditional (simpler) rather than AJAX form submission.
// Therefore, after handling the request (DB insert and file copy), this function then redirects back to admin.html
function ierg4210_prod_insert() {
    // input validation or sanitization

    // DB manipulation
    global $db;
    $db = ierg4210_DB();

    if (!preg_match('/^\d*$/', $_POST['catid']))
        throw new Exception("invalid-catid");
    $_POST['catid'] = (int) $_POST['catid'];
    if (!preg_match('/^[\w\- ]+$/', $_POST['name']))
        throw new Exception("invalid-name");
    if (!preg_match('/^[\d\.]+$/', $_POST['price']))
        throw new Exception("invalid-price");
    if (!preg_match('/^[\w\- ]+$/', $_POST['description']))
        throw new Exception("invalid-textt");

    $sql="INSERT INTO products (catid, name, price, description) VALUES (?, ?, ?, ?)";
    $q = $db->prepare($sql);

    // Copy the uploaded file to a folder which can be publicly accessible at incl/img/[pid].jpg

    if ($_FILES["file"]["error"] == 0
        && in_array($_FILES["file"]["type"], ["image/jpeg", "image/png"])
        && in_array(mime_content_type($_FILES["file"]["tmp_name"]), ["image/jpeg", "image/png"])
        && $_FILES["file"]["size"] < 5000000){

        $catid = $_POST["catid"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $desc = $_POST["description"];
        $sql="INSERT INTO products (catid, name, price, description) VALUES (?, ?, ?, ?);";
        $q = $db->prepare($sql);
        $q->bindParam(1, $catid);
        $q->bindParam(2, $name);
        $q->bindParam(3, $price);
        $q->bindParam(4, $desc);
        $q->execute();
        $lastId = $db->lastInsertId();

        // Note: Take care of the permission of destination folder (hints: current user is apache)
        if (move_uploaded_file($_FILES["file"]["tmp_name"], "medias/" . $lastId . ".jpg")) {
            // redirect back to original page; you may comment it during debug
            header('Location: admin.php');
            exit();
        }
    }
    // Only an invalid file will result in the execution below
    // To replace the content-type header which was json and output an error message
    header('Content-Type: text/html; charset=utf-8');
    echo 'Invalid file detected. <br/><a href="javascript:history.back();">Back to admin panel.</a>';
    exit();
}

function ierg4210_prod_fetchOne(){
    global $db;
    $db = ierg4210_DB();

    if (!preg_match('/^\d+$/', $_GET['pid']))
        throw new Exception("invalid-pid");

    $pid = (int) $_GET['pid'];

    $q = $db->prepare("SELECT * FROM products WHERE pid = ?;");
    $q->bindParam(1, $pid);
    if ($q->execute())
        return $q->fetch();
}

function ierg4210_prod_edit(){
    global $db;
    $db = ierg4210_DB();

    if (!preg_match('/^\d+$/', $_POST['pid']))
        throw new Exception("invalid-pid");
    if (!preg_match('/^\d+$/', $_POST['catid']))
        throw new Exception("invalid-catid");
    if (!preg_match('/^[\w\- ]+$/', $_POST['name']))
        throw new Exception("invalid-name");
    if (!preg_match('/^[\d\.]+$/', $_POST['price']))
        throw new Exception("invalid-price");
    if (!preg_match('/^[\w\- ]+$/', $_POST['description']))
        throw new Exception("invalid-desc");

    $pid = (int) $_POST['pid'];
    $catid = (int) $_POST['catid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['description'];

    $sql = "UPDATE products SET catid=?, name=?, price=?, description=? WHERE pid=?";
    $q = $db->prepare($sql);
    $q->bindParam(1, $catid);
    $q->bindParam(2, $name);
    $q->bindParam(3, $price);
    $q->bindParam(4, $desc);
    $q->bindParam(5, $pid);
    $q->execute();

    // If image is uploaded, update it
    if ($_FILES["file"]["error"] == 0
        && in_array($_FILES["file"]["type"], ["image/jpeg", "image/png"])
        && in_array(mime_content_type($_FILES["file"]["tmp_name"]), ["image/jpeg", "image/png"])
        && $_FILES["file"]["size"] < 5000000) {
        
        $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        $targetPath = "medias/" . $pid . "." . $ext;
        move_uploaded_file($_FILES["file"]["tmp_name"], $targetPath);
    }

    header('Location: admin.php');
    exit();
}

function ierg4210_prod_delete(){
    global $db;
    $db = ierg4210_DB();

    if (!preg_match('/^\d+$/', $_POST['pid']))
        throw new Exception("invalid-pid");

    $pid = (int) $_POST['pid'];

    // Delete the record
    $q = $db->prepare("DELETE FROM products WHERE pid=?;");
    $q->bindParam(1, $pid);
    $q->execute();

    // Optionally, delete the image
    $imagePathJpg = "medias/$pid.jpg";
    $imagePathPng = "medias/$pid.png";
    if (file_exists($imagePathJpg)) unlink($imagePathJpg);
    if (file_exists($imagePathPng)) unlink($imagePathPng);
    header('Location: admin.php');
    exit();
}

