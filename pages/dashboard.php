<!-- Bootstrap 5 -->

<style>
  .order-card {
    color: #fff;
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
  }

  .bg-c-blue {
    background: linear-gradient(45deg, #4099ff, #73b4ff);
  }

  .bg-c-green {
    background: linear-gradient(45deg, #2ed8b6, #59e0c5);
  }

  .bg-c-yellow {
    background: linear-gradient(45deg, #FFB64D, #ffcb80);
  }

  .bg-c-pink {
    background: linear-gradient(45deg, #FF5370, #ff869a);
  }

  .card-body i {
    font-size: 2rem;
  }
</style>

<div class="container mt-5">
  <div class="row gy-4">
    <!-- Materials Request -->
    <div class="col-lg-3 col-md-6">
      <a href="?pages=request_list" class="text-decoration-none">
        <div class="card bg-c-blue order-card">
          <div class="card-body">
            <h6 class="mb-3">Materials Request</h6>
            <h1 class="text-end"><i class="fa fa-cart-plus float-start"></i>
              <span>
                <?php
                $q = mysqli_query($conn, "SELECT count(id_mr) as cnt From material_request") or die(mysqli_error());
                $qr = mysqli_fetch_array($q);
                echo $qr['cnt'];
                ?>
              </span>
            </h1>
          </div>
        </div>
      </a>
    </div>

    <!-- Purchase Orders -->
    <div class="col-lg-3 col-md-6">
      <div class="card bg-c-green order-card">
        <div class="card-body">
          <h6 class="mb-3">Purchase Orders</h6>
          <h1 class="text-end"><i class="fa fa-rocket float-start"></i>
            <span>
              <?php
              $q = mysqli_query($conn, "SELECT count(id_po) as cnt From purchase_order") or die(mysqli_error());
              $qr = mysqli_fetch_array($q);
              echo $qr['cnt'];
              ?>
            </span>
          </h1>
        </div>
      </div>
    </div>

    <!-- Orders Received -->
    <div class="col-lg-3 col-md-6">
      <a href="?pages=receive_item" class="text-decoration-none">
        <div class="card bg-c-yellow order-card">
          <div class="card-body">
            <h6 class="mb-3">Orders Received (Today)</h6>
            <h1 class="text-end"><i class="fa fa-sign-in float-start"></i>
              <span>
                <?php
                $q = mysqli_query($conn, "SELECT count(id_receive) as cnt From receive_item where date='" . date('Y-m-d') . "'") or die(mysqli_error());
                $qr = mysqli_fetch_array($q);
                echo $qr['cnt'];
                ?>
              </span>
            </h1>
          </div>
        </div>
      </a>
    </div>

    <!-- Usage -->
    <div class="col-lg-3 col-md-6">
      <a href="?pages=usage_item" class="text-decoration-none">
        <div class="card bg-c-pink order-card">
          <div class="card-body">
            <h6 class="mb-3">Usage</h6>
            <h1 class="text-end"><i class="fa fa-refresh float-start"></i>
              <span>
                <?php
                $q = mysqli_query($conn, "SELECT count(id_usage) as cnt From material_usage where date='" . date('Y-m-d') . "'") or die(mysqli_error());
                $qr = mysqli_fetch_array($q);
                echo $qr['cnt'];
                ?>
              </span>
            </h1>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>
