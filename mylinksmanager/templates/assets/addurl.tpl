<!-- INCLUDE header.tpl -->
<script type=text/javascript>

window.onload=function() {
	sendRequest();
	totalShow();
	totalShow2();
}

var xmlHttp = createXmlHttpRequestObject();

function totalShow()
{
	var id_elm = new Array();
	var max = new Array();

	id_elm[0] = "htmlcode_banner";

	max[0] = ${NUMBER_HTML_CHARS};

	for(i=0; i<id_elm.length; i++){
		value_id(id_elm[i],max[i]);
	}
}

function totalShow2()
{
	var id_elm = new Array();
	var max = new Array();
	var min = new Array();

	id_elm[0] = "description";
	id_elm[1] = "full_description";

	min[0] = ${NUMBER_CHARS_DESCRIPTION_MIN};
	min[1] = ${NUMBER_CHARS_FULLDESCRIPTION_MIN};

	max[0] = ${NUMBER_CHARS_DESCRIPTION_MAX};
	max[1] = ${NUMBER_CHARS_FULLDESCRIPTION_MAX};

	for(var i=0; i<id_elm.length; i++){
		value_id2(id_elm[i],min[i],max[i]);
	}
}

function value_id(id,max)
{
	var id2 = document.getElementById(id).value;
	var ln = max-id2.length;

	if(ln < 0){
		ln = 0;
		id2 = id2.slice(0,max);
	}

	var lnpx = Math.round(id2.length / max * 150);

	if(lnpx == 0) lnpx = 1;
	if(lnpx == 150) lnpx = 149;

	var color1='#EE0E02';
	var color2='#FFDBD9';

	if(ln < max){
		color1='#009933';
		color2='#AAFFC6';
	}

	document.getElementById('id_'+id).innerHTML='<img src="./templates/images/line.gif" align="middle" border="1" width="'+lnpx+'" height="8px" style="background:'+color1+'"/><img src="./templates/images/line.gif" border="1" align="middle" width="'+(150-lnpx)+'" height="8px" style="background:'+color2+'"/> ${STR_LEFT}: '+ln+' (${STR_FROM_TOTAL} '+max+')';
}

function value_id2(id,min,max)
{
	var id2 = document.getElementById(id).value;
	var ln = max-id2.length;

	if(ln < 0){
		ln = 0;
		id2 = id2.slice(0,max);
	}

	var lnpx = Math.round(id2.length / max * 150);

	if(lnpx == 0) lnpx = 1;
	if(lnpx == 150) lnpx = 149;

	var color1;
	var color2;

	if(ln > (max-min)){
		color1='#EE0E02';
		color2='#FFDBD9';
	}
	else{
		color1='#009933';
		color2='#AAFFC6';
	}

	document.getElementById('id_'+id).innerHTML='<img src="./templates/images/line.gif" align="middle" border="1" width="'+lnpx+'" height="8px" style="background:'+color1+'"/><img src="./templates/images/line.gif" border="1" align="middle" width="'+(150-lnpx)+'" height="8px" style="background:'+color2+'"/> ${STR_LEFT}: '+ln+' (${STR_FROM_TOTAL} '+max+')';
}

function createXMLHttp() {
	if(typeof XMLHttpRequest != "undefined") { 
          return new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		var aVersions = ["MSXML2.XMLHttp.5.0", "MSXML2.XMLHttp.4.0",
                   "MSXML2.XMLHttp.3.0", "MSXML2.XMLHttp",
                   "Microsoft.XMLHttp"
                   ];
		for (var i = 0; i < aVersions.length; i++) {
			try {
				var oXmlHttp = new ActiveXObject(aVersions[i]);
				return oXmlHttp;
			} catch (oError) {	}
		}
		throw new Error("${ALERT_INITIAALIZATION_ERROR_INTERFACE}");
	}
}
     
function sendRequest() {

	var url = document.getElementById("url").value;
	url = trim(url);

	if (url != '') {
        document.getElementById("id_url").innerHTML = '<img src="./templates/images/loader.gif">';

        var http = new XMLHttpRequest();
        var params = 'url=' + encodeURIComponent(url);
        http.open("POST", "./?t=ajax&action=check_add_link", true);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        http.onreadystatechange = function() {
            if (http.readyState == 4) {
                if (http.status == 200) {
                    document.getElementById("id_url").innerHTML = http.responseText;
                } else {
                    document.getElementById("id_url").innerHTML = http.statusText;
                }
            } else {
                document.getElementById("id_url").innerHTML = '';
            }
        }

        http.send(params);
    }

}

function trim(str)
{
	var newstr = str.replace(/^\s*(.+?)\s*$/, "$1");

	if(newstr == " "){
		return "";
	}

	return newstr;
}

function showLength(id,min,max)
{
	var ln = max - id.value.length;

	if(ln < 0){
		ln = 0;
		id.value = id.value.slice(0,max);
	}

	var lnpx = Math.round(id.value.length / max * 150);

	if(lnpx == 0) lnpx = 1;
	if(lnpx == 150) lnpx = 149;

	var color1;
	var color2;

	if(ln > (max - min)){
		color1='#EE0E02';
		color2='#FFDBD9';
	}
	else{
		color1='#009933';
		color2='#AAFFC6';
	}

	document.getElementById('id_'+id.name).innerHTML='<img src="./templates/images/line.gif" align="middle" width="'+lnpx+'" height="8px" border="1" style="background:'+color1+'"/><img src="./templates/images/line.gif" border="1" align="middle" width="'+(150-lnpx)+'" height="8px" style="background:'+color2+'"/> ${STR_LEFT}: '+ln+' (${STR_FROM_TOTAL} '+max+')';
}

function showLength2(id,max)
{
	var ln = max - id.value.length;

	if(ln < 0){
		ln = 0;
		id.value = id.value.slice(0,max);
	}

	var lnpx = Math.round(id.value.length / max * 150);

	if(lnpx == 0) lnpx = 1;
	if(lnpx == 150) lnpx = 149;

	var color1='#EE0E02';
	var color2='#FFDBD9';

	if(ln < max){
		color1 = '#009933';
		color2 = '#AAFFC6';
	}

	document.getElementById('id_'+id.name).innerHTML='<img src="./templates/images/line.gif" align="middle" width="'+lnpx+'" height="8px" border="1" style="background:'+color1+'"/><img src="./templates/images/line.gif" border="1" align="middle" width="'+(150-lnpx)+'" height="8px" style="background:'+color2+'"/> ${STR_LEFT}: '+ln+' (${STR_FROM_TOTAL} '+max+')';
}

</script>

<h3>${ADDING_LINK}</h3>
<p align="left">« <a href="./">${STR_GO_TO_CATALOG}</a></p>
<table border="0" width="100%">
  <tr>
    <td vAlign="top">
      <!-- IF '${RULES}' != '' -->
      <div id=rule><b>${STR_RULES}:</b> ${RULES}</div>
      <!-- END IF -->
    </td>
  </tr>
  <tr>
    <td><table border="0">
        <!-- IF '${HTMLCODE_SITE1}' != '' || '${HTMLCODE_SITE2}' != '' || '${HTMLCODE_SITE3}' != '' -->
        <tr>
          <td width=100%><br />
            <h4>${STR_HTML_CODE_OF_LINK_FOR_THIS}:</h4></td>
        </tr>
        <!-- END IF -->
        <!-- IF '${HTMLCODE_SITE1}' != '' -->
        <tr>
          <td width="100%"><textarea rows="3" cols="50">${HTMLCODE_SITE1}</textarea></td>
        </tr>
        <!-- END IF -->
        <!-- IF '${HTMLCODE_SITE2}' != '' -->
        <tr>
          <td width=100%><textarea rows="3" cols="50">${HTMLCODE_SITE2}</textarea></td>
        </tr>
        <!-- END IF -->
        <!-- IF '${HTMLCODE_SITE3}' != '' -->
        <tr>
          <td width=100%><textarea rows="3" cols="50">${HTMLCODE_SITE3}</textarea></td>
        </tr>
        <!-- END IF -->
        <tr>
          <td width=100%>
            <!-- BEGIN banners -->
            <br />
            <h4>${STR_HTML_CODE_OF_BANNER_FOR_THIS}:</h4>
            <!-- END banners -->
          </td>
        </tr>
        <!-- IF '${HTMLCODE_BANNER1}' != '' -->
        <tr>
          <td width=100%>${STR_HTMLCODE_BANNER} 1<br />
            <br />
            <textarea rows="3" cols="50">${HTMLCODE_BANNER1}</textarea></td>
        </tr>
        <!-- END IF -->
        <!-- IF '${HTMLCODE_BANNER2}' != '' -->
        <tr>
          <td width=100%>${STR_HTMLCODE_BANNER} 2<br />
            <br />
            <textarea rows="3" cols="50">${HTMLCODE_BANNER2}</textarea></td>
        </tr>
        <!-- END IF -->
        <!-- IF '${HTMLCODE_BANNER3}' != '' -->
        <tr>
          <td width=100%>${STR_HTMLCODE_BANNER} 3<br />
            <br />
            <textarea rows="3" cols="50">${HTMLCODE_BANNER3}</textarea></td>
        </tr>
        <!-- END IF -->
      </table>
      <br />
      <form action="${ACTION}" method="post">
        <table class="link">
          <tr>
            <td><span class="msg">*</span> - ${STR_REQUIRED_FIELD}<br />
              <br /></td>
          </tr>
          <tr>
            <td align="right"><b>${STR_CHOOSE_YOUR_CATEGORY}:</b></td>
            <td><select type="text" class="input" name="cat_id">
                <option value="0" <!-- IF '${ID_CAT}' == 0 -->selected="selected" <!-- END IF --> class="input"> ---- ${STR_CHOOSE_CATEGORY} ---- </option>
                
              ${OPTION}
           
              </select>
            </td>
          </tr>
          <tr>
            <td align="right"><b>${STR_FORM_NAME}:</b></td>
            <td><input size="50" class="input" name="name" type="text" value="${NAME}"></td>
          </tr>
          <tr>
            <td align="right"><b>${STR_FORM_URL}:</b><span class="msg" id="id_url"></span></td>
            <td><input size="50" class="input" maxlength="200" name="url" id="url" onChange="sendRequest();" type="text" value="${URL}"></td>
          </tr>
          <!-- IF '${CHECK_URL}' == 'yes' -->
          <tr>
            <td align="right"><b>${STR_FORM_RECIPROCAL_LINK}:</b></td>
            <td><input size="50" class="input" maxlength="200" name="reciprocal_link" type="text" value="${RECIPROCAL_LINK}"></td>
          </tr>
          <!-- END IF -->
          <tr>
            <td align="right"><b>${STR_FORM_EMAIL}:</b></td>
            <td><input class="input" size="50" maxlength="150" name="email" type="text" value="${EMAIL}"></td>
          </tr>
          <tr>
            <td align="right"><b>${STR_FORM_KEYWORDS}:</b> (${STR_SEPARATED_BY_COMMAS}.)</td>
            <td><input class="input" size="50" maxlength="250" name="keywords" type="text" value="${KEYWORDS}"></td>
          </tr>
          <tr>
            <td align="right"><b>${STR_FORM_DESCRIPTION}:</b><br />
              (${STR_ONLY_TEXT_NOT_HTMLCODE} ${STR_FROM} ${NUMBER_CHARS_DESCRIPTION_MIN} ${STR_TO} ${NUMBER_CHARS_DESCRIPTION_MAX} ${STR_CHARACTERS}) </td>
            <td><textarea class="input2" cols="45" rows="3" onkeyup=showLength(this,${NUMBER_CHARS_DESCRIPTION_MIN},${NUMBER_CHARS_DESCRIPTION_MAX}); id="description" name="description">${DESCRIPTION}</textarea>
              <br />
              <span id="id_description"><img style="BACKGROUND: #FFDBD9" height="8" border="1" src="./templates/images/line.gif" width="150" align="middle"> ${STR_LEFT}: ${NUMBER_CHARS_DESCRIPTION_MAX} (${STR_FROM_TOTAL} ${NUMBER_CHARS_DESCRIPTION_MAX})</span></td>
          </tr>
          <tr>
            <td align="right"><b>${STR_FORM_FULL_DESCRIPTION}:</b><br />
              (${STR_ONLY_TEXT_NOT_HTMLCODE} ${STR_FROM} ${NUMBER_CHARS_FULLDESCRIPTION_MIN} ${STR_TO} ${NUMBER_CHARS_FULLDESCRIPTION_MAX} ${STR_CHARACTERS}) </td>
            <td><textarea class="input2" cols="45" rows="6" onkeyup=showLength(this,${NUMBER_CHARS_FULLDESCRIPTION_MIN},${NUMBER_CHARS_FULLDESCRIPTION_MAX}); id="full_description" name="full_description">${FULL_DESCRIPTION}</textarea>
              <br />
              <span id="id_full_description"><img style="BACKGROUND: #FFDBD9" height="8" border="1" src="./templates/images/line.gif" width="150" align="middle"> ${STR_LEFT}: ${NUMBER_CHARS_FULLDESCRIPTION_MAX} (${STR_FROM_TOTAL} ${NUMBER_CHARS_FULLDESCRIPTION_MAX})</span></td>
          </tr>
          <tr>
            <td align="right"><b>${STR_HTML_CODE_BANNER}:</b><br />
              (${STR_IF_ANY} ${STR_NO_MORE} ${NUMBER_HTML_CHARS} ${STR_CHARACTERS})</td>
            <td><textarea class="input2" cols="45" rows="3" onkeyup=showLength2(this,${NUMBER_HTML_CHARS}); id="htmlcode_banner" name="htmlcode_banner">${HTMLCODE_BANNER}</textarea>
              <br />
              <span id="id_htmlcode_banner"><img style="BACKGROUND: #FFDBD9" height="8" border="1" src="./templates/images/line.gif" width="150" align="middle"> ${STR_LEFT}: ${NUMBER_HTML_CHARS} (${STR_FROM_TOTAL} ${NUMBER_HTML_CHARS})</span></td>
          </tr>

          <!-- IF '${SECURITYCODE}' == 'yes' -->

          <tr>
            <td align="right"><b>${STR_FORM_SECURITYCODE}:</b></td>
            <td rowspan="2" valign="bottom"><input class="input" type="text" size="8" maxlength="8" name="securitycode"></td>
          </tr>
          <tr>
            <td align="right">
              <img src="${IMAGE_SRC}" alt="${STR_SECURITYCODE}"  />
            </td>
          </tr>

          <!-- END IF -->

          <tr>
            <td align="right" height="50">&nbsp;</td>
            <td>
              <input type="submit" class="inputsubmit" value="${BUTTON_ADD}">              &nbsp;&nbsp;&nbsp;
              <input type="reset" class="inputsubmit" value="${BUTTON_RESET}">
              <input type=hidden name="action" value="post"></td>
          </tr>
        </table>
      </form>
      <!-- BEGIN show_errors -->
      <h4 class="msg">${STR_IDENTIFIED_FOLLOWING_ERRORS}:</h4>
      <ul class="msg">
        <!-- BEGIN errors -->
        <li> ${ERROR}</li>
        <!-- END errors -->
      </ul>
      <!-- END show_errors -->
      <p style="text-align: center">
        <a href="http://janicky.com/" target=_blank>${STR_SCRIPT_LINK_CATALOG} ${VERSION}</a>
      </p>
      <br /></td>
  </tr>
</table>
<!-- INCLUDE footer.tpl -->