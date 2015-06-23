<?php echo "<h1>".__('Settings') . "</h1>"; ?>
	<form action="<?php echo get_url('plugin/djg_rss/save'); ?>" method="post">
	<fieldset style="padding: 0.5em;">
		<table class="fieldset" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td class="label"><label for="settings[generator]"><?php echo __('Generator'); ?></label></td>
				<td class="field">
					<input type="text" class="textbox" name="settings[generator]" value="<?php echo $settings['generator']; ?>" />
				</td>
				<td class="help"></td>
			</tr>
			<tr>
				<td class="label"><label for="settings[displayChannelContent]"><?php echo __('Display channel content') ?></label></td>
				<td class="field">
					   <select class="select" name="settings[defaultActive]">
						   <option value="1" <?php if ($settings['displayChannelContent'] == "1") echo 'selected = "";' ?>><?php echo __('Yes'); ?></option>
						   <option value="0" <?php if ($settings['displayChannelContent'] == "0") echo 'selected = "";' ?>><?php echo __('No'); ?></option>
					   </select>
				</td>
				<td class="help"></td>
			</tr>
			<tr>
				<td class="label"><label for="settings[managingEditor]"><?php echo __('Managing Editor'); ?></label></td>
				<td class="field">
					<input type="text" class="textbox" name="settings[managingEditor]" value="<?php echo $settings['managingEditor']; ?>" />
				</td>
				<td class="help"></td>
			</tr>
			<tr>
				<td class="label"><label for="settings[webMaster]"><?php echo __('Web Master'); ?></label></td>
				<td class="field">
					<input type="text" class="textbox" name="settings[webMaster]" value="<?php echo $settings['webMaster']; ?>" />
				</td>
				<td class="help"></td>
			</tr>
			<tr>
				<td class="label"><label for="settings[maxFeedsPerChannel]"><?php echo __('Max feeds per channel'); ?></label></td>
				<td class="field">
					<input type="number" min="1" max="1000" step="1" class="textbox" name="settings[maxFeedsPerChannel]" value="<?php echo $settings['maxFeedsPerChannel']; ?>" />
				</td>
				<td class="help"></td>
			</tr>
			<tr>
				<td class="label"><label for="settings[language]"><?php echo __('Language'); ?></label></td>
				<td class="field">
					<input type="text" class="textbox" name="settings[language]" value="<?php echo $settings['language']; ?>" />
				</td>
				<td class="help"></td>
			</tr>
		</table>
	</fieldset>
    <p class="buttons">
        <input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save'); ?>" />
    </p>
	</form>
<script type="text/javascript">
// <![CDATA[
    function setConfirmUnload(on, msg) {
        window.onbeforeunload = (on) ? unloadMessage : null;
        return true;
    }
    function unloadMessage() {
        return '<?php echo __('You have modified this page. If you navigate away from this page without first saving your data, the changes will be lost.'); ?>';
    }
    $(document).ready(function() {
        // Prevent accidentally navigating away
        $(':input').bind('change', function() { setConfirmUnload(true); });
        $('form').submit(function() { setConfirmUnload(false); return true; });
    });
// ]]>
</script>