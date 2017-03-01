<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Core\Lib\MySqli;

$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    $twig->addGlobal('user', $app['session']->get('user'));

    return $twig;
}));


$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html', [
        'readme' => file_get_contents('README.md'),
    ]);
});


$app->match('/login', function (Request $request) use ($app) {
    $username = $request->get('username');
    $password = $request->get('password');

    if ($username) {
        $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
        $user = $app['db']->fetchAssoc($sql);

        if ($user){
            $app['session']->set('user', $user);
            return $app->redirect('/todo');
        }
    }

    return $app['twig']->render('login.html', array());
});


$app->get('/logout', function () use ($app) {
    $app['session']->set('user', null);
    return $app->redirect('/');
});


$app->get('/todo/{id}', function ($id) use ($app) {
    if (null === $user = $app['session']->get('user')) {
        return $app->redirect('/login');
    } 

    $db = new MySqli();

    if (is_numeric($id)){
        $todo = $db->fetchByIdFromDb($app, $id);
        return $app['twig']->render('todo.html', [
            'todo' => $todo,
        ]);
    } else {
        $todos =  $db->fetchAllFromDb($app, $user);
        return $app['twig']->render('todos.html', [
            'todos' => $todos,
        ]);
    }
})
->value('id', null);

$app->get('/todo/{id}/json', function ($id) use ($app) {
    if (null === $user = $app['session']->get('user')) {
        return $app->redirect('/login');
    }
    $db = new MySqli();

    if (is_numeric($id)){
        $todo = $db->fetchByIdFromDb($app, $id);
        return $app['twig']->render('json.html', [
            'todo' => json_encode($todo),
        ]);
    } else {
        return $app['twig']->render('json.html', [
            'todo' => 'Please Specify valid integer id in URL. Example --> /todo/2/json',
        ]);
    }
})->value('id', null);



$app->post('/todo/add', function (Request $request) use ($app) {
    if (null === $user = $app['session']->get('user')) {
        return $app->redirect('/login');
    }

    $db = new MySqli();
	if(!empty($request->get('description'))){

        if($db->insert($app,$user['id'],$request->get('description'))){
            $app['session']->getFlashBag()->add('notify', 'New Description Added');
            return $app->redirect('/todo');
        }
	}
	
    return $app->redirect('/todo');
});

$app->post('/todo/mark', function (Request $request) use ($app) {
    if (null === $user = $app['session']->get('user')) {
        return $app->redirect('/login');
    }
    $db = new MySqli();
    
    if(!empty($request->get('marked'))){
       $db->markCompleted($app, $request->get('marked'));
    }
    return $app->redirect('/todo');
});


$app->match('/todo/delete/{id}', function ($id) use ($app) {
    $db = new MySqli();
    $db->deleteById($app, $id);
    $app['session']->getFlashBag()->add('notify', 'Item/Description Deleted');
    return $app->redirect('/todo');
});

