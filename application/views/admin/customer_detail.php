<main style="margin-top: 58px">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h5>Detail Pemesanan</h5>
				<?php if (!empty($detail_pemesanan)): ?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal Order</th>
								<th>Total</th>
								<th>Status Pembayaran</th>
								<th>Alamat</th>
								<th>Ulasan</th>
								<th>Jumlah Rating</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($detail_pemesanan as $index => $pemesanan): ?>
								<tr>
									<td><?php echo $index + 1; ?></td>
									<td><?php echo $pemesanan['Tanggal_Order']; ?></td>
									<td><?php echo $pemesanan['Total']; ?></td>
									<td><?php echo $pemesanan['Status_Pembayaran']; ?></td>
									<td><?php echo $pemesanan['Alamat']; ?></td>
									<td><?php echo $pemesanan['Ulasan']; ?></td>
									<td><?php echo $pemesanan['Jumlah_Rating']; ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				<?php else: ?>
					<p>Tidak ada detail pemesanan untuk customer ini.</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</main>