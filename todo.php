<?php

// we need to import the controller that we created, the code inside will be executed once it was imported here
require_once $_SERVER["DOCUMENT_ROOT"] . "/controllers/task.php";

// we just echoing the response for now so that we can easily debug it
print_r($response);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todo App</title>

  <style>
    table,
    th,
    td {
      border: 1px solid black;
    }

    div {
      padding: 4px;
      border-radius: 2px;
      color: #fff;
      width: fit-content;
      margin-block: 5px;
    }

    .error {
      background-color: red;
    }

    .success {
      background-color: green;
    }
  </style>
</head>

<body>

  <h1>
    Here's your ToDo tasks
  </h1>

  <!-- now let's check if there's any message on our response -->
  <?php
  if (isset($response['message'])) {
    if ($response['message']) {

      if ($response['success']) {
        echo "<div class='success'>";
      } else {
        echo "<div class='error'>";
      }

      echo $response['message'];

      echo "</div>";
    }
  }
  ?>

  <table>
    <thead>
      <tr style="text-align: left">
        <th style="width: 200px">Title</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($response['data'] as $task) {
        echo "<tr style='text-align: left'>";
        echo "<td style='width: 200px'>" . $task['title'] . "</td>";
        echo "<td>" . $task['description'] . "</td>";
        echo "</tr>";
      } ?>
    </tbody>
  </table>
  <hr>
  <form method="POST" action="">
    <h2>Create your task here</h2>
    <input type="text" name="title" placeholder="Enter task title" required>
    <br /><br />
    <textarea type="text" name="description" placeholder="Enter task description" required></textarea>
    <br /><br />
    <button type="submit">
      Submit
    </button>
  </form>
</body>

</html>