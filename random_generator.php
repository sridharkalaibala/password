<?php
// Just to generate passwords.txt file
$lines = 10000;
$line  = '';
for ( $i = 1; $i <= $lines; $i ++ ) {
	$line .= gr( rand( 3, 10 ) ) . ':' . gr( rand( 3, 5 ) ) . ':' . date( 'm-d-Y', strtotime( '+' . mt_rand( 0, 300 ) . ' days' ) ) . ",\n";
}

file_put_contents( 'passwords.txt', $line );


function gr( $length = 10 ) {
	$characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen( $characters );
	$randomString     = '';
	for ( $i = 0; $i < $length; $i ++ ) {
		$randomString .= $characters[ rand( 0, $charactersLength - 1 ) ];
	}

	return $randomString;
}