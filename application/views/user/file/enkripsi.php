<div class="container-fluid">

  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        <ol class="breadcrumb float-right p-0 m-0">
          <li>
            <a href="#">File</a>
          </li>
          <li class="active">
            Enkripsi
          </li>
        </ol>
        <h4 class="page-title m-0">Enkripsi File</h4>
      </div>

    </div>
  </div>
  <!-- end row -->
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <h4 class="m-t-0 header-title"><b>Pilih Jenis Enkripsi dan Masukan Key</b></h4>
          <p class="text-muted m-b-15">
            You can limit the number of elements you are allowed to select via the
            <code>
              data-max-option
            </code>
            attribute. It also works for option groups.
          </p>

          <div class="row">
            <div class="col-lg-6">
              <div class="demo-box">
                <?php echo form_open(site_url('admin/file/encrypt/'.urlencode($file_info->name)));?>
                  <div class="form-group">
                    <p>Masukan Key</p>
                    <input type="text" class="form-control" name="hash" placeholder="" required>
                  </div>
                  <div class="form-group">
                    <p>Pilih Jenis Enkripsi</p>
                    <select class="form-control" name="type">
                        <option value="aes">AES</option>
                        <option value="des">3 DES</option>
                    </select>
                  </div>
                  <div class="form-group float-right">
                    <button type="submit" class="btn btn-primary">Enkripsi File</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="row">
                <div class="col-lg-6">
                  <div class="demo-box">
                  <div class="p-5">
                    <?php
                        echo '<h4 class="">'.$file_info->name.'</h4>';
                        echo '<p><strong>Tipe File</strong> : '.$file_info->ext.'</p>';
                        echo '<p><strong>Ukuran</strong> : '.$file_info->size.'</p>   '
                    ?>
                    <a href="<?php echo base_url('uploads/'.$file_info->name)?>" target="_blank"><button class="btn btn-primary">Download</button></a>
                  </div>
                  
                </div>
                </div>
                <div class="col-lg-6"></div>
              </div>
            </div>
          </div> <!-- end row -->
        </div>
      </div>
    </div> <!-- end col -->
  </div>


</div>
<!-- end container-fluid -->
