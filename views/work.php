<?php
// random gif from .Side
  function getHomeId($oo, $root) {
    $children = $oo->children($root);
    foreach($children as $child) {
      $name =  strtolower($child["name1"]);
      if ($name == ".side") {
        return $child['id'];
      }
    }
  }
  $sideId = getHomeId($oo, $root);
  $sideMedia = $oo->media($sideId);
  $selectedGif = $sideMedia[array_rand($sideMedia)];

  $itemPath = $oo->ancestors($item['id']);
  array_push($itemPath, $item['id']);
  if (count($itemPath) > 1)
    $category = $oo->get($itemPath[1]);
  else
    $category = null;

  $body = $item['body'];
  $medias = $oo->media($item['id']);
?>

<div class = "projectNameContainer Mono Underline Arrow mobileNoVisibility">
  <img src="<?= m_url($selectedGif);?>" style="vertical-align: middle;">
  <div class="projectCategory">
    &nbsp;
    <?php echo $category['name1']; ?>
  </div>
</div>

<?php include_once('navigation.php'); ?>

<div class = "sidebarContainer Mono Underline Arrowlinks mobileHide">
  <?= $item['deck'] ?>
</div>

<div class = "imageContainer Mono Underline">
  <?php if ($body): ?>
    <div class="bodyText Body">
      <?php
        $doc = new DOMDocument();
        $doc->loadHTML('<?xml encoding="utf-8" ?>' . $body);
        $imgs = $doc->getElementsByTagName("img");

        //Create new wrapper div
        $new_div = $doc->createElement('div');
        $new_div->setAttribute('class','imagesubContainer');

        foreach($imgs as $img) {
          $img->setAttribute('style', 'width: 100%; height: 100%');

          //Clone our created div
          $new_div_clone = $new_div->cloneNode();

          //Replace image with this wrapper div
          if ($img->parentNode->tagName == 'a') {
            $aNode = $img->parentNode;
            $aNodeClone = $aNode->cloneNode();
            $aNode->parentNode->replaceChild($new_div_clone,$aNode);
            $new_div_clone->appendChild($aNodeClone);
            $aNodeClone->appendChild($img);
          } else {
            $img->parentNode->replaceChild($new_div_clone,$img);
            $new_div_clone->appendChild($img);
          }

          $src = $img->getAttribute('src');

          foreach ($medias as $media) {
            // if image and has caption, adds caption
            if ($src == m_url($media) && $media['caption']) {
              $div = $doc->createElement("div", $media['caption']);
              $div->setAttribute('class', 'Mono');

              $new_div_clone->appendChild($div);
              break;
            }
          }
        }

        $html = $doc->saveHTML();
        echo $html;
       ?>
    </div>
  <?php else: ?>
    <?php foreach($medias as $media): ?>
      <div class = "imagesubContainer">
        <img src="<?= m_url($media);?>" style="width: 100%; height: 100%">
        <?php if($media['caption']): ?>
          <div class="imageCaptionContainer caption">
            <?= nl2br($media['caption']); ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>

  <?php if ($body || count($medias) > 0): ?>
  <div class="bottomLineContainer">
    718 855 6262 / <a href='mailto:info@mgmtdesign.com'>info@mgmtdesign.com</a><br /><br />
  </div>
  <?php endif;?>
</div>
