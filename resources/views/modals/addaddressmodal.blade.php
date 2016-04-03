<div class="modal-dialog">
  <!-- Modal content-->
  <form class="form-horizontal" method="POST" action="user/addAddress">
  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Voeg een niewe gebruiker toe</h4>
    </div>
    <div class="modal-body">
         <div class="form-group">
          <label for="street" class="col-sm-2 control-label">Straat</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="street" name="street" placeholder="Straat">
          </div>
        </div>
        <div class="form-group">
         <label for="streetnumber" class="col-sm-2 control-label">Huisnummer</label>
         <div class="col-sm-10">
           <input type="text" class="form-control" id="streetnumber" name="streetnumber" placeholder="Huisnummer">
         </div>
       </div>
       <div class="form-group">
        <label for="bus" class="col-sm-2 control-label">Bus</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="bus" name="bus" placeholder="Bus">
        </div>
      </div>
       <div class="form-group">
        <label for="zipcode" class="col-sm-2 control-label">Postcode</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Postcode">
        </div>
      </div>
      <div class="form-group">
       <label for="city" class="col-sm-2 control-label">Stad</label>
       <div class="col-sm-10">
         <input type="text" class="form-control" id="city" name="city" placeholder="Stad">
       </div>
     </div>
     <div class="form-group">
      <label for="country" class="col-sm-2 control-label">Land</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="country" name="country" placeholder="Land">
      </div>
    </div>
    </div>
    <div class="modal-footer">
      <input type="submit" class="btn btn-primary" name="submit" value="Submit"/>
      <button type="button" class="btn btn-default" data-dismiss="modal">Sluit</button>
    </div>
  </div>
  </form>
</div>
