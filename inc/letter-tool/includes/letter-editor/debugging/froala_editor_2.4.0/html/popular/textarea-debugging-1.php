
<?php
  $path = 'http://localhost/practice/wordpress/wp-content/plugins/pdf-templator-upgrade-v2.1/inc/letter-tool/includes/letter-editor/debugging/froala_editor_2.4.0';

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php print $path; ?>/css/froala_editor.css">
  <link rel="stylesheet" href="<?php print $path; ?>/css/froala_style.css">
  <link rel="stylesheet" href="<?php print $path; ?>/css/plugins/code_view.css">
  <link rel="stylesheet" href="<?php print $path; ?>/css/plugins/image_manager.css">
  <link rel="stylesheet" href="<?php print $path; ?>/css/plugins/image.css">
  <link rel="stylesheet" href="<?php print $path; ?>/css/plugins/table.css">
  <link rel="stylesheet" href="<?php print $path; ?>/css/plugins/video.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">


  <style>
    body {
      text-align: center;
    }

    div#editor {
      width: 81%;
      margin: auto;
      text-align: left;
    }
  </style>
</head>

<body>
  <div id="editor">


    <?php for($i=0; $i<=21; $i++) {  ?>
      <div id="letter-tool-page-line-separator-<?php print $i; ?>"  class='letter-tool-page-line-separator' > </div>
    <?php } ?>


    <div class="row">

    </div>
    <div id="lt-editor-unmovablebox" class="lt-editor-unmovablebox" >
        <textarea cols="20"  rows="20" placeholder="please put your address here.." >{first_name}{last_name}{address}{address2}{town}{city}{postcode}</textarea>
    </div>

    <form>  
      <textarea id='edit' style="margin-top: 30px;" placeholder="Type some text"></textarea>

      <input type="submit">
      <input type="button" id="test-button" value="test me"/>
    </form>

<!-- 
inc/letter-tool/includes/letter-editor/debugging/froala_editor_2.4.0/
    <div id="history">  
  test
    </div> -->
  </div>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>
  <script type="text/javascript" src="<?php print $path; ?>/js/froala_editor.min.js"></script>
  <script type="text/javascript" src="<?php print $path; ?>/js/plugins/align.min.js"></script>
  <script type="text/javascript" src="<?php print $path; ?>/js/plugins/code_beautifier.min.js"></script>
  <script type="text/javascript" src="<?php print $path; ?>/js/plugins/code_view.min.js"></script>
  <script type="text/javascript" src="<?php print $path; ?>/js/plugins/draggable.min.js"></script>
  <script type="text/javascript" src="<?php print $path; ?>/js/plugins/image.min.js"></script>
  <script type="text/javascript" src="<?php print $path; ?>/js/plugins/image_manager.min.js"></script>
  <script type="text/javascript" src="<?php print $path; ?>/js/plugins/link.min.js"></script>
  <script type="text/javascript" src="<?php print $path; ?>/js/plugins/lists.min.js"></script>
  <script type="text/javascript" src="<?php print $path; ?>/js/plugins/paragraph_format.min.js"></script>
  <script type="text/javascript" src="<?php print $path; ?>/js/plugins/paragraph_style.min.js"></script>
  <script type="text/javascript" src="<?php print $path; ?>/js/plugins/table.min.js"></script>
  <script type="text/javascript" src="<?php print $path; ?>/js/plugins/video.min.js"></script>
  <script type="text/javascript" src="<?php print $path; ?>/js/plugins/url.min.js"></script>
  <script type="text/javascript" src="<?php print $path; ?>/js/plugins/entities.min.js"></script>
 
  
  <script type="text/javascript" src="<?php print $path; ?>/html/popular/js/letter-tool-js-1.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php print $path; ?>/html/popular/css/letter-tool-style-1.css">
</body>
</html>
