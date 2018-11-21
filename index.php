<!DOCTYPE html>
<html lang="en">
<head>
    <title>Password Check</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        /* Style the top navigation bar */
        .topnav {
            overflow: hidden;
            background-color: darkblue;
        }

        /* Style the topnav links */
        .topnav a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        /* Change color on hover */
        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Style the content */
        .content {
            background-color: #fff;
            padding: 10px;
            height: 550px; /* Should be removed. Only for demonstration */
        }

        /* Style the footer */
        .footer {
            background-color: #f1f1f1;
            padding: 10px;
        }
    </style>
</head>
<body>

<div class="topnav">
    <a href="index.php">Home</a>
</div>

<div class="content">
    <h2>Check your password...</h2>
    <p>
		<?php
		$needle = isset( $_POST['password'] ) ? $_POST['password'] : '';

		?>
    <form action="" method="post">

        <input type="text" name="password" value="<?php echo $needle; ?>" placeholder="Enter password here"/>

        <input type="submit" name="submit" value="Submit"/>

    </form>
    <br/>
    <div style="color: darkblue; font-size: large">
		<?php
		if ( isset( $_POST['submit'] ) ) {
			checkPassword( $needle, 'passwords.txt' );
		}
		// default reading size 1MB = 1000000
		function checkPassword( $needle, $fileName, $length = 1000000 ) {
			// SplFileObject can read large files part by part based on size or lines
			$file = new \SplFileObject( $fileName );
			while ( ! $file->eof() ) {
				$line = $file->fread( $length );
				// new line, space and carriage return added additionally if passwords.txt file format changes.
				// added comma before string to match the first string
				if ( preg_match( "/\,[\n\r\s]*$needle:/", ',' . $line ) ) {
					echo "INVALID PASSWORD, Try a differernt one";

					return;
				}
			}
			echo "OK";
		}

		?>
    </div>

    </p>
</div>

<div class="footer">
    <p></p>
</div>

</body>
</html>
