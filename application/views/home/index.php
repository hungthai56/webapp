<body class="home blog wp-embed-responsive customizer-styles-applied">
    <div class="wp-site-blocks">
        <?php
        $lang = "";
        if (isset($_GET['lang'])) {
            $lang .= $_GET['lang'];
        } else {
            $lang .= "en";
        }
        ?>
        <div class="wp-block-group is-layout-flow wp-container-core-group-layout-21 wp-block-group-is-layout-flow">
            <div class="wp-block-cover has-custom-content-position is-position-bottom-left css_banner"><span
                    aria-hidden="true"
                    class="wp-block-cover__background has-background-dim-30 has-background-dim"></span><img
                    class="wp-block-cover__image-background" alt=""
                    src="<?= site_url('assets/img/banner/' . $banner[0]['image']); ?>" data-object-fit="cover" />
                <div
                    class="wp-block-cover__inner-container has-global-padding is-layout-constrained wp-block-cover-is-layout-constrained">
                    <h2 class="wp-block-heading"
                        style="font-size:clamp(2.2rem, 2.2rem + ((1vw - 0.2rem) * 2.667), 4rem);">
                        <?= $banner[0]['title']; ?>
                    </h2>
                    <p>
                        <?= $banner[0]['text']; ?>
                    </p>
                    <div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
                        <div class="wp-block-button"><a href="<?= $banner[0]['url']; ?>"
                                class="wp-block-button__link wp-element-button">Install App</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="wp-block-group has-global-padding is-layout-constrained wp-block-group-is-layout-constrained"
                style="padding-top:8vh;padding-right:4vw;padding-bottom:8vh;padding-left:4vw">
                <div
                    class="wp-block-columns alignwide is-layout-flex wp-container-core-columns-layout-1 wp-block-columns-is-layout-flex">

                    <?php foreach ($media_intro as $md): ?>
                        <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow"
                            style="padding-bottom:40px">
                            <figure class="wp-block-image size-large"><img
                                    src="<?= site_url('assets/img/media/' . $md['image']); ?>" alt="" /></figure>
                            <h2 class=" wp-block-heading">
                                <?= $md['title'] ?>
                            </h2>
                            <p>
                                <?= $md['text'] ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="wp-block-group has-global-padding is-layout-constrained wp-block-group-is-layout-constrained"
                style="padding-top:8vh;padding-right:4vw;padding-bottom:8vh;padding-left:4vw">
                <h2 class="wp-block-heading alignwide"><i style="color: red" class="fab fa-youtube"></i> From our
                    youtube</h2>
                <div
                    class="wp-block-group alignwide is-content-justification-space-between is-nowrap is-layout-flex wp-container-core-group-layout-11 wp-block-group-is-layout-flex">
                    <ul class="nav nav-tabs" role="tablist">
                        <?php foreach ($video_manager as $video): ?>
                            <li class="nav-item">
                                <a onclick="ajaxSelect(<?= $video['group_id'] ?>)" class="nav-link nav-link_to"
                                    href="#t<?= $video['group_id'] ?>" role="tab" data-toggle="tab">
                                    <?= $video['name'] ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div
                    class="wp-block-group alignwide is-content-justification-space-between is-nowrap is-layout-flex wp-container-core-group-layout-11 wp-block-group-is-layout-flex">
                    <div class="tab-content">

                        <div id="show_ajax"
                            class="wp-block-query alignwide is-layout-flow wp-block-query-is-layout-flow">
                        </div>
                    </div>
                </div>
            </div>

            <div class="wp-block-cover" style="padding-right:4vw;padding-bottom:2vh;padding-left:4vw;min-height:464px">
                <span aria-hidden="true"
                    class="wp-block-cover__background has-background-dim-30 has-background-dim"></span><img
                    class="wp-block-cover__image-background" alt=""
                    src="<?= site_url('assets/img/info/' . $info[0]['imageinstall']); ?>" data-object-fit="cover" />
                <div
                    class="wp-block-cover__inner-container has-global-padding is-layout-constrained wp-block-cover-is-layout-constrained">
                    <h2 class="wp-block-heading alignwide"
                        style="font-size:clamp(1.743rem, 1.743rem + ((1vw - 0.2rem) * 1.862), 3rem);">
                        <?= $info[0]['titleinstall'] ?>
                    </h2>
                    <div class="wp-block-buttons alignwide is-layout-flex wp-block-buttons-is-layout-flex">
                        <div class="wp-block-button"><a href="<?= $banner[0]['url']; ?>"
                                class="wp-block-button__link wp-element-button">Install App</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalVideo">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content" id="select_link">

                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalContact">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content" id="select_link">
                    <iframe
                        src="https://docs.google.com/forms/d/e/1FAIpQLScGIR1XveJjl3jtylCSF99zvOWgx_ygSy4Fi-JwmM6Sn9levQ/viewform?embedded=true"
                        width="100%" height="600" frameborder="0" marginheight="0" marginwidth="0">Đang tải…</iframe>
                </div>
            </div>
        </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        function setVideo(id) {
            var chuoi = ""
            chuoi += '<iframe width="100%" height="500" src="https://www.youtube.com/embed/' + id + '"></iframe>'
            document.getElementById("select_link").innerHTML = chuoi;
        }

        document.getElementById("modalVideo").addEventListener("click", function () {
            document.getElementById("select_link").innerHTML = "";
        });

    </script>
    <script>
        $(document).ready(function () {
            ajaxSelect(1)
        });
        function ajaxSelect(id) {
            request = $.ajax({
                url: "<?= site_url('/ajaxViewData.php') ?>",
                type: "POST",
                data: { "data": id, "lang": '<?= $lang ?>' }
            });
            request.done(function (response, textStatus, jqXHR) {
                document.getElementById("show_ajax").innerHTML = response;
            });

            sessionStorage.setItem("data", id);
            sessionStorage.setItem("lang", '<?= $lang ?>');
        }
        document.getElementsByClassName("nav-link_to")[0].classList.add("active");
        function page_tion(ud) {
            let data = sessionStorage.getItem("data");
            let lang = sessionStorage.getItem("lang");
            console.log(ud)
            request = $.ajax({
                url: "<?= site_url('/ajaxViewData.php') ?>",
                type: "POST",
                data: { "data": data, "lang": lang, "page_current": ud }
            });
            request.done(function (response, textStatus, jqXHR) {
                document.getElementById("show_ajax").innerHTML = response;
            });
        }
    </script>
</body>