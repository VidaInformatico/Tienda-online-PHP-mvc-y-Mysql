<?php include_once 'Views/template/header-admin.php'; ?>

<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">weekend</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Pendientes</p>
                    <h4 class="mb-0"><?php echo $data['pendientes']['total']; ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Proceso</p>
                    <h4 class="mb-0"><?php echo $data['procesos']['total']; ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Finalizados</p>
                    <h4 class="mb-0"><?php echo $data['finalizados']['total']; ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">weekend</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Productos</p>
                    <h4 class="mb-0"><?php echo $data['productos']['total']; ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12 col-lg-4">
        <div class="card radius-10">
        <div class="card-header bg-transparent">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Pedidos</h6>
                        </div>
                    </div>
                </div>
            <div class="card-body">                
                <div class="chart-container-2">
                    <canvas id="reportePedidos"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card radius-10 w-100">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Productos con Stock Mínimo</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container-1">
                    <canvas id="chart4"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card radius-10 w-100">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Productos más vendidos</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container-1">
                    <canvas id="topProductos"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'Views/template/footer-admin.php'; ?>

<script>
    // chart 2

    var ctx = document.getElementById("reportePedidos").getContext('2d');

    var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke1.addColorStop(0, '#fc4a1a');
    gradientStroke1.addColorStop(1, '#f7b733');

    var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke2.addColorStop(0, '#4776e6');
    gradientStroke2.addColorStop(1, '#8e54e9');


    var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);

    gradientStroke3.addColorStop(0, '#42e695');
    gradientStroke3.addColorStop(1, '#3bb2b8');

    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Pendientes", "Proceso", "Finalizados"],
            datasets: [{
                backgroundColor: [
                    gradientStroke1,
                    gradientStroke2,
                    gradientStroke3
                ],
                hoverBackgroundColor: [
                    gradientStroke1,
                    gradientStroke2,
                    gradientStroke3
                ],
                data: [<?php echo $data['pendientes']['total']; ?>,
                    <?php echo $data['procesos']['total']; ?>,
                    <?php echo $data['finalizados']['total']; ?>
                ],
                borderWidth: [1, 1, 1]
            }]
        },
        options: {
            maintainAspectRatio: false,
            cutoutPercentage: 75,
            legend: {
                position: 'bottom',
                display: false,
                labels: {
                    boxWidth: 8
                }
            },
            tooltips: {
                displayColors: false,
            }
        }
    });
</script>

<script src="<?php echo BASE_URL; ?>assets/js/index.js"></script>

</body>

</html>