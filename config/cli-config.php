<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver;

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/dev.php';

$newDefaultAnnotationDrivers = array(
    __DIR__."/../src/Core/Lib"
);

$config = new \Doctrine\ORM\Configuration();
$config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ApcCache);
$driver = new Doctrine\ORM\Mapping\Driver\AnnotationDriver(new Doctrine\Common\Annotations\AnnotationReader(),$newDefaultAnnotationDrivers);

$config->setMetadataDriverImpl($driver);

$config->setProxyDir(__DIR__."/../vendor/doctrine/orm/lib/Doctrine/ORM/Proxies");
$config->setProxyNamespace("Proxies");
$app['db.options'] = array(
    'driver'    => 'pdo_mysql',
    'host'      => 'localhost',
    'dbname'    => 'ac_todos',
    'user'      => 'root',
    'password'  => '',
    'charset'   => 'utf8',
);
$paths =$newDefaultAnnotationDrivers;
$isDevMode = false;

$classLoader = new \Doctrine\Common\ClassLoader('Entities',__DIR__.'/../src/Core/Lib');
$classLoader->register();

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);

$em = \Doctrine\ORM\EntityManager::create($app['db.options'], $config);

$helpers = new Symfony\Component\Console\Helper\HelperSet(array(
   'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em),
));






