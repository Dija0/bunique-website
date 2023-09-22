<?php 
// Include configuration file 
include_once 'config.php'; 
 
$postData = ''; 
if(!empty($_SESSION['postData'])){ 
    $postData = $_SESSION['postData']; 
    unset($_SESSION['postData']); 
} 
 
$status = $statusMsg = ''; 
if(!empty($_SESSION['status_response'])){ 
    $status_response = $_SESSION['status_response']; 
    $status = $status_response['status']; 
    $statusMsg = $status_response['status_msg']; 
} 
?>

<!-- Status message -->
<?php if(!empty($statusMsg)){ ?>
    <div class="alert alert-<?php echo $status; ?>"><?php echo $statusMsg; ?></div>
<?php } ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bunique Beauty</title>
    <link rel="stylesheet" type="text/css" href="style4.css"> <!-- Include the external CSS file -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0f3b18171b.js" crossorigin="anonymous"></script>

    <script>
        // JavaScript to show and hide the popup alert
        window.addEventListener('DOMContentLoaded', (event) => {
            const alertElement = document.querySelector('.alert');

            // Check if the alert element exists and contains a message
            if (alertElement && alertElement.textContent.trim() !== '') {
                alertElement.style.display = 'block'; // Show the alert

                // Hide the alert after 5 seconds (adjust as needed)
                setTimeout(function() {
                    alertElement.style.display = 'none';
                }, 5000); // 5 seconds (5000 milliseconds)
            }
        });
    </script>
</head>
<body>
    <a href='bunique.html' class='logout'><i class="fas fa-sign-out-alt"></i> Logout</a>
    <div class="container">
        <form method="post" action="addEvent.php" class="form">
            <h1>Add Service</h1>
            <div class="form-group">
                <label for="title">Service</label>
                <input type="text" id="title" class="form-control" name="title" value="<?php echo !empty($postData['title'])?$postData['title']:''; ?>" required="">
            </div>
            <div class="form-group">
                <label for="description">Service Description</label>
                <textarea id="description" name="description" class="form-control"><?php echo !empty($postData['description'])?$postData['description']:''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="location">Phone Number</label>
                <input type="text" id="location" name="location" class="form-control" value="<?php echo !empty($postData['location'])?$postData['location']:''; ?>">
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" class="form-control" value="<?php echo !empty($postData['date'])?$postData['date']:''; ?>" required="">
            </div>
            <div class="form-group time">
                <label for="time_from">Time</label>
                <input type="time" id="time_from" name="time_from" class="form-control" value="<?php echo !empty($postData['time_from'])?$postData['time_from']:''; ?>">
                <span>to</span>
                <input type="time" id="time_to" name="time_to" class="form-control" value="<?php echo !empty($postData['time_to'])?$postData['time_to']:''; ?>">
            </div>
            <div class="form-group">
                <input type="submit" class="btn-primary" name="submit" value="Add Service"/>
            </div>
        </form>
    </div>
</body>
</html>
