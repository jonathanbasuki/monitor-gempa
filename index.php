<?php 

  function lastUpdate() {
    date_default_timezone_set('Asia/Jakarta');

    $date = date('d F Y H:i:s', time());
    return $date;
  }

 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">

    <title>Monitor Gempa | Info Gempabumi & Tsunami Terkini</title>

    <style>
      .highlight {
        border-radius: .3rem;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row my-3">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header bg-primary text-center text-light py-3">
              <h1 class="text-uppercase fw-light">Monitor Gempa</h1>
              <p>Informasi Terkini Gempabumi & Tsunami Indonesia</p>
              <p><em>Sumber: <a href="https://data.bmkg.go.id/gempabumi/" class="text-light">Badan Meteorologi, Klimatologi, dan Geofisika</a></em></p>
              <p>Last Update: <?= lastUpdate(); ?></p>
            </div>
            <div class="card-body">
              <h5 class="card-title fs-3 mb-3">Gempabumi M 5.0+ Terakhir</h5>
                <?php
                  $gempa = "https://data.bmkg.go.id/autogempa.xml";
                  $temp = file_get_contents($gempa);
                  $xml = simplexml_load_string($temp);

                  foreach($xml as $data) :
                ?>

                <div class="row d-flex align-items-center">
                  <div class="col-md-4 mb-2">
                    <div class="bg-success text-light p-3 highlight">
                      <h4 class="text-uppercase fw-light fs-3">Waktu</h4>
                      <b>
                        <p class="fs-5"><?= $data->Tanggal; ?> | <?= $data->Jam; ?></p>
                      </b>
                    </div>
                  </div>
                  <div class="col-md-4 mb-2">
                    <div class="bg-warning text-dark p-3 highlight">
                      <h4 class="text-uppercase fw-light fs-3">Potensi</h4>
                      <b>
                        <p class="fs-5"><?= $data->Potensi; ?></p>
                      </b>
                    </div>
                  </div>
                  <div class="col-md-4 mb-2">
                    <div class="bg-danger text-light p-3 highlight">
                      <h4 class="text-uppercase fw-light fs-3">Magnitude</h4>
                      <b>
                        <p class="fs-5"><?= $data->Magnitude; ?></p>
                      </b>
                    </div>
                  </div>
                  <div class="col-md-12 mb-4">
                    <div class="bg-info text-dark p-3 highlight">
                      <h4 class="text-uppercase fw-light fs-3">Wilayah</h4>
                      <div class="row p-1">
                        <div class="col-md-6">
                          <b>
                            <p class="mb-0">Terdekat:</p>
                            <ul>
                              <li><?= $data->Wilayah1 ?></li>
                              <li><?= $data->Wilayah2 ?></li>
                              <li><?= $data->Wilayah3 ?></li>
                              <li><?= $data->Wilayah4 ?></li>
                              <li><?= $data->Wilayah5 ?></li>
                            </ul>
                          </b>
                        </div>
                        <div class="col-md-3">
                          <b>
                            <p class="mb-0">Bujur: <?= $data->Bujur; ?></p>
                            <p class="mb-0">Lintang: <?= $data->Lintang; ?></p>
                            <p>Kedalaman: <?= $data->Kedalaman; ?></p>
                          </b>                         
                        </div>
                        <div class="col-md-3">
                          <img src="https://data.bmkg.go.id/eqmap.gif" width="200px" alt="Lokasi Gempa">              
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <?php endforeach; ?>

                <h5 class="card-title fs-3 mb-3">Gempabumi Berpotensi Tsunami Terakhir</h5>
                <?php
                  $source = "https://data.bmkg.go.id/lasttsunami.xml";
                  $temp = file_get_contents($source);
                  $xml = simplexml_load_string($temp);

                  foreach($xml as $data) :
                ?>

                <div class="row d-flex align-items-center">
                  <div class="col-md-4 mb-2">
                    <div class="bg-success text-light p-3 highlight">
                      <h4 class="text-uppercase fw-light fs-3">Waktu</h4>
                      <b>
                        <p class="fs-5"><?= $data->Tanggal; ?> | <?= $data->Jam; ?></p>
                      </b>
                    </div>
                  </div>
                  <div class="col-md-4 mb-2">
                    <div class="bg-warning text-dark p-3 highlight">
                      <h4 class="text-uppercase fw-light fs-3">Area</h4>
                      <b>
                        <p class="fs-5"><?= $data->Area; ?></p>
                      </b>
                    </div>
                  </div>
                  <div class="col-md-4 mb-2">
                    <div class="bg-danger text-light p-3 highlight">
                      <h4 class="text-uppercase fw-light fs-3">Magnitude</h4>
                      <b>
                        <p class="fs-5"><?= $data->Magnitude; ?></p>
                      </b>
                    </div>
                  </div>
                  <div class="col-md-12 mb-4">
                    <div class="bg-info text-dark p-3 highlight">
                      <h4 class="text-uppercase fw-light fs-3">Detail</h4>
                      <div class="row p-1">
                        <div class="col-md-6">
                          <b>
                            <p class="mb-0">Bujur: <?= $data->Bujur; ?></p>
                            <p class="mb-0">Lintang: <?= $data->Lintang; ?></p>
                            <p>Kedalaman: <?= $data->Kedalaman; ?></p>
                          </b>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end align-self-end">
                          <p><a href="<?= $data->Linkdetail ?>" class="fw-light text-dark fst-italic" target="_blank" rel="noopener noreferrer"><?= $data->Linkdetail ?></a></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <?php endforeach; ?>

                <h5 class="card-title fs-3 mb-3">Data Gempabumi Di Indonesia</h5>
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-striped data">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Tanggal</th>
                          <th>Posisi</th>
                          <th>Magnitude</th>
                          <th>Kedalaman</th>
                          <th>Keterangan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $gempa = "https://data.bmkg.go.id/gempadirasakan.xml";
                          $temp = file_get_contents($gempa);
                          $xml = simplexml_load_string($temp);
                          $index = 1;

                          foreach($xml as $data) :
                        ?>

                        <tr>
                          <td><?= $index++ ?></td>
                          <td><?= $data->Tanggal ?></td>
                          <td><?= $data->Posisi ?></td>
                          <td><?= $data->Magnitude ?></td>
                          <td><?= $data->Kedalaman ?></td>
                          <td><?= $data->Keterangan ?></td>
                        </tr>

                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
            <div class="card-footer text-muted text-center">
              &copy; <?= date('Y'); ?>, Jonathan Basuki.
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
    <script>
      $(document).ready(function() {
            $('table.data').DataTable({
              "scrollX": true
            });
        } );
    </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html>