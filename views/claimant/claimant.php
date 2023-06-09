<?php 
if(!isset($_SESSION['email'])){header('location: ../auth/login.php');}
define('CONTROLLERS1',$_SERVER['DOCUMENT_ROOT']."/fms/controllers/");
require_once(CONTROLLERS1.'userController.php');
$userController = new UserController();

$claimants = $userController->fetchAllClaimants();

?>

<div class="tab-content rounded-bottom card">
    <div class="p-3">
        <div>
            <span><big><b>List of claimants in the system</b></big></span>
            <a href="temp.php?page=claimant/print-claimant" class="btn btn-secondary float-end">Print Claimants</a>
        </div>
        
        <hr>
        <br>

        <table class="table table-striped table-bordered" style="width:100%"  id="datatable">
            <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>National Id</th>
                <th>EC Number</th>
                <th>Department</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                <?php 
                $count = 1;
                foreach($claimants as $claimant){
                    echo '
                        <tr>
                            <td>'.$count++.'</td>
                            <td scope="row">'.$claimant->getFirstName().'</td>
                            <td>'.$claimant->getLastName().'</td>
                            <td>'.$claimant->getNationalId().'</td>
                            <td>'.$claimant->getEcNumber().'</td>
                            <td>'.$claimant->getDepartment().'</td>
                            <td>
                                <form action="claimant/route.php">
                                <input type="number" name="claimant_id" class="visually-hidden" value="'.$claimant->getId().'" />
                                    <div class="dropdown open">
                                        <a type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span>
                                                <svg class="icon  text-muted">
                                                    <use xlink:href="../assets/vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                                                </svg>
                                            </span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                            <button class="dropdown-item" type="submit" name="view-documents">view documents</button>
                                            <button class="dropdown-item" type="submit" name="edit">Edit</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    ';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
