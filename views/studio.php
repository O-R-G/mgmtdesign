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

<div class="bodyContainer Mono Underline">
  <?= $item['body']; ?>
  <br /><br />
  <span class="mgmtVoice"><?= $item["deck"]; ?></span>
</div>

<?php include_once('navigation.php'); ?>

<div class = "bodyContainer mobileStudioBody">
  <?php foreach($oo->media($uu->id) as $media): ?>
    <div class = "imagesubContainer">
      <img src="<?= m_url($media);?>" style="width: 100%; height: 100%">
      <?php if($media['caption']): ?>
        <div class="imageCaptionContainer Caption">
          <?= strip_tags($media['caption']); ?>
        </div>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
</div>
