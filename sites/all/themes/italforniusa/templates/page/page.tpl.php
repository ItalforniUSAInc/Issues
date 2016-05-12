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
				<?php print t('Premier line of quality commercial cooking equipment from Italy.<br/>Innovative solutions designed specifically for the North American market.'); ?>
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

      <!-- BEGIN: Constant Contact Email List Form Button --><div align="center"><a href="http://visitor.r20.constantcontact.com/d.jsp?llr=xy477wwab&amp;p=oi&amp;m=1123902455575&amp;sit=v4wbopmkb&amp;f=65636363-e285-4804-8f8b-3d224bc64c09" class="button" style="background-color: rgb(0, 128, 0); border: 1px solid rgb(91, 91, 91); color: rgb(255, 255, 255); display: inline-block; padding: 8px 10px; text-shadow: none; border-top-left-radius: 20px; border-top-right-radius: 20px; border-bottom-right-radius: 20px; border-bottom-left-radius: 20px;">Join Our Email List</a><!-- BEGIN: Email Marketing you can trust --><div id="ctct_button_footer" align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:10px;color:#999999;margin-top: 10px;">For Email Marketing you can trust.</div></div>

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
