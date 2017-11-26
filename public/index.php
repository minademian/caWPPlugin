<?php // Silence is golden

$helloWorld = wp_remote_retrieve_body(wp_remote_get('http://192.168.0.8:8000/filter/'));

?>

<h1>Cocaine Anonymous Meetings</h1>
<?php echo $helloWorld; ?> 