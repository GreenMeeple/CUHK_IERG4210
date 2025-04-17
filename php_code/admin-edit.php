<?php
require __DIR__ . '/src/db.inc.php';

// ✅ Accept PID from either POST or GET
$pid = null;

if (isset($_GET['pid']) && preg_match('/^\d+$/', $_GET['pid'])) {
    $pid = (int)$_GET['pid'];
} elseif (isset($_POST['pid']) && preg_match('/^\d+$/', $_POST['pid'])) {
    $pid = (int)$_POST['pid'];
} else {
    die('Invalid PID.');
}

// Fetch the product data
$_GET['pid'] = $pid; // For compatibility with ierg4210_prod_fetchOne()
$product = ierg4210_prod_fetchOne();

$catOptions = '';
$categories = ierg4210_fetchcat();
foreach ($categories as $cat) {
    $selected = ($cat['catid'] == $product['catid']) ? 'selected' : '';
    $catOptions .= '<option value="' . htmlspecialchars($cat['catid']) . '" ' . $selected . '>' . htmlspecialchars($cat['name']) . '</option>';
}
?>

<!DOCTYPE html>
<html>

<head>
<title>Edit Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
			*{
				margin: 0;
				padding: 0;
				font-size: 100%;
				font-family: Arial, Helvetica, sans-serif;
				}

      header {
				margin-top:0px;
  			background-color: SeaGreen;
  			color: white;
			}	
			.flex{
  			display: flex;
				flex-direction: row;
				flex-wrap: nowrap;
				justify-content:flex-start;
			}

			div h1 {
				flex: 0 0 50%;
				padding: 25px 15px;
  			font-size: 32px;
				align-self: center;
				text-align: center;
			}

			.flexbanner {
				flex: 0 0 25%;	
				align-self: flex-end;
			}

			.flexbanner img {
				max-width: 100%;
			}

      body {
        background-color: #FFF;
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
      }

			.admin{
				padding-left: 25px;
    		display: block;
    		margin: 0 auto;
				width: fit-content;			
				}
    </style>
  </head>

  <body>

    <header>
			<div class="flex">
				<div class="flexbanner">
					<a href="./index.php"><img src="medias/Banner.jpg" alt="banner"></a>
				</div>
				<div>
					<h1>Please be reminded that this is your admin panel</h1>
				</div>
     	</div>
    </header>
    <fieldset class="admin">
    <legend>Edit Product ID: <?php echo $pid; ?></legend>
<form method="POST" action="admin-process.php?action=prod_edit" enctype="multipart/form-data">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>"/>

    <label>Category</label>
    <select name="catid"><?php echo $catOptions; ?></select><br>

    <label>Name</label>
    <input type="text" name="name" required pattern="^[\w\- ]+$" value="<?php echo htmlspecialchars($product['name']); ?>"/><br>

    <label>Price</label>
    <input type="text" name="price" required pattern="^\d+\.?\d*$" value="<?php echo htmlspecialchars($product['price']); ?>"/><br>

    <label>Description</label>
    <input type="text" name="description" required pattern="^[\w\- ]+$" value="<?php echo htmlspecialchars($product['description']); ?>"/><br>

    <label>Replace Image (optional)</label>
    <input type="file" name="file" accept="image/jpeg,image/png"/><br>

    <input type="submit" onclick="alert('This is a static demo.')" value="Update Product"/>
    
</form>
<form action="admin.php" method="get">
    <button type="submit" style="margin-top: 10px;">Back to Admin Panel</button>
</form>
</fieldset>
</body>
</html>
