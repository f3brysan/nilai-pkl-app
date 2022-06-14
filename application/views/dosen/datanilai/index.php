<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Nilai Mahasiswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('instansi') ?>">Home</a></li>
              <li class="breadcrumb-item active">Data Nilai Mahasiswa</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Nilai</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
          <!-- <div class="text-right">
            <a href="<?php echo site_url('instansi_datanilai/print_nilai') ?>" class="btn btn-success waves-effect waves-light"><i class="fa fa-print m-r-5"></i> Cetak Hasil Nilai</a>
                    </div> -->
        </div>
        <div class="card-body">
          <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Lahan PKL</th>
                    <th>Nilai Afektif</th>
                    <th>Nilai Kognitif</th>
                    <th>Nilai Psikomotor</th>
                    <th>Nilai Laporan</th>
                    <th>Nilai Seminar</th>                    
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
            <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Lahan PKL</th>
                    <th>Nilai Afektif</th>
                    <th>Nilai Kognitif</th>
                    <th>Nilai Psikomotor</th>
                    <th>Nilai Laporan</th>
                    <th>Nilai Seminar</th>                    
                    <th style="width:125px;">Action</th>
            </tr>
            </tfoot>
        </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
    <!-- /.modal -->
  </div>
  <div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                    <div class="form-group">
                            <label class="control-label col-md-3">NIM</label>
                            <div class="col-md-9">
                                <input name="rel_nim" placeholder="Last Name" class="form-control" type="text" disabled="">
                                <span class="help-block"></span>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Mahasiswa</label>
                            <div class="col-md-9">
                                <input name="nama_mhs" placeholder="Last Name" class="form-control" type="text" disabled="">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nilai Afektif</label>
                            <div class="col-md-9">
                                <input name="ds_afektif" placeholder="" id="afektif" class="form-control" type="number" maxlength="3">
                                <p id="alert_afektif"></p>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nilai Kognitif</label>
                            <div class="col-md-9">
                                <input name="ds_kognitif" placeholder="" id="kognitif" class="form-control" type="number" maxlength="3">
                                <p id="alert_kognitif"></p>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nilai Psikomotor</label>
                            <div class="col-md-9">
                                <input name="ds_psikomotor" placeholder="" id="psikomotor" class="form-control" type="number" maxlength="3">
                                <p id="alert_psikomotor"></p>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nilai Laporan</label>
                            <div class="col-md-9">
                                <input name="laporan" placeholder="" id="laporan" class="form-control" type="number" maxlength="3">
                                <p id="alert_laporan"></p>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nilai Seminar</label>
                            <div class="col-md-9">
                                <input name="seminar" placeholder="" id="seminar" class="form-control" type="text">
                                <p id="alert_seminar"></p>
                                <span class="help-block"></span>
                            </div>
                        </div>                                              
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
  <!-- /.content-wrapper -->
