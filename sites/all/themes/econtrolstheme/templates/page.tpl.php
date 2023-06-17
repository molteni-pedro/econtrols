<?php
/**
 * @file
 * Returns the HTML for a single Drupal page.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728148
 */
?>


<header class="header" role="banner">
    <div class="topbar">
        <div class="layout-center">
            <?php print render($page['topbar']); ?>
        </div>
    </div>

    <div class="logomenu">
        <div class="layout-center">

            <?php if ($logo): ?>
                <a href="<?php print $front_page; ?>" title="<?php print $site_name; ?>" rel="home" class="header__logo"><img src="<?php print $logo; ?>" alt="<?php print $site_name; ?>" class="header__logo-image" /></a>
            <?php endif; ?>

            <?php if ($site_name || $site_slogan): ?>
                <div class="header__name-and-slogan">
                    <?php /* if ($site_name): ?>
                      <h1 class="header__site-name">
                      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" class="header__site-link" rel="home"><span><?php print $site_name; ?></span></a>
                      </h1>
                      <?php endif; */ ?>

                    <?php if ($site_slogan): ?>
                        <div class="header__site-slogan"><?php print $site_slogan; ?></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php print render($page['navigation']); ?>
        </div>
    </div>

    <div class="headerheader">
        <div class="layout-center">
            <?php print render($page['header']); ?>
        </div>
    </div>

</header>


<?php
// Render the sidebars to see if there's anything in them.
$sidebar_first = render($page['sidebar_first']);
$sidebar_second = render($page['sidebar_second']);
// Decide on layout classes by checking if sidebars have content.
$content_class = 'layout-3col__full';
$sidebar_first_class = $sidebar_second_class = '';
if ($sidebar_first && $sidebar_second):
    $content_class = 'layout-3col__right-content';
    $sidebar_first_class = 'layout-3col__first-left-sidebar';
    $sidebar_second_class = 'layout-3col__second-left-sidebar';
elseif ($sidebar_second):
    $content_class = 'layout-3col__left-content';
    $sidebar_second_class = 'layout-3col__right-sidebar';
elseif ($sidebar_first):
    $content_class = 'layout-3col__right-content';
    $sidebar_first_class = 'layout-3col__left-sidebar';
endif;
?>
<?php print render($page['highlighted']); ?>
<?php if(isset($page['banners']) && $page['banners']){ ?>
<div class="banners">
    <div class="layout-center">
        <?php print render($page['banners']); ?>
    </div>
</div>
<?php } ?>
<div class="bggris">
    <div class="layout-center">
        <div class="layout-3col layout-swap">
            <?php print render($page['precontent']); ?>
            <?php print $breadcrumb; ?>
            <a href="#skip-link" class="visually-hidden visually-hidden--focusable" id="main-content">Back to top</a>
            <main class="<?php print $content_class; ?>" role="main">
                <?php print render($title_prefix); ?>
                <?php if ($title): ?>
                    <h1><?php print $title; ?></h1>
                <?php endif; ?>
                <?php print render($title_suffix); ?>
                <?php print $messages; ?>
                <?php print render($tabs); ?>
                <?php print render($page['help']); ?>
                <?php if ($action_links): ?>
                    <ul class="action-links"><?php print render($action_links); ?></ul>
                <?php endif; ?>
                <?php print render($page['content']); ?>
                <?php print $feed_icons; ?>
            </main>

            <div class="layout-swap__top layout-3col__full">

                <a href="#skip-link" class="visually-hidden visually-hidden--focusable" id="main-menu" tabindex="-1">Back to top</a>

            </div>

            <?php if ($sidebar_first): ?>
                <aside class="<?php print $sidebar_first_class; ?>" role="complementary">
                    <?php print $sidebar_first; ?>
                </aside>
            <?php endif; ?>

            <?php if ($sidebar_second): ?>
                <aside class="<?php print $sidebar_second_class; ?>" role="complementary">
                    <?php print $sidebar_second; ?>
                </aside>
            <?php endif; ?>
        </div>
    </div>
</div>      

<div class="prefooter"><div class="layout-center"><?php print render($page['prefooter']); ?></div></div>
<div class="footerline"><div class="layout-center"><?php print render($page['footerline']); ?></div></div>
<div class="footer"><div class="layout-center"><?php print render($page['footer']); ?></div></div>
<div class="bottom"><div class="layout-center"><?php print render($page['bottom']); ?></div></div>
<!-- Hotjar Tracking Code for http://www.e-controls.es/ -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:552125,hjsv:5};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>