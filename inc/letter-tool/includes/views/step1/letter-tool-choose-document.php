


<table class="table table-bordered">
    <tr>
        <td style="width:100px">
            <img src="http://localhost/practice/wordpress/wp-content/plugins/pdf-templator-upgrade-v2.1/assets/img/print.jpg" />
        </td>
        <td>
            <input type="radio" required name="<?php echo PREMETA; ?>newsletter_template" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_template'),"New Letter (includes letterhead)"); ?> value="New Letter (includes letterhead)" autocomplete="off">New Letter (includes letterhead) &nbsp;&nbsp;
            <p>Lorem Ipsum is simply dummy text o s been the industry's standard d</p>
        </td>
    </tr>
    <tr>
        <td style="width:100px">
            <img src="http://localhost/practice/wordpress/wp-content/plugins/pdf-templator-upgrade-v2.1/assets/img/print.jpg" />
        </td>
        <td>
            <input type="radio" required name="<?php echo PREMETA; ?>newsletter_template" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_template'),"New Letter (blank sheet)"); ?> value="New Letter (blank sheet)" autocomplete="off">New Letter (blank sheet) &nbsp;&nbsp;
            <p>Lorem Ipsum is simply du s been the industry's standard d</p>
        </td>
    </tr>
    <tr>
        <td style="width:100px">

            <img src="http://localhost/practice/wordpress/wp-content/plugins/pdf-templator-upgrade-v2.1/assets/img/print.jpg" />
        </td>
        <td>
            <input type="radio" required name="<?php echo PREMETA; ?>newsletter_template" <?php checked_radio(get_pdfnewsletter_meta($pid,PREMETA.'newsletter_template'),"Saved Letter"); ?> value="Saved Letter" autocomplete="off">Saved Letter &nbsp;&nbsp;
            <p>Lorem Ipsum is simply dummy text of the  e industry's standard d</p>
        </td>
    </tr>
</table>



