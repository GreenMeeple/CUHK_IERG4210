
<?php	
	require __DIR__.'/lib/db.inc.php';
	$res = ierg4210_fetchcat();
	$options = '';

	foreach ($res as $value){
    		$options .= '<option value="'.$value["catid"].'"> '.$value["name"].' </option>';
	}
?>

<!DOCTYPE html>

<html>
  <head>
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
					<a href="index.php"><img src="medias/Banner.jpg" alt="banner"></a>
				</div>
				<div>
					<h1>Please be reminded that this is your admin panel</h1>
				</div>
     	</div>
    </header>

    <fieldset class = "admin">
        <legend> New Product</legend>
        <form id="prod_insert" method="POST" action="admin-process.php?action=prod_insert"
        enctype="multipart/form-data">

            <label for="prod_catid"> Category *</label>
            <div> <select id="prod_catid" name="catid"><?php echo $options; ?></select></div>

            <label for="prod_name"> Name *</label>
            <div> <input id="prod_name" type="text" name="name" required="required" pattern="^[\w\-]+$"/></div>

            <label for="prod_price"> Price *</label>
            <div> <input id="prod_price" type="text" name="price" required="required" pattern="^\d+\.?\d*$"/></div>

            <label for="prod_desc"> Description *</label>
            <div> <input id="prod_desc" type="text" name="description"/> </div>

            <label for="prod_image"> Image * </label>
            <div> <input type="file" name="file" required="true" accept="image/jpeg/jpg/png"/> </div>

            <input type="submit" value="Submit"/>
        </form>
    </fieldset>
  </body>
</html>