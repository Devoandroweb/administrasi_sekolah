@extends('template/template',['active' => $active ?? '1','title' => $title])




@section('content')
<?php

use App\Helpers\Time;


?>

<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header card-header-icon card-header-rose">
        <div class="card-icon p-4">
          <i class="fas fa-user-graduate fa-4x"></i>
        </div>
        <div class="text-right">
          <h5 class="card-title">Siswa Aktif</h5>
          <h4 class="text-dark font-weight-bold"><?php echo $total_siswa ?> Siswa</h4>
        </div>

      </div>
      <div class="card-body">
        <hr class="m-0">
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">access_time</i><?php
                                                    if ($max_date_siswa != null) {
                                                      if ($max_date_siswa->updated_at == null) {
                                                        $date = Time::time_indo_convert(strtotime($max_date_siswa->created_at));
                                                      } else {
                                                        $date = Time::time_indo_convert(strtotime($max_date_siswa->updated_at));
                                                      }

                                                      echo 'Update terakhir ' . $date[0];
                                                    }
                                                    ?>
        </div>
      </div>
    </div>
  </div>
  {{--<div class="col-md-3">
    <div class="card">
      <div class="card-header card-header-icon card-header-info">
        <div class="card-icon p-4">
          <i class="fas fa-graduation-cap fa-4x"></i>
        </div>
        <div class="text-right">
          <h5 class="card-title">Alumni</h5>
          <h4 class="text-dark font-weight-bold"><?php echo $total_siswa_alumni ?> Siswa</h4>
        </div>

      </div>
      <div class="card-body">
        <hr class="m-0">
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">access_time</i><?php
                                                    if ($max_date_siswa != null) {
                                                      if ($max_date_siswa->updated_at == null) {
                                                        $date = Time::time_indo_convert(strtotime($max_date_siswa->created_at));
                                                      } else {
                                                        $date = Time::time_indo_convert(strtotime($max_date_siswa->updated_at));
                                                      }

                                                      echo 'Update terakhir ' . $date[0];
                                                    }
                                                    ?>
        </div>
      </div>
    </div>
  </div>--}}
  <div class="col-md-4">
    <div class="card">
      <div class="card-header card-header-icon card-header-danger">
        <div class="card-icon p-4">
          <i class="fas fa-arrow-up fa-4x"></i>
        </div>
        <div class="text-right">
          <h5 class="card-title">Pengeluaran</h5>
          <h4 class="text-dark font-weight-bold linumeric" data-a-dec=".">{{ $data_pengeluaran }}</h4>
        </div>

      </div>
      <div class="card-body">
        <hr class="m-0">
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">access_time</i><?php

                                                    if ($max_date_pengeluaran != null) {
                                                      if ($max_date_pengeluaran->updated_at == null) {
                                                        $date = Time::time_indo_convert(strtotime($max_date_pengeluaran->created_at));
                                                      } else {
                                                        $date = Time::time_indo_convert(strtotime($max_date_pengeluaran->updated_at));
                                                      }

                                                      echo 'Update terakhir ' . $date[0];
                                                    }

                                                    ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-header card-header-icon card-header-success">
        <div class="card-icon p-4">
          <i class="fas fa-arrow-down fa-4x"></i>
        </div>
        <div class="text-right">
          <h5 class="card-title">Pemasukan</h5>
          <h4 class="text-dark font-weight-bold linumeric" data-a-dec=".">{{ $total_pemasukan_all }}</h4>
        </div>

      </div>
      <div class="card-body">
        <hr class="m-0">
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">access_time</i> <?php
                                                    if ($max_date_pemasukan != null) {
                                                      if ($max_date_pemasukan->updated_at == null) {
                                                        $date = Time::time_indo_convert(strtotime($max_date_pemasukan->created_at));
                                                      } else {
                                                        $date = Time::time_indo_convert(strtotime($max_date_pemasukan->updated_at));
                                                      }

                                                      echo 'Update terakhir ' . $date[0];
                                                    }
                                                    ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- card statistik -->
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header card-chart card-header-success">
        <div class="ct-chart"></div>
      </div>
      <div class="card-body">
        <h4 class="card-title">Statistik Pemasukan</h4>
        <p class="card-category "><span class="alert-pemasukan"></p>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">access_time</i> <?php
                                                    if ($max_date_pemasukan != null) {
                                                      if ($max_date_pemasukan->updated_at == null) {
                                                        $date = Time::time_indo_convert(strtotime($max_date_pemasukan->created_at));
                                                      } else {
                                                        $date = Time::time_indo_convert(strtotime($max_date_pemasukan->updated_at));
                                                      }

                                                      echo 'Update terakhir ' . $date[0];
                                                    }
                                                    ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header card-chart card-header-warning">
        <div class="ct-chart" id="ct-chart2"></div>
      </div>
      <div class="card-body">
        <h4 class="card-title">Statistik Pengeluaran</h4>
        <p class="card-category"><span class="alert-pengeluaran"></p>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">access_time</i> <?php

                                                    if ($max_date_pengeluaran != null) {
                                                      if ($max_date_pengeluaran->updated_at == null) {
                                                        $date = Time::time_indo_convert(strtotime($max_date_pengeluaran->created_at));
                                                      } else {
                                                        $date = Time::time_indo_convert(strtotime($max_date_pengeluaran->updated_at));
                                                      }

                                                      echo 'Update terakhir ' . $date[0];
                                                    }

                                                    ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- tabel -->

<div class="card card-nav-tabs">
  <div class="card-header card-header-info  text-center">
    <h4 class="font-weight-bold m-0">Data Pemasukan Terakhir</h4>
  </div>
  <div class="card-body">
    <table class="table" style="width: 100%">
      <thead>
        <tr>
          <th class="text-center font-weight-bold">#</th>
          <th class="font-weight-bold">Tanggal</th>
          <th class="font-weight-bold">Nama</th>
          <th class="font-weight-bold">Kelas</th>
          <th class="text-right font-weight-bold">Uraian</th>
          <th class="text-right font-weight-bold">Total</th>
        </tr>
      </thead>
      <tbody>

        @if(count($data_pemasukan) != 0)
        <?php



        for ($i = 0; $i < count($data_pemasukan); $i++) {

        ?>

          <tr>
            <td><?= $i + 1 ?></td>
            <td><?php $date_indo = Time::time_indo_convert(strtotime($data_pemasukan[$i]->created_at));
                echo $date_indo[0]; ?></td>

            <td><?= $data_pemasukan[$i]->nama ?></td>
            <td><?= $data_pemasukan[$i]->kelas . " " . $data_pemasukan[$i]->rombel ?></td>
            <td><?php
                $uraian = json_decode($data_pemasukan[$i]->uraian);

                $html = "<ul style='display:contents;'>";

                if ($uraian->spp != "") {
                  $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>SPP</label><span class='linumeric float-right'>" . $uraian->spp . "</span>";
                }
                if ($uraian->psb != "") {
                  $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>PSB</label><span class='linumeric float-right'>" . $uraian->psb . "</span>";
                }
                if ($uraian->uts_1 != "") {
                  $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>UTS 1</label><span class='linumeric float-right'>" . $uraian->uts_1 . "</span>";
                }
                if ($uraian->uts_2 != "") {
                  $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>UTS 2</label><span class='linumeric float-right'>" . $uraian->uts_2 . "</span>";
                }
                if ($uraian->pas_1 != "") {
                  $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>PAS 1</label><span class='linumeric float-right'>" . $uraian->pas_1 . "</span>";
                }
                if ($uraian->pas_2 != "") {
                  $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>PAS 2</label><span class='linumeric float-right'>" . $uraian->pas_2 . "</span>";
                }
                if ($uraian->lks_1 != "") {
                  $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>LKS 1</label><span class='linumeric float-right'>" . $uraian->lks_1 . "</span>";
                }
                if ($uraian->lks_2 != "") {
                  $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>LKS 2</label><span class='linumeric float-right'>" . $uraian->lks_2 . "</span>";
                }
                $html .= "</li></ul>";
                echo $html;
                ?></td>
            <td class="linumeric font-weight-bold" style="text-align:right;" data-a-dec="."><?php

                                                                                            $uraian = json_decode($data_pemasukan[$i]->uraian);
                                                                                            $total = 0;
                                                                                            $total = $total + intval($uraian->spp);
                                                                                            $total = $total + intval($uraian->psb);
                                                                                            $total = $total + intval($uraian->uts_1);
                                                                                            $total = $total + intval($uraian->uts_2);
                                                                                            $total = $total + intval($uraian->pas_1);
                                                                                            $total = $total + intval($uraian->pas_2);
                                                                                            $total = $total + intval($uraian->lks_1);
                                                                                            $total = $total + intval($uraian->lks_2);
                                                                                            echo $total;
                                                                                            ?></td>


          </tr>
        <?php
        }
        ?>

        @endif

      </tbody>
    </table>


  </div>
</div>

@endsection