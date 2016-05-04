<?php
/**
 * @file
 * Returns the HTML for a single Drupal page.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728148
 */
?>

<div id="page">

  <header class="header" id="header" role="banner">

    <?php if ($logo): ?>
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="header__logo" id="logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" class="header__logo-image" /></a>
    <?php endif; ?>

    <?php if ($site_name): ?>
      <div class="header__name" id="name">
        <?php if ($site_name): ?>
          <h1 class="header__site-name" id="site-name">
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" class="header__site-link" rel="home"><span><?php print $site_name; ?></span></a>
          </h1>
        <?php endif; ?>
      </div>
    <?php endif; ?>
		
		<?php if ($site_slogan): ?>
      <!--<div class="header__site-slogan" id="site-slogan"><?php print $site_slogan; ?></div>-->
      <div class="header__site-slogan" id="site-slogan">
				<?php print t('Premier line of quality commercial cooking equipment  from Italy.<br/>Innovative solutions designed specifically for the US market.'); ?>
			</div>
    <?php endif; ?>
		
    <?php print render($page['header']); ?>

  </header>

  <div id="main">

    <div id="content" class="column" role="main">
      <?php print render($page['highlighted']); ?>
      <?php print $breadcrumb; ?>
      <a id="main-content"></a>
      <?php if ($title): ?>
        <h1 class="page__title title" id="page-title"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print $messages; ?>
      <?php print render($tabs); ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php print render($page['latest']); ?>
    </div>

    <div id="navigation">

      <?php print render($page['navigation']); ?>

    </div>

    <?php
      $sidebar_second = render($page['sidebar_second']);
    ?>

    <?php if ($sidebar_second): ?>
      <aside class="sidebars">
        <?php print $sidebar_second; ?>
      </aside>
    <?php endif; ?>

  </div>

	<!--<div class="push"></div>-->
	
</div>

<?php print render($page['bottom']); ?>
