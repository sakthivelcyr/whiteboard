        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
         <!-- <h1 class="h3 mb-2 text-gray-800">Customer</h1>          -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Customers</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>   
                      <th>S.No.</th>                   
                      <th>Name</th>
                      <th>Role</th>
                      <th>College</th>
                      <th>State</th>
                      <th>District</th>
                      <th>Mobile</th>
                      <th>Action</th>
                      
                    </tr>
                  </thead>
                  
                  <tbody>                   
                  
                    <?php $id=1 ?>
                            <?php foreach ($users as $user): ?>
                                
                                <tr>

                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $user->name; ?></td>
                                    <td><?php echo $user->role; ?></td>
                                    <td><?php echo $user->college; ?></td>
                                    <td><?php echo $user->state; ?></td>
                                    <td><?php echo $user->district; ?></td>
                                    <td><?php echo $user->mobile; ?></td>
                                    <td class="text-nowrap">
                                    
                                            <a href="#" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-success m-r-10"></i> </a>
                                            <span data-toggle="modal" data-target="#">
                                            <a id="delete" href="#"  data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-trash text-danger m-r-10"></i> </a>
                                            </span>    

                                    </td>
                                  
                                </tr>    
                                <?php $id = $id + 1;?>
                            <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Whiteboard 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('vendor/jquery/jquery.min.js')?>"></script>
  <script src="<?= base_url('vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('vendor/jquery-easing/jquery.easing.min.js')?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('js/sb-admin-2.min.js')?>"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url('vendor/datatables/jquery.dataTables.min.js')?>"></script>
  <script src="<?= base_url('vendor/datatables/dataTables.bootstrap4.min.js')?>"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url('js/demo/datatables-demo.js')?>"></script>

