<!-- INCLUDE header.tpl -->
<!-- BEGIN PRINT_CAT -->
<table width="100%" border="0">
   <!-- BEGIN ROW_CAT -->
   <tr>
      <!-- BEGIN ROW_FOLDER -->
      <td valign="top" width="${COLUMNS_NUMBER}%">
         <table border="0" class="folder">
            <tr>
               <td valign="top"><img border="0" src="${IMAGEFOLDER}"></td>
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
<br />
<table border="0" width="100%">
   <tr>
      <td>
         <form method="GET" action="${ACTION}">
            <fieldset>
               <legend>${STR_KEYWORDS_SEARCHFORM}&nbsp;</legend>
               <table border="0" width="100%">
                  <tr>
                     <td>
                        <p align="right">${STR_KEYWORDS}:</p>
                     </td>
                     <td><input type="text" size="25" class="input" name="search" value="${SEARCH}"></td>
                     <td width="15">&nbsp;</td>
                     <td>
                        <p align="right">${STR_SEARCH_IN_CATALOG_SEARCHFORM}:</p>
                     </td>
                     <td>
                        <select type=text class="input" name="catalog_id">
                           <option value=0 <!-- IF '${ID_CATALOG}' == 0 -->selected="selected"<!-- END IF -->>${STR_IT_DOESNT_MATTER_SEARCHFORM}</option>
                           ${OPTION}                
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <p align="right">${STR_MEETING_OF_KEYWORDS_SEARCHFORM}:</p>
                     </td>
                     <td>
                        <p>
                           <input name="logic" type="radio" value="0" <!-- IF '${LOGIC}' == 0 -->checked="checked"<!-- END IF -->> ${STR_AT_LEAST_ONCE}
                        </p>
                     </td>
                     <td width="15">&nbsp;</td>
                     <td>
                        <p align="right">
                           <input name="logic" type="radio" value="1" <!-- IF '${LOGIC}' == 1 -->checked="checked"<!-- END IF -->> ${STR_ALL_WORDS_TOGETHER}
                        </p>
                     </td>
                     <td>&nbsp;</td>
                  </tr>
                  <tr>
                     <td colspan="5">&nbsp;</td>
                  </tr>
                  <tr>
                     <td><input type="submit" class="inputsubmit" value="${BUTTON_FIND}"></td>
                  </tr>
               </table>
            </fieldset>
         </form>
      </td>
   </tr>
</table>
<p>${TOPBARMENU}</p>
<table border="0" width="100%">
   <tr>
      <td>
         <h2>${SUBCATALOG}</h2>
         <div style="text-align: center;"> <a href="<!-- URL 'Helper::url("./?t=addurl")' -->">${STR_ADD_URL}</a> </div>
         <!-- BEGIN ROW_LINKS -->
         <div id="link">
            <table width="100%" border="0">
               <tr>
                  <td colspan="2" align="left">
                     <table align="left">
                        <tr>
                           <td>${HTMLCODE_BANNER}</td>
                        </tr>
                     </table>
                     <p align="justify"><a href="http://${URL}" target=_blank>${NAME}</a> - ${DESCRIPTION}</a><br /><br />
                        <a href="${READ_MORE}">${STR_READ_MORE}</a>
                     </p>
                  </td>
               </tr>
               <tr>
                  <td width="50%" align="left"><span class="info">${STR_ADDED}: ${TIME}<br />
                     ${STR_CATEGORY}: ${CATEGORY}<br />
                     ${STR_NUMBER_OF_CLICKS}: ${NUMBER_OF_CLICKS} </span>
                  </td>
               </tr>
            </table>
            <!-- END ROW_LINKS -->
         </div>
         <!-- IF '${MSG_NOTLINKS}' != '' -->
         <div class="warning_msg" style="text-align: center;">${MSG_NOTLINKS}</div>
         <!-- END IF -->
         <!-- IF '${MSG_SEARCH_NOTFOUND}' != '' -->
         <div class="warning_msg" style="text-align: center;">${MSG_SEARCH_NOTFOUND}</div>
         <!-- END IF -->
         <!-- BEGIN pagination -->
         <div class="pagination">${STR_PAGES}:&nbsp;
            ${PERVPAGE}${PAGE2LEFT}${PAGE1LEFT}<b>${PAGE}</b>${PAGE1RIGHT}${PAGE2RIGHT}${NEXTPAGE} 
         </div>
         <!-- END pagination -->
         <div style="text-align: center;"> <a href="<!-- URL 'Helper::url("./?t=addurl")' -->">${STR_ADD_URL}</a> </div>
      </td>
   </tr>
</table>
<!-- INCLUDE footer.tpl -->