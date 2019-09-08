<!--create connection to DB-->
<?php
require_once('config.php');
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Mikes Demo | PHP</title>
    <!--link to bootstrap CSS/js-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </head>
  <body>
    <div>
      <!--read form data and insert into library-->
      <?php
        if(isset($_POST['create'])){
          $firstname    = $_POST['firstname'];
          $lastname     = $_POST['lastname'];
          $email        = $_POST['email'];
          $gender       = $_POST['gender'];
          $age          = $_POST['age'];
          $message      = $_POST['message'];
          if(isset($_POST['newsletter']) &&
          $_POST['newsletter'] == 1)
          {
            $newslet = 1;
          }
          else {
            $newslet = 0;
          }
          $serv      = $_POST['service'];

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $sql = "INSERT INTO submissions(first_name, surname, email, gender, age, message, newsletter, service ) VALUES(?,?,?,?,?,?,?,?)";
        $stmtinsert = $db->prepare($sql);
        $result = $stmtinsert->execute([$firstname, $lastname, $email, $gender, $age, $message, $newslet, $serv]);
        if($result){
          echo 'Success';
        }
        else{
          echo 'Sign up failed';
        }
}
       ?>
    </div>
    <div>
      <form action="registration.php" method="post">
        <div class="card">
          <div class="card-header">
             <h1>Sign up</h1>
          </div>
          <div class="card-body">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <p class="lead">Please fill out the form with correct values. </p>
              <hr>
            </div>
            <div class="col-6">
                <label for="firstname"><b>First name</b></label>
                <input class="form-control" id="firstname"  type="text" name="firstname" required>
            </div>
            <div class="col-6">
                <label for="lastname"><b>Last name</b></label>
                <input class="form-control" id="lastname"  type="text" name="lastname" required>
            </div>
            <div class="col-6">
                <label for="email"><b>E-Mail Address</b></label>
                <input class="form-control" id="email" type="email" name="email" required>
            </div>
            <div class="col-6">
                <label for="gender"><b>Gender</b></label>
                <select name="gender" id="gender" class="form-control" required>
                  <option value="">-Select Value-</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
            </div>
            <div class="col-6">
                <label for="age"><b>Age</b></label>
                <input class="form-control" id="age"  type="number" name="age" min="1" max="99" required>
              </div>
            <div class="col-6">
                <label for="user_text"><b>Message</b></label>
                <textarea class="form-control" id="message" name="message"></textarea>
            </div>
            <div class="col-2">
                <label for="newsletter"><b>Newsletter Signup: </b></label>
            </div>
            <div class="col-2">
                <input type="checkbox" id="newsletter" name="newsletter" value="1" >Yes
            </div>
            <div class="col-2">
                <input type="checkbox" id="newsletter" name="newsletter" value="0">No
              </div>
              <div class="col-6">
                <label for="service"><b>Service:</b></label>
                <div class="row">
                  <div class="col-3">
                    <input type="radio" id="service" name="service" value="design" required>&nbsp;Design<br>
                  </div>
                  <div class="col-4">
                    <input type="radio" id="service" name="service" value="development">&nbsp;Development<br>
                  </div>
                  <div class="col-3">
                    <input type="radio" id="service" name="service" value="optimisation"> Optimisation<br>
                  </div>
                  <div class="col-2">
                    <input type="radio" id="service" name="service" value="paid search"> Other
                  </div>
                </div>
              </div>
             </div>
            </div>
           </div>

          <div class="card-footer">
            <input type="submit" id="register" class="btn btn-primary" name="create" value="Sign up" />
          </div>
        </div>
       </div>
      </form>
    </div>
    <!--CDN jQuery library-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--CDN sweet alert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
	$(function(){
    <!--submit button click-->
		$('#register').click(function(e){
			var valid = this.form.checkValidity();
			if(valid){
        <!--check if each field has value-->
        var firstname   = $(#firstname).val();
        var lastname    = $(#lastname).val();
        var email       = $(#email).val();
        var gender      = $(#gender:checked).val();
        var age         = $(#age).val();
        var message     = $(#message).val();
        var newsletter  = $(#newsletter:checked).val();
        var service     = $(#service:checked).val();

				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: 'process.php',
					data: {firstname: firstname,lastname: lastname,email: email,gender: gender,age: age,message: message,newsletter: newsletter,service: service},
					success: function(data){
					Swal.fire({
								'title': 'Successful',
								'text': data,
								'type': 'success'
								})

					},
					error: function(data){
						Swal.fire({
								'title': 'Errors',
								'text': 'There were errors while saving the data.',
								'type': 'error'
								})
					}
				});

			}else{

			}

		});

	});

</script>
  </body>
</html>
