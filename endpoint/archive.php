<?php
// Include the database connection file
include('../conn/conn.php');

// Check if the connection is successful
if ($conn) {
    // Get the note ID and action from the form data
    $noteID = $_GET['id'];
    $action = $_GET['action'];

    // Update the "archived" column in the database for the specified note
    if ($action === 'archive') {
         
        $sql = "UPDATE `tbl_notes` SET `archived` = 1 WHERE `tbl_notes_id` = :noteID";
    } elseif ($action === 'unarchived') {
       
        $sql = "UPDATE `tbl_notes` SET `archived` = 0 WHERE `tbl_notes_id` = :noteID";
    } else {
        // Invalid action, handle error or redirect back to original page
        header("Location: index.php");
        exit;
    }

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':noteID', $noteID, PDO::PARAM_INT);
    $stmt->execute();

    // Redirect back to the original page after processing the action
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
} else {
    // Connection failed, handle the error or redirect back to original page
    header("Location: index.php");
    exit;
}
?>