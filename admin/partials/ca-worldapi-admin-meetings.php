<section id="content" class="ca-worldapi-meetings-list">
  <ol id="meetings" class="hfeed">
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
  <li>
  <article class="hentry">
    <header>
      <h2><?php echo $name; ?></h2>
    </header>
    <section>
      <p><?php echo $desc; ?></p>
    </section>
    <section class="meeting-map">
      <div id="map">
        map will be shown here
      </div>
    </section>
    <footer class="meeting-info">
      <section>
        <p><time><?php echo $start; ?></time> - <time><?php echo $end; ?></time></p>
      </section>
      <address><?php echo $address; ?></address>
    </footer>
  </article>
  </li>
 <?php
  }
  } else {
  ?>
    There was a problem communicating with the CA World API.
  <?php
  }
  ?>
  </ol>
</section>