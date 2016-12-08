<?php
$selectedColumn = $_GET['selectedColumn'];
$selectedColumn = str_replace('col-sm', '', $selectedColumn);
$selectedColumn = explode('-', $selectedColumn);
$columnId = strtotime("now");
$pluginUrl = explode("ajax", url())[0];
printColumn($selectedColumn, $columnId, $pluginUrl);

function printColumn($columnSize, $columnId, $pluginUrl)
{ ?>
    <div class="row" id="pdftv2-column-<?php print $columnId; ?>"  >
        <div class="pdftv2-settings-column" style="margin-bottom: 2px" >
            <span   class="pdftv2-button-column-delete" delete-elem="#pdftv2-column-<?php print $columnId; ?>" data-target="#pdftv2-column-delete" data-toggle="modal">
                <img title="delete column" style="height: 20px;" src="<?php print  $pluginUrl .'/assets/img/delete-icon.png' ?>" />
            </span>
            <span title="edit column" class="pdftv2-button-column-settings" id="pdftv2-button-column-settings" delete-elem="#pdftv2-column-<?php print $columnId; ?>" data-target="#pdftv2-column-settings-edit" data-toggle="modal" >
                <img style="height: 20px;" src="<?php print  $pluginUrl .'/assets/img/settings-icon.png' ?>" />
            </span>
        </div>

        <div style="display:flex">
            <?php foreach($columnSize as $key => $size):
                if( $size != 0 )
                { ?>
                    <div class="col-sm-<?php print $size; ?> pdftv2-content-container" style="border: 1px solid #eeeeee;padding: 11px !important;" >

                            <div style="float: right;" id="pdftv2-column-content-edit" data-toggle="modal" data-target="#pdftv2-wp-editor">

                                <img  style="cursor:pointer; height: 20px;" src="<?php print  $pluginUrl .'/assets/img/edit-icon.png' ?>" />
                            </div>

                            <div id="pdftv2-column"    >
                            <p> ...... </p> 
                        </div>
                    </div>
                    <?php
                }
                endforeach;
            ?>
            <div style="clear:both">
            </div>
        </div>
    </div>
<?php
}
function url()
{
    if(isset($_SERVER['HTTPS'])) {
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    } else {
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}
