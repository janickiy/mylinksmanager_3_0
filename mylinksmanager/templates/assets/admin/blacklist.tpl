<!-- INCLUDE header.tpl -->
<!-- BEGIN row -->
<div class="link-block">
  <div class="link-table col-md-12">
    <div class="link-header">
      <p><a href="http://${URL}" target=_blank>${NAME}</a></p>
    </div>
    <div class="link-left"></div>
    <div class="link-right"> ${DESCRIPTION}<br>
      ${STR_EMAIL}: ${EMAIL}<br>
      ${STR_CATEGORY}: ${CATEGORY}<br>
      ${STR_REASON}: ${REASON} </div>
    <div class="link-footer"> <em>
      <p align="right">${STR_BLACKLISTED}:${TIME} </p>
      </em>
      <div class="link-wrapper col-md-12">
        <div class="link-row">
          <div class="link-col link-c50">
            <form action="${PHP_SELF}" method=post>
              <button class="btn btn-primary" type="submit">${BUTTON_RESTORE}</button>
              <input type=hidden name="id_link" value="${ID_LINK}">
              <input type=hidden name="event" value="restore">
              <input type=hidden name="action" value=post>
            </form>
          </div>
          <div class="link-col link-c50">
            <form action="${PHP_SELF}" method=post>
              <button class="btn btn-danger" type="submit">${BUTTON_DELETE}</button>
              <input type=hidden name="id_link" value="${ID_LINK}">
              <input type=hidden name="event" value="delete">
              <input type=hidden name="action" value="post">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END row -->
<!-- IF '${MSG_NOTLINKS}' != '' -->
<div class="warning_msg" style="text-align: center;">${MSG_NOTLINKS}</div>
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