<!-- Footer-->
<!-- <footer class="bg-light py-5">
    <div class="container">
        <div class="small text-center text-muted">Copyright © <?= date('Y'); ?> - <?= $title; ?></div>
    </div>
</footer> -->
<footer class="wp-block-template-part">
    <div class="wp-block-group has-base-color has-primary-background-color has-text-color has-background has-link-color wp-elements-04baee31bae510feb70981c355d6b9ce is-layout-flow wp-block-group-is-layout-flow"
        style="padding-top:9vh;padding-right:4vw;padding-bottom:9vh;padding-left:4vw">
        <div
            class="wp-block-columns alignfull is-layout-flex wp-container-core-columns-layout-3 wp-block-columns-is-layout-flex">
            <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:30%">
                <h1 class="wp-block-site-title"><a href="https://hevordemo.wordpress.com/?demo" target="_self"
                        rel="home" aria-current="page">Hevor</a></h1>
                <p class="has-small-font-size">
                    <?= $info[0]['text_footer'] ?>
                </p>
            </div>
            <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow"></div>
            <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow">
                <p><strong>Get In Touch</strong></p>
                <p class="has-small-font-size"><a href="#">
                        <?= $info[0]['email'] ?>
                    </a><br>
                    <?= $info[0]['phone'] ?>
                </p>
            </div>
            <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow">
                <p><strong>Visit Us</strong></p>
                <p class="has-small-font-size">
                    <?= $info[0]['map'] ?>
                </p>
            </div>
        </div>
        <div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
        <div class="wp-block-group alignfull is-content-justification-space-between is-nowrap is-layout-flex wp-container-core-group-layout-19 wp-block-group-is-layout-flex"
            style="padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px">
            <p class="has-text-align-left" style="font-size:0.6rem"><a href="https://wordpress.com/?ref=footer_blog"
                    rel="nofollow">Copyright ©
                    <?= date('Y'); ?> -
                    <?= $title; ?>
                </a>
            </p>
            <nav class="has-small-font-size items-justified-space-between wp-block-navigation has-small-font-size is-content-justification-space-between is-layout-flex wp-container-core-navigation-layout-2 wp-block-navigation-is-layout-flex"
                aria-label="">
                <ul class="has-small-font-size wp-block-page-list">
                    <?php foreach ($user_menu as $menu): ?>

                        <li class="wp-block-pages-list__item wp-block-navigation-item open-on-hover-click"><a
                            class="wp-block-pages-list__item__link wp-block-navigation-item__content"
                            href="#"  data-toggle='modal' data-target='#<?= $menu['contact']; ?>'><?= $menu['menu']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

</body>

</html>