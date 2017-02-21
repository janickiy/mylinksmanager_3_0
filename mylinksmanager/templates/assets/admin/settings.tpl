<!-- INCLUDE header.tpl -->
<div class="row">
  <div class="col-md-12">
    <form action="${PHP_SELF}" method="post" role="form">
      <div class="panel panel-default">
        <div class="panel-body">
          <ul class="nav nav-pills">
            <li class="active"><a href="#interface_settings" data-toggle="tab">${STR_INTERFACE_SETTINGS}</a> </li>
            <li class=""><a href="#letters_templates" data-toggle="tab">${STR_LETTERS_TEMPLATES}</a> </li>
            <li class=""><a href="#catalog_settings" data-toggle="tab">${STR_CATALOG_SETTINGS}</a> </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade active in" id="interface_settings">
              <h4>${STR_INTERFACE_SETTINGS}</h4>
              <div class="form-group">
                <label>${STR_LANGUAGE}</label>
                <select name="language" class="form-control">
                  <option value="ru" 
                  <!-- IF '${LANGUAGE_OPTION}' == 'ru' -->
                  selected="selected"
                  <!-- END IF -->
                  >${STR_LANG_RU}
                  </option>
                  <option value="en" 
                  <!-- IF '${LANGUAGE_OPTION}' == 'en' -->
                  selected="selected"
                  <!-- END IF -->
                  >${STR_LANG_EN}
                  </option>
                </select>
              </div>
              <div class="form-group">
                <label for="all_number_links">${STR_ALL_NUMBER_LINKS}</label>
                <input type=text name="all_number_links" class="form-control" value="${ALL_NUMBER_LINK}">
              </div>
              <div class="form-group">
                <label for="url">${STR_ALL_NUMBER_NEW}</label>
                <input type=text name="all_number_new" class="form-control" value="${ALL_NUMBER_NEW}">
              </div>
              <div class="form-group">
                <label for="columns_number">${STR_COLUMNS_NUMBER}</label>
                <input type="text" name="columns_number" class="form-control" value="${COLUMNS_NUMBER}">
              </div>
              <div class="form-group">
                <label>${STR_ORDER_VIEWS}</label>
                <div class="radio">
                  <label> <input name="order_views" type="radio" value="1" 
                    <!-- IF '${ORDER_VIEWS}' == 1 -->
                    checked="checked"
                    <!-- END IF -->
                    >
                    ${STR_BY_DATE} </label>
                </div>
                <div class="radio">
                  <label> <input type="radio" name="order_views" value="2" 
                    <!-- IF '${ORDER_VIEWS}' == 2 -->
                    checked="checked"
                    <!-- END IF -->
                    >
                    ${STR_BY_NUMBER} </label>
                </div>
              </div>
              <div class="form-group">
                <label>${STR_ORDER_LINKS}</label>
                <div class="radio">
                  <label> <input name="order_links" type="radio" value="1" 
                    <!-- IF '${ORDER_LINKS}' == 1 -->
                    checked="checked"
                    <!-- END IF -->
                    >
                    ${STR_BY_INCREACE} </label>
                </div>
                <div class="radio">
                  <label> <input type="radio" name="order_links" value="2" 
                    <!-- IF '${ORDER_LINKS}' == 2 -->
                    checked="checked"
                    <!-- END IF -->
                    >
                    ${STR_BY_DECREASE} </label>
                </div>
              </div>
              <div class="form-group">
                <label for="show_cy">${STR_SHOW_CY}</label>
                <input type=checkbox name="show_cy" 
                <!-- IF '${SHOW_CY}' == 'yes' -->
                checked="checked"
                <!-- END IF -->
                > </div>
              <div class="form-group">
                <label for="show_pr">${STR_SHOW_PR}</label>
                <input type=checkbox  name="show_pr" 
                <!-- IF '${SHOW_PR}' == 'yes' -->
                checked="checked"
                <!-- END IF -->
                > </div>
              <div class="form-group">
                <label>${STR_STATIC}</label>
                <div class="radio">
                  <label> <input name="static" type="radio" value="1" 
                    <!-- IF '${STATIC}' == 1 -->
                    checked="checked"
                    <!-- END IF -->
                    >
                    ${STR_STATIC_URL} </label>
                </div>
                <div class="radio">
                  <label> <input type="radio" name="static" value="2" 
                    <!-- IF '${STATIC}' == 2 -->
                    checked="checked"
                    <!-- END IF -->
                    >
                    ${STR_DYNAMIC_URL} </label>
                </div>
              </div>
              <div class="form-group">
                <label for="url">${STR_CATALOG_URL}</label>
                <input type="text" name="url" class="form-control" value="${URL}">
              </div>
              <div class="form-group">
                <label for="email">${STR_ADMIN_EMAIL}</label>
                <input type="text" name="email" class="form-control" value="${EMAIL}">
              </div>
              <div class="form-group">
                <label for="rules">${STR_CATALOG_RULE}</label>
                <textarea class="form-control" rows="3" name="rules">${RULES}</textarea>
              </div>
              <div class="form-group">
				<label for="from_add_message">${STR_FROM_ADD_MESSAGE}</label>
                <textarea class="form-control" rows="3" name="from_add_message">${FROM_ADD_MESSAGE}</textarea>
              </div>
              <div class="form-group">
                <label for="htmlcode_site1">${STR_HTMLCODE_SITE1}</label>
                <textarea class="form-control" rows="3" name="htmlcode_site1">${HTMLCODE_SITE1}</textarea>
              </div>
              <div class="form-group">
                <label for="htmlcode_site2">${STR_HTMLCODE_SITE2}</label>
                <textarea class="form-control" rows="3" name="htmlcode_site2">${HTMLCODE_SITE2}</textarea>
              </div>
              <div class="form-group">
                <label for="htmlcode_site3">${STR_HTMLCODE_SITE3}</label>
                <textarea class="form-control" rows="3" name="htmlcode_site3">${HTMLCODE_SITE3}</textarea>
              </div>
              <div class="form-group">
                <label for="htmlcode_banner1">${STR_HTMLCODE_BANNER1}</label>
                <textarea class="form-control" rows="3" name="htmlcode_banner1">${HTMLCODE_BANNER1}</textarea>
              </div>
              <div class="form-group">
                <label for="htmlcode_banner2">${STR_HTMLCODE_BANNER2}</label>
                <textarea class="form-control" rows="3" name="htmlcode_banner2">${HTMLCODE_BANNER2}</textarea>
              </div>
              <div class="form-group">
                <label for="htmlcode_banner3">${STR_HTMLCODE_BANNER3}</label>
                <textarea class="form-control" rows="3" name="htmlcode_banner3">${HTMLCODE_BANNER3}</textarea>
              </div>
            </div>
            <div class="tab-pane fade" id="letters_templates">
              <h4>${STR_LETTERS_TEMPLATES}</h4>
              <div class="form-group">
                <label for="template_mail_1">${STR_EMAIL_FOR_USER_ADD_MODER}</label>
                <textarea class="form-control" name="template_mail_1">${TEMPLATE_MAIL_1}</textarea>
              </div>
              <div class="form-group">
                <label for="template_mail_2">${STR_EMAIL_FOR_USER_ADD_CATALOG}</label>
                <textarea class="form-control" name="template_mail_2">${TEMPLATE_MAIL_2}</textarea>
              </div>
              <div class="form-group">
                <label for="template_mail_3">${STR_EMAIL_FOR_USER_HIDE_ABSENSE}</label>
                <textarea class="form-control" name="template_mail_3">${TEMPLATE_MAIL_3}</textarea>
              </div>
              <div class="form-group">
                <label for="template_mail_4">${STR_EMAIL_FOR_USER_HIDE_PROHIB}</label>
                <textarea class="form-control" name="template_mail_4">${TEMPLATE_MAIL_4}</textarea>
              </div>
              <div class="form-group">
                <label for="template_mail_7">${STR_EMAIL_FOR_USER_PASSED}</label>
                <textarea class="form-control" name="template_mail_7">${TEMPLATE_MAIL_7}</textarea>
              </div>
              <div class="form-group">
                <label for="template_mail_6">${STR_EMAIL_FOR_USER_REMOVE}</label>
                <textarea class="form-control" name="template_mail_6">${TEMPLATE_MAIL_6}</textarea>
              </div>
              <div class="form-group">
                <label for="template_mail_5">${STR_EMAIL_FOR_USER_ADD_NEW}</label>
                <textarea class="form-control" name="template_mail_5">${TEMPLATE_MAIL_5}</textarea>
              </div>
            </div>
            <div class="tab-pane fade" id="catalog_settings">
              <h4>${STR_CATALOG_SETTINGS}</h4>
              <div class="form-group">
                <label for="check_interval">${STR_CHECK_INTERVAL}</label>
                <input type=text name="check_interval" value="${CHECK_INTERVAL}">
              </div>
              <div class="form-group">
                <label for="number_check">${STR_NUMBER_CHECK}</label>
                <input type=text name="number_check" value="${NUMBER_CHECK}">
              </div>
              <div class="form-group">
                <label>${STR_NUMBER_CHARS_DESCRIPTION}</label>
                <label class="checkbox-inline">
                  <input type="text" name="number_chars_description_min" value="${NUMBER_CHARS_DESCRIPTION_MIN}">
                  min </label>
                <label class="checkbox-inline">
                  <input type="text" name="number_chars_description_max" value="${NUMBER_CHARS_DESCRIPTION_MAX}">
                  max </label>
              </div>
              <div class="form-group">
                <label>${STR_NUMBER_CHARS_FULLDESCRIPTION}</label>
                <label class="checkbox-inline">
                  <input type="text" name="number_chars_fulldescription_min" value="${NUMBER_CHARS_FULLDESCRIPTION_MIN}">
                  min </label>
                <label class="checkbox-inline">
                  <input type="text" name="number_chars_fulldescription_max" value="${NUMBER_CHARS_FULLDESCRIPTION_MAX}">
                  max </label>
              </div>
              <div class="form-group">
                <label for="number_check">${STR_NUMBER_HTML_CHARS}</label>
                <input type="text" name="number_html_chars" class="form-control"  value="${NUMBER_HTML_CHARS}">
              </div>
              </label>
              <div class="checkbox">
                <label> <input type=checkbox name="request_captcha" 
                  <!-- IF '${REQUEST_CAPTCHA}' == 'yes' -->
                  checked="checked"
                  <!-- END IF -->
                  >
                  ${STR_REQUEST_CAPTCHA} </label>
              </div>
              <div class="checkbox">
                <label> <input type="checkbox" name="add_links_without_check" 
                  <!-- IF '${ADD_LINKS_WITHOUT_CHECK}' == 'yes' -->
                  checked="checked"
                  <!-- END IF -->
                  >
                  ${STR_ADD_LINKS_WITHOUT_CHECK} </label>
              </div>
              <div class="checkbox">
                <label> <input type=checkbox name="check_links" 
                  <!-- IF '${CHECK_LINKS}' == 'yes' -->
                  checked="checked"
                  <!-- END IF -->
                  >
                  ${STR_CHECK_LINKS} </label>
              </div>
              <div class="checkbox">
                <label> <input type=checkbox name="common_host" 
                  <!-- IF '${COMMON_HOST}' == 'yes' -->
                  checked="checked"
                  <!-- END IF -->
                  >
                  ${STR_COMMON_HOST} </label>
              </div>
              <div class="checkbox">
                <label> <input type=checkbox name="check_get_parameter" 
                  <!-- IF '${CHECK_GET_PARAMETER}' == 'yes' -->
                  checked="checked"
                  <!-- END IF -->
                  >
                  ${STR_CHECK_GET_PARAMETER} </label>
              </div>
              <div class="checkbox">
                <label> <input type=checkbox name="limit_reciprocal_links" 
                  <!-- IF '${LIMIT_RECIPROCAL_LINKS}' == 'yes' -->
                  checked="checked"
                  <!-- END IF -->
                  >
                  ${STR_LIMIT_RECIPROCAL_LINKS}
                  <input size="2" type=text name="number_reciprocal_links_limit" size="3" maxlength="6" value="${NUMBER_RECIPROCAL_LINKS_LIMIT}">
                </label>
              </div>
              <div class="checkbox">
                <label> <input type=checkbox name="add_to_blacklist" 
                  <!-- IF '${ADD_TO_BLACKLIST}' == 'yes' -->
                  checked="checked"
                  <!-- END IF -->
                  >
                  ${STR_ADD_TO_BLACKLIST} </label>
              </div>
              <div class="checkbox">
                <label> <input type=checkbox name="new_links_notification" 
                  <!-- IF '${NEW_LINKS_NOTIFICATION}' == 'yes' -->
                  checked="checked"
                  <!-- END IF -->
                  >
                  ${STR_NEW_LINKS_NOTIFICATION} </label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button class="btn btn-default" type="submit">${BUTTON_SAVE}</button>
      <input type=hidden name="action" value="post">
      </td>
    </form>
  </div>
</div>
<!-- INCLUDE footer.tpl -->