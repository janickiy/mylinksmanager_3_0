<!-- INCLUDE header.tpl -->
<div class="row">
  <div class="col-md-12">
    <form method="POST" action="${PHP_SELF}" role="form">
      <div class="form-group">
        <label for="style">${STR_FILE} style.css</label>
        <textarea class="form-control" rows="3" name="style">${BUFER1}</textarea>
      </div>
      <button class="btn btn-default" type="submit">${BUTTON_SAVE_CHANGES_IN} style.css</button>
      <input type="hidden" name="action" value="style">
    </form>
    <p>&nbsp;</p>
    <form method="POST" action="${PHP_SELF}" role="form">
      <div class="form-group">
        <label for="header">${STR_FILE} header.tpl</label>
        <textarea class="form-control" rows="3" name="header">${BUFER2}</textarea>
      </div>
      <button class="btn btn-default" type="submit">${BUTTON_SAVE_CHANGES_IN} header.tpl</button>
      <input type=hidden name="action" value="header">
    </form>
    <p>&nbsp;</p>
    <form method="POST" action="${PHP_SELF}" role="form">
      <div class="form-group">
        <label for="index">${STR_FILE} index.tpl</label>
        <textarea class="form-control" rows="3" name="index">${BUFER4}</textarea>
      </div>
      <button class="btn btn-default" type="submit">${BUTTON_SAVE_CHANGES_IN} links.tpl</button>
      <input type="hidden" name="action" value="index">
    </form>
    <p>&nbsp;</p>
    <form method="POST" action="${PHP_SELF}" role="form">
      <div class="form-group">
        <label for="add_url">${STR_FILE} add_url.tpl</label>
        <textarea class="form-control" rows="3" name="index">${BUFER5}</textarea>
      </div>
      <button class="btn btn-default" type="submit">${BUTTON_SAVE_CHANGES_IN} add_url.tpl</button>
      <input type="hidden" name="action" value="add_url">
    </form>
    <p>&nbsp;</p>
    <form method="POST" action="${PHP_SELF}" role="form">
      <div class="form-group">
        <label for="footer">${STR_FILE} footer.tpl</label>
        <textarea class="form-control" rows="3" name="footer">${BUFER3}</textarea>
      </div>
      <button class="btn btn-default" type="submit">${BUTTON_SAVE_CHANGES_IN} footer.tpl</button>
      <input type="hidden" name="action" value="footer">
    </form>
  </div>
</div>
<!-- INCLUDE footer.tpl -->