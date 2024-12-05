  <!--Main layout-->
  <main style="margin-top: 58px">
    <div class="container pt-4">

      <!--Section: Minimal statistics cards-->
      <section>
        <div class="row">
          <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    <h3 class="text-success">1000</h3>
                    <p class="mb-0">Total Workers</p>
                  </div>
                  <div class="align-self-center">
                    <i class="fas fa-user-tie text-success fa-3x"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    <h3 class="text-success">15</h3>
                    <p class="mb-0">Total Customers</p>
                  </div>
                  <div class="align-self-center">
                    <i class="fas fa-user text-success fa-3x"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    <h3 class="text-success">15</h3>
                    <p class="mb-0">Total Transactions</p>
                  </div>
                  <div class="align-self-center">
                    <i class="fas fa-money-check-dollar  text-success fa-3x"></i>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    <h3 class="text-success">15</h3>
                    <p class="mb-0">Total Services</p>
                  </div>
                  <div class="align-self-center">
                    <i class="fas fa-hand-holding-dollar text-success fa-3x"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--Section: Minimal statistics cards-->

      <!-- Section: Reviews -->
      <div class="container">
        <h5>Reviews</h5>
        <table class="table table-bordered" id="tabelku">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Description</th>
              <th>Foto</th>
              <th>Rating</th>
            </tr>
          </thead>
          <tbody>
            <!-- <?php foreach ($produk as $k => $v): ?>

            <tr>
              <td><?php echo $k +1; ?></td>
              <td><?php echo $v['nama_produk']; ?></td>
              <td><?php echo $v['harga_produk']; ?></td>
              <td>
                <img src="<?php echo $this->config->item("url_produk").$v["foto_produk"] ?>" width="200">
              </td>
              <td>
                <a href="" class="btn btn-info">Detail</a>
              </td>
            </tr>
            <?php endforeach ?> -->

          </tbody>
        </table>
        <a href="<?php echo base_url("member/tambah") ?>" class="btn btn-primary">Tambah Data</a>
      </div>

    </div>
  </main>
