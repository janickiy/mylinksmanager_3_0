<!-- INCLUDE header.tpl -->
<script type="text/javascript">
    $(document).ready(function(){
        $("#start_update").on("click", function(){
            $("#btn_refresh").html('<div id="progress_bar" class="progress progress-striped active"><div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 1%;"></div></div><span style="padding: 10px" id="status_process">${STR_START_UPDATE}</span>');

            $.ajax({
                type: "GET",
                cache: false,
                url: "<!-- URL 'Helper::url("./?t=ajax&action=start_update&p=start")' -->",
                dataType: "json",
                success: function(data){
                    if (data.result == 'yes') {
                        $('.progress-bar').css('width', '20%');
                        $("#status_process").text(data.status);
                        updateFiles();
                    } else {
                        $("#btn_refresh").html('<a id="start_update" class="btn" href="#"><i class="icon-refresh"></i>${BUTTON_UPDATE}</a><span style="padding: 10px">' + data.status + '</span>');
                    }
                }
            });
        });
    });

    function updateFiles()
    {
        $.ajax({
            type: "GET",
            cache: false,
            url: "<!-- URL 'Helper::url("./?t=ajax&action=start_update&p=update_files")' -->",
            dataType: "json",
            success: function(data){
                if (data.result == 'yes') {
                    $('.progress-bar').css('width', '70%');
                    updateBD();
                } else {
                    $("#btn_refresh").html('<a id="start_update" class="btn" href="#"><i class="icon-refresh"></i>${BUTTON_UPDATE}</a><span style="padding: 10px">' + data.status + '</span>');
                }
            }
        });
    }

    function updateBD()
    {
        $.ajax({
            type: "GET",
            cache: false,
            url: "<!-- URL 'Helper::url("./?t=ajax&action=start_update&p=update_bd")' -->",
            dataType: "json",
            success: function(data){
                if (data.result == 'yes') {
                    $('.progress-bar').css('width', '100%');
                    $('#progress_bar').delay(3000).fadeOut();
                    $('#status_process').delay(3000).text('${MSG_UPDATE_COMPLETED}');
                } else {
                    $("#btn_refresh").html('<a id="start_update" class="btn" href="#"><i class="icon-refresh"></i>${BUTTON_UPDATE}</a><span style="padding: 10px">' + data.status + '</span>');
                }
            }
        });
    }

</script>
<div class="span12">
    <!-- IF '${BUTTON_UPDATE}' != '' -->
    <div id="btn_refresh"><a id="start_update" class="btn btn-outline btn-default" href="#"><i class="fa fa-refresh"></i> ${BUTTON_UPDATE} </a></div>
    <!-- END IF -->

    <!-- IF '${MSG_NO_UPDATES}' != '' -->
    <a class="btn btn-outline btn-default" disabled><i class="fa fa-refresh"></i> ${MSG_NO_UPDATES}</a>
    <!-- END IF -->

</div>
<!-- INCLUDE footer.tpl -->