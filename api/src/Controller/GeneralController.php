<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\TodoList;

class GeneralController extends AbstractController
{
    private $entityManager;
    private $newTodoList;
    private $todoList;
    private $request;
    private $date;

    public function __construct(RequestStack $requestStack, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->newTodoList = new TodoList();
        $this->request = $requestStack->getCurrentRequest();
        $this->date = date( 'Y-m-d H:i:s' );
        
        $this->todoList = $this->entityManager
            ->getRepository(TodoList::class);
    }

    /**
     * @Route("/", name="general")
     */
    public function index()
    {

        if ( ! is_null( $this->request->get('action') ) && 'GET' === $this->request->getMethod() ) 
        {
            if ( 'getTodoList' === $_GET['action'] )
            {
                $serializer = $this->container->get('serializer');
                $result = json_decode( $serializer->serialize($this->todoList->findAllPriorty(), 'json') );
            }
            else
            {
                $result = "Invalid data login";
            }
        } 
        elseif ( ! is_null( $this->request->get('action') ) && 'POST' === $this->request->getMethod() )
        {
            if ( 'add' === $_POST['action'] )
            {   
                $result = $this->add();    
            }
            elseif ( 'complete' === $_POST['action'] )
            {
                $result = $this->complete();    
            }
            elseif ( 'update' === $_POST['action'] )
            {
                $result = $this->update();         
            }
            elseif ( 'delete' === $_POST['action'] )
            {   
                $result = $this->updateListOrder();            
            }
            elseif ( 'updateListOrder' === $_POST['action'] )
            {
                $result = $this->updateListOrder();    
            }
            else
            {
                $result = "Invalid data login";
            }
        }
        else
        {
            $result = "Invalid request";
        }
        return new JsonResponse($result);
    }

    private function add()
    {
        $priority = count( $this->todoList->findAll() ) + 1;
        $this->newTodoList
            ->setText($this->request->get('newTodo'))
            ->setCreated( $this->date )
            ->setUpdated( $this->date )
            ->setStatus( 0 )
            ->setPriority( $priority );
            
        $this->entityManager->persist($this->newTodoList);
        $this->entityManager->flush();
        return true;
    }
    
    private function complete()
    {
        $todoList = $this->todoList->get( $this->request->get('id') );

        $todoList
        ->setCompleted( $this->date )
        ->setStatus( 1 );

        $this->entityManager->persist($todoList);
        $this->entityManager->flush();
        return true;
    }

    private function update()
    {
        $todoList = $this->todoList->get( $this->request->get('id') );

        $todoList
        ->setUpdated( $this->date )
        ->setText( $this->request->get('newTodo') );

        $this->entityManager->persist($todoList);
        $this->entityManager->flush();
        return true;
    }

    private function delete()
    {
        $todoList = $this->todoList->get( $this->request->get('id') );
        $this->entityManager->remove($todoList);
        $this->entityManager->flush();
        return true;
    }

    private function updateListOrder()
    {
        $newTodoList =  json_decode( $this->request->get('todoList') );
        $priority = count( $newTodoList );
        foreach ($newTodoList as $todoList) {
            $oldTodoList = $this->todoList->get( $todoList->id );
            $oldTodoList->setPriority( $priority );
            $this->entityManager->persist($oldTodoList);
            $this->entityManager->flush();
            $priority--;
        }
        return true;
    }

}
