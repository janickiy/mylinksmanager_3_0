<div class="row">
   <div class="col-md-12">
      <div class="panel panel-default">
         <div class="panel-heading"><span class="msg">*</span> - ${STR_REQUIRED_FIELDS}</div>
         <div class="panel-body">
            <form enctype="multipart/form-data" action="${PHP_SELF}" role="form" method=post>
               <div class="form-group">
                  <label for="name">${STR_CATEGORY_NAME}:<span class=msg>*</span></label>
                  <input type="text" class="form-control" value="${NAME}" name="name">
               </div>
               <div class="form-group">
                  <label for="description">${STR_CATEGORY_DESCRIPTION}:</label>
                  <input type="text" class="form-control" value="${DESCRIPTION}" name="description">
               </div>
               <div class="form-group">
                  <label for="keywords">${STR_CATEGORY_KEYWORDS}:</label>
                  <input type="text" class="form-control" value="${KEYWORDS}" name="keywords">
               </div>
               <!-- IF '${OPTION}' != '' -->
               <div class="form-group">
                  <label for="new_id_cat">${STR_CATEGORY}:</label>
                  <select type=text name="new_id_cat" class="form-control">
                     <option value="0"  
                     <!-- IF '${ID_CAT}' == 0 -->
                     selected="selected"
                     <!-- END IF -->
                     class="input"> ----${STR_NO}---- 
                     </option>            
                     ${OPTION}
                  </select>
               </div>
               <!-- END IF -->
               <div class="form-group">
                  <label for="image">${STR_CATEGORY_IMAGE}:</label>
                  <input type="file" name="image">
               </div>
               <div class="checkbox">
                  <label for="removepic">
                     <input type="checkbox" 
                     <!-- IF '${FREEZ}' == 'yes' -->
                     disabled
                     <!-- END IF -->
                     type="checkbox" name="removepic">
                     ${STR_REMOVE_PIC} 
                  </label>
               </div>
               <!-- IF '${PARENT_ID}' != '' -->
               <input type=hidden name="parent_id" value="${PARENT_ID}">
               <!-- END IF -->
               <!-- IF '${ID}' != '' -->
               <input type=hidden name="id" value="${ID}">
               <!-- END IF -->
               <input type=hidden name="action" value="post">
               <button class="btn btn-primary" type="submit">${BUTTON}</button>

         </form>
      </div>
      </div>
   </div>
</div>