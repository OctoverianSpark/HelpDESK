<h1 class="title">Panel de Inventario</h1>


<div class="inv-dashboard container-grid">

        <div class="container-brief-cards">
                <div class="brief-card">
                        <span class="avatar">

                                <i class="bi bi-database"></i>

                        </span>
                        <div class="card-data">

                                <span class="card-title">Total de Inventario</span>
                                <span class="quantificate-total card-result"><?php echo count($inv) ?></span>

                        </div>
                </div>
                <div class="brief-card">
                        <span class="avatar">

                                <i class="bi bi-laptop"></i>


                        </span>
                        <div class="card-data">

                                <span class="card-title">Laptops Asignadas </span>
                                <span class="quantificate-asign-time card-result"><?php echo count($asigned) ?></span>
                        </div>

                </div>
                <div class="brief-card">
                        <span class="avatar">

                                <i class="bi bi-box-seam"></i>

                        </span>
                        <div class="card-data">
                                <span class="card-title">Laptops en Stock</span>
                                <span class="quantificate-pending-time card-result"><?php echo count($stock) ?></span>

                        </div>

                </div>

        </div>


        <div class="dashboard-menu">


                <div class="container-flex">
                        <div class="chart-board">

                                <canvas id="inv-type-chart">

                                </canvas>
                        </div>
                        <div class="chart-board">
                                <canvas id="inv-property-chart"></canvas>

                        </div>
                </div>


                <div class="chart-board">
                        <canvas id="inv-area-chart"></canvas>

                </div>




        </div>


</div>