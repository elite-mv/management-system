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
							    	<div class="collapse overflow-hidden" id="Collapse1">
							      		<div class="card card-body rounded-0 container-fluid">
							      			<div class="gap-3 px-3 row">
							      				<div class="col-auto d-flex align-items-center justify-content-center gap-3 border px-3 py-1 bg-light">
				      								<div>
				      					  				<input type="radio" name="filters" class="me-2"><small>A-Z</small>
				      								</div>
				      								<div>
				      					  				<input type="radio" name="filters" class="me-2"><small>Z-A</small>
				      								</div>
							      				</div>
							      				<div class="col-auto d-flex align-items-center justify-content-center gap-3 border px-3 py-1 bg-light">
				      								<div>
				      					  				<input type="radio" name="filters" class="me-2"><small>0-9</small>
				      								</div>
				      								<div>
				      					  				<input type="radio" name="filters" class="me-2"><small>9-0</small>
				      								</div>
							      				</div>
							      				<div class="col-auto d-flex align-items-center justify-content-center gap-3 border px-3 py-1 bg-light">
							      					<div>
							      						<input type="radio" name="filters" class="me-2"><small>By Customer</small>
								      				</div>
								      				<div>
								      					<input type="radio" name="filters" class="me-2"><small>By Sales Officer</small>
								      				</div>
								      				<div>
								      					<input type="radio" name="filters" class="me-2"><small>By Company</small>
								      				</div>
								      				<div>
								      					<input type="radio" name="filters" class="me-2"><small>By Unit</small>
								      				</div>
							      				</div>
							      				<div class="col-auto d-flex align-items-center justify-content-center gap-3 border px-3 py-1 bg-light">
							      					<div class="d-flex align-items-center flex-direction-row gap-3 w-100" style="justify-content: space-around;">
							      						<div class="p-3" style="border: 1px solid #000; border-style: none solid none none;">
							      							<div class="d-flex flex-direction-row gap-3 w-100" style="justify-content: space-around;">
							      								<div class="d-flex align-items-center">
							      									<input type="radio" name="filters" class="me-2"><small><</small>
							      								</div>
							      								<div class="d-flex align-items-center">
							      									<input type="radio" name="filters" class="me-2"><small>=</small>
							      								</div>
							      								<div class="d-flex align-items-center">
							      									<input type="radio" name="filters" class="me-2"><small>></small>
							      								</div>
							      							</div>
							      						</div>

							      						<div class="p-3 overflow-auto">
							      							<div class="d-flex align-items-center gap-3">
							      								<div>
							      									<small><input type="number" placeholder="Enter desired amount." class="form-control"></small>
							      								</div>
							      							</div>
							      						</div>
							      					</div>
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
								<b>List of Quotes</b>
							</div>
							
							<div class="col-auto p-0 ms-auto" style="display: flex; justify-content: center; align-items: center;">

								<button type="button" class="btn btn-sm btn-danger rounded-0 align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
								  	<i class="fas fa-plus-circle me-2"></i>QUOTATION
								</button>

								<div class="modal fade text-dark" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  	<div class="modal-dialog modal-xl">
								    	<div class="modal-content">
								    		<form>
										      	<div class="modal-header">
										        	<h1 class="modal-title fs-5" id="exampleModalLabel">Quote Configuration</h1>
										        	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										      	</div>
										      	<div class="modal-body">
										      		<div class="d-flex gap-3" style="flex-direction: column;">
										      			<div>
										      				<b>Customer Name</b>
										      				<small><select class="px-3 form-control">
										      					<option value="">Select a customer</option>
										      					<option value="Add new customer">Add new customer</option>
										      				</select></small>
										      			</div>

										      			<div class="d-flex flex-direction-row gap-3">
										      				<div class="w-50">
										      					<b>Start Date</b>
										      					<small><input type="date" class="form-control" name="start_date" disabled></small>
										      				</div>
										      				<div class="w-50">
										      					<b>Expiry Date</b>
										      					<small><input type="date" class="form-control" name="expiry_date"></small>
										      				</div>
										      			</div>

										      			<div>
										      				<b>Email Subject</b>
										      				<small><textarea class="form-control" placeholder="Let your customer know what this Quote is for..."></textarea></small>
										      			</div>

										      			<div style="overflow-x: auto;">
										      				<table class="table table-bordered" id="quotation_item">
										      					<thead>
										      					    <tr>
										      					      	<th scope="col" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">UNIT DETAILS</th>
										      					      	<th scope="col" class="text-end ps-5" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">QUANTITY</th>
										      					      	<th scope="col" class="text-end ps-5" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">UNIT COST</th>
										      					      	<th scope="col" class="text-end ps-5" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">DISCOUNT(%)</th>
										      					      	<th scope="col" class="text-end ps-5" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">AMOUNT</th>
										      					    </tr>
										      				  	</thead>
										      				  	<tbody>
										      					    <tr>
										      					      	<th scope="row" class="p-0"><input type="text" class="p-2 rounded-0 border-0 form-control" placeholder="Type the unit details." style="width: 300px;"></th>
										      					      	<td class="p-0"><input type="text" class="p-2 rounded-0 border-0 text-end form-control" value="1.00"></td>
										      					      	<td class="p-0"><input type="text" class="p-2 rounded-0 border-0 text-end form-control" value="0.00"></td>
										      					      	<td class="p-0"><input type="text" class="p-2 rounded-0 border-0 text-end form-control" value="0"></td>
										      					      	<td class="p-0"><input type="text" class="p-2 rounded-0 border-0 text-end form-control" value="0.00" disabled></td>
										      					    </tr>
										      				  	</tbody>
										      				</table>
										      			</div>

										      			<div class="d-flex flex-direction-row gap-3">
									      					<div class="d-flex flex-direction-row" style="height: 50%; width: 50%;">
									      						<button class="btn btn-outline-danger rounded-0" name="add_item">+ ITEM</button>
									      						<input type="number" value="1" min="1" max="100" name="add_item_number" class="px-2 rounded-0 border-1 text-end" style="width: 60px; border-style: solid solid solid none;">
									      					</div>
									      					<div class="d-flex p-3 w-100 bg-light gap-2" style="flex-direction: column; border-radius: 10px;">
									      						<div class="d-flex" style="justify-content: left;">
									      							<div>
									      								<b>Sub Total</b>
									      							</div>
									      							<div class="ms-auto">
									      								<b>0.00</b>
									      							</div>
									      						</div>
									      						
									      						<div class="d-flex" style="justify-content: left;">
									      							<div class="d-flex flex-direction-row align-items-center">
									      								<small>Discount</small>
									      								<input type="number" class="px-2 rounded-0 border border-dark text-end ms-3" style="width: 60px; border-style: solid none solid solid !important;" value="0">
									      								<b class="border border-dark rounded-0 px-2" style="border-style: solid solid solid none !important;">%</b>
									      							</div>
									      							<div class="ms-auto">
									      								<small>0.00</small>
									      							</div>
									      						</div>

									      						<div class="d-flex" style="justify-content: left;">
									      							<div class="d-flex flex-direction-row align-items-center">
									      								<small>Shipping Charges</small>
									      								<input type="number" class="px-2 rounded-0 border border-dark text-end ms-3" style="width: 60px;" value="0">
									      							</div>
									      							<div class="ms-auto">
									      								<small>0.00</small>
									      							</div>
									      						</div>

									      						<hr class="m-0 mt-2">

									      						<div class="d-flex" style="justify-content: left;">
									      							<div>
									      								<b>Total <span>(PHP)</span></b>
									      							</div>
									      							<div class="ms-auto">
									      								<b>0.00</b>
									      							</div>
									      						</div>
									      					</div>
									      				</div>

									      				<div>
										      				<b>Customer Notes</b>
										      				<small><textarea class="form-control">Looking forward for your business.</textarea></small>
										      			</div>

										      			<div>
										      				<b>Terms & Condition</b>
										      				<small><textarea class="form-control">By clicking accept, you'll be redirected to our secured system where you can further process this quote.</textarea></small>
										      			</div>
										      		</div>
										      	</div>
										      	<div class="modal-footer">
										        	<button type="submit" class="btn btn-primary rounded-0">Submit & Send</button>
										      	</div>
										    </form>
								    	</div>
								  	</div>
								</div>
							</div>
						</div>
						<table class="table table-border table-hover" id="quotes">
							<thead>
							    <tr>
							      	<th scope="col">QT#</th>
							      	<th scope="col">Date</th>
							      	<th scope="col">Sales Officer</th>
							      	<th scope="col">Customer</th>
							      	<th scope="col">Unit</th>
							      	<th scope="col" class="text-end">Amount</th>
							    </tr>
						  	</thead>
						  	<tbody>
							    <tr>
							      	<th scope="row">20241231-001</th>
							      	<td>1111-11-11</td>
							      	<td>Jocelyn</td>
							      	<td>John</td>
							      	<td>KOTSE</td>
							      	<td class="text-end">1,111,111.11</td>
							    </tr>
						  	</tbody>
						  	<tbody>
							    <tr>
							      	<th scope="row">20241231-002</th>
							      	<td>1111-11-11</td>
							      	<td>Jocelyn</td>
							      	<td>John</td>
							      	<td>KOTSE</td>
							      	<td class="text-end">1,111,111.11</td>
							    </tr>
						  	</tbody>
						</table>
					</div>
				</div>
			</div>

			<!-- page design ends here -->

		</main>
		<script type="text/javascript">
			window.addEventListener('load', function() {
			    const today = new Date();
			    const formattedDate = today.toISOString().split('T')[0];
			    document.querySelector('.modal-body [name="start_date"]').value = formattedDate;
				document.querySelector('.modal-body [name="expiry_date"]').min = formattedDate;
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

			$('.modal-body [name="add_item_number"]').on('input', function() {
				if ($(this).val() < 1) {
					$(this).val(1);
				} else if ($(this).val() > 100) {
					$(this).val(100);
				}
			})

			document.querySelector('.modal-body [name="add_item"]').addEventListener('click', function(event) {
			    event.preventDefault();

			    const quantity = document.querySelector('.modal-body [name="add_item_number"]').value;

                for (let i = 0; i < quantity; i++) {
                    const newRow = `
                        <tr>
                            <th scope="row" class="p-0 border">
                                <input type="text" class="p-2 rounded-0 border-0 form-control" placeholder="Type the unit details." style="width: 300px;">
                            </th>
                            <td class="p-0 border">
                                <input type="text" class="p-2 rounded-0 border-0 text-end form-control" value="1.00">
                            </td>
                            <td class="p-0 border">
                                <input type="text" class="p-2 rounded-0 border-0 text-end form-control" value="0.00">
                            </td>
                            <td class="p-0 border">
                                <input type="text" class="p-2 rounded-0 border-0 text-end form-control" value="0">
                            </td>
                            <td class="p-0 border">
                                <input type="text" class="p-2 rounded-0 border-0 text-end form-control" value="0.00" disabled>
                            </td>
                        </tr>
                    `;
                    $('#quotation_item').append(newRow);
                }

                document.querySelector('.modal-body [name="add_item_number"]').value = '1';
			});

			document.querySelector('.modal-header .btn-close').addEventListener('click', function(event) {
			    document.querySelectorAll('.modal-content [name="expiry_date"]]').value = '';
			});
		</script>
		<script type="text/javascript" src="navigation.js"></script>
	</body>
</html>