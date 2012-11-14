<?php

class IndexController extends CcRepositoryBrowserAppController
{
  public $uses = array('Repository');

  public function setting()
  {
    if($this->request->data) {
      $repository = $this->Repository->findByProjectId($this->_project['Project']['id']);

      if ($repository) {
        $this->request->data['Repository']['id'] = $repository['Repository']['id'];
      }
      $this->request->data['Repository']['project_id'] = $this->_project['Project']['id'];
      $this->Repository->save($this->request->data);
    }

    $this->redirect(
      sprintf('/projects/settings/%s/?tab=repository', $this->request->params['project_id'])
    );
  }

  public function index()
  {
    $this->set('title_for_layout', '/ - リポジトリ');
    $repository = $this->Repository->findByProjectId($this->_project['Project']['id']);
    $this->set('project_id', $this->_project['Project']['identifier']);

    $contents = json_decode($this->_getContents('https://api.github.com/repos/' . $repository['Repository']['url'] . '/contents/'));

    $dirs = array();
    $files = array();
    foreach ($contents as $content) {
      if ($content->type === 'dir') {
        $dirs[$content->name] = $content;
      } else {
        $files[$content->name] = $content;
      }
    }
    ksort($dirs);
    ksort($files);

    // $this->set('contents', $contents);
    $this->set('contents', array_merge($dirs, $files));

    $commits =  json_decode($this->_getContents('https://api.github.com/repos/' . $repository['Repository']['url'] . '/commits'));
    $this->set('commits', $commits);
  }

  public function show()
  {
    $repository = $this->Repository->findByProjectId($this->_project['Project']['id']);
    $this->set('project_id', $this->_project['Project']['identifier']);

    $contents = json_decode($this->_getContents(
      'https://api.github.com/repos/' . $repository['Repository']['url'] . '/contents/' . $this->request->params['pass'][0]
    ));

    $dirs = array();
    $files = array();
    foreach ($contents as $content) {
      if ($content->type === 'dir') {
        $dirs[$content->name] = $content;
      } else {
        $files[$content->name] = $content;
      }
    }
    ksort($dirs);
    ksort($files);

    // $this->set('contents', $contents);
    $this->set('contents', array_merge($dirs, $files));

    $this->set('path', $this->request->params['pass'][0]);
  }

  public function entry()
  {
    $repository = $this->Repository->findByProjectId($this->_project['Project']['id']);
    $this->set('project_id', $this->_project['Project']['identifier']);

    $contents = json_decode($this->_getContents(
      'https://api.github.com/repos/' . $repository['Repository']['url'] . '/contents/' . $this->request->params['pass'][0]
    ));
    $this->set('path', $this->request->params['pass'][0]);
    $this->set('contents', base64_decode($contents->content));
  }

  public function changes()
  {
    $repository = $this->Repository->findByProjectId($this->_project['Project']['id']);
    $this->set('project_id', $this->_project['Project']['identifier']);

    $commits = json_decode($this->_getContents(
      'https://api.github.com/repos/' . $repository['Repository']['url'] . '/commits?path=' . $this->request->params['pass'][0]
    ));
    $this->set('path', $this->request->params['pass'][0]);
    $this->set('commits', $commits);
  }

  public function diff()
  {
    $repository = $this->Repository->findByProjectId($this->_project['Project']['id']);
    $this->set('project_id', $this->_project['Project']['identifier']);

    $contents = json_decode($this->_getContents(
      sprintf('https://api.github.com/repos/%s/compare/%s...%s',
        $repository['Repository']['url'],
        $this->request->query['rev_to'],
        $this->request->query['rev']
      )
    ));
    $this->set('contents', $contents);
    $this->set('rev', $this->request->query['rev']);
    $this->set('rev_to', $this->request->query['rev_to']);
  }

  protected function _getContents($url)
  {
    return file_get_contents($url);
  }
}
