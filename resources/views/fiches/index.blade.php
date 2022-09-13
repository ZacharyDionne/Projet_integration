<!doctype html>
<html lang="en">
  <head>
  	<title>Fiche</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
<!--===============================================================================================-->
	<link rel="stylesheet" href="fonts\font-awesome-4.7.0\css\font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" href="css/styleCalendar.css">
<!--===============================================================================================-->

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Fiche - {Nom}</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="elegant-calencar d-md-flex">
						<div class="wrap-header d-flex align-items-center img" style="background-image: url(images/bgCalendar.png);">
				      <p id="reset">Aujourd'hui</p>
			        <div id="header" class="p-0">
								<!-- <div class="pre-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-left"></i></div> -->
		            <div class="head-info">
		            	<div class="head-month"></div>
		                <div class="head-day"></div>
		            </div>
		            <!-- <div class="next-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-right"></i></div> -->
			        </div>
			      </div>
			      <div class="calendar-wrap">
			      	<div class="w-100 button-wrap">
				      	<div class="pre-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-left"></i></div>
				      	<div class="next-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-right"></i></div>
			      	</div>
			        <table id="calendar">
		            <thead>
		                <tr>
	                    <th>Dim</th>
	                    <th>Lun</th>
	                    <th>Mar</th>
	                    <th>Mer</th>
	                    <th>Jeu</th>
	                    <th>Ven</th>
	                    <th>Sam</th>
		                </tr>
		            </thead>
		            <tbody>
	                <tr>
	                  <td data-toggle="modal" data-target="#exampleModalCenter"></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                </tr>
	                <tr>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                </tr>
	                <tr>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                </tr>
	                <tr>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                </tr>
	                <tr>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                </tr>
	                <tr>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                  <td></td>
	                </tr>
		            </tbody>
			        </table>
			      </div>
			    </div>
				</div>
			</div>
		</div>
	</section>

	    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content rounded-0">
          <div class="modal-body py-0">

            
            <div class="d-flex main-content">
              <div class="bg-image promo-img mr-3" style="background-image: url('images/img_1.jpg');">
              </div>
              <div class="content-text p-4">
                <h3>Sign up to access all the resourcess</h3>
                <p>All their equipment and instruments are alive. The sky was cloudless and of a deep dark blue.</p>
				<!--  -->

                <form action="#">
                  <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email">
                  </div>
                  <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" class="form-control" id="name">
                  </div>
                  <div class="form-group">
                    <label for="name">Password</label>
                    <input type="password" class="form-control" id="name">
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Sign up" class="btn btn-primary btn-block">
                  </div>
                  <div class="form-group ">
                    <p class="custom-note"><small>By signing up you will agree to our <a href="#">Privacy Policy</a></small></p>
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="js/mainCalendar.js"></script>

	</body>
</html>

