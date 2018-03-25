<section id="content" class="ca-worldapi-meetings-list">
  <ol id="meetings" class="hfeed">
<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public/partials
 */

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
    <footer class="meeting-info">
      <section>
        <p><time><?php echo $start; ?></time> - <time><?php echo $end; ?></time></p>
      </section>
      <address><a href="#" title="popup window"><?php echo $address; ?></a></address>
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