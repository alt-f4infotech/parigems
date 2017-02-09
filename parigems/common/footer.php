 <?php
 $number=rand(1111, 9999);
 ?>
  <script src="../js/search.js?<?php echo $number;?>" ></script>
  <div class="modal fade" id="showDiamondModal" role="dialog" style="z-index: 10000;">
			<div class="modal-dialog">
			  <!-- Modal content-->
			  <div class="modal-content border-radius0 search_modal" style="width: 800px;margin-left: -100px;">
				<div class="modal-body">
				</div>
			  </div>
			</div>
		  </div>
		 
  <footer>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<p class="margin0">2016. Parigems. All rights are reserved</p>
				</div>
				<div class="col-sm-6">
					<p class="text-right margin0">
						Developed and Managed by <a href="http://alt-f4infotech.com" target="_blank">Alt-f4 Infotech LLP</a> 
					</p>
				</div>
			</div>
		</div>
		
		 
		<script>
			  
  function showDiamondModal(diamondId)
	{
	 $.get('../search/showDiamondModal.php?diamondId='+diamondId, function(html){
			 $('#showDiamondModal .modal-body').html(html);
			 $('#showDiamondModal').modal('show', {backdrop: 'static'});
		 });
	}
	
	function showRateModal(diamondId)
	{
	 $.get('../search/showRateModal.php?diamondId='+diamondId, function(html){
			 $('#showDiamondModal .modal-body').html(html);
			 $('#showDiamondModal').modal('show', {backdrop: 'static'});
		 });
	}
	
			    $(document).ready(function() {
    $('#table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
				
var $table = $('#table');
      $(function () {
          $('#toolbar').find('select').change(function () {
              $table.bootstrapTable('refreshOptions', {
                  exportDataType: $(this).val()
              });
          });
      })
    /*var $table = $('#table');
    $(function () {
        $('#toolbar').find('select').change(function () {
            $table.bootstrapTable('destroy').bootstrapTable({
                exportDataType: $(this).val()
            });
        });
    })*/
</script>
		<script>
		//paste this code under the head tag or in a separate js file.
	// Wait for window load
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
</script>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>-->
	</footer>
  <?php
 mysqli_close($con);
 ?>
</div>
</body>
</html>