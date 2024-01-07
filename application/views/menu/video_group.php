<script>
    function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if (validation_errors()) : ?>
    <div class="alert alert-danger" role="alert">
        <?= validation_errors(); ?>
    </div>
    <?php endif; ?>

    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="" data-toggle="modal" data-target="#newSubmenuModal"><i class="fas fa-plus"></i> Add Group</a></h6>
        </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Name Group</th>
                                    <th>Action</th>
                                </tr>
                        </thead>
                    <tbody>
                        <?php $index = 1; ?>
                        <?php foreach($video_group as $sm) : ?>
                            <tr>
                                <td><?= $index; ?></td>
                                <td><?= $sm['name']; ?></td>
                                <td>
                                    <a class="badge badge-success" style="font-size:14px;" href="<?= site_url('menu/edit_video_group/'.$sm['id']); ?>">Update</a>
                                    <a class="badge badge-danger" style="font-size:14px;" href="#!" onclick="deleteConfirm('<?= site_url('menu/delet_video_group/'.$sm['id']); ?>')">Delete</a>
                                </td>
                            </tr>
                        <?php $index++; ?>
                        <?php endforeach; ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal add new submenu-->
<div class="modal fade" id="newSubmenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubmenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubmenuModalLabel">Add New Group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- form -->
      <form action="<?= site_url('menu/addvideo_group'); ?>" method="post">
        <div class="modal-body">
            <div class="form-group">
                <input type="text" class="form-control" id="groupname" name="groupname" placeholder="Video Group">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Deleted data cannot be recovered!</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a id="btn-delete" class="btn btn-danger" href="#">Remove</a>
      </div>
    </div>
  </div>
</div>