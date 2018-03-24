 <?php
  $meetings = unserialize(get_option('ca_worldapi_meetings_list'));

  if (is_array($meetings) && count($meetings) > 0) {
	 foreach($meetings as $key=>$meeting) {
    $name = $meeting['name'];
    $desc = $meeting['description'];
    $address = $meeting['adress'];

    $duration = $meeting['when']['duration'];

    $day = $meeting['when']['day'];
    $start = date('H:i', strtotime($meeting['when']['time']));
    $end = date('H:i', strtotime($meeting['when']['time']) + $duration * $duration);
 ?>
<article>
  <header>
    <h2><?php echo $name; ?></h2>
  </header>
  <section>
    <p><?php echo $desc; ?></p>
  </section>
  <section class="user_reviews">
    <article class="user_review">
      <p><time><?php echo $start; ?></time> to <time><?php echo $end; ?></time></p>
      <address><?php echo $address; ?></address>
    </article>
</article>
 <?php
  }
  } else {
  ?>
    There was a problem communicating with the CA World API.
  <?php
  }
  ?>