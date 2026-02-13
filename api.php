<?php
header("Content-Type: application/json");

$file = "data.json";
$data = json_decode(file_get_contents($file), true);

$action = $_GET['action'] ?? '';

if ($action === "get") {
    $data['visits']++;
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    echo json_encode($data);
    exit;
}

if ($action === "add") {
    $input = json_decode(file_get_contents("php://input"), true);
    $data['items'][] = $input;
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    echo json_encode(["status" => "added"]);
    exit;
}

if ($action === "delete") {
    $index = intval($_GET['index']);
    array_splice($data['items'], $index, 1);
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    echo json_encode(["status" => "deleted"]);
    exit;
}