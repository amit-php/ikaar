<?php
$current_user = wp_get_current_user();
$roles = $current_user->roles[0];
if ($roles != "buyer") {
    // wp_redirect(home_url());
    ?>

    <script> window.location.href = '<?php echo get_the_permalink(544); ?>'</script>

    <?php
    exit;
}
$page_id = get_queried_object_id(); ?>
<div class="dashboard-menu">
    <div class="top-row d-flex justify-content-between align-items-center">
        <div class="tittle-wrap">
            <h4 class="mb-0">
                <?php echo get_theme_value('mobile_menu'); ?>
                </h3>
        </div>
        <div class="toggle-menu-icon" id="toggle-button">
            <span class="line-toggle"></span>
            <span class="line-toggle"></span>
            <span class="line-toggle"></span>
        </div>
    </div>
    <?php $menu = wp_get_nav_menu_object('BuyerMenu');
    $menuitems = wp_get_nav_menu_items("BuyerMenu", array('order' => 'DESC')); ?>

    <ul class="dashboard-nav collapsible">
        <?php
        foreach ($menuitems as $menuitem) {
            $img = get_post_meta($menuitem->ID, 'icon_image', true);
            $img_url = wp_get_attachment_image_url($img, 'full');
            if (strtolower($menuitem->post_title) == "logout") {
                $url = wp_logout_url(home_url());
            } else {
                $url = $menuitem->url;
            }
            $is_active = ($page_id == $menuitem->object_id) ? 'active' : '';
            ?>
            <li class="<?php echo $is_active; ?>">
                <a href="<?php echo $url; ?>">
                    <span><img src="<?php echo $img_url ?>" alt=""></span>
                    <?php echo $menuitem->title; ?>
                </a>
            </li>

        <?php }
        ?>
    </ul>
</div>
