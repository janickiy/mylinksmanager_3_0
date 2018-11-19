<!-- INCLUDE header.tpl -->
<div class="row">
  <div class="col-md-12">
    <form action="${ACTION}" method="post" role="form">
      <div class="form-group">
        <label for="current_password"> ${STR_CURRENT_PASSWORD} </label>
        <input type="password" class="form-control" name="current_password">
      </div>
      <div class="form-group">
        <label for="password"> ${STR_NEW_PASSWORD} </label>
        <input type="password" class="form-control" name="password">
      </div>
      <div class="form-group">
        <label for="password_again"> ${STR_NEW_PASSWORD_AGAIN} </label>
        <input type="password" class="form-control" name="password_again">
      </div>
      <button class="btn btn-primary" type="submit">${BUTTON_SAVE}</button>
      <input type=hidden name="action" value="post">
    </form>
  </div>
</div>
<!-- INCLUDE footer.tpl -->
