<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <?= $title; ?>
    </h1>

    <div class="col-lg-7">
        <?= $this->session->flashdata('message'); ?>
    </div>

    <div class="card col-lg-12 shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="<?= base_url('menu/video_menu') ?>"><i
                        class="fas fa-arrow-left"></i> Back</a></h6>
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?= $video_manager['id']; ?>" />
                <div class="form-group">
                    <label for="menu">Youtube Link</label>
                    <input type="text" class="form-control" id="youtube_link" name="youtube_link"
                        placeholder="Video Link" value="<?= $video_manager['youtube_link'] ?>">
                </div>
                <div class="form-group">
                    <label for="menu">Group</label>
                    <select name="group_id" id="group_id" class="form-control">
                        <option value="">---Select Group---</option>
                        <?php
                        foreach ($group as $m):
                            ?>
                            <option value="<?= $m['id']; ?>" <?php if ($video_manager['group_id'] == $m['id']) {
                                  echo "selected";} ?> >
                                <?= $m['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="menu">Note</label>
                    <input class="form-control" type="text" name="note" placeholder="note"
                        value="<?= $video_manager['note'] ?>" />
                </div>
                <!-- btn -->
                <input class="btn btn-success" type="submit" name="btn" value="Change" />
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->