<!-- INCLUDE header.tpl -->
<!-- IF '${PARENT_ID}' != '' -->« <a href="<!-- URL 'Helper::url("./?a=admin&t=categories&parent_id=${PARENT_ID}")' -->">${STR_GO_BACK}</a><!-- ELSE -->« <a href="<!-- URL 'Helper::url("./?a=admin&t=categories")' -->">${STR_GO_BACK}</a><!-- END IF -->
<!-- INCLUDE category_form.tpl -->
<!-- INCLUDE footer.tpl -->
