<!-- INCLUDE header.tpl -->
<script type="text/javascript">

  (function($) {

    $.fn.scrollPagination = function(options) {

      var settings = {
        nop     : 25,
        offset  : 25,
        error   : '${STR_THERE_ARE_NO_MORE_ENTRIES}',
        delay   : 500,
        scroll  : true
      }

      if(options) {
        $.extend(settings, options);
      }

      return this.each(function() {

        $this = $(this);
        $settings = settings;
        var offset = $settings.offset;
        var busy = false;

        if($settings.scroll == true)
          $initmessage = '${STR_SHOW_MORE}';
        else
          $initmessage = '${STR_CLICK}';

        $("#msgShow").html('<div class="btn">' + $initmessage + '</div>');

        function getData() {




          $.post('./?t=ajax&action=get_black_list', {
            number		: $settings.nop,
            offset		: offset,
          }, function(data) {
            $("#msgShow").html($initmessage);

            if(data == null || data.item == null) {
              $("#msgShow").html($settings.error);
              $("#msgShow").addClass("disabled");
            }
            else {
              offset = offset+$settings.nop;

              for(var i=0; i < data.item.length; i++) {
                if(data.item[i].email == null) $("#msgShow").html('${STR_SHOW_MORE}');
                var content = '';


              <div class="well well-lg clearfix"><div class="col-xs-12 col-md-6 col-md-push-3"><div>' + data.item[i].banner + '</div></div><div class="col-xs-12 col-md-3 col-md-pull-6"><div class="alert alert-info">' + data.item[i]. + '<></div>
                </div>

                </div>



              <div class="link-block"><div class="link-table col-md-12"><div class="link-header"><p><a href="http://${URL}" target=_blank>${NAME}</a></p></div><div class="link-left"></div><div class="link-right"> ${DESCRIPTION}<br>${STR_EMAIL}: ${EMAIL}<br>${STR_CATEGORY}: ${CATEGORY}<br>${STR_REASON}: ${REASON} </div><div class="link-footer"> <em><p align="right">${STR_BLACKLISTED}:${TIME} </p>
                </em>

                </div>
                </div>
                </div>
                </div>
                </div>





                content += '<tr><td>' + data.item[i].name + '</td><td>' + data.item[i].email + '</td><td>' + data.item[i].catname + '</td><td>' + data.item[i].time + '</td><td>' + data.item[i].status + '</td><td>' + data.item[i].read + '</td><td width="30%">' + data.item[i].errormsg + '</td></tr>';
                $('#logTable > tbody > tr:last').after(content);
              }

              busy = false;
            }
          });
        }

        getData();

        if($settings.scroll == true) {
          $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() > $this.height() && !busy) {
              busy = true;

              $this.find('.loading-bar').html('${STR_LOADING_DATA}');

              setTimeout(function() {
                getData();
              }, $settings.delay);
            }
          });
        }

        $this.find('.loading-bar').click(function() {

          if(busy == false) {
            busy = true;
            getData();
          }
        });
      });
    }

  })(jQuery);

  $(document).ready(function() {
    $('#page-wrapper').scrollPagination({
      nop     : 25,
      offset  : 25,
      error   : '${STR_THERE_ARE_NO_MORE_ENTRIES}',
      delay   : 500,
      scroll  : true
    });
  });



  function PnumberChange()
  {
    var pnumber = document.getElementById("pnumber").value;
    document.cookie = "pnumber_black_list=" + pnumber;
    location.reload();
  }

</script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
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