<main style="margin-top: 58px">
  <div class="container">
        <h5>Customer</h5>
        <table class="table table-bordered" id="tabelku">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Email</th>
              <th>No. Hp</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($customer as $k => $v): ?>
              <?php if (isset($v['Role_Id']) && $v['Role_Id'] == "customer"): ?>
                <tr>
                  <td><?php echo $k + 1; ?></td>
                  <td><?php echo htmlspecialchars($v['Nama_User']); ?></td>
                  <td><?php echo htmlspecialchars($v['Email_User']); ?></td>
                  <td><?php echo htmlspecialchars($v['No_Hp']); ?></td>
                  <td>
                    <a href="<?php echo base_url("pekerja/customer/detail/" . $v['Id_User']); ?>" class="btn btn-info">Detail</a>
                  </td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
  </div>
</main>
