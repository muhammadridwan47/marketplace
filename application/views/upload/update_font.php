


<!DOCTYPE html>
<html lang="en">
<head>
  <title>upload-product</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?= base_url('assets2/') ?>css/upload.css">
  <!-- <script src="js/jquery.min.js"></script> -->

</head>
<body>

<div class="container">
    <?= form_open_multipart('upload/editfont/'.hashid($barang['id'])); ?>
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <div class="row mt-5">
      <?= $this->session->flashdata('message'); ?> 
        <div class="col-4">
          <div class="form-group">
            <input type="text" class="form-control" id="usr" name="nama_barang" value="<?= $barang['nama_barang'] ?>" placeholder="type your product name" autocomplete="off" readonly> 
          </div>
        </div>
        <div class="col-4">
            <div class="d-flex font__family-montserrat">
                <select name="jenis" class="dd1">
                  <option value="Font">Font</option>
                </select>
            </div>
        </div>
        <div class="col-4">
           <div class="d-flex">
              <select name="kategori" class="dd1">
                <option value="<?= $barang['kategori'] ?>"><?= $barang['kategori'] ?></option>
                <option value="Serif">Serif</option>
                <option value="Sans Serif">Sans Serif</option>
                <option value="Script">Script</option>
                <option value="Handwriting">Handwriting</option>
                <option value="Calligraphy">Calligraphy</option>
              </select>
            </div> 
          </div>
      </div>
      <div class="row">
        <div class="col-6">
          <div class="gambarbesar">
            <p class="mt-5 ml-5">794 x 529px recomended for hi res and max 5 files</p>
          </div>
        </div>
        <div class="col-6">
          <div class="uploadgambar">
            <div class="gambar p-2 mb-2">
              <input type="file" name="gambar1">
            </div>
            <div class="gambar p-2 mb-2">
              <input type="file" name="gambar2">
            </div>
            <div class="gambar p-2 mb-2">
              <input type="file" name="gambar3">
            </div>
            <div class="gambar p-2 mb-2">
              <input type="file" name="gambar4">
            </div>
            <div class="gambar p-2">
              <input type="file" name="gambar5">
            </div>
          </div>
        </div>
      </div>
      <div class="row pt-3">
        <div class="col-md-12">
          <div class="row">
              <div class="col-md-3 pb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck">
                  <label class="form-check-label" for="defaultCheck1" >
                    Free Version
                  </label>
                </div>
                <input type="file" name="file_gratis">
              </div>
              <div class="col-md-3 pb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                    <label class="form-check-label" for="defaultCheck2">
                      Desktop
                    </label>
                  </div>
                  <input type="text" placeholder="$ type your price" name="harga_dekstop" value="<?= $barang['harga_dekstop'] ?>">
                  <input type="file" name="file_dekstop">
              </div>
              <div class="col-md-3 pb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck3">
                  <label class="form-check-label" for="defaultCheck3">
                    Web
                  </label>
                </div>
                <input type="text" name="harga_web" placeholder="$ type your price" value="<?= $barang['harga_web'] ?>">
                <input type="file" name="file_web">
              </div>
              <div class="col-md-3 pb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck4">
                  <label class="form-check-label" for="defaultCheck4">
                    App
                  </label>
                </div>
                <input type="text" name="harga_app" placeholder="$ type your price" value="<?= $barang['harga_app'] ?>">
                <input type="file" name="file_app">
              </div>
          </div>
        </div>
      </div>
      <div class="row list">
        <div class="col-md-12">
          <center><b><label class="form-check-label">File include</label></b></center>
          <div class="row">
            <div class="col-md-3">
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="APP/" name="1" id="defaultCheck4" <?= periksa($barang['id'],'APP') ?>>
                  <label class="form-check-label" for="defaultCheck4">
                    App
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="WEB/" name="2" id="defaultCheck4" <?= periksa($barang['id'],'WEB') ?>>
                  <label class="form-check-label" for="defaultCheck4">
                    web
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="OTF/" name="3" id="defaultCheck4" <?= periksa($barang['id'],'OTF') ?>>
                  <label class="form-check-label" for="defaultCheck4">
                    otf
                  </label>
                </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="WOFF/" name="4" id="defaultCheck4" <?= periksa($barang['id'],'WOFF') ?>>
                  <label class="form-check-label" for="defaultCheck4">
                    woff
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="TTF/" name="5" id="defaultCheck4" <?= periksa($barang['id'],'TTF') ?>>
                  <label class="form-check-label" for="defaultCheck4">
                    ttf
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="EOT/" name="6" id="defaultCheck4" <?= periksa($barang['id'],'EOT') ?>>
                  <label class="form-check-label" for="defaultCheck4">
                    eot
                  </label>
                </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="PSD/" name="7" id="defaultCheck4" <?= periksa($barang['id'],'PSD') ?>>
                  <label class="form-check-label" for="defaultCheck4">
                    psd
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="AI/" name="8" id="defaultCheck4" <?= periksa($barang['id'],'AI') ?>>
                  <label class="form-check-label" for="defaultCheck4">
                    ai
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="CDR/" name="9" id="defaultCheck4" <?= periksa($barang['id'],'CDR') ?>>
                  <label class="form-check-label" for="defaultCheck4">
                    cdr
                  </label>
                </div>
            </div>
            <div class="col-md-3">
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="JPG/" name="10" id="defaultCheck4" <?= periksa($barang['id'],'JPG') ?>>
                  <label class="form-check-label" for="defaultCheck4">
                    jpg
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="PNG/" name="11" id="defaultCheck4" <?= periksa($barang['id'],'PNG') ?>>
                  <label class="form-check-label" for="defaultCheck4">
                    png
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="SVG/" name="12" id="defaultCheck4" <?= periksa($barang['id'],'SVG') ?>>
                  <label class="form-check-label" for="defaultCheck4">
                    svg
                  </label>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row pt-3">
        <div class="col-md-12">
         
          <div class="mb-3">
            <label for="validationTextarea">Tag's</label>
            <textarea class="form-control" id="validationTextarea"  placeholder="enter your tag" name="tag" required ><?= $barang['tag'] ?></textarea>
            <div class="invalid-feedback">
              
            </div>
          </div>
        
        </div>  
      </div>
      <div class="row mb-5">
        <div class="col-md-12">
            <label for="validationTextarea">description</label>
            <textarea class="form-control" id="validationTextarea"  placeholder="enter your description" name="deskripsi" required><?= $barang['deskripsi'] ?></textarea>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">UPLOAD</button>
        </div>
      </div>  
    </div>
  </form>
</div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="<?= base_url('assets2/') ?>js/boostrap.min.js"></script>
</body>
</html>
