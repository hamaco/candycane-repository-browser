<?php

Router::connect(
	'/projects/:project_id/repository/:action/**',
	array(
		'plugin' => 'CcRepositoryBrowser',
		'controller' => 'Index',
	)
);
