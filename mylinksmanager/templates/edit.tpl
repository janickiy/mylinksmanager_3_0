<!-- INCLUDE header.tpl -->
<h2>${TITLE}</h2>
<form action="${ACTION}" method=post>
  <table class="form">
    <tr>
      <td align="right"><b>${STR_RECIPROCAL_LINK}:</b></td>
      <td><input size="60" maxlength="200" name="reciprocal_link" type="text" value="${RECIPROCAL_LINK}"></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td><input type="submit" value="${BUTTON_EDIT}">
        <input type=hidden name="id_link" value="${ID_LINK}">
        <input type=hidden name="token" value="${TOKEN}">
        <input type=hidden name="url" value="${URL}">
        <input type=hidden name="action" value="post"></td>
    </tr>
  </table>
</form>
<!-- BEGIN show_errors -->
	<h4 class="msg">${STR_IDENTIFIED_FOLLOWING_ERRORS}:</h4>
	<ul class="msg">
		<!-- BEGIN row -->
			<li> ${ERROR}</li>
		<!-- END row -->
	</ul>
<!-- END show_errors -->
<!-- INCLUDE footer.tpl -->
