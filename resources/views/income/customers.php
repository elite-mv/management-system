<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<meta charset="UTF-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	  	<title>MS [ Income ] - Quotes</title>
	  	<?php include('include.html') ?>
	  	<link rel="stylesheet" type="text/css" href="navigation.css">
	  	<style type="text/css">
	  		input[type="number"]::-webkit-outer-spin-button,
	  		input[type="number"]::-webkit-inner-spin-button {
	  		    -webkit-appearance: none;
	  		    margin: 0;
	  		}

	  		input[type="number"] {
	  		    -moz-appearance: textfield;
	  		}

	  		input[name="search"]:focus{
	  		 	outline: none;
	  		}
	  	</style>
	</head>
	<body class="font-monospace">
		<main class="container-fluid p-0 income-with-nav">

			<?php include('navigation.html') ?>

			<!-- page design starts here -->

			<div class="w-100 d-flex align-items-start border">
				<div class="container-fluid p-3">
					<div class="row">
						<div class="col-12 text-start">
							<p class="d-inline-flex gap-1">
							  	<a class="btn btn-outline-primary rounded-0" data-bs-toggle="collapse" href="#Collapse1" role="button" aria-expanded="false" aria-controls="Collapse1">FILTER</a>
							</p>
							<div class="row pb-3">
							  	<div class="col">
							    	<div class="collapse" id="Collapse1">
							      		<div class="card card-body rounded-0 gap-3 overflow-x-auto" style="display: flex; flex-direction: row;">
							      			<div class="d-flex align-items-center justify-content-center gap-3 border p-3 bg-light">
				      							<div>
				      				  				<input type="radio" name="filters" class="me-2"><small>A-Z</small>
				      							</div>
				      							<div>
				      				  				<input type="radio" name="filters" class="me-2"><small>Z-A</small>
				      							</div>
							      			</div>

							      			<div class="d-flex align-items-center justify-content-center gap-3 border p-3 bg-light">
				      							<div>
				      				  				<input type="radio" name="filters" class="me-2"><small>0-9</small>
				      							</div>
				      							<div>
				      				  				<input type="radio" name="filters" class="me-2"><small>9-0</small>
				      							</div>
							      			</div>

							      			<div class="d-flex align-items-start justify-content-center gap-3 border p-3 bg-light">
				      							<div>
							      					<input type="radio" name="filters" class="me-2"><small>By Name</small>
							      				</div>
							      				<div>
							      					<input type="radio" name="filters" class="me-2"><small>By Position</small>
							      				</div>
							      				<div>
							      					<input type="radio" name="filters" class="me-2"><small>By Company</small>
							      				</div>
							      				<div>
							      					<input type="radio" name="filters" class="me-2"><small>By Address</small>
							      				</div>
							      				<div>
							      					<input type="radio" name="filters" class="me-2"><small>By Currency</small>
							      				</div>
							      			</div>
							      		</div>
							    	</div>
							  	</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12" style="display: flex; justify-content: center; align-items: center;">
							<div class="w-50 rounded-pill border d-flex align-items-start flex-direction-row gap-2 py-2 px-3">
								<div>
									<button class="border-0 bg-transparent" style="border-radius: 50%;">
										<i class="fas fa-search text-secondary"></i>
									</button>
								</div>
								<div class="w-100 mx-1">
									<small>
										<input type="search" name="search" class="rounded-0 border-0 w-100">
									</small>
								</div>
							</div>
						</div>
					</div>

					<div class="row p-3">
						<div class="border border-dark bg-dark text-white row m-0 p-1 d-flex align-items-center">
							<div class="col-auto">
								<b>List of Customers</b>
							</div>

							<div class="col-auto p-0 ms-auto" style="display: flex; justify-content: center; align-items: center;">

								<button type="button" class="btn btn-sm btn-danger rounded-0 d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
								  	<i class="fas fa-plus-circle me-2"></i>CUSTOMER
								</button>

								<div class="modal fade text-dark" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  	<div class="modal-dialog modal-xl">
								    	<div class="modal-content">
								    		<form>
										      	<div class="modal-header">
										        	<h1 class="modal-title fs-5" id="exampleModalLabel">Customer Configuration</h1>
										        	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										      	</div>
										      	<div class="modal-body">
										      		<div class="d-flex gap-3" style="flex-direction: column;">
										      			<div>
										      				<b>Customer Name</b>
										      				<div class="d-flex flex-direction-row gap-3">
										      					<small class="w-25 d-flex align-items-center" style="flex-direction: column;">
										      						<select class="form-control text-center" name="salutation">
										      							<option value="">None</option>
										      							<option value="Mx.">Mx.</option>
										      							<option value="Mr.">Mr.</option>
										      							<option value="Ms.">Ms.</option>
										      							<option value="Mrs.">Mrs.</option>
										      							<option value="Hon.">Hon.</option>
										      						</select>
										      						<span>Salutation</span>
										      					</small>
										      					<small class="w-75 d-flex align-items-center" style="flex-direction: column;">
										      						<input type="type" class="form-control" name="full_name" required>
										      						<span>Full Name</span>
										      					</small>
										      				</div>
										      			</div>

										      			<div>
										      				<b>Position</b>
										      				<small><input type="text" class="form-control" name="position"></small>
										      			</div>

										      			<div>
										      				<b>Company</b>
										      				<small><input type="text" class="form-control" name="company"></small>
										      			</div>

										      			<div>
										      				<b>Email</b>
										      				<small><input type="email" class="form-control" name="email" required></small>
										      			</div>

										      			<div>
										      				<b>Contact Number</b>
										      				<small><input type="number" class="form-control" name="contact_number"></small>
										      			</div>

									      				<div>
										      				<b>Address</b>
										      				<small><textarea class="form-control" name="address"></textarea></small>
										      			</div>

										      			<div>
										      				<b>Currency</b>
										      				<small>
										      					<select class="form-control" name="currency">
										      						<option value="PHP">PHP</option>
										      						<option value="USD">USD</option>
										      						<option value="EUR">EUR</option>
										      						<option value="Others">Others</option>
										      					</select>
										      				</small>
										      			</div>
										      		</div>
										      	</div>
										      	<div class="modal-footer">
										        	<button type="submit" class="btn btn-outline-danger rounded-pill w-50 mx-auto">Submit</button>
										      	</div>
										    </form>
								    	</div>
								  	</div>
								</div>
							</div>
						</div>
						<div class="overflow-x-auto">
							<table class="table table-border table-hover" id="quotes">
								<thead>
								    <tr>
								      	<th scope="col">Name</th>
								      	<th scope="col">Position</th>
								      	<th scope="col">Company</th>
								      	<th scope="col">Contact Number</th>
								      	<th scope="col">Address</th>
								      	<th scope="col">Currency</th>
								    </tr>
							  	</thead>
							  	<tbody>
								    <tr>
								      	<th scope="row">Mr. John Castillo</th>
								      	<td>Junior Developer</td>
								      	<td>Elite Aces Trading Inc.</td>
								      	<td>+63</td>
								      	<td>Imus</td>
								      	<td>PHP</td>
								    </tr>
							  	</tbody>
							  	<tbody>
								    <tr>
								      	<th scope="row">Ms. Jocelyn Compoto</th>
								      	<td>Undecided</td>
								      	<td>Elite Aces Trading Inc.</td>
								      	<td>+63</td>
								      	<td>Trece</td>
								      	<td>PHP</td>
								    </tr>
							  	</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<!-- page design ends here -->

		</main>
		<script type="text/javascript">
			document.querySelector('.modal-content > form').addEventListener('submit', function(event) {
				event.preventDefault();
				var salutation = document.querySelector('.modal-body [name="salutation"]').value;
				var full_name = salutation + ' ' + document.querySelector('.modal-body [name="full_name"]').value;
				var position = document.querySelector('.modal-body [name="position"]').value;
				var company = document.querySelector('.modal-body [name="company"]').value;
				var email = document.querySelector('.modal-body [name="email"]').value;
				var contact_number = document.querySelector('.modal-body [name="contact_number"]').value;
				var address = document.querySelector('.modal-body [name="address"]').value;
				var currency = document.querySelector('.modal-body [name="currency"]').value;
				alert(full_name + '\n' + position + '\n' + company + '\n' + email + '\n' + contact_number + '\n' + address + '\n' + currency);
			});

			document.querySelectorAll('#quotes > tbody > tr > th, #quotes > tbody > tr > td').forEach(function(element) {
			    element.addEventListener('click', function() {
			        const parentRow = element.closest('tr');
			        const quoteID = parentRow.querySelector('th');
			        if (quoteID) {
			            alert(quoteID.textContent);
			        }
			    });
			});

		</script>
		<script type="text/javascript" src="navigation.js"></script>
	</body>
</html>