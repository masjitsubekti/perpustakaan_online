<div class="row">
    <div class="col-md-3">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="media">
                    <div class="media-body">
                        <p class="text-muted font-weight-medium">Buku</p>
                        <h4 class="mb-0"><?= $buku['total_buku'] ?></h4>
                    </div>

                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                        <span class="avatar-title">
                            <i class="bx bx-copy-alt font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="media">
                    <div class="media-body">
                        <p class="text-muted font-weight-medium">Anggota</p>
                        <h4 class="mb-0"><?= $anggota['total_anggota'] ?></h4>
                    </div>

                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                        <span class="avatar-title">
                            <i class="bx bx-user font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="media">
                    <div class="media-body">
                        <p class="text-muted font-weight-medium">Jenis Koleksi</p>
                        <h4 class="mb-0"><?= $jenis_koleksi['total_jenis_koleksi'] ?></h4>
                    </div>

                    <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                        <span class="avatar-title rounded-circle bg-primary">
                            <i class="bx bx-purchase-tag-alt font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="media">
                    <div class="media-body">
                        <p class="text-muted font-weight-medium">Rak Buku</p>
                        <h4 class="mb-0"><?= $rak['total_rak'] ?></h4>
                    </div>

                    <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                        <span class="avatar-title rounded-circle bg-primary">
                            <i class="bx bx-archive-in font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
  <div class="col-md-8">
    <div id="line-chart"></div>
  </div>
  <div class="col-md-4">
    <div id="pie-chart"></div>
  </div>
</div>

<script>
  Highcharts.chart('line-chart', {
    chart: {
        type: 'spline'
    },
    title: {
        text: ' Grafik 7 Hari Terakhir'
    },
    credits: {
        enabled: false
    },
    subtitle: {
        text: 'Peminjaman dan Pengembalian'
    },
    xAxis: {
        categories: [
            <?php 
                for ($i=7-1; $i >= 0 ; $i--) { 
                    $tgl = date('Y-m-d',strtotime("-$i days"));
                    echo "'".tgl_indo($tgl)."',";
                }    
            ?>
        ]
    },
    yAxis: {
        title: {
            text: 'Jumlah Buku'
        },
        labels: {
            formatter: function () {
                return this.value + ' Buku';
                // return Highcharts.numberFormat(this.value,0);
            }
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [
      {
        name: 'Peminjaman',
        marker: {
            symbol: 'diamond'
        },
        data: [
            <?php 
                for ($i=7-1; $i >= 0 ; $i--) { 
                    $tgl = date('Y-m-d',strtotime("-$i days"));
                    $query = $this->db->query("
                                    select count(*) as jml from t_detail_peminjaman
                                    where tgl_pinjam = '$tgl' and status = '1'")->row_array();
                    
                    echo $query['jml'].",";
                }    
            ?>
        
        ]
      },
      {
        name: 'Pengembalian',
        marker: {
            symbol: 'square'
        },
        data: [
            <?php 
                for ($i=7-1; $i >= 0 ; $i--) { 
                    $tgl = date('Y-m-d',strtotime("-$i days"));
                    $query = $this->db->query("
                                    select count(*) as jml from t_pengembalian
                                    where tgl_pengembalian = '$tgl'")->row_array();
                    
                    echo $query['jml'].",";
                }    
            ?>
        
        ]
      }
    ]
  });

  Highcharts.chart('pie-chart', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Peminjaman Pada Bulan <?= get_bulan($bulan) ?>, <?= $tahun ?>'
    },
    credits: {
        enabled: false
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y:.0f} Buku</b>'
    },
    accessibility: {
        point: {
            valueSuffix: ''
        }
    },
    plotOptions: {
        pie: {
            colors: [
                '#DDDF00', 
                '#64E572', 
                '#ED561B', 
                '#24CBE5', 
                '#64E572', 
                '#FF9655', 
                '#FFF263', 
                '#50B432',
                '#6AF9C4'
            ],
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Jumlah',
        colorByPoint: true,
        data: [{
            name: 'Peminjaman',
            y: <?= $pie['peminjaman'] ?>,
            sliced: true,
            selected: true
        }, {
            name: 'Pengembalian',
            y: <?= $pie['pengembalian'] ?>
        }
        ]
    }]
  });
</script>