<?php // $Id: page.tpl.php,v 1.17 2009/05/07 17:00:40 jmburnz Exp $
/**
 * @file
 *  page.tpl.php
 *
 * Theme implementation to display a single Drupal page.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>">
<head>
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $style; ?>
  <!--[if IE]>
    <link type="text/css" rel="stylesheet" media="all" href="<?php print $base_path . $directory; ?>/ie.css" >
  <![endif]-->
  <?php print $scripts; ?>
</head>
<?php
  $pixture_width = theme_get_setting('pixture_width');
  $pixture_width = pixture_validate_page_width($pixture_width);
?>
<body id="pixture-reloaded" class="<?php print $body_classes; ?> <?php print $logo ? 'with-logo' : 'no-logo' ; ?>"> 

   <div id="page" style="width: <?php print $pixture_width; ?>;">
       <div id="main" class="clear-block <?php print $header ? 'with-header-blocks' : 'no-header-blocks' ; ?>">

      <div id="content">
      
      <div id="content-inner">
      
    <?php if ($title): ?><h1 class="title" ><?php print $title; ?></h1><?php endif; ?>
      <div id="content-area">
          <?php print $content; ?>
        </div>

        <?php if ($content_bottom): ?>
          <div id="content-bottom" class="region region-content_bottom">
            <?php print $content_bottom; ?>
          </div> <!-- /#content-bottom -->
        <?php endif; ?>

        <?php if ($feed_icons): ?>
          <div class="feed-icons"><?php print $feed_icons; ?></div>
        <?php endif; ?>
        
      <?php if ($left): ?>
        <div id="sidebar-left" class="region region-left">
          <?php print $left; ?>
        </div> <!-- /#sidebar-left -->
      <?php endif; ?>
    </div>
    </div>
    </div>
    </div>
</body>
</html>