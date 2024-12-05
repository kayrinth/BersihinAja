<main style="margin-top: 58px">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h5>Detail Customer</h5>
				<table class="table table-bordered">
					<tr>
						<td>Email Customer</td>
						<td><?php echo isset($user['Email_User']) ? $user['Email_User'] : 'Data tidak tersedia'; ?></td>
					</tr>
					<tr>
						<td>Nama Customer</td>
						<td><?php echo isset($user['Nama_User']) ? $user['Nama_User'] : 'Data tidak tersedia'; ?></td>
					</tr>

					<tr>
						<td>Alamat Customer</td>
						<td><?php echo isset($user['Alamat_User']) ? $user['Alamat_User'] : 'Data tidak tersedia'; ?></td>
					</tr>
					<tr>
						<td>No.Hp Customer</td>
						<td><?php echo isset($user['No_Hp']) ? $user['No_Hp'] : 'Data tidak tersedia'; ?></td>
					</tr>
					
				</table>
			</div>



			
			<!-- <div class="col-md-8">
				<h5>Transaksi Jual</h5>
				<table class="table table-bordered" id="tabelku">
					<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Total</th>
									<th>Status</th>
						<th>Opsi</th>
					</tr>
					</thead>
					<tbody>
								<?php foreach ($jual as $k => $v): ?>

					<tr>
						<td><?php echo $k +1; ?></td>
						<td><?php echo $v['tanggal_transaksi'];?></td>
						<td><?php echo $v['total_transaksi']; ?></td>
						<td><?php echo $v['status_transaksi']; ?></td>
						<td>
						<a href="<?php echo base_url("transaksi/detail/".$v["id_transaksi"]) ?>" class="btn btn-info">Detail</a>
						</td>
					</tr>
								<?php endforeach ?>
					</tbody>
				</table>
				
				<h5>Transaksi Beli</h5>
					<table class="table table-bordered" id="tabelku">
						<thead>
						<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>Total</th>
										<th>Status</th>
							<th>Opsi</th>
						</tr>
						</thead>
						<tbody>
									<?php foreach ($beli as $k => $v): ?>

						<tr>
							<td><?php echo $k +1; ?></td>
							<td><?php echo $v['tanggal_transaksi'];?></td>
							<td><?php echo $v['total_transaksi']; ?></td>
							<td><?php echo $v['status_transaksi']; ?></td>
							<td>
							<a href="<?php echo base_url("transaksi/detail/".$v["id_transaksi"]) ?>" class="btn btn-info">Detail</a>
							</td>
						</tr>
									<?php endforeach ?>
						</tbody>
					</table>
				
			</div> -->
		</div>
	</div>
</main>