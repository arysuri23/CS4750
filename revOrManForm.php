
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Friendbook</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  <h1>Sign up as a Reviewer or Restaurant Manager!</h1>
  <form name="revOrManForm" action="home.php" method="post">
    <div class="row mb-3 mx-3">
     Display Name:
      <input type="text" class="form-control" name="name" required /> 
    </div> 
    <div class="row mb-3 mx-3"> 
    Select your role:
    </div>
    <div > 
      
      <input type="radio" id="Restaurant Manager" name="revOrMan" value="Restaurant Manager">
      <label for="Restaurant Manager">Restaurant Manager</label> <br>
      <input type="radio" id="Restaurant Reviewer" name="revOrMan" value="Restaurant Reviewer">
      <label for="Restaurant Reviewer">Restaurant Reviewer</label>
    </div>

    <div class="row mb-3 mx-3">
    <input type="submit" name="actionBtn" value="Submit"  />
  </div> 
<hr/>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>


