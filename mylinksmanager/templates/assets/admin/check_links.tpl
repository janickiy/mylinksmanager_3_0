<!-- INCLUDE header.tpl -->
<!-- BEGIN STATISTICS -->
<p>« <a href="${URL}">${STR_GO_BACK}</a></p>
<p>${STR_REMOVED_LINKS}: ${DEL}<br />
  ${STR_RESULT_HIDDED_LINKS}: ${HIDE}<br />
  ${STR_RESULT_ADDED_LINKS}: ${ADD}</p>
<!-- END STATISTICS -->
<!-- BEGIN LINKS_LIST -->
<form action="${ACTION}" method=post>
  <input type=hidden name="event" value="check_all_aut">
  <input type=hidden name="action" value="post">
  <button class="btn btn-success" type="submit">${BUTTON_CHECK_ALL_LINKS_AUTOMATICALLY}</button>
</form>
<div class="topbarmenu">

 <!-- BEGIN PRINT_CAT -->
 <table border="0" width="100%">
   <!-- BEGIN ROW_CAT -->
  <tr>
    <!-- BEGIN ROW_FOLDER -->
	<td width="${COLUMNS_NUMBER}'%">
	  <table border="0" class="folder">
	    <tr>
          <td><img border="0" src="images/folder.gif"></td>
          <td><a href="${FOLDER_LINK}">${FOLDER_LINK_NAME}</a> <span>(${NUMBERSLINKS})</span><br><div class="subcat">${SHOWSUBCAT}</div></td>
		</tr>
      </table>
	</td>
	<!-- END ROW_FOLDER -->
  </tr>
  <!-- END ROW_CAT -->
 
 </table>
 <!-- END PRINT_CAT -->

${TOPBARMENU}</div>
<!-- IF '${ID_CAT}' != '' -->
<h2>${CATEGORY_NAME}</h2>
<p>« <a href="${RETURN_URL}">${STR_LINKS_WAITING_CHECKS}</a></p>
<!-- ELSE -->
<h2>${STR_LINKS_FOR_CHECK}</h2>
<br />
<!-- END IF -->
<!-- BEGIN ROW_LINKS -->
<div class="link-block">
  <div class="link-table col-md-12">
    <div class="link-header">
      <p>${HTMLCODE_BANNER} <a href="http://${URL}" target=_blank>${NAME}</a> - ${DESCRIPTION}</p>
    </div>
    <div class="link-left"></div>
    <div class="link-right"> ${STR_ADDED}: ${TIME}<br />
      ID: ${ID_LINK} <br />
      ${STR_NUMBER_OF_CLICKS}: ${COUNT} </div>
    <div class="link-footer">
      <p style="text-align: right">
        <!-- IF '${SHOW_PR}' == 'yes' -->
        <iframe src="show_pr.php?url='${URL}" frameborder="0" scrolling="no" width="100" height="50"></iframe>
        <!-- END IF -->
        &nbsp;
        <!-- IF '${SHOW_CY}' == 'yes' -->
        <iframe src="show_cy.php?url='${url}" frameborder="0" scrolling="no" width="125" height="50"></iframe>
        <!-- END IF -->
      </p>
      <div class="link-wrapper col-md-12">
        <div class="link-row">
          <div class="link-col link-c50">
            <!-- BEGIN BUTTON1 -->
            <form action="${ACTION1}" method="post" role="form">
              <button class="btn btn-primary" type="submit">${STR_BUTTON1}</button>
              <input type=hidden name="id_link" value="${ID_LINK1}">
              <input type=hidden name="event" value="check_hand">
              <input type=hidden name="action" value="post">
            </form>
            <!-- END BUTTON1 -->
          </div>
          <div class="link-col link-c50">
            <!-- BEGIN BUTTON2 -->
            <form action="${ACTION2}" method="post" role="form">
              <button class="btn btn-primary"  <!-- IF '${ALERT}' == 'show' -->onclick="alert('${MSG_ALERT_WAS_CHECKED}'); return false;"<!-- END IF --> type="submit">${STR_BUTTON2}</button>
              <input type=hidden name="id_link" value="${ID_LINK2}">
              <input type=hidden name="event" value="check_aut">
              <input type=hidden name="action" value="post">
            </form>
            <!-- END BUTTON2 -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END ROW_LINKS -->
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
<!-- IF '${MSG_NOTLINKS}' != '' -->
<div class="warning_msg" style="text-align: center;">${MSG_NOTLINKS}</div>
<!-- END IF -->
<!-- END LINKS_LIST -->
<!-- BEGIN CHECK_LINK -->
<p>« <a href=javascript:history.go(-1);>${RETURN_BACK}</a></p>
<div class="link-block">
  <div class="col-md-12">
    <div class="link-header">
      <p>${HTMLCODE_BANNER} <a href="http://${URL}" target=_blank>${NAME}</a> - ${DESCRIPTION}</p>
    </div>
    <div class="link-left"></div>
    <div class="link-right"> ${STR_RECIPROCAL_LINK}:&nbsp;</b>${RECIPROCAL_LINK}<br />
      ID: ${ID_LINK} <br />
      ${STR_CATEGORY}:&nbsp;</b>${CATNAME} <br />
      ${STR_ADDED}:${TIME} <br />
    </div>
    <div class="link-footer">
      <p style="text-align: right">
        <!-- IF '${SHOW_PR}' == 'yes' -->
        <iframe src="show_pr.php?url='${URL}" frameborder="0" scrolling="no" width="100" height="50"></iframe>
        <!-- END IF -->
        &nbsp;
        <!-- IF '${SHOW_CY}' == 'yes' -->
        <iframe src="show_cy.php?url='${url}" frameborder="0" scrolling="no" width="125" height="50"></iframe>
        <!-- END IF -->
      </p>
    </div>
    <div class="link-wrapper col-md-12">
      <div class="link-row">
        <!-- IF '${STATUS}' == 'hide' -->
        <div class="link-col link-c25">
          <form action="${ACTION}" method="post">
            <button class="btn btn-success" type="submit">${BUTTON_ADD}</button>
            <input type=hidden name="id_link" value="${ID_LINK}">
            <input type=hidden name="event" value="add">
            <input type=hidden name="action" value="post">
          </form>
        </div>
        <!-- END IF -->
        <div class="link-col link-c25">
          <form action="${ACTION}" method="post">
            <button class="btn btn-primary" type="submit">${BUTTON_TO_BLACKLIST}</button>
            <input type=hidden name="id_link" value="${ID_LINK}">
            <input type=hidden name="event" value="black">
            <input type=hidden name="action" value="post">
          </form>
        </div>
        <div class="link-col link-c50">
          <form action="${ACTION}" method="post">
            <button class="btn btn-danger" type="submit">${BUTTON_DELETE}</button>
            <input type=hidden name="id_link" value="${ID_LINK}">
            <input type=hidden name="event" value="delete">
            <input type=hidden name="action" value="post">
          </form>
        </div>
      </div>
    </div>
    <br>
    <br>
    <iframe width="100%" height="500" src="http://${RECIPROCAL_LINK}"></iframe>
  </div>
</div>
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
<!-- END CHECK_LINK -->
<!-- INCLUDE footer.tpl -->