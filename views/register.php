<h1>Register</h1>
<div class="row">
   <?php $form = \app\core\form\Form::begin('', "post") ?>;
   <?php echo $form->field($model, 'firstname') ?>;
   <?php echo $form->field($model, 'lastname') ?>;
   <?php echo $form->field($model, 'email') ?>;
   <?php echo $form->field($model, 'password') ?>;
   <?php echo $form->field($model, 'repeatPassword') ?>;
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\form\Form::end() ?>;


<!-- <form action="" method="post">
   <div class="row">
      <div class="col">
         <div class="mb-3">
            <label for="subjectTitle" class="form-label">First name</label>
            <input type="text" name='firstname' class="form-control">
         </div>
      </div>
      <div class="col">
         <div class="mb-3">
            <label for="exampleInputPassword" class="form-label">Last name</label>
            <input type="text" name='lastname' class="form-control">
         </div>
      </div>
   </div>
   <div class="mb-3">
      <label for="exampleInputPassword" class="form-label">Email</label>
      <input type="email" name="email" class="form-control">
      <div class="mb-3">
         <label for="exampleInputPassword" class="form-label">password</label>
         <input type="text" name='password' class="form-control">
      </div>
      <div class="mb-3">
         <label for="exampleInputPassword" class="form-label">Repeat Password</label>
         <input type="text" name='repeatPassword' class="form-control">
      </div>
      <div class="mb-3 form-check">
         <input type="checkbox" class="form-check-input" id="exampleCheck1">
         <label class="form-check-label" name='checkout' for="exampleCheck1">Check me out</label>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
</form> -->