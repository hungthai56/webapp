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
    <div class="col-md-12 mb-3">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <?php $lang_view = "media/infowebsite?lang=".$lang;  ?>
                <?= form_open_multipart($lang_view); ?>
                    <input type="hidden" name="id" id="id" value="<?= $info['id']; ?>" />
                    <div class="form-group row">
                        <div class="col-sm-2">
                        Logo Web
                        </div>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img style="height: 100px;" src="<?= base_url('assets/img/info/') . $info['logo']; ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="logo" name="logo">
                                        <label class="custom-file-label" for="logo">Insert File</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Slogan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="slogan" name="slogan" value="<?= $info['slogan']; ?>">
                            <?= form_error('slogan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                        Avt Web
                        </div>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img style="height: 100px;" src="<?= base_url('assets/img/info/') . $info['avt']; ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="avt" name="avt">
                                        <label class="custom-file-label" for="avt">Insert File</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" value="<?= $info['email']; ?>">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="phone" name="phone" value="<?= $info['phone']; ?>">
                            <?= form_error('phone', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Text Footer</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="text_footer" name="text_footer" value="<?= $info['text_footer']; ?>">
                            <?= form_error('text_footer', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Map</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="map" name="map" value="<?= $info['map']; ?>">
                            <?= form_error('map', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Title Install Footer</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="titleinstall" name="titleinstall" value="<?= $info['titleinstall']; ?>">
                            <?= form_error('titleinstall', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                        Image install footer
                        </div>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img style="height: 100px;" src="<?= base_url('assets/img/info/') . $info['imageinstall']; ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="imageinstall" name="imageinstall">
                                        <label class="custom-file-label" for="imageinstall">Insert File</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Change</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
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
      <div class="modal-body">Deleted accounts cannot be recovered!</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a id="btn-delete" class="btn btn-danger" href="#">Remove</a>
      </div>
    </div>
  </div>
</div>