<?php
// session_start();

if (empty($_SESSION['nip']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
echo "<script>alert('Kembalilah Kejalan yg benar!!!'); window.location = '../../index.php';</script>";
}
    else{
include '../system/tgl_indo.php';
$module="modul/mod_profil/profil_c.php?module=profil";

$sql = mysql_query("SELECT * FROM teacher WHERE nip = '$_SESSION[id_guru]' ");
$row = mysql_fetch_assoc($sql);

?>

      <div class="page-head">
        <h2 class="pull-left"><i class="fa fa-user"></i> Profil</h2> 
        <div class="bread-crumb pull-right">
          <a href="media.php?module=home"><i class="fa fa-home"></i> Home</a>
          <span class="divider">/</span> 
          <a href="media.php?module=profil" class="bread-current"> Profil</a>
        </div>
        <div class="clearfix"></div>
      </div>

      <div class="matter">
        <div class="container">
          <div class="row">

            <div class="col-md-3">            
             <div class="widget">
                <div class="widget-head">
                  <div class="widget-icons pull-right"> 
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                  <img width="100%" src="../image/guru/<?php echo $row['picture']; ?>">
              
              
                  </div>
                  </div>
                  <div class="widget-foot">
                    <!-- Footer goes here -->
                  </div>
                
                </div>

            </div>

            <div class="col-md-9">            
             <div class="widget">
                <div class="widget-head"> Data Profil
                  <div class="widget-icons pull-right"> 
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                  <div class="alert alert-info">

                    <div class="form-group">
                        <div class="row">
                          <div class="col-md-4"><label>NIP</label></div>
                          <div class="col-md-8">
                            : <?php echo $row['nip']; ?>
                          </div>
                        </div>
                      </div>

                    <div class="form-group">
                        <div class="row">
                          <div class="col-md-4"><label>Nama</label></div>
                          <div class="col-md-8">
                            : <?php echo $row['name']; ?>
                          </div>
                        </div>
                      </div>

                       <div class="form-group">
                        <div class="row">
                          <div class="col-md-4"><label>Alamat</label></div>
                          <div class="col-md-8">
                            : <?php echo $row['address']; ?>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-4"><label>Tempat Lahir</label></div>
                          <div class="col-md-8">
                            : <?php echo $row['po_birth']; ?>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-4"><label>Tanggal Lahir</label></div>
                          <div class="col-md-8">
                            : <?php echo TanggalIndo($row['do_birth']); ?>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-4"><label>Jenis Kelamin</label></div>
                          <div class="col-md-8">
                            : <?php $jk =$row['gender'];
                            if ($jk=='P') {
                              echo "Perempuan";
                            }elseif ($jk=='L') {
                              echo "Laki-laki";
                            } ?>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-4"><label>Agama</label></div>
                          <div class="col-md-8">
                            : <?php echo $row['religion']; ?>
                          </div>
                        </div>
                      </div>



                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-4"><label>No Tlp</label></div>
                          <div class="col-md-5">
                            : <?php echo $row['no_telp']; ?>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-4"><label>Email</label></div>
                          <div class="col-md-6">
                            : <?php echo $row['email']; ?>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-4"><label>Jabatan</label></div>
                          <div class="col-md-8">
                            : <?php echo $row['position']; ?>
                          </div>
                        </div>
                      </div> 

                      </div>
              
              
                  </div>
                  </div>
                  <div class="widget-foot">
                    <div class="row">
                      <div class="col-md-1">
                        <a href="#edit" data-toggle="modal"><button class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</button></a>
                      </div>
                    </div>

                  </div>
                
                </div>

            </div>




            </div>
          </div>
        </div>


<!-- EDIT DATA  -->
      <div id="edit" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" style="width: 500px;">
            <div class="modal-content">
                      <div class="modal-header kuning">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                        <h4 class="title-putih"><i class="fa fa-pencil"></i> Edit Data Guru</h4>
                      </div>
                      <div class="modal-body">
                      <form method="POST" action="<?php echo $module; ?>&act=update" enctype="multipart/form-data">
                      
                      <link rel="stylesheet" href="../../../assets/css/bootstrap-datetimepicker.min.css">
                      <script src="../../../assets/js/bootstrap-datetimepicker.min.js"></script>
                      <script src="../../../assets/js/custom.js"></script>


                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-3"><label>NIP</label></div>
                          <div class="col-md-7">
                            <input type="hidden" name="id" value="<?php echo $row['nip']; ?>">
                            <input type="text" readonly class="form-control" name="nip" value="<?php echo $row['nip']; ?>" required>
                          </div>
                        </div>
                      </div>


                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-3"><label>Nama Lengkap</label></div>
                          <div class="col-md-8">
                            <input type="text" class="form-control" name="nama" value="<?php echo $row['name']; ?>" required>
                          </div>
                        </div>
                      </div>

                      

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-3"><label>Password</label></div>
                          <div class="col-md-7">
                            <input type="password" class="form-control" name="password">
                            <p>Jika password tidak di ubah di kosongkan saja</p>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-3"><label>Alamat</label></div>
                          <div class="col-md-8">
                            <textarea class="form-control" name="alamat" required><?php echo $row['address']; ?></textarea>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-3"><label>Tempat Lahir</label></div>
                          <div class="col-md-6">
                            <input type="text" class="form-control" name="tempat_lahir" required value="<?php echo $row['po_birth']; ?>">
                          </div>
                        </div>
                      </div>

                      <?php $ok=rand(1, 100);
                          ?>
  
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-3"><label>Tanggal Lahir</label></div>
                          <div class="col-md-5">
                            <div id="<?php echo $ok; ?>" class="input-append input-group dtpicker">
                            <input data-format="yyyy-MM-dd" readonly type="text" name="tgl_lahir" class="form-control" value="<?php echo $row['do_birth']; ?>">
                            <span class="input-group-addon add-on">
                            <i data-time-icon="fa fa-times" data-date-icon="fa fa-calendar"></i>
                            </span>
                          </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-3"><label>Jenis Kelamin</label></div>
                          <div class="col-md-5">
                            <select name="jk" class="form-control" required>
                                      <option value="<?php echo $row['gender']; ?>">
                                        <?php if ($row['gender']=='L') {
                                          echo "Laki-laki";
                                          }elseif ($row['gender']=='P') {
                                            echo "Perempuan";
                                          
                                        } ?>
                                      </option>
                                      <?php if ($row['gender']=='L') {
                                        echo "<option value='P'>Perempuan</option>";
                                      } elseif ($row['gender']=='P') {
                                        echo "<option value='L'>Laki-laki</option>";
                                      } ?>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-3"><label>Agama</label></div>
                          <div class="col-md-5">
                            <input type="text" class="form-control" name="agama" required value="<?php echo $row['religion']; ?>">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-3"><label>No Tlp</label></div>
                          <div class="col-md-5">
                            <input type="text" class="form-control" name="no_telp" required value="<?php echo $row['no_telp']; ?>">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-3"><label>Email</label></div>
                          <div class="col-md-6">
                            <input type="email" class="form-control" name="email" required value="<?php echo $row['email']; ?>">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-3"><label>Foto</label></div>
                          <div class="col-md-8">
                            <input type="file" class="btn btn-default" name="fupload">
                            <p>Jika Foto tidak di ubah di kosongkan saja</p>
                          </div>
                        </div>
                      </div>


                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                        <button type="submit" class="btn btn-warning">Update</button>
                      </div>
                      </form> 
                    </div>
      </div>
     </div>

    <!-- End Edit Data -->



<?php } ?>