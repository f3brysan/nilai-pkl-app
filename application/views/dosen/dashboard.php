  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">              
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php foreach ($jml_mhs as $jml_mhs): ?>
                  <h3><?php echo $jml_mhs['jml_mhs'] ?></h3>
                <?php endforeach ?>
                

                <p>Mahasiswa</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="<?php echo site_url('dosen_datanilai') ?>" class="small-box-footer">Enter  <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->                              
        </div>
        <div class="row">
          <div class="col-12">
            <div class="col-md-12">
              <div class="card-box">
                <h4 class="header-title m-t-0 m-b-30">Aspek/Sasaran Penilaian</h4>

                <ul class="nav nav-pills navtab-bg nav-justified pull-in ">
                  <li class="nav-item">
                    <a href="#home1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                      <i class="fi-eye mr-2"></i> Afektif
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#profile1" data-toggle="tab" aria-expanded="false" class="nav-link">
                      <i class="fi-file mr-2"></i> Kognitif
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#messages1" data-toggle="tab" aria-expanded="false" class="nav-link">
                      <i class="fi-mail mr-2"></i> Psikomotor
                    </a>
                  </li> 
                </ul>
                <div class="tab-content">
                  <div class="tab-pane show active" id="home1">
                    <h5>Penilaian Afektif</h5>
                    <li>a. Pengetahuan & Penguasaan Materi.</li>
                    <li>b. Kemampuan Pemahaman Materi.</li>
                    <li>c. Kemampuan Mengaplikasikan.</li>
                    <li>d. Kemampuan Menganalisis & Mengevaluasi.</li>
                    <li>e. Ketepatan Menjawab.</li>
                    <li>f. Kemampuan Berfikir Rasional</li>                
                    <br>                
                  </div>
                  <div class="tab-pane" id="profile1">
                    <h5>Penilaian Kognitif</h5>
                    <li>a. Kejujuran.</li>
                    <li>b. Kebersihan & Kerapian.</li>
                    <li>c. Disiplin & Tanggung Jawab.</li>
                    <li>d. Tanggap.</li>               
                    <br>                
                  </div>
                  <div class="tab-pane" id="messages1">
                    <h5>Penilaian Psikomotor</h5>
                    <li>a. Kemampuan mempraktekkan sesuai dengan teori.</li>
                    <li>b. Kemampuan mengerjakan & membuat.</li>
                    <li>c. Disiplin & Tanggung Jawab.</li>                              
                    <br>                
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- end col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  