<!-- INCLUDE header.tpl -->
<!-- BEGIN new_links -->
<!-- BEGIN links_row -->
<div class="link-block">
    <div class="col-md-12">
        <form action="<!-- URL 'Helper::url("./?a=admin")' -->" method="post">
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

            <div class="col-xs-12 col-md-12">
                <a href="<!-- URL 'Helper::url("./?a=admin")' -->" class="btn btn-primary" type="button">${BUTTON_HANDCHECK}</a>
                    <button class="btn btn-primary" type="submit">${BUTTON_AUTOCHECK}</button>
                    <input type="hidden" name="id" value="${ID}">
                    <input type="hidden" name="event" value="auto_check">
                    <input type="hidden" name="action" value="post">
            </div>
        </div>
</form>
    </div>
</div>
<!-- END links_row -->
<!-- IF '${NOT_NEW_LINKS}' != '' --><div class="warning_msg" style="text-align: center;">${NOT_NEW_LINKS}</div><!-- END IF -->
<!-- END new_links -->
<!-- BEGIN info_link -->
<p>« <a href="<!-- URL 'Helper::url("./?a=admin")' -->">${STR_BACK}</a></p>
<div class="link-block">
    <div class="col-md-12">
        <div class="link-header">
            <p>${HTMLCODE_BANNER} <a href="http://${URL}" target=_blank>${NAME}</a> - ${DESCRIPTION}</p>
        </div>
        <div class="link-left"></div>
        <div class="link-right"> ${STR_RECIP_URL_LINK}: </b>${RECIPROCAL_LINK}<br />
            ${STR_CATEGORY}: </b>${CATEGORY_NAME}<br />
            ${STR_ADDED}: ${TIME} <br />
        </div>
        <div class="link-wrapper col-md-12">
            <div class="link-row">
                <div class="link-col link-c25">
                    <form action="<!-- URL 'Helper::url("./?a=admin")' -->" method="post">
                        <button class="btn btn-success" type="submit">${BUTTON_ADD}</button>
                        <input type="hidden" name="id" value="${ID}">
                        <input type="hidden" name="event" value="add">
                        <input type="hidden" name="action" value="post">
                    </form>
                </div>
                <div class="link-col link-c25">
                    <form action="<!-- URL 'Helper::url("./?a=admin")' -->" method="post">
                        <button class="btn btn-primary" type="submit">${BUTTON_TO_BLACKLIST}</button>
                        <input type="hidden" name="id" value="${ID}">
                        <input type="hidden" name="event" value="black">
                        <input type="hidden" name="action" value="post">
                    </form>
                </div>
                <div class="link-col link-c50">
                    <form action="<!-- URL 'Helper::url("./?a=admin")' -->" method="post">
                        <button class="btn btn-danger" type="submit">${BUTTON_DELETE}</button>
                        <input type="hidden" name="id" value="${ID}">
                        <input type="hidden" name="event" value="delete">
                        <input type="hidden" name="action" value="post">
                    </form>
                </div>
            </div>
        </div>
        <br>
        <br>
        <iframe width="100%" height="500" src="http://${RECIPROCAL_LINK}"></iframe>
    </div>
</div>
<!-- END info_link -->
<!-- INCLUDE footer.tpl -->