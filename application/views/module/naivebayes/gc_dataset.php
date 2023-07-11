<div class="row">
  <div class="col-12">
    <div class="card-box">
      <h4>Pilih Data Excel</h4>
      <small><a href="<?=base_url();?>assets/naivebayes/contoh-dataset.xlsx" target="_blank">Download contoh Format .xlsx</a></small>
      <br>
      <form enctype="multipart/form-data">
          <input id="upload" type="file" name="files">
          <button type="button" class="btn btn-primary btn-sm" id="upl" onclick="doupl()" style="display:none;">Upload</button>
      </form>
    </div>
  </div>
</div>
<?php
  echo $output;
?>
