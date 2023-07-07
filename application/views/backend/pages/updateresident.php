<!-- Main Content -->
<div id="content">
    <div class="container">

        <br>
        <br>
        <h2 class="text-center">EDIT RESIDENT INFORMATION</h2>
        <br>
        <br>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editResidentModal">
            Edit
        </button>

        <div class="modal fade" id="editResidentModal" tabindex="-1" role="dialog" aria-labelledby="editResidentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="<?php echo base_url('index.php/dashboard/update-resident/'.$resident_data->resident_id); ?>">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="firstname">First Name:</label>
                                <input type="text" name="firstname" value="<?php echo $resident_data->first_name; ?>" id="firstname" class="form-control" required />
                                <span><?= form_error('firstname') ?></span>
                            </div>
                            <div class="form-group col">
                                <label for="middlename">Middle Name:</label>
                                <input type="text" name="middlename" value="<?php echo $resident_data->middle_name; ?>" id="middlename" class="form-control" required />
                                <span><?= form_error('middlename') ?></span>
                            </div>
                            <div class="form-group col">
                                <label for="lastname">Last Name:</label>
                                <input type="text" name="lastname" value="<?php echo $resident_data->last_name; ?>" id="lastname" class="form-control" required />
                                <span><?= form_error('lastname') ?></span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="purok">Purok:</label>
                                <select name="purok" id="purok" class="form-control" required>
                                    <?php for ($i = 1; $i <= 7; $i++) { ?>
                                        <option value="<?= $i ?>" <?php if ($resident_data->purok == $i) echo 'selected'; ?>><?= $i ?></option>
                                    <?php } ?>
                                </select>
                                <span><?= form_error('purok') ?></span>
                            </div>
                            <div class="form-group col">
                                <label for="street">Street Name:</label>
                                <input type="text" name="streetname" value="<?php echo $resident_data->streetname; ?>" id="street" class="form-control" required />
                                <span><?= form_error('streetname') ?></span>
                            </div>
                            <div class="form-group col">
                                <label for="barangay">Barangay:</label>
                                <input type="text" name="barangay" value="<?php echo $resident_data->barangay; ?>" id="barangay" class="form-control" required />
                                <span><?= form_error('barangay') ?></span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="sex">Sex:</label>
                                <select name="sex" id="sex" class="form-control" required>
                                    <option value="male" <?php if ($resident_data->sex == 'male') echo 'selected'; ?>>Male</option>
                                    <option value="female" <?php if ($resident_data->sex == 'female') echo 'selected'; ?>>Female</option>
                                </select>
                                <span><?= form_error('sex') ?></span>
                            </div>
                            <div class="form-group col">
                                <label for="birth_date">Birth Date:</label>
                                <input type="date" name="birth_date" value="<?php echo $resident_data->birth_date; ?>" id="birth_date" class="form-control" required />
                                <span><?= form_error('birth_date') ?></span>
                            </div>
                            <div class="form-group col">
                                <label for="birth_place">Birth Place:</label>
                                <input type="text" name="birth_place" value="<?php echo $resident_data->birth_place; ?>" id="birth_place" class="form-control" required />
                                <span><?= form_error('birth_place') ?></span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="contact">Contact:</label>
                                <input type="text" name="contact" value="<?php echo $resident_data->contact; ?>" id="contact" class="form-control" required />
                                <span><?= form_error('contact') ?></span>
                            </div>
                            <div class="form-group col">
                                <label for="nationality">Nationality:</label>
                                <input type="text" name="nationality" value="<?php echo $resident_data->nationality; ?>" id="nationality" class="form-control" required />
                                <span><?= form_error('nationality') ?></span>
                            </div>
                            <div class="form-group col">
                                <label for="civil_status">Civil Status:</label>
                                <select name="civil_status" id="civil_status" class="form-control" required>
                                    <option value="single" <?php if ($resident_data->civil_status == 'single') echo 'selected'; ?>>Single</option>
                                    <option value="married" <?php if ($resident_data->civil_status == 'married') echo 'selected'; ?>>Married</option>
                                    <option value="widowed" <?php if ($resident_data->civil_status == 'widowed') echo 'selected'; ?>>Widowed</option>
                                    <option value="divorced" <?php if ($resident_data->civil_status == 'divorced') echo 'selected'; ?>>Divorced</option>
                                </select>
                                <span><?= form_error('civil_status') ?></span>
                            </div>
                            <div class="form-group col">
                                <label for="religion">Religion:</label>
                                <input type="text" name="religion" value="<?php echo $resident_data->religion; ?>" id="religion" class="form-control" required />
                                <span><?= form_error('religion') ?></span>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
