
		<div class="container  mb-3 credit-container">
	
			<div class="row justify-content-center text-center mb-2">
				<div class="col-9">
					<?= $this->session->flashdata('message'); ?>
				</div>
			</div>


			<div class="row justify-content-center text-center credit-row mt-4 mt-sm-5" >

				<div class="col-12 col-sm-4 col-md-2 col-lg-2 mb-2">
					<form action="<?= base_url('credit/buy') ?>" method="POST">
					<button style="width: 133px;height:105.1px;background:transparent;border:transparent" >
						<img class="mb-3 img-fluid" src="<?= base_url('assets2/') ?>img/logo/no-bonus25.svg" id="paypal-amount" alt="Card image cap" >
					</button>
					<input type="hidden" name="price" value="Credit $25">
					<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
					</form>
				</div>
				<div class="col-12 col-sm-4 col-md-2  col-lg-2  mb-2">
				<form action="<?= base_url('credit/buy') ?>" method="POST">
					<button style="width: 133px;height:105.1px;background:transparent;border:transparent" >
						<img class="mb-3 img-fluid" src="<?= base_url('assets2/') ?>img/logo/no-bonus50.svg" id="paypal-amount" alt="Card image cap" >
					</button>
					<input type="hidden" name="price" value="Credit $50">
					<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
					</form>
				</div>
				<div class="col-12 col-sm-4 col-md-2  col-lg-2">
				<form action="<?= base_url('credit/buy') ?>" method="POST">
					<button style="width: 133px;height:105.1px;background:transparent;border:transparent" >
						<?php if ($user['role_id'] <= 1): ?>

						<img class="mb-3 img-fluid" src="<?= base_url('assets2/') ?>img/logo/bonus-10.svg" id="paypal-amount" alt="Card image cap" >
						<?php else : ?>
							<img class="mb-3 img-fluid" src="<?= base_url('assets2/') ?>img/logo/no-bonus.svg" id="paypal-amount" alt="Card image cap" >
						<?php endif ?>
					</button>
					<input type="hidden" name="price" value="Credit $100">
					<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
					</form>
				</div>

			</div>

			<div class="text-center mt-4 mt-lg-5">
				<p style="color: #37363C" >Select the amount that is <br class="d-inline d-sm-none">saving for you and finish purchase</p>
				<img src="<?= base_url('assets2/') ?>img/logo/finish.svg" alt="">
			</div>
		</div>
	
	<nav class="navbar navbar-expand" style="height: 40.38px;background: #CCCCCC;position: absolute;bottom: 0 ;width: 100%"></nav>



<script src="<?= base_url('assets2/')?>js/jquery-3.2.1.min.js"></script>
<script src="<?= base_url('assets2/')?>js/bootstrap.js"></script>
<script src="<?= base_url('assets2/')?>js/sweet/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets2/')?>js/auth.js"></script>
</body>
</html>