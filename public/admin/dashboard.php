<?php

$title = 'Home';

require '../../src/app.php';

require '../../layouts/header.php';

require '../../layouts/navAdmin.php';


// logic backend

// mengambil angka pengaduan dari database
$res_pengaduan = mysqli_query($conn, "SELECT COUNT(*) as total FROM pengaduan");
$row_pengaduan = mysqli_fetch_assoc($res_pengaduan);
$total_pengaduan = $row_pengaduan['total'];

// mengambil angka tanggapan dari database
$res_tanggapan = mysqli_query($conn, "SELECT COUNT(*) as total FROM tanggapan");
$row_tanggapan = mysqli_fetch_assoc($res_tanggapan);
$total_tanggapan = $row_tanggapan['total'];

// mengambil angka akun masyarakat dari database
$res_masyarakat = mysqli_query($conn, "SELECT COUNT(*) as total FROM masyarakat");
$row_masyarakat = mysqli_fetch_assoc($res_masyarakat);
$total_masyarakat = $row_masyarakat['total'];

// Status counts for pie chart
$res_proses = mysqli_query($conn, "SELECT COUNT(*) as total FROM pengaduan WHERE status = 'proses'");
$total_proses = (int)mysqli_fetch_assoc($res_proses)['total'];

$res_selesai = mysqli_query($conn, "SELECT COUNT(*) as total FROM pengaduan WHERE status = 'selesai'");
$total_selesai = (int)mysqli_fetch_assoc($res_selesai)['total'];

$res_pending = mysqli_query($conn, "SELECT COUNT(*) as total FROM pengaduan WHERE status = '0'");
$total_pending = (int)mysqli_fetch_assoc($res_pending)['total'];

// Daily reports for line chart
$res_daily = mysqli_query($conn, "SELECT tgl_pengaduan, COUNT(*) as total FROM pengaduan GROUP BY tgl_pengaduan ORDER BY tgl_pengaduan DESC LIMIT 7");
$daily_dates = [];
$daily_counts = [];
while ($row = mysqli_fetch_assoc($res_daily)) {
    $daily_dates[] = $row['tgl_pengaduan'];
    $daily_counts[] = (int)$row['total'];
}
$daily_dates = array_reverse($daily_dates);
$daily_counts = array_reverse($daily_counts);

?>

<div class="row animate-fade-in-up mb-4">
  <div class="col-12 mb-2">
    <div class="d-flex align-items-center">
      <i class="fas fa-chart-line text-primary fs-3 mr-3"></i>
      <h2 class="text-dark font-weight-bold mb-0">Ringkasan Statistik Portal</h2>
    </div>
    <p class="text-secondary small mt-1">Status dan jumlah data laporan terkini pada sistem Pengaduan Masyarakat.</p>
  </div>
</div>

<div class="row animate-fade-in-up">
  <!-- Card Pengaduan -->
  <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="300">
    <div class="card stat-card stat-card-primary py-3">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col ml-2">
            <div class="text-xs font-weight-bold text-white-50 text-uppercase mb-1">Total Pengaduan</div>
            <div class="h2 mb-0 font-weight-bold text-white"><?= $total_pengaduan; ?></div>
          </div>
          <div class="col-auto mr-2">
            <i class="fas fa-comments fa-3x text-white" style="opacity: 0.35;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Card Tanggapan -->
  <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="500">
    <div class="card stat-card stat-card-secondary py-3">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col ml-2">
            <div class="text-xs font-weight-bold text-white-50 text-uppercase mb-1">Tanggapan Diberikan</div>
            <div class="h2 mb-0 font-weight-bold text-white"><?= $total_tanggapan; ?></div>
          </div>
          <div class="col-auto mr-2">
            <i class="fas fa-reply-all fa-3x text-white" style="opacity: 0.35;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Card Akun Masyarakat -->
  <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="700">
    <div class="card stat-card stat-card-dark py-3">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col ml-2">
            <div class="text-xs font-weight-bold text-white-50 text-uppercase mb-1">Masyarakat Terdaftar</div>
            <div class="h2 mb-0 font-weight-bold text-white"><?= $total_masyarakat; ?></div>
          </div>
          <div class="col-auto mr-2">
            <i class="fas fa-users fa-3x text-white" style="opacity: 0.35;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Charts Section -->
<div class="row animate-fade-in-up mt-2">
  <!-- Area/Line Chart -->
  <div class="col-xl-8 col-lg-7 mb-4">
    <div class="card shadow-sm border-0 h-100">
      <div class="card-header bg-white py-3 border-0">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-area mr-2"></i>Tren Laporan Masuk</h6>
      </div>
      <div class="card-body">
        <div style="position: relative; height: 300px;">
          <canvas id="myAreaChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Doughnut/Pie Chart -->
  <div class="col-xl-4 col-lg-5 mb-4">
    <div class="card shadow-sm border-0 h-100">
      <div class="card-header bg-white py-3 border-0">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-pie mr-2"></i>Status Pengaduan</h6>
      </div>
      <div class="card-body d-flex flex-column justify-content-between">
        <div style="position: relative; height: 220px;">
          <canvas id="myPieChart"></canvas>
        </div>
        <div class="text-center small mt-4">
          <span class="mr-3 font-weight-bold">
            <i class="fas fa-circle text-warning mr-1"></i> Proses (<?= $total_proses; ?>)
          </span>
          <span class="mr-3 font-weight-bold">
            <i class="fas fa-circle text-success mr-1"></i> Selesai (<?= $total_selesai; ?>)
          </span>
          <?php if ($total_pending > 0) : ?>
          <span class="font-weight-bold">
            <i class="fas fa-circle text-secondary mr-1"></i> Pending (<?= $total_pending; ?>)
          </span>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  window.addEventListener('load', function() {
    // Area Chart Setup
    var ctxArea = document.getElementById("myAreaChart");
    if(ctxArea) {
      new Chart(ctxArea, {
        type: 'line',
        data: {
          labels: <?= json_encode($daily_dates); ?>,
          datasets: [{
            label: "Jumlah Pengaduan",
            lineTension: 0.3,
            backgroundColor: "rgba(79, 70, 229, 0.05)",
            borderColor: "#4f46e5",
            pointRadius: 4,
            pointBackgroundColor: "#4f46e5",
            pointBorderColor: "#ffffff",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "#4f46e5",
            pointHoverBorderColor: "#ffffff",
            pointHitRadius: 15,
            pointBorderWidth: 2,
            data: <?= json_encode($daily_counts); ?>,
          }],
        },
        options: {
          maintainAspectRatio: false,
          layout: {
            padding: { left: 10, right: 25, top: 15, bottom: 0 }
          },
          scales: {
            xAxes: [{
              gridLines: { display: false, drawBorder: false }
            }],
            yAxes: [{
              ticks: {
                maxTicksLimit: 5,
                padding: 10,
                beginAtZero: true,
                stepSize: 1
              },
              gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
              }
            }],
          },
          legend: { display: false },
          tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
          }
        }
      });
    }

    // Pie Chart Setup
    var ctxPie = document.getElementById("myPieChart");
    if(ctxPie) {
      new Chart(ctxPie, {
        type: 'doughnut',
        data: {
          labels: ["Proses", "Selesai", "Pending"],
          datasets: [{
            data: [<?= $total_proses; ?>, <?= $total_selesai; ?>, <?= $total_pending; ?>],
            backgroundColor: ['#f59e0b', '#10b981', '#64748b'],
            hoverBackgroundColor: ['#d97706', '#059669', '#475569'],
            hoverBorderColor: "rgba(255, 255, 255, 1)",
            borderWidth: 3
          }],
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
          },
          legend: { display: false },
          cutoutPercentage: 75,
        },
      });
    }
  });
</script>

<?php require '../../layouts/footer.php'; ?>