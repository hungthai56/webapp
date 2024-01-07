<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <div class="flag">
                <ul style="list-style: none;display: flex; column-gap: 10px;margin: 0;cursor: pointer;">
                    <li onclick="sendlang('?lang=en')"><img style="height: 20px"
                            src="<?= base_url('assets/img/'); ?>uk.png" alt=""></li>
                    <li onclick="sendlang('?lang=vi')"><img style="height: 20px"
                            src="<?= base_url('assets/img/'); ?>vietnam.png" alt=""></li>
                </ul>
            </div>
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                            <?= $user['name']; ?>
                        </span>
                        <img class="img-profile rounded-circle"
                            src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('user'); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            My Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal"
                            data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Sign Out
                        </a>
                    </div>
                </li>

            </ul>

        </nav>

        <script>
            function sendlang(lang) {
                var urlweb = "";
                const url = window.location.href;
                const params = url.split("?");
                urlweb = params[0] + lang
                window.location = urlweb
                sessionStorage.setItem("url", lang);
            }
        </script>
        <!-- End of Topbar -->