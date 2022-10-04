<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">



        <!-- Main content -->
        <div class="invoice p-3 mb-3">
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <img style="width: 50px" src="<?= base_url('assets/img/' . $web->logo) ?>"> <?= $web->nama ?>
                <small class="float-right">Date : <?= $this->M_data->hari(date('D')) . ', ' . $this->M_data->tgl_indo(date('Y-m-d')); ?></small>
              </h4>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              From
              <address>
                <strong><?= $web->nama ?></strong><br>
                <?= $web->alamat ?><br>
                Phone: <?= $web->nohp ?><br>
                Email: <?= $web->email ?>
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              To
              <address>
                <strong><?= ucwords($data->nama) ?></strong><br>
                NIP : <?= $data->nip ?><br>
                Email: <?= $data->email ?><br>
                Departemen : <?= $data->departemen ?><br>
                Uang Makan : Rp. <?= number_format($data->u_makan) ?>/Hari<br>
                Uang Transport : Rp. <?= number_format($data->u_transport) ?>/Hari
              </address>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <!-- Table row -->
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped">
                <tr>
                  <th>Gaji Pokok :</th>
                  <td>Rp. <?= number_format($data->gaji_pokok) ?></td>
                </tr>
                <tr>
                  <th style="width:50%">Jumlah Kehadiran :</th>
                  <td><?= $absen ?> hari x Rp. <?= number_format($data->u_makan + $data->u_transport) ?></td>
                </tr>
                <tr>
                <tr>
                  <th>Jumlah Cuti :</th>
                  <td><?= $e ?> hari x Rp. <?= number_format($data->u_makan + $data->u_transport) ?></td>
                </tr>
                <tr>
                  <th>Jumlah Izin Tidak Masuk :</th>
                  <td><?= $g ?> hari x Rp. <?= number_format($data->u_makan + $data->u_transport) ?></td>
                </tr>
                <tr>
                  <th>Jumlah Sakit :</th>
                  <td><?= $f ?> hari</td>
                </tr>
                <tr>
                  <th>Total :</th>
                  <td>Rp. <?= number_format($absen * ($data->u_makan + $data->u_transport) - $g * ($data->u_makan + $data->u_transport) - $e * ($data->u_makan + $data->u_transport)) ?></td>
                </tr>
              </table>
            </div>
            <!-- /.col -->
          </div>

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-12">
              <a href="<?= base_url('pegawai/print_slip') ?>" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Print</a>
            </div>
          </div>
        </div>

        <!-- /.invoice -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section>