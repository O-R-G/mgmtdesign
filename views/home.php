<?php
  function getHomeId($oo, $root) {
    $children = $oo->children($root);
    foreach($children as $child) {
      $name =  strtolower($child["name1"]);
      if ($name == ".home") {
        return $child['id'];
      }
    }
  }
  $homeId = getHomeId($oo, $root);
  $homeMedia = $oo->media($homeId);
  $selectedGif = $homeMedia[array_rand($homeMedia)];
?>

<div class="jumpContainer">
  <img src="<?= m_url($selectedGif);?>">
</div>

<div class = 'homeContainer Big Hilight'>
  <p id='introType'>
    <?= nl2br($oo->get($homeId)['body']); ?>
  </p>
</div>

<?php include_once('navigation.php'); ?>
<!-- <div id='tweetinstaContainer' class='indent MenuSub mobileTweetInsta'>
  <a href='https://twitter.com/#!/MGMTdesign' target='new'>tweet tweet</a><br/>
  <a href='https://www.instagram.com/mgmtdesign/' target='new'>instagram</a>
</div> -->
