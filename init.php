<?php

$pluginContainer = ClassRegistry::getObject('PluginContainer');
$pluginContainer->installed('cc_repository_browser','0.1');


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
