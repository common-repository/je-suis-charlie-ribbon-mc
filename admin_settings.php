
<style>
.postbox {
  padding-left: 10px;
}
.one-third {
  float: left;
  margin: 0 0 20px;
  padding-left: 3%;
  width: 31%;
}
.one-fourth {
  float: left;
  margin: 0 0 20px;
  padding-left: 2%;
  width: 23%;
}

.first {
  padding-left: 0;
}

</style>


<div class=wrap>
    <div class="icon32" id="icon-edit"><br /></div>
    <h2><?php _e('"Je suis Charlie" Ribbon', MC_JSC_LANG_TAG) ?></h2>
    <form method="post" name="optForm" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
        <div class="postbox " id="postexcerpt">
            <h3><?php _e('Ribbon Position', MC_JSC_LANG_TAG) ?></h3>
            <div class="inside">
                <p>
                    <label for="mc_jsc_opt_left_yes">
                        <input type="radio" id="mc_jsc_opt_left_yes" name=<?php echo '"'.MC_JSC_OPT_LEFT.'"' ?> value="true" 
							<?php if ($options[MC_JSC_OPT_LEFT] == "true") { print ' checked="checked"';} ?> />
						<?php _e('Left', MC_JSC_LANG_TAG) ?>
                    </label>
                    <label for="mc_jsc_opt_left_no">
                        <input type="radio" id="mc_jsc_opt_left_no" name=<?php echo '"'.MC_JSC_OPT_LEFT.'"' ?>  value="false" 
							<?php if ($options[MC_JSC_OPT_LEFT] == "false") { print ' checked="checked"';} ?>/>
						<?php _e('Right', MC_JSC_LANG_TAG) ?>
                    </label>
                </p>
            </div>
        </div>
        <div class="postbox " id="postexcerpt" style="height:150px" >
            <h3><span><?php _e('URL for the ribbon link', MC_JSC_LANG_TAG) ?></span></h3>
            <div class="inside">
				<div class="one-fourth first">
					<label for="mc_jsc_opt_url_choice_w">
						<input type="radio" id="mc_jsc_opt_url_choice_w" name=<?php echo '"'.MC_JSC_OPT_URL_CHOICE.'"' ?> value="W" onclick="mngTxt('W')"
							<?php if ($options[MC_JSC_OPT_URL_CHOICE] == "W") { print ' checked="checked"';} ?> />
						<a href=<?php echo '"'.MC_JSC_URL_W.'"'?> target="_blank" ><?php _e('Charlie Hebdo Web Site', MC_JSC_LANG_TAG) ?></a>
					</label>
					<br />
				</div>
				<div class="one-fourth">
					<label for="mc_jsc_opt_url_choice_a">
						<input type="radio" id="mc_jsc_opt_url_choice_a" name=<?php echo '"'.MC_JSC_OPT_URL_CHOICE.'"' ?> value="A"  onclick="mngTxt(this.value)"
							<?php if ($options[MC_JSC_OPT_URL_CHOICE] == "A") { print ' checked="checked"';} ?> />
						<a href=<?php echo '"'.MC_JSC_URL_A.'"'?> target="_blank" ><?php _e("I Help Charlie web site (donations to the magazine)", MC_JSC_LANG_TAG) ?></a>
					</label>
				</div>
				<div class="one-fourth">
					<label for="mc_jsc_opt_url_choice_t">
						<input type="radio" id="mc_jsc_opt_url_choice_t" name=<?php echo '"'.MC_JSC_OPT_URL_CHOICE.'"' ?> value="T"  onclick="mngTxt(this.value)"
							<?php if ($options[MC_JSC_OPT_URL_CHOICE] == "T") { print ' checked="checked"';} ?> />
						<a href=<?php echo '"'.MC_JSC_URL_T.'"'?> target="_blank" ><?php _e('#JeSuisCharlie on Twitter', MC_JSC_LANG_TAG) ?></a>
					</label>
				</div>
				<div class="one-fourth">
					<label for="mc_jsc_opt_url_choice_u">
						<input type="radio" id="mc_jsc_opt_url_choice_u" name=<?php echo '"'.MC_JSC_OPT_URL_CHOICE.'"' ?> value="U"  onclick="mngTxt(this.value)"
							<?php if ($options[MC_JSC_OPT_URL_CHOICE] == "U") { print ' checked="checked"';} ?> />
						<?php _e('User URL (type in the URL you want to link to)', MC_JSC_LANG_TAG) ?>
					</label>
					<br />
					<input type="text" id=<?php echo '"'.MC_JSC_OPT_URL.'"' ?> size="30" name=<?php echo '"'.MC_JSC_OPT_URL.'"' ?>  value=<?php echo '"'.$options[MC_JSC_OPT_URL].'"' ?> />
				</div>
			</div>
        </div>
        <div class="submit">
            <input type="submit" name=<?php echo MC_JSC_UPD_SETTINGS ?> value="<?php _e('Update Settings', MC_JSC_LANG_TAG) ?>" />
        </div>
    </form>
</div>
<script language="JavaScript">
function mngTxt(pValue) {
	if (pValue == "U") {
		<?php echo "document.optForm.elements." . MC_JSC_OPT_URL . ".disabled=false;";  ?>
	} else {
		<?php echo "document.optForm.elements." . MC_JSC_OPT_URL . ".disabled=true;";  ?>
	}
}
mngTxt(<?php echo '"'.$options[MC_JSC_OPT_URL_CHOICE].'"' ?>);
</script>
 
