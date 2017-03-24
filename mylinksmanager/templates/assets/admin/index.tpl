<!-- INCLUDE header.tpl -->
<!-- BEGIN new_links -->
<!-- BEGIN links_row -->
<div class="link-block">
    <div class="col-md-12">

        <div class="well well-lg clearfix" id="link-{ID}">
            <div class="col-xs-12 col-md-6 col-md-push-3">
                <div>
                    <p><a href="http://${URL}" target=_blank>${NAME}</a> - ${DESCRIPTION}<br />
                    ${STR_ADDED}: ${TIME}<br />
                    ${STR_CATEGORY}: ${CATEGORY}<br />
                    ${STR_EMAIL}: ${EMAIL}
                    </p>
                </div>
            </div>
            <div class="col-xs-12 col-md-3 col-md-pull-6">
                <p>${HTMLCODE_BANNER}</p>
            </div>
            <div class="col-xs-6 col-md-6 col-md-push-3">
                <!-- IF '${SHOW_PR}' == 'yes' -->
                <iframe src="./?t=show_pr&url='${URL}" frameborder="0" scrolling="no" width="100" height="50"></iframe>
                <!-- END IF -->
                &nbsp;
                <!-- IF '${SHOW_CY}' == 'yes' -->
                <iframe src="./?t=show_cy&url='${URL}" frameborder="0" scrolling="no" width="125" height="50"></iframe>
                <!-- END IF -->
            </div>
            <div class="col-xs-12 col-md-12">
                <button class="btn btn-primary" type="button">${BUTTON_HANDCHECK}</button>
                <button class="btn btn-primary" type="button">${BUTTON_AUTOCHECK}</button>
            </div>
        </div>

    </div>
</div>
<!-- END links_row -->
<!-- IF '${MSG_NOTNEWLINKS}' != '' -->
<div class="warning_msg" style="text-align: center;">${MSG_NOTNEWLINKS}</div>
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
<!-- END new_links -->
<!-- BEGIN check_link -->
<p>« <a href=javascript:history.go(-1);>${STR_BACK}</a></p>
<div class="link-block">
    <div class="col-md-12">
        <div class="link-header">
            <p>${HTMLCODE_BANNER} <a href="http://${URL}" target=_blank>${NAME}</a> - ${DESCRIPTION}</p>
        </div>
        <div class="link-left"></div>
        <div class="link-right"> ${STR_RECIP_URL_LINK}:&nbsp;</b>${RECIPROCAL_LINK}<br />
            ${STR_CATEGORY}: </b>${CATEGORY_NAME}<br />
            ${STR_ADDED}: ${TIME} <br />
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
                <div class="link-col link-c25">
                    <form action="${ACTION}" method="post">
                        <button class="btn btn-success" type="submit">${BUTTON_ADD}</button>
                        <input type=hidden name="id_link" value="${ID_LINK}">
                        <input type=hidden name="event" value="add">
                        <input type=hidden name="action" value="post">
                    </form>
                </div>
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
<!-- END check_link -->
<!-- INCLUDE footer.tpl -->