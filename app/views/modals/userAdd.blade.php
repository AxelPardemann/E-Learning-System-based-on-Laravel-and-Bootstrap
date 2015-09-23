<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title">Add new restaurant</h4>
</div>
<div class="modal-body">
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-reorder"></i>Add new user form
			</div>
		</div>
		<div class="portlet-body form">
			<!-- BEGIN FORM-->
			{{Form::open(array('url' => 'user/add', 'method' => 'post', 'class' => 'horizontal-form', 'id' => 'userAdd', 'autocomplete' => 'off'))}}
				<div class="form-body">
				<div class="alert alert-danger display-hide">
					<button class="close" data-close="alert"></button>
					You have some form errors. Please check below.
				</div>
					<h3 class="form-section">User Information</h3>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Email address</label>
								<input type="text" name="email" class="form-control" placeholder="Required">
								<span class="help-block">
									Please enter email address
								</span>
							</div>
						</div>
						<!--/span-->
						<!--/span-->
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label">Permission</label>
								<select class="form-control" name="permission" class="select2me">
									<option value="Administrator">Administrator</option>
									<option value="Editor">Editor</option>
									<option value="Standard">Standard</option>
								</select>
							</div>
						</div>	
					</div>
					<!--/row-->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">First name</label>
								<input type="text" name="first" class="form-control" placeholder="Required">
								<span class="help-block">
									Please enter first name
								</span>
							</div>
						</div>
						<!--/span-->
						<div class="col-md-6">
							<div class="form-group">
							<label class="control-label">Last name</label>
								<input type="text" name="last" class="form-control" placeholder="Required">
								<span class="help-block">
									Please enter last name
								</span>
							</div>
						</div>
						<!--/span-->
					</div>						
					<div class="row">
						<!--/span-->
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Company/Organization Name</label>
								<input type="text" name="company" class="form-control" placeholder="Required">
								<span class="help-block">
									Please enter company / organization name
								</span>
							</div>
						</div>
						<!--/span-->
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Phone number</label>
								<input type="text" name="phone" class="form-control" placeholder="Required">
								<span class="help-block">
									Please enter at least 10 digits
								</span>
							</div>
						</div>
						<!--/span-->					
					</div>			
				</div>
				<div class="form-actions right">
					<button type="button" class="btn default">Cancel</button>
					<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
				</div>
			{{Form::close()}}
			<!-- END FORM-->
		</div>
	</div>
</div><!--/modal-body-->
<div class="modal-footer">
	<button type="button" class="btn default" data-dismiss="modal">Close</button>
</div>
