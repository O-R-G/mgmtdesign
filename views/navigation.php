<?php
function build_nav_to($itemId, $depth, $url, $needlePath, $needleId, $oo) {
  $kids = $oo->children_ids_nav($itemId);
  if (count($kids) == 0) {
    return [];
  }
  $itemObj = $oo->get($itemId);
  $url = $url . $itemObj['url'];

  $nav = array();
  foreach($kids as $kid) {
    $kidObj = $oo->get($kid);
    $nav []= array('depth'=>$depth+1, 'id'=>$kid, 'url'=> $url . '/' . $kidObj['url']);
    if (in_array($kid, $needlePath)) {
      $nav = array_merge($nav, build_nav_to($kid, $depth+1, $url . '/', $needlePath, $needleId, $oo));
    }
  }
  return $nav;
}

if ($item) {
  // regular behavior
  $itemPath = $oo->ancestors($item['id']);
  array_push($itemPath, $item['id']);
  $nav = build_nav_to(0, 0, '', $itemPath, $item['id'], $oo);
} else {
  // root behavior
  $nav = build_nav_to(0, 0, '', [], 0, $oo);
}

$tempNav = array();

if (count($itemPath) > 0)
  $rootParent = $oo->get($itemPath[0]);

// process include root node that is parent
foreach($nav as $key=>$n) {
  if ($n['id'] == $uu->id) {
    $navEntry = $n;
  }

  if ($n['depth'] == 1) {
    if ($n['id'] == $uu->id || $n['id'] == $rootParent['id']) {
      $tempNav []= $n;
    }
  } else {
    $tempNav []= $n;
  }
}

// if empty (home), just reset
if (count($tempNav) == 0) {
  $tempNav = $nav;
}

$level = 'maxLevel' . count($itemPath);


?>
<div id='nav' class='navContainer MenuSub <?= $level; ?>'>
  <div class = "indent">
    <ul class = 'staticHide'>
      <?php
        foreach ($tempNav as $n) {
          $listType = 'listStatic';
          if($itemPath && in_array($n['id'], $itemPath)) {
            $listType = 'listActive';
          }
      ?><li class="<?= $listType ?> <?= 'level'.$n['depth']; ?>">
          <a href="<?= $n['url']; ?>" style="display: block; padding-left: <?= ($n['depth'] * 10);?>px;">
            <?= $oo->get($n['id'])['name1']; ?>
          </a>
        </li><?php
          }
        ?>
    </ul>
  </div>
</div>
