<?php
include_once 'header.php';
if ($_SESSION['user_group'] == "Super Admin"):
?>
<div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="card-box">
                                <h4 class="header-title m-t-0 m-b-30">Plotësoni të dhënat</h4>
                            <?php
                                        if(isset($_GET['error']))
                                        {
                                              ?>
                                        <div class="col-md-12">
                                            <div class="alert alert-danger alert-dismissable" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    Dicka nuk shkoj sic duhet! Ju lutem provojeni përsëri
                                            </div>
                                        </div>
                                        
                                        <?php
                                           
                                        }
                                        else if(isset($_GET['registered']))
                                        {
                                             ?>
                                             <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable" >
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        Përdoruesi u shtua me sukses
                                                </div>
                                            </div>
                                             
                                              <?php
                                        }
                                        ?>
                                        
                                        <?php
                                            if (isset($_POST['submit']))  {
                                            
                                                $db_host = "localhost";
                                                $db_name = "db_name";
                                                $db_user = "";
                                                $db_pass = "";
                                            
                                                try {
                                                    $conn1 = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
                                            
                                                    // set the PDO error mode to exception
                                                    $conn1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            
                                                    // prepare sql and bind parameters
                                                     $stmt1 = $conn1->prepare('INSERT INTO users (user_first_name,user_last_name,user_email,user_pass,position,user_kategori,user_img,login_status,created) VALUES(:firstname,:lastname,:email,sha256(:password),:position,:role,:img_user,:status,:date_create)');
                                            
                                                    $stmt1->bindParam(':firstname', $firstname);
                                                    $stmt1->bindParam(':lastname', $lastname);
                                                    $stmt1->bindParam(':email', $email);
                                                    $stmt1->bindParam(':password', $password);
                                                    $stmt1->bindParam(':role', $role);
                                                    $stmt1->bindParam(':position', $position);
                                                    $stmt1->bindParam(':status', $status);
                                                    $stmt1->bindParam(':date_create', $date_create);
                                            
                                                    $firstname = $_POST['name'];
                                                    $lastname = $_POST['lname'];
                                                    $email = $_POST['email'];
                                                    $password = $_POST['password'];
                                                    $role = $_POST['roli'];
                                                    $position = $_POST['position'];
                                                    $img_user = 'user.png';
                                                    $images =  $role.$img_user;
                                                    $status =  'Active';
                                                    $date_create = $_POST['date_create'];
                                            
                                            
                                                    $stmt1->execute();
                                                    
                                                     if ($stmt1) { 
                                                       echo '<script>location.replace("shto_staf?registered")</script>';
                                                  }else{
                                                      echo '<script>location.replace("shto_staf?error")</script>';
                                                  }
                                                }
                                                catch(PDOException $e)
                                                {
                                                echo "Error: " . $e->getMessage();
                                                }
                                                $conn1 = null;
                                            }
                                            
                                            
                                            ?>
                                    <form action="" method="POST">
                                        <div class="row">
                                            <div class="col-xl-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Emër</label>
                                                    <input type="text" name="name" parsley-trigger="change" required placeholder="Vendosni emrin" class="form-control" id="name">
                                                </div>
                                            </div>
                                            
                                            <div class="col-xl-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="lname">Mbiemër</label>
                                                    <input type="text" name="lname" parsley-trigger="change" required placeholder="Vendosni mbiemrin" class="form-control" id="lname">
                                                </div>
                                            </div>
                                            
                                            <div class="col-xl-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="position">Pozicioni</label>
                                                    <input type="text" name="position" parsley-trigger="change" required placeholder="Vendosni pozicionin e punës" class="form-control" id="position">
                                                </div>
                                            </div>
                                            
                                            <div class="col-xl-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" parsley-trigger="change" required placeholder="Vendosni email" class="form-control" id="email">
                                                </div>
                                            </div>
                                            
                                            <div class="col-xl-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="roli">Roli</label>
                                                    <select name="roli" parsley-trigger="change" required class="form-control" id="roli">
                                                        <option>Selekto Rolin</option>
                                                        <option value="Super Admin">Super Admin</option>
                                                        <option value="User">User</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xl-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <div class="input-group icon">
                                                        <input type="password" name="password" parsley-trigger="change" required placeholder="Vendosni fjalëkalimin" class="form-control" id="password">
                                                        <button type="button" class="input-group-addon" onclick="myFunction()"> <i class="mdi mdi-eye-off"></i> </button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <script>
                                                    function myFunction() {
                                                          var x = document.getElementById("password");
                                                          if (x.type === "password") {
                                                            x.type = "text";
                                                          } else {
                                                            x.type = "password";
                                                          }
                                                        }
                                                </script>
                                
                                             <input type="hidden" name="date_create" value="<?php $date = new DateTime("now", new DateTimeZone('Europe/Rome') ); echo $date->format('Y-m-d H:i:s'); ?>">
                                            
                                        </div>
                                        <div class="form-group text-right m-b-0">
                                            <button class="btn btn-info waves-effect waves-light" name="submit" type="submit">
                                                Shto
                                            </button>
                                            <a href="stafi" class="btn btn-secondary waves-effect waves-light m-l-5">Dil</a>
                                        </div>

                                    </form>
                            </div>
                        </div>
                    </div>
                        
                </div> <!-- container -->
            </div> <!-- content -->
            
     
                                
                                
<?php else:
include_once'include/401.php';
 endif; 
include_once'footer.php'; ?>
