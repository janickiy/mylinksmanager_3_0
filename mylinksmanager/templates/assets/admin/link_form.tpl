<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><span class="msg">*</span> - ${STR_REQUIRED_FIELDS}</div>
      <div class="panel-body">
        <form action="${ACTION}" method="post" role="form">
          <!-- IF '${LINK_ID}' != '' -->
          <input type=hidden name="link_id" value="${LINK_ID}">
          <!-- END IF -->
          <input type=hidden name="action" value="post">
          <div class="form-group">
            <label>${STR_CATEGORY} <span class="msg">*</span></label>
            <select type=text name="cat_id" class="form-control">
              <option value="0" <!-- IF '${CAT_ID}' == 0 -->selected="selected"<!-- END IF -->class="input"> ----${STR_CHOOSE_CATEGORY}---- </option>              
				${OPTION}
            </select>
          </div>
          <div class="form-group">
            <label for="name">${STR_WEBSITE_NAME}<span class=msg>*</span></label>
            <input type="text" value="${NAME}" class="form-control" name="name">
          </div>
          <div class="form-group">
            <label for="url">${STR_URL}<span class=msg>*</span></label>
            <input type="text" value="${URL}" class="form-control" name="url">
          </div>
          <div class="form-group">
            <label for="reciprocal_link">${STR_ADDRESS_OF_RECIP_LINK_PAGE}</label>
            <input type="text" name="reciprocal_link" class="form-control" value="${RECIPROCAL_LINK}">
          </div>
          <div class="form-group">
            <label for="email">${STR_EMAIL}:</label>
            <input type="text" name="email" value="${EMAIL}" class="form-control">
          </div>
          <div class="form-group">
          <label for="keywords">${STR_KEYWORDS} (${STR_LIST_SEPARATED_BY_COMMAS})</label>
          <input type="text" name="keywords" value="${KEYWORDS}" class="form-control">
          <div class="form-group">
            <label for="description">${STR_BRIEF_DESCRIPTION} (${STR_ONLY_TEXT_NOT_HTML})<span class="msg">*</span></label>
            <textarea class="form-control" rows="3" name="description">${DESCRIPTION}</textarea>
          </div>
          <div class="form-group">
            <label for="full_description">${STR_FULL_DESCRIPTION} (${STR_ONLY_TEXT_NOT_HTML}): <span class="msg">*</span></label>
            <textarea class="form-control" rows="3" name="full_description">${FULL_DESCRIPTION}</textarea>
          </div>
          <div class="form-group">
            <label for="htmlcode_banner">${STR_HTML_CODE_OF_BANNER}:</label>
            <textarea class="form-control" rows="3" name="htmlcode_banner">${HTMLCODE_BANNER}</textarea>
          </div>
          <div class="field"> </div>
          <div class="checkbox">
            <label> <input type="checkbox" name="check_link" <!-- IF '${CHECK_LINK}' == 'yes' -->checked="checked"<!-- END IF -->>
              ${STR_TO_CHECK_THIS_LINK}: 
			</label>
          </div>
          <button class="btn btn-primary" type="submit">${BUTTON}</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>