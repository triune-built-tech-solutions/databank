

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Footer -->
				<footer class="sticky-footer bg-white mt-5">
					<div class="container my-auto">
						<div class="copyright text-center my-auto">
							<span>Copyright &copy; Industrial Training Fund <?php echo date('Y'); ?></span>
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
		<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		     aria-hidden="true">
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
						<a class="btn btn-primary" href="../index.php">Logout</a>
					</div>
				</div>
			</div>
		</div>



		<!-- Bootstrap core JavaScript-->
		<script src="../assets/vendor/jquery/jquery.min.js"></script>
		<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- OLD FOOTER APPENDS BEGINS -->

		<!-- Morris.js charts -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
		<script src="../old_assets/plugins/morris/morris.min.js"></script>
		<!-- Sparkline -->
		<script src="../old_assets/plugins/sparkline/jquery.sparkline.min.js"></script>
		<!-- jvectormap -->
		<script src="../old_assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
		<script src="../old_assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
		<!-- jQuery Knob Chart -->
		<script src="../old_assets/plugins/knob/jquery.knob.js"></script>
		<!-- daterangepicker -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
		<script src="../old_assets/plugins/daterangepicker/daterangepicker.js"></script>
		<!-- datepicker -->
		<script src="../old_assets/plugins/datepicker/bootstrap-datepicker.js"></script>
		<!-- Bootstrap WYSIHTML5 -->
		<script src="../old_assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
		<!-- Slimscroll -->
		<script src="../old_assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- FastClick -->
		<script src="../old_assets/plugins/fastclick/fastclick.js"></script>
		<!-- AdminLTE App -->
		<script src="../old_assets/dist/js/app.min.js"></script>
		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		<script src="../old_assets/dist/js/pages/dashboard.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="../old_assets/dist/js/demo.js"></script>

		<script type="text/javascript" src="../old_assets/ajax.js"></script>

		<!-- Custom JS -->
		<script type="text/javascript">
		    $(function() {

		        $(".vehdelbutton").click(function(){

		            //Save the link in a variable called element
		            var element = $(this);

		            //Find the id of the link that was clicked
		            var del_id = element.attr("id");

		            //Built a url to send
		            var info = 'id=' + del_id;
		            if(confirm("Sure you want to delete this record? There is NO undo!"))
		            {

		                $.ajax({
		                    type: "GET",
		                    url: "delete_untility.php",
		                    data: info,
		                    success: function(){

		                    }
		                });
		                $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		                    .animate({ opacity: "hide" }, "slow");

		            }

		            return false;

		        });

                $(".specdelbutton").click(function(){

//Save the link in a variable called element
                    var element = $(this);

//Find the id of the link that was clicked
                    var del_id = element.attr("id");

//Built a url to send
                    var info = 'id=' + del_id;
                    if(confirm("Sure you want to delete this record? There is NO undo!"))
                    {

                        $.ajax({
                            type: "GET",
                            url: "delete_spc.php",
                            data: info,
                            success: function(){

                            }
                        });
                        $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
                            .animate({ opacity: "hide" }, "slow");

                    }

                    return false;

                });


		        $(".delbutton").click(function(){

		            //Save the link in a variable called element
		            var element = $(this);

		            //Find the id of the link that was clicked
		            var del_id = element.attr("id");

		            //Built a url to send
		            var info = 'id=' + del_id;
		            if(confirm("Sure you want to delete this record? There is NO undo!"))
		            {

		                $.ajax({
		                    type: "GET",
		                    url: "delete_leg.php",
		                    data: info,
		                    success: function(){

		                    }
		                });
		                $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		                    .animate({ opacity: "hide" }, "slow");

		            }

		            return false;

		        });

		    });

            $('dd').filter('dd:nth-child(n+2)').hide();

            $('dt').click(function () {
                $(this).next().siblings('dd').hide();
                $(this).next().show();
            });
            //$('.subject').click(removeClass('li.page'));
		</script>
		<script type="text/javascript" src="../old_assets/val_ind_app.js"></script>
		<script type="text/javascript" src="../old_assets/val_ind_based.js"></script>


		<!-- OLD FOOTER APPENDS ENDS -->




		<!-- Core plugin JavaScript-->
		<script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

		<!-- Custom scripts for all pages-->
		<script src="../assets/js/sb-admin-2.min.js"></script>

		<!-- Page level plugins -->
		<script src="../assets/vendor/chart.js/Chart.min.js"></script>

		<!-- Page level custom scripts -->
		<script src="../assets/js/demo/chart-area-demo.js"></script>
		<script src="../assets/js/demo/chart-pie-demo.js"></script>

	</body>

</html>