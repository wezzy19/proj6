<div class="container-fluid">
   <!-- Page Heading -->
   <br>
   <center>
   <h1 class="h3 mb-2 text-gray-800">Resident List</h1></center>
   <p class="mb-4">
    &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<a class="btn btn-primary" href="<?= base_url('index.php/dashboard/add-resident') ?>"> Add Resident </a>
   </p>
   <!-- DataTales Example -->
   <div class="card shadow mb-4">
      <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">List</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Full Name</th>
      <th scope="col">Address</th>
      <th scope="col">Sex</th>
      <th scope="col">Birth Date</th>
      <th scope="col">Birth Place</th>
      <th scope="col">Contact</th>
      <th scope="col">Nationality</th>
      <th scope="col">Civil Status</th>
      <th scope="col">Religion</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($resident_list as $resident_data):?>
    <tr>
      <th scope="row"><?= $resident_data->resident_id ?></th>
      <td> <?= $resident_data->first_name ?> <?= $resident_data->middle_name ?> <?= $resident_data->last_name ?></td>
      <td><?= $resident_data->purok ?>, <?= $resident_data->streetname ?>, <?= $resident_data->barangay ?></td>
      <td><?= $resident_data->sex ?></td>
      <td><?= $resident_data->birth_date ?></td>
      <td><?= $resident_data->birth_place?></td>
      <td><?= $resident_data->contact ?></td>
      <td><?= $resident_data->nationality ?></td>
      <td><?= $resident_data->civil_status ?></td>
      <td><?= $resident_data->religion ?></td>
      <td> 
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editOfficialsModal">
            Edit
        </button>
         
                        <div class="modal fade" id="editOfficialsModal" tabindex="-1" role="dialog" aria-labelledby="editOfficialsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editOfficialsModalLabel">Edit Officials Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
        <form method="post" action="<?php echo base_url('index.php/dashboard/update-resident/'.$resident_data->resident_id); ?>">
            <div class="form-row">
                <div class="form-group col">
                    <label for="firstname">First Name:</label>
                    <input type="text" name="firstname" value="<?php echo $resident_data->first_name; ?>" id="firstname" class="form-control" required />
                    <span><?= form_error('firstname') ?></span>
                </div>
                <br>
                <div class="form-group col">
                    <label for="middlename">Middle Name:</label>
                    <input type="text" name="middlename" value="<?php echo $resident_data->middle_name; ?>" id="middlename" class="form-control" required />
                    <span><?= form_error('middlename') ?></span>
                </div>
                <br>
                <div class="form-group col">
                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" value="<?php echo $resident_data->last_name; ?>" id="lastname" class="form-control" required />
                    <span><?= form_error('lastname') ?></span>
                </div>
            </div>
            <br>

            <div class="form-row">
                <div class="form-group col">
                    <label for="purok">Purok:</label>
                    <select name="purok"  value="<?php echo $resident_data->purok; ?>" id="purok" class="form-control" required>
                        <?php for ($i = 1; $i <= 7; $i++) { ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php } ?>
                    </select>
                    <span><?= form_error('purok') ?></span>
                </div>
                <br>
                <div class="form-group col">
                    <label for="street">Street Name:</label>
                    <input type="text" name="streetname" value="<?php echo $resident_data->streetname; ?>" id="street" class="form-control" required />
                    <span><?= form_error('street') ?></span>
                </div>
                <br>
                <div class="form-group col">
                    <label for="barangay">Barangay:</label>
                    <input type="text" name="barangay" value="<?php echo $resident_data->barangay; ?>" id="barangay" class="form-control" required />
                    <span><?= form_error('barangay') ?></span>
                </div>
            </div>
            <br>
            <div class="form-row">
                <div class="form-group col">
                    <label for="sex">Sex:</label>
                    <select name="sex" value="<?php echo $resident_data->sex; ?>" id="sex" class="form-control" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <span><?= form_error('sex') ?></span>
                </div>
                <br>
                <div class="form-group col">
                    <label for="birth_date">Birth Date:</label>
                    <input type="date" name="birth_date" value="<?php echo $resident_data->birth_date; ?>" id="birth_date" class="form-control" required />
                    <span><?= form_error('birth_date') ?></span>
                </div>
                <br>
                <div class="form-group col">
                    <label for="birth_place">Birth Place:</label>
                    <input type="text" name="birth_place" value="<?php echo $resident_data->birth_place; ?>" id="birth_place" class="form-control" required />
                    <span><?= form_error('birth_place') ?></span>
                </div>
            </div>
            <br>

            <div class="form-row">
                <div class="form-group col">
                    <label for="contact">Contact:</label>
                    <input type="text" name="contact" value="<?php echo $resident_data->contact; ?>" id="contact" class="form-control" required />
                    <span><?= form_error('contact') ?></span>
                </div>
                <br>
                <div class="form-group col">
                    <label for="nationality">Nationality:</label>
                    <input type="text" name="nationality" value="<?php echo $resident_data->nationality; ?>" id="nationality" class="form-control" required />
                    <span><?= form_error('nationality') ?></span>
                </div>
                <br>
                <div class="form-group col">
                    <label for="civil_status">Civil Status:</label>
                    <select name="civil_status" value="<?php echo $resident_data->civil_status; ?>" id="civil_status" class="form-control" required>
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="widowed">Widowed</option>
                        <option value="divorced">Divorced</option>
                    </select>
                    <span><?= form_error('civil_status') ?></span>
                </div>
                <br>
                <div class="form-group col">
                    <label for="religion">Religion:</label>
                    <input type="text" name="religion" value="<?php echo $resident_data->religion; ?>" id="religion" class="form-control" required />
                    <span><?= form_error('religion') ?></span>
                </div>
            </div>
            <br>
            <div class="form-group text-center">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editOfficialsModal" tabindex="-1" role="dialog" aria-labelledby="editOfficialsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editOfficialsModalLabel">Edit Officials Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
        <form method="post" action="<?php echo base_url('index.php/dashboard/update-resident/'.$resident_data->resident_id); ?>">
            <div class="form-row">
                <div class="form-group col">
                    <label for="firstname">First Name:</label>
                    <input type="text" name="firstname" value="<?php echo $resident_data->first_name; ?>" id="firstname" class="form-control" required />
                    <span><?= form_error('firstname') ?></span>
                </div>
                <br>
                <div class="form-group col">
                    <label for="middlename">Middle Name:</label>
                    <input type="text" name="middlename" value="<?php echo $resident_data->middle_name; ?>" id="middlename" class="form-control" required />
                    <span><?= form_error('middlename') ?></span>
                </div>
                <br>
                <div class="form-group col">
                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" value="<?php echo $resident_data->last_name; ?>" id="lastname" class="form-control" required />
                    <span><?= form_error('lastname') ?></span>
                </div>
            </div>
            <br>

            <div class="form-row">
                <div class="form-group col">
                    <label for="purok">Purok:</label>
                    <select name="purok"  value="<?php echo $resident_data->purok; ?>" id="purok" class="form-control" required>
                        <?php for ($i = 1; $i <= 7; $i++) { ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php } ?>
                    </select>
                    <span><?= form_error('purok') ?></span>
                </div>
                <br>
                <div class="form-group col">
                    <label for="street">Street Name:</label>
                    <input type="text" name="streetname" value="<?php echo $resident_data->streetname; ?>" id="street" class="form-control" required />
                    <span><?= form_error('street') ?></span>
                </div>
                <br>
                <div class="form-group col">
                    <label for="barangay">Barangay:</label>
                    <input type="text" name="barangay" value="<?php echo $resident_data->barangay; ?>" id="barangay" class="form-control" required />
                    <span><?= form_error('barangay') ?></span>
                </div>
            </div>
            <br>
            <div class="form-row">
                <div class="form-group col">
                    <label for="sex">Sex:</label>
                    <select name="sex" value="<?php echo $resident_data->sex; ?>" id="sex" class="form-control" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <span><?= form_error('sex') ?></span>
                </div>
                <br>
                <div class="form-group col">
                    <label for="birth_date">Birth Date:</label>
                    <input type="date" name="birth_date" value="<?php echo $resident_data->birth_date; ?>" id="birth_date" class="form-control" required />
                    <span><?= form_error('birth_date') ?></span>
                </div>
                <br>
                <div class="form-group col">
                    <label for="birth_place">Birth Place:</label>
                    <input type="text" name="birth_place" value="<?php echo $resident_data->birth_place; ?>" id="birth_place" class="form-control" required />
                    <span><?= form_error('birth_place') ?></span>
                </div>
            </div>
            <br>

            <div class="form-row">
                <div class="form-group col">
                    <label for="contact">Contact:</label>
                    <input type="text" name="contact" value="<?php echo $resident_data->contact; ?>" id="contact" class="form-control" required />
                    <span><?= form_error('contact') ?></span>
                </div>
                <br>
                <div class="form-group col">
                    <label for="nationality">Nationality:</label>
                    <input type="text" name="nationality" value="<?php echo $resident_data->nationality; ?>" id="nationality" class="form-control" required />
                    <span><?= form_error('nationality') ?></span>
                </div>
                <br>
                <div class="form-group col">
                    <label for="civil_status">Civil Status:</label>
                    <select name="civil_status" value="<?php echo $resident_data->civil_status; ?>" id="civil_status" class="form-control" required>
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="widowed">Widowed</option>
                        <option value="divorced">Divorced</option>
                    </select>
                    <span><?= form_error('civil_status') ?></span>
                </div>
                <br>
                <div class="form-group col">
                    <label for="religion">Religion:</label>
                    <input type="text" name="religion" value="<?php echo $resident_data->religion; ?>" id="religion" class="form-control" required />
                    <span><?= form_error('religion') ?></span>
                </div>
            </div>
            <br>
            <div class="form-group text-center">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>

                    </div>
      <a class="btn btn-danger btn-sm" href="<?= base_url('index.php/dashboard/delete-resident/'.$resident_data->resident_id); ?>" >Delete</a>
      
    </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
</div>
      </div>
   </div>
</div>
