<!-- INCLUDE header.tpl -->
<div class="col-md-12">
   <div class="panel panel-default">
      <div class="panel-heading"> ${STR_FIND_SEARCHFORM} </div>
      <div class="panel-body">
         <div class="row">
            <form method="GET" action="${ACTION}" role="form">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>${STR_KEYWORDS_SEARCHFORM}</label>
                     <input name="search" value="${SEARCH}" class="form-control">
                  </div>
                  <div class="form-group">
                     <label>${STR_MEETING_OF_KEYWORDS_SEARCHFORM}</label>
                     <div class="radio">
                        <label>
                           <input name="logic" type=radio value="0" <!-- IF '${LOGIC}' == 0 -->checked="checked"<!-- END IF -->>${STR_AT_LEAST_ONCE}
                        </label>
                     </div>
                     <div class="radio">
                        <label>
                           <input name="logic" type="radio" value="1" <!-- IF '${LOGIC}' == 1 -->checked="checked"<!-- END IF -->>${STR_ALL_WORDS_TOGETHER}
                        </label>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>${STR_SEARCH_IN_CATALOG_SEARCHFORM}</label>
                     <select type="text" class="form-control" name="id_catalog">
                        <option value="0" <!-- IF '${ID_CATALOG}' == 0 -->selected="selected"<!-- END IF -->>${STR_IT_DOESNT_MATTER_SEARCHFORM}</option>
                        ${OPTION}
                     </select>
                  </div>
               </div>
               <div class="col-md-12">
                  <button class="btn btn-default" type="submit">${BUTTON_FIND}</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="topbarmenu">
   <div style="padding-bottom: 30px">${TOPBARMENU}</div>
   <!-- BEGIN PRINT_CAT -->
   <table border="0" width="100%">
      <!-- BEGIN ROW_CAT -->
      <tr>
         <!-- BEGIN ROW_FOLDER -->
         <td width="${COLUMNS_NUMBER}'%">
            <table border="0" class="folder">
               <tr>
                  <td><img border="0" src="images/folder.gif"></td>
                  <td>
                     <a href="${FOLDER_LINK}">${FOLDER_LINK_NAME}</a> <span>(${NUMBERSLINKS})</span><br>
                     <div class="subcat">${SHOWSUBCAT}</div>
                  </td>
               </tr>
            </table>
         </td>
         <!-- END ROW_FOLDER -->
      </tr>
      <!-- END ROW_CAT -->
   </table>
   <!-- END PRINT_CAT -->  
</div>
<h2>${CATNAME}</h2>
<!-- BEGIN ROW_LINKS -->
<div class="link-block">
   <div class="link-table col-md-12">
      <div class="link-header">
         <p>${HTMLCODE_BANNER} <a href="http://${URL}" target=_blank>${NAME}</a> - ${DESCRIPTION}</p>
      </div>
      <div class="link-left"></div>
      <div class="link-right">
         ${STR_ADDED}: ${TIME}<br />
         ID: ${ID_LINK} <br />
         ${STR_NUMBER_OF_CLICKS}: ${COUNT}
      </div>
      <div class="link-footer">
         <p style="text-align: right">
            <!-- IF '${SHOW_PR}' == 'yes' --><iframe src="show_pr.php?url='${URL}" frameborder="0" scrolling="no" width="100" height="50"></iframe><!-- END IF -->&nbsp;<!-- IF '${SHOW_CY}' == 'yes' --><iframe src="show_cy.php?url='${url}" frameborder="0" scrolling="no" width="125" height="50"></iframe><!-- END IF -->
         </p>
         <div class="link-wrapper col-md-12">
            <div class="link-row">
               <div class="link-col link-c50">
                  <form action="${ACTION}" method=post>
                     <button class="btn btn-primary" type="submit">${BUTTON_EDIT}</button>
                     <input type=hidden name="id_link" value="${ID_LINK}">
                  </form>
               </div>
               <div class="link-col link-c50">
                  <form action="edit.php?id_cat=${ID_CAT}" method=post>
                     <button class="btn btn-danger" type="submit">${BUTTON_REMOVE}</button>
                     <input type=hidden name="id_link" value="${ID_LINK}">
                     <input type=hidden name="id_cat" value="${ID_CAT}">
                     <input type=hidden name="action" value="post">
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- END ROW_LINKS -->
<!-- IF '${MSG_NOTLINKS}' != '' -->
<div class="warning_msg" style="text-align: center;">${MSG_NOTLINKS}</div>
<!-- END IF -->
<!-- IF '${MSG_SEARCH_NOTFOUND}' != '' -->
<div class="warning_msg" style="text-align: center;">${MSG_SEARCH_NOTFOUND}</div>
<!-- END IF -->
<!-- IF '${MSG_SEARCH_QUANTITY_CHARCTER}' != '' -->
<div class="warning_msg" style="text-align: center;">${MSG_SEARCH_QUANTITY_CHARCTER}</div>
<!-- END IF -->
<!-- BEGIN pagination -->
<ul class="pagination">
   <!-- IF '${PERVPAGE}' != '' -->
   <li>${PERVPAGE}</li>
   <!-- END IF -->
   <!-- IF '${PERV}' != '' -->
   <li>${PERV}</li>
   <!-- END IF -->
   <!-- IF '${PAGE2LEFT}' != '' -->
   <li>${PAGE2LEFT}</li>
   <!-- END IF -->
   <!-- IF '${PAGE1LEFT}' != '' -->
   <li>${PAGE1LEFT}</li>
   <!-- END IF -->
   <!-- IF '${CURRENT_PAGE}' != '' -->
   <li class="prev disabled">${CURRENT_PAGE}</li>
   <!-- END IF -->
   <!-- IF '${PAGE1RIGHT}' != '' -->
   <li>${PAGE1RIGHT}</li>
   <!-- END IF -->
   <!-- IF '${PAGE2RIGHT}' != '' -->
   <li>${PAGE2RIGHT}</li>
   <!-- END IF -->
   <!-- IF '${NEXTPAGE}' != '' -->
   <li>${NEXTPAGE}</li>
   <!-- END IF -->
   <!-- IF '${NEXT}' != '' -->
   <li>${NEXT}</li>
   <!-- END IF -->
</ul>
<!-- END pagination -->
<!-- INCLUDE footer.tpl -->