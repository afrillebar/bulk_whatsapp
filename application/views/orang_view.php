<main role="main" class="container">
    <div class="container pt-5">
        <h3><?= $title ?></h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a>Mahasiswa</a></li>
                <li class="breadcrumb-item active" aria-current="orang">List Data</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-primary mb-2" href="<?= base_url('mahasiswa/insert_dummy'); ?>">Buat Data Dummy</a>
                <a href="#" type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#modal-add"><i class="fas fa-pencil-alt"></i> </a>
                <div mb-2>
                    <!-- Menampilkan flashh data (pesan saat data berhasil disimpan)-->
                    <?php if ($this->session->flashdata('message')) :
                        echo $this->session->flashdata('message');
                    endif; ?>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tableMahasiswa">
                                <thead>
                                    <tr class="table-success">
                                        <th></th>
                                        <th>NAMA</th>
                                        <th>ALAMAT</th>
                                        <th>EMAIL</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal add -->
    <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modal-add" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?php echo site_url('mahasiswa/add'); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-add">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="Nama" class="form-control" placeholder="Tambah Nama">
                        </div>

                        <div class="form-group">
                            <label>Fakultas</label>
                            <input type="text" name="Alamat" class="form-control" placeholder="Tambah Alamat">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="Email" class="form-control" placeholder="Tambah Email">
                        </div>
                    </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Add</button>
            </div>
        </div>
    </div>
    </div>

    <!-- modal edit -->
    <?php foreach ($data_orang as $row) : ?>
        <div class="modal fade" id="modal-edit<?= $row->id_orang; ?>" tabindex="-1" aria-labelledby="modal-edit" aria-hidden="true">
            <div class="modal-dialog">
                <form action="<?php echo site_url('crud/edit'); ?>" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-edit">Konfirmasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?php echo $row->id_orang; ?>">

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" value="<?php echo $row->Nama; ?>">
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" name="Alamat" class="form-control" value="<?php echo $row->Alamat; ?>">
                            </div>
                        </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Edit</button>
                </div>
            </div>
        </div>
        </div>
    <?php endforeach; ?>

    <!-- Modal dialog hapus data-->
    <div class="modal fade" id="myModalDelete" tabindex="-1" aria-labelledby="myModalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalDeleteLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Anda ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-danger" id="btdelete">Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    //setting datatables
    $('#tableMahasiswa').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        },
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            //panggil method ajax list dengan ajax
            "url": 'orang/ajax_list',
            "type": "POST"
        }
    });

    $('#tableMahasiswa').on('click', '.item-delete', function() {
        //ambil data dari atribute data 
        var id = $(this).attr('data');
        $('#myModalDelete').modal('show');
        //ketika tombol lanjutkan ditekan, data id akan dikirim ke method delete 
        //pada controller mahasiswa
        $('#btdelete').unbind().click(function() {
            $.ajax({
                type: 'ajax',
                method: 'get',
                async: false,
                url: '<?php echo base_url() ?>crud/delete/',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    $('#myModalDelete').modal('hide');
                    location.reload();
                }
            });
        });
    });
</script>