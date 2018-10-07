<?php
// random gif from .Home
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

<?php include_once('navigation.php'); ?>

<div class="bodyContainer Mono Underline">
  <?= $item['body']; ?>
  <span class="mgmtVoice"><?= $item["deck"]; ?></span>
</div>
