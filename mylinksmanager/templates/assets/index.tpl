<!-- INCLUDE header.tpl -->
<!-- BEGIN show_errors -->
<div class="alert alert-error">
    <a class="close" href="#" data-dismiss="alert">×</a>
    <h4 class="alert-heading">${STR_IDENTIFIED_FOLLOWING_ERRORS}:</h4>
    <ul>
        <!-- BEGIN row -->
        <li> ${ERROR}</li>
        <!-- END row -->
    </ul>
</div>
<!-- END show_errors -->
<div class="container">
    <h1>${TITLE_PAGE}</h1>
    <div class="text-right"><b>${STR_NUMBER_MSG}:</b> <i class="badge">${NUMBER_MSG}</i></div><br/>
    <p class="text-center"><a title="${STR_ADD_COMMENT}" href="./add">${STR_ADD_COMMENT}</a></p>
    <!-- BEGIN row_comments -->
    <div class="message">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span>${NAME}</span>
                    <!-- IF '${CITY}' != '' --><span>${STR_AUTHOR_CITY}: ${CITY}</span><br><!-- END IF -->
                    <!-- IF '${EMAIL}' != '' --><span>${STR_AUTHOR_EMAIL}: ${EMAIL}</span><br><!-- END IF -->
                    <!-- IF '${URL}' != '' --> <span>${STR_AUTHOR_SITE}: <a class="link" href=\"http://${URL}\">${URL}</a></span><!-- END IF -->
                    <span class="pull-right label label-info">${STR_ADDED}: ${TIME}</span>
                </h3>
            </div>
            <div class="panel-body">
                ${MSG}
                <!-- IF '${ADMIN}' != '' --><p class="text-error">${STR_ADMIN_MSG}: ${ADMIN}</p><!-- END IF -->
                <hr>
            </div>
        </div>
    </div>
    <!-- END row_comments -->
    <p class="text-center"><a title="${STR_ADD_COMMENT}" href="./add">${STR_ADD_COMMENT}</a></p>
    <!-- BEGIN pagination -->
    <div class="pagination">
        <ul>
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
    </div>
    <!-- END pagination -->
    <p class="text-left">${STR_LOGO}, ${STR_AUTHOR}</p>
</div>
<!-- INCLUDE footer.tpl -->