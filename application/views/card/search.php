<nav class="navbar navbar-expand navbar-dark justify-content-center mt-5 search " >
    <form  method="POST" action="<?= base_url('product') ?>">
      <div>
        <div class="input-group">
          <div class="input-group-prepend">
           <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
            <button class="btn" type="submit" name="submit" value="submit">
              <img  src="<?= base_url('assets2/') ?>img/logo/search.svg"  class="align-text-bottom d-none d-sm-inline">
              <img  src="<?= base_url('assets2/') ?>img/logo/search-mobile.svg"  class="align-text-bottom d-inline d-sm-none">
            </button>
          </div>
          <input class="form-control form-control-sm" type="text" name="keyword" placeholder=" Search Supplement">
        </div>
      </div>
   </form>
  </nav>