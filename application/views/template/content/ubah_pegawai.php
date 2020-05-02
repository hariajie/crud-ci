<!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800"><?php echo $judul;?></h1>
          <p class="mb-4"><?php echo $desc;?></p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <span class="float-left">
              <h6 class="m-0 font-weight-bold text-primary text-left">Form Ubah Pegawai</h6>
             </span>
            </div>
            <form role="form" method="post" action="<?php echo site_url('crud/edit/').$pegawai->id;?>">
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="nama"><b>Nama Pegawai</b></label>
                  <input type="text" name="nama" class="form-control <?php if(form_error('nama')!=null) echo ' is-invalid' ;?>" id="nama" placeholder="Input Nama Pegawai" value="<?php echo $pegawai->nama;?>">
                  <?php echo form_error('nama', '<span class="text-danger">', '</span>');?>
                </div>
              </div>
              <div class="form-row">
                 <div class="form-group col-md-6">
                  <label for="parent"><b>Tempat Lahir</b></label>
                  <input type="text" name="tempat_lahir" class="form-control <?php if(form_error('tempat_lahir')!=null) echo ' is-invalid' ;?>" id="tempat_lahir" placeholder="Input Tempat Lahir" value="<?php echo $pegawai->tempat_lahir;?>">
                  <?php echo form_error('tempat_lahir', '<span class="text-danger">', '</span>');?>
                </div>
                <div class="form-group col-md-6">
                  <label for="parent"><b>Tanggal Lahir</b></label>
                  <input type="text" name="tanggal_lahir" class="form-control <?php if(form_error('tanggal_lahir')!=null) echo ' is-invalid' ;?>" id="tanggal_lahir" placeholder="Input Tanggal Lahir" value="<?php echo $pegawai->tanggal_lahir;?>"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                  <?php echo form_error('tanggal_lahir', '<span class="text-danger">', '</span>');?>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="alamat"><b>Alamat</b></label>
                  <textarea class="form-control <?php if(form_error('alamat')!=null) echo ' is-invalid' ;?>" id="alamat" name="alamat" placeholder="Input Alamat" rows="3"><?php echo $pegawai->alamat;?></textarea>
                  <?php echo form_error('alamat', '<span class="text-danger">', '</span>');?>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="telepon"><b>Nomor Telepon</b></label>
                  <input type="text" name="telepon" class="form-control <?php if(form_error('telepon')!=null) echo ' is-invalid' ;?>" id="telepon" placeholder="Input Telepon" value="<?php echo $pegawai->telepon;?>">
                  <?php echo form_error('telepon', '<span class="text-danger">', '</span>');?>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="email"><b>Email</b></label>
                  <input type="text" name="email" class="form-control <?php if(form_error('email')!=null) echo ' is-invalid' ;?>" id="email" placeholder="Input Email" value="<?php echo $pegawai->email;?>">
                  <?php echo form_error('email', '<span class="text-danger">', '</span>');?>
                </div>
              </div>
           
            </div>
              <!-- /.card-body -->

              <div class="card-footer">     
              <button type="submit" class="btn btn-primary" name="simpan"><span class="fa fa-save"></span> Simpan</button>
              <a href="<?php echo site_url('crud');?>" class="btn btn-success" name="kembali">Kembali</a>
              </div>
            </form>
          </div>

<link href="<?php echo base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css');?>" rel="stylesheet">

<script type="text/javascript" src="<?php echo base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js');?>"></script>
<script>
    $('#tanggal_lahir').datepicker({
        format: "yyyy-mm-dd"
    });
</script>