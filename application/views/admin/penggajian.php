    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

          <section class="col-lg-12 connectedSortable">

            <!-- Map card -->
            <div class="card">
              <div class="card-header"> <?= $title ?> </h3>
              </div>
              <div class="card-body table-responsive">
                <table border="1" id="myTable" class="table table-bordered table-striped text-center">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIP</th>
                      <th>Nama</th>
                      <th>Hadir</th>
                      <th>Cuti</th>
                      <th>Izin</th>
                      <th>Sakit</th>
                      <th>Gaji Pokok</th>
                      <th>Uang Makan</th>
                      <th>Uang Transport</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $no = 1;
                    foreach ($list as $data) {
                      $tahun  = date('Y');
                      $bulan  = date('m');
                      $jumlah = 0;
                      $stotal = 0;
                      $absen  = $this->M_data->absenbulan($data->nip, $tahun, $bulan)->num_rows();
                      $cuti   = $this->M_data->cutibulanb($data->nip, $tahun, $bulan)->num_rows();
                      $sakit  = $this->M_data->sakitbulanb($data->nip, $tahun, $bulan)->num_rows();
                      $izin   = $this->M_data->izinbulanb($data->nip, $tahun, $bulan)->num_rows();
                      $u_makan   = ($absen * $data->u_makan) - ($izin * $data->u_makan) - ($cuti * $data->u_makan);
                      $u_transport   = ($absen * $data->u_transport) - ($izin * $data->u_makan) - ($cuti * $data->u_makan);
                      //var_dump($cuti);
                      //hitung hari cuti
                    ?>
                      <tr>
                        <td width="1%"><?= $no++ ?></td>
                        <td><?= ucfirst($data->nip) ?></td>
                        <td><?= ucfirst($data->nama) ?></td>
                        <td><?= $absen ?></td>
                        <td><?= $cuti ?></td>
                        <td><?= $izin ?></td>
                        <td><?= $sakit ?></td>
                        <td>Rp. <?= number_format($data->gaji_pokok) ?></td>
                        <td>Rp. <?= number_format($u_makan) ?></td>
                        <td>Rp. <?= number_format($u_transport) ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>