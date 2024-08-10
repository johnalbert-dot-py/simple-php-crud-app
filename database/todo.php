<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/database/config.php";

function getTasks($conn)
{
  $sql = "SELECT * FROM tasks";
  $result = $conn->query($sql);
  $allTasks = [];
  while ($row = $result->fetch_assoc()) {
    $allTasks[] = $row;
  }
  return $allTasks;
}

function createTask($conn, $title, $description)
{
  $sql = "INSERT INTO tasks(title, description) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $title, $description);
  $stmt->execute();

  return true;
}