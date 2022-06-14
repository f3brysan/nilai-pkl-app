<style>
div.a {
text-align: center;
}
div.b {
text-align: left;
}
div.c {
text-align: right;
}
div.d {
text-align: justify;

}
.page_break {
		page-break-before: always;
	}
</style>
<style>
td.a {font-size: 12px;color: black;}
table.b {font-size: 14px;color: black;}
p.b {font-size: 14px;color: black;}
table.c {font-size: 13px;color: black;}
</style>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card-box table-responsive">
				<table width="100%" border="0">
					<tr>
						<td width="100%" align="center"><img src="assets/images/kop.png" alt="" width="680px""></td>
					</tr>
				</table>
				<div class="row">
					<div class="col-4 offset-4">
						<div class="col-md-4-2">
							<h4 align="center">Daftar Nilai Praktik Kerja Lapangan</h4>							
									<h4 class="b" align="center"><?php foreach ($detail as $d): ?>
                    <?php echo $d['nama'] ?>
                  <?php endforeach ?></h4>																		
						</div>
						</div><!-- end col -->										
						<hr>
						<!-- end row -->
						<div class="col-md-12">	
						<table width="100%" border="1" class="c">
                <thead>
                  <tr>
                    <th  width="3%" align="center">No</th>
                    <th width="5%">NIM</th>
                    <th width="15%">Nama Mahasiswa</th>
                    <th width="5%">Nilai Afektif</th>
                    <th width="5%">Nilai Kognitif</th>
                    <th width="5%">Nilai Psikomotor</th>
                    <th width="5%">Total Nilai</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (count($get) > 0): ?>
                  <?php $no = 1;
foreach ($get as $get): ?>
                  <tr>
                    <td align="right"><?php echo $no++; ?></td>
                    <td><?php echo $get['rel_nim'] ?></td>
                    <td><?php echo $get['nama_mhs'] ?></td>
                    <td align="center"><?php echo $get['lh_afektif'] ?></td>
                    <td align="center"><?php echo $get['lh_kognitif'] ?></td>
                    <td align="center"><?php echo $get['lh_psikomotor'] ?></td>
                    
                    <td align="center"><?php $total = $get['lh_afektif']+$get['lh_kognitif']+$get['lh_psikomotor']; ?>
                        <?php echo $total ?></td>
                  </tr>
                  <?php endforeach;?>                           
                </tbody>
                <?php else: ?>
                -
                <?php endif?>
              </table>				
					</div>
					<br>
					<div class="col-4 offset-4 page_break">
						<div class="col-md-4-2">
							<table>
  <tr>
  	<?php $date = date('Y-m-d')?>
    <td width="200"><div align="center"></div></td>
    <td width="100" rowspan="5">&nbsp;</td>
    <td width="200"><div align="center">Surabaya, <?php echo tanggal($date) ?></div></td>
  </tr>
  <tr>
    <td><div align="center"></div></td>
    <td><div align="center">Pihak <?php foreach ($detail as $dt): ?>
      <?php echo $dt['nama'] ?>
    <?php endforeach ?></div></td>
  </tr>
  <tr>
    <td height="50"><div align="center"></div></td>
    <td headers="50"><div align="center"></div></td>
  </tr>
  <!-- <tr>
    <td><div align="center"></div></td>
    <td><div align="center">(&nbsp;____________________&nbsp;)</div></td>
  </tr> -->
  <tr>
    <td><div align="center"></div></td>
    <td><div align="center">(&nbsp;____________________&nbsp;)</div></td>
  </tr>
</table>		
						</div>
						</div><!-- end col -->
				</div>


			</div>

				<!-- end row -->
				</div> <!-- container -->
				</div> <!-- content -->