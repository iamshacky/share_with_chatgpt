

<?php 
// config.php
$path = $_SERVER['DOCUMENT_ROOT'] . '/project1' . '/config/config.php';
include_once($path);

include($snippets_default_list_view);
?>





<?php

// require_db_connection
require_once($db_ss_pdo_1);

// Define variables and initialize with empty values
$snippet_title = $snippet = $notes = $source = $tags = $snippet_file_name = $snippet_meta_text = "";

$snippet_title_err = $snippet_err = $notes_err = $source_err = $tags_err = $snippet_file_name_err = $snippet_meta_text_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    // Validate snippet_title
    $input_snippet_title = trim($_POST["snippet_title"]);
    if (empty($input_snippet_title))
    {
        $snippet_title_err = "Please enter a snippet title.";
    }
    else
    {
        $snippet_title = $input_snippet_title;
    }

    // Validate snippet
    $input_snippet = trim($_POST["snippet"]);
    if (empty($input_snippet))
    {
        $snippet_err = "Please enter a snippet.";
    }
    else
    {
        $snippet = $input_snippet;
    }

    // Validate notes
    $input_notes = trim($_POST["notes"]);
    if (empty($input_notes))
    {
        $notes_err = "Please enter notes.";
    }
    else
    {
        $notes = $input_notes;
    }

    // Validate source
    $input_source = trim($_POST["source"]);
    if (empty($input_source))
    {
        $source_err = "Please enter source.";
    }
    else
    {
        $source = $input_source;
    }

    // Validate snippet_meta_text
    $input_snippet_meta_text = trim($_POST["snippet_meta_text"]);
    if (empty($input_snippet_meta_text))
    {
        $snippet_meta_text = "";
    }
    else
    {
        $snippet_meta_text = $input_snippet_meta_text;
    }

    // Validate tags
    $input_tags = trim($_POST["tags"]);
    if (empty($input_tags))
    {
        $tags_err = "Please enter tags.";
    }
    else
    {
        $tags = $input_tags;
    }

    // Validate snippet_file_name
    $input_snippet_file_name = trim($_POST["snippet_file_name"]);
    if (empty($input_snippet_file_name))
    {
        $snippet_file_name_err = "Please enter snipet_file_name(s).";
    }
    else
    {
        $snippet_file_name = $input_snippet_file_name;
    }

    // Check input errors before inserting in database
    if (empty($snippet_title_err) && empty($snippet_err) && empty($notes_err) && empty($source_err) && empty($tags_err) && empty($snippet_file_name_err))
    {
        // Prepare an insert statement
        $sql = "INSERT INTO snippets (snippet_title, snippet, notes, source, snippet_meta_text, tags, snippet_file_name) VALUES (:snippet_title, :snippet, :notes, :source, :snippet_meta_text, :tags, :snippet_file_name)";

        if ($stmt = $pdo->prepare($sql))
        {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":snippet_title", $param_snippet_title);
            $stmt->bindParam(":snippet", $param_snippet);
            $stmt->bindParam(":notes", $param_notes);
            $stmt->bindParam(":source", $param_source);
            $stmt->bindParam(":snippet_meta_text", $param_snippet_meta_text);
            $stmt->bindParam(":tags", $param_tags);
            $stmt->bindParam(":snippet_file_name", $param_snippet_file_name);

            // Set parameters
            $param_snippet_title = $snippet_title;
            $param_snippet = $snippet;
            $param_notes = $notes;
            $param_source = $source;
            $param_tags = $tags;
            $param_snippet_file_name = $snippet_file_name;
            if($_POST['snippet_meta_text']) $param_snippet_meta_text = $snippet_meta_text;
            
            // Attempt to execute the prepared statement
            if ($stmt->execute())
            {
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            }
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($pdo);
}
?>
 
<div class="snippets">  

<h1 class="page_title_detail">Create Record</h1>

<p>Please fill this form and submit to add a snippet to the database.</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

<!-- Snippet title -->
    <div>
        <h4>Snippet title</h4>
        <input type="text" 
        name= "snippet_title" <?php echo (!empty($snippet_title_err)) ? 'is-invalid' : ''; ?>><?php echo $snippet_title; ?></textarea>
        <span><?php echo $snippet_title_err; ?></span>
    </div>

    <!-- Snippet -->
    <div>
        <h4>Snippet</h4>
        <textarea name="snippet" <?php echo (!empty($snippet_err)) ? 'is-invalid' : ''; ?>><?php echo $snippet; ?></textarea>
        <span><?php echo $snippet_err; ?></span>
    </div>

    <!-- Notes -->
    <div>
        <h4>Notes</h4>
        <textarea name="notes" <?php echo (!empty($notes_err)) ? 'is-invalid' : ''; ?> value="<?php echo $notes; ?>"></textarea>
        <span><?php echo $notes_err; ?></span>
    </div>


    <!-- Source -->
    <div>
        <h4>Source</h4>
        <input type="text" name="source" <?php echo (!empty($source_err)) ? 'is-invalid' : ''; ?> value="<?php echo $source; ?>">
        <span><?php echo $source_err; ?></span>
    </div>

    <!-- snippet_meta_text -->
    <div>
        <h4>Snippet meta text</h4>
        <textarea name="snippet_meta_text" <?php echo (!empty($snippet_meta_text_err)) ? 'is-invalid' : ''; ?>><?php echo $snippet_meta_text; ?></textarea>
        <span><?php echo $snippet_meta_text_err; ?></span>
    </div>

    <!-- Tags -->
    <div>
        <h4>Tags</h4>
        <input type="text" name="tags" <?php echo (!empty($tags_err)) ? 'is-invalid' : ''; ?> value="<?php echo $tags; ?>">
        <span><?php echo $tags_err; ?></span>
    </div>

    <!-- snippet_file_name -->
    <div>
        <h4>Snippet file name</h4>
        <input type="text" name="snippet_file_name" <?php echo (!empty($snippet_file_name_err)) ? 'is-invalid' : ''; ?> value="<?php echo $snippet_file_name; ?>">
        <span><?php echo $snippet_file_name_err; ?></span>
    </div>

    <br><br>
    <!-- Submit snippet -->
    <button id="submit" type="submit" class="button submit">Create</button>

    <br><br>
    <!-- Cancel, go to home -->
    <a href='<?php echo $snippets_home;?>' class='cancel'>Cancel</a>
</form>

<div style="width:100%;clear:both;"></div>

</div><!-- close class snippets -->  

</div>

<!-- Footer -->
<?php
include($snippets_default_footer);
?>
