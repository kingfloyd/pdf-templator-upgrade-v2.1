<?php


print "please choose document";


?>

<input type="radio" required name="<?php echo PREMETA; ?>newsletter_template" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_template'),"New Letter (includes letterhead)"); ?> value="New Letter (includes letterhead)" autocomplete="off">New Letter (includes letterhead) &nbsp;&nbsp;
<input type="radio" required name="<?php echo PREMETA; ?>newsletter_template" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_template'),"New Letter (blank sheet)"); ?> value="New Letter (blank sheet)" autocomplete="off">New Letter (blank sheet) &nbsp;&nbsp;
<input type="radio" required name="<?php echo PREMETA; ?>newsletter_template" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_template'),"Saved Letter"); ?> value="Saved Letter" autocomplete="off">Saved Letter &nbsp;&nbsp;
