<section class="content">
  <div class="container-fluid">
    <!-- Main row -->
    <div class="row">

      <section class="col-lg-6 connectedSortable">

        <!-- Map card -->
        <div class="card">
          <div class="card-header"> Notifikasi </h3>
          </div>
          <form method="post" action="pegawai/proses_absen">
            <div class="card-body">
              <?php if ($waktu != 'dilarang') { ?>
                <p class="text-center">Hai, <b><?= $this->session->userdata('nama') ?></b> Silahkan lakukan absen <b><?= $waktu ?></b><br><br><button class="btn btn-primary">Absen <?= $waktu ?></button></p>
                <input type="hidden" name="ket" id="ket" value="<?= $waktu ?>">
              <?php } else { ?>
                <p class="text-center">Hai, <b><?= $this->session->userdata('nama') ?></b>, anda tidak dapat melakukan absen masuk, </b><br>
                <?php }  ?>
            </div>
          </form>
        </div>
      </section>

      <section class="col-lg-6 connectedSortable">

        <!-- Map card -->
        <div class="card">
          <div class="card-header"> Slip Gaji </h3>
          </div>
          <div class="card-body">

            <p class="text-center">Hai, <b><?= $this->session->userdata('nama') ?></b> silahkan download slip gaji anda pada tombol berikut <br><br><a class="btn btn-info" href="<?= base_url('pegawai/slip') ?>">Download Slip Gaji</a></p>
          </div>
        </div>
      </section>

    </div>
  </div>
</section>