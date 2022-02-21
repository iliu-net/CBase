<?php
class ArtifactController extends CBaseController {
  public function index($f3,$params) {
    if (isset($params['msg'])) {
      $f3->set('msg',$params['msg']);
    } else {
      $f3->set('msg','');
    }
    $arts = new Artifact($this->db);
    $f3->set('artifacts',$arts->find());
    $cats = new Category($this->db);
    $f3->set('cats',$cats->list_cats());
    echo View::instance()->render('artifact-list.html');
  }

  public function create($f3,$params) {
    if ($f3->exists('POST.create')) {
      $arts = new Artifact($this->db);
      $arts->reset();
      $arts->add();
      $f3->reroute('/artifact/msg/New artifact created');
      return;
    }
    $cats = new Category($this->db);
    $f3->set('cats',$cats->list_cats());

    $f3->set('form_action',Sc::url('/artifact/create'));
    $f3->set('page_head','Create Artifact');
    $f3->set('form_command','create');
    $f3->set('form_label','New Artifact');
    echo View::instance()->render('artifact-detail.html');
  }


  public function update($f3,$params) {
    $art = new Artifact($this->db);
    if ($f3->exists('POST.update')) {
      //~ echo '<pre>';
      //~ echo '$params'.PHP_EOL;
      //~ var_dump($params);
      //~ echo 'POST'.PHP_EOL;
      //~ var_dump($f3->get('POST'));
      //~ echo '</pre>';
      $art->reset();
      $art->edit($params['id']);
      $f3->reroute('/artifact/msg/Entry '.$params['id'].'  updated');
      return;
    }
    $art->get_by_id($params['id']);
    if (!$f3->get('POST.id')) {
      $f3->reroute('/artifact/msg/Lookup Error ('.$params['id'].')');
      return;
    }
    $cats = new Category($this->db);
    $f3->set('cats',$cats->list_cats());

    $f3->set('form_action',Sc::url('/artifact/update/'.$params['id']));
    $f3->set('page_head','Edit Artifact');
    $f3->set('form_command','update');
    $f3->set('form_label','Update');
    echo View::instance()->render('artifact-detail.html');
  }

  public function delete($f3,$params) {
    if (isset($params['id'])) {
      $id = $params['id'];
      $art = new Artifact($this->db);
      $art->delete($id);
      $f3->reroute('/artifact/msg/Artifact '.$id.' deleted!');
    } else {
      $f3->reroute('/artifact/msg/No record deleted');
    }
  }
}
