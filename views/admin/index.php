<h1 class="title">Panel de Administrador</h1>

<div class="container-brief-cards">
    <div class="brief-card">
        <span class="avatar">

            <i class="bi bi-ticket-detailed"></i>

        </span>
        <div class="card-data">

            <span class="card-title">Tickets en el Mes</span>
            <span class="month-total-tickets card-result"></span>

        </div>
    </div>
    <div class="brief-card">
        <span class="avatar">

            <i class="bi bi-database"></i>

        </span>
        <div class="card-data">

            <span class="card-title">Inventario Actual</span>
            <span class="total-inventory card-result"></span>
        </div>

    </div>
    <div class="brief-card">
        <span class="avatar">

            <i class="bi bi-file-earmark"></i>

        </span>
        <div class="card-data">
            <span class="card-title">Ordenes en el Mes</span>
            <span class="month-total-orders card-result"></span>

        </div>

    </div>

    <div class="brief-card">
        <span class="avatar">

            <i class="bi bi-file-earmark-arrow-down"></i>

        </span>
        <div class="card-data">
            <span class="card-title">Ordenes Pendientes</span>
            <span class="card-result"><?php echo count($orders); ?></span>

        </div>

    </div>
</div>

<div class="admin-dashboard">







    <div class="container-dashboard">
        <canvas id="tickets-chart">

        </canvas>
    </div>
    <div class="container-dashboard">
        <canvas id="inv-chart">

        </canvas>
    </div>
    <div class="container-dashboard">
        <canvas id="orders-type-chart">

        </canvas>
    </div>
    <div class="container-dashboard orders-brief">

        <?php if (empty($orders)) { ?>
            <h2>Sin Ordenes por el momento</h2>
        <?php } else { ?>

            <p class="subtitle">Ordenes Pendientes</p>
            <?php foreach ($orders as $order) { ?>


                <div class="order">
                    <p><?php echo $order->order_id ?></p>
                    <span><?php echo $order->nombre . " " . $order->apellido ?></span>
                    <span>Salida: <?php echo $order->emitted_date ?></span>
                    <span>Retorno: <?php echo $order->return_date ?></span>
                </div>

        <?php }
        } ?>

    </div>




</div>