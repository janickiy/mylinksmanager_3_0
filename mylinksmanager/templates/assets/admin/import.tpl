<!-- INCLUDE header.tpl -->
<form enctype="multipart/form-data" action="${ACTION}" method="post">
    <div class="form-group">
        <label for="file">${STR_DATABASE_FILE}</label>
        <input type="file" name="file" value="">
    </div>
    <div class="form-group">
        <input class="btn btn-success" type="submit" name="action" value="${BUTTON_ADD}">
    </div>
</form>
<!-- INCLUDE footer.tpl -->