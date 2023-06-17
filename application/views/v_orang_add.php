<main role="main" class="container">

    <div class="container pt-5">
        <h3><?= $title ?></h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a>Orang</a></li>
                <li class="breadcrumb-item "><a href="<?= base_url('orang'); ?>">List Data</a></li>
                <li class="breadcrumb-item active" aria-current="orang">Add Data</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                        //create form
                        $attributes = array('id' => 'FrmAddOrang', 'method' => "post", "autocomplete" => "off");
                        echo form_open('', $attributes);
                        ?>
                        <div class="form-group row">
                            <label for="Nama_orang" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="Nama_orang" name="Nama_orang" value="<?= set_value('Nama_orang'); ?>">
                                <small class="text-danger">
                                    <?php echo form_error('Nama_orang') ?>
                                </small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_telp" class="col-sm-2 col-form-label">No. Telp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= set_value('no_telp'); ?>">
                                <small class="text-danger">
                                    <?php echo form_error('no_telp') ?>
                                </small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="link_sebar" class="col-sm-2 col-form-label">Link</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="link_sebar" name="link_sebar" value="<?= set_value('link_sebar'); ?>">
                                <small class="text-danger">
                                    <?php echo form_error('link_sebar') ?>
                                </small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10 offset-md-2">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a class="btn btn-secondary" href="javascript:history.back()">Kembali</a>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>