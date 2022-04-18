<?php

// Объявляем нужные константы
define('DB_HOST', 'LOCAHOST');
define('DB_USER', 'dbUSER');
define('DB_PASSWORD', 'dbPASSWORD');
define('DB_NAME', 'dbNAME');


// Подключаемся к базе данных
function connectDB() {
    $errorMessage = 'Невозможно подключиться к серверу базы данных';
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$conn)
        throw new Exception($errorMessage);
    else {
        $query = $conn->query('set names utf8');
        if (!$query)
            throw new Exception($errorMessage);
        else
            return $conn;
    }
}

// Вытаскиваем категории из БД
function getCategories($db) {
    $query = "
        SELECT
           id AS `id`,
           IF (parent_id = 0, '#', parent_id) AS `parent`,
           category as `text`
        FROM
           categories
        ORDER BY
           `parent`, `number`
    ";
    $data = $db->query($query);
    $categories = array();
    while ($row = $data->fetch_assoc()) {
        array_push($categories, array(
            'id' => $row['id'],
            'parent' => $row['parent'],
            'text' => $row['text']
        ));
    }
    return $categories;
}

// Вставка категории по ее id, родителю и позиции number
function includePosition($db, $categoryId, $parentId, $position) {
    $query = "update categories set number = number + 1 where parent_id = $parentId and number >= $position";
    $db->query($query);
    $query = "update categories set parent_id = $parentId, number = $position where id = $categoryId";
    $db->query($query);
}

// Исключение категории по ее родителю и позиции number
function excludePosition($db, $parentId, $position) {
    $query = "update categories set number = number - 1 where parent_id = $parentId and number > $position";
    $db->query($query);
}

// Перемещение категории
function moveCategory($db, $params) {
    $categoryId = (int)$params['id'];
    $oldParentId = (int)$params['old_parent'];
    $newParentId = (int)$params['new_parent'];
    $oldPosition = (int)$params['old_position'] + 1;
    $newPosition = (int)$params['new_position'] + 1;

    excludePosition($db, $oldParentId, $oldPosition);
    includePosition($db, $categoryId, $newParentId, $newPosition);

    return json_encode(array(
        'code' => 'success'
    ));
}



try {
    // Подключаемся к базе данных
    $conn = connectDB();
    
    // Получаем данные из массива GET
    $action = $_GET['action'];
    switch ($action) {
        // Получаем дерево категорий
        case 'get_categories':
            $result = getCategories($conn);
            break;

        // Перемещаем категорию
        case 'move_category':
            $result = moveCategory($conn, $_GET);
            break;

        // Действие по умолчанию, ничего не делаем
        default:
            $result = 'unknown action';
            break;
    }

    // Возвращаем клиенту успешный ответ
    echo json_encode(array(
        'code' => 'success',
        'result' => $result
    ));
}
catch (Exception $e) {
    // Возвращаем клиенту ответ с ошибкой
    echo json_encode(array(
        'code' => 'error',
        'message' => $e->getMessage()
    ));
}
