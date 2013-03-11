<?php

$pluginContainer = ClassRegistry::getObject('PluginContainer');
$pluginContainer->installed('cc_repository_browser','0.1.2');

App::uses('CakeEventManager', 'Event');

CakeEventManager::instance()->attach(function($event) {
  $controller = $event->subject;

  if ($controller->name === 'Projects' && $controller->view === 'settings') {
    App::uses('Repository', 'Model');
    $model = new Repository();
    $repository = $model->findByProjectId($controller->_project['Project']['id']);

    $repository_url = '';
    if ($repository !== false) {
      $repository_url = $repository['Repository']['url'];
    }
    $controller->set('repository_url', $repository_url);
  }
}, 'Controller.beforeRender', array('priority' => 1));

$menuContainer = ClassRegistry::getObject('MenuContainer');
$menuContainer->addProjectMenu(
  'Repository',
  array(
    'plugin'     => 'CcRepositoryBrowser',
    'controller' => 'Index',
    'action'     => 'index',
    'class'      => '',
    'caption'    => 'Repository',
    'params'     => 'project_id',
    '_allowed'   => true // for bypassing permmission system.
  )
);

$menuContainer->addProjectSettingMenu(
  'Repository',
  array(
    // 'plugin'  => 'CcRepositoryBrowser',
    'name'    => 'repository',
    'partial' => 'CcRepositoryBrowser.repository/setting',
    'label'   => 'リポジトリ',
  )
);

CakePlugin::load(
  basename(dirname(__FILE__)),
  array('routes' => true)
);
