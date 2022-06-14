<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=nilai.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

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

</style>
<style>
	.a {
		font-size: 10px;
		color: black;
		border: 1px solid #999;
		font-family: "Californian FB", AppleMyungjo;		
	}

	table.b {
		font-size: 14px;
		color: black;
	}

	p.b {
		font-size: 14px;
		color: black;
	}

	table.c {
		font-size: 10px;
		color: black;
		border: 1px solid #999;
		font-family: "Californian FB", AppleMyungjo;		
	}

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
				<div class=" row">
								<div class="col-4 offset-4">
									<div class="col-md-4-2">
										<h4 align="center">Daftar Nilai Praktik Kerja Lapangan</h4>

									</div>
								</div><!-- end col -->
								<hr>
								<!-- end row -->
								<div class="col-md-12">
									<table width="100%" class="c">
										<thead>
											<tr>
												<th class="a" width="3%" align="center">No</th>
												<th class="a" width="5%">NIM</th>
												<th class="a" width="17%">Nama Mahasiswa</th>
                                                <th class="a" width="15%">Nama Lahan PKL</th>
												<th class="a" width="5%">Nilai Afektif</th>
												<th class="a" width="5%">Nilai Kognitif</th>
												<th class="a" width="5%">Nilai Psikomotor</th>
												<th class="a" width="5%">Nilai Individu</th>
												<th class="a" width="5%">Nilai Seminar</th>
												<th class="a" width="5%">Nilai Proposal</th>
												<th class="a" width="5%">Total Nilai</th>
											</tr>
										</thead>
										<tbody>
											<?php if (count($get) > 0): ?>
											<?php $no = 1;
foreach ($get as $get): ?>
											<tr>
												<td class="a" align="right"><?php echo $no++; ?></td>
												<td class="a"><?php echo $get['rel_nim'] ?></td>
												<td class="a"><?php echo $get['nama_mhs'] ?></td>
                                                <td class="a"><?php echo $get['nama'] ?></td>
												<td class="a" align="center"><?php echo $get['lh_afektif'] ?></td>
												<td class="a" align="center"><?php echo $get['lh_kognitif'] ?></td>
												<td class="a" align="center"><?php echo $get['lh_psikomotor'] ?></td>
												<?php $ds_nilai = number_format(floatval($get['ds_afektif'])+floatval($get['ds_kognitif'])+floatval($get['ds_psikomotor']),2);?>
												<?php $lh_nilai = number_format(floatval($get['lh_afektif'])+floatval($get['lh_kognitif'])+floatval($get['lh_psikomotor']),2);?>
												<?php $sempol = number_format((floatval($get['seminar'])+floatval($get['laporan']))/2,2);?>
												<?php $n_dosen = number_format((floatval($sempol)+floatval($ds_nilai))/2,2); ?>
												<td class="a" align="center"><?php echo $ds_nilai; ?></td>
												<td class="a" align="center"><?php echo $get['seminar']?> </td>
												<td class="a" align="center"><?php echo $get['laporan']?></td>
												<td class="a" align="center">
													<?php $total = number_format(((floatval($lh_nilai))*0.7)+((floatval($n_dosen))*0.3),2); ?>
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

				</div><!-- end col -->
			</div>


		</div>

		<!-- end row -->
	</div> <!-- container -->
</div> <!-- content -->
