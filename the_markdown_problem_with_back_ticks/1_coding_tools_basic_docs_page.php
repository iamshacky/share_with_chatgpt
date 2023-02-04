<style>
    code {
        background-color: orange;
    }

    .highlighted-code {
        background-color: orange;
    }
</style>
<!--
Note: The reason for the h3 classes of h3_toc and the id=<the_file_name> is so that they can be used in a table of contents or as a bookmark.

Each section below can be an included file or regular text.

# Each file named: 

1_coding_tools_basic_docs_page.php
-->


<?php
//$_GET['snippet_id'] = 109;
// Vars to add stuff to the page.
$description = '';
?>
<!--
Variables go above this comment 
-->


<?php 
// config
include_once($_SERVER['DOCUMENT_ROOT'] . '/project1' . '/config/config.php');

// header
include($zz_coding_tools_basic_docs_header);
?>





<div class="coding_tools_main_div">

<div class="docs_all_examples_container"><!--so toc will work-->




<!-- 1 --> 
<h1 class="h3_toc" id="example_1">
cold startup time for server
</h1>

<!--
<div id="demoDiv" class="coding_tools_example">
<pre>
    <?php//include 'cold_startup_time_for_server.html';
    ?>
</pre>
</div>
--> 

<pre>
<?php
$file_contents = file_get_contents('cold_startup_time_for_server.html');
$file_contents = htmlspecialchars($file_contents);
$file_contents = strip_tags($file_contents);
$file_contents = str_replace("`", "", $file_contents);
echo $file_contents;
?>
</pre>

<?php
echo '<h1 style="color:red">alrighty then, new section</h1>';
$generic_var = 'cold_startup_time_for_server.html';
$display_code = $file_contents = file_get_contents($generic_var);
$display_code = strip_tags($display_code);
$display_code = str_replace("`", "", $display_code);
?>


<pre class="highlighted-code">
    <div class="highlighted-code">asdfasdf
<code>
<?php
echo 'asdfasdfasdfasf';
?>
</code>
</div>
</pre>
<h1 style="color:blue" class="highlighted-code">done</h1>



</div><!-- end docs_all_examples_container -->
</div><!-- close coding_tools_main_div --> 

<hr>



<script src="markdown_parser_code.js"></script>


<?php include($zz_coding_tools_basic_docs_footer);?>
