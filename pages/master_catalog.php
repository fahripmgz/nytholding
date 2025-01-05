
<div class="">

	<div class="page-title">
		<div class="title_left">
			<h2><b>
					Create New Catalog | </b>
				<small>
					Catalog
				</small>
			</h2>
		</div>


	</div>
	<div class="clearfix"></div>
	<div class="row">
		<br>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="x_panel">

				<div class="x_content">
					<br />
					<form action="../controller/process.php?actionCatalog=insert" method="post"
						class="form-horizontal form-label-left input_mask" enctype="multipart/form-data">


						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Item Name </label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input type="text" class="form-control" name="txtitemname" placeholder="Item Name">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Specification </label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<textarea class="form-control" rows="3" name="txtspec"
									placeholder='Specification'></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Part Number</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input type="text" class="form-control" name="txtpartnumber" placeholder="Part Number">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Category </label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<select name="category" id="category" class="mySelect form-control" tabindex="-1">
									<option value="0">-select Category-</option>
									<?php

									$query = "SELECT * FROM master_category";
									$hasil = mysqli_query($conn, $query);
									while ($data = mysqli_fetch_array($hasil)) {

										echo "<option value='" . $data['id_cat'] . "'>" . $data['category_name'] . "</option>";

									} ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category </label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<select name="subcat" id="subcat" class="mySelect form-control" tabindex="-1">
								

								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Manufacture </label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<select name="txtmanufacture" id="txtmanufacture" class="mySelect form-control"
									tabindex="-1">
									<option value="0">-select Manufacture-</option>
									<?php

									$query = "SELECT * FROM master_manufacture";
									$hasil = mysqli_query($conn, $query);
									while ($data = mysqli_fetch_array($hasil)) {

										echo "<option value='" . $data['id_manu'] . "'>" . $data['manufacture_name'] . "</option>";

									} ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Brand</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<select name="txtbrand" id="txtbrand" class="mySelect form-control" tabindex="-1">
									<option value="0">-select Brand-</option>
									<?php

									$query = "SELECT * FROM master_brand";
									$hasil = mysqli_query($conn, $query);
									while ($data = mysqli_fetch_array($hasil)) {

										echo "<option value='" . $data['id_brand'] . "'>" . $data['brand_name'] . "</option>";

									} ?>
								</select>
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Maesurement </label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<select name="txtMaesurement" id="txtMaesurement" class="mySelect form-control"
									tabindex="-1">
									<option value="0">-select Maesurement-</option>
									<?php

									$query = "SELECT * FROM master_maesurement";
									$hasil = mysqli_query($conn, $query);
									while ($data = mysqli_fetch_array($hasil)) {

										echo "<option value='" . $data['id_mae'] . "'>" . $data['maesurename'] . "</option>";

									} ?>
								</select>
							</div>
						</div>

                	<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Min Stock </label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input type="number" class="form-control" name="minstock" placeholder="Minimum Stock">
							</div>
						</div>


						<div class="ln_solid"></div>

				</div>
			</div>
		</div>

		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="x_panel">

				<div class="x_content">
					<br />


					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Remark </label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<textarea class="form-control" rows="3" name="txtRemark" placeholder='Remark'></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Upload </label>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<input type="file" name="picture">
							<br>
							<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
										aria-hidden="true">&times;</span></button>
								<strong>Warning!</strong> * Format Upload JPG & PNG(Name not use Special Character)
							</div>


						</div>


						<br><br>
					</div>
				</div>

				<br>&nbsp;<br>

				<div class="form-group">
					<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<button class="btn btn-custom">Cancel</button>
						<button type="submit" class="btn btn-custom">Insert Catalog</button>

					</div>
				</div>

				</form>



			</div>
			<br><br>
		</div>
	</div>




	<div class="clearfix"></div>


</div>



</div>

