<?php

// Bulunduğumuz dizin.
$path = __DIR__ . DIRECTORY_SEPARATOR;

// Sınıfımızı dahil edip örneği oluşturalım
require_once $path . 'todo-app.php';
$todoApp = new TodoApp( $path );

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ( isset( $_GET['action'] ) && 'GET' === $requestMethod )
{
    if ( 'getTodoList' === $_GET['action'] )
    {
        echo json_encode( $todoApp->getTodoList() );
    }
    else
    {
        echo "Invalid data login";
    }
}
elseif ( isset( $_POST['action'] ) && 'POST' === $requestMethod )
{
    if ( 'add' === $_POST['action'] )
    {   
        echo $todoApp->add( $_POST['newTodo'] );      
    }
    elseif ( 'complete' === $_POST['action'] )
    {
        echo $todoApp->complete( $_POST['id'] );       
    }
    elseif ( 'update' === $_POST['action'] )
    {
        echo $todoApp->update( $_POST['id'], $_POST['newTodo'] );       
    }
    elseif ( 'delete' === $_POST['action'] )
    {
        echo $todoApp->delete( $_POST['id'] );       
    }
    elseif ( 'updateListOrder' === $_POST['action'] )
    {
        echo $todoApp->updateListOrder( json_decode( $_POST['todoList'], true ) );
    }
    else
    {
        echo "Invalid data login";
    }
}
else
{
    echo "Invalid request";
}