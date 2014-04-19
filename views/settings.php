<?php echo "<h1>".__('Settings') . "</h1>"; ?>
	<form action="<?php echo get_url('plugin/djg_rss/save'); ?>" method="post">
	<fieldset style="padding: 0.5em;">
		<table class="fieldset" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td class="label"><?php echo __('Generator'); ?></td>
				<td class="field">
					<input type="text" class="textbox" name="settings[generator]" value="<?php echo $settings['generator']; ?>" />
				</td>
				<td class="help"></strong></td>
			</tr>
			<tr>
				<td class="label"><?php echo __('Managing Editor'); ?></td>
				<td class="field">
					<input type="text" class="textbox" name="settings[managingEditor]" value="<?php echo $settings['managingEditor']; ?>" />
				</td>
				<td class="help"></strong></td>
			</tr>
			<tr>
				<td class="label"><?php echo __('Web Master'); ?></td>
				<td class="field">
					<input type="text" class="textbox" name="settings[webMaster]" value="<?php echo $settings['webMaster']; ?>" />
				</td>
				<td class="help"></strong></td>
			</tr>
			<tr>
				<td class="label"><?php echo __('Max <strong>feeds</strong> per chanel'); ?></td>
				<td class="field">
					<input type="number" min="1" max="1000" step="1" class="textbox" name="settings[maxFeedsPerChanel]" value="<?php echo $settings['maxFeedsPerChanel']; ?>" />
				</td>
				<td class="help"></strong></td>
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
        return '<?php echo __('You have modified this page.  If you navigate away from this page without first saving your data, the changes will be lost.'); ?>';
    }
    $(document).ready(function() {
        // Prevent accidentally navigating away
        $(':input').bind('change', function() { setConfirmUnload(true); });
        $('form').submit(function() { setConfirmUnload(false); return true; });
    });
// ]]>
</script>