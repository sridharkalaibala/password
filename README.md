# password

*Check Existing Password in the file*

My solution is, read the file using `SplFileObject` object instead of file_get_contents() and search given password.
file_get_contents will load full file into memory and large files may not able handle based on RAM allocated.
But using SplFileObject we load part of the file and search it.

I tested up to 3GB. Script didn't break and gave good performance than other method.


Live Demo: http://maiam.live/CL/

Code:

```
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
```		
